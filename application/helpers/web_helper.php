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

 //function 
 function get_pickup_location($id){
     $CI =& get_instance();
     $CI->load->model('web_model');
     $pl = $CI->web_model->get_pickup_location_name($id);
     return $pl;
 }

 //function 
 function get_end_location($id){
     $CI =& get_instance();
     $CI->load->model('web_model');
     $el = $CI->web_model->get_end_location_name($id);
     return $el;
 }

//function to get menu
 function get_gallery_images($cat_id){
     $CI =& get_instance();
     $CI->load->model('admin/admin_model');
     $menu = $CI->admin_model->get_galleries($cat_id);
     return $menu;
 }

 function get_nationality($id){
    $CI =& get_instance();
    $CI->load->model('web_model');
    $nationality = $CI->web_model->get_nationality($id);
    return $nationality;
 }

 function get_emirates_tours($tour_id = '')
 {
    $CI =& get_instance();
    $CI->load->model('admin/admin_model');
    $emirates = $CI->admin_model->get_emirates_tours($tour_id);
    return $emirates;
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
                              padding:10px; margin:0;">'.$message.'</h4><br>
                              <p style="font-family: Roboto, sans-serif; margin:2px 0; font-size:15px; font-weight:bold;">Dear '.$user_name.',</p>
                         </td>
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
                                   <p style="padding:0px; margin:0px;font-family: Roboto, sans-serif;"><strong>Dubai Private Tours</strong></p> <br>    
                                   <p style="padding:0px; margin:0px;font-family: Roboto, sans-serif;">Visit us @ <a href="http://www.dubaiprivatetour.com/" target="_blank">www.dubaiprivatetour.com</a></p>          
                                   <p style="padding:0px; margin:0px;font-family: Roboto, sans-serif;">Visit us @ <a href="http://www.milantoursdubai.com/" target="_blank">www.milantoursdubai.com</a></p>
                                   </td>
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
                           <td width="389"><a href="http://www.milantoursdubai.com/"><img alt="" src="http://www.dubaiprivatetour.com/beta/assets/images/milan.jpg"></a> <a href="https://www.tripadvisor.in/Attraction_Review-g295424-d2510773-Reviews-Dubai_Private_Tour-Dubai_Emirate_of_Dubai.html"><img alt="" src="http://www.dubaiprivatetour.com/beta/assets/images/ta-dpt.jpg"></a> <a href="https://www.facebook.com/Dubaiprivatetour-1200810873344965/"><img alt="" src="http://www.dubaiprivatetour.com/beta/assets/images/fb-follow.jpg"></a></td>
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


 function get_message($flag = ''){
    $message = "";
    if($flag == 'booking'){
      $text1 = "booking";
      $text2 = "tour booking";
    }
    if($flag == 'enquiry'){
      $text1 = "enquiry";
      $text2 = "reply";
    }
    if($flag == 'booking_email'){
      $text1 = "booking";
      $text2 = "tour booking";
      $message .= "<p><h5>Greetings and thank you for choosing Dubai Private Tour !!!! </h5></p><br>";
    }
    if($flag == 'visa'){
      $text1 = "visa application";
      $text2 = "reply";
    }

    $message .= '<p><h4><b>We are in receipt of your '.$text1.' and you shall receive our '.$text2.' confirmation within the next 24 hours.</b></h4> <small>(Kindly do check your SPAM Folder in case the reply isn’t delivered in Inbox)</small></p>
      <p>In case of any urgent matter, kindly Call / Text / Whatsapp us in either of the below numbers 
      <br><b>+971-552501818 / +971-552554333</b></p>
      <p>We work on trust basis and do not request payment in advance.</p>
      <p>You may kindly choose to pay us on day of tour by <b>CASH / CARD</b>. We accept all major <b>CREDIT / DEBIT / AMEX / DINER’S / MASTER / MAESTRO</b>.</p>
      <p>We also do not have any cancellation policy. However, if there is any cancellation, kindly inform us in advance.</p>';
    return $message;
 }

 function get_tour_details_table($bd = array()){
    $tour_details = '<table width="100%" border="1" style="border-collapse: collapse;" cellpadding="5">
                  <tbody>
                    <tr>
                      <td width="21%"><u>Tour date</u></td>
                      <td width="36%"><u>Tour title</u></td>
                      <td width="20%"><u>Start time</u></td>
                      <td width="23%"><u>Duration</u></td>
                    </tr>
                    <tr>
                      <td>'.$bd['tour_date'].'</td>
                      <td>'.$bd['title'].'</td>
                      <td>'.$bd['pref_pickup_time'].'</td>
                      <td>'.$bd['duration'].'</td>
                    </tr>
                  </tbody>
                </table>';
      return $tour_details;
 }

 function get_traveler_details($bd = array()){
    $tra_details = '<table width="100%" border="0" style="font-size: 14px;">
                  <tbody>
                    <tr>
                      <td>
                    <p>Date booking made: <u>'.$bd['booking_date'].'</u></p>
                    <p>Traveler: '.$bd['firstName'].' '.$bd['lastName'].'</p>
                    <p>Traveler cell phone: '.$bd['countryCode1'].' '.$bd['cell_no1'].'</p>
                    </td>
                  </tr>
                <tbody>
                </table>';
      return $tra_details;
 }

 function get_extra_details($td = array()){

    $pickup_location  = $td['pickup_location'];
    $end_location     = $td['drop_location'];  
    //echo $pickup_location; exit;
    //========= pickup location ================
    if($td['pickup_location'] == 1){
      $pickup_location_data = '<small>Name: </small>'.$td['hotelName'].'<br>
                              <small>Address: </small>'.$td['hotelAddress'].'<br>
                              <small>Phone: </small>'.$td['hotelPhoneNo'].'<br>';
    }
    else if($td['pickup_location'] == '2' || $td['pickup_location'] == '3' || $td['pickup_location'] == '4' || $td['pickup_location'] == '5' || $td['pickup_location'] == '6') {
      $pickup_location_data = '<small>Flight Name: </small>'.$td['flightName'].'<br>
                              <small>Terminal Name: </small>'.$td['terminalName'].'<br>
                              <small>Flight Arrival: </small>'.$td['flightArrival'].'<br>
                              <small>Flight Departure: </small>'.$td['flightDeparture'].'<br>';

    }
    else if($td['pickup_location'] == '7' || $td['pickup_location'] == '8') {
        $pickup_location_data = '<small>Ship Name: </small>'.$td['shipName'].'<br>';
    }
    else if($td['pickup_location'] == '12') {
        $pickup_location_data = '<br><small>Address: </small>'.$td['start_lr_address'].'<br>
                                 <small>Phone: </small>'.$td['start_lr_phone'].'<br>';
    }
    else if($td['pickup_location'] == '13') {
        $pickup_location_data = '<small>Name: </small>'.$td['start_rest_name'].'<br>
                                  <small>Address: </small>'.$td['start_rest_address'].'<br>
                                  <small>Phone: </small>'.$td['start_rest_phone'].'<br>';
    }

    //========= drop location ================
    if($td['dropLocation'] == '1') {
        $drop_location_data = '<small>Name: </small>'.$td['endhotelName'].'<br>
                                <small>Address: </small>'.$td['endhotelAddress'].'<br>
                                <small>Phone: </small>'.$td['endhotelPhoneNo'].'<br>';
    }
    else if($td['dropLocation'] == '12') { 
        $drop_location_data = '<br><small>Address: </small>'.$td['end_lr_address'].'<br>
                              <small>Phone: </small>'.$td['end_lr_phone'].'<br>';     
    }                                            
    else if($td['dropLocation'] == '13') {
        $drop_location_data = '<small>Name: </small>'.$td['end_rest_name'].'<br>
                            <small>Address: </small>'.$td['end_rest_address'].'<br>
                            <small>Phone: </small>'.$td['end_rest_phone'].'<br>';
    } 
    else if($td['dropLocation'] == '16') { 
        $drop_location_data = '<small>Name: </small>'.$td['end_place_name'].'<br>
                              <small>Address: </small>'.$td['end_place_address'].'<br>
                              <small>Phone: </small>'.$td['end_place_phone'].'<br>';
    }

    //Price 
    if($td['currencyCode'] == 'USD($)'){ $price = $td['usd_price'].' USD'; }
    else if($td['currencyCode'] == 'AED'){ $price = $td['price'].' AED'; }
    else { $price = $td['price'].' AED'; }

    //number of people count
    $people = 'Adult(s) - '.$td['adultNo'].', Children(s) - '.$td['childNo'].', Infant(s), - '.$td['infantNo'];

    $extra_details = '<br><b>Number of people: </b>'.$people.'<br>
                      <b>Price: Cost of tour: </b>'.$price.'<br>
                      <b>Amount Guide Must collect </b>from traveler ( VISA / MASTER / IN CASH ) at start of tour:  <b>'.$price.'</b>
                      <br>
                      <b>Meeting Location: </b>'.$pickup_location.'<br>'.$pickup_location_data.'
                      <br>
                      <b>End location: </b>'.$end_location.'<br>'.$drop_location_data;
    return $extra_details;
 }

 //get email template for admin when a booking initiated
 function get_admin_tour_template($td = array()){     
    $pickup_location  = get_pickup_location($td['pickup_location']);
    $end_location     = get_end_location($td['dropLocation']);
    $nationality      = get_nationality($td['nationality']);
    $tour_date = explode('-',$td['tour_date']);
    $tour_date = $tour_date[2].'/'.$tour_date[1].'/'.$tour_date[0];

    $tour_details = '<table width="100%" border="1" style="font-size: 14px; border-collapse:collapse" cellpadding="7">
    <tr> <td>Full Name: </td> <td>'.$td['firstName'].' '.$td['lastName'].'</td> </tr>
    <tr> <td>Email: </td> <td>'.$td['email'].'</td> </tr>
    <tr> <td>Cell No: 1: </td> <td>'.$td['countryCode1'].' '.$td['cell_no1'].'</td> </tr>
    <tr> <td>Cell No: 2</td> <td>'.$td['countryCode2'].' '.$td['cell_no2'].'</td> </tr>
    <tr> <td>Nationality: </td> <td>'.$nationality.'</td> </tr>
    <tr> <td>Tour Date: </td> <td>'.$tour_date.'</td> </tr>';
    //========= pickup location ================
    if($td['pickup_location'] == 1){
      $pickup_location_data = '<small>Name: </small>'.$td['hotelName'].'<br>
                              <small>Address: </small>'.$td['hotelAddress'].'<br>
                              <small>Phone: </small>'.$td['hotelPhoneNo'].'<br>';
    }
    else if($td['pickup_location'] == '2' || $td['pickup_location'] == '3' || $td['pickup_location'] == '4' || $td['pickup_location'] == '5' || $td['pickup_location'] == '6') {
      $pickup_location_data = '<small>Flight Name: </small>'.$td['flightName'].'<br>
                              <small>Terminal Name: </small>'.$td['terminalName'].'<br>
                              <small>Flight Arrival: </small>'.$td['flightArrival'].'<br>
                              <small>Flight Departure: </small>'.$td['flightDeparture'].'<br>';

    }
    else if($td['pickup_location'] == '7' || $td['pickup_location'] == '8') {
        $pickup_location_data = '<small>Ship Name: </small>'.$td['shipName'].'<br>';
    }
    else if($td['pickup_location'] == '12') {
        $pickup_location_data = '<br><small>Address: </small>'.$td['start_lr_address'].'<br>
                                 <small>Phone: </small>'.$td['start_lr_phone'].'<br>';
    }
    else if($td['pickup_location'] == '13') {
        $pickup_location_data = '<small>Name: </small>'.$td['start_rest_name'].'<br>
                                  <small>Address: </small>'.$td['start_rest_address'].'<br>
                                  <small>Phone: </small>'.$td['start_rest_phone'].'<br>';
    }

    //========= drop location ================
    if($td['dropLocation'] == '1') {
        $drop_location_data = '<small>Name: </small>'.$td['endhotelName'].'<br>
                                <small>Address: </small>'.$td['endhotelAddress'].'<br>
                                <small>Phone: </small>'.$td['endhotelPhoneNo'].'<br>';
    }
    else if($td['dropLocation'] == '12') { 
        $drop_location_data = '<br><small>Address: </small>'.$td['end_lr_address'].'<br>
                              <small>Phone: </small>'.$td['end_lr_phone'].'<br>';     
    }                                            
    else if($td['dropLocation'] == '13') {
        $drop_location_data = '<small>Name: </small>'.$td['end_rest_name'].'<br>
                            <small>Address: </small>'.$td['end_rest_address'].'<br>
                            <small>Phone: </small>'.$td['end_rest_phone'].'<br>';
    } 
    else if($td['dropLocation'] == '16') { 
        $drop_location_data = '<small>Name: </small>'.$td['end_place_name'].'<br>
                              <small>Address: </small>'.$td['end_place_address'].'<br>
                              <small>Phone: </small>'.$td['end_place_phone'].'<br>';
    }

    $tour_details .='<tr><td><p>Pickup location: '.$pickup_location.'</p>'.$pickup_location_data.'</td> 
    <td><p>End Location: '.$end_location.'</p>'.$drop_location_data.'</td> </tr>
    <tr> <td>Preferred Pickup Time: </td> <td>'.$td['pref_pickup_time'].'</td> </tr>
    <tr> <td>Passenger Details: </td> <td>Adult(s) - '.$td['adultNo'].', Children(s) - '.$td['childNo'].', Infant(s) - '.$td['infantNo'].' </td> </tr>
    <tr> <td>Preferred Guide language: </td> <td>'.$td['preferedguide'].'</td> </tr>
    <tr> <td>Currency: </td> <td>'.$td['currencyCode'].'</td> </tr>
    <tr> <td>Payment Mode: </td> <td>'.$td['currencyMode'].'</td> </tr>
    <tr> <td>Special Requests: </td> <td>'.$td['specialRequests'].'</td> </tr>
    <tr> <td>How Did You Discover Us: </td> <td>'.$td['howfind'].'</td> </tr></table><br><br>';

    return $tour_details;
 }