<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

    /**
     * Index Page for this controller.
     */
    var $gen_contents = array(
        
    );
    public function __construct() {
        parent::__construct();
        $this->load->model('web_model');
    }

    //default index page
    public function index() {
        //$this->load->model('web_model');
        $this->gen_contents = array();
        $this->template->write_view('content', 'index', $this->gen_contents);
        $this->template->render();
    }
    
    //about page
    public function about()
    {
        $this->gen_contents = array();
        $this->template->write_view('content', 'about', $this->gen_contents);
        $this->template->render();
    }

    //contact page
    public function contact()
    {
        $this->gen_contents = array();
        $this->template->write_view('content', 'contact', $this->gen_contents);
        $this->template->render();
    }

    //gallery page
    public function gallery()
    {
        $this->gen_contents = array();
        $this->template->write_view('content', 'gallery', $this->gen_contents);
        $this->template->render();
    }

    //reviews page
    public function reviews()
    {
        $this->gen_contents = array();
        $this->template->write_view('content', 'reviews', $this->gen_contents);
        $this->template->render();
    }

    //ourguide page
    public function our_guide()
    {
        $this->gen_contents = array();
        $this->template->write_view('content', 'our-guide', $this->gen_contents);
        $this->template->render();
    }

    //tourist-visa page
    public function tourist_visa()
    {
        $this->gen_contents = array();
        $this->template->write_view('content', 'tourist-visa', $this->gen_contents);
        $this->template->render();
    }

    //listing page
//    public function listing()
//    {        
//        $this->gen_contents = array();
//        $this->template->write_view('content', 'list_emirates', $this->gen_contents);
//        $this->template->render();
//    }
    
    //select tours 
    public function select_tours($category)
    {     
        $this->load->model('web_model');
        $this->gen_contents['categories'] = $this->web_model->get_categories();
        $this->gen_contents['current'] = $category;              
        //p($this->gen_contents['categories']);exit;
        $this->template->write_view('content', 'list-emirates', $this->gen_contents);
        $this->template->render();
    }

    //plan page
    public function select_plan($category,$emirates)
    {
        $tour_id = $this->input->get('plan', TRUE);
        $this->load->model('web_model');
        $this->gen_contents['current'] = $category;
        $this->gen_contents['tours'] = $this->web_model->get_tours($category);
        if(empty($tour_id)){
            $tour_id = $this->web_model->get_default_tour_id($category);
        }
        $this->gen_contents['tour_details'] = $this->web_model->get_tour_details($tour_id);
        $this->gen_contents['tour_id'] = $tour_id;
        
        //p($this->gen_contents['tour_details']); exit;
        $this->template->write_view('content', 'select-plan', $this->gen_contents);
        $this->template->render();
    }

    //why us page
    public function why_us()
    {        
        $this->gen_contents = array();
        $this->template->write_view('content', 'why-us', $this->gen_contents);
        $this->template->render();
    }

}
