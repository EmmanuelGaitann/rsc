<section class="page-hero hero-carousel">
  <div class="hc-track">
    <div class="hc-slide active" style="background-image:url('https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=1920&q=60')"></div>
    <div class="hc-slide" style="background-image:url('https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=1920&q=60')"></div>
    <div class="hc-slide" style="background-image:url('https://images.unsplash.com/photo-1570126618953-d437176e8c79?w=1920&q=60')"></div>
  </div>
  <div class="hc-overlay"></div>
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= base_url() ?>">Accueil</a>
      <span>›</span>
      <span><?= htmlspecialchars($page->title) ?></span>
    </div>
    <h1><?= htmlspecialchars($page->title) ?></h1>
  </div>
  <button class="hc-prev" aria-label="Précédent"><i class="fa-solid fa-chevron-left"></i></button>
  <button class="hc-next" aria-label="Suivant"><i class="fa-solid fa-chevron-right"></i></button>
  <div class="hc-dots">
    <button class="hc-dot active" aria-label="Slide 1"></button>
    <button class="hc-dot" aria-label="Slide 2"></button>
    <button class="hc-dot" aria-label="Slide 3"></button>
  </div>
</section>

<section class="section">
  <div class="container" style="max-width:860px;">
    <div class="fade-in" style="line-height:1.85;color:var(--text);">
      <?= $page->content ?>
    </div>
  </div>
</section>

<section class="cta-section fade-in">
  <div class="container">
    <h2>Besoin d'informations ?</h2>
    <p>Contactez notre équipe pour toute question.</p>
    <a href="<?= base_url('contact') ?>" class="btn btn-accent btn-lg">
      <i class="fa-solid fa-paper-plane" style="margin-right:0.4rem;"></i>Nous contacter
    </a>
  </div>
</section>
