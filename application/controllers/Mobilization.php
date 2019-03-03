<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobilization extends CI_Controller {
    
    public function upload_students() {
        $this->is_logged_in();
        $user = $this->getUser();

        $error = array();
        $success = '';
        
        $header = "Upload Mobilize Students";
        $sub_header = "Welcome, you can upload students mobilized from institutions here.";
        
        $this->load->model('MobilizationModel');
        $this->load->model('BatchModel');
        $this->load->model('InstitutionModel');
        
        $batch = new BatchModel();
        $institution = new InstitutionModel();
        
        $is_active = 0;
        
        $batchs= $this->BatchModel->get();
        
        foreach($batchs as $el){
            if($el->is_active == 1){
                $is_active = 1;
                $batch = $el;
                break;
            }
        }
        
        $institutions= $this->InstitutionModel->get();
        
        $institutions_to_view = array(''=>'--Select Institution--');
        foreach($institutions as $ins){
            $institutions_to_view[$ins->id] = $ins->institution_title;
        }
        
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $this->form_validation->set_rules(array(
                array(
                    'rules' => 'required',
                    'field' => 'institution_id',
                    'label' => 'institution',
                    'errors' => array('required' => 'Please select the %s.',),
                ),
            )); 

            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
            
            $check_file_upload = FALSE;
            if (isset($_FILES['students']['error']) && ($_FILES['students']['error'] != 4)) {
                $check_file_upload = TRUE;
            }else{
                $error[] = "Please attach the excel file containing students records.";
            }

            $institution->id = $this->input->post('institution_id');
            if(count($error) > 0 | !$this->form_validation->run()){
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('mobilization/upload', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'error'=>$error, 'is_active'=>$is_active, "success"=>$success, 'batch'=>$batch, 'institutions'=>$institutions_to_view, 'institution'=>$institution));
                $this->load->view('template/footer');
            }else{
                $data = array();
                
                $fileName = $_FILES['students']['name'];

                $ext= substr(strrchr($fileName, '.'), 1);

                if (!($ext=="xls" || $ext=="xlsx")){
                    $error[]="Uploaded file is not a valid excel file.";
                }else{
                    $tmpName = $_FILES['students']['tmp_name'];
                    $handle= @fopen($tmpName, "r");

                    $first_row = true;
                    $lineNo=1;
                    while (($buffer = @fgets($handle)) !== false){
                        if ( !$first_row ){
                            $mobilization= new MobilizationModel();

                            $index = 1;
                            $cells = explode("\t", $buffer);

                            foreach( $cells as $cell ){
                                if ( $index == 1 ) 
                                        $mobilization->matric_number = str_replace('"',"",$cell); //->nodeValue;
                                if ( $index == 2 ) 
                                        $mobilization->firstname = str_replace('"',"",$cell);//->nodeValue;
                                if ( $index == 3 ) 
                                        $mobilization->middlename = str_replace('"',"",$cell);//->nodeValue;
                                if ( $index == 4 ) 
                                        $mobilization->lastname = str_replace('"',"",$cell);//->nodeValue;
                                if ( $index == 5 ) 
                                        $mobilization->dob = str_replace('"',"",$cell);//->nodeValue;

                                $index += 1;
                            }
                            $mobilization->batch_id = $batch->batch_id;
                            $mobilization->institution_id = $institution->id;

                            if($mobilization->matric_number != "" && $mobilization->firstname != "" && $mobilization->lastname != "" && $mobilization->dob != ""){
                                $data[] = $mobilization;
                            }else{
                                $error[]="Student's data on line ".$lineNo." is invalid.";
                                break;
                            }
                        }
                        $first_row = false;
                        $lineNo++;
                    }
                }
                
                if(count($error)==0){
                    //Upload to database and redirect
                    $this->db->trans_start();

                    foreach($data as $da){
                        $query = $this->db->query("select * from mobilization_list where matric_number = '$da->matric_number' AND batch_id = '$batch->batch_id'");
                        $u = $query->result_array();
                        if(count($u) == 0){
                            $da->save();
                        }
                    }
                    
                    $this->db->trans_complete();

                    redirect("upload?success=true");
                }
                 
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('mobilization/upload', array("user"=>$user, 'header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, 'success'=>$success, 'institutions'=>$institutions_to_view, 'institution'=>$institution));
                $this->load->view('template/footer');
            }
        }else{
            $this->load->view('template/header', array("user"=>$user));
            $this->load->view('mobilization/upload', array("user"=>$user, 'header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, 'success'=>$success, 'institutions'=>$institutions_to_view, 'institution'=>$institution));
            $this->load->view('template/footer');
        }
        
    }
    
    public function view_mobilization_list() {
        $this->is_logged_in();
        $user = $this->getUser();

        $error = array();
        $success = '';
        
        $header = "View Mobilized Students";
        $sub_header = "Welcome, you can view students mobilized from institutions here.";
        
        $this->load->model('MobilizationModel');
        $this->load->model('BatchModel');
        $this->load->model('InstitutionModel');
        
        $batch = new BatchModel();
        $institution = new InstitutionModel();
        
        $is_active = 0;
        
        $batchs= $this->BatchModel->get();
        
        foreach($batchs as $el){
            if($el->is_active == 1){
                $is_active = 1;
                $batch = $el;
                break;
            }
        }
        
        $institutions= $this->InstitutionModel->get();
        
        $institutions_to_view = array(''=>'--Select Institution--');
        foreach($institutions as $ins){
            $institutions_to_view[$ins->id] = $ins->institution_title;
        }
        
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $this->form_validation->set_rules(array(
                array(
                    'rules' => 'required',
                    'field' => 'institution_id',
                    'label' => 'institution',
                    'errors' => array('required' => 'Please select the %s.',),
                ),
            )); 

            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
            
            $institution->id = $this->input->post('institution_id');
            if(count($error) > 0 | !$this->form_validation->run()){
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('mobilization/view_mobilized_list', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'error'=>$error, 'is_active'=>$is_active, "success"=>$success, 'batch'=>$batch, 'institutions'=>$institutions_to_view, 'institution'=>$institution));
                $this->load->view('template/footer');
            }else{
                $query = $this->db->query("select * from mobilization_list, batch_list where institution_id = '$institution->id' AND mobilization_list.batch_id = '$batch->batch_id' AND batch_list.batch_id = mobilization_list.batch_id");
            
                $mobilized_students = $query->result_array();
                
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('mobilization/view_mobilized_list', array("user"=>$user, 'header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, 'success'=>$success, 'institutions'=>$institutions_to_view, 'institution'=>$institution, 'mobilized_students'=>$mobilized_students));
                $this->load->view('template/footer');
            }
        }else{
            $this->load->view('template/header', array("user"=>$user));
            $this->load->view('mobilization/view_mobilized_list', array("user"=>$user, 'header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, 'success'=>$success, 'institutions'=>$institutions_to_view, 'institution'=>$institution));
            $this->load->view('template/footer');
        }
        
    }
    
    public function student_mobilization_status() {
        $error = array();
        $success = '';
        
        $header = "View Senate List or its equivalent";
        
        $this->load->model('MobilizationModel');
        $this->load->model('InstitutionModel');
        
        $mobilization = new MobilizationModel();
        $institution = new InstitutionModel();
        
        $institutions= $this->InstitutionModel->get();
        
        $institutions_to_view = array(''=>'--Select Institution--');
        foreach($institutions as $ins){
            $institutions_to_view[$ins->id] = $ins->institution_title;
        }
        
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $this->form_validation->set_rules(array(
                array(
                    'rules' => 'required',
                    'field' => 'matric_number',
                    'label' => 'matric number',
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
                    'field' => 'lastname',
                    'label' => 'surname',
                    'errors' => array('required' => 'Please provide your %s.',),
                ),
            )); 

            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
            
            $mobilization->matric_number = $this->input->post('matric_number');
            $mobilization->lastname = $this->input->post('lastname');
            $institution->id = $this->input->post('institution_id');
            
            if(count($error) > 0 | !$this->form_validation->run()){
                $this->load->view('template/header_student');
                $this->load->view('mobilization/student_mobilized_status', array('header' => $header, 'error'=>$error, 'error'=>$error, "success"=>$success, 'mobilization'=>$mobilization, 'institutions'=>$institutions_to_view, 'institution'=>$institution));
                $this->load->view('template/footer_student');
            }else{
                $query = $this->db->query("select * from mobilization_list, batch_list, institution_list where lastname = '$mobilization->lastname' AND matric_number = '$mobilization->matric_number' AND batch_list.is_active = '1' AND batch_list.batch_id = mobilization_list.batch_id AND institution_list.id = mobilization_list.institution_id");
            
                $student = $query->result_array();
                
                $this->load->view('template/header_student');
                $this->load->view('mobilization/student_mobilized_status', array('header' => $header, 'error'=>$error, 'success'=>$success, 'mobilization'=>$mobilization, 'institutions'=>$institutions_to_view, 'institution'=>$institution, 'student'=>$student));
                $this->load->view('template/footer_student');
            }
        }else{
            $this->load->view('template/header_student');
            $this->load->view('mobilization/student_mobilized_status', array('header' => $header, 'error'=>$error, 'success'=>$success, 'mobilization'=>$mobilization, 'institutions'=>$institutions_to_view, 'institution'=>$institution));
            $this->load->view('template/footer_student');
        }
        
    }
    
    public function view_mobilization_status() {
        $this->is_logged_in();
        $user = $this->getUser();

        $error = array();
        $success = '';
        
        $header = "View Student Status";
        $sub_header = "Welcome, you can view student mobilization status here.";
        
        $this->load->model('MobilizationModel');
        $this->load->model('BatchModel');
        $this->load->model('InstitutionModel');
        
        $mobilization = new MobilizationModel();
        $batch = new BatchModel();
        $institution = new InstitutionModel();
        
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
            
            $mobilization->matric_number = $this->input->post('matric_number');
            if(count($error) > 0 | !$this->form_validation->run()){
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('mobilization/view_mobilized_status', array('header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'error'=>$error, 'is_active'=>$is_active, "success"=>$success, 'mobilization'=>$mobilization));
                $this->load->view('template/footer');
            }else{
                $query = $this->db->query("select * from mobilization_list, batch_list, institution_list where matric_number = '$mobilization->matric_number' AND mobilization_list.batch_id = '$batch->batch_id' AND batch_list.batch_id = mobilization_list.batch_id AND institution_list.id = mobilization_list.institution_id");
            
                $student = $query->result_array();
                
                $this->load->view('template/header', array("user"=>$user));
                $this->load->view('mobilization/view_mobilized_status', array("user"=>$user, 'header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, 'success'=>$success, 'mobilization'=>$mobilization, 'student'=>$student));
                $this->load->view('template/footer');
            }
        }else{
            $this->load->view('template/header', array("user"=>$user));
            $this->load->view('mobilization/view_mobilized_status', array("user"=>$user, 'header' => $header, "sub_header" => $sub_header, 'error'=>$error, 'is_active'=>$is_active, 'success'=>$success, 'mobilization'=>$mobilization));
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

