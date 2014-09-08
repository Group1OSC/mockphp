<?php
class Slide_model extends CI_Model{

    protected $_table = "tbl_slide";
    protected $_product = "tbl_product";

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	//hungtp
	public function insert($data){
		$this->db->insert($this->_table, $data);
	}

	// hungtp
    public function select_all() {
		$this->db->select('pro_id');
		$this->db->order_by('slide_order','asc');
		return $this->db->get($this->_table)->result_array();	
	}
	// hungtp
    public function select_all_join() {
		$this->db->select('tbl_product.pro_name, tbl_slide.slide_id');
		$this->db->from($this->_product);
		$this->db->join($this->_table, 'tbl_product.pro_id = tbl_slide.pro_id','inner');
		$this->db->order_by('slide_order','asc');

		return $this->db->get()->result_array();
	}
	// hungtp
    public function delete_all() {
		$this->db->truncate($this->_table);

	}
	// hungtp
    public function update($id,$data) {

		$this->db->where('slide_id', $id);
		$this->db->update($this->_table, $data); 

	}


}


