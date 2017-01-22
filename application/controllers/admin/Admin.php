<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
        $this->load->model('admin/admin_model');
    }

    public function index() {
        //$this->load->model('admin/admin_model');
        (!$this->authentication->check_logged_in("admin", false)) ? redirect('admin') : '';


        $this->gen_contents['page_heading'] = 'Dashboard';
        $this->template->set_template('admin');
        $this->template->write_view('content', 'admin/dashboard', $this->gen_contents);
        $this->template->render();
    }

}
