<?php
class Brand extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->model("brand_model");
        $this->load->model("config_model");
		$this->load->library('pagination');
		$this->load->library('session');
        $this->load->library('form_validation');
	}
	
	// acc2 - hungtp
	public function index(){
		$data = array();

		$data['title'] = "List Brands";
		
		//assign value of sort type
		$sort = '';
		if(isset($_POST['brand_sort'])){
			$sort = $this->input->post('brand_sort');
			$this->session->set_userdata('brand_sort',$sort);
		}else{
			$sort = $this->session->userdata('brand_sort');;
		}
		
		//assign value of quantity of records per page
        $getpage = $this->config_model->getNumberPage();
		$num_page = $getpage['config_page'];
        
		if(isset($_POST['brand_num_page'])){
			$num_page = $this->input->post('brand_num_page');
			$this->session->set_userdata('brand_num_page',$num_page);
		}
		if($this->session->userdata('brand_num_page') != null){
			$num_page = $this->session->userdata('brand_num_page');;
		}
		$data['get_sort']	= $sort;
		$data['get_num']	= $num_page;
		
		$brand_data = $this->brand_model->get_all_brands();
		$total_row = count($brand_data);
		
		if($total_row >0){//check if there is records or not
			
			//config pagination
			$config['base_url'] = base_url().'admin/brand/index/';
			$config['total_rows'] = $total_row;
			$config['per_page'] = $num_page;
			$config['uri_segment'] = 4;
			

			$this->pagination->initialize($config);
			
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
			$offset = ($page-1)*$num_page;
			$data['results'] = $this->brand_model->paged_brands($config["per_page"], $offset,'brand_name', $sort);
			$data['links'] = $this->pagination->create_links();
			$data['num']	= ($page-1)*$num_page+1;
		}else{
			$data['results'] = '';
		}
		
		if(isset($_POST['brand_num_page'])){
			 redirect('/admin/brand/index', 'location');
		}
		$this->load->view("templates/header", $data);
		$this->load->view("brand/brand_list", $data);
		$this->load->view("templates/footer", $data);

	}  //end function index

	// toannt2
	public function search(){

		$data = array();

		$data['title'] = "Search Brands";

		if($this->input->post("submit")){

			$brand_name   = $this->input->post("brand_name");
			$data['brand_name'] = $brand_name;
			$data['brands'] = $this->brand_model->search_brand($brand_name);
		} else {
			$data['brands'] = $this->brand_model->get_all_brands();
		}

		$this->load->view("templates/header", $data);
		$this->load->view("brand/brand_search", $data);
		$this->load->view("templates/footer", $data);

	}  //end function search

	// toannt2
	public function insert(){

		$data = array();

		$data['title'] = "Insert Brands";
		$data['button'] = 'Insert';

		if($this->input->post("submit")){

			$this->form_validation->set_rules("brand_name","Brand name","trim|required|is_unique[tbl_brand.brand_name]");
			$this->form_validation->set_message("required","%s is required.");
			$this->form_validation->set_message("is_unique","%s already exists.");
            $this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

			$brand_name   = $this->input->post("brand_name");

			$data['brand_name'] = $brand_name;

			if ($this->form_validation->run()) {

				$this->brand_model->insert_brand(array('brand_name' => $brand_name));
				redirect(base_url("admin/brand/"),'refresh');
			}
		}

        if($this->input->post("btnCancel")) {
                redirect(base_url("admin/brand/"),'refresh');
        }

		$this->load->view("templates/header", $data);
		$this->load->view("brand/brand_insert", $data);
		$this->load->view("templates/footer", $data);

	}  //end function insert

	// acc4 - luanvd	
	public function update(){
        $id = $this->uri->segment(4);
         
		$data = array();

		$data['title'] = "Update Brands";
        $data['brandInfor'] = $this->brand_model->detail($id);
        
            if($this->input->post('update')){
				$this->form_validation->set_rules("brand_name","The Brand Name","trim|required|is_unique[tbl_brand.brand_name]");
		      	$this->form_validation->set_message("required","%s is required.");
                $this->form_validation->set_message("is_unique","%s already exists.");
				$this->form_validation->set_error_delimiters("<span class='error'>","</span>");
				$ten=$this->input->post("brand_name");
				if($this->form_validation->run()){
				$dataBrand = array("brand_name"=>$this->input->post("brand_name"));
						$this->brand_model->update($dataBrand, $id);
						redirect(base_url("admin/brand/"),'refresh');
				}
			}
            
        $this->load->view("templates/header", $data);
        $this->load->view("brand/brand_update", $data);
		$this->load->view("templates/footer", $data);
        
        //cacel update
        if($this->input->post("cancel")) {
                redirect(base_url("admin/brand/"),'refresh');
        }
            

	}  //end function update

	// acc3 - kiennb-luanvd
	public function delete(){
	   $id = $this->uri->segment(4);
       $this->brand_model->delete_one_brand($id);
       redirect(base_url("admin/brand/"),'refresh');	   
	}  //end function delete
}