<?php
$fallback_img = 'https://images.pexels.com/photos/3862632/pexels-photo-3862632.jpeg?auto=compress&w=900';
$img_src = ($p->image && strpos($p->image, 'http') === 0)
    ? htmlspecialchars($p->image)
    : ($p->image ? base_url(htmlspecialchars($p->image)) : $fallback_img);
$full_name  = $p->name . ($p->model ? ' ' . $p->model : '');
$brand_name = $brand ? $brand->name : ucfirst($p->brand);
$brand_col  = $brand && $brand->color ? $brand->color : 'var(--primary)';
$cat_name   = $category ? $category->name : ucfirst($p->category);
$quote_url  = base_url('contact') . '?subject=commercial&product=' . urlencode($full_name);
?>

<!-- FIL D'ARIANE -->
<section style="padding:6.5rem 0 0;">
  <div class="container" style="font-size:0.82rem;color:var(--gray);">
    <a href="<?= base_url() ?>" style="color:var(--gray);">Accueil</a>
    <span style="margin:0 0.4rem;">/</span>
    <a href="<?= base_url('produits') ?>" style="color:var(--gray);">Produits</a>
    <span style="margin:0 0.4rem;">/</span>
    <span style="color:var(--dark);font-weight:600;"><?= htmlspecialchars($full_name) ?></span>
  </div>
</section>

<!-- FICHE PRODUIT -->
<section class="section" style="padding-top:2rem;">
  <div class="container">
    <div class="grid-2 fade-in visible" style="gap:3rem;align-items:start;">

      <!-- Image -->
      <div style="background:#f4f6fa;border-radius:16px;padding:2rem;text-align:center;border:1px solid var(--border);">
        <img src="<?= $img_src ?>" alt="<?= htmlspecialchars($full_name) ?> — Royal Sales Cameroon"
             style="max-width:100%;max-height:420px;object-fit:contain;border-radius:8px;"
             onerror="this.src='<?= $fallback_img ?>'">
      </div>

      <!-- Informations -->
      <div>
        <div style="display:flex;gap:0.5rem;flex-wrap:wrap;margin-bottom:1rem;">
          <span style="background:<?= htmlspecialchars($brand_col) ?>;color:white;padding:0.25rem 0.9rem;border-radius:50px;font-size:0.7rem;font-weight:800;text-transform:uppercase;letter-spacing:0.08em;font-family:'Montserrat',sans-serif;">
            <?= htmlspecialchars($brand_name) ?>
          </span>
          <span style="background:var(--light);color:var(--gray);padding:0.25rem 0.9rem;border-radius:50px;font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;font-family:'Montserrat',sans-serif;border:1px solid var(--border);">
            <?= htmlspecialchars($cat_name) ?>
          </span>
        </div>

        <h1 style="font-family:'Montserrat',sans-serif;font-size:clamp(1.6rem,3.5vw,2.4rem);color:var(--dark);line-height:1.2;margin-bottom:0.4rem;">
          <?= htmlspecialchars($p->name) ?>
        </h1>
        <?php if ($p->model): ?>
        <p style="font-size:1.05rem;color:var(--gray);font-weight:600;margin-bottom:1.4rem;"><?= htmlspecialchars($p->model) ?></p>
        <?php endif; ?>

        <?php if ($p->description): ?>
        <div style="color:var(--gray);line-height:1.75;text-align:justify;margin-bottom:1.8rem;">
          <?= nl2br(htmlspecialchars($p->description)) ?>
        </div>
        <?php endif; ?>

        <!-- Points forts standard -->
        <ul class="feature-list" style="list-style:none;padding:0;margin:0 0 2rem;display:grid;gap:0.6rem;">
          <li style="display:flex;align-items:center;gap:0.6rem;color:var(--dark);font-size:0.92rem;">
            <span class="feature-check" style="flex:none;width:20px;height:20px;border-radius:50%;background:var(--primary);color:white;display:inline-flex;align-items:center;justify-content:center;"><svg viewBox="0 0 24 24" fill="currentColor" width="11" height="11"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span>
            Garantie fabricant &amp; pièces d'origine
          </li>
          <li style="display:flex;align-items:center;gap:0.6rem;color:var(--dark);font-size:0.92rem;">
            <span class="feature-check" style="flex:none;width:20px;height:20px;border-radius:50%;background:var(--primary);color:white;display:inline-flex;align-items:center;justify-content:center;"><svg viewBox="0 0 24 24" fill="currentColor" width="11" height="11"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span>
            Installation &amp; mise en service par nos techniciens certifiés
          </li>
          <li style="display:flex;align-items:center;gap:0.6rem;color:var(--dark);font-size:0.92rem;">
            <span class="feature-check" style="flex:none;width:20px;height:20px;border-radius:50%;background:var(--primary);color:white;display:inline-flex;align-items:center;justify-content:center;"><svg viewBox="0 0 24 24" fill="currentColor" width="11" height="11"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span>
            Maintenance &amp; support technique au Cameroun et en Afrique Centrale
          </li>
        </ul>

        <div style="display:flex;gap:0.8rem;flex-wrap:wrap;">
          <a href="<?= $quote_url ?>" class="btn btn-primary btn-lg">Nous contacter / Demander un devis</a>
          <?php if ($p->cta_url && preg_match('~^https?://~i', $p->cta_url)): ?>
          <a href="<?= htmlspecialchars($p->cta_url) ?>" target="_blank" rel="noopener" class="btn btn-outline btn-lg">Documentation fabricant</a>
          <?php endif; ?>
        </div>

        <p style="margin-top:1.2rem;font-size:0.8rem;color:var(--gray);">
          Réponse sous 12h ouvrées — étude gratuite de vos besoins. Aucun prix affiché en ligne :
          chaque configuration fait l'objet d'un devis personnalisé.
        </p>
      </div>
    </div>

    <?php if (!empty($related)): ?>
    <!-- PRODUITS SIMILAIRES -->
    <div style="margin-top:4rem;">
      <h2 style="font-family:'Montserrat',sans-serif;font-size:1.3rem;color:var(--dark);margin-bottom:1.4rem;">
        Dans la même catégorie
      </h2>
      <div class="grid-4" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1.2rem;">
        <?php foreach ($related as $r):
          $r_img = ($r->image && strpos($r->image, 'http') === 0)
              ? htmlspecialchars($r->image)
              : ($r->image ? base_url(htmlspecialchars($r->image)) : $fallback_img);
          $r_url = base_url('produit/' . $r->id . '/' . url_title($r->name . ($r->model ? '-' . $r->model : ''), '-', TRUE));
        ?>
        <a href="<?= $r_url ?>" class="card" style="text-decoration:none;display:block;overflow:hidden;">
          <img src="<?= $r_img ?>" alt="<?= htmlspecialchars($r->name) ?>" class="card-img img-contain"
               style="height:150px;width:100%;object-fit:contain;background:#f4f6fa;" loading="lazy"
               onerror="this.src='<?= $fallback_img ?>'">
          <div class="card-body" style="padding:0.9rem 1rem;">
            <h3 style="font-size:0.92rem;color:var(--dark);font-family:'Montserrat',sans-serif;"><?= htmlspecialchars($r->name) ?></h3>
            <?php if ($r->model): ?><p style="font-size:0.75rem;color:var(--gray);margin-top:0.2rem;"><?= htmlspecialchars($r->model) ?></p><?php endif; ?>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

  </div>
</section>
