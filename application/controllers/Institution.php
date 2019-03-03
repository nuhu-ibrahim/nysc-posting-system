<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Institution extends CI_Controller {
    /**
     * Index page for Magazine controller.
     */
    public function add_institution() {
        $this->is_logged_in();
        $user = $this->getUser();

        $success = "false";
        $header = "Add new institution Information";
        $sub_header = "Welcome, you can add new institution information here";
        $error = array();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('InstitutionModel');
        
        $institution = new InstitutionModel();
        $is_active = 0;
        
        if(isset($_POST['save'])){
            $this->form_validation->set_rules(array(
                array(
                    'rules' => 'required',
                    'field' => 'institution_title',
                    'label' => 'institution title',
                    'errors' => array('required' => 'Please provide the %s.',),
                ),
            )); 

            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
            
            $institution->institution_title = $this->input->post('institution_title');
            
            $query = $this->db->get_where('institution_list', array(
                'institution_title'=> $this->input->post('institution_title')
            ));
            
            $row = $query->row();
            
            if($this->form_validation->run()){
                if(isset($row)){
                    $error[] = "An institution with thesame title already exist.";
                }
            }
            
            if(count($error) > 0 || !$this->form_validation->run()){
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('institution/add_institution', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, "success"=>$success, "institution"=>$institution));
                $this->load->view('template/footer');
            }else{
                $this->db->trans_start();
                
                $institution->save();
                
                $this->db->trans_complete();
                
                redirect("add-institution?success=true");
             
            }
        }else{
            $this->load->view('template/header', array("user"=>$user));
            $this->load->view('institution/add_institution', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, "success"=>$success, "institution"=>$institution));
            $this->load->view('template/footer');
        } 
    }
    
    public function edit_institution($id) {
        $this->is_logged_in();
        $user = $this->getUser();
 
        $is_active = 0;
        
        $success = "false";
        $header = "Edit institution Information";
        $sub_header = "Welcome, you can edit the institution information here";
        $error = array();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('InstitutionModel');
        
        $institution = new InstitutionModel();
        
        if(isset($id)){
            $institution->load($id);
            if($institution->id === null){
                redirect(base_url("view-institutions"));
            }
        }else{
            redirect(base_url("view-institutions"));
        }
         
        if(isset($_POST['save'])){
            $this->form_validation->set_rules(array(
                array(
                    'rules' => 'required',
                    'field' => 'institution_title',
                    'label' => 'institution title',
                    'errors' => array('required' => 'Please provide the %s.',),
                ),
            )); 

            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
            
            $institution->institution_title = $this->input->post('institution_title');
            
            $query = $this->db->get_where('institution_list', array(
                'institution_title'=> $this->input->post('institution_title'), 'id !='=>$institution->id
            ));
            
            $row = $query->row();
            
            if($this->form_validation->run()){
                if(isset($row)){
                    $error[] = "An institution with thesame title already exist.";
                }
            }
            
            if(count($error) > 0 || !$this->form_validation->run()){
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('institution/edit_institution', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, "success"=>$success, 'institution'=>$institution));
                $this->load->view('template/footer');
            }else{
                $this->db->trans_start();

                $institution->update($institution->id);
                
                $this->db->trans_complete();
                
                redirect("edit-institution/".$institution->id."?success=true");
             
            }
        }else{
            $this->load->view('template/header', array("user"=>$user));
            $this->load->view('institution/edit_institution', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, "success"=>$success, 'institution'=>$institution));
            $this->load->view('template/footer');
        } 
        
    }
    
    public function delete_institution($id) {
        $this->is_logged_in();
        $user = $this->getUser();
        
        $this->load->model('PostModel');
        $this->load->model('CandidateModel');
        $this->load->model('VoteModel');
        
        $post = new PostModel();
        
        if(isset($id)){
            $post->load($id);
            if($post->post_id === null){
                redirect(base_url("view-posts"));
            }
        }else{
            redirect(base_url("view-posts"));
        }
        
        $this->db->trans_start();

        $candidate = new CandidateModel();
        $vote = new VoteModel();
        
        $candidates= $this->CandidateModel->get();
        
        foreach($candidates as $ca){
            if($ca->post_id == $id){
                $candidate = $ca;
                
                $query = $this->db->query("delete from vote_info where vote_info.candidate_id = '$candidate->candidate_id'");
                $candidate->delete();
            }
        }
        
        $post->delete();

        $this->db->trans_complete();

        redirect("view-posts");
    }
    
    public function view_institutions(){
        $this->is_logged_in();
        $user = $this->getUser();
        
        $header = "View Institution Information";
        $sub_header = "Welcome, you can edit institution information here by clicking edit on the institution record.";
        
        $this->load->model('InstitutionModel');
        
        $institution = new InstitutionModel();
 
        $institutions= $this->InstitutionModel->get();
        
        $institutions_to_view = array();
        foreach($institutions as $institution){
                $institutions_to_view[$institution->id] = $institution;
        }        
        
        $this->load->view('template/header', array("user"=>$user));
        $this->load->view('institution/view_institutions', array("user"=>$user, 'header' => $header, "sub_header" => $sub_header, "institutions"=>$institutions_to_view));
        $this->load->view('template/footer');
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

