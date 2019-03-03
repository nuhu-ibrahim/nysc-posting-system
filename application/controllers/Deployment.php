<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deployment extends CI_Controller {
    
    public function deploy_students() {
        $this->is_logged_in();
        $user = $this->getUser();
        
        $success = "false";
        $header = "Deploy Students Page";
        $sub_header = "Welcome, you can deploy registered students of this batch to various states by clicking the button below.";
        $error = array();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('BatchModel');
        $this->load->model('StateModel');
        
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
            
            $query = $this->db->query("select * from student_list where student_list.batch_id = '$batch->batch_id'");
            $undeployed_students = $query->result_array();
            
            foreach($undeployed_students as $student){
                $query = $this->db->query("select * from deployment_list where deployment_list.corp_id = '".$student['id']."'");
                $is_deployed = $query->result_array();
                
                if(count($is_deployed) == 0){
                    //Use some technique to select a state for the student
                    $states= $this->StateModel->get();
                    $states_to_view = array();
                    foreach($states as $ins){
                        $states_to_view[$ins->state_id] = $ins->state_title;
                    }
                    $state_id = array_rand($states_to_view, 1);
                    
                    $query = $this->db->query("select * from ppa_list where state_id = $state_id");
                    $ppas = $query->result_array();
                    
                    $ppa_to_view = array();
                    foreach($ppas as $ppa){
                        $ppa_to_view[$ppa['ppa_id']] = $ppa['ppa_name'];
                    }
                    
                    $ppa_id = array_rand($ppa_to_view, 1);
                    $this->db->query("insert into deployment_list (batch_id, corp_id, state_id, ppa_id) values ('$batch->batch_id', '". $student['id']."', '$state_id', '$ppa_id')");
                }
            }
            $this->db->trans_complete();

            redirect("deploy-students?success=true");
             
        }else{
            $this->load->view('template/header', array("user"=>$user));
            $this->load->view('deployment/deploy_student', array("user"=>$user, 'header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, "success"=>$success, 'batch'=>$batch));
            $this->load->view('template/footer');
        } 
    }
    
    public function view_deployment_list() {
        $this->is_logged_in();
        $user = $this->getUser();

        $error = array();
        $success = '';
        
        $header = "View Deployed Students";
        $sub_header = "Welcome, you can view students deployed to various states here.";
        
        $this->load->model('DeploymentModel');
        $this->load->model('BatchModel');
        $this->load->model('StateModel');
        
        $batch = new BatchModel();
        $state = new StateModel();
        
        $is_active = 0;
        
        $batchs= $this->BatchModel->get();
        
        foreach($batchs as $el){
            if($el->is_active == 1){
                $is_active = 1;
                $batch = $el;
                break;
            }
        }
        
        $states= $this->StateModel->get();
        
        $states_to_view = array(''=>'--Select State--');
        foreach($states as $ins){
            $states_to_view[$ins->state_id] = $ins->state_title;
        }
        
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $this->form_validation->set_rules(array(
                array(
                    'rules' => 'required',
                    'field' => 'state_id',
                    'label' => 'state',
                    'errors' => array('required' => 'Please select the %s.',),
                ),
            )); 

            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
            
            $state->state_id = $this->input->post('state_id');
            if(count($error) > 0 | !$this->form_validation->run()){
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('deployment/view_deployed_list', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'error'=>$error, 'is_active'=>$is_active, "success"=>$success, 'batch'=>$batch, 'states'=>$states_to_view, 'state'=>$state));
                $this->load->view('template/footer');
            }else{
                $query = $this->db->query("select * from deployment_list, batch_list,student_list, states, institution_list, ppa_list where states.state_id = '$state->state_id' AND deployment_list.batch_id = '$batch->batch_id' AND batch_list.batch_id = deployment_list.batch_id AND deployment_list.corp_id = student_list.id AND states.state_id = deployment_list.state_id AND institution_list.id = student_list.institution_id AND deployment_list.ppa_id = ppa_list.ppa_id");
            
                $deployed_students = $query->result_array();
                
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('deployment/view_deployed_list', array("user"=>$user, 'header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, 'success'=>$success, 'states'=>$states_to_view, 'state'=>$state, 'deployed_students'=>$deployed_students));
                $this->load->view('template/footer');
            }
        }else{
            $this->load->view('template/header', array("user"=>$user));
            $this->load->view('deployment/view_deployed_list', array("user"=>$user, 'header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, 'success'=>$success, 'states'=>$states_to_view, 'state'=>$state));
            $this->load->view('template/footer');
        }
        
    }
    
    public function view_deployment_status() {
        $this->is_logged_in();
        $user = $this->getUser();

        $error = array();
        $success = '';
        
        $header = "View Student Deployment Status";
        $sub_header = "Welcome, you can view student deployment status here.";
        
        $this->load->model('DeploymentModel');
        $this->load->model('BatchModel');
        $this->load->model('StudentModel');
        
        $deployment = new DeploymentModel();
        $batch = new BatchModel();
        $stu = new StudentModel();
        
        $is_active = 0;
        
        $batchs= $this->BatchModel->get();
        
        foreach($batchs as $el){
            if($el->is_active == 1){
                $is_active = 1;
                $batch = $el;
                break;
            }
        }
        
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $this->form_validation->set_rules(array(
                array(
                    'rules' => 'required',
                    'field' => 'matric_number',
                    'label' => 'matric number',
                    'errors' => array('required' => 'Please provide student %s.',),
                ),
            )); 

            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
            
            $stu->matric_number = $this->input->post('matric_number');
            
            if(count($error) > 0 | !$this->form_validation->run()){
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('deployment/view_deployed_status', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'error'=>$error, 'is_active'=>$is_active, "success"=>$success, 'matric_number'=>$stu->matric_number));
                $this->load->view('template/footer');
            }else{
                $query = $this->db->query("select * from deployment_list, batch_list,student_list, states, institution_list, ppa_list where student_list.matric_number = '$stu->matric_number' AND deployment_list.batch_id = '$batch->batch_id' AND batch_list.batch_id = deployment_list.batch_id AND deployment_list.corp_id = student_list.id AND states.state_id = deployment_list.state_id AND institution_list.id = student_list.institution_id AND deployment_list.ppa_id = ppa_list.ppa_id");
            
                $student = $query->result_array();
                
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('deployment/view_deployed_status', array("user"=>$user, 'header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, 'success'=>$success, 'matric_number'=>$stu->matric_number, 'student'=>$student));
                $this->load->view('template/footer');
            }
        }else{
            $this->load->view('template/header', array("user"=>$user));
            $this->load->view('deployment/view_deployed_status', array("user"=>$user, 'header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, 'success'=>$success, 'matric_number'=>$stu->matric_number));
            $this->load->view('template/footer');
        }
        
    }
    
    public function redeploy_student() {
        $this->is_logged_in();
        $user = $this->getUser();

        $error = array();
        $success = '';
        
        $header = "Student Redeployment Page";
        $sub_header = "Welcome, you can redeploy student to other state here.";
        
        $this->load->model('DeploymentModel');
        $this->load->model('BatchModel');
        $this->load->model('StudentModel');
        $this->load->model('StateModel');
        
        $deployment = new DeploymentModel();
        $batch = new BatchModel();
        $stu = new StudentModel();
        $state = new StateModel();
        
        $is_active = 0;
        
        $batchs= $this->BatchModel->get();
        
        foreach($batchs as $el){
            if($el->is_active == 1){
                $is_active = 1;
                $batch = $el;
                break;
            }
        }
        
        $states= $this->StateModel->get();
        
        $states_to_view = array(''=>'--Select State--');
        foreach($states as $ins){
            $states_to_view[$ins->state_id] = $ins->state_title;
        }
        
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $this->form_validation->set_rules(array(
                array(
                    'rules' => 'required',
                    'field' => 'matric_number',
                    'label' => 'matric number',
                    'errors' => array('required' => 'Please provide student %s.',),
                ),
            )); 

            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
            
            $state->state_id = $this->input->post('state_id');
            $stu->matric_number = $this->input->post('matric_number');
            
            if(count($error) > 0 | !$this->form_validation->run()){
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('deployment/redeploy_student', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'error'=>$error, 'is_active'=>$is_active, "success"=>$success, 'state'=>$state, 'states'=>$states_to_view, 'matric_number'=>$stu->matric_number));
                $this->load->view('template/footer');
            }else{
                if(isset($_POST['save2'])){
                    $query = $this->db->query("select * from batch_list, student_list, states, institution_list, deployment_list, ppa_list where student_list.matric_number = '".$_POST['matric_number2']."' AND deployment_list.batch_id = '$batch->batch_id' AND batch_list.batch_id = deployment_list.batch_id AND deployment_list.corp_id = student_list.id AND states.state_id = deployment_list.state_id AND institution_list.id = student_list.institution_id");
                    $student = $query->result_array();
                    $deployment->load($student[0]['id']);
                    
                    $this->db->trans_start();
                    
                    $deployment->state_id = $state->state_id;

                    $query = $this->db->query("select * from ppa_list where state_id = $deployment->state_id");
                    $ppas = $query->result_array();
                    
                    $ppa_to_view = array();
                    foreach($ppas as $ppa){
                        $ppa_to_view[$ppa['ppa_id']] = $ppa['ppa_name'];
                    }
                    
                    $ppa_id = array_rand($ppa_to_view, 1);
                    
                    $deployment->ppa_id = $ppa_id;
                    $deployment->update($deployment->id);
                    
                    $this->db->trans_complete();
                    redirect("redeploy-student?success=true");
                }else if(isset($_POST['save'])){
                    $query = $this->db->query("select * from batch_list,student_list, states, institution_list, deployment_list, ppa_list where student_list.matric_number = '$stu->matric_number' AND deployment_list.batch_id = '$batch->batch_id' AND batch_list.batch_id = deployment_list.batch_id AND deployment_list.corp_id = student_list.id AND states.state_id = deployment_list.state_id AND institution_list.id = student_list.institution_id AND deployment_list.ppa_id = ppa_list.ppa_id");
                    $student = $query->result_array();
                    if($student){
                        $state->state_id = $student[0]['state_id'];
                    }
                    $this->load->view('template/header', array("user"=>$user));
                    $this->load->view('deployment/redeploy_student', array("user"=>$user, 'header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, 'success'=>$success, 'state'=>$state, 'student'=>$student, 'states'=>$states_to_view, 'matric_number'=>$stu->matric_number));
                    $this->load->view('template/footer');
                }
                
            }
        }else{
            $this->load->view('template/header', array("user"=>$user));
            $this->load->view('deployment/redeploy_student', array("user"=>$user, 'header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, 'success'=>$success, 'state'=>$state, 'states'=>$states_to_view, 'matric_number'=>$stu->matric_number));
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
   
}

