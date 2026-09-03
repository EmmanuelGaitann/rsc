<?php
/* ================================================================
   Journal d'audit — vue admin
   ================================================================ */

/* Libellés lisibles par action */
$action_labels = [
    'login'                => ['Connexion',            'login',   'fa-right-to-bracket'],
    'logout'               => ['Déconnexion',           'logout',  'fa-right-from-bracket'],
    'login_failed'         => ['Échec connexion',       'login_failed', 'fa-triangle-exclamation'],
    'content_saved'        => ['Contenu sauvegardé',    'saved',   'fa-floppy-disk'],
    'inline_save'          => ['Modif. inline',         'saved',   'fa-pen'],
    'toggle_section'       => ['Section basculée',      'toggled', 'fa-eye'],
    'media_uploaded'       => ['Média téléversé',       'created', 'fa-upload'],
    'media_deleted'        => ['Média supprimé',        'deleted', 'fa-trash'],
    'gallery_added'        => ['Photo galerie ajoutée', 'created', 'fa-image'],
    'gallery_updated'      => ['Photo galerie modifiée','updated', 'fa-image'],
    'gallery_deleted'      => ['Photo galerie supprimée','deleted','fa-image'],
    'gallery_toggled'      => ['Galerie basculée',      'toggled', 'fa-eye'],
    'password_changed'     => ['Mot de passe changé',  'updated', 'fa-lock'],
    'page_created'         => ['Page créée',            'created', 'fa-file-circle-plus'],
    'page_updated'         => ['Page modifiée',         'updated', 'fa-file-pen'],
    'page_deleted'         => ['Page supprimée',        'deleted', 'fa-file-circle-xmark'],
    'product_created'      => ['Produit ajouté',        'created', 'fa-box'],
    'product_updated'      => ['Produit modifié',       'updated', 'fa-box'],
    'product_deleted'      => ['Produit supprimé',      'deleted', 'fa-box'],
    'product_toggled'      => ['Produit basculé',       'toggled', 'fa-eye'],
    'brand_created'        => ['Fabricant ajouté',      'created', 'fa-industry'],
    'brand_updated'        => ['Fabricant modifié',     'updated', 'fa-industry'],
    'brand_deleted'        => ['Fabricant supprimé',    'deleted', 'fa-industry'],
    'category_created'     => ['Catégorie ajoutée',     'created', 'fa-tag'],
    'category_updated'     => ['Catégorie modifiée',    'updated', 'fa-tag'],
    'category_deleted'     => ['Catégorie supprimée',   'deleted', 'fa-tag'],
    'user_created'         => ['Utilisateur créé',      'created', 'fa-user-plus'],
    'user_updated'         => ['Utilisateur modifié',   'updated', 'fa-user-pen'],
    'user_deleted'         => ['Utilisateur supprimé',  'deleted', 'fa-user-minus'],
    'user_password_changed'=> ['MDP utilisateur changé','updated','fa-key'],
];

$total_pages = max(1, ceil($total / $per_page));

/* URL helper */
function audit_url($p, $fa = null, $aa = null) {
    $q = [];
    if ($p > 1)  $q['p'] = $p;
    if ($fa)     $q['action'] = $fa;
    if ($aa > 0) $q['admin']  = $aa;
    return base_url('admin/audit') . ($q ? '?' . http_build_query($q) : '');
}
?>

<div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem;">
  <div>
    <h1 style="font-size:1.4rem;font-weight:700;display:flex;align-items:center;gap:.5rem;">
      <i class="fa-solid fa-clock-rotate-left" style="color:var(--primary);"></i> Journal d'audit
    </h1>
    <p style="color:var(--text-2);font-size:.875rem;margin-top:.2rem;">
      <?= number_format($total) ?> événement<?= $total > 1 ? 's' : '' ?> enregistré<?= $total > 1 ? 's' : '' ?>
    </p>
  </div>
  <a href="<?= base_url('admin/audit') ?>" class="btn btn-outline btn-sm">
    <i class="fa-solid fa-rotate-left"></i> Réinitialiser les filtres
  </a>
</div>

<!-- Filtres -->
<div class="admin-card" style="margin-bottom:1.25rem;padding:1rem 1.25rem;">
  <form method="get" action="<?= base_url('admin/audit') ?>" style="display:flex;gap:.75rem;flex-wrap:wrap;align-items:flex-end;">
    <div>
      <label style="display:block;font-size:.75rem;font-weight:600;color:var(--text-2);margin-bottom:.3rem;">Action</label>
      <select name="action" class="field-input" style="min-width:200px;padding:.45rem .75rem;">
        <option value="">— Toutes les actions —</option>
        <?php foreach ($action_labels as $code => $info): ?>
        <option value="<?= $code ?>" <?= ($filter_action === $code) ? 'selected' : '' ?>><?= htmlspecialchars($info[0]) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <?php if (!empty($admins)): ?>
    <div>
      <label style="display:block;font-size:.75rem;font-weight:600;color:var(--text-2);margin-bottom:.3rem;">Administrateur</label>
      <select name="admin" class="field-input" style="min-width:160px;padding:.45rem .75rem;">
        <option value="0">— Tous —</option>
        <?php foreach ($admins as $adm): ?>
        <option value="<?= $adm->id ?>" <?= ($filter_admin === (int)$adm->id) ? 'selected' : '' ?>>
          <?= htmlspecialchars($adm->name) ?>
        </option>
        <?php endforeach; ?>
      </select>
    </div>
    <?php endif; ?>
    <button type="submit" class="btn btn-primary btn-sm">
      <i class="fa-solid fa-filter"></i> Filtrer
    </button>
  </form>
</div>

<!-- Tableau -->
<div class="admin-card" style="padding:0;overflow:hidden;">
  <?php if (empty($logs)): ?>
  <div style="padding:3rem;text-align:center;color:var(--text-2);">
    <i class="fa-solid fa-inbox" style="font-size:2rem;margin-bottom:.75rem;display:block;"></i>
    Aucun événement trouvé.
  </div>
  <?php else: ?>
  <div style="overflow-x:auto;">
    <table class="audit-table">
      <thead>
        <tr>
          <th>Date / Heure</th>
          <th>Administrateur</th>
          <th>Action</th>
          <th>Entité</th>
          <th>Détails</th>
          <th>IP</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($logs as $log):
          $ainfo = isset($action_labels[$log->action]) ? $action_labels[$log->action] : [$log->action, 'other', 'fa-circle-dot'];
          $badge_class = 'audit-badge-' . $ainfo[1];
        ?>
        <tr>
          <td class="td-date">
            <?php
              $ts = strtotime($log->created_at);
              echo date('d/m/Y', $ts) . '<br><span style="font-size:.72rem;">' . date('H:i:s', $ts) . '</span>';
            ?>
          </td>
          <td class="td-who">
            <?php if ($log->admin_name): ?>
            <i class="fa-solid fa-circle-user" style="color:var(--text-2);margin-right:.3rem;font-size:.75rem;"></i>
            <?= htmlspecialchars($log->admin_name) ?>
            <?php else: ?>
            <span style="color:var(--text-2);font-style:italic;">inconnu</span>
            <?php endif; ?>
          </td>
          <td>
            <span class="audit-badge <?= $badge_class ?>">
              <i class="fa-solid <?= $ainfo[2] ?>"></i>
              <?= htmlspecialchars($ainfo[0]) ?>
            </span>
          </td>
          <td>
            <?php if ($log->entity_label || $log->entity_type): ?>
            <span style="font-size:.8rem;">
              <?php if ($log->entity_type): ?>
              <span style="color:var(--text-2);font-size:.72rem;text-transform:uppercase;letter-spacing:.05em;"><?= htmlspecialchars($log->entity_type) ?></span>
              <?php endif; ?>
              <?php if ($log->entity_label): ?>
              <br><strong><?= htmlspecialchars($log->entity_label) ?></strong>
              <?php endif; ?>
              <?php if ($log->entity_id): ?>
              <span style="color:var(--text-2);font-size:.7rem;"> #<?= htmlspecialchars($log->entity_id) ?></span>
              <?php endif; ?>
            </span>
            <?php else: ?>
            <span style="color:var(--text-2);">—</span>
            <?php endif; ?>
          </td>
          <td class="td-detail" title="<?= $log->details ? htmlspecialchars($log->details) : '' ?>">
            <?php if ($log->details && $log->details !== 'null'):
              $d = json_decode($log->details, true);
              if (is_array($d)) {
                $parts = [];
                foreach ($d as $k => $v) $parts[] = $k . ':' . (is_array($v) ? json_encode($v) : $v);
                echo htmlspecialchars(implode(', ', $parts));
              } else {
                echo htmlspecialchars($log->details);
              }
            else: ?>
            <span style="color:var(--text-2);">—</span>
            <?php endif; ?>
          </td>
          <td style="font-size:.75rem;color:var(--text-2);white-space:nowrap;">
            <?= htmlspecialchars($log->ip_address ?: '—') ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php endif; ?>
</div>

<!-- Pagination -->
<?php if ($total_pages > 1): ?>
<div class="audit-pagination">
  <?php if ($page > 1): ?>
  <a href="<?= audit_url($page - 1, $filter_action, $filter_admin) ?>" class="btn btn-outline btn-sm">
    <i class="fa-solid fa-chevron-left"></i> Précédent
  </a>
  <?php endif; ?>

  <?php
    $range = 2;
    $start = max(1, $page - $range);
    $end   = min($total_pages, $page + $range);
    if ($start > 1) echo '<span style="color:var(--text-2);padding:0 .25rem;">…</span>';
    for ($i = $start; $i <= $end; $i++):
      $active = ($i === $page) ? 'background:var(--primary);color:#fff;border-color:var(--primary);' : '';
  ?>
  <a href="<?= audit_url($i, $filter_action, $filter_admin) ?>"
     class="btn btn-outline btn-sm" style="<?= $active ?>min-width:36px;text-align:center;">
    <?= $i ?>
  </a>
  <?php endfor;
    if ($end < $total_pages) echo '<span style="color:var(--text-2);padding:0 .25rem;">…</span>';
  ?>

  <?php if ($page < $total_pages): ?>
  <a href="<?= audit_url($page + 1, $filter_action, $filter_admin) ?>" class="btn btn-outline btn-sm">
    Suivant <i class="fa-solid fa-chevron-right"></i>
  </a>
  <?php endif; ?>

  <span style="color:var(--text-2);font-size:.8rem;margin-left:.5rem;">
    Page <?= $page ?> / <?= $total_pages ?>
    (<?= number_format($total) ?> événements)
  </span>
</div>
<?php endif; ?>
