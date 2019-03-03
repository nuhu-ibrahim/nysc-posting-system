<?php

class StateModel extends MY_Model {
    
    const DB_TABLE = 'states';
    const DB_TABLE_PK = 'state_id';
    
    public $state_id;
    
    public $state_title;
    
    public $camp_name;
    
    public $camp_address;
}