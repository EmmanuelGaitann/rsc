<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Tools — commandes de maintenance en ligne de commande UNIQUEMENT.
 * (introuvable en HTTP : show_404 pour toute requête web)
 *
 * Usage :
 *   php index.php tools translate_pending        -> traduit les textes en attente
 *   php index.php tools i18n_stats               -> état du cache de traduction
 *
 * Sur l'hébergement (o2switch), on peut ajouter un cron :
 *   0 3 * * * php /home/sc2koga4651/www/index.php tools translate_pending
 */
class Tools extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!is_cli()) show_404();
    }

    /** Traduit les textes marqués « en attente », par tours successifs. */
    public function translate_pending($rounds = 10)
    {
        $this->load->library('rsc_translator');
        $rounds = max(1, (int)$rounds);

        for ($i = 1; $i <= $rounds; $i++) {
            $r = $this->rsc_translator->translate_missing(200);
            echo "Tour $i : traduits={$r['done']}  échecs={$r['failed']}  restants={$r['remaining']}\n";
            if ($r['remaining'] === 0) { echo "Terminé — plus rien en attente.\n"; return; }
            if ($r['done'] === 0)      { echo "Services de traduction injoignables — réessayez plus tard.\n"; return; }
        }
    }

    /** Affiche l'état du cache de traduction. */
    public function i18n_stats()
    {
        $this->load->library('rsc_translator');
        $s = $this->rsc_translator->stats('en');
        echo "Textes connus : {$s['total']}\n";
        echo "  - auto      : {$s['auto']}\n";
        echo "  - manuels   : {$s['manual']}\n";
        echo "  - en attente: {$s['pending']}\n";
    }

    /**
     * Sauvegarde complète de la base dans application/backups/
     * (dossier interdit d'accès web). Conserve les $keep plus récentes.
     *
     *   php index.php tools db_backup          -> sauvegarde + rotation (10)
     *   php index.php tools db_backup 30       -> conserve 30 sauvegardes
     *
     * Cron o2switch conseillé (tous les jours à 3h) :
     *   0 3 * * * php /home/sc2koga4651/www/index.php tools db_backup 45
     */
    public function db_backup($keep = 10)
    {
        $dir = APPPATH . 'backups';
        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
            file_put_contents($dir . '/index.html', '');
            file_put_contents($dir . '/.htaccess', "Require all denied\n");
        }

        $file = $dir . '/rsc_backup_' . date('Ymd_His') . '.sql';
        $fh   = fopen($file, 'w');
        if (!$fh) { echo "ERREUR : impossible d'écrire dans $dir\n"; return; }

        $db = $this->db;
        fwrite($fh, "-- Sauvegarde Royal Sales Cameroon — " . date('c') . "\n");
        fwrite($fh, "SET NAMES utf8mb4;\nSET FOREIGN_KEY_CHECKS=0;\n\n");

        $tables = [];
        foreach ($db->query('SHOW TABLES')->result_array() as $row) {
            $tables[] = array_values($row)[0];
        }

        $total_rows = 0;
        foreach ($tables as $table) {
            $create = $db->query('SHOW CREATE TABLE `' . $table . '`')->row_array();
            $create_sql = array_values($create)[1];
            fwrite($fh, "DROP TABLE IF EXISTS `$table`;\n$create_sql;\n\n");

            $offset = 0;
            while (true) {
                $rows = $db->query("SELECT * FROM `$table` LIMIT 500 OFFSET $offset")->result_array();
                if (!$rows) break;
                $values = [];
                foreach ($rows as $r) {
                    $vals = [];
                    foreach ($r as $v) {
                        $vals[] = ($v === null) ? 'NULL' : $db->escape($v);
                    }
                    $values[] = '(' . implode(',', $vals) . ')';
                }
                $cols = '`' . implode('`,`', array_keys($rows[0])) . '`';
                fwrite($fh, "INSERT INTO `$table` ($cols) VALUES\n" . implode(",\n", $values) . ";\n");
                $total_rows += count($rows);
                $offset += 500;
            }
            fwrite($fh, "\n");
        }
        fwrite($fh, "SET FOREIGN_KEY_CHECKS=1;\n");
        fclose($fh);

        echo 'Sauvegarde : ' . basename($file) . ' (' . count($tables) . ' tables, '
            . $total_rows . ' lignes, ' . round(filesize($file) / 1024) . " Ko)\n";

        // Rotation
        $keep = max(1, (int)$keep);
        $files = glob($dir . '/rsc_backup_*.sql');
        rsort($files);
        foreach (array_slice($files, $keep) as $old) {
            unlink($old);
            echo 'Rotation : ' . basename($old) . " supprimée\n";
        }
    }
}
