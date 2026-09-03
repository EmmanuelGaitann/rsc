<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expertise extends CI_Controller {

    public function index()
    {
        $this->load->model('Content_model');
        $data['title']    = 'Expertise & Actualités';
        $data['meta_desc'] = 'Articles techniques, actualités industrielles et conseils d\'experts Royal Sales Cameroon sur les compresseurs d\'air, la maintenance et l\'efficacité énergétique.';
        $data['c']        = $this->Content_model->get_page('expertise');
        $data['cms_page'] = 'expertise';
        $this->load->view('templates/header', $data);
        $this->load->view('expertise/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
