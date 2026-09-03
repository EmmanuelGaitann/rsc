<section class="page-hero hero-carousel" <?= cms_section_attrs($c, 'hero', 'Bannière principale') ?>>
  <div class="hc-track">
    <div class="hc-slide active" style="background-image:url('<?= isset($c['slide1']) && $c['slide1'] ? base_url($c['slide1']) : 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=1920&q=60' ?>')" <?= cms_field_attrs('slide1', 'image', 'Image slide 1', isset($c['slide1']) ? $c['slide1'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide2']) && $c['slide2'] ? base_url($c['slide2']) : 'https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=1920&q=60' ?>')" <?= cms_field_attrs('slide2', 'image', 'Image slide 2', isset($c['slide2']) ? $c['slide2'] : '') ?>></div>
    <div class="hc-slide" style="background-image:url('<?= isset($c['slide3']) && $c['slide3'] ? base_url($c['slide3']) : 'https://images.unsplash.com/photo-1570126618953-d437176e8c79?w=1920&q=60' ?>')" <?= cms_field_attrs('slide3', 'image', 'Image slide 3', isset($c['slide3']) ? $c['slide3'] : '') ?>></div>
  </div>
  <div class="hc-overlay"></div>
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= base_url() ?>" data-i18n="nav_home">Accueil</a>
      <span>›</span>
      <span data-i18n="nav_products">Produits</span>
    </div>
    <h1 <?= cms_field_attrs('hero_title', 'text', 'Titre de la bannière', isset($c['hero_title']) ? $c['hero_title'] : '') ?>><?= isset($c['hero_title']) && $c['hero_title'] ? htmlspecialchars($c['hero_title']) : 'Catalogue Produits' ?></h1>
    <p <?= cms_field_attrs('hero_subtitle', 'text', 'Sous-titre de la bannière', isset($c['hero_subtitle']) ? $c['hero_subtitle'] : '') ?>><?= isset($c['hero_subtitle']) && $c['hero_subtitle'] ? htmlspecialchars($c['hero_subtitle']) : 'RENNER Kompressoren &amp; Ingersoll Rand — Catalogue complet' ?></p>
  </div>
  <button class="hc-prev" aria-label="Précédent"><i class="fa-solid fa-chevron-left"></i></button>
  <button class="hc-next" aria-label="Suivant"><i class="fa-solid fa-chevron-right"></i></button>
  <div class="hc-dots">
    <button class="hc-dot active" aria-label="Slide 1"></button>
    <button class="hc-dot" aria-label="Slide 2"></button>
    <button class="hc-dot" aria-label="Slide 3"></button>
  </div>
</section>

<section class="section" style="background: linear-gradient(rgba(255,255,255,0.97), rgba(255,255,255,0.97)), url('https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=1920&q=50') center/cover no-repeat fixed;" <?= cms_section_attrs($c, 'catalogue', 'Catalogue Produits') ?>>
  <div class="container">

    <div style="margin-bottom:1.5rem;">
      <?php $search_ph = (isset($c['search_placeholder']) && $c['search_placeholder']) ? htmlspecialchars($c['search_placeholder']) : 'Rechercher un produit...'; ?>
      <input type="search" id="product-search" class="form-input" style="max-width:400px;" data-i18n="products_search" placeholder="<?= $search_ph ?>"
             <?= cms_field_attrs('search_placeholder', 'text', 'Placeholder de recherche', isset($c['search_placeholder']) ? $c['search_placeholder'] : '') ?>>
    </div>

    <div class="brand-filter-bar" id="brand-filter-bar">
      <button class="brand-btn active" data-brand="all"><i class="fa-solid fa-boxes-stacked" style="margin-right:0.35rem;"></i><span <?= cms_field_attrs('filter_all_text', 'text', 'Bouton "Tous les fournisseurs"', isset($c['filter_all_text']) ? $c['filter_all_text'] : '') ?>><?= (isset($c['filter_all_text']) && $c['filter_all_text']) ? htmlspecialchars($c['filter_all_text']) : 'Tous les fournisseurs' ?></span></button>
      <?php foreach ($brands as $b): ?>
      <button class="brand-btn" data-brand="<?= htmlspecialchars($b->slug) ?>">
        <i class="fa-solid <?= htmlspecialchars($b->icon) ?>" style="margin-right:0.35rem;"></i><?= htmlspecialchars($b->name) ?>
      </button>
      <?php endforeach; ?>
    </div>

    <div class="filter-bar">
      <button class="filter-btn active" data-filter="all"><span <?= cms_field_attrs('filter_all_cat', 'text', 'Bouton catégorie "Tous"', isset($c['filter_all_cat']) ? $c['filter_all_cat'] : '') ?>><?= (isset($c['filter_all_cat']) && $c['filter_all_cat']) ? htmlspecialchars($c['filter_all_cat']) : 'Tous' ?></span></button>
      <?php foreach ($categories as $cat): ?>
      <button class="filter-btn" data-filter="<?= htmlspecialchars($cat->slug) ?>"><?= htmlspecialchars($cat->name) ?></button>
      <?php endforeach; ?>
    </div>

    <div class="grid-auto" id="products-grid">

    <?php
    /* Build lookup maps from DB data */
    $brand_colors = [];
    $brand_badges = [];
    foreach ($brands as $b) {
        $brand_colors[$b->slug] = $b->color;
        $brand_badges[$b->slug] = $b->name;
    }
    $cat_labels = [];
    foreach ($categories as $cat) {
        $cat_labels[$cat->slug] = $cat->name;
    }
    $fallback_img = 'https://images.pexels.com/photos/3862632/pexels-photo-3862632.jpeg?auto=compress&w=600';
    ?>

    <?php if (!empty($products)): ?>
      <?php foreach ($products as $p): ?>
      <?php
        $color    = $brand_colors[$p->brand] ?? 'var(--primary)';
        $badge    = $brand_badges[$p->brand] ?? '';
        $cat_lbl  = $cat_labels[$p->category] ?? htmlspecialchars($p->category);
        $img_src  = ($p->image && strpos($p->image, 'http') === 0)
                      ? htmlspecialchars($p->image)
                      : ($p->image ? base_url(htmlspecialchars($p->image)) : $fallback_img);
        $cta_href = $p->cta_url
                      ? htmlspecialchars($p->cta_url)
                      : base_url('contact') . '?product=' . urlencode($p->name . ($p->model ? ' ' . $p->model : ''));
        $fiche_url = base_url('produit/' . $p->id . '/' . url_title($p->name . ($p->model ? '-' . $p->model : ''), '-', TRUE));
      ?>
      <div class="card product-card" data-cat="<?= htmlspecialchars($p->category) ?>" data-brand="<?= htmlspecialchars($p->brand) ?>">
        <?php if ($badge): ?>
        <span class="prod-brand-badge <?= htmlspecialchars($p->brand) ?>"><?= htmlspecialchars($badge) ?></span>
        <?php endif; ?>
        <a href="<?= $fiche_url ?>" style="display:block;">
          <img src="<?= $img_src ?>"
               alt="<?= htmlspecialchars($p->name . ($p->model ? ' ' . $p->model : '')) ?>"
               class="card-img img-contain" loading="lazy"
               onerror="this.src='<?= $fallback_img ?>';this.classList.remove('img-contain')">
        </a>
        <div class="card-body">
          <span class="card-label" style="color:<?= $color ?>;"><?= htmlspecialchars($cat_lbl) ?></span>
          <h3 class="card-title"><a href="<?= $fiche_url ?>" style="color:inherit;text-decoration:none;"><?= htmlspecialchars($p->name) ?></a></h3>
          <?php if ($p->model): ?>
          <p class="prod-model"><?= htmlspecialchars($p->model) ?></p>
          <?php endif; ?>
          <?php if ($p->description): ?>
          <p class="card-desc"><?= htmlspecialchars($p->description) ?></p>
          <?php endif; ?>
          <div style="display:flex;gap:0.5rem;flex-wrap:wrap;align-items:center;">
            <a href="<?= $cta_href ?>" class="btn btn-primary btn-sm"><?= (isset($c['product_cta_text']) && $c['product_cta_text']) ? htmlspecialchars($c['product_cta_text']) : 'Demander un devis' ?></a>
            <a href="<?= $fiche_url ?>" style="font-size:0.8rem;font-weight:700;color:var(--primary);text-decoration:none;">Voir la fiche &rarr;</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div style="grid-column:1/-1;text-align:center;padding:4rem 2rem;color:var(--gray);">
        <i class="fa-solid fa-box-open" style="font-size:3rem;margin-bottom:1rem;display:block;color:#cbd5e1;"></i>
        <p style="font-size:1.05rem;">Le catalogue est en cours de préparation.</p>
        <p style="font-size:0.9rem;margin-top:0.5rem;">
          <a href="<?= base_url('admin/product_new') ?>" style="color:var(--primary);">Ajouter des produits depuis l'administration</a>
        </p>
      </div>
    <?php endif; ?>

    </div>

    <div id="no-results" class="hidden" style="text-align:center;padding:3rem;color:var(--gray);">
      <div style="font-size:3rem;margin-bottom:1rem;color:var(--gray-light);"><i class="fa-solid fa-magnifying-glass"></i></div>
      <p data-i18n="no_results">Aucun produit trouvé pour cette recherche.</p>
    </div>

  </div>
</section>

<section class="cta-section fade-in" <?= cms_section_attrs($c, 'products_cta', 'Appel à l\'action') ?>>
  <div class="container" style="position:relative;z-index:1;">
    <h2 <?= cms_field_attrs('cta_title', 'text', 'CTA — Titre', isset($c['cta_title']) ? $c['cta_title'] : '') ?>><?= (isset($c['cta_title']) && $c['cta_title']) ? htmlspecialchars($c['cta_title']) : 'Vous ne trouvez pas ce qu\'il vous faut ?' ?></h2>
    <p <?= cms_field_attrs('cta_subtitle', 'html', 'CTA — Texte', isset($c['cta_subtitle']) ? $c['cta_subtitle'] : '') ?>><?= (isset($c['cta_subtitle']) && $c['cta_subtitle']) ? $c['cta_subtitle'] : 'Contactez notre équipe technique — nous intervenons sur toutes marques de compresseurs et pouvons répondre à toutes vos demandes spécifiques : RENNER, Ingersoll Rand et autres fabricants.' ?></p>
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
