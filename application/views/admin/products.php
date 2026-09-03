<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title"><i class="fa-solid fa-box fa-fw"></i> Catalogue Produits</h1>
    <p class="admin-page-subtitle">Gérez tous les produits affichés sur la page catalogue.</p>
  </div>
  <a href="<?= base_url('admin/product_new') ?>" class="btn btn-primary">
    <i class="fa-solid fa-plus"></i> Nouveau produit
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

<?php
/* $brands_map (slug => object) and $cats_map (slug => name) come from DB */
?>

<?php if (empty($products_list)): ?>
<div style="text-align:center;padding:3rem;background:var(--light);border-radius:12px;color:var(--gray);">
  <i class="fa-solid fa-box-open" style="font-size:2.5rem;margin-bottom:1rem;display:block;color:#94a3b8;"></i>
  <p>Aucun produit pour l'instant.</p>
  <a href="<?= base_url('admin/product_new') ?>" class="btn btn-primary" style="margin-top:1rem;">
    Ajouter mon premier produit
  </a>
</div>
<?php else: ?>
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);overflow:hidden;">
  <table style="width:100%;border-collapse:collapse;">
    <thead>
      <tr style="background:#f8fafc;border-bottom:1px solid #e2e8f0;">
        <th style="padding:0.75rem 1rem;text-align:left;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Produit</th>
        <th style="padding:0.75rem 1rem;text-align:left;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Fabricant</th>
        <th style="padding:0.75rem 1rem;text-align:left;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Catégorie</th>
        <th style="padding:0.75rem 1rem;text-align:center;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Ordre</th>
        <th style="padding:0.75rem 1rem;text-align:left;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">État</th>
        <th style="padding:0.75rem 1rem;text-align:right;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products_list as $p): ?>
      <tr style="border-bottom:1px solid #f1f5f9;">
        <td style="padding:0.85rem 1rem;">
          <div style="display:flex;align-items:center;gap:0.75rem;">
            <?php if ($p->image): ?>
            <?php $thumb = (strpos($p->image, 'http') === 0) ? htmlspecialchars($p->image) : base_url(htmlspecialchars($p->image)); ?>
            <img src="<?= $thumb ?>" style="width:48px;height:48px;object-fit:contain;border-radius:6px;border:1px solid #e2e8f0;background:#f4f6fa;" loading="lazy">
            <?php else: ?>
            <div style="width:48px;height:48px;border-radius:6px;border:1px solid #e2e8f0;background:#f4f6fa;display:flex;align-items:center;justify-content:center;color:#94a3b8;">
              <i class="fa-solid fa-image"></i>
            </div>
            <?php endif; ?>
            <div>
              <div style="font-weight:600;color:#0f172a;"><?= htmlspecialchars($p->name) ?></div>
              <?php if ($p->model): ?>
              <div style="font-size:0.78rem;color:#64748b;"><?= htmlspecialchars($p->model) ?></div>
              <?php endif; ?>
            </div>
          </div>
        </td>
        <td style="padding:0.85rem 1rem;">
          <?php $bobj = $brands_map[$p->brand] ?? null; $bc = $bobj ? $bobj->color : '#64748b'; $bl = $bobj ? $bobj->name : htmlspecialchars($p->brand); ?>
          <span style="background:<?= $bc ?>22;color:<?= $bc ?>;padding:0.2rem 0.6rem;border-radius:20px;font-size:0.75rem;font-weight:600;">
            <?= htmlspecialchars($bl) ?>
          </span>
        </td>
        <td style="padding:0.85rem 1rem;font-size:0.85rem;color:#64748b;">
          <?= isset($cats_map[$p->category]) ? htmlspecialchars($cats_map[$p->category]) : htmlspecialchars($p->category) ?>
        </td>
        <td style="padding:0.85rem 1rem;text-align:center;font-size:0.85rem;color:#64748b;">
          <?= (int)$p->sort_order ?>
        </td>
        <td style="padding:0.85rem 1rem;">
          <a href="<?= base_url('admin/product_toggle/' . $p->id) ?>" style="text-decoration:none;" title="Cliquer pour basculer">
            <?php if ($p->visible): ?>
            <span style="background:#dcfce7;color:#16a34a;padding:0.2rem 0.6rem;border-radius:20px;font-size:0.75rem;font-weight:600;">Visible</span>
            <?php else: ?>
            <span style="background:#f1f5f9;color:#94a3b8;padding:0.2rem 0.6rem;border-radius:20px;font-size:0.75rem;font-weight:600;">Masqué</span>
            <?php endif; ?>
          </a>
        </td>
        <td style="padding:0.85rem 1rem;text-align:right;white-space:nowrap;">
          <a href="<?= base_url('admin/product_edit/' . $p->id) ?>" class="btn btn-outline btn-sm" style="margin-right:0.5rem;">
            <i class="fa-solid fa-pencil"></i> Modifier
          </a>
          <form method="post" action="<?= base_url('admin/product_delete/' . $p->id) ?>" style="display:inline" onsubmit="return confirm('Supprimer ce produit définitivement ?')">
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
  <i class="fa-solid fa-circle-info"></i>
  <?= count($products_list) ?> produit(s) au total. Cliquez sur l'état pour basculer visibilité.
</p>
<?php endif; ?>
