<?php

class BatchModel extends MY_Model {
    
    const DB_TABLE = 'batch_list';
    const DB_TABLE_PK = 'batch_id';
    
    public $batch_id;
    
    public $batch_title;
    
    public $is_active;
    
}