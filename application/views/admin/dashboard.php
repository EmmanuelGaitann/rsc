<div class="dash-welcome">
  <h1><i class="fa-solid fa-gauge-high"></i> Tableau de bord</h1>
  <p>Bienvenue, <strong><?= htmlspecialchars($admin_name ?? 'Admin') ?></strong>. Sélectionnez une page à modifier.</p>
</div>

<div class="dash-section-title">
  <i class="fa-solid fa-file-lines"></i> Pages du site
</div>
<div class="dashboard-grid">
  <?php foreach ($page_defs as $pg_key => $pg): ?>
  <a href="<?= base_url('admin/page/' . $pg_key) ?>" class="dash-card">
    <i class="fa-solid <?= $pg['icon'] ?>"></i>
    <div class="dash-card-title"><?= htmlspecialchars($pg['title']) ?></div>
    <div class="dash-card-sub">
      <?php
        $field_count = 0;
        foreach ($pg['sections'] as $s) $field_count += count($s['fields']);
        echo $field_count . ' champ' . ($field_count > 1 ? 's' : '') . ' éditables';
      ?>
    </div>
  </a>
  <?php endforeach; ?>
</div>

<div class="dash-section-title" style="margin-top:2rem;">
  <i class="fa-solid fa-bolt"></i> Accès rapides
</div>
<div class="dashboard-grid" style="grid-template-columns:repeat(auto-fill,minmax(180px,1fr));">
  <a href="<?= base_url('admin/media') ?>" class="dash-card">
    <i class="fa-solid fa-images" style="color:#8b5cf6;"></i>
    <div class="dash-card-title">Bibliothèque d'images</div>
    <div class="dash-card-sub">Téléverser et gérer les photos</div>
  </a>
  <a href="<?= base_url('admin/password') ?>" class="dash-card">
    <i class="fa-solid fa-lock" style="color:#f59e0b;"></i>
    <div class="dash-card-title">Mot de passe</div>
    <div class="dash-card-sub">Modifier vos identifiants</div>
  </a>
  <a href="<?= base_url() ?>" target="_blank" class="dash-card">
    <i class="fa-solid fa-arrow-up-right-from-square" style="color:#10b981;"></i>
    <div class="dash-card-title">Voir le site</div>
    <div class="dash-card-sub">Ouvrir le site public</div>
  </a>
</div>

<div class="admin-card" style="margin-top:2rem;background:#f0fdf4;border:1px solid #bbf7d0;">
  <div style="display:flex;gap:1rem;align-items:flex-start;">
    <i class="fa-solid fa-circle-info" style="color:#16a34a;font-size:1.3rem;margin-top:.1rem;"></i>
    <div>
      <strong style="color:#15803d;">Comment modifier le contenu ?</strong>
      <ol style="color:#166534;font-size:.875rem;line-height:2;margin-top:.5rem;padding-left:1.25rem;">
        <li>Cliquez sur la page que vous souhaitez modifier</li>
        <li>Remplissez ou modifiez les champs de texte</li>
        <li>Cliquez sur <strong>Enregistrer les modifications</strong></li>
        <li>Les changements sont immédiatement visibles sur le site</li>
      </ol>
    </div>
  </div>
</div>
