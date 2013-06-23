<?php

class News extends CI_Controller {

    //calls teh constructor of its parent class
    public function __construct() {
        parent::__construct();
        $this->load->model('news_model');
    }

    public function index() {
        //gets all records from the model and assigns it to $data
        $data['news'] = $this->news_model->get_news();
        $data['title'] = 'News archive';
        //all data is passed to the views
        $this->load->view('templates/header', $data);
        $this->load->view('news/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug) {
        $data['news_item'] = $this->news_model->get_news($slug);
        if (empty($data['news_item'])) {
            show_404();
        }

        $data['title'] = $data['news_item']['title'];

        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data);
        $this->load->view('templates/footer');
    }

}

?>
