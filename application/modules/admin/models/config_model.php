<?php
class config_model extends CI_Model{
	protected $_table="tbl_config";
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getNumberPage(){
		$query= $this->db->query("SELECT * FROM $this->_table");
		return $query->row_array();
	}

	public function update($data){
		$sql="UPDATE tbl_config SET config_page = '".$data."' ";
		$this->db->query($sql);
	}
}
