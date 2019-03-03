<?php

class AppUser extends CI_Model {
    
    const DB_TABLE = 'app_user';
    const DB_TABLE_PK = 'user_id';
    
    public $user_id;
    
    public $regno;
    
    public $corp_id;
    
    public $email;
   
    public $password;
    
    public $role;
    
    public function getUser() {
        $this->db->select('*');
        $this->db->from('app_user');
        $this->db->where('user_id', $_SESSION['user_id']);
        
        $row = $this->db->get()->row();
        
        return $row;
    }
}