<?php 
class Report extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model("report_model");
        $this->load->model("config_model");
	}	

	public function product(){

		$data = array();

		$data['title'] = "Products Report";

		$data['products'] = $this->report('product');
        //luanvd: get number per page
        $getpage = $this->config_model->getNumberPage() ;
        $data['per_page'] = $getpage['config_page'];
        
		$this->load->view("templates/header", $data);
		$this->load->view("report/report_product", $data);
		$this->load->view("templates/footer", $data);

	} //end function product

	public function category(){

		$data = array();

		$data['title'] = "Categories Report";

		$data['cates'] = $this->report('category');
        //luanvd
        $getpage = $this->config_model->getNumberPage();
        $data['per_page'] = $getpage['config_page'];

		$this->load->view("templates/header", $data);
		$this->load->view("report/report_category", $data);
		$this->load->view("templates/footer", $data);

	} //end function category

	private function report($type="product"){

		if($this->input->post("btnReport")){


			$fromDate = $this->input->post("fromDate");
			$toDate   = $this->input->post("toDate");

			if(!isset($fromDate) || !isset($toDate) || empty($fromDate) || empty($toDate)){
				$this->session->unset_userdata('fromDate');
				$this->session->unset_userdata('toDate');
			} else {
				$this->session->set_userdata('fromDate', $fromDate);
				$this->session->set_userdata('toDate', $toDate);
			}

		}

		if($this->session->userdata('fromDate') && $this->session->userdata('toDate')){

			$fromDate = $this->session->userdata('fromDate') . " 00:00:00";
			$toDate = $this->session->userdata('toDate') . " 23:59:59";

			$items = $this->report_model->$type($fromDate, $toDate);

			$order = 0;
			foreach($items as &$item){

				$item['order'] = ++$order;
			}

			return $items;
		}

		return array();

	}
}