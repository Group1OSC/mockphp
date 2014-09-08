<?php 
class Order extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');		
		$this->load->model("order_model");	
		$this->load->helper(array('form','url'));
		$this->load->library('session');
		$this->load->library('pagination');
	}	
	
	//hungtp:display list orders
	public function index(){
		$data = array();

		$data['title'] = "Orders Manager";
			
		
		//assign value of quantity of records per page
		$num_page = 5;
		if(isset($_POST['order_num_page'])){
			$num_page = $this->input->post('order_num_page');
			$this->session->set_userdata('order_num_page',$num_page);
		}
		if($this->session->userdata('order_num_page') != null){
			$num_page = $this->session->userdata('order_num_page');;
		}
		$data['get_num']	= $num_page;
		
		$order_data = $this->order_model->get_all_orders();
		$total_row = count($order_data);
		
		if($total_row >0){//check if there is records or not
			
			//config pagination
			$config['base_url'] = base_url().'admin/order/index/';
			$config['total_rows'] = $total_row;
			$config['per_page'] = $num_page;
			

			$this->pagination->initialize($config);
			
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
			$offset = ($page-1)*$num_page;
			$data['page'] = $page;
			$data['results'] = $this->order_model->paged_orders($config["per_page"], $offset,'order_name', 'asc');
			$data['links'] = $this->pagination->create_links();
			$data['num']	= ($page-1)*$num_page+1;
		}else{
			$data['results'] = '';
		}
		
		if(isset($_POST['order_num_page'])){
			 redirect('/admin/order/index', 'location');
		}
		
		$this->load->view("templates/header", $data);
		$this->load->view("order/order_view", $data);
		$this->load->view("templates/footer", $data);

	} //end function index
	
	
	//hungtp:display order details
	public function detail($id){
		$data = array();

		$data['title'] = "Order details";
		$data['detail_id'] = $id;
		
		$data['result'] = $this->order_model->get_order($id);
		
		//get products in order
		$data['results'] = $this->order_model->get_order_details($id);
		
		$total = 0;
		foreach($data['results'] as $key=>$value){
			$sum = $value['pro_price']*$value['quantity'];
			$data['results'][$key]['total'] = $sum;
			$total += $sum;
		}
		$data['sum_total'] = $total;
		/* print_r($data['results']);exit(); */
		
		$this->load->view("templates/header", $data);
		$this->load->view("order/order_detail", $data);
		$this->load->view("templates/footer", $data);
	}
	
	
	//hungtp:set status for order 
	public function success($id,$detail_id = null,$page = null){
		$change = array(
			'order_status'=>1
		);
		$data['result'] = $this->order_model->update($id,$change);
		
		if($detail_id == null){
			if($page != null)
				redirect('/admin/order/index/'.$page, 'location');
			else
				redirect('/admin/order/index', 'location');
		}
		else{
			redirect('/admin/order/detail/'.$detail_id, 'location');
		}
	}
	
	//hungtp:set status for order 
	public function cancel($id,$detail_id = null,$page = null){
		$change = array(
			'order_status'=>-1
		);
		$data['result'] = $this->order_model->update($id,$change);
		
		if($detail_id == null){
			if($page != null){
				redirect('/admin/order/index/'.$page, 'location');
			}
			else
				redirect('/admin/order/index', 'location');
		}
		else{
			redirect('/admin/order/detail/'.$detail_id, 'location');
		}
	}
}