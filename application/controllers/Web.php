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
        $this->gen_contents['reviews']          = $this->web_model->get_reviews(3);        
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
            $cat_id = $this->input->get('id');
        }
        $this->gen_contents['categories'] = $this->admin_model->get_categories();
        $this->gen_contents['galleries'] = $this->web_model->get_tour_gallery($cat_id);
        $this->gen_contents['cat_name'] = $this->web_model->get_category_name($cat_id);

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
        $this->load->model('admin/admin_model');
        
        $this->gen_contents = array();
        $this->gen_contents['isd_code']    = $this->web_model->get_isd_code();
        $this->gen_contents['contents']    = $this->admin_model->get_dpt_contents();
        $this->template->write_view('content', 'our-guide', $this->gen_contents);
        $this->template->render();
    }

    //tourist-visa page
    public function tourist_visa()
    {
        $this->load->model('admin/admin_model');
        $this->gen_contents['nationalities']  = $this->web_model->get_nationalities();
        $this->gen_contents['isd_code']     = $this->web_model->get_isd_code();
        $this->gen_contents['contents']    = $this->admin_model->get_dpt_contents();
        $this->template->write_view('content', 'tourist-visa', $this->gen_contents);
        $this->template->render();
    }
    
    //select tours 
    public function select_tours($category='')
    {  
        $this->load->model('web_model');
        $this->load->model('admin/admin_model');
        $this->gen_contents['categories'] = $this->web_model->get_categories();
        $this->gen_contents['current'] = $category;  

        //Check the category has emirates or not
        $category_id    = $this->web_model->get_categoryID_fromSlug($category);
        $cat_emi        = $this->web_model->get_category_emirates($category_id);
        if(!empty($cat_emi)){
            $this->gen_contents['emirates'] = $cat_emi;
        }
        else{
            redirect('plan/'.$category);        
        }
        //p($cat_emi); exit;
        //$this->gen_contents['emirates'] = $this->admin_model->get_emirates();              
        //p($this->gen_contents['categories']);exit;

        if($category == 'luxury-tours'){
            redirect('plan/luxury-tours/select');
        }
        $this->template->write_view('content', 'list-emirates', $this->gen_contents);
        $this->template->render();
    }

    //transfer service

    //plan page
    public function select_plan($category='', $emirates='')
    {
        $tour_id = $this->input->get('plan', TRUE);
        $this->load->model('web_model');
        $this->gen_contents['current'] = $category;
        $this->gen_contents['tours'] = $this->web_model->get_tours($category);
        if(empty($tour_id)){
            $tour_id = $this->web_model->get_default_tour_id($category);
        }
        $tour_details = $this->web_model->get_tour_details($tour_id);
        $this->gen_contents['tour_details'] = $tour_details;
        $this->gen_contents['tour_gallery'] = $this->web_model->get_tour_gallery($tour_details['category_id'],$emirates);
        //p($this->gen_contents['tour_gallery']);
        $this->gen_contents['tour_id']      = $tour_id;
        $this->gen_contents['emirates']     = $emirates;        
        $this->gen_contents['emirates_id']     = $emirates;        
        $this->gen_contents['pickup_location'] = $this->web_model->get_pickup_location();
        $this->gen_contents['end_location'] = $this->web_model->get_end_location();
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
        //$this->gen_contents['tour_id'] = 0;
        $this->gen_contents['tours'] = $this->web_model->get_tours_from_emirates($emirates_id);
        $tour_id = $this->input->get('plan', TRUE);
        if(empty($tour_id)){
            $tour_id = $this->web_model->get_default_tour_emirates($emirates_id);
        }
        //echo $tour_id; exit;
        $this->gen_contents['tour_id']          = $tour_id;
        $this->gen_contents['tour_details']     = $this->web_model->get_tour_details($tour_id);
        $this->gen_contents['pickup_location']  = $this->web_model->get_pickup_location();
        $this->gen_contents['end_location']     = $this->web_model->get_end_location();
        $this->gen_contents['flag']             = 'transfer';
        $this->gen_contents['isd_code']         = $this->web_model->get_isd_code();
        
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
        $post_data['howfind']           = $this->input->post('howfind',true);
        $post_data['preferedguide']     = $this->input->post('preferedguide',true);
        $post_data['specialRequests']   = $this->input->post('specialResquest',true);
        
        $post_data['hotelName']         = $this->input->post('hotelName',true);
        $post_data['hotelAddress']      = $this->input->post('hotelAddress',true);
        $post_data['hotelPhoneNo']      = $this->input->post('hotelPhoneNo',true);
        $post_data['flightName']        = $this->input->post('flightName',true);
        $post_data['terminalName']      = $this->input->post('terminalName',true);
        $post_data['flightArrival']     = $this->input->post('flightArrivalTime',true).' '.$this->input->post('flightArrivalUnit',true);
        $post_data['flightDeparture']   = $this->input->post('flightDeparture',true).' '.$this->input->post('flightDepartureUnit',true);
        $post_data['endhotelName']      = $this->input->post('endhotelName',true);
        $post_data['endhotelAddress']   = $this->input->post('endhotelAddress',true);
        $post_data['endhotelPhoneNo']   = $this->input->post('endhotelPhoneNo',true);

        $post_data['start_lr_address']  = $this->input->post('start_lr_address',true);
        $post_data['start_lr_phone']    = $this->input->post('start_lr_phone',true);
        $post_data['start_rest_name']   = $this->input->post('start_rest_name',true);
        $post_data['start_rest_address']   = $this->input->post('start_rest_address',true);
        $post_data['start_rest_phone']     = $this->input->post('start_rest_phone',true);
        $post_data['end_lr_address']       = $this->input->post('end_lr_address',true);
        $post_data['end_lr_phone']         = $this->input->post('end_lr_phone',true);
        $post_data['end_rest_name']        = $this->input->post('end_rest_name',true);
        $post_data['end_rest_address']     = $this->input->post('end_rest_address',true);
        $post_data['end_rest_phone']       = $this->input->post('end_rest_phone',true);
        $post_data['end_place_name']       = $this->input->post('end_place_name',true);
        $post_data['end_place_address']    = $this->input->post('end_place_address',true);
        $post_data['end_place_phone']      = $this->input->post('end_place_phone',true);        

        $post_data['tour_id']           = $this->input->post('tour_id',true);
        $post_data['timestamp']         = time();
        $tour_name = $this->web_model->get_tourname($post_data['tour_id']);
        //echo get_admin_tour_template($post_data); exit;
        //p($post_data); exit;
        $response = $this->web_model->process_tour_booking($post_data);

        $user_name = $post_data['firstName'];
        $tour_name = $this->web_model->get_tourname($post_data['tour_id']);
        if($response == "success"){
            // ====== Send email notification =========
            if($post_data['tour_id'] > 0){                
                $content1 = '<b>Tour Booking Details:</b> <br><br>'.get_admin_tour_template($post_data);
            }
            else{                
                $content1 = '<b>Transfer Service Booking Details:</b> <br><br>'.get_admin_tour_template($post_data);
            }
            $content = get_message('booking');
            //======== EMAIL TO USER ===============
            $to_email       = $post_data['email'];
            $from_name      = 'Dubai Private Tours';
            $subject        = 'Greetings and thank you for choosing Dubai Private Tours!'; 
            $body_content   = email_header($user_name, 'Successfully submitted your booking').$content.email_footer();            
            $from_email     = 'info@dubaiprivatetour.com';
            send_mail($to_email, $from_name, $subject, $body_content, $from_email); // send notification to user

            //======== EMAIL TO ADMIN ===============
            $from_name      = $post_data['firstName'].' '.$post_data['lastName'];
            $from_email     = $post_data['email'];
            $to_email1      = 'info@dubaiprivatetour.com';
            $to_email2      = 'dubaiprivatetour@gmail.com';
            $subject1       = "Tour booking for ".$tour_name." from ".$user_name;
            $body_content1  = email_header('Admin', 'New booking for '.$tour_name).$content1.email_footer();    
            send_mail($to_email1, $from_name, $subject1, $body_content1, $from_email);  //send notification to admin
            send_mail($to_email2, $from_name, $subject1, $body_content1, $from_email);  //send notification to admin
            //echo $body_content1; exit;
            // ====== Send email notification =========
            $success_message = get_message('booking');
            sf('success_message',$success_message);
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
        $this->load->library('upload');
        
        $files = $_FILES;
        //============= hotel booking file upload ===========
        $count = count($_FILES['hotel_booking']['name']);
        for($i=0; $i<$count; $i++){
            $_FILES['hotel_booking']['name']     = $files['hotel_booking']['name'][$i];
            $_FILES['hotel_booking']['type']     = $files['hotel_booking']['type'][$i];
            $_FILES['hotel_booking']['tmp_name'] = $files['hotel_booking']['tmp_name'][$i];
            $_FILES['hotel_booking']['error']    = $files['hotel_booking']['error'][$i];
            $_FILES['hotel_booking']['size']     = $files['hotel_booking']['size'][$i];    
            $this->upload->initialize($config);
            if($this->upload->do_upload('hotel_booking')){
                $upload_detail = $this->upload->data();
                $hotel_booking[$i] = $upload_detail["file_name"];
            }
            
        }
        $post_data['hotel_booking'] = implode(',',$hotel_booking);
        //============= hotel booking file upload ===========

        //============= flight_ticket file upload ===========
        $count = count($_FILES['hotel_booking']['name']);
        for($i=0; $i<$count; $i++){
            $_FILES['flight_ticket']['name']     = $files['flight_ticket']['name'][$i];
            $_FILES['flight_ticket']['type']     = $files['flight_ticket']['type'][$i];
            $_FILES['flight_ticket']['tmp_name'] = $files['flight_ticket']['tmp_name'][$i];
            $_FILES['flight_ticket']['error']    = $files['flight_ticket']['error'][$i];
            $_FILES['flight_ticket']['size']     = $files['flight_ticket']['size'][$i];    
            $this->upload->initialize($config);
            if($this->upload->do_upload('flight_ticket')){
                $upload_detail = $this->upload->data();
                $flight_ticket[$i] = $upload_detail["file_name"];
            }
            
        }
        $post_data['flight_ticket'] = implode(',',$flight_ticket);
        //============= flight_ticket file upload ===========

        //============= flight_ticket file upload ===========
        $count = count($_FILES['passport_copy']['name']);
        for($i=0; $i<$count; $i++){
            $_FILES['passport_copy']['name']     = $files['passport_copy']['name'][$i];
            $_FILES['passport_copy']['type']     = $files['passport_copy']['type'][$i];
            $_FILES['passport_copy']['tmp_name'] = $files['passport_copy']['tmp_name'][$i];
            $_FILES['passport_copy']['error']    = $files['passport_copy']['error'][$i];
            $_FILES['passport_copy']['size']     = $files['passport_copy']['size'][$i];    
            $this->upload->initialize($config);
            if($this->upload->do_upload('passport_copy')){
                $upload_detail = $this->upload->data();
                $passport_copy[$i] = $upload_detail["file_name"];
            }
            
        }
        $post_data['passport_copy'] = implode(',',$passport_copy);
        //============= flight_ticket file upload ===========

        //process visa data
        $response = $this->web_model->process_visa_application($post_data);
        if($response == "success"){
            // ====== Send email notification =========
            $to_email       = 'info@dubaiprivatetour.com';
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
                $content        = get_message('enquiry');
                $to_email       = $post_data['email'];
                $from_name      = 'Dubai Private Tours';
                $subject        = 'Greetings and thank you for choosing Dubai Private Tours!'; 
                $body_content   = email_header($post_data['name'], 'The message was sent via contact form on with the following details').$content.email_footer();            
                $from_email     = 'info@dubaiprivatetour.com';
                send_mail($to_email, $from_name, $subject, $body_content, $from_email); // send notification to user

            $content1       = 'Contact enquiry from '.$post_data['name'].'. Enquiry Details are below:';
            $content1 .= '<table width="100%" border="1" style="border-collapse:collapse;" cellpadding="7">                
                            <tr><td>Name: </td> <td>'.$post_data['name'].'</td></tr>
                            <tr><td>Email: </td> <td>'.$post_data['email'].'</td></tr>
                            <tr><td>Nationality: </td> <td>'.$post_data['nationality'].'</td></tr>
                            <tr><td>How did you discover us: </td> <td>'.$post_data['how_discover_us'].'</td></tr>
                            <tr><td>Cell No: </td> <td>'.$post_data['phone_number'].'</td></tr>
                            <tr><td>Address: </td> <td>'.$post_data['address'].'</td></tr>
                            <tr><td>Subject: </td> <td>'.$post_data['subject'].'</td></tr>
                            <tr><td>Message: </td> <td>'.$post_data['message'].'</td></tr>                
                            </table><br><br>';
            $from_email     = $post_data['email'];
            $to_email1      = 'info@dubaiprivatetour.com';
            $to_email2      = 'dubaiprivatetour@gmail.com';
            $subject1       = $post_data['subject'];//"Enquiry from ".$post_data['name'];
            $from_name2     = $post_data['name'];
            $body_content1  = email_header('Admin', 'Contact Enquiry Notification').$content1.email_footer();    
            send_mail($to_email1, $from_name2, $subject1, $body_content1, $from_email);  //send notification to user
            send_mail($to_email2, $from_name2, $subject1, $body_content1, $from_email);  //send notification to admin

            // ====== Send email notification =========
            sf('success_message',$content);
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
