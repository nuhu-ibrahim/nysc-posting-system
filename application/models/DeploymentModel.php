<?php

class DeploymentModel extends MY_Model {

    const DB_TABLE = 'deployment_list';
    const DB_TABLE_PK = 'id';

    public $id;
    public $batch_id;
    public $corp_id;
    public $state_id;
    public $ppa_id;

}
