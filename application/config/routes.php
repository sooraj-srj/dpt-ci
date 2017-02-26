<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'web';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//---------- front end routing ---------------

$route['about']         = "web/about";
$route['contact']       = "web/contact";  
$route['gallery']       = "web/gallery"; 
$route['reviews']       = "web/reviews"; 
$route['our-guide']     = "web/our_guide"; 
$route['tourist-visa']  = "web/tourist_visa"; 
$route['plan']          = "web/plan"; 
$route['why-us']        = "web/why_us"; 
$route['faqs']         	= "web/faq"; 
$route['careers']       = "web/careers"; 
$route['terms-and-conditions']  = "web/terms"; 

$route['tours/(:any)']        	= "web/select_tours/$1"; 
$route['plan/(:any)/(:any)']  	= "web/select_plan/$1/$2"; 
$route['plan-appln']          	= "web/plan_appln"; 
//manage transfer service
$route['transfer/(:any)']       = "web/select_transfer/$1"; 
$route['thank-you']          	= "web/thankyou"; 
$route['visa-appln']          	= "web/visa_appln"; 
$route['askme-appln']          	= "web/askme_appln"; 
$route['review-appln']         	= "web/review_appln"; 
$route['contact-appln']         = "web/contact_appln"; 


//----------- admin common routing ------------
$route['admin']             = "admin/user/index";
$route['admin/login']       = "admin/user/index";
$route['admin/logout']      = "admin/user/logout";
$route['admin/dashboard']   = "admin/admin";
// manage categories
$route['admin/categories']                = "admin/admin/categories";
$route['admin/categories/(:any)']         = "admin/admin/categories/$1";
$route['admin/categories/(:any)/(:any)']  = "admin/admin/categories/$1/$2";
// manage emirates
$route['admin/emirates']                  = "admin/admin/emirates";
$route['admin/emirates/(:any)']           = "admin/admin/emirates/$1";
$route['admin/emirates/(:any)/(:any)']    = "admin/admin/emirates/$1/$2";
// manage emirates
$route['admin/tours']                  = "admin/admin/tours";
$route['admin/tours/(:any)']           = "admin/admin/tours/$1";
$route['admin/tours/(:any)/(:any)']    = "admin/admin/tours/$1/$2";
// manage emirates
$route['admin/tour-booking']           = "admin/admin/tour_bookings";
$route['admin/tour-booking/(:any)']    = "admin/admin/tour_bookings_details/$1";
//$route['admin/booking-appln/(:any)/(:any)']    = "admin/admin/booking_appln/$1/$2";
$route['admin/booking-appln']    	   = "admin/admin/booking_appln";

$route['admin/transfer-service-booking']           = "admin/admin/transfer_service_bookings";
$route['admin/transfer-service-booking/(:any)']    = "admin/admin/tour_bookings_details/$1";

$route['admin/email-template']         = "admin/admin/manage_email_template";

//manage gallery
$route['admin/gallery']                  = "admin/admin/gallery";
$route['admin/gallery/(:any)']           = "admin/admin/gallery/$1";
$route['admin/gallery/(:any)/(:any)']    = "admin/admin/gallery/$1/$2";

$route['admin/gallery-images/(:any)']    = "admin/admin/gallery_images/$1";
$route['admin/upload']    				= "admin/dropzone/upload";

$route['admin/menu']                  	= "admin/admin/menu";
$route['admin/menu/(:any)']           	= "admin/admin/menu/$1";
$route['admin/menu/(:any)/(:any)']   	= "admin/admin/menu/$1/$2";

$route['admin/reviews']                  	= "admin/admin/list_reviews";
$route['admin/reviews/(:any)/(:any)']       = "admin/admin/list_reviews/$1/$2";
$route['admin/questions']                  	= "admin/admin/list_questions";

$route['admin/agents']                  = "admin/admin/agents";
$route['admin/agents/(:any)']           = "admin/admin/agents/$1";
$route['admin/agents/(:any)/(:any)']    = "admin/admin/agents/$1/$2";







 
