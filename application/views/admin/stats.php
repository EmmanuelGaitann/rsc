<?php
$max = max(1, max($series ?: [1]));
$lang_total = 0;
foreach ($langs as $l) $lang_total += (int)$l->h;
?>
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title"><i class="fa-solid fa-chart-column fa-fw"></i> Statistiques de fréquentation</h1>
    <p class="admin-page-subtitle">
      Mesure interne et anonyme (aucun cookie, aucune donnée personnelle) — conforme RGPD.
      Les robots d'indexation sont exclus du comptage.
    </p>
  </div>
</div>

<!-- Compteurs -->
<div style="display:flex;gap:1rem;flex-wrap:wrap;margin-bottom:1.8rem;">
  <?php
  $tiles = [
    ['Aujourd\'hui',            $today,                              'fa-calendar-day',  '#1d4ed8', '#dbeafe'],
    ['7 derniers jours',        $week,                               'fa-calendar-week', '#0f766e', '#ccfbf1'],
    ['30 derniers jours',       $month,                              'fa-calendar',      '#7c3aed', '#ede9fe'],
    ['Demandes (30 j)',         (int)($leads_counts->recent ?? 0),   'fa-inbox',         '#b45309', '#fef3c7'],
    ['Demandes à traiter',      (int)($leads_counts->nouveaux ?? 0), 'fa-bell',          '#dc2626', '#fee2e2'],
  ];
  foreach ($tiles as $t): ?>
  <div style="flex:1;min-width:150px;background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);padding:1.1rem 1.3rem;">
    <div style="display:flex;align-items:center;gap:0.7rem;">
      <span style="width:38px;height:38px;border-radius:10px;background:<?= $t[4] ?>;color:<?= $t[3] ?>;display:inline-flex;align-items:center;justify-content:center;">
        <i class="fa-solid <?= $t[2] ?>"></i>
      </span>
      <div>
        <div style="font-size:1.45rem;font-weight:800;color:#0f172a;line-height:1;"><?= number_format($t[1], 0, ',', ' ') ?></div>
        <div style="font-size:0.72rem;text-transform:uppercase;letter-spacing:0.05em;color:#64748b;margin-top:0.25rem;"><?= $t[0] ?></div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<!-- Graphique 30 jours -->
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);padding:1.4rem;margin-bottom:1.8rem;">
  <h3 style="font-size:0.95rem;color:#0f172a;margin-bottom:1.2rem;"><i class="fa-solid fa-chart-simple" style="color:#1d67cd;"></i> Visites par jour — 30 derniers jours</h3>
  <div style="display:flex;align-items:flex-end;gap:3px;height:160px;">
    <?php foreach ($series as $day => $h):
      $pct = (int)round($h / $max * 100); ?>
    <div title="<?= date('d/m', strtotime($day)) ?> : <?= (int)$h ?> visite(s)"
         style="flex:1;background:<?= $h > 0 ? 'linear-gradient(180deg,#1d67cd,#1554b0)' : '#eef2f7' ?>;height:<?= max(2, $pct) ?>%;border-radius:3px 3px 0 0;"></div>
    <?php endforeach; ?>
  </div>
  <div style="display:flex;justify-content:space-between;font-size:0.68rem;color:#94a3b8;margin-top:0.5rem;">
    <span><?= date('d/m', strtotime(array_key_first($series))) ?></span>
    <span><?= date('d/m', strtotime(array_key_last($series))) ?></span>
  </div>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1.2rem;">

  <!-- Top pages -->
  <div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);padding:1.4rem;">
    <h3 style="font-size:0.95rem;color:#0f172a;margin-bottom:1rem;"><i class="fa-solid fa-ranking-star" style="color:#1d67cd;"></i> Pages les plus vues (30 j)</h3>
    <?php if (empty($top_pages)): ?>
    <p style="color:#94a3b8;font-size:0.85rem;">Pas encore de données.</p>
    <?php else:
      $tp_max = max(1, (int)$top_pages[0]->h);
      foreach ($top_pages as $tp): ?>
    <div style="margin-bottom:0.65rem;">
      <div style="display:flex;justify-content:space-between;font-size:0.8rem;margin-bottom:0.25rem;">
        <span style="color:#334155;font-family:monospace;"><?= htmlspecialchars($tp->path ?: '/') ?></span>
        <strong style="color:#0f172a;"><?= (int)$tp->h ?></strong>
      </div>
      <div style="height:6px;background:#eef2f7;border-radius:4px;overflow:hidden;">
        <div style="height:100%;width:<?= (int)round($tp->h / $tp_max * 100) ?>%;background:linear-gradient(90deg,#1d67cd,#4b8ce0);"></div>
      </div>
    </div>
    <?php endforeach; endif; ?>
  </div>

  <!-- Langues -->
  <div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);padding:1.4rem;">
    <h3 style="font-size:0.95rem;color:#0f172a;margin-bottom:1rem;"><i class="fa-solid fa-language" style="color:#1d67cd;"></i> Répartition par langue (30 j)</h3>
    <?php if ($lang_total === 0): ?>
    <p style="color:#94a3b8;font-size:0.85rem;">Pas encore de données.</p>
    <?php else: foreach ($langs as $l):
      $pct = (int)round($l->h / $lang_total * 100); ?>
    <div style="margin-bottom:0.9rem;">
      <div style="display:flex;justify-content:space-between;font-size:0.85rem;margin-bottom:0.3rem;">
        <span style="font-weight:700;color:#334155;"><?= $l->lang === 'fr' ? '🇫🇷 Français' : ($l->lang === 'en' ? '🇬🇧 English' : strtoupper($l->lang)) ?></span>
        <span style="color:#64748b;"><?= (int)$l->h ?> — <?= $pct ?>%</span>
      </div>
      <div style="height:8px;background:#eef2f7;border-radius:4px;overflow:hidden;">
        <div style="height:100%;width:<?= $pct ?>%;background:<?= $l->lang === 'fr' ? 'linear-gradient(90deg,#1d67cd,#4b8ce0)' : 'linear-gradient(90deg,#d1ab6a,#b8924e)' ?>;"></div>
      </div>
    </div>
    <?php endforeach; endif; ?>
    <p style="margin-top:1rem;font-size:0.78rem;color:#94a3b8;line-height:1.6;">
      <i class="fa-solid fa-inbox"></i> Total demandes reçues : <strong><?= (int)($leads_counts->total ?? 0) ?></strong>
      — <a href="<?= base_url('admin/leads') ?>" style="color:#1d67cd;">voir les demandes</a>
    </p>
  </div>
</div>
