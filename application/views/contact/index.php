<section class="page-hero hero-carousel" <?= cms_section_attrs($c, 'hero', 'Bannière principale') ?>>
  <div class="hc-track">
    <div class="hc-slide active" style="background-image:url('<?= isset($c['slide1']) && $c['slide1'] ? base_url($c['slide1']) : 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=1920&q=60' ?>')" <?= cms_field_attrs('slide1', 'image', 'Image slide 1', isset($c['slide1']) ? $c['slide1'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide2']) && $c['slide2'] ? base_url($c['slide2']) : 'https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=1920&q=60' ?>')" <?= cms_field_attrs('slide2', 'image', 'Image slide 2', isset($c['slide2']) ? $c['slide2'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide3']) && $c['slide3'] ? base_url($c['slide3']) : 'https://images.unsplash.com/photo-1570126618953-d437176e8c79?w=1920&q=60' ?>')" <?= cms_field_attrs('slide3', 'image', 'Image slide 3', isset($c['slide3']) ? $c['slide3'] : '') ?>></div>
  </div>
  <div class="hc-overlay"></div>
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= base_url() ?>" data-i18n="nav_home">Accueil</a>
      <span>›</span>
      <span data-i18n="nav_contact">Contact</span>
    </div>
    <h1 <?= cms_field_attrs('hero_title', 'text', 'Titre de la bannière', isset($c['hero_title']) ? $c['hero_title'] : '') ?>><?= isset($c['hero_title']) && $c['hero_title'] ? htmlspecialchars($c['hero_title']) : 'Contactez-Nous' ?></h1>
    <p <?= cms_field_attrs('hero_subtitle', 'text', 'Sous-titre de la bannière', isset($c['hero_subtitle']) ? $c['hero_subtitle'] : '') ?>><?= isset($c['hero_subtitle']) && $c['hero_subtitle'] ? htmlspecialchars($c['hero_subtitle']) : 'Notre équipe est à votre disposition' ?></p>
  </div>
  <button class="hc-prev" aria-label="Précédent"><i class="fa-solid fa-chevron-left"></i></button>
  <button class="hc-next" aria-label="Suivant"><i class="fa-solid fa-chevron-right"></i></button>
  <div class="hc-dots">
    <button class="hc-dot active" aria-label="Slide 1"></button>
    <button class="hc-dot" aria-label="Slide 2"></button>
    <button class="hc-dot" aria-label="Slide 3"></button>
  </div>
</section>

<!-- CONTACT -->
<section class="section" <?= cms_section_attrs($c, 'contact_form', 'Formulaire de contact') ?>>
  <div class="container">
    <div class="grid-2" style="gap:3rem;align-items:start;">

      <!-- FORMULAIRE -->
      <div class="fade-in">
        <h2 style="color:var(--secondary);margin-bottom:0.5rem;"
            <?= cms_field_attrs('form_title', 'text', 'Titre du formulaire', isset($c['form_title']) ? $c['form_title'] : '') ?>
        ><?= isset($c['form_title']) && $c['form_title'] ? htmlspecialchars($c['form_title']) : 'Envoyez-nous un message' ?></h2>
        <p style="color:var(--gray);margin-bottom:2rem;"
           <?= cms_field_attrs('form_subtitle', 'text', 'Sous-titre / accroche', isset($c['form_subtitle']) ? $c['form_subtitle'] : '') ?>
        ><?= isset($c['form_subtitle']) && $c['form_subtitle'] ? htmlspecialchars($c['form_subtitle']) : 'Remplissez le formulaire et nous vous répondrons dans les 12 heures.' ?></p>

        <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
        <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <?= form_open('contact/envoyer', ['id' => 'contact-form', 'novalidate' => 'novalidate']) ?>
          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="name">
                <span <?= cms_field_attrs('label_name', 'text', 'Label — Nom complet', isset($c['label_name']) ? $c['label_name'] : '') ?>><?= isset($c['label_name']) && $c['label_name'] ? htmlspecialchars($c['label_name']) : 'Nom complet' ?></span>
                <span class="required">*</span>
              </label>
              <input type="text" id="name" name="name" class="form-input" required placeholder="Jean Dupont" value="<?= set_value('name') ?>">
            </div>
            <div class="form-group">
              <label class="form-label" for="company">
                <span <?= cms_field_attrs('label_company', 'text', 'Label — Entreprise', isset($c['label_company']) ? $c['label_company'] : '') ?>><?= isset($c['label_company']) && $c['label_company'] ? htmlspecialchars($c['label_company']) : 'Entreprise' ?></span>
              </label>
              <input type="text" id="company" name="company" class="form-input" placeholder="Mon Entreprise SA" value="<?= set_value('company') ?>">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="email">
                <span <?= cms_field_attrs('label_email', 'text', 'Label — Adresse email', isset($c['label_email']) ? $c['label_email'] : '') ?>><?= isset($c['label_email']) && $c['label_email'] ? htmlspecialchars($c['label_email']) : 'Adresse email' ?></span>
                <span class="required">*</span>
              </label>
              <input type="email" id="email" name="email" class="form-input" required placeholder="email@exemple.com" value="<?= set_value('email') ?>">
            </div>
            <div class="form-group">
              <label class="form-label" for="phone">
                <span <?= cms_field_attrs('label_phone', 'text', 'Label — Téléphone', isset($c['label_phone']) ? $c['label_phone'] : '') ?>><?= isset($c['label_phone']) && $c['label_phone'] ? htmlspecialchars($c['label_phone']) : 'Téléphone' ?></span>
                <span class="required">*</span>
              </label>
              <input type="tel" id="phone" name="phone" class="form-input" required placeholder="+237 6XX XXX XXX" value="<?= set_value('phone') ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label" for="whatsapp">
              <span <?= cms_field_attrs('label_whatsapp', 'text', 'Label — WhatsApp', isset($c['label_whatsapp']) ? $c['label_whatsapp'] : '') ?>><?= isset($c['label_whatsapp']) && $c['label_whatsapp'] ? htmlspecialchars($c['label_whatsapp']) : 'Numéro WhatsApp (optionnel)' ?></span>
            </label>
            <input type="tel" id="whatsapp" name="whatsapp" class="form-input" placeholder="+237 6XX XXX XXX" value="<?= set_value('whatsapp') ?>">
          </div>
          <div class="form-group">
            <label class="form-label" for="subject">
              <span <?= cms_field_attrs('label_subject', 'text', 'Label — Sujet', isset($c['label_subject']) ? $c['label_subject'] : '') ?>><?= isset($c['label_subject']) && $c['label_subject'] ? htmlspecialchars($c['label_subject']) : 'Sujet' ?></span>
              <span class="required">*</span>
            </label>
            <?php
            // Sujets éditables via CMS (format: "valeur|Libellé" un par ligne)
            $subjects_raw = (isset($c['form_subjects']) && $c['form_subjects'])
                ? $c['form_subjects']
                : "commercial|Demande commerciale / Devis\ntechnique|Support technique\nmaintenance|Maintenance / Contrat\npieces|Pièces détachées\nautre|Autre";
            $subjects_lines = array_filter(array_map('trim', explode("\n", $subjects_raw)));
            ?>
            <select id="subject" name="subject" class="form-select" required>
              <option value="">-- Sélectionner --</option>
              <?php foreach ($subjects_lines as $line):
                $parts = explode('|', $line, 2);
                $val   = trim($parts[0]);
                $lbl   = isset($parts[1]) ? trim($parts[1]) : $val;
                if ($val === '') continue;
              ?>
              <option value="<?= htmlspecialchars($val) ?>" <?= set_select('subject', $val) ?>><?= htmlspecialchars($lbl) ?></option>
              <?php endforeach; ?>
            </select>
            <?php if ($cms_is_admin ?? false): ?>
            <small style="color:var(--gray);font-size:0.75rem;margin-top:0.3rem;display:block;">
              <i class="fa-solid fa-circle-info"></i> Admin : éditez les sujets dans <a href="<?= base_url('admin/page/contact') ?>" style="color:var(--primary);">Panneau complet → Contact → Sujets du formulaire</a>
            </small>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label class="form-label" for="message">
              <span <?= cms_field_attrs('label_message', 'text', 'Label — Votre message', isset($c['label_message']) ? $c['label_message'] : '') ?>><?= isset($c['label_message']) && $c['label_message'] ? htmlspecialchars($c['label_message']) : 'Votre message' ?></span>
              <span class="required">*</span>
            </label>
            <textarea id="message" name="message" class="form-textarea" required placeholder="Décrivez votre besoin en détail..."><?= set_value('message') ?></textarea>
          </div>
          <p style="font-size:0.8rem;color:var(--gray);margin-bottom:1.25rem;">* Champs obligatoires</p>

          <!-- Anti-spam : pot de miel (invisible pour les humains) + horodatage signé -->
          <div style="position:absolute;left:-9999px;top:-9999px;" aria-hidden="true">
            <label for="website">Ne pas remplir ce champ</label>
            <input type="text" id="website" name="website" tabindex="-1" autocomplete="off" value="">
          </div>
          <input type="hidden" name="fts"  value="<?= htmlspecialchars($antispam_ts ?? '') ?>">
          <input type="hidden" name="fsig" value="<?= htmlspecialchars($antispam_sig ?? '') ?>">

          <button type="submit" class="btn btn-primary btn-lg" style="width:100%;justify-content:center;">
            <?= isset($c['form_btn_text']) && $c['form_btn_text'] ? htmlspecialchars($c['form_btn_text']) : 'Envoyer' ?>
          </button>
        <?= form_close() ?>
      </div>

      <!-- INFOS CONTACT -->
      <div class="fade-in">
        <div class="contact-info-card">
          <h3 style="color:white;margin-bottom:2rem;"
              <?= cms_field_attrs('card_title', 'text', 'Titre de la carte contact', isset($c['card_title']) ? $c['card_title'] : '') ?>
          ><?= isset($c['card_title']) && $c['card_title'] ? htmlspecialchars($c['card_title']) : 'Informations de contact' ?></h3>

          <!-- Adresse -->
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
            </div>
            <div>
              <div class="contact-info-label">Adresse</div>
              <div class="contact-info-value" <?= cms_field_attrs('address', 'text', 'Adresse', isset($c['address']) ? $c['address'] : '') ?>><?= isset($c['address']) && $c['address'] ? nl2br(htmlspecialchars($c['address'])) : '739 rue Richard Bell, Nouvelle route Bonadibong - Akwa<br><span style="font-size:0.85rem;color:rgba(255,255,255,0.45);">À 200 m du Carrefour Kayo Élie — Douala, Cameroun</span>' ?></div>
            </div>
          </div>

          <!-- Téléphone -->
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
            </div>
            <div>
              <div class="contact-info-label">Téléphone</div>
              <?php $phone_val = isset($c['phone']) && $c['phone'] ? $c['phone'] : '+237 691 123 112'; ?>
              <div <?= cms_field_attrs('phone', 'text', 'Téléphone', isset($c['phone']) ? $c['phone'] : '') ?>>
                <a href="tel:<?= preg_replace('/\s+/', '', $phone_val) ?>" class="contact-info-value"><?= htmlspecialchars($phone_val) ?></a>
              </div>
            </div>
          </div>

          <!-- Email -->
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
            </div>
            <div>
              <div class="contact-info-label">Email</div>
              <?php $email_val = isset($c['email']) && $c['email'] ? $c['email'] : 'info@rsc-cameroon.com'; ?>
              <div <?= cms_field_attrs('email', 'text', 'Email affiché', isset($c['email']) ? $c['email'] : '') ?>>
                <a href="mailto:<?= htmlspecialchars($email_val) ?>" class="contact-info-value"><?= htmlspecialchars($email_val) ?></a>
              </div>
            </div>
          </div>

          <!-- WhatsApp -->
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884z"/></svg>
            </div>
            <div>
              <div class="contact-info-label">WhatsApp Business</div>
              <?php
                $wa_num  = isset($c['whatsapp']) && $c['whatsapp'] ? preg_replace('/\D/', '', $c['whatsapp']) : '237691123112';
                $wa_text = isset($c['whatsapp_text']) && $c['whatsapp_text'] ? $c['whatsapp_text'] : 'Démarrer une conversation';
              ?>
              <a href="https://wa.me/<?= $wa_num ?>" target="_blank" rel="noopener"
                 class="contact-info-value" style="color:#25d366;"
                 <?= cms_field_attrs('whatsapp_text', 'text', 'Texte lien WhatsApp', isset($c['whatsapp_text']) ? $c['whatsapp_text'] : '') ?>
              ><?= htmlspecialchars($wa_text) ?></a>
            </div>
          </div>

          <!-- Horaires -->
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/></svg>
            </div>
            <div>
              <div class="contact-info-label">Horaires</div>
              <div class="contact-info-value" <?= cms_field_attrs('hours', 'text', 'Horaires', isset($c['hours']) ? $c['hours'] : '') ?>><?= isset($c['hours']) && $c['hours'] ? htmlspecialchars($c['hours']) : 'Lun – Sam : 8h00 – 18h00' ?></div>
              <div style="font-size:0.8rem;color:rgba(255,255,255,0.35);margin-top:0.25rem;"
                   <?= cms_field_attrs('hours_extra', 'text', 'Ligne horaires secondaire', isset($c['hours_extra']) ? $c['hours_extra'] : '') ?>
              ><?= isset($c['hours_extra']) && $c['hours_extra'] ? htmlspecialchars($c['hours_extra']) : 'Urgences 24h/24 — 7j/7' ?></div>
            </div>
          </div>

          <!-- Réseaux sociaux -->
          <div style="margin-top:2rem;padding-top:1.5rem;border-top:1px solid rgba(255,255,255,0.1);">
            <p style="color:#64748b;font-size:0.85rem;margin-bottom:1rem;"
               <?= cms_field_attrs('social_title', 'text', 'Texte réseaux sociaux', isset($c['social_title']) ? $c['social_title'] : '') ?>
            ><?= isset($c['social_title']) && $c['social_title'] ? htmlspecialchars($c['social_title']) : 'Retrouvez-nous sur Facebook' ?></p>
            <?php $fb_url = isset($c['facebook_url']) && $c['facebook_url'] ? $c['facebook_url'] : 'https://www.facebook.com/profile.php?id=100093512901441'; ?>
            <a href="<?= htmlspecialchars($fb_url) ?>" target="_blank" rel="noopener"
               class="social-link" title="Facebook Royal Sales Cameroon"
               <?= cms_field_attrs('facebook_url', 'url', 'Lien Facebook', isset($c['facebook_url']) ? $c['facebook_url'] : '') ?>>
              <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
          </div>
        </div>

        <!-- Carte localisation -->
        <div style="margin-top:1.5rem;background:var(--light);border-radius:12px;padding:1.5rem;border:1px solid var(--border);text-align:center;">
          <div style="width:56px;height:56px;border-radius:12px;background:var(--primary-light);display:flex;align-items:center;justify-content:center;margin:0 auto 0.75rem;">
            <svg viewBox="0 0 24 24" fill="var(--primary)" width="28" height="28"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
          </div>
          <p style="color:var(--gray);font-size:0.9rem;font-weight:600;"
             <?= cms_field_attrs('maps_address', 'text', 'Adresse affichée sous la carte', isset($c['maps_address']) ? $c['maps_address'] : '') ?>
          ><?= isset($c['maps_address']) && $c['maps_address'] ? htmlspecialchars($c['maps_address']) : '739 rue Richard Bell, Akwa — Douala' ?></p>
          <?php $maps_url  = isset($c['maps_url'])      && $c['maps_url']      ? $c['maps_url']      : 'https://maps.google.com/?q=739+rue+Richard+Bell+Akwa+Douala+Cameroun'; ?>
          <?php $maps_btn  = isset($c['maps_btn_text']) && $c['maps_btn_text'] ? $c['maps_btn_text'] : 'Voir sur Google Maps'; ?>
          <a href="<?= htmlspecialchars($maps_url) ?>" target="_blank" rel="noopener"
             class="btn btn-outline btn-sm" style="margin-top:0.75rem;"
             <?= cms_field_attrs('maps_btn_text', 'text', 'Texte bouton Google Maps', isset($c['maps_btn_text']) ? $c['maps_btn_text'] : '') ?>
          ><?= htmlspecialchars($maps_btn) ?></a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section bg-light" <?= cms_section_attrs($c, 'faq', 'FAQ') ?>>
  <div class="container">
    <div class="section-header fade-in">
      <span class="section-label"
            <?= cms_field_attrs('faq_label', 'text', 'Label section FAQ', isset($c['faq_label']) ? $c['faq_label'] : '') ?>
      ><?= isset($c['faq_label']) && $c['faq_label'] ? htmlspecialchars($c['faq_label']) : 'FAQ' ?></span>
      <h2 class="section-title"
          <?= cms_field_attrs('faq_title', 'text', 'Titre section FAQ', isset($c['faq_title']) ? $c['faq_title'] : '') ?>
      ><?= isset($c['faq_title']) && $c['faq_title'] ? htmlspecialchars($c['faq_title']) : 'Questions fréquentes' ?></h2>
    </div>

    <?php
    $faqs = [
      1 => [
        'q' => 'Quels types de compresseurs proposez-vous ?',
        'a' => 'Nous proposons une gamme complète de compresseurs industriels — RENNER Kompressoren et Ingersoll Rand : à vis, sans huile, à piston et centrifuges. Puissances de 1,5 kW à 355 kW.',
      ],
      2 => [
        'q' => 'Quelle est la garantie sur les produits ?',
        'a' => 'Les produits RENNER et Ingersoll Rand distribués par Royal Sales Cameroon bénéficient de la garantie fabricant. RSC intervient également en maintenance sur toutes marques de compresseurs.',
      ],
      3 => [
        'q' => 'Intervenez-vous en urgence ?',
        'a' => 'Oui. Nos équipes interviennent sous 12h pour les pannes urgentes, à prix fixe défini à l\'avance, dans toute la région de Douala.',
      ],
      4 => [
        'q' => 'Couvrez-vous d\'autres pays ?',
        'a' => 'Nous intervenons principalement au Cameroun, mais aussi dans la sous-région CEMAC (Gabon, Congo, RCA, etc.) sur demande.',
      ],
    ];
    ?>

    <div class="grid-2 fade-in" style="gap:1.5rem;">
      <?php foreach ($faqs as $n => $faq): ?>
      <div style="background:white;border-radius:12px;padding:1.5rem;border:1px solid var(--border);">
        <h4 style="color:var(--secondary);margin-bottom:0.5rem;"
            <?= cms_field_attrs('faq'.$n.'_q', 'text', 'FAQ '.$n.' — Question', isset($c['faq'.$n.'_q']) ? $c['faq'.$n.'_q'] : '') ?>
        ><?= isset($c['faq'.$n.'_q']) && $c['faq'.$n.'_q'] ? htmlspecialchars($c['faq'.$n.'_q']) : htmlspecialchars($faq['q']) ?></h4>
        <p style="color:var(--gray);font-size:0.9rem;"
           <?= cms_field_attrs('faq'.$n.'_a', 'text', 'FAQ '.$n.' — Réponse', isset($c['faq'.$n.'_a']) ? $c['faq'.$n.'_a'] : '') ?>
        ><?= isset($c['faq'.$n.'_a']) && $c['faq'.$n.'_a'] ? htmlspecialchars($c['faq'.$n.'_a']) : htmlspecialchars($faq['a']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script>
window.addEventListener('DOMContentLoaded', function() {
  var params = new URLSearchParams(window.location.search);
  var subj = params.get('subject');
  var prod = params.get('product');
  if (subj) {
    var sel = document.getElementById('subject');
    if (sel && sel.querySelector('option[value="' + subj + '"]')) sel.value = subj;
  }
  if (prod) {
    var msg = document.getElementById('message');
    if (msg) msg.value = 'Bonjour, je souhaite obtenir des informations sur le produit : ' + prod.replace(/-/g, ' ') + '\n\nMerci de me contacter.';
  }
});
</script>
