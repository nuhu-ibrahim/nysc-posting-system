<?php

class MobilizationModel extends MY_Model {
    
    const DB_TABLE = 'mobilization_list';
    const DB_TABLE_PK = 'id';
    
    public $id;
    
    public $batch_id;
    
    public $institution_id;
    
    public $firstname;
    
    public $middlename;
    
    public $lastname;
    
    public $dob;
    
    public $matric_number;
}