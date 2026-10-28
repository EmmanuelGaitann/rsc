-- ============================================================
-- MIGRATION PRODUCTION — Royal Sales Cameroon (www.rsc-cameroon.com)
-- Module « Documents & PDF » : plus aucun fichier téléchargeable en dur,
-- tout est géré depuis Admin → Documents & PDF.
--
-- À exécuter sur la base de PRODUCTION (phpMyAdmin o2switch),
-- APRÈS avoir uploadé les fichiers du site.
--
-- ✅ SANS RISQUE :
--    - aucun DROP, aucun DELETE, aucun ALTER sur une table existante ;
--    - une seule table est créée (rsc_documents) ;
--    - le script est RÉEXÉCUTABLE : chaque insertion est protégée par un
--      test d'existence sur file_path (aucun doublon possible) ;
--    - si vous ne l'exécutez pas, le site continue de fonctionner :
--      le code crée la table au premier passage dans l'admin et retombe
--      sur les PDF historiques en attendant.
-- ============================================================

-- ------------------------------------------------------------
-- 1. Table des documents téléchargeables
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsc_documents` (
  `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `page`          VARCHAR(80)  NOT NULL DEFAULT 'partners_renner' COMMENT 'Page du site : partners_renner, partners_ir, partners_cas',
  `title`         VARCHAR(255) NOT NULL                           COMMENT 'Titre affiché sur la carte de téléchargement',
  `subtitle`      VARCHAR(255) DEFAULT NULL                       COMMENT 'Ligne de détail sous le titre',
  `file_path`     VARCHAR(500) NOT NULL DEFAULT ''                COMMENT 'Chemin web-relatif (assets/...) OU URL https complète',
  `original_name` VARCHAR(255) DEFAULT NULL                       COMMENT 'Nom du fichier tel que téléversé',
  `mime_type`     VARCHAR(100) DEFAULT NULL,
  `file_size`     INT UNSIGNED DEFAULT NULL                       COMMENT 'Taille en octets',
  `icon`          VARCHAR(60)  NOT NULL DEFAULT 'fa-file-pdf'     COMMENT 'Classe Font Awesome',
  `badge`         VARCHAR(30)  DEFAULT NULL                       COMMENT 'Pastille : PDF · FR, MSDS…',
  `sort_order`    SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `visible`       TINYINT(1)   NOT NULL DEFAULT 1,
  `downloads`     INT UNSIGNED NOT NULL DEFAULT 0                 COMMENT 'Compteur de téléchargements',
  `created_at`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_page_visible` (`page`,`visible`,`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='Documents téléchargeables (PDF, Word, Excel, ZIP…) — remplace les fichiers en dur des vues';

-- ------------------------------------------------------------
-- 2. Reprise des 10 PDF actuellement codés en dur dans les vues
--
--    Les fichiers physiques restent EXACTEMENT où ils sont
--    (assets/Documents/). On ne fait qu'enregistrer leurs métadonnées :
--    les liens du site sont donc identiques au pixel près, et les
--    anciennes URL directes continuent de fonctionner.
--
--    Chaque INSERT est ignoré si la ligne existe déjà → script rejouable.
-- ------------------------------------------------------------

-- 2a. Page Partenaire RENNER -------------------------------------------------

INSERT INTO `rsc_documents`
  (`page`,`title`,`subtitle`,`file_path`,`original_name`,`mime_type`,`file_size`,`icon`,`badge`,`sort_order`,`visible`)
SELECT 'partners_renner','Compresseurs à vis — Présentation','FR · Technologie & gamme à vis',
       'assets/Documents/Présentation_compresseurs_à_vis_FR.pdf','Présentation_compresseurs_à_vis_FR.pdf',
       'application/pdf',7281408,'fa-file-pdf','PDF · FR',10,1
  FROM DUAL
 WHERE NOT EXISTS (SELECT 1 FROM `rsc_documents` d
                    WHERE d.file_path = 'assets/Documents/Présentation_compresseurs_à_vis_FR.pdf');

INSERT INTO `rsc_documents`
  (`page`,`title`,`subtitle`,`file_path`,`original_name`,`mime_type`,`file_size`,`icon`,`badge`,`sort_order`,`visible`)
SELECT 'partners_renner','RS / RSF 55–110 kW — Prospectus','FR · Série RS/RSF puissances moyennes',
       'assets/Documents/RS(F) 55,0 - 1-110_prospectus_FR.pdf','RS(F) 55,0 - 1-110_prospectus_FR.pdf',
       'application/pdf',1370174,'fa-file-pdf','PDF · FR',20,1
  FROM DUAL
 WHERE NOT EXISTS (SELECT 1 FROM `rsc_documents` d
                    WHERE d.file_path = 'assets/Documents/RS(F) 55,0 - 1-110_prospectus_FR.pdf');

INSERT INTO `rsc_documents`
  (`page`,`title`,`subtitle`,`file_path`,`original_name`,`mime_type`,`file_size`,`icon`,`badge`,`sort_order`,`visible`)
SELECT 'partners_renner','Vue d''ensemble produits RENNER','DE/EN/FR · Catalogue gamme complète',
       'assets/Documents/Product overview_flyer_DE_EN_FR.pdf','Product overview_flyer_DE_EN_FR.pdf',
       'application/pdf',1169425,'fa-file-pdf','PDF',30,1
  FROM DUAL
 WHERE NOT EXISTS (SELECT 1 FROM `rsc_documents` d
                    WHERE d.file_path = 'assets/Documents/Product overview_flyer_DE_EN_FR.pdf');

INSERT INTO `rsc_documents`
  (`page`,`title`,`subtitle`,`file_path`,`original_name`,`mime_type`,`file_size`,`icon`,`badge`,`sort_order`,`visible`)
SELECT 'partners_renner','Brochure image RENNER','DE/EN/FR · Catalogue visuel institutionnel',
       'assets/Documents/Brochure image_DE_EN_FR.pdf','Brochure image_DE_EN_FR.pdf',
       'application/pdf',2033487,'fa-images','PDF',40,1
  FROM DUAL
 WHERE NOT EXISTS (SELECT 1 FROM `rsc_documents` d
                    WHERE d.file_path = 'assets/Documents/Brochure image_DE_EN_FR.pdf');

INSERT INTO `rsc_documents`
  (`page`,`title`,`subtitle`,`file_path`,`original_name`,`mime_type`,`file_size`,`icon`,`badge`,`sort_order`,`visible`)
SELECT 'partners_renner','Commandes électroniques RENNER','FR · Systèmes de contrôle & supervision',
       'assets/Documents/Commandes électroniques_prospectus_FR.pdf','Commandes électroniques_prospectus_FR.pdf',
       'application/pdf',1633235,'fa-microchip','PDF · FR',50,1
  FROM DUAL
 WHERE NOT EXISTS (SELECT 1 FROM `rsc_documents` d
                    WHERE d.file_path = 'assets/Documents/Commandes électroniques_prospectus_FR.pdf');

INSERT INTO `rsc_documents`
  (`page`,`title`,`subtitle`,`file_path`,`original_name`,`mime_type`,`file_size`,`icon`,`badge`,`sort_order`,`visible`)
SELECT 'partners_renner','Scroll Compressors — Overview','EN · Compresseurs scroll sans huile',
       'assets/Documents/Scroll compressors overview - EN.pdf','Scroll compressors overview - EN.pdf',
       'application/pdf',3660274,'fa-file-pdf','PDF · EN',60,1
  FROM DUAL
 WHERE NOT EXISTS (SELECT 1 FROM `rsc_documents` d
                    WHERE d.file_path = 'assets/Documents/Scroll compressors overview - EN.pdf');

INSERT INTO `rsc_documents`
  (`page`,`title`,`subtitle`,`file_path`,`original_name`,`mime_type`,`file_size`,`icon`,`badge`,`sort_order`,`visible`)
SELECT 'partners_renner','Famille de filtres RENNER','EN · Filtration air comprimé',
       'assets/Documents/filter family.pdf','filter family.pdf',
       'application/pdf',545393,'fa-filter','PDF · EN',70,1
  FROM DUAL
 WHERE NOT EXISTS (SELECT 1 FROM `rsc_documents` d
                    WHERE d.file_path = 'assets/Documents/filter family.pdf');

-- 2b. Page Partenaire CAS Lubricants -----------------------------------------

INSERT INTO `rsc_documents`
  (`page`,`title`,`subtitle`,`file_path`,`original_name`,`mime_type`,`file_size`,`icon`,`badge`,`sort_order`,`visible`)
SELECT 'partners_cas','Flyer produit — CAS Compressor Oil','Présentation commerciale · Applications · Avantages · Version anglaise',
       'assets/Documents/Compressor_Oil_Flyer_KAS_Eng.pdf','Compressor_Oil_Flyer_KAS_Eng.pdf',
       'application/pdf',268217,'fa-file-pdf','PDF · EN',10,1
  FROM DUAL
 WHERE NOT EXISTS (SELECT 1 FROM `rsc_documents` d
                    WHERE d.file_path = 'assets/Documents/Compressor_Oil_Flyer_KAS_Eng.pdf');

INSERT INTO `rsc_documents`
  (`page`,`title`,`subtitle`,`file_path`,`original_name`,`mime_type`,`file_size`,`icon`,`badge`,`sort_order`,`visible`)
SELECT 'partners_cas','Fiche technique CAS Lubricants','Spécifications · Caractéristiques physico-chimiques · Recommandations d''utilisation',
       'assets/Documents/cas_lubricant.pdf','cas_lubricant.pdf',
       'application/pdf',349124,'fa-file-pdf','PDF',20,1
  FROM DUAL
 WHERE NOT EXISTS (SELECT 1 FROM `rsc_documents` d
                    WHERE d.file_path = 'assets/Documents/cas_lubricant.pdf');

INSERT INTO `rsc_documents`
  (`page`,`title`,`subtitle`,`file_path`,`original_name`,`mime_type`,`file_size`,`icon`,`badge`,`sort_order`,`visible`)
SELECT 'partners_cas','Fiche de sécurité MSDS — CAS C1','Material Safety Data Sheet · Stockage · Premiers secours · Élimination',
       'assets/Documents/CAS_C1_MSDS.pdf','CAS_C1_MSDS.pdf',
       'application/pdf',168993,'fa-shield-halved','MSDS',30,1
  FROM DUAL
 WHERE NOT EXISTS (SELECT 1 FROM `rsc_documents` d
                    WHERE d.file_path = 'assets/Documents/CAS_C1_MSDS.pdf');

-- 2c. Page Partenaire Ingersoll Rand -----------------------------------------
--     Aucun document fourni à ce jour. La section « Documentation technique »
--     de cette page reste invisible jusqu'au premier document ajouté
--     depuis Admin → Documents & PDF.

-- ------------------------------------------------------------
-- 3. Vérification (facultatif — à exécuter pour contrôle)
-- ------------------------------------------------------------
-- SELECT page, COUNT(*) AS nb FROM rsc_documents GROUP BY page;
--   Résultat attendu après migration :
--     partners_cas     3
--     partners_renner  7

-- Fin de migration.
