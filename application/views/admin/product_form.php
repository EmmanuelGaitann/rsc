<?php $is_edit = !empty($product); ?>

<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title">
      <i class="fa-solid <?= $is_edit ? 'fa-pencil' : 'fa-plus' ?> fa-fw"></i>
      <?= $is_edit ? 'Modifier le produit' : 'Nouveau produit' ?>
    </h1>
    <?php if ($is_edit): ?>
    <p class="admin-page-subtitle"><?= htmlspecialchars($product->name) ?><?= $product->model ? ' — ' . htmlspecialchars($product->model) : '' ?></p>
    <?php endif; ?>
  </div>
  <a href="<?= base_url('admin/products') ?>" class="btn btn-outline">
    <i class="fa-solid fa-arrow-left"></i> Retour
  </a>
</div>

<?php if (!empty($error)): ?>
<div style="background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;padding:0.8rem 1rem;border-radius:8px;margin-bottom:1.5rem;">
  <i class="fa-solid fa-xmark"></i> <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<?php
/* Build brand / category maps for JS */
$brands_js = [];
foreach ($brands as $b) {
    $brands_js[$b->slug] = ['name' => $b->name, 'color' => $b->color];
}
$cats_js = [];
foreach ($categories as $cat) {
    $cats_js[$cat->slug] = $cat->name;
}
$cur_brand = $is_edit ? $product->brand : ($brands ? $brands[0]->slug : 'other');
$cur_brand_color = '#64748b';
foreach ($brands as $b) { if ($b->slug === $cur_brand) { $cur_brand_color = $b->color; break; } }
?>

<form method="post" id="pf-form"
      action="<?= $is_edit ? base_url('admin/product_do_edit/' . $product->id) : base_url('admin/product_do_new') ?>">
  <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

  <div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start;">

    <!-- ============================================================
         COLONNE GAUCHE — Formulaire
    ============================================================ -->
    <div>

      <!-- Informations principales -->
      <div class="editor-section" style="margin-bottom:1.25rem;">
        <h3 class="editor-section-title">Informations du produit</h3>

        <div class="form-group">
          <label class="form-label">Nom du produit <span style="color:#ef4444;">*</span></label>
          <input type="text" name="name" id="pf-name" class="form-control"
                 value="<?= $is_edit ? htmlspecialchars($product->name) : '' ?>"
                 placeholder="Ex : Compresseur à vis RENNER RS-PRO" required>
        </div>

        <div class="form-group">
          <label class="form-label">Référence / Modèle</label>
          <input type="text" name="model" id="pf-model" class="form-control"
                 value="<?= $is_edit ? htmlspecialchars($product->model) : '' ?>"
                 placeholder="Ex : 7,5 kW — 10 bar — 1 100 l/min">
          <small style="color:#94a3b8;font-size:0.75rem;">Spécifications techniques courtes affichées sous le nom.</small>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
          <div class="form-group" style="margin-bottom:0;">
            <label class="form-label">Fabricant <span style="color:#ef4444;">*</span></label>
            <div style="display:flex;align-items:center;gap:0.5rem;">
              <span id="pf-brand-dot" style="width:12px;height:12px;border-radius:50%;background:<?= $cur_brand_color ?>;flex-shrink:0;"></span>
              <select name="brand" id="pf-brand" class="form-control" required style="flex:1;">
                <?php foreach ($brands as $b): ?>
                <option value="<?= htmlspecialchars($b->slug) ?>"
                  <?= ($is_edit && $product->brand === $b->slug) ? 'selected' : (!$is_edit && $b === $brands[0] ? 'selected' : '') ?>
                  data-color="<?= htmlspecialchars($b->color) ?>">
                  <?= htmlspecialchars($b->name) ?>
                </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group" style="margin-bottom:0;">
            <label class="form-label">Catégorie <span style="color:#ef4444;">*</span></label>
            <select name="category" id="pf-category" class="form-control" required>
              <?php foreach ($categories as $cat): ?>
              <option value="<?= htmlspecialchars($cat->slug) ?>"
                <?= ($is_edit && $product->category === $cat->slug) ? 'selected' : (!$is_edit && $cat === $categories[0] ? 'selected' : '') ?>>
                <?= htmlspecialchars($cat->name) ?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>

      <!-- Image & Options -->
      <div class="editor-section" style="margin-bottom:1.25rem;">
        <h3 class="editor-section-title">Image & Options</h3>

        <div class="form-group">
          <label class="form-label">Image du produit</label>
          <div style="display:flex;gap:0.5rem;align-items:center;">
            <input type="text" name="image" id="pf-image" class="form-control"
                   value="<?= $is_edit ? htmlspecialchars($product->image) : '' ?>"
                   placeholder="URL https://... ou assets/uploads/fichier.jpg">
            <button type="button" class="btn btn-outline btn-sm" onclick="openProdMediaPicker()" title="Médiathèque">
              <i class="fa-solid fa-images"></i>
            </button>
          </div>
          <small style="color:#94a3b8;font-size:0.75rem;">URL externe ou chemin depuis la médiathèque.</small>
        </div>

        <div class="form-group">
          <label class="form-label">URL bouton "Demander un devis"</label>
          <input type="text" name="cta_url" class="form-control"
                 value="<?= $is_edit ? htmlspecialchars($product->cta_url) : '' ?>"
                 placeholder="Laisser vide → /contact?product=nom automatique">
          <small style="color:#94a3b8;font-size:0.75rem;">Vide = lien automatique vers la page contact avec le nom du produit.</small>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;align-items:end;">
          <div class="form-group" style="margin-bottom:0;">
            <label class="form-label">Ordre d'affichage</label>
            <input type="number" name="sort_order" class="form-control" min="0"
                   value="<?= $is_edit ? (int)$product->sort_order : '0' ?>">
            <small style="color:#94a3b8;font-size:0.75rem;">Plus petit = apparaît en premier (0 = début).</small>
          </div>
          <?php if ($is_edit): ?>
          <div class="form-group" style="margin-bottom:0;">
            <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;margin-top:1.5rem;">
              <input type="checkbox" name="visible" value="1" <?= $product->visible ? 'checked' : '' ?>>
              <span class="form-label" style="margin:0;">Visible sur le site</span>
            </label>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Description -->
      <div class="editor-section" style="margin-bottom:1.25rem;">
        <h3 class="editor-section-title">
          Description
          <span id="pf-desc-count" style="font-size:0.72rem;font-weight:400;color:#94a3b8;margin-left:0.5rem;">0 / 200</span>
        </h3>
        <div class="form-group" style="margin-bottom:0;">
          <textarea name="description" id="pf-desc" class="form-control" rows="4" maxlength="200"
                    placeholder="Caractéristiques techniques, puissance, applications, avantages..."><?= $is_edit ? htmlspecialchars($product->description) : '' ?></textarea>
        </div>
      </div>

    </div><!-- /colonne gauche -->

    <!-- ============================================================
         COLONNE DROITE — Aperçu live
    ============================================================ -->
    <div style="position:sticky;top:1.5rem;">
      <div class="editor-section">
        <h3 class="editor-section-title" style="margin-bottom:1rem;">
          <i class="fa-solid fa-eye" style="color:var(--primary);margin-right:0.35rem;"></i>Aperçu en direct
        </h3>

        <!-- Carte prévisualisation -->
        <div id="pf-preview-card" style="border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,0.07);position:relative;">
          <!-- Badge fabricant -->
          <span id="pf-prev-badge"
                style="position:absolute;top:0.55rem;right:0.55rem;z-index:2;font-size:0.58rem;font-weight:800;text-transform:uppercase;letter-spacing:0.09em;padding:0.2rem 0.6rem;border-radius:50px;color:white;background:<?= $cur_brand_color ?>;display:<?= ($is_edit && $product->brand && !empty($brands_js[$product->brand])) ? 'inline' : 'none' ?>;">
            <?= $is_edit ? htmlspecialchars($brands_js[$product->brand]['name'] ?? '') : '' ?>
          </span>

          <!-- Image -->
          <div id="pf-prev-img-wrap" style="height:160px;background:#f4f6fa;display:flex;align-items:center;justify-content:center;overflow:hidden;">
            <?php
              $pi = $is_edit && $product->image ? $product->image : '';
              $pi_src = $pi ? (strpos($pi,'http')===0 ? htmlspecialchars($pi) : base_url(htmlspecialchars($pi))) : '';
            ?>
            <img id="pf-prev-img" src="<?= $pi_src ?>"
                 style="max-height:160px;max-width:100%;object-fit:contain;<?= $pi_src ? '' : 'display:none;' ?>">
            <i id="pf-prev-img-ph" class="fa-solid fa-image"
               style="font-size:2.5rem;color:#cbd5e1;<?= $pi_src ? 'display:none;' : '' ?>"></i>
          </div>

          <!-- Corps -->
          <div style="padding:0.9rem 1rem;">
            <div id="pf-prev-cat" style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:0.35rem;color:<?= $cur_brand_color ?>;">
              <?php
                $cur_cat = $is_edit ? ($product->category ?? '') : ($categories ? $categories[0]->slug : '');
                echo isset($cats_js[$cur_cat]) ? htmlspecialchars($cats_js[$cur_cat]) : '';
              ?>
            </div>
            <div id="pf-prev-name" style="font-size:0.95rem;font-weight:700;color:#0f172a;line-height:1.3;margin-bottom:0.25rem;">
              <?= $is_edit ? htmlspecialchars($product->name) : '<span style="color:#94a3b8;">Nom du produit</span>' ?>
            </div>
            <div id="pf-prev-model" style="font-size:0.75rem;color:#64748b;margin-bottom:0.5rem;<?= ($is_edit && $product->model) ? '' : 'display:none;' ?>">
              <?= $is_edit ? htmlspecialchars($product->model) : '' ?>
            </div>
            <div id="pf-prev-desc" style="font-size:0.8rem;color:#475569;line-height:1.5;margin-bottom:0.75rem;<?= ($is_edit && $product->description) ? '' : 'display:none;' ?>">
              <?= $is_edit ? htmlspecialchars($product->description) : '' ?>
            </div>
            <span style="display:inline-block;padding:0.35rem 0.9rem;border-radius:6px;font-size:0.75rem;font-weight:600;color:white;background:var(--primary);">
              Demander un devis
            </span>
          </div>
        </div>

        <p style="font-size:0.72rem;color:#94a3b8;margin-top:0.75rem;line-height:1.4;">
          <i class="fa-solid fa-circle-info"></i>
          Aperçu fidèle à la carte produit publique. Mise à jour en temps réel.
        </p>
      </div>
    </div><!-- /colonne droite -->

  </div>

  <!-- Barre d'actions sticky -->
  <div class="editor-actions" style="position:sticky;bottom:0;background:white;padding:1rem 0;border-top:1px solid var(--border);margin-top:1.5rem;">
    <button type="submit" class="btn btn-primary btn-lg">
      <i class="fa-solid fa-check"></i>
      <?= $is_edit ? 'Mettre à jour' : 'Ajouter le produit' ?>
    </button>
    <a href="<?= base_url('admin/products') ?>" class="btn btn-outline btn-lg">Annuler</a>
  </div>

</form>

<!-- Modal médiathèque -->
<div id="pf-media-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.55);z-index:9999;align-items:center;justify-content:center;">
  <div style="background:white;border-radius:12px;width:min(700px,95vw);max-height:82vh;display:flex;flex-direction:column;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,0.3);">
    <div style="padding:1rem 1.5rem;border-bottom:1px solid #e2e8f0;display:flex;justify-content:space-between;align-items:center;">
      <h3 style="margin:0;font-size:1rem;font-weight:600;"><i class="fa-solid fa-images" style="color:#2563eb;margin-right:0.5rem;"></i>Choisir une image</h3>
      <button type="button" onclick="closeProdMediaPicker()" style="background:none;border:none;cursor:pointer;font-size:1.5rem;color:#64748b;line-height:1;">&times;</button>
    </div>
    <div id="pf-media-grid" style="padding:1.25rem;overflow-y:auto;display:grid;grid-template-columns:repeat(auto-fill,minmax(110px,1fr));gap:0.75rem;">
      <div style="color:#94a3b8;text-align:center;padding:2rem;grid-column:1/-1;"><i class="fa-solid fa-spinner fa-spin"></i> Chargement...</div>
    </div>
  </div>
</div>

<script>
const PF_BRANDS = <?= json_encode($brands_js, JSON_UNESCAPED_UNICODE) ?>;
const PF_CATS   = <?= json_encode($cats_js,   JSON_UNESCAPED_UNICODE) ?>;

function pfUpdatePreview() {
  const name  = document.getElementById('pf-name').value.trim();
  const model = document.getElementById('pf-model').value.trim();
  const desc  = document.getElementById('pf-desc').value.trim();
  const brand = document.getElementById('pf-brand').value;
  const cat   = document.getElementById('pf-category').value;
  const imgVal= document.getElementById('pf-image').value.trim();

  const bInfo  = PF_BRANDS[brand] || { name: brand, color: '#64748b' };
  const catName= PF_CATS[cat] || cat;
  const color  = bInfo.color;

  /* Badge */
  const badge = document.getElementById('pf-prev-badge');
  if (bInfo.name) {
    badge.textContent = bInfo.name;
    badge.style.background = color;
    badge.style.display = 'inline';
  } else {
    badge.style.display = 'none';
  }

  /* Brand dot */
  document.getElementById('pf-brand-dot').style.background = color;

  /* Category label */
  document.getElementById('pf-prev-cat').textContent = catName;
  document.getElementById('pf-prev-cat').style.color  = color;

  /* Name */
  const nameEl = document.getElementById('pf-prev-name');
  if (name) {
    nameEl.textContent = name;
    nameEl.style.color = '#0f172a';
  } else {
    nameEl.innerHTML = '<span style="color:#94a3b8;">Nom du produit</span>';
  }

  /* Model */
  const modelEl = document.getElementById('pf-prev-model');
  modelEl.textContent = model;
  modelEl.style.display = model ? '' : 'none';

  /* Description */
  const descEl = document.getElementById('pf-prev-desc');
  descEl.textContent = desc;
  descEl.style.display = desc ? '' : 'none';

  /* Image */
  const imgSrc = imgVal ? (imgVal.startsWith('http') ? imgVal : BASE_URL + imgVal) : '';
  const imgEl  = document.getElementById('pf-prev-img');
  const imgPh  = document.getElementById('pf-prev-img-ph');
  if (imgSrc) {
    imgEl.src = imgSrc;
    imgEl.style.display = '';
    imgPh.style.display = 'none';
  } else {
    imgEl.style.display = 'none';
    imgPh.style.display = '';
  }
}

/* Description char counter */
const descEl = document.getElementById('pf-desc');
const countEl= document.getElementById('pf-desc-count');
function updateCount() {
  const len = descEl.value.length;
  countEl.textContent = len + ' / 200';
  countEl.style.color = len > 180 ? '#ef4444' : '#94a3b8';
}

/* Watch all inputs */
['pf-name','pf-model','pf-image','pf-desc'].forEach(id => {
  document.getElementById(id).addEventListener('input', pfUpdatePreview);
});
['pf-brand','pf-category'].forEach(id => {
  document.getElementById(id).addEventListener('change', pfUpdatePreview);
});
document.getElementById('pf-desc').addEventListener('input', updateCount);

/* Brand dropdown → update dot color */
document.getElementById('pf-brand').addEventListener('change', function () {
  const opt = this.options[this.selectedIndex];
  document.getElementById('pf-brand-dot').style.background = opt.dataset.color || '#64748b';
});

/* Init */
updateCount();
pfUpdatePreview();

/* Médiathèque */
function openProdMediaPicker() {
  const modal = document.getElementById('pf-media-modal');
  modal.style.display = 'flex';
  fetch(BASE_URL + 'admin/media_json')
    .then(r => r.json())
    .then(data => {
      const grid = document.getElementById('pf-media-grid');
      if (!data.images || !data.images.length) {
        grid.innerHTML = '<p style="color:#94a3b8;text-align:center;padding:2rem;grid-column:1/-1;">Aucune image.<br><a href="' + BASE_URL + 'admin/media" target="_blank">Uploader</a></p>';
        return;
      }
      grid.innerHTML = data.images.map(img => `
        <div onclick="selectProdImage('${img.path}')"
             style="cursor:pointer;border-radius:8px;overflow:hidden;border:2px solid transparent;transition:border-color 0.15s;"
             onmouseover="this.style.borderColor='#2563eb'" onmouseout="this.style.borderColor='transparent'">
          <img src="${BASE_URL}${img.path}" style="width:100%;aspect-ratio:1;object-fit:cover;" loading="lazy">
          <div style="padding:0.2rem 0.35rem;font-size:0.62rem;color:#64748b;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">${img.original_name}</div>
        </div>
      `).join('');
    })
    .catch(() => {
      document.getElementById('pf-media-grid').innerHTML = '<p style="color:#dc2626;grid-column:1/-1;text-align:center;padding:2rem;">Erreur de chargement.</p>';
    });
}

function selectProdImage(path) {
  document.getElementById('pf-image').value = path;
  pfUpdatePreview();
  closeProdMediaPicker();
}

function closeProdMediaPicker() {
  document.getElementById('pf-media-modal').style.display = 'none';
}

document.getElementById('pf-media-modal').addEventListener('click', function (e) {
  if (e.target === this) closeProdMediaPicker();
});
</script>
