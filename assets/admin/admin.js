/* ================================================================
   RSC Admin Panel — JavaScript
   ================================================================ */

// BASE_URL est injecté dans le layout : const BASE_URL = '...';

/* ============================
   SIDEBAR MOBILE
   ============================ */
const sidebarToggle  = document.getElementById('sidebarToggle');
const sidebar        = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');

function closeSidebar() {
  sidebar && sidebar.classList.remove('open');
  sidebarOverlay && sidebarOverlay.classList.remove('open');
}

if (sidebarToggle) {
  sidebarToggle.addEventListener('click', function () {
    sidebar.classList.toggle('open');
    sidebarOverlay.classList.toggle('open');
  });
}

/* ============================
   TOAST
   ============================ */
function showToast(msg, type) {
  type = type || 'success';
  var container = document.getElementById('toast-container');
  if (!container) return;

  var icons = { success: 'fa-check-circle', error: 'fa-circle-exclamation', info: 'fa-circle-info' };
  var toast = document.createElement('div');
  toast.className = 'toast ' + type;
  toast.innerHTML = '<i class="fa-solid ' + (icons[type] || icons.success) + '"></i> ' + msg;
  container.appendChild(toast);
  setTimeout(function () { toast.remove(); }, 4500);
}

/* ============================
   TINYMCE INIT
   ============================ */
if (typeof tinymce !== 'undefined') {
  tinymce.init({
    selector: 'textarea.tinymce',
    height: 260,
    menubar: false,
    plugins: 'link lists table',
    toolbar: 'undo redo | bold italic underline | bullist numlist | link | removeformat',
    content_style: 'body { font-family: Inter, -apple-system, sans-serif; font-size: 14px; line-height: 1.7; color: #0f172a; }',
    branding: false,
    statusbar: false,
    language: 'fr_FR',
  });
}

/* ============================
   ENREGISTRER LES BLOCS (AJAX)
   ============================ */
var saveBtn = document.getElementById('save-btn');
if (saveBtn) {
  saveBtn.addEventListener('click', function () {
    var page   = document.getElementById('current-page');
    if (!page) return;

    var formData = new FormData();
    formData.append('page', page.value);

    var fields = document.querySelectorAll('.editor-field');
    var i = 0;
    fields.forEach(function (field) {
      var key   = field.dataset.key;
      var type  = field.dataset.type;
      var label = '';
      var lbl   = field.querySelector('.field-label');
      if (lbl) label = lbl.textContent.trim();
      var value = '';

      if (type === 'html') {
        var ta = field.querySelector('textarea');
        if (ta && typeof tinymce !== 'undefined') {
          var ed = tinymce.get(ta.id);
          value = ed ? ed.getContent() : ta.value;
        } else if (ta) {
          value = ta.value;
        }
      } else {
        var inp = field.querySelector('.field-input');
        if (inp) value = inp.value;
      }

      formData.append('blocks[' + i + '][key]',   key);
      formData.append('blocks[' + i + '][type]',  type);
      formData.append('blocks[' + i + '][label]', label);
      formData.append('blocks[' + i + '][value]', value);
      i++;
    });

    var btn = saveBtn;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Enregistrement…';

    var statusEl = document.getElementById('save-status');

    fetch(BASE_URL + 'admin/save_blocks', {
      method: 'POST',
      body: formData
    })
    .then(function (r) { return r.json(); })
    .then(function (data) {
      btn.disabled = false;
      btn.innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Enregistrer les modifications';
      if (data.ok) {
        showToast('Modifications enregistrées avec succès !', 'success');
        if (statusEl) {
          statusEl.className = 'save-status success';
          statusEl.innerHTML = '<i class="fa-solid fa-check"></i> Enregistré';
          setTimeout(function () { statusEl.innerHTML = ''; }, 3000);
        }
      } else {
        showToast(data.msg || "Erreur lors de l'enregistrement.", 'error');
      }
    })
    .catch(function () {
      btn.disabled = false;
      btn.innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Enregistrer les modifications';
      showToast('Erreur réseau. Vérifiez votre connexion.', 'error');
    });
  });
}

/* ============================
   MEDIA PICKER (modal)
   ============================ */
var currentImageField = null;

function openMediaPicker(fieldKey) {
  currentImageField = fieldKey;
  var modal = document.getElementById('media-modal');
  if (!modal) return;
  modal.classList.add('open');
  loadMediaGrid();
}

function closeMediaPicker() {
  var modal = document.getElementById('media-modal');
  if (modal) modal.classList.remove('open');
  currentImageField = null;
}

function loadMediaGrid() {
  var grid = document.getElementById('media-grid-picker');
  if (!grid) return;
  grid.innerHTML = '<div class="media-loading"><i class="fa-solid fa-spinner fa-spin"></i> Chargement…</div>';

  fetch(BASE_URL + 'admin/media_json')
    .then(function (r) { return r.json(); })
    .then(function (data) {
      if (!data.images || data.images.length === 0) {
        grid.innerHTML = '<div class="media-loading">Aucune image disponible. <a href="' + BASE_URL + 'admin/media">Téléversez des images d\'abord.</a></div>';
        return;
      }
      grid.innerHTML = data.images.map(function (img) {
        return '<div class="media-item pickable" onclick="selectImage(\'' + img.path + '\', \'' + img.original_name.replace(/'/g,'') + '\')" title="' + img.original_name + '">' +
          '<img src="' + BASE_URL + img.path + '" alt="' + img.original_name + '" loading="lazy">' +
          '<div class="media-item-info"><div class="media-item-name">' + img.original_name + '</div></div>' +
          '</div>';
      }).join('');
    })
    .catch(function () {
      grid.innerHTML = '<div class="media-loading">Erreur de chargement.</div>';
    });
}

function selectImage(path, name) {
  if (!currentImageField) return;
  var field = document.querySelector('[data-key="' + currentImageField + '"]');
  if (!field) return;

  // Mettre à jour l'input caché
  var hiddenInput = field.querySelector('.field-image');
  if (hiddenInput) hiddenInput.value = path;

  // Mettre à jour la prévisualisation
  var preview = field.querySelector('.current-image-preview');
  if (!preview) {
    preview = document.createElement('div');
    preview.className = 'current-image-preview';
    var wrap = field.querySelector('.field-image-wrap');
    if (wrap) wrap.insertBefore(preview, wrap.firstChild);
  }
  preview.classList.remove('hidden');
  preview.innerHTML = '<img src="' + BASE_URL + path + '" alt=""><span class="image-filename">' + path + '</span>';

  closeMediaPicker();
  showToast('Image sélectionnée.', 'success');
}

// Boutons "Choisir depuis la médiathèque"
document.querySelectorAll('.open-media-picker').forEach(function (btn) {
  btn.addEventListener('click', function () {
    openMediaPicker(this.dataset.field);
  });
});

// Upload rapide depuis modal
var modalUploadInput = document.getElementById('modal-upload-input');
if (modalUploadInput) {
  modalUploadInput.addEventListener('change', function () {
    if (!this.files || !this.files[0]) return;
    uploadFileToMedia(this.files[0], function () { loadMediaGrid(); });
  });
}

// Upload rapide depuis champ image (bouton "Téléverser")
document.querySelectorAll('.quick-upload').forEach(function (input) {
  input.addEventListener('change', function () {
    if (!this.files || !this.files[0]) return;
    var fieldKey = this.dataset.field;
    uploadFileToMedia(this.files[0], function (result) {
      if (result && result.ok) selectImage(result.path, result.name);
    });
  });
});

function uploadFileToMedia(file, callback) {
  var fd = new FormData();
  fd.append('file', file);
  showToast('Téléversement en cours…', 'info');
  fetch(BASE_URL + 'admin/upload_media', { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest' }, body: fd })
    .then(function (r) { return r.json(); })
    .then(function (data) {
      if (data.ok) {
        showToast('Image téléversée avec succès !', 'success');
        if (callback) callback(data);
      } else {
        showToast(data.msg || 'Erreur téléversement.', 'error');
        if (callback) callback(null);
      }
    })
    .catch(function () {
      showToast('Erreur réseau.', 'error');
      if (callback) callback(null);
    });
}

// Bouton "Supprimer" image
document.querySelectorAll('.btn-clear-image').forEach(function (btn) {
  btn.addEventListener('click', function () {
    var fieldKey = this.dataset.field;
    var field    = document.querySelector('[data-key="' + fieldKey + '"]');
    if (!field) return;
    var hidden  = field.querySelector('.field-image');
    var preview = field.querySelector('.current-image-preview');
    if (hidden)  hidden.value = '';
    if (preview) preview.classList.add('hidden');
  });
});

/* ============================
   COPIER CHEMIN IMAGE (médiathèque)
   ============================ */
document.querySelectorAll('.btn-copy-path').forEach(function (btn) {
  btn.addEventListener('click', function (e) {
    e.preventDefault();
    e.stopPropagation();
    var path = this.dataset.path;
    navigator.clipboard.writeText(path)
      .then(function () { showToast('Chemin copié : ' + path, 'info'); })
      .catch(function () { showToast('Impossible de copier.', 'error'); });
  });
});

/* ============================
   UPLOAD ZONE (glisser-déposer)
   ============================ */
var uploadZone  = document.getElementById('upload-zone');
var fileInput   = document.getElementById('file-input');
var fileNameEl  = document.getElementById('selected-filename');

if (uploadZone && fileInput) {
  uploadZone.addEventListener('click', function () { fileInput.click(); });

  uploadZone.addEventListener('dragover', function (e) {
    e.preventDefault();
    uploadZone.classList.add('drag-over');
  });
  uploadZone.addEventListener('dragleave', function () {
    uploadZone.classList.remove('drag-over');
  });
  uploadZone.addEventListener('drop', function (e) {
    e.preventDefault();
    uploadZone.classList.remove('drag-over');
    if (e.dataTransfer.files.length > 0) {
      fileInput.files = e.dataTransfer.files;
      if (fileNameEl) fileNameEl.textContent = e.dataTransfer.files[0].name;
    }
  });

  fileInput.addEventListener('change', function () {
    if (this.files.length > 0 && fileNameEl) {
      fileNameEl.textContent = this.files[0].name;
    }
  });
}
