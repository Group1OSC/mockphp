<?php
class product_model extends CI_Model{

    protected $_table = "tbl_product";
    protected $_order = "tbl_order";
    protected $_orderDetail = "tbl_order_detail";


    public function __construct(){
        parent::__construct();
         $this->load->database();   
    }

    //count how many product
	public function get_total_products(){
		return $this->db->count_all($this->_table);
	}
	public function get_max_price(){
    	$this->db->select('pro_sale_price');
		$this->db->order_by('pro_sale_price', 'desc');
		return $this->db->get($this->_table)->row_array();
	}

    //get informations of products
    public function get_all_products($filter = null, $cate_id = null) {
	
    	$this->db->select();
			$this->db->from('tbl_product as p');
		if(!empty($cate_id)){
		
			$this->db->join('tbl_pro_cate as pc', 'pc.pro_id = p.pro_id', 'inner');
			$this->db->where_in('pc.cate_id', $cate_id);
		}
		if(!empty($filter['price_range'])){
		//echo 'sdfd';exit();
			$this->db->where("p.pro_sale_price BETWEEN ".$filter['price_range'][0]." AND ".$filter['price_range'][1]);
		}
		if(!empty($filter['brands'])){
			$this->db->where_in('p.pro_brand',$filter['brands']);
		}
		return $this->db->get()->result_array();	
	}

    //getNumberPage
    public function getNumberPage(){
        $this->db->select('tbl_config.config_page');
        return $this->db->get()->row_array();
    } 

    //acc04-luanvd list all product (pagination)
    public function product_limit($limit, $offset){
        $this->db->select('p.pro_id, p.pro_name, p.pro_image, p.pro_list_price, p.pro_sale_price');
        $this->db->from('tbl_product as p');
        $this->db->limit($limit, $offset);
        $result = $this->db->get();
        return $result->result_array();
    }
    public function insertOrder($data){
        $this->db->insert($this->_order,$data);
        return $this->db->insert_id();
    }
    public function insertOrderDetail($data){
        $this->db->insert($this->_orderDetail,$data);
    }
	
	////////////////////////////////////////
	//acc05-toannt2 list product by category (pagination)
    public function product_by_cate_limit($cate_id, $limit, $offset){

    	$this->db->select('p.pro_id, p.pro_name, p.pro_desc, p.pro_list_price, p.pro_sale_price, p.pro_image');
    	$this->db->from('tbl_pro_cate as pc');
    	$this->db->join('tbl_product as p', 'pc.pro_id = p.pro_id', 'left');
    	$this->db->where('pc.cate_id', $cate_id);
    	$this->db->limit($limit, $offset);
    	$result = $this->db->get();
    	return $result->result_array();
    }

    //acc05-toannt2 return number of products in a specific category
    public function count_product_by_cate($cate_id){
    	$this->db->select('p.pro_id');
    	$this->db->from('tbl_pro_cate as pc');
    	$this->db->join('tbl_product as p', 'pc.pro_id = p.pro_id', 'left');
    	$this->db->where('pc.cate_id', $cate_id);

    	return $this->db->count_all_results();    	
    }
    public function count_product_menu($data){
    	$this->db->select();
    	$this->db->from('tbl_pro_cate');
    	$this->db->where_in('cate_id', $data);

    	return $this->db->count_all_results();    	
    }

    // acc05-toannt2
    public function get_product_detail($pro_id){

        $this->db->from('tbl_product as p');
        $this->db->join('tbl_brand as b', 'b.brand_id = p.pro_brand', 'left');
        $this->db->where('pro_id', $pro_id);
        return $this->db->get()->row_array();        
    } 

    //toannt2-check if a product exists or not
    public function check_product_exist($pro_id){

        $this->db->select();
        $this->db->from($this->_table);
        $this->db->where('pro_id', $pro_id);

        if($this->db->count_all_results() == 1){
            return true;
        }
        
        return false;
    }    
	
	//acc02-hungtp filter product 
    public function product_filter($limit, $offset,$get_sort, $get_order,$filter = null, $cate_id = null){
        $this->db->select('p.pro_id, p.pro_name, p.pro_image, p.pro_list_price, p.pro_sale_price');
        $this->db->from('tbl_product as p');
		if($cate_id != null){
			$this->db->join('tbl_pro_cate as pc', 'p.pro_id = pc.pro_id', 'inner');
			$this->db->where_in('pc.cate_id', $cate_id);
		}
		if(!empty($filter['price_range'])){
		//echo 'sdfd';exit();
			$this->db->where("p.pro_sale_price BETWEEN ".$filter['price_range'][0]." AND ".$filter['price_range'][1]);
		}
		if(!empty($filter['brands'])){
			$this->db->where_in('p.pro_brand',$filter['brands']);
		}
        $this->db->limit($limit, $offset);
        $this->db->order_by($get_sort, $get_order);
        $result = $this->db->get();
        return $result->result_array();
    }
}