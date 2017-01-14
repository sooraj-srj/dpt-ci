<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    var $username = "";
    var $password = "";
    var $title = '';
    var $gen_contents = array();
    var $mcontents;
    var $merror;
    var $msuccess;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        ini_set("display_errors", "0");
        error_reporting(0);
        $this->load->model('admin/admin_model');
    }

    public function index() {

        $this->load->model('admin/admin_model');
        if (s('ADMIN_USERID')) {
            redirect('admin/dashboard');
        } else {
            //echo "here inside"; die();
            $this->gen_contents['user_id'] = $this->authentication->admin_logged_in();

            if (!empty($_POST)) {

                $this->load->library('form_validation');
                $this->_init_adminlogin_validation_rules();
                //server side validation of input values
                if ($this->form_validation->run() == TRUE) {// form validation
                    $this->_init_adminlogin_details();
                    $login_details['username'] = $this->username;
                    $login_details['password'] = $this->password;
                    $msg = $this->authentication->process_admin_login($login_details);
                    //echo $msg; die();
                    if ($msg == 'success') {
                        // Remember Password set here --- start here - added by syama
                        //$this->admin_model->setRememberPassword();
                        // Remember Password set here --- end here
                        redirect("admin/dashboard");
                    } else if ($msg == 'inactive') {
                        sf('error_message', 'Your account has been inactivate');
                        redirect("admin");
                    } else {
                        sf('error_message', 'Invalid username or password');
                        redirect("admin");
                    }
                } else {
                    $this->merror = validation_errors();
                }
            }
            // Remember Password set here --- start here
            //$user_data = $this->admin_model->getRememberPassword();
            $this->session->set_userdata('c_username', @$user_data[1]);
            $this->session->set_userdata('c_password', @$user_data[0]);
            $this->session->set_userdata('c_remember', @$user_data[2]);
            // Remember Password set here --- end here
            
            $this->template->set_template('adminlogin');
            $this->template->write_view('content', 'admin/adminlogin', $this->gen_contents);
            $this->template->render();
        }
    }

    /**
     * validating the form elemnets
     */
    function _init_adminlogin_validation_rules() {
        $this->form_validation->set_rules('admin_username', 'username', 'required|max_length[50]');
        $this->form_validation->set_rules('admin_password', 'password', 'required|max_length[20]');
    }

    /**
     * Initialising the data     
     */
    function _init_adminlogin_details() {
        $this->username = $this->input->post("admin_username", true);
        $this->password = $this->input->post("admin_password", true);
    }

    /**
     * Admin logout function
     */
    function logout() {
        $this->authentication->admin_logout();
        redirect('admin');
    }
    
    // Update profile details
    function myprofile(){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $id = s('ADMIN_USERID');
        $details = $this->admin_model->get_profile_details($id); 
        
            $this->form_validation->set_rules('phone', 'Phone number', 'required|numeric');
            $this->form_validation->set_rules('adminname', 'Administrator name', 'required');
        
        if($this->form_validation->run() == TRUE){
            $userdata = array(
                "administrator" => $this->input->post("adminname",true),
                "phone"         => $this->input->post("phone",true)
            );
            
            $result = $this->admin_model->update_profile($userdata,$id);
            if($result) {
                sf( 'success_message', "Profile details modified successfully" );
                redirect("admin/myprofile");
            }
            else {
                sf( 'error_message', "No modifications done" );
                redirect("admin/myprofile");
            }
        }
        
        
        $this->gen_contents['details'] = $details; 
        $this->gen_contents['page_heading'] = 'My Profile';
        $this->template->set_template('admin');
        $this->template->write_view('content','admin/myprofile', $this->gen_contents);
        $this->template->render();
    }
    
    public function changepassword (){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->form_validation->set_rules('oldpassword', 'Old Password', 'required');
        $this->form_validation->set_rules('newpassword', 'New Password', 'required');
        $this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required|matches[newpassword]');
        
        if($this->form_validation->run() == TRUE){
            $userdata = array(
                "password" => $this->input->post("newpassword",true)
            );
            
            $id = s('ADMIN_USERID');
            $old_password = $this->input->post("oldpassword",true);
            
            $check_oldpassword = $this->admin_model->check_oldpassword($old_password,$id); 
            if($check_oldpassword){
                $result = $this->admin_model->update_password($userdata,$id);
                if($result) {
                    sf( 'success_message', "Password modified successfully" );
                    redirect("admin/changepassword");
                }
                else {
                    sf( 'error_message', "No modifications done" );
                    redirect("admin/changepassword");
                }
            }
            else {
                sf( 'error_message', "Please check your old password" );
                    redirect("admin/changepassword");
            }
        }
         
        $this->gen_contents['page_heading'] = 'Change Password';
        $this->template->set_template('admin');
        $this->template->write_view('content','admin/changepassword', $this->gen_contents);
        $this->template->render();
    }
    
    public function forgotpassword(){
        
        $this->form_validation->set_rules('admin_username', 'Username', 'required');
        $this->load->model('web_model');
       
        if($this->form_validation->run() == TRUE){
            $username = $this->input->post("admin_username",true);
            if(!empty($username)){ 
                
                $details = $this->admin_model->get_admindetails_byusername($username); 
                if($details) {         
                    
                    $this->load->helper('email_helper');
                    $this->gen_contents["mail_template"]  =  $this->web_model->get_mail_template(9);
                    $to = $details['email'];   
                    $firstname = $details['administrator'];
                    $subject = 'Forgot Password';
                    $message= "Hi ".$firstname."<br/>Please find your login details.<br/><br/><br/>"
                    ."<b>Username</b>  ".$details['username']."<br/>"
                    ."<b>Password</b>  ".$details['password'];

                    $mail_body  = sprintf($this->gen_contents["mail_template"]["mail_body"],$firstname,$message);
                    
                    $from_name  = $this->gen_contents["mail_template"]["mail_from_name"];
                    $from_email = $this->gen_contents["mail_template"]["mail_from"];
                    send_mail($to, $from_name,$subject,$mail_body,$from_email);

                    sf( 'success_message', "Your login details sended successfully,Please check your email." );
                    redirect("admin/forgotpassword"); 
                }
                else {
                    sf( 'error_message', "Please check your username" );
                     redirect("admin/forgotpassword");
                }
            } 
        }
        
        $this->template->set_template('adminlogin');
        $this->template->write_view('content', 'admin/forgotpassword', $this->gen_contents);
        $this->template->render();
    }
    

}
