<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content_model extends CI_Model {

    public function get_page($page)
    {
        $rows = $this->db->where('page', $page)->get('rsc_content')->result();
        $data = [];
        foreach ($rows as $row) {
            $data[$row->block_key] = $row->value;
        }
        return $data;
    }

    public function get($page, $key, $default = '')
    {
        $row = $this->db
            ->where('page', $page)
            ->where('block_key', $key)
            ->get('rsc_content')
            ->row();
        return $row ? $row->value : $default;
    }

    public function upsert($page, $key, $type, $value, $label = null)
    {
        $existing = $this->db
            ->where('page', $page)
            ->where('block_key', $key)
            ->get('rsc_content')
            ->row();

        if ($existing) {
            $this->db->where('id', $existing->id)->update('rsc_content', [
                'value'      => $value,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $this->db->insert('rsc_content', [
                'page'      => $page,
                'block_key' => $key,
                'type'      => $type,
                'value'     => $value,
                'label'     => $label,
            ]);
        }
    }
}
