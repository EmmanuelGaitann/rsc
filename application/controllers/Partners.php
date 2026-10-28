<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partners extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Content_model');
        $this->load->model('Document_model');
    }

    public function ingersoll_rand()
    {
        $data['title']     = 'Ingersoll Rand';
        $data['meta_desc'] = 'Ingersoll Rand — Compresseurs industriels à vis lubrifiés et sans huile. Royal Sales Cameroon, distributeur agréé officiel pour l\'Afrique Centrale.';
        $data['c']         = $this->Content_model->get_page('partners_ir');
        $data['cms_page']  = 'partners_ir';
        $data['docs']      = $this->Document_model->get_for_page('partners_ir');
        $this->load->view('templates/header', $data);
        $this->load->view('partners/ingersoll_rand', $data);
        $this->load->view('templates/footer', $data);
    }

    public function renner()
    {
        $data['title']     = 'RENNER Kompressoren';
        $data['meta_desc'] = 'RENNER Kompressoren — Compresseurs à vis Made in Germany. Royal Sales Cameroon, distributeur agréé officiel pour l\'Afrique Centrale.';
        $data['c']         = $this->Content_model->get_page('partners_renner');
        $data['cms_page']  = 'partners_renner';
        $data['docs']      = $this->Document_model->get_for_page('partners_renner');
        $this->load->view('templates/header', $data);
        $this->load->view('partners/renner', $data);
        $this->load->view('templates/footer', $data);
    }

    public function cas_lubricants()
    {
        $data['title']     = 'CAS Lubricants';
        $data['meta_desc'] = 'CAS Lubricants — Huiles compresseurs haute performance, marque exclusive Royal Sales Cameroon. Formulées pour conditions tropicales.';
        $data['c']         = $this->Content_model->get_page('partners_cas');
        $data['cms_page']  = 'partners_cas';
        $data['docs']      = $this->Document_model->get_for_page('partners_cas');
        $this->load->view('templates/header', $data);
        $this->load->view('partners/cas_lubricants', $data);
        $this->load->view('templates/footer', $data);
    }
}
