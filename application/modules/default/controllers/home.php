<?php
class Home extends CI_Controller {
	
	public function __construct() {

		parent::__construct();

        $this->load->library("cart");		
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->model("category_model");
		$this->load->model("product_model");
		$this->load->model("config_model");
		$this->load->model('slide_model');
		$this->load->model('brand_model');
		$this->load->model('image_model');
		$this->load->model('feedback_model');		
	}
	//get max price for product
	public function get_max_price(){
		$position = array('1','10','100','1000');
		
		$max_price = $this->product_model->get_max_price();
		
		$position_coma = stripos($max_price['pro_sale_price'],'.');
		if(empty($position_coma)){
			$position_coma = 1;
		}	
		$price = ceil($max_price['pro_sale_price']/$position[$position_coma-1])*$position[$position_coma-1];
		
		return $price;
	}
	// acc04-luanvd list all products
	public function index(){

		$data = array();
		
		//get menga menu
		$data = $this->mega_menu();
		$id = 0;
		$filter = $this->filter_product($id);
		$data['filter'] = $filter;
		
		//get max range price
		$data['max_price'] = $this->get_max_price();
		
		//sort product
		$sort = $this->sort_product();
		$data['sort'] = $sort;
		switch($sort['name']){
			case 'Name':
				$sort['name'] = 'pro_name';
				break;
			case 'Price':
				$sort['name'] = 'pro_sale_price';
				break;
			case 'Date':
				$sort['name'] = 'pro_id';
				break;
			default:
				$sort['name'] = 'pro_name';
				break;
		}

		$data['title'] = "Homepage";
		$data['type_page'] = "index";
        
        //how many product per page
        $getpage = $this->config_model->getNumberPage()['config_page'];

        //get config
        $config['base_url'] = base_url()."default/home/index/";
       // $config['total_rows'] = $this->product_model->get_total_products();
	   
        $config['total_rows'] = count($this->product_model->get_all_products($filter));
        $config['per_page'] = $getpage;

        //pagination base on config
        $this->pagination->initialize($config);
        //Page number
        $page_number = ($this->uri->segment(4)) ? $this->uri->segment(4): 1;

        $offset = ($page_number - 1) * $getpage;
		
		//validate variable on uri
        if(!is_numeric($page_number) || intval($page_number) <= 0){
            show_404();
        }
		$max_page = ceil($config['total_rows'] / $config['per_page']);
		if($config['total_rows'] == 0){
			$max_page = 1;
		}
        if($page_number > $max_page){
            show_404();
        }
		//end validation
		
        $data['products2'] = $this->product_model->product_limit($getpage, $offset);
		$data['products'] = $this->product_model->product_filter($getpage, $offset, $sort['name'], $sort['order'],$filter);
        
        $data['pages'] = $this->pagination->create_links();
        
        $this->load->view("templates/header", $data);
		$this->load->view("home/list", $data);
		$this->load->view("templates/footer", $data);
		
        if($this->input->post('addCart')){
            $this->add_cart();
        }    
         

		

	} // end function index
	
	
    //acc05-toannt2 - list products by category
    public function cate(){

        $data = array();

        $data = $this->mega_menu();
		
		//sort product
		$sort = $this->sort_product();
		$data['sort'] = $sort;
		switch($sort['name']){
			case 'Name':
				$sort['name'] = 'pro_name';
				break;
			case 'Price':
				$sort['name'] = 'pro_sale_price';
				break;
			case 'Date':
				$sort['name'] = 'pro_id';
				break;
			default:
				$sort['name'] = 'pro_name';
				break;
		}

		$data['title'] = "Homepage";
		$data['type_page'] = "list";

        $cate_id = $this->uri->segment(4);

        if(!is_numeric($cate_id) || intval($cate_id) <= 0){
            show_404();
        }

        // check if category exists or not
        $cate_exists = false;
        $cates = $this->category_model->get_all_category();

        foreach ($cates as $cate) {
            if($cate['cate_id'] == $cate_id){
                $cate_exists = true;
                $data['cate_name'] = $cate['cate_name'];
            }
        }

        if(!$cate_exists){
            show_404();
        }
		
		
		$filter = $this->filter_product($cate_id);
		$data['filter'] = $filter;
		
		//get max range price
		$data['max_price'] = $this->get_max_price();
		
		//if have sub-menu, show all products of sub-menu items
		$data_children = array();
		foreach($this->store_children as $key=>$value){
			if($key == $cate_id){
				$data_children = $value;
				$data_children[] = $cate_id;
			}
		}
		if(count($data_children) == 0)
			$data_children[0] = $cate_id;

        $current_page = $this->uri->segment(5);

        if(!$current_page){
            $current_page = 1;
        }

        if(!is_numeric($current_page) || intval($current_page) <= 0){
            show_404();
        }

        // pagination
        $config['base_url']         = base_url() . 'default/home/cate/' . $cate_id;
        $config['uri_segment']      = 5;
        $config['per_page']         = $this->config_model->getNumberPage()['config_page'];


        $config['total_rows'] = count($this->product_model->get_all_products($filter,$data_children));
		
		$max_page = ceil($config['total_rows'] / $config['per_page']);
		if($config['total_rows'] == 0){
			$max_page = 1;
		}
        if($current_page > $max_page){
            show_404();
        }

        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();

        // get products infomation
        $offset = ($current_page - 1) * $config['per_page'];

		// $data['products'] = $this->product_model->product_by_cate_limit($cate_id, $config['per_page'], $offset);
		$data['products'] = $this->product_model->product_filter($config['per_page'], $offset, $sort['name'], $sort['order'],$filter,$data_children);


		$this->load->view("templates/header", $data);
		$this->load->view("home/list", $data);
		$this->load->view("templates/footer", $data);
        
         if($this->input->post('addCart')){
            $this->add_cart();
        }
    }

	// toannt2
	public function detail(){

		$data = array();

		$data = $this->mega_menu();

		$data['title'] = "Homepage";
		$data['type_page'] = "detail";

        $pro_id = $this->uri->segment(4);

        //Check url
        if(!is_numeric($pro_id) || intval($pro_id) <= 0){
                show_404();
        }   
    
        if(!$this->product_model->check_product_exist($pro_id)){
            show_404();
        }

        $feedback_page = $this->uri->segment(5);

        if(!$feedback_page || !is_numeric($feedback_page) || intval($feedback_page) <= 0){
            $feedback_page = 1;
        }

        //End check url

        //Check validate comment                
        if($this->input->post("btnFeedback")){

            $this->form_validation->set_rules("name","name ","trim|required");
            $this->form_validation->set_rules("email","mail ","trim|required|valid_email");
            $this->form_validation->set_rules("content","review","trim|required");

            $this->form_validation->set_message("required","Please enter your %s");
            $this->form_validation->set_message("valid_email","Please enter a valid %s"); 

            $feed_name    = $this->input->post("name");
            $feed_email   = $this->input->post("email");
            $feed_rate    = $this->input->post("rating");
            $feed_content = $this->input->post("content");

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $feed_time = date('Y-m-d H:i:s', time());

            if($this->form_validation->run()){
                $this->feedback_model->insert($feed_name, $feed_email, $feed_content, $feed_rate, $feed_time, $pro_id);
                $data['just_feedback'] = true;
            } else{
                $data['name']    = $feed_name;
                $data['email']   = $feed_email;
                $data['rating']  = $feed_rate;
                $data['content'] = $feed_content;
            }
        }

        $data['product'] = $this->product_model->get_product_detail($pro_id);


        $data['alt_images'] = $this->image_model->get_alt_images($pro_id);

        //feedbacks

		$config['base_url']    = base_url() . 'default/home/detail/' . $pro_id;
		$config['uri_segment'] = 5;
		$config['per_page']    = 5;

		$offset = ($feedback_page - 1) * $config['per_page'];
        $config['total_rows'] = $this->feedback_model->count_feedback_by_pro_id($pro_id);

        if($feedback_page > ceil($config['total_rows'] / $config['per_page'])){
            $feedback_page = 1;
        }

        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();

        $data['feedbacks'] = $this->feedback_model->get_feedback_by_pro_id($pro_id, $config['per_page'], $offset);

        $avg_rate = $this->feedback_model->avg_rate($pro_id);

        $data['num_of_feedback'] = $avg_rate['count'];
        $data['avg_rate'] = $avg_rate['avg'];        


		$this->load->view("templates/header", $data);
		$this->load->view("home/detail", $data);
		$this->load->view("templates/footer", $data);
		
		
		if($this->input->post('addCart')){
            $flag = true;
            $id = $pro_id;
		    $this->cart->insert($data);
        
            foreach($this->cart->contents() as $item){
                if($id == $item['id']){
                    $item['qty'] +=1;
                    $this->cart->update($item);
                    $flag = false;
                    break;
                }
            }
        if($flag){
		    $data1 = array(
            'id' => $data['product']['pro_id'],
            'name' => $data['product']['pro_name'],
            'qty' => $this->input->post('qty'),
            'price' => $data['product']['pro_sale_price'],
            'options'=> array("pro_image" =>$data['product']['pro_image'])
            );
			$this->cart->insert($data1);
		}   
         redirect(base_url("default/home/"),"refresh");
        }

	} // end function detail

	// 
    public function add_cart(){
        if($this->input->post('addCart')){
            $flag = true;
            $data = array();
            $id = $this->input->post('pro_id');
            //check if product is added
            foreach($this->cart->contents() as $item){
                if($id == $item['id']){
                    $item['qty'] +=1;
                    $this->cart->update($item);
                    $flag = false;
                    break;
                }
            }
         if($flag){
            $data = array(
            'id' => $this->input->post('pro_id'),
            'name' => $this->input->post('pro_name'),
            'qty' => $this->input->post('qty'),
            'price' => $this->input->post('pro_price'),
            'options'=> array("pro_image" =>$this->input->post('pro_image'))
            );
            $this->cart->insert($data);
         }   
         redirect(base_url("default/home/"),"refresh");
          
        }
    }
	public function cart(){

		$data = array();
        $data = $this->mega_menu();
		$data['title'] = "Homepage";
		$data['type_page'] = "cart";
        $data['products'] = $this->cart->contents();

        if($this->input->post('update-cart')){

            $data1 = $this->input->post('quantity');
            $number_member = count($data1);
            for($i = 0; $i < $number_member; $i++){
                $stt = 0;
                foreach($data['products'] as $key=>$value){
                  if($stt == $i){
                    $data['products'][$key]['qty'] = $data1[$i];
                    $rowid = $data['products'][$key];
                    $rowid['qty'] = $data1[$i];
                    $update['rowid'] = $key;
                    $update['qty'] = $data1[$i];

                    $this->cart->update($update);
                    break;
                  }
                $stt++;
                }
            }
            redirect(base_url("default/home/cart"),"refresh"); 
        }
        

		$this->load->view("templates/header", $data);
		$this->load->view("home/cart", $data);
		$this->load->view("templates/footer", $data);

	} // end function cart
    
    //delete cart
    public function delete(){
        $id = $this->uri->segment(4);
        $data = $this->cart->contents();
        foreach($data as $item){
            if($item['id'] == $id){
                $item['qty'] = 0;
                $delOne = array("rowid"=>$item['rowid'], "qty"=>$item['qty']);
            }
        }
        if($this->cart->update($delOne));
        redirect(base_url("default/home/cart"),"refresh");
    }
    public function deleteall(){
        $this->cart->destroy();
        unset($data);
        redirect(base_url("default/home/index"),"refresh");
    }
	// 
	public function checkout(){

		$data = array();
        $data = $this->mega_menu();
		$data['title'] = "Homepage";
		$data['type_page'] = "checkout";
        $data['products'] = $this->cart->contents();
        if($this->input->post("checkout")){
            $this->form_validation->set_rules("name","The Name","trim|required");
            $this->form_validation->set_rules("email","Email","trim|required|valid_email");
            $this->form_validation->set_rules("phone","Phone number","trim|required|numeric|min_length[10]|max_length[11]");
            $this->form_validation->set_rules("address","Address","trim|required");
            
            $this->form_validation->set_message("required","%s is required");
            $this->form_validation->set_message("valid_email","%s must true type email");
            $this->form_validation->set_message("numeric","%s must be an numeric");
            $this->form_validation->set_message("min_length[10]","%s must be at least 10");
            $this->form_validation->set_message("max_length[11]","%s must be less than 11");
            
            $this->form_validation->set_error_delimiters("<span class='error'>","</span> ");
            
            if($this->form_validation->run()){
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $order_time = date('Y-m-d H:i:s', time());
                $dataCustomer = array(
                    //"order_id"=>"",
                    "order_time"=>$order_time,
                    "order_name"=>$this->input->post("name"),
                    "order_email"=>$this->input->post("email"),
                    "order_phone"=>$this->input->post("phone"),
                    "order_address"=>$this->input->post("address")
                );
                $order_id = $this->product_model->insertOrder($dataCustomer);
            //insert and get order id had inserted
            
            $dataAllDetail = $data['products'];
            foreach($dataAllDetail as $detail){
                $dataDetail = array(
                    "order_id" => $order_id,
                    "pro_id" => $detail["id"],
                    "quantity" => $detail["qty"],
                    "pro_name" => $detail["name"],
                    "pro_price" => $detail["price"]
                );
                $this->product_model->insertOrderDetail($dataDetail);
            }
                      $this->cart->destroy();
       
            }
               
        }        
		$this->load->view("templates/header", $data);
        if($this->input->post("checkout") && $this->form_validation->run()){
		  $this->load->view("home/checkoutsucess");

        }else{
            $this->load->view("home/checkout", $data);
          
        }
        
		$this->load->view("templates/footer", $data);

	} // end function checkout
	
	//hungtp: check filter product, will reset filter options if in another page
	public function filter_check($cate_id){
		
		$filter = array();
		if($this->session->userdata('checkFilter') != null){
			if($this->session->userdata('checkFilter') != $cate_id){
				$this->session->set_userdata('checkFilter',$cate_id);//assign new check var
				$this->session->set_userdata('filter',$filter);//reset filter
			}
		}else{
			$this->session->set_userdata('checkFilter',$cate_id);//assign new check var
			$this->session->set_userdata('filter',$filter);//reset filter
		}
		return $filter;
	}
	
	
	//hungtp: filter product
	public function filter_product($cate_id){
		
		$filter = $this->filter_check($cate_id);
		if(isset($_POST['price_range'])){
			$filter['category'] = $this->input->post('category');
			$filter['brands'] = $this->input->post('brands');
			$price_range = $this->input->post('price_range');
			//separate values of price_range
			$filter['price_range'] = explode(",",$price_range);
			$this->session->set_userdata('filter',$filter);
			
		}else{
			if($this->session->userdata('filter') != null){
				$filter = $this->session->userdata('filter');
			}
		}
		
		return $filter;
	}
	
	//hungtp: sort product 
	public function sort_product(){
			$sort = array();
			$sort['name'] = 'Name';
			$sort['order'] = 'ASC';
		if(isset($_POST['get_sort'])){
			$sort['name'] = $this->input->post('get_sort');
			$sort['order'] = $this->input->post('get_order');
			
			//save to session for use with pagination
			$this->session->set_userdata('get_sort',$sort['name']);
			$this->session->set_userdata('get_order',$sort['order']);
		}else{
			//echo $this->session->userdata('get_sort');
			// echo $this->session->userdata('get_order');exit();
		
			//assign to session for display at front end and through pages
			if($this->session->userdata('get_sort') != null){
				$sort['name'] = $this->session->userdata('get_sort');
				$sort['order'] = $this->session->userdata('get_order');
			}else{
				$this->session->set_userdata('get_sort',$sort['name']);
				$this->session->set_userdata('get_order',$sort['order']);
			}
		}
		return $sort;
	}

	//START hungtp: get treeview for list category
	//get children data
	public function treeChildren($id)
    {
        $children = $this->category_model->get_cates_list($id);;
        if (count($children) > 0)
        {
            $result = array();
            foreach($children as $child)
            {
                array_push($result, array('id'=>$child['cate_id'], 'text' => $child['cate_name'],'parent' => $child['cate_parent'], 'children' => $this->treeChildren($child['cate_id'])));
            }
            return $result;
        }
        return null;
    }

	//get treeview data
    public function treeData()
    {
        $root = $this->category_model->get_cates_list(0);
        if (count($root) > 0)
        {
            $result = array();
            foreach($root as $item)
            {
                array_push($result, array('id'=> $item['cate_id'], 'text'=> $item['cate_name'],'parent' => $item['cate_parent'], 'children'=>$this->treeChildren($item['cate_id'])));
            }
            return $result;
        }
        return null;
    }
	
	//get html form for treeview
	public function saveDataAsHtml($data,$type)
    {
        $html='';
        if(is_array($data))
        {
            foreach($data as $node)
            {
                if(!isset($node['text']))
                    continue;

                if(isset($node['expanded']))
                    $css=$node['expanded'] ? 'open' : 'closed';
                else
                    $css='';

                if(isset($node['hasChildren']) && $node['hasChildren'])
                {
                    if($css!=='')
                        $css.=' ';
                    $css.='hasChildren';
                }

                $options=isset($node['htmlOptions']) ? $node['htmlOptions'] : array();
                if($css!=='')
                {
                    if(isset($options['class']))
                        $options['class'].=' '.$css;
                    else
                        $options['class']=$css;
                }

                if(isset($node['id']))
                    $options['id']=$node['id'];
					
					/* -----------------------CUSTOM HERE-------------------- */
				$data_children = array();
				foreach($this->store_children as $key=>$value){
					if($key == $node['id']){
						$data_children = $value;
						$data_children[] = $node['id'];
					}
				}
				if(count($data_children) == 0)
					$data_children[0] = $node['id'];
					
					//print_r($data_children);exit();
				$quantity = $this->product_model->count_product_menu($data_children);
				
				if($type == 0){//filter section
					$toggle = '';
					$link = '';
					$icon = '';
					if($node['parent'] == 0){
						$parent = 'accordian';
					}else{
						$parent = 'smart'.$node['id'];
					}
					if(!empty($node['children'])){
						$toggle = 'data-toggle="collapse" data-parent="#'.$parent.'"';
						$link = $node['text'];
						$icon = '<i class="fa fa-chevron-down"></i>';
					}
					$html.='<div class="panel panel-default">
							<div class="panel-heading">
								<input class="pull-left" type="checkbox" name="" value="" style="margin-right:10px"/> <h4 class="panel-title"><a '.$toggle.' href="#smart'.$node['id'].'">
								<span class="badge pull-right">'.$icon.'</span>'.$node['text'].
								'
							</a></h4>
							</div>
						</div>';
					if(!empty($node['children']))
					{
						$html.='<div id="smart'.$node['id'].'" class="panel-collapse collapse">
						<div class="panel-body">';
						$html.=self::saveDataAsHtml($node['children'],0);
						$html.='
						</div>
					</div>';
					}
				}else{//mega menu
				
				
					if($node['parent'] != 0){
						$style = 'id="my-menu"';
					}else{
						$style = '';
					}
					
					$more='';
					$end_more='';
					$icon = '';
					$link_li = '';
					
					if(!empty($node['children'])){
						$link_li = 'class="dropdown" id="level-down"';
						$icon = '<i class="fa fa-angle-down"></i>';
						$more = '<ul class="nav navbar-nav collapse navbar-collapse">';
						$end_more = '</ul>';
					}
					
					$html.=$more.'<li '.$link_li.'><a href="'.base_url().'default/home/cate/'.$node['id'].'">'.$node['text'].'('.$quantity.')'.$icon.'</a>';
					
					if(!empty($node['children']))
					{
						
						$html.='<ul role="menu" '.$style.' class="sub-menu">';
						$html.=self::saveDataAsHtml($node['children'],1);
						$html.='</ul>';
					}
					
						$html.='</li>';
						$html.=$end_more;
				}
				
					/* -----------------------END CUSTOM HERE-------------------- */
            }
        }
		
        return $html;
    }
	private $store_children = array();
	//get all children of specific parent
	private function get_children($data){
	
		$store = '';
		foreach($data as $value){
			if(!empty($value['children'])){
				$store .= $value['id'].',';
				$store .= $this->get_children($value['children']);
				$this->store_children[$value['id']] = $this->get_children($value['children']);
			}else{
				$store = $value['id'];
			}
		}
		return $store;
	}
	private function get_all_children($data){
		foreach($data as $node){
		
			if(!empty($node['children'])){
				if(!isset($this->store_children[$node['id']])){
					$this->store_children[$node['id']] = $this->get_children($node['children']);
				}
				else{
					$this->store_children[$node['id']] .= $this->get_children($node['children']);
					}
			}
		}
		
		//convert to array format for each value of store_children
		$temp = array();
		foreach($this->store_children as $key=>$value){
			$temp[$key] = explode(',',$value);
		}
		$this->store_children = $temp;
		//echo '<pre>';
		// print_r($this->store_children);exit();
	}
	//END get treeview
	
	private function mega_menu(){
		//hungtp: get tree-view for filter and mega menu
		$data['total_slide'] = $this->slide_model->get_total_slides();
		$data['slide_data'] = $this->slide_model->get_all_data();
		$data['brand_data'] = $this->brand_model->get_all_brands();
		
		$cate_data = $this->category_model->get_all_category();
		
		$lists = $this->treeData();
		//echo '<pre>';
		//print_r($lists);exit();
		$data['count_data'] = count($lists);
		
		$children = $this->get_all_children($lists);
		if($data['count_data'] >0){
			//$data['get_treeview'] = $this->saveDataAsHtml($lists,0);
			$data['get_treeview_menu'] = $this->saveDataAsHtml($lists,1);
		}
		//end get tree-view
		return $data;		
	}

}