<?php

class Admin_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        ini_set("display_errors", "0");
        error_reporting(0);
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
    //function to get tour category details
    public function get_category($cat_id){
        $query = $this->db->select("*")
                ->where("id",$cat_id)
                ->from("default_tour_categories")
                ->get();
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result;
        } else {
            return '';
        }
    }
    
    // process category - add/edit/delete
    public function process_category($mode,$catdata){
        $catname    = $catdata['title'];
        $catid      = $catdata['catid'];
        $cdata = array(
            "title" => $catname,
            "slug"  => $catdata['slug'],
            "header_image" => $catdata['header_image']
        );
        
        if($mode == "add"){
            $this->db->select("*");
            $this->db->from("default_tour_categories");
            $this->db->where("title",$catname);
            $query = $this->db->get();
            if($query->num_rows() == 0){
                $this->db->insert("default_tour_categories",$cdata);
                return "added";
            }
            else {
                return "exists";
            }
        }
        if($mode == "edit"){          
            $this->db->select("*");
            $this->db->from("default_tour_categories");
            $this->db->where("id",$catid);
            $query = $this->db->get();  
            if($query->num_rows() == 1){
                $this->db->where("id",$catid);
                $this->db->update("default_tour_categories",$cdata);
                return "edited";
            }
        }
        if($mode == "delete"){            
            $this->db->where("id",$catid);
            $this->db->delete("default_tour_categories");
            return "deleted";
        }
    }
    
    //function to get emirates
    public function get_emirates(){
        $query = $this->db->select("*")
                ->from("default_emirates")
                ->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        } else {
            return '';
        }
    }
    //function to get tour category details
    public function get_emirates_data($eid){
        $query = $this->db->select("*")
                ->where("id",$eid)
                ->from("default_emirates")
                ->get();
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result;
        } else {
            return '';
        }
    }
    
    // process category - add/edit/delete
    public function process_emirates($mode,$edata){
        $name    = $edata['name'];
        $eid     = $edata['id'];
        
        if($mode == "add"){
            $this->db->select("*");
            $this->db->from("default_emirates");
            $this->db->where("name",$name);
            $query = $this->db->get();
            if($query->num_rows() == 0){
                $this->db->insert("default_emirates",$edata);
                return "added";
            }
            else {
                return "exists";
            }
        }
        if($mode == "edit"){          
            $this->db->select("*");
            $this->db->from("default_emirates");
            $this->db->where("id",$eid);
            $query = $this->db->get();  
            if($query->num_rows() == 1){
                $this->db->where("id",$eid);
                $this->db->update("default_emirates",$edata);
                return "edited";
            }
        }
        if($mode == "delete"){            
            $this->db->where("id",$eid);
            $this->db->delete("default_emirates");
            return "deleted";
        }
    }

    //function to get tours from category
    public function get_tours($tour_id = ""){
        
        $qry = "SELECT t.*, tc.id, t.id as tour_id, tc.title as category, e.name as emirates FROM `default_tour` t 
                LEFT JOIN default_tour_categories tc ON tc.id = t.category_id 
                LEFT JOIN default_emirates e ON e.id = t.emirates_id                 
                ORDER BY t.ordering_count";
        
        $sel = $this->db->query($qry);
        $res = $sel->result_array($sel);
        if(!empty($res)){
            return $res;
        }
        else{
            return '';
        }
        
    }

    // process tours - add/edit/delete
    public function process_tours($mode,$post_data){
        
        if($mode == "add"){
            $this->db->insert("default_tour",$post_data);
            return "added";
        }
        if($mode == "edit"){     
            $tid = $post_data['id'];     
            $this->db->where("id",$tid);
            $this->db->update("default_tour",$post_data);
            return "edited";
        }
        if($mode == "delete"){    
            $tid = $post_data['id'];      
            $this->db->where("id",$tid);
            $this->db->delete("default_tour");
            return "deleted";
        }
    }

    //get tour booking list
    public function get_tour_bookings($params='')
    {
        $qry = "SELECT b.*,t.*,tc.title as category,e.name as emirates, b.status as booking_status, b.id as booking_id,
                DATE_FORMAT(FROM_UNIXTIME(b.timestamp), '%d/%b/%Y') booking_date, 
                DATE_FORMAT(b.tour_date, '%d/%b/%Y') tour_date,
                CONCAT(b.firstName,' ',b.lastName) as user_name
                FROM `default_booking` b
                LEFT JOIN default_tour t ON b.tour_id = t.id
                LEFT JOIN default_tour_categories tc ON tc.id = t.category_id 
                LEFT JOIN default_emirates e ON e.id = t.emirates_id 
                ORDER BY b.`id`  DESC";
        
        $sel = $this->db->query($qry);
        $res = $sel->result_array($sel);
        if(!empty($res)){
            return $res;
        }
        else{
            return '';
        }
    }
    
    // get tour booking details
    public function get_tour_booking_details($booking_id='')
    {
        $qry = "SELECT b.*,t.*,tc.title as category,e.name as emirates, b.status as booking_status, b.id as booking_id, ic.country_name, 
                pl.location as pickup_location, pl1.location as drop_location,
                DATE_FORMAT(FROM_UNIXTIME(b.timestamp), '%d/%b/%Y') booking_date, 
                DATE_FORMAT(b.tour_date, '%d/%b/%Y') tour_date,
                CONCAT(b.firstName,' ',b.lastName) as user_name
                FROM `default_booking` b
                LEFT JOIN default_tour t ON b.tour_id = t.id
                LEFT JOIN default_tour_categories tc ON tc.id = t.category_id 
                LEFT JOIN default_emirates e ON e.id = t.emirates_id 
                LEFT JOIN default_isd_code ic ON ic.country_id = b.nationality 
                LEFT JOIN default_pickup_location pl ON pl.id = b.pickup_location 
                LEFT JOIN default_pickup_location pl1 ON pl1.id = b.dropLocation
                WHERE b.id = '$booking_id'
                ORDER BY b.`id`  DESC";
        
        $sel = $this->db->query($qry);
        $res = $sel->result_array($sel);
        if(!empty($res)){
            return $res;
        }
        else{
            return '';
        }
    }

    public function update_booking_status($booking_id='', $action='')
    {
        $data['status'] = $action;
        $this->db->where("id",$booking_id);
        $this->db->update("default_booking",$data);
        return "success";
    }

    //get email template data
    public function get_email_template($template='')
    {
        $qry = "SELECT * FROM default_email_templates WHERE slug = '$template'";
        $sel = $this->db->query($qry);
        $res = $sel->row_array($sel);
        if(!empty($res)){
            return $res;
        }
        else{
            return '';
        }
    }
    //update email template
    public function process_email_template($post_data='')
    {
        $this->db->where("slug",'booking-mail');
        $this->db->update("default_email_templates",$post_data);
        return "edited";
    }

    //get gallery list
    public function get_galleries()
    {
        $query = $this->db->select("*")
                ->from("default_gallery")
                ->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        } else {
            return '';
        }
    }

    //get gallery data
     public function get_gallery_data($id)
    {
        $query = $this->db->select("*")
                ->where('id',$id)
                ->from("default_gallery")
                ->get();
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result;
        } else {
            return '';
        }
    }

    // process gallery - add/edit/delete
    public function process_gallery($mode,$post_data){
        
        if($mode == "add"){
            $this->db->insert("default_gallery",$post_data);
            return "added";
        }
        if($mode == "edit"){     
            $tid = $post_data['id'];     
            $this->db->where("id",$tid);
            $this->db->update("default_gallery",$post_data);
            return "edited";
        }
        if($mode == "delete"){    
            $tid = $post_data['id'];      
            $this->db->where("id",$tid);
            $this->db->delete("default_gallery");
            return "deleted";
        }
    }

    //get gallery images
    public function get_gallery_images($id='')
    {
        if($id == ''){
            $query = $this->db->select("*")
                ->from("default_gallery_sub_images")
                ->get();
        }
        else{
            $query = $this->db->select("*")
                ->from("default_gallery_sub_images")
                ->where('resource_id',$id)
                ->get();
        }
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        } else {
            return '';
        }
    }

    //insert gallery images
    
    public function update_gallery_image($post_data){
        $this->db->insert("default_gallery_sub_images",$post_data);
    }

}
