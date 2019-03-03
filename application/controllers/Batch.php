<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Batch extends CI_Controller {
    /**
     * Index page for Magazine controller.
     */
    public function add_batch() {
        $this->is_logged_in();
        
        $user = $this->getUser();
        
        $success = "false";
        $header = "Profile Batch Information";
        $sub_header = "Welcome, you can add a new batch information here";
        $error = array();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('BatchModel');
        
        $batch = new BatchModel();
        $is_active = 0;
        
        $batchs= $this->BatchModel->get();
        
        foreach($batchs as $el){
            if($el->is_active == 1){
                $is_active = 1;
            }
        }
        
        if(isset($_POST['save'])){
            $this->form_validation->set_rules(array(
                array(
                    'rules' => 'required',
                    'field' => 'batch_title',
                    'label' => 'batch title',
                    'errors' => array('required' => 'Please provide the %s.',),
                ),
            )); 

            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');

            $batch->batch_title = $this->input->post('batch_title');
            
            $query = $this->db->get_where('batch_list', array(
                'batch_title'=> $this->input->post('batch_title'),
            ));
            
            $row = $query->row();
            
            if($this->form_validation->run()){
                if(isset($row)){
                    $error[] = "A batch with thesame title already exist.";
                }
            }
            
            if(count($error) > 0 || !$this->form_validation->run()){
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('batch/add_batch', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, "success"=>$success, 'batch'=>$batch));
                $this->load->view('template/footer');
            }else{
                $this->db->trans_start();
                
                $batch->is_active = 1;
                $batch->save();
                
                $this->db->trans_complete();
                
                redirect("add-batch?success=true");
             
            }
        }else{
            $this->load->view('template/header', array("user"=>$user));
            $this->load->view('batch/add_batch', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, "success"=>$success, 'batch'=>$batch));
            $this->load->view('template/footer');
        } 
    }
    
    public function edit_batch() {
        $this->is_logged_in();
        $user = $this->getUser();
        
        $success = "false";
        $header = "Edit Batch Information";
        $sub_header = "Welcome, you can edit the active batch information here";
        $error = array();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('BatchModel');
        
        $batch = new BatchModel();
        $is_active = 0;
        
        $batchs= $this->BatchModel->get();
       
        foreach($batchs as $el){
            if($el->is_active == 1){
                $batch = $el;
            }
        }
        
        if(isset($_POST['save'])){
            $this->form_validation->set_rules(array(
                array(
                    'rules' => 'required',
                    'field' => 'batch_title',
                    'label' => 'batch title',
                    'errors' => array('required' => 'Please provide the %s.',),
                ),
            )); 

            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
            
            $batch->batch_title = $this->input->post('batch_title');
            
            $query = $this->db->get_where('batch_list', array(
                'batch_title'=> $this->input->post('batch_title'), 'batch_id !='=>$batch->batch_id
            ));
            
            $row = $query->row();
            
            if($this->form_validation->run()){
                if(isset($row)){
                    $error[] = "A batch with thesame title already exist.";
                }
            }
            
            if(count($error) > 0 || !$this->form_validation->run()){
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('batch/edit_batch', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, "success"=>$success, 'batch'=>$batch));
                $this->load->view('template/footer');
            }else{
                $this->db->trans_start();

                $batch->update($batch->batch_id);
                
                $this->db->trans_complete();
                
                redirect("edit-batch?success=true");
             
            }
        }else{
            $this->load->view('template/header', array("user"=>$user));
            $this->load->view('batch/edit_batch', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, "success"=>$success, 'batch'=>$batch));
            $this->load->view('template/footer');
        } 
        
    }
    
    public function reset() {
        $this->is_logged_in();
        $user = $this->getUser();
        
        $success = "false";
        $header = "Reset NYSC System";
        $sub_header = "Welcome, notice that resetting the system sets it to default mode for a new batch, click the button below.";
        $error = array();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('BatchModel');
        
        $batch = new BatchModel();
        $is_active = 0;
        
        $batchs= $this->BatchModel->get();
       
        foreach($batchs as $el){
            if($el->is_active == 1){
                $batch = $el;
            }
        }
        
        if(isset($_POST['save'])){
            $this->db->trans_start();
            
            $batch->is_active = 0;
             
            $batch->update($batch->batch_id);

            $this->db->trans_complete();

            redirect("reset?success=true");
             
        }else{
            $this->load->view('template/header', array("user"=>$user));
            $this->load->view('batch/reset', array("user"=>$user, 'header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, "success"=>$success, 'batch'=>$batch));
            $this->load->view('template/footer');
        }    
    }
    
    public function is_logged_in() {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {	
            return true;
        }
        redirect("login");
    }
    
    public function getUser() {
        $this->load->model('AppUser');       
        $user = (new AppUser())->getUser();
        return $user;
    }
    
    public function date_validation($input) {
        $test_date = explode('-', $input);
        if (!@checkdate($test_date[1], $test_date[2], $test_date[0])) {
            $this->form_validation->set_message('date_validation', 'The %s field must be in YYYY-MM-DD format.');
            return FALSE;
        }
        return TRUE;
    }
}

