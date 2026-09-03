<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

    public function index()
    {
        $this->load->model('Content_model');
        $this->load->model('Gallery_model');
        $data['title']    = 'Galerie';
        $data['meta_desc'] = 'Galerie photos des produits et réalisations Royal Sales Cameroon : compresseurs industriels RENNER & Ingersoll Rand, installations et interventions en Afrique Centrale.';
        $data['c']        = $this->Content_model->get_page('gallery');
        $data['cms_page'] = 'gallery';
        $data['images']   = $this->Gallery_model->get_visible();
        $this->load->view('templates/header', $data);
        $this->load->view('gallery/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
