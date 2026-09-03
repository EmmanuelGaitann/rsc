<?php
$csrf_name = $this->security->get_csrf_token_name();
$csrf_hash = $this->security->get_csrf_hash();
$pages_tot = max(1, (int)ceil($total / $per_page));
?>
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title"><i class="fa-solid fa-language fa-fw"></i> Traductions (FR → EN)</h1>
    <p class="admin-page-subtitle">
      Tout le site est traduit automatiquement en anglais. Les textes ajoutés ou modifiés dans l'admin
      sont traduits dès leur premier affichage en anglais. Vous pouvez corriger chaque traduction ici :
      une correction manuelle n'est jamais écrasée par la traduction automatique.
    </p>
  </div>
  <form method="post" action="<?= base_url('admin/translations_run') ?>">
    <input type="hidden" name="<?= $csrf_name ?>" value="<?= $csrf_hash ?>">
    <button type="submit" class="btn btn-primary">
      <i class="fa-solid fa-wand-magic-sparkles"></i> Traduire les textes en attente
    </button>
  </form>
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

<!-- Statistiques -->
<div style="display:flex;gap:1rem;flex-wrap:wrap;margin-bottom:1.5rem;">
  <?php
  $chips = [
    ['label' => 'Textes connus',        'value' => $stats['total'],   'color' => '#0f172a', 'bg' => '#f1f5f9'],
    ['label' => 'Traduits (auto)',      'value' => $stats['auto'],    'color' => '#1d4ed8', 'bg' => '#dbeafe'],
    ['label' => 'Validés (manuel)',     'value' => $stats['manual'],  'color' => '#15803d', 'bg' => '#dcfce7'],
    ['label' => 'En attente',           'value' => $stats['pending'], 'color' => '#b45309', 'bg' => '#fef3c7'],
  ];
  foreach ($chips as $chip): ?>
  <div style="background:<?= $chip['bg'] ?>;border-radius:10px;padding:0.7rem 1.2rem;min-width:130px;">
    <div style="font-size:1.4rem;font-weight:800;color:<?= $chip['color'] ?>;"><?= (int)$chip['value'] ?></div>
    <div style="font-size:0.72rem;text-transform:uppercase;letter-spacing:0.05em;color:#64748b;"><?= $chip['label'] ?></div>
  </div>
  <?php endforeach; ?>
</div>

<!-- Filtres -->
<form method="get" action="<?= base_url('admin/translations') ?>"
      style="display:flex;gap:0.6rem;flex-wrap:wrap;align-items:center;margin-bottom:1.2rem;">
  <input type="text" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Rechercher un texte…"
         style="flex:1;min-width:220px;padding:0.55rem 0.8rem;border:1.5px solid #e2e8f0;border-radius:8px;font-size:0.9rem;">
  <select name="status" style="padding:0.55rem 0.8rem;border:1.5px solid #e2e8f0;border-radius:8px;font-size:0.9rem;">
    <option value="">Tous les statuts</option>
    <option value="auto"    <?= $status === 'auto' ? 'selected' : '' ?>>Auto</option>
    <option value="manual"  <?= $status === 'manual' ? 'selected' : '' ?>>Manuel (validé)</option>
    <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>En attente</option>
  </select>
  <button type="submit" class="btn btn-outline"><i class="fa-solid fa-filter"></i> Filtrer</button>
  <?php if ($q !== '' || $status !== ''): ?>
  <a href="<?= base_url('admin/translations') ?>" class="btn btn-outline btn-sm">Réinitialiser</a>
  <?php endif; ?>
</form>

<?php if (empty($rows)): ?>
<div style="text-align:center;padding:3rem;background:var(--light);border-radius:12px;color:var(--gray);">
  <i class="fa-solid fa-language" style="font-size:2.5rem;margin-bottom:1rem;display:block;color:#94a3b8;"></i>
  <p>Aucune entrée pour l'instant.</p>
  <p style="font-size:0.85rem;margin-top:0.5rem;">Les textes apparaissent ici dès que le site est visité en anglais
    (bouton <strong>EN</strong> sur le site).</p>
</div>
<?php else: ?>

<div style="display:flex;flex-direction:column;gap:0.8rem;">
  <?php foreach ($rows as $r):
    $is_pending = ($r->translated_text === null || $r->translated_text === '');
    if ($is_pending)            { $badge = ['En attente', '#b45309', '#fef3c7']; }
    elseif ($r->status === 'manual') { $badge = ['Validé manuel', '#15803d', '#dcfce7']; }
    else                        { $badge = ['Auto', '#1d4ed8', '#dbeafe']; }
  ?>
  <div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);padding:1rem 1.2rem;">
    <div style="display:flex;justify-content:space-between;gap:1rem;align-items:flex-start;flex-wrap:wrap;">
      <div style="flex:1;min-width:260px;">
        <div style="font-size:0.68rem;text-transform:uppercase;letter-spacing:0.06em;color:#94a3b8;margin-bottom:0.25rem;">
          Texte original (français)
        </div>
        <div style="font-size:0.9rem;color:#0f172a;line-height:1.5;max-height:110px;overflow:auto;">
          <?= htmlspecialchars($r->source_text) ?>
        </div>
      </div>
      <div style="display:flex;align-items:center;gap:0.6rem;">
        <span style="background:<?= $badge[2] ?>;color:<?= $badge[1] ?>;padding:0.2rem 0.7rem;border-radius:20px;font-size:0.7rem;font-weight:700;">
          <?= $badge[0] ?>
        </span>
        <form method="post" action="<?= base_url('admin/translation_delete/' . $r->id) ?>"
              onsubmit="return confirm('Supprimer cette entrée ?\nElle sera retraduite automatiquement au prochain affichage en anglais.')">
          <input type="hidden" name="<?= $csrf_name ?>" value="<?= $csrf_hash ?>">
          <button type="submit" class="btn btn-outline btn-sm" title="Supprimer (sera retraduite)">
            <i class="fa-solid fa-rotate"></i>
          </button>
        </form>
      </div>
    </div>

    <form method="post" action="<?= base_url('admin/translation_save') ?>"
          style="display:flex;gap:0.6rem;margin-top:0.7rem;align-items:flex-start;flex-wrap:wrap;">
      <input type="hidden" name="<?= $csrf_name ?>" value="<?= $csrf_hash ?>">
      <input type="hidden" name="id" value="<?= (int)$r->id ?>">
      <input type="hidden" name="back_q" value="<?= htmlspecialchars($q) ?>">
      <input type="hidden" name="back_status" value="<?= htmlspecialchars($status) ?>">
      <input type="hidden" name="back_p" value="<?= (int)$page ?>">
      <textarea name="translated_text" rows="2" placeholder="Traduction anglaise… (vide = retraduire automatiquement)"
                style="flex:1;min-width:260px;padding:0.55rem 0.8rem;border:1.5px solid #e2e8f0;border-radius:8px;font-size:0.9rem;font-family:inherit;resize:vertical;"><?= htmlspecialchars((string)$r->translated_text) ?></textarea>
      <button type="submit" class="btn btn-primary btn-sm" style="margin-top:0.2rem;">
        <i class="fa-solid fa-check"></i> Enregistrer
      </button>
    </form>
  </div>
  <?php endforeach; ?>
</div>

<!-- Pagination -->
<?php if ($pages_tot > 1): ?>
<div style="display:flex;gap:0.4rem;justify-content:center;margin-top:1.5rem;flex-wrap:wrap;">
  <?php for ($i = 1; $i <= $pages_tot; $i++):
    $link = base_url('admin/translations') . '?' . http_build_query(['q' => $q, 'status' => $status, 'p' => $i]); ?>
    <a href="<?= $link ?>"
       class="btn btn-sm <?= $i === $page ? 'btn-primary' : 'btn-outline' ?>"><?= $i ?></a>
  <?php endfor; ?>
</div>
<?php endif; ?>

<?php endif; ?>
