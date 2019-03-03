<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PPA extends CI_Controller {
    /**
     * Index page for Magazine controller.
     */
    public function add_PPA() {
        $this->is_logged_in();
        $user = $this->getUser();

        $success = "false";
        $header = "Place of Primary Assignment";
        $sub_header = "Welcome, you can add new place of primary assignment here.";
        $error = array();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('PPAModel');
        $this->load->model('StateModel');
        
        $ppa = new PPAModel();
        $state = new StateModel();
        
        $states= $this->StateModel->get();
        
        $states_to_view = array(''=>'--Select--');
        foreach($states as $ins){
            $states_to_view[$ins->state_id] = $ins->state_title;
        }
        
        if(isset($_POST['save'])){
            $this->form_validation->set_rules(array(
                array(
                    'rules' => 'required',
                    'field' => 'state_id',
                    'label' => 'state',
                    'errors' => array('required' => 'Please select the %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'ppa_name',
                    'label' => 'name',
                    'errors' => array('required' => 'Please provide organization\'s %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'ppa_address',
                    'label' => 'address',
                    'errors' => array('required' => 'Please provide organization\'s %s.',),
                ),
            )); 

            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
            
            $ppa->ppa_name = $this->input->post('ppa_name');
            $ppa->ppa_address = $this->input->post('ppa_address');
            $ppa->state_id = $this->input->post('state_id');
            
            $query = $this->db->get_where('ppa_list', array(
                'ppa_name'=> $this->input->post('ppa_name'),
                'state_id'=> $this->input->post('state_id')
            ));
            
            $row = $query->row();
            
            if($this->form_validation->run()){
                if(isset($row)){
                    $error[] = "A PPA with thesame name already exist in thesame state.";
                }
            }
            
            if(count($error) > 0 || !$this->form_validation->run()){
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('ppa/add_ppa', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, "ppa"=>$ppa, "states"=>$states_to_view));
                $this->load->view('template/footer');
            }else{
                $this->db->trans_start();
                
                $ppa->save();
                
                $this->db->trans_complete();
                
                redirect("add-ppa?success=true");
             
            }
        }else{
            $this->load->view('template/header', array("user"=>$user));
            $this->load->view('ppa/add_ppa', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, "ppa"=>$ppa, "states"=>$states_to_view));
            $this->load->view('template/footer');
        } 
    }
    
    public function edit_PPA($id) {
        $this->is_logged_in();
        $user = $this->getUser();
 
        $is_active = 0;
        
        $success = "false";
        $header = "Place of Primary Assignment";
        $sub_header = "Welcome, you can edit place of primary assignment here.";
        $error = array();
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->load->model('PPAModel');
        $this->load->model('StateModel');
        
        $ppa = new PPAModel();
        
        if(isset($id)){
            $ppa->load($id);
            if($ppa->ppa_id === null){
                redirect(base_url("view-ppa"));
            }
        }else{
            redirect(base_url("view-ppa"));
        }
         
        $states= $this->StateModel->get();
        
        $states_to_view = array(''=>'--Select--');
        foreach($states as $ins){
            $states_to_view[$ins->state_id] = $ins->state_title;
        }
        if(isset($_POST['save'])){
            $this->form_validation->set_rules(array(
                array(
                    'rules' => 'required',
                    'field' => 'state_id',
                    'label' => 'state',
                    'errors' => array('required' => 'Please select the %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'ppa_name',
                    'label' => 'name',
                    'errors' => array('required' => 'Please provide organization\'s %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'ppa_address',
                    'label' => 'address',
                    'errors' => array('required' => 'Please provide organization\'s %s.',),
                ),
            )); 

            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
            
            $ppa->ppa_name = $this->input->post('ppa_name');
            $ppa->ppa_address = $this->input->post('ppa_address');
            $ppa->state_id = $this->input->post('state_id');
            
            $query = $this->db->get_where('ppa_list', array(
                'ppa_name'=> $this->input->post('ppa_name'), 'state_id'=> $this->input->post('state_id'), 'ppa_id !='=>$ppa->ppa_id
            ));
            
            $row = $query->row();
            
            if($this->form_validation->run()){
                if(isset($row)){
                    $error[] = "A PPA with thesame name already exist in thesame state.";
                }
            }
            
            if(count($error) > 0 || !$this->form_validation->run()){
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('ppa/edit_ppa', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'ppa'=>$ppa, "states"=>$states_to_view));
                $this->load->view('template/footer');
            }else{
                $this->db->trans_start();

                $ppa->update($ppa->ppa_id);
                
                $this->db->trans_complete();
                
                redirect("edit-ppa/".$ppa->ppa_id."?success=true");
             
            }
        }else{
            $this->load->view('template/header', array("user"=>$user));
            $this->load->view('ppa/edit_ppa', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'ppa'=>$ppa, "states"=>$states_to_view));
            $this->load->view('template/footer');
        } 
        
    }
    
    public function view_PPA(){
        $this->is_logged_in();
        $user = $this->getUser();
        
        $header = "View Place of Primary Assignments";
        $sub_header = "Welcome, you can edit place of primary assignments here.";
        
        $query = $this->db->query("select * from ppa_list, states WHERE ppa_list.state_id = states.state_id ORDER BY state_title ASC, ppa_name ASC");
        $ppas = $query->result_array();   
        
        $this->load->view('template/header', array("user"=>$user));
        $this->load->view('ppa/view_ppa', array("user"=>$user, 'header' => $header, "sub_header" => $sub_header, "ppas"=>$ppas));
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

