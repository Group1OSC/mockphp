<?php
class Login_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function login($username, $password){

		$this->db->select('user_id, user_name, user_pass');
		$this->db->from('tbl_user');
		$this->db->where('user_name', $username);
		$this->db->where('user_pass', $password);
		$this->db->where('user_level', 1);

		$result = $this->db->get();
		
		if ($result->num_rows() == 1){
			$return = array_shift($result->result_array());
			return $return;
		}
		else {
			return false;
		}
	}
}