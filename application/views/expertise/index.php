<section class="page-hero hero-carousel" <?= cms_section_attrs($c, 'hero', 'Bannière principale') ?>>
  <div class="hc-track">
    <div class="hc-slide active" style="background-image:url('<?= isset($c['slide1']) && $c['slide1'] ? base_url($c['slide1']) : 'https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=1920&q=60' ?>')" <?= cms_field_attrs('slide1', 'image', 'Image slide 1', isset($c['slide1']) ? $c['slide1'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide2']) && $c['slide2'] ? base_url($c['slide2']) : 'https://images.unsplash.com/photo-1570126618953-d437176e8c79?w=1920&q=60' ?>')" <?= cms_field_attrs('slide2', 'image', 'Image slide 2', isset($c['slide2']) ? $c['slide2'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide3']) && $c['slide3'] ? base_url($c['slide3']) : 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=1920&q=60' ?>')" <?= cms_field_attrs('slide3', 'image', 'Image slide 3', isset($c['slide3']) ? $c['slide3'] : '') ?>></div>
  </div>
  <div class="hc-overlay"></div>
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= base_url() ?>" data-i18n="nav_home">Accueil</a>
      <span>›</span>
      <span data-i18n="nav_expertise">Expertise</span>
    </div>
    <h1 <?= cms_field_attrs('hero_title', 'text', 'Titre de la bannière', isset($c['hero_title']) ? $c['hero_title'] : '') ?>><?= isset($c['hero_title']) && $c['hero_title'] ? htmlspecialchars($c['hero_title']) : 'Expertise &amp; Actualités' ?></h1>
    <p <?= cms_field_attrs('hero_subtitle', 'text', 'Sous-titre de la bannière', isset($c['hero_subtitle']) ? $c['hero_subtitle'] : '') ?>><?= isset($c['hero_subtitle']) && $c['hero_subtitle'] ? htmlspecialchars($c['hero_subtitle']) : 'Ressources techniques et actualités du secteur' ?></p>
  </div>
  <button class="hc-prev" aria-label="Précédent"><i class="fa-solid fa-chevron-left"></i></button>
  <button class="hc-next" aria-label="Suivant"><i class="fa-solid fa-chevron-right"></i></button>
  <div class="hc-dots">
    <button class="hc-dot active" aria-label="Slide 1"></button>
    <button class="hc-dot" aria-label="Slide 2"></button>
    <button class="hc-dot" aria-label="Slide 3"></button>
  </div>
</section>

<!-- ARTICLES / CONSEILS -->
<section class="section" style="background: linear-gradient(rgba(255,255,255,0.97), rgba(255,255,255,0.97)), url('https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=1920&q=50') center/cover no-repeat;" <?= cms_section_attrs($c, 'articles', 'Articles & Conseils') ?>>
  <div class="container">
    <div class="section-header fade-in">
      <span class="section-label" <?= cms_field_attrs('exp_label', 'text', 'Section — Label', isset($c['exp_label']) ? $c['exp_label'] : '') ?>><?= (isset($c['exp_label']) && $c['exp_label']) ? htmlspecialchars($c['exp_label']) : 'Conseils Royal Sales Cameroon' ?></span>
      <h2 class="section-title" <?= cms_field_attrs('exp_title', 'text', 'Section — Titre', isset($c['exp_title']) ? $c['exp_title'] : '') ?>><?= (isset($c['exp_title']) && $c['exp_title']) ? htmlspecialchars($c['exp_title']) : 'Ce que nos techniciens recommandent' ?></h2>
      <p class="section-subtitle" <?= cms_field_attrs('exp_subtitle', 'text', 'Section — Sous-titre', isset($c['exp_subtitle']) ? $c['exp_subtitle'] : '') ?>><?= (isset($c['exp_subtitle']) && $c['exp_subtitle']) ? htmlspecialchars($c['exp_subtitle']) : 'Nos équipes terrain partagent leur expérience pour vous aider à mieux exploiter et maintenir vos équipements.' ?></p>
    </div>

    <div class="grid-3" style="gap:2rem;">

      <?php
      $articles = [
        1 => [
          'img_default'  => 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=600&q=80',
          'img_alt'      => 'Entretien compresseur',
          'label_def'    => 'Maintenance',
          'title_def'    => 'Pourquoi entretenir régulièrement votre compresseur ?',
          'desc_def'     => "Un entretien régulier prolonge la durée de vie de votre compresseur, réduit la consommation d'énergie et prévient les pannes coûteuses.",
          'btn_text_def' => 'Poser une question à nos experts',
          'btn_url_def'  => 'contact?subject=technique',
        ],
        2 => [
          'img_default'  => 'https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=600&q=80',
          'img_alt'      => 'Compresseur sans huile',
          'label_def'    => 'Technologie',
          'title_def'    => 'Compresseur à huile vs sans huile : lequel choisir ?',
          'desc_def'     => "Tout ce que vous devez savoir pour choisir entre un compresseur injecté d'huile et un compresseur sans huile selon votre application industrielle.",
          'btn_text_def' => 'Demander conseil à RSC',
          'btn_url_def'  => 'contact?subject=commercial',
        ],
        3 => [
          'img_default'  => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80',
          'img_alt'      => "Sécheur d'air réseau industriel",
          'label_def'    => "Traitement de l'air",
          'title_def'    => "L'importance du séchage de l'air comprimé",
          'desc_def'     => "L'eau dans votre réseau d'air comprimé cause corrosion, pannes et pertes de production. Découvrez les solutions de séchage adaptées.",
          'btn_text_def' => "Voir nos sécheurs d'air",
          'btn_url_def'  => 'produits?cat=air',
        ],
        4 => [
          'img_default'  => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?w=600&q=80',
          'img_alt'      => 'Efficacité énergétique',
          'label_def'    => 'Énergie',
          'title_def'    => "Réduire sa consommation d'énergie avec un compresseur à vitesse variable",
          'desc_def'     => "Les compresseurs à vitesse variable (VSD) peuvent réduire la consommation électrique jusqu'à 35% par rapport aux modèles à vitesse fixe.",
          'btn_text_def' => 'Demander un audit énergétique',
          'btn_url_def'  => 'contact?subject=technique',
        ],
        5 => [
          'img_default'  => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=600&q=80',
          'img_alt'      => 'Système de contrôle',
          'label_def'    => 'Innovation',
          'title_def'    => 'RENNERtronic Touch : la gestion intelligente de vos compresseurs',
          'desc_def'     => "Le système RENNERtronic Touch permet le monitoring en temps réel, la détection préventive des pannes et l'optimisation automatique des performances.",
          'btn_text_def' => 'Voir les systèmes de contrôle',
          'btn_url_def'  => 'produits?cat=control',
        ],
        6 => [
          'img_default'  => 'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=600&q=80',
          'img_alt'      => 'Qualité air comprimé',
          'label_def'    => 'Qualité',
          'title_def'    => "Normes ISO 8573 : les classes de qualité de l'air comprimé",
          'desc_def'     => "Comprendre les classes de qualité ISO 8573 pour choisir les bons équipements de traitement de l'air selon votre industrie.",
          'btn_text_def' => 'Consulter un technicien RSC',
          'btn_url_def'  => 'contact?subject=technique',
        ],
      ];
      ?>

      <?php foreach ($articles as $n => $a): ?>
      <?php
        $img_src    = (isset($c['art'.$n.'_img']) && $c['art'.$n.'_img']) ? base_url($c['art'.$n.'_img']) : $a['img_default'];
        $btn_href   = (isset($c['art'.$n.'_btn_url']) && $c['art'.$n.'_btn_url']) ? htmlspecialchars($c['art'.$n.'_btn_url']) : base_url($a['btn_url_def']);
      ?>
      <article class="card fade-in">
        <div style="position:relative;overflow:hidden;line-height:0;"
             <?= cms_field_attrs('art'.$n.'_img', 'image', 'Article '.$n.' — Image', isset($c['art'.$n.'_img']) ? $c['art'.$n.'_img'] : '') ?>>
          <img src="<?= $img_src ?>" alt="<?= htmlspecialchars($a['img_alt']) ?>" class="card-img" loading="lazy">
        </div>
        <div class="card-body">
          <span class="card-label" <?= cms_field_attrs('art'.$n.'_label', 'text', 'Article '.$n.' — Catégorie', isset($c['art'.$n.'_label']) ? $c['art'.$n.'_label'] : '') ?>><?= isset($c['art'.$n.'_label']) && $c['art'.$n.'_label'] ? htmlspecialchars($c['art'.$n.'_label']) : $a['label_def'] ?></span>
          <h3 class="card-title" <?= cms_field_attrs('art'.$n.'_title', 'text', 'Article '.$n.' — Titre', isset($c['art'.$n.'_title']) ? $c['art'.$n.'_title'] : '') ?>><?= isset($c['art'.$n.'_title']) && $c['art'.$n.'_title'] ? htmlspecialchars($c['art'.$n.'_title']) : $a['title_def'] ?></h3>
          <p class="card-desc" <?= cms_field_attrs('art'.$n.'_desc', 'text', 'Article '.$n.' — Description', isset($c['art'.$n.'_desc']) ? $c['art'.$n.'_desc'] : '') ?>><?= isset($c['art'.$n.'_desc']) && $c['art'.$n.'_desc'] ? htmlspecialchars($c['art'.$n.'_desc']) : $a['desc_def'] ?></p>
          <div style="margin-top:1rem;">
            <a href="<?= $btn_href ?>"
               class="btn btn-outline btn-sm"
               <?= cms_field_attrs('art'.$n.'_btn_url', 'url', 'Article '.$n.' — Bouton URL', isset($c['art'.$n.'_btn_url']) ? $c['art'.$n.'_btn_url'] : '') ?>>
              <span <?= cms_field_attrs('art'.$n.'_btn_text', 'text', 'Article '.$n.' — Bouton Texte', isset($c['art'.$n.'_btn_text']) ? $c['art'.$n.'_btn_text'] : '') ?>><?= (isset($c['art'.$n.'_btn_text']) && $c['art'.$n.'_btn_text']) ? htmlspecialchars($c['art'.$n.'_btn_text']) : $a['btn_text_def'] ?></span>
            </a>
          </div>
        </div>
      </article>
      <?php endforeach; ?>

    </div>
  </div>
</section>

<!-- CONTACT EXPERT -->
<section class="section bg-light fade-in" style="background: linear-gradient(rgba(244,246,249,0.94), rgba(244,246,249,0.94)), url('https://images.unsplash.com/photo-1487754180451-c456f719a1fc?w=1920&q=50') center/cover no-repeat;" <?= cms_section_attrs($c, 'expert_contact', 'Contact Expert') ?>>
  <div class="container" style="max-width:760px;text-align:center;">
    <span class="section-label" <?= cms_field_attrs('expert_label', 'text', 'Expert — Label', isset($c['expert_label']) ? $c['expert_label'] : '') ?>><?= (isset($c['expert_label']) && $c['expert_label']) ? htmlspecialchars($c['expert_label']) : "Besoin d'un conseil ?" ?></span>
    <h2 class="section-title" <?= cms_field_attrs('expert_title', 'text', 'Expert — Titre', isset($c['expert_title']) ? $c['expert_title'] : '') ?>><?= (isset($c['expert_title']) && $c['expert_title']) ? htmlspecialchars($c['expert_title']) : 'Posez directement la question à nos techniciens' ?></h2>
    <p style="color:var(--gray);margin-bottom:2.5rem;" <?= cms_field_attrs('expert_text', 'text', 'Expert — Texte', isset($c['expert_text']) ? $c['expert_text'] : '') ?>><?= (isset($c['expert_text']) && $c['expert_text']) ? htmlspecialchars($c['expert_text']) : "Nos équipes sont disponibles pour répondre à vos questions techniques, vous aider à choisir le bon équipement ou planifier une visite." ?></p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
      <a href="<?= (isset($c['expert_wa_url']) && $c['expert_wa_url']) ? htmlspecialchars($c['expert_wa_url']) : 'https://wa.me/237691123112?text=Bonjour%20RSC%20Cameroon%2C%20j%27ai%20une%20question%20technique%20%3A%20' ?>"
         target="_blank" rel="noopener"
         class="btn btn-primary btn-lg"
         <?= cms_field_attrs('expert_wa_url', 'url', 'Expert — WhatsApp URL', isset($c['expert_wa_url']) ? $c['expert_wa_url'] : '') ?>>
        <i class="fa-brands fa-whatsapp" style="margin-right:0.4rem;"></i>
        <span <?= cms_field_attrs('expert_wa_text', 'text', 'Expert — WhatsApp Texte', isset($c['expert_wa_text']) ? $c['expert_wa_text'] : '') ?>><?= (isset($c['expert_wa_text']) && $c['expert_wa_text']) ? htmlspecialchars($c['expert_wa_text']) : 'Écrire sur WhatsApp' ?></span>
      </a>
      <a href="<?= (isset($c['expert_msg_url']) && $c['expert_msg_url']) ? htmlspecialchars($c['expert_msg_url']) : base_url('contact') . '?subject=technique' ?>"
         class="btn btn-outline btn-lg"
         <?= cms_field_attrs('expert_msg_url', 'url', 'Expert — Message URL', isset($c['expert_msg_url']) ? $c['expert_msg_url'] : '') ?>>
        <i class="fa-solid fa-envelope" style="margin-right:0.4rem;"></i>
        <span <?= cms_field_attrs('expert_msg_text', 'text', 'Expert — Message Texte', isset($c['expert_msg_text']) ? $c['expert_msg_text'] : '') ?>><?= (isset($c['expert_msg_text']) && $c['expert_msg_text']) ? htmlspecialchars($c['expert_msg_text']) : 'Envoyer un message' ?></span>
      </a>
    </div>
  </div>
</section>

<!-- CTA FINAL -->
<section class="cta-section fade-in" <?= cms_section_attrs($c, 'expertise_cta', "Appel à l'action final") ?>>
  <div class="container" style="position:relative;z-index:1;">
    <h2 <?= cms_field_attrs('cta_title', 'text', 'CTA — Titre', isset($c['cta_title']) ? $c['cta_title'] : '') ?>><?= (isset($c['cta_title']) && $c['cta_title']) ? htmlspecialchars($c['cta_title']) : 'Prêt à optimiser votre production ?' ?></h2>
    <p <?= cms_field_attrs('cta_text', 'text', 'CTA — Texte', isset($c['cta_text']) ? $c['cta_text'] : '') ?>><?= (isset($c['cta_text']) && $c['cta_text']) ? htmlspecialchars($c['cta_text']) : 'Contactez notre équipe pour une étude de vos besoins et un devis personnalisé.' ?></p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
      <a href="<?= (isset($c['cta_btn1_url']) && $c['cta_btn1_url']) ? htmlspecialchars($c['cta_btn1_url']) : base_url('contact') ?>"
         class="btn btn-accent btn-lg"
         <?= cms_field_attrs('cta_btn1_url', 'url', 'CTA — Bouton 1 URL', isset($c['cta_btn1_url']) ? $c['cta_btn1_url'] : '') ?>>
        <i class="fa-solid fa-paper-plane" style="margin-right:0.4rem;"></i>
        <span <?= cms_field_attrs('cta_btn1_text', 'text', 'CTA — Bouton 1 Texte', isset($c['cta_btn1_text']) ? $c['cta_btn1_text'] : '') ?>><?= (isset($c['cta_btn1_text']) && $c['cta_btn1_text']) ? htmlspecialchars($c['cta_btn1_text']) : 'Demander un devis gratuit' ?></span>
      </a>
      <a href="<?= (isset($c['cta_phone_url']) && $c['cta_phone_url']) ? htmlspecialchars($c['cta_phone_url']) : 'tel:+237691123112' ?>"
         class="btn btn-outline-light btn-lg"
         <?= cms_field_attrs('cta_phone_url', 'url', 'CTA — Téléphone URL', isset($c['cta_phone_url']) ? $c['cta_phone_url'] : '') ?>>
        <i class="fa-solid fa-phone" style="margin-right:0.4rem;"></i>
        <span <?= cms_field_attrs('cta_phone_text', 'text', 'CTA — Téléphone Texte', isset($c['cta_phone_text']) ? $c['cta_phone_text'] : '') ?>><?= (isset($c['cta_phone_text']) && $c['cta_phone_text']) ? htmlspecialchars($c['cta_phone_text']) : '+237 691 123 112' ?></span>
      </a>
    </div>
  </div>
</section>
