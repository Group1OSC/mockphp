<?php
class config_model extends CI_Model{

	protected $_table="tbl_config";
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getNumberPage(){
		return $this->db->get($this->_table)->row_array();
	}

}