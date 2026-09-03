<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title"><i class="fa-solid fa-photo-film fa-fw"></i> Galerie Photos</h1>
    <p class="admin-page-subtitle">Gérez les images affichées sur la page Galerie du site.</p>
  </div>
  <a href="<?= base_url('admin/gallery_new') ?>" class="btn btn-primary">
    <i class="fa-solid fa-plus"></i> Nouvelle image
  </a>
</div>

<?php if (!empty($success)): ?>
<div style="margin-bottom:1.5rem;padding:0.8rem 1rem;border-radius:8px;background:#dcfce7;color:#15803d;border:1px solid #86efac;">
  <i class="fa-solid fa-check"></i> <?= htmlspecialchars($success) ?>
</div>
<?php endif; ?>

<?php if (!empty($error)): ?>
<div style="margin-bottom:1.5rem;padding:0.8rem 1rem;border-radius:8px;background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;">
  <i class="fa-solid fa-xmark"></i> <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<?php if (empty($gallery_list)): ?>
<div style="text-align:center;padding:3rem;background:var(--light);border-radius:12px;color:var(--gray);">
  <i class="fa-solid fa-images" style="font-size:2.5rem;margin-bottom:1rem;display:block;color:#94a3b8;"></i>
  <p>Aucune image dans la galerie pour l'instant.</p>
  <a href="<?= base_url('admin/gallery_new') ?>" class="btn btn-primary" style="margin-top:1rem;">
    Ajouter ma première image
  </a>
</div>
<?php else: ?>

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1.25rem;margin-bottom:1.5rem;">
  <?php foreach ($gallery_list as $item): ?>
  <?php $thumb = ($item->image && strpos($item->image, 'http') === 0) ? htmlspecialchars($item->image) : ($item->image ? base_url(htmlspecialchars($item->image)) : ''); ?>
  <div style="background:white;border-radius:10px;box-shadow:0 1px 4px rgba(0,0,0,0.08);overflow:hidden;display:flex;flex-direction:column;">
    <!-- Thumbnail -->
    <div style="position:relative;aspect-ratio:4/3;background:#f4f6fa;overflow:hidden;">
      <?php if ($thumb): ?>
      <img src="<?= $thumb ?>" alt="<?= htmlspecialchars($item->title ?: '') ?>"
           style="width:100%;height:100%;object-fit:cover;" loading="lazy">
      <?php else: ?>
      <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#94a3b8;">
        <i class="fa-solid fa-image" style="font-size:2.5rem;"></i>
      </div>
      <?php endif; ?>
      <!-- Visibility badge -->
      <a href="<?= base_url('admin/gallery_toggle/' . $item->id) ?>"
         style="position:absolute;top:0.5rem;right:0.5rem;text-decoration:none;" title="Basculer visibilité">
        <?php if ($item->visible): ?>
        <span style="background:#16a34a;color:white;padding:0.15rem 0.5rem;border-radius:20px;font-size:0.72rem;font-weight:600;">Visible</span>
        <?php else: ?>
        <span style="background:#64748b;color:white;padding:0.15rem 0.5rem;border-radius:20px;font-size:0.72rem;font-weight:600;">Masqué</span>
        <?php endif; ?>
      </a>
      <!-- Sort order badge -->
      <span style="position:absolute;top:0.5rem;left:0.5rem;background:rgba(0,0,0,0.55);color:white;padding:0.15rem 0.5rem;border-radius:20px;font-size:0.72rem;">#<?= (int)$item->sort_order ?></span>
    </div>
    <!-- Info -->
    <div style="padding:0.75rem;flex:1;display:flex;flex-direction:column;gap:0.35rem;">
      <div style="font-weight:600;font-size:0.9rem;color:#0f172a;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
        <?= $item->title ? htmlspecialchars($item->title) : '<em style="color:#94a3b8;">Sans titre</em>' ?>
      </div>
      <?php if ($item->caption): ?>
      <div style="font-size:0.78rem;color:#64748b;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
        <?= htmlspecialchars($item->caption) ?>
      </div>
      <?php endif; ?>
    </div>
    <!-- Actions -->
    <div style="padding:0.6rem 0.75rem;border-top:1px solid #f1f5f9;display:flex;gap:0.5rem;">
      <a href="<?= base_url('admin/gallery_edit/' . $item->id) ?>"
         class="btn btn-outline btn-sm" style="flex:1;text-align:center;">
        <i class="fa-solid fa-pencil"></i> Modifier
      </a>
      <form method="post" action="<?= base_url('admin/gallery_delete/' . $item->id) ?>" style="display:inline" onsubmit="return confirm('Supprimer cette image de la galerie ?')">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
        <button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;cursor:pointer;">
          <i class="fa-solid fa-trash"></i>
        </button>
      </form>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<p style="color:#94a3b8;font-size:0.82rem;">
  <i class="fa-solid fa-circle-info"></i>
  <?= count($gallery_list) ?> image(s) au total. Cliquez sur le badge "Visible / Masqué" pour basculer l'affichage. L'ordre est défini par le champ "Ordre".
</p>

<?php endif; ?>
