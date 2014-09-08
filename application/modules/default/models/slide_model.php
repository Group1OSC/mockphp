<?php
class Slide_model extends CI_Model{

    protected $_table = "tbl_slide";
    protected $_product = "tbl_product";

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	//hungtp
	public function get_total_slides(){
		return $this->db->count_all($this->_table);
	}

	// hungtp
    public function get_all_data() {
		$this->db->select('tbl_product.pro_sale_price,tbl_product.pro_list_price,tbl_product.pro_name, tbl_product.pro_desc, tbl_product.pro_image, tbl_product.pro_id, tbl_slide.slide_order');
		$this->db->from($this->_product);
		$this->db->join($this->_table, 'tbl_product.pro_id = tbl_slide.pro_id','inner');
		$this->db->order_by('slide_order','asc');

		return $this->db->get()->result_array();	
	}


}


