<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * cms_field_attrs() — outputs data-cms-* attributes on editable elements.
 * Returns empty string for non-admin users so the HTML stays clean.
 *
 * @param string $key    block_key in rsc_content
 * @param string $type   text | html | image | url
 * @param string $label  human-readable label shown in the edit modal
 * @param string $value  current raw DB value (used as starting value in editor)
 */
if (!function_exists('cms_field_attrs')) {
    function cms_field_attrs($key, $type, $label, $value = '', $page = '') {
        $CI =& get_instance();
        if (!$CI->session->userdata('admin_id')) return '';

        $a  = 'data-cms-key="'   . htmlspecialchars($key,   ENT_QUOTES) . '"';
        $a .= ' data-cms-type="'  . htmlspecialchars($type,  ENT_QUOTES) . '"';
        $a .= ' data-cms-label="' . htmlspecialchars($label, ENT_QUOTES) . '"';
        if ($value !== '') {
            $a .= ' data-cms-value="' . htmlspecialchars($value, ENT_QUOTES) . '"';
        }
        if ($page !== '') {
            $a .= ' data-cms-page="' . htmlspecialchars($page, ENT_QUOTES) . '"';
        }
        return $a;
    }
}

/**
 * cta_url() — returns a validated CTA URL, falling back if the stored value is empty or invalid.
 * Prevents `#`, spaces, and other bad DB values from being used as href.
 *
 * @param mixed  $stored   raw value from $c array (may be unset, empty, or '#')
 * @param string $fallback safe default URL to use
 */
if (!function_exists('cta_url')) {
    function cta_url($stored, $fallback) {
        $v = isset($stored) ? trim((string)$stored) : '';
        $bad = ['', '#', '/#', '0', 'javascript:void(0)', 'javascript:;'];
        if (in_array($v, $bad, true)) return $fallback;
        // Reject relative paths — only accept absolute URLs or root-relative (/...)
        if (!preg_match('/^(https?:\/\/|tel:|mailto:|\/)/i', $v)) return $fallback;
        return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
    }
}

/**
 * cms_section_attrs() — outputs data-cms-section-* attributes on <section> elements.
 * Also hides the section via inline style for non-admin visitors when marked hidden.
 *
 * @param array  $c           the $c content array from the controller
 * @param string $section_key short key, e.g. 'hero', 'services', 'cta'
 * @param string $label       human-readable name shown in the section bar
 */
if (!function_exists('cms_section_attrs')) {
    function cms_section_attrs($c, $section_key, $label, $page = '') {
        $vis_key = 'section_' . $section_key . '_visible';
        $hidden  = isset($c[$vis_key]) && $c[$vis_key] === '0';

        $CI       =& get_instance();
        $is_admin = (bool)$CI->session->userdata('admin_id');

        $a  = 'data-cms-section="'       . htmlspecialchars($section_key, ENT_QUOTES) . '"';
        $a .= ' data-cms-section-label="' . htmlspecialchars($label,       ENT_QUOTES) . '"';
        $a .= ' data-cms-hidden="'        . ($hidden ? '1' : '0')                      . '"';
        if ($page !== '') {
            $a .= ' data-cms-page="' . htmlspecialchars($page, ENT_QUOTES) . '"';
        }

        if (!$is_admin && $hidden) {
            $a .= ' style="display:none"';
        }
        return $a;
    }
}

/* ======================================================================
 * DOCUMENTS TÉLÉCHARGEABLES (table rsc_documents)
 * ====================================================================== */

/**
 * doc_ascii() — translittération ASCII fiable, indépendante de la plateforme.
 * iconv('ASCII//TRANSLIT') renvoie des « ? » sous Windows : on applique donc
 * d'abord une table explicite, iconv ne servant que de filet.
 */
if (!function_exists('doc_ascii')) {
    function doc_ascii($str) {
        static $map = [
            'à'=>'a','á'=>'a','â'=>'a','ä'=>'a','ã'=>'a','å'=>'a','À'=>'A','Á'=>'A','Â'=>'A','Ä'=>'A','Ã'=>'A','Å'=>'A',
            'ç'=>'c','Ç'=>'C',
            'è'=>'e','é'=>'e','ê'=>'e','ë'=>'e','È'=>'E','É'=>'E','Ê'=>'E','Ë'=>'E',
            'ì'=>'i','í'=>'i','î'=>'i','ï'=>'i','Ì'=>'I','Í'=>'I','Î'=>'I','Ï'=>'I',
            'ñ'=>'n','Ñ'=>'N',
            'ò'=>'o','ó'=>'o','ô'=>'o','ö'=>'o','õ'=>'o','ø'=>'o','Ò'=>'O','Ó'=>'O','Ô'=>'O','Ö'=>'O','Õ'=>'O','Ø'=>'O',
            'ù'=>'u','ú'=>'u','û'=>'u','ü'=>'u','Ù'=>'U','Ú'=>'U','Û'=>'U','Ü'=>'U',
            'ý'=>'y','ÿ'=>'y','Ý'=>'Y',
            'æ'=>'ae','Æ'=>'AE','œ'=>'oe','Œ'=>'OE','ß'=>'ss',
            '—'=>'-','–'=>'-','‑'=>'-','’'=>"'",'‘'=>"'",'“'=>'"','”'=>'"',
            '·'=>'-','•'=>'-','°'=>'',' '=>' ','€'=>'EUR','«'=>'','»'=>'',
        ];

        $out = strtr((string)$str, $map);

        // Filet : tout caractère non-ASCII restant
        if (preg_match('/[^\x20-\x7E]/', $out) && function_exists('iconv')) {
            $conv = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $out);
            if ($conv !== false) $out = str_replace('?', '', $conv);
        }
        return $out;
    }
}

/**
 * doc_slug() — nom de fichier « propre » utilisé dans l'URL publique.
 * Purement cosmétique / SEO : seul l'id compte pour retrouver le document.
 */
if (!function_exists('doc_slug')) {
    function doc_slug($doc) {
        $path = isset($doc->file_path) ? (string)$doc->file_path : '';
        $ext  = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        $base = isset($doc->title) ? (string)$doc->title : 'document';
        $base = strtolower(doc_ascii($base));
        $base = preg_replace('/[^a-z0-9]+/', '-', $base);
        $base = trim((string)$base, '-');
        if ($base === '') $base = 'document';
        $base = substr($base, 0, 80);

        return $base . ($ext !== '' ? '.' . $ext : '');
    }
}

/**
 * doc_url() — URL publique d'un document.
 *   - URL externe (http/https)      => lien direct
 *   - ligne en base (id non nul)    => /telechargement/{id}/{slug} (compteur + MIME corrects)
 *   - repli « en dur » (id === null) => lien direct vers le fichier, comme avant migration
 */
if (!function_exists('doc_url')) {
    function doc_url($doc) {
        $path = isset($doc->file_path) ? trim((string)$doc->file_path) : '';
        if ($path === '') return '#';

        if (preg_match('#^https?://#i', $path)) {
            return htmlspecialchars($path, ENT_QUOTES, 'UTF-8');
        }

        if (!empty($doc->id)) {
            return base_url('telechargement/' . (int)$doc->id . '/' . doc_slug($doc));
        }

        // Repli : chemin direct (chaque segment encodé — espaces, accents, virgules)
        $segments = array_map('rawurlencode', explode('/', ltrim($path, '/')));
        return base_url(implode('/', $segments));
    }
}

/** doc_ext() — extension en majuscules (PDF, DOCX…), chaîne vide si inconnue. */
if (!function_exists('doc_ext')) {
    function doc_ext($doc) {
        $path = isset($doc->file_path) ? (string)$doc->file_path : '';
        return strtoupper(pathinfo($path, PATHINFO_EXTENSION));
    }
}

/** doc_badge() — badge affiché (valeur saisie en admin, sinon l'extension). */
if (!function_exists('doc_badge')) {
    function doc_badge($doc) {
        $b = isset($doc->badge) ? trim((string)$doc->badge) : '';
        return $b !== '' ? $b : doc_ext($doc);
    }
}

/** doc_icon() — classe Font Awesome : valeur saisie en admin, sinon déduite de l'extension. */
if (!function_exists('doc_icon')) {
    function doc_icon($doc) {
        $icon = isset($doc->icon) ? trim((string)$doc->icon) : '';
        if ($icon !== '') return $icon;

        switch (doc_ext($doc)) {
            case 'PDF':  return 'fa-file-pdf';
            case 'DOC':
            case 'DOCX': return 'fa-file-word';
            case 'XLS':
            case 'XLSX':
            case 'CSV':  return 'fa-file-excel';
            case 'PPT':
            case 'PPTX': return 'fa-file-powerpoint';
            case 'ZIP':  return 'fa-file-zipper';
            case 'JPG':
            case 'JPEG':
            case 'PNG':
            case 'WEBP': return 'fa-file-image';
            default:     return 'fa-file-lines';
        }
    }
}

/** doc_size() — taille lisible (« 2,4 Mo »), chaîne vide si inconnue. */
if (!function_exists('doc_size')) {
    function doc_size($doc) {
        $b = isset($doc->file_size) ? (int)$doc->file_size : 0;
        if ($b <= 0) return '';
        if ($b < 1024)        return $b . ' o';
        if ($b < 1048576)     return number_format($b / 1024, 0, ',', ' ') . ' Ko';
        return number_format($b / 1048576, 1, ',', ' ') . ' Mo';
    }
}
