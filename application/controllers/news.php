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

    public function create()
    {
        //load form helper
        $this->load->helper('form');
        //load form validation library
        $this->load->library('form_validation');

        $data['title'] = 'Create a news item';
        //set_rules() method takes three arguments; the name of the input field, the name to be used in error messages, and the rule
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'text', 'required');
        //check the form validated successfully
        if ($this->form_validation->run() === FALSE)
        {
            //if not display the form
            $this->load->view('templates/header', $data);
            $this->load->view('news/create');
            $this->load->view('templates/footer');

        }
        else
        {
            //if it validated the new_model is called
            $this->news_model->set_news();
            //and a view is loaded to display a success message
            $this->load->view('news/success');
        }
    }

}


