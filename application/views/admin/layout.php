<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Administration — Royal Sales Cameroon</title>
  <link rel="stylesheet" href="<?= base_url('assets/admin/admin.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/fonts.css') ?>">
  <script>const BASE_URL = '<?= base_url() ?>';</script>
</head>
<body class="admin-body">

<!-- ===== SIDEBAR ===== -->
<aside class="admin-sidebar" id="sidebar">
  <div class="admin-logo">
    <img src="<?= base_url('assets/logo/RSC_logo.png') ?>" alt="RSC" onerror="this.style.display='none'">
    <span>RSC Admin</span>
  </div>

  <nav class="admin-nav">
    <div class="nav-section-label">Général</div>
    <a href="<?= base_url('admin') ?>"
       class="nav-item <?= ($this->uri->segment(2) === '' || $this->uri->segment(2) === false) ? 'active' : '' ?>">
      <i class="fa-solid fa-gauge-high fa-fw"></i> Tableau de bord
    </a>

    <div class="nav-section-label">Pages du site</div>
    <?php foreach ($page_defs as $pg_key => $pg): ?>
    <a href="<?= base_url('admin/page/' . $pg_key) ?>"
       class="nav-item <?= (isset($page_name) && $page_name === $pg_key) ? 'active' : '' ?>">
      <i class="fa-solid <?= $pg['icon'] ?> fa-fw"></i>
      <?= htmlspecialchars($pg['title']) ?>
    </a>
    <?php endforeach; ?>

    <div class="nav-section-label">Catalogue</div>
    <a href="<?= base_url('admin/products') ?>"
       class="nav-item <?= ($this->uri->segment(2) === 'products' || strpos($this->uri->segment(2), 'product') === 0) ? 'active' : '' ?>">
      <i class="fa-solid fa-box fa-fw"></i> Produits
    </a>
    <a href="<?= base_url('admin/brands') ?>"
       class="nav-item <?= ($this->uri->segment(2) === 'brands' || strpos($this->uri->segment(2), 'brand') === 0) ? 'active' : '' ?>">
      <i class="fa-solid fa-industry fa-fw"></i> Fabricants
    </a>
    <a href="<?= base_url('admin/categories') ?>"
       class="nav-item <?= ($this->uri->segment(2) === 'categories' || strpos($this->uri->segment(2), 'category') === 0) ? 'active' : '' ?>">
      <i class="fa-solid fa-tag fa-fw"></i> Catégories
    </a>

    <div class="nav-section-label">Pages personnalisées</div>
    <a href="<?= base_url('admin/pages') ?>"
       class="nav-item <?= ($this->uri->segment(2) === 'pages') ? 'active' : '' ?>">
      <i class="fa-solid fa-file-lines fa-fw"></i> Pages du site
    </a>

    <div class="nav-section-label">Suivi</div>
    <a href="<?= base_url('admin/leads') ?>"
       class="nav-item <?= (strpos((string)$this->uri->segment(2), 'lead') === 0) ? 'active' : '' ?>">
      <i class="fa-solid fa-inbox fa-fw"></i> Demandes reçues
      <?php if (!empty($leads_new_count)): ?>
      <span style="background:#dc2626;color:white;border-radius:20px;padding:0.05rem 0.5rem;font-size:0.68rem;font-weight:700;margin-left:auto;"><?= (int)$leads_new_count ?></span>
      <?php endif; ?>
    </a>
    <a href="<?= base_url('admin/stats') ?>"
       class="nav-item <?= ($this->uri->segment(2) === 'stats') ? 'active' : '' ?>">
      <i class="fa-solid fa-chart-column fa-fw"></i> Statistiques
    </a>

    <div class="nav-section-label">Traductions</div>
    <a href="<?= base_url('admin/translations') ?>"
       class="nav-item <?= (strpos((string)$this->uri->segment(2), 'translation') === 0) ? 'active' : '' ?>">
      <i class="fa-solid fa-language fa-fw"></i> Traductions EN
    </a>

    <div class="nav-section-label">Médias</div>
    <a href="<?= base_url('admin/media') ?>"
       class="nav-item <?= ($this->uri->segment(2) === 'media') ? 'active' : '' ?>">
      <i class="fa-solid fa-images fa-fw"></i> Bibliothèque d'images
    </a>
    <a href="<?= base_url('admin/gallery') ?>"
       class="nav-item <?= (strpos($this->uri->segment(2), 'gallery') === 0) ? 'active' : '' ?>">
      <i class="fa-solid fa-photo-film fa-fw"></i> Galerie
    </a>

    <?php if (!empty($admin_is_super)): ?>
    <div class="nav-section-label">Administration</div>
    <a href="<?= base_url('admin/users') ?>"
       class="nav-item <?= (in_array($this->uri->segment(2), ['users','user_new','user_edit','user_set_password'])) ? 'active' : '' ?>">
      <i class="fa-solid fa-users-gear fa-fw"></i> Utilisateurs
    </a>
    <a href="<?= base_url('admin/audit') ?>"
       class="nav-item <?= ($this->uri->segment(2) === 'audit') ? 'active' : '' ?>">
      <i class="fa-solid fa-clock-rotate-left fa-fw"></i> Journal d'audit
    </a>
    <?php endif; ?>

    <div class="nav-section-label">Compte</div>
    <a href="<?= base_url('admin/password') ?>"
       class="nav-item <?= ($this->uri->segment(2) === 'password') ? 'active' : '' ?>">
      <i class="fa-solid fa-lock fa-fw"></i> Mot de passe
    </a>
    <a href="<?= base_url('admin/logout') ?>" class="nav-item nav-item-danger">
      <i class="fa-solid fa-right-from-bracket fa-fw"></i> Déconnexion
    </a>
  </nav>
</aside>

<!-- ===== MAIN ===== -->
<div class="admin-main">

  <header class="admin-header">
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Menu">
      <i class="fa-solid fa-bars"></i>
    </button>
    <div class="admin-header-right">
      <span class="admin-user">
        <i class="fa-solid fa-circle-user"></i>
        <?= htmlspecialchars($admin_name ?? 'Admin') ?>
      </span>
      <a href="<?= base_url() ?>" target="_blank" class="btn btn-outline btn-sm">
        <i class="fa-solid fa-arrow-up-right-from-square"></i> Voir le site
      </a>
    </div>
  </header>

  <div class="admin-content">
    <?php $this->load->view($view_content, isset($data) ? $data : get_defined_vars()); ?>
  </div>

</div>

<!-- Overlay sidebar mobile -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- Toast container -->
<div id="toast-container"></div>

<!-- TinyMCE 5 (hébergé sur cdnjs, pas besoin de clé API) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.9/tinymce.min.js"></script>
<script src="<?= base_url('assets/admin/admin.js') ?>"></script>
</body>
</html>
