<?php 
class User_model extends CI_Model{
	protected $_table;

	public function __construct(){
		parent::__construct();
		$this->_table = 'tbl_user';
		$this->load->database();
	}

	public function get_users($id = FALSE){
		if ($id === FALSE){

			$query = $this->db->get($this->_table);
			return $query->result_array();
		}

		$query = $this->db->get_where($this->_table, array('user_id' => $id));
		return $query->row_array();
	}

	public function get_total_users(){
		return $this->db->count_all($this->_table);
	}
	
	public function get_all_users(){
		return $this->db->get($this->_table)->result_array();
	}
	
	public function delete_user($id){
		$this->db->where("user_id", $id);
		$this->db->delete($this->_table);
	}
	
	public function insert($data){
		$this->db->insert($this->_table, $data);
	}

	//acc05 - toannt2
	public function get_limit_users_orderby($offset, $limit, $field, $order){
		//$this->db->from($this->_table);
		$this->db->order_by($field, $order);
		$query = $this->db->get($this->_table, $limit, $offset); 
		return $query->result_array();
	}	
}