<style>
  .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1rem; }
  .gallery-item { position: relative; border-radius: 10px; overflow: hidden; aspect-ratio: 4/3; cursor: pointer; background: var(--light); }
  .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; }
  .gallery-item:hover img { transform: scale(1.05); }
  .gallery-item .overlay { position: absolute; inset: 0; background: rgba(29,103,205,0); display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s; padding: 1rem; }
  .gallery-item:hover .overlay { background: rgba(29,103,205,0.55); }
  .gallery-item .overlay .ov-icon { color: white; font-size: 1.8rem; opacity: 0; transition: opacity 0.3s; }
  .gallery-item:hover .overlay .ov-icon { opacity: 1; }
  .gallery-item .overlay .ov-caption { color: white; font-size: 0.85rem; text-align: center; opacity: 0; transition: opacity 0.3s; line-height: 1.4; }
  .gallery-item:hover .overlay .ov-caption { opacity: 1; }
  #lightbox { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.92); z-index: 2000; align-items: center; justify-content: center; flex-direction: column; gap: 1rem; }
  #lightbox.open { display: flex; }
  #lightbox img { max-width: 90vw; max-height: 80vh; object-fit: contain; border-radius: 8px; }
  #lightbox-caption { color: rgba(255,255,255,0.85); font-size: 0.95rem; text-align: center; max-width: 600px; padding: 0 1rem; min-height: 1.4em; }
  #lightbox-close { position: absolute; top: 1.5rem; right: 1.5rem; color: white; font-size: 2rem; cursor: pointer; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: rgba(255,255,255,0.1); }
  #lightbox-close:hover { background: rgba(255,255,255,0.2); }
</style>

<section class="page-hero hero-carousel" <?= cms_section_attrs($c, 'hero', 'Bannière principale') ?>>
  <div class="hc-track">
    <div class="hc-slide active" style="background-image:url('https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=1920&q=60')"></div>
    <div class="hc-slide" style="background-image:url('https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=1920&q=60')"></div>
    <div class="hc-slide" style="background-image:url('https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=1920&q=60')"></div>
  </div>
  <div class="hc-overlay"></div>
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= base_url() ?>" data-i18n="nav_home">Accueil</a>
      <span>›</span>
      <span>Galerie</span>
    </div>
    <h1 <?= cms_field_attrs('hero_title', 'text', 'Titre de la bannière', isset($c['hero_title']) ? $c['hero_title'] : '') ?>><?= isset($c['hero_title']) && $c['hero_title'] ? htmlspecialchars($c['hero_title']) : 'Galerie' ?></h1>
    <p <?= cms_field_attrs('hero_subtitle', 'text', 'Sous-titre de la bannière', isset($c['hero_subtitle']) ? $c['hero_subtitle'] : '') ?>><?= isset($c['hero_subtitle']) && $c['hero_subtitle'] ? htmlspecialchars($c['hero_subtitle']) : 'Nos produits et réalisations en images' ?></p>
  </div>
  <button class="hc-prev" aria-label="Précédent"><i class="fa-solid fa-chevron-left"></i></button>
  <button class="hc-next" aria-label="Suivant"><i class="fa-solid fa-chevron-right"></i></button>
  <div class="hc-dots">
    <button class="hc-dot active" aria-label="Slide 1"></button>
    <button class="hc-dot" aria-label="Slide 2"></button>
    <button class="hc-dot" aria-label="Slide 3"></button>
  </div>
</section>

<section class="section" style="background: linear-gradient(rgba(255,255,255,0.96), rgba(255,255,255,0.96)), url('https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=1920&q=50') center/cover no-repeat fixed;">
  <div class="container">

    <?php if (!empty($images)): ?>
    <div class="gallery-grid">
      <?php foreach ($images as $img): ?>
      <?php
        $img_src = (strpos($img->image, 'http') === 0)
                    ? htmlspecialchars($img->image)
                    : base_url(htmlspecialchars($img->image));
        $alt     = $img->title ? htmlspecialchars($img->title) : 'Galerie Royal Sales Cameroon';
        $caption = $img->caption ? htmlspecialchars($img->caption) : '';
      ?>
      <div class="gallery-item fade-in"
           onclick="openLightbox('<?= $img_src ?>', '<?= addslashes($alt) ?>', '<?= addslashes($caption) ?>')">
        <img src="<?= $img_src ?>" alt="<?= $alt ?>" loading="lazy">
        <div class="overlay">
          <span class="ov-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
          <?php if ($caption): ?>
          <span class="ov-caption"><?= $caption ?></span>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php else: ?>
    <div style="text-align:center;padding:5rem 2rem;color:var(--gray);">
      <i class="fa-solid fa-images" style="font-size:3.5rem;display:block;margin-bottom:1rem;color:#cbd5e1;"></i>
      <p style="font-size:1.05rem;">La galerie est en cours de préparation.</p>
      <p style="font-size:0.9rem;margin-top:0.5rem;color:#94a3b8;">Les photos seront bientôt disponibles.</p>
    </div>
    <?php endif; ?>

  </div>
</section>

<!-- Lightbox -->
<div id="lightbox" onclick="closeLightbox()">
  <div id="lightbox-close" onclick="closeLightbox()">✕</div>
  <img id="lightbox-img" src="" alt="Image agrandie" onclick="event.stopPropagation()">
  <p id="lightbox-caption"></p>
</div>

<!-- CTA -->
<section class="cta-section fade-in" <?= cms_section_attrs($c, 'gallery_cta', 'Appel à l\'action') ?>>
  <div class="container" style="position:relative;z-index:1;">
    <h2 <?= cms_field_attrs('cta_title', 'text', 'CTA — Titre', isset($c['cta_title']) ? $c['cta_title'] : '') ?>><?= (isset($c['cta_title']) && $c['cta_title']) ? htmlspecialchars($c['cta_title']) : 'Intéressé par nos produits ?' ?></h2>
    <p <?= cms_field_attrs('cta_text', 'text', 'CTA — Texte', isset($c['cta_text']) ? $c['cta_text'] : '') ?>><?= (isset($c['cta_text']) && $c['cta_text']) ? htmlspecialchars($c['cta_text']) : 'Contactez-nous pour un devis personnalisé ou une démonstration.' ?></p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
      <a href="<?= (isset($c['cta_btn1_url']) && $c['cta_btn1_url']) ? htmlspecialchars($c['cta_btn1_url']) : base_url('contact') ?>"
         class="btn btn-accent btn-lg"
         <?= cms_field_attrs('cta_btn1_url', 'url', 'CTA — Bouton 1 URL', isset($c['cta_btn1_url']) ? $c['cta_btn1_url'] : '') ?>>
        <i class="fa-solid fa-paper-plane" style="margin-right:0.4rem;"></i>
        <span <?= cms_field_attrs('cta_btn1_text', 'text', 'CTA — Bouton 1 Texte', isset($c['cta_btn1_text']) ? $c['cta_btn1_text'] : '') ?>><?= (isset($c['cta_btn1_text']) && $c['cta_btn1_text']) ? htmlspecialchars($c['cta_btn1_text']) : 'Demander un devis' ?></span>
      </a>
      <a href="<?= (isset($c['cta_btn2_url']) && $c['cta_btn2_url']) ? htmlspecialchars($c['cta_btn2_url']) : 'tel:+237691123112' ?>"
         class="btn btn-outline-light btn-lg"
         <?= cms_field_attrs('cta_btn2_url', 'url', 'CTA — Bouton 2 URL (tel:+237…)', isset($c['cta_btn2_url']) ? $c['cta_btn2_url'] : '') ?>>
        <i class="fa-solid fa-phone" style="margin-right:0.4rem;"></i>
        <span <?= cms_field_attrs('cta_btn2_text', 'text', 'CTA — Bouton 2 Texte (téléphone)', isset($c['cta_btn2_text']) ? $c['cta_btn2_text'] : '') ?>><?= (isset($c['cta_btn2_text']) && $c['cta_btn2_text']) ? htmlspecialchars($c['cta_btn2_text']) : '+237 691 123 112' ?></span>
      </a>
    </div>
  </div>
</section>

<script>
function openLightbox(src, title, caption) {
  document.getElementById('lightbox-img').src = src;
  document.getElementById('lightbox-img').alt = title || '';
  document.getElementById('lightbox-caption').textContent = caption || title || '';
  document.getElementById('lightbox').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeLightbox() {
  document.getElementById('lightbox').classList.remove('open');
  document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeLightbox(); });
</script>
