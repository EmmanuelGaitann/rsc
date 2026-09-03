<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
        $this->load->model('Content_model');
        $data['title']     = 'Accueil';
        $data['meta_desc'] = 'Royal Sales Cameroon, distributeur agréé RENNER Kompressoren & Ingersoll Rand en Afrique Centrale. Vente, installation et maintenance de compresseurs industriels toutes marques à Douala.';
        $data['c']         = $this->Content_model->get_page('home');
        $data['cms_page']  = 'home';
        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
