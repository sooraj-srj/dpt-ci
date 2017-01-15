<?php

 if ( ! defined('BASEPATH')) {exit('No direct script access allowed');}
 
 function get_settings($slug = ''){
     $CI =& get_instance();
     $CI->load->model('web_model');
     $value = $CI->web_model->get_settings($slug);
     return $value;
 }
 
 function get_categories(){
     $CI =& get_instance();
     $CI->load->model('web_model');
     $categories = $CI->web_model->get_categories();
     return $categories;
 }