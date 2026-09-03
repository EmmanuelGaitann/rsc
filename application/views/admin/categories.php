<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title"><i class="fa-solid fa-tag fa-fw"></i> Catégories</h1>
    <p class="admin-page-subtitle">Gérez les catégories de produits du catalogue.</p>
  </div>
  <a href="<?= base_url('admin/category_new') ?>" class="btn btn-primary">
    <i class="fa-solid fa-plus"></i> Nouvelle catégorie
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

<?php if (empty($categories_list)): ?>
<div style="text-align:center;padding:3rem;background:var(--light);border-radius:12px;color:var(--gray);">
  <i class="fa-solid fa-tag" style="font-size:2.5rem;margin-bottom:1rem;display:block;color:#94a3b8;"></i>
  <p>Aucune catégorie pour l'instant.</p>
  <a href="<?= base_url('admin/category_new') ?>" class="btn btn-primary" style="margin-top:1rem;">Ajouter une catégorie</a>
</div>
<?php else: ?>
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);overflow:hidden;">
  <table style="width:100%;border-collapse:collapse;">
    <thead>
      <tr style="background:#f8fafc;border-bottom:1px solid #e2e8f0;">
        <th style="padding:0.75rem 1rem;text-align:left;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Nom</th>
        <th style="padding:0.75rem 1rem;text-align:left;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Slug</th>
        <th style="padding:0.75rem 1rem;text-align:center;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Ordre</th>
        <th style="padding:0.75rem 1rem;text-align:right;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($categories_list as $cat): ?>
      <tr style="border-bottom:1px solid #f1f5f9;">
        <td style="padding:0.85rem 1rem;font-weight:600;color:#0f172a;"><?= htmlspecialchars($cat->name) ?></td>
        <td style="padding:0.85rem 1rem;font-size:0.82rem;color:#64748b;font-family:monospace;"><?= htmlspecialchars($cat->slug) ?></td>
        <td style="padding:0.85rem 1rem;text-align:center;font-size:0.85rem;color:#64748b;"><?= (int)$cat->sort_order ?></td>
        <td style="padding:0.85rem 1rem;text-align:right;white-space:nowrap;">
          <a href="<?= base_url('admin/category_edit/' . $cat->id) ?>" class="btn btn-outline btn-sm" style="margin-right:0.4rem;">
            <i class="fa-solid fa-pencil"></i> Modifier
          </a>
          <form method="post" action="<?= base_url('admin/category_delete/' . $cat->id) ?>" style="display:inline" onsubmit="return confirm('Supprimer cette catégorie ?\nImpossible si des produits lui sont associés.')">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
            <button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;cursor:pointer;">
              <i class="fa-solid fa-trash"></i>
            </button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<p style="margin-top:1rem;color:#94a3b8;font-size:0.82rem;">
  <i class="fa-solid fa-circle-info"></i> <?= count($categories_list) ?> catégorie(s) au total.
  Une catégorie utilisée par des produits ne peut pas être supprimée.
</p>
<?php endif; ?>
