<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

    public function land_student(){  
        $this->load->view('template/header_student');
        $this->load->view('template/index_student');
        $this->load->view('template/footer_student');
    }
     
    public function register(){ 
        $config = array(
            'upload_path' => 'assets/passports',
            'allowed_types' => 'gif|jpg|png',
            'max_size' => 1000,
            'max_width' => 1920,
            'max_heigh' => 1080,
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        $success = "false";
        $header = "Corp Registration Page";
        $sub_header = "Please remember your password; it will be used for subsequent visits to this portal.";
        $error = array();
        $cemail = '';
        $cpassword = '';
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->load->model('InstitutionModel');
        $this->load->model('StudentModel');
        $this->load->model('AppUser');
        $this->load->model('BatchModel');
        
        $is_active = 0;
        
        $institution = new InstitutionModel();
        $student = new StudentModel();
        $batch = new BatchModel();
        $user = new AppUser();

        $institutions= $this->InstitutionModel->get();
        
        $institutions_to_view = array(''=>'--Select Institution--');
        foreach($institutions as $ins){
            $institutions_to_view[$ins->id] = $ins->institution_title;
        }
        
        $batchs= $this->BatchModel->get();
        
        foreach($batchs as $el){
            if($el->is_active == 1){
                $is_active = 1;
                $batch = $el;
            }
        }
        
        if(isset($_POST['save'])){
            $this->form_validation->set_rules(array(
                array(
                    'rules' => 'required',
                    'field' => 'lastname',
                    'label' => 'surname',
                    'errors' => array('required' => 'Please provide your %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'firstname',
                    'label' => 'first name',
                    'errors' => array('required' => 'Please provide your %s.',),
                ),
                array(
                    'rules' => 'required|callback_date_validation',
                    'field' => 'dob',
                    'label' => 'date of birth',
                    'errors' => array('required' => 'Please provide your %s.',),
                ),
                array(
                    'rules' => 'required|valid_email',
                    'field' => 'email',
                    'label' => 'email',
                    'errors' => array('required' => 'Please provide your %s.', 'valid_email' => 'Email is not valid.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'GSM',
                    'label' => 'GSM No',
                    'errors' => array('required' => 'Please provide your %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'gender',
                    'label' => 'gender',
                    'errors' => array('required' => 'Please select your %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'marital_status',
                    'label' => 'marital status',
                    'errors' => array('required' => 'Please select your %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'state_of_origin',
                    'label' => 'state of origin',
                    'errors' => array('required' => 'Please select the %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'address',
                    'label' => 'address',
                    'errors' => array('required' => 'Please provide your %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'kin_name',
                    'label' => 'next of kin name',
                    'errors' => array('required' => 'Please provide your %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'kin_GSM',
                    'label' => 'next of kin GSM No',
                    'errors' => array('required' => 'Please provide your %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'kin_address',
                    'label' => 'next of kin address',
                    'errors' => array('required' => 'Please provide your %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'kin_relationship',
                    'label' => 'relationship',
                    'errors' => array('required' => 'Please provide your %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'institution_id',
                    'label' => 'institution',
                    'errors' => array('required' => 'Please select your %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'matric_number',
                    'label' => 'matric number',
                    'errors' => array('required' => 'Please provide your %s.',),
                ),
                array(
                    'rules' => 'required|callback_date_validation',
                    'field' => 'date_of_grad',
                    'label' => 'date of graduation',
                    'errors' => array('required' => 'Please provide your %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'class_of_degree',
                    'label' => 'class of degree',
                    'errors' => array('required' => 'Please select your %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'trouser_size',
                    'label' => 'trouser size',
                    'errors' => array('required' => 'Please select your %s.',),
                ),
                array(
                    'rules' => 'required|numeric|greater_than_equal_to[0]',
                    'field' => 'trouser_length',
                    'label' => 'trouser length',
                    'errors' => array('greater_than_equal_to'=>'Size of %s can not be zero or negative.', 'numeric' => 'Size of %s can not contain a non numeric character.','required' => 'Please provide your %s.',),
                ),
                array(
                    'rules' => 'required|numeric|greater_than_equal_to[0]',
                    'field' => 'trouser_waist',
                    'label' => 'trouser waist',
                    'errors' => array('greater_than_equal_to'=>'Size of %s can not be zero or negative.', 'numeric' => 'Size of %s can not contain a non numeric character.','required' => 'Please provide your %s.',),
                ),array(
                    'rules' => 'required|numeric|greater_than_equal_to[0]',
                    'field' => 'trouser_bottom',
                    'label' => 'trouser bottom',
                    'errors' => array('greater_than_equal_to'=>'Size of %s can not be zero or negative.', 'numeric' => 'Size of %s can not contain a non numeric character.','required' => 'Please provide your %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'shirt_size',
                    'label' => 'shirt size',
                    'errors' => array('required' => 'Please provide your %s.',),
                ),array(
                    'rules' => 'required|numeric|greater_than_equal_to[0]',
                    'field' => 'shirt_length',
                    'label' => 'shirt length',
                    'errors' => array('greater_than_equal_to'=>'Size of %s can not be zero or negative.', 'numeric' => 'Size of %s can not contain a non numeric character.','required' => 'Please provide your %s.',),
                ),
                array(
                    'rules' => 'required|numeric|greater_than_equal_to[0]',
                    'field' => 'canvas_size',
                    'label' => 'canvas size',
                    'errors' => array('greater_than_equal_to'=>'Size of %s can not be zero or negative.', 'numeric' => 'Size of %s can not contain a non numeric character.','required' => 'Please provide your %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'password',
                    'label' => 'password',
                    'errors' => array('required' => 'Please provide your %s.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'cpassword',
                    'label' => 'Confirm password',
                    'errors' => array('required' => '%s cannot be empty.',),
                ),
                array(
                    'rules' => 'required',
                    'field' => 'cemail',
                    'label' => 'Confirm email',
                    'errors' => array('required' => '%s cannot be empty.',),
                ),
            )); 

            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
            
            $check_file_upload = FALSE;
            if (isset($_FILES['passport']['error']) && ($_FILES['passport']['error'] != 4)) {
                $check_file_upload = TRUE;
            }
            
            $student->gender = $this->input->post('gender');
            $student->GSM = $this->input->post('GSM');
            $student->address = $this->input->post('address');
            $student->canvas_size = $this->input->post('canvas_size');
            $student->class_of_degree = $this->input->post('class_of_degree');
            $student->date_of_grad = $this->input->post('date_of_grad');
            $student->dob = $this->input->post('dob');
            $student->email = $this->input->post('email');
            $student->firstname = $this->input->post('firstname');
            $student->institution_id = $this->input->post('institution_id');
            $student->kin_GSM = $this->input->post('kin_GSM');
            $student->kin_address = $this->input->post('kin_address');
            $student->kin_name = $this->input->post('kin_name');
            $student->kin_relationship = $this->input->post('kin_relationship');
            $student->lastname = $this->input->post('lastname');
            $student->marital_status = $this->input->post('marital_status');
            $student->matric_number = $this->input->post('matric_number');
            $student->middlename = $this->input->post('middlename');
            $student->shirt_length = $this->input->post('shirt_length');
            $student->shirt_size = $this->input->post('shirt_size');
            $student->state_of_origin = $this->input->post('state_of_origin');
            $student->trouser_waist = $this->input->post('trouser_waist');
            $student->trouser_bottom = $this->input->post('trouser_bottom');
            $student->trouser_length = $this->input->post('trouser_length');
            $student->trouser_size = $this->input->post('trouser_size');
            
            $user->email = $this->input->post('email');
            $user->password = $this->input->post('password');
            $user->regno = $this->input->post('matric_number');
            
            $cemail = $this->input->post('cemail');
            $cpassword = $this->input->post('cpassword');
            
            if($this->form_validation->run()){
                if($cemail != $student->email){
                    $error[] = "Email address does not match confirm email address.";
                }else{
                    if($cpassword != $user->password){
                        $error[] = "Password does not match confirm password.";
                    }else{
                        $query = $this->db->get_where('mobilization_list', array(
                            'matric_number'=> $this->input->post('matric_number')
                        ));
                        
                        $row = $query->row();
                        
                        if(!isset($row)){
                            $error[] = "You have not been mobilized, you cannot register.";
                        }else{
                            $query = $this->db->get_where('student_list', array(
                                'matric_number'=> $this->input->post('matric_number')
                            ));

                            $row = $query->row();
                            if(isset($row)){
                                $error[] = "You have already registered, you can proceed to login.";
                            }else{
                                $query = $this->db->query("select * from mobilization_list where matric_number = '$student->matric_number' AND lastname = '$student->lastname' AND firstname = '$student->firstname' AND middlename = '$student->middlename' AND institution_id = '$student->institution_id' AND dob = '$student->dob'");
                                $match = $query->result_array();

                                if(!count($match) > 0){
                                    $error[] = "Information you provided does not match information provided by your senate.";
                                }else if(!$check_file_upload){
                                    $error[] = "Please attach a clear passport photograph.";
                                }
                            }
                        }
                    }
                }
            }
            
            if(count($error) > 0 || !$this->form_validation->run() || ($check_file_upload && !$this->upload->do_upload('passport'))){
                $this->load->view('template/header_student');
                $this->load->view('registration/register', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, "success"=>$success, "student"=>$student, 'institutions'=>$institutions_to_view, 'cemail'=>$cemail, 'cpassword'=>$cpassword, 'user'=>$user, 'is_active'=>$is_active));
                $this->load->view('template/footer_student');
            }else{
                $upload_data = $this->upload->data();
                if (isset($upload_data['file_name'])) {
                    $student->passport = $upload_data['file_name'];
                }
                
                if($upload_data['file_name'] === ""){
                    $student->passport = "dummy_photo.png";
                }
                
                $this->db->trans_start();
                
                $student->batch_id = $batch->batch_id;
                $student->save();
                
                $user->corp_id = $student->id;
                $user->role = 'ROLE_STUDENT';
                
                $user->save();
                
                $this->db->trans_complete();
                
                redirect("register?success=true");
             
            }
        }else{
            $this->load->view('template/header_student');
            $this->load->view('registration/register', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, "success"=>$success, "student"=>$student, 'institutions'=>$institutions_to_view, 'cemail'=>$cemail, 'cpassword'=>$cpassword, 'user'=>$user, 'is_active'=>$is_active));
            $this->load->view('template/footer_student');
        } 
    }
    
    public function dashboard(){  
        if ($this->is_logged_in()) {
            $this->load->model('AppUser');
            
            $user = (new AppUser())->getUser();
            $query = $this->db->query("select * from batch_list, student_list, institution_list where student_list.email = '$user->email' AND batch_list.batch_id = student_list.batch_id AND institution_list.id = student_list.institution_id");
            $student_norm = $query->result_array()[0];
            
            $query = $this->db->query("select * from batch_list, student_list, states, institution_list, deployment_list where student_list.email = '$user->email' AND batch_list.batch_id = deployment_list.batch_id AND deployment_list.corp_id = student_list.id AND states.state_id = deployment_list.state_id AND institution_list.id = student_list.institution_id");
            $student_dep = $query->result_array();
            
            $this->load->view('template/header_student', array("user"=>$user));
            $this->load->view('template/dashboard', array('student'=>$student_norm, 'student_dep'=>$student_dep));
            $this->load->view('template/footer_student');
        } else {
            // there user was not logged in, we cannot logged him out,
            // redirect him to site root
            redirect('slogin');
        }
    }
    
    public function print_deployment(){  
        if ($this->is_logged_in()) {
            $this->load->model('AppUser');
            
            $user = (new AppUser())->getUser();
            $query = $this->db->query("select * from batch_list, student_list, institution_list where student_list.email = '$user->email' AND batch_list.batch_id = student_list.batch_id AND institution_list.id = student_list.institution_id");
            $student_norm = $query->result_array()[0];
            
            $query = $this->db->query("select * from batch_list, student_list, states, institution_list, deployment_list, ppa_list where student_list.email = '$user->email' AND batch_list.batch_id = deployment_list.batch_id AND deployment_list.corp_id = student_list.id AND states.state_id = deployment_list.state_id AND institution_list.id = student_list.institution_idAND deployment_list.ppa_id = ppa_list.ppa_id");
            $student_dep = $query->result_array();
            
            $this->load->view('template/print_deployment', array("user"=>$user, 'student'=>$student_norm, 'student_dep'=>$student_dep));
        } else {
            // there user was not logged in, we cannot logged him out,
            // redirect him to site root
            redirect('slogin');
        }
    }
    
    public function print_green_card(){  
        if ($this->is_logged_in()) {
            $this->load->model('AppUser');
            
            $user = (new AppUser())->getUser();
            $query = $this->db->query("select * from batch_list, student_list, institution_list where student_list.email = '$user->email' AND batch_list.batch_id = student_list.batch_id AND institution_list.id = student_list.institution_id");
            $student_norm = $query->result_array()[0];
            
            $query = $this->db->query("select * from batch_list, student_list, states, institution_list, deployment_list where student_list.email = '$user->email' AND batch_list.batch_id = deployment_list.batch_id AND deployment_list.corp_id = student_list.id AND states.state_id = deployment_list.state_id AND institution_list.id = student_list.institution_id");
            $student_dep = $query->result_array();
            
            $this->load->view('template/print_green_card', array("user"=>$user, 'student'=>$student_norm, 'student_dep'=>$student_dep));
        } else {
            // there user was not logged in, we cannot logged him out,
            // redirect him to site root
            redirect('slogin');
        }
    }
    
    public function date_validation($input) {
        $test_date = explode('-', $input);
        if (!@checkdate($test_date[1], $test_date[2], $test_date[0])) {
            $this->form_validation->set_message('date_validation', 'The %s field must be in YYYY-MM-DD format.');
            return FALSE;
        }
        return TRUE;
    }
    
    public function logout(){
        if ($this->is_logged_in()) {	
            // remove session datas
            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);
            }
            // user logout ok
            redirect('slogin');
        } else {
            // there user was not logged in, we cannot logged him out,
            // redirect him to site root
            redirect('slogin');
        }
    }
    
    public function login(){
        if ($this->is_logged_in()) {
            redirect('dashboard');
        }
        $error = array();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('AppUser');
        $user = new AppUser();
        
        $password = "";
        $email = "";
        
        if(isset($_POST['save'])){
            $this->form_validation->set_rules(array(
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => array('required' => '%s can not be empty.', 'valid_email' => '%s is not valid.',),
                ),
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => array('required' => '%s can not be empty.',),
                ),
            ));
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');

            $email = $this->input->post('email');
            $password = $this->input->post('password');
            
            if(count($error) > 0 | !$this->form_validation->run()){
                $this->load->view('template/header_student');
                $this->load->view('login/login_student', array("email"=>$email, "password"=>$password, "error"=>$error));
                $this->load->view('template/footer_student');  
            }else{
                $this->db->select('*');
		$this->db->from('app_user');
		$this->db->where('email', $email);
                $this->db->where('password', $password);
                $this->db->where('role', 'ROLE_STUDENT');
                
                $row = $this->db->get()->row();
                if(isset($row)){
                    $_SESSION['user_id'] = (int)$row->user_id;
                    $_SESSION['logged_in'] = (bool)true;

                    redirect("dashboard");
                }else{
                    $error[] = "Incorrect email or password, Try again!.";
                    $this->load->view('template/header_student');
                    $this->load->view('login/login_student', array("email"=>$email, "password"=>$password, "error"=>$error));
                    $this->load->view('template/footer_student');  
                }
            }
        }else{
            $this->load->view('template/header_student');
            $this->load->view('login/login_student', array("email"=>$email, "password"=>$password, "error"=>$error));
            $this->load->view('template/footer_student');  
        } 
    }
    
    public function is_logged_in() {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {	
            return true;
        }
    }
}
