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





    //get key from lead match history(sell my copier)
//    public function get_key_from_SChistory($sellcopier_id,$user_id){
//        $qry = "SELECT `key` FROM cc_sellcopier_history WHERE sellcopier_id = '$sellcopier_id' AND userID = '$user_id'";
//        $sel = $this->db->query($qry);
//        $res = $sel->row_array($sel);
//        if(!empty($res)){
//            return $res['key'];
//        }
//        else{
//            return substr(md5(uniqid()), 0, 10);
//        }
//    }
}