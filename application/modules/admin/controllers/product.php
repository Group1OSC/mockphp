<?php
class Product extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library("form_validation");
        $this->load->model("config_model");
		$this->load->helper('url');
		$this->load->model("product_model");
		$this->load->model("category_model");
		$this->load->model("brand_model");
		$this->load->model("slide_model");
        $this->load->library("upload");
	}

	// acc1 - huanvm
	public function index(){

		$data = array();
		//hungtp: START select & insert slide items
		if(isset($_POST['upSlide'])){
			/* print_r($_POST['slides']);
			exit(); */
			$slides = $this->input->post('slide_data');
			$slides = explode(',',$slides);
			$slide_datas = array();
			
			$this->slide_model->delete_all();//removee all current records
			foreach($slides as $key=>$value){
				$slide_datas['slide_order'] = $key+1;
				$slide_datas['pro_id'] = $value;
				$this->slide_model->insert($slide_datas);	
			}
		}
		if(isset($_POST['clear'])){
			$this->slide_model->delete_all();//removee all current records
		}
		
		$data['slides_data'] ='';
		$get_slides = $this->slide_model->select_all();	
		if(!empty($get_slides)){
			foreach($get_slides as $key=>$value){
				$array_get_slides[$key] = $value['pro_id'];
				if($key != 0)
					$data['slides_data'] .= (','.$value['pro_id']);
				else
					$data['slides_data'] .= $value['pro_id'];
			}
			$data['slides'] = $array_get_slides;
		}else{
			$data['slides'] = '';
		}
		//hungtp: END select slide items

		$data['title'] = "List Products";
            
		$data['products'] = $this->product_model->get_all_joined_products();
        //luanvd: get number per page
        $getpage = $this->config_model->getNumberPage();
        $data['per_page'] = $getpage['config_page'];
        
		$this->load->view("templates/header", $data);
		$this->load->view("product/product_list", $data);
		$this->load->view("templates/footer", $data);

	}  //end function index

	// acc5 - toannt2
	public function search(){

		$data = array();

		$data['title'] = "Search Products";

		$page_number = $this->uri->segment(4);

		if(!$page_number || $page_number <= 0) {
			$page_number = 1;
		}
        $getpage = $this->config_model->getNumberPage();

		$config['base_url']         = base_url() . 'admin/product/search/';
		$config['use_page_numbers'] = TRUE;
		$config['uri_segment']      = 4;
		$config['per_page']         = $getpage['config_page']; 
		$config['prev_link']        = 'Prev';
		$config['next_link']        = 'Next';


		//$data['page_number'] = $page_number;

		if($this->input->post('btnSearch')){
			$this->session->set_userdata("srch_id", $this->input->post("txtID"));
			$this->session->set_userdata("srch_name", $this->input->post("txtName"));
			$this->session->set_userdata("srch_brand", $this->input->post("txtBrand"));
			$this->session->set_userdata("srch_country", $this->input->post("txtCountry"));
			$this->session->set_userdata("srch_prcMin", $this->input->post("prcMin"));
			$this->session->set_userdata("srch_prcMax", $this->input->post("prcMax"));
			$this->session->set_userdata("srch_strict", $this->input->post("chbxStrict"));
			if($page_number !== 1){
				redirect(base_url() . "admin/product/search/1");
			}
		}

		$offset = ($page_number - 1) * $config['per_page'];

		$id      = $this->session->userdata("srch_id"); 
		$name    = $this->session->userdata("srch_name"); 
		$brand   = $this->session->userdata("srch_brand");
		$country = $this->session->userdata("srch_country");
		$prcMin  = $this->session->userdata("srch_prcMin");
		$prcMax  = $this->session->userdata("srch_prcMax");
		$strict  = $this->session->userdata("srch_strict");

		if(isset($id) && isset($name) && isset($brand) && isset($country) && isset($prcMin) && isset($prcMax)) {
			if($prcMin == "") {
				$prcMin = 0;
			}

			if($prcMax == "") {
				$prcMax = 2000;
			}				

			$all_products = $this->product_model->get_all_products();
			$list_price = array();
			foreach ($all_products as $product) {
				$list_price[] = $product['pro_list_price'];
			}

			if(count($list_price) > 0 ){
				$data['max_price'] = max($list_price);
			}

			if((int)$strict == 1){
				$count_search_result = $this->product_model->count_search_all('where', $id, $name, $brand, $country, $prcMin, $prcMax);
				$data['products'] = $this->product_model->search_limit('where', $id, $name, $brand, $country, $prcMin, $prcMax, $offset, $config['per_page']);

			} else{
				$count_search_result = $this->product_model->count_search_all('like', $id, $name, $brand, $country, $prcMin, $prcMax);
				$data['products'] = $this->product_model->search_limit('like', $id, $name, $brand, $country, $prcMin, $prcMax, $offset, $config['per_page']);
			}

			$config['total_rows'] = $count_search_result;
		}
		
		$this->pagination->initialize($config);

		$data['pages'] = $this->pagination->create_links();

		$this->load->view("templates/header", $data);
		$this->load->view("product/product_search", $data);
		$this->load->view("templates/footer", $data);

	}  //end function search

	// acc3 - hungtp(kiennb)
	public function insert(){
		
		$data = array();

		$data['title'] = "Insert Products";
		$data['msg'] = "";
		$data['cate_error'] = '';
		$link_dir = './public/images/products/';
		//check if data was submited
		if(isset($_POST["submit"])){
			
			
			//valid data
			$this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_dash|is_unique[tbl_product.pro_name]|xss_clean');
			$this->form_validation->set_rules('country', 'Country', 'trim|alpha|xss_clean');
			$this->form_validation->set_rules('list_price', 'Price', 'trim|required|numeric');
			$this->form_validation->set_rules('sale_price', 'Sale price', 'trim|required|numeric');
			$this->form_validation->set_rules('desc', 'Description', 'trim|xss_clean|prep_for_form');
			$this->form_validation->set_rules('brand', 'Brand', '');
			$this->form_validation->set_rules('category[]', 'Category', 'callback_check_cate');
			if(empty($_FILES['main_img']['name'])){
				$this->form_validation->set_rules('main_img', 'Main image', 'required');
			}
			if(count($_FILES['alt_img']['name']) > 10){
				$this->form_validation->set_rules('alt_img[]', 'Alternative image', 'callback_check_alt_img');
			}
			//custom error message
			$this->form_validation->set_message('is_unique', 'This %s has existed.');
			
			$check =0;
			
			$cate 		= $this->input->post("category");
			$data['cate_datas'] = $cate;
			
			if ($this->form_validation->run() != FALSE){//valid data successfully
				
					//create directory if not exist
					if(!is_dir($link_dir.'temp/')){
						mkdir($link_dir.'temp/',0755,TRUE);
					}
					//handle upload image
					$config['upload_path'] = $link_dir.'temp/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '500';
					$config['max_width']  = '1024';
					$config['max_height']  = '768';
					
					$this->load->library('upload');
					$this->upload->initialize($config);//important, start uploading image library
					
					$field = 'main_img';
					$field2 = 'alt_img';

					if ( ! $this->upload->do_upload($field))
					{
						$error_img['main_img'] = $this->upload->display_errors();
						//$data['img_data'] = $error_img['main_img'];
					}
					else
					{
						$img_data['main'] = $this->upload->data();
					}

					if ( ! $this->upload->do_multi_upload($field2))
					{
						$error_img['alt_img'] = $this->upload->display_errors();
					}
					else
					{
						$img_data['alt'] = $this->upload->get_multi_upload_data();
						//$data['img_data'] = $img_data['alt'];
					}
					$check = 1;
				
			}
			if ($check == 1){//valid data successfully
				
				$name 		= $this->input->post("name");
				$country 	= $this->input->post("country");
				$list_price = $this->input->post("list_price");
				$sale_price = $this->input->post("sale_price");
				$desc		= $this->input->post("desc");
				$brand 		= $this->input->post("brand");
				
				
				//insert all data into an array
				$data['pro_data'] = array(
					'pro_name'=>$name,
					'pro_country'=>$country,
					'pro_list_price'=>$list_price,
					'pro_sale_price'=>$sale_price,
					'pro_desc'=>$desc,
					'pro_brand'=>$brand,
				);
				
				//insert into database
				$this->product_model->insert($data['pro_data']);
				
				$lastest = $this->product_model->get_max_id();
				
				rename($link_dir.'temp/',$link_dir.$lastest['pro_id'].'/');//change name of image folder for this product
				
				$image 		= 'public/images/products/'.$lastest['pro_id'].'/'.$img_data['main']['client_name'];
				
				$data['new_data'] = array(
					'pro_link'=>$image,
				);
				$this->product_model->update($lastest['pro_id'],$data['new_data']);//update new image link in db
				
				//insert category
				foreach($cate as $value){
					$cate_data = array(
						'pro_id'=>$lastest['pro_id'],
						'cate_id'=>$value,
					);
					$this->product_model->insert_custom('tbl_pro_cate',$cate_data);
				}
				
				if(!empty($img_data['alt'])){
					foreach($img_data['alt'] as $img){//insert alt images
						$image = 'public/images/products/'.$lastest['pro_id'].'/'.$img['client_name'];
					
						$img_data = array(
							'img_link'=>$image,
							'pro_id'=>$lastest['pro_id'],
						);
						$this->product_model->insert_custom('tbl_image',$img_data);
					}
				}
				
				$data['msg'] = 'Inserted successfully';
			}
		
		}
		
		
		$data['cates'] = $this->category_model->get_all_category();
		$data['brands'] = $this->brand_model->get_all_brands();
		
		$this->load->view("templates/header", $data);
		$this->load->view("product/product_insert", $data);
		$this->load->view("templates/footer", $data);

	}  //end function insert

	// acc4 - luanvd	
	public function update(){

		$data = array();

		$data['title'] = "Update Products";
        	$id = $this->uri->segment(4);    
        	$data['inforProduct'] = $this->product_model->getInforUpdate($id);
        	$data['listCategory'] = $this->category_model->get_all_category();
        	$data['brand'] = $this->brand_model->getAll();
        
        //get cate_id from tbl_pro_cate where pro_id = $id(updating)   
        $getSomeCateId[] = $this->product_model->getCateId($id);
        
        $tmp = array();
       	for($i=0; $i < count($getSomeCateId); $i++){
	        foreach($getSomeCateId[$i] as $value){
               $tmp[]=$value['cate_id'];
            }
        }
        
        $data['listCateId'] = $tmp;
        //get all infor image from tbl_image       
        $data['image']= $this->product_model->getImages($id);
        //$data['listThumb']
       	$data['listThumb']= $this->product_model->getImagesThumb($id);
        /*
         *Up load image thumbs;   
         */
      	$upload_url = "public/images/products/".$id."/";
		$config['upload_path'] = $upload_url;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '50000';
		
		$this->upload->initialize($config);
	
        /*
         * End config
         */    
 
 
        if($this->input->post('update')){
            $this->form_validation->set_rules("pro_name","The Product Name","trim|required");
            $this->form_validation->set_rules("pro_list_price","The List Price","trim|required|numeric");
            $this->form_validation->set_rules("pro_sale_price","The Sale Price","trim|numeric");
            
            $this->form_validation->set_message("required","%s is required");
            $this->form_validation->set_message("numeric","%s must is a numeric");
            $this->form_validation->set_error_delimiters("<span class='error' >","</span>");
            
            //get all post category data
            //$dataUpdate= array();
            $dataCategory = $this->input->post("category");
            if($this->form_validation->run()){
                //update main image
                
                if($this->uploadMainImage()){
                    //delete file old Main Image on server
                    $old_link_image ="./".$data['inforProduct']['pro_image'];
                    unlink($old_link_image);
                    $dataUpdate['img_id'] = $this->uploadMainImage();
                    $imagelink = $this->uploadMainImage();
                }
                else{
                    $dataUpdate['img_id'] = $data['inforProduct']['pro_image'];
                    $imagelink = $data['inforProduct']['pro_image'];
                }
                /*data update in tbl_product
                */
                $dataPro = array(
                    "pro_name"=>$this->input->post('pro_name'),
                    "pro_list_price"=>$this->input->post('pro_list_price'),
                    "pro_sale_price"=>$this->input->post('pro_sale_price'),
                    "pro_desc"=>$this->input->post('pro_desc'),
                    "pro_image"=>$dataUpdate['img_id'],
                    "pro_country"=>$this->input->post('pro_country'),
                    "pro_brand"=>$this->input->post('brand_id'),
                );
                /*
                 * Thumb insert
                 */
                 /*
                $data['insert'] = array (
                       "pro_images" => $this->input->post ("thumb"),
				);
                */
                $less_than = 10-count($data['listThumb']);  
                if($_FILES['thumb']['name']['0'] !=""){
                    if(count($_FILES['thumb']['name'])>$less_than){
                        $errorUpload = "The number of file is more than accept!";                    
                    }else{
                        $errorUpload = "";
               	        foreach($_FILES['thumb'] as $key=>$val){
					       $i = 1;
					       foreach($val as $v){
						      $field_name = "file_".$i;
						      $_FILES[$field_name][$key] = $v;
						      $i++;
					       }
				        }
                        unset($_FILES['thumb']);
				        $error = array();
				        $success = array();
				
				        foreach($_FILES as $field_name => $file){
				        	if(!$this->upload->do_upload($field_name)){
						          $error[] = $this->upload->display_errors();
		                    }else{
						          $success[] = $this->upload->data();
						          $temp_image[] = $upload_url.$file['name'];
                             }
				        }
                        
				        if(!empty($temp_image)) {
					       foreach ($temp_image as $t){
						      $data['img_id'][] = array(
							     "pro_id" => $id,
							     "img_link" => $t,
							     "img_status" => 0
						      );
					       }//end foreach
                        }//end if   
               		$this->product_model->insert_pro_image($data['img_id']);
                }//end else    
	          }//end if has thum image uploaded
                /*
                 *End thumb insert
                 */
                
                //update All Infor in tbl_product
                $this->product_model->update($dataPro,$id);
                //update Infor in tbl_image;
                $this->product_model->updateMainImage($imagelink,$id);
                
                //delete some row of table(tbl_pro_cate) where has pro_id = $id 
                //Then insert new data because a Product can belong to some category
                $this->product_model->deleteCate($id);
                foreach($dataCategory as $value){
                    $this->product_model->insertCate($value, $id);
                }
                
                redirect(base_url("admin/product/update/".$id),'refresh');
            }//end if validation->run
        }
		$this->load->view("templates/header", $data);
		$this->load->view("product/product_update", $data);
		$this->load->view("templates/footer", $data);
        
        
        if($this->input->post("cancel")){
            redirect(base_url("admin/product/"),'refresh');
        }

        
	}//end function update
    	public function uploadMainImage(){
        	$id = $this->uri->segment(4);
       
		    $fileName ="";
        	$fileInfo = $_FILES['images'];
        	if($fileInfo['name'] != null){
                $fileName = $fileInfo['name'];
                //move to "public/images/products/$id"
                move_uploaded_file($fileInfo['tmp_name'],"public/images/products/".$id."/".$fileName);
                $fileName = "public/images/products/".$id."/".$fileInfo['name'];
       }
        return $fileName;
       }
    	public function deleteThumb(){
		$id = $this->uri->segment(4);
        	$data = array();
        	$data['OneThumb'] = $this->product_model->getThumbImage($id);
        	$link="./".$data['OneThumb']['img_link'];
        	unlink($link);
        	$this->product_model->delete_one_thumb($id);
        	$pro_id = $this->uri->segment(5);
        	redirect(base_url("admin/product/update/".$pro_id),'refresh');	   
	    }  //end function delete
        
        public function setMainImage(){
            $id = $this->uri->segment(4);
            $pro_id = $this->uri->segment(5);
            $data = array();
            $data['old_main_image'] = $this->product_model->getMainImage($pro_id);
            $data['old_thumb_image'] = $this->product_model->getThumbImage($id);
            
            $this->product_model->updateMainImageProduct($data['old_thumb_image']['img_link'],$pro_id);
            $this->product_model->updateStatusThumb($data['old_main_image']['pro_image'],$pro_id);
            $this->product_model->updateStatusMainImage($data['old_thumb_image']['img_link'],$pro_id);

         /*
            echo "<pre>";
            echo print_r($data['old_main_image']);
            echo print_r($data['old_thumb_image']);
            die();
         */   
             	redirect(base_url("admin/product/update/".$pro_id),'refresh');	     
            
        }


	// acc2 - hungtp
	public function delete(){
	
		if(is_numeric($id)){
			$get_data = $this->product_model->get_product($id);
			if(!empty($get_data)){
				$this->product_model->delete_product($id);//delete record from db
				$this->product_model->delete_img($id);//delete coresponding imgs record from db
			
				$path_dir = './public/images/products/';
				if(delete_files($path_dir.$id)){//delete all images in folder
					if(rmdir($path_dir.$id))//delete folder
						//echo 'Deleted successfully.';
						$this->session->set_flashdata('message', 'Deleted successfully.');
						redirect(base_url().'admin/product/index/', 'location');
				}
				else{
					//echo 'Cannot delete product infomation completely.';
					$this->session->set_flashdata('message', 'Cannot delete product infomation completely.');
					redirect(base_url().'admin/product/index/', 'location');
				}
			}
			else{
				//echo 'This product does not exist.';
				$this->session->set_flashdata('message', 'This product does not exist.');
				redirect(base_url().'admin/product/index/', 'location');
			}
		}else{
			//echo 'Invalid id product.';
			$this->session->set_flashdata('message', 'Invalid id product.');
			redirect(base_url().'admin/product/index/', 'location');
		}
	}  //end function delete
	
	//hungtp:check category input
	public function check_cate($cate){
		$cates = $this->input->post("category");
		$valid_cate = array_unique($cates);
		/* print_r($cates);exit(); */
		if(count($cates) == count($valid_cate)){
			return TRUE;
		}else{
			$this->form_validation->set_message('check_cate', 'The %s field cannot be duplicated.');
			return FALSE;
		}
	
	}
	
	//hungtp:check alt images input
	public function check_alt_img($img){
			$this->form_validation->set_message('check_alt_img', 'The %s field cannot contain more than 10 images.');
			return FALSE;
	}
}
