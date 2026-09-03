<?php
$csrf_name = $this->security->get_csrf_token_name();
$csrf_hash = $this->security->get_csrf_hash();
$pages_tot = max(1, (int)ceil($total / $per_page));
$subject_labels = [
    'commercial'  => 'Commercial / Devis',
    'technique'   => 'Support technique',
    'maintenance' => 'Maintenance / Contrat',
    'pieces'      => 'Pièces détachées',
    'autre'       => 'Autre',
];
?>
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title"><i class="fa-solid fa-inbox fa-fw"></i> Demandes reçues</h1>
    <p class="admin-page-subtitle">
      Toutes les demandes envoyées via le formulaire de contact sont centralisées ici
      (même si l'envoi d'e-mail a échoué). <strong><?= (int)($counts->nouveaux ?? 0) ?></strong> nouvelle(s)
      sur <strong><?= (int)($counts->total ?? 0) ?></strong> au total.
    </p>
  </div>
</div>

<?php if (!empty($success)): ?>
<div style="margin-bottom:1.5rem;padding:0.8rem 1rem;border-radius:8px;background:#dcfce7;color:#15803d;border:1px solid #86efac;">
  <i class="fa-solid fa-check"></i> <?= htmlspecialchars($success) ?>
</div>
<?php endif; ?>

<!-- Filtres -->
<form method="get" action="<?= base_url('admin/leads') ?>"
      style="display:flex;gap:0.6rem;flex-wrap:wrap;align-items:center;margin-bottom:1.2rem;">
  <input type="text" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Rechercher (nom, email, message)…"
         style="flex:1;min-width:220px;padding:0.55rem 0.8rem;border:1.5px solid #e2e8f0;border-radius:8px;font-size:0.9rem;">
  <select name="status" style="padding:0.55rem 0.8rem;border:1.5px solid #e2e8f0;border-radius:8px;font-size:0.9rem;">
    <option value="">Toutes</option>
    <option value="nouveau" <?= $status === 'nouveau' ? 'selected' : '' ?>>Nouvelles</option>
    <option value="traite"  <?= $status === 'traite' ? 'selected' : '' ?>>Traitées</option>
  </select>
  <button type="submit" class="btn btn-outline"><i class="fa-solid fa-filter"></i> Filtrer</button>
</form>

<?php if (empty($rows)): ?>
<div style="text-align:center;padding:3rem;background:var(--light);border-radius:12px;color:var(--gray);">
  <i class="fa-solid fa-inbox" style="font-size:2.5rem;margin-bottom:1rem;display:block;color:#94a3b8;"></i>
  <p>Aucune demande pour l'instant.</p>
  <p style="font-size:0.85rem;margin-top:0.5rem;">Les messages envoyés depuis la page Contact apparaîtront ici automatiquement.</p>
</div>
<?php else: ?>

<div style="display:flex;flex-direction:column;gap:0.8rem;">
  <?php foreach ($rows as $r): $is_new = ($r->status === 'nouveau'); ?>
  <div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);padding:1.1rem 1.3rem;<?= $is_new ? 'border-left:4px solid #1d4ed8;' : 'opacity:0.85;' ?>">
    <div style="display:flex;justify-content:space-between;gap:1rem;flex-wrap:wrap;align-items:flex-start;">
      <div>
        <div style="display:flex;align-items:center;gap:0.6rem;flex-wrap:wrap;">
          <strong style="color:#0f172a;font-size:1rem;"><?= htmlspecialchars($r->name) ?></strong>
          <?php if ($r->company): ?><span style="color:#64748b;font-size:0.85rem;">— <?= htmlspecialchars($r->company) ?></span><?php endif; ?>
          <span style="background:<?= $is_new ? '#dbeafe' : '#dcfce7' ?>;color:<?= $is_new ? '#1d4ed8' : '#15803d' ?>;padding:0.15rem 0.65rem;border-radius:20px;font-size:0.68rem;font-weight:700;">
            <?= $is_new ? 'Nouveau' : 'Traité' ?>
          </span>
          <?php if (!$r->email_sent): ?>
          <span title="L'e-mail de notification n'a pas pu être envoyé — la demande n'existe qu'ici."
                style="background:#fef3c7;color:#b45309;padding:0.15rem 0.65rem;border-radius:20px;font-size:0.68rem;font-weight:700;">
            <i class="fa-solid fa-triangle-exclamation"></i> e-mail non parti
          </span>
          <?php endif; ?>
        </div>
        <div style="margin-top:0.35rem;font-size:0.82rem;color:#475569;display:flex;gap:1rem;flex-wrap:wrap;">
          <span><i class="fa-solid fa-envelope fa-fw" style="color:#94a3b8;"></i>
            <a href="mailto:<?= htmlspecialchars($r->email) ?>" style="color:#1d67cd;"><?= htmlspecialchars($r->email) ?></a></span>
          <?php if ($r->phone): ?>
          <span><i class="fa-solid fa-phone fa-fw" style="color:#94a3b8;"></i>
            <a href="tel:<?= preg_replace('/\s+/', '', $r->phone) ?>" style="color:#1d67cd;"><?= htmlspecialchars($r->phone) ?></a></span>
          <?php endif; ?>
          <?php if ($r->whatsapp): ?>
          <span><i class="fa-brands fa-whatsapp fa-fw" style="color:#22c55e;"></i> <?= htmlspecialchars($r->whatsapp) ?></span>
          <?php endif; ?>
          <span><i class="fa-solid fa-tag fa-fw" style="color:#94a3b8;"></i>
            <?= htmlspecialchars($subject_labels[$r->subject] ?? ucfirst((string)$r->subject)) ?></span>
          <span><i class="fa-solid fa-clock fa-fw" style="color:#94a3b8;"></i>
            <?= date('d/m/Y H:i', strtotime($r->created_at)) ?></span>
          <span title="Langue du site lors de l'envoi" style="text-transform:uppercase;font-weight:700;color:#94a3b8;"><?= htmlspecialchars($r->lang) ?></span>
        </div>
      </div>
      <div style="display:flex;gap:0.4rem;">
        <form method="post" action="<?= base_url('admin/lead_toggle/' . $r->id) ?>">
          <input type="hidden" name="<?= $csrf_name ?>" value="<?= $csrf_hash ?>">
          <button type="submit" class="btn btn-outline btn-sm">
            <?= $is_new ? '<i class="fa-solid fa-check"></i> Marquer traité' : '<i class="fa-solid fa-rotate-left"></i> Rouvrir' ?>
          </button>
        </form>
        <form method="post" action="<?= base_url('admin/lead_delete/' . $r->id) ?>"
              onsubmit="return confirm('Supprimer définitivement cette demande ?')">
          <input type="hidden" name="<?= $csrf_name ?>" value="<?= $csrf_hash ?>">
          <button type="submit" class="btn btn-outline btn-sm" style="color:#dc2626;border-color:#fca5a5;">
            <i class="fa-solid fa-trash"></i>
          </button>
        </form>
      </div>
    </div>
    <div style="margin-top:0.7rem;padding:0.8rem 1rem;background:#f8fafc;border-radius:8px;color:#334155;font-size:0.88rem;line-height:1.6;white-space:pre-wrap;"><?= htmlspecialchars($r->message) ?></div>
  </div>
  <?php endforeach; ?>
</div>

<?php if ($pages_tot > 1): ?>
<div style="display:flex;gap:0.4rem;justify-content:center;margin-top:1.5rem;flex-wrap:wrap;">
  <?php for ($i = 1; $i <= $pages_tot; $i++):
    $link = base_url('admin/leads') . '?' . http_build_query(['q' => $q, 'status' => $status, 'p' => $i]); ?>
    <a href="<?= $link ?>" class="btn btn-sm <?= $i === $page ? 'btn-primary' : 'btn-outline' ?>"><?= $i ?></a>
  <?php endfor; ?>
</div>
<?php endif; ?>

<?php endif; ?>
