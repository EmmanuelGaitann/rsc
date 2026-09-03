<?php $is_edit = !empty($brand); ?>

<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title">
      <i class="fa-solid <?= $is_edit ? 'fa-pencil' : 'fa-plus' ?> fa-fw"></i>
      <?= $is_edit ? 'Modifier le fabricant' : 'Nouveau fabricant' ?>
    </h1>
    <?php if ($is_edit): ?>
    <p class="admin-page-subtitle"><?= htmlspecialchars($brand->name) ?></p>
    <?php endif; ?>
  </div>
  <a href="<?= base_url('admin/brands') ?>" class="btn btn-outline">
    <i class="fa-solid fa-arrow-left"></i> Retour
  </a>
</div>

<?php if (!empty($error)): ?>
<div style="background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;padding:0.8rem 1rem;border-radius:8px;margin-bottom:1.5rem;">
  <i class="fa-solid fa-xmark"></i> <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<form method="post" action="<?= $is_edit ? base_url('admin/brand_do_edit/' . $brand->id) : base_url('admin/brand_do_new') ?>">
  <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
  <div class="editor-section" style="max-width:620px;">
    <h3 class="editor-section-title">Informations du fabricant</h3>

    <div class="form-group">
      <label class="form-label">Nom <span style="color:#ef4444;">*</span></label>
      <input type="text" name="name" id="bf-name" class="form-control"
             value="<?= $is_edit ? htmlspecialchars($brand->name) : '' ?>"
             placeholder="Ex : RENNER Kompressoren" required>
    </div>

    <div class="form-group">
      <label class="form-label">Slug (identifiant technique) <span style="color:#ef4444;">*</span></label>
      <input type="text" name="slug" id="bf-slug" class="form-control"
             value="<?= $is_edit ? htmlspecialchars($brand->slug) : '' ?>"
             placeholder="Ex : renner" pattern="[a-z0-9\-]+" required>
      <small style="color:#94a3b8;font-size:0.75rem;">
        Lettres minuscules, chiffres et tirets uniquement.
        <?= $is_edit ? '<strong style="color:#f59e0b;">Ne pas modifier après création si des produits existent.</strong>' : 'Généré automatiquement depuis le nom.' ?>
      </small>
    </div>

    <div class="form-group">
      <label class="form-label">Couleur de la marque</label>
      <div style="display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap;">
        <input type="color" id="bf-color-picker"
               value="<?= $is_edit ? htmlspecialchars($brand->color) : '#64748b' ?>"
               style="width:46px;height:36px;border:1px solid #e2e8f0;border-radius:6px;cursor:pointer;padding:2px;background:none;">
        <input type="text" name="color" id="bf-color-text" class="form-control"
               value="<?= $is_edit ? htmlspecialchars($brand->color) : '#64748b' ?>"
               placeholder="#64748b" style="max-width:110px;">
        <span id="bf-color-preview"
              style="padding:0.22rem 0.8rem;border-radius:20px;font-size:0.75rem;font-weight:700;color:white;background:<?= $is_edit ? htmlspecialchars($brand->color) : '#64748b' ?>;">
          <?= $is_edit ? htmlspecialchars($brand->name) : 'Aperçu badge' ?>
        </span>
      </div>
    </div>

    <div class="form-group">
      <label class="form-label">Icône FontAwesome</label>
      <div style="display:flex;align-items:center;gap:0.75rem;">
        <input type="text" name="icon" id="bf-icon" class="form-control"
               value="<?= $is_edit ? htmlspecialchars($brand->icon) : 'fa-industry' ?>"
               placeholder="fa-industry" style="max-width:200px;">
        <i id="bf-icon-preview"
           class="fa-solid <?= $is_edit ? htmlspecialchars($brand->icon) : 'fa-industry' ?>"
           style="font-size:1.5rem;color:<?= $is_edit ? htmlspecialchars($brand->color) : '#64748b' ?>;"></i>
      </div>
      <small style="color:#94a3b8;font-size:0.75rem;">
        Exemples : fa-industry, fa-gear, fa-star, fa-box, fa-oil-can.
        Voir <a href="https://fontawesome.com/icons" target="_blank" style="color:var(--primary);">fontawesome.com/icons</a>
      </small>
    </div>

    <div class="form-group">
      <label class="form-label">Ordre d'affichage</label>
      <input type="number" name="sort_order" class="form-control" min="0" style="max-width:120px;"
             value="<?= $is_edit ? (int)$brand->sort_order : '0' ?>">
      <small style="color:#94a3b8;font-size:0.75rem;">Plus petit = apparaît en premier dans la barre de filtres.</small>
    </div>
  </div>

  <div class="editor-actions" style="position:sticky;bottom:0;background:white;padding:1rem 0;border-top:1px solid var(--border);margin-top:1.5rem;">
    <button type="submit" class="btn btn-primary btn-lg">
      <i class="fa-solid fa-check"></i>
      <?= $is_edit ? 'Mettre à jour' : 'Ajouter le fabricant' ?>
    </button>
    <a href="<?= base_url('admin/brands') ?>" class="btn btn-outline btn-lg">Annuler</a>
  </div>
</form>

<script>
<?php if (!$is_edit): ?>
document.getElementById('bf-name').addEventListener('input', function () {
  const slug = this.value.toLowerCase()
    .normalize('NFD').replace(/[̀-ͯ]/g, '')
    .replace(/\s+/g, '-')
    .replace(/[^a-z0-9\-]/g, '')
    .replace(/-+/g, '-')
    .replace(/^-|-$/g, '');
  document.getElementById('bf-slug').value = slug;
  document.getElementById('bf-color-preview').textContent = this.value || 'Aperçu badge';
});
<?php endif; ?>

const colorPicker = document.getElementById('bf-color-picker');
const colorText   = document.getElementById('bf-color-text');

colorPicker.addEventListener('input', function () {
  colorText.value = this.value;
  applyColor(this.value);
});

colorText.addEventListener('input', function () {
  if (/^#[0-9a-fA-F]{6}$/.test(this.value)) {
    colorPicker.value = this.value;
    applyColor(this.value);
  }
});

function applyColor(c) {
  document.getElementById('bf-color-preview').style.background = c;
  document.getElementById('bf-icon-preview').style.color = c;
}

document.getElementById('bf-icon').addEventListener('input', function () {
  const el = document.getElementById('bf-icon-preview');
  el.className = 'fa-solid ' + this.value.trim();
});
</script>
