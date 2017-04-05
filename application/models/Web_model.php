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
                ->order_by('display_order')
                ->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        } else {
            return '';
        }
    }

    public function get_categoryID_fromSlug($cat_slug=''){
        $query = $this->db->select("*")
                ->from("default_tour_categories")
                ->where('slug',$cat_slug)
                ->get();
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result['id'];
        } else {
            return '';
        }
    }

    public function get_category_emirates($cat_id){
        $qry = "SELECT * FROM default_emirate_tours et 
                LEFT JOIN default_emirates e ON e.id = et.emirates_id
                WHERE et.category_id = '$cat_id'
                GROUP BY et.emirates_id";
        $sel = $this->db->query($qry);
        $res = $sel->result_array($sel);
        if(!empty($res)){
            return $res;
        }
        else{
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

    public function get_cat_id($slug='')
    {
        $qry = "SELECT id FROM default_tour_categories WHERE slug = '$slug'";
        $sel = $this->db->query($qry);
        $res = $sel->row_array($sel);
        return $res['id'];
    }

    //get tours from emirates id
    public function get_tours_from_emirates($emirates_id,$cat_id){
        $qry = "SELECT * FROM default_emirate_tours et 
                LEFT JOIN default_tour t ON t.id = et.tour_id
                WHERE et.emirates_id = '$emirates_id' AND t.category_id = '$cat_id'";
 
        $sel = $this->db->query($qry);
        $res = $sel->result_array($sel);
        if(!empty($res)){
            return $res;
        }
        else{
            return '';
        }
    }
    public function get_default_tour_idE($emirates_id,$cat_id){
        $qry = "SELECT * FROM default_emirate_tours et 
                LEFT JOIN default_tour t ON t.id = et.tour_id
                WHERE et.emirates_id = '$emirates_id' AND t.category_id = '$cat_id'
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

    //function to get default tour id from category
    public function get_default_tour_emirates($emirates_id){
        $qry = "SELECT * FROM default_emirate_tours et 
                LEFT JOIN default_tour t ON t.id = et.tour_id
                WHERE et.emirates_id = '$emirates_id' AND t.category_id = '3' 
                ORDER BY et.id LIMIT 1";
        //echo $qry;
        $sel = $this->db->query($qry);
        $res = $sel->row_array($sel);
        if(!empty($res)){
            return $res['tour_id'];
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

    //get end location 
    public function get_end_location(){
        $query = $this->db->select("*")
                ->from("default_end_location")
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
    public function get_tour_gallery($cat_id='', $emirates_id='')
    {
        $query = $this->db->select("*")
                ->from("default_tour_gallery");
        if($cat_id != ''){
            $query = $query->where('category_id',$cat_id);
        }
        if($emirates_id != ''){
            $query = $query->where('emirates_id', $emirates_id);
        }
        $query = $query->get();
        $result = $query->result_array();
        return $result;
    }

    //get review function
    public function get_reviews($limit = '')
    {
        $qry = "SELECT *,DATE_FORMAT(FROM_UNIXTIME(timestamp), '%M %e, %Y') AS 'review_date' 
                FROM `default_reviews` WHERE 1 AND status = 'live'";
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

    //get_pickup_location
    public function get_pickup_location_name($id='')
    {
        $query = $this->db->select("location")
                ->from("default_pickup_location")
                ->where('id',$id)
                ->get();
        $result = $query->row_array();
        return $result['location'];
    }

    //get_pickup_location
    public function get_end_location_name($id='')
    {
        $query = $this->db->select("location")
                ->from("default_end_location")
                ->where('id',$id)
                ->get();
        $result = $query->row_array();
        return $result['location'];
    }

    public function get_category_name($cat_id = ''){
        $query = $this->db->select("title")
                    ->from("default_tour_categories")
                    ->where('id',$cat_id)
                    ->get();
        $result = $query->row_array();
        return $result['title'];
    }

    public function get_nationality($id='')
    {
        $query = $this->db->select("country_name")
                    ->from("default_isd_code")
                    ->where('country_id',$id)
                    ->get();
        $result = $query->row_array();
        return $result['country_name'];
    }

}