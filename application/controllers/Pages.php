<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pages_model');
        $this->load->model('Content_model');
    }

    public function view($slug)
    {
        $page = $this->Pages_model->get_by_slug($slug);

        if (!$page || !$page->visible) {
            show_404();
        }

        $data['title']    = $page->title;
        $data['meta_desc']= $page->meta_desc ?: '';
        $data['page']     = $page;
        $data['cms_page'] = 'page_' . $page->slug;
        $data['c']        = [];

        $this->load->view('templates/header', $data);
        $this->load->view('pages/view', $data);
        $this->load->view('templates/footer', $data);
    }
}
