<?php
// MENTIONS LÉGALES & POLITIQUE DE CONFIDENTIALITÉ
// Les informations d'identité (raison sociale, adresse, contacts…) et les
// blocs Hébergement / Propriété intellectuelle / Politique de confidentialité
// sont éditables depuis Admin → Mentions Légales (les textes ci-dessous
// servent de valeurs par défaut).
if (!function_exists('_lv')) {
    function _lv($c, $k, $d) { return (isset($c[$k]) && trim((string)$c[$k]) !== '') ? htmlspecialchars($c[$k]) : $d; }
}
?>
<section class="page-hero" style="min-height:320px;display:flex;align-items:center;background:linear-gradient(135deg,#001a2c 0%,#002d4a 60%,#003d5c 100%);position:relative;overflow:hidden;">
  <div style="position:absolute;inset:0;background:url('<?= base_url('assets/logo/Logo_gold_RSC.png') ?>') center/auto 60% no-repeat;opacity:0.04;"></div>
  <div class="container" style="position:relative;z-index:1;">
    <div class="breadcrumb">
      <a href="<?= base_url() ?>" style="color:rgba(255,255,255,0.6);">Accueil</a>
      <span style="color:rgba(255,255,255,0.4);">›</span>
      <span style="color:white;">Mentions légales</span>
    </div>
    <h1 style="font-family:'Montserrat',sans-serif;font-size:clamp(1.8rem,4vw,2.8rem);font-weight:900;color:white;margin-top:1rem;line-height:1.1;">Mentions Légales<br><span style="color:var(--primary,#1d67cd);font-size:0.6em;font-weight:600;">& Politique de Confidentialité</span></h1>
    <p style="color:rgba(255,255,255,0.6);margin-top:0.75rem;font-size:0.95rem;">Dernière mise à jour : <?= date('d/m/Y') ?></p>
  </div>
</section>

<section class="section">
  <div class="container" style="max-width:860px;">
    <div style="display:flex;flex-direction:column;gap:3rem;">

      <!-- 1. ÉDITEUR DU SITE -->
      <div class="fade-in">
        <h2 style="color:var(--secondary,#0f2340);margin-bottom:1.5rem;padding-bottom:0.75rem;border-bottom:2px solid var(--border,#e2e8f0);">1. Éditeur du site</h2>
        <div style="background:var(--light,#f8fafc);border-radius:10px;padding:1.5rem;margin-bottom:1.5rem;">
          <?php $_lg_email = (isset($c['company_email']) && trim((string)$c['company_email']) !== '') ? trim($c['company_email']) : 'info@rsc-cameroon.com'; ?>
          <?php $_lg_phone = (isset($c['company_phone']) && trim((string)$c['company_phone']) !== '') ? trim($c['company_phone']) : '+237 691 123 112'; ?>
          <p style="line-height:2;color:var(--text,#1e293b);">
            <strong>Raison sociale :</strong> <span <?= cms_field_attrs('company_name', 'text', 'Raison sociale', isset($c['company_name']) ? $c['company_name'] : '') ?>><?= _lv($c, 'company_name', 'Royal Sales Cameroon SARL (RSC)') ?></span><br>
            <strong>Activité :</strong> <span <?= cms_field_attrs('company_activity', 'text', 'Activité', isset($c['company_activity']) ? $c['company_activity'] : '') ?>><?= _lv($c, 'company_activity', 'Distribution, installation et maintenance de compresseurs industriels') ?></span><br>
            <strong>Siège social :</strong> <span <?= cms_field_attrs('company_address', 'text', 'Siège social', isset($c['company_address']) ? $c['company_address'] : '') ?>><?= _lv($c, 'company_address', '739 rue Richard Bell, Nouvelle route Bonadibong - Akwa, Douala, Cameroun') ?></span><br>
            <strong>Email :</strong> <a href="mailto:<?= htmlspecialchars($_lg_email) ?>" style="color:var(--primary,#1d67cd);" <?= cms_field_attrs('company_email', 'text', 'Email', isset($c['company_email']) ? $c['company_email'] : '') ?>><?= htmlspecialchars($_lg_email) ?></a><br>
            <strong>Téléphone :</strong> <a href="tel:<?= preg_replace('/\s+/', '', $_lg_phone) ?>" style="color:var(--primary,#1d67cd);" <?= cms_field_attrs('company_phone', 'text', 'Téléphone', isset($c['company_phone']) ? $c['company_phone'] : '') ?>><?= htmlspecialchars($_lg_phone) ?></a><br>
            <strong>Partenaires :</strong> <span <?= cms_field_attrs('company_partner', 'text', 'Partenaire', isset($c['company_partner']) ? $c['company_partner'] : '') ?>><?= _lv($c, 'company_partner', 'Distributeur Exclusif RENNER Kompressoren GmbH (Allemagne) · Ingersoll Rand (USA)') ?></span>
          </p>
        </div>

        <h3 style="color:var(--secondary,#0f2340);margin-bottom:0.75rem;font-size:1.05rem;">Prestataire technique &amp; hébergement</h3>
        <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:1.5rem;margin-bottom:1.5rem;">
          <p style="line-height:1.9;color:var(--text,#1e293b);">
            <strong>Prestataire :</strong> Emmanuel Gaitan Kouedi — Développeur &amp; Intégrateur Web indépendant<br>
            <strong>Email :</strong> <a href="mailto:kouedigaitanemmanuel@gmail.com" style="color:var(--primary,#1d67cd);">kouedigaitanemmanuel@gmail.com</a><br>
            <strong>Rôle :</strong> Conception, développement et mise en ligne du site web de Royal Sales Cameroon SARL<br>
          </p>
          <div style="margin-top:1rem;padding:0.85rem 1rem;background:rgba(255,165,0,0.08);border-left:3px solid #f59e0b;border-radius:4px;">
            <p style="font-size:0.88rem;color:#92400e;line-height:1.7;margin:0;">
              <strong>Clause de responsabilité du prestataire :</strong><br>
              Emmanuel Gaitan Kouedi intervient exclusivement en qualité de prestataire technique. Il ne détient aucun droit sur le nom de domaine, la marque, le contenu, ni les données commerciales de Royal Sales Cameroon SARL. Le prestataire garantit le bon fonctionnement et l'hébergement du site web tant que Royal Sales Cameroon SARL s'acquitte des frais d'hébergement et de maintenance convenus. En cas de cessation de la relation contractuelle ou de non-paiement, le prestataire se réserve le droit de suspendre les services d'hébergement après mise en demeure de 15 jours. Royal Sales Cameroon SARL demeure seul propriétaire et responsable de l'intégralité du contenu publié sur le site, du nom de domaine et de toute communication diffusée via ce support.
            </p>
          </div>
        </div>

        <h3 style="color:var(--secondary,#0f2340);margin-bottom:0.75rem;font-size:1.05rem;">Hébergement</h3>
        <div style="color:var(--gray,#64748b);line-height:1.8;margin-bottom:1.5rem;" <?= cms_field_attrs('hosting_text', 'html', 'Hébergement', isset($c['hosting_text']) ? $c['hosting_text'] : '') ?>>
          <?= (isset($c['hosting_text']) && trim((string)$c['hosting_text']) !== '') ? $c['hosting_text'] : "Ce site est hébergé sur un serveur mutualisé avec protection SSL/HTTPS. L'hébergement est assuré dans le cadre du contrat de prestation conclu entre Royal Sales Cameroon SARL et son prestataire technique. Les données sont sauvegardées régulièrement. La continuité de l'hébergement est conditionnée au règlement des frais y afférents selon les termes du contrat de prestation." ?>
        </div>

        <h3 style="color:var(--secondary,#0f2340);margin-bottom:0.75rem;font-size:1.05rem;">Propriété intellectuelle</h3>
        <div style="color:var(--gray,#64748b);line-height:1.8;" <?= cms_field_attrs('ip_text', 'html', 'Propriété intellectuelle', isset($c['ip_text']) ? $c['ip_text'] : '') ?>>
          <?= (isset($c['ip_text']) && trim((string)$c['ip_text']) !== '') ? $c['ip_text'] : "L'ensemble des éléments composant ce site (textes, images, logos, graphismes, vidéos, structure) est la propriété exclusive de <strong>Royal Sales Cameroon SARL</strong> ou de ses partenaires (RENNER Kompressoren GmbH, Ingersoll Rand). Toute reproduction, représentation, modification, transmission ou exploitation sans autorisation écrite préalable de Royal Sales Cameroon SARL est strictement interdite et constitue une contrefaçon sanctionnée par la loi. Le prestataire technique concède à Royal Sales Cameroon SARL une licence complète, définitive et exclusive sur le code source du site développé dans le cadre de la prestation." ?>
        </div>
      </div>

      <!-- 2. NOM DE DOMAINE -->
      <div class="fade-in">
        <h2 style="color:var(--secondary,#0f2340);margin-bottom:1.5rem;padding-bottom:0.75rem;border-bottom:2px solid var(--border,#e2e8f0);">2. Nom de domaine &amp; identité numérique</h2>
        <div style="background:var(--light,#f8fafc);border-radius:10px;padding:1.5rem;">
          <p style="line-height:1.9;color:var(--text,#1e293b);">
            Le nom de domaine associé à ce site est la propriété exclusive de <strong>Royal Sales Cameroon SARL</strong>, qui en assure l'enregistrement, le renouvellement et la gestion. Le prestataire technique (Emmanuel Gaitan Kouedi) n'exerce aucun droit de propriété, de contrôle ou d'usage sur ce domaine en dehors des opérations techniques strictement nécessaires à la mise en ligne et à la maintenance du site, et uniquement pendant la durée du contrat de prestation. À l'expiration ou à la résiliation du contrat, le prestataire s'engage à restituer l'accès complet aux ressources techniques (hébergement, DNS, fichiers sources) dans un délai de 30 jours.
          </p>
        </div>
      </div>

      <!-- 3. LIENS HYPERTEXTES -->
      <div class="fade-in">
        <h2 style="color:var(--secondary,#0f2340);margin-bottom:1.5rem;padding-bottom:0.75rem;border-bottom:2px solid var(--border,#e2e8f0);">3. Liens hypertextes &amp; sites tiers</h2>
        <p style="color:var(--gray,#64748b);line-height:1.8;">
          Le site de Royal Sales Cameroon peut contenir des liens vers des sites partenaires ou fabricants (RENNER Kompressoren, Ingersoll Rand, etc.). Ces liens sont fournis à titre informatif. Royal Sales Cameroon SARL n'est pas responsable du contenu, de la disponibilité ou des pratiques de confidentialité de ces sites tiers. La consultation de ces sites externes se fait sous la seule responsabilité de l'utilisateur.
        </p>
      </div>

      <!-- 4. POLITIQUE DE CONFIDENTIALITÉ -->
      <div class="fade-in" id="privacy">
        <h2 style="color:var(--secondary,#0f2340);margin-bottom:1.5rem;padding-bottom:0.75rem;border-bottom:2px solid var(--border,#e2e8f0);">4. Politique de Confidentialité</h2>

        <?php if (isset($c['privacy_text']) && trim((string)$c['privacy_text']) !== ''): ?>
        <!-- Texte personnalisé saisi dans l'admin (remplace le contenu standard) -->
        <div style="color:var(--gray,#64748b);line-height:1.8;" <?= cms_field_attrs('privacy_text', 'html', 'Texte complet de la politique', $c['privacy_text']) ?>>
          <?= $c['privacy_text'] ?>
        </div>
        <?php else: ?>

        <h3 style="color:var(--secondary,#0f2340);margin-bottom:0.75rem;font-size:1.05rem;">Responsable du traitement</h3>
        <p style="color:var(--gray,#64748b);line-height:1.8;margin-bottom:1.5rem;">
          Royal Sales Cameroon SARL, sise à Douala (Cameroun), est responsable du traitement des données personnelles collectées via ce site. Le prestataire technique n'accède aux données personnelles des utilisateurs qu'à des fins strictement techniques de maintenance, et s'engage à ne pas les divulguer à des tiers.
        </p>

        <h3 style="color:var(--secondary,#0f2340);margin-bottom:0.75rem;font-size:1.05rem;">Données collectées</h3>
        <p style="color:var(--gray,#64748b);line-height:1.8;margin-bottom:1rem;">
          Royal Sales Cameroon collecte les données personnelles suivantes uniquement lorsque vous remplissez notre formulaire de contact :
        </p>
        <ul style="color:var(--gray,#64748b);line-height:2;margin-left:1.5rem;margin-bottom:1.5rem;">
          <li>Nom et prénom</li>
          <li>Nom de l'entreprise (optionnel)</li>
          <li>Adresse email</li>
          <li>Numéro de téléphone</li>
          <li>Numéro WhatsApp (optionnel)</li>
          <li>Contenu du message</li>
        </ul>
        <p style="color:var(--gray,#64748b);line-height:1.8;margin-bottom:1.5rem;">
          Ces données sont transmises par email à Royal Sales Cameroon SARL et enregistrées dans un
          registre interne sécurisé, accessible uniquement à l'administration du site, afin d'assurer
          le suivi de votre demande. Elles ne sont jamais rendues publiques ni cédées à des tiers.
        </p>

        <h3 style="color:var(--secondary,#0f2340);margin-bottom:0.75rem;font-size:1.05rem;">Finalité du traitement</h3>
        <p style="color:var(--gray,#64748b);line-height:1.8;margin-bottom:1.5rem;">
          Les données collectées sont utilisées exclusivement pour répondre à vos demandes commerciales, techniques ou de maintenance. Royal Sales Cameroon SARL ne vend, ne loue et ne communique jamais vos données personnelles à des tiers, à l'exception de ses prestataires techniques strictement nécessaires au fonctionnement du site.
        </p>

        <h3 style="color:var(--secondary,#0f2340);margin-bottom:0.75rem;font-size:1.05rem;">Durée de conservation</h3>
        <p style="color:var(--gray,#64748b);line-height:1.8;margin-bottom:1.5rem;">
          Vos données sont conservées pour la durée nécessaire au traitement de votre demande, et au maximum 3 ans à des fins de suivi commercial, conformément aux bonnes pratiques applicables.
        </p>

        <h3 style="color:var(--secondary,#0f2340);margin-bottom:0.75rem;font-size:1.05rem;">Vos droits</h3>
        <p style="color:var(--gray,#64748b);line-height:1.8;margin-bottom:1rem;">
          Vous disposez des droits suivants concernant vos données personnelles :
        </p>
        <ul style="color:var(--gray,#64748b);line-height:2;margin-left:1.5rem;margin-bottom:1rem;">
          <li><strong>Droit d'accès :</strong> obtenir une copie de vos données</li>
          <li><strong>Droit de rectification :</strong> corriger des données inexactes</li>
          <li><strong>Droit de suppression :</strong> demander l'effacement de vos données</li>
          <li><strong>Droit d'opposition :</strong> vous opposer à un traitement</li>
          <li><strong>Droit à la portabilité :</strong> recevoir vos données dans un format structuré</li>
        </ul>
        <p style="color:var(--gray,#64748b);line-height:1.8;margin-bottom:1.5rem;">
          Pour exercer ces droits, contactez Royal Sales Cameroon SARL à : <a href="mailto:info@rsc-cameroon.com" style="color:var(--primary,#1d67cd);">info@rsc-cameroon.com</a>
        </p>

        <h3 style="color:var(--secondary,#0f2340);margin-bottom:0.75rem;font-size:1.05rem;">Cookies</h3>
        <p style="color:var(--gray,#64748b);line-height:1.8;margin-bottom:1.5rem;">
          Ce site utilise uniquement des cookies techniques nécessaires à son bon fonctionnement :
          gestion de session et mémorisation de la langue choisie (FR/EN). Ces cookies sont exemptés
          de consentement. Aucun cookie publicitaire, de mesure d'audience tierce ou de profilage
          n'est déposé. Les statistiques de visite sont mesurées de manière totalement anonyme,
          sans cookie et sans collecte de données personnelles.
        </p>

        <h3 style="color:var(--secondary,#0f2340);margin-bottom:0.75rem;font-size:1.05rem;">Sécurité</h3>
        <p style="color:var(--gray,#64748b);line-height:1.8;">
          Royal Sales Cameroon SARL et son prestataire technique mettent en œuvre des mesures de sécurité adaptées (chiffrement SSL, accès restreint à l'administration, sauvegardes régulières) pour protéger vos données contre tout accès non autorisé, modification, divulgation ou destruction.
        </p>
        <?php endif; ?>
      </div>

      <!-- 5. LIMITATION DE RESPONSABILITÉ -->
      <div class="fade-in">
        <h2 style="color:var(--secondary,#0f2340);margin-bottom:1.5rem;padding-bottom:0.75rem;border-bottom:2px solid var(--border,#e2e8f0);">5. Limitation de responsabilité</h2>
        <p style="color:var(--gray,#64748b);line-height:1.8;">
          Royal Sales Cameroon SARL s'efforce de maintenir les informations publiées sur ce site à jour et exactes. Toutefois, la société ne peut garantir l'exactitude, la complétude ou l'actualité des informations diffusées. Royal Sales Cameroon SARL ne saurait être tenue responsable des dommages directs ou indirects résultant de l'utilisation du site ou de l'impossibilité d'y accéder. Le prestataire technique (Emmanuel Gaitan Kouedi) ne saurait être tenu responsable des contenus publiés par Royal Sales Cameroon SARL, ni des conséquences de leur utilisation par des tiers.
        </p>
      </div>

      <!-- 6. DROIT APPLICABLE -->
      <div class="fade-in">
        <h2 style="color:var(--secondary,#0f2340);margin-bottom:1.5rem;padding-bottom:0.75rem;border-bottom:2px solid var(--border,#e2e8f0);">6. Droit applicable &amp; juridiction compétente</h2>
        <p style="color:var(--gray,#64748b);line-height:1.8;">
          Les présentes mentions légales sont soumises au droit camerounais. Tout litige relatif à l'utilisation du site ou à l'interprétation des présentes mentions légales sera soumis aux tribunaux compétents de Douala (Cameroun), sauf disposition légale contraire.
        </p>
      </div>

      <!-- CONTACT -->
      <div class="fade-in" style="background:var(--primary-light,#eff6ff);border-radius:12px;padding:2rem;border:1px solid rgba(29,103,205,0.15);">
        <h3 style="color:var(--secondary,#0f2340);margin-bottom:1rem;">Une question sur vos données ?</h3>
        <p style="color:var(--gray,#64748b);margin-bottom:1.25rem;line-height:1.7;">
          Pour toute question relative à la présente politique de confidentialité ou à vos données personnelles, contactez directement Royal Sales Cameroon SARL :
        </p>
        <div style="display:flex;gap:1rem;flex-wrap:wrap;">
          <a href="mailto:info@rsc-cameroon.com" class="btn btn-primary"><i class="fa-solid fa-envelope" style="margin-right:0.4rem;"></i>info@rsc-cameroon.com</a>
          <a href="<?= base_url('contact') ?>" class="btn btn-outline"><i class="fa-solid fa-paper-plane" style="margin-right:0.4rem;"></i>Formulaire de contact</a>
        </div>
      </div>

    </div>
  </div>
</section>
