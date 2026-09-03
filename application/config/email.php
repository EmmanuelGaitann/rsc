<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 | -----------------------------------------------------------------------
 | EMAIL CONFIG — RSC Cameroun
 | -----------------------------------------------------------------------
 |
 | OPTION A : Gmail (App Password)
 |   1. Activez la vérification en 2 étapes sur votre compte Google
 |   2. Allez sur : myaccount.google.com > Sécurité > Mots de passe des applis
 |   3. Générez un mot de passe pour "Autre" → nommez-le "RSC CI"
 |   4. Copiez les 16 caractères générés dans smtp_pass ci-dessous
 |
 | OPTION B : @rsc-cameroon.com (hébergement mutualisé cPanel)
 |   Commentez le bloc A et décommentez le bloc B ci-dessous.
 |
 | from_email doit correspondre exactement à smtp_user pour éviter
 | que le message parte en spam.
 */

/* ---- OPTION A : Gmail -------------------------------------------- */
$config['protocol']    = 'smtp';
$config['smtp_host']   = 'smtp.gmail.com';
$config['smtp_port']   = 587;
$config['smtp_crypto'] = 'tls';
$config['smtp_user']   = 'votre-adresse@gmail.com';   // ← à remplacer
$config['smtp_pass']   = 'xxxx xxxx xxxx xxxx';        // ← App Password 16 car.
$config['from_email']  = 'votre-adresse@gmail.com';   // ← même adresse
$config['from_name']   = 'RSC Cameroun';

/* ---- OPTION B : @rsc-cameroon.com (décommenter pour activer) ------ */
// $config['protocol']    = 'smtp';
// $config['smtp_host']   = 'mail.rsc-cameroon.com';
// $config['smtp_port']   = 587;                        // ou 465 si port 587 bloqué
// $config['smtp_crypto'] = 'tls';                      // ou 'ssl' si port 465
// $config['smtp_user']   = 'contact@rsc-cameroon.com'; // ← à remplacer
// $config['smtp_pass']   = 'mot-de-passe-cpanel';      // ← mot de passe email cPanel
// $config['from_email']  = 'contact@rsc-cameroon.com'; // ← même adresse
// $config['from_name']   = 'RSC Cameroun';

/* ---- Paramètres communs (ne pas modifier) ------------------------- */
$config['mailtype']    = 'html';
$config['charset']     = 'utf-8';
$config['newline']     = "\r\n";
$config['crlf']        = "\r\n";
$config['wordwrap']    = TRUE;
