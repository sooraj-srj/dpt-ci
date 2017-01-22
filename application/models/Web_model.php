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
    public function get_tours($category){
        $qry = "SELECT t.*, tc.id, t.id as tour_id FROM `default_tour` t 
                LEFT JOIN default_tour_categories tc ON tc.slug = '".$category."' 
                WHERE t.`category_id` = tc.id
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



}