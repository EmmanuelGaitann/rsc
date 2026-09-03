<?php
$CI =& get_instance();
$CI->load->model('content_model');
$g  = $CI->content_model->get_page('global');
$cms_is_admin = (bool)$CI->session->userdata('admin_id');

// Shortcuts with fallbacks
$f_addr    = (isset($g['footer_address'])   && $g['footer_address'])   ? $g['footer_address']   : '739 rue Richard Bell, Nouvelle route Bonadibong - Akwa';
$f_addr2   = (isset($g['footer_address2'])  && $g['footer_address2'])  ? $g['footer_address2']  : 'À 200 m du Carrefour Kayo Élie — Douala, Cameroun';
$f_phone1  = (isset($g['footer_phone1'])    && $g['footer_phone1'])    ? $g['footer_phone1']    : '+237 691 123 112';
$f_phone2  = (isset($g['footer_phone2'])    && $g['footer_phone2'])    ? $g['footer_phone2']    : '+237 233 412 241';
$f_email   = (isset($g['footer_email'])     && $g['footer_email'])     ? $g['footer_email']     : 'info@rsc-cameroon.com';
$f_fb      = (isset($g['footer_fb'])        && $g['footer_fb'])        ? $g['footer_fb']        : 'https://www.facebook.com/profile.php?id=100093512901441';
$f_li      = (isset($g['footer_li'])        && $g['footer_li'])        ? $g['footer_li']        : 'https://www.linkedin.com/in/rsc-cameroon-sarl-215392364/';
$f_ig      = (isset($g['footer_ig'])        && $g['footer_ig'])        ? $g['footer_ig']        : 'https://www.instagram.com/rscameroon/';
$f_wa      = (isset($g['footer_wa'])        && $g['footer_wa'])        ? $g['footer_wa']        : 'https://wa.me/237691123112';
$f_desc    = (isset($g['footer_desc'])      && $g['footer_desc'])      ? $g['footer_desc']      : 'Votre partenaire agréé pour les compresseurs industriels RENNER et Ingersoll Rand en Afrique Centrale.';
$f_copy    = (isset($g['footer_copyright']) && $g['footer_copyright']) ? $g['footer_copyright'] : '© ' . date('Y') . ' Royal Sales Cameroon SARL. Tous droits réservés.';
$f_r_sub   = (isset($g['footer_renner_sub'])&& $g['footer_renner_sub'])? $g['footer_renner_sub']: 'Kompressoren — Allemagne';
$f_ir_sub  = (isset($g['footer_ir_sub'])    && $g['footer_ir_sub'])    ? $g['footer_ir_sub']    : 'Industrial Technologies — USA';
$f_size    = (isset($g['footer_font_size']) && $g['footer_font_size']) ? $g['footer_font_size'] : '';

// Footer nav link texts
$_fn = [
  ['url'=>base_url(),               'def'=>'Accueil',  'key'=>'footer_nav_home'],
  ['url'=>base_url('a-propos'),      'def'=>'À propos', 'key'=>'footer_nav_about'],
  ['url'=>base_url('produits'),      'def'=>'Produits', 'key'=>'footer_nav_prod'],
  ['url'=>base_url('services'),      'def'=>'Services', 'key'=>'footer_nav_serv'],
  ['url'=>base_url('expertise'),     'def'=>'Expertise','key'=>'footer_nav_exp'],
  ['url'=>base_url('galerie'),       'def'=>'Galerie',  'key'=>'footer_nav_gal'],
  ['url'=>base_url('contact'),       'def'=>'Contact',  'key'=>'footer_nav_contact'],
];

// Footer product link texts
$_fp = [
  ['url'=>base_url('produits?cat=vis'),         'def'=>'Compresseurs à vis',     'key'=>'footer_prod_vis'],
  ['url'=>base_url('produits?cat=oilfree'),      'def'=>'Sans huile',             'key'=>'footer_prod_oil'],
  ['url'=>base_url('produits?cat=piston'),       'def'=>'À piston',               'key'=>'footer_prod_pist'],
  ['url'=>base_url('produits?cat=air'),          'def'=>"Traitement de l'air",    'key'=>'footer_prod_air'],
  ['url'=>base_url('produits?cat=tanks'),        'def'=>'Réservoirs',             'key'=>'footer_prod_tank'],
  ['url'=>base_url('produits?cat=consommables'), 'def'=>'Pièces &amp; Consommables','key'=>'footer_prod_cons'],
];
?>

<footer id="main-footer"<?= $f_size ? ' style="font-size:'.htmlspecialchars($f_size).';"' : '' ?>>
  <?php if ($cms_is_admin): ?>
  <div style="background:rgba(29,103,205,0.12);border-bottom:1px solid rgba(29,103,205,0.2);padding:0.4rem 1.5rem;font-size:0.72rem;color:rgba(255,255,255,0.55);display:flex;align-items:center;gap:1rem;flex-wrap:wrap;">
    <span><i class="fa-solid fa-gear" style="margin-right:0.3rem;"></i>Footer — Paramètres globaux :</span>
    <a href="<?= base_url('admin/page/global') ?>" style="color:var(--accent);font-weight:600;">Modifier les champs &amp; liens</a>
    <?php if ($f_size): ?>
    <span>Taille texte : <strong style="color:white;"><?= htmlspecialchars($f_size) ?></strong></span>
    <?php endif; ?>
    <span <?= cms_field_attrs('footer_font_size', 'text', 'Taille texte footer (ex: 0.85rem)', $f_size, 'global') ?> style="cursor:pointer;color:var(--accent);" title="Modifier taille"><i class="fa-solid fa-text-height"></i> Taille</span>
  </div>
  <?php endif; ?>
  <div class="footer-grid">

    <!-- Col 1 : Logo + Description + Réseaux -->
    <div <?= cms_section_attrs($g, 'footer_col1', 'Footer — Logo & Description', 'global') ?>>
      <img src="<?= (isset($g['footer_logo']) && $g['footer_logo']) ? base_url($g['footer_logo']) : base_url('assets/logo/Logo_gold_RSC.png') ?>"
           alt="Royal Sales Cameroon" class="footer-logo"
           <?= cms_field_attrs('footer_logo', 'image', 'Logo footer', isset($g['footer_logo']) ? $g['footer_logo'] : '', 'global') ?>
           onerror="this.style.display='none'; this.insertAdjacentHTML('afterend','<span class=\'footer-logo-text\'>Royal Sales Cameroon</span>')">
      <p class="footer-desc" <?= cms_field_attrs('footer_desc', 'text', 'Footer — Description', $f_desc, 'global') ?>><?= htmlspecialchars($f_desc) ?></p>
      <div class="footer-social">
        <a href="<?= htmlspecialchars($f_fb) ?>" target="_blank" rel="noopener" class="social-link" aria-label="Facebook" <?= cms_field_attrs('footer_fb', 'url', 'Footer — URL Facebook', $f_fb, 'global') ?>>
          <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
        </a>
        <a href="<?= htmlspecialchars($f_li) ?>" target="_blank" rel="noopener" class="social-link" aria-label="LinkedIn" <?= cms_field_attrs('footer_li', 'url', 'Footer — URL LinkedIn', $f_li, 'global') ?>>
          <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
        </a>
        <a href="<?= htmlspecialchars($f_ig) ?>" target="_blank" rel="noopener" class="social-link" aria-label="Instagram" <?= cms_field_attrs('footer_ig', 'url', 'Footer — URL Instagram', $f_ig, 'global') ?>>
          <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
        </a>
        <a href="<?= htmlspecialchars($f_wa) ?>" target="_blank" rel="noopener" class="social-link" aria-label="WhatsApp" <?= cms_field_attrs('footer_wa', 'url', 'Footer — URL WhatsApp', $f_wa, 'global') ?>>
          <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        </a>
      </div>
    </div>

    <!-- Col 2 : Navigation -->
    <div <?= cms_section_attrs($g, 'footer_col_nav', 'Footer — Navigation', 'global') ?>>
      <h4 class="footer-heading" <?= cms_field_attrs('footer_nav_title', 'text', 'Footer — Titre colonne Navigation', isset($g['footer_nav_title']) ? $g['footer_nav_title'] : '', 'global') ?>>
        <?= (isset($g['footer_nav_title']) && $g['footer_nav_title']) ? htmlspecialchars($g['footer_nav_title']) : 'Navigation' ?>
      </h4>
      <ul class="footer-links">
        <?php foreach ($_fn as $item): ?>
        <li><a href="<?= $item['url'] ?>"><span <?= cms_field_attrs($item['key'], 'text', 'Nav — '.$item['def'], isset($g[$item['key']]) ? $g[$item['key']] : '', 'global') ?>><?= (isset($g[$item['key']]) && $g[$item['key']]) ? htmlspecialchars($g[$item['key']]) : $item['def'] ?></span></a></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <!-- Col 3 : Catégories produits -->
    <div <?= cms_section_attrs($g, 'footer_col_prod', 'Footer — Produits', 'global') ?>>
      <h4 class="footer-heading" <?= cms_field_attrs('footer_prod_title', 'text', 'Footer — Titre colonne Produits', isset($g['footer_prod_title']) ? $g['footer_prod_title'] : '', 'global') ?>>
        <?= (isset($g['footer_prod_title']) && $g['footer_prod_title']) ? htmlspecialchars($g['footer_prod_title']) : 'Nos Produits' ?>
      </h4>
      <ul class="footer-links">
        <?php foreach ($_fp as $item): ?>
        <li><a href="<?= $item['url'] ?>"><span <?= cms_field_attrs($item['key'], 'text', $item['def'], isset($g[$item['key']]) ? $g[$item['key']] : '', 'global') ?>><?= (isset($g[$item['key']]) && $g[$item['key']]) ? htmlspecialchars($g[$item['key']]) : $item['def'] ?></span></a></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <!-- Col 4 : Contact -->
    <div <?= cms_section_attrs($g, 'footer_col_contact', 'Footer — Contact', 'global') ?>>
      <h4 class="footer-heading" <?= cms_field_attrs('footer_contact_title', 'text', 'Footer — Titre colonne Contact', isset($g['footer_contact_title']) ? $g['footer_contact_title'] : '', 'global') ?>>
        <?= (isset($g['footer_contact_title']) && $g['footer_contact_title']) ? htmlspecialchars($g['footer_contact_title']) : 'Contact' ?>
      </h4>
      <div class="footer-contact-item">
        <span class="icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></span>
        <div>
          <div <?= cms_field_attrs('footer_address', 'text', 'Footer — Adresse ligne 1', $f_addr, 'global') ?>><?= htmlspecialchars($f_addr) ?></div>
          <div style="color:rgba(255,255,255,0.3);font-size:0.8rem;" <?= cms_field_attrs('footer_address2', 'text', 'Footer — Adresse ligne 2', $f_addr2, 'global') ?>><?= htmlspecialchars($f_addr2) ?></div>
        </div>
      </div>
      <div class="footer-contact-item">
        <span class="icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg></span>
        <div>
          <a href="tel:<?= preg_replace('/\s+/', '', $f_phone1) ?>" style="display:block;" <?= cms_field_attrs('footer_phone1', 'text', 'Footer — Téléphone 1', $f_phone1, 'global') ?>><?= htmlspecialchars($f_phone1) ?></a>
          <a href="tel:<?= preg_replace('/\s+/', '', $f_phone2) ?>" style="display:block;color:rgba(255,255,255,0.55);font-size:0.85rem;" <?= cms_field_attrs('footer_phone2', 'text', 'Footer — Téléphone 2', $f_phone2, 'global') ?>><?= htmlspecialchars($f_phone2) ?></a>
        </div>
      </div>
      <div class="footer-contact-item">
        <span class="icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg></span>
        <div <?= cms_field_attrs('footer_email', 'text', 'Footer — Email', $f_email, 'global') ?>>
          <a href="mailto:<?= htmlspecialchars($f_email) ?>"><?= htmlspecialchars($f_email) ?></a>
        </div>
      </div>
    </div>

    <!-- Col 5 : Partenaires -->
    <div <?= cms_section_attrs($g, 'footer_col_partners', 'Footer — Partenaires', 'global') ?>>
      <h4 class="footer-heading" style="font-size:0.7rem;" <?= cms_field_attrs('footer_partners_title', 'text', 'Footer — Titre Partenaires', isset($g['footer_partners_title']) ? $g['footer_partners_title'] : '', 'global') ?>>
        <?= (isset($g['footer_partners_title']) && $g['footer_partners_title']) ? htmlspecialchars($g['footer_partners_title']) : 'PARTENAIRES' ?>
      </h4>
      <p style="font-size:0.72rem;color:rgba(255,255,255,0.4);margin-bottom:1rem;line-height:1.45;" <?= cms_field_attrs('footer_partners_desc', 'text', 'Footer — Texte Partenaires', isset($g['footer_partners_desc']) ? $g['footer_partners_desc'] : '', 'global') ?>>
        <?= (isset($g['footer_partners_desc']) && $g['footer_partners_desc']) ? htmlspecialchars($g['footer_partners_desc']) : "Distributeur agréé de marques leaders en compression d'air industrielle." ?>
      </p>

      <a href="<?= base_url('partenaires/renner') ?>" style="display:block;margin-bottom:0.75rem;padding:0.7rem 0.85rem;border-radius:8px;background:rgba(0,141,142,0.12);border:1px solid rgba(0,141,142,0.3);text-decoration:none;transition:background 0.2s;"
         onmouseover="this.style.background='rgba(0,141,142,0.22)'" onmouseout="this.style.background='rgba(0,141,142,0.12)'">
        <img src="<?= base_url('assets/logo/Renner_logo.png') ?>" alt="RENNER Kompressoren"
             style="height:22px;filter:brightness(0) invert(1);opacity:0.85;display:block;margin-bottom:0.4rem;"
             onerror="this.style.display='none'; this.insertAdjacentHTML('afterend','<span style=\'font-family:Montserrat,sans-serif;font-weight:800;font-size:0.85rem;color:#fff;letter-spacing:0.05em;\'>RENNER</span>')">
        <span style="font-size:0.67rem;color:rgba(255,255,255,0.4);" <?= cms_field_attrs('footer_renner_sub', 'text', 'Footer — Sous-titre RENNER', $f_r_sub, 'global') ?>><?= htmlspecialchars($f_r_sub) ?></span>
      </a>

      <a href="<?= base_url('partenaires/ingersoll-rand') ?>" style="display:block;padding:0.7rem 0.85rem;border-radius:8px;background:rgba(232,80,26,0.12);border:1px solid rgba(232,80,26,0.3);text-decoration:none;transition:background 0.2s;"
         onmouseover="this.style.background='rgba(232,80,26,0.22)'" onmouseout="this.style.background='rgba(232,80,26,0.12)'">
        <img src="<?= base_url('assets/logo/Ingersoll_Rand_logo.svg') ?>" alt="Ingersoll Rand"
             style="height:19px;filter:brightness(0) invert(1);opacity:0.85;display:block;margin-bottom:0.4rem;"
             onerror="this.style.display='none'; this.insertAdjacentHTML('afterend','<span style=\'font-family:Montserrat,sans-serif;font-weight:800;font-size:0.85rem;color:#fff;letter-spacing:0.05em;\'>INGERSOLL RAND</span>')">
        <span style="font-size:0.67rem;color:rgba(255,255,255,0.4);" <?= cms_field_attrs('footer_ir_sub', 'text', 'Footer — Sous-titre Ingersoll Rand', $f_ir_sub, 'global') ?>><?= htmlspecialchars($f_ir_sub) ?></span>
      </a>
    </div>

  </div>

  <div class="footer-bottom">
    <span <?= cms_field_attrs('footer_copyright', 'text', 'Footer — Copyright', $f_copy, 'global') ?>><?= htmlspecialchars($f_copy) ?></span>
    <div class="footer-bottom-links">
      <a href="<?= base_url('mentions-legales') ?>">Mentions légales</a>
      <a href="<?= base_url('mentions-legales#privacy') ?>">Confidentialité</a>
    </div>
  </div>
</footer>

<!-- Bandeau d'information cookies / confidentialité (RGPD) -->
<div id="rsc-cookie-banner" style="display:none;position:fixed;left:1rem;right:1rem;bottom:1rem;z-index:9999;max-width:520px;margin:0 auto;background:#1e2838;color:rgba(255,255,255,0.85);border:1px solid rgba(209,171,106,0.35);border-radius:12px;padding:1rem 1.2rem;box-shadow:0 10px 40px rgba(0,0,0,0.35);font-size:0.82rem;line-height:1.55;">
  <div style="display:flex;gap:1rem;align-items:flex-start;flex-wrap:wrap;">
    <p style="flex:1;min-width:220px;margin:0;">
      Ce site n'utilise que des cookies techniques indispensables (session, choix de langue).
      Aucun cookie publicitaire ni de suivi n'est déposé.
      <a href="<?= base_url('mentions-legales#privacy') ?>" style="color:#d1ab6a;text-decoration:underline;">Politique de confidentialité</a>
    </p>
    <button onclick="rscCookieOk()" style="background:#1D67CD;color:white;border:none;border-radius:8px;padding:0.55rem 1.3rem;font-weight:700;cursor:pointer;font-size:0.82rem;">J'ai compris</button>
  </div>
</div>
<script>
function rscCookieOk() {
  try { localStorage.setItem('rsc_cookie_ok', '1'); } catch (e) {}
  var b = document.getElementById('rsc-cookie-banner');
  if (b) b.style.display = 'none';
}
(function () {
  var seen = null;
  try { seen = localStorage.getItem('rsc_cookie_ok'); } catch (e) {}
  if (!seen) {
    var b = document.getElementById('rsc-cookie-banner');
    if (b) b.style.display = 'block';
  }
})();
</script>

<script>const BASE_URL = '<?= base_url() ?>';</script>
<script src="<?= base_url('assets/js/translations.js') ?>"></script>
<script src="<?= base_url('assets/js/app.js') ?>"></script>
<?= isset($extra_js) ? $extra_js : '' ?>

<?php if ($cms_is_admin): ?>
<div id="cms-toast-area"></div>

<div id="cms-edit-modal">
  <div class="cms-modal-box">
    <div class="cms-modal-title">
      <i class="fa-solid fa-pencil"></i>
      <span>Modifier</span>
    </div>
    <div class="cms-modal-field"></div>
    <div class="cms-modal-actions">
      <button class="cms-btn-cancel" onclick="closeCmsModal()">
        <i class="fa-solid fa-xmark"></i> Annuler
      </button>
      <button class="cms-btn-save" onclick="saveCmsEdit()">
        <i class="fa-solid fa-check"></i> Enregistrer
      </button>
    </div>
  </div>
</div>

<script>const CMS_BASE_URL = '<?= base_url() ?>';</script>
<script src="<?= base_url('assets/admin/inline-edit.js') ?>"></script>
<?php endif; ?>
</body>
</html>
