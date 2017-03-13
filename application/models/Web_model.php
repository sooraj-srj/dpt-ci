<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Web_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        ini_set("display_errors", "0");
        error_reporting(0);
    }

    //function to get settings values from slug
    public function get_settings($slug = ""){
        $where = array(
            "slug" => $slug
        );
        $query = $this->db->select("value")
                ->from("default_settings")
                ->where($where)
                ->get();
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result['value'];
        } else {
            return '';
        }        
    }
    
    //function to get tour categories
    public function get_categories(){
        $query = $this->db->select("*")
                ->from("default_tour_categories")
                ->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        } else {
            return '';
        }
    }
    
    //function to get tours from category
    public function get_tours($category = "",$limit = 6){
        if($category == 'popular'){
            $qry = "SELECT t.*, tc.id, t.id as tour_id, tc.slug as cat_slug FROM `default_tour` t 
                    LEFT JOIN default_tour_categories tc ON tc.id = t.category_id
                    WHERE t.`category_id` = tc.id ORDER BY RAND() LIMIT $limit";
        }
        else{
            $qry = "SELECT t.*, tc.id, t.id as tour_id FROM `default_tour` t 
                    LEFT JOIN default_tour_categories tc ON tc.slug = '".$category."' 
                    WHERE t.`category_id` = tc.id
                    ORDER BY t.ordering_count";
        }
        
        $sel = $this->db->query($qry);
        $res = $sel->result_array($sel);
        if(!empty($res)){
            return $res;
        }
        else{
            return '';
        }
        
    }
    
    //function to get default tour id from category
    public function get_default_tour_id($category){
        $qry = "SELECT t.id FROM `default_tour` t 
                LEFT JOIN default_tour_categories tc ON tc.slug = '".$category."' 
                WHERE t.`category_id` = tc.id
                ORDER BY t.ordering_count LIMIT 1";
        $sel = $this->db->query($qry);
        $res = $sel->row_array($sel);
        if(!empty($res)){
            return $res['id'];
        }
        else{
            return '';
        }
        
    }
    
    //function to get tour details
    public function get_tour_details($tour_id){
        $query = $this->db->select("*")
                ->from("default_tour")
                ->where('id',$tour_id)
                ->get();
        $result = $query->row_array();
        //p($result);
        return $result;
    }
    
    //get pickup location 
    public function get_pickup_location(){
        $query = $this->db->select("*")
                ->from("default_pickup_location")
                ->get();
        $result = $query->result_array();
        return $result;
    }
    
    //get nationalities
    public function get_nationalities(){
        $query = $this->db->select("*")
                ->from("default_nationality")
                ->get();
        $result = $query->result_array();
        return $result;
    }
    
    //get isd codes
    public function get_isd_code(){
        $query = $this->db->select("*")
                ->from("default_isd_code")
                ->get();
        $result = $query->result_array();
        return $result;
    }

    //process tour booking
    public function process_tour_booking($post_data = array()){
        if($this->db->insert('default_booking',$post_data)){
            return 'success';
        }
        else{
            return 'error';
        }
    }
    
    //visa application
    public function process_visa_application($post_data = array()){
        if($this->db->insert('default_visa_booking',$post_data)){
            return 'success';
        }
        else{
            return 'error';
        }
    }

    // process ask qn appln
    public function process_ask_question($post_data = array())
    {
        if($this->db->insert('default_ask_questions',$post_data)){
            return 'success';
        }
        else{
            return 'error';
        }
    }

    // process review appln
    public function process_review_appln($post_data = array())
    {
        if($this->db->insert('default_reviews',$post_data)){
            return 'success';
        }
        else{
            return 'error';
        }
    }

    //function to get tour gallery
    public function get_tour_gallery($tour_id='')
    {
        $query = $this->db->select("*")
                ->from("default_tour_gallery")
                ->get();
        $result = $query->result_array();
        return $result;
    }

    //get review function
    public function get_reviews($limit = '')
    {
        $qry = "SELECT *,DATE_FORMAT(FROM_UNIXTIME(timestamp), '%M %e, %Y') AS 'review_date' 
                FROM `default_reviews` WHERE 1 ";
        $qry .= "ORDER BY timestamp DESC";
        if($limit != ''){
            $qry .= " LIMIT $limit";
        }
        $sel = $this->db->query($qry);
        $res = $sel->result_array($sel);
        if(!empty($res)){
            return $res;
        }
        else{
            return '';
        }
    }

    // contact appln
    public function process_contact_appln($post_data = array())
    {
        if($this->db->insert('default_contact_log',$post_data)){
            return 'success';
        }
        else{
            return 'error';
        }
    }

    //function to get email templates
    public function get_mail_template($value = '')
    {
        $query = $this->db->select("*")
                ->from("default_email_templates")
                ->get();
        $result = $query->result_array();
        return $result;
    }

    //get tour name
    public function get_tourname($tour_id='')
    {
        $query = $this->db->select("title")
                ->from("default_tour")
                ->where('id',$tour_id)
                ->get();
        $result = $query->row_array();
        return $result['title'];
    }

    //get email template for booking
    public function getEmailTemplate()
    {
        
        $booking_mail = '<!DOCTYPE html>
            <html>
            <head>
            <title>Booking</title>
            </head>
            <body>
            Hi, {{user_name}}
            <br><br>
            {{message}}. We will review youe booking and will contact you by email.
            <br><br><br>
            Thanks
            <br>
            Dubai Private Tours<br>
            <a href="http://dubaiprivatetours.com">http://dubaiprivatetours.com</a>
            </body>
            </html>';
        return $booking_mail;
    }


}