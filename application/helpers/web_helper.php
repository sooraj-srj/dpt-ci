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

 //function to get emirates
 function get_emirates(){
 	$CI =& get_instance();
     $CI->load->model('admin/admin_model');
     $emirates = $CI->admin_model->get_emirates();
     return $emirates;
 }

 //function to get popular tours
 function get_tours($type="",$limit=6){
     $CI =& get_instance();
     $CI->load->model('web_model');
     $tours = $CI->web_model->get_tours($type,$limit);
     return $tours;
 }

 //function to get menu
 function get_menu(){
     $CI =& get_instance();
     $CI->load->model('admin/admin_model');
     $menu = $CI->admin_model->get_menu();
     return $menu;
 }