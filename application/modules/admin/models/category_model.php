<?php
class category_model extends CI_Model{

	protected $_table = "tbl_category";
	public function __construct(){
		parent::__construct();
			
		$this->load->database();
	}

	public function get_all_category(){
		return $this->db->get($this->_table)->result_array();
	}
	
	// acc05 - toannt2
	public function insert_category($data){
		$this->db->insert($this->_table, $data);
	}

	// acc05 - toannt2
	public function get_sibling_orderby($cate_parent, $cate_level){
		$this->db->select('cate_orderby');
		$query = $this->db->get_where($this->_table, array('cate_parent' => $cate_parent, 'cate_level' => $cate_level));
		return $query->result_array();
	}
	
	//hungtp:get categories with specific condition
	public function get_cate($id){
		$this->db->where('cate_id', $id);
		return $this->db->get($this->_table)->result_array();
	}
	//hungtp:update categories
	public function update_cate($id,$data){
		$this->db->where('cate_id', $id);
		$this->db->update($this->_table, $data);
	}
	
	//hungtp:get categories with specific condition
	public function get_cates_list($data){
		$this->db->where('cate_parent', $data);
		$this->db->order_by('cate_orderby', 'asc');
		return $this->db->get($this->_table)->result_array();
	}
	//hungtp:get categories with specific condition
	public function count_level($data){
		$this->db->distinct();
		$this->db->select('cate_level');
		$this->db->where('cate_parent', $data);
		$this->db->order_by('cate_orderby', 'asc');
		return $this->db->get($this->_table)->result_array();
	}
	
	//hungtp:delete a single record
	public function delete_category($id){
		$this->db->where("cate_id", $id);
		$this->db->delete($this->_table);
	}
	
	//hungtp: get record on each page based on limit
	public function paged_cates($limit, $start,$field = null, $order = null) {
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
	//luanvd: update category
    	public function detail($id){
        	$this->db->where("cate_id = $id ");
        	return $this->db->get($this->_table)->row_array();
    	}
    	public function update($data,$id){
        	$this->db->where("cate_id = $id");
        	$this->db->update($this->_table,$data);        
    	}
    	//end acc4 luanvd
	

}
