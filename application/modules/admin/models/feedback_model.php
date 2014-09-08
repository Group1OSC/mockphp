<?php 
class Feedback_model extends CI_Model{
	protected $_table = "tbl_feedback";
	protected $_product = "tbl_product";

	public function __construct(){
		parent::__construct();
			
		$this->load->database();
	}

	public function check_feedback_exist($feedback_id){

		$this->db->select();
		$this->db->from($this->_table);
		$this->db->where('feedback_status', 0);
		$this->db->where('feedback_id', $feedback_id);
		$this->db->order_by('feedback_time', 'asc');
		if($this->db->count_all_results() == 1){
			return true;
		}
		return false;
	}

	public function get_waiting_feedbacks(){

		$this->db->select();
		$this->db->from($this->_table);
		$this->db->join($this->_product, "$this->_table.pro_id = $this->_product.pro_id", 'left');
		$this->db->where('feedback_status', 0);
		$this->db->order_by('feedback_time', 'asc');
		$result = $this->db->get();
		return $result->result_array();
	}

	public function approve($feedback_id){
		$this->db->where('feedback_id', $feedback_id);
		$this->db->update($this->_table, array('feedback_status' => 1));
	}

	public function disapprove($feedback_id){
		$this->db->delete($this->_table, array('feedback_id' => $feedback_id));
	}
       
}