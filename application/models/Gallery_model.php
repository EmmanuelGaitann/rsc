<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_model extends CI_Model {

    public function get_all()
    {
        return $this->db->order_by('sort_order', 'ASC')->order_by('id', 'ASC')->get('rsc_gallery')->result();
    }

    public function get_visible()
    {
        return $this->db->where('visible', 1)->order_by('sort_order', 'ASC')->order_by('id', 'ASC')->get('rsc_gallery')->result();
    }

    public function get($id)
    {
        return $this->db->where('id', $id)->get('rsc_gallery')->row();
    }

    public function insert($data)
    {
        $this->db->insert('rsc_gallery', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)->update('rsc_gallery', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete('rsc_gallery');
    }

    public function toggle_visible($id)
    {
        $item = $this->get($id);
        if ($item) {
            $this->db->where('id', $id)->update('rsc_gallery', ['visible' => $item->visible ? 0 : 1]);
        }
    }
}
