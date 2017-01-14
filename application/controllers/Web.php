<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

    /**
     * Index Page for this controller.
     */
    var $gen_contents = array(
        
    );

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
    public function listing()
    {        
        $this->gen_contents = array();
        $this->template->write_view('content', 'list', $this->gen_contents);
        $this->template->render();
    }

    //plan page
    public function plan()
    {
        $this->gen_contents = array();
        $this->template->write_view('content', 'plan', $this->gen_contents);
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
