<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    /**
     *Controller to generate ajax request data
     */
    var $gen_contents = array();
    // view more function to display popup data
    public function viewmore($from = "", $data_id = ""){
        
        $this->load->model('admin/admin_model');
        if($from == 'leads') {
            $tbl_name       = 'leads_details';
            $data['from']   = "leads";
            $data['ld']     = $this->admin_model->get_more_details($data_id,$tbl_name);  // get lead details
        }
        else if($from == 'sellyourcopier') {
            $tbl_name       = 'cc_sellcopier';
            $data['from']   = "sellyourcopier";
            $data['ld']     = $this->admin_model->get_more_details($data_id,$tbl_name);  // get sellyourcopier details
        }
        else if($from == 'preregistration') {
            $tbl_name       = 'pre_registration';
            $data['from']   = "preregistration";
            $data['ld']     = $this->admin_model->get_more_details($data_id,$tbl_name);  // get preregistration details
        }
        else if($from == 'leadmatchsuppliers') {
            $tbl_name       = 'leadmatch_history';
            $data['from']   = "leadmatchsuppliers";
            $data['details'] = $this->admin_model->get_more_details($data_id,$tbl_name);  // get leadmatchsuppliers details
            //p($data['details']);
        }
        else if($from == 'leadmatchsuppliers_paymentstatus') {
            $tbl_name       = 'leadmatch_history_payment';
            $data['from']   = "leadmatchsuppliers_paymentstatus";
            $data['details'] = $this->admin_model->get_more_details($data_id,$tbl_name);  // get leadmatchsuppliers details
        }
        else {  
            $tbl_name       = 'users';
            $data['from']   = "users"; 
            $data['ld']     = $this->admin_model->get_more_details($data_id,$tbl_name);  // get user details
        }
        
        $this->load->view("admin/ajax_data",$data);
        
    }
    
    public function viewquestionanswerlist($id = 0){  
        
        if($id != 0){
            $this->load->model('admin/admin_model');
            $this->data['details'] = $this->admin_model->get_questionanswerlist($id);
            $this->data['from']   = "questionanswerlist";
            $this->load->view("admin/ajax_data",$this->data);
            
        }
       else {
            return false;
        }
    }
    
    public function modifydeviceprice($id = 0){     
        if($id != 0){
            $this->load->model('admin/admin_model');
            $this->data['id']     = $id;
            $this->data['details'] = $this->admin_model->get_devide_pricebyid($id);
            $this->data['from']   = "modifydeviceprice";
            $this->load->view("admin/ajax_data",$this->data); 
        }
       else {
            return false;
        }
    }
    
    public function addcredict($id = 0){     
        if($id != 0){
            $this->data['id']     = $id;
            $this->data['from']   = "addcredict";
            $this->load->view("admin/ajax_data",$this->data); 
        }
       else {
            return false;
        }
    }
    
    public function rotating_banner_urlupdate($id = 0){    
        if($id != 0){
            $this->load->model('admin/admin_model');
            $this->data['id']     = $id;
            $this->data['details'] = $this->admin_model->get_rotating_banner_link($id); 
            $this->data['from']   = "rotating_banner_urlupdate";
            $this->load->view("admin/ajax_data",$this->data); 
        }
       else {
            return false;
        }
    }
    
    public function editmessage($id = 0){     
        if($id != 0){
            $this->load->model('admin/admin_model');
            $this->data['id']     = $id;
            $this->data['details'] = $this->admin_model->get_emailalert_details($id); 
            $this->data['from']   = "editmessage";
            $this->load->view("admin/ajax_data",$this->data); 
        }
       else {
            return false;
        }
    }
    
    
    public function removecarousalimages ($id = 0) {
        $this->load->model('admin/admin_model');
        $result = $this->admin_model->deletecarousal_images_inedit($id); 
        if($result)
            return TRUE;
        else 
            return FALSE;
    }
    
    public function removearticleimage ($id = 0) {
        $this->load->model('admin/admin_model');
        $get_image_byid = $this->admin_model->get_image_articles($id);
        if($get_image_byid){
            
            unlink("assets/images/articles/".$get_image_byid['image']);
            
            $data = array(
                "image" => ''
            );
            $clear_image_field = $this->admin_model->update_image_field($id,$data);
            if($clear_image_field)
                return true;
            else 
                return false;
        }
    }

        public function rejectreason($id = 0,$userID = 0){     
        if($id != 0){
            $this->load->model('admin/admin_model');
            $this->data['details'] = $this->admin_model->get_transaction_details_byid($userID); 
            
            $details = explode(':', $this->data['details']['description']);
            $this->data['banner_id']     = $details[1];
            $this->data['id']     = $id;
            $this->data['userID']     = $userID;
            $this->data['from']   = "rejectreason";
            $this->load->view("admin/ajax_data",$this->data); 
        }
       else {
            return false;
        }
    }
    
    public function feedbackapprove($lead_feedback_id = 0,$lead_id = 0,$sellcopier_id = 0,$userID = 0){     
        if($lead_feedback_id != 0 && is_numeric($lead_feedback_id)){
            $this->load->model('admin/admin_model');
            /*$transaction_details = $this->admin_model->get_transaction_details_byid_feedbackapproval($userID); 
            
            if($transaction_details){
                foreach ($transaction_details as $trans){
                    $details = explode(':', $trans['description']);
                    if($details[2] == $lead_feedback_id){
                        $this->data['amount']     = $trans['amount'];
                        $this->data['lead_feedback_id']     = $lead_feedback_id;
                        $this->data['lead_id']     = $lead_id;
                        $this->data['sellcopier_id']     = $sellcopier_id;
                        $this->data['userID']     = $userID;
                        
                        $this->data['from']   = "feedbackapproval";
                        $this->load->view("admin/ajax_data",$this->data); 
                    }
                }
            } */
            if($lead_id != 0) {
                $get_lead_price = $this->admin_model->get_lead_price_byleadid($lead_id); 
                $amount = $get_lead_price['lead_price']; 
            }
            else {
                $get_lead_price = $this->admin_model->get_sellcopier_price($sellcopier_id); 
                 $amount = $get_lead_price['supplier_price']; 
            }
            if($get_lead_price){
                
                $this->data['amount']           = $amount;
                $this->data['lead_feedback_id'] = $lead_feedback_id;
                $this->data['lead_id']          = $lead_id;
                $this->data['sellcopier_id']    = $sellcopier_id;
                $this->data['userID']           = $userID;

                $this->data['from']             = "feedbackapproval";
                $this->load->view("admin/ajax_data",$this->data); 
            }
            else {
                return false;
            }
        }
       else {
            return false;
        }
    }
    
    public function viewpreview($id = 0,$type = ''){  
        
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            $this->data['details'] = $this->admin_model->get_previewlist($id,$type);
            $this->data['type']   = $type;
            $this->data['from']   = "previewlist";
            $this->load->view("admin/ajax_data",$this->data);
        }
        else {
            return false;
        }
    }
    
    public function viewpreview_pagecontents(){  
        
        $link = $this->input->get("link"); 
        $this->data['type']   = $link;
        $this->data['from']   = "previewlist_pagecontents";
        $this->load->view("admin/ajax_data",$this->data);
    }
    
    public function modifydevicepricesubmision () {      
        $this->load->model('admin/admin_model');
        
        $amount = $this->input->get("amount"); 
        $price_id = $this->input->get("price_id"); 
        
        $userdata = array(
               'price' => $amount
        );       
       
        $result = $this->admin_model->device_price_modification($userdata,$price_id);
        if($result){
            sf( 'success_message', "Device price modified successfully" );  
            redirect("admin/devicepricesettings");
        }
        else {
            sf('error_message', 'No modifications done'); 
            redirect("admin/devicepricesettings");
        } 
    }
    
    public function modifybannerlink( ) {      
        $this->load->model('admin/admin_model');
        
        $banner_url = $this->input->get("banner_url"); 
        $banner_id = $this->input->get("banner_id"); 
        
        $userdata = array(
               'banner_link' => $banner_url
        );       
       
        $result = $this->admin_model->banner_link_modification($userdata,$banner_id);
        if($result){
            sf( 'success_message', "Banner link modified successfully" );  
            redirect("admin/rotatingbannerreport");
        }
        else {
            sf('error_message', 'No modifications done'); 
            redirect("admin/rotatingbannerreport");
        } 
    }
    
    
    public function creditsubmision () {      
        $this->load->model('admin/admin_model');
        
        $amount = $this->uri->segment(3); 
        $reason = urldecode($this->uri->segment(4));  
        $userID = $this->uri->segment(5);
        $reason_data = substr($reason, 6);
        $date = date('Y-m-d');
        $userdata = array(
               'amount' => $amount,
               'credits_nr' => $amount,
               'reason' => $reason_data,
               'description' => $reason_data,
               'userID' => $userID,
               'status' => 'Completed',
               'date' => $date,
               'transaction' => 'Credit added',
        );       
       
        $result = $this->admin_model->credit_amount_insertion($userdata);
        if($result){
            sf( 'success_message', "Credit amount inserted successfully" );  
            redirect("admin/users");
        }
        else {
            sf('error_message', 'Credit amount not inserted,Please try again'); 
            redirect("admin/users");
        } 
    }
    
    public function modifymessagesubmision () {      
        $this->load->model('admin/admin_model');
         
        //$message = urldecode($this->uri->segment(3));  
       //$id = $this->uri->segment(4);
        //$message_data = substr($message, 6);
        $message_data = $this->input->get("message"); 
        $id = $this->input->get("id"); 
        
        $userdata = array(
               'message' => $message_data
        );       
       
        $result = $this->admin_model->modify_emailalert_settings($userdata,$id);
        if($result){
            sf( 'success_message', "Message successfully modified" );  
            redirect("admin/emailalertsettings");
        }
        else {
            sf('error_message', 'Message not modified,Please try again'); 
            redirect("admin/emailalertsettings");
        } 
    }
    
    public function feedbackapprovalsubmit () {  
        $this->load->model('admin/admin_model');
        $this->load->model('web_model');
        
        $amount = $this->uri->segment(3); 
        $lead_id = $this->uri->segment(4);   
        $userID = $this->uri->segment(5);
        $lead_feedback_id = $this->uri->segment(6);
        $sellcopier_id = $this->uri->segment(7);
        
        $udata = array(
               'refund_approved' => '1' 
        );
          
         if($lead_id != '0'){     
             $description = 'Refund approved, User ID:'.$lead_id.', Feedback ID:'.$lead_feedback_id ;
         }
         else {
              $description = 'Refund approved, User ID:'.$sellcopier_id.', Feedback ID:'.$lead_feedback_id ;
         }
                 
        $update_feedback_table = $this->admin_model-> feedback_modification($udata,$lead_feedback_id);
        $lead_details = $this->admin_model-> get_lead_details_byid($lead_id);
        $supplier_details = $this->admin_model-> get_supplier_details_byid($userID);
        
        if($supplier_details){
            $userdata = array(
               'transaction' => 'Refunded',
               'userID' => $userID,
               'date' => date('Y-m-d'),
               'credits_nr' => $amount,
               'amount' => $amount,
               'company_name' => $userID,
               'username' => $supplier_details['contact_name'],
               'description' => $description,
               'status' => 'Completed',
            );  

            $insert_transaction_details = $this->admin_model-> insert_transaction($userdata);
            
            $this->load->helper('email_helper');
            $this->gen_contents["mail_template"]  =  $this->web_model->get_mail_template(16);
            $message = 'Your refund request was approved. Amount refunded was <b>'.$amount .'</b> credits';
            //echo $message; exit;
            $mail_body  = sprintf($this->gen_contents["mail_template"]["mail_body"],$supplier_details['contact_name'],$message);
            $mail_to = $supplier_details['email'];

            $subject    = 'Refund approval';
            $from_name  = $this->gen_contents["mail_template"]["mail_from_name"];
            $from_email = $this->gen_contents["mail_template"]["mail_from"];
            send_mail($mail_to, $from_name,$subject,$mail_body,$from_email);
            
            sf( 'success_message', "Refund request approved successfully" );
            redirect("admin/managerefund");
        }
        else {
            sf( 'error_message', "Refund request not approved,Please try again" );
            redirect("admin/managerefund");
        } 
    }
    
    public function rejectreasonrotatingbanner () {
        $this->load->model('admin/admin_model');
        $this->load->model('web_model');
        
        $amount = $this->uri->segment(3); 
        $reason = $this->uri->segment(4);  
        $id     = $this->uri->segment(5);
        $userID = $this->uri->segment(6);
        $banner_id = $this->uri->segment(7);
        $reason_data = substr($reason, 6);      
        $rason = urldecode($reason_data);
        $date = date('Y-m-d H:i:s');
        $amount = abs($amount);         
        
        $udata = array(
               'rejection_reason' => $rason,
               'deleted_date' => $date,
               'status' => 'D' 
        );  
        $update_rotating_table = $this->admin_model-> update_rotatingbanner($udata,$id);
        $transaction_details = $this->admin_model-> get_transaction_details_byid($userID);
            
        $userdata = array(
               'transaction' => 'Banner rejection',
               'userID' => $userID,
               'date' => date('Y-m-d'),
               'credits_nr' => $amount,
               'amount' => $amount,
               'company_name' => $userID,
               'username' => $transaction_details['username'],
               'description' => 'Banner rejection,User ID:'.$userID.',Banner ID:'.$banner_id,
               'reason' => $reason,
               'status' => 'Completed',
        );  
         
        $insert_transaction_details = $this->admin_model-> insert_transaction($userdata);
        if($insert_transaction_details){      
            
            $this->load->helper('email_helper');
            $this->gen_contents["mail_template"]  =  $this->web_model->get_mail_template(16);
            $message = 'Your banner submission is rejected due to the following reason: <br><br>'.$rason.'<br><br>We have refunded your credit of <b>'.$amount.'</b> to your account.';
            
            $mail_body  = sprintf($this->gen_contents["mail_template"]["mail_body"],$transaction_details['contact_name'],$message);
            $mail_to = $transaction_details['email'];

            $subject    = 'Rotating banner submission';
            $from_name  = $this->gen_contents["mail_template"]["mail_from_name"];
            $from_email = $this->gen_contents["mail_template"]["mail_from"];
            send_mail($mail_to, $from_name,$subject,$mail_body,$from_email);
            
            sf( 'success_message', "Rotating banner details rejected successfully" );
            redirect("admin/rotatingbannerreport");
        }
        else {
            sf( 'error_message', "Rotating banner details not rejected,Please try again" );
            redirect("admin/rotatingbannerreport");
        } 
    }
    
}
