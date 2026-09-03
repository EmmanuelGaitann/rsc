<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title"><i class="fa-solid fa-file-lines fa-fw"></i> Pages personnalisées</h1>
    <p class="admin-page-subtitle">Créez et gérez des pages libres accessibles sur le site.</p>
  </div>
  <a href="<?= base_url('admin/pages/new') ?>" class="btn btn-primary">
    <i class="fa-solid fa-plus"></i> Nouvelle page
  </a>
</div>

<?php if (!empty($success)): ?>
<div class="alert alert-success" style="margin-bottom:1.5rem;padding:0.8rem 1rem;border-radius:8px;background:#dcfce7;color:#15803d;border:1px solid #86efac;">
  <i class="fa-solid fa-check"></i> <?= htmlspecialchars($success) ?>
</div>
<?php endif; ?>

<?php if (!empty($error)): ?>
<div class="alert alert-error" style="margin-bottom:1.5rem;padding:0.8rem 1rem;border-radius:8px;background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;">
  <i class="fa-solid fa-xmark"></i> <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<?php if (empty($pages_list)): ?>
<div style="text-align:center;padding:3rem;background:var(--light);border-radius:12px;color:var(--gray);">
  <i class="fa-solid fa-file-circle-plus" style="font-size:2.5rem;margin-bottom:1rem;display:block;color:#94a3b8;"></i>
  <p>Aucune page personnalisée pour l'instant.</p>
  <a href="<?= base_url('admin/pages/new') ?>" class="btn btn-primary" style="margin-top:1rem;">
    Créer ma première page
  </a>
</div>
<?php else: ?>
<div class="admin-table-wrap" style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);overflow:hidden;">
  <table style="width:100%;border-collapse:collapse;">
    <thead>
      <tr style="background:#f8fafc;border-bottom:1px solid #e2e8f0;">
        <th style="padding:0.75rem 1rem;text-align:left;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Titre</th>
        <th style="padding:0.75rem 1rem;text-align:left;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Slug / URL</th>
        <th style="padding:0.75rem 1rem;text-align:left;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">État</th>
        <th style="padding:0.75rem 1rem;text-align:left;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Nav</th>
        <th style="padding:0.75rem 1rem;text-align:right;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pages_list as $pg): ?>
      <tr style="border-bottom:1px solid #f1f5f9;">
        <td style="padding:0.85rem 1rem;font-weight:600;color:#0f172a;"><?= htmlspecialchars($pg->title) ?></td>
        <td style="padding:0.85rem 1rem;">
          <a href="<?= base_url('p/' . $pg->slug) ?>" target="_blank" style="color:#2563eb;font-size:0.85rem;">
            /p/<?= htmlspecialchars($pg->slug) ?> <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:0.7rem;"></i>
          </a>
        </td>
        <td style="padding:0.85rem 1rem;">
          <?php if ($pg->visible): ?>
          <span style="background:#dcfce7;color:#16a34a;padding:0.2rem 0.6rem;border-radius:20px;font-size:0.75rem;font-weight:600;">Visible</span>
          <?php else: ?>
          <span style="background:#f1f5f9;color:#94a3b8;padding:0.2rem 0.6rem;border-radius:20px;font-size:0.75rem;font-weight:600;">Masquée</span>
          <?php endif; ?>
        </td>
        <td style="padding:0.85rem 1rem;">
          <?php if ($pg->show_in_nav): ?>
          <span style="background:#dbeafe;color:#2563eb;padding:0.2rem 0.6rem;border-radius:20px;font-size:0.75rem;font-weight:600;">Dans nav</span>
          <?php else: ?>
          <span style="color:#94a3b8;font-size:0.82rem;">—</span>
          <?php endif; ?>
        </td>
        <td style="padding:0.85rem 1rem;text-align:right;">
          <a href="<?= base_url('admin/pages/edit/' . $pg->id) ?>" class="btn btn-outline btn-sm" style="margin-right:0.5rem;">
            <i class="fa-solid fa-pencil"></i> Modifier
          </a>
          <a href="<?= base_url('admin/pages/delete/' . $pg->id) ?>"
             class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;"
             onclick="return confirm('Supprimer cette page définitivement ?')">
            <i class="fa-solid fa-trash"></i>
          </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php endif; ?>
