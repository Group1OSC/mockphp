<?php 
class Report_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		
		$this->load->database();
	}

	public function product($fromDate, $toDate){

		$sql = 
		"SELECT p.pro_id, COUNT(p.pro_id) AS count, p.pro_name, p.pro_list_price, p.pro_sale_price, SUM(od.quantity) AS quantity
		FROM (
			(SELECT * FROM tbl_order WHERE order_time >= '$fromDate' AND order_time <= '$toDate' AND order_status = 1) AS o	
			LEFT JOIN tbl_order_detail AS od ON od.order_id = o.order_id
            INNER JOIN tbl_product AS p ON od.pro_id = p.pro_id
		) GROUP BY od.pro_id ORDER BY count DESC, quantity DESC
		";

		$query = $this->db->query($sql);
		return $query->result_array();		
	}

	public function category($fromDate, $toDate){
		$sql = 
		"SELECT cate.cate_id, count(cate.cate_id) as count, cate.cate_name, cate.cate_level, cate.cate_parent
		FROM (
			(SELECT * FROM tbl_order WHERE order_time >= '$fromDate' AND order_time <= '$toDate' AND order_status = 1) AS o
			LEFT JOIN tbl_order_detail AS od ON od.order_id = o.order_id
			INNER JOIN tbl_pro_cate AS pc ON od.pro_id = pc.pro_id
			LEFT JOIN tbl_category as cate ON pc.cate_id = cate.cate_id
		) GROUP BY cate.cate_id ORDER BY count DESC
		";

		$query = $this->db->query($sql);
		return $query->result_array();	
	}
}