<?php
class User extends Admin_Controller {
    
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
        $this->load->model("config_model");
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library("form_validation");
		$this->load->helper('url');

	}

	// acc5 - toannt2
	public function index(){

		$data = array();

		$data['title'] = "List Users";		

		$data['users'] = $this->user_model->get_users();
        //get number of page
        $getpage = $this->config_model->getNumberPage();
        $data['per_page'] = $getpage['config_page'];
        
		$this->load->view("templates/header", $data);
		$this->load->view("user/user_list", $data);
		$this->load->view("templates/footer", $data);

	} // end function index
	
	// acc2 - hungtp
	public function insert(){


		$data = array();

		$data['title'] = "Insert Users";
		$data['msg'] = "";
		
		//check if data was submited
		if(isset($_POST["submit"])){
			
			//valid data
			$this->form_validation->set_rules('name', 'Username', 'trim|required|alpha_dash|is_unique[tbl_user.user_name]|xss_clean');
			$this->form_validation->set_rules('pass', 'Password', 'trim|required|alpha_dash|md5');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[pass]');
			$this->form_validation->set_rules('address', 'Address', 'trim');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|is_natural|min_length[10]|max_length[11]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_emails|is_unique[tbl_user.user_email]');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('level', 'Level', 'required');
			
			//custom error message
			$this->form_validation->set_message('is_unique', 'This %s has existed.');
			
			if ($this->form_validation->run() != FALSE){//valid data successfully
				
				$name = $this->input->post("name");
				$pass = $this->input->post("pass");
				$passconf = $this->input->post("passconf");
				$address = $this->input->post("address");
				$phone = $this->input->post("phone");
				$email = $this->input->post("email");
				$gender = $this->input->post("gender");
				$level = $this->input->post("level");
				
				//insert all data into an array
				$data['user_data'] = array(
					'user_name'=>$name,
					'user_pass'=>$pass,
					'user_address'=>$address,
					'user_phone'=>$phone,
					'user_email'=>$email,
					'user_gender'=>$gender,
					'user_level'=>$level,
				);
				
				//insert into database
				$this->user_model->insert($data['user_data']);
				
				$data['msg'] = 'Inserted successfully';
			}
		
		}

		$this->load->view("templates/header", $data);
		$this->load->view("user/user_insert", $data);
		$this->load->view("templates/footer", $data);

	} //end function insert

	// acc3 - hungtp(kiennb)
	public function update($id){

		$data = array();
		$data['title'] = "Update Users";
		$data['msg'] = "";
		
		//check if data was submited
		if(isset($_POST["submit"])){
			
			$pass = $this->input->post("pass");
			$passconf = $this->input->post("passconf");
			//valid data
			if($pass != ''){
				$this->form_validation->set_rules('pass', 'Password', 'trim|alpha_dash|md5');
				$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[pass]');
			}
			if($passconf  != ''){
				$this->form_validation->set_rules('pass', 'Password', 'required');
			}
			/* $this->form_validation->set_rules('name', 'Username', 'trim|required|is_unique[tbl_user.user_name]|xss_clean'); */
			$this->form_validation->set_rules('address', 'Address', 'trim');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|is_natural|min_length[10]|max_length[11]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_emails|callback_check_email['.$id.']');
			
			//custom error message
			$this->form_validation->set_message('is_unique', 'This %s has existed.');
			
			$name = $this->input->post("name");
			$address = $this->input->post("address");
			$phone = $this->input->post("phone");
			$email = $this->input->post("email");
			$gender = $this->input->post("gender");
			$level = $this->input->post("level");
			
			if ($this->form_validation->run() != FALSE){//valid data successfully
				
				if($pass != ''){
					//insert all data into an array
					$user_data = array(
						'user_pass'=>$pass,
						'user_address'=>$address,
						'user_phone'=>$phone,
						'user_email'=>$email,
						'user_gender'=>$gender,
						'user_level'=>$level,
					);
				}else{
					//insert all data into an array
					$user_data = array(
						'user_address'=>$address,
						'user_phone'=>$phone,
						'user_email'=>$email,
						'user_gender'=>$gender,
						'user_level'=>$level,
					);
				
				}
				
				//insert into database
				$this->user_model->update($id,$user_data);
				$data['msg'] = 'Updated successfully';
				
			}else{
					$data['user_data'] = array(
						'user_name'=>$name,
						'user_address'=>$address,
						'user_phone'=>$phone,
						'user_email'=>$email,
						'user_gender'=>$gender,
						'user_level'=>$level,
					);
			}
		
		}else{
			$data['user_data'] = $this->user_model->get_users($id);
		
		}

		$this->load->view("templates/header", $data);
		$this->load->view("user/user_update", $data);
		$this->load->view("templates/footer", $data);
	} //end function update

	// acc4 - luanvd
	public function delete(){
		$id = $this->uri->segment(4);
        $this->user_model->delete_user($id);
        Redirect(base_url("admin/user/"), 'refresh');    
	} //end function delete	

	// hungtp:check email when update user
	public function check_email($email,$id){
		$get_emails = $this->user_model->check_email($id,$email);
		if(count($get_emails) > 0){
			$this->form_validation->set_message('check_email', 'The %s field has existed.');
			return FALSE;
		}else{
			return TRUE;
		}

	} //end function email_check
	
}