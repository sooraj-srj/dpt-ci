<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    var $gen_contents = array();
    
    // index function - check login and navigate to dashboard
    public function __construct() {
            parent::__construct();
            $this->load->library('Excel');
            $this->load->model('admin/admin_model');
        }
    public function index() {
        //$this->load->model('admin/admin_model');
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->model('admin/admin_model');
        $total_suppliers = $this->admin_model->get_total_suppliers_count();
        $this->gen_contents['suppliers_count'] = $total_suppliers['suppliercount'];
        
        $total_payment = $this->admin_model->get_total_payment_count();
        $this->gen_contents['payment_count'] = $total_payment['paymentcount'];
        
        $total_leads = $this->admin_model->get_total_lead_count();
        $this->gen_contents['lead_count'] = $total_leads['leadcount'];
        
        $total_preregisterlist = $this->admin_model->get_total_preregister_count();
        $this->gen_contents['preregister_count'] = $total_preregisterlist['precount'];
        $tbl_name = 'cc_enquiries';
        $this->gen_contents['cc_enquirieslist'] = $this->admin_model->get_copier_enquies_list($tbl_name);
        
        
        $this->gen_contents['page_heading'] = 'Dashboard';
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/dashboard', $this->gen_contents);
        $this->template->render();
    }
    
    //manage product category 
    public function categories($mode="list",$catid=""){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
            $this->load->model('admin/admin_model');
            // Category add area
            if($mode == "add"){
                $this->load->library('form_validation');
                $this->form_validation->set_rules('catname', 'Category Name', 'required');
                if($this->form_validation->run() == TRUE){
                    $catdata = array(
                        "catname" => $this->input->post("catname",true)
                    );
                    $response = $this->admin_model->process_category("add",$catdata);
                    if($response == "added"){
                        redirect("admin/categories");
                    }
                    else if($response == "exists"){
                        sf('error_message', 'Sorry! This category name already exists');
                    }
                }

            }
            // Category edit area
            if($mode == "edit"){
                $catdata = array(
                    "catid"     => $catid,
                    "catname"   =>  $this->admin_model->get_catname($catid)
                );
                //print_r($catdata); die();
                $this->gen_contents['catdata'] = $catdata;

                $this->load->library('form_validation');
                $this->form_validation->set_rules('catname', 'Category Name', 'required');
                if($this->form_validation->run() == TRUE){   
                    $catdata = array(
                        "catname"   => $this->input->post("catname",true),
                        "catid"     => $this->input->post("catid",true)
                    );
                    $response = $this->admin_model->process_category("edit",$catdata);
                    if($response == "edited"){
                        redirect("admin/categories");
                    }
                    else if($response == "exists"){
                        sf('error_message', 'Sorry! This category name already exists');
                    }
                }

            }
            // Category delete area
            if($mode == "delete" && !empty($catid)){
                $catdata = array(
                    'catid'=> $catid
                );
                $response = $this->admin_model->process_category("delete",$catdata);
                //redirect("admin/categories");
            }

            $this->gen_contents['categories'] = $this->admin_model->get_categories();
            $this->gen_contents['page_heading'] = 'Product Categories';
            $this->template->set_template('admin');
            $this->template->write_view('content', 'admin/categories', $this->gen_contents);
            $this->template->render();
    }
    
    
    //manage product category 
    public function packages($mode="list",$pack_id=""){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->model('admin/admin_model');
        $page = 'admin/packages';
        // Package add area
        if($mode == "add"){
            $this->load->library('form_validation');
            $page = 'admin/packages_add';
            $this->form_validation->set_rules('credits_nr', 'credits', 'required');
            if($this->form_validation->run() == TRUE){
                $packdata = array(
                    "description"       => $this->input->post("credits_nr",true).' Credits',
                    "credits_nr"        => $this->input->post("credits_nr",true),
                    "price"             => $this->input->post("price",true),
                    "currency"          => $this->input->post("currency",true),
                    "currency_symbol"   => $this->input->post("currency_symbol",true)
                );
                $response = $this->admin_model->process_package("add",$packdata);
                if($response == "added"){
                    redirect("admin/packages");
                }
                else if($response == "exists"){
                    sf('error_message', 'Sorry! This package name already exists');
                }
            }
            
        }
        
        // Package edit area
        if($mode == "edit"){
            $packdata = $this->admin_model->get_packages('list',$pack_id);
            //print_r($packdata); die();
            $this->gen_contents['pd'] = $packdata;
            $page = "admin/packages_add";
            $this->load->library('form_validation');
            $this->form_validation->set_rules('credits_nr', 'credits', 'required');
            if($this->form_validation->run() == TRUE){
                
                $packdata_new = array(
                    "packageID"         => $this->input->post("packageID",true),
                    "description"       => $this->input->post("credits_nr",true).' Credits',
                    "credits_nr"        => $this->input->post("credits_nr",true),
                    "price"             => $this->input->post("price",true),
                    "currency"          => $this->input->post("currency",true),
                    "currency_symbol"   => $this->input->post("currency_symbol",true)
                );
                //print_r($packdata_new); die();
                $response = $this->admin_model->process_package("edit",$packdata_new);
                if($response == "edited"){
                    redirect("admin/packages");
                }
            }
            
        }
        // Package delete area
        if($mode == "delete" && !empty($pack_id)){
            $packdata = array(
                'packageID'=> $pack_id
            );
            $response = $this->admin_model->process_package("delete",$packdata);
            redirect("admin/packages");
        }
        
        $this->gen_contents['packages'] = $this->admin_model->get_packages();
        $this->gen_contents['page_heading'] = 'Packages';
        $this->template->set_template('admin');
        $this->template->write_view('content', $page, $this->gen_contents);
        $this->template->render();
        
    }
    
      //manage makers/brands
    public function makers($mode="list",$maker_id=""){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->model('admin/admin_model');
        $page = 'admin/makers';
        // makeres add area
        if($mode == "add"){
            $this->load->library('form_validation');
            $page = 'admin/makers_add';
            $this->form_validation->set_rules('maker', 'Maker name', 'required');
            if($this->form_validation->run() == TRUE){
                $makerdata = array(
                    "maker"       => $this->input->post("maker",true),
                    "cat_id"      => $this->input->post("cat_id",true)
                );
                $response = $this->admin_model->process_makers("add",$makerdata);
                if($response == "added"){
                    redirect("admin/makers");
                }
                else if($response == "exists"){
                    sf('error_message', 'Sorry! This maker name already exists for same category');
                }
            }
        }
        
        // makers edit area
        if($mode == "edit"){
            $makerdata = $this->admin_model->get_makers('list',$maker_id);
            //print_r($packdata); die();
            $this->gen_contents['md'] = $makerdata;
            $page = "admin/makers_add";
            $this->load->library('form_validation');
            $this->form_validation->set_rules('maker', 'Maker name', 'required');
            if($this->form_validation->run() == TRUE){
                $makerdata_new = array(
                    "makerID"     => $this->input->post("makerID",true),
                    "maker"       => $this->input->post("maker",true),
                    "cat_id"      => $this->input->post("cat_id",true)
                );
                //print_r($packdata_new); die();
                $response = $this->admin_model->process_makers("edit",$makerdata_new);
                if($response == "edited"){
                    redirect("admin/makers");
                }
            }
            
        }
        // makers delete area
        if($mode == "delete" && !empty($maker_id)){
            $makerdata = array(
                'makerID'=> $maker_id
            );
            $response = $this->admin_model->process_makers("delete",$makerdata);
            redirect("admin/makers");
        }
        
        $this->gen_contents['makers'] = $this->admin_model->get_makers();
        $this->gen_contents['cat_list'] = $this->admin_model->get_categories();
        $this->gen_contents['page_heading'] = 'Makers/Brands';
        $this->template->set_template('admin');
        $this->template->write_view('content', $page, $this->gen_contents);
        $this->template->render();
        
    }
    
    //users list controller
    public function users($mode = 'list',$user_id = 0){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $user_id = $this->input->get("id"); 
        
        $this->load->model('admin/admin_model');
        $page = 'admin/users';                       
        
        if($this->input->post("record_page_limit")){
            $this->session->set_userdata('page_limit', $this->input->post("record_page_limit"));
            $config['per_page']   = s('page_limit');   
        }
        else if(NULL != s('page_limit')){
            $config['per_page']   = s('page_limit');
        }  
        else {
             $config['per_page']   = 25;
        }
        
        $this->gen_contents['per_page'] = $config['per_page'];
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;  
        
        if($this->input->post("contact_name_search") != '')
            $contact_name_search = trim($this->input->post("contact_name_search",true));
        else 
            $contact_name_search = '';
        if($this->input->post("city_suburb_search") != '')
            $city_suburb_search = $this->input->post("city_suburb_search",true);
        else 
            $city_suburb_search = '';
        if($this->input->post("status_search") != '')
            $status_search = $this->input->post("status_search",true);
        else 
            $status_search = '';
        if($this->input->post("email_search") != '')
            $email_search = trim($this->input->post("email_search",true));
        else 
            $email_search = '';
        if($this->input->post("company_search") != '')
            $company_search = trim($this->input->post("company_search",true));
        else 
            $company_search = '';
        if($this->input->post("postcode_search") != '')
            $postcode_search = trim($this->input->post("postcode_search",true));
        else 
            $postcode_search = '';
        
        $this->gen_contents['users'] = $this->admin_model->get_users($config['per_page'], $pagin,$contact_name_search,$city_suburb_search,$status_search,$email_search,$company_search,$postcode_search,$user_id);
        
        $total_user = $this->admin_model->get_total_rows();
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'users';
        $config['total_rows']   = $total_user;
        $bs_init = $this->bspagination->config();
        $config = array_merge($config, $bs_init);
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();
        
        $this->gen_contents['page_heading'] = 'Manage Suppliers';
        $this->template->set_template('admin');
        $this->template->write_view('content', $page, $this->gen_contents);
        $this->template->render();
    }
    
    public function supplierprofilestatus($mode = 'list'){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->model('admin/admin_model');
        $page = 'admin/profile_status';                       
        
        if($this->input->post("record_page_limit")){
            $this->session->set_userdata('page_limit', $this->input->post("record_page_limit"));
            $config['per_page']   = s('page_limit');   
        }
        else if(NULL != s('page_limit')){
            $config['per_page']   = s('page_limit');
        }  
        else {
             $config['per_page']   = 25;
        }
        
        $this->gen_contents['per_page'] = $config['per_page'];
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;  
        
        if($this->input->post("contact_name_search") != '')
            $contact_name_search = trim($this->input->post("contact_name_search",true));
        else 
            $contact_name_search = '';
        if($this->input->post("email_search") != '')
            $email_search = trim($this->input->post("email_search",true));
        else 
            $email_search = '';
        if($this->input->post("status_search") != '')
            $status_search = $this->input->post("status_search",true);
        else 
            $status_search = '';
        
        $user_option_data = $this->admin_model->get_user_option_details();
        $user_optn = array();
        if($user_option_data) {
            foreach ($user_option_data as $id){
                $user_optn[] = $id['userID'];
            }
        }
        
        $this->gen_contents['details'] = $this->admin_model->get_user_profile_status($config['per_page'], $pagin,$contact_name_search,$email_search,$status_search,$user_optn);
        $total_rows = $this->admin_model->get_total_rows();
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'supplierprofilestatus';
        $config['total_rows']   = $total_rows;
        $bs_init = $this->bspagination->config();
        $config = array_merge($config, $bs_init);
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();
        
        $this->gen_contents['page_heading'] = 'Supplier Profile Status';
        $this->template->set_template('admin');
        $this->template->write_view('content', $page, $this->gen_contents);
        $this->template->render();
    }
    
    //Leads list controller
    public function leads($mode = 'list'){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->model('admin/admin_model');
        $page = 'admin/leads';
        
        if($this->input->post("record_page_limit")){
            $this->session->set_userdata('page_limit', $this->input->post("record_page_limit"));
            $config['per_page']   = s('page_limit');   
        }
        else if(NULL != s('page_limit')){
            $config['per_page']   = s('page_limit');
        }  
        else {
             $config['per_page']   = 25;
        } 
        
        $this->gen_contents['per_page'] = $config['per_page'];
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        if($this->input->post("leadname_search") != '')
            $leadname_search = $this->input->post("leadname_search",true);
        else 
            $leadname_search = '';
        if($this->input->post("leadname_email") != '')
            $leadname_email = $this->input->post("leadname_email",true);
        else 
            $leadname_email = '';
        if($this->input->post("starlevel_search") != '')
            $starlevel_search = $this->input->post("starlevel_search",true);
        else 
            $starlevel_search = '';
        if($this->input->post("city_suburb_search") != '')
            $city_suburb_search = $this->input->post("city_suburb_search",true);
        else 
            $city_suburb_search = '';
        if($this->input->post("status_search") != '')
            $status_search = $this->input->post("status_search",true);
        else 
            $status_search = '';
        if($this->input->post("fromdate_search") != '')
            $fromdate_search = $this->input->post("fromdate_search",true);
        else 
            $fromdate_search = '';
        if($this->input->post("todate_search") != '')
            $todate_search = $this->input->post("todate_search",true);
        else 
            $todate_search = '';
        
        $this->gen_contents['leads'] = $this->admin_model->get_leads($config['per_page'], $pagin,$leadname_search,$leadname_email,$starlevel_search,$city_suburb_search,$status_search,$fromdate_search,$todate_search);
        
        $total_leads = $this->admin_model->get_total_rows();  
        
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'leads';
        $config['total_rows']   = $total_leads;
        
        //config for bootstrap pagination class integration   
        $bs_init = $this->bspagination->config();
        $config = array_merge($config, $bs_init);
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        
        $this->gen_contents['page_heading'] = 'Leads';
        $this->template->set_template('admin');
        $this->template->write_view('content', $page, $this->gen_contents);
        $this->template->render();
    }
    
    // Manage postcode/city
     public function managepostcode($mode = 'list'){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->model('admin/admin_model');
        $page = 'admin/managepostcodelist';
        
        if($this->input->post("record_page_limit")){
            $this->session->set_userdata('page_limit', $this->input->post("record_page_limit"));
            $config['per_page']   = s('page_limit');   
        }
        else {
            $config['per_page']   = 25;
        }  
        
        
        $this->gen_contents['per_page'] = $config['per_page'];
        
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        if($this->input->post("state_search") != '')
            $state_search = $this->input->post("state_search",true);
        else 
            $state_search = '';
        if($this->input->post("mainregion_search") != '')
            $mainregion_search = $this->input->post("mainregion_search",true);
        else 
            $mainregion_search = '';       
        if($this->input->post("subregion_search") != '')
            $subregion_search = $this->input->post("subregion_search",true);
        else 
            $subregion_search = '';        
        if($this->input->post("city_suburb_search") != '')
            $city_suburb_search = $this->input->post("city_suburb_search",true);
        else 
            $city_suburb_search = '';       
        if($this->input->post("postcode_search") != '')
            $postcode_search = $this->input->post("postcode_search",true);
        else 
            $postcode_search = '';
        
        $this->gen_contents['postcodelist'] = $this->admin_model->get_postcodelist($config['per_page'], $pagin,$state_search,$mainregion_search,$subregion_search,$city_suburb_search,$postcode_search);
        
        $total_records = $this->admin_model->get_total_rows();  
        
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'managepostcode';
        $config['total_rows']   = $total_records;
        
        //config for bootstrap pagination class integration   
        $bs_init = $this->bspagination->config();
        $config = array_merge($config, $bs_init);
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        
        $this->gen_contents['page_heading'] = 'Manage Suburb/Postcode';
        $this->template->set_template('admin');
        $this->template->write_view('content', $page, $this->gen_contents);
        $this->template->render();
    }
       
    public function createcity () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->form_validation->set_rules('state', 'state', 'required');
        $this->form_validation->set_rules('main_region', 'main region', 'required');
        $this->form_validation->set_rules('sub_region', 'sub region', 'required');
        $this->form_validation->set_rules('city', 'city', 'required');
        $this->form_validation->set_rules('postcode', 'postcode', 'required');
        
            if($this->form_validation->run() == TRUE){
                
                $userdata = array(
                    "stateID"   => $this->input->post("state",true),
                    "mregionID"  => $this->input->post("main_region",true),
                    "sregionID"  => $this->input->post("sub_region",true),
                    "city"  => $this->input->post("city",true),
                    "postcode"     => $this->input->post("postcode",true)
                );
                
                 
                $checking_city = $this->admin_model->checking_city_values($userdata);
                if($checking_city) {
                    $result = $this->admin_model->new_city_insert($userdata);
                    if($result){
                        sf( 'success_message', "City details inserted successfully" );
                        redirect("admin/managepostcode");
                    }
                    else {
                        sf('error_message', 'The city details not inserted, Please try agin later');
                        redirect("admin/managepostcode");
                    }
                }
                else {
                    sf('error_message', 'The city already exists');
                    redirect("admin/managepostcode");
                }
            }
            
            $this->gen_contents['state'] = $this->admin_model->get_state_list();
            $this->gen_contents['major_regions'] = $this->admin_model->get_major_regions_list();
            $this->gen_contents['sub_regions'] = $this->admin_model->get_sub_regions_list();
            
            $this->gen_contents['page_heading'] = 'Manage Suburb/Postcode';
            $this->template->set_template('admin');
            $this->template->write_view('content', 'admin/createcity', $this->gen_contents);
            $this->template->render();
    }
    
    public function buyerguidereport($mode = 'list'){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $page = 'admin/buyerguidereport';
        
        if($this->input->post("record_page_limit")){
            $this->session->set_userdata('page_limit', $this->input->post("record_page_limit"));
            $config['per_page']   = s('page_limit');   
        }
        else if(NULL != s('page_limit')){
            $config['per_page']   = s('page_limit');
        }  
        else {
             $config['per_page']   = 25;
        } 
        
        $this->gen_contents['per_page'] = $config['per_page'];
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        if($this->input->post("name_search") != '')
            $name_search = trim($this->input->post("name_search",true));
        else 
            $name_search = '';
        if($this->input->post("suburb_search") != '')
            $suburb_search = trim($this->input->post("suburb_search",true));
        else 
            $suburb_search = '';
        if($this->input->post("email_search") != '')
            $email_search = trim($this->input->post("email_search",true));
        else 
            $email_search = '';
        if($this->input->post("status_search") != '')
            $status_search = $this->input->post("status_search",true);
        else 
            $status_search = '';
        
        
        $this->gen_contents['buyerguide'] = $this->admin_model->get_buyerguide_report($config['per_page'], $pagin,$name_search,$email_search,$status_search,$suburb_search);
        
        $total_records = $this->admin_model->get_total_rows();  
        
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'buyerguidereport';
        $config['total_rows']   = $total_records;
        
        //config for bootstrap pagination class integration   
        $bs_init = $this->bspagination->config();
        $config = array_merge($config, $bs_init);
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        
        $this->gen_contents['page_heading'] = 'Buyer Guide';
        $this->template->set_template('admin');
        $this->template->write_view('content', $page, $this->gen_contents);
        $this->template->render();
    }
    
    // About us page 
    
    public function about() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->library('form_validation');
        $this->load->model('admin/admin_model');
       
        $this->form_validation->set_rules('page_title', 'Page title', 'required');
        $this->form_validation->set_rules('contents', 'Page contents', 'required');
        $controller = 'about';
        if($this->form_validation->run() == TRUE){
           
            $content = $this->input->post("contents");  
            $base_path = base_url(); 
            $contents = str_replace("../",$base_path,$content);
            
            $userdata = array(
                'page_title' => $this->input->post("page_title",true),
                'contents'   => $contents
            );
            $condition = $this->input->post("id",true);
                 
            $result = $this->admin_model->update_webcontents($userdata,$condition,$controller);
            if($result){
                sf( 'success_message', "About us details modified successfully" );
                redirect("admin/about");
            }
            else {
                sf('error_message', 'No modifications done');
                redirect("admin/about");
            }
        }
        $this->gen_contents['details'] = $this->admin_model->get_webcontents_details($controller);
        $this->gen_contents['page_heading'] = 'About Us Page';
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/aboutus', $this->gen_contents);
        $this->template->render();
          
    }
    
    public function leadcoveragearea() { 
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->library('form_validation');
        $this->load->model('admin/admin_model');
       
        $this->form_validation->set_rules('title', 'Page title', 'required');
        $this->form_validation->set_rules('contents', 'Page contents', 'required');
        
        if($this->form_validation->run() == TRUE){
           
            $content = '';
             
            $content = str_replace("<img","<img class='img-responsive'",$this->input->post("contents")); 
            
            $base_path = base_url(); 
            
            $contents = str_replace("../../",$base_path,$content);
            $contents = str_replace("../",$base_path,$content);
            
            $userdata = array(
                'title' => $this->input->post("title",true),
                'contents'   => $contents
            );
            $condition = $this->input->post("id",true);
                 
            $result = $this->admin_model->update_leadcoveragearea($userdata,$condition);
            if($result){
                sf( 'success_message', "Lead coverage area details modified successfully" );
                redirect("admin/leadcoveragearea");
            }
            else {
                sf('error_message', 'No modifications done');
                redirect("admin/leadcoveragearea");
            }
        }
        $this->gen_contents['details'] = $this->admin_model->get_lead_coveragearea_details();
        $this->gen_contents['page_heading'] = 'Lead Coverage Area';
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/leadcoveragearea', $this->gen_contents);
        $this->template->render();
          
    }
    
    // Contact us 
    public function contact() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->library('form_validation');
        $this->load->model('admin/admin_model');
       
        $this->form_validation->set_rules('page_title', 'Page title', 'required');
        $this->form_validation->set_rules('contents', 'Page contents', 'required');
        $controller = 'contact';  
        if($this->form_validation->run() == TRUE){
           
            $userdata = array(
                'page_title' => $this->input->post("page_title",true),
                'contents' => $this->input->post("contents",true)
            );
            $condition = $this->input->post("id",true);
              
            $result = $this->admin_model->update_webcontents($userdata,$condition,$controller);
            if($result){
                sf( 'success_message', "Contact us details modified successfully" );
                redirect("admin/contact");
            }
            else {
                sf('error_message', 'No modifications done');
                redirect("admin/contact");
            }
        }
        
        $this->gen_contents['details'] = $this->admin_model->get_webcontents_details($controller);
        $this->gen_contents['page_heading'] = 'Contact Us';
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/contactus', $this->gen_contents);
        $this->template->render();
        
        
    }
    
    // Resources 
    public function resources() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->library('form_validation');
        $this->load->model('admin/admin_model');
       
        $this->form_validation->set_rules('page_title', 'Page title', 'required');
        $this->form_validation->set_rules('contents', 'Page contents', 'required');
        $controller = 'resources';  
        if($this->form_validation->run() == TRUE){
            
            $content = $this->input->post("contents");  
            $base_path = base_url(); 
            $contents = str_replace("../",$base_path,$content);
            
            $userdata = array(
                'page_title' => $this->input->post("page_title",true),
                'contents'   => $contents
            );
            $condition = $this->input->post("id",true);
              
            $result = $this->admin_model->update_webcontents($userdata,$condition,$controller);
            if($result){
                sf( 'success_message', "Resources details modified successfully" );
                redirect("admin/resources");
            }
            else {
                sf('error_message', 'No modifications done');
                redirect("admin/resources");
            }
        }
        
        $this->gen_contents['details'] = $this->admin_model->get_webcontents_details($controller);
        $this->gen_contents['page_heading'] = 'Resources Page';
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/resources', $this->gen_contents);
        $this->template->render();
        
        
    }
    
    // Sellcopier 
    public function sellcopier() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->library('form_validation');
        $this->load->model('admin/admin_model');
       
        $this->form_validation->set_rules('page_title', 'Page title', 'required');
        $this->form_validation->set_rules('contents', 'Page contents', 'required');
        $controller = 'sellcopier';  
        if($this->form_validation->run() == TRUE){
            
            $content = $this->input->post("contents");  
            $base_path = base_url(); 
            $contents = str_replace("../",$base_path,$content);
            
            $userdata = array(
                'page_title' => $this->input->post("page_title",true),
                'contents'   => $contents
            );
            $condition = $this->input->post("id",true);
              
            $result = $this->admin_model->update_webcontents($userdata,$condition,$controller);
            if($result){
                sf( 'success_message', "Sellcopier details modified successfully" );
                redirect("admin/sellcopier");
            }
            else {
                sf('error_message', 'No modifications done');
                redirect("admin/sellcopier");
            }
        }
        
        $this->gen_contents['details'] = $this->admin_model->get_webcontents_details($controller);
        $this->gen_contents['page_heading'] = 'Sellcopier Page';
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/sellcopier', $this->gen_contents);
        $this->template->render();
        
        
    }
    
    // Web pages content management page
    public function webpages() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->model('admin/admin_model');
        
        $config['per_page']     = 25;
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        if($this->input->post("html_name_search") != '')
            $html_name_search = trim($this->input->post("html_name_search",true));
        else 
            $html_name_search = '';
        if($this->input->post("title_search") != '')
            $title_search = trim($this->input->post("title_search",true));
        else 
            $title_search = '';
        if($this->input->post("status_search") != '')
            $status_search = $this->input->post("status_search",true);
        else 
            $status_search = '';
        
        $this->gen_contents['details'] = $this->admin_model->get_webpage_list($config['per_page'], $pagin,$html_name_search,$title_search,$status_search);      
        $total_webpages = $this->admin_model->get_total_rows(); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');  
        $config['base_url']     = admin_url().'webpages';
        $config['total_rows']   = $total_webpages;
        $bs_init = $this->bspagination->config();
        $config = array_merge($config, $bs_init);
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links(); 
        
        $this->gen_contents['page_heading'] = 'Web Pages CopierChoice';       
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/webpagelist', $this->gen_contents);
        $this->template->render();
    }
    
    public function leadspagecontents() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $config['per_page']     = 25;
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $this->gen_contents['details'] = $this->admin_model->get_leadpagecontent_list($config['per_page'], $pagin);      
        $total_records = $this->admin_model->get_total_rows(); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');  
        $config['base_url']     = admin_url().'leadspagecontents';
        $config['total_rows']   = $total_records;
        $bs_init = $this->bspagination->config();
        $config = array_merge($config, $bs_init);
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links(); 
        
        $this->gen_contents['page_heading'] = 'Page Contents';       
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/leadspagecontentlist', $this->gen_contents);
        $this->template->render();
    }
    
    // To generate clean url
    function url_slug($str)
    {	
        #convert case to lower
        $str = strtolower($str);
        #remove special characters
        $str = preg_replace('/[^a-zA-Z0-9]/i',' ', $str);
        #remove white space characters from both side
        $str = trim($str);
        #remove double or more space repeats between words chunk
        $str = preg_replace('/\s+/', ' ', $str);
        #fill spaces with hyphens
        $str = preg_replace('/\s+/', '-', $str);
        return $str;
    }

    // Add web pages 
    public function addwebpages (){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->model('admin/admin_model');
        $this->form_validation->set_rules('link_name', 'Web page link name', 'required');
        $this->form_validation->set_rules('title', 'Web page title', 'required');
        $this->form_validation->set_rules('contents', 'Web page contents', 'required');
        $this->form_validation->set_rules('link_url', 'Link url', 'required');
        
        if($this->form_validation->run() == TRUE){  
            
            $html_link = '';
            $content = '';
            $html_link = $this->url_slug($this->input->post("link_url"));
            $html_link = $html_link.'.html';
            $content = str_replace("<img","<img class='img-responsive'",$this->input->post("contents")); 
            
            //$content = $this->input->post("contents");  
            $base_path = base_url(); 
            $contents = str_replace("../../../",$base_path,$content);
            $contents = str_replace("../../",$base_path,$content);
            $contents = str_replace("../",$base_path,$contents);
            
            $userdata = array(
                'category'  => $this->input->post("category",true),
                'title'     => $this->input->post("title",true),
                'contents'  => $contents,
                'html_link' => $html_link,
                'status' => $this->input->post("status",true),
                'meta_tags' => $this->input->post("meta_tags",true),
                'meta_description' => $this->input->post("meta_description",true),
                'link_name' => $this->input->post("link_name",true),
                'link_path' => 'pages/'
            );
            
            $tbl_name = 'cc_web_pages';
            $result = $this->admin_model->insert_webpages($userdata,$tbl_name);
            if($result){
                sf( 'success_message', "Web pages details inserted successfully" );
                redirect("admin/webpages");
            }
            else {
                sf('error_message', 'Web pages details not inserted');
                redirect("admin/webpages");
            }    
        }
        
        
        $this->gen_contents['page_heading'] = 'Web pages creation';
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/webpagecreation', $this->gen_contents);
        $this->template->render();
        
    }
    
    public function modifypagecontents($id = 0){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        if($id != 0 && is_numeric($id)){
            
            $this->load->model('admin/admin_model');
            $this->form_validation->set_rules('description', 'page description', 'required');
            //$this->form_validation->set_rules('contents', 'Page contents', 'required');
            
            if($this->form_validation->run() == TRUE){  
            
                $content = '';
                $content = str_replace("<img","<img class='img-responsive'",$this->input->post("contents")); 
                
                //$content = $this->input->post("contents");  
                $base_path = base_url(); 
                $contents = str_replace("../../../",$base_path,$content);
                $contents = str_replace("../../",$base_path,$content);
                $contents = str_replace("../",$base_path,$contents);
            
                $userdata = array(
                    'description' => $this->input->post("description",true),
                    'contents' => $contents
                );
                
                $pageid = $this->input->post("id",true);
                    
                $result = $this->admin_model->update_pagecontents($userdata,$pageid);
                if($result){
                    sf( 'success_message', "Page contents details modified successfully" );
                    redirect("admin/leadspagecontents");
                }
                else {
                    sf('error_message', 'No modifications done');
                    redirect("admin/leadspagecontents");
                }
            }

            $this->gen_contents['details'] = $this->admin_model->get_pagecontent_details($id);
            $this->gen_contents['page_heading'] = 'Page Contents Modification';
            $this->template->set_template('admin');
            $this->template->write_view('content', 'admin/modifypagecontents', $this->gen_contents);
            $this->template->render();
              
        }
        else {
            redirect("admin/leadspagecontents");
        }
    }
    
    public function modifywebpages($id = 0){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        if($id != 0 && is_numeric($id)){
            
            $this->load->model('admin/admin_model');
            $this->form_validation->set_rules('link_name', 'Web page link name', 'required');
            $this->form_validation->set_rules('title', 'Web page title', 'required');
            $this->form_validation->set_rules('contents', 'Web page contents', 'required');
            $tbl_name = 'cc_web_pages';
            
            if($this->form_validation->run() == TRUE){  
            
                $content = '';
                $html_link = '';
                
                $html_link = $this->url_slug($this->input->post("link_url"));
                $html_link = $html_link.'.html';
                $content = str_replace("<img","<img class='img-responsive'",$this->input->post("contents")); 
                
                //$content = $this->input->post("contents");  
                $base_path = base_url(); 
                $contents = str_replace("../../../",$base_path,$content);
                $contents = str_replace("../../",$base_path,$content);
                $contents = str_replace("../",$base_path,$contents);
            
                $userdata = array(
                    'category' => $this->input->post("category",true),
                    'title'    => $this->input->post("title",true),
                    'contents' => $contents,
                    'status' => $this->input->post("status",true),
                    'meta_tags' => $this->input->post("meta_tags",true),
                    'meta_description' => $this->input->post("meta_description",true),
                    'link_name' => $this->input->post("link_name",true)     
                );
                //,'html_link' => $html_link
                $pageid = $this->input->post("pageid",true);
                    
                $result = $this->admin_model->update_webpages($userdata,$pageid,$tbl_name);
                if($result){
                    sf( 'success_message', "Web pages details modified successfully" );
                    redirect("admin/webpages");
                }
                else {
                    sf('error_message', 'No modifications done');
                    redirect("admin/webpages");
                }
            }

            $this->gen_contents['details'] = $this->admin_model->get_webpade_details($id,$tbl_name);
            $this->gen_contents['page_heading'] = 'Web Pages Modification';
            $this->template->set_template('admin');
            $this->template->write_view('content', 'admin/webpagemodofication', $this->gen_contents);
            $this->template->render();
              
        }
        else {
            redirect("admin/webpages");
        }
    }
    
    public function  deletewebpages ($pageid = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        if($pageid != 0 && is_numeric($pageid)){
            $this->load->model('admin/admin_model');
            $result = $this->admin_model->remove_webpage($pageid);
            if($result) {
                sf( 'success_message', "Web pages details deleted successfully" );
                redirect("admin/webpages");
            }
            else {
                sf( 'error_message', "Web pages details not deleted,Please try again" );
                redirect("admin/webpages");

            }
        }
        else {
            redirect("admin/webpages");
        }
    }
    
    public function  deletewebpageleads ($pageid = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        if($pageid != 0 && is_numeric($pageid)){
            $this->load->model('admin/admin_model');
            $result = $this->admin_model->remove_webpage_leads($pageid);
            if($result) {
                sf( 'success_message', "Web pages details deleted successfully" );
                redirect("admin/webpagesleads2sale");
            }
            else {
                sf( 'error_message', "Web pages details not deleted,Please try again" );
                redirect("admin/webpagesleads2sale");

            }
        }
        else {
            redirect("admin/webpagesleads2sale");
        }
    }
    
    public function  deletelandingpages ($pageid = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        if($pageid != 0 && is_numeric($pageid)){
            $this->load->model('admin/admin_model');
            
            $remove_carousal_images = $this->admin_model->remove_carousal_images($pageid);
            
            $userdata = array(
                'status' => 'Inactive'
            );
            $tbl_name = 'cc_landing_pages';
            $result = $this->admin_model->update_webpages($userdata,$pageid,$tbl_name);
            if($result) {
                sf( 'success_message', "Landing pages details deleted successfully" );
                redirect("admin/landingpages");
            }
            else {
                sf( 'error_message', "Landing pages details not deleted,Please try again" );
                redirect("admin/landingpages");

            }
        }
        else {
            redirect("admin/landingpages");
        }
    }
    
    // Landing pages 
    public function landingpages() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->model('admin/admin_model');
        $tblname = 'cc_landing_pages';
        $total_webpages = $this->admin_model->get_total_records($tblname); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   //bootstrap pagination styles
        $config['base_url']     = admin_url().'landingpages';
        $config['total_rows']   = $total_webpages;
        $config['per_page']     = 25;
        $bs_init = $this->bspagination->config();
        
        $config = array_merge($config, $bs_init);
        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        
        
        $this->gen_contents['details'] = $this->admin_model->get_landingpages_list($config['per_page'], $pagin);
        $this->gen_contents['page_heading'] = 'Landing Pages';
        
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/landingpagelist', $this->gen_contents);
        $this->template->render();
    }
    
     public function modifylandingpages($id = 0){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        if($id != 0 && is_numeric($id)){
            
            $this->load->model('admin/admin_model');
            $this->form_validation->set_rules('link_name', 'link name', 'required');
            $this->form_validation->set_rules('contents', 'Web page contents', 'required');
            $tbl_name = 'cc_landing_pages';
            
            if($this->form_validation->run() == TRUE){  
            
                $content = '';
                $content = str_replace("<img","<img class='img-responsive'",$this->input->post("contents")); 
                
                //$content = $this->input->post("contents");  
                $base_path = base_url(); 
                $contents = str_replace("../../../",$base_path,$content);
                $contents = str_replace("../../",$base_path,$content);
                $contents = str_replace("../",$base_path,$contents);
                
                if($this->input->post("has_carousal") == NULL)
                    $has_carousal = 0;
                else 
                    $has_carousal = $this->input->post("has_carousal",true);

                if($this->input->post("has_top_menu") == NULL)
                    $has_top_menu = 0;
                else 
                    $has_top_menu = $this->input->post("has_top_menu",true);

                if($this->input->post("has_footer_menu") == NULL)
                    $has_footer_menu = 0;
                else 
                    $has_footer_menu = $this->input->post("has_footer_menu",true);
            
                $userdata = array(
                    'link_name'  => $this->input->post("link_name",true),
                    'contents'  => $contents,
                    'status' => 'Active',
                    'has_carousal' => $has_carousal,
                    'has_top_menu' => $has_top_menu,
                    'has_footer_menu' => $has_footer_menu,
                    'meta_tags' => $this->input->post("meta_tags",true),
                    'meta_description' => $this->input->post("meta_description",true),
                    'link_name' => $this->input->post("link_name",true),
                    'status' => $this->input->post("status",true)
                );
                
                $pageid = $this->input->post("pageid",true);
                    
                $result = $this->admin_model->update_webpages($userdata,$pageid,$tbl_name);
                if($result){     
                    
                    //if ($_FILES['images']['name'][0] != '' || $_FILES['images']['name'][1] != '' || $_FILES['images']['name'][2] != '' || $_FILES['images']['name'][3] != '') {  
                        
                        $get_old_carousal_images_details = $this->admin_model->get_old_carousal_images_details($pageid);
                        
                        //$remove_old_images = $this->admin_model->remove_carousal_images($pageid);
                            
                        if($_FILES['images']['name'][0] ==  ''){
                            $_FILES['images']['name'][0] = $get_old_carousal_images_details[0]['image_path'];
                        }
                        if($_FILES['images']['name'][1] ==  '') {
                            $_FILES['images']['name'][1] = $get_old_carousal_images_details[1]['image_path'];
                        }
                        if($_FILES['images']['name'][2] ==  '') {
                            $_FILES['images']['name'][2] = $get_old_carousal_images_details[2]['image_path'];
                        }
                        if($_FILES['images']['name'][3] ==  '') {
                            $_FILES['images']['name'][3] = $get_old_carousal_images_details[3]['image_path'];
                        }    
                        
                        if($this->input->post("captions1") != '')
                            $caption1 = $this->input->post("captions1");
                        else 
                             $caption1 = '';  
                        if($this->input->post("captions2") != '')
                            $caption2 = $this->input->post("captions2");
                        else 
                             $caption2 = '';
                        if($this->input->post("captions3") != '')
                            $caption3 = $this->input->post("captions3");
                        else 
                             $caption3 = '';
                        if($this->input->post("captions4") != '')
                            $caption4 = $this->input->post("captions4");
                        else 
                             $caption4 = '';
                        
                        if($this->input->post("fontcolor1") != '')
                            $fontcolor1 = $this->input->post("fontcolor1");
                        else 
                             $fontcolor1 = '';
                        
                        if($this->input->post("fontcolor2") != '')
                            $fontcolor2 = $this->input->post("fontcolor2");
                        else 
                             $fontcolor2 = '';
                        
                        if($this->input->post("fontcolor3") != '')
                            $fontcolor3 = $this->input->post("fontcolor3");
                        else 
                             $fontcolor3 = '';
                        
                        if($this->input->post("fontcolor4") != '')
                            $fontcolor4 = $this->input->post("fontcolor4");
                        else 
                             $fontcolor4 = '';
                        
                        if($this->input->post("fontsize1") != '')
                            $fontsize1 = $this->input->post("fontsize1");
                        else 
                             $fontsize1 = '';
                        
                        if($this->input->post("fontsize2") != '')
                            $fontsize2 = $this->input->post("fontsize2");
                        else 
                             $fontsize2 = '';
                        
                        if($this->input->post("fontsize3") != '')
                            $fontsize3 = $this->input->post("fontsize3");
                        else 
                             $fontsize3 = '';
                        
                        if($this->input->post("fontsize4") != '')
                            $fontsize4 = $this->input->post("fontsize4");
                        else 
                             $fontsize4 = '';
                        
                        $fontsize = array();
                        $fontsize[] = $fontsize1;
                        $fontsize[] = $fontsize2;
                        $fontsize[] = $fontsize3;
                        $fontsize[] = $fontsize4;
                        
                        
                        $fontcolor = array();
                        $fontcolor[] = $fontcolor1;
                        $fontcolor[] = $fontcolor2;
                        $fontcolor[] = $fontcolor3;
                        $fontcolor[] = $fontcolor4;
                        
                        $caption = array();
                        $caption[] = $caption1;
                        $caption[] = $caption2;
                        $caption[] = $caption3;
                        $caption[] = $caption4;
                        
                        
                        $remove_old_images = $this->admin_model->remove_carousal_images($pageid);
                        
                        if ($this->upload_files_modify($pageid, $_FILES['images'],$caption,$fontcolor,$fontsize) === FALSE) {  
                            $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                        }
                    //} 
                    sf( 'success_message', "Landing pages details modified successfully" );
                    redirect("admin/landingpages");
                }
                else {
                    sf('error_message', 'No modifications done');
                    redirect("admin/landingpages");
                }
            }

            $this->gen_contents['details'] = $this->admin_model->get_webpade_details($id,$tbl_name);
            $this->gen_contents['carousal_details'] = $this->admin_model->get_carousal_details($id);
            $this->gen_contents['page_heading'] = 'Landing Pages Modification';
            $this->template->set_template('admin');
            $this->template->write_view('content', 'admin/landingpagemodofication', $this->gen_contents);
            $this->template->render();
              
        }
        else {
            redirect("admin/landingpages");
        }
    }
    
    private function upload_files_modify($pageid, $files,$caption,$fontcolor,$fontsize)
    {                                     
        $this->load->model('admin/admin_model');
        $config = array(
            'upload_path'   => './assets/images/landing_pages/',
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => 1,                       
        );
        $this->load->library('upload', $config);
        $images = array(); 

            foreach ($files['name'] as $key => $image) {   
                $_FILES['images[]']['name']= $files['name'][$key];
                $_FILES['images[]']['type']= $files['type'][$key];
                $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
                $_FILES['images[]']['error']= $files['error'][$key];
                $_FILES['images[]']['size']= $files['size'][$key];

                $fileName =  $image; 
                $caption_value = $caption[$key];  
               
                $fontcolor_value = $fontcolor[$key]; 
                
                $fontsize_value = $fontsize[$key]; 
                
                $userdata = array(
                    "image_path" => $fileName,
                    "captions" => $caption_value,
                    "fontcolor" => $fontcolor_value,
                    "fontsize" => $fontsize_value,
                    "pageid" => $pageid
                ); 
                if($fileName != '')
                    $result = $this->admin_model->save_carousal_images($userdata);

                $images[] = $fileName;

                $config['file_name'] = $fileName;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('images[]')) {
                    $this->upload->data();
                    
                    $this->load->library('image_lib');
                    $config_thumb['image_library'] = 'gd2';
                    $config_thumb['source_image'] = './assets/images/landing_pages/'.$fileName;
                    $config_thumb['maintain_ratio'] = TRUE;
                    $config_thumb['quality'] = "100%";
                    $config_thumb['width'] = 1920;
                    $config_thumb['height'] = 520;

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config_thumb);
                    $this->image_lib->resize();
                }     
            }        
            return $images;
    }
    
    public function addlandingpages (){  
        
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->model('admin/admin_model');
        $this->form_validation->set_rules('link_name', 'link name', 'required');
        $this->form_validation->set_rules('contents', 'Web page contents', 'required');
        
        if($this->form_validation->run() == TRUE){  
            
            $html_link = '';
            $content = '';
            $html_link = $this->url_slug($this->input->post("link_name"));
            $html_link = $html_link.'.html';
            $content = str_replace("<img","<img class='img-responsive'",$this->input->post("contents")); 
            
            //$content = $this->input->post("contents");  
            $base_path = base_url(); 
            $contents = str_replace("../../../",$base_path,$content);
            $contents = str_replace("../../",$base_path,$content);
            $contents = str_replace("../",$base_path,$contents);
            
            if($this->input->post("has_carousal") == NULL)
                $has_carousal = 0;
            else 
                $has_carousal = $this->input->post("has_carousal",true);
            
            if($this->input->post("has_top_menu") == NULL)
                $has_top_menu = 0;
            else 
                $has_top_menu = $this->input->post("has_top_menu",true);
            
            if($this->input->post("has_footer_menu") == NULL)
                $has_footer_menu = 0;
            else 
                $has_footer_menu = $this->input->post("has_footer_menu",true);
            
            $userdata = array(
                'link_name'  => $this->input->post("link_name",true),
                'contents'  => $contents,
                'html_link' => $html_link,
                'status' => 'Active',
                'has_carousal' => $has_carousal,
                'has_top_menu' => $has_top_menu,
                'has_footer_menu' => $has_footer_menu,
                'meta_tags' => $this->input->post("meta_tags",true),
                'meta_description' => $this->input->post("meta_description",true),
                'link_name' => $this->input->post("link_name",true)
            );
            $pageid =  $this->admin_model->save_landingpage_images($userdata);
            
            if (!empty($_FILES['images']['name'][0])) {
                if ($this->upload_files($pageid, $_FILES['images']) === FALSE) {
                    $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                }
            } 
            redirect("admin/landingpages");
        }
        
        $condition = 'Default';
        $this->gen_contents['default'] = $this->admin_model->get_default_landingpage_values($condition); 
        $this->gen_contents['page_heading'] = 'Landing Page Creation';
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/landingpagecreation', $this->gen_contents);
        $this->template->render();
        
    }
    
    private function upload_files($pageid, $files)
    {                                           //p($files); exit;
        $this->load->model('admin/admin_model');
        $config = array(
            'upload_path'   => './assets/images/landing_pages/',
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => 1,                       
        );
        $this->load->library('upload', $config);
        $images = array(); 

            foreach ($files['name'] as $key => $image) {   
                $_FILES['images[]']['name']= $files['name'][$key];
                $_FILES['images[]']['type']= $files['type'][$key];
                $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
                $_FILES['images[]']['error']= $files['error'][$key];
                $_FILES['images[]']['size']= $files['size'][$key];

                $fileName =  $image;    
                $caption =   $this->input->post("captions");
                $caption_value = $caption[$key]; 
                
                $fontcolor =   $this->input->post("fontcolor");
                $fontcolor_value = $fontcolor[$key]; 
                
                $fontsize =   $this->input->post("fontsize");
                $fontsize_value = $fontsize[$key]; 
                
                //$position =   $this->input->post("position");
                //$position_value = $position[$key]; 
                
                $userdata = array(
                    "image_path" => $fileName,
                    "captions" => $caption_value,
                    "fontcolor" => $fontcolor_value,
                    "fontsize" => $fontsize_value,
                    "pageid" => $pageid
                ); 
                if($fileName != '')
                    $result = $this->admin_model->save_carousal_images($userdata);

                $images[] = $fileName;

                $config['file_name'] = $fileName;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('images[]')) {
                    $this->upload->data();
                    
                    $this->load->library('image_lib');
                    $config_thumb['image_library'] = 'gd2';
                    $config_thumb['source_image'] = './assets/images/landing_pages/'.$fileName;
                    $config_thumb['maintain_ratio'] = TRUE;
                    $config_thumb['quality'] = "100%";
                    $config_thumb['width'] = 1920;
                    $config_thumb['height'] = 520;

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config_thumb);
                    $this->image_lib->resize();
                }     
            }        
            return $images;
    }

    public function enquiries() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->model('admin/admin_model');
        
        $config['per_page']     = 25;
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $userdata = array(
           'admin_view_status' => '0'
        );
        $tblname = 'cc_enquiries';
        $clear_notifications = $this->admin_model->clear_notifications($tblname,$userdata);
        
        if($this->input->post("name_search") != '')
            $name_search = trim($this->input->post("name_search",true));
        else 
            $name_search = '';
        if($this->input->post("fromdate_search") != '')
            $fromdate_search = $this->input->post("fromdate_search",true);
        else 
            $fromdate_search = '';
        if($this->input->post("todate_search") != '')
            $todate_search = $this->input->post("todate_search",true);
        else 
            $todate_search = '';
        
        $this->gen_contents['details'] = $this->admin_model->get_enquiries_list($config['per_page'], $pagin,$name_search,$fromdate_search,$todate_search);
        
        $total_enquiries = $this->admin_model->get_total_rows(); 
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'enquiries';
        $config['total_rows']   = $total_enquiries;
        $bs_init = $this->bspagination->config();      
        $config = array_merge($config, $bs_init);      
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        
        $this->gen_contents['page_heading'] = 'Enquiries';      
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/enquirieslist', $this->gen_contents);
        $this->template->render();
    }
    
    public function enquiries_leadsales() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->model('admin/admin_model');
        
        $config['per_page']     = 25;
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $userdata = array(
           'admin_view_status' => '0'
        );
        $tblname = 'ls_enquiries';
        $clear_notifications = $this->admin_model->clear_notifications($tblname,$userdata);
        
        if($this->input->post("name_search") != '')
            $name_search = $this->input->post("name_search",true);
        else 
            $name_search = '';
        if($this->input->post("fromdate_search") != '')
            $fromdate_search = $this->input->post("fromdate_search",true);
        else 
            $fromdate_search = '';
        if($this->input->post("todate_search") != '')
            $todate_search = $this->input->post("todate_search",true);
        else 
            $todate_search = '';
        
        $this->gen_contents['details'] = $this->admin_model->get_enquiries_list_leadsales($config['per_page'], $pagin,$name_search,$fromdate_search,$todate_search);
        
        $total_records = $this->admin_model->get_total_rows(); 
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'enquiries_leadsales';
        $config['total_rows']   = $total_records;
        $bs_init = $this->bspagination->config();       
        $config = array_merge($config, $bs_init);       
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        
        $this->gen_contents['page_heading'] = 'Enquiries';      
        $this->template->set_template('admin');  
        $this->template->write_view('content', 'admin/enquiriesleadsaleslist', $this->gen_contents);
        $this->template->render();
    }
    
    public function supplierrequests() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->model('admin/admin_model');
        
        $config['per_page']     = 25;
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $userdata = array(
           'admin_view_status' => '0'
        );
        if($this->input->post("name_search") != '')
            $name_search = $this->input->post("name_search",true);
        else 
            $name_search = '';
        if($this->input->post("fromdate_search") != '')
            $fromdate_search = $this->input->post("fromdate_search",true);
        else 
            $fromdate_search = '';
        if($this->input->post("todate_search") != '')
            $todate_search = $this->input->post("todate_search",true);
        else 
            $todate_search = ''; 
        
        $tblname = 'cc_suppliers';
        $clear_notifications = $this->admin_model->clear_notifications($tblname,$userdata);
        $this->gen_contents['details'] = $this->admin_model->get_supplierrequests_list($config['per_page'], $pagin,$name_search,$fromdate_search,$todate_search);
        
        $total_supplierrequests = $this->admin_model->get_total_rows(); 
        $this->load->library('pagination');
        $this->load->library('bspagination'); 
        $config['base_url']     = admin_url().'supplierrequests';
        $config['total_rows']   = $total_supplierrequests;
        $bs_init = $this->bspagination->config();       
        $config = array_merge($config, $bs_init);      
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();        
        
        $this->gen_contents['page_heading'] = 'Supplier Requests';      
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/supplierrequests', $this->gen_contents);
        $this->template->render(); 
    }
    
    // Sell your copier report
    public function sellyourcopier() {
        
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->model('admin/admin_model');
        
       if($this->input->post("record_page_limit")){
            $this->session->set_userdata('page_limit', $this->input->post("record_page_limit"));
            $config['per_page']   = s('page_limit');   
        }
        else if(NULL != s('page_limit')){
            $config['per_page']   = s('page_limit');
        }  
        else {
             $config['per_page']   = 25;
        }
        
        $this->gen_contents['per_page'] = $config['per_page'];
        
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        if($this->input->post("name_search") != '')
            $name_search = trim($this->input->post("name_search"));
        else 
            $name_search = '';
        if($this->input->post("city_suburb_search") != '')
            $city_suburb_search = $this->input->post("city_suburb_search");
        else 
            $city_suburb_search = '';
        if($this->input->post("email_search") != '')
            $email_search = trim($this->input->post("email_search"));
        else 
            $email_search = '';
        if($this->input->post("fromdate_search") != '')
            $fromdate_search = $this->input->post("fromdate_search",true);
        else 
            $fromdate_search = '';
        if($this->input->post("todate_search") != '')
            $todate_search = $this->input->post("todate_search",true);
        else 
            $todate_search = '';
        
        $this->gen_contents['details'] = $this->admin_model->get_sellcopoerlist_list($config['per_page'], $pagin,$name_search,$city_suburb_search,$email_search,$fromdate_search,$todate_search);
       
        $total_sellcopier = $this->admin_model->get_total_rows(); 
        $this->load->library('pagination');
        $this->load->library('bspagination');  
        $config['base_url']     = admin_url().'sellyourcopier';
        $config['total_rows']   = $total_sellcopier;
        $bs_init = $this->bspagination->config();        
        $config = array_merge($config, $bs_init);       
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        
         $this->gen_contents['page_heading'] = 'Sell Your Copier';        
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/sellyourcopier', $this->gen_contents);
        $this->template->render(); 
    }
    
    // Pre registation list report 
    public function preregistrationlist() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        if($this->input->post("record_page_limit")){
            $this->session->set_userdata('page_limit', $this->input->post("record_page_limit"));
            $config['per_page']   = s('page_limit');   
        }
        else if(NULL != s('page_limit')){
            $config['per_page']   = s('page_limit');
        }  
        else {
             $config['per_page']   = 25;
        } 
        
        $this->gen_contents['per_page'] = $config['per_page'];
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        if($this->input->post("name_search") != '')
            $name_search = trim($this->input->post("name_search",true));
        else 
            $name_search = '';
        if($this->input->post("industry_search") != '')
            $industry_search = trim($this->input->post("industry_search",true));
        else 
            $industry_search = '';
        if($this->input->post("email") != '')
            $email = trim($this->input->post("email",true));
        else 
            $email = '';
        if($this->input->post("city_suburb_search") != '')
            $city_suburb_search = $this->input->post("city_suburb_search",true);
        else 
            $city_suburb_search = '';
        
        $this->gen_contents['details'] = $this->admin_model->get_preregistration_list($config['per_page'], $pagin,$name_search,$email,$city_suburb_search,$industry_search);
       
        $total_records = $this->admin_model->get_total_rows(); 
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'preregistrationlist';
        $config['total_rows']   = $total_records;
        $bs_init = $this->bspagination->config();        
        $config = array_merge($config, $bs_init);        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        
         $this->gen_contents['page_heading'] = 'Pre Registration';        
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/preregistrationlist', $this->gen_contents);
        $this->template->render(); 
    }
    
    // Credict history report 
    public function credithistory () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        
        if($this->input->post("record_page_limit")){
            $this->session->set_userdata('page_limit', $this->input->post("record_page_limit"));
            $config['per_page']   = s('page_limit');   
        }
        else if(NULL != s('page_limit')){
            $config['per_page']   = s('page_limit');
        }  
        else {
             $config['per_page']   = 25;
        } 
        
        $this->gen_contents['per_page'] = $config['per_page'];
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        if($this->input->post("supplier_search") != '')
            $search_data = $this->input->post("supplier_search",true);
        else 
            $search_data = '';
        if($this->input->post("supplier_id_search") != '')
            $supplier_id_search = $this->input->post("supplier_id_search",true);
        else 
            $supplier_id_search = '';
        if($this->input->post("amount_search") != '')
            $amount_search = $this->input->post("amount_search",true);
        else 
            $amount_search = '';
        if($this->input->post("status_search") != '')
            $status_search = $this->input->post("status_search",true);
        else 
            $status_search = '';
        if($this->input->post("fromdate_search") != '')
            $fromdate_search = $this->input->post("fromdate_search",true);
        else 
            $fromdate_search = '';
        if($this->input->post("todate_search") != '')
            $todate_search = $this->input->post("todate_search",true);
        else 
            $todate_search = '';
        
        $this->gen_contents['details'] = $this->admin_model->get_credithistory_list($config['per_page'], $pagin,$search_data,$status_search,$fromdate_search,$todate_search,$amount_search,$supplier_id_search);
        
        $total_records = $this->admin_model->get_total_rows(); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'credithistory';
        $config['total_rows']   = $total_records;
        $bs_init = $this->bspagination->config();
        $config = array_merge($config, $bs_init);       
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links(); 
        
        $this->gen_contents['page_heading'] = 'Sales Report';       
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/credithistorylist', $this->gen_contents);
        $this->template->render(); 
    }
    
    // Payment reports
    public function paymentreports () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        $tblname = 'transactions';
        
        if($this->input->post("record_page_limit")){
            $this->session->set_userdata('page_limit', $this->input->post("record_page_limit"));
            $config['per_page']   = s('page_limit');   
        }
        else if(NULL != s('page_limit')){
            $config['per_page']   = s('page_limit');
        }  
        else {
             $config['per_page']   = 25;
        }
        
        $this->gen_contents['per_page'] = $config['per_page'];
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        if($this->input->post("supplier_search") != '')
            $search_data = $this->input->post("supplier_search",true);
        else 
            $search_data = '';
        if($this->input->post("status_search") != '')
            $status_search = $this->input->post("status_search",true);
        else 
            $status_search = '';
        if($this->input->post("fromdate_search") != '')
            $fromdate_search = $this->input->post("fromdate_search",true);
        else 
            $fromdate_search = '';
        if($this->input->post("todate_search") != '')
            $todate_search = $this->input->post("todate_search",true);
        else 
            $todate_search = '';
        
        $this->gen_contents['details'] = $this->admin_model->get_transaction_list($config['per_page'], $pagin,$search_data,$status_search,$fromdate_search,$todate_search);
        
        $total_records = $this->admin_model->get_total_rows(); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'paymentreports';
        $config['total_rows']   = $total_records;
        $bs_init = $this->bspagination->config();
        $config = array_merge($config, $bs_init);        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
       
        $this->gen_contents['page_heading'] = 'Transaction Report';        
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/paymentreportlist', $this->gen_contents);
        $this->template->render(); 
    }
    
    // Feedback report
    public function managerefund () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        
        $config['per_page']     = 25;
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        if($this->input->post("seller_search") != '')
            $seller_search = $this->input->post("seller_search",true);
        else 
            $seller_search = '';
        if($this->input->post("starlevel_search") != '')
            $starlevel_search = $this->input->post("starlevel_search",true);
        else 
            $starlevel_search = '';
        if($this->input->post("status_search") != '')
            $status_search = $this->input->post("status_search",true);
        else 
            $status_search = '';
        if($this->input->post("fromdate_search") != '')
            $fromdate_search = $this->input->post("fromdate_search",true);
        else 
            $fromdate_search = '';
        if($this->input->post("todate_search") != '')
            $todate_search = $this->input->post("todate_search",true);
        else 
            $todate_search = ''; 
        if($this->input->post("leadid_search") != '')
            $leadid_search = $this->input->post("leadid_search",true);
        else 
            $leadid_search = ''; 
        
        $this->gen_contents['details'] = $this->admin_model->get_refund_list($config['per_page'], $pagin,$seller_search,$starlevel_search,$status_search,$fromdate_search,$todate_search,$leadid_search); 
        
        $total_records = $this->admin_model->get_total_rows();
        
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'managerefund';
        $config['total_rows']   = $total_records;
        $bs_init = $this->bspagination->config();       
        $config = array_merge($config, $bs_init);       
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();         
        
        $this->gen_contents['page_heading'] = 'Manage Refund';        
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/managerefundlist', $this->gen_contents);
        $this->template->render(); 
    }
    
    public function feedbackreports () { 
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        if($this->input->post("record_page_limit")){
            $this->session->set_userdata('page_limit', $this->input->post("record_page_limit"));
            $config['per_page']   = s('page_limit');   
        }
        else if(NULL != s('page_limit')){
            $config['per_page']   = s('page_limit');
        }  
        else {
             $config['per_page']   = 25;
        } 
        
        $this->gen_contents['per_page'] = $config['per_page'];     
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        if($this->input->post("seller_search") != '')
            $seller_search = $this->input->post("seller_search",true);
        else 
            $seller_search = '';
        if($this->input->post("starlevel_search") != '')
            $starlevel_search = $this->input->post("starlevel_search",true);
        else 
            $starlevel_search = '';
        if($this->input->post("status_search") != '')
            $status_search = $this->input->post("status_search",true);
        else 
            $status_search = '';
        if($this->input->post("fromdate_search") != '')
            $fromdate_search = $this->input->post("fromdate_search",true);
        else 
            $fromdate_search = '';
        if($this->input->post("todate_search") != '')
            $todate_search = $this->input->post("todate_search",true);
        else 
            $todate_search = ''; 
        if($this->input->post("leadid_search") != '')
            $leadid_search = trim($this->input->post("leadid_search",true));
        else 
            $leadid_search = ''; 
        
        $this->gen_contents['details'] = $this->admin_model->get_feedback_list($config['per_page'], $pagin,$seller_search,$starlevel_search,$status_search,$fromdate_search,$todate_search,$leadid_search); 
        
        $total_records = $this->admin_model->get_total_rows();
        
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'feedbackreports';
        $config['total_rows']   = $total_records;
        $bs_init = $this->bspagination->config();       
        $config = array_merge($config, $bs_init);       
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();         
        
        $this->gen_contents['page_heading'] = 'Feedback Report';        
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/feedbackreport', $this->gen_contents);
        $this->template->render(); 
    }
    
    //Lead match history report
    public function leadmatchhistory () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        
       if($this->input->post("record_page_limit")){
            $this->session->set_userdata('page_limit', $this->input->post("record_page_limit"));
            $config['per_page']   = s('page_limit');   
        }
        else if(NULL != s('page_limit')){
            $config['per_page']   = s('page_limit');
        }  
        else {
             $config['per_page']   = 25;
        } 
        
        $this->gen_contents['per_page'] = $config['per_page'];
        
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        if($this->input->post("supplier_search") != '')
            $supplier_search = $this->input->post("supplier_search",true);
        else 
            $supplier_search = '';
        if($this->input->post("fromdate_search") != '')
            $fromdate_search = $this->input->post("fromdate_search",true);
        else 
            $fromdate_search = '';
        if($this->input->post("todate_search") != '')
            $todate_search = $this->input->post("todate_search",true);
        else 
            $todate_search = '';
        
        $this->gen_contents['details'] = $this->admin_model->get_leadmatch_list($config['per_page'], $pagin,$supplier_search,$fromdate_search,$todate_search); 
        //p($this->gen_contents['details']); exit;
        $total_records = $this->admin_model->get_total_rows();  
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'leadmatchhistory';
        $config['total_rows']   = $total_records;
        $bs_init = $this->bspagination->config();        
        $config = array_merge($config, $bs_init);       
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();           
        
        $this->gen_contents['page_heading'] = 'Lead Match History';        
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/leadmatchhistorylist', $this->gen_contents);
        $this->template->render(); 
    }
    
    // Drop out leads reports
    public function dropoutleads () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        $tblname = 'leads_details';
        
       if($this->input->post("record_page_limit")){
            $this->session->set_userdata('page_limit', $this->input->post("record_page_limit"));
            $config['per_page']   = s('page_limit');   
        }
        else if(NULL != s('page_limit')){
            $config['per_page']   = s('page_limit');
        }  
        else {
             $config['per_page']   = 25;
        }
        
        $this->gen_contents['per_page'] = $config['per_page'];
        
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        if($this->input->post("leadname_search") != '')
            $leadname_search = $this->input->post("leadname_search",true);
        else 
            $leadname_search = '';
        if($this->input->post("leadname_email") != '')
            $leadname_email = $this->input->post("leadname_email",true);
        else 
            $leadname_email = '';
        if($this->input->post("starlevel_search") != '')
            $starlevel_search = $this->input->post("starlevel_search",true);
        else 
            $starlevel_search = '';
        if($this->input->post("city_suburb_search") != '')
            $city_suburb_search = $this->input->post("city_suburb_search",true);
        else 
            $city_suburb_search = '';
        
        if($this->input->post("fromdate_search") != '')
            $fromdate_search = $this->input->post("fromdate_search",true);
        else 
            $fromdate_search = '';
        if($this->input->post("todate_search") != '')
            $todate_search = $this->input->post("todate_search",true);
        else 
            $todate_search = '';
        
        $this->gen_contents['details'] = $this->admin_model->get_dropoutlead_list($config['per_page'], $pagin,$leadname_search,$leadname_email,$starlevel_search,$city_suburb_search,$fromdate_search,$todate_search); 
       
        $total_records = $this->admin_model->get_total_rows(); 
        
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'dropoutleads';
        $config['total_rows']   = $total_records;
        $bs_init = $this->bspagination->config();
        
        $config = array_merge($config, $bs_init);  
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();        
        
         $this->gen_contents['page_heading'] = 'Drop-Out Leads';
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/dropoutleadlist', $this->gen_contents);
        $this->template->render(); 
    }
    
    // Rotating banner report
    public function rotatingbannerreport (){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        
        $config['per_page']     = 25;
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        if($this->input->post("name_search") != '') 
            $name_search = $this->input->post("name_search",true);
        else 
            $name_search = '';
        
        if($this->input->post("status_search") != '')
            $status_search = $this->input->post("status_search",true);
        else 
            $status_search = '';
        
        $this->gen_contents['details'] = $this->admin_model->get_rotatingbanner_list($config['per_page'], $pagin,$name_search,$status_search); 
       
        $total_records = $this->admin_model->get_total_rows();
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'rotatingbannerreport';
        $config['total_rows']   = $total_records;
        $bs_init = $this->bspagination->config();      
        $config = array_merge($config, $bs_init);       
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();              
        
        $this->gen_contents['page_heading'] = 'Rotating Banner Report';        
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/rotatingbannerreport', $this->gen_contents);
        $this->template->render(); 
    }

    // Webpage Leads2sale modifications
    public function addwebpagesleads2sale () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->load->model('admin/admin_model');
        $this->form_validation->set_rules('link_name', 'Web page link name', 'required');
        $this->form_validation->set_rules('title', 'Web page title', 'required');
        $this->form_validation->set_rules('contents', 'Web page contents', 'required');
        
        if($this->form_validation->run() == TRUE){  
            
            $html_link = '';
            $content = '';
            $html_link = $this->url_slug($this->input->post("link_name"));
            $html_link = $html_link.'.html';
            $content = str_replace("<img","<img class='img-responsive'",$this->input->post("contents")); 
            
            //$content = $this->input->post("contents");  
            $base_path = base_url(); 
            $contents = str_replace("../../../",$base_path,$content);
            $contents = str_replace("../../",$base_path,$content);
            $contents = str_replace("../",$base_path,$contents);
            
            //$contents = str_replace("./",$base_path,$content);
             
            
            $userdata = array(
                'title'    => $this->input->post("title",true),
                'contents' => $contents,
                'html_link' => $html_link,
                'status' => $this->input->post("status",true),
                'meta_tags' => $this->input->post("meta_tags",true),
                'meta_description' => $this->input->post("meta_description",true),
                'link_name' => $this->input->post("link_name",true),
                'quick_link' => $this->input->post("quick_link",true),
                'link_path' => 'pages/'
            );
             
            $tbl_name = 'ls_web_pages';
            $result = $this->admin_model->insert_webpages($userdata,$tbl_name);
            if($result){
                sf( 'success_message', "Web pages details inserted successfully" );
                redirect("admin/webpagesleads2sale");
            }
            else {
                sf('error_message', 'Web pages details not inserted');
                redirect("admin/webpagesleads2sale");
            }    
        }
        
        
        $this->gen_contents['page_heading'] = 'Web Pages Creation';
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/webpagecreationleads2sale', $this->gen_contents);
        $this->template->render();
    }
    
    public function modifywebpagesleads2sale($id = 0){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            
            $this->load->model('admin/admin_model');
            $this->form_validation->set_rules('link_name', 'Web page link name', 'required');
            $this->form_validation->set_rules('title', 'Web page title', 'required');
            $this->form_validation->set_rules('contents', 'Web page contents', 'required');
            $tbl_name = 'ls_web_pages';
            
            if($this->form_validation->run() == TRUE){  
            
                $content = '';
                $content = str_replace("<img","<img class='img-responsive'",$this->input->post("contents")); 
                  
                $base_path = base_url(); 
                $contents = str_replace("../../../",$base_path,$content); 
                $contents = str_replace("../../",$base_path,$content); 
                $contents = str_replace("../",$base_path,$contents);
            
                $userdata = array(
                    'title'    => $this->input->post("title",true),
                    'contents' => $contents,
                    'status' => $this->input->post("status",true),
                    'meta_tags' => $this->input->post("meta_tags",true),
                    'meta_description' => $this->input->post("meta_description",true),
                    'link_name' => $this->input->post("link_name",true),
                    'quick_link' => $this->input->post("quick_link",true),
                );
                
                $pageid = $this->input->post("pageid",true);
                
                $result = $this->admin_model->update_webpages($userdata,$pageid,$tbl_name);
                if($result){
                    sf( 'success_message', "Web pages details modified successfully" );
                    redirect("admin/webpagesleads2sale");
                }
                else {
                    sf('error_message', 'No modifications done');
                    redirect("admin/webpagesleads2sale");
                }
            }

            $this->gen_contents['details'] = $this->admin_model->get_webpade_details($id,$tbl_name);
            $this->gen_contents['page_heading'] = 'Web Pages Modification';
            $this->template->set_template('admin');
            $this->template->write_view('content', 'admin/webpagemodifyleads2sale', $this->gen_contents);
            $this->template->render();
              
        }
        else {
            redirect("admin/webpagesleads2sale");
        }
    }
    
    // Web pages leads2sale content management page 
    public function webpagesleads2sale () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        
        $config['per_page']     = 25;
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        if($this->input->post("html_name_search") != '')
            $html_name_search = trim($this->input->post("html_name_search",true));
        else 
            $html_name_search = '';
        if($this->input->post("title_search") != '')
            $title_search = trim($this->input->post("title_search",true));
        else 
            $title_search = '';
        if($this->input->post("status_search") != '')
            $status_search = $this->input->post("status_search",true);
        else 
            $status_search = '';
        
        $this->gen_contents['details'] = $this->admin_model->get_webpage_list_lead2sale($config['per_page'], $pagin,$html_name_search,$title_search,$status_search);
        
        $total_webpages = $this->admin_model->get_total_rows(); 
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'webpagesleads2sale';
        $config['total_rows']   = $total_webpages;
        $bs_init = $this->bspagination->config();        
        $config = array_merge($config, $bs_init);       
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();
        
        $this->gen_contents['page_heading'] = 'Web Pages Leads2sales'; 
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/webpagelistleads2sale', $this->gen_contents);
        $this->template->render();
    }
    
    public function managebuyerguide() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        $tblname = 'cc_buyer_guide';
        $total_records = $this->admin_model->get_total_records($tblname); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'managebuyerguide';
        $config['total_rows']   = $total_records;
        $config['per_page']     = 25;
        $bs_init = $this->bspagination->config();
        
        $config = array_merge($config, $bs_init);
        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $this->gen_contents['details'] = $this->admin_model->get_buyerguide_list($config['per_page'], $pagin);
        $this->gen_contents['page_heading'] = 'Manage Buyer Guide';
        
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/buyerguidelist', $this->gen_contents);
        $this->template->render(); 
    }
    
    public function buyerguidecreation (){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->form_validation->set_rules('guide_name', 'Buyer guide name', 'required');
        $this->form_validation->set_rules('year', 'Year', 'required|numeric');
        if (empty($_FILES['guide']['name']))
            $this->form_validation->set_rules('guide', 'Document', 'required');
        
        $this->load->model('admin/admin_model');
        if($this->form_validation->run() == TRUE){    
            if (!empty($_FILES['guide']['name'])) {
                
                $config['upload_path']          = './assets/uploads/buyerguide/';  
                $config['allowed_types']        = 'gif|jpg|png|pdf';
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;

                $image_name = '';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('guide')){
                      $upload_detail = $this->upload->data();
                      $image_name = $upload_detail["file_name"];
                }
                else {
                    sf( 'error_message', "Error occured,file cannot uploaded" );
                    redirect("admin/manageproduct");
                }

                $userdata = array(
                    "guide_name"  => $this->input->post("guide_name",true),
                    "year"  => $this->input->post("year",true),
                    "file_path" => $image_name,
                );

                $result = $this->admin_model->buyerguide_creation($userdata);
                if($result) {
                    sf( 'success_message', "Buyer guide details inserted successfully" );
                    redirect("admin/managebuyerguide");
                }
                else {
                    sf( 'error_message', "Buyer guide details not inserted" );
                    redirect("admin/managebuyerguide");
                }
            }
            else 
            {
                sf( 'error_message', "Please upload a file" );
                redirect("admin/managebuyerguide");
            }
        }
        
        $this->gen_contents['page_heading'] = 'Manage Buyer guide';
        $this->template->set_template('admin');
        $this->template->write_view('content','admin/buyerguidecreation', $this->gen_contents);
        $this->template->render();
    }
    
    public function modifybuyerguide($id = 0){ 
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            
            $this->load->model('admin/admin_model');
            $this->form_validation->set_rules('guide_name', 'Buyer guide name', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required|numeric');
            $image_name = '';
            if($this->form_validation->run() == TRUE){ 
                if (!empty($_FILES['guide']['name'])) {

                    $config['upload_path']          = './assets/uploads/buyerguide/';  
                    $config['allowed_types']        = 'gif|jpg|png|pdf';
                    $config['max_size']             = 0;
                    $config['max_width']            = 0;
                    $config['max_height']           = 0;

                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('guide')){
                          $upload_detail = $this->upload->data();
                          $image_name = $upload_detail["file_name"];
                    }
                    else {
                        sf( 'error_message', "Error occured,file cannot uploaded" );
                        redirect("admin/managebuyerguide");
                    }
                }
                else {
                    $image_name = $this->input->post("old_filename",true);
                }
                $userdata = array(
                    "guide_name"  => $this->input->post("guide_name",true),
                    "year"  => $this->input->post("year",true),
                    "file_path" => $image_name,
                );
        
                $page_id  = $this->input->post("id",true);
                $result = $this->admin_model->buyerguide_modification($userdata,$page_id);
                if($result) {
                    sf( 'success_message', "Buyer guide details updated successfully" );
                    redirect("admin/managebuyerguide");
                }
                else {
                    sf( 'error_message', "No modification done" );
                    redirect("admin/managebuyerguide");
                }
            }
                
            $this->gen_contents['details'] = $this->admin_model->get_buyerguide_details($id);
            $this->gen_contents['page_heading'] = 'Manage Buyer Guide';
            $this->template->set_template('admin');
            $this->template->write_view('content', 'admin/buyerguidemodification', $this->gen_contents);
            $this->template->render();   
        }
        else {
            redirect("admin/managebuyerguide");
        }
    }
    
    public function deletebuyerguide($id = 0){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            $userdata = array(
                'status' => '0'
            );
            $result = $this->admin_model->buyerguide_modification($userdata,$id);
            if($result) {
                $tbl_name = 'cc_buyer_guide';
                $getimage = $this->admin_model->get_image_byid($id,$tbl_name);
                if($getimage)
                    unlink("assets/uploads/buyerguide/".$getimage['file_path']);
                sf( 'success_message', "Buyer guide details deleted successfully" );
                redirect("admin/managebuyerguide");
            }
            else {
                sf( 'error_message', "Buyer guide details not deleted,Please try again" );
                redirect("admin/managebuyerguide");
            }
        }
        else {
            redirect("admin/managebuyerguide");
        }
    }
    
    public function manageproduct() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        $tblname = 'cc_popular_products';
        $total_records = $this->admin_model->get_total_records($tblname); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'manageproduct';
        $config['total_rows']   = $total_records;
        $config['per_page']     = 25;
        $bs_init = $this->bspagination->config();
        
        $config = array_merge($config, $bs_init);
        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $this->gen_contents['details'] = $this->admin_model->get_popularproduct_list($config['per_page'], $pagin);
        $this->gen_contents['havetextarea'] = 'YES';
        $this->gen_contents['page_heading'] = 'Manage Popular Products';
        
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/productlist', $this->gen_contents);
        $this->template->render(); 
    }
    
    public function productcreation (){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->form_validation->set_rules('product_title', 'Product title', 'required');
        $this->form_validation->set_rules('cat_id', 'Product category', 'required');
        if (empty($_FILES['product_image']['name']))
            $this->form_validation->set_rules('product_image', 'Document', 'required');
        
        $this->load->model('admin/admin_model');
        if($this->form_validation->run() == TRUE){  
            
            if (!empty($_FILES['product_image']['name'])) {
                
                $config['upload_path']          = './assets/images/popularproducts/';  
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;

                $image_name = '';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('product_image')){
                      $upload_detail = $this->upload->data();
                      $image_name = $upload_detail["file_name"];
                }
                else {
                    sf( 'error_message', "Error occured,image cannot uploaded" );
                    redirect("admin/manageproduct");
                }
                $this->load->library('image_lib');
                $config_thumb['image_library'] = 'gd2';
                $config_thumb['source_image'] = './assets/images/popularproducts/'.$upload_detail["file_name"];
                $config_thumb['maintain_ratio'] = TRUE;
                $config_thumb['quality'] = "100%";
                $config_thumb['width'] = 300;
                $config_thumb['height'] = 190;

                $this->image_lib->clear();
                $this->image_lib->initialize($config_thumb);
                $this->image_lib->resize();
                
                $clean_url = $this->url_slug($this->input->post("product_title"));
                $clean_url = $clean_url.'.html';
            
                $userdata = array(
                    "product_title"  => $this->input->post("product_title",true),
                    "cat_id"  => $this->input->post("cat_id",true),
                    "product_details"  => $this->input->post("product_details",true),
                    "key_features"  => $this->input->post("key_features",true),
                    "status"  => $this->input->post("status",true),
                    "product_image" => $image_name,
                    "clean_url" => $clean_url
                );

                $result = $this->admin_model->product_creation($userdata);
                if($result) {
                    sf( 'success_message', "Popular product details inserted successfully" );
                    redirect("admin/manageproduct");
                }
                else {
                    sf( 'error_message', "Popular product details not inserted" );
                    redirect("admin/manageproduct");
                }
            }
            else 
            {
                sf( 'error_message', "Please upload an image" );
                redirect("admin/manageproduct");
            }
        }
        
        $this->gen_contents['category'] = $this->admin_model->get_categories(); 
        $this->gen_contents['page_heading'] = 'Manage Popular Products';
        $this->template->set_template('admin');
        $this->template->write_view('content','admin/productcreation', $this->gen_contents);
        $this->template->render();
    }
    
    public function modifyproduct($id = 0){   
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            
            $this->load->model('admin/admin_model');
            $this->form_validation->set_rules('product_title', 'Product title', 'required');
            $this->form_validation->set_rules('cat_id', 'Product category', 'required');
            $image_name = '';
            if($this->form_validation->run() == TRUE){ 
                if (!empty($_FILES['product_image']['name'])) {

                    $config['upload_path']          = './assets/images/popularproducts/';  
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 0;
                    $config['max_width']            = 0;
                    $config['max_height']           = 0;

                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('product_image')){
                          $upload_detail = $this->upload->data();
                          $image_name = $upload_detail["file_name"];
                    }
                    else {
                        sf( 'error_message', "Error occured,image cannot uploaded" );
                        redirect("admin/bannersettings");
                    }
                    $this->load->library('image_lib');
                    $config_thumb['image_library'] = 'gd2';
                    $config_thumb['source_image'] = './assets/images/popularproducts/'.$upload_detail["file_name"];
                    $config_thumb['maintain_ratio'] = TRUE;
                    $config_thumb['quality'] = "100%";
                    $config_thumb['width'] = 300;
                    $config_thumb['height'] = 190;

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config_thumb);
                    $this->image_lib->resize(); 
                }
                else {
                    $image_name = $this->input->post("old_imagename",true);
                }
                
                $clean_url = $this->url_slug($this->input->post("product_title"));
                $clean_url = $clean_url.'.html';
                
                $userdata = array(
                    "cat_id"  => $this->input->post("cat_id",true),
                    "product_title"   => $this->input->post("product_title",true),
                    "product_details" => $this->input->post("product_details",true),
                    "key_features"    => $this->input->post("key_features",true),
                    "product_image"   => $image_name,
                    "status"          => $this->input->post("status",true),
                    "clean_url"       => $clean_url
                );
                $page_id  = $this->input->post("pid",true);
                $result = $this->admin_model->product_modification($userdata,$page_id);
                if($result) {
                    sf( 'success_message', "Popular product details updated successfully" );
                    redirect("admin/manageproduct");
                }
                else {
                    sf( 'error_message', "No modification done" );
                    redirect("admin/manageproduct");
                }
            }
                
            $this->gen_contents['category'] = $this->admin_model->get_categories(); 
            $this->gen_contents['details'] = $this->admin_model->get_product_details($id);
            $this->gen_contents['page_heading'] = 'Manage Popular Products';
            $this->template->set_template('admin');
            $this->template->write_view('content', 'admin/productmodification', $this->gen_contents);
            $this->template->render();   
        }
        else {
            redirect("admin/manageproduct");
        }
    }
    
    public function deletecarousal_images($id = 0){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            
            $landingpage_details = $this->admin_model->get_pageid_bycarousalid($id);
            $page_id = $landingpage_details['pageid'];
            $result = $this->admin_model->deletecarousal_images_inedit($id);
            if($result) {
                $tbl_name = 'cc_landing_page_carousal_images';
                $getimage = $this->admin_model->get_image_byid($id,$tbl_name);
                if($getimage)
                    unlink("assets/images/landing_pages/".$getimage['image_path']);
                sf( 'success_message', "Image deleted successfully" );
                redirect("admin/modifylandingpages/".$page_id);
            }
            else {
                sf( 'error_message', "Image not deleted,Please try again" );
                redirect("admin/landingpages");
            }
        }
        else {
            redirect("admin/landingpages");
        }
    }
    
    public function deleteproduct($id = 0){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            /*$userdata = array(
                'status' => '0'
            ); */
            //$result = $this->admin_model->product_modification($userdata,$id);
            //if($result) {
                $tbl_name = 'cc_popular_products';
                $getimage = $this->admin_model->get_image_byid($id,$tbl_name);
                if($getimage){
                    unlink("assets/images/popularproducts/".$getimage['product_image']);
                $delete_popular_products = $this->admin_model->delete_popular_products($id);
                sf( 'success_message', "Popular product details deleted successfully" );
                redirect("admin/manageproduct");
            }
            else {
                sf( 'error_message', "Popular product details not deleted,Please try again" );
                redirect("admin/manageproduct");
            }
        }
        else {
            redirect("admin/manageproduct");
        }
    }
    
    public function articles() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        $tblname = 'cc_articles';
        $total_records = $this->admin_model->get_total_records($tblname); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'articles';
        $config['total_rows']   = $total_records;
        $config['per_page']     = 25;
        $bs_init = $this->bspagination->config();
        
        $config = array_merge($config, $bs_init);
        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
     
        $this->gen_contents['details'] = $this->admin_model->get_articles_list($config['per_page'], $pagin,$tblname);
        $this->gen_contents['page_heading'] = 'Manage Articles';
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/articleslist', $this->gen_contents);
        $this->template->render(); 
    }
    
    public function addarticles (){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        
        if($this->form_validation->run() == TRUE){             
            $image_name = '';
            if (!empty($_FILES['image']['name'])) {
                
                $config['upload_path']          = './assets/images/articles/';  
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;

                $image_name = '';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')){
                      $upload_detail = $this->upload->data();
                      $image_name = $upload_detail["file_name"];
                }
                else {
                    sf( 'error_message', "Error occured,image cannot uploaded" );
                    redirect("admin/articles");
                }
            }
            $clean_url = $this->url_slug($this->input->post("title"));
            $clean_url = $clean_url.'.html';
           
            $description = '';
            $description = str_replace("<img","<img class='img-responsive'",$this->input->post("description")); 
  
            $base_path = base_url(); 
            $descriptions = str_replace("../../../",$base_path,$description);
            $descriptions = str_replace("../../",$base_path,$description);
            $descriptions = str_replace("../",$base_path,$descriptions);
            
            
            $userdata = array(
                "title"  => $this->input->post("title",true),
                "description"  => $descriptions,
                "link"  => $this->input->post("link",true),
                "clean_url"  => $clean_url,
                'meta_tags' => $this->input->post("meta_tags",true),
                'meta_description' => $this->input->post("meta_description",true),
                "image"  => $image_name
            );

            $tbl_name = 'cc_articles';
            $result = $this->admin_model->banner_creation($userdata,$tbl_name);
            if($result) {
                sf( 'success_message', "Articles details inserted successfully" );
                redirect("admin/articles");
            }
            else {
                sf( 'error_message', "Articles details not inserted" );
                redirect("admin/articles");
            }
        }
         
        $this->gen_contents['page_heading'] = 'Manage Articles';
        $this->template->set_template('admin');
        $this->template->write_view('content','admin/articlescreation', $this->gen_contents);
        $this->template->render();
    }
    
    public function modifyarticles($id = 0){  
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        if($id != 0 && is_numeric($id)){
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $image_name = '';
            
            if($this->form_validation->run() == TRUE){ 
                $id      = $this->input->post("id",true);
                $tblname = 'cc_articles';
                if (!empty($_FILES['image']['name'])) {

                    $config['upload_path']          = './assets/images/articles/';  
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 0;
                    $config['max_width']            = 0;
                    $config['max_height']           = 0;

                    $image_name = '';
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('image')){
                          $upload_detail = $this->upload->data();
                          $image_name = $upload_detail["file_name"];
                    }
                    else {
                        sf( 'error_message', "Error occured,image cannot uploaded" );
                        redirect("admin/articles");
                    }
                }
                else {
                    $image_name = $this->input->post("old_imagename",true);
                }
                
                $clean_url = $this->url_slug($this->input->post("title"));
                $clean_url = $clean_url.'.html';
                
                $description = '';
                $description = str_replace("<img","<img class='img-responsive'",$this->input->post("description")); 

                $base_path = base_url(); 
                $descriptions = str_replace("../../../",$base_path,$description);
                $descriptions = str_replace("../../",$base_path,$description);
                $descriptions = str_replace("../",$base_path,$descriptions);
            
                $userdata = array(
                    "title"  => $this->input->post("title",true),
                    "description"  => $descriptions,
                    "link"  => $this->input->post("link",true),
                    "clean_url"  => $clean_url,
                    'meta_tags' => $this->input->post("meta_tags",true),
                    'meta_description' => $this->input->post("meta_description",true),
                    "image"  => $image_name
                );

                $result = $this->admin_model->banner_modification($userdata,$id,$tblname);
                if($result) {
                    sf( 'success_message', "Articles details updated successfully" );
                    redirect("admin/articles");
                }
                else {
                    sf( 'error_message', "No modification done" );
                    redirect("admin/articles");
                }
            }
            
            $tblname      = 'cc_articles';
            $this->gen_contents['details'] = $this->admin_model->get_banner_details($id,$tblname);
            $this->gen_contents['page_heading'] = 'Manage Articles';
            $this->template->set_template('admin');
            $this->template->write_view('content', 'admin/articlemodification', $this->gen_contents);
            $this->template->render();
        }
        else {
            redirect("admin/articles");
        }
    }
    
    public function leadscarousalsettings() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $tblname = 'ls_web_banners';
        $total_bannerlist = $this->admin_model->get_total_records($tblname); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'leadscarousalsettings';
        $config['total_rows']   = $total_bannerlist;
        $config['per_page']     = 25;
        $bs_init = $this->bspagination->config();
        
        $config = array_merge($config, $bs_init);
        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        
        
        $this->gen_contents['details'] = $this->admin_model->get_banner_list($config['per_page'], $pagin,$tblname);
        $this->gen_contents['page_heading'] = 'Manage Carousal  Banners';
        
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/leadscarousalsettings', $this->gen_contents);
        $this->template->render(); 
    }
    
    public function bannersettings() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        $tblname = 'cc_web_banners';
        $total_bannerlist = $this->admin_model->get_total_records($tblname); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'bannersettings';
        $config['total_rows']   = $total_bannerlist;
        $config['per_page']     = 25;
        $bs_init = $this->bspagination->config();
        
        $config = array_merge($config, $bs_init);
        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        
        
        $this->gen_contents['details'] = $this->admin_model->get_banner_list($config['per_page'], $pagin,$tblname);
        $this->gen_contents['page_heading'] = 'Manage Carousal  Banners';
        
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/bannersettinglist', $this->gen_contents);
        $this->template->render(); 
    }
    
    public function sellcopierbannersettings() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        $tblname = 'cc_sellcopier_banners';
        $total_bannerlist = $this->admin_model->get_total_records($tblname); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'sellcopierbannersettings';
        $config['total_rows']   = $total_bannerlist;
        $config['per_page']     = 25;
        $bs_init = $this->bspagination->config();
        
        $config = array_merge($config, $bs_init);
        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        
        
        $this->gen_contents['details'] = $this->admin_model->get_banner_list($config['per_page'], $pagin,$tblname);
        $this->gen_contents['page_heading'] = 'Banner Settings';
        
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/sellcopierbannersettinglist', $this->gen_contents);
        $this->template->render(); 
    }
    
    public function bannercreationleads (){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->form_validation->set_rules('banner_name', 'Banner name', 'required');
        $this->form_validation->set_rules('banner_order', 'Banner order', 'required|numeric');
        if (empty($_FILES['banner_image']['name']))
            $this->form_validation->set_rules('banner_image', 'Document', 'required');
        
        if($this->form_validation->run() == TRUE){  
            
            if (!empty($_FILES['banner_image']['name'])) {
                
                $tbl_name = 'ls_web_banners';
                $banner_order = $this->input->post("banner_order",true);
                $check_banner_order = $this->admin_model->check_banner_order($banner_order,$id = 0,$tbl_name);
                if($check_banner_order) {
                    $config['upload_path']          = './assets/images/banners/Leads2sale/';  
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 0;
                    $config['max_width']            = 0;
                    $config['max_height']           = 0;

                    $image_name = '';
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('banner_image')){
                          $upload_detail = $this->upload->data();
                          $image_name = $upload_detail["file_name"];
                    }
                    else {
                        sf( 'error_message', "Error occured,image cannot uploaded" );
                        redirect("admin/leadscarousalsettings");
                    }
                    $this->load->library('image_lib');
                    $config_thumb['image_library'] = 'gd2';
                    $config_thumb['source_image'] = './assets/images/banners/Leads2sale/'.$upload_detail["file_name"];
                    $config_thumb['maintain_ratio'] = TRUE;
                    $config_thumb['quality'] = "100%";
                    $config_thumb['width'] = 1920;
                    $config_thumb['height'] = 636;

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config_thumb);
                    $this->image_lib->resize();
                
                
                    $userdata = array(
                        "banner_name"  => $this->input->post("banner_name",true),
                        "banner_order" => $banner_order,
                        "banner_image" => $image_name,
                        "status"       => 'A'
                    );
                    $tbl_name = 'ls_web_banners';
                    $result = $this->admin_model->banner_creation($userdata,$tbl_name);
                    if($result) {
                        sf( 'success_message', "Banner details inserted successfully" );
                        redirect("admin/leadscarousalsettings");
                    }
                    else {
                        sf( 'error_message', "Banner details not inserted" );
                        redirect("admin/leadscarousalsettings");
                    }
                }
                else {
                    sf( 'error_message', "Banner order already taken,Please choose another one" );
                    redirect("admin/leadscarousalsettings");
                }
            }
        }
         
        $this->gen_contents['page_heading'] = 'Manage Carousal  Banners';
        $this->template->set_template('admin');
        $this->template->write_view('content','admin/bannercreationleads', $this->gen_contents);
        $this->template->render();
    }
    
    public function bannercreation (){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->form_validation->set_rules('banner_name', 'Banner name', 'required');
        $this->form_validation->set_rules('banner_order', 'Banner order', 'required|numeric');
        if (empty($_FILES['banner_image']['name']))
            $this->form_validation->set_rules('banner_image', 'Document', 'required');
        
        $this->load->model('admin/admin_model');
        if($this->form_validation->run() == TRUE){  
            
            if (!empty($_FILES['banner_image']['name'])) {
                
                $tbl_name = 'cc_web_banners';
                $banner_order = $this->input->post("banner_order",true);
                $check_banner_order = $this->admin_model->check_banner_order($banner_order,$id = 0,$tbl_name);
                if($check_banner_order) {
                    $config['upload_path']          = './assets/images/banners/';  
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 0;
                    $config['max_width']            = 0;
                    $config['max_height']           = 0;

                    $image_name = '';
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('banner_image')){
                          $upload_detail = $this->upload->data();
                          $image_name = $upload_detail["file_name"];
                    }
                    else {
                        sf( 'error_message', "Error occured,image cannot uploaded" );
                        redirect("admin/bannersettings");
                    }
                    $this->load->library('image_lib');
                    $config_thumb['image_library'] = 'gd2';
                    $config_thumb['source_image'] = './assets/images/banners/'.$upload_detail["file_name"];
                    $config_thumb['maintain_ratio'] = TRUE;
                    $config_thumb['quality'] = "100%";
                    $config_thumb['width'] = 1920;
                    $config_thumb['height'] = 520;

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config_thumb);
                    $this->image_lib->resize();
                
                
                    $userdata = array(
                        "banner_name"  => $this->input->post("banner_name",true),
                        "banner_order" => $banner_order,
                        "banner_image" => $image_name,
                        "status"       => 'A'
                    );
                    $tbl_name = 'cc_web_banners';
                    $result = $this->admin_model->banner_creation($userdata,$tbl_name);
                    if($result) {
                        sf( 'success_message', "Banner details inserted successfully" );
                        redirect("admin/bannersettings");
                    }
                    else {
                        sf( 'error_message', "Banner details not inserted" );
                        redirect("admin/bannersettings");
                    }
                }
                else {
                    sf( 'error_message', "Banner order already taken,Please choose another one" );
                    redirect("admin/bannercreation");
                }
            }
        }
         
        $this->gen_contents['page_heading'] = 'Manage Carousal  Banners';
        $this->template->set_template('admin');
        $this->template->write_view('content','admin/bannercreation', $this->gen_contents);
        $this->template->render();
    }
    
    public function sellcopierbannercreation (){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->form_validation->set_rules('banner_name', 'Banner name', 'required');
        $this->form_validation->set_rules('banner_order', 'Banner order', 'required|numeric');
        if (empty($_FILES['banner_image']['name']))
            $this->form_validation->set_rules('banner_image', 'Document', 'required');
        
        $this->load->model('admin/admin_model');
        if($this->form_validation->run() == TRUE){  
            
            if (!empty($_FILES['banner_image']['name'])) {
                
                $banner_order = $this->input->post("banner_order",true);
                $tbl_name = 'cc_sellcopier_banners';
                $check_banner_order = $this->admin_model->check_banner_order($banner_order,$id = 0,$tbl_name);
                if($check_banner_order) {
                    $config['upload_path']          = './assets/images/banners/sellcopiers';  
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 0;
                    $config['max_width']            = 0;
                    $config['max_height']           = 0;

                    $image_name = '';
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('banner_image')){
                          $upload_detail = $this->upload->data();
                          $image_name = $upload_detail["file_name"];
                    }
                    else {
                        sf( 'error_message', "Error occured,image cannot uploaded" );
                        redirect("admin/sellcopierbannercreation");
                    }
                    $this->load->library('image_lib');
                    $config_thumb['image_library'] = 'gd2';
                    $config_thumb['source_image'] = './assets/images/banners/sellcopiers/'.$upload_detail["file_name"];
                    $config_thumb['maintain_ratio'] = TRUE;
                    $config_thumb['quality'] = "100%";
                    $config_thumb['width'] = 1920;
                    $config_thumb['height'] = 520;

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config_thumb);
                    $this->image_lib->resize();
                
                
                    $userdata = array(
                        "banner_name"  => $this->input->post("banner_name",true),
                        "banner_order" => $banner_order,
                        "banner_image" => $image_name,
                        "status"       => 'A'
                    );
                    
                    $tbl_name = 'cc_sellcopier_banners';
                    $result = $this->admin_model->banner_creation($userdata,$tbl_name);
                    if($result) {
                        sf( 'success_message', "Banner details inserted successfully" );
                        redirect("admin/sellcopierbannersettings");
                    }
                    else {
                        sf( 'error_message', "Banner details not inserted" );
                        redirect("admin/sellcopierbannersettings");
                    }
                }
                else {
                    sf( 'error_message', "Banner order already taken,Please choose another one" );
                    redirect("admin/sellcopierbannersettings");
                }
            }
        }
         
        $this->gen_contents['page_heading'] = 'Banner Settings';
        $this->template->set_template('admin');
        $this->template->write_view('content','admin/sellcopierbannercreation', $this->gen_contents);
        $this->template->render();
    }
    
    public function modifybannerleads($id = 0){  
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            
            $this->form_validation->set_rules('banner_name', 'Banner name', 'required');
            $this->form_validation->set_rules('banner_order', 'Banner order', 'required|numeric');
            $image_name = '';
            
            if($this->form_validation->run() == TRUE){ 
                $banner_order = $this->input->post("banner_order",true);
                $page_id      = $this->input->post("id",true);
                $tblname      = 'ls_web_banners';
                $check_banner_order = $this->admin_model->check_banner_order($banner_order,$page_id,$tblname);
                if($check_banner_order) {
                    
                    if (!empty($_FILES['banner_image']['name'])) {

                        $config['upload_path']          = './assets/images/banners/Leads2sale/';  
                        $config['allowed_types']        = 'gif|jpg|png';
                        $config['max_size']             = 0;
                        $config['max_width']            = 0;
                        $config['max_height']           = 0;

                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('banner_image')){
                              $upload_detail = $this->upload->data();
                              $image_name = $upload_detail["file_name"];
                        }
                        else {
                            sf( 'error_message', "Error occured,image cannot uploaded" );
                            redirect("admin/bannersettings");
                        }
                        $this->load->library('image_lib');
                        $config_thumb['image_library'] = 'gd2';
                        $config_thumb['source_image'] = './assets/images/banners/Leads2sale/'.$upload_detail["file_name"];
                        $config_thumb['maintain_ratio'] = TRUE;
                        $config_thumb['quality'] = "100%";
                        $config_thumb['width'] = 1920;
                        $config_thumb['height'] = 636;

                        $this->image_lib->clear();
                        $this->image_lib->initialize($config_thumb);
                        $this->image_lib->resize(); 
                    }
                    else {
                        $image_name = $this->input->post("old_imagename",true);
                    }
                
                
                    $userdata = array(
                        "banner_name"  => $this->input->post("banner_name",true),
                        "banner_order" => $banner_order,
                        "banner_image" => $image_name,
                        "status"       => 'A'
                    );

                    $result = $this->admin_model->banner_modification($userdata,$page_id,$tblname);
                    if($result) {
                        sf( 'success_message', "Banner details updated successfully" );
                        redirect("admin/leadscarousalsettings");
                    }
                    else {
                        sf( 'error_message', "No modification done" );
                        redirect("admin/leadscarousalsettings");
                    }
                }
                else {
                    sf( 'error_message', "Banner order already taken,Please choose another one" );
                    redirect("admin/modifybannerleads/".$page_id);
                }
            }
            
            $tblname      = 'ls_web_banners';
            $this->gen_contents['details'] = $this->admin_model->get_banner_details($id,$tblname);
            $this->gen_contents['page_heading'] = 'Manage Carousal  Banners';
            $this->template->set_template('admin');
            $this->template->write_view('content', 'admin/bannermodifyleads', $this->gen_contents);
            $this->template->render();
              
        }
        else {
            redirect("admin/leadscarousalsettings");
        }
    }
    
    public function modifybanner($id = 0){  
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            
            $this->load->model('admin/admin_model');
            $this->form_validation->set_rules('banner_name', 'Banner name', 'required');
            $this->form_validation->set_rules('banner_order', 'Banner order', 'required|numeric');
            $image_name = '';
            
            if($this->form_validation->run() == TRUE){ 
                $banner_order = $this->input->post("banner_order",true);
                $page_id      = $this->input->post("id",true);
                $tblname      = 'cc_web_banners';
                $check_banner_order = $this->admin_model->check_banner_order($banner_order,$page_id,$tblname);
                if($check_banner_order) {
                    
                    if (!empty($_FILES['banner_image']['name'])) {

                        $config['upload_path']          = './assets/images/banners/';  
                        $config['allowed_types']        = 'gif|jpg|png';
                        $config['max_size']             = 0;
                        $config['max_width']            = 0;
                        $config['max_height']           = 0;

                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('banner_image')){
                              $upload_detail = $this->upload->data();
                              $image_name = $upload_detail["file_name"];
                        }
                        else {
                            sf( 'error_message', "Error occured,image cannot uploaded" );
                            redirect("admin/bannersettings");
                        }
                        $this->load->library('image_lib');
                        $config_thumb['image_library'] = 'gd2';
                        $config_thumb['source_image'] = './assets/images/banners/'.$upload_detail["file_name"];
                        $config_thumb['maintain_ratio'] = TRUE;
                        $config_thumb['quality'] = "100%";
                        $config_thumb['width'] = 1920;
                        $config_thumb['height'] = 520;

                        $this->image_lib->clear();
                        $this->image_lib->initialize($config_thumb);
                        $this->image_lib->resize(); 
                    }
                    else {
                        $image_name = $this->input->post("old_imagename",true);
                    }
                
                
                    $userdata = array(
                        "banner_name"  => $this->input->post("banner_name",true),
                        "banner_order" => $banner_order,
                        "banner_image" => $image_name,
                        "status"       => 'A'
                    );

                    $result = $this->admin_model->banner_modification($userdata,$page_id,$tblname);
                    if($result) {
                        sf( 'success_message', "Banner details updated successfully" );
                        redirect("admin/bannersettings");
                    }
                    else {
                        sf( 'error_message', "No modification done" );
                        redirect("admin/bannersettings");
                    }
                }
                else {
                    sf( 'error_message', "Banner order already taken,Please choose another one" );
                    redirect("admin/modifybanner/".$page_id);
                }
            }
            
            $tblname      = 'cc_web_banners';
            $this->gen_contents['details'] = $this->admin_model->get_banner_details($id,$tblname);
            $this->gen_contents['page_heading'] = 'Manage Carousal  Banners';
            $this->template->set_template('admin');
            $this->template->write_view('content', 'admin/bannermodification', $this->gen_contents);
            $this->template->render();
              
        }
        else {
            redirect("admin/bannersettings");
        }
    }
    
    public function modifybannersellcopier($id = 0){ 
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            
            $this->load->model('admin/admin_model');
            $this->form_validation->set_rules('banner_name', 'Banner name', 'required');
            $this->form_validation->set_rules('banner_order', 'Banner order', 'required|numeric');
            $image_name = '';
            
            if($this->form_validation->run() == TRUE){ 
                $banner_order = $this->input->post("banner_order",true);
                $page_id      = $this->input->post("id",true);
                $tblname = 'cc_sellcopier_banners';
                $check_banner_order = $this->admin_model->check_banner_order($banner_order,$page_id,$tblname);
                if($check_banner_order) {
                    
                    if (!empty($_FILES['banner_image']['name'])) {

                        $config['upload_path']          = './assets/images/banners/sellcopiers/';  
                        $config['allowed_types']        = 'gif|jpg|png';
                        $config['max_size']             = 0;
                        $config['max_width']            = 0;
                        $config['max_height']           = 0;

                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('banner_image')){
                              $upload_detail = $this->upload->data();
                              $image_name = $upload_detail["file_name"];
                        }
                        else {
                            sf( 'error_message', "Error occured,image cannot uploaded" );
                            redirect("admin/sellcopierbannersettings");
                        }
                        $this->load->library('image_lib');
                        $config_thumb['image_library'] = 'gd2';
                        $config_thumb['source_image'] = './assets/images/banners/sellcopiers/'.$upload_detail["file_name"];
                        $config_thumb['maintain_ratio'] = TRUE;
                        $config_thumb['quality'] = "100%";
                        $config_thumb['width'] = 1920;
                        $config_thumb['height'] = 520;

                        $this->image_lib->clear();
                        $this->image_lib->initialize($config_thumb);
                        $this->image_lib->resize(); 
                    }
                    else {
                        $image_name = $this->input->post("old_imagename",true);
                    }
                
                
                    $userdata = array(
                        "banner_name"  => $this->input->post("banner_name",true),
                        "banner_order" => $banner_order,
                        "banner_image" => $image_name,
                        "status"       => 'A'
                    );
                        
                    $result = $this->admin_model->banner_modification($userdata,$page_id,$tblname);
                    if($result) {
                        sf( 'success_message', "Banner details updated successfully" );
                        redirect("admin/sellcopierbannersettings");
                    }
                    else {
                        sf( 'error_message', "No modification done" );
                        redirect("admin/sellcopierbannersettings");
                    }
                }
                else {
                    sf( 'error_message', "Banner order already taken,Please choose another one" );
                    redirect("admin/sellcopierbannersettings/".$page_id);
                }
            }
                
            $tblname = 'cc_sellcopier_banners';
            $this->gen_contents['details'] = $this->admin_model->get_banner_details($id,$tblname);
            $this->gen_contents['page_heading'] = 'Banner Settings';
            $this->template->set_template('admin');
            $this->template->write_view('content', 'admin/sellcopierbannermodification', $this->gen_contents);
            $this->template->render();
              
        }
        else {
            redirect("admin/bannersettings");
        }
    }
    
    public function deletearticles($id = 0){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        if($id != 0 && is_numeric($id)){
            $userdata = array(
                'status' => '0'
            );
            $tbl_name = 'cc_articles';
            $result = $this->admin_model->banner_modification($userdata,$id,$tbl_name);
            if($result) {
                $getimage = $this->admin_model->get_image_byid($id,$tbl_name);
                if($getimage)
                    unlink("assets/images/articles/".$getimage['image']);
                sf( 'success_message', "Articles details deleted successfully" );
                redirect("admin/articles");
            }
            else {
                sf( 'error_message', "Articles details not deleted,Please try again" );
                redirect("admin/articles");
            }
        }
        else {
            redirect("admin/articles");
        }
    }
    
    public function deletebanner($id = 0){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            $userdata = array(
                'status' => 'D'
            );
            $tbl_name = 'cc_web_banners';
            $result = $this->admin_model->banner_modification($userdata,$id,$tbl_name);
            if($result) {
                
                $getimage = $this->admin_model->get_image_byid($id,$tbl_name);
                if($getimage)
                    unlink("assets/images/banners/".$getimage['banner_image']);
                sf( 'success_message', "Banner details deleted successfully" );
                redirect("admin/bannersettings");
            }
            else {
                sf( 'error_message', "Banner details not deleted,Please try again" );
                redirect("admin/bannersettings");
            }
        }
        else {
            redirect("admin/bannersettings");
        }
    }
    
    public function deletebannerleads($id = 0){
        
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $userdata = array(
                'status' => 'D'
            );
            $tbl_name = 'ls_web_banners';
            $result = $this->admin_model->banner_modification($userdata,$id,$tbl_name);
            if($result) {
                
                $getimage = $this->admin_model->get_image_byid($id,$tbl_name);
                if($getimage)
                    unlink("assets/images/banners/Leads2sale/".$getimage['banner_image']);
                sf( 'success_message', "Banner details deleted successfully" );
                redirect("admin/leadscarousalsettings");
            }
            else {
                sf( 'error_message', "Banner details not deleted,Please try again" );
                redirect("admin/leadscarousalsettings");
            }
        }
        else {
            redirect("admin/leadscarousalsettings");
        }
    }
    
    public function deletebannersellcopier($id = 0){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            $userdata = array(
                'status' => 'D'
            );
            $tbl_name = 'cc_sellcopier_banners';
            $result = $this->admin_model->banner_modification($userdata,$id,$tbl_name);
            if($result) {
                
                $getimage = $this->admin_model->get_image_byid($id,$tbl_name);
                if($getimage)
                    unlink("assets/images/banners/sellcopiers/".$getimage['banner_image']);
                sf( 'success_message', "Banner details deleted successfully" );
                redirect("admin/sellcopierbannersettings");
            }
            else {
                sf( 'error_message', "Banner details not deleted,Please try again" );
                redirect("admin/sellcopierbannersettings");
            }
        }
        else {
            redirect("admin/sellcopierbannersettings");
        }
    }
    
    // Routating banner status updation
    public function rotatingbannerstatusupdate ($id = 0, $status = '') {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            if($status == 'A'){
                $status_new = 'D';
            }
            else {
                $status_new = 'A';
            }
            $userdata = array(
                'status' => $status_new,
                'approval_date' => date('Y-m-d H:i:s')
            );
            $result = $this->admin_model->update_rotatingbanner($userdata,$id);
            if($result) {
                sf( 'success_message', "Rotating banner status updated successfully" );
                redirect("admin/rotatingbannerreport");
            }
            else {
                sf( 'error_message', "Rotating banner status not updated,Please try again" );
                redirect("admin/rotatingbannerreport");
            }
        }
        else {
            redirect("admin/rotatingbannerreport");
        }
    }
    
    public function userstatusupdate ($id = 0, $status = '') {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            if($status == 'Active'){
                $status_new = 'Deactive';
            }
            else {
                $status_new = 'Active';
            }
            $userdata = array(
                'status' => $status_new
            );
            $result = $this->admin_model->update_users($userdata,$id);
            if($result) {
                sf( 'success_message', "User status updated successfully" );
                redirect("admin/users");
            }
            else {
                sf( 'error_message', "User status not updated,Please try again" );
                redirect("admin/users");
            }
        }
        else {
            redirect("admin/users");
        }
    }
    
    public function reductionpercentagelist() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        $tblname = 'reduction_percentage`';
        $total_records = $this->admin_model->get_total_records($tblname); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'emailsettings';
        $config['total_rows']   = $total_records;
        $config['per_page']     = 25;
        $bs_init = $this->bspagination->config();
        
        $config = array_merge($config, $bs_init);
        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        
        
        $this->gen_contents['details'] = $this->admin_model->get_reduction_list($config['per_page'], $pagin);
        $this->gen_contents['page_heading'] = 'Reduction Percentage Settings';
        
        $this->template->set_template('admin');  
        $this->template->write_view('content', 'admin/reductionpercentagelist', $this->gen_contents);
        $this->template->render(); 
    }
    
    public function modifyreduction ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
           
            $this->load->model('admin/admin_model');
            $this->form_validation->set_rules('lead_star', 'Lead star', 'required');
            $this->form_validation->set_rules('red_perc', 'Reduction percentage', 'required|numeric');
            if($this->form_validation->run() == TRUE){
           
                $userdata = array(
                    'lead_star'        => $this->input->post("lead_star",true),
                    'red_perc'   => $this->input->post("red_perc",true)
                );
                $condition = $this->input->post("id",true);

                $result = $this->admin_model->update_reductionsettings($userdata,$condition);
                if($result){
                    sf( 'success_message', "Reduction percentage settings modified successfully" );
                    redirect("admin/reductionpercentagelist");
                }
                else {
                    sf('error_message', 'No modifications done');
                    redirect("admin/reductionpercentagelist");
                }
            }
           
           $this->gen_contents['details'] = $this->admin_model->get_reductiondetails_byid($id);
           $this->gen_contents['page_heading'] = 'Reduction Percentage Settings';
           $this->template->set_template('admin');
           $this->template->write_view('content', 'admin/modifyreduction', $this->gen_contents);
           $this->template->render();
        } 
       else {
           redirect("admin/reductionpercentagelist");
       }
    }
    
    public function emailalertsettings() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $tblname = 'admin_email_notification`';
        $total_maillist = $this->admin_model->get_total_records($tblname); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'emailalertsettings';
        $config['total_rows']   = $total_maillist;
        $config['per_page']     = 25;
        $bs_init = $this->bspagination->config();
        
        $config = array_merge($config, $bs_init);
        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        
        
        $this->gen_contents['details'] = $this->admin_model->get_emailalert_list($config['per_page'], $pagin);
        $this->gen_contents['page_heading'] = 'Email Alert Settings';
        
        $this->template->set_template('admin');  
        $this->template->write_view('content', 'admin/emailalertsettings', $this->gen_contents);
        $this->template->render(); 
    }
    
    public function emailsettings() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        $tblname = 'mail_template`';
        $total_maillist = $this->admin_model->get_total_records($tblname); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'emailsettings';
        $config['total_rows']   = $total_maillist;
        $config['per_page']     = 25;
        $bs_init = $this->bspagination->config();
        
        $config = array_merge($config, $bs_init);
        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        
        
        $this->gen_contents['details'] = $this->admin_model->get_email_list($config['per_page'], $pagin);
        $this->gen_contents['page_heading'] = 'Email Settings';
        
        $this->template->set_template('admin');  
        $this->template->write_view('content', 'admin/emailsettingslist', $this->gen_contents);
        $this->template->render(); 
    }
    
    public function emailmodification ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
           
            $this->load->model('admin/admin_model');
            $this->form_validation->set_rules('mail_from', 'Mail from', 'required');
            $this->form_validation->set_rules('mail_from_name', 'Mail from name', 'required');
            if($this->form_validation->run() == TRUE){
           
                $userdata = array(
                    'mail_from'        => $this->input->post("mail_from",true),
                    'mail_from_name'   => $this->input->post("mail_from_name",true),
                    'mail_subject'     => $this->input->post("mail_subject",true),
                    'mail_body'     => $this->input->post("mail_body",true),
                );
                $condition = $this->input->post("mail_template_id",true);

                $result = $this->admin_model->update_mailsettings($userdata,$condition);
                if($result){
                    sf( 'success_message', "Email settings modified successfully" );
                    redirect("admin/emailsettings");
                }
                else {
                    sf('error_message', 'No modifications done');
                    redirect("admin/emailsettings");
                }
            }
           
           $this->gen_contents['details'] = $this->admin_model->get_emaildetails_byid($id);
           $this->gen_contents['page_heading'] = 'Email Settings';
           $this->template->set_template('admin');
           $this->template->write_view('content', 'admin/emailmodification', $this->gen_contents);
           $this->template->render();
        }
        else {
           redirect("admin/emailsettings");
        }
    }
    
    public function socialmediasettings (){
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        
        if($this->input->post("formsubmit"))
            $formsubmit = $this->input->post("formsubmit",true);
        else 
            $formsubmit = '';
        if($formsubmit == 1){

            $userdata = array(
                'link'  => $this->input->post("facebookcc",true)
            );
            $condition = '1';

            $result = $this->admin_model->update_socialmediasettings($userdata,$condition);
            
            $userdata = array(
                'link'  => $this->input->post("twittercc",true)
            );
            $condition = '2';

            $result = $this->admin_model->update_socialmediasettings($userdata,$condition);
            $userdata = array(
                'link'  => $this->input->post("linkdincc",true)
            );
            $condition = '3';

            $result = $this->admin_model->update_socialmediasettings($userdata,$condition);
            $userdata = array(
                'link'  => $this->input->post("facebookls",true)
            );
            $condition = '4';

            $result = $this->admin_model->update_socialmediasettings($userdata,$condition);
            $userdata = array(
                'link'  => $this->input->post("linkdinls",true)
            );
            $condition = '5';

            $result = $this->admin_model->update_socialmediasettings($userdata,$condition);
            $userdata = array(
                'link'  => $this->input->post("twitterls",true)
            );
            $condition = '6';

            $result = $this->admin_model->update_socialmediasettings($userdata,$condition);
            
            
            sf( 'success_message', "Email settings modified successfully" );
                redirect("admin/socialmediasettings"); 
        }
        
        $this->gen_contents['details'] = $this->admin_model->get_socialmedia_list(); 
        $this->gen_contents['page_heading'] = 'Social Media Settings';
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/socialmedialinks', $this->gen_contents);
        $this->template->render();
    }

    public function manageindustry () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $tblname = 'ls_industries`';
        
        $config['per_page']     = 25;
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->gen_contents['details'] = $this->admin_model->get_industry_list($config['per_page'], $pagin);
        $total_records = $this->admin_model->get_total_rows();
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'manageindustry';
        $config['total_rows']   = $total_records;
        
        $bs_init = $this->bspagination->config();
        $config = array_merge($config, $bs_init);

        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        
        $this->gen_contents['page_heading'] = 'Manage Industry';
        $this->template->set_template('admin');  
        $this->template->write_view('content', 'admin/industrylist', $this->gen_contents);
        $this->template->render(); 
    }
    
    public function industrycreation () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->form_validation->set_rules('industry_name', 'Industry name', 'required');
        
        $this->load->model('admin/admin_model');
        if($this->form_validation->run() == TRUE){   
            
            $userdata = array(
                "industry_name"  => $this->input->post("industry_name",true)
            );

            $result = $this->admin_model->industry_creation($userdata);
            if($result) {
                sf( 'success_message', "Industry details inserted successfully" );
                redirect("admin/manageindustry");
            }
            else {
                sf( 'error_message', "Industry details not inserted,Please try again" );
                redirect("admin/manageindustry");
            }    
        }
         
        $this->gen_contents['page_heading'] = 'Manage Industry';
        $this->template->set_template('admin');
        $this->template->write_view('content','admin/industrycreation', $this->gen_contents);
        $this->template->render();
    }
    
    public function industrymodification ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
       if($id != 0 && is_numeric($id)){
           
            $this->load->model('admin/admin_model');
             
            $this->form_validation->set_rules('industry_name', 'Industry name', 'required');
            if($this->form_validation->run() == TRUE){
                
                $userdata = array(
                    "industry_name"  => $this->input->post("industry_name",true)
                );
                $condition = $this->input->post("id",true);

                $result = $this->admin_model->industry_modification($userdata,$condition);
                if($result){
                    sf( 'success_message', "Industry details modified successfully" );
                    redirect("admin/manageindustry");
                }
                else {
                    sf('error_message', 'No modifications done');
                    redirect("admin/manageindustry");
                }
            }
           $this->gen_contents['details'] = $this->admin_model->get_industrydetails_byid($id);
           $this->gen_contents['page_heading'] = 'Manage Industry';
           $this->template->set_template('admin');
           $this->template->write_view('content', 'admin/industrymodification', $this->gen_contents);
           $this->template->render();
        }
       else {
           redirect("admin/manageindustry");
       }
    }
    
    public function deleteenquiryleads ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            $tbl_name = 'ls_enquiries';
            $result = $this->admin_model->deleteenquiries($id,$tbl_name);
            if($result) {
                sf( 'success_message', "Enquiry details deleted successfully" );
                redirect("admin/enquiriesleadsales");
            }
            else {
                sf( 'error_message', "Enquiry details not deleted,Please try again" );
                redirect("admin/enquiriesleadsales");
            }
        }
        else {
            redirect("admin/enquiriesleadsales");
        }
    }
    
    public function deleteenquiry ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            $tbl_name = 'cc_enquiries';
            $result = $this->admin_model->deleteenquiries($id,$tbl_name);
            if($result) {
                sf( 'success_message', "Enquiry details deleted successfully" );
                redirect("admin/enquiries");
            }
            else {
                sf( 'error_message', "Enquiry details not deleted,Please try again" );
                redirect("admin/enquiries");
            }
        }
        else {
            redirect("admin/enquiries");
        }
    }
    
    public function deletedropoutlead ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            
            $result_lead_response = $this->admin_model->deleteleadresponse($id);
            $result = $this->admin_model->deletedropoutlead($id);
            if($result) {
                sf( 'success_message', "Lead details deleted successfully" );
                redirect("admin/dropoutleads");
            }
            else {
                sf( 'error_message', "Lead details not deleted,Please try again" );
                redirect("admin/dropoutleads");
            }
        }
        else {
            redirect("admin/dropoutleads");
        }
    }
    
    
    
    public function deleterotatingbanner ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            
            $userdata = array(
                "status" => "D"
            );
            $result = $this->admin_model->deleterotatingbanner($id,$userdata);
            if($result) {
                sf( 'success_message', "Banner details deleted successfully" );
                redirect("admin/rotatingbannerreport");
            }
            else {
                sf( 'error_message', "Banner details not deleted,Please try again" );
                redirect("admin/rotatingbannerreport");
            }
        }
        else {
            redirect("admin/rotatingbannerreport");
        }
    }
    
    public function deleteindustry ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            $userdata = array(
                'status' => '0'
            );
            $result = $this->admin_model->industry_modification($userdata,$id);
            if($result) {
                sf( 'success_message', "Industry details deleted successfully" );
                redirect("admin/manageindustry");
            }
            else {
                sf( 'error_message', "Industry details not deleted,Please try again" );
                redirect("admin/manageindustry");
            }
        }
        else {
            redirect("admin/manageindustry");
        }
    }
    
    public function approveindustry ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $userdata = array(
                'status' => '1'
            );
            $result = $this->admin_model->industry_modification($userdata,$id);
            if($result) {
                sf( 'success_message', "Industry details approved successfully" );
                redirect("admin/manageindustry");
            }
            else {
                sf( 'error_message', "Industry details not approved,Please try again" );
                redirect("admin/manageindustry");
            }
        }
        else {
            redirect("admin/manageindustry");
        }
    }
    
    public function promocodesettings () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        $tblname = 'ls_promocode`';
        $total_records = $this->admin_model->get_total_records($tblname); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'promocodesettings';
        $config['total_rows']   = $total_records;
        $config['per_page']     = 25;
        $bs_init = $this->bspagination->config();
        
        $config = array_merge($config, $bs_init);
        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        
        
        $this->gen_contents['details'] = $this->admin_model->get_promocode_list($config['per_page'], $pagin,$tblname);
        $this->gen_contents['page_heading'] = 'Promocode Settings';
        
        $this->template->set_template('admin');  
        $this->template->write_view('content', 'admin/promocodesettingslist', $this->gen_contents);
        $this->template->render(); 
    }
    
    public function rotatingbannerpackages () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        $tblname = 'rotating_banner_packages`';
        $total_records = $this->admin_model->get_total_records($tblname); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'promocodesettings';
        $config['total_rows']   = $total_records;
        $config['per_page']     = 25;
        $bs_init = $this->bspagination->config();
        
        $config = array_merge($config, $bs_init);
        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        
        
        $this->gen_contents['details'] = $this->admin_model->get_bannerpackage_list($config['per_page'], $pagin,$tblname);
        $this->gen_contents['page_heading'] = 'Rotating Banner Packages';
        
        $this->template->set_template('admin');  
        $this->template->write_view('content', 'admin/bannerpackageslist', $this->gen_contents);
        $this->template->render(); 
    }
    
    public function promotionslinks () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        $tblname = 'cc_promotions`';
        $total_records = $this->admin_model->get_total_records($tblname); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'promotionslinks';
        $config['total_rows']   = $total_records;
        $config['per_page']     = 25;
        $bs_init = $this->bspagination->config();
        
        $config = array_merge($config, $bs_init);
        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        
        
        $this->gen_contents['details'] = $this->admin_model->get_promotions_list($config['per_page'], $pagin,$tblname);
        $this->gen_contents['page_heading'] = 'Promotions Links';
        $this->template->set_template('admin');  
        $this->template->write_view('content', 'admin/promotionslinkslist', $this->gen_contents);
        $this->template->render(); 
    }
    
    public function promotionscreation () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->form_validation->set_rules('source', 'Source', 'required');
        $this->form_validation->set_rules('short_url', 'Short url', 'required');
        $this->form_validation->set_rules('landing_page', 'Landing page url', 'required');
        
        $this->load->model('admin/admin_model');
        if($this->form_validation->run() == TRUE){  
            
            $source = trim($this->input->post("source",true));
            $short_url = str_replace(' ', '', $this->input->post("short_url",true));
            $userdata = array(
                "source"       => $source,
                "short_url"    => $short_url,
                "landing_page" => trim($this->input->post("landing_page",true)),
                "status"       => '1'
            );
            
            $tbl_name = 'cc_promotions';
            $check_source = $this->admin_model-> check_promotions_source($short_url);
            if($check_source) {
                $result = $this->admin_model->promocode_creation($userdata,$tbl_name);
                if($result) {
                    sf( 'success_message', "Promotions details inserted successfully" );
                    redirect("admin/promotionslinks");
                }
                else {
                    sf( 'error_message', "Promotions details not inserted" );
                    redirect("admin/promotionslinks");
                }  
            }
            else {
                sf( 'error_message', "Short url  already exists" );
                    redirect("admin/promotionscreation");
            }
        }
         
        $this->gen_contents['page_heading'] = 'Promotions Settings';
        $this->template->set_template('admin');
        $this->template->write_view('content','admin/promotionscreation', $this->gen_contents);
        $this->template->render();
    }
    
    public function promocodecreation () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->form_validation->set_rules('promocode', 'Promocode', 'required|is_unique[ls_promocode.code]');
        $this->form_validation->set_rules('max_usage_count', 'Max usage count', 'required|numeric');
        $this->form_validation->set_rules('rate', 'Rate', 'numeric');
        
        $this->load->model('admin/admin_model');
        if($this->form_validation->run() == TRUE){   
            
            $date = $this->input->post("expiry_date");  
            $userdata = array(
                "code"  => $this->input->post("promocode",true),
                "expiry_date" => $date,
                "max_usage_count" => $this->input->post("max_usage_count",true),
                "rate" => $this->input->post("rate",true),
                "status"       => 'Active'
            );
            $tbl_name = 'ls_promocode';
            $result = $this->admin_model->promocode_creation($userdata,$tbl_name);
            if($result) {
                sf( 'success_message', "Promocode details inserted successfully" );
                redirect("admin/promocodesettings");
            }
            else {
                sf( 'error_message', "Promocode details not inserted" );
                redirect("admin/promocodesettings");
            }    
        }
         
        $this->gen_contents['page_heading'] = 'Promocode Settings';
        $this->template->set_template('admin');
        $this->template->write_view('content','admin/promocodecreation', $this->gen_contents);
        $this->template->render();
    }
    
    public function deleteleadprice ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            $userdata = array(
                'status' => '0'
            );
            $result = $this->admin_model->leadprice_modification($userdata,$id);
            if($result) {
                sf( 'success_message', "Lead price details deleted successfully" );
                redirect("admin/leadpricesettings");
            }
            else {
                sf( 'error_message', "Lead price details not deleted,Please try again" );
                redirect("admin/leadpricesettings");
            }
        }
        else {
            redirect("admin/leadpricesettings");
        }
    }
    
    public function deletebannerpackage ($id = 0) {  
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            $userdata = array(
                'status' => '0'
            );
            $tbl_name = 'rotating_banner_packages';
            $get_package_limit = $this->admin_model->get_package_limit($id); 
            if($get_package_limit)
                $package_limit_count = $get_package_limit['pack_limit'];
            else 
                $package_limit_count = 0;
            
            $checking_before_delete_package = $this->admin_model->checking_before_delete_packages($id,$package_limit_count);
            $checking_before_delete_package_count = $checking_before_delete_package['count'];
            if($checking_before_delete_package_count != '0'){  
                sf( 'error_message', "This package is already in used some suppliers" );
                redirect("admin/rotatingbannerpackages");
            }
            else {  
                $result = $this->admin_model->rotating_banner_packages_modification($userdata,$id,$tbl_name);
                if($result) {
                    sf( 'success_message', "Rotating banner packages deleted successfully" );
                    redirect("admin/rotatingbannerpackages");
                }
                else {
                    sf( 'error_message', "Rotating banner packages not deleted,Please try again" );
                    redirect("admin/rotatingbannerpackages");
                }
            }
        }
        else {
            redirect("admin/rotatingbannerpackages");
        }
    }
    
    public function deletepromocode ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            $userdata = array(
                'status' => 'Inactive'
            );
            $result = $this->admin_model->promocode_modification($userdata,$id);
            if($result) {
                sf( 'success_message', "Promocode details deleted successfully" );
                redirect("admin/promocodesettings");
            }
            else {
                sf( 'error_message', "Promocode details not deleted,Please try again" );
                redirect("admin/promocodesettings");
            }
        }
        else {
            redirect("admin/promocodesettings");
        }
    }
    
    public function deletepromotionslinks ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            $userdata = array(
                'status' => '0'
            );
            $tbl_name = 'cc_promotions';
            $result = $this->admin_model->promocode_modification($userdata,$id,$tbl_name);
            if($result) {
                sf( 'success_message', "Promotions links deleted successfully" );
                redirect("admin/promotionslinks");
            }
            else {
                sf( 'error_message', "Promotions links not deleted,Please try again" );
                redirect("admin/promotionslinks");
            }
        }
        else {
            redirect("admin/promotionslinks");
        }
    }
    
    public function deletedeviceprice ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            
            $result = $this->admin_model->delete_device_price($id);
            if($result) {
                sf( 'success_message', "Device price deleted successfully" );
                redirect("admin/devicepricesettings");
            }
            else {
                sf( 'error_message', "Device price not deleted,Please try again" );
                redirect("admin/devicepricesettings");
            }
        }
        else {
            redirect("admin/devicepricesettings");
        }
    }
    
    public function deleteadminsettings ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            $userdata = array(
                'status' => '0'
            );
            $result = $this->admin_model->adminsetting_modification($userdata,$id);
            if($result) {
                sf( 'success_message', "Admin settings details deleted successfully" );
                redirect("admin/adminsettings");
            }
            else {
                sf( 'error_message', "Admin settings details not deleted,Please try again" );
                redirect("admin/adminsettings");
            }
        }
        else {
            redirect("admin/adminsettings");
        }
    }
    
    public function modifysupplier ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
           
            $this->load->model('admin/admin_model');
            $tbl_name = 'users';
             
            $this->form_validation->set_rules('contact_name', 'Name', 'required');
            $this->form_validation->set_rules('company_name', 'Company name', 'required');
            $this->form_validation->set_rules('postcode', 'Postcode', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('postcode', 'Postcode', 'required|numeric');
            $this->form_validation->set_rules('telephone', 'Telephone', 'numeric');
            if($this->form_validation->run() == TRUE){
             
                $userdata = array(
                    "contact_name"  => $this->input->post("contact_name",true),
                    "company_name"  => $this->input->post("company_name",true),
                    "postcode" => $this->input->post("postcode",true),
                    "email" => $this->input->post("email",true),
                    "telephone" => $this->input->post("telephone",true),
                    "city" => $this->input->post("city",true),
                    "state" => $this->input->post("state",true),
                    "address" => $this->input->post("address",true),
                    "email1" => $this->input->post("email1",true),
                    "alternate_leads_email" => $this->input->post("alternate_leads_email",true),
                    "abn" => $this->input->post("abn",true),
                    "makers" => $this->input->post("makers",true)
                );
                $condition = $this->input->post("userID",true);
                
                $result = $this->admin_model->user_modification($userdata,$condition,$tbl_name);
                if($result){
                    sf( 'success_message', "Suppliers details modified successfully" );
                    redirect("admin/users");
                }
                else {
                    sf('error_message', 'No modifications done');
                    redirect("admin/users");
                }
            }
           
           $this->gen_contents['details'] = $this->admin_model->get_user_byid($id,$tbl_name);
           $this->gen_contents['page_heading'] = 'Suppliers Settings';
           $this->template->set_template('admin');
           $this->template->write_view('content', 'admin/usermodification', $this->gen_contents);
           $this->template->render();
        }
       else {
           redirect("admin/users");
       }
    }

    public function promocodemodification ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
       if($id != 0 && is_numeric($id)){
           
            $this->load->model('admin/admin_model');
            $tbl_name = 'ls_promocode';
            $details = $this->admin_model->get_promocodedetails_byid($id,$tbl_name);
            if($this->input->post("promocode") != $details['code']){
                $this->form_validation->set_rules('promocode', 'Promocode', 'required|numeric|is_unique[ls_promocode.code]');
            }
             
            $this->form_validation->set_rules('max_usage_count', 'Max usage count', 'required|numeric');
            $this->form_validation->set_rules('rate', 'Rate', 'numeric');
            if($this->form_validation->run() == TRUE){
            
                $date = $this->input->post("expiry_date");  
                $userdata = array(
                    "code"  => $this->input->post("promocode",true),
                    "expiry_date" => $date,
                    "max_usage_count" => $this->input->post("max_usage_count",true),
                    "rate" => $this->input->post("rate",true),
                    "status"  => 'Active'
                );
                $condition = $this->input->post("id",true);
                 $tbl_name = 'ls_promocode'; 
                $result = $this->admin_model->promocode_modification($userdata,$condition,$tbl_name);
                if($result){
                    sf( 'success_message', "Promocode settings modified successfully" );
                    redirect("admin/promocodesettings");
                }
                else {
                    sf('error_message', 'No modifications done');
                    redirect("admin/promocodesettings");
                }
            }
           
           $this->gen_contents['details'] = $details;
           $this->gen_contents['page_heading'] = 'Promocode Settings';
           $this->template->set_template('admin');
           $this->template->write_view('content', 'admin/promocodemodification', $this->gen_contents);
           $this->template->render();
        }
       else {
           redirect("admin/promocodesettings");
       }
    }
    
    public function modifybannerpackages ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
       if($id != 0 && is_numeric($id)){
           
            $this->load->model('admin/admin_model');
            $tbl_name = 'rotating_banner_packages';
            
            $this->form_validation->set_rules('pack_name', 'Package name', 'required');
            $this->form_validation->set_rules('pack_limit', 'Limit', 'required|numeric');
            $this->form_validation->set_rules('pack_credit', 'credit', 'required|numeric');
           
            if($this->form_validation->run() == TRUE){
              
                $userdata = array(
                    "pack_name"  => $this->input->post("pack_name",true),
                    "pack_details"  => $this->input->post("pack_details",true),
                    "pack_limit" => $this->input->post("pack_limit",true),
                    "pack_credit" => $this->input->post("pack_credit",true),
                    "status"  => '1'
                );
                $condition = $this->input->post("pack_id",true);
                 
                $result = $this->admin_model->rotating_banner_packages_modification($userdata,$condition,$tbl_name);
                if($result){
                    sf( 'success_message', "Rotating banner packages modified successfully" );
                    redirect("admin/rotatingbannerpackages");
                }
                else {
                    sf('error_message', 'No modifications done');
                    redirect("admin/rotatingbannerpackages");
                }
            }
           
           $this->gen_contents['details'] = $this->admin_model->get_bannerpackages_byid($id,$tbl_name);
           $this->gen_contents['page_heading'] = 'Rotating Banner Packages';
           $this->template->set_template('admin');
           $this->template->write_view('content', 'admin/bannerpackagemodification', $this->gen_contents);
           $this->template->render();
        }
       else {
           redirect("admin/rotatingbannerpackages");
       }
    }
    
    public function bannerpackagecreation () {
           (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');

        $this->form_validation->set_rules('pack_name', 'Package name', 'required');
        $this->form_validation->set_rules('pack_limit', 'Limit', 'required|numeric');
        $this->form_validation->set_rules('pack_credit', 'credit', 'required|numeric');

        if($this->form_validation->run() == TRUE){

            $userdata = array(
                "pack_name"  => $this->input->post("pack_name",true),
                "pack_details"  => $this->input->post("pack_details",true),
                "pack_limit" => $this->input->post("pack_limit",true),
                "pack_credit" => $this->input->post("pack_credit",true),
                "status"  => '1'
            );;

            $result = $this->admin_model->insert_banner_packages($userdata);
            if($result){
                sf( 'success_message', "Rotating banner packages inserted successfully" );
                redirect("admin/rotatingbannerpackages");
            }
            else {
                sf('error_message', 'Rotating banner packages not inserted,Please try again');
                redirect("admin/rotatingbannerpackages");
            }
        }

       $this->gen_contents['page_heading'] = 'Rotating Banner Packages';
       $this->template->set_template('admin');
       $this->template->write_view('content', 'admin/bannerpackagecreation', $this->gen_contents);
       $this->template->render();
    }
    
    
    public function promotionsmodification ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
       if($id != 0 && is_numeric($id)){
           
            $this->load->model('admin/admin_model');
            $tbl_name = 'cc_promotions';
             
            $this->form_validation->set_rules('source', 'Source', 'required');
            $this->form_validation->set_rules('short_url', 'Short url', 'required');
            $this->form_validation->set_rules('landing_page', 'Landing page url', 'required');
        
            if($this->form_validation->run() == TRUE){
            
                $source = trim($this->input->post("source",true));
                $short_url = str_replace(' ', '', $this->input->post("short_url",true));
                $userdata = array(
                    "source"       => $source,
                    "short_url"    => $short_url,
                    "landing_page" => trim($this->input->post("landing_page",true)),
                    "status"       => '1'
                );
                
                $check_source = $this->admin_model-> check_promotions_source($short_url,$id);
                if($check_source) {
                    
                    $condition = $this->input->post("id",true);
                    $result = $this->admin_model->promocode_modification($userdata,$condition,$tbl_name);
                    if($result){
                        sf( 'success_message', "Promotions settings modified successfully" );
                        redirect("admin/promotionslinks");
                    }
                    else {
                        sf('error_message', 'No modifications done');
                        redirect("admin/promotionslinks");
                    }  
                }
                else {
                    sf( 'error_message', "Short url already exists" );
                        redirect("admin/promotionsmodification/".$id);
                }
            }
           
           $this->gen_contents['details'] = $this->admin_model->get_promocodedetails_byid($id,$tbl_name);
           $this->gen_contents['page_heading'] = 'Promotions Links';
           $this->template->set_template('admin');
           $this->template->write_view('content', 'admin/Promotionsmodification', $this->gen_contents);
           $this->template->render();
        }
       else {
           redirect("admin/promotionslinks");
       }
    }
    
    public function adminsettingsmodification ($id = 0) {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
       if($id != 0 && is_numeric($id)){
           
            $this->load->model('admin/admin_model');
            $this->form_validation->set_rules('label', 'Label', 'required');
            $this->form_validation->set_rules('settings_value', 'Settings value', 'required');
            $this->form_validation->set_rules('setting_amount', 'Settings amount', 'numeric');
            if($this->form_validation->run() == TRUE){
                  
                if(is_numeric($this->input->post("settings_value"))){  
                    $setting_type = 'Number';
                }
                else { 
                    $setting_type = 'String';
                }
                if($this->input->post("setting_amount")){
                    $userdata = array(
                        "settings_value" => $this->input->post("settings_value",true),
                        "setting_type" => $setting_type,
                        "setting_amount" => $this->input->post("setting_amount",true)
                    );
                }
                else {
                    $userdata = array(
                        "settings_value" => $this->input->post("settings_value",true),
                        "setting_type" => $setting_type
                    );
                }  
                
                $condition = $this->input->post("settings_id",true);

                $result = $this->admin_model->adminsetting_modification($userdata,$condition);
                if($result){
                    sf( 'success_message', "Admin settings modified successfully" );
                    redirect("admin/adminsettings");
                }
                else {
                    sf('error_message', 'No modifications done');
                    redirect("admin/adminsettings");
                }
            }
           
            $this->gen_contents['details'] = $this->admin_model->get_adminsettings_byid($id);
            $this->gen_contents['page_heading'] = 'Admin Settings';
            $this->template->set_template('admin');
            $this->template->write_view('content', 'admin/adminsettingsmodification', $this->gen_contents);
            $this->template->render();
        }
        else {
            redirect("admin/adminsettings");
        }
    }
    
    public function adminsettingcreation() {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        
        $this->form_validation->set_rules('label', 'Label', 'required');
        $this->form_validation->set_rules('settings_value', 'Settings value', 'required');
        $this->form_validation->set_rules('setting_amount', 'Settings amount', 'numeric');
            if($this->form_validation->run() == TRUE){
                
                $label = $this->input->post("label");
                $title = preg_replace('/\s+/', '_', $label);
                if(is_numeric($this->input->post("settings_value"))){  
                    $setting_type = 'Number';
                }
                else { 
                    $setting_type = 'String';
                }  
                $userdata = array(
                    "label"  => $label,
                    "title" => $title,
                    "settings_value" => $this->input->post("settings_value",true),
                    "setting_type" => $setting_type,
                    "setting_amount" => $this->input->post("setting_amount",true),
                    "status" => '1'
                );

                $result = $this->admin_model->adminsetting_modification($userdata);
                if($result){
                    sf( 'success_message', "Admin settings created successfully" );
                    redirect("admin/adminsettings");
                }
                else {
                    sf('error_message', 'Admin settings not created,Please try again later');
                    redirect("admin/adminsettings");
                }
            }
            
        $this->gen_contents['details'] = $this->admin_model->get_admindetails();
        $this->gen_contents['page_heading'] = 'Admin Settings';
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/adminsettings', $this->gen_contents);
        $this->template->render();
    }
    
    public function adminsettings () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        $tblname = 'admin_settings`';
        $total_records = $this->admin_model->get_total_records($tblname); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'adminsettings';
        $config['total_rows']   = $total_records;
        $config['per_page']     = 25;
        $bs_init = $this->bspagination->config();
        
        $config = array_merge($config, $bs_init);
        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        
        
        $this->gen_contents['details'] = $this->admin_model->get_adminsettings_list($config['per_page'], $pagin);
        $this->gen_contents['page_heading'] = 'Admin Settings';        
        $this->template->set_template('admin');  
        $this->template->write_view('content', 'admin/adminsettingslist', $this->gen_contents);
        $this->template->render(); 
    }

    public function copierpromocodestatusupdate ($id = 0, $status = '') {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            if($status == 'Active'){
                $status_new = 'Inactive';
            }
            else {
                $status_new = 'Active';
            }
            $userdata = array(
                'status' => $status_new
            );
            $tbl_name = 'cc_promocode';
            $result = $this->admin_model->promocode_modification($userdata,$id,$tbl_name);
            if($result) {
                sf( 'success_message', "Promocode status updated successfully" );
                redirect("admin/promocodesettingscopierchoice");
            }
            else {
                sf( 'error_message', "Promocode status not updated,Please try again" );
                redirect("admin/promocodesettingscopierchoice");
            }
        }
        else {
            redirect("admin/promocodesettingscopierchoice");
        }
    }
    
    public function bannerpackagestatusupdate ($id = 0, $status = '') {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            if($status == '1'){
                $status_new = '0';
            }
            else {
                $status_new = '1';
            }
            $userdata = array(
                'status' => $status_new
            );
            $tbl_name = 'rotating_banner_packages';
            $result = $this->admin_model->rotating_banner_packages_modification($userdata,$id,$tbl_name);
            if($result) {
                sf( 'success_message', "Rotating banner packages status updated successfully" );
                redirect("admin/rotatingbannerpackages");
            }
            else {
                sf( 'error_message', "Rotating banner packages status not updated,Please try again" );
                redirect("admin/rotatingbannerpackages");
            }
        }
        else {
            redirect("admin/rotatingbannerpackages");
        }
    }
    
    public function promocodestatusupdate ($id = 0, $status = '') {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            $this->load->model('admin/admin_model');
            if($status == 'Active'){
                $status_new = 'Inactive';
            }
            else {
                $status_new = 'Active';
            }
            $userdata = array(
                'status' => $status_new
            );
            $tbl_name = 'ls_promocode';
            $result = $this->admin_model->promocode_modification($userdata,$id,$tbl_name);
            if($result) {
                sf( 'success_message', "Promocode status updated successfully" );
                redirect("admin/promocodesettings");
            }
            else {
                sf( 'error_message', "Promocode status not updated,Please try again" );
                redirect("admin/promocodesettings");
            }
        }
        else {
            redirect("admin/promocodesettings");
        }
    }
    
    public function packagestatusupdate ($id = 0, $status = '') {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
            if($status == 'A'){
                $status_new = 'D';
            }
            else {
                $status_new = 'A';
            }
            $userdata = array(
                'status' => $status_new
            );
            $tbl_name = 'packages';
            $result = $this->admin_model->package_modification($userdata,$id,$tbl_name);
            if($result) {
                sf( 'success_message', "Packages status updated successfully" );
                redirect("admin/packages");
            }
            else {
                sf( 'error_message', "Packages status not updated,Please try again" );
                redirect("admin/packages");
            }
        }
        else {
            redirect("admin/packages");
        }
    }

    public function emailalertstatusupdate ($id = 0, $status = '') {   
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){
             $status = urldecode($status);   
            if($status == 'off'){
                $status_new = '0';
            }
            else {
                $status_new = '1';
            }
            $userdata = array(
                'status' => $status_new
            );
            $result = $this->admin_model->emailalert_modification($userdata,$id);
            if($result) {
                sf( 'success_message', "Email alert settings modified successfully" );
                redirect("admin/emailalertsettings");
            }
            else {
                sf( 'error_message', "Email alert settings not modified,Please try again" );
                redirect("admin/emailalertsettings");
            }
        }
        else {
            redirect("admin/emailalertsettings");
        }
    }
    
    public function feedbackstatusupdate ($id = 0, $status = '',$lead_id = 0) {  
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        if($id != 0 && is_numeric($id)){      
            $this->load->model('admin/admin_model');
            $this->load->model('web_model');
             $status = urldecode($status); 
             $date_time = date('Y-m-d H:i:s');
            if($status == 'reject'){
                $status_new = '2';
            }
            else {
                $status_new = '1';
            }
            $userdata = array(
                'refund_approved' => $status_new,
                'refund_date' => $date_time
            );
            $result = $this->admin_model->feedback_modification($userdata,$id);
            if($result) {          
                
                $lead_details = $this->admin_model-> get_lead_details_byid($lead_id);
                
                $supplier_data = $this->admin_model-> get_supplierid_byfeedback_id($id);
                $supplier_id = $supplier_data['userID'];
                
                $supplier_details = $this->admin_model-> get_supplier_details_byid($supplier_id);
                
                
                $this->load->helper('email_helper');
                $this->gen_contents["mail_template"]  =  $this->web_model->get_mail_template(16);
                $message = '<p>Your refund request was declined this time. <br><br> If you feel your refund request has been unfairly declined, please let us know by contacting us.</p>';  
                //echo $message; exit;
                $mail_body  = sprintf($this->gen_contents["mail_template"]["mail_body"],$supplier_details['contact_name'],$message);
                $mail_to = $supplier_details['email'];

                $subject    = 'Refund request';
                $from_name  = $this->gen_contents["mail_template"]["mail_from_name"];
                $from_email = $this->gen_contents["mail_template"]["mail_from"];
                send_mail($mail_to, $from_name,$subject,$mail_body,$from_email);   
            
                sf( 'success_message', "Refund request rejected successfully" );
                redirect("admin/managerefund");
            }
            else {
                sf( 'error_message', "Refund status not rejected,Please try again" );
                redirect("admin/managerefund");
            }
        }
        else {
            redirect("admin/managerefund");
        }
    }
    
    public function devicepricesettings () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $tblname = 'cc_device_price`';
        $total_records = $this->admin_model->get_total_records($tblname); 
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'devicepricesettings';
        $config['total_rows']   = $total_records;
        $config['per_page']     = 25;
        $bs_init = $this->bspagination->config();
        
        $config = array_merge($config, $bs_init);
        
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        
        $this->gen_contents['details'] = $this->admin_model->get_deviceprice_details($config['per_page'], $pagin);
        $this->gen_contents['page_heading'] = 'Device Price Settings';
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/device_price_settingslist', $this->gen_contents);
        $this->template->render();
      
    }
    
     public function devicepricesettingcreation () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        $this->form_validation->set_rules('price', 'Device price', 'required');
        $this->form_validation->set_rules('device_type', 'Type', 'required');
        $this->form_validation->set_rules('device_speed', 'Speed', 'required');
        $this->form_validation->set_rules('device_model', 'Model', 'required');
        $this->form_validation->set_rules('device_color', 'Color', 'required');
        
            if($this->form_validation->run() == TRUE){
                
                $device_type = $this->input->post("device_type",true);
                $device_color = $this->input->post("device_color",true);
                $device_speed = $this->input->post("device_speed",true);
                $device_model = $this->input->post("device_model",true);
                
                $userdata = array(
                    "type_id"  => $device_type,
                    "color_id"  => $device_color,
                    "speed_id"  => $device_speed,
                    "model_id"  => $device_model,
                    "price" => $this->input->post("price",true)
                );
                
                 
                $checking_price_code = $this->admin_model->checking_device_details($device_type,$device_color,$device_speed,$device_model);
                if($checking_price_code){ 
                    $price_id = $checking_price_code['price_id'];
                    $result = $this->admin_model->device_price_modify($userdata,$price_id);
                }
                else {  
                      $result = $this->admin_model->device_price_insert($userdata);
                }
                
                if($result){
                    sf( 'success_message', "Device price modified successfully" );
                    redirect("admin/devicepricesettings");
                }
                else {
                    sf('error_message', 'No modifications done');
                    redirect("admin/devicepricesettings");
                }
            }
            
            $this->gen_contents['device_color'] = $this->admin_model->get_device_color();
            $this->gen_contents['device_type'] = $this->admin_model->get_device_type();
            $this->gen_contents['device_speed'] = $this->admin_model->get_device_speed();
            $this->gen_contents['device_model'] = $this->admin_model->get_device_model();
            $this->gen_contents['page_heading'] = 'Device Price Settings';
            $this->template->set_template('admin');
            $this->template->write_view('content', 'admin/devicepricecreation', $this->gen_contents);
            $this->template->render();
    }
    
    public function leadpricesettings () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        
        if($this->input->post("record_page_limit")){
            $this->session->set_userdata('page_limit', $this->input->post("record_page_limit"));
            $config['per_page']   = s('page_limit');   
        }
        else {
            $config['per_page']   = 25;
        } 
        
        $this->gen_contents['per_page'] = $config['per_page'];      
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $this->gen_contents['details'] = $this->admin_model->get_leadprice_details($config['per_page'], $pagin);
        $total_records = $this->admin_model->get_total_rows();
        
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'leadpricesettings';
        $config['total_rows']   = $total_records;
        $bs_init = $this->bspagination->config();
        $config = array_merge($config, $bs_init);
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();  
       
        $this->gen_contents['page_heading'] = 'Lead Price Settings';
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/lead_price_settingslist', $this->gen_contents);
        $this->template->render();
    }
    
    public function leadpricesettingcreation () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        
        $this->form_validation->set_rules('price', 'Lead price', 'required|numeric');
        $this->form_validation->set_rules('lead_type', 'Lead type', 'required');
            if($this->form_validation->run() == TRUE){
                $data = '';
                $price_code = '';
                if($this->input->post("question_id")) {  
                    foreach($this->input->post("question_id") as $key => $val){
                        $question_ids = $this->input->post('question_id');  
                        $question_id = $question_ids[$key];    // echo $question_id; exit;
                        if($this->input->post("answer")){
                            $ans_id = $this->input->post("answer");
                            $answer_id = $ans_id[$key]; 
                        }
                        
                        $data .= 'Q'.$question_id.'(A'.$answer_id.')_' ;
                    }
                }
                $price_code = rtrim($data, "_"); 
                 
                $userdata = array(
                    "lead_type_id"  => $this->input->post("lead_type",true),
                    "price_code" => $price_code,
                    "price" => $this->input->post("price",true)
                );
                $checking_price_code = $this->admin_model->checking_price_code($price_code,$this->input->post("lead_type",true));
                if($checking_price_code){ 
                    $result = $this->admin_model->lead_price_combination_modify($userdata,$price_code);
                }
                else {  
                      $result = $this->admin_model->lead_price_combination_insert($userdata);
                }
                
                if($result){
                    sf( 'success_message', "Lead price modified successfully" );
                    redirect("admin/leadpricesettings");
                }
                else {
                    sf('error_message', 'No modifications done');
                    redirect("admin/leadpricesettings");
                }
            }
            
            $this->gen_contents['lead_type'] = $this->admin_model->get_lead_types();
            $this->gen_contents['page_heading'] = 'Lead Price Settings';
            $this->template->set_template('admin');
            $this->template->write_view('content', 'admin/leadpricecreation', $this->gen_contents);
            $this->template->render();
    }
    
    public function getleadpricelist () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        $lead_type_id = $this->input->post("data");
        $msg = '';
        if($lead_type_id != 0){
            $get_questions = $this->admin_model->get_leadquestions_byid($lead_type_id);
            if($get_questions) {
                foreach ($get_questions as $qetn){
                    $question_id = $qetn['question_id'];
                    $msg .= $qetn['question'];
                    $msg .= '<input type = "hidden" name = "question_id[]" value = '.$qetn['question_id'].'>';
                    $get_answers = $this->admin_model->get_leadanswers_byid($question_id);
                    if($get_answers){
                        $msg .= "<select name = 'answer[]' class = 'form-control'>";
                        foreach ($get_answers as $ans){ 
                            $msg .= '<option value = '.$ans['aid'].'>'.$ans['answer'].'</option>';
                            
                        }
                        $msg .= "</select>";
                    }
                }
            }
            $msg .= "<div class='form-group'>
                        <label for='price' class='control-label'>Price</label>
                        <div class='input-icon right'>
                        <input type = 'text' name = 'price' class = 'form-control' required>
                        </div>
                    </div>";
            $output = array("status" => "1", "msg" => $msg);
            echo json_encode($output);
            exit;
        }
    }
    
    public function getenquirylist () {
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';
        $this->load->model('admin/admin_model');
        $enquiry_type = $this->input->post("data");  
        $msg = '';
        if($enquiry_type == 'leads2sales'){
            $tbl_name = 'ls_enquiries';
            $enquirylist =  $this->admin_model->get_copier_enquies_list($tbl_name);
        }
        else {
            $tbl_name = 'cc_enquiries';
            $enquirylist =  $this->admin_model->get_copier_enquies_list($tbl_name);
        }

        if($enquirylist) {         
            foreach ($enquirylist as $enquiry){

                $msg .= "<li class='in enquirylist'>
                            <img src='".assets_url()."images/avatar/user.png' class='avatar img-responsive' />
                            <div class='message'>
                                <span class='chat-arrow'></span><a href='#' class='chat-name'>
                                    ".$enquiry['name']."</a>&nbsp;
                                        <span  class='chat-datetime'>at '".date('M D Y H:i:s', strtotime($enquiry['date_time']))."'</span>
                                        <span class='chat-body'>".$enquiry['message']."
                                </span>
                            </div>
                        </li>";
            }
        }
        $output = array("status" => "1", "msg" => $msg);
        echo json_encode($output);
        exit;
    }
    
    public function excel () {  
        
        $lead_values = $this->input->post("leads_values");  
        $leads = unserialize(base64_decode($lead_values));  
        
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Leads Report');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Leads Report Excel Sheet');
        $this->excel->getActiveSheet()->setCellValue('A4', 'Sl.no.');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Lead ID');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Name');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Email');
        $this->excel->getActiveSheet()->setCellValue('E4', 'City/Suburb');
        $this->excel->getActiveSheet()->setCellValue('F4', 'Star level');
        $this->excel->getActiveSheet()->setCellValue('G4', 'Source');
        $this->excel->getActiveSheet()->setCellValue('H4', 'Status');
        $this->excel->getActiveSheet()->setCellValue('I4', 'Submission date');
        $this->excel->getActiveSheet()->setCellValue('J4', 'Mobile Number');
        $this->excel->getActiveSheet()->setCellValue('K4', 'Address');
        $this->excel->getActiveSheet()->setCellValue('L4', 'Job Title');
        $this->excel->getActiveSheet()->setCellValue('M4', 'Company Name');
        $this->excel->getActiveSheet()->setCellValue('N4', 'Phone(Business)');
        $this->excel->getActiveSheet()->setCellValue('O4', 'Country');
        $this->excel->getActiveSheet()->setCellValue('P4', 'City');
        $this->excel->getActiveSheet()->setCellValue('Q4', 'State');
        $this->excel->getActiveSheet()->setCellValue('R4', 'Postcode');
        $this->excel->getActiveSheet()->setCellValue('S4', 'Business Type');
        $this->excel->getActiveSheet()->setCellValue('T4', 'Industry');
        $this->excel->getActiveSheet()->setCellValue('U4', 'Number of Employees');
        $this->excel->getActiveSheet()->setCellValue('V4', 'Future Communication');
        $this->excel->getActiveSheet()->setCellValue('W4', 'Lead Price');
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:W1');
        //set aligment to center for that merged cell
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A4:W4')->getFont()->setBold(true);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
        
        for($col = ord('A'); $col <= ord('W'); $col++){
           //set column dimension
           $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
           $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

           $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
        //Show table values
        $exceldata = "";
        $row = 5;
        $no = 1;
        foreach ($leads as $lead){
            
            if($lead['source'] != '')
                $source = $lead['source'];
            else 
                $source = '---';
                                
            $this->excel->getActiveSheet()->setCellValue('A'.$row,$no);
            $this->excel->getActiveSheet()->setCellValue('B'.$row,$lead['lead_id']);
            $this->excel->getActiveSheet()->setCellValue('C'.$row,$lead['first_name'] . ' ' . $lead['last_name']);
            $this->excel->getActiveSheet()->setCellValue('D'.$row,$lead['email']);
            $this->excel->getActiveSheet()->setCellValue('E'.$row,$lead['city_suburb']);
            $this->excel->getActiveSheet()->setCellValue('F'.$row,$lead['star_level']);
            $this->excel->getActiveSheet()->setCellValue('G'.$row,$source);
            $this->excel->getActiveSheet()->setCellValue('H'.$row,$lead['submission_status']);
            $this->excel->getActiveSheet()->setCellValue('I'.$row,date('d-M-Y', strtotime($lead['date_time'])));
            $this->excel->getActiveSheet()->setCellValue('J'.$row,$lead['mobile']);
            $this->excel->getActiveSheet()->setCellValue('K'.$row,$lead['address1']);
            $this->excel->getActiveSheet()->setCellValue('L'.$row,$lead['job_title']);
            $this->excel->getActiveSheet()->setCellValue('M'.$row,$lead['company_name']);
            $this->excel->getActiveSheet()->setCellValue('N'.$row,$lead['business_phone']);
            $this->excel->getActiveSheet()->setCellValue('O'.$row,$lead['country']);
            $this->excel->getActiveSheet()->setCellValue('P'.$row,$lead['city_suburb']);
            $this->excel->getActiveSheet()->setCellValue('Q'.$row,$lead['state']);
            $this->excel->getActiveSheet()->setCellValue('R'.$row,$lead['postcode']);
            $this->excel->getActiveSheet()->setCellValue('S'.$row,$lead['business_type']);
            $this->excel->getActiveSheet()->setCellValue('T'.$row,$lead['industry']);
            $this->excel->getActiveSheet()->setCellValue('U'.$row,$lead['num_employees']);
            $this->excel->getActiveSheet()->setCellValue('V'.$row,$lead['marketing_option']);
            $this->excel->getActiveSheet()->setCellValue('W'.$row,$lead['lead_price']);

            $row++;
            $no++;
        }
           
        $filename = 'Leads_report.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        ob_end_clean();
        $objWriter->save('php://output');
    }
    
    public function excel_preregister () {  
        
        $details_values = $this->input->post("details_values");  
        $details = unserialize(base64_decode($details_values));  
        
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Pre Registration Report');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Pre Registration Report Excel Sheet');
        $this->excel->getActiveSheet()->setCellValue('A4', 'Sl.no.');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Name');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Functions');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Company name');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Email');
        $this->excel->getActiveSheet()->setCellValue('F4', 'Mobile');
        $this->excel->getActiveSheet()->setCellValue('G4', 'Phone');
        $this->excel->getActiveSheet()->setCellValue('H4', 'Suburb');
        $this->excel->getActiveSheet()->setCellValue('I4', 'Postcode');
        $this->excel->getActiveSheet()->setCellValue('J4', 'State');
        $this->excel->getActiveSheet()->setCellValue('K4', 'Country');
        $this->excel->getActiveSheet()->setCellValue('L4', 'Industry');
        $this->excel->getActiveSheet()->setCellValue('M4', 'Lead type');
        $this->excel->getActiveSheet()->setCellValue('N4', 'T/as');
        $this->excel->getActiveSheet()->setCellValue('O4', 'Notification option');
        $this->excel->getActiveSheet()->setCellValue('P4', 'Keep up to date');
        $this->excel->getActiveSheet()->setCellValue('Q4', 'How did you hear about us');
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:Q1');
        //set aligment to center for that merged cell
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A4:Q4')->getFont()->setBold(true);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
        
        for($col = ord('A'); $col <= ord('Q'); $col++){
           //set column dimension
           $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
           $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

           $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
        //Show table values
        $exceldata = "";
        $row = 5;
        $no = 1;
        foreach ($details as $data){
            
            if($data['notification'] == '1') {
                $notification = 'Email';
            }
            else if($data['notification'] == '0') {
                $notification = 'SMS';
            }
            else {
                $notification = 'Both email and sms';
            }
                    
            if($data['agree_update'] == '1') {
                $agree_update = 'Yes';
            }
            else {
                $agree_update = 'No';
            }
                                
            $this->excel->getActiveSheet()->setCellValue('A'.$row,$no);
            $this->excel->getActiveSheet()->setCellValue('B'.$row,$data['first_name'] . ' ' . $data['last_name']);
            $this->excel->getActiveSheet()->setCellValue('C'.$row,$data['functions']);
            $this->excel->getActiveSheet()->setCellValue('D'.$row,$data['company_name']);
            $this->excel->getActiveSheet()->setCellValue('E'.$row,$data['email']);
            $this->excel->getActiveSheet()->setCellValue('F'.$row,$data['mobile']);
            $this->excel->getActiveSheet()->setCellValue('G'.$row,$data['phone']);
            $this->excel->getActiveSheet()->setCellValue('H'.$row,$data['city_suburb']);
            $this->excel->getActiveSheet()->setCellValue('I'.$row,$data['postcode']);
            $this->excel->getActiveSheet()->setCellValue('J'.$row,$data['state']);
            $this->excel->getActiveSheet()->setCellValue('K'.$row,$data['country']);
            $this->excel->getActiveSheet()->setCellValue('L'.$row,$data['industry_name']);
            $this->excel->getActiveSheet()->setCellValue('M'.$row,$data['type_of_leads']);
            $this->excel->getActiveSheet()->setCellValue('N'.$row,$data['t_as']);
            $this->excel->getActiveSheet()->setCellValue('O'.$row,$notification);
            $this->excel->getActiveSheet()->setCellValue('P'.$row,$agree_update);
            $this->excel->getActiveSheet()->setCellValue('Q'.$row,$data['hear_about']);   

            $row++;
            $no++;
        }
           
        $filename = 'Pre_registration_report.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        ob_end_clean();
        $objWriter->save('php://output');
    }
    
    public function excel_leadprice () {  
        
        $details_values = $this->input->post("details_values");  
        $details = unserialize(base64_decode($details_values));  
        
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Lead Price Report');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Lead Price Excel Sheet');
        $this->excel->getActiveSheet()->setCellValue('A4', 'Sl.no.');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Lead Type');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Price Code');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Question');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Answer');
        $this->excel->getActiveSheet()->setCellValue('F4', 'Price');
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:F1');
        //set aligment to center for that merged cell
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A4:F4')->getFont()->setBold(true);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
        
        for($col = ord('A'); $col <= ord('F'); $col++){
           //set column dimension
           $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
           $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

           $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
        //Show table values
        $exceldata = "";
        $row = 5;
        $no = 1;
        foreach ($details as $data){
             
            $question = '';
            $answer = '';

            $qus_ans_list = explode("_", $data['price_code']);  
            foreach ($qus_ans_list as $qustn_ans) {
                $qus_ans_list = explode("(", $qustn_ans); 

                if($qus_ans_list[0] != '') {  
                    $qid = substr($qus_ans_list[0], 1); 
                    $qustion = get_leadprice_question($qid);
                    $question .= $qustion['question'].',';
                }
                if($qus_ans_list[1] != '') {   
                    $ansid = substr($qus_ans_list[1], 1, -1);  
                    $answerlist = get_leadprice_answer($ansid);
                    $answer .= $answerlist['answer'].',';
                }
            }
                                
            $this->excel->getActiveSheet()->setCellValue('A'.$row,$no);
            $this->excel->getActiveSheet()->setCellValue('B'.$row,$data['lead_type']);
            $this->excel->getActiveSheet()->setCellValue('C'.$row,$data['price_code']);
            $this->excel->getActiveSheet()->setCellValue('D'.$row,rtrim($question,','));
            $this->excel->getActiveSheet()->setCellValue('E'.$row,rtrim($answer,','));
            $this->excel->getActiveSheet()->setCellValue('F'.$row,$data['price']);

            $row++;
            $no++;
        }
           
        $filename = 'Leads_price_report.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        ob_end_clean();
        $objWriter->save('php://output');
    }
    
    public function excel_feedback () {  
        
        $details_values = $this->input->post("details_values");  
        $details = unserialize(base64_decode($details_values));  
        
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Feedback Report');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Feedback Report Excel Sheet');
        $this->excel->getActiveSheet()->setCellValue('A4', 'Sl.no.');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Lead ID');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Seller');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Lead/Supplier');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Star Rating');
        $this->excel->getActiveSheet()->setCellValue('F4', 'Lead Price');
        $this->excel->getActiveSheet()->setCellValue('G4', 'Lead Status');
        $this->excel->getActiveSheet()->setCellValue('H4', 'Comments');
        $this->excel->getActiveSheet()->setCellValue('I4', 'Type');
        $this->excel->getActiveSheet()->setCellValue('J4', 'Created Date');
        $this->excel->getActiveSheet()->setCellValue('K4', 'Status');
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        //set aligment to center for that merged cell
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A4:K4')->getFont()->setBold(true);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
        
        for($col = ord('A'); $col <= ord('K'); $col++){
           //set column dimension
           $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
           $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

           $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
        //Show table values
        $exceldata = "";
        $row = 5;
        $no = 1;
        foreach ($details as $data){
            
            if($data['refund_approved'] == '1') {
                
                $style_status = 'label label-success';
                $button_data = 'Approved';
                $color = 'green';
            }
            else if($data['refund_approved'] == '0') {

                $style_status = 'label label-warning';
                $button_data = 'Pending';
                $color = 'blue';
            }
            else if($data['refund_approved'] == '2') { 

                $style_status = 'label label-red';
                $button_data = 'Rejected';
                $color = 'red';
            }
            else {

                $style_status = 'label label-warning';
                $button_data = '---';
                $color = 'blue';
            }                 
            if($data['lead_id'] != '0'){
                $type = 'Lead';
            }
            else {
                $type = 'Sellcopier';
            }
            if($data['lead_status'] == 'Completed'){
                $lead_status = 'Won';
            }
            else if($data['lead_status'] == 'Used by Some other Supplier'){
                $lead_status = 'Lost';
            }
            else {
                $lead_status = $data['lead_status'];
            }  
            
            if($data['lead_id'] == 0 && $data['sellcopier_id'] != '0'){
                $sellcopier_details = get_sellcopier_details_feedback_report($data['sellcopier_id']);
                if($sellcopier_details) {
                    $lead_id = $sellcopier_details['id'];
                    $contact_name = $sellcopier_details['name'];
                    $price = $sellcopier_details['supplier_price'];
                }
                else {
                    $lead_id = '0';
                    $contact_name = '';
                    $price = '';
                }
            }
            else {
                $lead_id = $data['lead_id'];
                $contact_name = $data['first_name'].' ' .$data['last_name'];
                $price = $data['lead_price'];
            }
                                
            $this->excel->getActiveSheet()->setCellValue('A'.$row,$no);
            $this->excel->getActiveSheet()->setCellValue('B'.$row,$lead_id);
            $this->excel->getActiveSheet()->setCellValue('C'.$row,$data['contact_name']);
            $this->excel->getActiveSheet()->setCellValue('D'.$row,$contact_name);
            $this->excel->getActiveSheet()->setCellValue('E'.$row,$data['star_rating']);
            $this->excel->getActiveSheet()->setCellValue('F'.$row,$price);
            $this->excel->getActiveSheet()->setCellValue('G'.$row,$lead_status);
            $this->excel->getActiveSheet()->setCellValue('H'.$row,$data['comments']);
            $this->excel->getActiveSheet()->setCellValue('I'.$row,$type);
            $this->excel->getActiveSheet()->setCellValue('J'.$row,date('d-M-Y', strtotime($data['created_date'])));          
            $this->excel->getActiveSheet()->setCellValue('K'.$row,$button_data);

            $row++;
            $no++;
        }
           
        $filename = 'Feedback_report.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        ob_end_clean();
        $objWriter->save('php://output');
    }
    
    public function excel_dropout () {  
        
        $lead_values = $this->input->post("leads_values");  
        $leads = unserialize(base64_decode($lead_values));  
        
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Drop-Out Leads Report');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Drop-Out Leads Report Excel Sheet');
        $this->excel->getActiveSheet()->setCellValue('A4', 'Sl.no.');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Lead ID');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Name');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Email');
        $this->excel->getActiveSheet()->setCellValue('E4', 'City/Suburb');
        $this->excel->getActiveSheet()->setCellValue('F4', 'Star level');
        $this->excel->getActiveSheet()->setCellValue('G4', 'Source');
        $this->excel->getActiveSheet()->setCellValue('H4', 'Submission date');
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:H1');
        //set aligment to center for that merged cell
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A4:H4')->getFont()->setBold(true);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
        
        for($col = ord('A'); $col <= ord('H'); $col++){
           //set column dimension
           $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
           $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

           $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
        //Show table values
        $exceldata = "";
        $row = 5;
        $no = 1;
        foreach ($leads as $lead){
            
            if($lead['source'] != '')
                $source = $lead['source'];
            else 
                $source = '---';
                                
            $this->excel->getActiveSheet()->setCellValue('A'.$row,$no);
            $this->excel->getActiveSheet()->setCellValue('B'.$row,$lead['lead_id']);
            $this->excel->getActiveSheet()->setCellValue('C'.$row,$lead['first_name'] . ' ' . $lead['last_name']);
            $this->excel->getActiveSheet()->setCellValue('D'.$row,$lead['email']);
            $this->excel->getActiveSheet()->setCellValue('E'.$row,$lead['city_suburb']);
            $this->excel->getActiveSheet()->setCellValue('F'.$row,$lead['star_level']);
            $this->excel->getActiveSheet()->setCellValue('G'.$row,$source);
            $this->excel->getActiveSheet()->setCellValue('H'.$row,date('d-M-Y', strtotime($lead['date_time'])));

            $row++;
            $no++;
        }
           
        $filename = 'Drop-OutLeads_report.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        ob_end_clean();
        $objWriter->save('php://output');
    }
    
    public function excel_suppliers () {  
        
        $user_values = $this->input->post("user_values");  
        $user_details = unserialize(base64_decode($user_values));  
        
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Suppliers Report');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Suppliers List Excel Sheet');
        $this->excel->getActiveSheet()->setCellValue('A4', 'Sl.no.');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Name');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Company');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Email');
        $this->excel->getActiveSheet()->setCellValue('E4', 'City/Suburb');
        $this->excel->getActiveSheet()->setCellValue('F4', 'Postcode');
        $this->excel->getActiveSheet()->setCellValue('G4', 'Status');
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:G1');
        //set aligment to center for that merged cell 
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A4:G4')->getFont()->setBold(true);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
        
        for($col = ord('A'); $col <= ord('G'); $col++){
           //set column dimension
           $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
           $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

           $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
        //Show table values
        $exceldata = "";
        $row = 5;
        $no = 1;
        foreach ($user_details as $user){
            
                                
            $this->excel->getActiveSheet()->setCellValue('A'.$row,$no);
            $this->excel->getActiveSheet()->setCellValue('B'.$row,$user['contact_name']);
            $this->excel->getActiveSheet()->setCellValue('C'.$row,$user['company_name']);
            $this->excel->getActiveSheet()->setCellValue('D'.$row,$user['email']);
            $this->excel->getActiveSheet()->setCellValue('E'.$row,$user['city']);
            $this->excel->getActiveSheet()->setCellValue('F'.$row,$user['postcode']);
            $this->excel->getActiveSheet()->setCellValue('G'.$row,$user['status']);

            $row++;
            $no++;
        }
           
        $filename = 'Suppliers_Report.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        ob_end_clean();
        $objWriter->save('php://output');
    }
    
    public function excel_suppliers_profile () {  
        
        $details_values = $this->input->post("details_values");  
        $details = unserialize(base64_decode($details_values));  
        
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Supplier Profile Status Report');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Supplier Profile Status List Excel Sheet');
        $this->excel->getActiveSheet()->setCellValue('A4', 'Sl.no.');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Name');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Company');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Email');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Preference Status');
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:E1');
        //set aligment to center for that merged cell 
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A4:E4')->getFont()->setBold(true);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
        
        for($col = ord('A'); $col <= ord('E'); $col++){
           //set column dimension
           $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
           $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

           $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
        //Show table values
        $exceldata = "";
        $row = 5;
        $no = 1;
        foreach ($details as $user){
            
            $check_status = check_preference_status($user['userID']);
             if($check_status){
                $color = 'green';
                $text = 'Updated';
            }
            else {
                $color = 'red';
                $text = 'Not updated';
            }
            
            $this->excel->getActiveSheet()->setCellValue('A'.$row,$no);
            $this->excel->getActiveSheet()->setCellValue('B'.$row,$user['contact_name']);
            $this->excel->getActiveSheet()->setCellValue('C'.$row,$user['company_name']);
            $this->excel->getActiveSheet()->setCellValue('D'.$row,$user['email']);
            $this->excel->getActiveSheet()->setCellValue('E'.$row,$text);

            $row++;
            $no++;
        }
           
        $filename = 'Suppliers_Profile_Status_Report.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        ob_end_clean();
        $objWriter->save('php://output');
    }
    
    public function excelbuyerguide () {  
        
        $buyerguide_values = $this->input->post("buyerguide_values");  
        $buyerguide = unserialize(base64_decode($buyerguide_values));  
        
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Buyer Guide Report');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Buyer Guide List Excel Sheet');
        $this->excel->getActiveSheet()->setCellValue('A4', 'Sl.no.');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Date');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Name');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Email');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Suburb');
        //$this->excel->getActiveSheet()->setCellValue('D4', 'Lead ID');
        $this->excel->getActiveSheet()->setCellValue('F4', 'organization');
        $this->excel->getActiveSheet()->setCellValue('G4', 'Brand');
        $this->excel->getActiveSheet()->setCellValue('H4', 'No. Devices');
        $this->excel->getActiveSheet()->setCellValue('I4', 'Contract Expire');
        $this->excel->getActiveSheet()->setCellValue('J4', 'Expected Delivery');
        $this->excel->getActiveSheet()->setCellValue('K4', 'Satisfactory');
        $this->excel->getActiveSheet()->setCellValue('L4', 'Download Status');
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:L1');
        //set aligment to center for that merged cell 
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A4:L4')->getFont()->setBold(true);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
        
        for($col = ord('A'); $col <= ord('L'); $col++){
           //set column dimension
           $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
           $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

           $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
        //Show table values
        $exceldata = "";
        $row = 5;
        $no = 1;
        foreach ($buyerguide as $buyer){
            
            if($buyer['survey_date'] == '0000-00-00 00:00:00'){
                $date = '0000-00-00';
            }   
            else {
                $date = date('d-M-Y', strtotime($buyer['survey_date']));
            }
            if($buyer['suburb_postcode'] == ''){
                $suburb = '---';
            }   
            else {
                $suburb = $buyer['suburb_postcode'];
            }
                                
            $this->excel->getActiveSheet()->setCellValue('A'.$row,$no);
            $this->excel->getActiveSheet()->setCellValue('B'.$row,$date);
            $this->excel->getActiveSheet()->setCellValue('C'.$row,$buyer['fname'] . ' ' . $buyer['lname']);
            $this->excel->getActiveSheet()->setCellValue('D'.$row,$buyer['email']);
            $this->excel->getActiveSheet()->setCellValue('E'.$row,$suburb);
            //$this->excel->getActiveSheet()->setCellValue('D'.$row,$buyer['lead_id']);
            $this->excel->getActiveSheet()->setCellValue('F'.$row,$buyer['org_name']);
            $this->excel->getActiveSheet()->setCellValue('G'.$row,$buyer['brand']);
            $this->excel->getActiveSheet()->setCellValue('H'.$row,$buyer['num_devices']);
            $this->excel->getActiveSheet()->setCellValue('I'.$row,$buyer['contract_expire']);
            $this->excel->getActiveSheet()->setCellValue('J'.$row,$buyer['expected_delivery']);
            $this->excel->getActiveSheet()->setCellValue('K'.$row,$buyer['satisfactory']);
            $this->excel->getActiveSheet()->setCellValue('L'.$row,$buyer['download_status']);

            $row++;
            $no++;
        }               
           
        $filename = 'Buyer_Guide_Report.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        ob_end_clean();
        $objWriter->save('php://output');
    }
    
    public function excelsellcopier () {  
        
        $details_values = $this->input->post("details_values");  
        $details = unserialize(base64_decode($details_values));  
        
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Sell Your Copier');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Sell Your Copier Excel Sheet');
        $this->excel->getActiveSheet()->setCellValue('A4', 'Sl.no.');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Lead ID');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Name');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Email');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Suburb');
        $this->excel->getActiveSheet()->setCellValue('F4', 'Quantity');
        $this->excel->getActiveSheet()->setCellValue('G4', 'Company');
        $this->excel->getActiveSheet()->setCellValue('H4', 'Submission date');
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:H1');
        //set aligment to center for that merged cell 
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A4:H4')->getFont()->setBold(true);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
        
        for($col = ord('A'); $col <= ord('H'); $col++){
           //set column dimension
           $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
           $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

           $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
        //Show table values
        $exceldata = "";
        $row = 5;
        $no = 1;
        foreach ($details as $data){
                           
            $this->excel->getActiveSheet()->setCellValue('A'.$row,$no);
            $this->excel->getActiveSheet()->setCellValue('B'.$row,$data['id']);
            $this->excel->getActiveSheet()->setCellValue('C'.$row,$data['name']);
            $this->excel->getActiveSheet()->setCellValue('D'.$row,$data['email']);
            $this->excel->getActiveSheet()->setCellValue('E'.$row,$data['suburb']);
            $this->excel->getActiveSheet()->setCellValue('F'.$row,$data['quantity']);
            $this->excel->getActiveSheet()->setCellValue('G'.$row,$data['company']);
            $this->excel->getActiveSheet()->setCellValue('H'.$row,date('d-M-Y', strtotime($data['date_time'])));

            $row++;
            $no++;
        }               
           
        $filename = 'Sell_Your_Copier_Report.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        ob_end_clean();
        $objWriter->save('php://output');
    }
    
    public function excelpaymentreports () {  
        
        $details_values = $this->input->post("details_values");  
        $details = unserialize(base64_decode($details_values));  
        
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Payment Reports');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Payment Reports Excel Sheet');
        $this->excel->getActiveSheet()->setCellValue('A4', 'Sl.no.');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Contact Name');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Description');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Amount');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Date');
        $this->excel->getActiveSheet()->setCellValue('F4', 'Payment Email');
        $this->excel->getActiveSheet()->setCellValue('G4', 'Payment Status');
        $this->excel->getActiveSheet()->setCellValue('H4', 'Payment Note');
        $this->excel->getActiveSheet()->setCellValue('I4', 'Status');
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:I1');
        //set aligment to center for that merged cell 
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A4:I4')->getFont()->setBold(true);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
        
        for($col = ord('A'); $col <= ord('I'); $col++){
           //set column dimension
           $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
           $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

           $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
        //Show table values
        $exceldata = "";
        $row = 5;
        $no = 1;
        foreach ($details as $data){
             
            if($data['transaction'] != '') {
                $transaction = $data['transaction'];  
            }
            else {
                $transaction_details = explode(',', $data['description']);
                $transaction = $transaction_details[0];
            }

            if($data['trans_details'] != ''){
                $payment_details = unserialize($data['trans_details']);
                $payment_status = $payment_details['payment_status'];
                $payment_email = $payment_details['receiver_email'];
                $note = array_key_exists('memo',$payment_details) ? $payment_details['memo'] : "";
            }
            else {
                $payment_status = '---';
                $payment_email = '---';
                $note = '---';
            }  
                                
            $this->excel->getActiveSheet()->setCellValue('A'.$row,$no);
            $this->excel->getActiveSheet()->setCellValue('B'.$row,$data['contact_name']);
            $this->excel->getActiveSheet()->setCellValue('C'.$row,$transaction);
            $this->excel->getActiveSheet()->setCellValue('D'.$row,$data['amount']);
            $this->excel->getActiveSheet()->setCellValue('E'.$row,date('d-M-Y', strtotime($data['date'])));
            $this->excel->getActiveSheet()->setCellValue('F'.$row,$payment_email);
            $this->excel->getActiveSheet()->setCellValue('G'.$row,$payment_status);
            $this->excel->getActiveSheet()->setCellValue('H'.$row,$note);  
            $this->excel->getActiveSheet()->setCellValue('I'.$row,$data['status']);

            $row++;
            $no++;
        }               
           
        $filename = 'Payment_Report.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        ob_end_clean();
        $objWriter->save('php://output');
    }
    
    public function excelcredithistory () {  
        
        $details_values = $this->input->post("details_values");  
        $details = unserialize(base64_decode($details_values));  
        
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Credit History');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Sales History');
        $this->excel->getActiveSheet()->setCellValue('A4', 'Sl.no.');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Supplier ID');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Supplier Name');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Reason');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Company');
        $this->excel->getActiveSheet()->setCellValue('F4', 'Debit');
        $this->excel->getActiveSheet()->setCellValue('G4', 'Credit');
        $this->excel->getActiveSheet()->setCellValue('H4', 'Paid');
        $this->excel->getActiveSheet()->setCellValue('I4', 'Date');
        $this->excel->getActiveSheet()->setCellValue('J4', 'Status');
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:J1');
        //set aligment to center for that merged cell 
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A4:J4')->getFont()->setBold(true);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
        
        for($col = ord('A'); $col <= ord('J'); $col++){
           //set column dimension
           $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
           $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

           $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
        //Show table values
        $exceldata = "";
        $row = 5;
        $no = 1;
        foreach ($details as $data){
             
            if($data['transaction'] != '') {
                $transaction = $data['transaction'];  
            }
            else {
                $transaction_details = explode(',', $data['description']);
                $transaction = $transaction_details[0];
            }
            if($data['amount'] < 0 ){
                $amount = abs($data['amount']);
            }
            else {
                $amount =  '-';
            }
            if($data['amount'] >= 0) {
                $credit = $data['amount'];
            }
            else {
                $credit = '-';
            }
            if($data['credits_nr'] >= 0) {
                $credit_amount = $data['credits_nr'];
            }
            else {
                $credit_amount = '-';
            }

            $this->excel->getActiveSheet()->setCellValue('A'.$row,$no);
            $this->excel->getActiveSheet()->setCellValue('B'.$row,$data['userID']);
            $this->excel->getActiveSheet()->setCellValue('C'.$row,$data['contact_name']);
            $this->excel->getActiveSheet()->setCellValue('D'.$row,$transaction);       
            $this->excel->getActiveSheet()->setCellValue('E'.$row,$data['company_name']);
            $this->excel->getActiveSheet()->setCellValue('F'.$row,$amount);
            $this->excel->getActiveSheet()->setCellValue('G'.$row,$credit_amount);
            $this->excel->getActiveSheet()->setCellValue('H'.$row,$credit);         
            $this->excel->getActiveSheet()->setCellValue('I'.$row,date('d-M-Y', strtotime($data['date'])));
            $this->excel->getActiveSheet()->setCellValue('J'.$row,$data['status']);

            $row++;
            $no++;
        }               
           
        $filename = 'Credit_History.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        ob_end_clean();
        $objWriter->save('php://output');
    }
    
    public function excelleadmatchhistory () {  
        
        $details_values = $this->input->post("details_values");  
        $details = unserialize(base64_decode($details_values));  
        
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Lead Match History');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Lead Match History Excel Sheet');
        $this->excel->getActiveSheet()->setCellValue('A4', 'Sl.no.');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Lead ID');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Name');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Mail received suppliers');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Suppliers purchased');
        $this->excel->getActiveSheet()->setCellValue('F4', 'Date');
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:F1');
        //set aligment to center for that merged cell 
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A4:F4')->getFont()->setBold(true);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
        
        for($col = ord('A'); $col <= ord('F'); $col++){
           //set column dimension
           $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
           $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

           $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
        //Show table values
        $exceldata = "";
        $row = 5;
        $no = 1;
        foreach ($details as $data){

            $this->excel->getActiveSheet()->setCellValue('A'.$row,$no);
            $this->excel->getActiveSheet()->setCellValue('B'.$row,$data['lead_id']);
            $this->excel->getActiveSheet()->setCellValue('C'.$row,$data['first_name'] . ' ' . $data['last_name']);
            $this->excel->getActiveSheet()->setCellValue('D'.$row,$data['match_count']);       
            $this->excel->getActiveSheet()->setCellValue('E'.$row,$data['purchase_count']);       
            $this->excel->getActiveSheet()->setCellValue('F'.$row,date('d-M-Y', strtotime($data['date_time'])));

            $row++;
            $no++;
        }               
           
        $filename = 'Lead_Match_History.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        ob_end_clean();
        $objWriter->save('php://output');
    }
    
    public function update_popular_products () {   
        
        $get_details = $this->admin_model->get_popular_product_details();  
        if($get_details) {
            foreach ($get_details as $product) {
                $title = $product['product_title'];
                $pid = $product['pid'];
                $clean_url = $this->url_slug($title);
                $clean_url = $clean_url.'.html';
                
                $userdata = array(
                    "clean_url"  => $clean_url
                );
                
                $update_product = $this->admin_model->update_popular_products($userdata,$pid);
            }
        }
    }
    
    public function update_old_db_values() {
        $old_db_values = $this->admin_model->get_old_db_values(); 
        $data = array();
        $datas = array();
        if($old_db_values) {
            foreach ($old_db_values as $key => $value) { 
                
               $data = array( 
                   "lead_id" => $value['ID'],  
                   "title" => $value['Title'],  
                   "first_name" => $value['First_Name'],  
                   "last_name" => $value['Last_Name'],  
                   "job_title" => $value['Job_Title'],  
                   "company_name" => '',
                    "address1" => $value['Address_1'],
                    "address2" => $value['Address_2'],
                    "country" => $value['Country'],
                    "city_suburb" => $value['City'],
                    "state" => $value['State'],
                    "postcode" => $value['Postcode'],
                    "business_postcode" => '', 
                    "email" => $value['Email'],
                    "business_phone" => $value['Business_Phone'],
                    "mobile" => $value['Mobile'],
                    "preffered_contact_method" => $value['Preferred_Contact_Method'],
                    "business_type" => $value['Business_Type'],
                    "business_size" => $value['Business_Size'],
                    "industry" => $value['Industry'],
                    "num_employees" => '',
                    "marketing_option" => 'yes',
                    "promo_id" => '',
                    "star_level" => 0,
                    "lead_price" => 0,
                    "date_time" => $value['Submission_Date'],
                    "ip_address" => $value['IP_Address'],
                    "sess_id" => '',
                    "submission_status" => 'Completed',
                    "mail_sent_count" => 0,
                    "payment_status_count" => 0
               );
               
               $datas[$key]   = $data;
               
               //$insert_old_values = $this->admin_model->insert_old_db_values($data); 
            }
        
            if(!empty($datas)){  
                if($this->admin_model->insert_old_db_values_batch($datas)){
                    
                }
            }
        } 
    }
    
}