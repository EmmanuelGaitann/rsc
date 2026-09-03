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
