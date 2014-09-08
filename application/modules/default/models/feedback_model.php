<?php 
class Feedback_model extends CI_Model{
	protected $_table = "tbl_feedback";

	public function __construct(){
		parent::__construct();
			
		$this->load->database();
	}

	// acc05-toannt2
	public function count_feedback_by_pro_id($pro_id){

		$this->db->select();
		$this->db->from($this->_table);
		$this->db->where('pro_id', $pro_id);
		$this->db->where('feedback_status', 1);
    	return $this->db->count_all_results();
	}

	// acc05-toannt2
	public function get_feedback_by_pro_id($pro_id, $limit, $offset){

		$this->db->select();
		$this->db->from($this->_table);
		$this->db->where('pro_id', $pro_id);
		$this->db->where('feedback_status', 1);
		$this->db->order_by('feedback_time', 'asc');
		$this->db->limit($limit, $offset);
		$result = $this->db->get();
		return $result->result_array();
	}

	// acc05-toannt2
	public function insert($feed_name, $feed_email, $feed_content, $feed_rate, $feed_time, $pro_id){
		$data = array(
			'feedback_name'    => $feed_name,
			'feedback_email'   => $feed_email,
			'feedback_content' => $feed_content,
			'feedback_rate'    => $feed_rate,
			'feedback_time'    => $feed_time,
			'pro_id'           => $pro_id,
			'feedback_status'  => 0
		);

		$this->db->insert($this->_table, $data); 
	}
    
	// acc05-toannt2
	public function avg_rate($pro_id){
		$this->db->select("count(pro_id) as count, avg(feedback_rate) as avg");
		$this->db->from($this->_table);
		$this->db->where('pro_id', $pro_id);
		$this->db->where('feedback_status', 1);

		$result = $this->db->get();
		return $result->row_array();
	}    
}