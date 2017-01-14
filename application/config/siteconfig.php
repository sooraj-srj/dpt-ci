<?php

// For the script that is running:

//if (!defined('DOCUMENT_ROOT'))
//    define('DOCUMENT_ROOT', str_replace('application/config', '', substr(__FILE__, 0, strrpos(__FILE__, '/'))));
//$script_directory = substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'], '/'));
$CI = &get_instance();
//$config['site_baseurl'] = $CI->config->item('site_baseurl');
//$config['site_basepath'] = constant("DOCUMENT_ROOT");
//
//$config['styles_path_url'] = $config['site_baseurl'] . 'assets/styles/';
//$config['css_path_url'] = $config['site_baseurl'] . 'assets/css/';
//$config['js_path_url'] = $config['site_baseurl'] . 'assets/js/';
//
//$config['images_path'] = $config['site_basepath'] . 'assets/images/';
//$config['image_url'] = $config['site_baseurl'] . 'assets/images/';



switch (ENVIRONMENT) {
    case 'development':
        $config['admin_mail'] = 'sooraj.v@rainconcert.in';
        $config['admin_name'] = 'Sooraj V';
        break;
    case 'testing':
        $config['admin_mail'] = 'admin@copierchoice.com.au';
        $config['admin_name'] = 'CopierChoice';
        break;
    case 'production':
        $config['admin_mail'] = 'admin@copierchoice.com.au';
        $config['admin_name'] = 'CopierChoice';
        break;
    default:
        $config['admin_mail'] = 'sooraj.v@rainconcert.in';
        $config['admin_name'] = 'Sooraj V';
        break;
}
//Email template constants
$config['CC_ENQUIRY_MAIL_TEMPLATE']     = 5;
$config['BG_MAIL_TEMPLATE']             = 6;
//$config['LEAD_MAIL_TEMPLATE']           = 7;
$config['ALERT_MAIL_TEMPLATE']          = 9;
$config['LEAD_MAIL_TEMPLATE']           = 14;
$config['VALUATION_MAIL_TEMPLATE']      = 15;

//leads2sale.com.au site url
switch (ENVIRONMENT){
    case 'development':
        $config['l2s_url']          = "http://leads2sales.com.au/beta/";
        $config['l2s_signin_url']   = "http://leads2sales.com.au/beta/signin/";
        break;
    case 'testing':
        $config['l2s_url']          = "http://leads2sales.com.au/beta/";
        $config['l2s_signin_url']   = "http://leads2sales.com.au/beta/signin/";
        break;
    case 'production':
        $config['l2s_url']          = "http://leads2sales.com.au/";
        $config['l2s_signin_url']   = "http://leads2sales.com.au/signin/";
        break;
    default:
        $config['l2s_url']          = "http://leads2sales.com.au/";
        $config['l2s_signin_url']   = "http://leads2sales.com.au/signin/";
        break;
}

