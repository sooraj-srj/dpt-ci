<?php

class Admin_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        ini_set("display_errors", "0");
        error_reporting(0);
    }
    
    
    
}
