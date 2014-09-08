<?php
class Image_model extends CI_Model{

	protected $_table="tbl_image";
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	// toannt2 - return an array of alternative images of a specific product
	function get_alt_images($pro_id){
		$this->db->select('img_link');
		$this->db->from($this->_table);
		$this->db->where('pro_id', $pro_id);
		$this->db->order_by('img_status', 'asc');
		$this->db->order_by('img_link', 'asc');
		$result = $this->db->get()->result_array();

		$images_arr = array();

		foreach($result as $item){
			$images_arr[] = $item['img_link'];
		}

		return $images_arr;
	}

}