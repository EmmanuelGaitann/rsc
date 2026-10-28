<style>
  :root {
    --cas: var(--dark); --cas-dark: var(--dark-deep);
    --cas-gold: var(--accent); --cas-light: var(--primary-light);
  }
  .cas-hero {
    background: linear-gradient(135deg, var(--dark-deep) 0%, var(--dark) 50%, var(--dark-mid) 100%);
    padding: 5rem 0 4rem; position: relative; overflow: hidden;
  }
  .cas-hero::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(ellipse at 70% 50%, rgba(29,103,205,0.08) 0%, transparent 65%);
    pointer-events: none;
  }
  .cas-hero-inner {
    max-width: 1320px; margin: 0 auto; padding: 0 2rem;
    display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;
  }
  .cas-badge-pill {
    display: inline-flex; align-items: center; gap: 0.45rem;
    background: rgba(29,103,205,0.12); border: 1px solid rgba(29,103,205,0.35);
    color: var(--accent); padding: 0.3rem 0.9rem; border-radius: 50px;
    font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: 0.12em; font-family: 'Montserrat', sans-serif;
    margin-bottom: 1.5rem; width: fit-content;
  }
  .cas-hero h1 { font-family: 'Montserrat', sans-serif; font-weight: 900; font-size: clamp(2rem, 4vw, 3rem); color: white; line-height: 1.1; margin-bottom: 0.75rem; }
  .cas-hero h1 span { color: var(--accent); }
  .cas-hero-sub { font-size: 1rem; color: rgba(255,255,255,0.55); margin-bottom: 2rem; line-height: 1.7; }
  .cas-hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; }
  .btn-cas { display: inline-flex; align-items: center; gap: 0.5rem; background: var(--primary); color: white; font-weight: 700; padding: 0.75rem 1.5rem; border-radius: 8px; font-family: 'Montserrat', sans-serif; font-size: 0.88rem; text-decoration: none; transition: background 0.2s, transform 0.15s; white-space: nowrap; }
  .btn-cas:hover { background: var(--primary-dark); transform: translateY(-2px); }
  .btn-cas-outline { display: inline-flex; align-items: center; gap: 0.5rem; background: transparent; color: rgba(255,255,255,0.8); border: 1.5px solid rgba(255,255,255,0.25); font-weight: 600; padding: 0.75rem 1.5rem; border-radius: 8px; font-family: 'Montserrat', sans-serif; font-size: 0.88rem; text-decoration: none; transition: all 0.2s; white-space: nowrap; }
  .btn-cas-outline:hover { border-color: var(--accent); color: var(--accent); }
  .cas-hero-img-wrap { display: flex; justify-content: center; align-items: center; background: rgba(255,255,255,0.03); border-radius: 20px; border: 1px solid rgba(29,103,205,0.12); padding: 2.5rem; min-height: 320px; }
  .cas-hero-img-wrap img { max-width: 100%; max-height: 320px; object-fit: contain; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.5)); }
  .cas-stats { background: var(--primary); padding: 1.5rem 0; }
  .cas-stats-inner { max-width: 1320px; margin: 0 auto; padding: 0 2rem; display: flex; align-items: center; justify-content: space-around; flex-wrap: wrap; gap: 1.5rem; }
  .cas-stat { text-align: center; }
  .cas-stat strong { display: block; font-size: 1.6rem; font-weight: 900; font-family: 'Montserrat', sans-serif; color: white; line-height: 1; }
  .cas-stat span { font-size: 0.75rem; font-weight: 600; color: rgba(255,255,255,0.75); text-transform: uppercase; letter-spacing: 0.08em; }
  .cas-stat-sep { width: 1px; height: 36px; background: rgba(255,255,255,0.25); }
  .cas-card { background: white; border-radius: 14px; border: 1px solid var(--border); overflow: hidden; transition: transform 0.2s, box-shadow 0.2s; display: flex; flex-direction: column; }
  .cas-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,0.1); }
  .cas-card-header { background: linear-gradient(135deg, var(--dark-deep) 0%, var(--dark) 100%); padding: 2rem 1.5rem; display: flex; align-items: center; justify-content: center; min-height: 160px; }
  .cas-card-header img { max-height: 120px; object-fit: contain; filter: drop-shadow(0 8px 16px rgba(0,0,0,0.4)); }
  .cas-card-body { padding: 1.5rem; flex: 1; }
  .cas-card-label { font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; color: var(--accent); font-family: 'Montserrat', sans-serif; margin-bottom: 0.4rem; }
  .cas-card-title { font-size: 1.05rem; font-weight: 800; color: var(--dark); font-family: 'Montserrat', sans-serif; margin-bottom: 0.6rem; }
  .cas-card-desc { font-size: 0.87rem; color: var(--gray); line-height: 1.65; }
  .cas-spec-table { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
  .cas-spec-table th { background: var(--dark); color: var(--accent); padding: 0.65rem 1rem; text-align: left; font-family: 'Montserrat', sans-serif; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; }
  .cas-spec-table td { padding: 0.6rem 1rem; border-bottom: 1px solid var(--border); color: var(--dark); }
  .cas-spec-table tr:last-child td { border-bottom: none; }
  .cas-spec-table tr:hover td { background: var(--primary-light); }
  .cas-spec-table .spec-key { font-weight: 600; color: var(--dark-mid); }
  .dl-card { display: flex; align-items: center; gap: 1.25rem; background: white; border: 1px solid var(--border); border-radius: 12px; padding: 1.25rem 1.5rem; text-decoration: none; transition: all 0.2s; border-left: 4px solid var(--accent); }
  .dl-card:hover { box-shadow: var(--shadow); transform: translateX(4px); }
  .dl-icon { width: 44px; height: 44px; background: var(--primary-light); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--accent); font-size: 1.2rem; }
  .dl-info { flex: 1; }
  .dl-title { font-weight: 700; color: var(--dark); font-family: 'Montserrat', sans-serif; font-size: 0.92rem; margin-bottom: 0.2rem; }
  .dl-sub { font-size: 0.78rem; color: var(--gray); }
  .dl-badge { font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; padding: 0.2rem 0.55rem; border-radius: 4px; background: #f1f5f9; color: var(--gray); font-family: 'Montserrat', sans-serif; flex-shrink: 0; }
  .section-label-gold { display: inline-block; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; color: var(--accent); margin-bottom: 0.5rem; font-family: 'Montserrat', sans-serif; }
  .cas-check { color: var(--accent); margin-right: 0.6rem; }
  @media (max-width: 768px) { .cas-hero-inner { grid-template-columns: 1fr; gap: 2rem; } .cas-hero-img-wrap { min-height: 200px; } .cas-stat-sep { display: none; } }
</style>

<section class="cas-hero hero-carousel" <?= cms_section_attrs($c, 'hero', 'Bannière principale') ?>>
  <div class="hc-track">
    <div class="hc-slide active" style="background-image:url('<?= isset($c['slide1']) && $c['slide1'] ? base_url($c['slide1']) : 'https://images.unsplash.com/photo-1570126618953-d437176e8c79?w=1920&q=60' ?>')" <?= cms_field_attrs('slide1', 'image', 'Image slide 1', isset($c['slide1']) ? $c['slide1'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide2']) && $c['slide2'] ? base_url($c['slide2']) : 'https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=1920&q=60' ?>')" <?= cms_field_attrs('slide2', 'image', 'Image slide 2', isset($c['slide2']) ? $c['slide2'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide3']) && $c['slide3'] ? base_url($c['slide3']) : 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=1920&q=60' ?>')" <?= cms_field_attrs('slide3', 'image', 'Image slide 3', isset($c['slide3']) ? $c['slide3'] : '') ?>></div>
  </div>
  <div class="hc-overlay" style="background:rgba(20,28,45,0.85)"></div>
  <div class="cas-hero-inner">
    <div>
      <div class="breadcrumb" style="margin-bottom:1rem;">
        <a href="<?= base_url() ?>" data-i18n="nav_home" style="color:rgba(255,255,255,0.6);">Accueil</a>
        <span style="color:rgba(255,255,255,0.4);">›</span>
        <span style="color:rgba(255,255,255,0.6);" data-i18n="about_partners">Partenaires</span>
        <span style="color:rgba(255,255,255,0.4);">›</span>
        <span style="color:white;">CAS Lubricants</span>
      </div>
      <div class="cas-badge-pill" <?= cms_field_attrs('hero_badge', 'text', 'Badge (texte court)', isset($c['hero_badge']) ? $c['hero_badge'] : '') ?>>
        <i class="fa-solid fa-oil-can"></i> <?= isset($c['hero_badge']) && $c['hero_badge'] ? htmlspecialchars($c['hero_badge']) : 'Marque Exclusive Royal Sales Cameroon' ?>
      </div>
      <h1 <?= cms_field_attrs('hero_title', 'text', 'Titre principal', isset($c['hero_title']) ? $c['hero_title'] : '') ?>><?= isset($c['hero_title']) && $c['hero_title'] ? htmlspecialchars($c['hero_title']) : 'Huiles <span>CAS</span> Lubricants' ?></h1>
      <p class="cas-hero-sub" <?= cms_field_attrs('about_text', 'html', 'Texte de présentation', isset($c['about_text']) ? $c['about_text'] : '') ?>>
        <?= isset($c['about_text']) && $c['about_text'] ? $c['about_text'] : "Lubrifiants haute performance pour compresseurs industriels. Formulés spécialement pour les conditions climatiques tropicales d'Afrique Centrale. Compatible toutes marques de compresseurs à vis." ?>
      </p>
      <div class="cas-hero-actions">
        <a href="<?= base_url('contact') ?>?product=huile-CAS" class="btn-cas">
          <i class="fa-solid fa-paper-plane"></i> Demander un devis
        </a>
        <?php if (!empty($docs)): ?>
        <a href="#telechargements" class="btn-cas-outline">
          <i class="fa-solid fa-file-arrow-down"></i> Fiches techniques
        </a>
        <?php endif; ?>
      </div>
    </div>
    <div class="cas-hero-img-wrap" <?= cms_field_attrs('hero_img', 'image', 'Image principale du produit', isset($c['hero_img']) ? $c['hero_img'] : '') ?>>
      <img src="<?= isset($c['hero_img']) && $c['hero_img'] ? base_url($c['hero_img']) : base_url('assets/images/huiles/image.png') ?>" alt="CAS Lubricants — Huiles compresseurs fûts 200L et bidons 20L">
    </div>
  </div>
  <button class="hc-prev" aria-label="Précédent"><i class="fa-solid fa-chevron-left"></i></button>
  <button class="hc-next" aria-label="Suivant"><i class="fa-solid fa-chevron-right"></i></button>
  <div class="hc-dots">
    <button class="hc-dot active" aria-label="Slide 1"></button>
    <button class="hc-dot" aria-label="Slide 2"></button>
    <button class="hc-dot" aria-label="Slide 3"></button>
  </div>
</section>

<?php
$_cas_stats = [
  1 => ['val'=>'stat1_value','d_val'=>'100%',      'lbl'=>'stat1_label','d_lbl'=>'Compatible toutes marques'],
  2 => ['val'=>'stat2_value','d_val'=>'4 000 h',   'lbl'=>'stat2_label','d_lbl'=>'Intervalle de vidange'],
  3 => ['val'=>'stat3_value','d_val'=>'ISO VG 46', 'lbl'=>'stat3_label','d_lbl'=>'Viscosité standard'],
  4 => ['val'=>'stat4_value','d_val'=>'+55°C',     'lbl'=>'stat4_label','d_lbl'=>'Adapté au climat tropical'],
  5 => ['val'=>'stat5_value','d_val'=>'En stock',  'lbl'=>'stat5_label','d_lbl'=>'À Douala — Livraison rapide'],
];
?>
<div class="cas-stats" <?= cms_section_attrs($c, 'stats_bar', 'Barre de statistiques') ?>>
  <div class="cas-stats-inner">
    <?php foreach ($_cas_stats as $n => $s): ?>
    <?php $sv = (isset($c[$s['val']]) && $c[$s['val']]) ? htmlspecialchars($c[$s['val']]) : $s['d_val']; ?>
    <?php $sl = (isset($c[$s['lbl']]) && $c[$s['lbl']]) ? htmlspecialchars($c[$s['lbl']]) : $s['d_lbl']; ?>
    <div class="cas-stat">
      <strong <?= cms_field_attrs($s['val'], 'text', 'Stat '.$n.' — Valeur', isset($c[$s['val']]) ? $c[$s['val']] : '') ?>><?= $sv ?></strong>
      <span <?= cms_field_attrs($s['lbl'], 'text', 'Stat '.$n.' — Libellé', isset($c[$s['lbl']]) ? $c[$s['lbl']] : '') ?>><?= $sl ?></span>
    </div>
    <?php if ($n < 5): ?><div class="cas-stat-sep"></div><?php endif; ?>
    <?php endforeach; ?>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="section-header fade-in">
      <span class="section-label-gold">Gamme CAS Lubricants</span>
      <h2 class="section-title">Nos huiles pour compresseurs</h2>
      <p class="section-subtitle">Conditionnements disponibles selon vos besoins. Livraison sur site à Douala et dans la région.</p>
    </div>

    <div class="grid-3 fade-in" style="gap:1.75rem;">
      <div class="cas-card">
        <div class="cas-card-header" <?= cms_field_attrs('prod1_img', 'image', 'Produit 1 — Image', isset($c['prod1_img']) ? $c['prod1_img'] : '') ?>>
          <img src="<?= isset($c['prod1_img']) && $c['prod1_img'] ? base_url($c['prod1_img']) : base_url('assets/images/huiles/image.png') ?>" alt="CAS Lubricants fût 200L">
        </div>
        <div class="cas-card-body">
          <div class="cas-card-label">Grand volume — Industrie</div>
          <div class="cas-card-title" <?= cms_field_attrs('prod1_title', 'text', 'Produit 1 — Titre', isset($c['prod1_title']) ? $c['prod1_title'] : '') ?>><?= isset($c['prod1_title']) && $c['prod1_title'] ? htmlspecialchars($c['prod1_title']) : 'CAS Lubricants — Fût 200 L' ?></div>
          <p class="cas-card-desc" <?= cms_field_attrs('prod1_desc', 'text', 'Produit 1 — Description', isset($c['prod1_desc']) ? $c['prod1_desc'] : '') ?>><?= isset($c['prod1_desc']) && $c['prod1_desc'] ? htmlspecialchars($c['prod1_desc']) : "Idéal pour les parcs de compresseurs importants ou les contrats de maintenance. Économique à l'usage, stockage facilité sur site industriel." ?></p>
          <a href="<?= base_url('contact') ?>?product=CAS-fut-200L" class="btn btn-primary btn-sm" style="margin-top:1rem;">Demander un devis</a>
        </div>
      </div>

      <div class="cas-card">
        <div class="cas-card-header" <?= cms_field_attrs('prod2_img', 'image', 'Produit 2 — Image', isset($c['prod2_img']) ? $c['prod2_img'] : '') ?>>
          <img src="<?= isset($c['prod2_img']) && $c['prod2_img'] ? base_url($c['prod2_img']) : base_url('assets/images/huiles/image.png') ?>" alt="CAS Lubricants bidon 20L">
        </div>
        <div class="cas-card-body">
          <div class="cas-card-label">Usage courant — Atelier</div>
          <div class="cas-card-title" <?= cms_field_attrs('prod2_title', 'text', 'Produit 2 — Titre', isset($c['prod2_title']) ? $c['prod2_title'] : '') ?>><?= isset($c['prod2_title']) && $c['prod2_title'] ? htmlspecialchars($c['prod2_title']) : 'CAS Lubricants — Bidon 20 L' ?></div>
          <p class="cas-card-desc" <?= cms_field_attrs('prod2_desc', 'text', 'Produit 2 — Description', isset($c['prod2_desc']) ? $c['prod2_desc'] : '') ?>><?= isset($c['prod2_desc']) && $c['prod2_desc'] ? htmlspecialchars($c['prod2_desc']) : "Format pratique pour les ateliers et petits parcs machines. Manipulation aisée, bouchon étanche. Idéal pour la maintenance préventive périodique." ?></p>
          <a href="<?= base_url('contact') ?>?product=CAS-bidon-20L" class="btn btn-primary btn-sm" style="margin-top:1rem;">Demander un devis</a>
        </div>
      </div>

      <div class="cas-card">
        <div class="cas-card-header" style="flex-direction:column;gap:1rem;">
          <i class="fa-solid fa-flask" style="font-size:3rem;color:var(--accent);"></i>
          <div style="color:white;font-family:'Montserrat',sans-serif;font-weight:700;font-size:0.9rem;text-align:center;">Conditionnement sur mesure</div>
        </div>
        <div class="cas-card-body">
          <div class="cas-card-label">Sur commande</div>
          <div class="cas-card-title" <?= cms_field_attrs('prod3_title', 'text', 'Produit 3 — Titre', isset($c['prod3_title']) ? $c['prod3_title'] : '') ?>><?= isset($c['prod3_title']) && $c['prod3_title'] ? htmlspecialchars($c['prod3_title']) : 'Conditionnement personnalisé' ?></div>
          <p class="cas-card-desc" <?= cms_field_attrs('prod3_desc', 'text', 'Produit 3 — Description', isset($c['prod3_desc']) ? $c['prod3_desc'] : '') ?>><?= isset($c['prod3_desc']) && $c['prod3_desc'] ? htmlspecialchars($c['prod3_desc']) : "Vous avez des besoins spécifiques en volume ou en viscosité ? Contactez-nous pour un conditionnement adapté à votre parc machines et vos intervalles de maintenance." ?></p>
          <a href="<?= base_url('contact') ?>?product=CAS-custom" class="btn btn-primary btn-sm" style="margin-top:1rem;">Nous contacter</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section bg-light" style="background:linear-gradient(rgba(248,249,250,0.97),rgba(248,249,250,0.97));">
  <div class="container">
    <div class="about-grid fade-in" style="align-items:start;gap:3.5rem;">
      <div>
        <span class="section-label-gold">Caractéristiques techniques</span>
        <h2 class="section-title" style="margin-bottom:1.5rem;">Spécifications CAS Lubricants</h2>
        <div style="border-radius:12px;overflow:hidden;border:1px solid var(--border);margin-bottom:2rem;">
          <table class="cas-spec-table">
            <thead><tr><th>Propriété</th><th>Valeur</th></tr></thead>
            <tbody>
              <tr><td class="spec-key">Type de lubrifiant</td><td>Huile minérale pour compresseurs à vis</td></tr>
              <tr><td class="spec-key">Viscosité ISO VG</td><td>VG 46 / VG 68 (selon application)</td></tr>
              <tr><td class="spec-key">Indice de viscosité</td><td>&gt; 100</td></tr>
              <tr><td class="spec-key">Point d'éclair</td><td>&gt; 220°C</td></tr>
              <tr><td class="spec-key">Point d'écoulement</td><td>&lt; -15°C</td></tr>
              <tr><td class="spec-key">Intervalle de vidange</td><td>2 000 – 4 000 heures</td></tr>
              <tr><td class="spec-key">Température de service max.</td><td>+100°C</td></tr>
              <tr><td class="spec-key">Compatibilité matériaux</td><td>Joint NBR, FKM, cuivre, aluminium</td></tr>
              <tr><td class="spec-key">Conditionnements</td><td>Bidon 20 L / Fût 200 L</td></tr>
            </tbody>
          </table>
        </div>
        <div style="background:linear-gradient(135deg,var(--dark-deep) 0%,var(--dark) 100%);border-radius:12px;padding:1.75rem;border-left:4px solid var(--accent);">
          <div style="font-family:'Montserrat',sans-serif;font-weight:700;color:var(--accent);font-size:0.8rem;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:1rem;">Compatible avec</div>
          <div style="display:flex;flex-wrap:wrap;gap:0.5rem;">
            <span style="background:rgba(29,103,205,0.1);border:1px solid rgba(29,103,205,0.25);color:rgba(255,255,255,0.8);padding:0.3rem 0.85rem;border-radius:50px;font-size:0.78rem;font-family:'Montserrat',sans-serif;font-weight:600;">RENNER</span>
            <span style="background:rgba(29,103,205,0.1);border:1px solid rgba(29,103,205,0.25);color:rgba(255,255,255,0.8);padding:0.3rem 0.85rem;border-radius:50px;font-size:0.78rem;font-family:'Montserrat',sans-serif;font-weight:600;">Ingersoll Rand</span>
            <span style="background:rgba(29,103,205,0.1);border:1px solid rgba(29,103,205,0.25);color:rgba(255,255,255,0.8);padding:0.3rem 0.85rem;border-radius:50px;font-size:0.78rem;font-family:'Montserrat',sans-serif;font-weight:600;">Atlas Copco</span>
            <span style="background:rgba(29,103,205,0.1);border:1px solid rgba(29,103,205,0.25);color:rgba(255,255,255,0.8);padding:0.3rem 0.85rem;border-radius:50px;font-size:0.78rem;font-family:'Montserrat',sans-serif;font-weight:600;">Kaeser</span>
            <span style="background:rgba(29,103,205,0.1);border:1px solid rgba(29,103,205,0.25);color:rgba(255,255,255,0.8);padding:0.3rem 0.85rem;border-radius:50px;font-size:0.78rem;font-family:'Montserrat',sans-serif;font-weight:600;">Gardner Denver</span>
            <span style="background:rgba(29,103,205,0.1);border:1px solid rgba(29,103,205,0.25);color:rgba(255,255,255,0.8);padding:0.3rem 0.85rem;border-radius:50px;font-size:0.78rem;font-family:'Montserrat',sans-serif;font-weight:600;">Sullair</span>
            <span style="background:rgba(29,103,205,0.1);border:1px solid rgba(29,103,205,0.25);color:rgba(255,255,255,0.8);padding:0.3rem 0.85rem;border-radius:50px;font-size:0.78rem;font-family:'Montserrat',sans-serif;font-weight:600;">+ autres marques</span>
          </div>
        </div>
      </div>

      <div>
        <span class="section-label-gold">Pourquoi CAS Lubricants ?</span>
        <h2 class="section-title" style="margin-bottom:1.5rem;">Les avantages</h2>
        <ul style="list-style:none;display:flex;flex-direction:column;gap:1.1rem;">
          <li style="display:flex;gap:0.85rem;align-items:flex-start;">
            <span class="cas-check"><i class="fa-solid fa-circle-check"></i></span>
            <div><strong style="color:var(--dark);display:block;margin-bottom:0.2rem;">Formulation tropicale</strong><span style="color:var(--gray);font-size:0.9rem;">Spécialement développée pour les températures élevées et l'humidité d'Afrique Centrale. Stabilité thermique optimale au-delà de 40°C ambiants.</span></div>
          </li>
          <li style="display:flex;gap:0.85rem;align-items:flex-start;">
            <span class="cas-check"><i class="fa-solid fa-circle-check"></i></span>
            <div><strong style="color:var(--dark);display:block;margin-bottom:0.2rem;">Protection maximale de l'airend</strong><span style="color:var(--gray);font-size:0.9rem;">Film lubrifiant robuste, anti-usure et anti-corrosion pour prolonger la durée de vie des rotors et roulements.</span></div>
          </li>
          <li style="display:flex;gap:0.85rem;align-items:flex-start;">
            <span class="cas-check"><i class="fa-solid fa-circle-check"></i></span>
            <div><strong style="color:var(--dark);display:block;margin-bottom:0.2rem;">Intervalles de vidange prolongés</strong><span style="color:var(--gray);font-size:0.9rem;">Jusqu'à 4 000 heures entre deux vidanges, réduisant les coûts de maintenance et les arrêts de production.</span></div>
          </li>
          <li style="display:flex;gap:0.85rem;align-items:flex-start;">
            <span class="cas-check"><i class="fa-solid fa-circle-check"></i></span>
            <div><strong style="color:var(--dark);display:block;margin-bottom:0.2rem;">Stock disponible à Douala</strong><span style="color:var(--gray);font-size:0.9rem;">Disponibilité immédiate sans délai d'importation. Livraison rapide sur chantier dans la région de Douala et l'Afrique Centrale.</span></div>
          </li>
          <li style="display:flex;gap:0.85rem;align-items:flex-start;">
            <span class="cas-check"><i class="fa-solid fa-circle-check"></i></span>
            <div><strong style="color:var(--dark);display:block;margin-bottom:0.2rem;">Traçabilité et conformité</strong><span style="color:var(--gray);font-size:0.9rem;">Fiche de données de sécurité (MSDS) disponible en téléchargement. Conforme aux exigences réglementaires industrielles.</span></div>
          </li>
          <li style="display:flex;gap:0.85rem;align-items:flex-start;">
            <span class="cas-check"><i class="fa-solid fa-circle-check"></i></span>
            <div><strong style="color:var(--dark);display:block;margin-bottom:0.2rem;">Marque exclusive RSC</strong><span style="color:var(--gray);font-size:0.9rem;">Développée et distribuée exclusivement par Royal Sales Cameroon — votre garantie d'un produit adapté à vos besoins locaux.</span></div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php if (!empty($docs)): ?>
<section id="telechargements" class="section">
  <div class="container">
    <div class="section-header fade-in">
      <span class="section-label-gold">Documentation technique</span>
      <h2 class="section-title">Téléchargements</h2>
      <p class="section-subtitle">Accédez aux fiches techniques, documentations produit et fiches de sécurité CAS Lubricants.</p>
    </div>
    <?php /* Documents gérés dans Admin → Documents & PDF (table rsc_documents) */ ?>
    <div style="display:flex;flex-direction:column;gap:1rem;max-width:720px;margin:0 auto;" class="fade-in">
      <?php foreach ($docs as $doc): ?>
      <a href="<?= doc_url($doc) ?>" target="_blank" rel="noopener" class="dl-card">
        <div class="dl-icon"><i class="fa-solid <?= htmlspecialchars(doc_icon($doc)) ?>"></i></div>
        <div class="dl-info">
          <div class="dl-title"><?= htmlspecialchars($doc->title) ?></div>
          <?php if ($doc->subtitle): ?>
          <div class="dl-sub"><?= htmlspecialchars($doc->subtitle) ?></div>
          <?php endif; ?>
        </div>
        <span class="dl-badge"><?= htmlspecialchars(doc_badge($doc)) ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="section" style="background:linear-gradient(135deg,var(--dark-deep) 0%,var(--dark) 100%);" <?= cms_section_attrs($c, 'cta', "Appel à l'action") ?>>
  <div class="container" style="text-align:center;">
    <span class="section-label-gold">Commander</span>
    <h2 style="color:white;margin:0.75rem 0 1rem;font-family:'Montserrat',sans-serif;" <?= cms_field_attrs('cta_title', 'text', 'Titre CTA', isset($c['cta_title']) ? $c['cta_title'] : '') ?>><?= (isset($c['cta_title']) && $c['cta_title']) ? htmlspecialchars($c['cta_title']) : "Besoin d'huile CAS Lubricants ?" ?></h2>
    <p style="color:rgba(255,255,255,0.5);max-width:520px;margin:0 auto 2rem;line-height:1.7;" <?= cms_field_attrs('cta_subtitle', 'html', 'Texte CTA', isset($c['cta_subtitle']) ? $c['cta_subtitle'] : '') ?>>
      <?= (isset($c['cta_subtitle']) && $c['cta_subtitle']) ? $c['cta_subtitle'] : "Contactez notre équipe pour un devis, une commande ou toute question technique sur nos lubrifiants. Disponibilité immédiate à Douala." ?>
    </p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
      <a href="<?= (isset($c['cta_btn1_url']) && $c['cta_btn1_url']) ? htmlspecialchars($c['cta_btn1_url']) : base_url('contact').'?product=huile-CAS' ?>"
         class="btn-cas"
         <?= cms_field_attrs('cta_btn1_url', 'url', 'Bouton 1 — URL (devis)', isset($c['cta_btn1_url']) ? $c['cta_btn1_url'] : '') ?>>
        <i class="fa-solid fa-paper-plane"></i>
        <span <?= cms_field_attrs('cta_btn1_text', 'text', 'Bouton 1 — Texte', isset($c['cta_btn1_text']) ? $c['cta_btn1_text'] : '') ?>><?= (isset($c['cta_btn1_text']) && $c['cta_btn1_text']) ? htmlspecialchars($c['cta_btn1_text']) : 'Demander un devis' ?></span>
      </a>
      <a href="<?= (isset($c['cta_btn2_url']) && $c['cta_btn2_url']) ? htmlspecialchars($c['cta_btn2_url']) : 'tel:+237691123112' ?>"
         class="btn-cas-outline"
         <?= cms_field_attrs('cta_btn2_url', 'url', 'Bouton 2 — URL (tel:+237…)', isset($c['cta_btn2_url']) ? $c['cta_btn2_url'] : '') ?>>
        <i class="fa-solid fa-phone"></i>
        <span <?= cms_field_attrs('cta_btn2_text', 'text', 'Bouton 2 — Texte', isset($c['cta_btn2_text']) ? $c['cta_btn2_text'] : '') ?>><?= (isset($c['cta_btn2_text']) && $c['cta_btn2_text']) ? htmlspecialchars($c['cta_btn2_text']) : '+237 691 123 112' ?></span>
      </a>
      <a href="<?= (isset($c['cta_btn3_url']) && $c['cta_btn3_url']) ? htmlspecialchars($c['cta_btn3_url']) : 'https://wa.me/237691123112?text=Bonjour%20RSC%20Cameroon%2C%20je%20souhaite%20commander%20de%20l%27huile%20CAS%20Lubricants.' ?>"
         target="_blank" rel="noopener" class="btn-cas-outline"
         <?= cms_field_attrs('cta_btn3_url', 'url', 'Bouton 3 — URL (WhatsApp)', isset($c['cta_btn3_url']) ? $c['cta_btn3_url'] : '') ?>>
        <i class="fa-brands fa-whatsapp"></i>
        <span <?= cms_field_attrs('cta_btn3_text', 'text', 'Bouton 3 — Texte (WhatsApp)', isset($c['cta_btn3_text']) ? $c['cta_btn3_text'] : '') ?>><?= (isset($c['cta_btn3_text']) && $c['cta_btn3_text']) ? htmlspecialchars($c['cta_btn3_text']) : 'WhatsApp' ?></span>
      </a>
    </div>
  </div>
</section>
