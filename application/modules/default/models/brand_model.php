<?php
class brand_model extends CI_Model{
	
	protected $_table = "tbl_brand";

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	//hungtp: get all brands
	public function get_all_brands(){
		return $this->db->get($this->_table)->result_array();
	}
	
	//hungtp: get record on each page based on limit
	public function paged_brands($limit, $start,$field = null, $order = null) {
		if(!empty($order)){
			$this->db->order_by($field, $order);
			$this->db->limit($limit, $start);
		}else{
			$this->db->limit($limit, $start);
		}
		$query = $this->db->get($this->_table);

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $key=>$value) {
				$data[$key] = $value;
			}
			return $data;
		}
		return false;
	}
	
}