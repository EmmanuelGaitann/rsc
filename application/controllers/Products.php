<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function index()
    {
        $this->load->model('Content_model');
        $this->load->model('Products_model');

        $brands     = $this->Products_model->get_brands();
        $categories = $this->Products_model->get_categories();

        $data['title']      = 'Catalogue Produits';
        $data['meta_desc']  = 'Catalogue complet RENNER Kompressoren & Ingersoll Rand : compresseurs à vis, sans huile, à piston, sécheurs d\'air, réservoirs et systèmes de contrôle. Disponibles au Cameroun.';
        $data['c']          = $this->Content_model->get_page('products');
        $data['cms_page']   = 'products';
        $data['products']   = $this->Products_model->get_all();
        $data['brands']     = $brands;
        $data['categories'] = $categories;

        /* Build dynamic brand badge CSS from DB */
        $badge_css = '<style>
  .product-card { position: relative; }
  .prod-brand-badge { position: absolute; top: 0.55rem; right: 0.55rem; z-index: 2; font-size: 0.58rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.09em; padding: 0.2rem 0.6rem; border-radius: 50px; font-family: \'Montserrat\', sans-serif; pointer-events: none; white-space: nowrap; color: white; }
  .brand-filter-bar { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 0.75rem; }
  .brand-btn { padding: 0.4rem 1.1rem; border-radius: 50px; border: 1.5px solid var(--border); background: white; color: var(--gray); font-size: 0.8rem; font-weight: 700; cursor: pointer; transition: all 0.2s; font-family: \'Montserrat\', sans-serif; }
  .brand-btn[data-brand="all"].active { background: var(--dark); color: white; border-color: var(--dark); }' . "\n";
        foreach ($brands as $b) {
            $slug  = htmlspecialchars($b->slug,  ENT_QUOTES);
            $color = htmlspecialchars($b->color, ENT_QUOTES);
            $badge_css .= "  .prod-brand-badge.{$slug} { background: {$color}; }\n";
            $badge_css .= "  .brand-btn[data-brand=\"{$slug}\"].active { background: {$color}; color: white; border-color: {$color}; }\n";
        }
        $badge_css .= '  .card-img.img-contain { object-fit: contain; background: #f4f6fa; }
  .prod-model { font-size: 0.78rem; color: var(--gray); margin: -0.4rem 0 0.5rem; }
</style>';

        $data['extra_css'] = $badge_css;

        $this->load->view('templates/header', $data);
        $this->load->view('products/index', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Fiche produit détaillée : /produit/{id}/{slug}
     * (description technique, marque, catégorie, CTA « Nous contacter »)
     */
    public function fiche($id)
    {
        $this->load->model('Content_model');
        $this->load->model('Products_model');
        $this->load->helper('url');

        $p = $this->Products_model->get_visible((int)$id);
        if (!$p) show_404();

        $brands     = $this->Products_model->get_brands();
        $categories = $this->Products_model->get_categories();

        $brand = null;
        foreach ($brands as $b) if ($b->slug === $p->brand) { $brand = $b; break; }
        $category = null;
        foreach ($categories as $cat) if ($cat->slug === $p->category) { $category = $cat; break; }

        $desc_plain = trim(preg_replace('/\s+/', ' ', strip_tags((string)$p->description)));

        $data['title']     = $p->name . ($p->model ? ' ' . $p->model : '');
        $data['meta_desc'] = $desc_plain !== ''
            ? mb_substr($desc_plain, 0, 158)
            : 'Fiche produit ' . $p->name . ' — Royal Sales Cameroon, distributeur agréé au Cameroun.';
        $data['c']         = $this->Content_model->get_page('products');
        $data['cms_page']  = 'products';
        $data['p']         = $p;
        $data['brand']     = $brand;
        $data['category']  = $category;
        $data['related']   = $this->Products_model->get_related($p->category, $p->id, 4);

        $this->load->view('templates/header', $data);
        $this->load->view('products/fiche', $data);
        $this->load->view('templates/footer', $data);
    }
}
