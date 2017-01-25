<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    var $gen_contents = array();

    // index function - check login and navigate to dashboard
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/admin_model');
        $this->gen_contents['dashboard_js'] = '';
    }

    public function index() {
        //$this->load->model('admin/admin_model');
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->gen_contents['page_heading'] = 'Dashboard';
        $this->template->set_template('admin');
        $this->gen_contents['page_heading'] = 'Dashboard';
        $this->gen_contents['dashboard_js'] = 'yes';
        $this->template->write_view('content', 'admin/dashboard', $this->gen_contents);
        $this->template->render();
    }

    //list categories
    public function list_categories() {
        $this->load->model('admin/admin_model');
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->gen_contents['page_heading'] = 'Categories';
        $this->gen_contents['categories'] = $this->admin_model->get_categories();
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/category-list', $this->gen_contents);
        $this->template->render();
    }

    public function add_category(){
        $this->gen_contents = array();
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/category-add', $this->gen_contents);
        $this->template->render();
    }

    //manage categories controller 
    public function categories($mode="list",$catid=""){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
            $page = 'admin/category-list';
            $this->load->model('admin/admin_model');
            // Category add area
            if($mode == "add"){
                $page = 'admin/category-add';
                $this->load->library('form_validation');
                $this->form_validation->set_rules('title', 'Category Name', 'required');
                if($this->form_validation->run() == TRUE){
                    $title = $this->input->post("title",true);
                    // --------- if image not null the upload file -------------
                    $image_name = "";
                    if (!empty($_FILES['header_image']['name'])) { 
                        
                        $config['upload_path']          = './assets/images/category/';  
                        $config['allowed_types']        = 'jpg|png';                
                        $config['encrypt_name'] = TRUE;
                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('header_image')){
                              $upload_detail = $this->upload->data();
                              $image_name = $upload_detail["file_name"];
                        }               
                    }
                    //----------------------------------------------------------
                    $catdata = array(
                        "title" => $title,
                        'slug'  => url_title($title, 'dash', true),
                        'header_image' => $image_name
                    );
                    $response = $this->admin_model->process_category("add",$catdata);
                    if($response == "added"){
                        sf('succes_message', 'New category has been added successfully');
                        redirect("admin/categories");
                    }
                    else if($response == "exists"){
                        sf('error_message', 'Sorry! This category name already exists');
                    }
                }

            }
            // Category edit area
            if($mode == "edit"){
                $page = 'admin/category-add';
                $catdata = $this->admin_model->get_category($catid);
                $this->gen_contents['catdata'] = $catdata;

                $this->load->library('form_validation');
                $this->form_validation->set_rules('title', 'Category Name', 'required');
                if($this->form_validation->run() == TRUE){   
                    $title = $this->input->post("title",true);
                    // --------- if image not null the upload file -------------
                    $image_name = "";
                    if (!empty($_FILES['header_image']['name'])) { 
                        
                        $config['upload_path']          = './assets/images/category/';  
                        $config['allowed_types']        = 'jpg|png';                
                        $config['encrypt_name'] = TRUE;
                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('header_image')){
                              $upload_detail = $this->upload->data();
                              $image_name = $upload_detail["file_name"];
                        }               
                    }
                    else{
                        $image_name = $this->input->post("image_name",true);
                    }
                    //----------------------------------------------------------
                    $catdata = array(
                        "title"     => $title,
                        "catid"     => $this->input->post("id",true),
                        "slug"      => url_title($title, 'dash', true),
                        "header_image"  => $image_name
                    );
                    $response = $this->admin_model->process_category("edit",$catdata);
                    if($response == "edited"){
                        redirect("admin/categories");
                    }
                    else if($response == "exists"){
                        sf('error_message', 'Sorry! This category name already exists');
                    }
                }

            }
            // Category delete area
            if($mode == "delete" && !empty($catid)){                
                $catdata = array(
                    'catid'=> $catid
                );
                $response = $this->admin_model->process_category("delete",$catdata);
                redirect("admin/categories");
            }
            //rendering page
            $this->gen_contents['page_heading'] = 'Categories';
            $this->gen_contents['categories'] = $this->admin_model->get_categories();
            $this->template->set_template('admin');
            $this->template->write_view('content', $page, $this->gen_contents);
            $this->template->render();
    }
    //manage emirates controller 
    public function emirates($mode="list",$eid=""){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
            $page = 'admin/emirates-list';
            $this->load->model('admin/admin_model');
            // Emirates add area
            if($mode == "add"){
                $page = 'admin/emirates-add';
                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Emirates Name', 'required');
                if($this->form_validation->run() == TRUE){
                    $name = $this->input->post("name",true);
                    // --------- if image not null the upload file -------------
                    $image_name = "";
                    if (!empty($_FILES['image']['name'])) { 
                        
                        $config['upload_path']          = './assets/images/emirates/';  
                        $config['allowed_types']        = 'jpg|png';                
                        $config['encrypt_name'] = TRUE;
                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('image')){
                              $upload_detail = $this->upload->data();
                              $image_name = $upload_detail["file_name"];
                        }               
                    }
                    //----------------------------------------------------------
                    $edata = array(
                        "name" => $name,
                        'image' => $image_name
                    );
                    $response = $this->admin_model->process_emirates("add",$edata);
                    if($response == "added"){
                        sf('succes_message', 'New emirates has been added successfully');
                        redirect("admin/emirates");
                    }
                    else if($response == "exists"){
                        sf('error_message', 'Sorry! This emirates name already exists');
                    }
                }

            }
            // Emirates edit area
            if($mode == "edit"){
                $page = 'admin/emirates-add';
                $edata = $this->admin_model->get_emirates_data($eid);
                $this->gen_contents['edata'] = $edata;

                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Emirates Name', 'required');
                if($this->form_validation->run() == TRUE){   
                    $name = $this->input->post("name",true);
                    // --------- if image not null then upload file -------------
                    $image_name = "";
                    if (!empty($_FILES['image']['name'])) { 
                        
                        $config['upload_path']          = './assets/images/emirates/';  
                        $config['allowed_types']        = 'jpg|png';                
                        $config['encrypt_name'] = TRUE;
                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('image')){
                              $upload_detail = $this->upload->data();
                              $image_name = $upload_detail["file_name"];
                        }               
                    }
                    else{
                        $image_name = $this->input->post("image_name",true);
                    }
                    //----------------------------------------------------------
                    $edata = array(                        
                        "id"     => $this->input->post("id",true),  
                        "name"   => $name,
                        "image"  => $image_name
                    );
                    $response = $this->admin_model->process_emirates("edit",$edata);
                    if($response == "edited"){
                        redirect("admin/emirates");
                    }
                    else if($response == "exists"){
                        sf('error_message', 'Sorry! This emirates name already exists');
                    }
                }

            }
            // Category delete area
            if($mode == "delete" && !empty($eid)){                
                $edata = array(
                    'id'=> $eid
                );
                $response = $this->admin_model->process_emirates("delete",$edata);
                redirect("admin/emirates");
            }
            //rendering page
            $this->gen_contents['page_heading'] = 'Emirates';
            $this->gen_contents['emirates'] = $this->admin_model->get_emirates();
            $this->template->set_template('admin');
            $this->template->write_view('content', $page, $this->gen_contents);
            $this->template->render();
    }

}
