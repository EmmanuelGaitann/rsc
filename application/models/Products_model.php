<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {

    // ============================================================
    // PRODUITS
    // ============================================================

    public function get_all()
    {
        return $this->db
            ->where('visible', 1)
            ->order_by('sort_order', 'ASC')
            ->order_by('id', 'ASC')
            ->get('rsc_products')
            ->result();
    }

    public function get_all_admin()
    {
        return $this->db
            ->order_by('sort_order', 'ASC')
            ->order_by('id', 'ASC')
            ->get('rsc_products')
            ->result();
    }

    public function get($id)
    {
        return $this->db->where('id', (int)$id)->get('rsc_products')->row();
    }

    /** Produit visible uniquement (fiche publique). */
    public function get_visible($id)
    {
        return $this->db
            ->where('id', (int)$id)
            ->where('visible', 1)
            ->get('rsc_products')
            ->row();
    }

    /** Produits de la même catégorie (suggestions sur la fiche). */
    public function get_related($category, $exclude_id, $limit = 4)
    {
        return $this->db
            ->where('visible', 1)
            ->where('category', $category)
            ->where('id !=', (int)$exclude_id)
            ->order_by('sort_order', 'ASC')
            ->limit((int)$limit)
            ->get('rsc_products')
            ->result();
    }

    public function insert($data)
    {
        $this->db->insert('rsc_products', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', (int)$id)->update('rsc_products', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', (int)$id)->delete('rsc_products');
    }

    public function toggle_visible($id)
    {
        $product = $this->get((int)$id);
        if ($product) {
            $this->db->where('id', (int)$id)->update('rsc_products', [
                'visible' => $product->visible ? 0 : 1,
            ]);
        }
    }

    // ============================================================
    // FABRICANTS (BRANDS)
    // ============================================================

    public function get_brands()
    {
        return $this->db
            ->order_by('sort_order', 'ASC')
            ->order_by('id', 'ASC')
            ->get('rsc_brands')
            ->result();
    }

    public function get_brand($id)
    {
        return $this->db->where('id', (int)$id)->get('rsc_brands')->row();
    }

    public function get_brand_by_slug($slug)
    {
        return $this->db->where('slug', $slug)->get('rsc_brands')->row();
    }

    public function insert_brand($data)
    {
        $this->db->insert('rsc_brands', $data);
        return $this->db->insert_id();
    }

    public function update_brand($id, $data)
    {
        $this->db->where('id', (int)$id)->update('rsc_brands', $data);
    }

    public function delete_brand($id)
    {
        $this->db->where('id', (int)$id)->delete('rsc_brands');
    }

    public function brand_in_use($id)
    {
        $brand = $this->get_brand((int)$id);
        if (!$brand) return false;
        return $this->db
            ->where('brand', $brand->slug)
            ->count_all_results('rsc_products') > 0;
    }

    // ============================================================
    // CATÉGORIES
    // ============================================================

    public function get_categories()
    {
        return $this->db
            ->order_by('sort_order', 'ASC')
            ->order_by('id', 'ASC')
            ->get('rsc_categories')
            ->result();
    }

    public function get_category($id)
    {
        return $this->db->where('id', (int)$id)->get('rsc_categories')->row();
    }

    public function insert_category($data)
    {
        $this->db->insert('rsc_categories', $data);
        return $this->db->insert_id();
    }

    public function update_category($id, $data)
    {
        $this->db->where('id', (int)$id)->update('rsc_categories', $data);
    }

    public function delete_category($id)
    {
        $this->db->where('id', (int)$id)->delete('rsc_categories');
    }

    public function category_in_use($id)
    {
        $cat = $this->get_category((int)$id);
        if (!$cat) return false;
        return $this->db
            ->where('category', $cat->slug)
            ->count_all_results('rsc_products') > 0;
    }
}
