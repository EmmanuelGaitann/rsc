<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';

/* --- Admin CMS --- */
$route['admin']                       = 'admin/index';
$route['admin/login']                 = 'admin/login';
$route['admin/do_login']              = 'admin/do_login';
$route['admin/logout']                = 'admin/logout';
$route['admin/setup']                 = 'admin/setup';
$route['admin/do_setup']              = 'admin/do_setup';
$route['admin/page/(:any)']           = 'admin/page/$1';
$route['admin/save_blocks']           = 'admin/save_blocks';
$route['admin/media']                 = 'admin/media';
$route['admin/media_json']            = 'admin/media_json';
$route['admin/upload_media']          = 'admin/upload_media';
$route['admin/delete_media/(:num)']   = 'admin/delete_media/$1';
$route['admin/password']              = 'admin/password';
$route['admin/save_password']         = 'admin/save_password';
$route['admin/inline_save']           = 'admin/inline_save';
$route['admin/toggle_section']        = 'admin/toggle_section';
$route['admin/pages']                 = 'admin/pages';
$route['admin/pages/new']             = 'admin/new_page';
$route['admin/do_new_page']           = 'admin/do_new_page';
$route['admin/pages/edit/(:num)']     = 'admin/edit_page_custom/$1';
$route['admin/pages/save/(:num)']     = 'admin/save_page_custom/$1';
$route['admin/pages/delete/(:num)']   = 'admin/delete_page_custom/$1';

/* --- Admin Produits --- */
$route['admin/products']               = 'admin/products';
$route['admin/product_new']            = 'admin/product_new';
$route['admin/product_do_new']         = 'admin/product_do_new';
$route['admin/product_edit/(:num)']    = 'admin/product_edit/$1';
$route['admin/product_do_edit/(:num)'] = 'admin/product_do_edit/$1';
$route['admin/product_delete/(:num)']  = 'admin/product_delete/$1';
$route['admin/product_toggle/(:num)']  = 'admin/product_toggle/$1';

/* --- Admin Fabricants --- */
$route['admin/brands']                   = 'admin/brands';
$route['admin/brand_new']                = 'admin/brand_new';
$route['admin/brand_do_new']             = 'admin/brand_do_new';
$route['admin/brand_edit/(:num)']        = 'admin/brand_edit/$1';
$route['admin/brand_do_edit/(:num)']     = 'admin/brand_do_edit/$1';
$route['admin/brand_delete/(:num)']      = 'admin/brand_delete/$1';

/* --- Admin Catégories --- */
$route['admin/categories']               = 'admin/categories';
$route['admin/category_new']             = 'admin/category_new';
$route['admin/category_do_new']          = 'admin/category_do_new';
$route['admin/category_edit/(:num)']     = 'admin/category_edit/$1';
$route['admin/category_do_edit/(:num)']  = 'admin/category_do_edit/$1';
$route['admin/category_delete/(:num)']   = 'admin/category_delete/$1';

/* --- Admin Galerie --- */
$route['admin/gallery']                  = 'admin/gallery';
$route['admin/gallery_new']              = 'admin/gallery_new';
$route['admin/gallery_do_new']           = 'admin/gallery_do_new';
$route['admin/gallery_edit/(:num)']      = 'admin/gallery_edit/$1';
$route['admin/gallery_do_edit/(:num)']   = 'admin/gallery_do_edit/$1';
$route['admin/gallery_delete/(:num)']    = 'admin/gallery_delete/$1';
$route['admin/gallery_toggle/(:num)']    = 'admin/gallery_toggle/$1';

/* --- Admin Traductions --- */
$route['admin/documents']                = 'admin/documents';
$route['admin/document_new']             = 'admin/document_new';
$route['admin/document_do_new']          = 'admin/document_do_new';
$route['admin/document_edit/(:num)']     = 'admin/document_edit/$1';
$route['admin/document_do_edit/(:num)']  = 'admin/document_do_edit/$1';
$route['admin/document_delete/(:num)']   = 'admin/document_delete/$1';
$route['admin/document_toggle/(:num)']   = 'admin/document_toggle/$1';
$route['admin/upload_document']          = 'admin/upload_document';

$route['admin/translations']             = 'admin/translations';
$route['admin/translation_save']         = 'admin/translation_save';
$route['admin/translation_delete/(:num)']= 'admin/translation_delete/$1';
$route['admin/translations_run']         = 'admin/translations_run';

/* --- Admin Suivi (demandes + statistiques) --- */
$route['admin/leads']                    = 'admin/leads';
$route['admin/lead_toggle/(:num)']       = 'admin/lead_toggle/$1';
$route['admin/lead_delete/(:num)']       = 'admin/lead_delete/$1';
$route['admin/stats']                    = 'admin/stats';

$route['p/(:any)']                    = 'pages/view/$1';

$route['a-propos']                      = 'about/index';
$route['produits']                      = 'products/index';
$route['produit/(:num)']                = 'products/fiche/$1';
$route['produit/(:num)/(:any)']         = 'products/fiche/$1';
$route['services']                      = 'services/index';
$route['expertise']                     = 'expertise/index';
$route['contact']                       = 'contact/index';
$route['contact/envoyer']               = 'contact/envoyer';
$route['galerie']                       = 'gallery/index';
$route['partenaires/ingersoll-rand']    = 'partners/ingersoll_rand';
$route['partenaires/renner']            = 'partners/renner';
$route['partenaires/cas-lubrifiants']   = 'partners/cas_lubricants';
$route['mentions-legales']              = 'legal/index';

// Documents téléchargeables servis depuis la base (table rsc_documents)
$route['telechargement/(:num)']         = 'documents/download/$1';
$route['telechargement/(:num)/(:any)']  = 'documents/download/$1/$2';

$route['sitemap.xml']  = 'sitemap/index';
$route['sitemap']      = 'sitemap/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
