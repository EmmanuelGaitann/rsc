<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Connexion — Administration RSC</title>
  <link rel="stylesheet" href="<?= base_url('assets/admin/admin.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>">
</head>
<body class="admin-login-page">

<div class="login-card">
  <div class="login-logo">
    <img src="<?= base_url('assets/logo/RSC_logo.png') ?>" alt="RSC" onerror="this.style.display='none'">
    <h2>Royal Sales Cameroon</h2>
    <p>Espace d'administration</p>
  </div>

  <?php if ($this->session->flashdata('login_success')): ?>
  <div class="login-success">
    <i class="fa-solid fa-check-circle"></i>
    <?= htmlspecialchars($this->session->flashdata('login_success')) ?>
  </div>
  <?php endif; ?>

  <?php if (!empty($error)): ?>
  <div class="login-error">
    <i class="fa-solid fa-triangle-exclamation"></i>
    <?= htmlspecialchars($error) ?>
  </div>
  <?php endif; ?>

  <form action="<?= base_url('admin/do_login') ?>" method="POST">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
    <div class="login-field">
      <label for="username"><i class="fa-solid fa-user"></i> Identifiant</label>
      <input type="text" id="username" name="username" placeholder="Votre identifiant" required autofocus>
    </div>
    <div class="login-field">
      <label for="password"><i class="fa-solid fa-lock"></i> Mot de passe</label>
      <div style="position:relative;">
        <input type="password" id="password" name="password" placeholder="••••••••" required>
        <button type="button" class="pw-toggle" onclick="togglePw()" title="Afficher/masquer">
          <i class="fa-solid fa-eye" id="pw-icon"></i>
        </button>
      </div>
    </div>
    <button type="submit" class="login-btn">
      <i class="fa-solid fa-arrow-right-to-bracket"></i> Se connecter
    </button>
  </form>

  <p style="text-align:center;margin-top:1.5rem;font-size:.8rem;color:#94a3b8;">
    <a href="<?= base_url() ?>" style="color:#94a3b8;">← Retour au site</a>
  </p>
</div>

<script>
function togglePw() {
  const input = document.getElementById('password');
  const icon  = document.getElementById('pw-icon');
  if (input.type === 'password') {
    input.type = 'text';
    icon.className = 'fa-solid fa-eye-slash';
  } else {
    input.type = 'password';
    icon.className = 'fa-solid fa-eye';
  }
}
</script>
</body>
</html>
