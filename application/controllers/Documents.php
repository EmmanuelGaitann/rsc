<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Documents — diffusion publique des documents de la table rsc_documents.
 *
 * Route : /telechargement/{id}/{nom-du-fichier}
 *
 * Pourquoi passer par un contrôleur plutôt qu'un lien direct ?
 *   - le .htaccess racine interdit .doc/.docx/.xls/.xlsx au web : ici le
 *     fichier est lu sur disque puis renvoyé, donc tous les formats passent ;
 *   - les noms de fichiers stockés restent opaques (pas d'énumération) ;
 *   - compteur de téléchargements par document ;
 *   - un PDF s'ouvre dans l'onglet (inline), les autres formats se
 *     téléchargent (attachment) — comportement identique à l'existant.
 */
class Documents extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Document_model');
    }

    public function download($id = 0, $slug = null)
    {
        $doc = $this->Document_model->get((int)$id);

        if (!$doc || (int)$doc->visible !== 1) show_404();

        $path = trim((string)$doc->file_path);
        if ($path === '') show_404();

        // Document hébergé ailleurs : simple redirection
        if (preg_match('#^https?://#i', $path)) {
            redirect($path);
            return;
        }

        $real = $this->_safe_realpath($path);
        if ($real === false) show_404();

        $this->Document_model->increment_downloads($doc->id);

        $this->_stream($real, $doc);
    }

    // ----------------------------------------------------------------
    // Interne
    // ----------------------------------------------------------------

    /**
     * Résout le chemin relatif stocké en base vers un fichier réel situé
     * sous la racine web. Bloque toute traversée de répertoire.
     *
     * @return string|false
     */
    private function _safe_realpath($rel)
    {
        $rel = ltrim(str_replace('\\', '/', $rel), '/');
        if ($rel === '' || strpos($rel, '../') !== false || strpos($rel, "\0") !== false) {
            return false;
        }

        $root = realpath(FCPATH);
        $real = realpath(FCPATH . $rel);

        if ($root === false || $real === false) return false;
        if (strpos($real, $root) !== 0)         return false;
        if (!is_file($real) || !is_readable($real)) return false;

        // Jamais de script exécutable renvoyé, même si la base est corrompue
        $ext = strtolower(pathinfo($real, PATHINFO_EXTENSION));
        if (in_array($ext, ['php', 'phtml', 'php3', 'php4', 'php5', 'php7', 'phar', 'htaccess'], true)) {
            return false;
        }

        return $real;
    }

    private function _stream($real, $doc)
    {
        $ext      = strtolower(pathinfo($real, PATHINFO_EXTENSION));
        $size     = filesize($real);
        $mime     = $doc->mime_type ? $doc->mime_type : $this->_mime_for($ext);
        $filename = $this->_download_name($doc, $ext);

        // Les PDF et images s'ouvrent dans l'onglet (comme avant la migration)
        $inline = in_array($ext, ['pdf', 'jpg', 'jpeg', 'png', 'webp', 'gif', 'svg', 'txt'], true);

        // On vide tout tampon de sortie éventuel : le corps doit être binaire pur
        while (ob_get_level() > 0) { @ob_end_clean(); }

        header('Content-Type: ' . $mime);
        header('Content-Length: ' . $size);
        header('Content-Disposition: ' . ($inline ? 'inline' : 'attachment')
            . '; filename="' . $this->_ascii_name($filename) . '"'
            . "; filename*=UTF-8''" . rawurlencode($filename));
        header('Content-Transfer-Encoding: binary');
        header('X-Content-Type-Options: nosniff');
        header('Cache-Control: public, max-age=86400');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($real)) . ' GMT');
        header('Accept-Ranges: none');

        readfile($real);

        // exit volontaire : court-circuite les hooks post_controller
        // (statistiques et traduction HTML) qui n'ont pas de sens ici et
        // corrompraient un flux binaire.
        exit;
    }

    /** Nom proposé au visiteur : titre du document + extension réelle. */
    private function _download_name($doc, $ext)
    {
        $base = trim((string)$doc->title);
        if ($base === '') {
            $base = pathinfo((string)$doc->original_name, PATHINFO_FILENAME);
        }
        if ($base === '') $base = 'document';

        $base = preg_replace('/[\\\\\/:*?"<>|\r\n]+/', ' ', $base);
        $base = trim(preg_replace('/\s+/', ' ', $base));
        $base = substr($base, 0, 120);

        return $base . ($ext !== '' ? '.' . $ext : '');
    }

    /** Variante ASCII du nom, pour les navigateurs anciens. */
    private function _ascii_name($name)
    {
        $name = preg_replace('/[^A-Za-z0-9._ -]+/', ' ', doc_ascii($name));
        $name = trim(preg_replace('/\s+/', ' ', $name));
        return $name !== '' ? $name : 'document';
    }

    private function _mime_for($ext)
    {
        $map = [
            'pdf'  => 'application/pdf',
            'doc'  => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls'  => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'ppt'  => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'zip'  => 'application/zip',
            'csv'  => 'text/csv',
            'txt'  => 'text/plain; charset=UTF-8',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png'  => 'image/png',
            'webp' => 'image/webp',
            'gif'  => 'image/gif',
            'svg'  => 'image/svg+xml',
        ];
        return isset($map[$ext]) ? $map[$ext] : 'application/octet-stream';
    }
}
