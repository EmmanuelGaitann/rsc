<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title"><i class="fa-solid fa-file-arrow-down fa-fw"></i> Documents &amp; Catalogues</h1>
    <p class="admin-page-subtitle">Tous les fichiers téléchargeables du site (PDF, Word, Excel, ZIP…). Ajoutez, remplacez ou masquez un document sans toucher au code.</p>
  </div>
  <a href="<?= base_url('admin/document_new') ?>" class="btn btn-primary">
    <i class="fa-solid fa-plus"></i> Nouveau document
  </a>
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

<?php if (empty($documents_list)): ?>
<div style="text-align:center;padding:3rem;background:#f4f6fa;border-radius:12px;color:#64748b;">
  <i class="fa-solid fa-file-circle-plus" style="font-size:2.5rem;margin-bottom:1rem;display:block;color:#94a3b8;"></i>
  <p>Aucun document enregistré pour l'instant.</p>
  <p style="font-size:0.82rem;color:#94a3b8;">En attendant, le site affiche les PDF historiques livrés avec le code.</p>
  <a href="<?= base_url('admin/document_new') ?>" class="btn btn-primary" style="margin-top:1rem;">
    Ajouter mon premier document
  </a>
</div>
<?php else: ?>

<?php
/* Regroupement par page du site */
$grouped = [];
foreach ($documents_list as $d) {
    $grouped[$d->page][] = $d;
}
?>

<?php foreach ($grouped as $pg => $docs): ?>
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);overflow:hidden;margin-bottom:1.5rem;">
  <div style="padding:0.9rem 1.25rem;border-bottom:1px solid #e2e8f0;background:#f8fafc;display:flex;align-items:center;gap:0.6rem;">
    <i class="fa-solid fa-folder-open" style="color:#64748b;"></i>
    <strong style="font-size:0.92rem;color:#0f172a;">
      <?= htmlspecialchars(isset($doc_pages[$pg]) ? $doc_pages[$pg] : $pg) ?>
    </strong>
    <span style="font-size:0.78rem;color:#94a3b8;"><?= count($docs) ?> document(s)</span>
  </div>

  <table style="width:100%;border-collapse:collapse;">
    <thead>
      <tr style="background:#fbfcfe;border-bottom:1px solid #e2e8f0;">
        <th style="padding:0.7rem 1rem;text-align:left;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Document</th>
        <th style="padding:0.7rem 1rem;text-align:left;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Fichier</th>
        <th style="padding:0.7rem 1rem;text-align:center;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Ordre</th>
        <th style="padding:0.7rem 1rem;text-align:center;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Téléch.</th>
        <th style="padding:0.7rem 1rem;text-align:left;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">État</th>
        <th style="padding:0.7rem 1rem;text-align:right;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($docs as $d): ?>
      <?php
        $missing = (!preg_match('#^https?://#i', (string)$d->file_path))
                   && $d->file_path !== ''
                   && !is_file(FCPATH . ltrim((string)$d->file_path, '/'));
      ?>
      <tr style="border-bottom:1px solid #f1f5f9;">
        <td style="padding:0.85rem 1rem;">
          <div style="display:flex;align-items:center;gap:0.75rem;">
            <div style="width:40px;height:40px;border-radius:8px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
              <i class="fa-solid <?= htmlspecialchars(doc_icon($d)) ?>" style="color:#1D67CD;"></i>
            </div>
            <div style="min-width:0;">
              <div style="font-weight:600;font-size:0.88rem;color:#0f172a;"><?= htmlspecialchars($d->title) ?></div>
              <?php if ($d->subtitle): ?>
              <div style="font-size:0.76rem;color:#64748b;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:360px;">
                <?= htmlspecialchars($d->subtitle) ?>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </td>
        <td style="padding:0.85rem 1rem;font-size:0.78rem;color:#64748b;">
          <?php if ($d->file_path === ''): ?>
            <span style="color:#dc2626;">Aucun fichier</span>
          <?php else: ?>
            <a href="<?= doc_url($d) ?>" target="_blank" rel="noopener" style="color:#1D67CD;text-decoration:none;">
              <?= htmlspecialchars($d->original_name ?: basename($d->file_path)) ?>
              <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:0.7rem;"></i>
            </a>
            <div style="color:#94a3b8;margin-top:0.15rem;">
              <?= htmlspecialchars(doc_ext($d)) ?><?= doc_size($d) ? ' · ' . doc_size($d) : '' ?>
            </div>
            <?php if ($missing): ?>
            <div style="color:#dc2626;margin-top:0.2rem;">
              <i class="fa-solid fa-triangle-exclamation"></i> Fichier absent du serveur
            </div>
            <?php endif; ?>
          <?php endif; ?>
        </td>
        <td style="padding:0.85rem 1rem;text-align:center;color:#64748b;font-size:0.85rem;"><?= (int)$d->sort_order ?></td>
        <td style="padding:0.85rem 1rem;text-align:center;color:#64748b;font-size:0.85rem;"><?= (int)$d->downloads ?></td>
        <td style="padding:0.85rem 1rem;">
          <a href="<?= base_url('admin/document_toggle/' . $d->id) ?>" style="text-decoration:none;" title="Basculer la visibilité">
            <?php if ($d->visible): ?>
            <span style="background:#16a34a;color:white;padding:0.15rem 0.55rem;border-radius:20px;font-size:0.72rem;font-weight:600;">Visible</span>
            <?php else: ?>
            <span style="background:#64748b;color:white;padding:0.15rem 0.55rem;border-radius:20px;font-size:0.72rem;font-weight:600;">Masqué</span>
            <?php endif; ?>
          </a>
        </td>
        <td style="padding:0.85rem 1rem;text-align:right;white-space:nowrap;">
          <a href="<?= base_url('admin/document_edit/' . $d->id) ?>" class="btn btn-outline btn-sm">
            <i class="fa-solid fa-pencil"></i> Modifier
          </a>
          <form method="post" action="<?= base_url('admin/document_delete/' . $d->id) ?>" style="display:inline"
                onsubmit="return confirm('Supprimer définitivement ce document de la liste ?')">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
            <input type="hidden" name="purge_file" value="1">
            <button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;cursor:pointer;">
              <i class="fa-solid fa-trash"></i>
            </button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php endforeach; ?>

<p style="color:#94a3b8;font-size:0.82rem;">
  <i class="fa-solid fa-circle-info"></i>
  <?= count($documents_list) ?> document(s) au total. L'ordre d'affichage sur le site suit le champ « Ordre » (du plus petit au plus grand).
  Un document masqué disparaît du site sans être supprimé.
</p>

<?php endif; ?>
