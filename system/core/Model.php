<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model {
        const DB_TABLE = 'abstract';
        const DB_TABLE_PK = 'abstract';

        /**
         * Create record.
         */
        public function insert() {
            $this->db->insert($this::DB_TABLE, $this);
            $this->{$this::DB_TABLE_PK} = $this->db->insert_id();
        }

        /**
         * Update record.
         */
        public function update($id) {
            $this->db->where($this::DB_TABLE_PK, $id);
            $this->db->update($this::DB_TABLE, $this);
        }

        /**
         * Populate from an array or standard class.
         * @param mixed $row
         */
        public function populate($row) {
            foreach ($row as $key => $value) {
                $this->$key = $value;
            }
        }

        /**
         * Load from the database.
         * @param int $id
         */
        public function load($id) {
            $query = $this->db->get_where($this::DB_TABLE, array(
                $this::DB_TABLE_PK => $id,
            ));
            $row = $query->row();
            if($row)
                $this->populate($query->row());
        }

        /**
         * Delete the current record.
         */
        public function delete() {
            $this->db->delete($this::DB_TABLE, array(
               $this::DB_TABLE_PK => $this->{$this::DB_TABLE_PK}, 
            ));
            unset($this->{$this::DB_TABLE_PK});
        }

        /**
         * Save the record.
         */
        public function save() {
            if (isset($this->{$this::DB_TABLE_PK})) {
                $this->update();
            }
            else {
                $this->insert();
            }
        }

        /**
         * Get an array of Models with an optional limit, offset.
         * 
         * @param int $limit Optional.
         * @param int $offset Optional; if set, requires $limit.
         * @return array Models populated by database, keyed by PK.
         */
        public function get($limit = 0, $offset = 0) {
            if ($limit) {
                $query = $this->db->get($this::DB_TABLE, $limit, $offset);
            }
            else {
                $query = $this->db->get($this::DB_TABLE);
            }
            $ret_val = array();
            $class = get_class($this);
            foreach ($query->result() as $row) {
                $model = new $class;
                $model->populate($row);
                $ret_val[$row->{$this::DB_TABLE_PK}] = $model;
            }
            return $ret_val;
        }

        public function useQuery($query = "") {
            $query = $this->db->query($query);

            $ret_val = array();
            $class = get_class($this);
            foreach ($query->result() as $row) {
                $model = new $class;
                $model->populate($row);
                $ret_val[$row->{$this::DB_TABLE_PK}] = $model;
            }
            return $ret_val;
        }
    
    

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		log_message('info', 'Model Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * __get magic
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string	$key
	 */
	public function __get($key)
	{
		// Debugging note:
		//	If you're here because you're getting an error message
		//	saying 'Undefined Property: system/core/Model.php', it's
		//	most likely a typo in your model code.
		return get_instance()->$key;
	}

}
