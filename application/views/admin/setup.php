<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Configuration initiale — RSC Admin</title>
  <link rel="stylesheet" href="<?= base_url('assets/admin/admin.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>">
</head>
<body class="admin-login-page">

<div class="login-card" style="max-width:460px;">
  <div class="login-logo">
    <img src="<?= base_url('assets/logo/RSC_logo.png') ?>" alt="RSC" onerror="this.style.display='none'">
    <h2>Configuration initiale</h2>
    <p>Créez le compte administrateur du site</p>
  </div>

  <?php if (!empty($error)): ?>
  <div class="login-error">
    <i class="fa-solid fa-triangle-exclamation"></i>
    <?= htmlspecialchars($error) ?>
  </div>
  <?php endif; ?>

  <form action="<?= base_url('admin/do_setup') ?>" method="POST">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
    <div class="login-field">
      <label>Votre prénom et nom</label>
      <input type="text" name="name" placeholder="Ex : Jean Dupont" required>
    </div>
    <div class="login-field">
      <label>Identifiant de connexion</label>
      <input type="text" name="username" placeholder="Ex : admin" required>
    </div>
    <div class="login-field">
      <label>Mot de passe <small style="font-weight:400;color:#94a3b8;">(8 caractères minimum)</small></label>
      <input type="password" name="password" placeholder="••••••••" required minlength="8">
    </div>
    <div class="login-field">
      <label>Confirmer le mot de passe</label>
      <input type="password" name="confirm" placeholder="••••••••" required>
    </div>
    <button type="submit" class="login-btn">
      <i class="fa-solid fa-user-plus"></i> Créer le compte et accéder au panneau
    </button>
  </form>

  <div style="background:#fef9c3;border:1px solid #fde047;border-radius:8px;padding:.9rem 1rem;margin-top:1.25rem;font-size:.82rem;color:#713f12;">
    <strong><i class="fa-solid fa-shield-halved"></i> Sécurité :</strong>
    Cette page n'est accessible qu'une seule fois — elle sera automatiquement désactivée après création du compte.
  </div>
</div>
</body>
</html>
