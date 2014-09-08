<?php
class Product_model extends CI_Model{

	protected $_table = "tbl_product";
    protected $_image = "tbl_image";
    protected $_cate = "tbl_pro_cate";

	public function __construct(){
		parent::__construct();
			
		$this->load->database();
	}

	public function get_total_products(){
		return $this->db->count_all($this->_table);
	}

	// acc05 - toannt2
    public function get_all_products() {
		return $this->db->get($this->_table)->result_array();	
	}

    // acc05-toannt2
    public function get_all_joined_products(){

    	$this->db->from('tbl_product as p');
		$this->db->join('tbl_brand as b', 'b.brand_id = p.pro_brand', 'left');

		return $this->db->get()->result_array();		
	}

	// acc05 - toannt2
	public function search_limit($search_type='like', $id, $name, $brand, $country, $prcMin, $prcMax, $offset, $limit){

		$this->db->select('p.pro_id, p.pro_name, p.pro_list_price, p.pro_sale_price, p.pro_desc, p.pro_country, b.brand_name');
		$this->db->from('tbl_product as p');
		$this->db->join('tbl_brand as b', 'b.brand_id = p.pro_brand', 'left');
		$this->db->where('p.pro_list_price >=', $prcMin);
		$this->db->where('p.pro_list_price <=', $prcMax);

		if($id != ""){
			$this->db->$search_type('p.pro_id', $id);
		}
		if($name != ""){
			$this->db->$search_type('p.pro_name', $name);
		}
		if($country != ""){
			$this->db->$search_type('p.pro_country', $country);
		}
		if($brand !=""){
			$this->db->$search_type('b.brand_name', $brand);
		}

		$this->db->limit($limit, $offset);

		$result = $this->db->get();

		return $result->result_array();
	}


	// acc05 - toannt2
	public function count_search_all($search_type='like', $id, $name, $brand, $country, $prcMin, $prcMax){

		$this->db->select('p.pro_id');
		$this->db->from('tbl_product as p');
		$this->db->join('tbl_brand AS b', 'b.brand_id = p.pro_brand', 'left');
		$this->db->where('p.pro_list_price >=', $prcMin);
		$this->db->where('p.pro_list_price <=', $prcMax);

		if($id != ""){
			$this->db->$search_type('p.pro_id', $id);
		}
		if($name != ""){
			$this->db->$search_type('p.pro_name', $name);
		}
		if($country != ""){
			$this->db->$search_type('p.pro_country', $country);
		}
		if($brand !=""){
			$this->db->$search_type('b.brand_name', $brand);
		}

		return $this->db->count_all_results();	
	}
	
	//hungtp:get product data
	public function get_product($id){
		$query = $this->db->get_where($this->_table, array('pro_id' => $id));
		return $query->row_array();
	}
	
	//hungtp:delete product
	public function delete_product($id){
		$this->db->where('pro_id', $id);
		$this->db->delete($this->_table);
	}
	
	//hungtp:delete all alt images of specific product
	public function delete_img($pro_id){
		$this->db->where('pro_id', $pro_id);
		$this->db->delete('tbl_image');
	}

	//hungtp:get largest id of product
	public function get_max_id(){
		$this->db->order_by('pro_id','desc');
		return $this->db->get($this->_table)->row_array();
	}
	//hungtp:insert product into db
	public function insert($data){
		$this->db->insert($this->_table, $data);
	}
	//hungtp:insert product into db
	public function insert_custom($table,$data){
		$this->db->insert($table, $data);
	}
	
	
	//hungtp:update product
	///////////////////////////////////////////////////////////////////////////////////
    //luanvd-hungtp use this function
    public function update($data, $id){
      	$this->db->where("pro_id = $id");
    	$this->db->update($this->_table,$data);
	}
    
    //////////////////////////////////////////////////////////////////////////////////
    //luanvd: update product
    public function getInforUpdate($id){
        $query = "SELECT * FROM tbl_product WHERE pro_id ='".$id."' ";
        $result = $this->db->query($query);
        return $result->row_array();
    }
    public function getCateId($id){
        $query = "SELECT cate_id FROM tbl_pro_cate WHERE pro_id = '".$id."' ";
        $result = $this->db->query($query);
        return $result->result_array();
    }
   	public function deleteCate($id){
		$sql="DELETE FROM tbl_pro_cate WHERE pro_id='".$id."'";
		$this->db->query($sql);
	}
	public function insertCate($value,$id){
		$sql="INSERT INTO tbl_pro_cate (pro_id,cate_id) VALUES (".$id.", ".$value.")";
		$this->db->query($sql);
	}
    //get main image in tbl_image
	public function getImages($id){
 	   
		$sql="SELECT * FROM tbl_image WHERE pro_id= '".$id."' AND img_status = 1 ";
		$result = $this->db->query($sql);
		return $result->row_array();
	}
    //get main image in tbl_product
   	public function getMainImage($id){
		$sql="SELECT pro_image FROM tbl_product WHERE pro_id= '".$id."' ";
		$result = $this->db->query($sql);
		return $result->row_array();
	}

    public function getThumbImage($id){
        $sql= "SELECT * FROM tbl_image WHERE img_id =".$id;
        $result = $this->db->query($sql);
        return $result->row_array(); 
    }
    //update mainImage in tbl_image
    public function updateMainImage($imagelink, $id){
        $sql= "UPDATE tbl_image set img_link = '".$imagelink."'WHERE pro_id = '".$id."' AND img_status = 1";
        $this->db->query($sql);
    }
    //updata mainImage in product
    public function updateMainImageProduct($imagelink, $id){
        $sql= "UPDATE tbl_product set pro_image = '".$imagelink."'WHERE pro_id = '".$id."' ";
        $this->db->query($sql);
    }
    //update status main to thumb
    public function updateStatusThumb($imagelink, $id){
        $sql= "UPDATE tbl_image SET img_status = 0  WHERE pro_id = '".$id."' AND img_link = '".$imagelink."' ";
        $this->db->query($sql);
    }
    //update status thumb to main
    public function updateStatusMainImage($imagelink, $id){
        $sql= "UPDATE tbl_image SET img_status = 1  WHERE pro_id = '".$id."' AND img_link = '".$imagelink."' ";
        $this->db->query($sql);
    }
    //get all Thumbs Image
   	public function getImagesThumb($id){
        $this->db->where("pro_id",$id);
        $this->db->where("img_status",0);
        $data = $this->db->get("tbl_image")->result_array();
        return $data;
	}
  	public function insert_pro_image($data){
		$this->db->insert_batch($this->_image,$data);
	}
  	public function delete_one_thumb($id){
	   $this->db->query("DELETE FROM $this->_image WHERE img_id = $id");
	}	

}


