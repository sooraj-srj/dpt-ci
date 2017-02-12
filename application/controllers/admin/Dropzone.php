<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Dropzone extends CI_Controller {
  
    public function __construct() {
       parent::__construct();
       $this->load->helper(array('url','html','form'));
    }
 
    // public function index() {
    //     $this->load->view('dropzone_view');
    // }
    
    public function upload() {
        //if (!empty($_FILES)) {
        // $tempFile = $_FILES['file']['tmp_name'];
        // $fileName = $_FILES['file']['name'];
        // $targetPath = './images/gallery/';
        // echo $targetPath;
        // $targetFile = $targetPath . $fileName ;
        // move_uploaded_file($tempFile, $targetFile);

        if (!empty($_FILES['file']['name'])) { 
            $config['upload_path']          = './assets/images/gallery/';  
            $config['allowed_types']        = 'jpg|png';                
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')){
                  $upload_detail = $this->upload->data();
                  $image_name = $upload_detail["file_name"];
            }  

            $post_data['resource_id'] = $this->input->post("gallery_id",true);
            $post_data['file_name'] = $image_name;
            $this->load->model('admin/admin_model');
            $this->admin_model->update_gallery_image($post_data);

        }


        // if you want to save in db,where here
        // with out model just for example
        // $this->load->database(); // load database
        // $this->db->insert('file_table',array('file_name' => $fileName));
        //}
    }
}
 