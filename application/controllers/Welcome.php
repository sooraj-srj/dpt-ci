<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    var $gen_contents = array();

    //default index page
    public function index() {
        $this->template->write_view('content', 'home', $this->gen_contents);
        $this->template->render();
    }
    // Autocomplete postcode 
    public function postcode_autocomplete() {  
        $keyword = $this->input->post("keyword");
        if($keyword != '') { 
            $this->load->model('web_model');  
            $result = $this->web_model->postcode_autocomplete($keyword); 
            if($result){ ?>
                <ul id="postcode-list">
                    <?php
                    foreach($result as $pcode) { ?>
                        <li  class = "postcodeautolist" onClick="selectpostcode('<?php echo $pcode["postcode"]; ?>');"><?php echo $pcode["postcode"]; ?></li>
                    <?php } ?>
                </ul>
            <?php }
        }
        
    }
    
    // Dynamic city dropdown values corresponding to postcode
    public function autocompletecity() {
        $data = $this->input->post("data"); 
        $this->load->model('web_model');  
        $result = $this->web_model->autocompletecity($data);
        $output_city = '';
        if($result){
            foreach($result as $city) { 
                $output_city .= '<option value = '.$city['cityID'].'_'.$city['city'].'>'.$city['city'].'</option>';
             }
        }
        
        $output = array("status" => "1", "city" => $output_city);
        echo json_encode($output);
        exit;
    }
    
    // Auto complete sell mycopier
    public function sellmycopier_autocomplete() {  
        $keyword = $this->input->post("keyword");
        $selector = $this->input->post("selector");
        if($keyword != '') { 
            $this->load->model('web_model');  
            $result = $this->web_model->get_cities_onsearch($keyword); 
            $this->gen_contents['postal'] =  $result;
            $postallist = array();
            if($result){ ?>
                <ul id="postcode-list-3qotes">
                    <?php
                    foreach($result as $pcode) { 
                        $value = $pcode["city"].'['.$pcode["postcode"].']';
                        $postcode = $pcode["postcode"];
                        $city = $pcode["city"];?>
                        <li  class = "autocompletesellmycopier" onClick="selectsellmycopiervalue('<?php echo $value; ?>','<?php echo $selector?>','<?php echo $city?>','<?php echo $postcode?>');"><?php echo $value; ?></li>
                    <?php } ?>
                </ul>
            <?php }
        } 
    }    
    
    public function sellmycopier_autocompletehome() {  
        $keyword = $this->input->post("keyword");
        $selector = $this->input->post("selector");
        if($keyword != '') { 
            $this->load->model('web_model');  
            $result = $this->web_model->get_cities_onsearch($keyword); 
            $this->gen_contents['postal'] =  $result;
            $postallist = array();
            if($result){ ?>
                <ul id="postcode-list-3qotes" style = "width: 48% ! important;">
                    <?php
                    foreach($result as $pcode) { 
                        $value = $pcode["city"].'['.$pcode["postcode"].']';
                        $postcode = $pcode["postcode"];
                        $city = $pcode["city"];?>
                        <li  class = "autocompletesellmycopier" onClick="selectsellmycopiervaluehome('<?php echo $value; ?>','<?php echo $selector?>','<?php echo $city?>','<?php echo $postcode?>');"><?php echo $value; ?></li>
                    <?php } ?>
                </ul>
            <?php }
        } 
    }  
    
    
    // Postcode auto complete for get 3 quotes
    public function postcode_autocomplete_get3quotes() {  
        $keyword = $this->input->post("keyword");
        $selector = $this->input->post("selector");
        if($keyword != '') { 
            $this->load->model('web_model');  
            $result = $this->web_model->postcode_autocomplete($keyword); 
            if($result){ ?>
                <ul id="postcode-list-3qotes">
                    <?php
                    foreach($result as $pcode) { ?>
                        <li  class = "postcodeautolist" onClick="selectpostcodevalue('<?php echo $pcode["postcode"]; ?>','<?php echo $selector?>');"><?php echo $pcode["postcode"]; ?></li>
                    <?php } ?>
                </ul>
            <?php }
        } 
    }
    
    // Suburb auto complete for get 3 quotes
    public function postcode_autocomplete_suburb () {
        $keyword = $this->input->post("keyword");
        $selector = $this->input->post("selector");
        if($keyword != '') { 
            $this->load->model('web_model');  
            $result = $this->web_model->suburb_autocomplete($keyword); 
            if($result){ ?>
                <ul id="postcode-list-3qotes">
                    <?php
                    foreach($result as $suburb) { ?>
                        <li  class = "suburbautolist" onClick="selectsuburb('<?php echo $suburb["city"]; ?>','<?php echo $selector?>');"><?php echo $suburb["city"]; ?></li>
                    <?php } ?>
                </ul>
            <?php }
        }
    }
    //lead suburb search
    public function lead_suburb_search () {
        $keyword = $this->input->post("keyword");
        $selector = $this->input->post("selector");
        $tabletype = $this->input->post("tabletype");
        if($keyword != '') { 
            $this->load->model('web_model');  
            $result = $this->web_model->lead_suburb_search_autocomplete($keyword,$tabletype); 
            if($result){ ?>
                <ul id="postcode-list-3qotes">
                    <?php
                    foreach($result as $suburb) { ?>
                        <li  class = "suburbautolist" onClick="selectsuburb_search('<?php echo $suburb["city_suburb"]; ?>','<?php echo $selector?>');"><?php echo $suburb["city_suburb"]; ?></li>
                    <?php } ?>
                </ul>
            <?php }
        }
    }

        // Take full city list 
    public function completecitylist(){
        $this->load->model('web_model');  
        $result = $this->web_model->get_cities();
        $cities = '';
        $cities .= '<option value="">Select Your Suburb</option>';
        if($result) {
            foreach($result as $city) { 
                 $cities .= '<option value = '.$city['cityID'].'>'.$city['city'].'</option>';
            }
        }
        
        $output = array("status" => "1", "city" => $cities);
        echo json_encode($output);
        exit;
    }
    
    /*
    *  Load Postal/Suburb Code
    */
    function load_postal_code() {
      $this->load->model('web_model');
      $search = $this->input->post('q');
      $this->gen_contents['postal'] = $this->web_model->get_cities_onsearch($search); 
      $postallist = array();
      
      if(!empty($this->gen_contents['postal'])){
          foreach ($this->gen_contents['postal'] as $postals) {
            $postallist[] = array('id' => $postals['cityID'], 'name' => $postals['city'].'['.$postals['postcode'].']','postalcode' => $postals['postcode'],'suburb' => $postals['city']);
          }
      }

      $this->gen_contents['ajax_value'] = json_encode($postallist);
      $this->load->view('ajax/ajax_view', $this->gen_contents);
    }

}
