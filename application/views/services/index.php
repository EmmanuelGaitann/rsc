<section class="page-hero hero-carousel" <?= cms_section_attrs($c, 'hero', 'Bannière principale') ?>>
  <div class="hc-track">
    <div class="hc-slide active" style="background-image:url('<?= isset($c['slide1']) && $c['slide1'] ? base_url($c['slide1']) : 'https://images.unsplash.com/photo-1570126618953-d437176e8c79?w=1920&q=60' ?>')" <?= cms_field_attrs('slide1', 'image', 'Image slide 1', isset($c['slide1']) ? $c['slide1'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide2']) && $c['slide2'] ? base_url($c['slide2']) : 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=1920&q=60' ?>')" <?= cms_field_attrs('slide2', 'image', 'Image slide 2', isset($c['slide2']) ? $c['slide2'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide3']) && $c['slide3'] ? base_url($c['slide3']) : 'https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=1920&q=60' ?>')" <?= cms_field_attrs('slide3', 'image', 'Image slide 3', isset($c['slide3']) ? $c['slide3'] : '') ?>></div>
  </div>
  <div class="hc-overlay"></div>
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= base_url() ?>" data-i18n="nav_home">Accueil</a>
      <span>›</span>
      <span data-i18n="nav_services">Services</span>
    </div>
    <h1 <?= cms_field_attrs('hero_title', 'text', 'Titre de la bannière', isset($c['hero_title']) ? $c['hero_title'] : '') ?>><?= isset($c['hero_title']) && $c['hero_title'] ? htmlspecialchars($c['hero_title']) : 'Nos Services' ?></h1>
    <p <?= cms_field_attrs('hero_subtitle', 'text', 'Sous-titre de la bannière', isset($c['hero_subtitle']) ? $c['hero_subtitle'] : '') ?>><?= isset($c['hero_subtitle']) && $c['hero_subtitle'] ? htmlspecialchars($c['hero_subtitle']) : 'Un accompagnement technique complet de A à Z' ?></p>
  </div>
  <button class="hc-prev" aria-label="Précédent"><i class="fa-solid fa-chevron-left"></i></button>
  <button class="hc-next" aria-label="Suivant"><i class="fa-solid fa-chevron-right"></i></button>
  <div class="hc-dots">
    <button class="hc-dot active" aria-label="Slide 1"></button>
    <button class="hc-dot" aria-label="Slide 2"></button>
    <button class="hc-dot" aria-label="Slide 3"></button>
  </div>
</section>

<!-- SERVICES DÉTAILLÉS -->
<section class="section" style="background: linear-gradient(rgba(255,255,255,0.97), rgba(255,255,255,0.97)), url('https://images.unsplash.com/photo-1570126618953-d437176e8c79?w=1920&q=50') center/cover no-repeat;">
  <div class="container">
    <div style="display:flex;flex-direction:column;gap:3.5rem;">

      <!-- ===== Service 1 — Vente & Conseil ===== -->
      <div class="about-grid fade-in" style="align-items:center;" <?= cms_section_attrs($c, 'service1', 'Service 1 — Vente & Conseil') ?>>
        <div>
          <span class="section-label">01</span>
          <h2 class="section-title" <?= cms_field_attrs('srv1_title', 'text', 'Service 1 — Titre', isset($c['srv1_title']) ? $c['srv1_title'] : '') ?>><?= isset($c['srv1_title']) && $c['srv1_title'] ? htmlspecialchars($c['srv1_title']) : 'Vente &amp; Conseil' ?></h2>
          <p style="color:var(--gray);line-height:1.8;margin-bottom:1.5rem;" <?= cms_field_attrs('srv1_desc', 'text', 'Service 1 — Description', isset($c['srv1_desc']) ? $c['srv1_desc'] : '') ?>><?= isset($c['srv1_desc']) && $c['srv1_desc'] ? htmlspecialchars($c['srv1_desc']) : "Notre équipe commerciale et technique analyse vos besoins en production pour vous recommander la solution de compression d'air la plus adaptée, qu'il s'agisse d'un compresseur à vis, sans huile ou à piston." ?></p>
          <ul class="feature-list" style="margin-bottom:1.75rem;">
            <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('srv1_li1', 'text', 'Service 1 — Point 1', isset($c['srv1_li1']) ? $c['srv1_li1'] : '') ?>><?= isset($c['srv1_li1']) && $c['srv1_li1'] ? htmlspecialchars($c['srv1_li1']) : 'Étude de vos besoins en air comprimé' ?></span></li>
            <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('srv1_li2', 'text', 'Service 1 — Point 2', isset($c['srv1_li2']) ? $c['srv1_li2'] : '') ?>><?= isset($c['srv1_li2']) && $c['srv1_li2'] ? htmlspecialchars($c['srv1_li2']) : 'Sélection du compresseur optimal' ?></span></li>
            <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('srv1_li3', 'text', 'Service 1 — Point 3', isset($c['srv1_li3']) ? $c['srv1_li3'] : '') ?>><?= isset($c['srv1_li3']) && $c['srv1_li3'] ? htmlspecialchars($c['srv1_li3']) : 'Conseil en efficacité énergétique' ?></span></li>
            <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('srv1_li4', 'text', 'Service 1 — Point 4', isset($c['srv1_li4']) ? $c['srv1_li4'] : '') ?>><?= isset($c['srv1_li4']) && $c['srv1_li4'] ? htmlspecialchars($c['srv1_li4']) : 'Devis détaillé et personnalisé' ?></span></li>
          </ul>
          <a href="<?= (isset($c['srv1_btn_url']) && $c['srv1_btn_url']) ? htmlspecialchars($c['srv1_btn_url']) : base_url('contact') ?>"
             class="btn btn-primary"
             <?= cms_field_attrs('srv1_btn_url', 'url', 'Service 1 — Bouton URL', isset($c['srv1_btn_url']) ? $c['srv1_btn_url'] : '') ?>>
            <span <?= cms_field_attrs('srv1_btn_text', 'text', 'Service 1 — Bouton Texte', isset($c['srv1_btn_text']) ? $c['srv1_btn_text'] : '') ?>><?= (isset($c['srv1_btn_text']) && $c['srv1_btn_text']) ? htmlspecialchars($c['srv1_btn_text']) : 'Demander un devis' ?></span>
          </a>
        </div>
        <div style="border-radius:16px;overflow:hidden;position:relative;height:320px;" <?= cms_field_attrs('srv1_img', 'image', 'Service 1 — Image', isset($c['srv1_img']) ? $c['srv1_img'] : '') ?>>
          <img src="<?= isset($c['srv1_img']) && $c['srv1_img'] ? base_url($c['srv1_img']) : 'https://images.pexels.com/photos/3184418/pexels-photo-3184418.jpeg?auto=compress&w=800' ?>" alt="Vente &amp; Conseil RSC" style="width:100%;height:100%;object-fit:cover;">
          <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(30,40,55,0.7) 0%,transparent 60%);display:flex;align-items:flex-end;padding:1.5rem;">
            <div>
              <div style="display:inline-flex;align-items:center;gap:0.5rem;background:rgba(237,205,31,0.9);color:var(--dark);padding:0.3rem 0.85rem;border-radius:50px;font-size:0.72rem;font-weight:700;font-family:'Montserrat',sans-serif;margin-bottom:0.5rem;">
                <i class="fa-solid fa-cart-shopping"></i>
                <span <?= cms_field_attrs('srv1_badge', 'text', 'Service 1 — Badge image', isset($c['srv1_badge']) ? $c['srv1_badge'] : '') ?>><?= (isset($c['srv1_badge']) && $c['srv1_badge']) ? htmlspecialchars($c['srv1_badge']) : 'Vente &amp; Conseil' ?></span>
              </div>
              <p style="color:rgba(255,255,255,0.85);font-size:0.85rem;margin:0;" <?= cms_field_attrs('srv1_caption', 'text', 'Service 1 — Légende image', isset($c['srv1_caption']) ? $c['srv1_caption'] : '') ?>><?= (isset($c['srv1_caption']) && $c['srv1_caption']) ? htmlspecialchars($c['srv1_caption']) : 'RENNER, Ingersoll Rand et toutes marques — conseil indépendant' ?></p>
            </div>
          </div>
        </div>
      </div>

      <hr style="border:none;border-top:1px solid var(--border);">

      <!-- ===== Service 2 — Installation ===== -->
      <div class="about-grid fade-in" style="align-items:center;" <?= cms_section_attrs($c, 'service2', 'Service 2 — Installation & Mise en service') ?>>
        <div style="border-radius:16px;overflow:hidden;position:relative;height:320px;" <?= cms_field_attrs('srv2_img', 'image', 'Service 2 — Image', isset($c['srv2_img']) ? $c['srv2_img'] : '') ?>>
          <img src="<?= isset($c['srv2_img']) && $c['srv2_img'] ? base_url($c['srv2_img']) : 'https://images.pexels.com/photos/3844790/pexels-photo-3844790.jpeg?auto=compress&w=800' ?>" alt="Installation &amp; Mise en service RSC" style="width:100%;height:100%;object-fit:cover;">
          <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(30,40,55,0.7) 0%,transparent 60%);display:flex;align-items:flex-end;padding:1.5rem;">
            <div>
              <div style="display:inline-flex;align-items:center;gap:0.5rem;background:var(--primary);color:white;padding:0.3rem 0.85rem;border-radius:50px;font-size:0.72rem;font-weight:700;font-family:'Montserrat',sans-serif;margin-bottom:0.5rem;">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                <span <?= cms_field_attrs('srv2_badge', 'text', 'Service 2 — Badge image', isset($c['srv2_badge']) ? $c['srv2_badge'] : '') ?>><?= (isset($c['srv2_badge']) && $c['srv2_badge']) ? htmlspecialchars($c['srv2_badge']) : 'Techniciens Certifiés' ?></span>
              </div>
              <p style="color:rgba(255,255,255,0.85);font-size:0.85rem;margin:0;" <?= cms_field_attrs('srv2_caption', 'text', 'Service 2 — Légende image', isset($c['srv2_caption']) ? $c['srv2_caption'] : '') ?>><?= (isset($c['srv2_caption']) && $c['srv2_caption']) ? htmlspecialchars($c['srv2_caption']) : 'Certifiés fabricants — Formation continue' ?></p>
            </div>
          </div>
        </div>
        <div>
          <span class="section-label">02</span>
          <h2 class="section-title" <?= cms_field_attrs('srv2_title', 'text', 'Service 2 — Titre', isset($c['srv2_title']) ? $c['srv2_title'] : '') ?>><?= isset($c['srv2_title']) && $c['srv2_title'] ? htmlspecialchars($c['srv2_title']) : 'Installation &amp; Mise en service' ?></h2>
          <p style="color:var(--gray);line-height:1.8;margin-bottom:1.5rem;" <?= cms_field_attrs('srv2_desc', 'text', 'Service 2 — Description', isset($c['srv2_desc']) ? $c['srv2_desc'] : '') ?>><?= isset($c['srv2_desc']) && $c['srv2_desc'] ? htmlspecialchars($c['srv2_desc']) : "Nos techniciens certifiés assurent l'installation complète de vos équipements, toutes marques confondues : positionnement, raccordements électriques et pneumatiques, mise en service, tests et formation de vos opérateurs." ?></p>
          <ul class="feature-list" style="margin-bottom:1.75rem;">
            <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('srv2_li1', 'text', 'Service 2 — Point 1', isset($c['srv2_li1']) ? $c['srv2_li1'] : '') ?>><?= isset($c['srv2_li1']) && $c['srv2_li1'] ? htmlspecialchars($c['srv2_li1']) : 'Installation et positionnement professionnel' ?></span></li>
            <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('srv2_li2', 'text', 'Service 2 — Point 2', isset($c['srv2_li2']) ? $c['srv2_li2'] : '') ?>><?= isset($c['srv2_li2']) && $c['srv2_li2'] ? htmlspecialchars($c['srv2_li2']) : 'Raccordements électriques et pneumatiques' ?></span></li>
            <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('srv2_li3', 'text', 'Service 2 — Point 3', isset($c['srv2_li3']) ? $c['srv2_li3'] : '') ?>><?= isset($c['srv2_li3']) && $c['srv2_li3'] ? htmlspecialchars($c['srv2_li3']) : 'Mise en service et tests de performance' ?></span></li>
            <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('srv2_li4', 'text', 'Service 2 — Point 4', isset($c['srv2_li4']) ? $c['srv2_li4'] : '') ?>><?= isset($c['srv2_li4']) && $c['srv2_li4'] ? htmlspecialchars($c['srv2_li4']) : 'Formation des opérateurs incluse' ?></span></li>
          </ul>
          <a href="<?= (isset($c['srv2_btn_url']) && $c['srv2_btn_url']) ? htmlspecialchars($c['srv2_btn_url']) : base_url('contact') ?>"
             class="btn btn-primary"
             <?= cms_field_attrs('srv2_btn_url', 'url', 'Service 2 — Bouton URL', isset($c['srv2_btn_url']) ? $c['srv2_btn_url'] : '') ?>>
            <span <?= cms_field_attrs('srv2_btn_text', 'text', 'Service 2 — Bouton Texte', isset($c['srv2_btn_text']) ? $c['srv2_btn_text'] : '') ?>><?= (isset($c['srv2_btn_text']) && $c['srv2_btn_text']) ? htmlspecialchars($c['srv2_btn_text']) : 'Nous contacter' ?></span>
          </a>
        </div>
      </div>

      <hr style="border:none;border-top:1px solid var(--border);">

      <!-- ===== Service 3 — Maintenance ===== -->
      <div class="about-grid fade-in" style="align-items:center;" <?= cms_section_attrs($c, 'service3', 'Service 3 — Maintenance & Réparation') ?>>
        <div>
          <span class="section-label">03</span>
          <h2 class="section-title" <?= cms_field_attrs('srv3_title', 'text', 'Service 3 — Titre', isset($c['srv3_title']) ? $c['srv3_title'] : '') ?>><?= isset($c['srv3_title']) && $c['srv3_title'] ? htmlspecialchars($c['srv3_title']) : 'Maintenance &amp; Réparation' ?></h2>
          <p style="color:var(--gray);line-height:1.8;margin-bottom:1.5rem;" <?= cms_field_attrs('srv3_desc', 'text', 'Service 3 — Description', isset($c['srv3_desc']) ? $c['srv3_desc'] : '') ?>><?= isset($c['srv3_desc']) && $c['srv3_desc'] ? htmlspecialchars($c['srv3_desc']) : "Royal Sales Cameroon assure la maintenance préventive et corrective de tous vos compresseurs, toutes marques confondues, avec des pièces d'origine ou équivalent certifié. Nos interventions d'urgence sont disponibles à prix fixe pour minimiser vos arrêts de production." ?></p>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.75rem;">
            <div style="background:var(--primary-light);padding:1.5rem;border-radius:10px;border-left:3px solid var(--primary);">
              <h4 style="color:var(--primary);margin-bottom:0.5rem;font-size:0.95rem;font-family:'Montserrat',sans-serif;" <?= cms_field_attrs('srv3_card1_title', 'text', 'Service 3 — Carte 1 Titre', isset($c['srv3_card1_title']) ? $c['srv3_card1_title'] : '') ?>><?= (isset($c['srv3_card1_title']) && $c['srv3_card1_title']) ? htmlspecialchars($c['srv3_card1_title']) : 'Préventive' ?></h4>
              <p style="color:var(--gray);font-size:0.85rem;line-height:1.65;" <?= cms_field_attrs('srv3_card1_text', 'text', 'Service 3 — Carte 1 Texte', isset($c['srv3_card1_text']) ? $c['srv3_card1_text'] : '') ?>><?= (isset($c['srv3_card1_text']) && $c['srv3_card1_text']) ? htmlspecialchars($c['srv3_card1_text']) : 'Visites planifiées, remplacement filtres, huile, courroies. Rapport technique systématique.' ?></p>
            </div>
            <div style="background:var(--light);padding:1.5rem;border-radius:10px;border-left:3px solid var(--accent);border:1px solid var(--border);">
              <h4 style="color:var(--dark);margin-bottom:0.5rem;font-size:0.95rem;font-family:'Montserrat',sans-serif;" <?= cms_field_attrs('srv3_card2_title', 'text', 'Service 3 — Carte 2 Titre', isset($c['srv3_card2_title']) ? $c['srv3_card2_title'] : '') ?>><?= (isset($c['srv3_card2_title']) && $c['srv3_card2_title']) ? htmlspecialchars($c['srv3_card2_title']) : 'Corrective / Urgence' ?></h4>
              <p style="color:var(--gray);font-size:0.85rem;line-height:1.65;" <?= cms_field_attrs('srv3_card2_text', 'text', 'Service 3 — Carte 2 Texte', isset($c['srv3_card2_text']) ? $c['srv3_card2_text'] : '') ?>><?= (isset($c['srv3_card2_text']) && $c['srv3_card2_text']) ? htmlspecialchars($c['srv3_card2_text']) : "Intervention sous 12h. Diagnostic rapide, réparation avec pièces d'origine. Prix fixe." ?></p>
            </div>
          </div>
          <a href="<?= (isset($c['srv3_btn_url']) && $c['srv3_btn_url']) ? htmlspecialchars($c['srv3_btn_url']) : base_url('contact') ?>"
             class="btn btn-primary"
             <?= cms_field_attrs('srv3_btn_url', 'url', 'Service 3 — Bouton URL', isset($c['srv3_btn_url']) ? $c['srv3_btn_url'] : '') ?>>
            <span <?= cms_field_attrs('srv3_btn_text', 'text', 'Service 3 — Bouton Texte', isset($c['srv3_btn_text']) ? $c['srv3_btn_text'] : '') ?>><?= (isset($c['srv3_btn_text']) && $c['srv3_btn_text']) ? htmlspecialchars($c['srv3_btn_text']) : 'Demander une intervention' ?></span>
          </a>
        </div>
        <div style="border-radius:16px;overflow:hidden;position:relative;height:320px;" <?= cms_field_attrs('srv3_img', 'image', 'Service 3 — Image', isset($c['srv3_img']) ? $c['srv3_img'] : '') ?>>
          <img src="<?= isset($c['srv3_img']) && $c['srv3_img'] ? base_url($c['srv3_img']) : 'https://images.pexels.com/photos/8961252/pexels-photo-8961252.jpeg?auto=compress&w=800' ?>" alt="Maintenance RSC" style="width:100%;height:100%;object-fit:cover;">
          <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(30,40,55,0.7) 0%,transparent 60%);display:flex;align-items:flex-end;padding:1.5rem;">
            <div>
              <div style="display:inline-flex;align-items:center;gap:0.5rem;background:rgba(237,205,31,0.9);color:var(--dark);padding:0.3rem 0.85rem;border-radius:50px;font-size:0.72rem;font-weight:700;font-family:'Montserrat',sans-serif;margin-bottom:0.5rem;">
                <i class="fa-solid fa-gears"></i>
                <span <?= cms_field_attrs('srv3_badge', 'text', 'Service 3 — Badge image', isset($c['srv3_badge']) ? $c['srv3_badge'] : '') ?>><?= (isset($c['srv3_badge']) && $c['srv3_badge']) ? htmlspecialchars($c['srv3_badge']) : 'Intervention sous 12h' ?></span>
              </div>
              <p style="color:rgba(255,255,255,0.85);font-size:0.85rem;margin:0;" <?= cms_field_attrs('srv3_caption', 'text', 'Service 3 — Légende image', isset($c['srv3_caption']) ? $c['srv3_caption'] : '') ?>><?= (isset($c['srv3_caption']) && $c['srv3_caption']) ? htmlspecialchars($c['srv3_caption']) : "Urgences à prix fixe — Pièces d'origine en stock" ?></p>
            </div>
          </div>
        </div>
      </div>

      <hr style="border:none;border-top:1px solid var(--border);">

      <!-- ===== Service 4 — Pièces & Lubrifiants ===== -->
      <div class="about-grid fade-in" style="align-items:center;" <?= cms_section_attrs($c, 'service4', 'Service 4 — Pièces & Lubrifiants') ?>>
        <div style="border-radius:16px;overflow:hidden;position:relative;height:320px;" <?= cms_field_attrs('srv4_img', 'image', 'Service 4 — Image', isset($c['srv4_img']) ? $c['srv4_img'] : '') ?>>
          <img src="<?= isset($c['srv4_img']) && $c['srv4_img'] ? base_url($c['srv4_img']) : 'https://images.pexels.com/photos/4489749/pexels-photo-4489749.jpeg?auto=compress&w=800' ?>" alt="Pièces &amp; Lubrifiants RSC" style="width:100%;height:100%;object-fit:cover;">
          <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(30,40,55,0.7) 0%,transparent 60%);display:flex;align-items:flex-end;padding:1.5rem;">
            <div>
              <div style="display:inline-flex;align-items:center;gap:0.5rem;background:var(--renner);color:white;padding:0.3rem 0.85rem;border-radius:50px;font-size:0.72rem;font-weight:700;font-family:'Montserrat',sans-serif;margin-bottom:0.5rem;">
                <i class="fa-solid fa-oil-can"></i>
                <span <?= cms_field_attrs('srv4_badge', 'text', "Service 4 — Badge image", isset($c['srv4_badge']) ? $c['srv4_badge'] : '') ?>><?= (isset($c['srv4_badge']) && $c['srv4_badge']) ? htmlspecialchars($c['srv4_badge']) : "Pièces d'Origine" ?></span>
              </div>
              <p style="color:rgba(255,255,255,0.85);font-size:0.85rem;margin:0;" <?= cms_field_attrs('srv4_caption', 'text', 'Service 4 — Légende image', isset($c['srv4_caption']) ? $c['srv4_caption'] : '') ?>><?= (isset($c['srv4_caption']) && $c['srv4_caption']) ? htmlspecialchars($c['srv4_caption']) : 'Stock certifié RENNER &amp; Ingersoll Rand à Douala' ?></p>
            </div>
          </div>
        </div>
        <div>
          <span class="section-label">04</span>
          <h2 class="section-title" <?= cms_field_attrs('srv4_title', 'text', 'Service 4 — Titre', isset($c['srv4_title']) ? $c['srv4_title'] : '') ?>><?= isset($c['srv4_title']) && $c['srv4_title'] ? htmlspecialchars($c['srv4_title']) : 'Pièces Détachées &amp; Lubrifiants' ?></h2>
          <p style="color:var(--gray);line-height:1.8;margin-bottom:1.5rem;" <?= cms_field_attrs('srv4_desc', 'text', 'Service 4 — Description', isset($c['srv4_desc']) ? $c['srv4_desc'] : '') ?>><?= isset($c['srv4_desc']) && $c['srv4_desc'] ? htmlspecialchars($c['srv4_desc']) : "Royal Sales Cameroon maintient un stock de pièces d'origine et de lubrifiants spécialisés pour garantir des interventions rapides. Nos pièces sont certifiées et compatibles avec toutes les grandes marques de compresseurs industriels." ?></p>
          <ul class="feature-list" style="margin-bottom:1.75rem;">
            <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('srv4_li1', 'text', 'Service 4 — Point 1', isset($c['srv4_li1']) ? $c['srv4_li1'] : '') ?>><?= isset($c['srv4_li1']) && $c['srv4_li1'] ? htmlspecialchars($c['srv4_li1']) : "Filtres à air, à huile et séparateurs d'origine" ?></span></li>
            <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('srv4_li2', 'text', 'Service 4 — Point 2', isset($c['srv4_li2']) ? $c['srv4_li2'] : '') ?>><?= isset($c['srv4_li2']) && $c['srv4_li2'] ? htmlspecialchars($c['srv4_li2']) : 'Lubrifiants haute performance pour compresseurs (dont huile CAS exclusive RSC)' ?></span></li>
            <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('srv4_li3', 'text', 'Service 4 — Point 3', isset($c['srv4_li3']) ? $c['srv4_li3'] : '') ?>><?= isset($c['srv4_li3']) && $c['srv4_li3'] ? htmlspecialchars($c['srv4_li3']) : 'Courroies, joints et kits de révision certifiés' ?></span></li>
            <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('srv4_li4', 'text', 'Service 4 — Point 4', isset($c['srv4_li4']) ? $c['srv4_li4'] : '') ?>><?= isset($c['srv4_li4']) && $c['srv4_li4'] ? htmlspecialchars($c['srv4_li4']) : 'Commande rapide et disponibilité immédiate' ?></span></li>
          </ul>
          <a href="<?= (isset($c['srv4_btn_url']) && $c['srv4_btn_url']) ? htmlspecialchars($c['srv4_btn_url']) : base_url('contact') ?>"
             class="btn btn-primary"
             <?= cms_field_attrs('srv4_btn_url', 'url', 'Service 4 — Bouton URL', isset($c['srv4_btn_url']) ? $c['srv4_btn_url'] : '') ?>>
            <span <?= cms_field_attrs('srv4_btn_text', 'text', 'Service 4 — Bouton Texte', isset($c['srv4_btn_text']) ? $c['srv4_btn_text'] : '') ?>><?= (isset($c['srv4_btn_text']) && $c['srv4_btn_text']) ? htmlspecialchars($c['srv4_btn_text']) : 'Commander des pièces' ?></span>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- CONTRATS DE MAINTENANCE -->
<section id="contracts" class="section bg-light" style="background: linear-gradient(rgba(244,246,249,0.94), rgba(244,246,249,0.94)), url('https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=1920&q=50') center/cover no-repeat;" <?= cms_section_attrs($c, 'contracts', 'Contrats de Maintenance') ?>>
  <div class="container">
    <div class="section-header fade-in">
      <span class="section-label" style="background:var(--accent);color:var(--dark);padding:0.3rem 1rem;border-radius:50px;font-weight:700;" <?= cms_field_attrs('contracts_badge', 'text', 'Contrats — Badge', isset($c['contracts_badge']) ? $c['contracts_badge'] : '') ?>><?= (isset($c['contracts_badge']) && $c['contracts_badge']) ? htmlspecialchars($c['contracts_badge']) : 'Offre phare' ?></span>
      <h2 class="section-title" <?= cms_field_attrs('contracts_title', 'text', 'Contrats — Titre', isset($c['contracts_title']) ? $c['contracts_title'] : '') ?>><?= (isset($c['contracts_title']) && $c['contracts_title']) ? htmlspecialchars($c['contracts_title']) : 'Contrats de Maintenance' ?></h2>
      <p class="section-subtitle" <?= cms_field_attrs('contracts_subtitle', 'text', 'Contrats — Sous-titre', isset($c['contracts_subtitle']) ? $c['contracts_subtitle'] : '') ?>><?= (isset($c['contracts_subtitle']) && $c['contracts_subtitle']) ? htmlspecialchars($c['contracts_subtitle']) : 'Protégez vos équipements avec nos contrats de maintenance annuels. Nos techniciens certifiés assurent le suivi régulier de vos installations.' ?></p>
    </div>
    <div class="grid-2 fade-in" style="align-items:start;">
      <div style="background:white;border-radius:16px;padding:2.5rem;box-shadow:var(--shadow);border:1px solid var(--border);">
        <h3 style="color:var(--dark);margin-bottom:1.5rem;font-family:'Montserrat',sans-serif;" <?= cms_field_attrs('contracts_box_title', 'text', 'Contrats — Titre liste inclus', isset($c['contracts_box_title']) ? $c['contracts_box_title'] : '') ?>><?= (isset($c['contracts_box_title']) && $c['contracts_box_title']) ? htmlspecialchars($c['contracts_box_title']) : 'Ce que comprend un contrat :' ?></h3>
        <ul class="feature-list">
          <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('contracts_li1', 'text', 'Contrats — Inclus 1', isset($c['contracts_li1']) ? $c['contracts_li1'] : '') ?>><?= (isset($c['contracts_li1']) && $c['contracts_li1']) ? htmlspecialchars($c['contracts_li1']) : 'Visites préventives programmées (selon fréquence convenue)' ?></span></li>
          <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('contracts_li2', 'text', 'Contrats — Inclus 2', isset($c['contracts_li2']) ? $c['contracts_li2'] : '') ?>><?= (isset($c['contracts_li2']) && $c['contracts_li2']) ? htmlspecialchars($c['contracts_li2']) : "Remplacement des pièces d'usure inclus" ?></span></li>
          <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('contracts_li3', 'text', 'Contrats — Inclus 3', isset($c['contracts_li3']) ? $c['contracts_li3'] : '') ?>><?= (isset($c['contracts_li3']) && $c['contracts_li3']) ? htmlspecialchars($c['contracts_li3']) : 'Interventions correctives prioritaires' ?></span></li>
          <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('contracts_li4', 'text', 'Contrats — Inclus 4', isset($c['contracts_li4']) ? $c['contracts_li4'] : '') ?>><?= (isset($c['contracts_li4']) && $c['contracts_li4']) ? htmlspecialchars($c['contracts_li4']) : 'Rapport technique après chaque visite' ?></span></li>
          <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('contracts_li5', 'text', 'Contrats — Inclus 5', isset($c['contracts_li5']) ? $c['contracts_li5'] : '') ?>><?= (isset($c['contracts_li5']) && $c['contracts_li5']) ? htmlspecialchars($c['contracts_li5']) : 'Hotline technique 7j/7' ?></span></li>
          <li><span class="feature-check"><svg viewBox="0 0 24 24" fill="currentColor" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span><span <?= cms_field_attrs('contracts_li6', 'text', 'Contrats — Inclus 6', isset($c['contracts_li6']) ? $c['contracts_li6'] : '') ?>><?= (isset($c['contracts_li6']) && $c['contracts_li6']) ? htmlspecialchars($c['contracts_li6']) : 'Gestion du stock de pièces détachées' ?></span></li>
        </ul>
      </div>
      <div>
        <div style="background:var(--dark);border-radius:16px;padding:2.5rem;color:white;margin-bottom:1.5rem;border-left:4px solid var(--accent);">
          <h3 style="margin-bottom:1.25rem;font-family:'Montserrat',sans-serif;" <?= cms_field_attrs('contracts_adv_title', 'text', 'Contrats — Titre avantages', isset($c['contracts_adv_title']) ? $c['contracts_adv_title'] : '') ?>><?= (isset($c['contracts_adv_title']) && $c['contracts_adv_title']) ? htmlspecialchars($c['contracts_adv_title']) : 'Avantages du contrat' ?></h3>
          <ul style="list-style:none;display:flex;flex-direction:column;gap:0.85rem;font-size:0.95rem;">
            <?php
            $adv_defaults = [
              'contracts_adv1' => 'Zéro surprise : coûts de maintenance maîtrisés',
              'contracts_adv2' => "Priorisation de vos interventions d'urgence",
              'contracts_adv3' => 'Suivi historique complet de vos équipements',
              'contracts_adv4' => 'Tarifs préférentiels sur pièces et main d\'œuvre',
              'contracts_adv5' => 'Prolongation de la durée de vie de vos machines',
            ];
            foreach ($adv_defaults as $key => $default):
              $num = substr($key, -1);
            ?>
            <li style="display:flex;gap:0.75rem;align-items:flex-start;color:rgba(255,255,255,0.75);">
              <span style="width:18px;height:18px;border-radius:50%;background:rgba(237,205,31,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                <svg viewBox="0 0 24 24" fill="#EDCD1F" width="10" height="10"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              </span>
              <span <?= cms_field_attrs($key, 'text', 'Contrats — Avantage ' . $num, isset($c[$key]) ? $c[$key] : '') ?>><?= (isset($c[$key]) && $c[$key]) ? htmlspecialchars($c[$key]) : $default ?></span>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <a href="<?= (isset($c['contracts_btn_url']) && $c['contracts_btn_url']) ? htmlspecialchars($c['contracts_btn_url']) : base_url('contact') . '?subject=maintenance' ?>"
           class="btn btn-primary" style="width:100%;justify-content:center;"
           <?= cms_field_attrs('contracts_btn_url', 'url', 'Contrats — Bouton URL', isset($c['contracts_btn_url']) ? $c['contracts_btn_url'] : '') ?>>
          <span <?= cms_field_attrs('contracts_btn_text', 'text', 'Contrats — Bouton Texte', isset($c['contracts_btn_text']) ? $c['contracts_btn_text'] : '') ?>><?= (isset($c['contracts_btn_text']) && $c['contracts_btn_text']) ? htmlspecialchars($c['contracts_btn_text']) : 'Demander une offre de contrat' ?></span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- AUDIT -->
<section class="section" <?= cms_section_attrs($c, 'audit', 'Audit Air Comprimé') ?>>
  <div class="container fade-in">
    <div style="background:var(--dark);border-radius:20px;padding:3.5rem;display:grid;grid-template-columns:1fr auto;gap:2rem;align-items:center;border-left:4px solid var(--accent);">
      <div>
        <span class="section-label" style="color:var(--accent);" <?= cms_field_attrs('audit_label', 'text', 'Audit — Label', isset($c['audit_label']) ? $c['audit_label'] : '') ?>><?= (isset($c['audit_label']) && $c['audit_label']) ? htmlspecialchars($c['audit_label']) : 'Audit Air Comprimé' ?></span>
        <h2 style="color:white;margin:0.75rem 0;" <?= cms_field_attrs('audit_title', 'text', 'Audit — Titre', isset($c['audit_title']) ? $c['audit_title'] : '') ?>><?= (isset($c['audit_title']) && $c['audit_title']) ? htmlspecialchars($c['audit_title']) : "Audit de votre réseau d'air comprimé" ?></h2>
        <p style="color:rgba(255,255,255,0.55);line-height:1.8;" <?= cms_field_attrs('audit_text', 'text', 'Audit — Texte', isset($c['audit_text']) ? $c['audit_text'] : '') ?>><?= (isset($c['audit_text']) && $c['audit_text']) ? htmlspecialchars($c['audit_text']) : "Notre service d'audit analyse votre réseau d'air comprimé pour identifier les pertes, optimiser les performances et réduire votre consommation d'énergie jusqu'à 30%." ?></p>
      </div>
      <div>
        <a href="<?= (isset($c['audit_btn_url']) && $c['audit_btn_url']) ? htmlspecialchars($c['audit_btn_url']) : base_url('contact') . '?subject=audit' ?>"
           class="btn btn-accent btn-lg"
           <?= cms_field_attrs('audit_btn_url', 'url', 'Audit — Bouton URL', isset($c['audit_btn_url']) ? $c['audit_btn_url'] : '') ?>>
          <span <?= cms_field_attrs('audit_btn_text', 'text', 'Audit — Bouton Texte', isset($c['audit_btn_text']) ? $c['audit_btn_text'] : '') ?>><?= (isset($c['audit_btn_text']) && $c['audit_btn_text']) ? htmlspecialchars($c['audit_btn_text']) : 'Demander un audit' ?></span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- CTA FINAL -->
<section class="cta-section fade-in" <?= cms_section_attrs($c, 'services_cta', "Appel à l'action final") ?>>
  <div class="container" style="position:relative;z-index:1;">
    <h2 <?= cms_field_attrs('cta_title', 'text', 'CTA — Titre', isset($c['cta_title']) ? $c['cta_title'] : '') ?>><?= (isset($c['cta_title']) && $c['cta_title']) ? htmlspecialchars($c['cta_title']) : 'Prêt à optimiser votre production ?' ?></h2>
    <p <?= cms_field_attrs('cta_text', 'text', 'CTA — Texte', isset($c['cta_text']) ? $c['cta_text'] : '') ?>><?= (isset($c['cta_text']) && $c['cta_text']) ? htmlspecialchars($c['cta_text']) : 'Contactez notre équipe pour une étude de vos besoins et un devis personnalisé.' ?></p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
      <a href="<?= cta_url($c['cta_btn1_url'] ?? '', base_url('contact')) ?>"
         class="btn btn-accent btn-lg"
         <?= cms_field_attrs('cta_btn1_url', 'url', 'CTA — Bouton 1 URL', $c['cta_btn1_url'] ?? '') ?>>
        <i class="fa-solid fa-paper-plane" style="margin-right:0.4rem;"></i>
        <span <?= cms_field_attrs('cta_btn1_text', 'text', 'CTA — Bouton 1 Texte', $c['cta_btn1_text'] ?? '') ?>><?= ($c['cta_btn1_text'] ?? '') ? htmlspecialchars($c['cta_btn1_text']) : 'Demander un devis gratuit' ?></span>
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
