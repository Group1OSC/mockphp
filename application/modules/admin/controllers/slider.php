<?php 
class Slider extends CI_Controller{

	private $changeTree = array();
	public function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library("form_validation");
        $this->load->model("config_model");
		$this->load->helper('url');
		$this->load->model("product_model");
		$this->load->model("category_model");
		$this->load->model("brand_model");
		$this->load->model("slide_model");
        $this->load->library("upload");
	}	

	// acc1 - huanvm
	public function index(){
		$data = array();
		$data['title'] = "Sliders Magager";
		
		$slide_data = $this->slide_model->select_all_join();
		
		$data['slide_data'] = $slide_data;

		$this->load->view("templates/header", $data);
		$this->load->view("slider/slider_view", $data);
		$this->load->view("templates/footer", $data);

	}
	
	//hungtp:get data from move view and update db
	public function data(){
		$get_data = json_decode($_GET['data']);
		//update db
		foreach($get_data as $key=>$value){
			$data = array(
				'slide_order'=>$key+1,
			);
			$this->slide_model->update($value->id,$data);
		}
	}
}