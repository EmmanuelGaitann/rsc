<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

    public function index()
    {
        $this->load->model('Content_model');
        $data['title']     = 'À Propos';
        $data['meta_desc'] = 'Royal Sales Cameroon, distributeur agréé RENNER Kompressoren et Ingersoll Rand pour l\'Afrique Centrale. Spécialiste en compression d\'air industrielle, maintenance et pièces détachées toutes marques à Douala.';
        $data['c']         = $this->Content_model->get_page('about');
        $data['cms_page']  = 'about';
        $this->load->view('templates/header', $data);
        $this->load->view('about/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
