<?php $editing = !empty($item); ?>
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title">
      <i class="fa-solid fa-file-arrow-down fa-fw"></i>
      <?= $editing ? 'Modifier un document' : 'Nouveau document' ?>
    </h1>
    <p class="admin-page-subtitle">
      <?= $editing
          ? 'Changez le titre, l\'ordre, ou remplacez le fichier par une version plus récente.'
          : 'Téléversez un fichier (PDF, Word, Excel, PowerPoint, ZIP…) et choisissez la page où il apparaîtra.' ?>
    </p>
  </div>
  <a href="<?= base_url('admin/documents') ?>" class="btn btn-outline">
    <i class="fa-solid fa-arrow-left"></i> Retour à la liste
  </a>
</div>

<?php if (!empty($error)): ?>
<div style="margin-bottom:1.5rem;padding:0.8rem 1rem;border-radius:8px;background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;">
  <i class="fa-solid fa-xmark"></i> <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<?php $action = $editing ? base_url('admin/document_do_edit/' . $item->id) : base_url('admin/document_do_new'); ?>

<form method="post" action="<?= $action ?>" id="doc-form" style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start;">
  <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

  <!-- Champs renseignés automatiquement par le téléversement -->
  <input type="hidden" name="file_path"     id="doc-path"  value="<?= $editing ? htmlspecialchars($item->file_path) : '' ?>">
  <input type="hidden" name="original_name" id="doc-orig"  value="<?= $editing ? htmlspecialchars((string)$item->original_name) : '' ?>">
  <input type="hidden" name="mime_type"     id="doc-mime"  value="<?= $editing ? htmlspecialchars((string)$item->mime_type) : '' ?>">
  <input type="hidden" name="file_size"     id="doc-size"  value="<?= $editing ? (int)$item->file_size : '' ?>">

  <div style="display:flex;flex-direction:column;gap:1.25rem;">

    <!-- ===== FICHIER ===== -->
    <div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);padding:1.5rem;">
      <h3 style="margin:0 0 1rem;font-size:1rem;color:#0f172a;">Fichier</h3>

      <div id="doc-file-box" style="display:flex;align-items:center;gap:1rem;padding:1rem;border:2px dashed #e2e8f0;border-radius:10px;background:#f9fbfd;">
        <div style="width:46px;height:46px;border-radius:10px;background:#eef3fb;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
          <i class="fa-solid fa-file-arrow-up" id="doc-file-icon" style="color:#1D67CD;font-size:1.1rem;"></i>
        </div>
        <div style="flex:1;min-width:0;">
          <div id="doc-file-name" style="font-weight:600;font-size:0.88rem;color:#0f172a;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
            <?php if ($editing && $item->file_path): ?>
              <?= htmlspecialchars($item->original_name ?: basename($item->file_path)) ?>
            <?php else: ?>
              Aucun fichier sélectionné
            <?php endif; ?>
          </div>
          <div id="doc-file-meta" style="font-size:0.76rem;color:#64748b;">
            <?php if ($editing && $item->file_path): ?>
              <?= htmlspecialchars(doc_ext($item)) ?><?= doc_size($item) ? ' · ' . doc_size($item) : '' ?>
              · <a href="<?= doc_url($item) ?>" target="_blank" rel="noopener" style="color:#1D67CD;">Ouvrir</a>
            <?php else: ?>
              PDF, DOC(X), XLS(X), PPT(X), ZIP, CSV, TXT, images — 30 Mo max
            <?php endif; ?>
          </div>
        </div>
        <label class="btn btn-outline" style="cursor:pointer;margin:0;flex-shrink:0;">
          <i class="fa-solid fa-upload"></i> <?= $editing ? 'Remplacer' : 'Téléverser' ?>
          <input type="file" id="doc-file-input" style="display:none;"
                 accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.csv,.txt,.jpg,.jpeg,.png,.webp">
        </label>
      </div>

      <p id="doc-upload-status" style="font-size:0.82rem;color:#64748b;margin:0.6rem 0 0;"></p>

      <details style="margin-top:1rem;">
        <summary style="cursor:pointer;font-size:0.82rem;color:#64748b;">Ou pointer vers un fichier existant / une URL externe</summary>
        <input type="text" class="form-input" id="doc-path-manual" style="margin-top:0.6rem;"
               value="<?= $editing ? htmlspecialchars($item->file_path) : '' ?>"
               placeholder="assets/Documents/mon-fichier.pdf ou https://exemple.com/fiche.pdf">
        <p style="font-size:0.76rem;color:#94a3b8;margin-top:0.35rem;">
          Chemin relatif à la racine du site (doit commencer par <code>assets/</code>) ou URL complète en https.
        </p>
      </details>
    </div>

    <!-- ===== LIBELLÉS ===== -->
    <div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);padding:1.5rem;">
      <h3 style="margin:0 0 1rem;font-size:1rem;color:#0f172a;">Libellés affichés sur le site</h3>

      <div class="form-group">
        <label class="form-label">Titre</label>
        <input type="text" name="title" id="doc-title" class="form-input" maxlength="255"
               value="<?= $editing ? htmlspecialchars($item->title) : '' ?>"
               placeholder="Ex : Compresseurs à vis — Présentation">
      </div>

      <div class="form-group">
        <label class="form-label">Sous-titre <span style="color:#94a3b8;font-weight:400;">(ligne de détail sous le titre)</span></label>
        <input type="text" name="subtitle" id="doc-subtitle" class="form-input" maxlength="255"
               value="<?= $editing ? htmlspecialchars((string)$item->subtitle) : '' ?>"
               placeholder="Ex : FR · Technologie &amp; gamme à vis">
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
        <div class="form-group">
          <label class="form-label">Badge <span style="color:#94a3b8;font-weight:400;">(optionnel)</span></label>
          <input type="text" name="badge" id="doc-badge" class="form-input" maxlength="30"
                 value="<?= $editing ? htmlspecialchars((string)$item->badge) : '' ?>"
                 placeholder="PDF · FR">
          <p style="font-size:0.76rem;color:#94a3b8;margin-top:0.3rem;">Vide = l'extension du fichier (PDF, DOCX…).</p>
        </div>
        <div class="form-group">
          <label class="form-label">Icône</label>
          <select name="icon" id="doc-icon" class="form-input">
            <?php
            $icons = [
              'fa-file-pdf'        => 'PDF (document)',
              'fa-file-word'       => 'Word',
              'fa-file-excel'      => 'Excel',
              'fa-file-powerpoint' => 'PowerPoint',
              'fa-file-zipper'     => 'Archive ZIP',
              'fa-file-lines'      => 'Document générique',
              'fa-images'          => 'Brochure / visuel',
              'fa-shield-halved'   => 'Sécurité / MSDS',
              'fa-microchip'       => 'Électronique / contrôle',
              'fa-filter'          => 'Filtration',
              'fa-gear'            => 'Technique / pièces',
            ];
            $cur = $editing ? $item->icon : 'fa-file-pdf';
            foreach ($icons as $cls => $lbl):
            ?>
            <option value="<?= $cls ?>" <?= $cur === $cls ? 'selected' : '' ?>><?= $lbl ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
    </div>

    <!-- ===== EMPLACEMENT & AFFICHAGE ===== -->
    <div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);padding:1.5rem;">
      <h3 style="margin:0 0 1rem;font-size:1rem;color:#0f172a;">Emplacement &amp; affichage</h3>

      <div class="form-group">
        <label class="form-label">Page du site</label>
        <select name="page" class="form-input">
          <?php foreach ($doc_pages as $pg_key => $pg_label): ?>
          <option value="<?= htmlspecialchars($pg_key) ?>"
                  <?= ($editing && $item->page === $pg_key) ? 'selected' : '' ?>>
            <?= htmlspecialchars($pg_label) ?>
          </option>
          <?php endforeach; ?>
        </select>
        <p style="font-size:0.76rem;color:#94a3b8;margin-top:0.3rem;">
          Le document apparaît dans la section « Documentation technique » de la page choisie.
        </p>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
        <div class="form-group">
          <label class="form-label">Ordre d'affichage</label>
          <input type="number" name="sort_order" class="form-input" min="0" max="9999"
                 value="<?= $editing ? (int)$item->sort_order : 10 ?>">
          <p style="font-size:0.76rem;color:#94a3b8;margin-top:0.3rem;">0 = en premier.</p>
        </div>
        <div class="form-group" style="display:flex;align-items:center;gap:0.75rem;padding-top:1.5rem;">
          <label style="display:flex;align-items:center;gap:0.6rem;cursor:pointer;font-weight:500;">
            <input type="checkbox" name="visible" value="1"
                   <?= (!$editing || $item->visible) ? 'checked' : '' ?>
                   style="width:18px;height:18px;cursor:pointer;">
            Visible sur le site
          </label>
        </div>
      </div>
    </div>

  </div>

  <!-- ===== APERÇU ===== -->
  <div style="position:sticky;top:1.5rem;">
    <div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);overflow:hidden;">
      <div style="padding:1rem 1.25rem;border-bottom:1px solid #f1f5f9;font-weight:600;font-size:0.9rem;color:#334155;">
        <i class="fa-solid fa-eye" style="color:#64748b;margin-right:0.4rem;"></i> Aperçu sur le site
      </div>
      <div style="padding:1.25rem;">
        <div style="display:flex;align-items:center;gap:1rem;background:white;border:1px solid #e2e8f0;border-left:4px solid #1D67CD;border-radius:10px;padding:1rem;">
          <div style="width:40px;height:40px;background:rgba(29,103,205,0.08);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="fa-solid <?= htmlspecialchars($editing ? $item->icon : 'fa-file-pdf') ?>" id="doc-prev-icon" style="color:#1D67CD;font-size:1.1rem;"></i>
          </div>
          <div style="flex:1;min-width:0;">
            <div id="doc-prev-title" style="font-weight:600;font-size:0.86rem;color:#0f172a;min-height:1.2em;">
              <?= $editing ? htmlspecialchars($item->title) : 'Titre du document' ?>
            </div>
            <div id="doc-prev-sub" style="font-size:0.74rem;color:#64748b;">
              <?= $editing ? htmlspecialchars((string)$item->subtitle) : '' ?>
            </div>
          </div>
          <span id="doc-prev-badge" style="font-size:0.7rem;font-weight:700;color:#1D67CD;background:rgba(29,103,205,0.08);padding:0.15rem 0.45rem;border-radius:6px;flex-shrink:0;">
            <?= $editing ? htmlspecialchars(doc_badge($item)) : 'PDF' ?>
          </span>
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn-primary" style="width:100%;margin-top:1rem;padding:0.9rem;">
      <i class="fa-solid fa-<?= $editing ? 'floppy-disk' : 'plus' ?>"></i>
      <?= $editing ? 'Enregistrer les modifications' : 'Ajouter le document' ?>
    </button>

    <?php if ($editing): ?>
    <p style="font-size:0.76rem;color:#94a3b8;margin-top:0.75rem;line-height:1.5;">
      <i class="fa-solid fa-circle-info"></i>
      Remplacer le fichier ne casse aucun lien : l'adresse publique du document reste la même.
    </p>
    <?php endif; ?>
  </div>

</form>

<script>
(function () {
  var pathEl   = document.getElementById('doc-path');
  var origEl   = document.getElementById('doc-orig');
  var mimeEl   = document.getElementById('doc-mime');
  var sizeEl   = document.getElementById('doc-size');
  var manualEl = document.getElementById('doc-path-manual');
  var statusEl = document.getElementById('doc-upload-status');
  var titleEl  = document.getElementById('doc-title');
  var subEl    = document.getElementById('doc-subtitle');
  var badgeEl  = document.getElementById('doc-badge');
  var iconEl   = document.getElementById('doc-icon');

  function extOf(path) {
    var m = String(path || '').match(/\.([A-Za-z0-9]+)(?:[?#].*)?$/);
    return m ? m[1].toUpperCase() : '';
  }

  function humanSize(bytes) {
    bytes = parseInt(bytes, 10) || 0;
    if (bytes <= 0) return '';
    if (bytes < 1024) return bytes + ' o';
    if (bytes < 1048576) return Math.round(bytes / 1024) + ' Ko';
    return (bytes / 1048576).toFixed(1).replace('.', ',') + ' Mo';
  }

  function syncPreview() {
    document.getElementById('doc-prev-title').textContent = titleEl.value || 'Titre du document';
    document.getElementById('doc-prev-sub').textContent   = subEl.value || '';
    document.getElementById('doc-prev-badge').textContent  = badgeEl.value || extOf(pathEl.value) || 'PDF';
    var icon = document.getElementById('doc-prev-icon');
    icon.className = 'fa-solid ' + iconEl.value;
  }

  [titleEl, subEl, badgeEl].forEach(function (el) {
    if (el) el.addEventListener('input', syncPreview);
  });
  if (iconEl) iconEl.addEventListener('change', syncPreview);

  // Icône proposée automatiquement d'après l'extension
  function suggestIcon(ext) {
    var map = {
      PDF: 'fa-file-pdf', DOC: 'fa-file-word', DOCX: 'fa-file-word',
      XLS: 'fa-file-excel', XLSX: 'fa-file-excel', CSV: 'fa-file-excel',
      PPT: 'fa-file-powerpoint', PPTX: 'fa-file-powerpoint',
      ZIP: 'fa-file-zipper', TXT: 'fa-file-lines',
      JPG: 'fa-images', JPEG: 'fa-images', PNG: 'fa-images', WEBP: 'fa-images'
    };
    return map[ext] || 'fa-file-lines';
  }

  function applyFile(data) {
    pathEl.value = data.path;
    origEl.value = data.name || '';
    mimeEl.value = data.mime || '';
    sizeEl.value = data.size || '';
    if (manualEl) manualEl.value = data.path;

    var ext = extOf(data.name || data.path);
    document.getElementById('doc-file-name').textContent = data.name || data.path;
    document.getElementById('doc-file-meta').textContent =
      ext + (humanSize(data.size) ? ' · ' + humanSize(data.size) : '');
    document.getElementById('doc-file-icon').className = 'fa-solid ' + suggestIcon(ext);
    document.getElementById('doc-file-box').style.borderColor = '#86efac';

    // Pré-remplissages pratiques, jamais écrasants
    if (iconEl && !iconEl.dataset.touched) {
      var sug = suggestIcon(ext);
      for (var i = 0; i < iconEl.options.length; i++) {
        if (iconEl.options[i].value === sug) { iconEl.selectedIndex = i; break; }
      }
    }
    if (titleEl && !titleEl.value && data.name) {
      titleEl.value = data.name.replace(/\.[A-Za-z0-9]+$/, '').replace(/[_-]+/g, ' ');
    }
    syncPreview();
  }

  if (iconEl) iconEl.addEventListener('change', function () { this.dataset.touched = '1'; });

  var input = document.getElementById('doc-file-input');
  if (input) {
    input.addEventListener('change', function () {
      if (!this.files || !this.files[0]) return;
      var file = this.files[0];
      statusEl.style.color = '#64748b';
      statusEl.textContent = 'Téléversement de « ' + file.name + ' »…';

      var fd = new FormData();
      fd.append('file', file);

      fetch(BASE_URL + 'admin/upload_document', { method: 'POST', body: fd })
        .then(function (r) { return r.json(); })
        .then(function (data) {
          if (data && data.ok) {
            statusEl.style.color = '#15803d';
            statusEl.textContent = 'Fichier téléversé. Cliquez sur « Enregistrer » pour valider.';
            applyFile(data);
          } else {
            statusEl.style.color = '#dc2626';
            statusEl.textContent = 'Erreur : ' + ((data && data.msg) || 'téléversement refusé.');
          }
        })
        .catch(function () {
          statusEl.style.color = '#dc2626';
          statusEl.textContent = 'Erreur réseau pendant le téléversement.';
        });
    });
  }

  // Saisie manuelle d'un chemin / d'une URL
  if (manualEl) {
    manualEl.addEventListener('input', function () {
      pathEl.value = this.value.trim();
      var ext = extOf(pathEl.value);
      document.getElementById('doc-file-name').textContent =
        pathEl.value ? pathEl.value.split('/').pop() : 'Aucun fichier sélectionné';
      document.getElementById('doc-file-meta').textContent = ext;
      if (!origEl.value) origEl.value = pathEl.value.split('/').pop();
      syncPreview();
    });
  }

  // Garde-fou : pas d'enregistrement sans fichier
  document.getElementById('doc-form').addEventListener('submit', function (e) {
    if (!pathEl.value.trim()) {
      e.preventDefault();
      statusEl.style.color = '#dc2626';
      statusEl.textContent = 'Téléversez un fichier ou saisissez un chemin avant d\'enregistrer.';
    }
  });

  syncPreview();
})();
</script>
