// ================================================================
//  RSC CMS — Inline Editing System
//  Loaded only on the public site when admin is logged in.
//  Requires: CMS_BASE_URL (set by header.php before this script)
// ================================================================

'use strict';

/* ── State ──────────────────────────────────────────────────── */
const CMS_PAGE      = document.body.dataset.cmsPage || '';
let   editModeActive = false;
let   currentEditEl  = null;
let   cmsMediaCache  = null;

/* ── Toast ──────────────────────────────────────────────────── */
function cmsToast(msg, type = 'success') {
  const area = document.getElementById('cms-toast-area');
  if (!area) return;
  const el = document.createElement('div');
  el.className = 'cms-toast ' + type;
  el.innerHTML = '<i class="fa-solid ' + (type === 'success' ? 'fa-check' : 'fa-xmark') + '"></i> ' + msg;
  area.appendChild(el);
  setTimeout(() => { el.style.opacity = '0'; el.style.transition = 'opacity 0.3s'; }, 3500);
  setTimeout(() => el.remove(), 3900);
}

/* ── Edit Mode Toggle ───────────────────────────────────────── */
function cmsToggleEdit() {
  editModeActive = !editModeActive;
  document.body.classList.toggle('cms-edit-mode', editModeActive);

  const btn = document.getElementById('cms-edit-toggle');
  if (editModeActive) {
    btn.classList.add('active');
    btn.innerHTML = '<i class="fa-solid fa-eye"></i> Aperçu';
    initPencils();
    initSectionBars();
    cmsToast('Mode édition — cliquez sur ✏ pour modifier');
  } else {
    btn.classList.remove('active');
    btn.innerHTML = '<i class="fa-solid fa-pencil"></i> Mode Édition';
    removePencils();
    removeSectionBars();
  }
}

/* ── Pencil Icons ───────────────────────────────────────────── */
function initPencils() {
  document.querySelectorAll('[data-cms-key]').forEach(el => {
    if (el.querySelector('.cms-pencil-btn')) return;
    const key   = el.dataset.cmsKey;
    const type  = el.dataset.cmsType  || 'text';
    const label = el.dataset.cmsLabel || key;

    // Ensure position:relative so pencil can be absolute
    if (getComputedStyle(el).position === 'static') {
      el.style.position = 'relative';
    }

    const btn = document.createElement('button');
    btn.className   = 'cms-pencil-btn';
    btn.title       = 'Modifier : ' + label;
    btn.innerHTML   = '<i class="fa-solid fa-pencil" style="pointer-events:none;font-size:10px;"></i>';
    btn.addEventListener('click', function(e) {
      e.stopPropagation();
      e.preventDefault();
      openEditModal(key, type, label, el);
    });
    el.appendChild(btn);
  });
}

function removePencils() {
  document.querySelectorAll('.cms-pencil-btn').forEach(b => b.remove());
  document.querySelectorAll('[data-cms-key]').forEach(el => {
    if (el.getAttribute('style') === 'position: relative;') el.style.position = '';
  });
}

/* ── Edit Modal ─────────────────────────────────────────────── */
function openEditModal(key, type, label, el) {
  currentEditEl = el;
  const modal   = document.getElementById('cms-edit-modal');
  const titleEl = modal.querySelector('.cms-modal-title span');
  const fieldEl = modal.querySelector('.cms-modal-field');

  titleEl.textContent  = label;
  modal.dataset.cmsKey          = key;
  modal.dataset.cmsType         = type;
  modal.dataset.cmsPageOverride = el.dataset.cmsPage || '';

  fieldEl.innerHTML = '';

  if (type === 'text' || type === 'url') {
    // Prefer stored data-cms-value over visible text (avoids grabbing nested HTML)
    const raw = el.dataset.cmsValue !== undefined ? el.dataset.cmsValue
              : (el.innerText || el.textContent || '').trim();
    fieldEl.innerHTML = '<input type="text" id="cms-val" value="' + cmsEsc(raw) + '" autocomplete="off">';

  } else if (type === 'html') {
    const raw = el.dataset.cmsValue !== undefined ? el.dataset.cmsValue : '';
    fieldEl.innerHTML =
      '<textarea id="cms-val">' + cmsEsc(raw) + '</textarea>' +
      '<p class="cms-full-editor-note">' +
      '<i class="fa-solid fa-circle-info"></i> Pour la mise en forme avancée : ' +
      '<a href="' + CMS_BASE_URL + 'admin/page/' + CMS_PAGE + '" target="_blank">ouvrir l\'éditeur complet →</a></p>';

  } else if (type === 'image') {
    const currentPath = el.dataset.cmsValue || '';
    const currentSrc  = currentPath ? CMS_BASE_URL + currentPath : '';

    fieldEl.innerHTML =
      '<div id="cms-img-preview-wrap">' +
        (currentSrc
          ? '<img src="' + currentSrc + '" class="cms-img-preview" id="cms-img-cur">'
          : '<div class="cms-img-placeholder"><i class="fa-solid fa-image"></i> Aucune image sélectionnée</div>') +
      '</div>' +
      '<input type="hidden" id="cms-val" value="' + cmsEsc(currentPath) + '">' +
      '<p style="font-size:0.78rem;color:#64748b;margin:0.5rem 0 0.3rem;">Bibliothèque d\'images :</p>' +
      '<div class="cms-img-grid" id="cms-img-grid"><p style="color:#94a3b8;font-size:0.78rem;padding:0.4rem;">Chargement…</p></div>' +
      '<label class="cms-upload-label">' +
        '<i class="fa-solid fa-upload"></i> Téléverser une image' +
        '<input type="file" id="cms-upload-input" accept="image/*" style="display:none;">' +
      '</label>' +
      '<span id="cms-upload-status" style="font-size:0.75rem;color:#64748b;margin-left:0.5rem;"></span>';

    loadCmsMediaGrid();

    document.getElementById('cms-upload-input')
      .addEventListener('change', handleCmsUpload);
  }

  modal.classList.add('open');

  setTimeout(() => {
    const inp = document.getElementById('cms-val');
    if (inp && type !== 'image') inp.focus();
  }, 60);
}

function closeCmsModal() {
  document.getElementById('cms-edit-modal').classList.remove('open');
  currentEditEl = null;
}

async function saveCmsEdit() {
  const modal = document.getElementById('cms-edit-modal');
  const key   = modal.dataset.cmsKey;
  const type  = modal.dataset.cmsType;
  const page  = modal.dataset.cmsPageOverride || CMS_PAGE;
  const valEl = document.getElementById('cms-val');
  if (!valEl || !page) return;

  const value = valEl.value;
  const label = currentEditEl ? (currentEditEl.dataset.cmsLabel || key) : key;
  const saveBtn = modal.querySelector('.cms-btn-save');

  saveBtn.disabled    = true;
  saveBtn.textContent = 'Enregistrement…';

  try {
    const fd = new FormData();
    fd.append('page',  page);
    fd.append('key',   key);
    fd.append('type',  type);
    fd.append('value', value);
    fd.append('label', label);

    const r    = await fetch(CMS_BASE_URL + 'admin/inline_save', { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest' }, body: fd });
    const json = await r.json();

    if (json.ok) {
      // Visual feedback on element
      if (currentEditEl) {
        currentEditEl.classList.add('cms-saving');
        setTimeout(() => currentEditEl.classList.remove('cms-saving'), 2000);
      }
      cmsToast('Enregistré !');
      closeCmsModal();
      // Reload to show fresh content
      setTimeout(() => location.reload(), 800);
    } else {
      cmsToast(json.msg || 'Erreur lors de la sauvegarde', 'error');
    }
  } catch(e) {
    cmsToast('Erreur réseau', 'error');
  }

  saveBtn.disabled    = false;
  saveBtn.textContent = 'Enregistrer';
}

/* ── Media Picker ───────────────────────────────────────────── */
async function loadCmsMediaGrid() {
  const grid = document.getElementById('cms-img-grid');
  if (!grid) return;

  try {
    if (!cmsMediaCache) {
      const r   = await fetch(CMS_BASE_URL + 'admin/media_json');
      cmsMediaCache = await r.json();
    }
    const imgs = cmsMediaCache.images || [];

    if (imgs.length === 0) {
      grid.innerHTML = '<p style="color:#94a3b8;font-size:0.78rem;padding:0.4rem;">Aucune image. Téléversez-en une ci-dessous.</p>';
      return;
    }

    grid.innerHTML = imgs.map(img =>
      '<img src="' + CMS_BASE_URL + cmsEsc(img.path) + '"' +
      ' class="cms-img-thumb"' +
      ' title="' + cmsEsc(img.original_name) + '"' +
      ' data-path="' + cmsEsc(img.path) + '"' +
      ' onclick="selectCmsImage(\'' + cmsEsc(img.path) + '\', this)">'
    ).join('');

    // Mark currently selected
    const currentVal = document.getElementById('cms-val');
    if (currentVal && currentVal.value) {
      const thumb = grid.querySelector('[data-path="' + currentVal.value + '"]');
      if (thumb) thumb.classList.add('selected');
    }
  } catch(e) {
    const grid2 = document.getElementById('cms-img-grid');
    if (grid2) grid2.innerHTML = '<p style="color:#ef4444;font-size:0.78rem;padding:0.4rem;">Erreur de chargement</p>';
  }
}

function selectCmsImage(path, thumbEl) {
  const valEl = document.getElementById('cms-val');
  if (valEl) valEl.value = path;

  document.querySelectorAll('.cms-img-thumb').forEach(t => t.classList.remove('selected'));
  if (thumbEl) thumbEl.classList.add('selected');

  const wrap = document.getElementById('cms-img-preview-wrap');
  if (wrap) {
    wrap.innerHTML = '<img src="' + CMS_BASE_URL + path + '" class="cms-img-preview">';
  }
}

async function handleCmsUpload(e) {
  const file = e.target.files[0];
  if (!file) return;

  const status = document.getElementById('cms-upload-status');
  if (status) status.textContent = 'Téléversement…';

  const fd = new FormData();
  fd.append('file', file);

  try {
    const r    = await fetch(CMS_BASE_URL + 'admin/upload_media', { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest' }, body: fd });
    const json = await r.json();

    if (json.ok) {
      cmsMediaCache = null; // invalidate cache
      if (status) status.textContent = '✓ Téléversé !';
      await loadCmsMediaGrid();
      selectCmsImage(json.path, null);
    } else {
      if (status) status.textContent = 'Erreur : ' + (json.msg || '');
    }
  } catch(e2) {
    if (status) status.textContent = 'Erreur réseau';
  }
}

/* ── Section Controls ───────────────────────────────────────── */
function initSectionBars() {
  document.querySelectorAll('[data-cms-section]').forEach(section => {
    if (section.querySelector('.cms-section-bar')) return;

    const sKey    = section.dataset.cmsSection;
    const label   = section.dataset.cmsSectionLabel || sKey;
    const isHidden = section.dataset.cmsHidden === '1';

    if (getComputedStyle(section).position === 'static') {
      section.style.position = 'relative';
    }

    const bar = document.createElement('div');
    bar.className = 'cms-section-bar';
    bar.innerHTML =
      '<span class="cms-sec-label">' + cmsEsc(label) + '</span>' +
      '<div class="cms-tb-sep"></div>' +
      '<button class="cms-sec-btn hide-btn" onclick="cmsToggleSection(\'' + cmsEsc(sKey) + '\', this.closest(\'[data-cms-section]\'))">' +
        '<i class="fa-solid ' + (isHidden ? 'fa-eye' : 'fa-eye-slash') + '"></i> ' +
        (isHidden ? 'Afficher' : 'Masquer') +
      '</button>';
    section.appendChild(bar);

    if (isHidden) {
      const badge = document.createElement('div');
      badge.className = 'cms-hidden-badge';
      badge.innerHTML = '<i class="fa-solid fa-eye-slash"></i> Section masquée';
      section.appendChild(badge);
    }
  });
}

function removeSectionBars() {
  document.querySelectorAll('.cms-section-bar, .cms-hidden-badge').forEach(el => el.remove());
  document.querySelectorAll('[data-cms-section]').forEach(el => {
    if (el.style.position === 'relative') el.style.position = '';
  });
}

async function cmsToggleSection(sKey, sectionEl) {
  const isHidden = sectionEl.dataset.cmsHidden === '1';
  const newVisible = isHidden ? '1' : '0';

  const fd = new FormData();
  fd.append('page',    sectionEl.dataset.cmsPage || CMS_PAGE);
  fd.append('section', sKey);
  fd.append('visible', newVisible);

  try {
    const r    = await fetch(CMS_BASE_URL + 'admin/toggle_section', { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest' }, body: fd });
    const json = await r.json();

    if (json.ok) {
      cmsToast(isHidden ? 'Section rendue visible' : 'Section masquée');
      // Reload to apply changes
      setTimeout(() => location.reload(), 700);
    } else {
      cmsToast('Erreur', 'error');
    }
  } catch(e) {
    cmsToast('Erreur réseau', 'error');
  }
}

/* ── Nav Manager ────────────────────────────────────────────── */
function cmsOpenNavManager() {
  const modal = document.getElementById('cms-nav-manager');
  if (modal) modal.style.display = 'flex';
}

function cmsCloseNavManager() {
  const modal = document.getElementById('cms-nav-manager');
  if (modal) modal.style.display = 'none';
}

async function cmsToggleNavItem(key, newVisible) {
  const btn = document.getElementById('cms-nav-btn-' + key);
  if (btn) { btn.disabled = true; btn.textContent = '…'; }

  const fd = new FormData();
  fd.append('page',    'global');
  fd.append('section', 'nav_' + key);
  fd.append('visible', newVisible);

  try {
    const r    = await fetch(CMS_BASE_URL + 'admin/toggle_section', { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest' }, body: fd });
    const json = await r.json();

    if (json.ok) {
      const isNowHidden = newVisible === '0';
      const row = document.getElementById('cms-nav-row-' + key);
      const ico = document.getElementById('cms-nav-ico-' + key);

      if (row) row.classList.toggle('is-hidden', isNowHidden);
      if (ico) {
        ico.className = 'fa-solid ' + (isNowHidden ? 'fa-eye-slash' : 'fa-eye');
      }
      if (btn) {
        btn.disabled   = false;
        btn.textContent = isNowHidden ? 'Afficher' : 'Masquer';
        btn.className  = 'cms-nav-mgr-toggle ' + (isNowHidden ? 'show' : 'hide');
        btn.setAttribute('onclick', "cmsToggleNavItem('" + key + "', '" + (isNowHidden ? '1' : '0') + "')");
      }
      cmsToast(isNowHidden ? 'Lien masqué' : 'Lien affiché');
      setTimeout(() => location.reload(), 900);
    } else {
      cmsToast('Erreur', 'error');
      if (btn) { btn.disabled = false; btn.textContent = newVisible === '0' ? 'Masquer' : 'Afficher'; }
    }
  } catch(e) {
    cmsToast('Erreur réseau', 'error');
    if (btn) { btn.disabled = false; }
  }
}

/* ── Helpers ────────────────────────────────────────────────── */
function cmsEsc(str) {
  return String(str || '')
    .replace(/&/g,  '&amp;')
    .replace(/</g,  '&lt;')
    .replace(/>/g,  '&gt;')
    .replace(/"/g,  '&quot;')
    .replace(/'/g,  '&#039;');
}

/* ── Keyboard ───────────────────────────────────────────────── */
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') { closeCmsModal(); cmsCloseNavManager(); }
  if ((e.ctrlKey || e.metaKey) && e.key === 'e') {
    e.preventDefault();
    cmsToggleEdit();
  }
});

/* ── Backdrop clicks — guarded to avoid null errors ─────────── */
(function() {
  var editModal = document.getElementById('cms-edit-modal');
  if (editModal) {
    editModal.addEventListener('click', function(e) {
      if (e.target === this) closeCmsModal();
    });
  }
  var navMgr = document.getElementById('cms-nav-manager');
  if (navMgr) {
    navMgr.addEventListener('click', function(e) {
      if (e.target === this) cmsCloseNavManager();
    });
  }
})();
