-- ============================================================
-- MIGRATION PRODUCTION — Royal Sales Cameroon (www.rsc-cameroon.com)
-- À exécuter UNE SEULE FOIS sur la base de PRODUCTION (phpMyAdmin
-- o2switch), après avoir uploadé les fichiers du site.
--
-- Ce script est SANS RISQUE : il ne supprime ni ne modifie aucune
-- donnée existante (CREATE TABLE IF NOT EXISTS + migrations douces).
-- Remarque : les 3 tables se créent aussi automatiquement au premier
-- usage — ce script ne fait que prendre de l'avance.
-- ============================================================

-- 1. Cache de traduction automatique FR -> EN
CREATE TABLE IF NOT EXISTS `rsc_translations` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lang` VARCHAR(5) NOT NULL,
  `source_hash` CHAR(40) NOT NULL,
  `source_text` MEDIUMTEXT NOT NULL,
  `translated_text` MEDIUMTEXT DEFAULT NULL,
  `status` ENUM('auto','manual','pending') NOT NULL DEFAULT 'pending',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_lang_hash` (`lang`,`source_hash`),
  KEY `idx_lang_status` (`lang`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Demandes reçues (formulaire de contact centralisé)
CREATE TABLE IF NOT EXISTS `rsc_leads` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(190) NOT NULL,
  `company` VARCHAR(190) DEFAULT NULL,
  `email` VARCHAR(190) NOT NULL,
  `phone` VARCHAR(50) DEFAULT NULL,
  `whatsapp` VARCHAR(50) DEFAULT NULL,
  `subject` VARCHAR(150) DEFAULT NULL,
  `message` TEXT,
  `lang` VARCHAR(5) NOT NULL DEFAULT 'fr',
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `status` ENUM('nouveau','traite') NOT NULL DEFAULT 'nouveau',
  `email_sent` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_status` (`status`),
  KEY `idx_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Statistiques de fréquentation internes (anonymes)
CREATE TABLE IF NOT EXISTS `rsc_stats` (
  `day` DATE NOT NULL,
  `path` VARCHAR(180) NOT NULL,
  `lang` VARCHAR(5) NOT NULL DEFAULT 'fr',
  `hits` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`day`,`path`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Migration des contenus saisis dans d'anciens champs jamais affichés
--    (l'éditeur admin a été resynchronisé avec les pages réelles)

-- 4a. Accueil : hero_subtitle (texte de présentation saisi par le client,
--     jamais affiché) devient hero_desc (le champ réellement affiché).
--     Si hero_desc existe déjà : il n'est rempli que s'il était vide.
INSERT INTO rsc_content (page, block_key, label, type, value)
SELECT 'home', 'hero_desc', 'Description héros', 'html', s.value
FROM rsc_content s
WHERE s.page = 'home' AND s.block_key = 'hero_subtitle' AND s.value <> ''
LIMIT 1
ON DUPLICATE KEY UPDATE
  value = IF(rsc_content.value = '' OR rsc_content.value IS NULL, VALUES(value), rsc_content.value);

-- 4b. À propos : intro_image (image chargée par le client, jamais affichée)
--     devient main_img (le champ réellement affiché), seulement si vide.
INSERT INTO rsc_content (page, block_key, label, type, value)
SELECT 'about', 'main_img', 'Image principale (À propos)', 'image', s.value
FROM rsc_content s
WHERE s.page = 'about' AND s.block_key = 'intro_image' AND s.value <> ''
LIMIT 1
ON DUPLICATE KEY UPDATE
  value = IF(rsc_content.value = '' OR rsc_content.value IS NULL, VALUES(value), rsc_content.value);

-- 4c. Suppression des lignes orphelines (clés que plus aucune page ne lit)
DELETE FROM rsc_content WHERE page = 'home'
  AND block_key IN ('hero_title','hero_subtitle','hero_btn1','hero_btn2',
                    'about_badge','about_title','about_text','about_image',
                    'cta_subtitle','cta_btn1','cta_btn2');
DELETE FROM rsc_content WHERE page = 'about'
  AND block_key IN ('intro_title','intro_text','intro_image');
DELETE FROM rsc_content WHERE page = 'gallery'
  AND block_key IN ('slide1','slide2','slide3');

-- Fin de migration.
