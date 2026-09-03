<div class="page-editor-header">
  <div>
    <div class="page-editor-breadcrumb">
      <a href="<?= base_url('admin') ?>">Tableau de bord</a>
      <i class="fa-solid fa-chevron-right"></i>
      <span><?= htmlspecialchars($page_def['title']) ?></span>
    </div>
    <h1><i class="fa-solid <?= $page_def['icon'] ?>"></i> <?= htmlspecialchars($page_def['title']) ?></h1>
  </div>
  <?php if (!empty($page_def['route'])): ?>
  <a href="<?= base_url($page_def['route']) ?>" target="_blank" class="btn btn-outline">
    <i class="fa-solid fa-arrow-up-right-from-square"></i> Voir la page
  </a>
  <?php else: ?>
  <a href="<?= base_url() ?>" target="_blank" class="btn btn-outline">
    <i class="fa-solid fa-arrow-up-right-from-square"></i> Voir le site
  </a>
  <?php endif; ?>
</div>

<?php foreach ($page_def['sections'] as $si => $section): ?>
<div class="editor-section">
  <div class="editor-section-title">
    <i class="fa-solid fa-pen-to-square"></i>
    <?= htmlspecialchars($section['label']) ?>
  </div>

  <?php foreach ($section['fields'] as $field):
    $current_val = isset($content[$field['key']]) ? $content[$field['key']] : '';
    $field_id    = 'tme_' . $si . '_' . $field['key'];
  ?>

  <div class="editor-field" data-key="<?= htmlspecialchars($field['key']) ?>" data-type="<?= $field['type'] ?>">
    <label class="field-label"><?= htmlspecialchars($field['label']) ?></label>

    <?php if ($field['type'] === 'text'): ?>
      <input type="text"
             class="field-input field-text"
             value="<?= htmlspecialchars($current_val) ?>"
             placeholder="<?= htmlspecialchars($field['label']) ?>">
      <?php if (!empty($field['hint'])): ?>
      <small class="field-hint"><?= htmlspecialchars($field['hint']) ?></small>
      <?php endif; ?>

    <?php elseif ($field['type'] === 'html'): ?>
      <textarea class="field-input field-html tinymce"
                id="<?= $field_id ?>"
                rows="6"><?= htmlspecialchars($current_val) ?></textarea>

    <?php elseif ($field['type'] === 'url'): ?>
      <input type="text"
             class="field-input field-url"
             value="<?= htmlspecialchars($current_val) ?>"
             placeholder="https://...">
      <small class="field-hint">Copiez/collez l'URL complète (ex: depuis Google Maps → Partager → Intégrer)</small>

    <?php elseif ($field['type'] === 'select'): ?>
      <select class="field-input field-select">
        <?php foreach ($field['options'] as $opt_val => $opt_label): ?>
        <option value="<?= htmlspecialchars($opt_val) ?>"
          <?= ($current_val === (string)$opt_val) ? 'selected' : '' ?>>
          <?= htmlspecialchars($opt_label) ?>
        </option>
        <?php endforeach; ?>
      </select>
      <?php if (!empty($field['hint'])): ?>
      <small class="field-hint"><?= htmlspecialchars($field['hint']) ?></small>
      <?php endif; ?>

    <?php elseif ($field['type'] === 'image'): ?>
      <div class="field-image-wrap" id="wrap_<?= $field['key'] ?>">
        <div class="current-image-preview <?= empty($current_val) ? 'hidden' : '' ?>" id="preview_<?= $field['key'] ?>">
          <?php if (!empty($current_val)): ?>
          <img src="<?= base_url($current_val) ?>" alt="" onerror="this.src='<?= base_url('assets/admin/no-image.png') ?>'">
          <span class="image-filename"><?= htmlspecialchars($current_val) ?></span>
          <?php endif; ?>
        </div>
        <input type="hidden" class="field-input field-image" value="<?= htmlspecialchars($current_val) ?>">
        <div style="display:flex;gap:.75rem;flex-wrap:wrap;align-items:center;">
          <button type="button" class="btn btn-outline btn-sm open-media-picker"
                  data-field="<?= htmlspecialchars($field['key']) ?>">
            <i class="fa-solid fa-photo-film"></i> Choisir depuis la médiathèque
          </button>
          <label class="btn btn-outline btn-sm" style="cursor:pointer;">
            <i class="fa-solid fa-upload"></i> Téléverser une image
            <input type="file" class="quick-upload" data-field="<?= $field['key'] ?>"
                   accept="image/*" style="display:none;">
          </label>
          <?php if (!empty($current_val)): ?>
          <button type="button" class="btn-clear-image btn-sm" data-field="<?= $field['key'] ?>">
            <i class="fa-solid fa-xmark"></i> Supprimer
          </button>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <?php endforeach; ?>
</div>
<?php endforeach; ?>

<!-- Actions -->
<div class="editor-actions">
  <button type="button" class="btn btn-primary btn-lg" id="save-btn">
    <i class="fa-solid fa-floppy-disk"></i> Enregistrer les modifications
  </button>
  <span class="save-status" id="save-status"></span>
</div>

<!-- Champ caché pour le nom de page -->
<input type="hidden" id="current-page" value="<?= htmlspecialchars($page_name) ?>">

<!-- ===== MODAL MÉDIATHÈQUE ===== -->
<div class="modal" id="media-modal">
  <div class="modal-overlay" onclick="closeMediaPicker()"></div>
  <div class="modal-content">
    <div class="modal-header">
      <h3><i class="fa-solid fa-images"></i> Bibliothèque d'images</h3>
      <button onclick="closeMediaPicker()" class="modal-close">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>
    <div class="modal-upload">
      <label class="btn btn-outline btn-sm" style="cursor:pointer;">
        <i class="fa-solid fa-upload"></i> Téléverser une nouvelle image
        <input type="file" id="modal-upload-input" accept="image/*" style="display:none;">
      </label>
    </div>
    <div class="modal-body">
      <div id="media-grid-picker" class="media-grid">
        <div class="media-loading"><i class="fa-solid fa-spinner fa-spin"></i> Chargement…</div>
      </div>
    </div>
  </div>
</div>
