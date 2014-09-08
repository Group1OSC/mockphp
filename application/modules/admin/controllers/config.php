<?php 
class Config extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	    $this->load->model("config_model");
		//$this->load->model("products_model");
		$this->load->library("session");
		$this->load->library("form_validation");
		$this->load->helper(array('form','url'));

	}	
	public function index(){

		$data = array();

		$data['title'] = "Config";
        $data['config_page']=$this->config_model->getNumberPage();

      		if($this->input->post('update')){
			$this->form_validation->set_rules("config_page","The number of config","trim|required|is_natural_no_zero");
			$this->form_validation->set_message("required","%s is required");
            $this->form_validation->set_message("is_natural_no_zero","%s must be an integer and not zero");
			
			$this->form_validation->set_error_delimiters("<span class='error' color='red'>","</span>");
			if($this->form_validation->run()){
				$dataNumberPage = $this->input->post('config_page');
				$this->config_model->update($dataNumberPage);
				redirect(base_url("admin/product/"));
			}

            }
		$this->load->view("templates/header", $data);
		$this->load->view("config/config_view", $data);
		$this->load->view("templates/footer", $data);
        
        if($this->input->post('cancel')){
            redirect(base_url("admin/product/"),'refresh');
        }
	} //end function index
}




