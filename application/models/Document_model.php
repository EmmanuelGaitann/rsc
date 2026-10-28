<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Document_model — Documents téléchargeables (PDF, DOCX, XLSX, ZIP…)
 *
 * Remplace les fichiers « en dur » des vues par des enregistrements en base,
 * gérables depuis Admin → Documents.
 *
 * Deux garde-fous pour ne JAMAIS casser la production :
 *   1. ensure_schema() crée la table au premier usage (même principe que
 *      _ensure_leads_table() dans le contrôleur Admin).
 *   2. get_for_page() retombe sur defaults() si la table est absente ou vide :
 *      le site continue d'afficher les PDF historiques de assets/Documents/.
 */
class Document_model extends CI_Model {

    const TABLE   = 'rsc_documents';
    const UPL_DIR = 'assets/uploads/docs/';

    /** Pages pouvant recevoir des documents (clé => libellé admin) */
    public static $pages = [
        'partners_renner' => 'Partenaire — RENNER Kompressoren',
        'partners_ir'     => 'Partenaire — Ingersoll Rand',
        'partners_cas'    => 'Partenaire — CAS Lubricants',
    ];

    private static $table_checked = null;

    // ----------------------------------------------------------------
    // Lecture
    // ----------------------------------------------------------------

    /**
     * Documents visibles d'une page, triés. Retombe sur les valeurs
     * historiques si la table n'existe pas encore ou ne contient rien
     * pour cette page.
     */
    public function get_for_page($page)
    {
        if (!$this->table_ready()) {
            return $this->defaults($page);
        }

        $rows = $this->db
            ->where('page', $page)
            ->where('visible', 1)
            ->order_by('sort_order', 'ASC')
            ->order_by('id', 'ASC')
            ->get(self::TABLE)
            ->result();

        return $rows ? $rows : $this->defaults($page);
    }

    /** Tous les documents (admin), toutes pages confondues. */
    public function get_all()
    {
        if (!$this->table_ready()) return [];

        return $this->db
            ->order_by('page', 'ASC')
            ->order_by('sort_order', 'ASC')
            ->order_by('id', 'ASC')
            ->get(self::TABLE)
            ->result();
    }

    public function get($id)
    {
        if (!$this->table_ready()) return null;
        return $this->db->where('id', (int)$id)->get(self::TABLE)->row();
    }

    public function count_all()
    {
        if (!$this->table_ready()) return 0;
        return (int)$this->db->count_all(self::TABLE);
    }

    // ----------------------------------------------------------------
    // Écriture
    // ----------------------------------------------------------------

    public function insert($data)
    {
        $this->ensure_schema();
        $this->db->insert(self::TABLE, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->ensure_schema();
        $this->db->where('id', (int)$id)->update(self::TABLE, $data);
    }

    public function delete($id)
    {
        if (!$this->table_ready()) return;
        $this->db->where('id', (int)$id)->delete(self::TABLE);
    }

    public function toggle_visible($id)
    {
        $item = $this->get($id);
        if ($item) {
            $this->db->where('id', (int)$id)
                     ->update(self::TABLE, ['visible' => $item->visible ? 0 : 1]);
        }
    }

    public function increment_downloads($id)
    {
        if (!$this->table_ready()) return;
        @$this->db->simple_query(
            'UPDATE ' . self::TABLE . ' SET downloads = downloads + 1 WHERE id = ' . (int)$id
        );
    }

    // ----------------------------------------------------------------
    // Schéma
    // ----------------------------------------------------------------

    /** TRUE si la table existe (mis en cache pour la durée de la requête). */
    public function table_ready()
    {
        if (self::$table_checked === null) {
            self::$table_checked = (bool)$this->db->table_exists(self::TABLE);
        }
        return self::$table_checked;
    }

    /**
     * Crée la table si absente puis sème les documents historiques.
     * Idempotent — appelé uniquement depuis l'admin (jamais en front).
     */
    public function ensure_schema()
    {
        if ($this->table_ready()) return;

        @$this->db->simple_query(
            'CREATE TABLE IF NOT EXISTS ' . self::TABLE . " (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                page VARCHAR(80) NOT NULL DEFAULT 'partners_renner',
                title VARCHAR(255) NOT NULL,
                subtitle VARCHAR(255) DEFAULT NULL,
                file_path VARCHAR(500) NOT NULL DEFAULT '',
                original_name VARCHAR(255) DEFAULT NULL,
                mime_type VARCHAR(100) DEFAULT NULL,
                file_size INT UNSIGNED DEFAULT NULL,
                icon VARCHAR(60) NOT NULL DEFAULT 'fa-file-pdf',
                badge VARCHAR(30) DEFAULT NULL,
                sort_order SMALLINT UNSIGNED NOT NULL DEFAULT 0,
                visible TINYINT(1) NOT NULL DEFAULT 1,
                downloads INT UNSIGNED NOT NULL DEFAULT 0,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                KEY idx_page_visible (page, visible, sort_order)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
        );

        self::$table_checked = (bool)$this->db->table_exists(self::TABLE);
        if (!self::$table_checked) return;

        // Semis : uniquement si la table est vide (aucun doublon possible)
        if ((int)$this->db->count_all(self::TABLE) === 0) {
            foreach (array_keys(self::$pages) as $pg) {
                foreach ($this->defaults($pg) as $d) {
                    $this->db->insert(self::TABLE, [
                        'page'          => $pg,
                        'title'         => $d->title,
                        'subtitle'      => $d->subtitle,
                        'file_path'     => $d->file_path,
                        'original_name' => basename($d->file_path),
                        'mime_type'     => 'application/pdf',
                        'file_size'     => $d->file_size,
                        'icon'          => $d->icon,
                        'badge'         => $d->badge,
                        'sort_order'    => (int)$d->sort_order,
                        'visible'       => 1,
                    ]);
                }
            }
        }
    }

    private function disk_size($rel_path)
    {
        $full = FCPATH . ltrim($rel_path, '/');
        return is_file($full) ? filesize($full) : null;
    }

    // ----------------------------------------------------------------
    // Valeurs historiques (filet de sécurité)
    // ----------------------------------------------------------------

    /**
     * Liste « en dur » d'origine, conservée comme repli. Les objets renvoyés
     * ont la même forme qu'une ligne de la table, avec id = null : les vues
     * et doc_url() génèrent alors un lien direct vers le fichier, exactement
     * comme avant la migration.
     */
    public function defaults($page)
    {
        $seed = [
            'partners_renner' => [
                ['Compresseurs à vis — Présentation', 'FR · Technologie & gamme à vis',             'assets/Documents/Présentation_compresseurs_à_vis_FR.pdf',    'fa-file-pdf',      'PDF · FR'],
                ['RS / RSF 55–110 kW — Prospectus',   'FR · Série RS/RSF puissances moyennes',      'assets/Documents/RS(F) 55,0 - 1-110_prospectus_FR.pdf',      'fa-file-pdf',      'PDF · FR'],
                ["Vue d'ensemble produits RENNER",    'DE/EN/FR · Catalogue gamme complète',        'assets/Documents/Product overview_flyer_DE_EN_FR.pdf',       'fa-file-pdf',      'PDF'],
                ['Brochure image RENNER',             'DE/EN/FR · Catalogue visuel institutionnel', 'assets/Documents/Brochure image_DE_EN_FR.pdf',               'fa-images',        'PDF'],
                ['Commandes électroniques RENNER',    'FR · Systèmes de contrôle & supervision',    'assets/Documents/Commandes électroniques_prospectus_FR.pdf', 'fa-microchip',     'PDF · FR'],
                ['Scroll Compressors — Overview',     'EN · Compresseurs scroll sans huile',        'assets/Documents/Scroll compressors overview - EN.pdf',      'fa-file-pdf',      'PDF · EN'],
                ['Famille de filtres RENNER',         'EN · Filtration air comprimé',               'assets/Documents/filter family.pdf',                         'fa-filter',        'PDF · EN'],
            ],
            'partners_cas' => [
                ['Flyer produit — CAS Compressor Oil', 'Présentation commerciale · Applications · Avantages · Version anglaise',              'assets/Documents/Compressor_Oil_Flyer_KAS_Eng.pdf', 'fa-file-pdf',      'PDF · EN'],
                ['Fiche technique CAS Lubricants',     "Spécifications · Caractéristiques physico-chimiques · Recommandations d'utilisation", 'assets/Documents/cas_lubricant.pdf',                'fa-file-pdf',      'PDF'],
                ['Fiche de sécurité MSDS — CAS C1',    'Material Safety Data Sheet · Stockage · Premiers secours · Élimination',              'assets/Documents/CAS_C1_MSDS.pdf',                  'fa-shield-halved', 'MSDS'],
            ],
            'partners_ir' => [],
        ];

        if (!isset($seed[$page])) return [];

        $out = [];
        $i   = 0;
        foreach ($seed[$page] as $row) {
            $i += 10;
            $o = new stdClass();
            $o->id            = null;
            $o->page          = $page;
            $o->title         = $row[0];
            $o->subtitle      = $row[1];
            $o->file_path     = $row[2];
            $o->icon          = $row[3];
            $o->badge         = $row[4];
            $o->original_name = basename($row[2]);
            $o->mime_type     = 'application/pdf';
            $o->file_size     = $this->disk_size($row[2]);
            $o->sort_order    = $i;
            $o->visible       = 1;
            $o->downloads     = 0;
            $out[] = $o;
        }
        return $out;
    }
}
