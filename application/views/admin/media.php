<div class="page-editor-header">
  <div>
    <div class="page-editor-breadcrumb">
      <a href="<?= base_url('admin') ?>">Tableau de bord</a>
      <i class="fa-solid fa-chevron-right"></i>
      <span>Bibliothèque d'images</span>
    </div>
    <h1><i class="fa-solid fa-images"></i> Bibliothèque d'images</h1>
  </div>
</div>

<?php if (!empty($upload_success)): ?>
<div class="alert alert-success"><i class="fa-solid fa-check-circle"></i> <?= htmlspecialchars($upload_success) ?></div>
<?php endif; ?>
<?php if (!empty($upload_error)): ?>
<div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation"></i> <?= htmlspecialchars($upload_error) ?></div>
<?php endif; ?>

<!-- Zone d'upload -->
<div class="admin-card">
  <div class="admin-card-title"><i class="fa-solid fa-upload"></i> Ajouter des images</div>
  <form action="<?= base_url('admin/upload_media') ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
    <div class="upload-zone" id="upload-zone">
      <i class="fa-solid fa-cloud-arrow-up" style="font-size:2.5rem;margin-bottom:.75rem;color:#94a3b8;"></i>
      <p style="font-size:1rem;font-weight:600;margin-bottom:.25rem;">Glissez-déposez vos images ici</p>
      <p style="font-size:.85rem;color:#94a3b8;">ou cliquez pour sélectionner</p>
      <p style="font-size:.75rem;color:#cbd5e1;margin-top:.5rem;">JPG, PNG, WEBP, GIF, SVG — 5 Mo max</p>
      <input type="file" id="file-input" name="file" accept="image/*" style="display:none;">
    </div>
    <div style="margin-top:1rem;display:flex;gap:1rem;align-items:center;">
      <button type="submit" class="btn btn-primary">
        <i class="fa-solid fa-floppy-disk"></i> Téléverser
      </button>
      <span id="selected-filename" style="font-size:.85rem;color:#64748b;"></span>
    </div>
  </form>
</div>

<!-- Grille des images -->
<div class="admin-card">
  <div class="admin-card-title">
    <i class="fa-solid fa-photo-film"></i>
    Mes images
    <span style="font-weight:400;color:#94a3b8;font-size:.85rem;"><?= count($images) ?> image<?= count($images) > 1 ? 's' : '' ?></span>
  </div>

  <?php if (empty($images)): ?>
  <div style="text-align:center;padding:3rem;color:#94a3b8;">
    <i class="fa-solid fa-images" style="font-size:3rem;margin-bottom:1rem;display:block;"></i>
    Aucune image pour l'instant. Téléversez votre première image ci-dessus.
  </div>
  <?php else: ?>
  <div class="media-grid">
    <?php foreach ($images as $img): ?>
    <div class="media-item" title="<?= htmlspecialchars($img->original_name) ?>">
      <img src="<?= base_url('assets/uploads/' . $img->filename) ?>"
           alt="<?= htmlspecialchars($img->original_name) ?>"
           loading="lazy"
           onerror="this.src='<?= base_url('assets/admin/no-image.png') ?>'">
      <div class="media-item-info">
        <div class="media-item-name"><?= htmlspecialchars($img->original_name) ?></div>
        <div style="font-size:.7rem;color:#94a3b8;"><?= date('d/m/Y', strtotime($img->uploaded_at)) ?></div>
      </div>
      <div class="media-item-actions">
        <button class="btn-copy-path" title="Copier le chemin"
                data-path="assets/uploads/<?= htmlspecialchars($img->filename) ?>">
          <i class="fa-solid fa-copy"></i>
        </button>
        <form method="post" action="<?= base_url('admin/delete_media/' . $img->id) ?>" style="display:inline" onsubmit="return confirm('Supprimer cette image définitivement ?')">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
          <button type="submit" class="btn-del" title="Supprimer" style="cursor:pointer;border:none;background:none;padding:0;">
            <i class="fa-solid fa-trash"></i>
          </button>
        </form>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>
