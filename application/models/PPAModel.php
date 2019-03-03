<?php

class PPAModel extends MY_Model {
    
    const DB_TABLE = 'ppa_list';
    const DB_TABLE_PK = 'ppa_id';
    
    public $ppa_id;
    
    public $state_id;
    
    public $ppa_name;
    
    public $ppa_address;
}