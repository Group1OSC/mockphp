<?php
class Login extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		
		$this->load->helper(array('form','url'));
		$this->load->library(array("form_validation","session"));
		$this->load->model("login_model");
	}
	
	public function index(){

		if($this->session->userdata('logged_in')){
			$data['username'] = $this->session->userdata('logged_in');
			redirect(base_url()."admin/user");
		}

		else {
			$data['login_failed'] = "";

			if ($this->input->post("submit")){

				$this->form_validation->set_rules("username","Username","trim|required");
				$this->form_validation->set_rules("password","Password","required");
					
				$this->form_validation->set_message("required","%s is required");
			
				if($this->form_validation->run()){
					$dataUser = array(
							"username" => $this->input->post("username"),
							"password" => $this->input->post("password")
					);
					$data = $this->login_model->login($dataUser['username'], md5($dataUser["password"]));
					if ($data){
						$this->session->set_userdata("logged_in",$data['user_name']);
						redirect(base_url()."admin/user");
					}
					else {
						$data['login_failed'] = "Wrong username/password";
					}
				}
			}
		}

		$this->load->view('login_view',$data);
	}

	public function logout(){
		$this->session->unset_userdata('logged_in');
		redirect(base_url()."authen/login", "refresh");
	} 
}