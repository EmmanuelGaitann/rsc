<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Page 404 aux couleurs du site — bilingue (lit le cookie de langue,
// car les pages d'erreur ne passent pas par le pipeline de traduction).
$_lang = (isset($_COOKIE['rsc_lang']) && $_COOKIE['rsc_lang'] === 'en') ? 'en' : 'fr';
$_t = [
    'fr' => [
        'title'    => 'Page introuvable — Royal Sales Cameroon',
        'code_lbl' => 'Erreur 404',
        'heading'  => 'Cette page est introuvable',
        'text'     => "La page que vous cherchez n'existe pas, a été déplacée ou n'est plus disponible.",
        'home'     => "Retour à l'accueil",
        'products' => 'Voir nos produits',
        'contact'  => 'Nous contacter',
    ],
    'en' => [
        'title'    => 'Page not found — Royal Sales Cameroon',
        'code_lbl' => 'Error 404',
        'heading'  => 'This page cannot be found',
        'text'     => 'The page you are looking for does not exist, has been moved or is no longer available.',
        'home'     => 'Back to homepage',
        'products' => 'View our products',
        'contact'  => 'Contact us',
    ],
];
$_s = $_t[$_lang];

// Base URL sans dépendre du framework (page d'erreur autonome)
$_scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$_host   = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'www.rsc-cameroon.com';
$_dir    = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])) : '/';
$_base   = $_scheme . '://' . $_host . rtrim($_dir, '/') . '/';
?>
<!DOCTYPE html>
<html lang="<?= $_lang ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex">
<title><?= $_s['title'] ?></title>
<link rel="icon" type="image/x-icon" href="<?= $_base ?>assets/logo/Logo_gold_RSC.png">
<style>
  * { margin:0; padding:0; box-sizing:border-box; }
  body {
    font-family: 'Segoe UI', 'Inter', Arial, sans-serif;
    min-height: 100vh;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, #1e2838 0%, #2c3749 55%, #1D67CD 160%);
    color: #fff; padding: 2rem; text-align: center;
  }
  .box { max-width: 560px; }
  .logo { height: 64px; margin-bottom: 2rem; }
  .code {
    display: inline-block; padding: 0.3rem 1.1rem; border-radius: 50px;
    background: rgba(209,171,106,0.15); border: 1px solid rgba(209,171,106,0.5);
    color: #d1ab6a; font-size: 0.78rem; font-weight: 700;
    letter-spacing: 0.12em; text-transform: uppercase; margin-bottom: 1.2rem;
  }
  .num {
    font-size: clamp(5rem, 16vw, 8rem); font-weight: 900; line-height: 1;
    background: linear-gradient(180deg, #ffffff 20%, #d1ab6a 100%);
    -webkit-background-clip: text; background-clip: text; color: transparent;
    margin-bottom: 0.6rem;
  }
  h1 { font-size: clamp(1.2rem, 3.4vw, 1.7rem); font-weight: 700; margin-bottom: 0.8rem; }
  p  { color: rgba(255,255,255,0.65); line-height: 1.7; margin-bottom: 2rem; font-size: 0.98rem; }
  .actions { display: flex; gap: 0.8rem; justify-content: center; flex-wrap: wrap; }
  .btn {
    display: inline-block; padding: 0.8rem 1.6rem; border-radius: 8px;
    font-weight: 700; font-size: 0.9rem; text-decoration: none; transition: all 0.2s;
  }
  .btn-primary { background: #1D67CD; color: #fff; }
  .btn-primary:hover { background: #1554B0; }
  .btn-outline { border: 1.5px solid rgba(255,255,255,0.35); color: #fff; }
  .btn-outline:hover { background: rgba(255,255,255,0.1); }
</style>
</head>
<body>
  <div class="box">
    <img src="<?= $_base ?>assets/logo/Logo_gold_RSC.png" alt="Royal Sales Cameroon" class="logo"
         onerror="this.style.display='none'">
    <div>
      <span class="code"><?= $_s['code_lbl'] ?></span>
    </div>
    <div class="num">404</div>
    <h1><?= $_s['heading'] ?></h1>
    <p><?= $_s['text'] ?></p>
    <div class="actions">
      <a class="btn btn-primary" href="<?= $_base ?>"><?= $_s['home'] ?></a>
      <a class="btn btn-outline" href="<?= $_base ?>produits"><?= $_s['products'] ?></a>
      <a class="btn btn-outline" href="<?= $_base ?>contact"><?= $_s['contact'] ?></a>
    </div>
  </div>
</body>
</html>
