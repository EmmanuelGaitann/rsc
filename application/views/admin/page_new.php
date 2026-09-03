<?php $is_edit = !empty($edit_page); ?>
<div class="admin-page-header">
  <div>
    <h1 class="admin-page-title">
      <i class="fa-solid <?= $is_edit ? 'fa-pencil' : 'fa-plus' ?> fa-fw"></i>
      <?= $is_edit ? 'Modifier la page' : 'Nouvelle page' ?>
    </h1>
    <p class="admin-page-subtitle">
      <?= $is_edit ? htmlspecialchars($edit_page->title) : 'Créez une nouvelle page pour votre site.' ?>
    </p>
  </div>
  <a href="<?= base_url('admin/pages') ?>" class="btn btn-outline">
    <i class="fa-solid fa-arrow-left"></i> Retour
  </a>
</div>

<?php if (!empty($error)): ?>
<div style="background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;padding:0.8rem 1rem;border-radius:8px;margin-bottom:1.5rem;">
  <i class="fa-solid fa-xmark"></i> <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<form method="post" action="<?= $is_edit ? base_url('admin/pages/save/' . $edit_page->id) : base_url('admin/do_new_page') ?>">
  <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem;">

    <div class="editor-section">
      <h3 class="editor-section-title">Titre et URL</h3>

      <div class="form-group">
        <label class="form-label">Titre de la page <span style="color:#ef4444;">*</span></label>
        <input type="text" name="title" class="form-control"
               value="<?= $is_edit ? htmlspecialchars($edit_page->title) : '' ?>"
               placeholder="Ex : Nos références clients"
               oninput="generateSlug(this.value)"
               required>
      </div>

      <div class="form-group">
        <label class="form-label">
          Slug (identifiant URL) <span style="color:#ef4444;">*</span>
          <span style="color:#94a3b8;font-weight:400;font-size:0.78rem;"> — URL : /p/votre-slug</span>
        </label>
        <input type="text" name="slug" id="slug-field" class="form-control"
               value="<?= $is_edit ? htmlspecialchars($edit_page->slug) : '' ?>"
               placeholder="ex : nos-references"
               pattern="[a-z0-9\-]+"
               required>
        <small style="color:#94a3b8;font-size:0.75rem;">Minuscules, chiffres et tirets uniquement.</small>
      </div>

      <div class="form-group">
        <label class="form-label">Description SEO (meta)</label>
        <textarea name="meta_desc" class="form-control" rows="2"
                  placeholder="Courte description pour les moteurs de recherche (150 car. max)"><?= $is_edit ? htmlspecialchars($edit_page->meta_desc) : '' ?></textarea>
      </div>
    </div>

    <div class="editor-section">
      <h3 class="editor-section-title">Navigation & Visibilité</h3>

      <div class="form-group">
        <label class="form-label">Libellé dans la navigation</label>
        <input type="text" name="nav_label" class="form-control"
               value="<?= $is_edit ? htmlspecialchars($edit_page->nav_label) : '' ?>"
               placeholder="Ex : Références">
        <small style="color:#94a3b8;font-size:0.75rem;">Laissez vide pour ne pas modifier la navigation.</small>
      </div>

      <div class="form-group">
        <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;">
          <input type="checkbox" name="show_in_nav" value="1"
                 <?= ($is_edit && $edit_page->show_in_nav) ? 'checked' : '' ?>>
          <span class="form-label" style="margin:0;">Afficher dans la barre de navigation</span>
        </label>
      </div>

      <?php if ($is_edit): ?>
      <div class="form-group">
        <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;">
          <input type="checkbox" name="visible" value="1"
                 <?= $edit_page->visible ? 'checked' : '' ?>>
          <span class="form-label" style="margin:0;">Page visible (publiée)</span>
        </label>
      </div>
      <?php endif; ?>

      <?php if ($is_edit): ?>
      <div style="background:#f8fafc;border-radius:8px;padding:1rem;margin-top:1rem;">
        <p style="color:#64748b;font-size:0.82rem;margin:0;">
          <i class="fa-solid fa-link" style="color:#2563eb;"></i>
          URL publique :
          <a href="<?= base_url('p/' . $edit_page->slug) ?>" target="_blank" style="color:#2563eb;">
            <?= base_url('p/' . $edit_page->slug) ?>
          </a>
        </p>
      </div>
      <?php endif; ?>
    </div>

  </div>

  <?php if (!$is_edit): ?>
  <div class="editor-section" style="margin-bottom:1.5rem;">
    <h3 class="editor-section-title">Modèle de départ</h3>
    <div class="form-group" style="max-width:420px;">
      <label class="form-label">Choisir un modèle</label>
      <select id="template-selector" class="form-control" onchange="applyPageTemplate(this.value)">
        <option value="blank">— Page vide (TinyMCE vide)</option>
        <option value="texte">Page texte — Titre + paragraphes + liste</option>
        <option value="cards">Page services — 3 cartes en grille</option>
        <option value="references">Page références — Logos + témoignage</option>
        <option value="faq">Page FAQ — Questions / Réponses</option>
      </select>
      <small style="color:#94a3b8;font-size:0.75rem;">Le modèle pré-remplit l'éditeur. Vous pouvez tout modifier ensuite.</small>
    </div>
  </div>
  <?php endif; ?>

  <div class="editor-section">
    <h3 class="editor-section-title">Contenu de la page</h3>
    <div class="form-group">
      <textarea name="content" id="page-content-editor" class="tinymce" rows="20"><?= $is_edit ? htmlspecialchars($edit_page->content) : '' ?></textarea>
    </div>
  </div>

  <div class="editor-actions" style="position:sticky;bottom:0;background:white;padding:1rem 0;border-top:1px solid var(--border);margin-top:1.5rem;">
    <button type="submit" class="btn btn-primary btn-lg">
      <i class="fa-solid fa-check"></i>
      <?= $is_edit ? 'Mettre à jour' : 'Créer la page' ?>
    </button>
    <a href="<?= base_url('admin/pages') ?>" class="btn btn-outline btn-lg">Annuler</a>
  </div>

</form>

<script>
function generateSlug(title) {
  const slugField = document.getElementById('slug-field');
  if (slugField.dataset.manual) return;
  const slug = title.toLowerCase()
    .normalize('NFD').replace(/[̀-ͯ]/g, '')
    .replace(/[^a-z0-9\s\-]/g, '')
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-')
    .replace(/^-|-$/g, '');
  slugField.value = slug;
}
document.getElementById('slug-field').addEventListener('input', function() {
  this.dataset.manual = '1';
});

/* ---- Page templates ---- */
var PAGE_TEMPLATES = {
  blank: '',

  texte: `<h2>Titre de la section</h2>
<p>Rédigez votre introduction ici. Présentez le sujet de cette page en quelques phrases claires et engageantes.</p>
<h3>Sous-titre</h3>
<p>Développez votre contenu ici. Vous pouvez ajouter autant de paragraphes que nécessaire, des listes, des images, etc.</p>
<ul>
  <li>Point clé numéro 1</li>
  <li>Point clé numéro 2</li>
  <li>Point clé numéro 3</li>
</ul>
<p>Concluez avec un appel à l'action ou une information de contact.</p>`,

  cards: `<h2 style="text-align:center;margin-bottom:0.5rem;">Nos services</h2>
<p style="text-align:center;color:#64748b;margin-bottom:2rem;">Découvrez l'ensemble de nos prestations adaptées à vos besoins industriels.</p>
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-bottom:2rem;">
  <div style="border:1px solid #e2e8f0;border-radius:8px;padding:1.5rem;text-align:center;">
    <h3 style="margin-top:0;color:#1e3a5f;">Service 1</h3>
    <p style="color:#475569;">Description du premier service proposé par RSC Cameroun.</p>
  </div>
  <div style="border:1px solid #e2e8f0;border-radius:8px;padding:1.5rem;text-align:center;">
    <h3 style="margin-top:0;color:#1e3a5f;">Service 2</h3>
    <p style="color:#475569;">Description du deuxième service proposé par RSC Cameroun.</p>
  </div>
  <div style="border:1px solid #e2e8f0;border-radius:8px;padding:1.5rem;text-align:center;">
    <h3 style="margin-top:0;color:#1e3a5f;">Service 3</h3>
    <p style="color:#475569;">Description du troisième service proposé par RSC Cameroun.</p>
  </div>
</div>
<p style="text-align:center;">
  <a href="/contact" style="background:#1e3a5f;color:white;padding:0.75rem 2rem;border-radius:6px;text-decoration:none;display:inline-block;">Nous contacter</a>
</p>`,

  references: `<h2 style="text-align:center;margin-bottom:0.5rem;">Ils nous font confiance</h2>
<p style="text-align:center;color:#64748b;margin-bottom:2rem;">Des entreprises de toutes tailles nous confient leurs équipements industriels.</p>
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:2.5rem;">
  <div style="border:1px solid #e2e8f0;border-radius:8px;padding:1rem;text-align:center;min-height:80px;display:flex;align-items:center;justify-content:center;">
    <span style="color:#94a3b8;font-size:0.85rem;">Logo client 1</span>
  </div>
  <div style="border:1px solid #e2e8f0;border-radius:8px;padding:1rem;text-align:center;min-height:80px;display:flex;align-items:center;justify-content:center;">
    <span style="color:#94a3b8;font-size:0.85rem;">Logo client 2</span>
  </div>
  <div style="border:1px solid #e2e8f0;border-radius:8px;padding:1rem;text-align:center;min-height:80px;display:flex;align-items:center;justify-content:center;">
    <span style="color:#94a3b8;font-size:0.85rem;">Logo client 3</span>
  </div>
  <div style="border:1px solid #e2e8f0;border-radius:8px;padding:1rem;text-align:center;min-height:80px;display:flex;align-items:center;justify-content:center;">
    <span style="color:#94a3b8;font-size:0.85rem;">Logo client 4</span>
  </div>
</div>
<h3>Témoignages</h3>
<blockquote style="border-left:4px solid #1e3a5f;padding-left:1.25rem;margin-left:0;color:#334155;">
  <p>« RSC Cameroun nous a fourni des compresseurs fiables qui ont transformé notre production. Un partenaire de confiance pour nos besoins industriels. »</p>
  <cite style="color:#64748b;font-size:0.85rem;">— Directeur technique, Entreprise XYZ</cite>
</blockquote>`,

  faq: `<h2>Questions fréquentes</h2>
<p style="color:#64748b;margin-bottom:2rem;">Retrouvez les réponses aux questions les plus courantes sur nos produits et services.</p>
<h3 style="color:#1e3a5f;border-bottom:2px solid #e2e8f0;padding-bottom:0.5rem;">Question 1 : Comment commander un compresseur ?</h3>
<p>Répondez à la question ici. Soyez concis et précis. Vous pouvez inclure des liens vers d'autres pages ou des contacts.</p>
<h3 style="color:#1e3a5f;border-bottom:2px solid #e2e8f0;padding-bottom:0.5rem;">Question 2 : Proposez-vous un service après-vente ?</h3>
<p>Répondez à la question ici. N'hésitez pas à détailler les étapes ou conditions importantes.</p>
<h3 style="color:#1e3a5f;border-bottom:2px solid #e2e8f0;padding-bottom:0.5rem;">Question 3 : Quelles marques distribuez-vous ?</h3>
<p>Répondez à la question ici. Vous pouvez lister les marques, ajouter des liens, etc.</p>
<h3 style="color:#1e3a5f;border-bottom:2px solid #e2e8f0;padding-bottom:0.5rem;">Question 4 : Livrez-vous partout au Cameroun ?</h3>
<p>Répondez à la question ici.</p>
<p style="margin-top:2rem;text-align:center;">
  <strong>Vous ne trouvez pas la réponse ?</strong><br>
  <a href="/contact" style="color:#1e3a5f;">Contactez-nous directement →</a>
</p>`
};

function applyPageTemplate(tpl) {
  var html = PAGE_TEMPLATES[tpl] || '';
  var ed = typeof tinymce !== 'undefined' && tinymce.get('page-content-editor');
  if (ed) {
    ed.setContent(html);
  } else {
    document.getElementById('page-content-editor').value = html;
  }
}
</script>
