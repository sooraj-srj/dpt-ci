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
        $this->load->model('admin/admin_model');
        $this->gen_contents['emirates']         = $this->admin_model->get_emirates();   
        $this->gen_contents['popular_tours']    = $this->web_model->get_tours('popular');   
        $this->gen_contents['categories']       = $this->web_model->get_categories();   
        $this->gen_contents['reviews']          = $this->web_model->get_reviews();        
        //p($this->gen_contents['popular_tours']); exit;     
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

    //faq page
    public function faq()
    {
        $this->gen_contents = array();
        $this->template->write_view('content', 'faq', $this->gen_contents);
        $this->template->render();
    }

    //terms page
    public function terms()
    {
        $this->gen_contents = array();
        $this->template->write_view('content', 'terms', $this->gen_contents);
        $this->template->render();
    }

    //careers page
    public function careers()
    {
        $this->gen_contents = array();
        $this->template->write_view('content', 'careers', $this->gen_contents);
        $this->template->render();
    }


    //contact page
    public function contact()
    {
        $this->gen_contents = array();
        $this->gen_contents['isd_code'] = $this->web_model->get_isd_code();
        $this->template->write_view('content', 'contact', $this->gen_contents);
        $this->template->render();
    }

    //gallery page
    public function gallery()
    {
        $this->load->model('web_model');
        $this->load->model('admin/admin_model');
        $this->gen_contents['galleries'] = $this->admin_model->get_galleries();
        $gallery_id = '';
        if($this->input->get('id') != ''){
            $gallery_id = $this->input->get('id');
        }
        $this->gen_contents['gallery_images'] = $this->admin_model->get_gallery_images($gallery_id);
        $this->gen_contents['gallery_data'] = $this->admin_model->get_gallery_data($gallery_id);
        $this->template->write_view('content', 'gallery', $this->gen_contents);
        $this->template->render();
    }

    //reviews page
    public function reviews()
    {
        $this->gen_contents = array();
        $this->gen_contents['isd_code'] = $this->web_model->get_isd_code();
        $this->gen_contents['reviews']  = $this->web_model->get_reviews();        
        $this->template->write_view('content', 'reviews', $this->gen_contents);
        $this->template->render();
    }

    //ourguide page
    public function our_guide()
    {
        $this->gen_contents = array();
        $this->gen_contents['isd_code'] = $this->web_model->get_isd_code();
        $this->template->write_view('content', 'our-guide', $this->gen_contents);
        $this->template->render();
    }

    //tourist-visa page
    public function tourist_visa()
    {
        $this->gen_contents['nationalities']  = $this->web_model->get_nationalities();
        $this->gen_contents['isd_code']     = $this->web_model->get_isd_code();
        $this->template->write_view('content', 'tourist-visa', $this->gen_contents);
        $this->template->render();
    }
    
    //select tours 
    public function select_tours($category)
    {     
        $this->load->model('web_model');
        $this->load->model('admin/admin_model');
        $this->gen_contents['categories'] = $this->web_model->get_categories();
        $this->gen_contents['current'] = $category;  
        $this->gen_contents['emirates'] = $this->admin_model->get_emirates();              
        //p($this->gen_contents['categories']);exit;
        $this->template->write_view('content', 'list-emirates', $this->gen_contents);
        $this->template->render();
    }

    //transfer service

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
        $this->gen_contents['tour_gallery'] = $this->web_model->get_tour_gallery($tour_id);
        $this->gen_contents['tour_id'] = $tour_id;
        $this->gen_contents['pickup_location'] = $this->web_model->get_pickup_location();
        $this->gen_contents['flag'] = 'tours';
        $this->gen_contents['isd_code'] = $this->web_model->get_isd_code();
        
        //p($this->gen_contents['tour_details']); exit;
        $this->template->write_view('content', 'select-plan', $this->gen_contents);
        $this->template->render();
    }

    //select and submit transfer service
    public function select_transfer($emirates_id)
    {        
        $this->load->model('web_model');
        $this->gen_contents['emirates_id'] = $emirates_id;
        $this->gen_contents['tour_id'] = 0;
        
        $this->gen_contents['pickup_location'] = $this->web_model->get_pickup_location();
        $this->gen_contents['flag'] = 'transfer';
        $this->gen_contents['isd_code'] = $this->web_model->get_isd_code();
        
        //p($this->gen_contents['tour_details']); exit;
        $this->template->write_view('content', 'select-plan', $this->gen_contents);
        $this->template->render();
    }

    //plan submission application
    public function plan_appln()
    {
        $this->load->model('web_model');

        $tour_date                      = explode('/',$this->input->post('tour_date',true));
        $post_data['tour_date']         = $tour_date[2].'-'.$tour_date[1].'-'.$tour_date[0];
        $post_data['pref_pickup_time']  = $this->input->post('pref_pickup_time',true);
        $post_data['pickup_location']   = $this->input->post('pickup_location',true);
        $post_data['dropLocation']      = $this->input->post('dropLocation',true);
        $post_data['currencyCode']      = $this->input->post('currencyCode',true);
        $post_data['currencyMode']      = $this->input->post('currencyMode',true);
        $post_data['adultNo']           = $this->input->post('adultNo',true);
        $post_data['childNo']           = $this->input->post('childNo',true);
        $post_data['infantNo']          = $this->input->post('infantNo',true);
        $post_data['firstName']         = $this->input->post('firstName',true);
        $post_data['lastName']          = $this->input->post('lastName',true);
        $post_data['email']             = $this->input->post('email',true);
        $post_data['nationality']       = $this->input->post('nationality',true);
        $post_data['countryCode1']      = $this->input->post('countryCode1',true);
        $post_data['cell_no1']          = $this->input->post('cell_no1',true);
        $post_data['countryCode2']      = $this->input->post('countryCode2',true);
        $post_data['cell_no2']          = $this->input->post('cell_no2',true);
        //$post_data['howfind']           = $this->input->post('howfind',true);
        $post_data['specialRequests']   = $this->input->post('specialResquest',true);
        $post_data['cell_no2']          = $this->input->post('cell_no2',true);
        
        $post_data['hotelName']         = $this->input->post('hotelName',true);
        $post_data['hotelAddress']      = $this->input->post('hotelAddress',true);
        $post_data['hotelPhoneNo']      = $this->input->post('hotelPhoneNo',true);
        $post_data['flightName']        = $this->input->post('flightName',true);
        $post_data['terminalName']      = $this->input->post('terminalName',true);
        $post_data['flightArrival']     = $this->input->post('flightArrival',true);
        $post_data['flightDeparture']   = $this->input->post('flightDeparture',true);
        $post_data['endhotelName']      = $this->input->post('endhotelName',true);
        $post_data['endhotelAddress']   = $this->input->post('endhotelAddress',true);
        $post_data['endhotelPhoneNo']   = $this->input->post('endhotelPhoneNo',true);

        $post_data['tour_id']           = $this->input->post('tour_id',true);
        $post_data['timestamp']         = time();
        $tour_name = $this->web_model->get_tourname($post_data['tour_id']);
        //p($post_data); exit;
        $response = $this->web_model->process_tour_booking($post_data);

        $user_name = $post_data['firstName'];
        $tour_name = $this->web_model->get_tourname($post_data['tour_id']);
        if($response == "success"){
            // ====== Send email notification =========
            if($tour_id > 0){
                $message = "Your booking for the tour, ".$tour_name." has been initiated successfully";
            }
            else{
                $message = "Your booking for transfer service has been initiated successfully";
            }
            $to_email       = $post_data['email'];
            $from_name      = 'Dubai Private Tours';
            $subject        = $tour_name.': Booking initiated!';            
            $body_content   = $this->web_model->getEmailTemplate();
            $body_content   = str_replace('{{user_name}}', $user_name, $body_content);
            $body_content   = str_replace('{{message}}', $message, $body_content);
            $from_email     = 'info@dubaiprivatetour.com';
            //echo $body_content; exit;
            send_mail($to_email, $from_name, $subject, $body_content, $from_email);
            // ====== Send email notification =========
            sf('success_message','Your booking has been submitted successfully. We will update the booking status by email soon.');
            redirect('thank-you');
        }
        else{
            sf('error_message','Your booking failed! Please try again.');
            redirect('thank-you');
        }

    }

    // visa submission application
    public function visa_appln()
    {
        $this->load->model('web_model');            
        $post_data['name']              = $this->input->post('name',true);
        $post_data['email']             = $this->input->post('email',true);
        $post_data['contact_no']        = $this->input->post('isd_code',true).' '.$this->input->post('contact_no',true);
        $post_data['nationality']       = $this->input->post('nationality',true);

        $arrival_date                   = explode('/',$this->input->post('arrival_date',true));
        $post_data['arrival_date']      = $arrival_date[2].'-'.$arrival_date[1].'-'.$arrival_date[0];

        $departure_date                 = explode('/',$this->input->post('departure_date',true));
        $post_data['departure_date']    = $departure_date[2].'-'.$departure_date[1].'-'.$departure_date[0];

        $post_data['people']            = $this->input->post('people',true);
        $post_data['how_discover_us']   = $this->input->post('how_discover_us',true);        
        $post_data['timestamp']         = time();
        //p($post_data); exit;
        
        $config['upload_path']          = './assets/files/';  
        $config['allowed_types']        = 'jpg|png|pdf';                
        $config['encrypt_name']         = TRUE;
        
        //hotel booking file upload
        $hotel_booking = "";
        if (!empty($_FILES['hotel_booking']['name'])) {                         
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('hotel_booking')){
                  $upload_detail = $this->upload->data();
                  $post_data['hotel_booking'] = $upload_detail["file_name"];
            }               
        }

        //hotel booking file upload
        $flight_ticket = "";
        if (!empty($_FILES['flight_ticket']['name'])) {             
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('flight_ticket')){
                  $upload_detail = $this->upload->data();
                  $post_data['flight_ticket'] = $upload_detail["file_name"];
            }               
        }

        //hotel booking file upload
        $passport_copy = "";
        if (!empty($_FILES['passport_copy']['name'])) {             
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('passport_copy')){
                  $upload_detail = $this->upload->data();
                  $post_data['passport_copy'] = $upload_detail["file_name"];
            }               
        }

        //process visa data
        $response = $this->web_model->process_visa_application($post_data);
        if($response == "success"){
            // ====== Send email notification =========
            $to_email       = 'soorajsolutino@gmail.com';
            $from_name      = 'Dubai Private Tours';
            $subject        = 'A new tourist visa application';
            $body_content   = 'Hi, A new visa application from '.$post_data['name'];
            $from_email     = 'info@dubaiprivatetour.com';

            send_mail($to_email, $from_name, $subject, $body_content, $from_email);
            // ====== Send email notification =========
            sf('success_message','Your application has been submitted successfully!');
            redirect('thank-you');
        }
        else{
            sf('error_message','Your application failed! Please try again.');
            redirect('thank-you');
        }

    }

    //askme submission 
    public function askme_appln()
    {
        $this->load->model('web_model');

        $post_data['first_name']      = $this->input->post('first_name',true);
        $post_data['last_name']       = $this->input->post('last_name',true);
        $post_data['email']           = $this->input->post('email',true);
        $post_data['nationality']     = $this->input->post('nationality',true);
        $post_data['phone_number']    = $this->input->post('phone_number',true);
        $post_data['message']         = $this->input->post('message',true);
        $tour_id = $this->input->post('tour_id',true);
        if(!empty($tour_id)) { 
            $post_data['tour_id'] = $tour_id; 
        } else { 
            $post_data['tour_id'] = 0; 
        }
        $post_data['qn_for']          = $this->input->post('qn_for',true);
        $post_data['timestamp']       = time();
        //p($post_data); exit;
        $response = $this->web_model->process_ask_question($post_data);
        if($response == "success"){
            // ====== Send email notification =========
            $to_email       = 'soorajsolutino@gmail.com';
            $from_name      = 'Dubai Private Tours';
            $subject        = 'Question from a user';
            $body_content   = 'Hi, A new question from '.$post_data['first_name'];
            $from_email     = 'info@dubaiprivatetour.com';

            //send_mail($to_email, $from_name, $subject, $body_content, $from_email);
            // ====== Send email notification =========
            sf('success_message','Your message/question has been submitted successfully!');
            redirect('thank-you');
        }
        else{
            sf('error_message','Your submission failed! Please try again.');
            redirect('thank-you');
        }

    }

    //review submission 
    public function review_appln()
    {
        $this->load->model('web_model');

        $post_data['name']      = $this->input->post('name',true);        
        $post_data['email']     = $this->input->post('email',true);
        $post_data['country']   = $this->input->post('country',true);
        $post_data['rating']    = $this->input->post('rating',true);
        $post_data['comments']  = $this->input->post('comments',true);        
        $post_data['timestamp'] = time();
        //p($post_data); exit;
        $response = $this->web_model->process_review_appln($post_data);
        if($response == "success"){
            // ====== Send email notification =========            
            sf('success_message','Your review has been submitted successfully. Thank you for yoour valuable review.');
            redirect('thank-you');
        }
        else{
            sf('error_message','Your submission failed! Please try again.');
            redirect('thank-you');
        }

    }

    //contact appln submission 
    public function contact_appln()
    {
        $this->load->model('web_model');

        $post_data['name']            = $this->input->post('name',true);
        $post_data['email']           = $this->input->post('email',true);
        $post_data['nationality']     = $this->input->post('nationality',true);
        $post_data['phone_number']    = $this->input->post('isd_code',true).' '.$this->input->post('phone_number',true);
        $post_data['how_discover_us'] = $this->input->post('how_discover_us',true);        
        $post_data['address']         = $this->input->post('address',true);        
        $post_data['subject']         = $this->input->post('subject',true);        
        $post_data['message']         = $this->input->post('message',true);                
        $post_data['timestamp']       = time();
        //p($post_data); exit;
        $response = $this->web_model->process_contact_appln($post_data);
        if($response == "success"){
            // ====== Send email notification =========
            $to_email       = 'soorajsolutino@gmail.com';
            $from_name      = 'Dubai Private Tours';
            $subject        = 'Contact Message';
            $body_content   = 'Hi, A new contact message from '.$post_data['name'];
            $from_email     = 'info@dubaiprivatetour.com';

            send_mail($to_email, $from_name, $subject, $body_content, $from_email);
            // ====== Send email notification =========
            sf('success_message','Your contact message has been submitted successfully!');
            redirect('thank-you');
        }
        else{
            sf('error_message','Your submission failed! Please try again.');
            redirect('thank-you');
        }

    }

    //thank you page
    public function thankyou()
    {
        $this->gen_contents = array();
        $this->template->write_view('content', 'thank-you', $this->gen_contents);
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
