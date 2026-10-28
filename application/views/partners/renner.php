<style>
  :root { --renner: var(--primary); --renner-dark: var(--primary-dark); }
  .renner-accent { color: var(--renner); }
  .renner-badge { display: inline-flex; align-items: center; gap: 0.4rem; background: rgba(29,103,205,0.1); border: 1px solid rgba(29,103,205,0.25); color: var(--renner); padding: 0.25rem 0.75rem; border-radius: 50px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; font-family: 'Montserrat', sans-serif; }
  .renner-card { background: white; border-radius: 12px; overflow: hidden; border: 1px solid var(--border); transition: transform 0.2s, box-shadow 0.2s; }
  .renner-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,0.1); }
  .renner-card-img { width: 100%; height: 200px; object-fit: contain; background: #f8f9fa; padding: 1.5rem; border-bottom: 1px solid var(--border); }
  .renner-card-body { padding: 1.25rem 1.5rem 1.5rem; }
  .renner-card-label { font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; color: var(--renner); font-family: 'Montserrat', sans-serif; margin-bottom: 0.4rem; }
  .renner-card-title { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 0.4rem; font-family: 'Montserrat', sans-serif; }
  .renner-card-power { font-size: 0.8rem; color: var(--gray); margin-bottom: 0.75rem; }
  .renner-card-desc { font-size: 0.85rem; color: var(--gray); line-height: 1.6; margin-bottom: 1rem; }
  .spec-table { width: 100%; border-collapse: collapse; font-size: 0.82rem; }
  .spec-table th { background: var(--dark); color: white; padding: 0.6rem 0.75rem; text-align: left; font-family: 'Montserrat', sans-serif; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; }
  .spec-table td { padding: 0.55rem 0.75rem; border-bottom: 1px solid var(--border); color: var(--dark); }
  .spec-table tr:hover td { background: rgba(29,103,205,0.04); }
  .spec-table .model-name { font-weight: 700; color: var(--renner); font-family: 'Montserrat', sans-serif; }
  .renner-section-filter { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 2rem; }
  .renner-filter-btn { padding: 0.45rem 1rem; border-radius: 50px; border: 1px solid var(--border); background: white; color: var(--gray); font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: all 0.2s; font-family: 'Montserrat', sans-serif; }
  .renner-filter-btn.active, .renner-filter-btn:hover { background: var(--renner); color: white; border-color: var(--renner); }
  .cat-section { display: none; }
  .cat-section.visible { display: block; }
</style>

<section class="page-hero hero-carousel" style="padding: 5rem 0 4rem; min-height: 340px; display: flex; align-items: center; background: linear-gradient(135deg, #003d3e 0%, var(--dark) 80%);" <?= cms_section_attrs($c, 'hero', 'Bannière principale') ?>>
  <div class="hc-track">
    <div class="hc-slide active" style="background-image:url('<?= isset($c['slide1']) && $c['slide1'] ? base_url($c['slide1']) : 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=1920&q=60' ?>')" <?= cms_field_attrs('slide1', 'image', 'Image slide 1', isset($c['slide1']) ? $c['slide1'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide2']) && $c['slide2'] ? base_url($c['slide2']) : 'https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=1920&q=60' ?>')" <?= cms_field_attrs('slide2', 'image', 'Image slide 2', isset($c['slide2']) ? $c['slide2'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide3']) && $c['slide3'] ? base_url($c['slide3']) : 'https://images.unsplash.com/photo-1570126618953-d437176e8c79?w=1920&q=60' ?>')" <?= cms_field_attrs('slide3', 'image', 'Image slide 3', isset($c['slide3']) ? $c['slide3'] : '') ?>></div>
  </div>
  <div class="hc-overlay" style="background:rgba(0,40,40,0.82)"></div>
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= base_url() ?>" data-i18n="nav_home" style="color:rgba(255,255,255,0.6);">Accueil</a>
      <span style="color:rgba(255,255,255,0.4);">›</span>
      <span style="color:rgba(255,255,255,0.6);" data-i18n="about_partners">Partenaires</span>
      <span style="color:rgba(255,255,255,0.4);">›</span>
      <span style="color:white;">RENNER Kompressoren</span>
    </div>
    <div style="display: flex; align-items: center; gap: 2rem; flex-wrap: wrap; margin-top: 1.5rem;">
      <div style="flex: 1; min-width: 280px;">
        <div style="margin-bottom: 1rem;"><span class="renner-badge"><i class="fa-solid fa-certificate"></i> Distributeur Agréé Officiel</span></div>
        <h1 style="font-family:'Montserrat',sans-serif; font-size: clamp(2rem, 4vw, 3rem); font-weight: 900; color: white; line-height: 1.1; margin-bottom: 1rem;" <?= cms_field_attrs('hero_title', 'text', 'Titre principal', isset($c['hero_title']) ? $c['hero_title'] : '') ?>>
          <?= isset($c['hero_title']) && $c['hero_title'] ? htmlspecialchars($c['hero_title']) : 'RENNER Kompressoren' ?><br>
          <span style="color: var(--renner);" <?= cms_field_attrs('hero_subtitle', 'text', 'Sous-titre', isset($c['hero_subtitle']) ? $c['hero_subtitle'] : '') ?>><?= isset($c['hero_subtitle']) && $c['hero_subtitle'] ? htmlspecialchars($c['hero_subtitle']) : "L'Air Comprimé Made in Germany" ?></span>
        </h1>
        <p style="color: rgba(255,255,255,0.7); font-size: 1rem; line-height: 1.7; max-width: 560px; margin-bottom: 2rem;" <?= cms_field_attrs('about_text', 'html', 'Texte de présentation', isset($c['about_text']) ? $c['about_text'] : '') ?>>
          <?= isset($c['about_text']) && $c['about_text'] ? $c['about_text'] : "Fondée en 1994 en Allemagne, RENNER fabrique plus de 6 000 modèles de compresseurs industriels haute qualité. Royal Sales Cameroon est votre distributeur agréé officiel pour toute l'Afrique Centrale." ?>
        </p>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
          <a href="<?= base_url('contact') ?>" class="btn btn-accent"><i class="fa-solid fa-file-lines" style="margin-right: 0.4rem;"></i>Demander un devis</a>
          <a href="#gamme" class="btn" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2);"><i class="fa-solid fa-list" style="margin-right: 0.4rem;"></i>Voir la gamme</a>
        </div>
      </div>
      <div style="display: flex; flex-direction: column; gap: 1rem; min-width: 200px;">
        <img src="<?= base_url('assets/logo/Renner_logo.png') ?>" alt="RENNER Kompressoren" style="height: 48px; width: auto; filter: brightness(0) invert(1); object-fit: contain;" onerror="this.style.display='none'; this.insertAdjacentHTML('afterend','<span style=\'color:white;font-size:1.4rem;font-family:Montserrat,sans-serif;font-weight:900;\'>RENNER</span>')">
        <?php
        $_rn_stats = [
          1 => ['val' => 'stat1_value', 'd_val' => '1994',   'lbl' => 'stat1_label', 'd_lbl' => 'Fondée en'],
          2 => ['val' => 'stat2_value', 'd_val' => '6 000+', 'lbl' => 'stat2_label', 'd_lbl' => 'Modèles'],
          3 => ['val' => 'stat3_value', 'd_val' => '200+',   'lbl' => 'stat3_label', 'd_lbl' => 'Employés'],
          4 => ['val' => 'stat4_value', 'd_val' => 'ISO',    'lbl' => 'stat4_label', 'd_lbl' => '9001 certifié'],
        ];
        ?>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
          <?php foreach ($_rn_stats as $n => $s):
            $sv = (isset($c[$s['val']]) && $c[$s['val']]) ? $c[$s['val']] : $s['d_val'];
            $sl = (isset($c[$s['lbl']]) && $c[$s['lbl']]) ? $c[$s['lbl']] : $s['d_lbl'];
          ?>
          <div style="background: rgba(255,255,255,0.08); border-radius: 10px; padding: 0.75rem; text-align: center; border: 1px solid rgba(255,255,255,0.1);">
            <div style="font-size: 1.4rem; font-weight: 800; color: var(--renner); font-family: 'Montserrat',sans-serif;"
                 <?= cms_field_attrs('stat'.$n.'_value', 'text', 'Stat '.$n.' — Valeur', $sv) ?>><?= htmlspecialchars($sv) ?></div>
            <div style="font-size: 0.65rem; color: rgba(255,255,255,0.55); text-transform: uppercase; letter-spacing: 0.08em;"
                 <?= cms_field_attrs('stat'.$n.'_label', 'text', 'Stat '.$n.' — Libellé', $sl) ?>><?= htmlspecialchars($sl) ?></div>
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

<?php
$_rn_about_lbl  = (isset($c['about_section_title'])  && $c['about_section_title'])  ? $c['about_section_title']  : 'À propos de RENNER';
$_rn_about_h2   = (isset($c['about_section_h2'])     && $c['about_section_h2'])     ? $c['about_section_h2']     : "Entreprise familiale.<br>Qualité <span class=\"renner-accent\">allemande</span>.";
$_rn_about_d1   = (isset($c['about_desc1'])           && $c['about_desc1'])           ? $c['about_desc1']           : "RENNER GmbH Kompressoren est une entreprise familiale fondée en 1994 par Annette et Bernt Renner à Güglingen, Bade-Wurtemberg, Allemagne. Démarrée avec 3 employés dans un garage, elle compte aujourd'hui plus de 200 collaborateurs et livre des compresseurs sur tous les continents.";
$_rn_about_d2   = (isset($c['about_desc2'])           && $c['about_desc2'])           ? $c['about_desc2']           : "Toute la production est réalisée en Allemagne, avec des composants exclusivement issus de fabricants allemands reconnus. La certification <strong>DIN EN ISO 9001</strong> (depuis 2006) garantit des processus de fabrication ultra-modernes et une traçabilité totale de chaque machine.";
$_rn_about_img  = (isset($c['about_image'])           && $c['about_image'])           ? base_url($c['about_image']) : 'https://www.renner-kompressoren.de/fileadmin/_processed_/3/4/csm_Firmengeb%C3%A4ude_Banner_2024_2dad42fa95.png';
$_rn_web_url    = (isset($c['about_website_url'])     && $c['about_website_url'])     ? $c['about_website_url']    : 'https://www.renner-kompressoren.de';
$_rn_web_text   = (isset($c['about_website_text'])    && $c['about_website_text'])    ? $c['about_website_text']   : 'Site officiel RENNER';
$_rn_details = [
  ['l' => 'about_detail1_label', 'd_l' => 'Siège social',       'v' => 'about_detail1_value', 'd_v' => 'Güglingen, Bade-Wurtemberg, Allemagne'],
  ['l' => 'about_detail2_label', 'd_l' => 'Certification',      'v' => 'about_detail2_value', 'd_v' => 'DIN EN ISO 9001 depuis 2006'],
  ['l' => 'about_detail3_label', 'd_l' => 'Plage de puissance', 'v' => 'about_detail3_value', 'd_v' => '2,2 kW à 355 kW'],
  ['l' => 'about_detail4_label', 'd_l' => 'Pressions dispo.', 'v' => 'about_detail4_value', 'd_v' => '7 bar à 40 bar'],
];
?>
<section class="section" <?= cms_section_attrs($c, 'about_section', 'Section À propos') ?>>
  <div class="container">
    <div class="about-grid fade-in">
      <div>
        <span class="section-label" <?= cms_field_attrs('about_section_title', 'text', 'Label section', $_rn_about_lbl) ?>><?= htmlspecialchars($_rn_about_lbl) ?></span>
        <h2 class="section-title" <?= cms_field_attrs('about_section_h2', 'text', 'Titre H2', (isset($c['about_section_h2']) && $c['about_section_h2']) ? $c['about_section_h2'] : '') ?>><?= $_rn_about_h2 ?></h2>
        <p style="color:var(--gray);line-height:1.8;margin-bottom:1.25rem;" <?= cms_field_attrs('about_desc1', 'html', 'Paragraphe 1', (isset($c['about_desc1']) && $c['about_desc1']) ? $c['about_desc1'] : '') ?>><?= $_rn_about_d1 ?></p>
        <p style="color:var(--gray);line-height:1.8;margin-bottom:1.75rem;" <?= cms_field_attrs('about_desc2', 'html', 'Paragraphe 2', (isset($c['about_desc2']) && $c['about_desc2']) ? $c['about_desc2'] : '') ?>><?= $_rn_about_d2 ?></p>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.75rem;">
          <?php foreach ($_rn_details as $i => $det): $n = $i+1;
            $dl = (isset($c[$det['l']]) && $c[$det['l']]) ? $c[$det['l']] : $det['d_l'];
            $dv = (isset($c[$det['v']]) && $c[$det['v']]) ? $c[$det['v']] : $det['d_v'];
          ?>
          <div style="padding: 1rem; background: white; border-radius: 10px; border-left: 3px solid var(--renner); box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
            <div style="font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: var(--renner); margin-bottom: 0.3rem; font-family: 'Montserrat',sans-serif;"
                 <?= cms_field_attrs('about_detail'.$n.'_label', 'text', 'Détail '.$n.' — Label', $dl) ?>><?= htmlspecialchars($dl) ?></div>
            <div style="font-size: 0.9rem; color: var(--dark); font-weight: 500;"
                 <?= cms_field_attrs('about_detail'.$n.'_value', 'text', 'Détail '.$n.' — Valeur', $dv) ?>><?= htmlspecialchars($dv) ?></div>
          </div>
          <?php endforeach; ?>
        </div>
        <a href="<?= htmlspecialchars($_rn_web_url) ?>" target="_blank" rel="noopener" class="btn btn-outline"
           style="border-color: var(--renner); color: var(--renner);"
           <?= cms_field_attrs('about_website_url', 'url', 'URL site officiel', $_rn_web_url) ?>>
          <i class="fa-solid fa-arrow-up-right-from-square" style="margin-right: 0.4rem;"></i>
          <span <?= cms_field_attrs('about_website_text', 'text', 'Texte bouton site', $_rn_web_text) ?>><?= htmlspecialchars($_rn_web_text) ?></span>
        </a>
      </div>
      <div style="position: relative;">
        <img src="<?= htmlspecialchars($_rn_about_img) ?>" alt="À propos RENNER Kompressoren"
             style="width:100%; border-radius:16px; box-shadow:0 12px 40px rgba(0,0,0,0.15);"
             <?= cms_field_attrs('about_image', 'image', 'Image principale', (isset($c['about_image']) && $c['about_image']) ? $c['about_image'] : '') ?>
             onerror="this.src='<?= base_url('assets/images/Renner_patner/1.webp') ?>'">
      </div>
    </div>
  </div>
</section>

<section class="section" id="gamme" style="background: white;">
  <div class="container">
    <div class="section-header fade-in">
      <span class="section-label">Catalogue complet</span>
      <h2 class="section-title">La Gamme RENNER <span class="renner-accent">Kompressoren</span></h2>
      <p class="section-subtitle">De 2,2 kW à 355 kW — plus de 6 000 configurations disponibles sur commande</p>
    </div>

    <div class="renner-section-filter fade-in">
      <button class="renner-filter-btn active" onclick="showCat('vis', this)"><i class="fa-solid fa-gear" style="margin-right: 0.3rem;"></i>Compresseurs à vis</button>
      <button class="renner-filter-btn" onclick="showCat('oilfree', this)"><i class="fa-solid fa-droplet-slash" style="margin-right: 0.3rem;"></i>Sans huile</button>
      <button class="renner-filter-btn" onclick="showCat('piston', this)"><i class="fa-solid fa-arrows-up-down" style="margin-right: 0.3rem;"></i>À piston</button>
      <button class="renner-filter-btn" onclick="showCat('air', this)"><i class="fa-solid fa-wind" style="margin-right: 0.3rem;"></i>Traitement de l'air</button>
      <button class="renner-filter-btn" onclick="showCat('reservoirs', this)"><i class="fa-solid fa-database" style="margin-right: 0.3rem;"></i>Réservoirs &amp; Accessoires</button>
      <button class="renner-filter-btn" onclick="showCat('controle', this)"><i class="fa-solid fa-sliders" style="margin-right: 0.3rem;"></i>Systèmes de contrôle</button>
    </div>

    <!-- COMPRESSEURS À VIS -->
    <div class="cat-section visible" id="cat-vis">
      <h3 style="font-family:'Montserrat',sans-serif;color:var(--dark);margin-bottom:0.5rem;" <?= cms_field_attrs('cat_vis_title', 'text', 'Catégorie Vis — Titre', isset($c['cat_vis_title']) ? $c['cat_vis_title'] : '') ?>><?= isset($c['cat_vis_title']) && $c['cat_vis_title'] ? htmlspecialchars($c['cat_vis_title']) : "Compresseurs à vis injectés d'huile" ?></h3>
      <p style="color:var(--gray);margin-bottom:2rem;line-height:1.7;" <?= cms_field_attrs('cat_vis_desc', 'text', 'Catégorie Vis — Description', isset($c['cat_vis_desc']) ? $c['cat_vis_desc'] : '') ?>><?= isset($c['cat_vis_desc']) && $c['cat_vis_desc'] ? htmlspecialchars($c['cat_vis_desc']) : "Silencieux, compacts et conçus pour un fonctionnement continu — la série phare RENNER pour les applications industrielles et commerciales." ?></p>
      <div class="grid-auto fade-in">
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/b/8/csm_rs-b_fa4d63a9b3.png" alt="RENNER RS-B" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Vis lubrifiée — Courroie</div><div class="renner-card-title">RS-B</div><div class="renner-card-power"><i class="fa-solid fa-bolt" style="color:var(--renner);margin-right:0.3rem;"></i>2,2 – 11,0 kW &nbsp;|&nbsp; &lt; 10 bar</div><p class="renner-card-desc">Modèle d'entrée de gamme robuste, conçu pour les artisans et petites installations industrielles. Disponible avec réservoir, sécheur frigorifique et variateur de vitesse.</p><a href="<?= base_url('contact') ?>?product=RENNER-RS-B" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/0/3/csm_rs-pro_e1fc8dfe60.png" alt="RENNER RS-PRO" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Vis lubrifiée — Courroie</div><div class="renner-card-title">RS-PRO</div><div class="renner-card-power"><i class="fa-solid fa-bolt" style="color:var(--renner);margin-right:0.3rem;"></i>3,0 – 55,0 kW &nbsp;|&nbsp; &lt; 15 bar</div><p class="renner-card-desc">Gamme professionnelle polyvalente. Très économique, extrêmement fiable. Option récupération d'énergie intégrée jusqu'à 95% de la chaleur générée.</p><a href="<?= base_url('contact') ?>?product=RENNER-RS-PRO" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/f/e/csm_rs_78d5d2a83d.png" alt="RENNER RS 55-110 kW" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Vis lubrifiée — Courroie</div><div class="renner-card-title">RS</div><div class="renner-card-power"><i class="fa-solid fa-bolt" style="color:var(--renner);margin-right:0.3rem;"></i>55,0 – 110 kW &nbsp;|&nbsp; &lt; 15 bar</div><p class="renner-card-desc">Série haute puissance pour applications industrielles lourdes. Fonctionnement continu, composants de haute qualité issus de fabricants allemands reconnus. Garantie 2 ans.</p><a href="<?= base_url('contact') ?>?product=RENNER-RS-55-110" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/4/2/csm_rs-d_db9b69a010.png" alt="RENNER RSF-PRO 2" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1570126618953-d437176e8c79?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Vis — Entraînement direct</div><div class="renner-card-title">RSF-PRO 2 / RS 2</div><div class="renner-card-power"><i class="fa-solid fa-bolt" style="color:var(--renner);margin-right:0.3rem;"></i>5,5 – 355 kW &nbsp;|&nbsp; &lt; 15 bar</div><p class="renner-card-desc">Entraînement direct sans courroie — efficacité maximale. Version RSF = régulation de vitesse variable intégrée. Plage de puissance très étendue : 5,5 à 355 kW.</p><a href="<?= base_url('contact') ?>?product=RENNER-RSF-PRO" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/9/2/csm_rsf-revolution_014bac6315.png" alt="RENNER RSF-REvolution" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label" style="color: var(--accent);">Technologie IE4 — Premium</div><div class="renner-card-title">RSF-REvolution</div><div class="renner-card-power"><i class="fa-solid fa-bolt" style="color:var(--renner);margin-right:0.3rem;"></i>55 / 75 / 90 kW &nbsp;|&nbsp; <i class="fa-solid fa-leaf" style="color:green;margin-right:0.3rem;"></i>–35% énergie</div><p class="renner-card-desc">La toute dernière génération RENNER. Moteur IE4 haut rendement, économies d'énergie pouvant atteindre 35% par rapport à un compresseur conventionnel.</p><a href="<?= base_url('contact') ?>?product=RENNER-RSF-Revolution" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/c/6/csm_rs-h_72ff37d569.png" alt="RENNER RS-H haute pression" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1565034946487-077786996e27?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Vis — Haute pression</div><div class="renner-card-title">RS-H</div><div class="renner-card-power"><i class="fa-solid fa-bolt" style="color:var(--renner);margin-right:0.3rem;"></i>11,0 + 15,0 kW &nbsp;|&nbsp; &lt; 20 bar</div><p class="renner-card-desc">Compresseurs spéciaux pour applications nécessitant des pressions supérieures à la norme. Jusqu'à 20 bar. Entraînement par courroie.</p><a href="<?= base_url('contact') ?>?product=RENNER-RS-H" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/1/0/csm_booster_0fc2a2b949.png" alt="RENNER RS-M Booster" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Vis — Ultra-haute pression</div><div class="renner-card-title">RS-M Booster</div><div class="renner-card-power"><i class="fa-solid fa-bolt" style="color:var(--renner);margin-right:0.3rem;"></i>18,5 – 45,0 kW &nbsp;|&nbsp; &lt; 40 bar</div><p class="renner-card-desc">Compresseur Booster pour applications très haute pression jusqu'à 40 bar. Idéal pour production PET, gonflage haute pression et applications industrielles spécifiques.</p><a href="<?= base_url('contact') ?>?product=RENNER-RS-M-Booster" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/9/4/csm_heat_0cf1850e88.png" alt="RENNER récupération de chaleur" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label" style="color: green;">Option éco-énergie</div><div class="renner-card-title">Récupération de chaleur</div><div class="renner-card-power"><i class="fa-solid fa-leaf" style="color:green;margin-right:0.3rem;"></i>7,5 – 132 kW &nbsp;|&nbsp; Jusqu'à 95% récupéré</div><p class="renner-card-desc">Système intégré ou en boîtier externe permettant de récupérer jusqu'à 95% de la chaleur générée par la compression. Compatible séries RS-PRO, RSF-PRO et RS.</p><a href="<?= base_url('contact') ?>?product=RENNER-chaleur" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
      </div>
      <div class="fade-in" style="margin-top: 3rem; overflow-x: auto;">
        <h4 style="font-family:'Montserrat',sans-serif;margin-bottom:1rem;color:var(--dark);">Tableau comparatif — Compresseurs à vis</h4>
        <table class="spec-table">
          <thead><tr><th>Modèle</th><th>Puissance (kW)</th><th>Pression max.</th><th>Entraînement</th><th>Application principale</th></tr></thead>
          <tbody>
            <tr><td class="model-name">RS-B</td><td>2,2 – 11,0</td><td>&lt; 10 bar</td><td>Courroie</td><td>Artisanat / PME</td></tr>
            <tr><td class="model-name">RS-PRO</td><td>3,0 – 55,0</td><td>&lt; 15 bar</td><td>Courroie</td><td>Industrie légère</td></tr>
            <tr><td class="model-name">RS</td><td>55,0 – 110</td><td>&lt; 15 bar</td><td>Courroie</td><td>Grande industrie</td></tr>
            <tr><td class="model-name">RSF-PRO 2 / RS 2</td><td>5,5 – 355</td><td>&lt; 15 bar</td><td>Direct</td><td>Industrie / VSD</td></tr>
            <tr><td class="model-name">RSF-REvolution</td><td>55 / 75 / 90</td><td>&lt; 15 bar</td><td>Direct IE4</td><td>Efficacité maximale</td></tr>
            <tr><td class="model-name">RS-H</td><td>11,0 + 15,0</td><td>&lt; 20 bar</td><td>Courroie</td><td>Haute pression</td></tr>
            <tr><td class="model-name">RS-M Booster</td><td>18,5 – 45,0</td><td>&lt; 40 bar</td><td>Courroie</td><td>PET / Industrie spéc.</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- SANS HUILE -->
    <div class="cat-section" id="cat-oilfree">
      <h3 style="font-family:'Montserrat',sans-serif;color:var(--dark);margin-bottom:0.5rem;" <?= cms_field_attrs('cat_oilfree_title', 'text', 'Catégorie Sans Huile — Titre', isset($c['cat_oilfree_title']) ? $c['cat_oilfree_title'] : '') ?>><?= isset($c['cat_oilfree_title']) && $c['cat_oilfree_title'] ? htmlspecialchars($c['cat_oilfree_title']) : 'Compresseurs sans huile' ?></h3>
      <p style="color:var(--gray);margin-bottom:2rem;line-height:1.7;" <?= cms_field_attrs('cat_oilfree_desc', 'text', 'Catégorie Sans Huile — Description', isset($c['cat_oilfree_desc']) ? $c['cat_oilfree_desc'] : '') ?>><?= isset($c['cat_oilfree_desc']) && $c['cat_oilfree_desc'] ? htmlspecialchars($c['cat_oilfree_desc']) : "Pour les applications où la qualité de l'air est critique — industrie pharmaceutique, alimentaire, électronique, laboratoires. Air certifié 100% exempt d'huile." ?></p>
      <div class="grid-auto fade-in">
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/3/3/csm_oil-free_50f3306317.png" alt="RENNER SL-NEO scroll sans huile" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Scroll sans huile</div><div class="renner-card-title">SL-NEO I / S</div><div class="renner-card-power"><i class="fa-solid fa-droplet-slash" style="color:var(--renner);margin-right:0.3rem;"></i>100% sans huile &nbsp;|&nbsp; SuperSilent disponible</div><p class="renner-card-desc">Compresseurs scroll sans huile. Version Industry pour installations industrielles, version SuperSilent pour environnements sensibles (bureaux, cliniques, laboratoires).</p><a href="<?= base_url('contact') ?>?product=RENNER-SL-NEO" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/3/3/csm_oil-free_50f3306317.png" alt="RENNER SLM-S multi-têtes SuperSilent" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Scroll multi-têtes — SuperSilent</div><div class="renner-card-title">SLM-S</div><div class="renner-card-power"><i class="fa-solid fa-bolt" style="color:var(--renner);margin-right:0.3rem;"></i>7,5 – 30,0 kW &nbsp;|&nbsp; Ultra-silencieux</div><p class="renner-card-desc">Installation multi-têtes scroll sans huile de 7,5 à 30 kW. Conception SuperSilent. Idéale pour environnements sensibles nécessitant un débit important sans contamination.</p><a href="<?= base_url('contact') ?>?product=RENNER-SLM-S" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/3/3/csm_oil-free_50f3306317.png" alt="RENNER RSW injection d'eau" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Vis + injection d'eau</div><div class="renner-card-title">RSW</div><div class="renner-card-power"><i class="fa-solid fa-bolt" style="color:var(--renner);margin-right:0.3rem;"></i>18,5 – 120 kW &nbsp;|&nbsp; ISO 8573-1 Cl.0</div><p class="renner-card-desc">Technologie à injection d'eau permettant une compression totalement sans huile avec rendements très élevés. Air certifié ISO 8573-1 Classe 0. Pharmaceutique, agroalimentaire, chimie fine.</p><a href="<?= base_url('contact') ?>?product=RENNER-RSW" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
      </div>
      <div class="fade-in" style="margin-top: 2.5rem; background: var(--dark); border-radius: 16px; padding: 2rem; border-left: 4px solid var(--renner);">
        <h4 style="color: white; font-family:'Montserrat',sans-serif; margin-bottom: 1rem;">Industries cibles pour le sans huile</h4>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 1rem;">
          <div style="text-align:center;padding:0.75rem;background:rgba(255,255,255,0.06);border-radius:8px;"><i class="fa-solid fa-pills" style="color:var(--renner);font-size:1.2rem;margin-bottom:0.4rem;"></i><div style="color:white;font-size:0.8rem;font-weight:600;font-family:'Montserrat',sans-serif;">Pharmacie</div></div>
          <div style="text-align:center;padding:0.75rem;background:rgba(255,255,255,0.06);border-radius:8px;"><i class="fa-solid fa-utensils" style="color:var(--renner);font-size:1.2rem;margin-bottom:0.4rem;"></i><div style="color:white;font-size:0.8rem;font-weight:600;font-family:'Montserrat',sans-serif;">Agroalimentaire</div></div>
          <div style="text-align:center;padding:0.75rem;background:rgba(255,255,255,0.06);border-radius:8px;"><i class="fa-solid fa-microchip" style="color:var(--renner);font-size:1.2rem;margin-bottom:0.4rem;"></i><div style="color:white;font-size:0.8rem;font-weight:600;font-family:'Montserrat',sans-serif;">Électronique</div></div>
          <div style="text-align:center;padding:0.75rem;background:rgba(255,255,255,0.06);border-radius:8px;"><i class="fa-solid fa-flask" style="color:var(--renner);font-size:1.2rem;margin-bottom:0.4rem;"></i><div style="color:white;font-size:0.8rem;font-weight:600;font-family:'Montserrat',sans-serif;">Chimie fine</div></div>
          <div style="text-align:center;padding:0.75rem;background:rgba(255,255,255,0.06);border-radius:8px;"><i class="fa-solid fa-stethoscope" style="color:var(--renner);font-size:1.2rem;margin-bottom:0.4rem;"></i><div style="color:white;font-size:0.8rem;font-weight:600;font-family:'Montserrat',sans-serif;">Médical</div></div>
          <div style="text-align:center;padding:0.75rem;background:rgba(255,255,255,0.06);border-radius:8px;"><i class="fa-solid fa-building" style="color:var(--renner);font-size:1.2rem;margin-bottom:0.4rem;"></i><div style="color:white;font-size:0.8rem;font-weight:600;font-family:'Montserrat',sans-serif;">Laboratoires</div></div>
        </div>
      </div>
    </div>

    <!-- PISTON -->
    <div class="cat-section" id="cat-piston">
      <h3 style="font-family:'Montserrat',sans-serif;color:var(--dark);margin-bottom:0.5rem;" <?= cms_field_attrs('cat_piston_title', 'text', 'Catégorie Piston — Titre', isset($c['cat_piston_title']) ? $c['cat_piston_title'] : '') ?>><?= isset($c['cat_piston_title']) && $c['cat_piston_title'] ? htmlspecialchars($c['cat_piston_title']) : 'Compresseurs à piston' ?></h3>
      <p style="color:var(--gray);margin-bottom:2rem;line-height:1.7;" <?= cms_field_attrs('cat_piston_desc', 'text', 'Catégorie Piston — Description', isset($c['cat_piston_desc']) ? $c['cat_piston_desc'] : '') ?>><?= isset($c['cat_piston_desc']) && $c['cat_piston_desc'] ? htmlspecialchars($c['cat_piston_desc']) : "Trois séries pour les applications mobiles, légères et semi-industrielles. Fiabilité et économie pour les besoins courants en air comprimé." ?></p>
      <div class="grid-auto fade-in">
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/6/0/csm_kolben_c5a3a7b8ff.png" alt="RENNER REKO piston industriel" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Piston — Industriel</div><div class="renner-card-title">REKO</div><div class="renner-card-power"><i class="fa-solid fa-industry" style="color:var(--renner);margin-right:0.3rem;"></i>Usage industriel continu</div><p class="renner-card-desc">Série robuste pour applications industrielles continues. Conçus pour résister aux conditions d'utilisation exigeantes. Différentes configurations de puissance et pression.</p><a href="<?= base_url('contact') ?>?product=RENNER-REKO" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/6/0/csm_kolben_c5a3a7b8ff.png" alt="RENNER RIKO piston compact" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Piston — Compact</div><div class="renner-card-title">RIKO</div><div class="renner-card-power"><i class="fa-solid fa-wrench" style="color:var(--renner);margin-right:0.3rem;"></i>Ateliers &amp; applications mobiles</div><p class="renner-card-desc">Compresseurs à piston légers et compacts. Idéaux pour les ateliers, petites installations et applications mobiles. Rapport poids/performance optimisé.</p><a href="<?= base_url('contact') ?>?product=RENNER-RIKO" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/6/0/csm_kolben_c5a3a7b8ff.png" alt="RENNER RBK piston standard" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Piston — Standard</div><div class="renner-card-title">RBK</div><div class="renner-card-power"><i class="fa-solid fa-check-circle" style="color:var(--renner);margin-right:0.3rem;"></i>Fiable &amp; économique</div><p class="renner-card-desc">Gamme standard de compresseurs à piston. Fiables et économiques pour les besoins courants en air comprimé. Solution d'entrée de gamme performante.</p><a href="<?= base_url('contact') ?>?product=RENNER-RBK" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
      </div>
    </div>

    <!-- TRAITEMENT AIR -->
    <div class="cat-section" id="cat-air">
      <h3 style="font-family:'Montserrat',sans-serif;color:var(--dark);margin-bottom:0.5rem;" <?= cms_field_attrs('cat_air_title', 'text', 'Catégorie Air — Titre', isset($c['cat_air_title']) ? $c['cat_air_title'] : '') ?>><?= isset($c['cat_air_title']) && $c['cat_air_title'] ? htmlspecialchars($c['cat_air_title']) : "Traitement de l'air comprimé" ?></h3>
      <p style="color:var(--gray);margin-bottom:2rem;line-height:1.7;" <?= cms_field_attrs('cat_air_desc', 'text', 'Catégorie Air — Description', isset($c['cat_air_desc']) ? $c['cat_air_desc'] : '') ?>><?= isset($c['cat_air_desc']) && $c['cat_air_desc'] ? htmlspecialchars($c['cat_air_desc']) : "Gamme complète d'équipements pour assurer la qualité de l'air en sortie de compresseur. Conformité aux normes les plus strictes." ?></p>
      <div class="grid-auto fade-in">
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/c/2/csm_da_c015e8ec51.png" alt="Sécheurs RENNER" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Séchage</div><div class="renner-card-title">Sécheurs frigorifiques &amp; adsorption</div><p class="renner-card-desc">Sécheurs frigorifiques (point de rosée garanti) et sécheurs par adsorption (air ultra-sec, jusqu'à -70°C). Élimination de l'humidité par refroidissement ou dessiccation.</p><a href="<?= base_url('contact') ?>?product=RENNER-secheurs" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/c/2/csm_da_c015e8ec51.png" alt="Filtres RENNER" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Filtration</div><div class="renner-card-title">Filtres à air comprimé</div><p class="renner-card-desc">Filtration fine des particules, huile et micro-organismes. Séparateurs cycloniques RF-C pour élimination des grosses particules et condensats. Adsorbeurs charbon actif.</p><a href="<?= base_url('contact') ?>?product=RENNER-filtres" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/c/2/csm_da_c015e8ec51.png" alt="Purgeurs RENNER" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Condensats</div><div class="renner-card-title">Purgeurs &amp; Séparateurs huile/eau</div><p class="renner-card-desc">Purgeurs de condensats automatiques et séparateurs huile/eau pour traitement des condensats huileux avant rejet — conformité environnementale garantie.</p><a href="<?= base_url('contact') ?>?product=RENNER-purgeurs" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
      </div>
    </div>

    <!-- RÉSERVOIRS -->
    <div class="cat-section" id="cat-reservoirs">
      <h3 style="font-family:'Montserrat',sans-serif;color:var(--dark);margin-bottom:0.5rem;" <?= cms_field_attrs('cat_res_title', 'text', 'Catégorie Réservoirs — Titre', isset($c['cat_res_title']) ? $c['cat_res_title'] : '') ?>><?= isset($c['cat_res_title']) && $c['cat_res_title'] ? htmlspecialchars($c['cat_res_title']) : 'Réservoirs &amp; Accessoires' ?></h3>
      <p style="color:var(--gray);margin-bottom:2rem;line-height:1.7;" <?= cms_field_attrs('cat_res_desc', 'text', 'Catégorie Réservoirs — Description', isset($c['cat_res_desc']) ? $c['cat_res_desc'] : '') ?>><?= isset($c['cat_res_desc']) && $c['cat_res_desc'] ? htmlspecialchars($c['cat_res_desc']) : "Réservoirs d'air comprimé certifiés pression et flexibles haute pression pour compléter votre installation." ?></p>
      <div class="grid-auto fade-in">
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/4/9/csm_zubehoer_5b82f8f4da.png" alt="Réservoirs RENNER" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Stockage</div><div class="renner-card-title">Réservoirs air comprimé</div><p class="renner-card-desc">Différentes capacités, certifiés pression selon normes européennes. Verticaux et horizontaux. Compatibles avec toute la gamme de compresseurs RENNER.</p><a href="<?= base_url('contact') ?>?product=RENNER-reservoirs" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/4/9/csm_zubehoer_5b82f8f4da.png" alt="Flexibles RENNER" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Raccordement</div><div class="renner-card-title">Flexibles haute pression</div><p class="renner-card-desc">Flexibles de raccordement haute pression et robinets à bille électriques RKE ½–2". Automatisation de la coupure d'air et flexibilité d'installation.</p><a href="<?= base_url('contact') ?>?product=RENNER-flexibles" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
      </div>
    </div>

    <!-- CONTRÔLE -->
    <div class="cat-section" id="cat-controle">
      <h3 style="font-family:'Montserrat',sans-serif;color:var(--dark);margin-bottom:0.5rem;" <?= cms_field_attrs('cat_ctrl_title', 'text', 'Catégorie Contrôle — Titre', isset($c['cat_ctrl_title']) ? $c['cat_ctrl_title'] : '') ?>><?= isset($c['cat_ctrl_title']) && $c['cat_ctrl_title'] ? htmlspecialchars($c['cat_ctrl_title']) : 'Systèmes de contrôle &amp; supervision' ?></h3>
      <p style="color:var(--gray);margin-bottom:2rem;line-height:1.7;" <?= cms_field_attrs('cat_ctrl_desc', 'text', 'Catégorie Contrôle — Description', isset($c['cat_ctrl_desc']) ? $c['cat_ctrl_desc'] : '') ?>><?= isset($c['cat_ctrl_desc']) && $c['cat_ctrl_desc'] ? htmlspecialchars($c['cat_ctrl_desc']) : "Gestion intelligente de votre installation d'air comprimé — du contrôleur individuel au système de supervision multi-compresseurs." ?></p>
      <div class="grid-auto fade-in">
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/d/6/csm_control_touch_771c18427a.png" alt="RENNERtronic" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Contrôle individuel</div><div class="renner-card-title">RENNERtronic Touch</div><p class="renner-card-desc">Gestion intelligente du compresseur, protection automatique, affichage des paramètres opérationnels. Communication Modbus/Profibus disponible. Interface tactile intuitive.</p><a href="<?= base_url('contact') ?>?product=RENNER-rennertronic" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
        <div class="renner-card"><img src="https://www.renner-kompressoren.de/fileadmin/_processed_/d/6/csm_control_touch_771c18427a.png" alt="Contrôle supérieur RENNER" class="renner-card-img" onerror="this.src='https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=400&q=70'"><div class="renner-card-body"><div class="renner-card-label">Supervision multi-compresseurs</div><div class="renner-card-title">Contrôle supérieur</div><p class="renner-card-desc">Gestion centralisée de plusieurs compresseurs en réseau. Optimisation de la consommation énergétique globale. Intégration dans systèmes SCADA industriels.</p><a href="<?= base_url('contact') ?>?product=RENNER-supervision" class="btn btn-primary btn-sm">Demander un devis</a></div></div>
      </div>
    </div>

  </div>
</section>

<section class="section" style="background: linear-gradient(rgba(244,246,249,0.96), rgba(244,246,249,0.96)), url('https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=1920&q=40') center/cover fixed;">
  <div class="container">
    <div class="section-header fade-in">
      <span class="section-label">Pourquoi choisir RENNER</span>
      <h2 class="section-title">4 raisons de faire confiance<br>à <span class="renner-accent">RENNER</span></h2>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem;" class="fade-in">
      <div style="background: white; border-radius: 16px; padding: 2rem; border-top: 3px solid var(--renner); box-shadow: 0 4px 16px rgba(0,0,0,0.06);"><div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(29,103,205,0.1); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;"><i class="fa-solid fa-industry" style="font-size: 1.3rem; color: var(--renner);"></i></div><h3 style="font-family:'Montserrat',sans-serif; font-size: 1.05rem; color: var(--dark); margin-bottom: 0.6rem;">Made in Germany</h3><p style="color: var(--gray); font-size: 0.88rem; line-height: 1.7;">100% fabriqué en Allemagne, à Güglingen. Composants issus exclusivement de fabricants allemands. Certification DIN EN ISO 9001 depuis 2006. Qualité traçable et garantie.</p></div>
      <div style="background: white; border-radius: 16px; padding: 2rem; border-top: 3px solid var(--accent); box-shadow: 0 4px 16px rgba(0,0,0,0.06);"><div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(237,205,31,0.12); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;"><i class="fa-solid fa-shield-halved" style="font-size: 1.3rem; color: var(--accent);"></i></div><h3 style="font-family:'Montserrat',sans-serif; font-size: 1.05rem; color: var(--dark); margin-bottom: 0.6rem;">Programme SAFETY 5</h3><p style="color: var(--gray); font-size: 0.88rem; line-height: 1.7;">Extension de garantie optionnelle à 5 ans sur les compresseurs à vis RENNER éligibles. Un gage de confiance du fabricant dans la durabilité de ses produits. Garantie 2 ans standard incluse.</p></div>
      <div style="background: white; border-radius: 16px; padding: 2rem; border-top: 3px solid #22c55e; box-shadow: 0 4px 16px rgba(0,0,0,0.06);"><div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(34,197,94,0.1); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;"><i class="fa-solid fa-leaf" style="font-size: 1.3rem; color: #22c55e;"></i></div><h3 style="font-family:'Montserrat',sans-serif; font-size: 1.05rem; color: var(--dark); margin-bottom: 0.6rem;">Économies d'énergie</h3><p style="color: var(--gray); font-size: 0.88rem; line-height: 1.7;">L'énergie représente 78% du coût total d'un compresseur sur 5 ans. Avec un compresseur RSF à variateur de fréquence RENNER : jusqu'à 35% d'économies sur la facture énergétique.</p></div>
      <div style="background: white; border-radius: 16px; padding: 2rem; border-top: 3px solid var(--primary); box-shadow: 0 4px 16px rgba(0,0,0,0.06);"><div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(29,103,205,0.1); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;"><i class="fa-solid fa-layer-group" style="font-size: 1.3rem; color: var(--primary);"></i></div><h3 style="font-family:'Montserrat',sans-serif; font-size: 1.05rem; color: var(--dark); margin-bottom: 0.6rem;">Catalogue ultra-large</h3><p style="color: var(--gray); font-size: 0.88rem; line-height: 1.7;">Plus de 6 000 modèles configurables de 2,2 à 355 kW, 7 à 40 bar. Technologies à vis, piston et scroll. Options : avec/sans réservoir, sécheur intégré, variateur, récupération de chaleur.</p></div>
    </div>
    <div class="fade-in" style="margin-top: 3rem; background: var(--dark); border-radius: 20px; padding: 2.5rem; display: flex; flex-wrap: wrap; gap: 2rem; align-items: center; border-left: 4px solid var(--renner);">
      <div style="flex: 1; min-width: 240px;">
        <div style="font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.14em; color: var(--renner); margin-bottom: 0.5rem; font-family: 'Montserrat', sans-serif;">Coût total de possession</div>
        <h3 style="color: white; font-family: 'Montserrat',sans-serif; margin-bottom: 0.75rem;">78% du coût = énergie</h3>
        <p style="color: rgba(255,255,255,0.6); font-size: 0.88rem; line-height: 1.7; margin-bottom: 1.25rem;">Sur 5 ans d'utilisation, l'énergie représente 78% du coût total d'un compresseur. Investir dans un compresseur à variateur de vitesse RSF-PRO/RSF-REvolution est l'arbitrage économique le plus rentable.</p>
        <div style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
          <div style="text-align: center;"><div style="font-size: 2rem; font-weight: 800; color: var(--renner); font-family: 'Montserrat',sans-serif;">35%</div><div style="font-size: 0.72rem; color: rgba(255,255,255,0.5);">d'économies avec VSD</div></div>
          <div style="text-align: center;"><div style="font-size: 2rem; font-weight: 800; color: var(--accent); font-family: 'Montserrat',sans-serif;">95%</div><div style="font-size: 0.72rem; color: rgba(255,255,255,0.5);">chaleur récupérable</div></div>
          <div style="text-align: center;"><div style="font-size: 2rem; font-weight: 800; color: white; font-family: 'Montserrat',sans-serif;">5 ans</div><div style="font-size: 0.72rem; color: rgba(255,255,255,0.5);">garantie SAFETY 5</div></div>
        </div>
      </div>
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; min-width: 200px;">
        <div style="background: rgba(255,255,255,0.06); border-radius: 10px; padding: 1rem; text-align: center; border: 1px solid rgba(29,103,205,0.3);"><i class="fa-solid fa-bolt" style="color: var(--renner); font-size: 1.2rem; margin-bottom: 0.3rem;"></i><div style="color: white; font-size: 0.78rem; font-weight: 600;">78% — Énergie</div></div>
        <div style="background: rgba(255,255,255,0.06); border-radius: 10px; padding: 1rem; text-align: center; border: 1px solid rgba(255,255,255,0.1);"><i class="fa-solid fa-wrench" style="color: rgba(255,255,255,0.5); font-size: 1.2rem; margin-bottom: 0.3rem;"></i><div style="color: rgba(255,255,255,0.5); font-size: 0.78rem; font-weight: 600;">12% — Maintenance</div></div>
        <div style="background: rgba(255,255,255,0.06); border-radius: 10px; padding: 1rem; text-align: center; border: 1px solid rgba(255,255,255,0.1);"><i class="fa-solid fa-box" style="color: rgba(255,255,255,0.5); font-size: 1.2rem; margin-bottom: 0.3rem;"></i><div style="color: rgba(255,255,255,0.5); font-size: 0.78rem; font-weight: 600;">10% — Achat initial</div></div>
        <div style="background: rgba(255,255,255,0.06); border-radius: 10px; padding: 1rem; text-align: center; border: 1px solid rgba(255,255,255,0.1);"><i class="fa-solid fa-circle-xmark" style="color: rgba(255,255,255,0.5); font-size: 1.2rem; margin-bottom: 0.3rem;"></i><div style="color: rgba(255,255,255,0.5); font-size: 0.78rem; font-weight: 600;">≈0% — Autres</div></div>
      </div>
    </div>
  </div>
</section>

<?php if (!empty($docs)): ?>
<section class="section" style="background: var(--light);">
  <div class="container">
    <div class="section-header fade-in" style="text-align:center;margin-bottom:2.5rem;">
      <span class="section-badge" style="background:rgba(29,103,205,0.1);color:var(--renner);">Documentation technique</span>
      <h2>Catalogues &amp; Ressources RENNER</h2>
      <p style="max-width:560px;margin:0 auto;">Téléchargez les brochures, fiches techniques et présentations officielles RENNER Kompressoren.</p>
    </div>
    <?php /* Documents gérés dans Admin → Documents & PDF (table rsc_documents) */ ?>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1rem;max-width:1000px;margin:0 auto;" class="fade-in">

      <?php foreach ($docs as $doc): ?>
      <a href="<?= doc_url($doc) ?>" target="_blank" rel="noopener" style="display:flex;align-items:center;gap:1rem;background:white;border:1px solid var(--border);border-left:4px solid var(--renner);border-radius:10px;padding:1.1rem 1.25rem;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.boxShadow='var(--shadow)';this.style.transform='translateX(4px)'" onmouseout="this.style.boxShadow='';this.style.transform=''">
        <div style="width:40px;height:40px;background:rgba(29,103,205,0.08);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fa-solid <?= htmlspecialchars(doc_icon($doc)) ?>" style="color:var(--renner);font-size:1.1rem;"></i></div>
        <div style="flex:1;min-width:0;"><div style="font-weight:600;font-size:0.88rem;color:var(--text);"><?= htmlspecialchars($doc->title) ?></div><?php if ($doc->subtitle): ?><div style="font-size:0.75rem;color:var(--gray);"><?= htmlspecialchars($doc->subtitle) ?></div><?php endif; ?></div>
        <i class="fa-solid fa-arrow-down-to-line" style="color:var(--renner);font-size:0.9rem;flex-shrink:0;"></i>
      </a>
      <?php endforeach; ?>

    </div>
  </div>
</section>
<?php endif; ?>

<section class="section cta-section">
  <div class="container">
    <div class="cta-content fade-in">
      <img src="<?= base_url('assets/logo/Renner_logo.png') ?>" alt="RENNER" style="height:36px;filter:brightness(0) invert(1);margin-bottom:1.5rem;opacity:0.9;" onerror="this.style.display='none'">
      <h2 data-i18n="cta_title">Prêt à optimiser votre production ?</h2>
      <p style="max-width:560px;margin:0 auto 2rem;">Contactez Royal Sales Cameroon pour une étude personnalisée de vos besoins et un devis RENNER adapté à votre installation et à votre budget.</p>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
        <a href="<?= base_url('contact') ?>" class="btn btn-accent btn-lg"><i class="fa-solid fa-file-lines" style="margin-right:0.4rem;"></i>Demander un devis RENNER</a>
        <a href="tel:+237691123112" class="btn btn-lg" style="background:rgba(255,255,255,0.15);color:white;border:1px solid rgba(255,255,255,0.25);"><i class="fa-solid fa-phone" style="margin-right:0.4rem;"></i>+237 691 123 112</a>
      </div>
    </div>
  </div>
</section>

<script>
function showCat(cat, btn) {
  document.querySelectorAll('.cat-section').forEach(s => s.classList.remove('visible'));
  document.querySelectorAll('.renner-filter-btn').forEach(b => b.classList.remove('active'));
  document.getElementById('cat-' + cat)?.classList.add('visible');
  btn.classList.add('active');
  document.getElementById('cat-' + cat)?.scrollIntoView({ behavior: 'smooth', block: 'start' });
}
</script>
