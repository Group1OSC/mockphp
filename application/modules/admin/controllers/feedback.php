<?php
class Feedback extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->model("feedback_model");
        $this->load->model("config_model");
		$this->load->library('pagination');
	}
	
	public function index(){
		$data = array();

		$data['title'] = "Pending Feedbacks";
		
		//assign value of quantity of records per page
        $getpage = $this->config_model->getNumberPage();
		$data['per_page'] = $getpage['config_page'];

		$data['feedbacks'] = $this->feedback_model->get_waiting_feedbacks();

		$this->load->view("templates/header", $data);
		$this->load->view("feedback/feedback_list", $data);
		$this->load->view("templates/footer", $data);

	}  //end function index

	public function approve(){

		$id = $this->uri->segment(4);

        //Check url
        if(!is_numeric($id) || intval($id) <= 0){
                show_404();
        }   
    
        if(!$this->feedback_model->check_feedback_exist($id)){
            show_404();
        }
        //End check url

        $this->feedback_model->approve($id);
		redirect(base_url("/admin/feedback/"), 'refresh');
	}

	public function disapprove(){

		$id = $this->uri->segment(4);

        //Check url
        if(!is_numeric($id) || intval($id) <= 0){
                show_404();
        }   
    
        if(!$this->feedback_model->check_feedback_exist($id)){
            show_404();
        }
        //End check url

        $this->feedback_model->disapprove($id);
		redirect(base_url("/admin/feedback/"), 'refresh');        
	}
}