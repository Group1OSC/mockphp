<?php
class brand_model extends CI_Model{
	
	protected $_table = "tbl_brand";

	public function __construct(){
		parent::__construct();
		
		$this->load->database();
	}
    public function detail($id){
        $this->db->where("brand_id = $id");
        return $this->db->get($this->_table)->row_array();
    }
    public function update($data,$id){
			$this->db->where("brand_id",$id);
			$this->db->update($this->_table,$data);
	}
	public function delete_one_brand($id){
	   $this->db->query("DELETE FROM $this->_table WHERE brand_id = $id");
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
	}
    //luanvd:
    public function getAll() {
			$query = $this->db->query("SELECT * FROM $this->_table");
			return $query->result_array();
	}
	
	//toannt2
	public function insert_brand($data){
		$this->db->insert($this->_table, $data);
	}

	//toannt2
	public function search_brand($brand_name){
		$this->db->like('brand_name', $brand_name);
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}	
}