<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model {

    public function get_all() {
        return $this->db->order_by('id', 'DESC')->get('rsc_pages')->result();
    }

    public function get($id) {
        return $this->db->where('id', $id)->get('rsc_pages')->row();
    }

    public function get_by_slug($slug) {
        return $this->db->where('slug', $slug)->get('rsc_pages')->row();
    }

    public function get_nav_items() {
        return $this->db->where('show_in_nav', 1)->where('visible', 1)
                        ->order_by('id', 'ASC')->get('rsc_pages')->result();
    }

    public function insert($data) {
        $this->db->insert('rsc_pages', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id)->update('rsc_pages', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id)->delete('rsc_pages');
    }
}
