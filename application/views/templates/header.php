<?php
$CI           =& get_instance();
$cms_is_admin = (bool)$CI->session->userdata('admin_id');
$CI->load->model('content_model');
$CI->load->model('Pages_model');
$g            = $CI->content_model->get_page('global');
$cms_page_key = isset($cms_page) ? $cms_page : '';

$custom_nav = $CI->Pages_model->get_nav_items();

$nav_keys_def = [
    'home'      => ['label' => 'Accueil',   'url' => ''],
    'about'     => ['label' => 'À propos',  'url' => 'a-propos'],
    'products'  => ['label' => 'Produits',  'url' => 'produits'],
    'services'  => ['label' => 'Services',  'url' => 'services'],
    'expertise' => ['label' => 'Expertise', 'url' => 'expertise'],
    'gallery'   => ['label' => 'Galerie',   'url' => 'galerie'],
    'contact'   => ['label' => 'Contact',   'url' => 'contact'],
];
$nav_hidden = [];
foreach ($nav_keys_def as $k => $def) {
    $vis_key = 'section_nav_' . $k . '_visible';
    $nav_hidden[$k] = isset($g[$vis_key]) && $g[$vis_key] === '0';
}

if (!function_exists('_gv')) { function _gv($g, $k, $d) { return (isset($g[$k]) && $g[$k] !== '') ? htmlspecialchars($g[$k]) : $d; } }

// ── SEO ──────────────────────────────────────────────────────
$_seo_kw = [
    'home'            => 'compresseur industriel Cameroun, compresseur RENNER Douala, Ingersoll Rand Cameroun, RSC Cameroon, Royal Sales Cameroon, compresseur à vis Douala, maintenance compresseur Cameroun, pièces compresseur Douala, vendeur compresseur Cameroun, fournisseur air comprimé Afrique',
    'about'           => 'Royal Sales Cameroon, RSC Cameroon, distributeur agréé RENNER Cameroun, compresseur industriel Afrique Centrale, société compresseur Douala, historique RSC',
    'products'        => 'achat compresseur industriel Cameroun, catalogue compresseur RENNER, Ingersoll Rand prix Cameroun, compresseur à vis, compresseur sans huile, compresseur à piston Douala, pièces détachées compresseur',
    'services'        => 'maintenance compresseur Cameroun, contrat maintenance compresseur, réparation compresseur Douala, audit air comprimé, SAV compresseur, dépannage compresseur urgence',
    'expertise'       => 'expertise compresseur Cameroun, technicien compresseur, actualités air comprimé Afrique, solutions air comprimé industriel',
    'gallery'         => 'galerie Royal Sales Cameroon, installations compresseur Cameroun, chantiers RSC, réalisations compresseur Douala',
    'contact'         => 'contacter Royal Sales Cameroon, devis compresseur Cameroun, contact RSC Douala, téléphone compresseur Douala, adresse RSC Cameroun',
    'partners_renner' => 'RENNER Kompressoren Cameroun, distributeur RENNER Afrique Centrale, compresseur RENNER prix, RENNER RSC Cameroun, compresseur allemand Douala',
    'partners_ir'     => 'Ingersoll Rand Cameroun, distributeur Ingersoll Rand Afrique, compresseur Ingersoll Rand Douala, IR Cameroun',
    'partners_cas'    => 'huile CAS Lubricants Cameroun, lubrifiant compresseur Douala, huile compresseur industriel Cameroun',
    'legal'           => 'mentions légales Royal Sales Cameroon, politique confidentialité RSC',
];
$_kw      = $_seo_kw[$cms_page_key] ?? 'compresseur industriel Cameroun, Royal Sales Cameroon, RSC Cameroon, RENNER Kompressoren, Ingersoll Rand Douala, vendeur compresseur Afrique';
$_t_raw   = isset($title) && $title ? $title : '';
$_seo_t   = $_t_raw
    ? htmlspecialchars($_t_raw . ' | Royal Sales Cameroon — Douala, Cameroun')
    : 'Royal Sales Cameroon (RSC) | Compresseurs Industriels RENNER & Ingersoll Rand — Douala';
$_seo_d   = (isset($meta_desc) && $meta_desc)
    ? htmlspecialchars($meta_desc)
    : 'Royal Sales Cameroon (RSC) — Distributeur agréé RENNER Kompressoren & Ingersoll Rand au Cameroun. Vente, installation et maintenance de compresseurs industriels à Douala.';
$_og_img  = (isset($g['og_image']) && $g['og_image']) ? base_url($g['og_image']) : base_url('assets/logo/Logo_gold_RSC.png');
$_site_url = rtrim(base_url(), '/');
// Schema.org phone/address from CMS or fallback
$_sc_phone = (isset($g['footer_phone1']) && $g['footer_phone1']) ? preg_replace('/\s+/', '', $g['footer_phone1']) : '+237691123112';
$_sc_email = (isset($g['footer_email'])  && $g['footer_email'])  ? $g['footer_email'] : 'info@rsc-cameroon.com';
$_sc_addr  = (isset($g['footer_address']) && $g['footer_address']) ? $g['footer_address'] : '739 rue Richard Bell, Nouvelle route Bonadibong - Akwa';
$_sc_fb    = (isset($g['footer_fb']) && $g['footer_fb']) ? $g['footer_fb'] : 'https://www.facebook.com/profile.php?id=100093512901441';
$_sc_li    = (isset($g['footer_li']) && $g['footer_li']) ? $g['footer_li'] : 'https://www.linkedin.com/in/rsc-cameroon-sarl-215392364/';
$_sc_ig    = (isset($g['footer_ig']) && $g['footer_ig']) ? $g['footer_ig'] : 'https://www.instagram.com/rscameroon/';
?>
<!DOCTYPE html>
<html lang="fr" prefix="og: https://ogp.me/ns#">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="<?= $_site_url ?>/assets/logo/Logo_gold_RSC.png">
  <!-- ── Primary SEO ──────────────────────────────────────── -->
  <title><?= $_seo_t ?></title>
  <meta name="title"       content="<?= $_seo_t ?>">
  <meta name="description" content="<?= $_seo_d ?>">
  <meta name="keywords"    content="<?= htmlspecialchars($_kw) ?>">
  <meta name="robots"      content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
  <meta name="language"    content="French">
  <meta name="author"      content="Royal Sales Cameroon SARL">
  <meta name="geo.region"  content="CM-LT">
  <meta name="geo.placename" content="Douala, Cameroun">
  <meta name="geo.position"  content="4.0511;9.7679">
  <meta name="ICBM"          content="4.0511, 9.7679">
  <link rel="canonical"    href="<?= htmlspecialchars(current_url()) ?>">

  <!-- ── Open Graph / Facebook ────────────────────────────── -->
  <meta property="og:type"        content="<?= $cms_page_key === 'products' ? 'website' : 'website' ?>">
  <meta property="og:url"         content="<?= htmlspecialchars(current_url()) ?>">
  <meta property="og:title"       content="<?= $_seo_t ?>">
  <meta property="og:description" content="<?= $_seo_d ?>">
  <meta property="og:image"       content="<?= htmlspecialchars($_og_img) ?>">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:locale"      content="fr_CM">
  <meta property="og:site_name"   content="Royal Sales Cameroon">

  <!-- ── Twitter Card ─────────────────────────────────────── -->
  <meta name="twitter:card"        content="summary_large_image">
  <meta name="twitter:title"       content="<?= $_seo_t ?>">
  <meta name="twitter:description" content="<?= $_seo_d ?>">
  <meta name="twitter:image"       content="<?= htmlspecialchars($_og_img) ?>">

  <!-- ── Schema.org — LocalBusiness ──────────────────────── -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "@id": "<?= $_site_url ?>/#business",
    "name": "Royal Sales Cameroon",
    "alternateName": ["RSC Cameroon", "RSC", "Royal Sales"],
    "description": "Distributeur agréé RENNER Kompressoren et Ingersoll Rand au Cameroun. Vente, installation et maintenance de compresseurs industriels à Douala et en Afrique Centrale.",
    "url": "<?= $_site_url ?>",
    "telephone": "<?= htmlspecialchars($_sc_phone) ?>",
    "email": "<?= htmlspecialchars($_sc_email) ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "<?= htmlspecialchars($_sc_addr) ?>",
      "addressLocality": "Douala",
      "addressRegion": "Littoral",
      "addressCountry": "CM"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": 4.0511,
      "longitude": 9.7679
    },
    "openingHoursSpecification": [{
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
      "opens": "08:00",
      "closes": "18:00"
    }],
    "image": "<?= htmlspecialchars($_og_img) ?>",
    "logo": {
      "@type": "ImageObject",
      "url": "<?= $_site_url ?>/assets/logo/Logo_gold_RSC.png"
    },
    "priceRange": "$$",
    "currenciesAccepted": "XAF, EUR",
    "paymentAccepted": "Cash, Virement bancaire, Chèque",
    "areaServed": [
      {"@type": "Country", "name": "Cameroun"},
      {"@type": "AdministrativeArea", "name": "Afrique Centrale"},
      {"@type": "AdministrativeArea", "name": "CEMAC"}
    ],
    "hasOfferCatalog": {
      "@type": "OfferCatalog",
      "name": "Compresseurs Industriels",
      "itemListElement": [
        {"@type": "Offer", "itemOffered": {"@type": "Product", "name": "Compresseurs à vis RENNER"}},
        {"@type": "Offer", "itemOffered": {"@type": "Product", "name": "Compresseurs Ingersoll Rand"}},
        {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Maintenance compresseurs industriels"}},
        {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Audit air comprimé"}}
      ]
    },
    "sameAs": [
      "<?= htmlspecialchars($_sc_fb) ?>",
      "<?= htmlspecialchars($_sc_li) ?>",
      "<?= htmlspecialchars($_sc_ig) ?>"
    ]
  }
  </script>

  <!-- ── Styles ────────────────────────────────────────────── -->
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
  <?php if ($cms_is_admin): ?>
  <link rel="stylesheet" href="<?= base_url('assets/admin/inline-edit.css') ?>">
  <?php endif; ?>
  <!-- Polices et icônes auto-hébergées (aucune requête vers des serveurs tiers — RGPD) -->
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/fonts.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>">
  <?= isset($extra_css) ? $extra_css : '' ?>
</head>
<body <?= $cms_is_admin ? 'class="cms-admin"' : '' ?> data-cms-page="<?= isset($cms_page) ? htmlspecialchars($cms_page) : '' ?>">

<?php if ($cms_is_admin): ?>
<div id="cms-toolbar">
  <div class="cms-tb-inner">
    <span class="cms-tb-brand"><i class="fa-solid fa-bolt"></i> RSC Admin</span>
    <div class="cms-tb-sep"></div>
    <button id="cms-edit-toggle" onclick="cmsToggleEdit()">
      <i class="fa-solid fa-pencil"></i> Mode Édition
    </button>
    <?php if (!empty($cms_page)): ?>
    <a href="<?= base_url('admin/page/' . $cms_page) ?>" class="cms-tb-link" target="_blank">
      <i class="fa-solid fa-gear"></i> Panneau complet
    </a>
    <?php endif; ?>
    <button type="button" class="cms-tb-newpage" onclick="cmsOpenNavManager()">
      <i class="fa-solid fa-bars"></i> Gérer le menu
    </button>
    <a href="<?= base_url('admin/media') ?>" class="cms-tb-link">
      <i class="fa-solid fa-images"></i> Médias
    </a>
    <a href="<?= base_url('admin') ?>" class="cms-tb-link">
      <i class="fa-solid fa-gauge-high"></i> Dashboard
    </a>
    <a href="<?= base_url('admin/logout') ?>" class="cms-tb-link danger">
      <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
    </a>
  </div>
</div>

<!-- ── Nav Manager Modal ──────────────────────────────────────── -->
<div id="cms-nav-manager" class="cms-nav-mgr-backdrop" style="display:none">
  <div class="cms-nav-mgr-box">

    <div class="cms-nav-mgr-head">
      <div class="cms-nav-mgr-title">
        <i class="fa-solid fa-bars"></i> Gestion du menu
      </div>
      <button class="cms-nav-mgr-close" onclick="cmsCloseNavManager()" aria-label="Fermer">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <div class="cms-nav-mgr-body">

      <p class="cms-nav-mgr-section-label">Liens intégrés</p>
      <div class="cms-nav-mgr-list">
        <?php foreach ($nav_keys_def as $k => $def):
          $hidden = $nav_hidden[$k]; ?>
        <div class="cms-nav-mgr-row <?= $hidden ? 'is-hidden' : '' ?>" id="cms-nav-row-<?= $k ?>">
          <div class="cms-nav-mgr-row-info">
            <i class="fa-solid <?= $hidden ? 'fa-eye-slash' : 'fa-eye' ?>" id="cms-nav-ico-<?= $k ?>"></i>
            <span id="cms-nav-lbl-<?= $k ?>"><?= htmlspecialchars($def['label']) ?></span>
          </div>
          <button class="cms-nav-mgr-toggle <?= $hidden ? 'show' : 'hide' ?>"
                  id="cms-nav-btn-<?= $k ?>"
                  onclick="cmsToggleNavItem('<?= $k ?>', '<?= $hidden ? '1' : '0' ?>')">
            <?= $hidden ? 'Afficher' : 'Masquer' ?>
          </button>
        </div>
        <?php endforeach; ?>
      </div>

      <?php if (!empty($custom_nav)): ?>
      <p class="cms-nav-mgr-section-label" style="margin-top:1.25rem;">Pages personnalisées</p>
      <div class="cms-nav-mgr-list">
        <?php foreach ($custom_nav as $cn): ?>
        <div class="cms-nav-mgr-row">
          <div class="cms-nav-mgr-row-info">
            <i class="fa-solid fa-link" style="color:#94a3b8;"></i>
            <span><?= htmlspecialchars($cn->nav_label ?: $cn->title) ?></span>
            <span class="cms-nav-mgr-slug">/p/<?= htmlspecialchars($cn->slug) ?></span>
          </div>
          <a href="<?= base_url('admin/edit_page_custom/' . $cn->id) ?>" class="cms-nav-mgr-edit">Modifier</a>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

    </div>

    <div class="cms-nav-mgr-foot">
      <a href="<?= base_url('admin/pages') ?>" class="cms-nav-mgr-add-btn">
        <i class="fa-solid fa-plus"></i> Ajouter un nouveau lien
      </a>
      <p class="cms-nav-mgr-hint">Les pages créées avec "Afficher dans le menu" apparaissent automatiquement.</p>
    </div>

  </div>
</div>
<?php endif; ?>

<nav id="main-nav">
  <div class="nav-inner">

    <!-- Logo -->
    <a href="<?= base_url() ?>" class="nav-logo">
      <img src="<?= (isset($g['nav_logo']) && $g['nav_logo']) ? base_url($g['nav_logo']) : base_url('assets/logo/Logo_gold_RSC.png') ?>"
           alt="Royal Sales Cameroon"
           <?= cms_field_attrs('nav_logo', 'image', 'Logo navigation', isset($g['nav_logo']) ? $g['nav_logo'] : '', 'global') ?>
           onerror="this.style.display=\'none\'; this.parentElement.innerHTML=\'<span class=&quot;nav-logo-text&quot;>Royal Sales Cameroon</span>\'">
    </a>

    <!-- Desktop links -->
    <ul class="nav-links">
      <?php if ($cms_is_admin || !$nav_hidden['home']): ?>
      <li <?= ($cms_is_admin && $nav_hidden['home']) ? 'class="nav-item-hidden-admin" title="Masqué aux visiteurs"' : '' ?>>
        <a href="<?= base_url() ?>" class="<?= $cms_page_key === 'home' ? 'active' : '' ?>">
          <?php if ($cms_is_admin && $nav_hidden['home']): ?><i class="fa-solid fa-eye-slash" style="font-size:0.65em;opacity:0.5;margin-right:3px;"></i><?php endif; ?>
          <span <?= cms_field_attrs('nav_home', 'text', 'Menu — Accueil', isset($g['nav_home']) ? $g['nav_home'] : '', 'global') ?>><?= _gv($g,'nav_home','Accueil') ?></span>
        </a>
      </li>
      <?php endif; ?>

      <?php if ($cms_is_admin || !$nav_hidden['about']): ?>
      <li <?= ($cms_is_admin && $nav_hidden['about']) ? 'class="nav-item-hidden-admin" title="Masqué aux visiteurs"' : '' ?>>
        <a href="<?= base_url('a-propos') ?>" class="<?= $cms_page_key === 'about' ? 'active' : '' ?>">
          <?php if ($cms_is_admin && $nav_hidden['about']): ?><i class="fa-solid fa-eye-slash" style="font-size:0.65em;opacity:0.5;margin-right:3px;"></i><?php endif; ?>
          <span <?= cms_field_attrs('nav_about', 'text', 'Menu — À propos', isset($g['nav_about']) ? $g['nav_about'] : '', 'global') ?>><?= _gv($g,'nav_about','À propos') ?></span>
        </a>
      </li>
      <?php endif; ?>

      <?php if ($cms_is_admin || !$nav_hidden['products']): ?>
      <li class="nav-dropdown<?= ($cms_is_admin && $nav_hidden['products']) ? ' nav-item-hidden-admin' : '' ?>" <?= ($cms_is_admin && $nav_hidden['products']) ? 'title="Masqué aux visiteurs"' : '' ?>>
        <a href="<?= base_url('produits') ?>" class="<?= in_array($cms_page_key, ['products','partners_renner','partners_ir','partners_cas']) ? 'active' : '' ?>">
          <?php if ($cms_is_admin && $nav_hidden['products']): ?><i class="fa-solid fa-eye-slash" style="font-size:0.65em;opacity:0.5;margin-right:3px;"></i><?php endif; ?>
          <span <?= cms_field_attrs('nav_products', 'text', 'Menu — Produits', isset($g['nav_products']) ? $g['nav_products'] : '', 'global') ?>><?= _gv($g,'nav_products','Produits') ?></span>
          <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
        </a>
        <ul class="nav-dropdown-menu">
          <li>
            <a href="<?= base_url('partenaires/renner') ?>" class="<?= $cms_page_key === 'partners_renner' ? 'active' : '' ?>">
              <span class="nav-dropdown-icon" style="color:#008d8e;"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/></svg></span>
              <span style="font-weight:600;" <?= cms_field_attrs('nav_partner_renner', 'text', 'Menu — RENNER Kompressoren', isset($g['nav_partner_renner']) ? $g['nav_partner_renner'] : '', 'global') ?>><?= _gv($g,'nav_partner_renner','RENNER Kompressoren') ?></span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('partenaires/ingersoll-rand') ?>" class="<?= $cms_page_key === 'partners_ir' ? 'active' : '' ?>">
              <span class="nav-dropdown-icon" style="color:#E8501A;"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/></svg></span>
              <span style="font-weight:600;" <?= cms_field_attrs('nav_partner_ir', 'text', 'Menu — Ingersoll Rand', isset($g['nav_partner_ir']) ? $g['nav_partner_ir'] : '', 'global') ?>><?= _gv($g,'nav_partner_ir','Ingersoll Rand') ?></span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('partenaires/cas-lubrifiants') ?>" class="<?= $cms_page_key === 'partners_cas' ? 'active' : '' ?>">
              <span class="nav-dropdown-icon" style="color:#F5B700;"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.5 3.5L18 2l-1.5 1.5L15 2l-1.5 1.5L12 2l-1.5 1.5L9 2 7.5 3.5 6 2v14H3v3a3 3 0 003 3h12a3 3 0 003-3V2l-1.5 1.5zM19 19a1 1 0 01-1 1H6a1 1 0 01-1-1v-1h12V5.08L19 4v15z"/></svg></span>
              <span style="font-weight:600;" <?= cms_field_attrs('nav_partner_cas', 'text', 'Menu — Huile CAS Lubricants', isset($g['nav_partner_cas']) ? $g['nav_partner_cas'] : '', 'global') ?>><?= _gv($g,'nav_partner_cas','Huile CAS Lubricants') ?></span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('produits') ?>">
              <span class="nav-dropdown-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M7 6h10l-5 7-5-7zm-2-2h14l-6 8.39V19l-2 1v-7.61L5 4z"/></svg></span>
              <span <?= cms_field_attrs('nav_parts', 'text', 'Menu — Pièces &amp; Consommables', isset($g['nav_parts']) ? $g['nav_parts'] : '', 'global') ?>><?= _gv($g,'nav_parts','Pièces &amp; Consommables') ?></span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>

      <?php if ($cms_is_admin || !$nav_hidden['services']): ?>
      <li <?= ($cms_is_admin && $nav_hidden['services']) ? 'class="nav-item-hidden-admin" title="Masqué aux visiteurs"' : '' ?>>
        <a href="<?= base_url('services') ?>" class="<?= $cms_page_key === 'services' ? 'active' : '' ?>">
          <?php if ($cms_is_admin && $nav_hidden['services']): ?><i class="fa-solid fa-eye-slash" style="font-size:0.65em;opacity:0.5;margin-right:3px;"></i><?php endif; ?>
          <span <?= cms_field_attrs('nav_services', 'text', 'Menu — Services', isset($g['nav_services']) ? $g['nav_services'] : '', 'global') ?>><?= _gv($g,'nav_services','Services') ?></span>
        </a>
      </li>
      <?php endif; ?>

      <?php if ($cms_is_admin || !$nav_hidden['expertise']): ?>
      <li <?= ($cms_is_admin && $nav_hidden['expertise']) ? 'class="nav-item-hidden-admin" title="Masqué aux visiteurs"' : '' ?>>
        <a href="<?= base_url('expertise') ?>" class="<?= $cms_page_key === 'expertise' ? 'active' : '' ?>">
          <?php if ($cms_is_admin && $nav_hidden['expertise']): ?><i class="fa-solid fa-eye-slash" style="font-size:0.65em;opacity:0.5;margin-right:3px;"></i><?php endif; ?>
          <span <?= cms_field_attrs('nav_expertise', 'text', 'Menu — Expertise', isset($g['nav_expertise']) ? $g['nav_expertise'] : '', 'global') ?>><?= _gv($g,'nav_expertise','Expertise') ?></span>
        </a>
      </li>
      <?php endif; ?>

      <?php if ($cms_is_admin || !$nav_hidden['gallery']): ?>
      <li <?= ($cms_is_admin && $nav_hidden['gallery']) ? 'class="nav-item-hidden-admin" title="Masqué aux visiteurs"' : '' ?>>
        <a href="<?= base_url('galerie') ?>" class="<?= $cms_page_key === 'gallery' ? 'active' : '' ?>">
          <?php if ($cms_is_admin && $nav_hidden['gallery']): ?><i class="fa-solid fa-eye-slash" style="font-size:0.65em;opacity:0.5;margin-right:3px;"></i><?php endif; ?>
          <span <?= cms_field_attrs('nav_gallery', 'text', 'Menu — Galerie', isset($g['nav_gallery']) ? $g['nav_gallery'] : '', 'global') ?>><?= _gv($g,'nav_gallery','Galerie') ?></span>
        </a>
      </li>
      <?php endif; ?>

      <?php if ($cms_is_admin || !$nav_hidden['contact']): ?>
      <li <?= ($cms_is_admin && $nav_hidden['contact']) ? 'class="nav-item-hidden-admin" title="Masqué aux visiteurs"' : '' ?>>
        <a href="<?= base_url('contact') ?>" class="<?= $cms_page_key === 'contact' ? 'active' : '' ?>">
          <?php if ($cms_is_admin && $nav_hidden['contact']): ?><i class="fa-solid fa-eye-slash" style="font-size:0.65em;opacity:0.5;margin-right:3px;"></i><?php endif; ?>
          <span <?= cms_field_attrs('nav_contact', 'text', 'Menu — Contact', isset($g['nav_contact']) ? $g['nav_contact'] : '', 'global') ?>><?= _gv($g,'nav_contact','Contact') ?></span>
        </a>
      </li>
      <?php endif; ?>

      <?php foreach ($custom_nav as $cn): ?>
      <li>
        <a href="<?= base_url('p/' . htmlspecialchars($cn->slug)) ?>">
          <span><?= htmlspecialchars($cn->nav_label ?: $cn->title) ?></span>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>

    <div style="display:flex;align-items:center;gap:0.5rem;">
      <div class="lang-switch">
        <button class="lang-btn" data-lang="fr" onclick="setLang('fr')">FR</button>
        <button class="lang-btn" data-lang="en" onclick="setLang('en')">EN</button>
      </div>
      <button class="mobile-menu-btn" onclick="toggleMobileMenu()" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>

  <!-- Mobile nav -->
  <div class="mobile-nav" id="mobile-nav">
    <?php if ($cms_is_admin || !$nav_hidden['home']): ?>
    <a href="<?= base_url() ?>" <?= ($cms_is_admin && $nav_hidden['home']) ? 'style="opacity:0.4;text-decoration:line-through;" title="Masqué aux visiteurs"' : '' ?>><?php if ($cms_is_admin && $nav_hidden['home']): ?><i class="fa-solid fa-eye-slash" style="font-size:0.65em;margin-right:4px;"></i><?php endif; ?><?= _gv($g,'nav_home','Accueil') ?></a>
    <?php endif; ?>
    <?php if ($cms_is_admin || !$nav_hidden['about']): ?>
    <a href="<?= base_url('a-propos') ?>" <?= ($cms_is_admin && $nav_hidden['about']) ? 'style="opacity:0.4;text-decoration:line-through;" title="Masqué aux visiteurs"' : '' ?>><?php if ($cms_is_admin && $nav_hidden['about']): ?><i class="fa-solid fa-eye-slash" style="font-size:0.65em;margin-right:4px;"></i><?php endif; ?><?= _gv($g,'nav_about','À propos') ?></a>
    <?php endif; ?>
    <?php if ($cms_is_admin || !$nav_hidden['products']): ?>
    <a href="<?= base_url('produits') ?>" <?= ($cms_is_admin && $nav_hidden['products']) ? 'style="opacity:0.4;text-decoration:line-through;" title="Masqué aux visiteurs"' : '' ?>><?php if ($cms_is_admin && $nav_hidden['products']): ?><i class="fa-solid fa-eye-slash" style="font-size:0.65em;margin-right:4px;"></i><?php endif; ?><?= _gv($g,'nav_products','Produits') ?></a>
    <a href="<?= base_url('partenaires/renner') ?>" style="padding-left:1.5rem;font-size:0.85rem;opacity:0.8;">&#8627; <?= _gv($g,'nav_partner_renner','RENNER Kompressoren') ?></a>
    <a href="<?= base_url('partenaires/ingersoll-rand') ?>" style="padding-left:1.5rem;font-size:0.85rem;opacity:0.8;">&#8627; <?= _gv($g,'nav_partner_ir','Ingersoll Rand') ?></a>
    <a href="<?= base_url('partenaires/cas-lubrifiants') ?>" style="padding-left:1.5rem;font-size:0.85rem;opacity:0.8;">&#8627; <?= _gv($g,'nav_partner_cas','Huile CAS Lubricants') ?></a>
    <?php endif; ?>
    <?php if ($cms_is_admin || !$nav_hidden['services']): ?>
    <a href="<?= base_url('services') ?>" <?= ($cms_is_admin && $nav_hidden['services']) ? 'style="opacity:0.4;text-decoration:line-through;" title="Masqué aux visiteurs"' : '' ?>><?php if ($cms_is_admin && $nav_hidden['services']): ?><i class="fa-solid fa-eye-slash" style="font-size:0.65em;margin-right:4px;"></i><?php endif; ?><?= _gv($g,'nav_services','Services') ?></a>
    <?php endif; ?>
    <?php if ($cms_is_admin || !$nav_hidden['expertise']): ?>
    <a href="<?= base_url('expertise') ?>" <?= ($cms_is_admin && $nav_hidden['expertise']) ? 'style="opacity:0.4;text-decoration:line-through;" title="Masqué aux visiteurs"' : '' ?>><?php if ($cms_is_admin && $nav_hidden['expertise']): ?><i class="fa-solid fa-eye-slash" style="font-size:0.65em;margin-right:4px;"></i><?php endif; ?><?= _gv($g,'nav_expertise','Expertise') ?></a>
    <?php endif; ?>
    <?php if ($cms_is_admin || !$nav_hidden['gallery']): ?>
    <a href="<?= base_url('galerie') ?>" <?= ($cms_is_admin && $nav_hidden['gallery']) ? 'style="opacity:0.4;text-decoration:line-through;" title="Masqué aux visiteurs"' : '' ?>><?php if ($cms_is_admin && $nav_hidden['gallery']): ?><i class="fa-solid fa-eye-slash" style="font-size:0.65em;margin-right:4px;"></i><?php endif; ?><?= _gv($g,'nav_gallery','Galerie') ?></a>
    <?php endif; ?>
    <?php if ($cms_is_admin || !$nav_hidden['contact']): ?>
    <a href="<?= base_url('contact') ?>" <?= ($cms_is_admin && $nav_hidden['contact']) ? 'style="opacity:0.4;text-decoration:line-through;" title="Masqué aux visiteurs"' : '' ?>><?php if ($cms_is_admin && $nav_hidden['contact']): ?><i class="fa-solid fa-eye-slash" style="font-size:0.65em;margin-right:4px;"></i><?php endif; ?><?= _gv($g,'nav_contact','Contact') ?></a>
    <?php endif; ?>
    <?php foreach ($custom_nav as $cn): ?>
    <a href="<?= base_url('p/' . htmlspecialchars($cn->slug)) ?>"><?= htmlspecialchars($cn->nav_label ?: $cn->title) ?></a>
    <?php endforeach; ?>
    <div style="display:flex;gap:0.5rem;padding:1rem 0;">
      <button class="lang-btn" data-lang="fr" onclick="setLang('fr')">FR</button>
      <button class="lang-btn" data-lang="en" onclick="setLang('en')">EN</button>
    </div>
  </div>
</nav>
