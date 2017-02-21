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
                        sf('success_message', 'New category has been added successfully');
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
                        sf('success_message', 'New emirates has been added successfully');
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

    //manage tours controller 
    public function tours($mode="list",$tour_id=""){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
            $page = 'admin/tours-list';
            $this->load->model('admin/admin_model');
            $this->load->model('web_model');
            $this->gen_contents['categories'] = $this->admin_model->get_categories();
            $this->gen_contents['emirates'] = $this->admin_model->get_emirates();
            // Emirates add area
            if($mode == "add"){
                $page = 'admin/tours-manage';
                $this->load->library('form_validation');
                $this->form_validation->set_rules('title', 'Tour Name', 'required');
                if($this->form_validation->run() == TRUE){
                    $post_data['title']         = $this->input->post("title",true);
                    $post_data['category_id']   = $this->input->post("category_id",true);
                    $post_data['emirates_id']   = $this->input->post("emirates_id",true);
                    $post_data['intro']         = $this->input->post("intro",true);
                    $post_data['body']          = $this->input->post("body",true);
                    $post_data['mail_body']     = $this->input->post("mail_body",true);
                    $post_data['price']         = $this->input->post("price",true);
                    $post_data['usd_price']     = $this->input->post("usd_price",true);
                    $post_data['duration']      = $this->input->post("duration",true);
                    $post_data['status']        = $this->input->post("status",true);
                    $post_data['created']       = date('Y-m-d H:i:s');
                    $post_data['updated']       = date('Y-m-d H:i:s');
                    // --------- if image not null the upload file -------------
                    $image_name = "";
                    if (!empty($_FILES['image']['name'])) { 
                        
                        $config['upload_path']          = './assets/images/tours/';  
                        $config['allowed_types']        = 'jpg|png';                
                        $config['encrypt_name']         = TRUE;
                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('image')){
                              $upload_detail = $this->upload->data();
                              $image_name = $upload_detail["file_name"];
                        }               
                    }
                    //----------------------------------------------------------
                    $post_data['image']          = $image_name;
                    //p($post_data); exit;
                    $response = $this->admin_model->process_tours("add",$post_data);
                    if($response == "added"){
                        sf('success_message', 'New tours has been added successfully');
                        redirect("admin/tours");
                    }                    
                }

            }
            // Emirates edit area
            if($mode == "edit"){
                $page = 'admin/tours-manage';

                $this->gen_contents['tourdata'] = $this->web_model->get_tour_details($tour_id);

                $this->load->library('form_validation');
                $this->form_validation->set_rules('title', 'Tour Name', 'required');
                if($this->form_validation->run() == TRUE){   
                    $post_data['id']            = $this->input->post("tour_id",true);
                    $post_data['title']         = $this->input->post("title",true);
                    $post_data['category_id']   = $this->input->post("category_id",true);
                    $post_data['emirates_id']   = $this->input->post("emirates_id",true);
                    $post_data['intro']         = $this->input->post("intro",true);
                    $post_data['body']          = $this->input->post("body",true);
                    $post_data['mail_body']     = $this->input->post("mail_body",true);
                    $post_data['price']         = $this->input->post("price",true);
                    $post_data['usd_price']     = $this->input->post("usd_price",true);
                    $post_data['duration']      = $this->input->post("duration",true);
                    $post_data['status']        = $this->input->post("status",true);
                    $post_data['updated']       = date('Y-m-d H:i:s');
                    //p($post_data); exit;
                    // --------- if image not null then upload file -------------
                    $image_name = "";
                    if (!empty($_FILES['image']['name'])) { 
                        
                        $config['upload_path']          = './assets/images/tours/';  
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
                    $post_data['image']          = $image_name;
                    $response = $this->admin_model->process_tours("edit",$post_data);
                    if($response == "edited"){
                        sf('success_message', 'New tours has been edited successfully');
                        redirect("admin/tours");
                    }
                    else{
                        redirect("admin/tours");
                    }
                }

            }
            // Category delete area
            if($mode == "delete" && !empty($tour_id)){                
                $tdata = array(
                    'id'=> $tour_id
                );
                $response = $this->admin_model->process_tours("delete",$tdata);
                redirect("admin/tours");
            }
            //rendering page
            $this->gen_contents['page_heading'] = 'Tours';
            $this->gen_contents['tours'] = $this->admin_model->get_tours();
            $this->template->set_template('admin');
            $this->template->write_view('content', $page, $this->gen_contents);
            $this->template->render();
    }

    //list tour bookings
    public function tour_bookings($params='')
    {
        $this->load->model('admin/admin_model');
        $this->gen_contents['page_heading'] = 'Tour Bookings';
        $this->gen_contents['tour_bookings'] = $this->admin_model->get_tour_bookings();
        //p($this->gen_contents['tour_bookings']); exit;
        //rendering page        
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/tours-booking', $this->gen_contents);
        $this->template->render();
    }

    //display booking details page
    public function tour_bookings_details($booking_id='')
    {
        $this->load->model('admin/admin_model');
        $this->gen_contents['page_heading'] = 'Tour Booking Details';
        $this->gen_contents['booking_details'] = $this->admin_model->get_tour_booking_details($booking_id);
        $booking_details = $this->gen_contents['booking_details'];
        foreach ($booking_details as $bd) { }

        $mail_body = $this->admin_model->get_email_template('booking-mail');
        if($bd['mail_body'] != '') $tour_details = $bd['mail_body']; else $tour_details = $bd['body'];
        $mail_body = str_replace('{{user_name}}', $bd['user_name'], $mail_body['body']);                
        $mail_body = str_replace('{{tour_details}}', $tour_details, $mail_body);
        $this->gen_contents['mail_content'] = $mail_body;
        //p($this->gen_contents['booking_details']); exit;
        //rendering page        
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/tours-booking-details', $this->gen_contents);
        $this->template->render();
    }

    // update booking by admin
    public function booking_appln()
    {
        $this->load->model('admin/admin_model');
        $booking_id = $this->input->post("booking_id",true);
        $booking_details = $this->admin_model->get_tour_booking_details($booking_id);
        foreach ($booking_details as $bd) { }
        $action = $this->input->post("btn-booking",true);
        if($action == 'confirm'){
            $response = $this->admin_model->update_booking_status($booking_id,'approved');
            
            if($response == "success"){
                // ====== Send email notification =========
                     
                $mail_body  = $this->input->post("mail_body",true);
                $subject    = $this->input->post("subject",true);
                //echo $mail_body; exit;
                //$to_email       = 'soorajsolutino@gmail.com';
                $to_email       = $bd['email'];
                $from_name      = 'Dubai Private Tours';
                //$subject        = 
                $body_content   = $mail_body;
                //echo $body_content; exit;
                $from_email     = 'info@dubaiprivatetour.com';

                send_mail($to_email, $from_name, $subject, $body_content, $from_email);
                // ====== Send email notification =========
                sf('success_message','Booking has been confirmed successfully');
                redirect('admin/tour-booking/'.$booking_id);
            }
            else{
                redirect('admin/tour-booking/'.$booking_id);
            }
        }
        else if($action == 'cancel'){
            $response = $this->admin_model->update_booking_status($booking_id,'cancelled');
            sf('success_message','Booking has been cancelled successfully');
            redirect('admin/tour-booking/'.$booking_id);
        }
    }

    //update email template -Booking email
    public function manage_email_template($template='')
    {
        $template = 'booking-mail';
        $this->load->model('admin/admin_model');
        $this->gen_contents['page_heading'] = 'Update Email Template';

        if($this->input->post("update_et",true)){
            $post_data['body'] = $this->input->post("body",true);
            $response = $this->admin_model->process_email_template($post_data);
            if($response == "edited"){
                sf('success_message', 'Email template has been updated successfully');
                redirect("admin/email-template");
            }
        }

        $this->gen_contents['email_template'] = $this->admin_model->get_email_template($template);
        //p($this->gen_contents['booking_details']); exit;
        //rendering page        
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/email-template-manage', $this->gen_contents);
        $this->template->render();
    }

    //manage gallery
    public function gallery($mode="list",$id=""){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
            $page = 'admin/gallery-list';
            $this->load->model('admin/admin_model');
            // Emirates add area
            if($mode == "add"){
                $page = 'admin/gallery-add';
                $this->load->library('form_validation');
                $this->form_validation->set_rules('title', 'Gallery Name', 'required');
                if($this->form_validation->run() == TRUE){
                    $post_data['title'] = $this->input->post("title",true);                    
                    $response = $this->admin_model->process_gallery("add",$post_data);
                    if($response == "added"){
                        sf('success_message', 'New gallery has been added successfully');
                        redirect("admin/gallery");
                    }                    
                }

            }
            // Emirates edit area
            if($mode == "edit"){
                $page = 'admin/gallery-add';
                $gdata = $this->admin_model->get_gallery_data($id);
                $this->gen_contents['gdata'] = $gdata;

                $this->load->library('form_validation');
                $this->form_validation->set_rules('title', 'Gallery Name', 'required');
                if($this->form_validation->run() == TRUE){   
                    $post_data['title'] = $this->input->post("title",true);                    
                    $post_data['id'] =  $this->input->post("id",true);               
                    
                    $response = $this->admin_model->process_gallery("edit",$post_data);
                    if($response == "edited"){
                        sf('success_message', 'Gallery data has been added successfully');
                        redirect("admin/gallery");
                    }
                    
                }

            }
            // Category delete area
            if($mode == "delete" && !empty($id)){                
                $post_data = array(
                    'id'=> $id
                );
                $response = $this->admin_model->process_gallery("delete",$post_data);
                redirect("admin/gallery");
            }
            //rendering page
            $this->gen_contents['page_heading'] = 'Gallery';
            $this->gen_contents['gallery'] = $this->admin_model->get_galleries();
            $this->template->set_template('admin');
            $this->template->write_view('content', $page, $this->gen_contents);
            $this->template->render();
    }

    // Gallery images
    public function gallery_images($id='')
    {
        $this->gen_contents['page_heading'] = 'Gallery Images';
        $this->gen_contents['gallery_images']   = $this->admin_model->get_gallery_images($id);
        $this->gen_contents['gallery_data']     = $this->admin_model->get_gallery_data($id);
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/gallery-images', $this->gen_contents);
        $this->template->render();
    }

    //manage menu
    public function menu($mode="list",$id=""){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
            $page = 'admin/menu-list';
            $this->load->model('admin/admin_model');
            
            // menu edit area
            if($mode == "edit"){
                $page = 'admin/menu-edit';
                $mdata = $this->admin_model->get_menu_data($id);
                $this->gen_contents['mdata'] = $mdata;

                $this->load->library('form_validation');
                $this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
                if($this->form_validation->run() == TRUE){   
                    $post_data['menu_name'] = $this->input->post("menu_name",true);                    
                    $post_data['id'] =  $this->input->post("id",true);               
                    
                    $response = $this->admin_model->process_menu("edit",$post_data);
                    if($response == "edited"){
                        sf('success_message', 'Menu has been edited successfully');
                        redirect("admin/menu");
                    }
                    
                }

            }
            
            //rendering page
            $this->gen_contents['page_heading'] = 'Menu';
            $this->gen_contents['menu'] = $this->admin_model->get_menu();
            $this->template->set_template('admin');
            $this->template->write_view('content', $page, $this->gen_contents);
            $this->template->render();
    }


}
