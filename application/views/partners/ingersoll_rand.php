<style>
  :root { --ir-blue: var(--primary-dark); --ir-orange: var(--primary); }
  .ir-accent { color: var(--ir-orange); }
  .ir-badge { display: inline-flex; align-items: center; gap: 0.4rem; background: rgba(29,103,205,0.1); border: 1px solid rgba(29,103,205,0.25); color: var(--ir-orange); padding: 0.25rem 0.75rem; border-radius: 50px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; font-family: 'Montserrat', sans-serif; }
  .ir-card { background: white; border-radius: 12px; overflow: hidden; border: 1px solid var(--border); transition: transform 0.2s, box-shadow 0.2s; }
  .ir-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,0.1); }
  .ir-card-img { width: 100%; height: 200px; object-fit: contain; background: #f4f6fa; padding: 1rem; box-sizing: border-box; display: block; flex-shrink: 0; }
  .ir-card-body { padding: 1.25rem 1.5rem 1.5rem; }
  .ir-card-label { font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; color: var(--ir-orange); font-family: 'Montserrat', sans-serif; margin-bottom: 0.4rem; }
  .ir-card-title { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 0.4rem; font-family: 'Montserrat', sans-serif; }
  .ir-card-power { font-size: 0.8rem; color: var(--gray); margin-bottom: 0.75rem; }
  .ir-card-desc { font-size: 0.85rem; color: var(--gray); line-height: 1.6; margin-bottom: 1rem; }
  .ir-spec-table { width: 100%; border-collapse: collapse; font-size: 0.82rem; }
  .ir-spec-table th { background: var(--ir-blue); color: white; padding: 0.6rem 0.75rem; text-align: left; font-family: 'Montserrat', sans-serif; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; }
  .ir-spec-table td { padding: 0.55rem 0.75rem; border-bottom: 1px solid var(--border); color: var(--dark); }
  .ir-spec-table tr:hover td { background: rgba(29,103,205,0.04); }
  .ir-spec-table .model-name { font-weight: 700; color: var(--ir-orange); font-family: 'Montserrat', sans-serif; }
  .ir-filter-btn { padding: 0.45rem 1rem; border-radius: 50px; border: 1px solid var(--border); background: white; color: var(--gray); font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: all 0.2s; font-family: 'Montserrat', sans-serif; }
  .ir-filter-btn.active, .ir-filter-btn:hover { background: var(--ir-orange); color: white; border-color: var(--ir-orange); }
  .ir-hero-bg { background: linear-gradient(135deg, var(--ir-blue) 0%, #001a4d 60%), url('https://images.pexels.com/photos/3862130/pexels-photo-3862130.jpeg?auto=compress&w=1920') center/cover no-repeat; background-blend-mode: multiply; }
  .tech-card { background: white; border-radius: 14px; padding: 1.75rem; border: 1px solid var(--border); position: relative; overflow: hidden; border-top: 3px solid var(--ir-orange); }
  .ir-cat-section { display: none; }
  .ir-cat-section.visible { display: block; }
</style>

<section class="page-hero ir-hero-bg hero-carousel" style="padding: 5rem 0 4rem; min-height: 340px; display: flex; align-items: center;" <?= cms_section_attrs($c, 'hero', 'Bannière principale') ?>>
  <div class="hc-track">
    <div class="hc-slide active" style="background-image:url('<?= isset($c['slide1']) && $c['slide1'] ? base_url($c['slide1']) : 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=1920&q=60' ?>')" <?= cms_field_attrs('slide1', 'image', 'Image slide 1', isset($c['slide1']) ? $c['slide1'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide2']) && $c['slide2'] ? base_url($c['slide2']) : 'https://images.unsplash.com/photo-1570126618953-d437176e8c79?w=1920&q=60' ?>')" <?= cms_field_attrs('slide2', 'image', 'Image slide 2', isset($c['slide2']) ? $c['slide2'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide3']) && $c['slide3'] ? base_url($c['slide3']) : 'https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=1920&q=60' ?>')" <?= cms_field_attrs('slide3', 'image', 'Image slide 3', isset($c['slide3']) ? $c['slide3'] : '') ?>></div>
  </div>
  <div class="hc-overlay" style="background:rgba(0,10,50,0.82)"></div>
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= base_url() ?>" data-i18n="nav_home" style="color:rgba(255,255,255,0.6);">Accueil</a>
      <span style="color:rgba(255,255,255,0.4);">›</span>
      <span style="color:rgba(255,255,255,0.6);" data-i18n="about_partners">Partenaires</span>
      <span style="color:rgba(255,255,255,0.4);">›</span>
      <span style="color:white;">Ingersoll Rand</span>
    </div>
    <div style="display: flex; align-items: center; gap: 2rem; flex-wrap: wrap; margin-top: 1.5rem;">
      <div style="flex: 1; min-width: 280px;">
        <div style="margin-bottom: 1rem;"><span class="ir-badge"><i class="fa-solid fa-certificate"></i> Distributeur Agréé Officiel</span></div>
        <h1 style="font-family:'Montserrat',sans-serif; font-size: clamp(2rem, 4vw, 3rem); font-weight: 900; color: white; line-height: 1.1; margin-bottom: 1rem;" <?= cms_field_attrs('hero_title', 'text', 'Titre principal', isset($c['hero_title']) ? $c['hero_title'] : '') ?>>
          <?= isset($c['hero_title']) && $c['hero_title'] ? htmlspecialchars($c['hero_title']) : 'Ingersoll Rand' ?><br>
          <span style="color: var(--ir-orange);" <?= cms_field_attrs('hero_subtitle', 'text', 'Sous-titre', isset($c['hero_subtitle']) ? $c['hero_subtitle'] : '') ?>><?= isset($c['hero_subtitle']) && $c['hero_subtitle'] ? htmlspecialchars($c['hero_subtitle']) : "150 ans d'excellence industrielle" ?></span>
        </h1>
        <p style="color: rgba(255,255,255,0.7); font-size: 1rem; line-height: 1.7; max-width: 560px; margin-bottom: 2rem;" <?= cms_field_attrs('about_text', 'html', 'Texte de présentation', isset($c['about_text']) ? $c['about_text'] : '') ?>>
          <?= isset($c['about_text']) && $c['about_text'] ? $c['about_text'] : "Fondée en 1871, Ingersoll Rand est un leader mondial des équipements industriels critiques. Présente dans plus de 100 pays avec un CA de 7,5 milliards USD, ses compresseurs équipent les industries les plus exigeantes du monde." ?>
        </p>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
          <a href="<?= base_url('contact') ?>" class="btn btn-accent"><i class="fa-solid fa-file-lines" style="margin-right: 0.4rem;"></i>Demander un devis</a>
          <a href="#gamme" class="btn" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2);"><i class="fa-solid fa-list" style="margin-right: 0.4rem;"></i>Voir la gamme</a>
        </div>
      </div>
      <div style="display: flex; flex-direction: column; gap: 1rem; min-width: 200px;">
        <img src="<?= base_url('assets/logo/Ingersoll_Rand_logo.svg') ?>" alt="Ingersoll Rand" style="height: 44px; width: auto; filter: brightness(0) invert(1); object-fit: contain;" onerror="this.style.display='none'; this.insertAdjacentHTML('afterend','<span style=\'color:white;font-size:1.1rem;font-family:Montserrat,sans-serif;font-weight:900;\'>INGERSOLL RAND</span>')">
        <?php
        $_ir_stats = [
          1 => ['val'=>'stat1_value','d_val'=>'1871',     'lbl'=>'stat1_label','d_lbl'=>'Fondée en'],
          2 => ['val'=>'stat2_value','d_val'=>'100+',     'lbl'=>'stat2_label','d_lbl'=>'Pays'],
          3 => ['val'=>'stat3_value','d_val'=>'45 000+',  'lbl'=>'stat3_label','d_lbl'=>'Employés'],
          4 => ['val'=>'stat4_value','d_val'=>'7,5 Mds$', 'lbl'=>'stat4_label','d_lbl'=>'CA annuel'],
        ];
        ?>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
          <?php foreach ($_ir_stats as $n => $s): ?>
          <?php $sv = (isset($c[$s['val']]) && $c[$s['val']]) ? htmlspecialchars($c[$s['val']]) : $s['d_val']; ?>
          <?php $sl = (isset($c[$s['lbl']]) && $c[$s['lbl']]) ? htmlspecialchars($c[$s['lbl']]) : $s['d_lbl']; ?>
          <div style="background: rgba(255,255,255,0.08); border-radius: 10px; padding: 0.75rem; text-align: center; border: 1px solid rgba(255,255,255,0.1);">
            <div style="font-size: 1rem; font-weight: 800; color: var(--ir-orange); font-family: 'Montserrat',sans-serif;" <?= cms_field_attrs($s['val'], 'text', 'Stat '.$n.' — Valeur', isset($c[$s['val']]) ? $c[$s['val']] : '') ?>><?= $sv ?></div>
            <div style="font-size: 0.6rem; color: rgba(255,255,255,0.55); text-transform: uppercase; letter-spacing: 0.08em;" <?= cms_field_attrs($s['lbl'], 'text', 'Stat '.$n.' — Libellé', isset($c[$s['lbl']]) ? $c[$s['lbl']] : '') ?>><?= $sl ?></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
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

<section class="section" style="background: linear-gradient(rgba(248,249,250,0.97), rgba(248,249,250,0.97)), url('https://images.pexels.com/photos/8961354/pexels-photo-8961354.jpeg?auto=compress&w=1920') center/cover fixed;" <?= cms_section_attrs($c, 'about_section', 'Section À propos') ?>>
  <div class="container">
    <?php
    $_ir_about_lbl = (isset($c['about_section_title']) && $c['about_section_title']) ? htmlspecialchars($c['about_section_title']) : "À propos d'Ingersoll Rand";
    $_ir_about_d1  = (isset($c['about_desc1'])         && $c['about_desc1'])         ? $c['about_desc1'] : "Fondée en 1871 par Simon Ingersoll, Ingersoll Rand Inc. (NYSE : IR, S&amp;P 500) est aujourd'hui l'un des leaders mondiaux inconditionnels des équipements industriels critiques. La fusion historique de 2020 entre Gardner Denver et le segment industriel d'Ingersoll-Rand plc a créé une entreprise de 15 milliards USD consolidant plus de 40 marques premium.";
    $_ir_about_d2  = (isset($c['about_desc2'])         && $c['about_desc2'])         ? $c['about_desc2'] : "Ingersoll Rand conçoit, fabrique et entretient des solutions de compression d'air, de vide, de gestion de fluides, d'outils de puissance et de levage pour pratiquement tous les secteurs industriels. Les services après-vente représentent 43 % du CA, témoignant de la solidité du réseau mondial.";
    $_ir_about_img = (isset($c['about_image'])         && $c['about_image'])         ? base_url($c['about_image']) : 'https://images.pexels.com/photos/3862627/pexels-photo-3862627.jpeg?auto=compress&w=800';
    $_ir_web_url   = (isset($c['about_website_url'])   && $c['about_website_url'])   ? htmlspecialchars($c['about_website_url']) : 'https://www.ingersollrand.com';
    $_ir_web_text  = (isset($c['about_website_text'])  && $c['about_website_text'])  ? htmlspecialchars($c['about_website_text']) : 'Site officiel Ingersoll Rand';
    $_ir_details = [
      ['l'=>'about_detail1_label','d_l'=>'Siège social',     'v'=>'about_detail1_value','d_v'=>'Davidson, Caroline du Nord, États-Unis'],
      ['l'=>'about_detail2_label','d_l'=>'Bourse',           'v'=>'about_detail2_value','d_v'=>'NYSE : IR — S&P 500'],
      ['l'=>'about_detail3_label','d_l'=>'Certifications',   'v'=>'about_detail3_value','d_v'=>'ISO, ASME, ATEX, CE, API'],
      ['l'=>'about_detail4_label','d_l'=>'Marques portfolio','v'=>'about_detail4_value','d_v'=>'40+ marques (Gardner Denver, CompAir, ARO, Nash…)'],
    ];
    ?>
    <div class="about-grid fade-in">
      <div>
        <span class="section-label" <?= cms_field_attrs('about_section_title', 'text', 'Label de section', isset($c['about_section_title']) ? $c['about_section_title'] : '') ?>><?= $_ir_about_lbl ?></span>
        <h2 class="section-title" <?= cms_field_attrs('about_section_h2', 'text', 'Titre H2', isset($c['about_section_h2']) ? $c['about_section_h2'] : '') ?>><?= (isset($c['about_section_h2']) && $c['about_section_h2']) ? htmlspecialchars($c['about_section_h2']) : 'Plus de 150 ans<br>au service de <span class="ir-accent">l\'industrie</span>' ?></h2>
        <p style="color:var(--gray);line-height:1.8;margin-bottom:1.25rem;" <?= cms_field_attrs('about_desc1', 'html', 'Paragraphe 1', isset($c['about_desc1']) ? $c['about_desc1'] : '') ?>><?= $_ir_about_d1 ?></p>
        <p style="color:var(--gray);line-height:1.8;margin-bottom:1.75rem;" <?= cms_field_attrs('about_desc2', 'html', 'Paragraphe 2', isset($c['about_desc2']) ? $c['about_desc2'] : '') ?>><?= $_ir_about_d2 ?></p>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.75rem;">
          <?php foreach ($_ir_details as $d): ?>
          <?php $dl = (isset($c[$d['l']]) && $c[$d['l']]) ? htmlspecialchars($c[$d['l']]) : $d['d_l']; ?>
          <?php $dv = (isset($c[$d['v']]) && $c[$d['v']]) ? htmlspecialchars($c[$d['v']]) : $d['d_v']; ?>
          <div style="padding: 1rem; background: white; border-radius: 10px; border-left: 3px solid var(--ir-orange); box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
            <div style="font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: var(--ir-orange); margin-bottom: 0.3rem; font-family: 'Montserrat',sans-serif;" <?= cms_field_attrs($d['l'], 'text', $d['d_l'].' — Label', isset($c[$d['l']]) ? $c[$d['l']] : '') ?>><?= $dl ?></div>
            <div style="font-size: 0.88rem; color: var(--dark); font-weight: 500;" <?= cms_field_attrs($d['v'], 'text', $d['d_l'].' — Valeur', isset($c[$d['v']]) ? $c[$d['v']] : '') ?>><?= $dv ?></div>
          </div>
          <?php endforeach; ?>
        </div>
        <a href="<?= $_ir_web_url ?>" target="_blank" rel="noopener" class="btn btn-outline" style="border-color: var(--ir-orange); color: var(--ir-orange);"
           <?= cms_field_attrs('about_website_url', 'url', 'URL site officiel', isset($c['about_website_url']) ? $c['about_website_url'] : '') ?>>
          <i class="fa-solid fa-arrow-up-right-from-square" style="margin-right: 0.4rem;"></i>
          <span <?= cms_field_attrs('about_website_text', 'text', 'Texte bouton site', isset($c['about_website_text']) ? $c['about_website_text'] : '') ?>><?= $_ir_web_text ?></span>
        </a>
      </div>
      <div style="position: relative;">
        <img src="<?= $_ir_about_img ?>" alt="Ingénieurs Royal Sales Cameroon — solutions Ingersoll Rand" style="width:100%; height: 420px; object-fit:cover; border-radius:16px; box-shadow:0 12px 40px rgba(0,0,0,0.15);"
             <?= cms_field_attrs('about_image', 'image', 'Image principale', isset($c['about_image']) ? $c['about_image'] : '') ?>>
        <div style="position:absolute;bottom:-1.5rem;right:-1rem;background:var(--ir-orange);color:white;padding:1.25rem 1.5rem;border-radius:12px;text-align:center;box-shadow:0 8px 24px rgba(29,103,205,0.35);">
          <div style="font-size: 1.6rem; font-weight: 900; font-family:'Montserrat',sans-serif; line-height:1;">150+</div>
          <div style="font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; opacity: 0.9;">ans d'excellence</div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section" id="gamme" style="background: white;">
  <div class="container">
    <div class="section-header fade-in">
      <span class="section-label">Catalogue Ingersoll Rand</span>
      <h2 class="section-title">La Gamme <span class="ir-accent">Ingersoll Rand</span></h2>
      <p class="section-subtitle">Des compresseurs 4 kW à 355 kW+ — solutions pour toutes les applications industrielles</p>
    </div>

    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 2rem;" class="fade-in">
      <button class="ir-filter-btn active" onclick="showIRCat('rseries', this)"><i class="fa-solid fa-gear" style="margin-right: 0.3rem;"></i>R-Series (Vis lubrifiés)</button>
      <button class="ir-filter-btn" onclick="showIRCat('oilfree', this)"><i class="fa-solid fa-droplet-slash" style="margin-right: 0.3rem;"></i>Sans huile</button>
      <button class="ir-filter-btn" onclick="showIRCat('piston', this)"><i class="fa-solid fa-arrows-up-down" style="margin-right: 0.3rem;"></i>À piston</button>
      <button class="ir-filter-btn" onclick="showIRCat('centrifuge', this)"><i class="fa-solid fa-rotate" style="margin-right: 0.3rem;"></i>Centrifuges</button>
      <button class="ir-filter-btn" onclick="showIRCat('airtreatment', this)"><i class="fa-solid fa-wind" style="margin-right: 0.3rem;"></i>Traitement d'air</button>
    </div>

    <!-- R-SERIES -->
    <div class="ir-cat-section visible" id="ir-cat-rseries">
      <h3 style="font-family:'Montserrat',sans-serif;color:var(--dark);margin-bottom:0.5rem;" <?= cms_field_attrs('cat_rseries_title', 'text', 'Catégorie R-Series — Titre', isset($c['cat_rseries_title']) ? $c['cat_rseries_title'] : '') ?>><?= isset($c['cat_rseries_title']) && $c['cat_rseries_title'] ? htmlspecialchars($c['cat_rseries_title']) : 'R-Series — Compresseurs à vis lubrifiés' ?></h3>
      <p style="color:var(--gray);margin-bottom:2rem;line-height:1.7;" <?= cms_field_attrs('cat_rseries_desc', 'text', 'Catégorie R-Series — Description', isset($c['cat_rseries_desc']) ? $c['cat_rseries_desc'] : '') ?>><?= isset($c['cat_rseries_desc']) && $c['cat_rseries_desc'] ? htmlspecialchars($c['cat_rseries_desc']) : "La gamme phare d'Ingersoll Rand pour les applications industrielles. Technologie à vis rotative avec système connecté Helix® (IIoT). Disponibles en version standard et VSD (Variable Speed Drive)." ?></p>
      <div class="grid-auto fade-in">
        <div class="ir-card"><img src="https://www.compressorworld.com/assets/Ingersoll-Rand-R11i-Fixed-Speed-Rotary-Screw-Air-Compressor-Tank-Mounted.jpg" alt="R-Series 4–11 kW" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/3861969/pexels-photo-3861969.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">Vis lubrifiée — Compact</div><div class="ir-card-title">R-Series</div><div class="ir-card-power"><i class="fa-solid fa-bolt" style="color:var(--ir-orange);margin-right:0.3rem;"></i>4 – 11 kW (5–15 HP) &nbsp;|&nbsp; Contrôleur Xe-70M</div><p class="ir-card-desc">Performances optimales en format compact. Option Total Air System (TAS) avec sécheur frigorifique intégré. Technologie V-Shield (zéro fuite).</p><a href="<?= base_url('contact') ?>?product=IR-R-Series-4-11" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="ir-card"><img src="https://www.compressorworld.com/assets/Ingersoll-Rand-RS22ie-Rotary-Screw-Air-Compressor.jpg" alt="Next Gen RS 11–22 kW" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/3861969/pexels-photo-3861969.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">Next Generation RS</div><div class="ir-card-title">Next Gen RS</div><div class="ir-card-power"><i class="fa-solid fa-bolt" style="color:var(--ir-orange);margin-right:0.3rem;"></i>11 – 22 kW (15–30 HP) &nbsp;|&nbsp; Xe-Series</div><p class="ir-card-desc">Moteur IE3/IE4. TAS avec échangeur thermique 3-en-1. Tension V-Belt automatique. Contrôleur Xe-Series avec affichage haute résolution et accès web distant.</p><a href="<?= base_url('contact') ?>?product=IR-NGS-11-22" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="ir-card"><img src="https://www.compressorworld.com/assets/IR-RS30-37-Air-Compressor-Tech-Specs_1.jpg" alt="Next Gen RS 30–37 kW" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/8961252/pexels-photo-8961252.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">Next Generation RS — 18% plus efficace</div><div class="ir-card-title">Next Gen RS</div><div class="ir-card-power"><i class="fa-solid fa-bolt" style="color:var(--ir-orange);margin-right:0.3rem;"></i>30 – 37 kW &nbsp;|&nbsp; PAC® intégré</div><p class="ir-card-desc">+18% d'efficacité. Conception airend nouvelle génération. Progressive Adaptive Control (PAC®) pour prévention des arrêts imprévus. Intégration Helix® Connected Platform.</p><a href="<?= base_url('contact') ?>?product=IR-NGS-30-37" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="ir-card"><img src="https://www.compressorworld.com/assets/RS_Big.png" alt="Next Gen RS 45–75 kW" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/8961252/pexels-photo-8961252.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">Next Generation RS — Haute performance</div><div class="ir-card-title">Next Gen RS</div><div class="ir-card-power"><i class="fa-solid fa-bolt" style="color:var(--ir-orange);margin-right:0.3rem;"></i>45 – 75 kW &nbsp;|&nbsp; +16% efficacité, +21% débit</div><p class="ir-card-desc">Rotor optimisé : +16% d'efficacité, +21% de capacité. V-Shield Technology (zéro fuite). PAC® protection. Xe-Series controller avec accès web. Moteur NEMA Premium / IE3.</p><a href="<?= base_url('contact') ?>?product=IR-NGS-45-75" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="ir-card"><img src="https://www.compressorworld.com/assets/IngersollRandRSSeriesBaseMount.jpeg" alt="Next Gen RS 90–132 kW" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/3862627/pexels-photo-3862627.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">Next Generation RS — Industrie lourde</div><div class="ir-card-title">Next Gen RS</div><div class="ir-card-power"><i class="fa-solid fa-bolt" style="color:var(--ir-orange);margin-right:0.3rem;"></i>90 – 132 kW &nbsp;|&nbsp; Helix® IIoT intégré</div><p class="ir-card-desc">Airend semi-intégré haute performance. IP55 premium. Connexions Viton Victaulic. Helix® IIoT intégré. +8% d'efficacité, +13% de débit vs génération précédente.</p><a href="<?= base_url('contact') ?>?product=IR-NGS-90-132" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="ir-card"><img src="https://www.compressorworld.com/assets/Ingersoll-Rand-R11i-Fixed-Speed-Rotary-Screw-Air-Compressor-Tank-Mounted.jpg" alt="R-Series IAS 110–160 kW" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/3844790/pexels-photo-3844790.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">Integrated Air System — Tout-en-un</div><div class="ir-card-title">R-Series IAS</div><div class="ir-card-power"><i class="fa-solid fa-bolt" style="color:var(--ir-orange);margin-right:0.3rem;"></i>110 – 160 kW &nbsp;|&nbsp; Compresseur + sécheur + filtre</div><p class="ir-card-desc">Solution tout-en-un intégrant compresseur, sécheur, filtre et stockage dans un seul package. Sequential Cooling System. Energy Recovery System (ERS) optionnel.</p><a href="<?= base_url('contact') ?>?product=IR-IAS-110-160" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="ir-card"><img src="https://www.compressorworld.com/assets/IR-RS45-75i-Air-Compressor-Tech-Specs_1.jpg" alt="Next Gen RS 315–355 kW" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/3862627/pexels-photo-3862627.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">Next Generation RS — Très haute puissance</div><div class="ir-card-title">Next Gen RS</div><div class="ir-card-power"><i class="fa-solid fa-bolt" style="color:var(--ir-orange);margin-right:0.3rem;"></i>315 – 355 kW &nbsp;|&nbsp; Outdoor / harsh env.</div><p class="ir-card-desc">Très haute puissance. Airend double étage optionnel. PAC® protection, V-Shield®, refroidissement flottant. Options environnements sévères.</p><a href="<?= base_url('contact') ?>?product=IR-NGS-315-355" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
      </div>
      <div class="fade-in" style="margin-top: 3rem; overflow-x: auto;">
        <h4 style="font-family:'Montserrat',sans-serif;margin-bottom:1rem;color:var(--dark);">Tableau comparatif — R-Series</h4>
        <table class="ir-spec-table">
          <thead><tr><th>Modèle</th><th>Puissance</th><th>Option VSD</th><th>Contrôleur</th><th>Particularités</th></tr></thead>
          <tbody>
            <tr><td class="model-name">R-Series</td><td>4 – 11 kW</td><td>Oui</td><td>Xe-70M</td><td>Compact, TAS optionnel</td></tr>
            <tr><td class="model-name">Next Gen RS</td><td>11 – 22 kW</td><td>Oui</td><td>Xe-Series</td><td>Auto V-Belt, TAS 3-en-1</td></tr>
            <tr><td class="model-name">Next Gen RS</td><td>30 – 37 kW</td><td>Oui</td><td>Xe-Series</td><td>+18% efficacité, PAC®</td></tr>
            <tr><td class="model-name">Next Gen RS</td><td>45 – 75 kW</td><td>Oui</td><td>Xe-Series</td><td>+16% efficacité, +21% débit</td></tr>
            <tr><td class="model-name">Next Gen RS</td><td>90 – 132 kW</td><td>Oui</td><td>Xe-Series</td><td>Helix® IIoT, Viton Victaulic</td></tr>
            <tr><td class="model-name">R-Series VSD</td><td>90 – 110 kW</td><td>Standard</td><td>XS-Series</td><td>+18% rotor optimisé</td></tr>
            <tr><td class="model-name">R-Series IAS</td><td>110 – 160 kW</td><td>Oui</td><td>Xe-Series</td><td>Solution tout-en-un intégrée</td></tr>
            <tr><td class="model-name">Next Gen RS</td><td>200 – 250 kW</td><td>Oui</td><td>Xe-Series</td><td>2 étages disponibles</td></tr>
            <tr><td class="model-name">Next Gen RS</td><td>315 – 355 kW</td><td>Oui</td><td>Xe-Series</td><td>Outdoor / harsh env.</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- SANS HUILE -->
    <div class="ir-cat-section" id="ir-cat-oilfree">
      <h3 style="font-family:'Montserrat',sans-serif;color:var(--dark);margin-bottom:0.5rem;" <?= cms_field_attrs('cat_oilfree_title', 'text', 'Catégorie Sans Huile — Titre', isset($c['cat_oilfree_title']) ? $c['cat_oilfree_title'] : '') ?>><?= isset($c['cat_oilfree_title']) && $c['cat_oilfree_title'] ? htmlspecialchars($c['cat_oilfree_title']) : 'Compresseurs sans huile — Classe 0' ?></h3>
      <p style="color:var(--gray);margin-bottom:2rem;line-height:1.7;" <?= cms_field_attrs('cat_oilfree_desc', 'text', 'Catégorie Sans Huile — Description', isset($c['cat_oilfree_desc']) ? $c['cat_oilfree_desc'] : '') ?>><?= isset($c['cat_oilfree_desc']) && $c['cat_oilfree_desc'] ? htmlspecialchars($c['cat_oilfree_desc']) : "Gamme primée certifiée ISO 8573-1 Classe 0. Idéaux pour les industries où la contamination par l'huile est inacceptable." ?></p>
      <div class="grid-auto fade-in">
        <div class="ir-card"><img src="https://yscompressor.com/wp-content/uploads/2022/10/0550560.jpg" alt="ES Series Oil-Free" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/3912992/pexels-photo-3912992.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">Vis rotative sans huile</div><div class="ir-card-title">ES Series Oil-Free</div><div class="ir-card-power"><i class="fa-solid fa-bolt" style="color:var(--ir-orange);margin-right:0.3rem;"></i>55 – 110 kW &nbsp;|&nbsp; ISO 8573-1 Classe 0</div><p class="ir-card-desc">Nouvelle génération de compresseurs sans huile à vis rotative. Package optimisé pour le TCO le plus bas. Disponible refroidi à air ou à eau.</p><a href="<?= base_url('contact') ?>?product=IR-ES-oilfree" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="ir-card"><img src="https://yscompressor.com/wp-content/uploads/2022/10/World-Class-Efficiency.jpg" alt="Rotary Oil-Free" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/3912992/pexels-photo-3912992.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">Rotatif sans huile — Primé</div><div class="ir-card-title">Rotary Oil-Free</div><div class="ir-card-power"><i class="fa-solid fa-award" style="color:var(--ir-orange);margin-right:0.3rem;"></i>Primé — Technologie éprouvée</div><p class="ir-card-desc">Série primée de compresseurs rotatifs sans huile. Composants airend conçus et fabriqués par Ingersoll Rand. Récupération de chaleur disponible.</p><a href="<?= base_url('contact') ?>?product=IR-rotary-oilfree" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
      </div>
      <div class="fade-in" style="margin-top: 2rem; background: var(--dark); border-radius: 16px; padding: 2rem; border-left: 4px solid var(--ir-orange);">
        <h4 style="color: white; font-family:'Montserrat',sans-serif; margin-bottom: 1rem;">Industries nécessitant l'air Classe 0</h4>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem;">
          <div style="text-align:center;padding:0.75rem;background:rgba(255,255,255,0.06);border-radius:8px;"><i class="fa-solid fa-pills" style="color:var(--ir-orange);font-size:1.2rem;margin-bottom:0.4rem;"></i><div style="color:white;font-size:0.78rem;font-weight:600;font-family:'Montserrat',sans-serif;">Pharmaceutique</div><div style="color:rgba(255,255,255,0.45);font-size:0.7rem;">FDA/GMP conforme</div></div>
          <div style="text-align:center;padding:0.75rem;background:rgba(255,255,255,0.06);border-radius:8px;"><i class="fa-solid fa-utensils" style="color:var(--ir-orange);font-size:1.2rem;margin-bottom:0.4rem;"></i><div style="color:white;font-size:0.78rem;font-weight:600;font-family:'Montserrat',sans-serif;">Agroalimentaire</div><div style="color:rgba(255,255,255,0.45);font-size:0.7rem;">Zéro contamination</div></div>
          <div style="text-align:center;padding:0.75rem;background:rgba(255,255,255,0.06);border-radius:8px;"><i class="fa-solid fa-microchip" style="color:var(--ir-orange);font-size:1.2rem;margin-bottom:0.4rem;"></i><div style="color:white;font-size:0.78rem;font-weight:600;font-family:'Montserrat',sans-serif;">Électronique</div><div style="color:rgba(255,255,255,0.45);font-size:0.7rem;">Salle blanche</div></div>
          <div style="text-align:center;padding:0.75rem;background:rgba(255,255,255,0.06);border-radius:8px;"><i class="fa-solid fa-flask" style="color:var(--ir-orange);font-size:1.2rem;margin-bottom:0.4rem;"></i><div style="color:white;font-size:0.78rem;font-weight:600;font-family:'Montserrat',sans-serif;">Chimie fine</div><div style="color:rgba(255,255,255,0.45);font-size:0.7rem;">Zéro réaction</div></div>
          <div style="text-align:center;padding:0.75rem;background:rgba(255,255,255,0.06);border-radius:8px;"><i class="fa-solid fa-wind" style="color:var(--ir-orange);font-size:1.2rem;margin-bottom:0.4rem;"></i><div style="color:white;font-size:0.78rem;font-weight:600;font-family:'Montserrat',sans-serif;">Aérospatial</div><div style="color:rgba(255,255,255,0.45);font-size:0.7rem;">Applications critiques</div></div>
          <div style="text-align:center;padding:0.75rem;background:rgba(255,255,255,0.06);border-radius:8px;"><i class="fa-solid fa-industry" style="color:var(--ir-orange);font-size:1.2rem;margin-bottom:0.4rem;"></i><div style="color:white;font-size:0.78rem;font-weight:600;font-family:'Montserrat',sans-serif;">Industrie du verre</div><div style="color:rgba(255,255,255,0.45);font-size:0.7rem;">Procédés sensibles</div></div>
        </div>
      </div>
    </div>

    <!-- PISTON -->
    <div class="ir-cat-section" id="ir-cat-piston">
      <h3 style="font-family:'Montserrat',sans-serif;color:var(--dark);margin-bottom:0.5rem;" <?= cms_field_attrs('cat_piston_title', 'text', 'Catégorie Piston — Titre', isset($c['cat_piston_title']) ? $c['cat_piston_title'] : '') ?>><?= isset($c['cat_piston_title']) && $c['cat_piston_title'] ? htmlspecialchars($c['cat_piston_title']) : 'Compresseurs à piston (Reciprocating)' ?></h3>
      <p style="color:var(--gray);margin-bottom:2rem;line-height:1.7;" <?= cms_field_attrs('cat_piston_desc', 'text', 'Catégorie Piston — Description', isset($c['cat_piston_desc']) ? $c['cat_piston_desc'] : '') ?>><?= isset($c['cat_piston_desc']) && $c['cat_piston_desc'] ? htmlspecialchars($c['cat_piston_desc']) : "Des solutions à piston pour chaque usage : de l'atelier professionnel à l'application industrielle haute pression jusqu'à 345 bar." ?></p>
      <div class="grid-auto fade-in">
        <div class="ir-card"><img src="https://www.compressorworld.com/assets/Ingersoll-Rand-2475-piston-air-compressor-vertical-tank.jpg" alt="Single Stage 3–5 HP" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/4489765/pexels-photo-4489765.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">1 étage</div><div class="ir-card-title">Single Stage 3–5 HP</div><div class="ir-card-power"><i class="fa-solid fa-gauge-high" style="color:var(--ir-orange);margin-right:0.3rem;"></i>Jusqu'à 9,3 bar (135 psig)</div><p class="ir-card-desc">Pour ateliers et petits garages. Réservoir vertical ASME 60 gallons. Conception robuste avec accès facile pour maintenance.</p><a href="<?= base_url('contact') ?>?product=IR-piston-1stage" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="ir-card"><img src="https://www.compressorworld.com/assets/Ingersoll-Rand-7100-two-stage-piston-air-compressor.jpg" alt="Two-Stage industriel" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/4489765/pexels-photo-4489765.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">2 étages — Industriel</div><div class="ir-card-title">Two-Stage Industriel</div><div class="ir-card-power"><i class="fa-solid fa-industry" style="color:var(--ir-orange);margin-right:0.3rem;"></i>Atelier intensif / industriel</div><p class="ir-card-desc">Pour applications d'atelier intensif. Modèle duplex électrique. Composants renouvelables pour maintenance économique.</p><a href="<?= base_url('contact') ?>?product=IR-piston-2stage" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="ir-card"><img src="https://www.compressorworld.com/assets/Ingersoll-Rand-15T2-High-Pressure-Piston-Air-Compressor.jpg" alt="High Pressure Reciprocating" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/8961139/pexels-photo-8961139.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">Ultra-haute pression</div><div class="ir-card-title">High Pressure Reciprocating</div><div class="ir-card-power"><i class="fa-solid fa-gauge-high" style="color:var(--ir-orange);margin-right:0.3rem;"></i>Jusqu'à 345 bar (5 000 psig)</div><p class="ir-card-desc">Technologie à piston à base montée. Jusqu'à 5 000 psig (345 bar). Applications : stations de ravitaillement, PBM, centrales électriques, démarrage de moteurs.</p><a href="<?= base_url('contact') ?>?product=IR-piston-HP" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
      </div>
    </div>

    <!-- CENTRIFUGES -->
    <div class="ir-cat-section" id="ir-cat-centrifuge">
      <h3 style="font-family:'Montserrat',sans-serif;color:var(--dark);margin-bottom:0.5rem;" <?= cms_field_attrs('cat_centri_title', 'text', 'Catégorie Centrifuges — Titre', isset($c['cat_centri_title']) ? $c['cat_centri_title'] : '') ?>><?= isset($c['cat_centri_title']) && $c['cat_centri_title'] ? htmlspecialchars($c['cat_centri_title']) : 'Compresseurs centrifuges' ?></h3>
      <p style="color:var(--gray);margin-bottom:2rem;line-height:1.7;" <?= cms_field_attrs('cat_centri_desc', 'text', 'Catégorie Centrifuges — Description', isset($c['cat_centri_desc']) ? $c['cat_centri_desc'] : '') ?>><?= isset($c['cat_centri_desc']) && $c['cat_centri_desc'] ? htmlspecialchars($c['cat_centri_desc']) : "Ingersoll Rand est leader mondial des compresseurs centrifuges pour applications industrielles lourdes — raffinerie, pétrochimie, séparation d'air, chimie." ?></p>
      <div class="grid-auto fade-in">
        <div class="ir-card"><img src="https://yscompressor.com/wp-content/uploads/2022/10/core-components.jpg" alt="CENTAC" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/3862130/pexels-photo-3862130.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">Centrifuge multi-étages</div><div class="ir-card-title">CENTAC®</div><div class="ir-card-power"><i class="fa-solid fa-rotate" style="color:var(--ir-orange);margin-right:0.3rem;"></i>Gamme historique — Grande capacité</div><p class="ir-card-desc">Compresseurs centrifuges multi-étages pour applications industrielles lourdes. Flux continus importants et pressions élevées. Séparation d'air, raffinerie, pétrochimie.</p><a href="<?= base_url('contact') ?>?product=IR-CENTAC" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="ir-card"><img src="https://yscompressor.com/wp-content/uploads/2022/10/Efficiency1.jpg" alt="TURBO-AIR" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/3862130/pexels-photo-3862130.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">Centrifuge turbo</div><div class="ir-card-title">TURBO-AIR®</div><div class="ir-card-power"><i class="fa-solid fa-rotate" style="color:var(--ir-orange);margin-right:0.3rem;"></i>Air &amp; gaz de procédé</div><p class="ir-card-desc">Compresseurs centrifuges à turbo pour air et gaz de procédé. Conçus pour les environnements industriels les plus exigeants avec haute fiabilité et performance continue.</p><a href="<?= base_url('contact') ?>?product=IR-TURBO-AIR" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="ir-card"><img src="https://yscompressor.com/wp-content/uploads/2022/10/easy-maintenance.jpg" alt="MSG" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/3862130/pexels-photo-3862130.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">Centrifuge procédé</div><div class="ir-card-title">MSG®</div><div class="ir-card-power"><i class="fa-solid fa-rotate" style="color:var(--ir-orange);margin-right:0.3rem;"></i>Grande capacité — Procédé industriel</div><p class="ir-card-desc">Compresseurs centrifuges à grande échelle pour industries de procédé. Gaz naturel, chimie, pétrochimie. Conçu pour les débits les plus importants.</p><a href="<?= base_url('contact') ?>?product=IR-MSG" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
      </div>
    </div>

    <!-- TRAITEMENT AIR -->
    <div class="ir-cat-section" id="ir-cat-airtreatment">
      <h3 style="font-family:'Montserrat',sans-serif;color:var(--dark);margin-bottom:0.5rem;" <?= cms_field_attrs('cat_air_title', 'text', 'Catégorie Traitement Air — Titre', isset($c['cat_air_title']) ? $c['cat_air_title'] : '') ?>><?= isset($c['cat_air_title']) && $c['cat_air_title'] ? htmlspecialchars($c['cat_air_title']) : "Traitement de l'air &amp; Accessoires" ?></h3>
      <p style="color:var(--gray);margin-bottom:2rem;line-height:1.7;" <?= cms_field_attrs('cat_air_desc', 'text', 'Catégorie Traitement Air — Description', isset($c['cat_air_desc']) ? $c['cat_air_desc'] : '') ?>><?= isset($c['cat_air_desc']) && $c['cat_air_desc'] ? htmlspecialchars($c['cat_air_desc']) : "Gamme complète de sécheurs, filtres, séparateurs et générateurs d'azote pour optimiser la qualité de votre air comprimé." ?></p>
      <div class="grid-auto fade-in">
        <div class="ir-card"><img src="https://www.compressorworld.com/assets/Ingersoll-Rand-Non-Cycling-Refrigerated-Air-Dryer.jpg" alt="Sécheurs IR" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/8961354/pexels-photo-8961354.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">Séchage</div><div class="ir-card-title">Sécheurs (Dryers)</div><p class="ir-card-desc">Sécheurs frigorifiques et à adsorption. Élimination de l'humidité, protection des équipements aval, conformité ISO 8572-1:2010.</p><a href="<?= base_url('contact') ?>?product=IR-dryers" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="ir-card"><img src="https://www.compressorworld.com/assets/Ingersoll-Rand-Modular-Heatless-Desiccant-Dryer.jpg" alt="Filtres IR" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/4489749/pexels-photo-4489749.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">Filtration</div><div class="ir-card-title">Filtres air comprimé</div><p class="ir-card-desc">Filtration multi-étages : particules, huile, micro-organismes. Conformité aux normes de qualité d'air les plus strictes.</p><a href="<?= base_url('contact') ?>?product=IR-filters" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="ir-card"><img src="https://www.compressorworld.com/assets/Ingersoll-Rand-Nirvana-Cycling-Refrigerated-Air-Dryer.jpg" alt="Générateurs N2" class="ir-card-img" onerror="this.src='https://images.pexels.com/photos/8961427/pexels-photo-8961427.jpeg?auto=compress&w=600'"><div class="ir-card-body"><div class="ir-card-label">Génération d'azote</div><div class="ir-card-title">Générateurs d'azote N2</div><p class="ir-card-desc">Génération d'azote sur site. Réduction de la dépendance aux livraisons de gaz. Pureté ajustable selon l'application. Fiabilité intégrée.</p><a href="<?= base_url('contact') ?>?product=IR-nitrogen" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
      </div>
    </div>

  </div>
</section>

<section class="section" style="background: linear-gradient(rgba(244,246,249,0.96), rgba(244,246,249,0.96)), url('https://images.pexels.com/photos/3861969/pexels-photo-3861969.jpeg?auto=compress&w=1920') center/cover fixed;">
  <div class="container">
    <div class="section-header fade-in">
      <span class="section-label">Innovation technologique</span>
      <h2 class="section-title">Technologies exclusives<br><span class="ir-accent">Ingersoll Rand</span></h2>
      <p class="section-subtitle">Quatre technologies brevetées qui distinguent les compresseurs Ingersoll Rand</p>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem;" class="fade-in">
      <div class="tech-card"><div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(29,103,205,0.1); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;"><i class="fa-solid fa-wifi" style="font-size: 1.3rem; color: var(--ir-orange);"></i></div><h3 style="font-family:'Montserrat',sans-serif; font-size: 1rem; color: var(--dark); margin-bottom: 0.4rem;">Helix® Connected Platform</h3><p style="color: var(--gray); font-size: 0.85rem; line-height: 1.7;">Plateforme IIoT pour surveillance en temps réel. Données actionnables, rapports de diagnostic, alertes préventives. Accessible via navigateur web ou application mobile. Maximise l'uptime.</p></div>
      <div class="tech-card"><div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(29,103,205,0.1); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;"><i class="fa-solid fa-shield-halved" style="font-size: 1.3rem; color: var(--ir-orange);"></i></div><h3 style="font-family:'Montserrat',sans-serif; font-size: 1rem; color: var(--dark); margin-bottom: 0.4rem;">V-Shield™ Technology</h3><p style="color: var(--gray); font-size: 0.85rem; line-height: 1.7;">Technologie zéro fuite brevetée. Tuyaux PTFE + joints O-ring assurent une étanchéité permanente sur toutes les connexions internes. Fiabilité renforcée, maintenance réduite.</p></div>
      <div class="tech-card"><div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(29,103,205,0.1); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;"><i class="fa-solid fa-brain" style="font-size: 1.3rem; color: var(--ir-orange);"></i></div><h3 style="font-family:'Montserrat',sans-serif; font-size: 1rem; color: var(--dark); margin-bottom: 0.4rem;">PAC® — Progressive Adaptive Control</h3><p style="color: var(--gray); font-size: 0.85rem; line-height: 1.7;">Système de contrôle adaptatif pour prévention des arrêts imprévus. Détecte et compense les variations de conditions d'exploitation avant qu'elles causent un arrêt.</p></div>
      <div class="tech-card"><div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(29,103,205,0.1); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;"><i class="fa-solid fa-boxes-stacked" style="font-size: 1.3rem; color: var(--ir-orange);"></i></div><h3 style="font-family:'Montserrat',sans-serif; font-size: 1rem; color: var(--dark); margin-bottom: 0.4rem;">Total Air System (TAS)</h3><p style="color: var(--gray); font-size: 0.85rem; line-height: 1.7;">Système tout-en-un intégrant compresseur + sécheur frigorifique + filtre dans un package unique. Installation simplifiée, encombrement réduit, gestion énergétique optimisée.</p></div>
    </div>
  </div>
</section>

<section class="section" style="background: white;">
  <div class="container">
    <div class="section-header fade-in">
      <span class="section-label">Secteurs d'activité</span>
      <h2 class="section-title">Ingersoll Rand au service<br>de <span class="ir-accent">toutes les industries</span></h2>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;" class="fade-in">
      <div style="padding: 1.5rem; background: #f8f9fa; border-radius: 12px; border-top: 3px solid var(--ir-orange);"><i class="fa-solid fa-wind" style="color: var(--ir-orange); font-size: 1.4rem; margin-bottom: 0.75rem;"></i><h4 style="font-family:'Montserrat',sans-serif; font-size: 0.9rem; color: var(--dark); margin-bottom: 0.4rem;">Aérospatial / Aviation</h4><p style="color: var(--gray); font-size: 0.8rem; line-height: 1.6;">Oil-Free Rotary Screw — Air pur certifié, applications critiques</p></div>
      <div style="padding: 1.5rem; background: #f8f9fa; border-radius: 12px; border-top: 3px solid var(--ir-orange);"><i class="fa-solid fa-car" style="color: var(--ir-orange); font-size: 1.4rem; margin-bottom: 0.75rem;"></i><h4 style="font-family:'Montserrat',sans-serif; font-size: 0.9rem; color: var(--dark); margin-bottom: 0.4rem;">Automobile</h4><p style="color: var(--gray); font-size: 0.8rem; line-height: 1.6;">R-Series — Peinture, outils, assemblage de précision</p></div>
      <div style="padding: 1.5rem; background: #f8f9fa; border-radius: 12px; border-top: 3px solid var(--ir-orange);"><i class="fa-solid fa-utensils" style="color: var(--ir-orange); font-size: 1.4rem; margin-bottom: 0.75rem;"></i><h4 style="font-family:'Montserrat',sans-serif; font-size: 0.9rem; color: var(--dark); margin-bottom: 0.4rem;">Agroalimentaire</h4><p style="color: var(--gray); font-size: 0.8rem; line-height: 1.6;">Oil-Free Cl.0 + Azote — Brasseries, embouteillage, conditionnement</p></div>
      <div style="padding: 1.5rem; background: #f8f9fa; border-radius: 12px; border-top: 3px solid var(--ir-orange);"><i class="fa-solid fa-pills" style="color: var(--ir-orange); font-size: 1.4rem; margin-bottom: 0.75rem;"></i><h4 style="font-family:'Montserrat',sans-serif; font-size: 0.9rem; color: var(--dark); margin-bottom: 0.4rem;">Pharmaceutique</h4><p style="color: var(--gray); font-size: 0.8rem; line-height: 1.6;">Oil-Free Cl.0 FDA — Conformité GMP/FDA, stérilité garantie</p></div>
      <div style="padding: 1.5rem; background: #f8f9fa; border-radius: 12px; border-top: 3px solid var(--ir-orange);"><i class="fa-solid fa-oil-can" style="color: var(--ir-orange); font-size: 1.4rem; margin-bottom: 0.75rem;"></i><h4 style="font-family:'Montserrat',sans-serif; font-size: 0.9rem; color: var(--dark); margin-bottom: 0.4rem;">Pétrole &amp; Gaz</h4><p style="color: var(--gray); font-size: 0.8rem; line-height: 1.6;">Centrifugal / Oil-Free — Offshore, onshore, certifié ATEX</p></div>
      <div style="padding: 1.5rem; background: #f8f9fa; border-radius: 12px; border-top: 3px solid var(--ir-orange);"><i class="fa-solid fa-mountain" style="color: var(--ir-orange); font-size: 1.4rem; margin-bottom: 0.75rem;"></i><h4 style="font-family:'Montserrat',sans-serif; font-size: 0.9rem; color: var(--dark); margin-bottom: 0.4rem;">Industrie minière</h4><p style="color: var(--gray); font-size: 0.8rem; line-height: 1.6;">R-Series renforcé — Environnements sévères, poussiéreux, exigeants</p></div>
    </div>
  </div>
</section>

<?php /* Documentation technique — s'affiche dès qu'un document est ajouté
         dans Admin → Documents & PDF pour la page « Ingersoll Rand ». */ ?>
<?php if (!empty($docs)): ?>
<section class="section" style="background: #f8f9fa;">
  <div class="container">
    <div class="section-header fade-in" style="text-align:center;margin-bottom:2.5rem;">
      <span class="section-label">Documentation technique</span>
      <h2 class="section-title">Catalogues &amp; Ressources <span class="ir-accent">Ingersoll Rand</span></h2>
      <p style="max-width:560px;margin:0 auto;">Téléchargez les brochures, fiches techniques et présentations officielles Ingersoll Rand.</p>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1rem;max-width:1000px;margin:0 auto;" class="fade-in">
      <?php foreach ($docs as $doc): ?>
      <a href="<?= doc_url($doc) ?>" target="_blank" rel="noopener" style="display:flex;align-items:center;gap:1rem;background:white;border:1px solid var(--border);border-left:4px solid var(--ir-orange);border-radius:10px;padding:1.1rem 1.25rem;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.boxShadow='var(--shadow)';this.style.transform='translateX(4px)'" onmouseout="this.style.boxShadow='';this.style.transform=''">
        <div style="width:40px;height:40px;background:rgba(232,80,26,0.08);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fa-solid <?= htmlspecialchars(doc_icon($doc)) ?>" style="color:var(--ir-orange);font-size:1.1rem;"></i></div>
        <div style="flex:1;min-width:0;"><div style="font-weight:600;font-size:0.88rem;color:var(--dark);"><?= htmlspecialchars($doc->title) ?></div><?php if ($doc->subtitle): ?><div style="font-size:0.75rem;color:var(--gray);"><?= htmlspecialchars($doc->subtitle) ?></div><?php endif; ?></div>
        <i class="fa-solid fa-arrow-down-to-line" style="color:var(--ir-orange);font-size:0.9rem;flex-shrink:0;"></i>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="section cta-section" <?= cms_section_attrs($c, 'ir_cta', "Appel à l'action") ?>>
  <div class="container">
    <div class="cta-content fade-in">
      <img src="<?= base_url('assets/logo/Ingersoll_Rand_logo.svg') ?>" alt="Ingersoll Rand" style="height:32px;filter:brightness(0) invert(1);margin-bottom:1.5rem;opacity:0.9;" onerror="this.style.display='none'">
      <h2 <?= cms_field_attrs('cta_title', 'text', 'Titre CTA', isset($c['cta_title']) ? $c['cta_title'] : '') ?>><?= (isset($c['cta_title']) && $c['cta_title']) ? htmlspecialchars($c['cta_title']) : 'Prêt à optimiser votre production ?' ?></h2>
      <p style="max-width:560px;margin:0 auto 2rem;" <?= cms_field_attrs('cta_subtitle', 'text', 'Texte CTA', isset($c['cta_subtitle']) ? $c['cta_subtitle'] : '') ?>><?= (isset($c['cta_subtitle']) && $c['cta_subtitle']) ? htmlspecialchars($c['cta_subtitle']) : "Contactez Royal Sales Cameroon pour une étude personnalisée de vos besoins et un devis Ingersoll Rand adapté à votre installation et à votre secteur d'activité." ?></p>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
        <a href="<?= (isset($c['cta_btn1_url']) && $c['cta_btn1_url']) ? htmlspecialchars($c['cta_btn1_url']) : base_url('contact') ?>"
           class="btn btn-accent btn-lg"
           <?= cms_field_attrs('cta_btn1_url', 'url', 'Bouton 1 — URL', isset($c['cta_btn1_url']) ? $c['cta_btn1_url'] : '') ?>>
          <i class="fa-solid fa-file-lines" style="margin-right:0.4rem;"></i>
          <span <?= cms_field_attrs('cta_btn1_text', 'text', 'Bouton 1 — Texte', isset($c['cta_btn1_text']) ? $c['cta_btn1_text'] : '') ?>><?= (isset($c['cta_btn1_text']) && $c['cta_btn1_text']) ? htmlspecialchars($c['cta_btn1_text']) : 'Demander un devis Ingersoll Rand' ?></span>
        </a>
        <a href="<?= (isset($c['cta_btn2_url']) && $c['cta_btn2_url']) ? htmlspecialchars($c['cta_btn2_url']) : 'tel:+237691123112' ?>"
           class="btn btn-lg" style="background:rgba(255,255,255,0.15);color:white;border:1px solid rgba(255,255,255,0.25);"
           <?= cms_field_attrs('cta_btn2_url', 'url', 'Bouton 2 — URL (tel:+237…)', isset($c['cta_btn2_url']) ? $c['cta_btn2_url'] : '') ?>>
          <i class="fa-solid fa-phone" style="margin-right:0.4rem;"></i>
          <span <?= cms_field_attrs('cta_btn2_text', 'text', 'Bouton 2 — Texte', isset($c['cta_btn2_text']) ? $c['cta_btn2_text'] : '') ?>><?= (isset($c['cta_btn2_text']) && $c['cta_btn2_text']) ? htmlspecialchars($c['cta_btn2_text']) : '+237 691 123 112' ?></span>
        </a>
      </div>
    </div>
  </div>
</section>

<script>
function showIRCat(cat, btn) {
  document.querySelectorAll('.ir-cat-section').forEach(s => s.classList.remove('visible'));
  document.querySelectorAll('.ir-filter-btn').forEach(b => b.classList.remove('active'));
  document.getElementById('ir-cat-' + cat)?.classList.add('visible');
  btn.classList.add('active');
  document.getElementById('ir-cat-' + cat)?.scrollIntoView({ behavior: 'smooth', block: 'start' });
}
</script>
