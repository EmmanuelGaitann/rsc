<?php
$is_edit       = !empty($edit_user);
$is_pw_change  = !empty($change_password);
$current_admin = $this->session->userdata('admin_id');
?>
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title">
      <i class="fa-solid <?= $is_pw_change ? 'fa-key' : ($is_edit ? 'fa-user-pen' : 'fa-user-plus') ?> fa-fw"></i>
      <?php if ($is_pw_change): ?>
        Changer le mot de passe — <?= htmlspecialchars($edit_user->name) ?>
      <?php elseif ($is_edit): ?>
        Modifier l'utilisateur
      <?php else: ?>
        Nouvel utilisateur
      <?php endif; ?>
    </h1>
  </div>
  <a href="<?= base_url('admin/users') ?>" class="btn btn-outline">
    <i class="fa-solid fa-arrow-left"></i> Retour
  </a>
</div>

<?php if (!empty($error)): ?>
<div style="background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;padding:0.8rem 1rem;border-radius:8px;margin-bottom:1.5rem;">
  <i class="fa-solid fa-xmark"></i> <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<?php if ($is_pw_change): ?>
<!-- ===== Formulaire changement mot de passe ===== -->
<div class="editor-section" style="max-width:520px;">
  <h3 class="editor-section-title">Nouveau mot de passe pour « <?= htmlspecialchars($edit_user->name) ?> »</h3>
  <form method="post" action="<?= base_url('admin/user_do_set_password/' . $edit_user->id) ?>">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
    <div class="form-group">
      <label class="form-label">Nouveau mot de passe <span style="color:#ef4444;">*</span></label>
      <input type="password" name="new_password" class="form-control" minlength="8" required
             placeholder="8 caractères minimum">
    </div>
    <div class="form-group">
      <label class="form-label">Confirmer le mot de passe <span style="color:#ef4444;">*</span></label>
      <input type="password" name="confirm_password" class="form-control" minlength="8" required>
    </div>
    <div style="display:flex;gap:1rem;margin-top:1.5rem;">
      <button type="submit" class="btn btn-primary">
        <i class="fa-solid fa-check"></i> Enregistrer
      </button>
      <a href="<?= base_url('admin/users') ?>" class="btn btn-outline">Annuler</a>
    </div>
  </form>
</div>

<?php else: ?>
<!-- ===== Formulaire création / édition ===== -->
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;max-width:900px;">

  <div class="editor-section">
    <h3 class="editor-section-title">Informations</h3>
    <form method="post"
          action="<?= $is_edit ? base_url('admin/user_do_edit/' . $edit_user->id) : base_url('admin/user_do_new') ?>">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

      <div class="form-group">
        <label class="form-label">Nom complet <span style="color:#ef4444;">*</span></label>
        <input type="text" name="name" class="form-control" required
               value="<?= $is_edit ? htmlspecialchars($edit_user->name) : '' ?>"
               placeholder="Ex : Marie Dupont">
      </div>

      <?php if (!$is_edit): ?>
      <div class="form-group">
        <label class="form-label">Identifiant (login) <span style="color:#ef4444;">*</span></label>
        <input type="text" name="username" class="form-control" required
               placeholder="Ex : marie.dupont"
               pattern="[a-zA-Z0-9._\-]+"
               title="Lettres, chiffres, point, tiret et underscore uniquement">
        <small style="color:#94a3b8;font-size:0.75rem;">Impossible à modifier après création.</small>
      </div>
      <?php else: ?>
      <div class="form-group">
        <label class="form-label">Identifiant</label>
        <input type="text" class="form-control" value="<?= htmlspecialchars($edit_user->username) ?>" disabled
               style="background:#f8fafc;color:#94a3b8;">
        <small style="color:#94a3b8;font-size:0.75rem;">Non modifiable.</small>
      </div>
      <?php endif; ?>

      <div class="form-group">
        <label class="form-label">Rôle <span style="color:#ef4444;">*</span></label>
        <select name="role" class="form-control"
                <?= ($is_edit && $edit_user->id == $current_admin) ? 'disabled title="Vous ne pouvez pas modifier votre propre rôle."' : '' ?>>
          <option value="editor" <?= ($is_edit && $edit_user->role === 'editor') ? 'selected' : '' ?>>
            Éditeur — CMS uniquement
          </option>
          <option value="super"  <?= ($is_edit && $edit_user->role === 'super')  ? 'selected' : '' ?>>
            Super Admin — accès complet
          </option>
        </select>
        <?php if ($is_edit && $edit_user->id == $current_admin): ?>
        <input type="hidden" name="role" value="<?= htmlspecialchars($edit_user->role) ?>">
        <small style="color:#f59e0b;font-size:0.75rem;"><i class="fa-solid fa-triangle-exclamation"></i> Vous ne pouvez pas modifier votre propre rôle.</small>
        <?php endif; ?>
      </div>

      <?php if (!$is_edit): ?>
      <div class="form-group">
        <label class="form-label">Mot de passe <span style="color:#ef4444;">*</span></label>
        <input type="password" name="password" class="form-control" minlength="8" required
               placeholder="8 caractères minimum">
      </div>
      <div class="form-group">
        <label class="form-label">Confirmer <span style="color:#ef4444;">*</span></label>
        <input type="password" name="confirm" class="form-control" minlength="8" required>
      </div>
      <?php endif; ?>

      <div style="display:flex;gap:1rem;margin-top:1.5rem;">
        <button type="submit" class="btn btn-primary">
          <i class="fa-solid fa-check"></i>
          <?= $is_edit ? 'Mettre à jour' : 'Créer l\'utilisateur' ?>
        </button>
        <a href="<?= base_url('admin/users') ?>" class="btn btn-outline">Annuler</a>
      </div>
    </form>
  </div>

  <?php if ($is_edit): ?>
  <div class="editor-section">
    <h3 class="editor-section-title">Changer le mot de passe</h3>
    <p style="color:#64748b;font-size:0.85rem;margin-bottom:1rem;">
      En tant que Super Admin, vous pouvez forcer un nouveau mot de passe sans connaître l'ancien.
    </p>
    <a href="<?= base_url('admin/user_set_password/' . $edit_user->id) ?>"
       class="btn btn-outline" style="width:100%;text-align:center;">
      <i class="fa-solid fa-key"></i> Définir un nouveau mot de passe
    </a>

    <?php if ($edit_user->id != $current_admin): ?>
    <div style="margin-top:2rem;padding-top:1.5rem;border-top:1px solid var(--border);">
      <h4 style="color:#dc2626;font-size:0.9rem;margin-bottom:0.5rem;">Zone dangereuse</h4>
      <form method="post" action="<?= base_url('admin/user_delete/' . $edit_user->id) ?>" style="display:inline" onsubmit="return confirm('Supprimer définitivement « <?= htmlspecialchars(addslashes($edit_user->name)) ?> » ?')">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
        <button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;cursor:pointer;">
          <i class="fa-solid fa-trash"></i> Supprimer cet utilisateur
        </button>
      </form>
    </div>
    <?php endif; ?>
  </div>
  <?php endif; ?>

</div>
<?php endif; ?>
