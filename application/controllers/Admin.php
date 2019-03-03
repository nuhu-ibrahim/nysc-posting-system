<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function land_admin(){  
        if ($this->is_logged_in()) {
            $this->load->model('AppUser');
            
            $user = (new AppUser())->getUser();

            $this->load->view('template/header', array("user"=>$user));
            $this->load->view('template/footer');
        } else {
            // there user was not logged in, we cannot logged him out,
            // redirect him to site root
            redirect('login');
        }
    }
    
    public function logout(){
        if ($this->is_logged_in()) {	
            // remove session datas
            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);
            }
            // user logout ok
            redirect('');
        } else {
            // there user was not logged in, we cannot logged him out,
            // redirect him to site root
            redirect('login');
        }
    }
    
    public function login(){
        if ($this->is_logged_in()) {
            redirect('admin');
        }
        $error = array();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('AppUser');
        $user = new AppUser();
        
        $password = "";
        $username = "";
        
        if(isset($_POST['save'])){
            $this->form_validation->set_rules(array(
                array(
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => array('required' => '%s can not be empty.',),
                ),
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => array('required' => '%s can not be empty.',),
                ),
            ));
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            if(count($error) > 0 || !$this->form_validation->run()){
                $this->load->view('login/login_admin', array("username"=>$username, "password"=>$password, "error"=>$error));
            }else{
                $this->db->select('*');
		$this->db->from('app_user');
		$this->db->where('email', $username);
                $this->db->where('password', $password);
                $this->db->where('role', 'ROLE_ADMIN');
                
                $row = $this->db->get()->row();
                if(isset($row)){
                    $_SESSION['user_id'] = (int)$row->user_id;
                    $_SESSION['logged_in'] = (bool)true;

                    redirect("admin");
                }else{
                    $error[] = "Incorrect username or password, try again!.";
                    $this->load->view('login/login_admin', array("username"=>$username, "password"=>$password, "error"=>$error));
                }
            }
        }else{
            $this->load->view('login/login_admin', array("username"=>$username, "password"=>$password, "error"=>$error));
        } 
    }
    
    public function is_logged_in() {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {	
            return true;
        }
    }
}
