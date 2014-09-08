<?php 
class Admin_Controller extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		if (!$this->session->userdata('logged_in')){
			redirect(base_url("authen/login"), "refresh");
		}
	}
}
