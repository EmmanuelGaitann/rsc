<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Rsc_translator — traduction automatique du site avec cache en base.
 *
 * Principe :
 *  - La page HTML finale (rendue en français) est analysée (DOM).
 *  - Chaque texte visible (nœuds texte + attributs alt/title/placeholder/…)
 *    est recherché dans la table cache `rsc_translations`.
 *  - Les textes absents du cache sont traduits automatiquement (Google
 *    Translate public par lots, avec repli MyMemory), puis mis en cache.
 *  - Les textes modifiés/créés par le client dans l'admin sont donc traduits
 *    automatiquement dès leur premier affichage en anglais.
 *  - L'admin peut corriger chaque traduction (statut `manual`, jamais écrasé).
 *
 * Robustesse :
 *  - Pas de réseau / service indisponible : les textes restent en français,
 *    marqués `pending`, et ne sont retentés qu'après un délai de
 *    RETRY_COOLDOWN_S — les pages restent rapides même hors ligne.
 *  - Bouton « Traduire les textes en attente » dans l'admin pour rattraper.
 */
class Rsc_translator {

    const TABLE               = 'rsc_translations';
    const MAX_NEW_PER_REQUEST = 80;    // nb max de chaînes traduites par affichage
    const HTTP_BUDGET_S       = 6.0;   // budget temps API par affichage (secondes)
    const MAX_LEN             = 4000;  // au-delà : texte laissé en français
    const RETRY_COOLDOWN_S    = 600;   // délai avant de retenter une chaîne en échec
    const BATCH_MAX_ITEMS     = 25;    // textes max par requête API
    const BATCH_MAX_CHARS     = 3500;  // caractères max par requête API

    protected $CI;
    protected $schema_ok = false;
    protected $google_down = false;    // disjoncteur pour la requête en cours

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->database();
    }

    // ================================================================
    // API publique
    // ================================================================

    /**
     * Traduit une page HTML complète. Retourne le HTML traduit
     * (ou le HTML d'origine si la traduction est impossible).
     */
    public function translate_page($html, $to = 'en', $from = 'fr')
    {
        if (!class_exists('DOMDocument') || $to === $from) {
            return $html;
        }

        $this->ensure_schema();
        $this->maybe_seed($to);

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        // Le préfixe XML force l'interprétation UTF-8 par le parseur HTML.
        $loaded = $dom->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_NOWARNING | LIBXML_NOERROR);
        libxml_clear_errors();
        if (!$loaded) {
            return $html;
        }
        foreach ($dom->childNodes as $child) {
            if ($child->nodeType === XML_PI_NODE) {
                $dom->removeChild($child);
                break;
            }
        }
        $dom->encoding = 'UTF-8';

        $xp = new DOMXPath($dom);

        // ---- Collecte des éléments traduisibles -------------------------
        $items   = array(); // chaque item : [node, kind, hash, lead, trail]
        $by_hash = array(); // hash => texte source normalisé

        $skip = 'ancestor-or-self::script or ancestor-or-self::style or ancestor-or-self::code'
              . ' or ancestor-or-self::pre or ancestor-or-self::textarea'
              . ' or ancestor-or-self::*[@translate="no"]'
              . ' or ancestor-or-self::*[contains(concat(" ", normalize-space(@class), " "), " notranslate ")]';

        foreach ($xp->query('//text()[not(' . $skip . ')]') as $node) {
            if (!preg_match('/^(\s*)(.*?)(\s*)$/su', $node->nodeValue, $m)) continue;
            $core = preg_replace('/\s+/u', ' ', $m[2]);
            if (!$this->is_translatable($core)) continue;
            $h = sha1($core);
            $by_hash[$h] = $core;
            $items[] = array($node, 'text', $h, $m[1], $m[3]);
        }

        $attr_queries = array(
            '//@placeholder',
            '//@title',
            '//@alt',
            '//@aria-label',
            '//input[@type="submit" or @type="button"]/@value',
            '//meta[@name="description" or @name="title"'
                . ' or @property="og:title" or @property="og:description"'
                . ' or @name="twitter:title" or @name="twitter:description"]/@content',
        );
        foreach ($attr_queries as $q) {
            foreach ($xp->query($q) as $attr) {
                $core = preg_replace('/\s+/u', ' ', trim($attr->nodeValue));
                if (!$this->is_translatable($core)) continue;
                $h = sha1($core);
                $by_hash[$h] = $core;
                $items[] = array($attr, 'attr', $h, '', '');
            }
        }

        if (!$by_hash) {
            return $html;
        }

        // ---- Cache existant ---------------------------------------------
        $map = $this->fetch_cached(array_keys($by_hash), $to);

        // ---- Chaînes à traduire -------------------------------------------
        $now     = time();
        $missing = array();
        foreach ($by_hash as $h => $src) {
            if (!isset($map[$h])) {
                $missing[$h] = $src;                       // jamais vue
            } elseif ($map[$h]['t'] === '' && $map[$h]['status'] !== 'manual') {
                // en attente : ne retenter qu'après le délai de refroidissement
                if ($now - $map[$h]['ts'] >= self::RETRY_COOLDOWN_S) {
                    $missing[$h] = $src;
                }
            }
        }

        if ($missing) {
            $batch = array_slice($missing, 0, self::MAX_NEW_PER_REQUEST, true);
            $overflow = array_slice($missing, self::MAX_NEW_PER_REQUEST, null, true);

            $results = $this->machine_translate($batch, $from, $to, self::HTTP_BUDGET_S);

            $ok = $ko = array();
            foreach ($batch as $h => $src) {
                if (isset($results[$h]) && $results[$h] !== null && $results[$h] !== '') {
                    $ok[$h] = array($src, $results[$h]);
                    $map[$h] = array('t' => $results[$h], 'status' => 'auto', 'ts' => $now);
                } else {
                    $ko[$h] = array($src, null);
                }
            }
            if ($ok) $this->store($ok, $to, 'auto');
            // Échecs + dépassement de quota : « pending » (updated_at sert de
            // point de départ du délai avant nouvel essai)
            foreach ($overflow as $h => $src) $ko[$h] = array($src, null);
            if ($ko) $this->store($ko, $to, 'pending');
        }

        // ---- Application des traductions ----------------------------------
        foreach ($items as $it) {
            list($node, $kind, $h, $lead, $trail) = $it;
            if (!isset($map[$h]) || $map[$h]['t'] === '' || $map[$h]['t'] === null) continue;
            if ($kind === 'text') {
                $node->nodeValue = $lead . $map[$h]['t'] . $trail;
            } else {
                $node->nodeValue = $map[$h]['t'];
            }
        }

        // ---- Métadonnées de langue ----------------------------------------
        $html_el = $dom->getElementsByTagName('html')->item(0);
        if ($html_el) $html_el->setAttribute('lang', $to);
        foreach ($xp->query('//meta[@property="og:locale"]') as $meta) {
            $meta->setAttribute('content', $to === 'en' ? 'en_US' : 'fr_CM');
        }
        foreach ($xp->query('//meta[@name="language"]') as $meta) {
            $meta->setAttribute('content', $to === 'en' ? 'English' : 'French');
        }

        $out = $dom->saveHTML();
        return ($out !== false && $out !== '') ? $out : $html;
    }

    /**
     * Traduit un lot de chaînes en attente (bouton admin / maintenance).
     * Retourne array('done' => n, 'failed' => n, 'remaining' => n).
     */
    public function translate_missing($limit = 150, $to = 'en', $from = 'fr')
    {
        $this->ensure_schema();

        $rows = $this->CI->db->query(
            'SELECT source_hash, source_text FROM ' . self::TABLE .
            " WHERE lang = ? AND (translated_text IS NULL OR translated_text = '') AND status <> 'manual' LIMIT " . (int)$limit,
            array($to)
        )->result();

        $batch = array();
        foreach ($rows as $r) $batch[$r->source_hash] = $r->source_text;

        $done = $failed = 0;
        if ($batch) {
            $results = $this->machine_translate($batch, $from, $to, 25.0);
            $ok = $ko = array();
            foreach ($batch as $h => $src) {
                if (isset($results[$h]) && $results[$h] !== null && $results[$h] !== '') {
                    $ok[$h] = array($src, $results[$h]);
                    $done++;
                } else {
                    $ko[$h] = array($src, null);
                    $failed++;
                }
            }
            if ($ok) $this->store($ok, $to, 'auto');
            if ($ko) $this->store($ko, $to, 'pending'); // remet le compteur de cooldown à zéro
        }

        $remaining = (int)$this->CI->db->query(
            'SELECT COUNT(*) c FROM ' . self::TABLE .
            " WHERE lang = ? AND (translated_text IS NULL OR translated_text = '') AND status <> 'manual'",
            array($to)
        )->row()->c;

        return array('done' => $done, 'failed' => $failed, 'remaining' => $remaining);
    }

    /** Statistiques pour la page admin. */
    public function stats($to = 'en')
    {
        $this->ensure_schema();
        $this->maybe_seed($to);
        $row = $this->CI->db->query(
            'SELECT COUNT(*) total,'
            . " SUM(status = 'manual') manual,"
            . " SUM(status = 'auto') auto,"
            . " SUM(translated_text IS NULL OR translated_text = '') pending"
            . ' FROM ' . self::TABLE . ' WHERE lang = ?',
            array($to)
        )->row();
        return array(
            'total'   => (int)$row->total,
            'manual'  => (int)$row->manual,
            'auto'    => (int)$row->auto,
            'pending' => (int)$row->pending,
        );
    }

    // ================================================================
    // Schéma & seed
    // ================================================================

    public function ensure_schema()
    {
        if ($this->schema_ok) return;
        $this->CI->db->query(
            "CREATE TABLE IF NOT EXISTS " . self::TABLE . " (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                lang VARCHAR(5) NOT NULL,
                source_hash CHAR(40) NOT NULL,
                source_text MEDIUMTEXT NOT NULL,
                translated_text MEDIUMTEXT NULL,
                status ENUM('auto','manual','pending') NOT NULL DEFAULT 'pending',
                updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                UNIQUE KEY uq_lang_hash (lang, source_hash),
                KEY idx_lang_status (lang, status)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
        );
        $this->schema_ok = true;
    }

    /**
     * Amorce le cache avec le dictionnaire FR→EN historique du site
     * (assets/js/translations.js converti en application/config/i18n_seed.php).
     * Ne fait rien si le cache contient déjà des entrées.
     */
    protected function maybe_seed($to)
    {
        if ($to !== 'en') return;
        $n = (int)$this->CI->db->query(
            'SELECT COUNT(*) c FROM ' . self::TABLE . ' WHERE lang = ?', array($to)
        )->row()->c;
        if ($n > 0) return;

        $seed_file = APPPATH . 'config/i18n_seed.php';
        if (!is_file($seed_file)) return;

        $rsc_i18n_seed = array();
        include $seed_file;

        $pairs = array();
        foreach ($rsc_i18n_seed as $pair) {
            if (empty($pair['fr']) || empty($pair['en'])) continue;
            $src = preg_replace('/\s+/u', ' ', trim($pair['fr']));
            $trg = preg_replace('/\s+/u', ' ', trim($pair['en']));
            if ($src === '' || $trg === '') continue;
            $pairs[sha1($src)] = array($src, $trg);
        }
        if ($pairs) $this->store($pairs, $to, 'manual');
    }

    // ================================================================
    // Internes
    // ================================================================

    protected function is_translatable($core)
    {
        if ($core === '' || mb_strlen($core) > self::MAX_LEN) return false;
        if (!preg_match('/\p{L}/u', $core)) return false;                    // aucune lettre
        if (preg_match('~^(https?://|www\.|mailto:|tel:|//)~i', $core)) return false;
        if (preg_match('/^[+\d][\d\s().\/-]*$/', $core)) return false;       // téléphone / nombre
        if (filter_var($core, FILTER_VALIDATE_EMAIL)) return false;
        return true;
    }

    /** Retourne hash => array('t' => traduction, 'status' => statut, 'ts' => timestamp). */
    protected function fetch_cached(array $hashes, $to)
    {
        $map = array();
        foreach (array_chunk($hashes, 300) as $chunk) {
            $in = implode(',', array_map(array($this->CI->db, 'escape'), $chunk));
            $rows = $this->CI->db->query(
                'SELECT source_hash, translated_text, status, UNIX_TIMESTAMP(updated_at) ts FROM ' . self::TABLE .
                ' WHERE lang = ' . $this->CI->db->escape($to) . ' AND source_hash IN (' . $in . ')'
            )->result();
            foreach ($rows as $r) {
                $map[$r->source_hash] = array(
                    't'      => (string)$r->translated_text,
                    'status' => $r->status,
                    'ts'     => (int)$r->ts,
                );
            }
        }
        return $map;
    }

    /**
     * Insère/actualise des paires. $pairs : hash => array(source, traduction|null).
     * Une entrée `manual` existante n'est jamais écrasée.
     * updated_at est systématiquement rafraîchi (sert d'horodatage du dernier essai).
     */
    protected function store(array $pairs, $to, $status)
    {
        if (!$pairs) return;
        $db = $this->CI->db;
        foreach (array_chunk($pairs, 100, true) as $chunk) {
            $values = array();
            foreach ($chunk as $h => $p) {
                $values[] = '(' . $db->escape($to) . ',' . $db->escape($h) . ','
                    . $db->escape($p[0]) . ','
                    . ($p[1] === null ? 'NULL' : $db->escape($p[1])) . ','
                    . $db->escape($status) . ')';
            }
            $db->query(
                'INSERT INTO ' . self::TABLE . ' (lang, source_hash, source_text, translated_text, status) VALUES '
                . implode(',', $values)
                . " ON DUPLICATE KEY UPDATE"
                . " translated_text = IF(status = 'manual', translated_text,"
                . "   IF(VALUES(translated_text) IS NULL, translated_text, VALUES(translated_text))),"
                . " status = IF(status = 'manual', status,"
                . "   IF(VALUES(translated_text) IS NULL, status, VALUES(status))),"
                . " updated_at = CURRENT_TIMESTAMP"
            );
        }
    }

    /**
     * Traduction automatique par lots.
     * $texts : hash => texte source. Retourne hash => traduction|null.
     *
     * 1. Google Translate public (translate_a/t) : ~25 textes par requête.
     * 2. En cas d'échec Google (blocage, réseau) : repli MyMemory, texte par
     *    texte, dans la limite du budget temps.
     */
    protected function machine_translate(array $texts, $from, $to, $budget_s = 6.0)
    {
        $out = array();
        foreach ($texts as $h => $t) $out[$h] = null;
        if (!$texts || !function_exists('curl_init')) return $out;

        $deadline = microtime(true) + $budget_s;

        // ---- Constitution des lots -------------------------------------
        $batches = array();
        $cur = array(); $cur_len = 0;
        foreach ($texts as $h => $t) {
            $len = mb_strlen($t);
            if ($cur && (count($cur) >= self::BATCH_MAX_ITEMS || $cur_len + $len > self::BATCH_MAX_CHARS)) {
                $batches[] = $cur;
                $cur = array(); $cur_len = 0;
            }
            $cur[$h] = $t;
            $cur_len += $len;
        }
        if ($cur) $batches[] = $cur;

        // ---- 1. Google par lots ------------------------------------------
        $failed = array();
        foreach ($batches as $batch) {
            if ($this->google_down || microtime(true) > $deadline) {
                foreach ($batch as $h => $t) $failed[$h] = $t;
                continue;
            }
            $res = $this->google_batch($batch, $from, $to);
            if ($res === null) {
                // service indisponible : on arrête d'insister pour cette requête
                $this->google_down = true;
                foreach ($batch as $h => $t) $failed[$h] = $t;
            } else {
                foreach ($batch as $h => $t) {
                    if (isset($res[$h]) && $res[$h] !== '') $out[$h] = $res[$h];
                    else $failed[$h] = $t;
                }
            }
        }

        // ---- 2. Repli MyMemory (texte par texte, borné par le budget temps) --
        if ($failed) {
            $n = 0;
            foreach ($failed as $h => $t) {
                if (microtime(true) > $deadline || ++$n > 150) break;
                $tr = $this->mymemory_one($t, $from, $to);
                if ($tr !== null) $out[$h] = $tr;
            }
        }

        return $out;
    }

    /**
     * Un lot vers l'endpoint public translate_a/t.
     * Retourne hash => traduction, ou NULL si le service est indisponible.
     */
    protected function google_batch(array $batch, $from, $to)
    {
        $body = '';
        foreach ($batch as $t) {
            $body .= ($body === '' ? '' : '&') . 'q=' . urlencode($t);
        }

        $ch = curl_init(
            'https://translate.googleapis.com/translate_a/t?client=dict-chrome-ex'
            . '&sl=' . urlencode($from) . '&tl=' . urlencode($to)
        );
        curl_setopt_array($ch, array(
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $body,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT        => 6,
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0 Safari/537.36',
            CURLOPT_HTTPHEADER     => array('Content-Type: application/x-www-form-urlencoded'),
        ));
        $resp = curl_exec($ch);
        $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code !== 200 || !$resp) return null;
        $j = json_decode($resp, true);
        if (!is_array($j)) return null;

        // Réponse : ["trad1","trad2",…] ou [["trad1",…],["trad2",…],…]
        // (un seul q => parfois une chaîne simple)
        if (count($batch) === 1 && is_string($j)) $j = array($j);

        $keys = array_keys($batch);
        $outp = array();
        $i = 0;
        foreach ($j as $item) {
            if (!isset($keys[$i])) break;
            if (is_string($item)) {
                $outp[$keys[$i]] = trim($item);
            } elseif (is_array($item) && isset($item[0]) && is_string($item[0])) {
                $outp[$keys[$i]] = trim($item[0]);
            }
            $i++;
        }
        // Le compte doit correspondre, sinon la réponse n'est pas fiable
        if (count($outp) !== count($batch)) return null;
        return $outp;
    }

    /** Traduction d'un seul texte via MyMemory (repli). NULL si échec. */
    protected function mymemory_one($text, $from, $to)
    {
        if (mb_strlen($text) > 500) return null; // limite du service gratuit
        $url = 'https://api.mymemory.translated.net/get?q=' . urlencode($text)
             . '&langpair=' . urlencode($from . '|' . $to)
             . '&de=info@rsc-cameroon.com';
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT        => 5,
            CURLOPT_USERAGENT      => 'RSC-Website/1.0 (info@rsc-cameroon.com)',
        ));
        $resp = curl_exec($ch);
        $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($code !== 200 || !$resp) return null;
        $j = json_decode($resp, true);
        if (!is_array($j) || !isset($j['responseData']['translatedText'])) return null;
        if ((int)($j['responseStatus'] ?? 0) !== 200) return null;
        $t = trim((string)$j['responseData']['translatedText']);
        if ($t === '' || stripos($t, 'MYMEMORY WARNING') !== false) return null;
        return $t;
    }
}
