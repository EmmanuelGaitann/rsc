<?php
// ⚠️ SCRIPT TEMPORAIRE — SUPPRIMER APRÈS UTILISATION
// Accessible uniquement sur localhost

if ($_SERVER['REMOTE_ADDR'] !== '127.0.0.1' && $_SERVER['REMOTE_ADDR'] !== '::1') {
    die('Accès refusé.');
}

define('BASEPATH', true);

// Mêmes réglages que application/config/database.php (poste local) :
// essaie MySQL 8 sur 3307 puis les configurations XAMPP classiques sur 3306.
$dbname   = 'sc2koga4651_rsc';
$attempts = [
    ['host' => '127.0.0.1', 'port' => 3307, 'user' => 'root', 'pass' => 'Emmanuel.01'],
    ['host' => '127.0.0.1', 'port' => 3306, 'user' => 'root', 'pass' => 'Emmanuel.01'],
    ['host' => '127.0.0.1', 'port' => 3306, 'user' => 'root', 'pass' => ''],
];

$message = '';
$type    = '';

$current_user = '';
$pdo = null;
foreach ($attempts as $a) {
    try {
        $pdo = new PDO(
            "mysql:host={$a['host']};port={$a['port']};dbname=$dbname;charset=utf8mb4",
            $a['user'], $a['pass'],
            [PDO::ATTR_TIMEOUT => 3, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        break;
    } catch (PDOException $e) { $pdo = null; }
}
if (!$pdo) {
    die('Connexion MySQL impossible — vérifiez que MySQL est démarré (port 3307 ou 3306).');
}
try {
    $row = $pdo->query("SELECT username FROM rsc_admin_users ORDER BY id LIMIT 1")->fetch(PDO::FETCH_OBJ);
    if ($row) $current_user = $row->username;
} catch (PDOException $e) {}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = trim($_POST['username'] ?? '');
    $new          = $_POST['password']  ?? '';
    $confirm      = $_POST['confirm']   ?? '';

    if ($new_username === '') {
        $message = 'Le nom d\'utilisateur ne peut pas être vide.';
        $type = 'error';
    } elseif (strlen($new) < 8) {
        $message = 'Le mot de passe doit contenir au moins 8 caractères.';
        $type = 'error';
    } elseif ($new !== $confirm) {
        $message = 'Les mots de passe ne correspondent pas.';
        $type = 'error';
    } else {
        try {
            $hash = password_hash($new, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("UPDATE rsc_admin_users SET username = ?, password = ? ORDER BY id LIMIT 1");
            $stmt->execute([$new_username, $hash]);
            $current_user = $new_username;
            $message = '✅ Identifiants mis à jour ! Connectez-vous avec <strong>' . htmlspecialchars($new_username) . '</strong>. <strong>Supprimez ce fichier.</strong>';
            $type = 'success';
        } catch (PDOException $e) {
            $message = 'Erreur base de données : ' . htmlspecialchars($e->getMessage());
            $type = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Réinitialiser le mot de passe admin</title>
<style>
  body { font-family: sans-serif; max-width: 420px; margin: 80px auto; padding: 0 1rem; }
  h2 { color: #0f172a; }
  label { display:block; margin-top:1rem; font-size:.9rem; font-weight:600; color:#374151; }
  input[type=password], input[type=text] { width:100%; padding:.55rem .75rem; border:1.5px solid #d1d5db; border-radius:6px; font-size:.95rem; margin-top:.3rem; box-sizing:border-box; }
  button { margin-top:1.5rem; width:100%; padding:.7rem; background:#2563eb; color:white; border:none; border-radius:7px; font-size:1rem; cursor:pointer; }
  button:hover { background:#1d4ed8; }
  .msg { padding:.8rem 1rem; border-radius:7px; margin-top:1rem; font-size:.9rem; }
  .success { background:#dcfce7; color:#166534; border:1px solid #86efac; }
  .error   { background:#fee2e2; color:#991b1b; border:1px solid #fca5a5; }
  .warn { background:#fef9c3; color:#92400e; border:1px solid #fde68a; padding:.7rem 1rem; border-radius:7px; font-size:.82rem; margin-bottom:1.5rem; }
</style>
</head>
<body>
<h2>🔑 Réinitialiser le mot de passe</h2>
<div class="warn">⚠️ Script temporaire — <strong>supprimez ce fichier</strong> après utilisation.</div>
<?php if ($message): ?>
<div class="msg <?= $type ?>"><?= $message ?></div>
<?php endif; ?>
<form method="POST">
  <label>Nom d'utilisateur actuel en base</label>
  <input type="text" value="<?= htmlspecialchars($current_user) ?>" disabled style="width:100%;padding:.55rem .75rem;border:1.5px solid #d1d5db;border-radius:6px;font-size:.95rem;margin-top:.3rem;box-sizing:border-box;background:#f3f4f6;color:#6b7280;">
  <label>Nouveau nom d'utilisateur</label>
  <input type="text" name="username" required autofocus placeholder="ex: admin" value="<?= htmlspecialchars($current_user) ?>">
  <label>Nouveau mot de passe</label>
  <input type="password" name="password" required minlength="8">
  <label>Confirmer le mot de passe</label>
  <input type="password" name="confirm" required minlength="8">
  <button type="submit">Mettre à jour les identifiants</button>
</form>
<p style="margin-top:1.5rem;font-size:.8rem;color:#9ca3af;">
  Après réinitialisation → <a href="http://localhost/RSC/admin/login">Aller au login</a> → puis supprimer <code>reset_password.php</code>
</p>
</body>
</html>
