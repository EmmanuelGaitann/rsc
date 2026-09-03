<!-- HERO -->
<section class="hero hero-carousel" <?= cms_section_attrs($c, 'hero', 'Section Héros') ?>>
  <div class="hc-track">
    <div class="hc-slide active" style="background-image:url('<?= isset($c['slide1']) && $c['slide1'] ? base_url($c['slide1']) : base_url('assets/images/back1.jpg') ?>')" <?= cms_field_attrs('slide1', 'image', 'Image slide 1', isset($c['slide1']) ? $c['slide1'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide2']) && $c['slide2'] ? base_url($c['slide2']) : 'https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=1920&q=60' ?>')" <?= cms_field_attrs('slide2', 'image', 'Image slide 2', isset($c['slide2']) ? $c['slide2'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide3']) && $c['slide3'] ? base_url($c['slide3']) : 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=1920&q=60' ?>')" <?= cms_field_attrs('slide3', 'image', 'Image slide 3', isset($c['slide3']) ? $c['slide3'] : '') ?>></div>
  </div>
  <div class="hero-accent-bar"></div>
  <div class="hero-content">
    <div>
      <div class="hero-badge">
        <span class="hero-badge-dot"></span>
        <span <?= cms_field_attrs('hero_badge', 'text', 'Badge héros', isset($c['hero_badge']) ? $c['hero_badge'] : '') ?>
              <?= (!isset($c['hero_badge']) || !$c['hero_badge']) ? 'data-i18n="hero_badge"' : '' ?>>
          <?= (isset($c['hero_badge']) && $c['hero_badge']) ? htmlspecialchars($c['hero_badge']) : 'Distributeurs Agréés RENNER &amp; Ingersoll Rand — Afrique Centrale' ?>
        </span>
      </div>
      <h1 class="hero-title">
        <span data-i18n="hero_title_1" <?= cms_field_attrs('hero_title_1', 'text', 'Titre héros — Ligne 1', isset($c['hero_title_1']) ? $c['hero_title_1'] : '') ?>>
          <?= (isset($c['hero_title_1']) && $c['hero_title_1']) ? htmlspecialchars($c['hero_title_1']) : 'Votre Expert en' ?>
        </span><br>
        <span class="accent" data-i18n="hero_title_2" <?= cms_field_attrs('hero_title_2', 'text', 'Titre héros — Ligne 2 (accent)', isset($c['hero_title_2']) ? $c['hero_title_2'] : '') ?>>
          <?= (isset($c['hero_title_2']) && $c['hero_title_2']) ? htmlspecialchars($c['hero_title_2']) : "Compression d'Air" ?>
        </span><br>
        <span data-i18n="hero_title_3" <?= cms_field_attrs('hero_title_3', 'text', 'Titre héros — Ligne 3', isset($c['hero_title_3']) ? $c['hero_title_3'] : '') ?>>
          <?= (isset($c['hero_title_3']) && $c['hero_title_3']) ? htmlspecialchars($c['hero_title_3']) : 'en Afrique Centrale' ?>
        </span>
      </h1>
      <p class="hero-desc"
         <?= cms_field_attrs('hero_desc', 'html', 'Description héros', isset($c['hero_desc']) ? $c['hero_desc'] : '') ?>
         <?= (!isset($c['hero_desc']) || !$c['hero_desc']) ? 'data-i18n="hero_desc"' : '' ?>
         style="text-align: justify;">
        <?= (isset($c['hero_desc']) && $c['hero_desc']) ? $c['hero_desc'] : "Royal Sales Cameroon est votre spécialiste en compression d'air industrielle en Afrique Centrale. Vente, installation, maintenance et support technique pour toutes marques — RENNER Kompressoren et Ingersoll Rand — à Douala et dans toute la région." ?>
      </p>
      <div class="hero-actions">
        <a href="<?= (isset($c['hero_btn1_url']) && $c['hero_btn1_url']) ? htmlspecialchars($c['hero_btn1_url']) : base_url('produits') ?>"
           class="btn btn-primary btn-lg"
           <?= cms_field_attrs('hero_btn1_url', 'url', 'Bouton 1 — URL', isset($c['hero_btn1_url']) ? $c['hero_btn1_url'] : '') ?>>
          <span data-i18n="hero_cta1" <?= cms_field_attrs('hero_btn1_text', 'text', 'Bouton 1 — Texte', isset($c['hero_btn1_text']) ? $c['hero_btn1_text'] : '') ?>>
            <?= (isset($c['hero_btn1_text']) && $c['hero_btn1_text']) ? htmlspecialchars($c['hero_btn1_text']) : 'Découvrir nos produits' ?>
          </span>
        </a>
        <a href="<?= (isset($c['hero_btn2_url']) && $c['hero_btn2_url']) ? htmlspecialchars($c['hero_btn2_url']) : base_url('contact') ?>"
           class="btn btn-outline-light btn-lg"
           <?= cms_field_attrs('hero_btn2_url', 'url', 'Bouton 2 — URL', isset($c['hero_btn2_url']) ? $c['hero_btn2_url'] : '') ?>>
          <span data-i18n="hero_cta2" <?= cms_field_attrs('hero_btn2_text', 'text', 'Bouton 2 — Texte', isset($c['hero_btn2_text']) ? $c['hero_btn2_text'] : '') ?>>
            <?= (isset($c['hero_btn2_text']) && $c['hero_btn2_text']) ? htmlspecialchars($c['hero_btn2_text']) : 'Nous contacter' ?>
          </span>
        </a>
      </div>
    </div>
    <div class="hero-image">
      <img style="border-radius: 30px;"
           src="<?= (isset($c['hero_side_image']) && $c['hero_side_image']) ? base_url($c['hero_side_image']) : base_url('assets/images/pexels-alshreef-29411310.jpg') ?>"
           alt="Ingénieur africain en casque sur site industriel — Royal Sales Cameroon"
           loading="eager"
           <?= cms_field_attrs('hero_side_image', 'image', 'Image héros — Photo côté droit', isset($c['hero_side_image']) ? $c['hero_side_image'] : '') ?>>
    </div>
  </div>
  <div class="hero-stats">
    <div class="hero-stats-inner">
      <div class="hero-stat">
        <strong data-i18n="hero_stat1" <?= cms_field_attrs('stat1_value', 'text', 'Stat 1 — Valeur', isset($c['stat1_value']) ? $c['stat1_value'] : '') ?>>
          <?= (isset($c['stat1_value']) && $c['stat1_value']) ? htmlspecialchars($c['stat1_value']) : '5 ans' ?>
        </strong>
        <span data-i18n="hero_stat1_label" <?= cms_field_attrs('stat1_label', 'text', 'Stat 1 — Libellé', isset($c['stat1_label']) ? $c['stat1_label'] : '') ?>>
          <?= (isset($c['stat1_label']) && $c['stat1_label']) ? htmlspecialchars($c['stat1_label']) : 'Garantie fabricant' ?>
        </span>
      </div>
      <div class="hero-stat">
        <strong data-i18n="hero_stat2" <?= cms_field_attrs('stat2_value', 'text', 'Stat 2 — Valeur', isset($c['stat2_value']) ? $c['stat2_value'] : '') ?>>
          <?= (isset($c['stat2_value']) && $c['stat2_value']) ? htmlspecialchars($c['stat2_value']) : '24h' ?>
        </strong>
        <span data-i18n="hero_stat2_label" <?= cms_field_attrs('stat2_label', 'text', 'Stat 2 — Libellé', isset($c['stat2_label']) ? $c['stat2_label'] : '') ?>>
          <?= (isset($c['stat2_label']) && $c['stat2_label']) ? htmlspecialchars($c['stat2_label']) : 'Intervention urgence' ?>
        </span>
      </div>
      <div class="hero-stat">
        <strong data-i18n="hero_stat3" <?= cms_field_attrs('stat3_value', 'text', 'Stat 3 — Valeur', isset($c['stat3_value']) ? $c['stat3_value'] : '') ?>>
          <?= (isset($c['stat3_value']) && $c['stat3_value']) ? htmlspecialchars($c['stat3_value']) : '100%' ?>
        </strong>
        <span data-i18n="hero_stat3_label" <?= cms_field_attrs('stat3_label', 'text', 'Stat 3 — Libellé', isset($c['stat3_label']) ? $c['stat3_label'] : '') ?>>
          <?= (isset($c['stat3_label']) && $c['stat3_label']) ? htmlspecialchars($c['stat3_label']) : "Pièces d'origine" ?>
        </span>
      </div>
      <div class="hero-stat">
        <strong <?= cms_field_attrs('stat4_value', 'text', 'Stat 4 — Valeur', isset($c['stat4_value']) ? $c['stat4_value'] : '') ?>>
          <?= (isset($c['stat4_value']) && $c['stat4_value']) ? htmlspecialchars($c['stat4_value']) : '6' ?>
        </strong>
        <span <?= cms_field_attrs('stat4_label', 'text', 'Stat 4 — Libellé', isset($c['stat4_label']) ? $c['stat4_label'] : '') ?>>
          <?= (isset($c['stat4_label']) && $c['stat4_label']) ? htmlspecialchars($c['stat4_label']) : 'Gammes produits' ?>
        </span>
      </div>
    </div>
  </div>
  <button class="hc-prev" aria-label="Précédent" style="top:45%"><i class="fa-solid fa-chevron-left"></i></button>
  <button class="hc-next" aria-label="Suivant" style="top:45%"><i class="fa-solid fa-chevron-right"></i></button>
  <div class="hc-dots" style="bottom:5rem">
    <button class="hc-dot active" aria-label="Slide 1"></button>
    <button class="hc-dot" aria-label="Slide 2"></button>
    <button class="hc-dot" aria-label="Slide 3"></button>
  </div>
</section>

<!-- SERVICES -->
<section class="section bg-light" style="background: linear-gradient(rgba(220,225,233,0.88), rgba(220,225,233,0.88)), url('<?= base_url('assets/images/back1.jpg') ?>') center/cover no-repeat;" <?= cms_section_attrs($c, 'services', 'Section Services') ?>>
  <div class="container">
    <div class="section-header fade-in">
      <span class="section-label" data-i18n="services_label" <?= cms_field_attrs('services_label', 'text', 'Services — Label', isset($c['services_label']) ? $c['services_label'] : '') ?>>
        <?= (isset($c['services_label']) && $c['services_label']) ? htmlspecialchars($c['services_label']) : 'Nos services' ?>
      </span>
      <h2 class="section-title" data-i18n="services_title" <?= cms_field_attrs('services_title', 'text', 'Services — Titre', isset($c['services_title']) ? $c['services_title'] : '') ?>>
        <?= (isset($c['services_title']) && $c['services_title']) ? htmlspecialchars($c['services_title']) : 'Un accompagnement complet' ?>
      </h2>
      <p class="section-subtitle" data-i18n="services_subtitle" <?= cms_field_attrs('services_subtitle', 'text', 'Services — Sous-titre', isset($c['services_subtitle']) ? $c['services_subtitle'] : '') ?>>
        <?= (isset($c['services_subtitle']) && $c['services_subtitle']) ? htmlspecialchars($c['services_subtitle']) : 'De la vente à la maintenance, Royal Sales Cameroon vous accompagne à chaque étape.' ?>
      </p>
    </div>
    <div class="grid-3" style="gap:1.5rem;">
      <div class="service-card fade-in">
        <div class="service-icon"><i class="fa-solid fa-cart-shopping"></i></div>
        <h3 data-i18n="srv_sales_title" <?= cms_field_attrs('srv1_title', 'text', 'Service 1 — Titre', isset($c['srv1_title']) ? $c['srv1_title'] : '') ?>>
          <?= (isset($c['srv1_title']) && $c['srv1_title']) ? htmlspecialchars($c['srv1_title']) : 'Vente &amp; Conseil' ?>
        </h3>
        <p style="color:var(--gray);font-size:0.9rem;margin-top:0.5rem;line-height:1.65; text-align: justify;" data-i18n="srv_sales_desc"
           <?= cms_field_attrs('srv1_desc', 'text', 'Service 1 — Description', isset($c['srv1_desc']) ? $c['srv1_desc'] : '') ?>>
          <?= (isset($c['srv1_desc']) && $c['srv1_desc']) ? htmlspecialchars($c['srv1_desc']) : 'Sélection du compresseur adapté à vos besoins, conseil technique expert.' ?>
        </p>
        <a href="<?= (isset($c['srv1_url']) && $c['srv1_url']) ? htmlspecialchars($c['srv1_url']) : base_url('services') ?>"
           style="display:inline-flex;align-items:center;gap:0.35rem;margin-top:1rem;font-size:0.82rem;font-weight:600;color:var(--primary);font-family:'Montserrat',sans-serif;text-decoration:none;"
           data-i18n="learn_more"
           <?= cms_field_attrs('srv1_url', 'url', 'Service 1 — URL', isset($c['srv1_url']) ? $c['srv1_url'] : '') ?>>
          En savoir plus <i class="fa-solid fa-arrow-right" style="font-size:0.7rem;"></i>
        </a>
      </div>
      <div class="service-card fade-in">
        <div class="service-icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
        <h3 data-i18n="srv_install_title" <?= cms_field_attrs('srv2_title', 'text', 'Service 2 — Titre', isset($c['srv2_title']) ? $c['srv2_title'] : '') ?>>
          <?= (isset($c['srv2_title']) && $c['srv2_title']) ? htmlspecialchars($c['srv2_title']) : 'Installation &amp; Mise en service' ?>
        </h3>
        <p style="color:var(--gray);font-size:0.9rem;margin-top:0.5rem;line-height:1.65; text-align: justify;" data-i18n="srv_install_desc"
           <?= cms_field_attrs('srv2_desc', 'text', 'Service 2 — Description', isset($c['srv2_desc']) ? $c['srv2_desc'] : '') ?>>
          <?= (isset($c['srv2_desc']) && $c['srv2_desc']) ? htmlspecialchars($c['srv2_desc']) : 'Installation professionnelle et mise en service par nos techniciens certifiés.' ?>
        </p>
        <a href="<?= (isset($c['srv2_url']) && $c['srv2_url']) ? htmlspecialchars($c['srv2_url']) : base_url('services') ?>"
           style="display:inline-flex;align-items:center;gap:0.35rem;margin-top:1rem;font-size:0.82rem;font-weight:600;color:var(--primary);font-family:'Montserrat',sans-serif;text-decoration:none;"
           data-i18n="learn_more"
           <?= cms_field_attrs('srv2_url', 'url', 'Service 2 — URL', isset($c['srv2_url']) ? $c['srv2_url'] : '') ?>>
          En savoir plus <i class="fa-solid fa-arrow-right" style="font-size:0.7rem;"></i>
        </a>
      </div>
      <div class="service-card fade-in">
        <div class="service-icon"><i class="fa-solid fa-gears"></i></div>
        <h3 data-i18n="srv_maint_title" <?= cms_field_attrs('srv3_title', 'text', 'Service 3 — Titre', isset($c['srv3_title']) ? $c['srv3_title'] : '') ?>>
          <?= (isset($c['srv3_title']) && $c['srv3_title']) ? htmlspecialchars($c['srv3_title']) : 'Maintenance &amp; Réparation' ?>
        </h3>
        <p style="color:var(--gray);font-size:0.9rem;margin-top:0.5rem;line-height:1.65; text-align: justify;" data-i18n="srv_maint_desc"
           <?= cms_field_attrs('srv3_desc', 'text', 'Service 3 — Description', isset($c['srv3_desc']) ? $c['srv3_desc'] : '') ?>>
          <?= (isset($c['srv3_desc']) && $c['srv3_desc']) ? htmlspecialchars($c['srv3_desc']) : 'Maintenance préventive et corrective, réparations d\'urgence à prix fixe.' ?>
        </p>
        <a href="<?= (isset($c['srv3_url']) && $c['srv3_url']) ? htmlspecialchars($c['srv3_url']) : base_url('services') ?>"
           style="display:inline-flex;align-items:center;gap:0.35rem;margin-top:1rem;font-size:0.82rem;font-weight:600;color:var(--primary);font-family:'Montserrat',sans-serif;text-decoration:none;"
           data-i18n="learn_more"
           <?= cms_field_attrs('srv3_url', 'url', 'Service 3 — URL', isset($c['srv3_url']) ? $c['srv3_url'] : '') ?>>
          En savoir plus <i class="fa-solid fa-arrow-right" style="font-size:0.7rem;"></i>
        </a>
      </div>
    </div>
    <div class="fade-in" style="background:linear-gradient(135deg, var(--dark) 0%, var(--dark-mid) 100%);border-radius:16px;padding:2rem 2.5rem;display:flex;justify-content:space-between;align-items:center;gap:1.5rem;flex-wrap:wrap;border-left:4px solid var(--accent);margin-top:2.5rem;">
      <div>
        <div style="font-size:0.68rem;font-weight:700;text-transform:uppercase;letter-spacing:0.14em;color:var(--accent);margin-bottom:0.4rem;font-family:'Montserrat',sans-serif;"
             <?= cms_field_attrs('contracts_badge', 'text', 'Offre phare — Badge', isset($c['contracts_badge']) ? $c['contracts_badge'] : '') ?>>
          <?= (isset($c['contracts_badge']) && $c['contracts_badge']) ? htmlspecialchars($c['contracts_badge']) : 'Offre phare' ?>
        </div>
        <h3 style="color:white;margin-bottom:0.35rem;font-family:'Montserrat',sans-serif;" data-i18n="contracts_title"
            <?= cms_field_attrs('contracts_title', 'text', 'Offre phare — Titre', isset($c['contracts_title']) ? $c['contracts_title'] : '') ?>>
          <?= (isset($c['contracts_title']) && $c['contracts_title']) ? htmlspecialchars($c['contracts_title']) : 'Contrats de Maintenance Annuels' ?>
        </h3>
        <p style="color:rgba(255,255,255,0.5);font-size:0.88rem;margin:0;" data-i18n="contracts_desc"
           <?= cms_field_attrs('contracts_desc', 'text', 'Offre phare — Description', isset($c['contracts_desc']) ? $c['contracts_desc'] : '') ?>>
          <?= (isset($c['contracts_desc']) && $c['contracts_desc']) ? htmlspecialchars($c['contracts_desc']) : 'Protégez vos équipements avec nos contrats de maintenance annuels.' ?>
        </p>
      </div>
      <a href="<?= (isset($c['contracts_url']) && $c['contracts_url']) ? htmlspecialchars($c['contracts_url']) : base_url('services') . '#contracts' ?>"
         class="btn btn-accent" style="white-space:nowrap;flex-shrink:0;"
         <?= cms_field_attrs('contracts_url', 'url', 'Offre phare — URL du bouton', isset($c['contracts_url']) ? $c['contracts_url'] : '') ?>>
        <i class="fa-solid fa-file-contract" style="margin-right:0.4rem;"></i>
        <span data-i18n="learn_more" <?= cms_field_attrs('contracts_cta', 'text', 'Offre phare — Texte bouton', isset($c['contracts_cta']) ? $c['contracts_cta'] : '') ?>>
          <?= (isset($c['contracts_cta']) && $c['contracts_cta']) ? htmlspecialchars($c['contracts_cta']) : 'Découvrir les contrats' ?>
        </span>
      </a>
    </div>
    <div style="text-align:center;margin-top:2.5rem;">
      <a href="<?= (isset($c['services_all_url']) && $c['services_all_url']) ? htmlspecialchars($c['services_all_url']) : base_url('services') ?>"
         class="btn btn-outline"
         <?= cms_field_attrs('services_all_url', 'url', 'Services — URL bouton "Voir tous"', isset($c['services_all_url']) ? $c['services_all_url'] : '') ?>>
        <span <?= cms_field_attrs('services_all_text', 'text', 'Services — Texte bouton "Voir tous"', isset($c['services_all_text']) ? $c['services_all_text'] : '') ?>>
          <?= (isset($c['services_all_text']) && $c['services_all_text']) ? htmlspecialchars($c['services_all_text']) : 'Voir tous nos services' ?>
        </span>
      </a>
    </div>
  </div>
</section>

<!-- PARTENAIRES OFFICIELS -->
<section style="background: linear-gradient(135deg, #232e3e 0%, #2B3648 55%, #1e2838 100%); padding:2.75rem 0; overflow:hidden;border-top:1px solid rgba(237,205,31,0.15);border-bottom:1px solid rgba(237,205,31,0.15);" <?= cms_section_attrs($c, 'partenaires', 'Section Partenaires Officiels') ?>>
  <div style="max-width:1320px;margin:0 auto;padding:0 2rem;display:flex;align-items:center;justify-content:space-between;gap:2rem;flex-wrap:wrap;">
    <div style="display:flex;align-items:center;gap:2rem;">
      <div style="width:3px;height:64px;background:var(--accent);border-radius:2px;opacity:0.85;flex-shrink:0;"></div>
      <div>
        <div style="font-size:0.7rem;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(255,255,255,0.6);font-family:'Montserrat',sans-serif;margin-bottom:0.5rem;"
             <?= cms_field_attrs('partners_label1', 'text', 'Partenaires — Label RENNER', isset($c['partners_label1']) ? $c['partners_label1'] : '') ?>>
          <?= (isset($c['partners_label1']) && $c['partners_label1']) ? htmlspecialchars($c['partners_label1']) : 'Partenariats Officiels' ?>
        </div>
        <img src="<?= base_url('assets/logo/Renner_logo.png') ?>" alt="RENNER Kompressoren" style="height:34px;filter:brightness(0) invert(1);opacity:0.9;display:block;margin-bottom:0.35rem;" onerror="this.style.display='none'; this.insertAdjacentHTML('afterend','<div style=\'font-size:1.4rem;font-weight:900;color:white;font-family:Montserrat,sans-serif;\'>RENNER Kompressoren</div>')">
        <div style="font-size:0.82rem;color:rgba(255,255,255,0.5);"
             <?= cms_field_attrs('partners_renner_sub', 'text', 'Partenaires — Sous-titre RENNER', isset($c['partners_renner_sub']) ? $c['partners_renner_sub'] : '') ?>>
          <?= (isset($c['partners_renner_sub']) && $c['partners_renner_sub']) ? htmlspecialchars($c['partners_renner_sub']) : 'Fabriqué en Allemagne — Garantie 5 ans' ?>
        </div>
      </div>
    </div>
    <div style="width:1px;height:60px;background:rgba(255,255,255,0.2);flex-shrink:0;"></div>
    <div style="display:flex;align-items:center;gap:2rem;">
      <div style="width:3px;height:64px;background:rgba(255,255,255,0.4);border-radius:2px;flex-shrink:0;"></div>
      <div>
        <div style="font-size:0.7rem;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(255,255,255,0.6);font-family:'Montserrat',sans-serif;margin-bottom:0.5rem;"
             <?= cms_field_attrs('partners_label2', 'text', 'Partenaires — Label Ingersoll Rand', isset($c['partners_label2']) ? $c['partners_label2'] : '') ?>>
          <?= (isset($c['partners_label2']) && $c['partners_label2']) ? htmlspecialchars($c['partners_label2']) : 'Partenaire Officiel' ?>
        </div>
        <img src="<?= base_url('assets/logo/Ingersoll_Rand_logo.svg') ?>" alt="Ingersoll Rand" style="height:34px;filter:brightness(0) invert(1);opacity:0.9;display:block;margin-bottom:0.35rem;" onerror="this.style.display='none'; this.insertAdjacentHTML('afterend','<div style=\'font-size:1.4rem;font-weight:900;color:white;font-family:Montserrat,sans-serif;\'>Ingersoll Rand</div>')">
        <div style="font-size:0.82rem;color:rgba(255,255,255,0.5);"
             <?= cms_field_attrs('partners_ir_sub', 'text', 'Partenaires — Sous-titre Ingersoll Rand', isset($c['partners_ir_sub']) ? $c['partners_ir_sub'] : '') ?>>
          <?= (isset($c['partners_ir_sub']) && $c['partners_ir_sub']) ? htmlspecialchars($c['partners_ir_sub']) : 'Solutions de compression industrielle' ?>
        </div>
      </div>
    </div>
    <div style="display:flex;align-items:center;gap:2.5rem;flex-wrap:wrap;margin-left:auto;">
      <div style="text-align:center;">
        <div style="font-size:1.9rem;font-weight:900;color:var(--accent);font-family:'Montserrat',sans-serif;line-height:1;letter-spacing:-0.03em;"
             <?= cms_field_attrs('partners_stat_value', 'text', 'Partenaires — Stat valeur', isset($c['partners_stat_value']) ? $c['partners_stat_value'] : '') ?>>
          <?= (isset($c['partners_stat_value']) && $c['partners_stat_value']) ? htmlspecialchars($c['partners_stat_value']) : '+50 ans' ?>
        </div>
        <div style="font-size:0.7rem;color:rgba(255,255,255,0.45);text-transform:uppercase;letter-spacing:0.1em;margin-top:0.2rem;font-family:'Montserrat',sans-serif;"
             <?= cms_field_attrs('partners_stat_label', 'text', "Partenaires — Stat libellé", isset($c['partners_stat_label']) ? $c['partners_stat_label'] : '') ?>>
          <?= (isset($c['partners_stat_label']) && $c['partners_stat_label']) ? htmlspecialchars($c['partners_stat_label']) : "d'innovation" ?>
        </div>
      </div>
      <div style="width:1px;height:40px;background:rgba(255,255,255,0.15);"></div>
      <a href="<?= (isset($c['partners_catalog_url']) && $c['partners_catalog_url']) ? htmlspecialchars($c['partners_catalog_url']) : base_url('produits') ?>"
         class="btn btn-accent" style="white-space:nowrap;font-family:'Montserrat',sans-serif;"
         <?= cms_field_attrs('partners_catalog_url', 'url', 'Partenaires — URL "Voir le catalogue"', isset($c['partners_catalog_url']) ? $c['partners_catalog_url'] : '') ?>>
        <i class="fa-solid fa-box-open" style="margin-right:0.45rem;"></i>
        <span <?= cms_field_attrs('partners_catalog_text', 'text', 'Partenaires — Texte bouton catalogue', isset($c['partners_catalog_text']) ? $c['partners_catalog_text'] : '') ?>>
          <?= (isset($c['partners_catalog_text']) && $c['partners_catalog_text']) ? htmlspecialchars($c['partners_catalog_text']) : 'Voir le catalogue' ?>
        </span>
      </a>
    </div>
  </div>
</section>

<!-- PRODUITS EN VEDETTE -->
<section class="section" style="background: linear-gradient(rgba(230,233,238,0.90), rgba(230,233,238,0.90)), url('<?= base_url('assets/images/compresseur.jpg') ?>') center/cover no-repeat;" <?= cms_section_attrs($c, 'produits_vedette', 'Section Produits en Vedette') ?>>
  <div class="container">
    <div class="section-header fade-in">
      <span class="section-label" data-i18n="products_label" <?= cms_field_attrs('products_label', 'text', 'Produits — Label', isset($c['products_label']) ? $c['products_label'] : '') ?>>
        <?= (isset($c['products_label']) && $c['products_label']) ? htmlspecialchars($c['products_label']) : 'Catalogue produits' ?>
      </span>
      <h2 class="section-title" data-i18n="products_title" <?= cms_field_attrs('products_title', 'text', 'Produits — Titre', isset($c['products_title']) ? $c['products_title'] : '') ?>>
        <?= (isset($c['products_title']) && $c['products_title']) ? htmlspecialchars($c['products_title']) : 'Nos gammes de produits' ?>
      </h2>
      <p class="section-subtitle" data-i18n="products_subtitle" <?= cms_field_attrs('products_subtitle', 'text', 'Produits — Sous-titre', isset($c['products_subtitle']) ? $c['products_subtitle'] : '') ?>>
        <?= (isset($c['products_subtitle']) && $c['products_subtitle']) ? htmlspecialchars($c['products_subtitle']) : "Toute notre gamme : compresseurs RENNER et Ingersoll Rand, traitement d'air, réservoirs et systèmes de contrôle." ?>
      </p>
    </div>
    <div class="grid-3" style="gap:1.75rem;">
      <a href="<?= (isset($c['prod1_url']) && $c['prod1_url']) ? htmlspecialchars($c['prod1_url']) : base_url('partenaires/renner') ?>"
         class="card fade-in" style="text-decoration:none;"
         <?= cms_field_attrs('prod1_url', 'url', 'Produit 1 — URL', isset($c['prod1_url']) ? $c['prod1_url'] : '') ?>>
        <?php $_p1_img = (isset($c['prod1_img']) && $c['prod1_img']) ? base_url($c['prod1_img']) : base_url('assets/images/Renner_patner/comp_a_vis.webp'); ?>
        <img src="<?= $_p1_img ?>" alt="Compresseurs à vis RENNER Kompressoren" class="card-img" loading="lazy" onerror="this.src='https://images.pexels.com/photos/1108101/pexels-photo-1108101.jpeg?auto=compress&w=600'" <?= cms_field_attrs('prod1_img', 'image', 'Produit 1 — Image', isset($c['prod1_img']) ? $c['prod1_img'] : '') ?>>
        <div class="card-body">
          <span class="card-label" style="color:var(--primary);"
                <?= cms_field_attrs('prod1_label', 'text', 'Produit 1 — Label', isset($c['prod1_label']) ? $c['prod1_label'] : '') ?>>
            <?= (isset($c['prod1_label']) && $c['prod1_label']) ? htmlspecialchars($c['prod1_label']) : 'RENNER Kompressoren' ?>
          </span>
          <h3 class="card-title" <?= cms_field_attrs('prod1_title', 'text', 'Produit 1 — Titre', isset($c['prod1_title']) ? $c['prod1_title'] : '') ?>>
            <?= (isset($c['prod1_title']) && $c['prod1_title']) ? htmlspecialchars($c['prod1_title']) : 'Compresseurs RENNER' ?>
          </h3>
          <p class="card-desc" <?= cms_field_attrs('prod1_desc', 'text', 'Produit 1 — Description', isset($c['prod1_desc']) ? $c['prod1_desc'] : '') ?>>
            <?= (isset($c['prod1_desc']) && $c['prod1_desc']) ? htmlspecialchars($c['prod1_desc']) : 'Gamme complète à vis, sans huile et à piston — Made in Germany. 2,2 à 355 kW. Fiabilité et performance prouvées depuis 1994.' ?>
          </p>
          <span class="btn btn-outline btn-sm" style="margin-top:0.5rem;"
                <?= cms_field_attrs('prod1_cta', 'text', 'Produit 1 — Texte CTA', isset($c['prod1_cta']) ? $c['prod1_cta'] : '') ?>>
            <?= (isset($c['prod1_cta']) && $c['prod1_cta']) ? htmlspecialchars($c['prod1_cta']) : 'Découvrir la gamme →' ?>
          </span>
        </div>
      </a>
      <a href="<?= (isset($c['prod2_url']) && $c['prod2_url']) ? htmlspecialchars($c['prod2_url']) : base_url('partenaires/ingersoll-rand') ?>"
         class="card fade-in" style="text-decoration:none;"
         <?= cms_field_attrs('prod2_url', 'url', 'Produit 2 — URL', isset($c['prod2_url']) ? $c['prod2_url'] : '') ?>>
        <?php $_p2_img = (isset($c['prod2_img']) && $c['prod2_img']) ? base_url($c['prod2_img']) : base_url('assets/images/ingersoll/sans_piston.webp'); ?>
        <img src="<?= $_p2_img ?>" alt="Compresseurs Ingersoll Rand" class="card-img" loading="lazy" onerror="this.src='https://images.pexels.com/photos/2760243/pexels-photo-2760243.jpeg?auto=compress&w=600'" <?= cms_field_attrs('prod2_img', 'image', 'Produit 2 — Image', isset($c['prod2_img']) ? $c['prod2_img'] : '') ?>>
        <div class="card-body">
          <span class="card-label" style="color:var(--primary);"
                <?= cms_field_attrs('prod2_label', 'text', 'Produit 2 — Label', isset($c['prod2_label']) ? $c['prod2_label'] : '') ?>>
            <?= (isset($c['prod2_label']) && $c['prod2_label']) ? htmlspecialchars($c['prod2_label']) : 'Ingersoll Rand' ?>
          </span>
          <h3 class="card-title" <?= cms_field_attrs('prod2_title', 'text', 'Produit 2 — Titre', isset($c['prod2_title']) ? $c['prod2_title'] : '') ?>>
            <?= (isset($c['prod2_title']) && $c['prod2_title']) ? htmlspecialchars($c['prod2_title']) : 'Compresseurs Ingersoll Rand' ?>
          </h3>
          <p class="card-desc" <?= cms_field_attrs('prod2_desc', 'text', 'Produit 2 — Description', isset($c['prod2_desc']) ? $c['prod2_desc'] : '') ?>>
            <?= (isset($c['prod2_desc']) && $c['prod2_desc']) ? htmlspecialchars($c['prod2_desc']) : 'Leader mondial depuis 1871. Compresseurs à vis oil-free et lubrifiés, 4 à 355 kW. Technologie IIoT, Classe 0 ISO 8573-1.' ?>
          </p>
          <span class="btn btn-outline btn-sm" style="margin-top:0.5rem;"
                <?= cms_field_attrs('prod2_cta', 'text', 'Produit 2 — Texte CTA', isset($c['prod2_cta']) ? $c['prod2_cta'] : '') ?>>
            <?= (isset($c['prod2_cta']) && $c['prod2_cta']) ? htmlspecialchars($c['prod2_cta']) : 'Découvrir la gamme →' ?>
          </span>
        </div>
      </a>
      <a href="<?= (isset($c['prod3_url']) && $c['prod3_url']) ? htmlspecialchars($c['prod3_url']) : base_url('partenaires/cas-lubrifiants') ?>"
         class="card fade-in" style="text-decoration:none;"
         <?= cms_field_attrs('prod3_url', 'url', 'Produit 3 — URL', isset($c['prod3_url']) ? $c['prod3_url'] : '') ?>>
        <?php $_p3_img = (isset($c['prod3_img']) && $c['prod3_img']) ? base_url($c['prod3_img']) : base_url('assets/images/huiles/image.png'); ?>
        <img src="<?= $_p3_img ?>" alt="Huile CAS Lubricants Royal Sales Cameroon" class="card-img" loading="lazy" onerror="this.src='https://images.pexels.com/photos/4481326/pexels-photo-4481326.jpeg?auto=compress&w=600'" <?= cms_field_attrs('prod3_img', 'image', 'Produit 3 — Image', isset($c['prod3_img']) ? $c['prod3_img'] : '') ?>>
        <div class="card-body">
          <span class="card-label" style="color:var(--accent);"
                <?= cms_field_attrs('prod3_label', 'text', 'Produit 3 — Label', isset($c['prod3_label']) ? $c['prod3_label'] : '') ?>>
            <?= (isset($c['prod3_label']) && $c['prod3_label']) ? htmlspecialchars($c['prod3_label']) : 'Marque exclusive RSC' ?>
          </span>
          <h3 class="card-title" <?= cms_field_attrs('prod3_title', 'text', 'Produit 3 — Titre', isset($c['prod3_title']) ? $c['prod3_title'] : '') ?>>
            <?= (isset($c['prod3_title']) && $c['prod3_title']) ? htmlspecialchars($c['prod3_title']) : 'Huile CAS Lubricants' ?>
          </h3>
          <p class="card-desc" <?= cms_field_attrs('prod3_desc', 'text', 'Produit 3 — Description', isset($c['prod3_desc']) ? $c['prod3_desc'] : '') ?>>
            <?= (isset($c['prod3_desc']) && $c['prod3_desc']) ? htmlspecialchars($c['prod3_desc']) : 'Lubrifiant haute performance formulé pour conditions tropicales. Compatible toutes marques de compresseurs. Exclusivité Royal Sales Cameroon.' ?>
          </p>
          <span class="btn btn-outline btn-sm" style="margin-top:0.5rem;"
                <?= cms_field_attrs('prod3_cta', 'text', 'Produit 3 — Texte CTA', isset($c['prod3_cta']) ? $c['prod3_cta'] : '') ?>>
            <?= (isset($c['prod3_cta']) && $c['prod3_cta']) ? htmlspecialchars($c['prod3_cta']) : 'Voir la fiche produit →' ?>
          </span>
        </div>
      </a>
    </div>
    <div style="text-align:center;margin-top:3rem;">
      <a href="<?= (isset($c['products_all_url']) && $c['products_all_url']) ? htmlspecialchars($c['products_all_url']) : base_url('produits') ?>"
         class="btn btn-primary btn-lg"
         data-i18n="see_all"
         <?= cms_field_attrs('products_all_url', 'url', 'Produits — URL "Voir tout"', isset($c['products_all_url']) ? $c['products_all_url'] : '') ?>>
        <span <?= cms_field_attrs('products_all_text', 'text', 'Produits — Texte "Voir tout"', isset($c['products_all_text']) ? $c['products_all_text'] : '') ?>>
          <?= (isset($c['products_all_text']) && $c['products_all_text']) ? htmlspecialchars($c['products_all_text']) : 'Voir tout le catalogue' ?>
        </span>
      </a>
    </div>
  </div>
</section>

<!-- À PROPOS -->
<section class="section bg-light" style="background: linear-gradient(rgba(244,246,249,0.93), rgba(244,246,249,0.93)), url('https://images.unsplash.com/photo-1623424894032-8e2cb6b1e84a?w=1920&q=50') center/cover no-repeat;" <?= cms_section_attrs($c, 'apropos', 'Section À Propos') ?>>
  <div class="container">
    <div class="about-grid">
      <div class="about-img-wrap fade-in">
        <img src="<?= (isset($c['about_img']) && $c['about_img']) ? base_url($c['about_img']) : base_url('assets/images/equip.jpg') ?>"
             alt="Technicien Royal Sales Cameroon avec EPI inspectant équipement industriel"
             <?= cms_field_attrs('about_img', 'image', 'À propos — Photo principale', isset($c['about_img']) ? $c['about_img'] : '') ?>>
        <div style="position:absolute;bottom:2rem;left:2rem;right:2rem;z-index:3;background:rgba(43,54,72,0.92);backdrop-filter:blur(8px);border:1px solid rgba(237,205,31,0.3);border-radius:10px;padding:1.25rem;">
          <div style="display:flex;align-items:center;gap:0.6rem;margin-bottom:0.5rem;">
            <img src="<?= base_url('assets/images/cmr_flag.png') ?>" alt="Drapeau Cameroun" style="height:18px;border-radius:2px;flex-shrink:0;">
          </div>
          <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:0.4rem;">
            <img src="<?= base_url('assets/logo/Renner_logo.png') ?>" alt="RENNER" style="height:10px;filter:brightness(0) invert(1);opacity:0.55;" onerror="this.style.display='none'">
            <span style="color:rgba(255,255,255,0.2);font-size:0.7rem;">|</span>
            <img src="<?= base_url('assets/logo/Ingersoll_Rand_logo.svg') ?>" alt="Ingersoll Rand" style="height:9px;filter:brightness(0) invert(1);opacity:0.55;" onerror="this.style.display='none'">
          </div>
          <div style="font-weight:700;font-size:1rem;color:white;font-family:'Montserrat',sans-serif;">Distributeurs Agréés Officiels</div>
          <div style="font-size:0.85rem;color:rgba(255,255,255,0.55);margin-top:0.25rem;">Afrique Centrale — Garantie fabricant</div>
        </div>
      </div>
      <div class="fade-in">
        <span class="section-label" data-i18n="about_label" <?= cms_field_attrs('about_label', 'text', 'À propos — Label', isset($c['about_label']) ? $c['about_label'] : '') ?>>
          <?= (isset($c['about_label']) && $c['about_label']) ? htmlspecialchars($c['about_label']) : 'Qui sommes-nous' ?>
        </span>
        <h2 class="section-title" style="margin-bottom:1.25rem;" data-i18n="about_title"
            <?= cms_field_attrs('about_title_home', 'text', 'À propos — Titre', isset($c['about_title_home']) ? $c['about_title_home'] : '') ?>>
          <?= (isset($c['about_title_home']) && $c['about_title_home']) ? htmlspecialchars($c['about_title_home']) : "Votre Expert en Solutions de Compression — Afrique Centrale" ?>
        </h2>
        <p style="color:var(--gray);margin-bottom:1rem;line-height:1.8;" data-i18n="about_desc1"
           <?= cms_field_attrs('about_desc1', 'html', 'À propos — Paragraphe 1', isset($c['about_desc1']) ? $c['about_desc1'] : '') ?>>
          <?= (isset($c['about_desc1']) && $c['about_desc1']) ? $c['about_desc1'] : "Royal Sales Cameroon est distributeur agréé de RENNER Kompressoren (Allemagne) et Ingersoll Rand pour la région Afrique Centrale. Basés à Douala, nous proposons une gamme complète de solutions de compression industrielle avec garantie fabricant." ?>
        </p>
        <p style="color:var(--gray);margin-bottom:2rem;line-height:1.8;" data-i18n="about_desc2"
           <?= cms_field_attrs('about_desc2', 'html', 'À propos — Paragraphe 2', isset($c['about_desc2']) ? $c['about_desc2'] : '') ?>>
          <?= (isset($c['about_desc2']) && $c['about_desc2']) ? $c['about_desc2'] : "Notre équipe de techniciens certifiés assure installation, maintenance préventive et corrective, réparations d'urgence et support à distance pour toute la région, quelle que soit la marque de vos équipements." ?>
        </p>
        <ul class="feature-list" style="margin-bottom:2rem;">
          <li>
            <span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span>
            <span style="font-weight:600;color:var(--dark);" data-i18n="about_guarantee"
                  <?= cms_field_attrs('about_feat1', 'text', 'À propos — Point 1', isset($c['about_feat1']) ? $c['about_feat1'] : '') ?>>
              <?= (isset($c['about_feat1']) && $c['about_feat1']) ? htmlspecialchars($c['about_feat1']) : 'Garantie fabricant incluse' ?>
            </span>
          </li>
          <li>
            <span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span>
            <span style="font-weight:600;color:var(--dark);" data-i18n="about_certified"
                  <?= cms_field_attrs('about_feat2', 'text', 'À propos — Point 2', isset($c['about_feat2']) ? $c['about_feat2'] : '') ?>>
              <?= (isset($c['about_feat2']) && $c['about_feat2']) ? htmlspecialchars($c['about_feat2']) : 'Techniciens certifiés fabricants' ?>
            </span>
          </li>
          <li>
            <span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span>
            <span style="font-weight:600;color:var(--dark);" data-i18n="about_parts"
                  <?= cms_field_attrs('about_feat3', 'text', 'À propos — Point 3', isset($c['about_feat3']) ? $c['about_feat3'] : '') ?>>
              <?= (isset($c['about_feat3']) && $c['about_feat3']) ? htmlspecialchars($c['about_feat3']) : "Pièces d'origine garanties" ?>
            </span>
          </li>
        </ul>
        <a href="<?= (isset($c['about_btn_url']) && $c['about_btn_url']) ? htmlspecialchars($c['about_btn_url']) : base_url('a-propos') ?>"
           class="btn btn-primary"
           data-i18n="learn_more"
           <?= cms_field_attrs('about_btn_url', 'url', 'À propos — URL du bouton', isset($c['about_btn_url']) ? $c['about_btn_url'] : '') ?>>
          <span <?= cms_field_attrs('about_btn_text', 'text', 'À propos — Texte bouton', isset($c['about_btn_text']) ? $c['about_btn_text'] : '') ?>>
            <?= (isset($c['about_btn_text']) && $c['about_btn_text']) ? htmlspecialchars($c['about_btn_text']) : 'En savoir plus' ?>
          </span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section fade-in" style="background: linear-gradient(rgba(30,40,55,0.88), rgba(30,40,55,0.88)), url('https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=1920&q=60') center/cover no-repeat;" <?= cms_section_attrs($c, 'cta', 'Section CTA') ?>>
  <div class="container" style="position:relative;">
    <span class="section-label" style="color:var(--accent);"
          <?= cms_field_attrs('cta_label', 'text', 'CTA — Label', isset($c['cta_label']) ? $c['cta_label'] : '') ?>>
      <?= (isset($c['cta_label']) && $c['cta_label']) ? htmlspecialchars($c['cta_label']) : 'Passez à l\'action' ?>
    </span>
    <h2 style="margin-top:0.75rem;"
        <?= cms_field_attrs('cta_title', 'text', 'Titre CTA', isset($c['cta_title']) ? $c['cta_title'] : '') ?>
        <?= (!isset($c['cta_title']) || !$c['cta_title']) ? 'data-i18n="cta_title"' : '' ?>>
      <?= (isset($c['cta_title']) && $c['cta_title']) ? htmlspecialchars($c['cta_title']) : 'Prêt à optimiser votre production ?' ?>
    </h2>
    <p <?= cms_field_attrs('cta_desc', 'text', 'Description CTA', isset($c['cta_desc']) ? $c['cta_desc'] : '') ?>
       <?= (!isset($c['cta_desc']) || !$c['cta_desc']) ? 'data-i18n="cta_desc"' : '' ?>>
      <?= (isset($c['cta_desc']) && $c['cta_desc']) ? htmlspecialchars($c['cta_desc']) : 'Contactez notre équipe pour une étude de vos besoins et un devis personnalisé.' ?>
    </p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;margin-bottom:1.5rem;">
      <a href="<?= cta_url($c['cta_btn1_url'] ?? '', base_url('contact')) ?>"
         class="btn btn-accent btn-lg"
         data-i18n="cta_btn"
         <?= cms_field_attrs('cta_btn1_url', 'url', 'CTA — URL bouton principal', $c['cta_btn1_url'] ?? '') ?>>
        <i class="fa-solid fa-paper-plane" style="margin-right:0.4rem;"></i>
        <span <?= cms_field_attrs('cta_btn1_text', 'text', 'CTA — Texte bouton principal', $c['cta_btn1_text'] ?? '') ?>>
          <?= ($c['cta_btn1_text'] ?? '') ? htmlspecialchars($c['cta_btn1_text']) : 'Demander un devis gratuit' ?>
        </span>
      </a>
      <a href="<?= cta_url($c['cta_phone_url'] ?? '', 'tel:+237691123112') ?>"
         class="btn btn-outline-light btn-lg"
         <?= cms_field_attrs('cta_phone_url', 'url', 'CTA — Lien téléphone (tel:...)', $c['cta_phone_url'] ?? '') ?>>
        <i class="fa-solid fa-phone" style="margin-right:0.4rem;"></i>
        <span <?= cms_field_attrs('cta_phone_text', 'text', 'CTA — Affichage téléphone', $c['cta_phone_text'] ?? '') ?>>
          <?= ($c['cta_phone_text'] ?? '') ? htmlspecialchars($c['cta_phone_text']) : '+237 691 123 112' ?>
        </span>
      </a>
    </div>
    <div style="display:flex;gap:2rem;justify-content:center;flex-wrap:wrap;font-size:0.82rem;color:rgba(255,255,255,0.45);font-family:'Montserrat',sans-serif;font-weight:600;">
      <span>
        <i class="fa-solid fa-shield-halved" style="color:var(--accent);margin-right:0.35rem;"></i>
        <span <?= cms_field_attrs('cta_badge1', 'text', 'CTA — Badge 1', isset($c['cta_badge1']) ? $c['cta_badge1'] : '') ?>>
          <?= (isset($c['cta_badge1']) && $c['cta_badge1']) ? htmlspecialchars($c['cta_badge1']) : 'Garantie 5 ans incluse' ?>
        </span>
      </span>
      <span>
        <i class="fa-solid fa-truck-fast" style="color:var(--accent);margin-right:0.35rem;"></i>
        <span <?= cms_field_attrs('cta_badge2', 'text', 'CTA — Badge 2', isset($c['cta_badge2']) ? $c['cta_badge2'] : '') ?>>
          <?= (isset($c['cta_badge2']) && $c['cta_badge2']) ? htmlspecialchars($c['cta_badge2']) : "Livraison sur toute l'Afrique Centrale" ?>
        </span>
      </span>
      <span>
        <i class="fa-solid fa-headset" style="color:var(--accent);margin-right:0.35rem;"></i>
        <span <?= cms_field_attrs('cta_badge3', 'text', 'CTA — Badge 3', isset($c['cta_badge3']) ? $c['cta_badge3'] : '') ?>>
          <?= (isset($c['cta_badge3']) && $c['cta_badge3']) ? htmlspecialchars($c['cta_badge3']) : 'Support technique 12h/24h' ?>
        </span>
      </span>
    </div>
  </div>
</section>
