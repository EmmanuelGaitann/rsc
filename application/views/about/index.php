<!-- PAGE HERO -->
<section class="page-hero hero-carousel" <?= cms_section_attrs($c, 'hero', 'Bannière principale') ?>>
  <div class="hc-track">
    <div class="hc-slide active" style="background-image:url('<?= isset($c['slide1']) && $c['slide1'] ? base_url($c['slide1']) : 'https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=1920&q=60' ?>')" <?= cms_field_attrs('slide1', 'image', 'Image slide 1', isset($c['slide1']) ? $c['slide1'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide2']) && $c['slide2'] ? base_url($c['slide2']) : 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=1920&q=60' ?>')" <?= cms_field_attrs('slide2', 'image', 'Image slide 2', isset($c['slide2']) ? $c['slide2'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide3']) && $c['slide3'] ? base_url($c['slide3']) : 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=1920&q=60' ?>')" <?= cms_field_attrs('slide3', 'image', 'Image slide 3', isset($c['slide3']) ? $c['slide3'] : '') ?>></div>
  </div>
  <div class="hc-overlay"></div>
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= base_url() ?>" data-i18n="nav_home">Accueil</a>
      <span>›</span>
      <span data-i18n="nav_about">À Propos</span>
    </div>
    <h1 <?= cms_field_attrs('hero_title', 'text', 'Titre de la bannière', isset($c['hero_title']) ? $c['hero_title'] : '') ?>><?= isset($c['hero_title']) && $c['hero_title'] ? htmlspecialchars($c['hero_title']) : 'À Propos de Royal Sales Cameroon' ?></h1>
    <p <?= cms_field_attrs('hero_subtitle', 'text', 'Sous-titre de la bannière', isset($c['hero_subtitle']) ? $c['hero_subtitle'] : '') ?>><?= isset($c['hero_subtitle']) && $c['hero_subtitle'] ? htmlspecialchars($c['hero_subtitle']) : 'Votre partenaire de confiance en équipements industriels' ?></p>
  </div>
  <button class="hc-prev" aria-label="Précédent"><i class="fa-solid fa-chevron-left"></i></button>
  <button class="hc-next" aria-label="Suivant"><i class="fa-solid fa-chevron-right"></i></button>
  <div class="hc-dots">
    <button class="hc-dot active" aria-label="Slide 1"></button>
    <button class="hc-dot" aria-label="Slide 2"></button>
    <button class="hc-dot" aria-label="Slide 3"></button>
  </div>
</section>

<!-- MISSION & VISION -->
<section class="section" style="background: linear-gradient(rgba(255,255,255,0.96), rgba(255,255,255,0.96)), url('https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=1920&q=50') center/cover no-repeat;" <?= cms_section_attrs($c, 'mission_vision', 'Mission & Vision') ?>>
  <div class="container">
    <div class="about-grid">
      <div class="fade-in">
        <span class="section-label" <?= cms_field_attrs('mission_title', 'text', 'Titre Mission', isset($c['mission_title']) ? $c['mission_title'] : '') ?>><?= isset($c['mission_title']) && $c['mission_title'] ? htmlspecialchars($c['mission_title']) : 'Notre mission' ?></span>
        <h2 class="section-title" <?= cms_field_attrs('mission_headline', 'text', 'Titre principal Mission', isset($c['mission_headline']) ? $c['mission_headline'] : '') ?>><?= isset($c['mission_headline']) && $c['mission_headline'] ? htmlspecialchars($c['mission_headline']) : 'Fiabilité, expertise et service de proximité' ?></h2>
        <p style="color:var(--gray);line-height:1.8;margin-bottom:1.5rem;" <?= cms_field_attrs('mission_text', 'html', 'Texte Mission', isset($c['mission_text']) ? $c['mission_text'] : '') ?>><?= isset($c['mission_text']) && $c['mission_text'] ? $c['mission_text'] : "Fournir aux industriels d'Afrique Centrale des solutions de compression d'air fiables, performantes et économes en énergie, avec un service après-vente de haute qualité." ?></p>
        <div style="background:var(--light);border-left:4px solid var(--accent);padding:1.25rem 1.5rem;border-radius:0 8px 8px 0;margin-bottom:1.5rem;">
          <h4 style="color:var(--dark);margin-bottom:0.4rem;" <?= cms_field_attrs('vision_title', 'text', 'Titre Vision', isset($c['vision_title']) ? $c['vision_title'] : '') ?>><?= isset($c['vision_title']) && $c['vision_title'] ? htmlspecialchars($c['vision_title']) : 'Notre Vision' ?></h4>
          <p style="color:var(--gray);font-size:0.95rem;" <?= cms_field_attrs('vision_text', 'html', 'Texte Vision', isset($c['vision_text']) ? $c['vision_text'] : '') ?>><?= isset($c['vision_text']) && $c['vision_text'] ? $c['vision_text'] : "Devenir le leader régional en solutions de compression d'air industrielle, reconnu pour la qualité de nos produits et l'excellence de notre service." ?></p>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-top:1.5rem;">
          <div style="text-align:center;padding:1.25rem;background:var(--primary-light);border-radius:10px;">
            <div style="font-size:2rem;font-weight:800;color:var(--primary);" <?= cms_field_attrs('stat1_value', 'text', 'Stat 1 — Valeur', isset($c['stat1_value']) ? $c['stat1_value'] : '') ?>><?= isset($c['stat1_value']) && $c['stat1_value'] ? htmlspecialchars($c['stat1_value']) : '5' ?></div>
            <div style="font-size:0.85rem;color:var(--gray);" <?= cms_field_attrs('stat1_label', 'text', 'Stat 1 — Libellé', isset($c['stat1_label']) ? $c['stat1_label'] : '') ?>><?= isset($c['stat1_label']) && $c['stat1_label'] ? htmlspecialchars($c['stat1_label']) : 'Ans de garantie fabricant' ?></div>
          </div>
          <div style="text-align:center;padding:1.25rem;background:var(--primary-light);border-radius:10px;">
            <div style="font-size:2rem;font-weight:800;color:var(--primary);" <?= cms_field_attrs('stat2_value', 'text', 'Stat 2 — Valeur', isset($c['stat2_value']) ? $c['stat2_value'] : '') ?>><?= isset($c['stat2_value']) && $c['stat2_value'] ? htmlspecialchars($c['stat2_value']) : '12h' ?></div>
            <div style="font-size:0.85rem;color:var(--gray);" <?= cms_field_attrs('stat2_label', 'text', 'Stat 2 — Libellé', isset($c['stat2_label']) ? $c['stat2_label'] : '') ?>><?= isset($c['stat2_label']) && $c['stat2_label'] ? htmlspecialchars($c['stat2_label']) : "Délai d'intervention urgence" ?></div>
          </div>
          <div style="text-align:center;padding:1.25rem;background:var(--primary-light);border-radius:10px;">
            <div style="font-size:2rem;font-weight:800;color:var(--primary);" <?= cms_field_attrs('stat3_value', 'text', 'Stat 3 — Valeur', isset($c['stat3_value']) ? $c['stat3_value'] : '') ?>><?= isset($c['stat3_value']) && $c['stat3_value'] ? htmlspecialchars($c['stat3_value']) : '100%' ?></div>
            <div style="font-size:0.85rem;color:var(--gray);" <?= cms_field_attrs('stat3_label', 'text', 'Stat 3 — Libellé', isset($c['stat3_label']) ? $c['stat3_label'] : '') ?>><?= isset($c['stat3_label']) && $c['stat3_label'] ? htmlspecialchars($c['stat3_label']) : "Pièces d'origine certifiées" ?></div>
          </div>
          <div style="text-align:center;padding:1.25rem;background:var(--primary-light);border-radius:10px;">
            <div style="font-size:2rem;font-weight:800;color:var(--primary);" <?= cms_field_attrs('stat4_value', 'text', 'Stat 4 — Valeur', isset($c['stat4_value']) ? $c['stat4_value'] : '') ?>><?= isset($c['stat4_value']) && $c['stat4_value'] ? htmlspecialchars($c['stat4_value']) : '7j/7' ?></div>
            <div style="font-size:0.85rem;color:var(--gray);" <?= cms_field_attrs('stat4_label', 'text', 'Stat 4 — Libellé', isset($c['stat4_label']) ? $c['stat4_label'] : '') ?>><?= isset($c['stat4_label']) && $c['stat4_label'] ? htmlspecialchars($c['stat4_label']) : 'Support technique disponible' ?></div>
          </div>
        </div>
      </div>
      <div class="about-img-wrap fade-in" <?= cms_field_attrs('main_img', 'image', 'Image principale (À propos)', isset($c['main_img']) ? $c['main_img'] : '') ?>>
        <img src="<?= isset($c['main_img']) && $c['main_img'] ? base_url($c['main_img']) : 'https://images.pexels.com/photos/3862634/pexels-photo-3862634.jpeg?auto=compress&w=800' ?>" alt="Équipe d'ingénieurs Royal Sales Cameroon sur chantier industriel en Afrique Centrale" style="width:100%;height:500px;object-fit:cover;border-radius:16px;">
      </div>
    </div>
  </div>
</section>

<!-- ENGAGEMENTS -->
<section class="section bg-light" <?= cms_section_attrs($c, 'engagements', 'Section Engagements') ?>>
  <div class="container">
    <div class="section-header fade-in">
      <span class="section-label" <?= cms_field_attrs('eng_label', 'text', 'Engagements — Libellé', isset($c['eng_label']) ? $c['eng_label'] : '') ?>><?= isset($c['eng_label']) && $c['eng_label'] ? htmlspecialchars($c['eng_label']) : 'Nos engagements' ?></span>
      <h2 class="section-title" <?= cms_field_attrs('eng_title', 'text', 'Engagements — Titre', isset($c['eng_title']) ? $c['eng_title'] : '') ?>><?= isset($c['eng_title']) && $c['eng_title'] ? htmlspecialchars($c['eng_title']) : 'Pourquoi choisir Royal Sales Cameroon ?' ?></h2>
    </div>
    <div class="grid-3" style="gap:1.5rem;">
      <div class="card fade-in" style="text-align:center;padding:2rem;">
        <div style="font-size:2.5rem;color:var(--primary);margin-bottom:1rem;"><i class="fa-solid fa-certificate"></i></div>
        <h3 style="margin-bottom:0.75rem;" <?= cms_field_attrs('eng1_title', 'text', 'Engagement 1 — Titre', isset($c['eng1_title']) ? $c['eng1_title'] : '') ?>><?= isset($c['eng1_title']) && $c['eng1_title'] ? htmlspecialchars($c['eng1_title']) : "Pièces d'Origine" ?></h3>
        <p style="color:var(--gray);font-size:0.9rem;line-height:1.7;" <?= cms_field_attrs('eng1_text', 'text', 'Engagement 1 — Texte', isset($c['eng1_text']) ? $c['eng1_text'] : '') ?>><?= isset($c['eng1_text']) && $c['eng1_text'] ? htmlspecialchars($c['eng1_text']) : "100% de pièces détachées certifiées d'origine fabricant pour une durée de vie maximale." ?></p>
      </div>
      <div class="card fade-in" style="text-align:center;padding:2rem;">
        <div style="font-size:2.5rem;color:var(--primary);margin-bottom:1rem;"><i class="fa-solid fa-headset"></i></div>
        <h3 style="margin-bottom:0.75rem;" <?= cms_field_attrs('eng2_title', 'text', 'Engagement 2 — Titre', isset($c['eng2_title']) ? $c['eng2_title'] : '') ?>><?= isset($c['eng2_title']) && $c['eng2_title'] ? htmlspecialchars($c['eng2_title']) : 'Support Réactif' ?></h3>
        <p style="color:var(--gray);font-size:0.9rem;line-height:1.7;" <?= cms_field_attrs('eng2_text', 'text', 'Engagement 2 — Texte', isset($c['eng2_text']) ? $c['eng2_text'] : '') ?>><?= isset($c['eng2_text']) && $c['eng2_text'] ? htmlspecialchars($c['eng2_text']) : "Intervention d'urgence sous 24h, support technique disponible 7j/7 pour vos équipements." ?></p>
      </div>
      <div class="card fade-in" style="text-align:center;padding:2rem;">
        <div style="font-size:2.5rem;color:var(--primary);margin-bottom:1rem;"><i class="fa-solid fa-earth-africa"></i></div>
        <h3 style="margin-bottom:0.75rem;" <?= cms_field_attrs('eng3_title', 'text', 'Engagement 3 — Titre', isset($c['eng3_title']) ? $c['eng3_title'] : '') ?>><?= isset($c['eng3_title']) && $c['eng3_title'] ? htmlspecialchars($c['eng3_title']) : 'Expertise Locale' ?></h3>
        <p style="color:var(--gray);font-size:0.9rem;line-height:1.7;" <?= cms_field_attrs('eng3_text', 'text', 'Engagement 3 — Texte', isset($c['eng3_text']) ? $c['eng3_text'] : '') ?>><?= isset($c['eng3_text']) && $c['eng3_text'] ? htmlspecialchars($c['eng3_text']) : "Présence au Cameroun depuis des années, nous connaissons les spécificités industrielles locales." ?></p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section fade-in" <?= cms_section_attrs($c, 'cta', 'Appel à l\'action') ?>>
  <div class="container" style="position:relative;z-index:1;">
    <h2 <?= cms_field_attrs('cta_title', 'text', 'CTA — Titre', isset($c['cta_title']) ? $c['cta_title'] : '') ?>><?= isset($c['cta_title']) && $c['cta_title'] ? htmlspecialchars($c['cta_title']) : 'Prêt à travailler avec nous ?' ?></h2>
    <p <?= cms_field_attrs('cta_subtitle', 'text', 'CTA — Sous-titre', isset($c['cta_subtitle']) ? $c['cta_subtitle'] : '') ?>><?= isset($c['cta_subtitle']) && $c['cta_subtitle'] ? htmlspecialchars($c['cta_subtitle']) : 'Contactez notre équipe pour une étude personnalisée de vos besoins.' ?></p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
      <a href="<?= cta_url($c['cta_btn_url'] ?? '', base_url('contact')) ?>"
         class="btn btn-accent btn-lg"
         <?= cms_field_attrs('cta_btn_url', 'url', 'CTA — Bouton URL', $c['cta_btn_url'] ?? '') ?>>
        <i class="fa-solid fa-paper-plane" style="margin-right:0.4rem;"></i>
        <span <?= cms_field_attrs('cta_btn_text', 'text', 'CTA — Bouton Texte', $c['cta_btn_text'] ?? '') ?>><?= ($c['cta_btn_text'] ?? '') ? htmlspecialchars($c['cta_btn_text']) : 'Demander un devis' ?></span>
      </a>
      <a href="<?= cta_url($c['cta_phone_url'] ?? '', 'tel:+237691123112') ?>"
         class="btn btn-outline-light btn-lg"
         <?= cms_field_attrs('cta_phone_url', 'url', 'CTA — Téléphone URL', $c['cta_phone_url'] ?? '') ?>>
        <i class="fa-solid fa-phone" style="margin-right:0.4rem;"></i>
        <span <?= cms_field_attrs('cta_phone_text', 'text', 'CTA — Téléphone Texte', $c['cta_phone_text'] ?? '') ?>><?= ($c['cta_phone_text'] ?? '') ? htmlspecialchars($c['cta_phone_text']) : '+237 691 123 112' ?></span>
      </a>
    </div>
  </div>
</section>
