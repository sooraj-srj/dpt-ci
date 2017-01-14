<?php

class Admin_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        ini_set("display_errors", "0");
        error_reporting(0);
    }
    
    // get product categories function
    public function get_categories($type = "list"){
        $this->db->select("*");
        $this->db->from('product_categories');
        $this->db->where(array('parent_id' => 0,'status' => 'A'));
        $this->db->order_by("cat_name");
        $query = $this->db->get();
        if($type == 'list'){
            return $query->result_array();
        } else {
            return $query->num_rows();
        }
    }
    
    // process category - add/edit/delete
    public function process_category($mode,$catdata){
        $catname    = $catdata['catname'];
        $catid      = $catdata['catid'];
        $cdata = array(
          "cat_name" => $catname
        );
        
        if($mode == "add"){
            $this->db->select("*");
            $this->db->from("product_categories");
            $this->db->where("cat_name",$catname);
            $this->db->where("status","A");
            $query = $this->db->get();
            if($query->num_rows() == 0){
                $this->db->insert("product_categories",$cdata);
                return "added";
            }
            else {
                return "exists";
            }
        }
        if($mode == "edit"){          
            $this->db->select("*");
            $this->db->from("product_categories");
            $this->db->where("cat_id",$catid);
            $query = $this->db->get();  
            if($query->num_rows() == 1){
                $this->db->where("cat_id",$catid);
                $this->db->update("product_categories",$cdata);
                return "edited";
            }
        }
        if($mode == "delete"){
            $cdata_del = array(
                "status"    => "D"
            );
            $this->db->where("cat_id",$catid);
            $this->db->update("product_categories",$cdata_del);
            return "deleted";
        }
    }

    // function to get category name 
    public function get_catname($catid){
        $this->db->select("cat_name");
        $this->db->from("product_categories");
        $this->db->where("cat_id",$catid);
        $query = $this->db->get();
        $res = $query->result_array();
        return $res[0]["cat_name"];
    }
    
    // function to get packages
    public function get_packages($type = "list", $pack_id="",$limit = 25, $start = 0) {
        $this->db->select("*");
        $this->db->from('packages');
        if(!empty($pack_id)){
            $where = array(
                'status'    => 'A',
                'packageID' => $pack_id
            );
        }
        else{
            $where = array(
                //'status'    => 'A'
            );
        }
        $this->db->where($where);
        $this->db->order_by("description");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if($type == 'list'){
            return $query->result_array();
        } else {
            return $query->num_rows();
        }
    }
    
    
    // function to add/edit/delete packages
    public function process_package($mode, $packdata){
        $pack_name  = $packdata['description'];
        $pack_id    = $packdata['packageID'];
        if($mode == "add"){
            $this->db->select("*");
            $this->db->from("packages");
            $this->db->where("description",$pack_name);
            $this->db->where("status",'A');
            $query = $this->db->get();
            if($query->num_rows() == 0){
                $this->db->insert("packages",$packdata);
                return "added";
            }
            else {
                return "exists";
            }
        }
        if($mode == "edit"){
            $this->db->where("packageID",$pack_id);
            $this->db->update("packages",$packdata);
            return "edited";
        }
        if($mode == "delete"){
            $pdata_del = array(
                "status"    => "D"
            );
            $this->db->where("packageID",$pack_id);
            $this->db->update("packages",$pdata_del);
            return "deleted";
        }
    }
    
    // function to get makers
    public function get_makers($type = "list", $maker_id="") {
        $this->db->select("*");
        $this->db->from('makers m');
        $this->db->join("product_categories pc", "pc.cat_id = m.cat_id", "left");
        if(!empty($maker_id)){
            $where = array(
                'm.status'    => 'A',
                'm.makerID' => $maker_id
            );
        }
        else{
            $where = array(
                'm.status'    => 'A'
            );
        }
        $this->db->where($where);
        $this->db->order_by("m.maker");
        $query = $this->db->get();
        if($type == 'list'){
            return $query->result_array();
        } else {
            return $query->num_rows();
        }
    }
    
    // function to add/edit/delete makers
    public function process_makers($mode, $makerdata){
        $maker      = $makerdata['maker'];
        $maker_id   = $makerdata['makerID'];
        $cat_id     = $makerdata['cat_id'];
        if($mode == "add"){
            $where = array(
                'maker'     => $maker,
                'cat_id'    => $cat_id
            );
            $this->db->select("*");
            $this->db->from("makers");
            $this->db->where($where);
            $query = $this->db->get();
            if($query->num_rows() == 0){
                $this->db->insert("makers",$makerdata);
                return "added";
            }
            else {
                return "exists";
            }
        }
        if($mode == "edit"){
            $this->db->where("makerID",$maker_id);
            $this->db->update("makers",$makerdata);
            return "edited";
        }
        if($mode == "delete"){
            $mdata_del = array(
                "status"    => "D"
            );
            $this->db->where("makerID",$maker_id);
            $this->db->update("makers",$mdata_del);
            return "deleted";
        }
    }
    
    //function to get users(sellers)
    public function get_users($limit, $start,$contact_name_search = '',$city_suburb_search = '',$status_search = '',$email_search = '',$company_search = '',$postcode_search = '',$user_id = 0){
        $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE); 
        $this->db->from('users');
        if($contact_name_search != ''){
            $this->db->like('contact_name',$contact_name_search);
        }
        if($city_suburb_search != ''){
            $this->db->like('city',$city_suburb_search);
        }
        if($status_search != ''){
            $this->db->where('status',$status_search);
        }
        if($email_search != ''){
            $this->db->like('email',$email_search);
        }
        if($company_search != ''){
            $this->db->like('company_name',$company_search);
        }
        if($postcode_search != ''){
            $this->db->like('postcode',$postcode_search);
        }
        
        if($user_id != 0){
            $this->db->where('userID',$user_id);
        }
        
        $this->db->order_by("userID","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();          
        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    public function get_user_option_details () {
        $query = $this->db->get('user_options');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    public function get_user_profile_status($limit, $start,$contact_name_search = '',$email_search = '',$status_search = '',$user_optn = ''){
        $this->db->select("SQL_CALC_FOUND_ROWS u.*",FALSE);
        
        if($contact_name_search != ''){
            $this->db->like('u.contact_name',$contact_name_search);
        }
        if($email_search != ''){
            $this->db->like('u.email',$email_search);
        }
        if($status_search != ''){
            if($status_search == 'updated'){
                $this->db->from('users u');
                $this->db->join('user_options p', 'p.userID = u.userID', 'inner');
            }
            else {
                $this->db->from('users u');
                $this->db->where_not_in('u.userID', $user_optn);
            }
        }
        else {
            $this->db->from('users u');
        }
        $this->db->order_by("userID","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();           
        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    //function to get leads list
    public function get_leads($limit, $start,$leadname = '',$leadname_email = '',$starlevel_search = '',$city_suburb_search = '',$status_search = '',$fromdate_search = '',$todate_search = ''){
        $this->db->select("SQL_CALC_FOUND_ROWS l.*,p.source",FALSE);
        $this->db->from('leads_details l');
        $this->db->join('cc_promotions p', 'p.id = l.promo_id', 'left');
        $this->db->where("star_level !=", "0");
        if($leadname != ''){
            $this->db->like('l.first_name',$leadname);
            $this->db->or_like('l.last_name',$leadname);
            $this->db->or_like('l.lead_id',$leadname);
        }
        if($leadname_email != ''){
            $this->db->like('l.email',$leadname_email);
        }
        if($starlevel_search != ''){
            $this->db->where('l.star_level',$starlevel_search);
        }
        if($city_suburb_search != ''){
            $this->db->like('l.city_suburb',$city_suburb_search);
        }
        if($status_search != ''){
            $this->db->where('l.submission_status',$status_search);
        }
        if($fromdate_search != '') 
            $this->db->where('l.date_time >=', $fromdate_search);
        if($todate_search != '') 
            $this->db->where('l.date_time <=', $todate_search);
        
        $this->db->order_by("l.date_time","DESC");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    public function get_postcodelist($limit, $start,$state_search = '',$mainregion_search = '',$subregion_search = '',$city_suburb_search = '',$postcode_search = ''){
        $this->db->select("SQL_CALC_FOUND_ROWS c.*,st.state,m.mregion,s.sregion",FALSE);
        $this->db->from('cities c');
        $this->db->join('states st', 'st.stateID = c.stateID', 'left');
        $this->db->join('major_regions m', 'm.mregionID = c.mregionID', 'left');
        $this->db->join('sub_regions s', 's.sregionID = c.sregionID', 'left');
        
        if($state_search != ''){
            $this->db->like('st.state',$state_search);
        }
        if($mainregion_search != ''){
            $this->db->like('m.mregion',$mainregion_search);
        }
        if($subregion_search != ''){
            $this->db->like('s.sregion',$subregion_search);
        }
        if($city_suburb_search != ''){
            $this->db->like('c.city',$city_suburb_search);
        }
        if($postcode_search != ''){
            $this->db->like('c.postcode',$postcode_search);
        }
        
        $this->db->order_by("c.cityID","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    
    public function get_buyerguide_report($limit, $start,$name_search = '',$email_search = '',$status_search = '',$suburb_search = ''){
        $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE);
        $this->db->from('buyerguid_userdata');
        if($name_search != ''){
            $this->db->like('fname',$name_search);
            $this->db->or_like('lname',$name_search);
        }
        if($email_search != '')
            $this->db->like('email',$email_search);
        if($suburb_search != '')
            $this->db->like('suburb_postcode',$suburb_search);
        if($status_search != '')
            $this->db->where('download_status',$status_search);
        
        $this->db->order_by("id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();           
        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    //funtion to get total rows
    public function get_total_rows(){
        $query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
        return $query->row()->Count;
    }
    
    //function to update timestamp to date time in new field (submit_date) - 
    //to avoide mismatching of date time format of Submission_Date - varchar(255)
    function update_submit_date(){
        $query = $this->db->query("SELECT Submission_Date, Timestamp, ID FROM leads WHERE 1");
        foreach ($query->result() as $row){
            $timestamp = $row->Timestamp;
            $datetime = timestamp_to_datetime($timestamp, 'Y-m-d H:i:s');
            $qry = 'UPDATE leads SET submit_date = DATE_ADD("'.$datetime.'",INTERVAL 330 MINUTE) WHERE ID = '.$row->ID; 
            $this->db->query($qry);
            //echo '<br>'.$qry;
        }
    }
    
    function get_more_details($id = 0,$tbl_name = ''){
        if($tbl_name == 'leadmatch_history')
            $this->db->select("l.*,u.contact_name,u.email,");
        else if($tbl_name == 'leadmatch_history_payment')
            $this->db->select("l.*,u.contact_name,u.email,");
        else  if($tbl_name == 'pre_registration') 
            $this->db->select("p.*,i.industry_name");
        else
            $this->db->select("*");
        if($tbl_name == 'leads_details') {
            $this->db->from('leads_details');
            $where = array(
                'lead_id' => $id
            );
        }
        else  if($tbl_name == 'cc_sellcopier') {
            $this->db->from('cc_sellcopier');
            $where = array(
                'id' => $id
            );
        }
        else  if($tbl_name == 'pre_registration') {
            $this->db->from('pre_registration p');
             $this->db->join("ls_industries i", "i.id = p.industry", "left");
            $where = array(
                'pre_registration_id' => $id
            );
        }
        else  if($tbl_name == 'leadmatch_history') {
            $this->db->from('leadmatch_history l');
            $this->db->join("users u", "u.userID = l.userID", "left");
            $where = array(
                'lead_id' => $id
            );
        }
        else  if($tbl_name == 'leadmatch_history_payment') {
            $this->db->from('leadmatch_history l');
            $this->db->join("users u", "u.userID = l.userID", "left");
            $where = array(
                'lead_id' => $id,
                'payment_status' => '1'
            );
        }
        else {
            $this->db->from('users');
            $where = array(
                'userID' => $id
            );
        }
        
        $this->db->where($where);
        $query = $this->db->get();   
        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    function get_webcontents_details ($controller = ''){
        $this->db->select("*");
        $this->db->from('cc_web_contents');
        $this->db->where('controller',$controller);
        $query = $this->db->get();
        if($query->num_rows() >0)
            return $query->row_array();
        else
            return false;
        
    }
    
    function get_lead_coveragearea_details (){
        $this->db->select("*");
        $this->db->from('ls_leads_coverage_area_popup');
        $query = $this->db->get();
        if($query->num_rows() >0)
            return $query->row_array();
        else
            return false;
        
    }
    
    function update_webcontents($userdata = array(),$condition = '',$controller = ''){
        
        $this->db->where('id',$condition);
        $this->db->where('controller',$controller);
        $this->db->update('cc_web_contents',$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    } 
    
    public function update_leadcoveragearea ($userdata = array(),$condition = 0) {
        $this->db->where('id',$condition);
        $this->db->update('ls_leads_coverage_area_popup',$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }


    // Get question and answer list for a particular lead 
    function get_questionanswerlist($id = 0){
        $this->db->select('r.*,q.question');
        $this->db->from('leads_response r');
        $this->db->join('lead_questions q', 'q.question_id = r.question_id', 'left');
   
        $this->db->where('lead_id',$id);
        $this->db->order_by("r.lead_id");
        $query = $this->db->get();          
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_webpage_list($limit, $start,$html_name_search = '',$title_search = '',$status_search = '') {
        $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE); 
        if($html_name_search != ''){
            $this->db->like('link_name',$html_name_search);
        }
        if($title_search != ''){
            $this->db->like('title',$title_search);
        }
        if($status_search != ''){
            $this->db->where('status',$status_search);
        }
        $this->db->from('cc_web_pages');
        $this->db->order_by("pageid","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_leadpagecontent_list($limit, $start) {
        $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE); 
        
        $this->db->where('status','1');
        $this->db->from('ls_page_contents');
        $this->db->order_by("id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_landingpages_list($limit, $start) {
        $this->db->select('*');
        $this->db->from('cc_landing_pages');
        $this->db->where("status !=","Default");
        $this->db->where("status","Active");
        $this->db->order_by("pageid","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_default_landingpage_values ($status) {
        $this->db->select('*');
        $this->db->from('cc_landing_pages');
        $this->db->where("status",$status);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }

        public function get_webpage_list_lead2sale($limit, $start,$html_name_search = '',$title_search = '',$status_search = '') {
        $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE); 
        if($html_name_search != ''){
            $this->db->like('link_name',$html_name_search);
        }
        if($title_search != ''){
            $this->db->like('title',$title_search);
        }
        if($status_search != ''){
            $this->db->where('status',$status_search);
        }
        $this->db->from('ls_web_pages');
        $this->db->order_by("pageid","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function insert_webpages($userdata,$tbl_name) {
        $this->db->insert($tbl_name,$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }

    public function get_webpade_details($id = 0,$tbl_name = '') {
        $this->db->select('*');
        $this->db->where("pageid", $id);
        $this->db->from($tbl_name);
        $query = $this->db->get();
        if($query->num_rows() >0)
            return $query->row_array();
        else 
            return false;
    }
    
    public function get_pagecontent_details($id = 0) {
        $this->db->select('*');
        $this->db->where("id", $id);
        $this->db->from('ls_page_contents');
        $query = $this->db->get();
        if($query->num_rows() >0)
            return $query->row_array();
        else 
            return false;
    }
    
    public function update_webpages($userdata = array(),$pageid = 0,$table_name = '') {
        $this->db->where("pageid", $pageid);
        $this->db->update($table_name,$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return true;
    }
    
    public function update_pagecontents($userdata = array(),$pageid = 0) {
        $this->db->where("id", $pageid);
        $this->db->update('ls_page_contents',$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function remove_webpage($pageid = 0) {
        $this->db->where("pageid", $pageid);
        $this->db->delete('cc_web_pages');
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function remove_webpage_leads($pageid = 0) {
        $this->db->where("pageid", $pageid);
        $this->db->delete('ls_web_pages');
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function get_previewlist($id = 0,$type = '') {
        $this->db->select("*");
        $this->db->where("pageid",$id);
        if($type == 'copierchoice')
            $this->db->from("cc_web_pages");
        else if($type == 'landingpage')
             $this->db->from("cc_landing_pages");
        else 
            $this->db->from("ls_web_pages");
        $query = $this->db->get();           // echo $this->db->last_query();
        if($query->num_rows() > 0)
            return $query->row_array();
        else
            return false;
    }
    
 
    public function get_enquiries_list($limit, $start,$name_search = '',$fromdate_search = '',$todate_search = '') {
        $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE); 
        $this->db->from('cc_enquiries');
        if($name_search != ''){
            $this->db->like('name',$name_search);
        }
        if($fromdate_search != '') 
            $this->db->where('date_time >=', $fromdate_search);
        if($todate_search != '') 
            $this->db->where('date_time <=', $todate_search);
        $this->db->where("email !=", '');
        $this->db->order_by("id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();           
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_enquiries_list_leadsales($limit, $start,$name_search = '',$fromdate_search = '',$todate_search = '') {
        $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE); 
        $this->db->from('ls_enquiries');
        if($name_search != ''){
            $this->db->like('name',$name_search);
        }
        if($fromdate_search != '') 
            $this->db->where('date_time >=', $fromdate_search);
        if($todate_search != '') 
            $this->db->where('date_time <=', $todate_search);
        $this->db->where('email !=', '');
        $this->db->order_by("id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();           
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_profile_details($id = 0){
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->from('administrators');
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    
    public function get_total_records($tblname = ''){
        $count = $this->db->count_all($tblname);
        return $count;
    }

    public function get_supplierrequests_list($limit, $start,$name_search = '',$fromdate_search ='',$todate_search ='') {
        $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE); 
        $this->db->from('cc_suppliers');
        if($name_search != ''){
            $this->db->like('fname',$name_search);
            $this->db->or_like('lname',$name_search);
        }
        if($fromdate_search != '') 
            $this->db->where('date_time >=', $fromdate_search);
        if($todate_search != '') 
            $this->db->where('date_time <=', $todate_search);
        $this->db->order_by("id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_sellcopoerlist_list($limit, $start,$name_search = '',$city_suburb_search = '',$email_search = '',$fromdate_search = '',$todate_search = '') {
        $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE); 
        $this->db->from('cc_sellcopier');
        if($name_search != ''){
            $this->db->like('name',$name_search);
        }
        if($city_suburb_search != ''){
            $this->db->like('suburb',$city_suburb_search);
        }
        if($email_search != ''){
            $this->db->like('email',$email_search);
        }
         if($fromdate_search != '') 
            $this->db->where('date_time >=', $fromdate_search);
        if($todate_search != '') 
            $this->db->where('date_time <=', $todate_search);
        $this->db->order_by("id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_preregistration_list($limit, $start,$name_search = '',$email = '',$city_suburb_search = '',$industry_search = '') {
        $this->db->select("SQL_CALC_FOUND_ROWS p.*,i.industry_name",FALSE);  
        $this->db->from('pre_registration p');
        $this->db->join('ls_industries i', 'i.id = p.industry', 'left');
        
        
        if($name_search != ''){
            $this->db->like('p.first_name',$name_search);
            $this->db->or_like('p.last_name',$name_search);
        }
        if($email != ''){
            $this->db->like('p.email',$email);
        }
        if($city_suburb_search != ''){
            $this->db->like('p.city_suburb',$city_suburb_search);
        }
        if($industry_search != ''){
            $this->db->like('i.industry_name',$industry_search);
        }
        $this->db->order_by("p.pre_registration_id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();        // echo $this->db->last_query(); exit;
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_transaction_list($limit, $start , $search_term = '',$status_search = '' ,$fromdate_search = '' ,$todate_search = '',$amount_search = '',$supplier_id_search = '') {
        $this->db->select("SQL_CALC_FOUND_ROWS t.*,u.contact_name,u.userID",FALSE); 
        $this->db->from('transactions t');
        $this->db->join('users u', 'u.userID = t.userID', 'left');
        if($search_term != '') {
            $this->db->like('u.contact_name',$search_term);
            $this->db->or_like('u.userID',$search_term);
        }
        if($status_search != '') 
            $this->db->like('t.status',$status_search);
        if($fromdate_search != '') 
            $this->db->where('t.date >=', $fromdate_search);
        if($todate_search != '') 
        $this->db->where('t.date <=', $todate_search);
        if($amount_search != '') 
            $this->db->where('t.amount',$amount_search);
        if($supplier_id_search != '') 
            $this->db->where('u.userID',$supplier_id_search);
        
        $this->db->order_by("transactionID","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();     //echo $this->db->last_query();
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_credithistory_list($limit, $start , $search_term = '',$status_search = '' ,$fromdate_search = '' ,$todate_search = '',$amount_search = '',$supplier_id_search = '') {
        $this->db->select("SQL_CALC_FOUND_ROWS t.*,u.contact_name,u.userID,u.company_name",FALSE); 
        $this->db->from('transactions t');
        $this->db->join('users u', 'u.userID = t.userID', 'left');
        if($search_term != '') {
            $this->db->like('u.contact_name',$search_term);
            $this->db->or_like('u.userID',$search_term);
        }
        if($status_search != '') 
            $this->db->like('t.status',$status_search);
        if($fromdate_search != '') 
            $this->db->where('t.date >=', $fromdate_search);
        if($todate_search != '') 
        $this->db->where('t.date <=', $todate_search);
        if($amount_search != '') 
            $this->db->where('t.amount',$amount_search);
        if($supplier_id_search != '') 
            $this->db->where('u.userID',$supplier_id_search);
        
        
        $this->db->where('t.transaction','Purchase');
        
        $this->db->order_by("transactionID","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();     //echo $this->db->last_query();
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_leadmatch_list($limit, $start,$supplier_search,$fromdate_search,$todate_search) {
        
        $condition = '';
        //if($fromdate_search != '' && $todate_search != '') 
            //$condition .= "and lh.date_time BETWEEN ".$fromdate_search."AND".$todate_search;
        //if($fromdate_search != '') {
            //$fromdate_value = $fromdate_search.' 00:00:00'; 
            //$condition .= "and ld.date_time >= ".$fromdate_value; 
        //
        //if($todate_search != '') 
            //$this->db->where('l.date_time <=', $todate_search);
            //$condition .= 'and lh.date_time <= '.$todate_search;
        
        $query = $this->db->query("SELECT SQL_CALC_FOUND_ROWS ld .* , IFNULL( lh.lm_count, 0 ) match_count, IFNULL( lh1.pur_count, 0 ) purchase_count
                                    FROM leads_details ld
                                    LEFT JOIN (
                                        SELECT COUNT( * ) lm_count, lead_id,date_time
                                        FROM leadmatch_history
                                        GROUP BY lead_id
                                    )lh ON ( ld.lead_id = lh.lead_id ) 
                                    LEFT JOIN (
                                        SELECT COUNT( * ) pur_count, lead_id,date_time
                                        FROM leadmatch_history
                                        WHERE payment_status =1
                                        GROUP BY lead_id
                                    )lh1 ON ( ld.lead_id = lh1.lead_id ) 
                                    WHERE lh.lm_count >0 ".$condition." order by date_time desc
                                    LIMIT ".$limit, $start);
         //echo $this->db->last_query();
        //$query = $this->db->get();        echo $this->db->last_query();exit;
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_leadmatch_lists($limit, $start,$supplier_search,$fromdate_search,$todate_search) {
        $this->db->select("SQL_CALC_FOUND_ROWS d.*,u.contact_name,count(l.lead_id) as supplier_count,count(l.payment_status) as purchased_supplier_count,l.status",FALSE); 
        $this->db->from('leads_details d');
        $this->db->join('leadmatch_history l', 'l.lead_id = d.lead_id', 'left');
        $this->db->join('users u', 'u.userID = l.userID', 'left');
        
        
        if($supplier_search != ''){
            $this->db->where('u.contact_name',$supplier_search);
        }
        if($fromdate_search != '') 
            $this->db->where('l.date_time >=', $fromdate_search);
        if($todate_search != '') 
            $this->db->where('l.date_time <=', $todate_search);
        
        $this->db->group_by("l.lead_id");
        $this->db->order_by("l.lead_id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();        echo $this->db->last_query();exit;
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_refund_list($limit, $start,$seller_search = '',$starlevel_search = '',$status_search = '',$fromdate_search = '',$todate_search ='',$leadid_search = '') {
        $this->db->select("SQL_CALC_FOUND_ROWS l.*,u.contact_name,d.first_name,d.last_name,d.lead_price",FALSE); 
        $this->db->from('lead_feedback l');
        $this->db->join('users u', 'u.userID = l.userID', 'left');
        $this->db->join('leads_details d', 'd.lead_id = l.lead_id', 'left');
        //$this->db->where("status",'1');
        
        if($seller_search != ''){
            $this->db->like('u.contact_name',$seller_search);
        }
        if($starlevel_search != ''){
            $this->db->where('l.star_rating',$starlevel_search);
        }
        if($leadid_search != ''){
            $this->db->where('l.lead_id',$leadid_search);
        }
        if($status_search != ''){
            $this->db->where('l.refund_approved',$status_search);
        }
        if($fromdate_search != '') 
            $this->db->where('l.created_date >=', $fromdate_search);
        if($todate_search != '') 
            $this->db->where('l.created_date <=', $todate_search);
        
        $this->db->where('l.refund_approved','0');
        $this->db->where('l.refund','1');
        $this->db->order_by("lead_feedback_id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();               
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_feedback_list($limit, $start,$seller_search = '',$starlevel_search = '',$status_search = '',$fromdate_search = '',$todate_search ='',$leadid_search = '') {
        $this->db->select("SQL_CALC_FOUND_ROWS l.*,u.contact_name,d.first_name,d.last_name,d.lead_price",FALSE); 
        $this->db->from('lead_feedback l');
        $this->db->join('users u', 'u.userID = l.userID', 'left');
        $this->db->join('leads_details d', 'd.lead_id = l.lead_id', 'left');
        //$this->db->where("status",'1');
        
        if($seller_search != ''){
            $this->db->like('u.contact_name',$seller_search);
        }
        if($starlevel_search != ''){
            $this->db->where('l.star_rating',$starlevel_search);
        }
        if($status_search != ''){
            $this->db->where('l.refund_approved',$status_search);
        }
        if($leadid_search != ''){
            $this->db->where('l.lead_id',$leadid_search);
        }
        if($fromdate_search != '') 
            $this->db->where('l.created_date >=', $fromdate_search);
        if($todate_search != '') 
            $this->db->where('l.created_date <=', $todate_search);
        
        $this->db->where('l.refund_approved !=','0');
        //$this->db->where('l.refund','0');
        $this->db->order_by("lead_feedback_id","desc");
        $this->db->limit($limit, $start);   
        $query = $this->db->get();           
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_dropoutlead_list($limit, $start,$leadname_search = '',$leadname_email = '',$starlevel_search ='',$city_suburb_search ='',$fromdate_search ='',$todate_search ='') {
        $this->db->select("SQL_CALC_FOUND_ROWS l.*,p.source",FALSE); 
        $this->db->from('leads_details l');
        $this->db->join('cc_promotions p', 'p.id = l.promo_id', 'left');
        $this->db->where("submission_status",'Incompleted');
        
        if($leadname_search != ''){
            $this->db->like('first_name',$leadname);
            $this->db->or_like('last_name',$leadname);
        }
        if($leadname_email != ''){
            $this->db->like('email',$leadname_email);
        }
        if($starlevel_search != ''){
            $this->db->where('star_level',$starlevel_search);
        }
        if($city_suburb_search != ''){
            $this->db->like('city_suburb',$city_suburb_search);
        }
        if($fromdate_search != '') 
            $this->db->where('date_time >=', $fromdate_search);
        if($todate_search != '') 
            $this->db->where('date_time <=', $todate_search);
        
        $this->db->order_by("lead_id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  //echo $this->db->last_query(); exit;
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_rotatingbanner_list($limit, $start,$name_search = '',$status_search = '') {
        $this->db->select("SQL_CALC_FOUND_ROWS r.*,p.pack_limit",FALSE); 
        $this->db->from('rotating_banners r');
        $this->db->join('rotating_banner_packages p', 'p.pack_id = r.pack_id', 'left');
        //$this->db->where("status",'A');
        if($status_search != ''){
            $this->db->where('r.status',$status_search);
        }
        if($name_search != ''){
            $this->db->like('r.banner_name',$name_search);
        }
        $this->db->where('r.status != ',"D");
        $this->db->order_by("r.id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function update_profile($data = array(), $id = 0) {
        $this->db->where("id",$id);
        $this->db->update("administrators",$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function update_password($data = array(), $id = 0) {
        $this->db->where("id",$id);
        $this->db->update("administrators",$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function check_oldpassword($password,$id){
        $this->db->where("password",$password);
        $this->db->where("id",$id);
        $this->db->from('administrators');
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return true;
        else
            return false;
    }

    public function get_admindetails_byusername($username){
        $this->db->select('*');
        $this->db->where("username",$username);
        $this->db->from('administrators');
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_emailalert_details ($id = 0) {
        $this->db->select('*');
        $this->db->where("id",$id);
        $this->db->from('admin_email_notification');
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_rotating_banner_link ($id = 0) {
        $this->db->select('*');
        $this->db->where("id",$id);
        $this->db->from('rotating_banners');
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
            
    function send_mail($to="",$subject="",$message=""){ 
        $config = Array( 
            'protocol' => 'smtp',        
            'smtp_host' => $this->config->item('smtp_host'),  
            'smtp_port' => $this->config->item('smtp_port'),      
            'smtp_user' => $this->config->item('smtp_user'), 
            'smtp_pass' => $this->config->item('smtp_password'), 
            'mailtype' => $this->config->item('mailtype'), 
            'charset' => 'iso-8859-1',   
            'wordwrap' => TRUE );      
        
        $this->load->library('email', $config); 
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");    
        $this->email->from('niju.lv@rainconcert.in', 'NIJU.L.V');            
        $this->email->to($to);      
        $this->email->subject($subject);     
        $this->email->message($message);       
       if($this->email->send())               
            return TRUE;      
        else        
             return FALSE;   
    }
    
    public function get_articles_list($limit, $start,$tbl_name = '') {
        $this->db->select('*');
        $this->db->where("status",'1');
        $this->db->from($tbl_name);  
        $this->db->order_by("id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_banner_list($limit, $start,$tbl_name = '') {
        $this->db->select('*');
        $this->db->where("status",'A');
        $this->db->from($tbl_name);  
        $this->db->order_by("banner_order","asc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_buyerguide_list($limit, $start) {
        $this->db->select('*');
        $this->db->where("status",'1');
        $this->db->from('cc_buyer_guide '); 
        $this->db->order_by("id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_popularproduct_list($limit, $start) {
        $this->db->select('p.*,c.cat_name');
       //$this->db->where("p.status",'1');
        $this->db->from('cc_popular_products p'); 
        $this->db->join('product_categories c', 'c.cat_id = p.cat_id', 'left');
        $this->db->order_by("pid","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function banner_creation ($userdata = array(),$tbl_name = ''){
        $this->db->insert($tbl_name,$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function product_creation ($userdata = array()){
        $this->db->insert('cc_popular_products',$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function buyerguide_creation ($userdata = array()){
        $this->db->insert('cc_buyer_guide',$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function promocode_creation ($userdata = array(),$tbl_name = ''){
        $this->db->insert($tbl_name,$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function check_promotions_source ($short_url = '',$id = 0) {
        //$query = $this->db->get_where('cc_promotions', array('short_url' => $short_url));
        $this->db->from("cc_promotions");
        $this->db->where("short_url",$short_url);
        if($id != 0)
            $this->db->where("id !=",$id);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return false;
        else 
            return true;
    }

        public function industry_creation ($userdata = array()){
        $this->db->insert('ls_industries',$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function check_banner_order ($order,$id = 0,$tbl_name = '') {
        $this->db->where("banner_order",$order);
        $this->db->where("status",'A');
        if($id != 0)
            $this->db->where("id !=",$id);   
        $query = $this->db->get($tbl_name);  
        if($query->num_rows () >0)
            return false;
        else
            return true;
    }
    
    public function get_banner_details($id = 0,$tbl_name){
        $this->db->select('*');
        $this->db->where("id",$id);
        $this->db->from($tbl_name);  
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    } 
    
    public function get_buyerguide_details($id = 0){
        $this->db->select('*');
        $this->db->where("id",$id);
        $this->db->from('cc_buyer_guide');  
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    } 
    
     public function get_product_details($id = 0){
        $this->db->select('*');
        $this->db->where("pid",$id);
        $this->db->from('cc_popular_products');  
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function banner_modification ($userdata = array(),$id = 0,$tbl_name = '') {
        $this->db->where('id',$id);
        $this->db->update($tbl_name,$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function product_modification ($userdata = array(),$id = 0) {
        $this->db->where('pid',$id);
        $this->db->update('cc_popular_products',$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function buyerguide_modification ($userdata = array(),$id = 0) {
        $this->db->where('id',$id);
        $this->db->update('cc_buyer_guide',$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function promocode_modification ($userdata = array(),$id = 0,$tbl_name = '') {
        $this->db->where('id',$id);
        $this->db->update($tbl_name,$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function package_modification ($userdata = array(),$id = 0,$tbl_name = '') {
        $this->db->where('packageID',$id);
        $this->db->update($tbl_name,$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function user_modification ($userdata = array(),$id = 0,$tbl_name = '') {
        $this->db->where('userID',$id);
        $this->db->update($tbl_name,$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function rotating_banner_packages_modification ($userdata = array(),$id = 0,$tbl_name = '') {
        $this->db->where('pack_id',$id);
        $this->db->update($tbl_name,$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function checking_before_delete_packages ($id = 0,$package_limit_count = 0) {

        $query = $this->db->query("select count(*) as count from rotating_banners where pack_id =".$id." and 
                                    DATE(DATE_ADD(approval_date, INTERVAL $package_limit_count DAY)) > DATE(NOW())"
                                 );
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_package_limit ($id = 0) {
        $this->db->select("*");
        $this->db->from("rotating_banner_packages");
        $this->db->where("pack_id", $id);
        $query = $this->db->get(); 
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }

    public function  insert_banner_packages ($data = array()) {
        $this->db->insert('rotating_banner_packages',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return true;   
    }

    

    public function leadprice_modification ($userdata = array(),$id = 0) {
        $this->db->where('price_id',$id);
        $this->db->update('lead_price_master',$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function emailalert_modification ($userdata = array(),$id = 0) {
        $this->db->where('id',$id);
        $this->db->update('admin_email_notification',$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function feedback_modification ($userdata = array(),$id = 0) {
        $this->db->where('lead_feedback_id',$id);
        $this->db->update('lead_feedback',$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function get_supplier_details_byid ($id = 0){
        $this->db->select('*');
        $this->db->where('userID',$id);
        $this->db->from('users');
        $query = $this->db->get();  
        if($query->num_rows () > 0)
            return $query->row_array();
        else
            return false;
    } 
    
    public function get_supplierid_byfeedback_id ($id = 0){
        $this->db->select('*');
        $this->db->where('lead_feedback_id',$id);
        $this->db->from('lead_feedback');
        $query = $this->db->get();  
        if($query->num_rows () > 0)
            return $query->row_array();
        else
            return false;
    } 

        public function industry_modification ($userdata = array(),$id = 0) {
        $this->db->where('id',$id);
        $this->db->update('ls_industries',$userdata);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function delete_popular_products ($id = 0) {
         $this->db->where('pid',$id);
        $this->db->delete('cc_popular_products');
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }

        public function get_image_byid($id = 0,$tbl_name = ''){
        if($tbl_name == 'cc_web_banners'){
            $this->db->select('banner_image');
            $this->db->where('id',$id);
        }
        else if($tbl_name == 'ls_web_banners'){
            $this->db->select('banner_image');
            $this->db->where('id',$id);
        }
        else if($tbl_name == 'cc_sellcopier_banners'){
            $this->db->select('banner_image');
            $this->db->where('id',$id);
        }
        else if($tbl_name == 'cc_buyer_guide'){
            $this->db->select('file_path');
            $this->db->where('id',$id);
        }
        else if($tbl_name == 'cc_landing_page_carousal_images'){
            $this->db->select('image_path');
            $this->db->where('id',$id);
        }
        else if($tbl_name == 'cc_articles'){
            $this->db->select('image');
            $this->db->where('id',$id);
        }
        else {
            $this->db->select('product_image');
            $this->db->where('pid',$id);
        }
        $this->db->from($tbl_name); 
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_emailalert_list($limit, $start) {  
        $this->db->select('*');
        //$this->db->where("status","1");
        $this->db->from('admin_email_notification');  
        $this->db->order_by("id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_email_list($limit, $start) {  
        $this->db->select('*');
        $this->db->where("status","1");
        $this->db->from('mail_template');  
        $this->db->order_by("mail_template_id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_reduction_list($limit, $start) {  
        $this->db->select('*');
        $this->db->from('reduction_percentage');  
        $this->db->order_by("id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_promotions_list($limit, $start,$tblname = '') {  
        $this->db->select('*');
        $this->db->where("status","1");
        $this->db->from($tblname);  
        $this->db->order_by("id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_promocode_list($limit, $start,$tblname = '') {  
        $this->db->select('*');
        //$this->db->where("status","A");
        $this->db->from($tblname);  
        $this->db->order_by("id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_bannerpackage_list($limit, $start,$tblname = '') {  
        $this->db->select('*');
        $this->db->where("status","1");
        $this->db->from($tblname);  
        $this->db->order_by("pack_id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_industry_list($limit, $start) {  
        
        $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE);
        $this->db->where("status !=","0");
        $this->db->from('ls_industries');  
        $this->db->order_by("id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();    
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_adminsettings_list($limit, $start) {  
        $this->db->select('*');
        $this->db->where("status","1");
        $this->db->from('admin_settings');  
        $this->db->order_by("settings_id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_emaildetails_byid ($id = 0){
        $this->db->select('*');
        $this->db->where("mail_template_id",$id);
        $this->db->from('mail_template');
         $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_reductiondetails_byid ($id = 0){
        $this->db->select('*');
        $this->db->where("id",$id);
        $this->db->from('reduction_percentage');
         $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_socialmedia_list ($id = 0){
        $this->db->select('*');
        $this->db->from('social_media_links');
        $this->db->where("status",'1');
        $this->db->group_by("id");
        $this->db->order_by("id","asc");
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_promocodedetails_byid ($id = 0,$tbl_name = ''){
        $this->db->select('*');
        $this->db->where("id",$id);
        $this->db->from($tbl_name);
         $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_user_byid ($id = 0,$tbl_name = ''){
        $this->db->select('*');
        $this->db->where("userID",$id);
        $this->db->from($tbl_name);
         $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
     public function get_bannerpackages_byid ($id = 0,$tbl_name = ''){
        $this->db->select('*');
        $this->db->where("pack_id",$id);
        $this->db->from($tbl_name);
         $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_industrydetails_byid ($id = 0){
        $this->db->select('*');
        $this->db->where("id",$id);
        $this->db->from('ls_industries');
         $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_adminsettings_byid ($id = 0) {
        $this->db->select('*');
        $this->db->where("settings_id",$id);
        $this->db->from('admin_settings');
         $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }

        public function get_admindetails (){
        $this->db->select('*');
        $this->db->from('admin_settings');
         $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function update_mailsettings ($data = array(),$mail_template_id = 0) {
        $this->db->where("mail_template_id", $mail_template_id);
        $this->db->update('mail_template',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function update_reductionsettings ($data = array(),$id = 0) {
        $this->db->where("id", $id);
        $this->db->update('reduction_percentage',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function update_socialmediasettings ($data = array(),$id = 0) {
        $this->db->where("id", $id);
        $this->db->update('social_media_links',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function update_users($data = array(), $id = 0) {
        $this->db->where("userID",$id);
        $this->db->update("users",$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function update_rotatingbanner($data = array(), $id = 0) {
        $this->db->where("id",$id);
        $this->db->update("rotating_banners",$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function adminsetting_modification ($data = array(), $id = 0) { 
        if($id == 0)
           $this->db->insert('admin_settings',$data);
        else {
            $this->db->where("settings_id",$id);
            $this->db->update('admin_settings',$data);
        }
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function change_other_promocode_status ($data = array(),$id = 0) {
        $this->db->where("id !=",$id);
        $this->db->update('ls_promocode',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function checking_promocode_status ($id = 0) {
        $this->db->select('*');
        if($id !=0)
            $this->db->where("id !=", $id);
        $this->db->where("status", 'Active');
        $this->db->from('ls_promocode');
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return true;
        else
            return false;
    }
    
    public function get_device_color () {
        $this->db->select('*');
        $this->db->from("cc_device_color");
        $this->db->order_by("color_id","asc");
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_device_type () {
        $this->db->select('*');
        $this->db->from("cc_device_type");
        $this->db->order_by("type_id","asc");
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_device_speed () {
        $this->db->select('*');
        $this->db->from("cc_device_speed");
        $this->db->order_by("speed_id","asc");
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_state_list () {
        $this->db->select('*');
        $this->db->from("states");
        $this->db->group_by("state");
        $this->db->order_by("stateID","asc");
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_major_regions_list () {
        $this->db->select('*');
        $this->db->from("major_regions");
        $this->db->group_by("mregion");
        $this->db->order_by("mregionID","asc");
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_sub_regions_list () {
        $this->db->select('*');
        $this->db->from("sub_regions");
        $this->db->group_by("sregion");
        $this->db->order_by("sregionID","asc");
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_device_model () {
        $this->db->select('*');
        $this->db->from("cc_device_model");
        $this->db->order_by("model_id","asc");
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }

    public function get_lead_types() {
        $this->db->select('*');
        $this->db->from("lead_types");
        $this->db->order_by("lead_type_id","asc");
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_leadquestions_byid ($lead_type_id = 0) {
        $this->db->select('*');
        $this->db->from("lead_questions"); 
        $this->db->where("lead_type_id", $lead_type_id);
        $this->db->where("lead_price_matching", 'yes');
        $query = $this->db->get();               
        if($query->num_rows () >0) 
            return $query->result_array();
        else
            return false;
    }
    
    public function get_leadanswers_byid ($question_id = 0){
        $this->db->select('*');
        $this->db->from("lead_question_answers"); 
        $this->db->where("question_id", $question_id);
        $query = $this->db->get(); 
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function lead_price_combination_modify ($data = array(),$price_code = 0) {
        
        $this->db->where("price_code",$price_code);
        $this->db->update('lead_price_master',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;  
    }
    
    public function checking_city_values ($data = array()) {
        $this->db->select("*");
        $this->db->from("cities");
        $this->db->where($data);
        $qry = $this->db->get();
        if ($qry->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public function new_city_insert ($data = array()) {
        $this->db->insert('cities',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false; 
    }

    public function device_price_modify ($data = array(),$price_id = 0) {
        
        $this->db->where("price_id",$price_id);
        $this->db->update('cc_device_price',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;  
    }
    
    public function lead_price_combination_insert ($data = array()) {
        
        $this->db->insert('lead_price_master',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return true;  
    }
    
    public function device_price_insert ($data = array()) {
        
        $this->db->insert('cc_device_price',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return true;  
    }
    
    public function get_devide_pricebyid ($id = 0){
        $this->db->select('*');
        $this->db->from("cc_device_price"); 
        $this->db->where("price_id", $id);
        $query = $this->db->get(); 
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }

        public function checking_price_code ($price_code = 0,$lead_type_id = 0) {
        $this->db->select('*');
        $this->db->from("lead_price_master"); 
        $this->db->where("price_code", $price_code);
        $this->db->where("lead_type_id", $lead_type_id);
        $query = $this->db->get(); 
        if($query->num_rows () >0)
            return true;
        else
            return false;
    }
    
    public function checking_device_details ($device_type = 0,$device_color = 0,$device_speed = 0,$device_model = 0) {
        $this->db->select('*');
        $this->db->from("cc_device_price"); 
        $this->db->where("type_id", $device_type);
        $this->db->where("color_id", $device_color);
        $this->db->where("speed_id", $device_speed);
        $this->db->where("model_id", $device_model);
        $query = $this->db->get(); 
        if($query->num_rows () >0)
             return $query->row_array();
        else
            return false;
    }
    
    public function get_leadprice_details ($limit, $start) {
        $this->db->select('SQL_CALC_FOUND_ROWS m.*,t.lead_type',FALSE);
        $this->db->from('lead_price_master m');
        $this->db->join('lead_types t', 't.lead_type_id = m.lead_type_id', 'left');
        $this->db->where("m.status", "1");
        $this->db->order_by("price_id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_deviceprice_details ($limit, $start) {
        $this->db->select('dp.*,dt.type,dc.color,ds.speed,dm.model');
        $this->db->from('cc_device_price dp');
        $this->db->join('cc_device_type dt', 'dt.type_id = dp.type_id', 'left');
        $this->db->join('cc_device_color dc', 'dc.color_id = dp.color_id', 'left');
        $this->db->join('cc_device_speed ds', 'ds.speed_id = dp.speed_id', 'left');
        $this->db->join('cc_device_model dm', 'dm.model_id = dp.model_id', 'left');
        
        $this->db->order_by("price_id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function modify_emailalert_settings ($data = array(),$id = 0) {
        $this->db->where("id", $id);
        $this->db->update('admin_email_notification',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function device_price_modification ($data = array(),$id = 0) {
        $this->db->where("price_id", $id);
        $this->db->update('cc_device_price',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function banner_link_modification ($data = array(),$id = 0) {
        $this->db->where("id", $id);
        $this->db->update('rotating_banners',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function credit_amount_insertion ($data = array()) {
        $this->db->insert('transactions',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false; 
    }
    
    public function get_notification_count ($tbl_name = ''){
        $this->db->select("count(*) as count");
        $this->db->where("admin_view_status",'1');
        $this->db->from($tbl_name);
        $query = $this->db->get();
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function clear_notifications ($tbl_name = '', $data = array()) {
        $this->db->update($tbl_name,$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false; 
    }
    
    public function get_transaction_details_byid_feedbackapproval ($id = 0){
        if($id != 0 && is_numeric($id)){
            $this->db->select("*");
            $this->db->from("transactions");
            $this->db->where("userID",$id);
            $this->db->where("transaction",'Feedback');
            $query = $this->db->get();          //echo $this->db->last_query(); exit;
            if($query->num_rows () >0)
                return $query->result_array();
            else
                return false;
        }
    }
    
    public function get_sellcopier_price ($sellcopier_id = 0) {
        $this->db->select("*");
        $this->db->from("cc_sellcopier");
        $this->db->where("id",$sellcopier_id);
        $query = $this->db->get();          //echo $this->db->last_query(); exit;
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    } 
    
    public function get_lead_price_byleadid ($lead_id = 0) {
        $this->db->select("*");
        $this->db->from("leads_details");
        $this->db->where("lead_id",$lead_id);
        $query = $this->db->get();          //echo $this->db->last_query(); exit;
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    } 

        public function get_transaction_details_byid ($id = 0){
        if($id != 0 && is_numeric($id)){
            $this->db->select("t.*,u.contact_name,u.username,u.email");
            $this->db->from("transactions t");
            $this->db->join('users u', 'u.userID = t.userID', 'left');
            $this->db->where("t.userID",$id);
            $this->db->where("t.transaction",'Purchase banner');
            $query = $this->db->get();          //echo $this->db->last_query(); exit;
            if($query->num_rows () >0)
                return $query->row_array();
            else
                return false;
        }
    }
    
    public function insert_transaction ($data = array()){
        $this->db->insert('transactions',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function get_lead_details_byid ($id = 0){
        $this->db->select("*");
        $this->db->from("leads_details");
        $this->db->where("lead_id",$id);
        $query = $this->db->get();      
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
   
    
    public function save_carousal_images ($data = array()) {
        $this->db->insert("cc_landing_page_carousal_images",$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function save_landingpage_images ($data = array()) {
        $this->db->insert("cc_landing_pages",$data);
        $insert_id = $this->db->insert_id();
        if($this->db->affected_rows() >0)
            return  $insert_id;
        else
            return false;
    }
    
    public function get_carousal_details ($id =0) {
        $this->db->select("*");
        $this->db->from("cc_landing_page_carousal_images");
        $this->db->where("pageid",$id);
        $query = $this->db->get();      
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    
    public function remove_carousal_images ($id = 0) {
        $this->db->where("pageid", $id);
        $this->db->delete('cc_landing_page_carousal_images');
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function get_carousal_images_unlink ($id = 0) {
       $this->db->select('image_path');
        $this->db->where("pageid", $id);
        $this->db->from('cc_landing_page_carousal_images');
        $query = $this->db->get();      
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_old_carousal_images_details ($id = 0) {
        $this->db->select('*');
        $this->db->where("pageid", $id);
        $this->db->from('cc_landing_page_carousal_images');
        $query = $this->db->get();      
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }

        public function delete_device_price ($id = 0) {
        $this->db->where("price_id", $id);
        $this->db->delete('cc_device_price');
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function deletecarousal_images_inedit ($id = 0) {
        $this->db->where("id", $id);
        $this->db->delete('cc_landing_page_carousal_images');
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function update_image_field ($id = 0,$data = array()) {
        $this->db->where("id", $id);
        $this->db->update('cc_articles',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function get_image_articles ($id = 0) {
        $this->db->select("*");
        $this->db->where("id", $id);
        $this->db->from("cc_articles");
        $query = $this->db->get();      
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }

        public function get_pageid_bycarousalid ($id = 0){
        $this->db->select("pageid");
        $this->db->where("id", $id);
        $this->db->from("cc_landing_page_carousal_images");
        $query = $this->db->get();      
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_total_suppliers_count (){
        $this->db->select("count(*) as suppliercount");
        $this->db->where("status","Active");
        $this->db->from("users");
        $query = $this->db->get();      
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_total_payment_count (){   
        /*
        $this->db->select("count(*) as paymentcount");
        $this->db->where("status","Completed");
        $this->db->from("transactions");
        //$qry = $this->db->query("select count(*) as paymentcount from transactions where status = 'Completed' and month(date) = month(now())");
        $query = $this->db->get(); 
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
        */
        $res['paymentcount'] = $this->db->count_all_results('sales');
        return $res;
    }
    
    public function get_total_lead_count (){
        $this->db->select("count(*) as leadcount");
        $this->db->where("submission_status","Completed");
        $this->db->from("leads_details");
        $query = $this->db->get();      
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_total_preregister_count (){
        $this->db->select("count(*) as precount");
        //$this->db->where("submission_status","Completed");
        $this->db->from("pre_registration");
        $query = $this->db->get();      
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_copier_enquies_list ($tbl_name = ''){
        $this->db->select("*");
        $this->db->from($tbl_name);
        $query = $this->db->get();      
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function deletedropoutlead ($id = 0){
        $this->db->where("lead_id", $id);
        $this->db->delete('leads_details');
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function deleterotatingbanner ($id = 0,$data = array()){
        $this->db->where("id", $id);
        $this->db->update('rotating_banners',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function deleteleadresponse ($id = 0){
        $this->db->where("lead_id", $id);
        $this->db->delete('leads_response');
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function deleteenquiries ($id = 0,$tbl_name = '') {
         $this->db->where("id", $id);
        $this->db->delete($tbl_name);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
     public function get_popular_product_details () {
        $this->db->select('*');
        $this->db->from('cc_popular_products');
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_qustion_byid ($qid = 0) {   
        $this->db->select('*');  
        $this->db->from("lead_questions"); 
        $this->db->where("question_id", $qid);
        $query = $this->db->get();              
        if($query->num_rows () > 0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_answer_byid ($ansid = 0) {   
        $this->db->select('*');  
        $this->db->from("lead_question_answers"); 
        $this->db->where("aid", $ansid);
        $query = $this->db->get();             
        if($query->num_rows () > 0)
            return $query->row_array();
        else
            return false;
    }
    
    public function check_preference_status ($userid = 0) {   
        $this->db->select('*');  
        $this->db->from("user_options"); 
        $this->db->where("userID", $userid);
        $query = $this->db->get();             
        if($query->num_rows () > 0)
            return true;
        else
            return false;
    }
    
    public function get_sellcopier_details_feedback_report ($sellcopier_id = 0) {   
        $this->db->select('*');  
        $this->db->from("cc_sellcopier"); 
        $this->db->where("id", $sellcopier_id);
        $query = $this->db->get();             
        if($query->num_rows () > 0)
            return $query->row_array();
        else
            return false;
    }

    public function update_popular_products ($data = array(), $id = 0) {
        $this->db->where("pid", $id);
        $this->db->update('cc_popular_products',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function get_old_db_values () {
        $this->db->select('*');
        $this->db->from('leads');
        $this->db->limit(1,0);
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function insert_old_db_values ($data = array()){
        $this->db->insert('leads_details',$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function insert_old_db_values_batch ($data = array()){
        if(!empty($data)){
            return $this->db->insert_batch("leads_details", $data);
        }
        return FALSE;
    }
    
}
