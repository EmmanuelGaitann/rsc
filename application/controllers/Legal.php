<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Legal extends CI_Controller {

    public function index()
    {
        $this->load->model('Content_model');
        $data['title']    = 'Mentions Légales';
        $data['meta_desc'] = 'Mentions légales et politique de confidentialité de Royal Sales Cameroon.';
        $data['c']        = $this->Content_model->get_page('legal');
        $data['cms_page'] = 'legal';
        $this->load->view('templates/header', $data);
        $this->load->view('legal/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
