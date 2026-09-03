<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

    public function index()
    {
        $this->load->model('Content_model');
        $data['title']    = 'Services';
        $data['meta_desc'] = 'Royal Sales Cameroon : installation, maintenance préventive et corrective, réparations d\'urgence, contrats de maintenance annuels et audit air comprimé à Douala, Cameroun.';
        $data['c']        = $this->Content_model->get_page('services');
        $data['cms_page'] = 'services';
        $this->load->view('templates/header', $data);
        $this->load->view('services/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
