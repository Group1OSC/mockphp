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
	public function get_all_category_order(){
		$this->db->order_by('cate_level', 'desc');
		return $this->db->get($this->_table)->result_array();
	}
	
	//hungtp:get categories with specific condition
	public function get_cates_list($data){
		$this->db->where('cate_parent', $data);
		$this->db->order_by('cate_orderby', 'asc');
		return $this->db->get($this->_table)->result_array();
	}

}
