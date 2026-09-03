<div class="page-editor-header">
  <div>
    <div class="page-editor-breadcrumb">
      <a href="<?= base_url('admin') ?>">Tableau de bord</a>
      <i class="fa-solid fa-chevron-right"></i>
      <span>Mot de passe</span>
    </div>
    <h1><i class="fa-solid fa-lock"></i> Changer le mot de passe</h1>
  </div>
</div>

<?php if (!empty($success)): ?>
<div class="alert alert-success"><i class="fa-solid fa-check-circle"></i> <?= htmlspecialchars($success) ?></div>
<?php endif; ?>
<?php if (!empty($error)): ?>
<div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation"></i> <?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="admin-card" style="max-width:480px;">
  <div class="admin-card-title">Modifier mes identifiants</div>
  <form action="<?= base_url('admin/save_password') ?>" method="POST">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
    <div class="editor-field">
      <label class="field-label">Mot de passe actuel</label>
      <input type="password" class="field-input" name="current_password" placeholder="••••••••" required>
    </div>
    <div class="editor-field">
      <label class="field-label">Nouveau mot de passe <small style="font-weight:400;color:#94a3b8;">(8 caractères min.)</small></label>
      <input type="password" class="field-input" name="new_password" placeholder="••••••••" required minlength="8">
    </div>
    <div class="editor-field">
      <label class="field-label">Confirmer le nouveau mot de passe</label>
      <input type="password" class="field-input" name="confirm_password" placeholder="••••••••" required>
    </div>
    <div style="margin-top:1.5rem;">
      <button type="submit" class="btn btn-primary">
        <i class="fa-solid fa-floppy-disk"></i> Enregistrer
      </button>
    </div>
  </form>
</div>
