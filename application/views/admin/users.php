<?php
$current_id = $this->session->userdata('admin_id');
?>
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title">
      <i class="fa-solid fa-users-gear fa-fw"></i> Gestion des utilisateurs
    </h1>
    <p class="admin-page-subtitle">Comptes administrateurs et leurs rôles.</p>
  </div>
  <a href="<?= base_url('admin/user_new') ?>" class="btn btn-primary">
    <i class="fa-solid fa-plus"></i> Nouvel utilisateur
  </a>
</div>

<?php if (!empty($success)): ?>
<div style="background:#dcfce7;color:#16a34a;border:1px solid #86efac;padding:0.8rem 1rem;border-radius:8px;margin-bottom:1.5rem;">
  <i class="fa-solid fa-check"></i> <?= htmlspecialchars($success) ?>
</div>
<?php endif; ?>

<?php if (!empty($error)): ?>
<div style="background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;padding:0.8rem 1rem;border-radius:8px;margin-bottom:1.5rem;">
  <i class="fa-solid fa-xmark"></i> <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<div class="editor-section">
  <table style="width:100%;border-collapse:collapse;">
    <thead>
      <tr style="border-bottom:2px solid var(--border);text-align:left;">
        <th style="padding:0.75rem 1rem;color:#64748b;font-weight:600;font-size:0.82rem;">ID</th>
        <th style="padding:0.75rem 1rem;color:#64748b;font-weight:600;font-size:0.82rem;">Nom</th>
        <th style="padding:0.75rem 1rem;color:#64748b;font-weight:600;font-size:0.82rem;">Identifiant</th>
        <th style="padding:0.75rem 1rem;color:#64748b;font-weight:600;font-size:0.82rem;">Rôle</th>
        <th style="padding:0.75rem 1rem;color:#64748b;font-weight:600;font-size:0.82rem;">Créé le</th>
        <th style="padding:0.75rem 1rem;color:#64748b;font-weight:600;font-size:0.82rem;">Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $u): ?>
    <tr style="border-bottom:1px solid var(--border);<?= ($u->id == $current_id) ? 'background:#f8fafc;' : '' ?>">
      <td style="padding:0.85rem 1rem;color:#94a3b8;font-size:0.85rem;"><?= $u->id ?></td>
      <td style="padding:0.85rem 1rem;font-weight:500;">
        <?= htmlspecialchars($u->name) ?>
        <?php if ($u->id == $current_id): ?>
          <span style="font-size:0.72rem;background:#dbeafe;color:#1d4ed8;padding:0.1rem 0.5rem;border-radius:99px;margin-left:0.4rem;">vous</span>
        <?php endif; ?>
      </td>
      <td style="padding:0.85rem 1rem;font-family:monospace;font-size:0.9rem;"><?= htmlspecialchars($u->username) ?></td>
      <td style="padding:0.85rem 1rem;">
        <?php if ($u->role === 'super'): ?>
          <span style="background:#fef3c7;color:#92400e;padding:0.2rem 0.7rem;border-radius:99px;font-size:0.78rem;font-weight:600;">
            <i class="fa-solid fa-crown"></i> Super Admin
          </span>
        <?php else: ?>
          <span style="background:#f1f5f9;color:#475569;padding:0.2rem 0.7rem;border-radius:99px;font-size:0.78rem;font-weight:600;">
            <i class="fa-solid fa-pen-to-square"></i> Éditeur
          </span>
        <?php endif; ?>
      </td>
      <td style="padding:0.85rem 1rem;color:#64748b;font-size:0.85rem;">
        <?= date('d/m/Y', strtotime($u->created_at)) ?>
      </td>
      <td style="padding:0.85rem 1rem;">
        <div style="display:flex;gap:0.5rem;flex-wrap:wrap;">
          <a href="<?= base_url('admin/user_edit/' . $u->id) ?>" class="btn btn-outline btn-sm">
            <i class="fa-solid fa-pencil"></i> Modifier
          </a>
          <a href="<?= base_url('admin/user_set_password/' . $u->id) ?>" class="btn btn-outline btn-sm">
            <i class="fa-solid fa-key"></i> MDP
          </a>
          <?php if ($u->id != $current_id): ?>
          <a href="<?= base_url('admin/user_delete/' . $u->id) ?>" class="btn btn-sm"
             style="background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;"
             onclick="return confirm('Supprimer l\'utilisateur « <?= htmlspecialchars(addslashes($u->name)) ?> » ? Cette action est irréversible.')">
            <i class="fa-solid fa-trash"></i>
          </a>
          <?php endif; ?>
        </div>
      </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>

<div style="margin-top:1.5rem;padding:1rem;background:#fef9c3;border:1px solid #fde047;border-radius:8px;font-size:0.85rem;color:#713f12;">
  <i class="fa-solid fa-circle-info"></i>
  <strong>Super Admin</strong> — accès complet : CMS, catalogue, galerie, pages, médias, gestion des utilisateurs.<br>
  <strong>Éditeur</strong> — accès CMS uniquement : peut modifier les textes, images, produits et galerie. Ne peut pas gérer les utilisateurs ni modifier les paramètres système.
</div>
