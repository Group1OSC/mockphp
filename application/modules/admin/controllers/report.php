<?php 
class Report extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model("report_model");
		$this->load->model("category_model");
        $this->load->model("config_model");
	}	

	public function product(){

		$data = array();

		$data['title'] = "Products Report";

		$data['products'] = array();

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

			$items = $this->report_model->product($fromDate, $toDate);

			$order = 0;
			foreach($items as &$item){

				$item['order'] = ++$order;
			}

			$data['products'] = $items;
		}

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

		$data['cates'] = array();


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

			$cates = $this->report_model->category($fromDate, $toDate);

			if(count($cates) > 0) {

				$top_cates_id = array();

				foreach ($cates as &$top_cate) {
					$top_cates_id[] = $top_cate['cate_id'];
					$top_cate['direct_pro'] = $top_cate['count'];
				}


				$result_all_cates = $this->category_model->get_all_category();
				foreach ($result_all_cates as $cate) {

					if(!in_array($cate['cate_id'], $top_cates_id) ){
						$cates[] = array('cate_name' => $cate['cate_name'],
				 	                     'count'     => 0,
				 	                     'cate_id'   => $cate['cate_id'],
				 	                     'cate_level' => $cate['cate_level'],
				 	                     'cate_parent' => $cate['cate_parent'],
				 	                     'direct_pro' => 0
				 	                     );
					}
				}

				foreach($cates as &$cate) {

					$cate['count'] += $this->dequy($cate['cate_id'], $cates);
				}

				foreach ($cates as &$cate) {

				    $count[$cate['cate_id']]  = $cate['count'];

				}

				array_multisort($count, SORT_DESC, $cates);

				$data['cates'] = $cates;
			}
		}

        //luanvd
        $getpage = $this->config_model->getNumberPage();
        $data['per_page'] = $getpage['config_page'];

		$this->load->view("templates/header", $data);
		$this->load->view("report/report_category", $data);
		$this->load->view("templates/footer", $data);

	} //end function category

	private function dequy($cate_parent, $cates){
		$count = 0;
		foreach ($cates as $cate) {
			if($cate['cate_parent'] == $cate_parent){
				if($cate['count'] == $cate['direct_pro']){
				$count += $cate['count'] + $this->dequy($cate['cate_id'], $cates);
				} else {
					$count += $cate['count'];
				}
			}
		}
		return $count;
	}
}