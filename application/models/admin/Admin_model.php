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
    
}
