<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faker_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	/**
	 * Function used to insert the values in the given table.
	 * @param  String $table  Name of the table.
	 * @param  Array  $values Array of value to be inserted.
	 */
	public function insert($table, $values = array()) {
			return $this->db->insert($table, $values);
	}

}

/* End of file Faker_model.php */
/* Location: ./application/models/Faker_model.php */
