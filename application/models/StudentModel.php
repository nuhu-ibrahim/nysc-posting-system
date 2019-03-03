<?php

class StudentModel extends MY_Model {
    
    const DB_TABLE = 'student_list';
    const DB_TABLE_PK = 'id';
    
    public $id;
    
    public $batch_id;
    
    public $lastname;
    
    public $firstname;
    
    public $middlename;
    
    public $dob;
    
    public $email;
    
    public $GSM;
    
    public $gender;
    
    public $marital_status;
    
    public $state_of_origin;
    
    public $address;
    
    public $passport;
    
    public $kin_name;
    
    public $kin_GSM;
    
    public $kin_address;
    
    public $kin_relationship;
    
    public $institution_id;
    
    public $matric_number;
    
    public $date_of_grad;
    
    public $class_of_degree;
    
    public $trouser_size;
    
    public $trouser_length;
    
    public $trouser_waist;
    
    public $trouser_bottom;
    
    public $shirt_size;
    
    public $shirt_length;
    
    public $canvas_size;
}