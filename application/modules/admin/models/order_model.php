<?php 
class Order_model extends CI_Model{
	protected $_table;

	public function __construct(){
		parent::__construct();
		$this->_table = 'tbl_order';
		$this->load->database();
	}

	public function get_order($id){
		$query = $this->db->get_where($this->_table, array('order_id' => $id));
		return $query->row_array();
	}
	
	public function get_all_orders(){
		return $this->db->get($this->_table)->result_array();
	}
	
	public function get_order_details($id){
		$this->db->where('order_id',$id);
		return $this->db->get('tbl_order_detail')->result_array();
	}
	
	
	public function update($id,$data){
		$this->db->where('order_id', $id);
		$this->db->update($this->_table, $data); 
	}
	
	
	//hungtp: get record on each page based on limit
	public function paged_orders($limit, $start,$field = null, $order = null) {
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