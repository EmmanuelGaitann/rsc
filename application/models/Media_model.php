<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media_model extends CI_Model {

    public function get_all()
    {
        return $this->db->order_by('uploaded_at', 'DESC')->get('rsc_media')->result();
    }

    public function get($id)
    {
        return $this->db->where('id', $id)->get('rsc_media')->row();
    }

    public function insert($data)
    {
        $this->db->insert('rsc_media', $data);
        return $this->db->insert_id();
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete('rsc_media');
    }
}
