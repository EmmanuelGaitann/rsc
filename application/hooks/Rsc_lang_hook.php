<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Rsc_lang_hook — gestion de la langue du site + traduction de la sortie.
 *
 * detect_lang (post_controller_constructor) :
 *   - ?lang=en|fr dans l'URL  => définit le cookie rsc_lang (1 an)
 *   - sinon cookie rsc_lang   => langue mémorisée du visiteur
 *   - défaut                  => fr (langue d'édition du site)
 *
 * translate_output (post_controller) :
 *   - si la langue demandée est 'en' et que la page est une page publique
 *     HTML, la sortie est traduite par Rsc_translator (cache en base +
 *     traduction automatique des chaînes manquantes).
 */
class Rsc_lang_hook {

    const DEFAULT_LANG   = 'fr';
    const ALLOWED_LANGS  = array('fr', 'en');
    const COOKIE_NAME    = 'rsc_lang';

    public function detect_lang()
    {
        $CI =& get_instance();

        $lang = null;

        // 1. Paramètre d'URL explicite (?lang=en)
        $get = $CI->input->get('lang');
        if (is_string($get) && in_array(strtolower($get), self::ALLOWED_LANGS, true)) {
            $lang = strtolower($get);
            // Mémorise le choix pour 1 an (cookie lisible côté JS pour les boutons FR/EN)
            setcookie(self::COOKIE_NAME, $lang, array(
                'expires'  => time() + 31536000,
                'path'     => '/',
                'secure'   => !(defined('RSC_LOCAL') && RSC_LOCAL),
                'httponly' => false,
                'samesite' => 'Lax',
            ));
            $_COOKIE[self::COOKIE_NAME] = $lang;
        }

        // 2. Cookie mémorisé
        if ($lang === null && isset($_COOKIE[self::COOKIE_NAME])
            && in_array($_COOKIE[self::COOKIE_NAME], self::ALLOWED_LANGS, true)) {
            $lang = $_COOKIE[self::COOKIE_NAME];
        }

        if ($lang === null) {
            $lang = self::DEFAULT_LANG;
        }

        $CI->config->set_item('rsc_lang', $lang);
    }

    /**
     * Statistiques de fréquentation internes — totalement anonymes :
     * un simple compteur (jour, page, langue) sans cookie, sans IP,
     * sans donnée personnelle. Consultables dans Admin → Statistiques.
     */
    public function log_stats()
    {
        if (is_cli()) return;
        $CI =& get_instance();

        if (strtoupper($CI->input->server('REQUEST_METHOD') ?: '') !== 'GET') return;

        $segment = (string)$CI->uri->segment(1);
        if (in_array($segment, array('admin', 'tools', 'sitemap', 'sitemap.xml'), true)) return;

        // Ignore les robots d'indexation et les outils
        $ua = (string)$CI->input->user_agent();
        if ($ua === '' || preg_match('/bot|crawl|spider|slurp|curl|wget|python|httpclient|scan|monitor/i', $ua)) return;

        // Ne compter que les vraies pages HTML
        $out = $CI->output->get_output();
        if ($out === '' || stripos($out, '<html') === false) return;

        $day  = date('Y-m-d');
        $path = '/' . $CI->uri->uri_string();
        $path = mb_substr($path === '/' ? '/' : rtrim($path, '/'), 0, 180);
        $lang = $CI->config->item('rsc_lang') ?: 'fr';

        $db  = $CI->db;
        $sql = 'INSERT INTO rsc_stats (day, path, lang, hits) VALUES ('
             . $db->escape($day) . ',' . $db->escape($path) . ',' . $db->escape($lang) . ', 1)'
             . ' ON DUPLICATE KEY UPDATE hits = hits + 1';

        // simple_query : silencieux — si la table n'existe pas encore, on la crée puis on réessaie.
        if (!@$db->simple_query($sql)) {
            @$db->simple_query(
                'CREATE TABLE IF NOT EXISTS rsc_stats (
                    day DATE NOT NULL,
                    path VARCHAR(180) NOT NULL,
                    lang VARCHAR(5) NOT NULL DEFAULT \'fr\',
                    hits INT UNSIGNED NOT NULL DEFAULT 0,
                    PRIMARY KEY (day, path, lang)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
            );
            @$db->simple_query($sql);
        }
    }

    public function translate_output()
    {
        $CI =& get_instance();

        $lang = $CI->config->item('rsc_lang');
        if (!$lang || $lang === self::DEFAULT_LANG) {
            return; // français : rien à faire
        }

        // Jamais de traduction dans l'administration ni sur le sitemap
        $segment = $CI->uri->segment(1);
        if (in_array($segment, array('admin', 'sitemap', 'sitemap.xml'), true)) {
            return;
        }

        $output = $CI->output->get_output();

        // Ne traduire que les vraies pages HTML complètes
        if ($output === '' || stripos($output, '<html') === false) {
            return;
        }

        try {
            $CI->load->library('rsc_translator');
            $translated = $CI->rsc_translator->translate_page($output, $lang, self::DEFAULT_LANG);
            if (is_string($translated) && $translated !== '') {
                $CI->output->set_output($translated);
            }
        } catch (Throwable $e) {
            // En cas de pépin (extension DOM absente, base indisponible…),
            // on sert la page originale plutôt qu'une erreur.
            log_message('error', 'Rsc_lang_hook: traduction impossible — ' . $e->getMessage());
        }
    }
}
