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

 //function email header
 function email_header($user_name = "", $message = ""){
     $email_header = '<html>
     <head>
     <meta charset="utf-8">
     <title>Untitled Document</title>
     <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
     </head>

     <body>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tbody>
         <tr>
           <td><table width="624" border="0" align="center" cellpadding="0" cellspacing="0">
             <tbody>
               <tr>
                 <td width="624"><table width="600" border="0" cellspacing="0" cellpadding="0">
                   <tbody>
                     <tr>
                       <td><img src="http://www.dubaiprivatetour.com/beta/assets/images/logo.png" width="130" height="50" alt=""/></td>
                       <td>&nbsp;</td>
                     </tr>
                   </tbody>
                 </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                     <tbody>
                       <tr>
                         <td><img src="http://www.dubaiprivatetour.com/beta/assets/images/banner.JPG" width="100%"></td>
                       </tr>
                     </tbody>
                   </table>
                   <table width="100%" border="0" cellspacing="0" cellpadding="0">
                     <tbody>
                       <tr>
                         <td>
                         <h4 style="text-align:center;font-family: Roboto, sans-serif; background-color:#2BB9F4; color:#fff;
                         padding:10px; margin:0;">Confirmed Booking</h4>
                         <p style="font-family: Roboto, sans-serif; margin:2px 0; font-size:15px; font-weight:bold;">Dear '.$user_name.' ,</p>
                           <p style="font-family: Roboto, sans-serif; margin:10px 0; font-size:14px;">'.$message.'</p></td>
                       </tr>
                     </tbody>
                   </table>
                   
                   
                   <p style="font-family: Roboto, sans-serif; font-size:14px;">';
     return $email_header;
 }

 //function to get email footer 
 function email_footer(){
     $email_footer = '<table border="0" cellpadding="0" cellspacing="0">
                       <tbody>
                         <tr>
                           <td><table border="0" cellpadding="0" cellspacing="0">
                             <tbody>
                               <tr>
                                 <td width="100%"><p style="padding:0px; margin:0px;font-family: Roboto, sans-serif;"><strongThanks</strong></p>
                                   <p style="padding:0px; margin:0px;font-family: Roboto, sans-serif;"><strong>Dubai Private Tours</strong></p>               
                                   <p style="padding:0px; margin:0px;font-family: Roboto, sans-serif;">Visit us @ <a href="http://www.milantoursdubai.com/" target="_blank">www.milantoursdubai.com</a></p>
                                   <p style="padding:0px; margin:0px;font-family: Roboto, sans-serif;">Visit  us @ <a href="http://www.dubaiprivatetour.com/" target="_blank">www.dubaiprivatetour.com</a></p></td>
                               </tr>
                             </tbody>
                           </table></td>
                           <td> </td>
                         </tr>
                       </tbody>
                     </table>
                     <table border="0" cellpadding="1" cellspacing="1">
                       <tbody>
                         <tr>
                           <td width="389"><a href="http://www.milantoursdubai.com/"><img alt="" src="http://www.dubaiprivatetour.com/beta/assets/images/milan.jpg"></a> <a href="https://www.tripadvisor.in/Attraction_Review-g295424-d2510773-Reviews-Dubai_Private_Tour-Dubai_Emirate_of_Dubai.html"><img alt="" src="http://www.dubaiprivatetour.com/beta/assets/images/ta-dpt.jpg"></a> <a href="https://www.facebook.com/DubaiPrivatTour?fref=ts"><img alt="" src="http://www.dubaiprivatetour.com/beta/assets/images/fb-follow.jpg"></a></td>
                         </tr>
                       </tbody>
                     </table>
                     <br>
                              </td>
                              </tr>
                            </tbody>
                          </table></td>
                        </tr>
                      </tbody>
                    </table>
                    </body>
                    </html>';
     return $email_footer;
 }