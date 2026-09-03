<?php $editing = !empty($item); ?>
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title">
      <i class="fa-solid fa-photo-film fa-fw"></i>
      <?= $editing ? 'Modifier une image' : 'Nouvelle image' ?>
    </h1>
    <p class="admin-page-subtitle"><?= $editing ? 'Modifiez les informations de cette image de galerie.' : 'Ajoutez une nouvelle image à la galerie du site.' ?></p>
  </div>
  <a href="<?= base_url('admin/gallery') ?>" class="btn btn-outline">
    <i class="fa-solid fa-arrow-left"></i> Retour à la galerie
  </a>
</div>

<?php $action = $editing ? base_url('admin/gallery_do_edit/' . $item->id) : base_url('admin/gallery_do_new'); ?>

<form method="post" action="<?= $action ?>" style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start;">
  <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

  <!-- ===== COLONNE PRINCIPALE ===== -->
  <div style="display:flex;flex-direction:column;gap:1.25rem;">

    <!-- Image -->
    <div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);padding:1.5rem;">
      <h3 style="margin:0 0 1rem;font-size:1rem;color:#0f172a;">Image</h3>

      <input type="hidden" name="image" id="gf-image-input"
             value="<?= $editing ? htmlspecialchars($item->image) : '' ?>">

      <!-- Preview -->
      <div id="gf-image-preview" style="margin-bottom:1rem;border-radius:8px;overflow:hidden;aspect-ratio:16/9;background:#f4f6fa;display:flex;align-items:center;justify-content:center;border:2px dashed #e2e8f0;">
        <?php if ($editing && $item->image): ?>
        <?php $prev = (strpos($item->image, 'http') === 0) ? htmlspecialchars($item->image) : base_url(htmlspecialchars($item->image)); ?>
        <img src="<?= $prev ?>" id="gf-preview-img" style="width:100%;height:100%;object-fit:cover;">
        <?php else: ?>
        <div id="gf-preview-placeholder" style="text-align:center;color:#94a3b8;">
          <i class="fa-solid fa-image" style="font-size:2.5rem;display:block;margin-bottom:0.5rem;"></i>
          <span style="font-size:0.85rem;">Aucune image sélectionnée</span>
        </div>
        <?php endif; ?>
      </div>

      <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
        <button type="button" class="btn btn-outline" onclick="openGalleryMediaPicker()">
          <i class="fa-solid fa-folder-open"></i> Choisir depuis la médiathèque
        </button>
        <label class="btn btn-outline" style="cursor:pointer;margin:0;">
          <i class="fa-solid fa-upload"></i> Téléverser une image
          <input type="file" accept="image/*" style="display:none;" onchange="gfUploadFile(this)">
        </label>
        <?php if ($editing && $item->image): ?>
        <button type="button" class="btn btn-sm" onclick="gfClearImage()"
                style="background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;">
          <i class="fa-solid fa-xmark"></i> Retirer
        </button>
        <?php endif; ?>
      </div>
      <p id="gf-upload-status" style="font-size:0.82rem;color:#64748b;margin-top:0.5rem;"></p>
    </div>

    <!-- Titre & Légende -->
    <div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);padding:1.5rem;">
      <h3 style="margin:0 0 1rem;font-size:1rem;color:#0f172a;">Informations</h3>

      <div class="form-group">
        <label class="form-label">Titre <span style="color:#94a3b8;font-weight:400;">(affiché dans le lightbox)</span></label>
        <input type="text" name="title" class="form-input"
               value="<?= $editing ? htmlspecialchars($item->title) : '' ?>"
               placeholder="Ex: Installation compresseur RENNER RS 15">
      </div>

      <div class="form-group">
        <label class="form-label">Légende <span style="color:#94a3b8;font-weight:400;">(optionnel — survol de la grille)</span></label>
        <textarea name="caption" class="form-input" rows="2"
                  placeholder="Courte description affichée au survol..."><?= $editing ? htmlspecialchars($item->caption) : '' ?></textarea>
      </div>
    </div>

    <!-- Ordre & Visibilité -->
    <div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);padding:1.5rem;">
      <h3 style="margin:0 0 1rem;font-size:1rem;color:#0f172a;">Affichage</h3>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
        <div class="form-group">
          <label class="form-label">Ordre d'affichage</label>
          <input type="number" name="sort_order" class="form-input" min="0" max="9999"
                 value="<?= $editing ? (int)$item->sort_order : 0 ?>">
          <p style="font-size:0.78rem;color:#94a3b8;margin-top:0.3rem;">0 = en premier. Les images sont triées du plus petit au plus grand.</p>
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

  <!-- ===== APERÇU STICKY ===== -->
  <div style="position:sticky;top:1.5rem;">
    <div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);overflow:hidden;">
      <div style="padding:1rem 1.25rem;border-bottom:1px solid #f1f5f9;font-weight:600;font-size:0.9rem;color:#334155;">
        <i class="fa-solid fa-eye" style="color:#64748b;margin-right:0.4rem;"></i> Aperçu
      </div>
      <!-- Mini galerie item -->
      <div style="aspect-ratio:4/3;background:#f4f6fa;position:relative;overflow:hidden;">
        <img id="gf-prev-card-img" src="" alt=""
             style="width:100%;height:100%;object-fit:cover;display:<?= ($editing && $item->image) ? 'block' : 'none' ?>;">
        <div id="gf-prev-placeholder" style="width:100%;height:100%;display:<?= ($editing && $item->image) ? 'none' : 'flex' ?>;align-items:center;justify-content:center;color:#cbd5e1;flex-direction:column;gap:0.5rem;">
          <i class="fa-solid fa-image" style="font-size:2.5rem;"></i>
          <span style="font-size:0.8rem;">Aucune image</span>
        </div>
        <div id="gf-prev-overlay" style="position:absolute;inset:0;background:rgba(29,103,205,0);display:flex;align-items:flex-end;justify-content:center;transition:background 0.3s;padding-bottom:0.75rem;">
          <span id="gf-prev-caption" style="color:white;font-size:0.82rem;text-align:center;padding:0 0.5rem;opacity:0;transition:opacity 0.3s;"></span>
        </div>
      </div>
      <div style="padding:1rem;">
        <p id="gf-prev-title" style="font-weight:600;font-size:0.9rem;color:#0f172a;min-height:1.2em;">
          <?= $editing && $item->title ? htmlspecialchars($item->title) : '' ?>
        </p>
      </div>
    </div>

    <button type="submit" class="btn btn-primary" style="width:100%;margin-top:1rem;padding:0.9rem;">
      <i class="fa-solid fa-<?= $editing ? 'floppy-disk' : 'plus' ?>"></i>
      <?= $editing ? 'Enregistrer les modifications' : 'Ajouter à la galerie' ?>
    </button>
  </div>

</form>

<!-- ===== MEDIA PICKER MODAL ===== -->
<div id="gf-media-modal" style="display:none;position:fixed;inset:0;z-index:1000;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;">
  <div style="background:white;border-radius:12px;width:min(860px,95vw);max-height:85vh;display:flex;flex-direction:column;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,0.3);">
    <div style="padding:1.25rem 1.5rem;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;">
      <h3 style="margin:0;font-size:1.05rem;font-weight:600;">Médiathèque</h3>
      <div style="display:flex;gap:0.75rem;align-items:center;">
        <label class="btn btn-primary btn-sm" style="cursor:pointer;margin:0;">
          <i class="fa-solid fa-upload"></i> Téléverser
          <input type="file" accept="image/*" style="display:none;" onchange="gfModalUpload(this)">
        </label>
        <button type="button" onclick="closeGalleryMediaPicker()" style="background:none;border:none;font-size:1.5rem;cursor:pointer;color:#64748b;line-height:1;">✕</button>
      </div>
    </div>
    <div id="gf-media-grid" style="overflow-y:auto;padding:1.25rem;display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:0.75rem;">
      <div style="grid-column:1/-1;text-align:center;padding:2rem;color:#94a3b8;">
        <i class="fa-solid fa-spinner fa-spin"></i> Chargement…
      </div>
    </div>
  </div>
</div>

<script>
(function() {
  // ---- Live preview sync ----
  var titleInput   = document.querySelector('input[name="title"]');
  var captionInput = document.querySelector('textarea[name="caption"]');

  function syncPreview() {
    var title   = titleInput ? titleInput.value : '';
    var caption = captionInput ? captionInput.value : '';
    var el = document.getElementById('gf-prev-title');
    if (el) el.textContent = title || '';
    var capEl = document.getElementById('gf-prev-caption');
    if (capEl) capEl.textContent = caption || '';
  }
  if (titleInput)   titleInput.addEventListener('input', syncPreview);
  if (captionInput) captionInput.addEventListener('input', syncPreview);

  // Set initial preview image if editing
  <?php if ($editing && $item->image): ?>
  <?php $prev_url = (strpos($item->image, 'http') === 0) ? htmlspecialchars($item->image) : base_url(htmlspecialchars($item->image)); ?>
  var cardImg = document.getElementById('gf-prev-card-img');
  if (cardImg) cardImg.src = '<?= $prev_url ?>';
  <?php endif; ?>

  // ---- Image selection ----
  window.gfSelectImage = function(path, url) {
    document.getElementById('gf-image-input').value = path;

    // Update main preview
    var preview = document.getElementById('gf-image-preview');
    var existing = document.getElementById('gf-preview-img');
    var placeholder = document.getElementById('gf-preview-placeholder');
    if (!existing) {
      var img = document.createElement('img');
      img.id = 'gf-preview-img';
      img.style.cssText = 'width:100%;height:100%;object-fit:cover;';
      preview.innerHTML = '';
      preview.appendChild(img);
      existing = img;
    }
    existing.src = url;
    if (placeholder) placeholder.style.display = 'none';

    // Update preview card
    var cardImg = document.getElementById('gf-prev-card-img');
    var cardPh  = document.getElementById('gf-prev-placeholder');
    if (cardImg) { cardImg.src = url; cardImg.style.display = 'block'; }
    if (cardPh)  cardPh.style.display = 'none';

    closeGalleryMediaPicker();
  };

  window.gfClearImage = function() {
    document.getElementById('gf-image-input').value = '';
    var preview = document.getElementById('gf-image-preview');
    preview.innerHTML = '<div id="gf-preview-placeholder" style="text-align:center;color:#94a3b8;"><i class="fa-solid fa-image" style="font-size:2.5rem;display:block;margin-bottom:0.5rem;"></i><span style="font-size:0.85rem;">Aucune image sélectionnée</span></div>';
    var cardImg = document.getElementById('gf-prev-card-img');
    var cardPh  = document.getElementById('gf-prev-placeholder');
    if (cardImg) { cardImg.src = ''; cardImg.style.display = 'none'; }
    if (cardPh)  cardPh.style.display = 'flex';
  };

  // ---- Direct upload ----
  window.gfUploadFile = function(input) {
    if (!input.files || !input.files[0]) return;
    var statusEl = document.getElementById('gf-upload-status');
    if (statusEl) statusEl.textContent = 'Téléversement en cours…';
    var fd = new FormData();
    fd.append('file', input.files[0]);
    fetch(BASE_URL + 'admin/upload_media', { method: 'POST', body: fd })
      .then(function(r) { return r.json(); })
      .then(function(data) {
        if (data.ok) {
          var fullUrl = BASE_URL + data.path;
          gfSelectImage(data.path, fullUrl);
          if (statusEl) statusEl.textContent = '';
        } else {
          if (statusEl) statusEl.textContent = 'Erreur : ' + (data.msg || 'Échec du téléversement');
        }
      })
      .catch(function() {
        if (statusEl) statusEl.textContent = 'Erreur réseau.';
      });
  };

  // ---- Media picker modal ----
  window.openGalleryMediaPicker = function() {
    var modal = document.getElementById('gf-media-modal');
    modal.style.display = 'flex';
    gfLoadMediaGrid();
  };

  window.closeGalleryMediaPicker = function() {
    document.getElementById('gf-media-modal').style.display = 'none';
  };

  window.gfModalUpload = function(input) {
    if (!input.files || !input.files[0]) return;
    var fd = new FormData();
    fd.append('file', input.files[0]);
    fetch(BASE_URL + 'admin/upload_media', { method: 'POST', body: fd })
      .then(function(r) { return r.json(); })
      .then(function(data) {
        if (data.ok) {
          var fullUrl = BASE_URL + data.path;
          gfSelectImage(data.path, fullUrl);
        } else {
          alert('Erreur : ' + (data.msg || 'Échec du téléversement'));
        }
      });
  };

  function gfLoadMediaGrid() {
    var grid = document.getElementById('gf-media-grid');
    grid.innerHTML = '<div style="grid-column:1/-1;text-align:center;padding:2rem;color:#94a3b8;"><i class="fa-solid fa-spinner fa-spin"></i> Chargement…</div>';
    fetch(BASE_URL + 'admin/media_json')
      .then(function(r) { return r.json(); })
      .then(function(data) {
        if (!data.images || data.images.length === 0) {
          grid.innerHTML = '<div style="grid-column:1/-1;text-align:center;padding:2rem;color:#94a3b8;">Aucune image dans la médiathèque.</div>';
          return;
        }
        grid.innerHTML = '';
        data.images.forEach(function(img) {
          var url  = BASE_URL + img.path;
          var item = document.createElement('div');
          item.style.cssText = 'cursor:pointer;border-radius:8px;overflow:hidden;aspect-ratio:1;background:#f4f6fa;position:relative;border:2px solid transparent;transition:border-color 0.2s;';
          item.onmouseover = function() { this.style.borderColor = '#1D67CD'; };
          item.onmouseout  = function() { this.style.borderColor = 'transparent'; };
          item.onclick = function() { gfSelectImage(img.path, url); };
          item.innerHTML = '<img src="' + url + '" alt="' + img.original_name + '" title="' + img.original_name + '" style="width:100%;height:100%;object-fit:cover;" loading="lazy">';
          grid.appendChild(item);
        });
      });
  }

  // Close on backdrop click
  document.getElementById('gf-media-modal').addEventListener('click', function(e) {
    if (e.target === this) closeGalleryMediaPicker();
  });
})();
</script>
