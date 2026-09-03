<?php $is_edit = !empty($category); ?>

<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title">
      <i class="fa-solid <?= $is_edit ? 'fa-pencil' : 'fa-plus' ?> fa-fw"></i>
      <?= $is_edit ? 'Modifier la catégorie' : 'Nouvelle catégorie' ?>
    </h1>
    <?php if ($is_edit): ?>
    <p class="admin-page-subtitle"><?= htmlspecialchars($category->name) ?></p>
    <?php endif; ?>
  </div>
  <a href="<?= base_url('admin/categories') ?>" class="btn btn-outline">
    <i class="fa-solid fa-arrow-left"></i> Retour
  </a>
</div>

<?php if (!empty($error)): ?>
<div style="background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;padding:0.8rem 1rem;border-radius:8px;margin-bottom:1.5rem;">
  <i class="fa-solid fa-xmark"></i> <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<form method="post" action="<?= $is_edit ? base_url('admin/category_do_edit/' . $category->id) : base_url('admin/category_do_new') ?>">
  <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
  <div class="editor-section" style="max-width:560px;">
    <h3 class="editor-section-title">Informations de la catégorie</h3>

    <div class="form-group">
      <label class="form-label">Nom <span style="color:#ef4444;">*</span></label>
      <input type="text" name="name" id="cf-name" class="form-control"
             value="<?= $is_edit ? htmlspecialchars($category->name) : '' ?>"
             placeholder="Ex : Compresseurs à vis" required>
    </div>

    <div class="form-group">
      <label class="form-label">Slug (identifiant technique) <span style="color:#ef4444;">*</span></label>
      <input type="text" name="slug" id="cf-slug" class="form-control"
             value="<?= $is_edit ? htmlspecialchars($category->slug) : '' ?>"
             placeholder="Ex : vis" pattern="[a-z0-9\-]+" required>
      <small style="color:#94a3b8;font-size:0.75rem;">
        Lettres minuscules, chiffres et tirets uniquement.
        <?= $is_edit ? '<strong style="color:#f59e0b;">Ne pas modifier après création si des produits existent.</strong>' : 'Généré automatiquement depuis le nom.' ?>
      </small>
    </div>

    <div class="form-group">
      <label class="form-label">Ordre d'affichage</label>
      <input type="number" name="sort_order" class="form-control" min="0" style="max-width:120px;"
             value="<?= $is_edit ? (int)$category->sort_order : '0' ?>">
      <small style="color:#94a3b8;font-size:0.75rem;">Plus petit = apparaît en premier dans la barre de filtres.</small>
    </div>
  </div>

  <div class="editor-actions" style="position:sticky;bottom:0;background:white;padding:1rem 0;border-top:1px solid var(--border);margin-top:1.5rem;">
    <button type="submit" class="btn btn-primary btn-lg">
      <i class="fa-solid fa-check"></i>
      <?= $is_edit ? 'Mettre à jour' : 'Ajouter la catégorie' ?>
    </button>
    <a href="<?= base_url('admin/categories') ?>" class="btn btn-outline btn-lg">Annuler</a>
  </div>
</form>

<script>
<?php if (!$is_edit): ?>
document.getElementById('cf-name').addEventListener('input', function () {
  const slug = this.value.toLowerCase()
    .normalize('NFD').replace(/[̀-ͯ]/g, '')
    .replace(/\s+/g, '-')
    .replace(/[^a-z0-9\-]/g, '')
    .replace(/-+/g, '-')
    .replace(/^-|-$/g, '');
  document.getElementById('cf-slug').value = slug;
});
<?php endif; ?>
</script>
