<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/hooks.html
|
*/

/*
| Traduction automatique du site (FR -> EN).
| 1. detect_lang : lit ?lang=xx ou le cookie rsc_lang et mémorise la langue
|    demandée pour toute la requête.
| 2. translate_output : si la langue demandée n'est pas le français, la page
|    HTML générée est traduite côté serveur (cache en base rsc_translations,
|    complété automatiquement par traduction automatique). Couvre TOUS les
|    textes, y compris ceux créés ou modifiés via le dashboard admin.
*/
$hook['post_controller_constructor'][] = array(
	'class'    => 'Rsc_lang_hook',
	'function' => 'detect_lang',
	'filename' => 'Rsc_lang_hook.php',
	'filepath' => 'hooks',
);

$hook['post_controller'][] = array(
	'class'    => 'Rsc_lang_hook',
	'function' => 'translate_output',
	'filename' => 'Rsc_lang_hook.php',
	'filepath' => 'hooks',
);

/*
| Statistiques de fréquentation internes (anonymes : jour + page + langue,
| aucun cookie ni donnée personnelle) — voir Admin → Statistiques.
*/
$hook['post_controller'][] = array(
	'class'    => 'Rsc_lang_hook',
	'function' => 'log_stats',
	'filename' => 'Rsc_lang_hook.php',
	'filepath' => 'hooks',
);
