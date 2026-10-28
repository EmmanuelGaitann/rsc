<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    // ----------------------------------------------------------------
    // Définition des pages éditables et de leurs champs
    // ----------------------------------------------------------------
    private $page_defs = [

        /*
         * IMPORTANT : chaque champ listé ici correspond EXACTEMENT à une clé
         * réellement affichée par la vue (views/home/index.php). Ne pas ajouter
         * de champ sans l'utiliser dans la vue, sinon il n'aura aucun effet.
         */
        'home' => [
            'title' => "Page d'Accueil",
            'icon'  => 'fa-house',
            'route' => '',
            'sections' => [
                [
                    'label'  => 'Bannière principale (Hero)',
                    'fields' => [
                        ['key'=>'slide1',          'label'=>'Image carrousel 1',              'type'=>'image'],
                        ['key'=>'slide2',          'label'=>'Image carrousel 2',              'type'=>'image'],
                        ['key'=>'slide3',          'label'=>'Image carrousel 3',              'type'=>'image'],
                        ['key'=>'hero_badge',      'label'=>'Badge (texte court au-dessus du titre)', 'type'=>'text'],
                        ['key'=>'hero_title_1',    'label'=>'Titre — Ligne 1',                'type'=>'text'],
                        ['key'=>'hero_title_2',    'label'=>'Titre — Ligne 2 (couleur accent)','type'=>'text'],
                        ['key'=>'hero_title_3',    'label'=>'Titre — Ligne 3',                'type'=>'text'],
                        ['key'=>'hero_desc',       'label'=>'Description',                    'type'=>'html'],
                        ['key'=>'hero_btn1_text',  'label'=>'Bouton 1 — Texte',               'type'=>'text'],
                        ['key'=>'hero_btn1_url',   'label'=>'Bouton 1 — URL',                 'type'=>'url'],
                        ['key'=>'hero_btn2_text',  'label'=>'Bouton 2 — Texte',               'type'=>'text'],
                        ['key'=>'hero_btn2_url',   'label'=>'Bouton 2 — URL',                 'type'=>'url'],
                        ['key'=>'hero_side_image', 'label'=>'Photo côté droit',               'type'=>'image'],
                    ],
                ],
                [
                    'label'  => 'Chiffres clés',
                    'fields' => [
                        ['key'=>'stat1_value','label'=>'Stat 1 — Valeur (ex: 10+)',  'type'=>'text'],
                        ['key'=>'stat1_label','label'=>'Stat 1 — Libellé',           'type'=>'text'],
                        ['key'=>'stat2_value','label'=>'Stat 2 — Valeur',            'type'=>'text'],
                        ['key'=>'stat2_label','label'=>'Stat 2 — Libellé',           'type'=>'text'],
                        ['key'=>'stat3_value','label'=>'Stat 3 — Valeur',            'type'=>'text'],
                        ['key'=>'stat3_label','label'=>'Stat 3 — Libellé',           'type'=>'text'],
                        ['key'=>'stat4_value','label'=>'Stat 4 — Valeur',            'type'=>'text'],
                        ['key'=>'stat4_label','label'=>'Stat 4 — Libellé',           'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Section Services',
                    'fields' => [
                        ['key'=>'services_label',    'label'=>'Label de section',            'type'=>'text'],
                        ['key'=>'services_title',    'label'=>'Titre de section',            'type'=>'text'],
                        ['key'=>'services_subtitle', 'label'=>'Sous-titre',                  'type'=>'text'],
                        ['key'=>'srv1_title', 'label'=>'Service 1 — Titre',       'type'=>'text'],
                        ['key'=>'srv1_desc',  'label'=>'Service 1 — Description', 'type'=>'text'],
                        ['key'=>'srv1_url',   'label'=>'Service 1 — URL',         'type'=>'url'],
                        ['key'=>'srv2_title', 'label'=>'Service 2 — Titre',       'type'=>'text'],
                        ['key'=>'srv2_desc',  'label'=>'Service 2 — Description', 'type'=>'text'],
                        ['key'=>'srv2_url',   'label'=>'Service 2 — URL',         'type'=>'url'],
                        ['key'=>'srv3_title', 'label'=>'Service 3 — Titre',       'type'=>'text'],
                        ['key'=>'srv3_desc',  'label'=>'Service 3 — Description', 'type'=>'text'],
                        ['key'=>'srv3_url',   'label'=>'Service 3 — URL',         'type'=>'url'],
                        ['key'=>'services_all_text', 'label'=>'Bouton « Voir tous » — Texte', 'type'=>'text'],
                        ['key'=>'services_all_url',  'label'=>'Bouton « Voir tous » — URL',   'type'=>'url'],
                    ],
                ],
                [
                    'label'  => 'Offre phare (Contrats de maintenance)',
                    'fields' => [
                        ['key'=>'contracts_badge', 'label'=>'Badge',             'type'=>'text'],
                        ['key'=>'contracts_title', 'label'=>'Titre',             'type'=>'text'],
                        ['key'=>'contracts_desc',  'label'=>'Description',       'type'=>'text'],
                        ['key'=>'contracts_cta',   'label'=>'Bouton — Texte',    'type'=>'text'],
                        ['key'=>'contracts_url',   'label'=>'Bouton — URL',      'type'=>'url'],
                    ],
                ],
                [
                    'label'  => 'Bandeau partenaires',
                    'fields' => [
                        ['key'=>'partners_label1',       'label'=>'Label RENNER',              'type'=>'text'],
                        ['key'=>'partners_renner_sub',   'label'=>'Sous-titre RENNER',         'type'=>'text'],
                        ['key'=>'partners_label2',       'label'=>'Label Ingersoll Rand',      'type'=>'text'],
                        ['key'=>'partners_ir_sub',       'label'=>'Sous-titre Ingersoll Rand', 'type'=>'text'],
                        ['key'=>'partners_stat_value',   'label'=>'Statistique (valeur)',      'type'=>'text'],
                        ['key'=>'partners_catalog_text', 'label'=>'Bouton catalogue — Texte',  'type'=>'text'],
                        ['key'=>'partners_catalog_url',  'label'=>'Bouton catalogue — URL',    'type'=>'url'],
                    ],
                ],
                [
                    'label'  => 'Produits vedette (3 cartes)',
                    'fields' => [
                        ['key'=>'products_label',    'label'=>'Label de section',       'type'=>'text'],
                        ['key'=>'products_title',    'label'=>'Titre de section',       'type'=>'text'],
                        ['key'=>'products_subtitle', 'label'=>'Sous-titre de section',  'type'=>'text'],
                        ['key'=>'prod1_img',   'label'=>'Produit 1 — Image',            'type'=>'image'],
                        ['key'=>'prod1_label', 'label'=>'Produit 1 — Label (marque)',   'type'=>'text'],
                        ['key'=>'prod1_title', 'label'=>'Produit 1 — Titre',            'type'=>'text'],
                        ['key'=>'prod1_desc',  'label'=>'Produit 1 — Description',      'type'=>'text'],
                        ['key'=>'prod1_url',   'label'=>'Produit 1 — URL du lien',      'type'=>'url'],
                        ['key'=>'prod1_cta',   'label'=>'Produit 1 — Texte bouton',     'type'=>'text'],
                        ['key'=>'prod2_img',   'label'=>'Produit 2 — Image',            'type'=>'image'],
                        ['key'=>'prod2_label', 'label'=>'Produit 2 — Label (marque)',   'type'=>'text'],
                        ['key'=>'prod2_title', 'label'=>'Produit 2 — Titre',            'type'=>'text'],
                        ['key'=>'prod2_desc',  'label'=>'Produit 2 — Description',      'type'=>'text'],
                        ['key'=>'prod2_url',   'label'=>'Produit 2 — URL du lien',      'type'=>'url'],
                        ['key'=>'prod2_cta',   'label'=>'Produit 2 — Texte bouton',     'type'=>'text'],
                        ['key'=>'prod3_img',   'label'=>'Produit 3 — Image',            'type'=>'image'],
                        ['key'=>'prod3_label', 'label'=>'Produit 3 — Label (marque)',   'type'=>'text'],
                        ['key'=>'prod3_title', 'label'=>'Produit 3 — Titre',            'type'=>'text'],
                        ['key'=>'prod3_desc',  'label'=>'Produit 3 — Description',      'type'=>'text'],
                        ['key'=>'prod3_url',   'label'=>'Produit 3 — URL du lien',      'type'=>'url'],
                        ['key'=>'prod3_cta',   'label'=>'Produit 3 — Texte bouton',     'type'=>'text'],
                        ['key'=>'products_all_text', 'label'=>'Bouton « Voir tout » — Texte', 'type'=>'text'],
                        ['key'=>'products_all_url',  'label'=>'Bouton « Voir tout » — URL',   'type'=>'url'],
                    ],
                ],
                [
                    'label'  => 'Section À propos',
                    'fields' => [
                        ['key'=>'about_img',        'label'=>'Photo principale',   'type'=>'image'],
                        ['key'=>'about_label',      'label'=>'Label de section',   'type'=>'text'],
                        ['key'=>'about_title_home', 'label'=>'Titre de section',   'type'=>'text'],
                        ['key'=>'about_desc1',      'label'=>'Paragraphe 1',       'type'=>'html'],
                        ['key'=>'about_desc2',      'label'=>'Paragraphe 2',       'type'=>'html'],
                        ['key'=>'about_feat1',      'label'=>'Point fort 1',       'type'=>'text'],
                        ['key'=>'about_feat2',      'label'=>'Point fort 2',       'type'=>'text'],
                        ['key'=>'about_feat3',      'label'=>'Point fort 3',       'type'=>'text'],
                        ['key'=>'about_btn_text',   'label'=>'Bouton — Texte',     'type'=>'text'],
                        ['key'=>'about_btn_url',    'label'=>'Bouton — URL',       'type'=>'url'],
                    ],
                ],
                [
                    'label'  => "Appel à l'action (bas de page)",
                    'fields' => [
                        ['key'=>'cta_label',     'label'=>'Label',                     'type'=>'text'],
                        ['key'=>'cta_title',     'label'=>'Titre',                     'type'=>'text'],
                        ['key'=>'cta_desc',      'label'=>'Description',               'type'=>'text'],
                        ['key'=>'cta_btn1_text', 'label'=>'Bouton principal — Texte',  'type'=>'text'],
                        ['key'=>'cta_btn1_url',  'label'=>'Bouton principal — URL',    'type'=>'url'],
                        ['key'=>'cta_phone_text','label'=>'Téléphone — Affichage',     'type'=>'text'],
                        ['key'=>'cta_phone_url', 'label'=>'Téléphone — Lien (tel:…)',  'type'=>'url'],
                        ['key'=>'cta_badge1',    'label'=>'Badge 1',                   'type'=>'text'],
                        ['key'=>'cta_badge2',    'label'=>'Badge 2',                   'type'=>'text'],
                        ['key'=>'cta_badge3',    'label'=>'Badge 3',                   'type'=>'text'],
                    ],
                ],
            ],
        ],

        'about' => [
            'title' => 'Page À Propos',
            'icon'  => 'fa-circle-info',
            'route' => 'a-propos',
            'sections' => [
                [
                    'label'  => 'Bannière',
                    'fields' => [
                        ['key'=>'hero_title',    'label'=>'Titre',              'type'=>'text'],
                        ['key'=>'hero_subtitle', 'label'=>'Sous-titre',         'type'=>'text'],
                        ['key'=>'slide1',        'label'=>'Image carrousel 1',  'type'=>'image'],
                        ['key'=>'slide2',        'label'=>'Image carrousel 2',  'type'=>'image'],
                        ['key'=>'slide3',        'label'=>'Image carrousel 3',  'type'=>'image'],
                    ],
                ],
                [
                    'label'  => 'Mission & Vision',
                    'fields' => [
                        ['key'=>'mission_title',    'label'=>'Label Mission',           'type'=>'text'],
                        ['key'=>'mission_headline', 'label'=>'Titre principal Mission', 'type'=>'text'],
                        ['key'=>'mission_text',     'label'=>'Texte Mission',           'type'=>'html'],
                        ['key'=>'vision_title',     'label'=>'Titre Vision',            'type'=>'text'],
                        ['key'=>'vision_text',      'label'=>'Texte Vision',            'type'=>'html'],
                    ],
                ],
                [
                    'label'  => 'Image & Engagements',
                    'fields' => [
                        ['key'=>'main_img',   'label'=>'Image principale',        'type'=>'image'],
                        ['key'=>'eng_label',  'label'=>'Engagements — Libellé',   'type'=>'text'],
                        ['key'=>'eng_title',  'label'=>'Engagements — Titre',     'type'=>'text'],
                        ['key'=>'eng1_title', 'label'=>'Engagement 1 — Titre',    'type'=>'text'],
                        ['key'=>'eng1_text',  'label'=>'Engagement 1 — Texte',    'type'=>'text'],
                        ['key'=>'eng2_title', 'label'=>'Engagement 2 — Titre',    'type'=>'text'],
                        ['key'=>'eng2_text',  'label'=>'Engagement 2 — Texte',    'type'=>'text'],
                        ['key'=>'eng3_title', 'label'=>'Engagement 3 — Titre',    'type'=>'text'],
                        ['key'=>'eng3_text',  'label'=>'Engagement 3 — Texte',    'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Chiffres clés',
                    'fields' => [
                        ['key'=>'stat1_value','label'=>'Stat 1 — Valeur','type'=>'text'],
                        ['key'=>'stat1_label','label'=>'Stat 1 — Libellé','type'=>'text'],
                        ['key'=>'stat2_value','label'=>'Stat 2 — Valeur','type'=>'text'],
                        ['key'=>'stat2_label','label'=>'Stat 2 — Libellé','type'=>'text'],
                        ['key'=>'stat3_value','label'=>'Stat 3 — Valeur','type'=>'text'],
                        ['key'=>'stat3_label','label'=>'Stat 3 — Libellé','type'=>'text'],
                        ['key'=>'stat4_value','label'=>'Stat 4 — Valeur','type'=>'text'],
                        ['key'=>'stat4_label','label'=>'Stat 4 — Libellé','type'=>'text'],
                    ],
                ],
                [
                    'label'  => "Appel à l'action (bas de page)",
                    'fields' => [
                        ['key'=>'cta_title',      'label'=>'Titre',                    'type'=>'text'],
                        ['key'=>'cta_subtitle',   'label'=>'Sous-titre',               'type'=>'text'],
                        ['key'=>'cta_btn_text',   'label'=>'Bouton — Texte',           'type'=>'text'],
                        ['key'=>'cta_btn_url',    'label'=>'Bouton — URL',             'type'=>'url'],
                        ['key'=>'cta_phone_text', 'label'=>'Téléphone — Affichage',    'type'=>'text'],
                        ['key'=>'cta_phone_url',  'label'=>'Téléphone — Lien (tel:…)', 'type'=>'url'],
                    ],
                ],
            ],
        ],

        'contact' => [
            'title' => 'Page Contact',
            'icon'  => 'fa-envelope',
            'route' => 'contact',
            'sections' => [
                [
                    'label'  => 'Bannière',
                    'fields' => [
                        ['key'=>'hero_title',    'label'=>'Titre',         'type'=>'text'],
                        ['key'=>'hero_subtitle', 'label'=>'Sous-titre',    'type'=>'text'],
                        ['key'=>'slide1',        'label'=>'Image slide 1', 'type'=>'image'],
                        ['key'=>'slide2',        'label'=>'Image slide 2', 'type'=>'image'],
                        ['key'=>'slide3',        'label'=>'Image slide 3', 'type'=>'image'],
                    ],
                ],
                [
                    'label'  => 'Réception des emails du formulaire',
                    'fields' => [
                        ['key'=>'mail_to',  'label'=>'Destinataire — TO (adresse principale de réception)',                     'type'=>'text'],
                        ['key'=>'mail_cc',  'label'=>'Copie — CC (plusieurs adresses séparées par des virgules)',               'type'=>'text'],
                        ['key'=>'mail_bcc', 'label'=>'Copie cachée — BCC (plusieurs adresses séparées par des virgules)',       'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Configuration SMTP (envoi des emails)',
                    'fields' => [
                        ['key'=>'smtp_host',      'label'=>'Serveur SMTP',           'type'=>'text',   'hint'=>'Ex : smtp.gmail.com, mail.infomaniak.com'],
                        ['key'=>'smtp_port',      'label'=>'Port SMTP',              'type'=>'select', 'hint'=>'587 = TLS recommandé pour la plupart des hébergeurs',
                            'options'=>['587'=>'587 — TLS (recommandé)', '465'=>'465 — SSL', '2525'=>'2525 — TLS alternatif', '25'=>'25 — Sans chiffrement']],
                        ['key'=>'smtp_crypto',    'label'=>'Chiffrement',            'type'=>'select',
                            'options'=>['tls'=>'TLS (recommandé)', 'ssl'=>'SSL', ''=>'Aucun']],
                        ['key'=>'smtp_user',      'label'=>'Identifiant SMTP',       'type'=>'text',   'hint'=>'Adresse email expéditrice'],
                        ['key'=>'smtp_pass',      'label'=>'Mot de passe SMTP',      'type'=>'text',   'hint'=>"Mot de passe du compte ou mot de passe d'application Google/Microsoft"],
                        ['key'=>'mail_from_name', 'label'=>'Nom expéditeur',         'type'=>'text',   'hint'=>"Nom affiché dans les emails reçus (ex : RSC Cameroun)"],
                    ],
                ],
                [
                    'label'  => 'Formulaire de contact',
                    'fields' => [
                        ['key'=>'form_title',       'label'=>'Titre du formulaire',         'type'=>'text'],
                        ['key'=>'form_subtitle',    'label'=>'Sous-titre / accroche',        'type'=>'text'],
                        ['key'=>'form_btn_text',    'label'=>'Texte du bouton Envoyer',      'type'=>'text'],
                        ['key'=>'label_name',       'label'=>'Label — Nom complet',          'type'=>'text'],
                        ['key'=>'label_company',    'label'=>'Label — Entreprise',           'type'=>'text'],
                        ['key'=>'label_email',      'label'=>'Label — Adresse email',        'type'=>'text'],
                        ['key'=>'label_phone',      'label'=>'Label — Téléphone',            'type'=>'text'],
                        ['key'=>'label_whatsapp',   'label'=>'Label — WhatsApp (optionnel)', 'type'=>'text'],
                        ['key'=>'label_subject',    'label'=>'Label — Sujet',                'type'=>'text'],
                        ['key'=>'label_message',    'label'=>'Label — Votre message',        'type'=>'text'],
                        ['key'=>'form_subjects',    'label'=>'Sujets du dropdown (format: valeur|Libellé, un par ligne)', 'type'=>'html'],
                    ],
                ],
                [
                    'label'  => 'Coordonnées',
                    'fields' => [
                        ['key'=>'card_title',    'label'=>'Titre de la carte contact',         'type'=>'text'],
                        ['key'=>'address',       'label'=>'Adresse complète',                  'type'=>'text'],
                        ['key'=>'phone',         'label'=>'Téléphone principal',               'type'=>'text'],
                        ['key'=>'email',         'label'=>'Adresse email affichée',            'type'=>'text'],
                        ['key'=>'hours',         'label'=>'Horaires d\'ouverture',             'type'=>'text'],
                        ['key'=>'hours_extra',   'label'=>'Ligne horaires secondaire',         'type'=>'text'],
                        ['key'=>'whatsapp',      'label'=>'Numéro WhatsApp (chiffres, ex: 237691123112)', 'type'=>'text'],
                        ['key'=>'whatsapp_text', 'label'=>'Texte du lien WhatsApp',           'type'=>'text'],
                        ['key'=>'social_title',  'label'=>'Texte réseaux sociaux',            'type'=>'text'],
                        ['key'=>'facebook_url',  'label'=>'Lien Facebook',                    'type'=>'url'],
                    ],
                ],
                [
                    'label'  => 'Carte & Localisation',
                    'fields' => [
                        ['key'=>'maps_address',  'label'=>'Adresse affichée sous la carte',   'type'=>'text'],
                        ['key'=>'maps_url',      'label'=>'Lien Google Maps (href)',           'type'=>'url'],
                        ['key'=>'maps_btn_text', 'label'=>'Texte du bouton Google Maps',      'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'FAQ — Questions fréquentes',
                    'fields' => [
                        ['key'=>'faq_label', 'label'=>'Label section FAQ',   'type'=>'text'],
                        ['key'=>'faq_title', 'label'=>'Titre section FAQ',   'type'=>'text'],
                        ['key'=>'faq1_q',    'label'=>'FAQ 1 — Question',    'type'=>'text'],
                        ['key'=>'faq1_a',    'label'=>'FAQ 1 — Réponse',     'type'=>'text'],
                        ['key'=>'faq2_q',    'label'=>'FAQ 2 — Question',    'type'=>'text'],
                        ['key'=>'faq2_a',    'label'=>'FAQ 2 — Réponse',     'type'=>'text'],
                        ['key'=>'faq3_q',    'label'=>'FAQ 3 — Question',    'type'=>'text'],
                        ['key'=>'faq3_a',    'label'=>'FAQ 3 — Réponse',     'type'=>'text'],
                        ['key'=>'faq4_q',    'label'=>'FAQ 4 — Question',    'type'=>'text'],
                        ['key'=>'faq4_a',    'label'=>'FAQ 4 — Réponse',     'type'=>'text'],
                    ],
                ],
            ],
        ],

        'services' => [
            'title' => 'Page Services',
            'icon'  => 'fa-screwdriver-wrench',
            'route' => 'services',
            'sections' => [
                [
                    'label'  => 'Bannière',
                    'fields' => [
                        ['key'=>'hero_title',    'label'=>'Titre',             'type'=>'text'],
                        ['key'=>'hero_subtitle', 'label'=>'Sous-titre',        'type'=>'text'],
                        ['key'=>'slide1',        'label'=>'Image carrousel 1', 'type'=>'image'],
                        ['key'=>'slide2',        'label'=>'Image carrousel 2', 'type'=>'image'],
                        ['key'=>'slide3',        'label'=>'Image carrousel 3', 'type'=>'image'],
                    ],
                ],
                [
                    'label'  => 'Service 1 — Vente & Conseil',
                    'fields' => [
                        ['key'=>'srv1_title',   'label'=>'Titre',          'type'=>'text'],
                        ['key'=>'srv1_desc',    'label'=>'Description',    'type'=>'text'],
                        ['key'=>'srv1_img',     'label'=>'Image',          'type'=>'image'],
                        ['key'=>'srv1_li1',     'label'=>'Point 1',        'type'=>'text'],
                        ['key'=>'srv1_li2',     'label'=>'Point 2',        'type'=>'text'],
                        ['key'=>'srv1_li3',     'label'=>'Point 3',        'type'=>'text'],
                        ['key'=>'srv1_li4',     'label'=>'Point 4',        'type'=>'text'],
                        ['key'=>'srv1_btn_text','label'=>'Bouton — Texte', 'type'=>'text'],
                        ['key'=>'srv1_btn_url', 'label'=>'Bouton — URL',   'type'=>'url'],
                        ['key'=>'srv1_badge',   'label'=>'Badge image',    'type'=>'text'],
                        ['key'=>'srv1_caption', 'label'=>'Légende image',  'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Service 2 — Installation & Mise en service',
                    'fields' => [
                        ['key'=>'srv2_title',   'label'=>'Titre',          'type'=>'text'],
                        ['key'=>'srv2_desc',    'label'=>'Description',    'type'=>'text'],
                        ['key'=>'srv2_img',     'label'=>'Image',          'type'=>'image'],
                        ['key'=>'srv2_li1',     'label'=>'Point 1',        'type'=>'text'],
                        ['key'=>'srv2_li2',     'label'=>'Point 2',        'type'=>'text'],
                        ['key'=>'srv2_li3',     'label'=>'Point 3',        'type'=>'text'],
                        ['key'=>'srv2_li4',     'label'=>'Point 4',        'type'=>'text'],
                        ['key'=>'srv2_btn_text','label'=>'Bouton — Texte', 'type'=>'text'],
                        ['key'=>'srv2_btn_url', 'label'=>'Bouton — URL',   'type'=>'url'],
                        ['key'=>'srv2_badge',   'label'=>'Badge image',    'type'=>'text'],
                        ['key'=>'srv2_caption', 'label'=>'Légende image',  'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Service 3 — Maintenance & Réparation',
                    'fields' => [
                        ['key'=>'srv3_title',      'label'=>'Titre',             'type'=>'text'],
                        ['key'=>'srv3_desc',       'label'=>'Description',       'type'=>'text'],
                        ['key'=>'srv3_img',        'label'=>'Image',             'type'=>'image'],
                        ['key'=>'srv3_card1_title','label'=>'Carte Préventive — Titre', 'type'=>'text'],
                        ['key'=>'srv3_card1_text', 'label'=>'Carte Préventive — Texte', 'type'=>'text'],
                        ['key'=>'srv3_card2_title','label'=>'Carte Corrective — Titre', 'type'=>'text'],
                        ['key'=>'srv3_card2_text', 'label'=>'Carte Corrective — Texte', 'type'=>'text'],
                        ['key'=>'srv3_btn_text',   'label'=>'Bouton — Texte',   'type'=>'text'],
                        ['key'=>'srv3_btn_url',    'label'=>'Bouton — URL',     'type'=>'url'],
                        ['key'=>'srv3_badge',      'label'=>'Badge image',      'type'=>'text'],
                        ['key'=>'srv3_caption',    'label'=>'Légende image',    'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Service 4 — Pièces & Lubrifiants',
                    'fields' => [
                        ['key'=>'srv4_title',   'label'=>'Titre',          'type'=>'text'],
                        ['key'=>'srv4_desc',    'label'=>'Description',    'type'=>'text'],
                        ['key'=>'srv4_img',     'label'=>'Image',          'type'=>'image'],
                        ['key'=>'srv4_li1',     'label'=>'Point 1',        'type'=>'text'],
                        ['key'=>'srv4_li2',     'label'=>'Point 2',        'type'=>'text'],
                        ['key'=>'srv4_li3',     'label'=>'Point 3',        'type'=>'text'],
                        ['key'=>'srv4_li4',     'label'=>'Point 4',        'type'=>'text'],
                        ['key'=>'srv4_btn_text','label'=>'Bouton — Texte', 'type'=>'text'],
                        ['key'=>'srv4_btn_url', 'label'=>'Bouton — URL',   'type'=>'url'],
                        ['key'=>'srv4_badge',   'label'=>'Badge image',    'type'=>'text'],
                        ['key'=>'srv4_caption', 'label'=>'Légende image',  'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Contrats de Maintenance',
                    'fields' => [
                        ['key'=>'contracts_badge',      'label'=>'Badge',             'type'=>'text'],
                        ['key'=>'contracts_title',      'label'=>'Titre',             'type'=>'text'],
                        ['key'=>'contracts_subtitle',   'label'=>'Sous-titre',        'type'=>'text'],
                        ['key'=>'contracts_box_title',  'label'=>'Titre liste inclus','type'=>'text'],
                        ['key'=>'contracts_li1',        'label'=>'Inclus 1',          'type'=>'text'],
                        ['key'=>'contracts_li2',        'label'=>'Inclus 2',          'type'=>'text'],
                        ['key'=>'contracts_li3',        'label'=>'Inclus 3',          'type'=>'text'],
                        ['key'=>'contracts_li4',        'label'=>'Inclus 4',          'type'=>'text'],
                        ['key'=>'contracts_li5',        'label'=>'Inclus 5',          'type'=>'text'],
                        ['key'=>'contracts_li6',        'label'=>'Inclus 6',          'type'=>'text'],
                        ['key'=>'contracts_adv_title',  'label'=>'Titre avantages',   'type'=>'text'],
                        ['key'=>'contracts_adv1',       'label'=>'Avantage 1',        'type'=>'text'],
                        ['key'=>'contracts_adv2',       'label'=>'Avantage 2',        'type'=>'text'],
                        ['key'=>'contracts_adv3',       'label'=>'Avantage 3',        'type'=>'text'],
                        ['key'=>'contracts_adv4',       'label'=>'Avantage 4',        'type'=>'text'],
                        ['key'=>'contracts_adv5',       'label'=>'Avantage 5',        'type'=>'text'],
                        ['key'=>'contracts_btn_text',   'label'=>'Bouton — Texte',    'type'=>'text'],
                        ['key'=>'contracts_btn_url',    'label'=>'Bouton — URL',      'type'=>'url'],
                    ],
                ],
                [
                    'label'  => 'Audit Air Comprimé',
                    'fields' => [
                        ['key'=>'audit_label',    'label'=>'Label',        'type'=>'text'],
                        ['key'=>'audit_title',    'label'=>'Titre',        'type'=>'text'],
                        ['key'=>'audit_text',     'label'=>'Texte',        'type'=>'text'],
                        ['key'=>'audit_btn_text', 'label'=>'Bouton — Texte','type'=>'text'],
                        ['key'=>'audit_btn_url',  'label'=>'Bouton — URL', 'type'=>'url'],
                    ],
                ],
                [
                    'label'  => "Appel à l'action (bas de page)",
                    'fields' => [
                        ['key'=>'cta_title',      'label'=>'Titre',              'type'=>'text'],
                        ['key'=>'cta_text',       'label'=>'Texte',              'type'=>'text'],
                        ['key'=>'cta_btn1_text',  'label'=>'Bouton 1 — Texte',  'type'=>'text'],
                        ['key'=>'cta_btn1_url',   'label'=>'Bouton 1 — URL',    'type'=>'url'],
                        ['key'=>'cta_phone_text', 'label'=>'Téléphone — Texte', 'type'=>'text'],
                        ['key'=>'cta_phone_url',  'label'=>'Téléphone — URL',   'type'=>'url'],
                    ],
                ],
            ],
        ],

        'expertise' => [
            'title' => 'Page Expertise',
            'icon'  => 'fa-award',
            'route' => 'expertise',
            'sections' => [
                [
                    'label'  => 'Bannière',
                    'fields' => [
                        ['key'=>'hero_title',    'label'=>'Titre',             'type'=>'text'],
                        ['key'=>'hero_subtitle', 'label'=>'Sous-titre',        'type'=>'text'],
                        ['key'=>'slide1',        'label'=>'Image carrousel 1', 'type'=>'image'],
                        ['key'=>'slide2',        'label'=>'Image carrousel 2', 'type'=>'image'],
                        ['key'=>'slide3',        'label'=>'Image carrousel 3', 'type'=>'image'],
                    ],
                ],
                [
                    'label'  => 'En-tête section articles',
                    'fields' => [
                        ['key'=>'exp_label',    'label'=>'Label',      'type'=>'text'],
                        ['key'=>'exp_title',    'label'=>'Titre',      'type'=>'text'],
                        ['key'=>'exp_subtitle', 'label'=>'Sous-titre', 'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Article 1',
                    'fields' => [
                        ['key'=>'art1_img',      'label'=>'Image',          'type'=>'image'],
                        ['key'=>'art1_label',    'label'=>'Catégorie',      'type'=>'text'],
                        ['key'=>'art1_title',    'label'=>'Titre',          'type'=>'text'],
                        ['key'=>'art1_desc',     'label'=>'Description',    'type'=>'text'],
                        ['key'=>'art1_btn_text', 'label'=>'Bouton — Texte', 'type'=>'text'],
                        ['key'=>'art1_btn_url',  'label'=>'Bouton — URL',   'type'=>'url'],
                    ],
                ],
                [
                    'label'  => 'Article 2',
                    'fields' => [
                        ['key'=>'art2_img',      'label'=>'Image',          'type'=>'image'],
                        ['key'=>'art2_label',    'label'=>'Catégorie',      'type'=>'text'],
                        ['key'=>'art2_title',    'label'=>'Titre',          'type'=>'text'],
                        ['key'=>'art2_desc',     'label'=>'Description',    'type'=>'text'],
                        ['key'=>'art2_btn_text', 'label'=>'Bouton — Texte', 'type'=>'text'],
                        ['key'=>'art2_btn_url',  'label'=>'Bouton — URL',   'type'=>'url'],
                    ],
                ],
                [
                    'label'  => 'Article 3',
                    'fields' => [
                        ['key'=>'art3_img',      'label'=>'Image',          'type'=>'image'],
                        ['key'=>'art3_label',    'label'=>'Catégorie',      'type'=>'text'],
                        ['key'=>'art3_title',    'label'=>'Titre',          'type'=>'text'],
                        ['key'=>'art3_desc',     'label'=>'Description',    'type'=>'text'],
                        ['key'=>'art3_btn_text', 'label'=>'Bouton — Texte', 'type'=>'text'],
                        ['key'=>'art3_btn_url',  'label'=>'Bouton — URL',   'type'=>'url'],
                    ],
                ],
                [
                    'label'  => 'Article 4',
                    'fields' => [
                        ['key'=>'art4_img',      'label'=>'Image',          'type'=>'image'],
                        ['key'=>'art4_label',    'label'=>'Catégorie',      'type'=>'text'],
                        ['key'=>'art4_title',    'label'=>'Titre',          'type'=>'text'],
                        ['key'=>'art4_desc',     'label'=>'Description',    'type'=>'text'],
                        ['key'=>'art4_btn_text', 'label'=>'Bouton — Texte', 'type'=>'text'],
                        ['key'=>'art4_btn_url',  'label'=>'Bouton — URL',   'type'=>'url'],
                    ],
                ],
                [
                    'label'  => 'Article 5',
                    'fields' => [
                        ['key'=>'art5_img',      'label'=>'Image',          'type'=>'image'],
                        ['key'=>'art5_label',    'label'=>'Catégorie',      'type'=>'text'],
                        ['key'=>'art5_title',    'label'=>'Titre',          'type'=>'text'],
                        ['key'=>'art5_desc',     'label'=>'Description',    'type'=>'text'],
                        ['key'=>'art5_btn_text', 'label'=>'Bouton — Texte', 'type'=>'text'],
                        ['key'=>'art5_btn_url',  'label'=>'Bouton — URL',   'type'=>'url'],
                    ],
                ],
                [
                    'label'  => 'Article 6',
                    'fields' => [
                        ['key'=>'art6_img',      'label'=>'Image',          'type'=>'image'],
                        ['key'=>'art6_label',    'label'=>'Catégorie',      'type'=>'text'],
                        ['key'=>'art6_title',    'label'=>'Titre',          'type'=>'text'],
                        ['key'=>'art6_desc',     'label'=>'Description',    'type'=>'text'],
                        ['key'=>'art6_btn_text', 'label'=>'Bouton — Texte', 'type'=>'text'],
                        ['key'=>'art6_btn_url',  'label'=>'Bouton — URL',   'type'=>'url'],
                    ],
                ],
                [
                    'label'  => 'Section Contact Expert',
                    'fields' => [
                        ['key'=>'expert_label',    'label'=>'Label',            'type'=>'text'],
                        ['key'=>'expert_title',    'label'=>'Titre',            'type'=>'text'],
                        ['key'=>'expert_text',     'label'=>'Texte',            'type'=>'text'],
                        ['key'=>'expert_wa_text',  'label'=>'WhatsApp — Texte', 'type'=>'text'],
                        ['key'=>'expert_wa_url',   'label'=>'WhatsApp — URL',   'type'=>'url'],
                        ['key'=>'expert_msg_text', 'label'=>'Message — Texte',  'type'=>'text'],
                        ['key'=>'expert_msg_url',  'label'=>'Message — URL',    'type'=>'url'],
                    ],
                ],
                [
                    'label'  => "Appel à l'action (bas de page)",
                    'fields' => [
                        ['key'=>'cta_title',      'label'=>'Titre',              'type'=>'text'],
                        ['key'=>'cta_text',       'label'=>'Texte',              'type'=>'text'],
                        ['key'=>'cta_btn1_text',  'label'=>'Bouton 1 — Texte',  'type'=>'text'],
                        ['key'=>'cta_btn1_url',   'label'=>'Bouton 1 — URL',    'type'=>'url'],
                        ['key'=>'cta_phone_text', 'label'=>'Téléphone — Texte', 'type'=>'text'],
                        ['key'=>'cta_phone_url',  'label'=>'Téléphone — URL',   'type'=>'url'],
                    ],
                ],
            ],
        ],

        'gallery' => [
            'title' => 'Page Galerie',
            'icon'  => 'fa-images',
            'route' => 'galerie',
            'sections' => [
                [
                    'label'  => 'Bannière',
                    'fields' => [
                        ['key'=>'hero_title',    'label'=>'Titre',             'type'=>'text'],
                        ['key'=>'hero_subtitle', 'label'=>'Sous-titre',        'type'=>'text'],
                    ],
                ],
                [
                    'label'  => "Appel à l'action (bas de page)",
                    'fields' => [
                        ['key'=>'cta_title',     'label'=>'Titre',                          'type'=>'text'],
                        ['key'=>'cta_text',      'label'=>'Texte',                          'type'=>'text'],
                        ['key'=>'cta_btn1_text', 'label'=>'Bouton 1 — Texte',              'type'=>'text'],
                        ['key'=>'cta_btn1_url',  'label'=>'Bouton 1 — URL (ex: contact)',  'type'=>'url'],
                        ['key'=>'cta_btn2_text', 'label'=>'Bouton 2 — Texte (téléphone)', 'type'=>'text'],
                        ['key'=>'cta_btn2_url',  'label'=>'Bouton 2 — URL (ex: tel:+237…)','type'=>'url'],
                    ],
                ],
            ],
        ],

        'products' => [
            'title' => 'Page Produits',
            'icon'  => 'fa-box',
            'route' => 'produits',
            'sections' => [
                [
                    'label'  => 'Bannière',
                    'fields' => [
                        ['key'=>'hero_title',    'label'=>'Titre',             'type'=>'text'],
                        ['key'=>'hero_subtitle', 'label'=>'Sous-titre',        'type'=>'text'],
                        ['key'=>'slide1',        'label'=>'Image carrousel 1', 'type'=>'image'],
                        ['key'=>'slide2',        'label'=>'Image carrousel 2', 'type'=>'image'],
                        ['key'=>'slide3',        'label'=>'Image carrousel 3', 'type'=>'image'],
                    ],
                ],
                [
                    'label'  => 'Catalogue — Textes des filtres',
                    'fields' => [
                        ['key'=>'search_placeholder', 'label'=>'Placeholder de recherche', 'type'=>'text'],
                        ['key'=>'filter_all_text',    'label'=>'Bouton "Tous les fournisseurs"', 'type'=>'text'],
                        ['key'=>'filter_all_cat',     'label'=>'Bouton catégorie "Tous"', 'type'=>'text'],
                        ['key'=>'product_cta_text',   'label'=>'Texte du bouton sur chaque produit', 'type'=>'text'],
                    ],
                ],
                [
                    'label'  => "Appel à l'action (bas de page)",
                    'fields' => [
                        ['key'=>'cta_title',      'label'=>'Titre',              'type'=>'text'],
                        ['key'=>'cta_subtitle',   'label'=>'Texte',              'type'=>'html'],
                        ['key'=>'cta_btn_url',    'label'=>'Bouton — URL',       'type'=>'url'],
                        ['key'=>'cta_btn_text',   'label'=>'Bouton — Texte',     'type'=>'text'],
                        ['key'=>'cta_phone_url',  'label'=>'Téléphone — URL',    'type'=>'url'],
                        ['key'=>'cta_phone_text', 'label'=>'Téléphone — Texte',  'type'=>'text'],
                    ],
                ],
            ],
        ],

        'legal' => [
            'title' => 'Mentions Légales',
            'icon'  => 'fa-file-contract',
            'route' => 'mentions-legales',
            'sections' => [
                [
                    'label'  => "Informations sur l'éditeur",
                    'fields' => [
                        ['key'=>'company_name',     'label'=>'Raison sociale',    'type'=>'text'],
                        ['key'=>'company_activity', 'label'=>'Activité',          'type'=>'text'],
                        ['key'=>'company_address',  'label'=>'Siège social',      'type'=>'text'],
                        ['key'=>'company_email',    'label'=>'Email',             'type'=>'text'],
                        ['key'=>'company_phone',    'label'=>'Téléphone',         'type'=>'text'],
                        ['key'=>'company_partner',  'label'=>'Partenaire',        'type'=>'text'],
                        ['key'=>'hosting_text',     'label'=>'Hébergement',       'type'=>'html'],
                        ['key'=>'ip_text',          'label'=>'Propriété intellectuelle', 'type'=>'html'],
                    ],
                ],
                [
                    'label'  => 'Politique de confidentialité',
                    'fields' => [
                        ['key'=>'privacy_text', 'label'=>'Texte complet de la politique', 'type'=>'html'],
                    ],
                ],
            ],
        ],

        'partners_renner' => [
            'title' => 'Partenaire RENNER',
            'icon'  => 'fa-industry',
            'route' => 'partenaires/renner',
            'sections' => [
                [
                    'label'  => 'Bannière hero',
                    'fields' => [
                        ['key'=>'hero_title',    'label'=>'Titre',             'type'=>'text'],
                        ['key'=>'hero_subtitle', 'label'=>'Sous-titre coloré', 'type'=>'text'],
                        ['key'=>'about_text',    'label'=>'Texte intro (hero)','type'=>'html'],
                        ['key'=>'slide1',        'label'=>'Image carrousel 1', 'type'=>'image'],
                        ['key'=>'slide2',        'label'=>'Image carrousel 2', 'type'=>'image'],
                        ['key'=>'slide3',        'label'=>'Image carrousel 3', 'type'=>'image'],
                    ],
                ],
                [
                    'label'  => 'Chiffres clés (4 stats dans le hero)',
                    'fields' => [
                        ['key'=>'stat1_value','label'=>'Stat 1 — Valeur (ex: 1994)','type'=>'text'],
                        ['key'=>'stat1_label','label'=>'Stat 1 — Libellé (ex: Fondée en)','type'=>'text'],
                        ['key'=>'stat2_value','label'=>'Stat 2 — Valeur (ex: 6 000+)','type'=>'text'],
                        ['key'=>'stat2_label','label'=>'Stat 2 — Libellé (ex: Modèles)','type'=>'text'],
                        ['key'=>'stat3_value','label'=>'Stat 3 — Valeur (ex: 200+)','type'=>'text'],
                        ['key'=>'stat3_label','label'=>'Stat 3 — Libellé (ex: Employés)','type'=>'text'],
                        ['key'=>'stat4_value','label'=>'Stat 4 — Valeur (ex: ISO)','type'=>'text'],
                        ['key'=>'stat4_label','label'=>'Stat 4 — Libellé (ex: 9001 certifié)','type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Section À propos (bloc détail)',
                    'fields' => [
                        ['key'=>'about_section_title',  'label'=>'Titre de section',                'type'=>'text'],
                        ['key'=>'about_section_h2',     'label'=>'Sous-titre H2',                   'type'=>'text'],
                        ['key'=>'about_desc1',          'label'=>'Paragraphe 1',                    'type'=>'html'],
                        ['key'=>'about_desc2',          'label'=>'Paragraphe 2',                    'type'=>'html'],
                        ['key'=>'about_image',          'label'=>'Image principale',                'type'=>'image'],
                        ['key'=>'about_detail1_label',  'label'=>'Détail 1 — Label (ex: Siège social)', 'type'=>'text'],
                        ['key'=>'about_detail1_value',  'label'=>'Détail 1 — Valeur',               'type'=>'text'],
                        ['key'=>'about_detail2_label',  'label'=>'Détail 2 — Label (ex: Certification)', 'type'=>'text'],
                        ['key'=>'about_detail2_value',  'label'=>'Détail 2 — Valeur',               'type'=>'text'],
                        ['key'=>'about_detail3_label',  'label'=>'Détail 3 — Label (ex: Plage puissance)', 'type'=>'text'],
                        ['key'=>'about_detail3_value',  'label'=>'Détail 3 — Valeur',               'type'=>'text'],
                        ['key'=>'about_detail4_label',  'label'=>'Détail 4 — Label (ex: Pressions)', 'type'=>'text'],
                        ['key'=>'about_detail4_value',  'label'=>'Détail 4 — Valeur',               'type'=>'text'],
                        ['key'=>'about_website_url',    'label'=>'URL site officiel (href)',         'type'=>'url'],
                        ['key'=>'about_website_text',   'label'=>'Texte bouton site officiel',       'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Titres des catégories produits',
                    'fields' => [
                        ['key'=>'catalog_label',      'label'=>'Label section catalogue',  'type'=>'text'],
                        ['key'=>'catalog_title',      'label'=>'Titre section catalogue',  'type'=>'text'],
                        ['key'=>'catalog_subtitle',   'label'=>'Sous-titre catalogue',     'type'=>'text'],
                        ['key'=>'cat_vis_title',      'label'=>'Catégorie Vis — Titre',    'type'=>'text'],
                        ['key'=>'cat_vis_desc',       'label'=>'Catégorie Vis — Desc.',    'type'=>'text'],
                        ['key'=>'cat_oilfree_title',  'label'=>'Sans huile — Titre',       'type'=>'text'],
                        ['key'=>'cat_oilfree_desc',   'label'=>'Sans huile — Desc.',       'type'=>'text'],
                        ['key'=>'cat_piston_title',   'label'=>'Piston — Titre',           'type'=>'text'],
                        ['key'=>'cat_piston_desc',    'label'=>'Piston — Desc.',           'type'=>'text'],
                        ['key'=>'cat_air_title',      'label'=>'Traitement air — Titre',   'type'=>'text'],
                        ['key'=>'cat_air_desc',       'label'=>'Traitement air — Desc.',   'type'=>'text'],
                        ['key'=>'cat_res_title',      'label'=>'Réservoirs — Titre',       'type'=>'text'],
                        ['key'=>'cat_res_desc',       'label'=>'Réservoirs — Desc.',       'type'=>'text'],
                        ['key'=>'cat_ctrl_title',     'label'=>'Contrôle — Titre',         'type'=>'text'],
                        ['key'=>'cat_ctrl_desc',      'label'=>'Contrôle — Desc.',         'type'=>'text'],
                    ],
                ],
                [
                    'label'  => '4 Arguments de vente',
                    'fields' => [
                        ['key'=>'args_label',  'label'=>'Label section arguments',  'type'=>'text'],
                        ['key'=>'args_title',  'label'=>'Titre section arguments',  'type'=>'text'],
                        ['key'=>'arg1_title', 'label'=>'Argument 1 — Titre', 'type'=>'text'],
                        ['key'=>'arg1_text',  'label'=>'Argument 1 — Texte', 'type'=>'text'],
                        ['key'=>'arg2_title', 'label'=>'Argument 2 — Titre', 'type'=>'text'],
                        ['key'=>'arg2_text',  'label'=>'Argument 2 — Texte', 'type'=>'text'],
                        ['key'=>'arg3_title', 'label'=>'Argument 3 — Titre', 'type'=>'text'],
                        ['key'=>'arg3_text',  'label'=>'Argument 3 — Texte', 'type'=>'text'],
                        ['key'=>'arg4_title', 'label'=>'Argument 4 — Titre', 'type'=>'text'],
                        ['key'=>'arg4_text',  'label'=>'Argument 4 — Texte', 'type'=>'text'],
                    ],
                ],
                [
                    'label'  => "Appel à l'action final",
                    'fields' => [
                        ['key'=>'cta_title',      'label'=>'Titre CTA',             'type'=>'text'],
                        ['key'=>'cta_subtitle',   'label'=>'Texte CTA',             'type'=>'text'],
                        ['key'=>'cta_btn1_text',  'label'=>'Bouton 1 Texte',        'type'=>'text'],
                        ['key'=>'cta_btn1_url',   'label'=>'Bouton 1 URL',          'type'=>'url'],
                        ['key'=>'cta_btn2_text',  'label'=>'Bouton 2 Texte',        'type'=>'text'],
                        ['key'=>'cta_btn2_url',   'label'=>'Bouton 2 URL (tel:…)',  'type'=>'url'],
                    ],
                ],
            ],
        ],

        'partners_ir' => [
            'title' => 'Partenaire Ingersoll Rand',
            'icon'  => 'fa-industry',
            'route' => 'partenaires/ingersoll-rand',
            'sections' => [
                [
                    'label'  => 'Bannière hero',
                    'fields' => [
                        ['key'=>'hero_title',    'label'=>'Titre',               'type'=>'text'],
                        ['key'=>'hero_subtitle', 'label'=>'Sous-titre',          'type'=>'text'],
                        ['key'=>'about_text',    'label'=>'Texte intro (hero)', 'type'=>'html'],
                        ['key'=>'slide1',        'label'=>'Image carrousel 1',  'type'=>'image'],
                        ['key'=>'slide2',        'label'=>'Image carrousel 2',  'type'=>'image'],
                        ['key'=>'slide3',        'label'=>'Image carrousel 3',  'type'=>'image'],
                    ],
                ],
                [
                    'label'  => 'Chiffres clés (4 stats)',
                    'fields' => [
                        ['key'=>'stat1_value','label'=>'Stat 1 — Valeur','type'=>'text'],
                        ['key'=>'stat1_label','label'=>'Stat 1 — Libellé','type'=>'text'],
                        ['key'=>'stat2_value','label'=>'Stat 2 — Valeur','type'=>'text'],
                        ['key'=>'stat2_label','label'=>'Stat 2 — Libellé','type'=>'text'],
                        ['key'=>'stat3_value','label'=>'Stat 3 — Valeur','type'=>'text'],
                        ['key'=>'stat3_label','label'=>'Stat 3 — Libellé','type'=>'text'],
                        ['key'=>'stat4_value','label'=>'Stat 4 — Valeur','type'=>'text'],
                        ['key'=>'stat4_label','label'=>'Stat 4 — Libellé','type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Section À propos',
                    'fields' => [
                        ['key'=>'about_section_title',  'label'=>'Label de section',     'type'=>'text'],
                        ['key'=>'about_section_h2',     'label'=>'Titre H2',             'type'=>'text'],
                        ['key'=>'about_desc1',          'label'=>'Paragraphe 1',         'type'=>'html'],
                        ['key'=>'about_desc2',          'label'=>'Paragraphe 2',         'type'=>'html'],
                        ['key'=>'about_image',          'label'=>'Image principale',     'type'=>'image'],
                        ['key'=>'about_detail1_label',  'label'=>'Détail 1 — Label',    'type'=>'text'],
                        ['key'=>'about_detail1_value',  'label'=>'Détail 1 — Valeur',   'type'=>'text'],
                        ['key'=>'about_detail2_label',  'label'=>'Détail 2 — Label',    'type'=>'text'],
                        ['key'=>'about_detail2_value',  'label'=>'Détail 2 — Valeur',   'type'=>'text'],
                        ['key'=>'about_detail3_label',  'label'=>'Détail 3 — Label',    'type'=>'text'],
                        ['key'=>'about_detail3_value',  'label'=>'Détail 3 — Valeur',   'type'=>'text'],
                        ['key'=>'about_detail4_label',  'label'=>'Détail 4 — Label',    'type'=>'text'],
                        ['key'=>'about_detail4_value',  'label'=>'Détail 4 — Valeur',   'type'=>'text'],
                        ['key'=>'about_website_url',    'label'=>'URL site officiel',    'type'=>'url'],
                        ['key'=>'about_website_text',   'label'=>'Texte bouton site',    'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Gamme de produits (titres)',
                    'fields' => [
                        ['key'=>'catalog_label',     'label'=>'Label catalogue',              'type'=>'text'],
                        ['key'=>'catalog_title',     'label'=>'Titre catalogue H2',           'type'=>'text'],
                        ['key'=>'catalog_subtitle',  'label'=>'Sous-titre catalogue',         'type'=>'text'],
                        ['key'=>'cat_rseries_title', 'label'=>'R-Series — Titre',             'type'=>'text'],
                        ['key'=>'cat_rseries_desc',  'label'=>'R-Series — Description',       'type'=>'text'],
                        ['key'=>'cat_oilfree_title', 'label'=>'Sans huile — Titre',           'type'=>'text'],
                        ['key'=>'cat_oilfree_desc',  'label'=>'Sans huile — Description',     'type'=>'text'],
                        ['key'=>'cat_piston_title',  'label'=>'Piston — Titre',               'type'=>'text'],
                        ['key'=>'cat_piston_desc',   'label'=>'Piston — Description',         'type'=>'text'],
                        ['key'=>'cat_centri_title',  'label'=>'Centrifuges — Titre',          'type'=>'text'],
                        ['key'=>'cat_centri_desc',   'label'=>'Centrifuges — Description',    'type'=>'text'],
                        ['key'=>'cat_air_title',     'label'=>'Traitement air — Titre',       'type'=>'text'],
                        ['key'=>'cat_air_desc',      'label'=>'Traitement air — Description', 'type'=>'text'],
                    ],
                ],
                [
                    'label'  => '4 Arguments de vente',
                    'fields' => [
                        ['key'=>'args_label',  'label'=>'Label section',  'type'=>'text'],
                        ['key'=>'args_title',  'label'=>'Titre section',  'type'=>'text'],
                        ['key'=>'arg1_title', 'label'=>'Argument 1 — Titre','type'=>'text'],
                        ['key'=>'arg1_text',  'label'=>'Argument 1 — Texte','type'=>'text'],
                        ['key'=>'arg2_title', 'label'=>'Argument 2 — Titre','type'=>'text'],
                        ['key'=>'arg2_text',  'label'=>'Argument 2 — Texte','type'=>'text'],
                        ['key'=>'arg3_title', 'label'=>'Argument 3 — Titre','type'=>'text'],
                        ['key'=>'arg3_text',  'label'=>'Argument 3 — Texte','type'=>'text'],
                        ['key'=>'arg4_title', 'label'=>'Argument 4 — Titre','type'=>'text'],
                        ['key'=>'arg4_text',  'label'=>'Argument 4 — Texte','type'=>'text'],
                    ],
                ],
                [
                    'label'  => "Appel à l'action final",
                    'fields' => [
                        ['key'=>'cta_title',     'label'=>'Titre CTA',      'type'=>'text'],
                        ['key'=>'cta_subtitle',  'label'=>'Texte CTA',      'type'=>'text'],
                        ['key'=>'cta_btn1_text', 'label'=>'Bouton 1 Texte', 'type'=>'text'],
                        ['key'=>'cta_btn1_url',  'label'=>'Bouton 1 URL',   'type'=>'url'],
                        ['key'=>'cta_btn2_text', 'label'=>'Bouton 2 Texte', 'type'=>'text'],
                        ['key'=>'cta_btn2_url',  'label'=>'Bouton 2 URL',   'type'=>'url'],
                    ],
                ],
            ],
        ],

        'partners_cas' => [
            'title' => 'Partenaire CAS Lubricants',
            'icon'  => 'fa-oil-can',
            'route' => 'partenaires/cas-lubrifiants',
            'sections' => [
                [
                    'label'  => 'Bannière hero',
                    'fields' => [
                        ['key'=>'hero_title', 'label'=>'Titre principal',        'type'=>'text'],
                        ['key'=>'hero_badge', 'label'=>'Badge (texte court)',    'type'=>'text'],
                        ['key'=>'about_text', 'label'=>'Texte de présentation', 'type'=>'html'],
                        ['key'=>'hero_img',   'label'=>'Image produit (hero)',   'type'=>'image'],
                        ['key'=>'slide1',     'label'=>'Image carrousel 1',      'type'=>'image'],
                        ['key'=>'slide2',     'label'=>'Image carrousel 2',      'type'=>'image'],
                        ['key'=>'slide3',     'label'=>'Image carrousel 3',      'type'=>'image'],
                    ],
                ],
                [
                    'label'  => 'Barre de statistiques (5 chiffres)',
                    'fields' => [
                        ['key'=>'stat1_value', 'label'=>'Stat 1 — Valeur',   'type'=>'text'],
                        ['key'=>'stat1_label', 'label'=>'Stat 1 — Libellé',  'type'=>'text'],
                        ['key'=>'stat2_value', 'label'=>'Stat 2 — Valeur',   'type'=>'text'],
                        ['key'=>'stat2_label', 'label'=>'Stat 2 — Libellé',  'type'=>'text'],
                        ['key'=>'stat3_value', 'label'=>'Stat 3 — Valeur',   'type'=>'text'],
                        ['key'=>'stat3_label', 'label'=>'Stat 3 — Libellé',  'type'=>'text'],
                        ['key'=>'stat4_value', 'label'=>'Stat 4 — Valeur',   'type'=>'text'],
                        ['key'=>'stat4_label', 'label'=>'Stat 4 — Libellé',  'type'=>'text'],
                        ['key'=>'stat5_value', 'label'=>'Stat 5 — Valeur',   'type'=>'text'],
                        ['key'=>'stat5_label', 'label'=>'Stat 5 — Libellé',  'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Produits (3 cartes)',
                    'fields' => [
                        ['key'=>'prod1_img',   'label'=>'Produit 1 — Image',        'type'=>'image'],
                        ['key'=>'prod1_title', 'label'=>'Produit 1 — Titre',        'type'=>'text'],
                        ['key'=>'prod1_desc',  'label'=>'Produit 1 — Description',  'type'=>'text'],
                        ['key'=>'prod2_img',   'label'=>'Produit 2 — Image',        'type'=>'image'],
                        ['key'=>'prod2_title', 'label'=>'Produit 2 — Titre',        'type'=>'text'],
                        ['key'=>'prod2_desc',  'label'=>'Produit 2 — Description',  'type'=>'text'],
                        ['key'=>'prod3_title', 'label'=>'Produit 3 — Titre',        'type'=>'text'],
                        ['key'=>'prod3_desc',  'label'=>'Produit 3 — Description',  'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Caractéristiques techniques',
                    'fields' => [
                        ['key'=>'spec_viscosity', 'label'=>'Viscosité ISO VG',           'type'=>'text'],
                        ['key'=>'spec_interval',  'label'=>'Intervalle de vidange',       'type'=>'text'],
                        ['key'=>'spec_temp',      'label'=>'Température de service max',  'type'=>'text'],
                        ['key'=>'spec_std',       'label'=>'Norme / Certification',       'type'=>'text'],
                    ],
                ],
                [
                    'label'  => "Appel à l'action",
                    'fields' => [
                        ['key'=>'cta_title',     'label'=>'Titre CTA',                      'type'=>'text'],
                        ['key'=>'cta_subtitle',  'label'=>'Texte CTA',                      'type'=>'html'],
                        ['key'=>'cta_btn1_text', 'label'=>'Bouton 1 — Texte (devis)',       'type'=>'text'],
                        ['key'=>'cta_btn1_url',  'label'=>'Bouton 1 — URL',                 'type'=>'url'],
                        ['key'=>'cta_btn2_text', 'label'=>'Bouton 2 — Texte (téléphone)',   'type'=>'text'],
                        ['key'=>'cta_btn2_url',  'label'=>'Bouton 2 — URL (tel:+237…)',     'type'=>'url'],
                        ['key'=>'cta_btn3_text', 'label'=>'Bouton 3 — Texte (WhatsApp)',    'type'=>'text'],
                        ['key'=>'cta_btn3_url',  'label'=>'Bouton 3 — URL (wa.me/…)',       'type'=>'url'],
                    ],
                ],
            ],
        ],

        'global' => [
            'title' => 'Paramètres globaux & Footer',
            'icon'  => 'fa-gear',
            'route' => null,
            'sections' => [
                [
                    'label'  => 'Footer — Général',
                    'fields' => [
                        ['key'=>'footer_logo',      'label'=>'Logo footer',                    'type'=>'image'],
                        ['key'=>'footer_desc',      'label'=>'Texte de description',           'type'=>'text'],
                        ['key'=>'footer_font_size', 'label'=>'Taille texte footer (ex: 0.85rem)', 'type'=>'text'],
                        ['key'=>'footer_copyright', 'label'=>'Copyright',                     'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Footer — Navigation (textes des liens)',
                    'fields' => [
                        ['key'=>'footer_nav_title',   'label'=>'Titre colonne Navigation', 'type'=>'text'],
                        ['key'=>'footer_nav_home',    'label'=>'Lien — Accueil',           'type'=>'text'],
                        ['key'=>'footer_nav_about',   'label'=>'Lien — À propos',          'type'=>'text'],
                        ['key'=>'footer_nav_prod',    'label'=>'Lien — Produits',           'type'=>'text'],
                        ['key'=>'footer_nav_serv',    'label'=>'Lien — Services',           'type'=>'text'],
                        ['key'=>'footer_nav_exp',     'label'=>'Lien — Expertise',          'type'=>'text'],
                        ['key'=>'footer_nav_gal',     'label'=>'Lien — Galerie',            'type'=>'text'],
                        ['key'=>'footer_nav_contact', 'label'=>'Lien — Contact',            'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Footer — Catégories produits (textes des liens)',
                    'fields' => [
                        ['key'=>'footer_prod_title', 'label'=>'Titre colonne Produits',          'type'=>'text'],
                        ['key'=>'footer_prod_vis',   'label'=>'Lien — Compresseurs à vis',       'type'=>'text'],
                        ['key'=>'footer_prod_oil',   'label'=>'Lien — Sans huile',               'type'=>'text'],
                        ['key'=>'footer_prod_pist',  'label'=>'Lien — À piston',                 'type'=>'text'],
                        ['key'=>'footer_prod_air',   'label'=>"Lien — Traitement de l'air",      'type'=>'text'],
                        ['key'=>'footer_prod_tank',  'label'=>'Lien — Réservoirs',               'type'=>'text'],
                        ['key'=>'footer_prod_cons',  'label'=>'Lien — Pièces & Consommables',    'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Footer — Contact',
                    'fields' => [
                        ['key'=>'footer_contact_title', 'label'=>'Titre colonne Contact', 'type'=>'text'],
                        ['key'=>'footer_address',       'label'=>'Adresse ligne 1',       'type'=>'text'],
                        ['key'=>'footer_address2',      'label'=>'Adresse ligne 2',       'type'=>'text'],
                        ['key'=>'footer_phone1',        'label'=>'Téléphone 1',           'type'=>'text'],
                        ['key'=>'footer_phone2',        'label'=>'Téléphone 2',           'type'=>'text'],
                        ['key'=>'footer_email',         'label'=>'Email',                 'type'=>'text'],
                    ],
                ],
                [
                    'label'  => 'Footer — Réseaux sociaux',
                    'fields' => [
                        ['key'=>'footer_fb', 'label'=>'URL Facebook',  'type'=>'url'],
                        ['key'=>'footer_li', 'label'=>'URL LinkedIn',  'type'=>'url'],
                        ['key'=>'footer_ig', 'label'=>'URL Instagram', 'type'=>'url'],
                        ['key'=>'footer_wa', 'label'=>'URL WhatsApp',  'type'=>'url'],
                    ],
                ],
                [
                    'label'  => 'Footer — Partenaires',
                    'fields' => [
                        ['key'=>'footer_partners_title', 'label'=>'Titre colonne Partenaires',   'type'=>'text'],
                        ['key'=>'footer_partners_desc',  'label'=>'Description partenaires',     'type'=>'text'],
                        ['key'=>'footer_renner_sub',     'label'=>'Sous-titre RENNER',           'type'=>'text'],
                        ['key'=>'footer_ir_sub',         'label'=>'Sous-titre Ingersoll Rand',   'type'=>'text'],
                    ],
                ],
            ],
        ],
    ];

    // ----------------------------------------------------------------
    // Constructor
    // ----------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Content_model');
        $this->load->model('Media_model');

        $public_methods = ['login', 'do_login', 'setup', 'do_setup', 'logout'];
        $method = $this->router->fetch_method();

        if (!in_array($method, $public_methods) && !$this->session->userdata('admin_id')) {
            redirect('admin/login');
        }
    }

    // ================================================================
    // AUTH
    // ================================================================

    public function login()
    {
        if ($this->session->userdata('admin_id')) {
            redirect('admin');
        }
        $this->load->view('admin/login', [
            'error' => $this->session->flashdata('login_error'),
        ]);
    }

    public function do_login()
    {
        if ($this->input->method() !== 'post') redirect('admin/login');

        // Brute-force : 5 tentatives max, blocage 10 min
        $attempts  = (int)($this->session->userdata('login_attempts') ?: 0);
        $last_fail = (int)($this->session->userdata('login_last_fail')  ?: 0);
        if ($attempts >= 5 && (time() - $last_fail) < 600) {
            $wait = ceil((600 - (time() - $last_fail)) / 60);
            $this->session->set_flashdata('login_error', "Compte temporairement bloqué. Réessayez dans {$wait} min.");
            redirect('admin/login');
        }
        if ((time() - $last_fail) >= 600) {
            $this->session->set_userdata(['login_attempts' => 0, 'login_last_fail' => 0]);
            $attempts = 0;
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password');

        $user = $this->db
            ->where('username', $username)
            ->get('rsc_admin_users')
            ->row();

        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata([
                'admin_id'        => $user->id,
                'admin_name'      => $user->name,
                'admin_role'      => $user->role,
                'admin_is_super'  => ($user->role === 'super'),
                'login_attempts'  => 0,
                'login_last_fail' => 0,
            ]);
            $this->_log('login', 'auth', $user->id, $user->username);
            redirect('admin');
        } else {
            $this->db->insert('rsc_audit_log', [
                'admin_id'     => null,
                'admin_name'   => $username,
                'action'       => 'login_failed',
                'entity_type'  => 'auth',
                'entity_id'    => '',
                'entity_label' => $username,
                'details'      => json_encode(['tentatives' => $attempts + 1]),
                'ip_address'   => $this->input->ip_address(),
                'user_agent'   => substr($this->input->user_agent(), 0, 255),
            ]);
            $this->session->set_userdata([
                'login_attempts'  => $attempts + 1,
                'login_last_fail' => time(),
            ]);
            $this->session->set_flashdata('login_error', 'Identifiants incorrects. Veuillez réessayer.');
            redirect('admin/login');
        }
    }

    public function logout()
    {
        $this->_log('logout', 'auth');
        $this->session->sess_destroy();
        redirect('admin/login');
    }

    // ================================================================
    // SETUP — premier démarrage uniquement
    // ================================================================

    public function setup()
    {
        if ($this->db->count_all('rsc_admin_users') > 0) {
            redirect('admin/login');
        }
        $this->load->view('admin/setup', [
            'error' => $this->session->flashdata('setup_error'),
        ]);
    }

    public function do_setup()
    {
        if ($this->db->count_all('rsc_admin_users') > 0) {
            redirect('admin/login');
        }

        $name     = $this->input->post('name',     TRUE);
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password');
        $confirm  = $this->input->post('confirm');

        if (strlen($password) < 8) {
            $this->session->set_flashdata('setup_error', 'Le mot de passe doit contenir au moins 8 caractères.');
            redirect('admin/setup');
        }
        if ($password !== $confirm) {
            $this->session->set_flashdata('setup_error', 'Les mots de passe ne correspondent pas.');
            redirect('admin/setup');
        }

        $this->db->insert('rsc_admin_users', [
            'name'     => $name,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role'     => 'super', // premier compte toujours Super Admin
        ]);

        $this->session->set_flashdata('login_success', 'Compte Super Admin créé. Connectez-vous.');
        redirect('admin/login');
    }

    // ================================================================
    // DASHBOARD
    // ================================================================

    public function index()
    {
        $this->_view('dashboard', []);
    }

    // ================================================================
    // ÉDITEUR DE PAGE
    // ================================================================

    public function page($page_name = 'home')
    {
        if (!isset($this->page_defs[$page_name])) show_404();

        $content = $this->Content_model->get_page($page_name);

        $this->_view('page_editor', [
            'page_name' => $page_name,
            'page_def'  => $this->page_defs[$page_name],
            'content'   => $content,
        ]);
    }

    public function save_blocks()
    {
        if ($this->input->method() !== 'post') {
            echo json_encode(['ok' => false, 'msg' => 'Method not allowed']);
            return;
        }

        $page   = $this->input->post('page', TRUE);
        $blocks = $this->input->post('blocks', FALSE); // FALSE = raw, pour les champs HTML

        if (!$page || !is_array($blocks)) {
            echo json_encode(['ok' => false, 'msg' => 'Données manquantes']);
            return;
        }

        foreach ($blocks as $block) {
            $key   = $this->security->xss_clean($block['key']);
            $type  = $this->security->xss_clean($block['type']);
            $label = $this->security->xss_clean($block['label']);
            // Pour HTML, on garde le contenu brut (l'admin est de confiance)
            $value = ($type === 'html') ? $block['value'] : $this->security->xss_clean($block['value']);

            $this->Content_model->upsert($page, $key, $type, $value, $label);
        }

        $this->_log('content_saved', 'page', $page, $page, ['fields' => count($blocks)]);
        echo json_encode(['ok' => true, 'saved' => count($blocks)]);
    }

    // ================================================================
    // MÉDIATHÈQUE
    // ================================================================

    public function media()
    {
        $data['images']        = $this->Media_model->get_all();
        $data['upload_error']  = $this->session->flashdata('media_error');
        $data['upload_success']= $this->session->flashdata('media_success');
        $this->_view('media', $data);
    }

    public function media_json()
    {
        $images = $this->Media_model->get_all();
        $result = [];
        foreach ($images as $img) {
            $result[] = [
                'id'            => $img->id,
                'filename'      => $img->filename,
                'original_name' => $img->original_name,
                'path'          => 'assets/uploads/' . $img->filename,
            ];
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['images' => $result]));
    }

    public function upload_media()
    {
        if ($this->input->method() !== 'post') redirect('admin/media');

        $upload_path = FCPATH . 'assets/uploads/';
        if (!is_dir($upload_path)) mkdir($upload_path, 0755, TRUE);

        $config = [
            'upload_path'   => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|webp|gif',
            'max_size'      => 5120,
            'encrypt_name'  => TRUE,
        ];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {
            $info      = $this->upload->data();
            $filename  = $info['file_name'];
            $orig_name = $info['orig_name'];
            $mime_type = $info['file_type'];

            // Convert JPG/PNG to WebP if GD supports it
            if (function_exists('imagewebp')) {
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                    $src_path = $upload_path . $filename;
                    $src_img  = ($ext === 'png') ? @imagecreatefrompng($src_path) : @imagecreatefromjpeg($src_path);
                    if ($src_img) {
                        $webp_name = pathinfo($filename, PATHINFO_FILENAME) . '.webp';
                        $webp_path = $upload_path . $webp_name;
                        if (@imagewebp($src_img, $webp_path, 82)) {
                            imagedestroy($src_img);
                            @unlink($src_path);
                            $filename  = $webp_name;
                            $orig_name = pathinfo($orig_name, PATHINFO_FILENAME) . '.webp';
                            $mime_type = 'image/webp';
                        } else {
                            imagedestroy($src_img);
                        }
                    }
                }
            }

            $this->Media_model->insert([
                'filename'      => $filename,
                'original_name' => $orig_name,
                'mime_type'     => $mime_type,
                'file_size'     => $info['file_size'],
            ]);
            $this->_log('media_uploaded', 'media', $filename, $orig_name, ['size_kb' => $info['file_size']]);

            if ($this->input->is_ajax_request()) {
                echo json_encode([
                    'ok'   => true,
                    'path' => 'assets/uploads/' . $filename,
                    'name' => $orig_name,
                ]);
                return;
            }

            $this->session->set_flashdata('media_success', 'Image téléversée avec succès.');
        } else {
            $err = $this->upload->display_errors('', '');

            if ($this->input->is_ajax_request()) {
                echo json_encode(['ok' => false, 'msg' => $err]);
                return;
            }

            $this->session->set_flashdata('media_error', $err);
        }

        redirect('admin/media');
    }

    public function delete_media($id)
    {
        if ($this->input->method() !== 'post') redirect('admin/media');
        $media = $this->Media_model->get((int)$id);
        if ($media) {
            @unlink(FCPATH . 'assets/uploads/' . $media->filename);
            $this->Media_model->delete((int)$id);
            $this->_log('media_deleted', 'media', $id, $media->filename);
        }
        redirect('admin/media');
    }

    // ================================================================
    // DOCUMENTS TÉLÉCHARGEABLES (PDF, DOCX, XLSX…)
    // ================================================================

    public function documents()
    {
        $this->load->model('Document_model');
        $this->Document_model->ensure_schema();

        $data['documents_list'] = $this->Document_model->get_all();
        $data['doc_pages']      = Document_model::$pages;
        $data['success']        = $this->session->flashdata('doc_success');
        $data['error']          = $this->session->flashdata('doc_error');
        $this->_view('documents', $data);
    }

    public function document_new()
    {
        $this->load->model('Document_model');
        $this->Document_model->ensure_schema();

        $this->_view('document_form', [
            'item'      => null,
            'doc_pages' => Document_model::$pages,
            'error'     => $this->session->flashdata('doc_error'),
        ]);
    }

    public function document_edit($id)
    {
        $this->load->model('Document_model');
        $this->Document_model->ensure_schema();

        $item = $this->Document_model->get((int)$id);
        if (!$item) redirect('admin/documents');

        $this->_view('document_form', [
            'item'      => $item,
            'doc_pages' => Document_model::$pages,
            'error'     => $this->session->flashdata('doc_error'),
        ]);
    }

    public function document_do_new()
    {
        if ($this->input->method() !== 'post') redirect('admin/documents');
        $this->load->model('Document_model');

        $fields = $this->_document_post();
        if ($fields['file_path'] === '') {
            $this->session->set_flashdata('doc_error', 'Aucun fichier : téléversez un document ou saisissez une URL externe.');
            redirect('admin/document_new');
        }

        $id = $this->Document_model->insert($fields);
        $this->_log('document_added', 'document', $id, $fields['title']);
        $this->session->set_flashdata('doc_success', 'Document ajouté.');
        redirect('admin/documents');
    }

    public function document_do_edit($id)
    {
        if ($this->input->method() !== 'post') redirect('admin/documents');
        $this->load->model('Document_model');

        $item = $this->Document_model->get((int)$id);
        if (!$item) redirect('admin/documents');

        $fields = $this->_document_post();

        // Aucun nouveau fichier envoyé : on conserve celui déjà en place
        if ($fields['file_path'] === '') {
            unset($fields['file_path'], $fields['original_name'], $fields['mime_type'], $fields['file_size']);
        }

        $this->Document_model->update((int)$id, $fields);
        $this->_log('document_updated', 'document', $id, $this->input->post('title', TRUE));
        $this->session->set_flashdata('doc_success', 'Document mis à jour.');
        redirect('admin/documents');
    }

    public function document_delete($id)
    {
        if ($this->input->method() !== 'post') redirect('admin/documents');
        $this->load->model('Document_model');

        $item = $this->Document_model->get((int)$id);
        if ($item) {
            // Seuls les fichiers téléversés via l'admin sont effacés du disque.
            // Les PDF historiques de assets/Documents/ sont toujours conservés.
            if ($this->input->post('purge_file')
                && strpos((string)$item->file_path, Document_model::UPL_DIR) === 0) {
                @unlink(FCPATH . $item->file_path);
            }
            $this->Document_model->delete((int)$id);
            $this->_log('document_deleted', 'document', $id, $item->title);
            $this->session->set_flashdata('doc_success', 'Document supprimé.');
        }
        redirect('admin/documents');
    }

    public function document_toggle($id)
    {
        $this->load->model('Document_model');
        $this->Document_model->toggle_visible((int)$id);
        $this->_log('document_toggled', 'document', $id);
        redirect('admin/documents');
    }

    /**
     * Téléversement AJAX d'un fichier de documentation.
     * Renvoie {ok, path, name, size, mime} — consommé par document_form.php.
     */
    public function upload_document()
    {
        if ($this->input->method() !== 'post') {
            $this->_json(['ok' => false, 'msg' => 'Méthode non autorisée.']);
            return;
        }

        $this->load->model('Document_model');
        $upload_path = FCPATH . Document_model::UPL_DIR;
        if (!is_dir($upload_path)) @mkdir($upload_path, 0755, TRUE);

        if (!is_dir($upload_path) || !is_writable($upload_path)) {
            $this->_json(['ok' => false, 'msg' => 'Dossier ' . Document_model::UPL_DIR . ' introuvable ou non inscriptible.']);
            return;
        }

        $this->load->library('upload', [
            'upload_path'   => $upload_path,
            'allowed_types' => 'pdf|doc|docx|xls|xlsx|ppt|pptx|zip|csv|txt|jpg|jpeg|png|webp',
            'max_size'      => 30720, // 30 Mo
            'encrypt_name'  => TRUE,
        ]);

        if (!$this->upload->do_upload('file')) {
            $this->_json(['ok' => false, 'msg' => $this->upload->display_errors('', '')]);
            return;
        }

        $info = $this->upload->data();
        $this->_log('document_file_uploaded', 'document', null, $info['orig_name'], ['size_kb' => $info['file_size']]);

        $this->_json([
            'ok'   => true,
            'path' => Document_model::UPL_DIR . $info['file_name'],
            'name' => $info['orig_name'],
            'size' => (int)$info['file_size'] * 1024,
            'mime' => $info['file_type'],
        ]);
    }

    /**
     * Valide le chemin d'un document : soit une URL http(s), soit un chemin
     * interne sous assets/. Renvoie '' si le chemin n'est pas acceptable.
     *
     * Validation structurelle (pas de liste blanche de caractères) : les noms
     * de fichiers réels contiennent accents, espaces, parenthèses et virgules.
     */
    private function _document_path($raw)
    {
        $path = trim(str_replace('\\', '/', $raw));
        if ($path === '') return '';

        if (preg_match('#^https?://#i', $path)) return $path;

        $path = ltrim($path, '/');

        if (strpos($path, 'assets/') !== 0)     return ''; // hors zone publique
        if (strpos($path, '..') !== false)      return ''; // traversée de répertoire
        if (strpos($path, "\0") !== false)      return '';
        if (preg_match('/[\x00-\x1F\x7F]/', $path)) return ''; // caractères de contrôle

        // Jamais de script exécutable
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        if (in_array($ext, ['php', 'phtml', 'php3', 'php4', 'php5', 'php7', 'phar', 'cgi', 'pl', 'py', 'htaccess'], true)) {
            return '';
        }

        return $path;
    }

    /** Champs du formulaire Document, normalisés. */
    private function _document_post()
    {
        $pages = array_keys(Document_model::$pages);
        $page  = (string)$this->input->post('page');
        if (!in_array($page, $pages, TRUE)) $page = $pages[0];

        $path = $this->_document_path((string)$this->input->post('file_path'));

        $icon = trim((string)$this->input->post('icon'));
        if (!preg_match('/^fa-[a-z0-9-]{2,}$/', $icon)) $icon = '';

        $orig  = trim((string)$this->input->post('original_name', TRUE));
        $title = trim((string)$this->input->post('title', TRUE));
        if ($title === '') {
            $title = $orig !== '' ? pathinfo($orig, PATHINFO_FILENAME) : 'Document';
        }

        return [
            'page'          => $page,
            'title'         => $title,
            'subtitle'      => trim((string)$this->input->post('subtitle', TRUE)),
            'file_path'     => $path,
            'original_name' => $orig,
            'mime_type'     => trim((string)$this->input->post('mime_type', TRUE)),
            'file_size'     => (int)$this->input->post('file_size') ?: null,
            'icon'          => $icon !== '' ? $icon : 'fa-file-pdf',
            'badge'         => trim((string)$this->input->post('badge', TRUE)),
            'sort_order'    => (int)$this->input->post('sort_order'),
            'visible'       => $this->input->post('visible') ? 1 : 0,
        ];
    }

    private function _json($payload)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($payload, JSON_UNESCAPED_UNICODE));
    }

    // ================================================================
    // GALERIE PHOTOS
    // ================================================================

    public function gallery()
    {
        $this->load->model('Gallery_model');
        $data['gallery_list'] = $this->Gallery_model->get_all();
        $data['success']      = $this->session->flashdata('gallery_success');
        $data['error']        = $this->session->flashdata('gallery_error');
        $this->_view('gallery', $data);
    }

    public function gallery_new()
    {
        $this->load->model('Gallery_model');
        $data['item'] = null;
        $this->_view('gallery_form', $data);
    }

    public function gallery_do_new()
    {
        if ($this->input->method() !== 'post') redirect('admin/gallery');
        $this->load->model('Gallery_model');
        $this->Gallery_model->insert([
            'image'      => $this->input->post('image'),
            'title'      => $this->input->post('title'),
            'caption'    => $this->input->post('caption'),
            'sort_order' => (int)$this->input->post('sort_order'),
            'visible'    => $this->input->post('visible') ? 1 : 0,
        ]);
        $this->_log('gallery_added', 'gallery', $this->db->insert_id(), $this->input->post('title', TRUE));
        $this->session->set_flashdata('gallery_success', 'Image ajoutée à la galerie.');
        redirect('admin/gallery');
    }

    public function gallery_edit($id)
    {
        $this->load->model('Gallery_model');
        $item = $this->Gallery_model->get((int)$id);
        if (!$item) redirect('admin/gallery');
        $data['item'] = $item;
        $this->_view('gallery_form', $data);
    }

    public function gallery_do_edit($id)
    {
        if ($this->input->method() !== 'post') redirect('admin/gallery');
        $this->load->model('Gallery_model');
        $this->Gallery_model->update((int)$id, [
            'image'      => $this->input->post('image'),
            'title'      => $this->input->post('title'),
            'caption'    => $this->input->post('caption'),
            'sort_order' => (int)$this->input->post('sort_order'),
            'visible'    => $this->input->post('visible') ? 1 : 0,
        ]);
        $this->_log('gallery_updated', 'gallery', $id, $this->input->post('title', TRUE));
        $this->session->set_flashdata('gallery_success', 'Image mise à jour.');
        redirect('admin/gallery');
    }

    public function gallery_delete($id)
    {
        if ($this->input->method() !== 'post') redirect('admin/gallery');
        $this->load->model('Gallery_model');
        $this->Gallery_model->delete((int)$id);
        $this->_log('gallery_deleted', 'gallery', $id);
        $this->session->set_flashdata('gallery_success', 'Image supprimée de la galerie.');
        redirect('admin/gallery');
    }

    public function gallery_toggle($id)
    {
        $this->load->model('Gallery_model');
        $this->Gallery_model->toggle_visible((int)$id);
        $this->_log('gallery_toggled', 'gallery', $id);
        redirect('admin/gallery');
    }

    // ================================================================
    // MOT DE PASSE
    // ================================================================

    public function password()
    {
        $this->_view('password', [
            'error'   => $this->session->flashdata('pw_error'),
            'success' => $this->session->flashdata('pw_success'),
        ]);
    }

    public function save_password()
    {
        $current = $this->input->post('current_password');
        $new     = $this->input->post('new_password');
        $confirm = $this->input->post('confirm_password');

        $admin_id = $this->session->userdata('admin_id');
        $user     = $this->db->where('id', $admin_id)->get('rsc_admin_users')->row();

        if (!$user || !password_verify($current, $user->password)) {
            $this->session->set_flashdata('pw_error', 'Mot de passe actuel incorrect.');
            redirect('admin/password');
        }

        if (strlen($new) < 8) {
            $this->session->set_flashdata('pw_error', 'Le nouveau mot de passe doit contenir au moins 8 caractères.');
            redirect('admin/password');
        }

        if ($new !== $confirm) {
            $this->session->set_flashdata('pw_error', 'Les nouveaux mots de passe ne correspondent pas.');
            redirect('admin/password');
        }

        $this->db->where('id', $admin_id)->update('rsc_admin_users', [
            'password' => password_hash($new, PASSWORD_BCRYPT),
        ]);

        $this->_log('password_changed', 'account', $admin_id, $this->session->userdata('admin_name'));
        $this->session->set_flashdata('pw_success', 'Mot de passe modifié avec succès.');
        redirect('admin/password');
    }

    // ================================================================
    // SAUVEGARDE INLINE (AJAX)
    // ================================================================

    public function inline_save()
    {
        if ($this->input->method() !== 'post') {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(['ok' => false, 'msg' => 'Method not allowed']));
            return;
        }

        $page  = $this->input->post('page',  TRUE);
        $key   = $this->input->post('key',   TRUE);
        $type  = $this->input->post('type',  TRUE) ?: 'text';
        $label = $this->input->post('label', TRUE);
        $value = ($type === 'html')
               ? $this->input->post('value', FALSE)
               : $this->input->post('value', TRUE);

        if (!$page || !$key) {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(['ok' => false, 'msg' => 'Données manquantes']));
            return;
        }

        $this->Content_model->upsert($page, $key, $type, $value, $label ?: $key);
        $this->_log('inline_save', 'content', $page . '.' . $key, $label ?: $key, ['page' => $page, 'key' => $key]);

        $this->output->set_content_type('application/json')
            ->set_output(json_encode(['ok' => true]));
    }

    // ================================================================
    // VISIBILITÉ DE SECTION (AJAX)
    // ================================================================

    public function toggle_section()
    {
        if ($this->input->method() !== 'post') {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(['ok' => false]));
            return;
        }

        $page    = $this->input->post('page',    TRUE);
        $section = $this->input->post('section', TRUE);
        $visible = $this->input->post('visible', TRUE);

        if (!$page || !$section) {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(['ok' => false, 'msg' => 'Données manquantes']));
            return;
        }

        $key = 'section_' . preg_replace('/[^a-z0-9_]/', '', strtolower($section)) . '_visible';
        $this->Content_model->upsert($page, $key, 'text', ($visible === '1' ? '1' : '0'), 'Visibilité section');
        $this->_log('toggle_section', 'content', $page, $section, ['page' => $page, 'section' => $section, 'visible' => $visible]);

        $this->output->set_content_type('application/json')
            ->set_output(json_encode(['ok' => true]));
    }

    // ================================================================
    // PAGES PERSONNALISÉES
    // ================================================================

    public function pages()
    {
        $this->load->model('Pages_model');
        $this->_view('pages', [
            'pages_list' => $this->Pages_model->get_all(),
            'success'    => $this->session->flashdata('page_success'),
            'error'      => $this->session->flashdata('page_error'),
        ]);
    }

    public function new_page()
    {
        $this->_view('page_new', [
            'edit_page' => null,
            'error'     => $this->session->flashdata('page_error'),
        ]);
    }

    public function do_new_page()
    {
        if ($this->input->method() !== 'post') redirect('admin/pages');

        $title       = $this->input->post('title',       TRUE);
        $slug        = preg_replace('/[^a-z0-9\-]/', '', strtolower($this->input->post('slug', TRUE)));
        $content     = $this->input->post('content',     FALSE);
        $nav_label   = $this->input->post('nav_label',   TRUE);
        $show_in_nav = $this->input->post('show_in_nav') ? 1 : 0;
        $meta_desc   = $this->input->post('meta_desc',   TRUE);

        if (!$title || !$slug) {
            $this->session->set_flashdata('page_error', 'Le titre et le slug sont requis.');
            redirect('admin/pages/new');
        }

        $this->load->model('Pages_model');
        $this->Pages_model->insert([
            'title'       => $title,
            'slug'        => $slug,
            'content'     => $content,
            'nav_label'   => $nav_label,
            'show_in_nav' => $show_in_nav,
            'meta_desc'   => $meta_desc,
            'visible'     => 1,
        ]);
        $new_id = $this->db->insert_id();
        $this->_log('page_created', 'page', $new_id, $title, ['slug' => $slug]);

        $this->session->set_flashdata('page_success', 'Page créée ! Accessible à : ' . base_url('p/' . $slug));
        redirect('admin/pages');
    }

    public function edit_page_custom($id)
    {
        $this->load->model('Pages_model');
        $page = $this->Pages_model->get((int)$id);
        if (!$page) show_404();

        $this->_view('page_new', [
            'edit_page' => $page,
            'error'     => $this->session->flashdata('page_error'),
        ]);
    }

    public function save_page_custom($id)
    {
        if ($this->input->method() !== 'post') redirect('admin/pages');

        $this->load->model('Pages_model');
        $slug = preg_replace('/[^a-z0-9\-]/', '', strtolower($this->input->post('slug', TRUE)));

        $title = $this->input->post('title', TRUE);
        $this->Pages_model->update((int)$id, [
            'title'       => $title,
            'slug'        => $slug,
            'content'     => $this->input->post('content',     FALSE),
            'nav_label'   => $this->input->post('nav_label',   TRUE),
            'show_in_nav' => $this->input->post('show_in_nav') ? 1 : 0,
            'meta_desc'   => $this->input->post('meta_desc',   TRUE),
            'visible'     => $this->input->post('visible')     ? 1 : 0,
        ]);
        $this->_log('page_updated', 'page', $id, $title, ['slug' => $slug]);

        $this->session->set_flashdata('page_success', 'Page mise à jour.');
        redirect('admin/pages');
    }

    public function delete_page_custom($id)
    {
        $this->load->model('Pages_model');
        $page = $this->Pages_model->get((int)$id);
        $this->Pages_model->delete((int)$id);
        $this->_log('page_deleted', 'page', $id, $page ? $page->title : null);
        $this->session->set_flashdata('page_success', 'Page supprimée.');
        redirect('admin/pages');
    }

    // ================================================================
    // CATALOGUE PRODUITS
    // ================================================================

    public function products()
    {
        $this->load->model('Products_model');
        $brands_raw = $this->Products_model->get_brands();
        $brands_map = [];
        foreach ($brands_raw as $b) { $brands_map[$b->slug] = $b; }
        $cats_raw = $this->Products_model->get_categories();
        $cats_map = [];
        foreach ($cats_raw as $c) { $cats_map[$c->slug] = $c->name; }
        $this->_view('products', [
            'products_list' => $this->Products_model->get_all_admin(),
            'brands_map'    => $brands_map,
            'cats_map'      => $cats_map,
            'success'       => $this->session->flashdata('product_success'),
            'error'         => $this->session->flashdata('product_error'),
        ]);
    }

    public function product_new()
    {
        $this->load->model('Products_model');
        $this->_view('product_form', [
            'product'    => null,
            'brands'     => $this->Products_model->get_brands(),
            'categories' => $this->Products_model->get_categories(),
            'error'      => $this->session->flashdata('product_error'),
        ]);
    }

    public function product_do_new()
    {
        if ($this->input->method() !== 'post') redirect('admin/products');

        $this->load->model('Products_model');
        $name = $this->input->post('name', TRUE);

        if (!$name) {
            $this->session->set_flashdata('product_error', 'Le nom du produit est requis.');
            redirect('admin/product_new');
        }

        $this->Products_model->insert([
            'name'        => $name,
            'model'       => $this->input->post('model',       TRUE),
            'brand'       => $this->input->post('brand',       TRUE) ?: 'other',
            'category'    => $this->input->post('category',    TRUE) ?: 'vis',
            'description' => $this->input->post('description', TRUE),
            'image'       => $this->input->post('image',       TRUE),
            'cta_url'     => $this->input->post('cta_url',     TRUE),
            'sort_order'  => (int) $this->input->post('sort_order'),
            'visible'     => 1,
        ]);
        $new_id = $this->db->insert_id();
        $this->_log('product_created', 'product', $new_id, $name, ['brand' => $this->input->post('brand', TRUE)]);

        $this->session->set_flashdata('product_success', 'Produit ajouté avec succès.');
        redirect('admin/products');
    }

    public function product_edit($id)
    {
        $this->load->model('Products_model');
        $product = $this->Products_model->get((int)$id);
        if (!$product) show_404();

        $this->_view('product_form', [
            'product'    => $product,
            'brands'     => $this->Products_model->get_brands(),
            'categories' => $this->Products_model->get_categories(),
            'error'      => $this->session->flashdata('product_error'),
        ]);
    }

    public function product_do_edit($id)
    {
        if ($this->input->method() !== 'post') redirect('admin/products');

        $this->load->model('Products_model');
        $name = $this->input->post('name', TRUE);

        if (!$name) {
            $this->session->set_flashdata('product_error', 'Le nom du produit est requis.');
            redirect('admin/product_edit/' . (int)$id);
        }

        $this->Products_model->update((int)$id, [
            'name'        => $name,
            'model'       => $this->input->post('model',       TRUE),
            'brand'       => $this->input->post('brand',       TRUE) ?: 'other',
            'category'    => $this->input->post('category',    TRUE) ?: 'vis',
            'description' => $this->input->post('description', TRUE),
            'image'       => $this->input->post('image',       TRUE),
            'cta_url'     => $this->input->post('cta_url',     TRUE),
            'sort_order'  => (int) $this->input->post('sort_order'),
            'visible'     => $this->input->post('visible') ? 1 : 0,
        ]);
        $this->_log('product_updated', 'product', $id, $name);

        $this->session->set_flashdata('product_success', 'Produit mis à jour.');
        redirect('admin/products');
    }

    public function product_delete($id)
    {
        if ($this->input->method() !== 'post') redirect('admin/products');
        $this->load->model('Products_model');
        $product = $this->Products_model->get((int)$id);
        $this->Products_model->delete((int)$id);
        $this->_log('product_deleted', 'product', $id, $product ? $product->name : null);
        $this->session->set_flashdata('product_success', 'Produit supprimé.');
        redirect('admin/products');
    }

    public function product_toggle($id)
    {
        $this->load->model('Products_model');
        $product = $this->Products_model->get((int)$id);
        $this->Products_model->toggle_visible((int)$id);
        $this->_log('product_toggled', 'product', $id, $product ? $product->name : null);
        redirect('admin/products');
    }

    // ================================================================
    // FABRICANTS (BRANDS)
    // ================================================================

    public function brands()
    {
        $this->load->model('Products_model');
        $this->_view('brands', [
            'brands_list' => $this->Products_model->get_brands(),
            'success'     => $this->session->flashdata('brand_success'),
            'error'       => $this->session->flashdata('brand_error'),
        ]);
    }

    public function brand_new()
    {
        $this->_view('brand_form', [
            'brand' => null,
            'error' => $this->session->flashdata('brand_error'),
        ]);
    }

    public function brand_do_new()
    {
        if ($this->input->method() !== 'post') redirect('admin/brands');
        $this->load->model('Products_model');

        $name = $this->input->post('name', TRUE);
        $slug = preg_replace('/[^a-z0-9\-]/', '', strtolower($this->input->post('slug', TRUE)));

        if (!$name || !$slug) {
            $this->session->set_flashdata('brand_error', 'Le nom et le slug sont requis.');
            redirect('admin/brand_new');
        }

        $this->Products_model->insert_brand([
            'name'       => $name,
            'slug'       => $slug,
            'color'      => $this->input->post('color',      TRUE) ?: '#64748b',
            'icon'       => $this->input->post('icon',       TRUE) ?: 'fa-industry',
            'sort_order' => (int) $this->input->post('sort_order'),
        ]);
        $this->_log('brand_created', 'brand', $this->db->insert_id(), $name, ['slug' => $slug]);

        $this->session->set_flashdata('brand_success', 'Fabricant ajouté avec succès.');
        redirect('admin/brands');
    }

    public function brand_edit($id)
    {
        $this->load->model('Products_model');
        $brand = $this->Products_model->get_brand((int)$id);
        if (!$brand) show_404();

        $this->_view('brand_form', [
            'brand' => $brand,
            'error' => $this->session->flashdata('brand_error'),
        ]);
    }

    public function brand_do_edit($id)
    {
        if ($this->input->method() !== 'post') redirect('admin/brands');
        $this->load->model('Products_model');

        $name = $this->input->post('name', TRUE);
        $slug = preg_replace('/[^a-z0-9\-]/', '', strtolower($this->input->post('slug', TRUE)));

        if (!$name || !$slug) {
            $this->session->set_flashdata('brand_error', 'Le nom et le slug sont requis.');
            redirect('admin/brand_edit/' . (int)$id);
        }

        $this->Products_model->update_brand((int)$id, [
            'name'       => $name,
            'slug'       => $slug,
            'color'      => $this->input->post('color',      TRUE) ?: '#64748b',
            'icon'       => $this->input->post('icon',       TRUE) ?: 'fa-industry',
            'sort_order' => (int) $this->input->post('sort_order'),
        ]);
        $this->_log('brand_updated', 'brand', $id, $name);

        $this->session->set_flashdata('brand_success', 'Fabricant mis à jour.');
        redirect('admin/brands');
    }

    public function brand_delete($id)
    {
        if ($this->input->method() !== 'post') redirect('admin/brands');
        $this->load->model('Products_model');
        if ($this->Products_model->brand_in_use((int)$id)) {
            $this->session->set_flashdata('brand_error', 'Impossible de supprimer : ce fabricant est utilisé par des produits.');
            redirect('admin/brands');
        }
        $brand = $this->Products_model->get_brand((int)$id);
        $this->Products_model->delete_brand((int)$id);
        $this->_log('brand_deleted', 'brand', $id, $brand ? $brand->name : null);
        $this->session->set_flashdata('brand_success', 'Fabricant supprimé.');
        redirect('admin/brands');
    }

    // ================================================================
    // CATÉGORIES
    // ================================================================

    public function categories()
    {
        $this->load->model('Products_model');
        $this->_view('categories', [
            'categories_list' => $this->Products_model->get_categories(),
            'success'         => $this->session->flashdata('cat_success'),
            'error'           => $this->session->flashdata('cat_error'),
        ]);
    }

    public function category_new()
    {
        $this->_view('category_form', [
            'category' => null,
            'error'    => $this->session->flashdata('cat_error'),
        ]);
    }

    public function category_do_new()
    {
        if ($this->input->method() !== 'post') redirect('admin/categories');
        $this->load->model('Products_model');

        $name = $this->input->post('name', TRUE);
        $slug = preg_replace('/[^a-z0-9\-]/', '', strtolower($this->input->post('slug', TRUE)));

        if (!$name || !$slug) {
            $this->session->set_flashdata('cat_error', 'Le nom et le slug sont requis.');
            redirect('admin/category_new');
        }

        $this->Products_model->insert_category([
            'name'       => $name,
            'slug'       => $slug,
            'sort_order' => (int) $this->input->post('sort_order'),
        ]);
        $this->_log('category_created', 'category', $this->db->insert_id(), $name, ['slug' => $slug]);

        $this->session->set_flashdata('cat_success', 'Catégorie ajoutée avec succès.');
        redirect('admin/categories');
    }

    public function category_edit($id)
    {
        $this->load->model('Products_model');
        $cat = $this->Products_model->get_category((int)$id);
        if (!$cat) show_404();

        $this->_view('category_form', [
            'category' => $cat,
            'error'    => $this->session->flashdata('cat_error'),
        ]);
    }

    public function category_do_edit($id)
    {
        if ($this->input->method() !== 'post') redirect('admin/categories');
        $this->load->model('Products_model');

        $name = $this->input->post('name', TRUE);
        $slug = preg_replace('/[^a-z0-9\-]/', '', strtolower($this->input->post('slug', TRUE)));

        if (!$name || !$slug) {
            $this->session->set_flashdata('cat_error', 'Le nom et le slug sont requis.');
            redirect('admin/category_edit/' . (int)$id);
        }

        $this->Products_model->update_category((int)$id, [
            'name'       => $name,
            'slug'       => $slug,
            'sort_order' => (int) $this->input->post('sort_order'),
        ]);
        $this->_log('category_updated', 'category', $id, $name);

        $this->session->set_flashdata('cat_success', 'Catégorie mise à jour.');
        redirect('admin/categories');
    }

    public function category_delete($id)
    {
        if ($this->input->method() !== 'post') redirect('admin/categories');
        $this->load->model('Products_model');
        if ($this->Products_model->category_in_use((int)$id)) {
            $this->session->set_flashdata('cat_error', 'Impossible de supprimer : cette catégorie est utilisée par des produits.');
            redirect('admin/categories');
        }
        $cat = $this->Products_model->get_category((int)$id);
        $this->Products_model->delete_category((int)$id);
        $this->_log('category_deleted', 'category', $id, $cat ? $cat->name : null);
        $this->session->set_flashdata('cat_success', 'Catégorie supprimée.');
        redirect('admin/categories');
    }

    // ================================================================
    // GESTION UTILISATEURS (Super Admin uniquement)
    // ================================================================

    public function users()
    {
        $this->_require_super();
        $this->_view('users', [
            'users'   => $this->db->order_by('id', 'ASC')->get('rsc_admin_users')->result(),
            'success' => $this->session->flashdata('user_success'),
            'error'   => $this->session->flashdata('user_error'),
        ]);
    }

    public function user_new()
    {
        $this->_require_super();
        $this->_view('user_form', [
            'edit_user'       => null,
            'change_password' => false,
            'error'           => $this->session->flashdata('user_error'),
        ]);
    }

    public function user_do_new()
    {
        $this->_require_super();
        if ($this->input->method() !== 'post') redirect('admin/users');

        $name     = $this->input->post('name',     TRUE);
        $username = $this->input->post('username', TRUE);
        $role     = $this->input->post('role',     TRUE);
        $password = $this->input->post('password');
        $confirm  = $this->input->post('confirm');

        $role = in_array($role, ['super', 'editor']) ? $role : 'editor';

        if (!$name || !$username || !$password) {
            $this->session->set_flashdata('user_error', 'Tous les champs sont requis.');
            redirect('admin/user_new');
        }
        if ($password !== $confirm) {
            $this->session->set_flashdata('user_error', 'Les mots de passe ne correspondent pas.');
            redirect('admin/user_new');
        }
        if (strlen($password) < 8) {
            $this->session->set_flashdata('user_error', 'Mot de passe trop court (8 caractères min).');
            redirect('admin/user_new');
        }
        if ($this->db->where('username', $username)->count_all_results('rsc_admin_users')) {
            $this->session->set_flashdata('user_error', "Nom d'utilisateur « $username » déjà utilisé.");
            redirect('admin/user_new');
        }

        $this->db->insert('rsc_admin_users', [
            'name'     => $name,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role'     => $role,
        ]);
        $new_id = $this->db->insert_id();
        $this->_log('user_created', 'user', $new_id, $name, ['username' => $username, 'role' => $role]);

        $this->session->set_flashdata('user_success', "Utilisateur « $name » créé avec succès.");
        redirect('admin/users');
    }

    public function user_edit($id)
    {
        $this->_require_super();
        $user = $this->db->where('id', (int)$id)->get('rsc_admin_users')->row();
        if (!$user) show_404();

        $this->_view('user_form', [
            'edit_user'       => $user,
            'change_password' => false,
            'error'           => $this->session->flashdata('user_error'),
        ]);
    }

    public function user_do_edit($id)
    {
        $this->_require_super();
        if ($this->input->method() !== 'post') redirect('admin/users');

        $id   = (int)$id;
        $name = $this->input->post('name', TRUE);
        $role = $this->input->post('role', TRUE);
        $role = in_array($role, ['super', 'editor']) ? $role : 'editor';

        // Impossible de rétrograder si dernier super
        if ($role !== 'super') {
            $target = $this->db->where('id', $id)->get('rsc_admin_users')->row();
            if ($target && $target->role === 'super') {
                $super_count = $this->db->where('role', 'super')->count_all_results('rsc_admin_users');
                if ($super_count <= 1) {
                    $this->session->set_flashdata('user_error', 'Impossible de rétrograder le dernier Super Administrateur.');
                    redirect('admin/user_edit/' . $id);
                }
            }
        }

        $this->db->where('id', $id)->update('rsc_admin_users', [
            'name' => $name,
            'role' => $role,
        ]);
        $this->_log('user_updated', 'user', $id, $name, ['role' => $role]);

        $this->session->set_flashdata('user_success', 'Utilisateur mis à jour.');
        redirect('admin/users');
    }

    public function user_set_password($id)
    {
        $this->_require_super();
        $user = $this->db->where('id', (int)$id)->get('rsc_admin_users')->row();
        if (!$user) show_404();

        $this->_view('user_form', [
            'edit_user'       => $user,
            'change_password' => true,
            'error'           => $this->session->flashdata('user_error'),
        ]);
    }

    public function user_do_set_password($id)
    {
        $this->_require_super();
        if ($this->input->method() !== 'post') redirect('admin/users');

        $id      = (int)$id;
        $new     = $this->input->post('new_password');
        $confirm = $this->input->post('confirm_password');

        if (strlen($new) < 8) {
            $this->session->set_flashdata('user_error', 'Mot de passe trop court (8 caractères min).');
            redirect('admin/user_set_password/' . $id);
        }
        if ($new !== $confirm) {
            $this->session->set_flashdata('user_error', 'Les mots de passe ne correspondent pas.');
            redirect('admin/user_set_password/' . $id);
        }

        $this->db->where('id', $id)->update('rsc_admin_users', [
            'password' => password_hash($new, PASSWORD_BCRYPT),
        ]);
        $target = $this->db->where('id', $id)->get('rsc_admin_users')->row();
        $this->_log('user_password_changed', 'user', $id, $target ? $target->name : null);

        $this->session->set_flashdata('user_success', 'Mot de passe modifié avec succès.');
        redirect('admin/users');
    }

    public function user_delete($id)
    {
        $this->_require_super();
        if ($this->input->method() !== 'post') redirect('admin/users');
        $id = (int)$id;

        if ($id === (int)$this->session->userdata('admin_id')) {
            $this->session->set_flashdata('user_error', 'Vous ne pouvez pas supprimer votre propre compte.');
            redirect('admin/users');
        }

        $user = $this->db->where('id', $id)->get('rsc_admin_users')->row();
        if ($user && $user->role === 'super') {
            $super_count = $this->db->where('role', 'super')->count_all_results('rsc_admin_users');
            if ($super_count <= 1) {
                $this->session->set_flashdata('user_error', 'Impossible de supprimer le dernier Super Administrateur.');
                redirect('admin/users');
            }
        }

        $target = $this->db->where('id', $id)->get('rsc_admin_users')->row();
        $this->db->where('id', $id)->delete('rsc_admin_users');
        $this->_log('user_deleted', 'user', $id, $target ? $target->name : null, ['username' => $target ? $target->username : null]);
        $this->session->set_flashdata('user_success', 'Utilisateur supprimé.');
        redirect('admin/users');
    }

    // ================================================================
    // Helpers privés
    // ================================================================

    // ================================================================
    // JOURNAL D'AUDIT
    // ================================================================

    public function audit()
    {
        $is_super     = (bool)$this->session->userdata('admin_is_super');
        $admin_id     = (int)$this->session->userdata('admin_id');
        $per_page     = 60;
        $page         = max(1, (int)$this->input->get('p'));
        $offset       = ($page - 1) * $per_page;
        $filter_action= $this->input->get('action', TRUE) ?: '';
        $filter_admin = (int)($this->input->get('admin') ?: 0);

        $this->db->from('rsc_audit_log');
        if (!$is_super) {
            $this->db->where('admin_id', $admin_id);
        } elseif ($filter_admin > 0) {
            $this->db->where('admin_id', $filter_admin);
        }
        if ($filter_action) {
            $this->db->where('action', $filter_action);
        }
        $total = $this->db->count_all_results('', FALSE);

        $logs = $this->db->order_by('id', 'DESC')->limit($per_page, $offset)->get()->result();

        $admins = $is_super
            ? $this->db->order_by('name', 'ASC')->get('rsc_admin_users')->result()
            : [];

        $this->_view('audit', [
            'logs'          => $logs,
            'total'         => $total,
            'page'          => $page,
            'per_page'      => $per_page,
            'filter_action' => $filter_action,
            'filter_admin'  => $filter_admin,
            'admins'        => $admins,
            'is_super'      => $is_super,
        ]);
    }

    // ================================================================
    // DEMANDES REÇUES (leads du formulaire de contact)
    // ================================================================

    private function _ensure_leads_table()
    {
        @$this->db->simple_query(
            "CREATE TABLE IF NOT EXISTS rsc_leads (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                name VARCHAR(190) NOT NULL,
                company VARCHAR(190) DEFAULT NULL,
                email VARCHAR(190) NOT NULL,
                phone VARCHAR(50) DEFAULT NULL,
                whatsapp VARCHAR(50) DEFAULT NULL,
                subject VARCHAR(150) DEFAULT NULL,
                message TEXT,
                lang VARCHAR(5) NOT NULL DEFAULT 'fr',
                ip_address VARCHAR(45) DEFAULT NULL,
                status ENUM('nouveau','traite') NOT NULL DEFAULT 'nouveau',
                email_sent TINYINT(1) NOT NULL DEFAULT 0,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                KEY idx_status (status),
                KEY idx_created (created_at)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
        );
    }

    public function leads()
    {
        $this->_ensure_leads_table();

        $per_page = 30;
        $page     = max(1, (int)$this->input->get('p'));
        $offset   = ($page - 1) * $per_page;
        $status   = $this->input->get('status', TRUE) ?: '';
        $q        = trim((string)$this->input->get('q', TRUE));

        $this->db->from('rsc_leads');
        if (in_array($status, ['nouveau', 'traite'], true)) {
            $this->db->where('status', $status);
        }
        if ($q !== '') {
            $this->db->group_start()
                ->like('name', $q)->or_like('email', $q)
                ->or_like('company', $q)->or_like('message', $q)
                ->group_end();
        }
        $total = $this->db->count_all_results('', FALSE);
        $rows  = $this->db->order_by('id', 'DESC')->limit($per_page, $offset)->get()->result();

        $counts = $this->db->query(
            "SELECT COUNT(*) total, SUM(status = 'nouveau') nouveaux FROM rsc_leads"
        )->row();

        $this->_view('leads', [
            'rows'     => $rows,
            'total'    => $total,
            'page'     => $page,
            'per_page' => $per_page,
            'status'   => $status,
            'q'        => $q,
            'counts'   => $counts,
            'success'  => $this->session->flashdata('success'),
        ]);
    }

    public function lead_toggle($id)
    {
        if ($this->input->method() !== 'post') redirect('admin/leads');
        $lead = $this->db->where('id', (int)$id)->get('rsc_leads')->row();
        if ($lead) {
            $new = $lead->status === 'nouveau' ? 'traite' : 'nouveau';
            $this->db->where('id', (int)$id)->update('rsc_leads', ['status' => $new]);
            $this->_log('lead_status', 'lead', $id, $lead->name, ['status' => $new]);
        }
        redirect($this->input->server('HTTP_REFERER') ?: 'admin/leads');
    }

    public function lead_delete($id)
    {
        if ($this->input->method() !== 'post') redirect('admin/leads');
        $lead = $this->db->where('id', (int)$id)->get('rsc_leads')->row();
        if ($lead) {
            $this->db->where('id', (int)$id)->delete('rsc_leads');
            $this->_log('lead_deleted', 'lead', $id, $lead->name);
            $this->session->set_flashdata('success', 'Demande supprimée.');
        }
        redirect('admin/leads');
    }

    // ================================================================
    // STATISTIQUES DE FRÉQUENTATION (internes, anonymes)
    // ================================================================

    public function stats()
    {
        @$this->db->simple_query(
            "CREATE TABLE IF NOT EXISTS rsc_stats (
                day DATE NOT NULL,
                path VARCHAR(180) NOT NULL,
                lang VARCHAR(5) NOT NULL DEFAULT 'fr',
                hits INT UNSIGNED NOT NULL DEFAULT 0,
                PRIMARY KEY (day, path, lang)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
        );
        $this->_ensure_leads_table();

        $today = date('Y-m-d');
        $d7    = date('Y-m-d', strtotime('-6 days'));
        $d30   = date('Y-m-d', strtotime('-29 days'));

        $tot = function ($since) use ($today) {
            $r = $this->db->query(
                'SELECT COALESCE(SUM(hits),0) h FROM rsc_stats WHERE day BETWEEN ? AND ?',
                [$since, $today]
            )->row();
            return (int)$r->h;
        };

        // Série des 30 derniers jours (pour le graphique en barres)
        $series = [];
        for ($i = 29; $i >= 0; $i--) $series[date('Y-m-d', strtotime("-$i days"))] = 0;
        foreach ($this->db->query(
            'SELECT day, SUM(hits) h FROM rsc_stats WHERE day >= ? GROUP BY day', [$d30]
        )->result() as $r) {
            $series[$r->day] = (int)$r->h;
        }

        $top_pages = $this->db->query(
            'SELECT path, SUM(hits) h FROM rsc_stats WHERE day >= ? GROUP BY path ORDER BY h DESC LIMIT 12',
            [$d30]
        )->result();

        $langs = $this->db->query(
            'SELECT lang, SUM(hits) h FROM rsc_stats WHERE day >= ? GROUP BY lang ORDER BY h DESC',
            [$d30]
        )->result();

        $leads_counts = $this->db->query(
            "SELECT COUNT(*) total, SUM(status = 'nouveau') nouveaux,
                    SUM(created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)) recent
             FROM rsc_leads"
        )->row();

        $this->_view('stats', [
            'today'        => $tot($today),
            'week'         => $tot($d7),
            'month'        => $tot($d30),
            'series'       => $series,
            'top_pages'    => $top_pages,
            'langs'        => $langs,
            'leads_counts' => $leads_counts,
        ]);
    }

    // ================================================================
    // TRADUCTIONS (FR -> EN)
    // ================================================================

    public function translations()
    {
        $this->load->library('rsc_translator');

        $per_page = 50;
        $page     = max(1, (int)$this->input->get('p'));
        $offset   = ($page - 1) * $per_page;
        $q        = trim((string)$this->input->get('q', TRUE));
        $status   = $this->input->get('status', TRUE) ?: '';

        $this->db->from('rsc_translations')->where('lang', 'en');
        if ($q !== '') {
            $this->db->group_start()
                ->like('source_text', $q)
                ->or_like('translated_text', $q)
                ->group_end();
        }
        if ($status === 'pending') {
            $this->db->group_start()
                ->where('translated_text IS NULL', NULL, FALSE)
                ->or_where('translated_text', '')
                ->group_end();
        } elseif (in_array($status, ['auto', 'manual'], true)) {
            $this->db->where('status', $status);
        }
        $total = $this->db->count_all_results('', FALSE);
        $rows  = $this->db->order_by('updated_at', 'DESC')
                          ->limit($per_page, $offset)->get()->result();

        $this->_view('translations', [
            'rows'     => $rows,
            'total'    => $total,
            'page'     => $page,
            'per_page' => $per_page,
            'q'        => $q,
            'status'   => $status,
            'stats'    => $this->rsc_translator->stats('en'),
            'success'  => $this->session->flashdata('success'),
            'error'    => $this->session->flashdata('error'),
        ]);
    }

    public function translation_save()
    {
        if ($this->input->method() !== 'post') redirect('admin/translations');

        $id   = (int)$this->input->post('id');
        $text = trim((string)$this->input->post('translated_text', FALSE));

        $row = $this->db->where('id', $id)->where('lang', 'en')->get('rsc_translations')->row();
        if (!$row) {
            $this->session->set_flashdata('error', 'Traduction introuvable.');
            redirect('admin/translations');
        }

        if ($text === '') {
            // Vider = repasser en attente de traduction automatique
            $this->db->where('id', $id)->update('rsc_translations', [
                'translated_text' => null,
                'status'          => 'pending',
            ]);
        } else {
            $this->db->where('id', $id)->update('rsc_translations', [
                'translated_text' => $text,
                'status'          => 'manual',
            ]);
        }

        $this->_log('translation_saved', 'translation', $id, mb_substr($row->source_text, 0, 80));
        $this->session->set_flashdata('success', 'Traduction enregistrée.');
        redirect('admin/translations?' . http_build_query([
            'q'      => $this->input->post('back_q', TRUE),
            'status' => $this->input->post('back_status', TRUE),
            'p'      => (int)$this->input->post('back_p'),
        ]));
    }

    public function translation_delete($id)
    {
        if ($this->input->method() !== 'post') redirect('admin/translations');
        $row = $this->db->where('id', (int)$id)->get('rsc_translations')->row();
        if ($row) {
            $this->db->where('id', (int)$id)->delete('rsc_translations');
            $this->_log('translation_deleted', 'translation', $id, mb_substr($row->source_text, 0, 80));
            $this->session->set_flashdata('success', 'Entrée supprimée — elle sera retraduite automatiquement au prochain affichage.');
        }
        redirect('admin/translations');
    }

    public function translations_run()
    {
        if ($this->input->method() !== 'post') redirect('admin/translations');
        $this->load->library('rsc_translator');
        $r = $this->rsc_translator->translate_missing(200);
        $this->_log('translations_run', 'translation', null, null, $r);
        if ($r['done'] > 0) {
            $msg = $r['done'] . ' texte(s) traduit(s) automatiquement.';
            if ($r['remaining'] > 0) $msg .= ' Reste ' . $r['remaining'] . ' en attente — relancez.';
            $this->session->set_flashdata('success', $msg);
        } elseif ($r['failed'] > 0) {
            $this->session->set_flashdata('error',
                'Le service de traduction est injoignable pour le moment (' . $r['failed'] . ' échec(s)). Réessayez plus tard.');
        } else {
            $this->session->set_flashdata('success', 'Aucun texte en attente — tout est déjà traduit.');
        }
        redirect('admin/translations');
    }

    // ================================================================
    // Helpers privés
    // ================================================================

    private function _require_super()
    {
        if ($this->session->userdata('admin_role') !== 'super') {
            show_error('Accès refusé. Cette section est réservée au Super Administrateur.', 403, 'Accès refusé');
        }
    }

    private function _log($action, $entity_type = null, $entity_id = null, $entity_label = null, $details = null)
    {
        $this->db->insert('rsc_audit_log', [
            'admin_id'     => $this->session->userdata('admin_id'),
            'admin_name'   => $this->session->userdata('admin_name'),
            'action'       => $action,
            'entity_type'  => $entity_type,
            'entity_id'    => ($entity_id !== null) ? (string)$entity_id : '',
            'entity_label' => $entity_label,
            'details'      => ($details !== null) ? json_encode($details, JSON_UNESCAPED_UNICODE) : null,
            'ip_address'   => $this->input->ip_address(),
            'user_agent'   => substr($this->input->user_agent(), 0, 255),
        ]);
    }

    private function _view($view, $data = [])
    {
        $data['page_defs']       = $this->page_defs;
        $data['admin_name']      = $this->session->userdata('admin_name');
        $data['admin_is_super']  = (bool)$this->session->userdata('admin_is_super');
        $data['view_content']    = 'admin/' . $view;

        // Badge « nouvelles demandes » dans la sidebar (0 si table absente)
        try {
            $data['leads_new_count'] = (int)$this->db
                ->query("SELECT COUNT(*) c FROM rsc_leads WHERE status = 'nouveau'")
                ->row()->c;
        } catch (Throwable $e) {
            $data['leads_new_count'] = 0;
        }

        $this->load->view('admin/layout', $data);
    }
}
