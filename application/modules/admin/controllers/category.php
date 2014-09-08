<?php
class Category extends Admin_Controller{

	private $changeTree = array();
	
	public function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');		
		$this->load->helper(array('form','url'));
		$this->load->model("category_model");
		$this->load->library('form_validation');
	}

	// acc2 - hungtp
	public function index(){

		$data = array();

		$data['title'] = "List Categories";
		
		$cate_data = $this->category_model->get_all_category();
		
		$lists = $this->treeData();
		$data['count_data'] = count($lists);
		
		if($data['count_data'] >0)
			$data['get_treeview'] = $this->saveDataAsHtml2($lists,0);
			
		/* echo '<pre>';
		print_r($data['get_treeview']);
		echo '</pre>';exit(); */
		
		$this->load->view("templates/header", $data);
		$this->load->view("category/category_list", $data);
		$this->load->view("templates/footer", $data);

	} // end function index
	
	//hungtp: get treeview for list category
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
	
	public static function saveDataAsHtml($data)
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
				$actionHtml = '<span style="display:inline">
				<a href="'.base_url().'admin/category/update/'.$node['id'].'" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
				<a href="'.base_url().'admin/category/delete/'.$node['id'].'" title="Delete" onCLick="return checkDelete()"><i class="fa fa-fw fa-minus-square"></i></a>
				</span>';

                $html.='<ul><li>'.$node['text'].' '.$actionHtml;
                if(!empty($node['children']))
                {
                    $html.='<ul>';
                    $html.=self::saveDataAsHtml($node['children']);
                    $html.='</ul>';
                }
                $html.='</li></ul>';
            }
        }
		
        return $html;
    }
	
	public static function saveDataAsHtml2($data,$type)
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
					
				$actionHtml = '<span style="display:inline">
				<a href="'.base_url().'admin/category/update/'.$node['id'].'" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
				<a href="'.base_url().'admin/category/delete/'.$node['id'].'" title="Delete" onCLick="return checkDelete()"><i class="fa fa-fw fa-minus-square"></i></a>
				</span>';
				
				if($type == 0)
					$html.='<li class="dd-item" data-id="'.$node['id'].'"><div class="dd-handle">'.$node['text'].$actionHtml.'</div>';
				else
					$html.='<li class="dd-item" data-id="'.$node['id'].'"><div class="dd-handle">'.$node['text'].'</div>';
                if(!empty($node['children']))
                {
                    $html.='<ol class="dd-list">';
                    $html.=self::saveDataAsHtml2($node['children'],$type);
                    $html.='</ol>';
                }
                $html.='</li>';
            }
        }
		
        return $html;
    }
	//hungtp: end get treeview for list category
	
	// acc5 - toannt2
	public function insert(){
		$data = array();

		$data['title'] = "Insert Categories";

		$data['all_cates'] = $this->category_model->get_all_category();

		if($this->input->post("btnInsert")){

			$this->form_validation->set_rules("cate_name","Category name","trim|required|is_unique[tbl_category.cate_name]");
			$this->form_validation->set_message("required","%s is required.");
			$this->form_validation->set_message("is_unique","%s already exists.");
            $this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

			$cate_name   = $this->input->post("cate_name");
			$cate_parent = $this->input->post("cate_parent");

			$data['cate_name']   = $cate_name;
			$data['cate_parent'] = $cate_parent;

			if ($this->form_validation->run()) {

				// cate_level
				if($cate_parent == 0){
					$cate_level = 1;
				} else {
					foreach($data['all_cates'] as $cate){
						if($cate['cate_id'] == $cate_parent){
							$cate_level = $cate['cate_level'] + 1;
							break;
						}
					}
				}

				$sibling_orderby = $this->category_model->get_sibling_orderby($cate_parent, $cate_level);
				if(count($sibling_orderby) == 0){
					$cate_orderby = 1;
				} else {
					$orderby_arr = array();
					foreach($sibling_orderby as $sibling){
						$orderby_arr[] = $sibling['cate_orderby'];
					}
					$cate_orderby = max($orderby_arr) + 1;
				}

				$new_cate = array(
					'cate_name'    => $cate_name,
					'cate_parent'  => $cate_parent,
					'cate_level'   => $cate_level,
					'cate_orderby' => $cate_orderby
				);

				$this->category_model->insert_category($new_cate);
				redirect(base_url("admin/category/"),'refresh');
			}
		}

        if($this->input->post("btnCancel")) {
                redirect(base_url("admin/category/"),'refresh');
        }

		$this->load->view("templates/header", $data);
		$this->load->view("category/category_insert", $data);
		$this->load->view("templates/footer", $data);

	} //end function insert

	// acc4 - luanvd
        public function update(){
        $id = $this->uri->segment(4);
		$data = array();
        $data['cateInfor'] = $this->category_model->detail($id);
        $data['cateAll'] = $this->category_model->get_all_category();
		$data['title'] = "Update Categories";
        
        if($this->input->post('update')){
            
           //$this->form_validation->set_rules("cate_name","The category name","trim|required");
            $this->form_validation->set_rules('cate_name','The category name','trim|required|edit_unique[tbl_category.cate_name.'.$id.']');
                                                                                            
            $this->form_validation->set_message("required","%s is required");
            $this->form_validation->set_message('edit_unique',"%s has been exist");
            $this->form_validation->set_error_delimiters("<span class = 'error'>","</span>");
            
            $name = $this->input->post("cate_name");
            if($this->form_validation->run()){
                $listall = $this->category_model->get_all_category();
                foreach($listall as $row){
                    if(in_array(trim($name),$row) && $row['cate_id'] !=$id) $data['errorName'] = "The Name has been exist";
                }
                if(!isset($data['errorName'])){
                    $dataCate = array(
                        "cate_name"=>$this->input->post("cate_name"),
                        "cate_parent"=>$this->input->post("cate_parent")
                    );
                    $this->category_model->update($dataCate,$id);
                    redirect(base_url("admin/category/"),'refresh');
                }
                
                    
            }
        }//ennif post("update"")
        $data['id'] = $id;
        
		$this->load->view("templates/header", $data);
		$this->load->view("category/category_update", $data);
		$this->load->view("templates/footer", $data);
        
        //cancel update
        if($this->input->post("cancel")){
            Redirect(base_url("admin/category/"),'refresh');
        }

	} //end function update


	// acc1 - hungtp(huanvm)
	public function move(){
		$data = array();

		$data['title'] = "Move Categories";
		
		
		$cate_data = $this->category_model->get_all_category();
		
		$lists = $this->treeData();
		$data['count_data'] = count($lists);
		
		if($data['count_data'] >0)
			$data['get_treeview'] = $this->saveDataAsHtml2($lists,1);
		$this->load->view("templates/header", $data);
		$this->load->view("category/category_move", $data);
		$this->load->view("templates/footer", $data);

	}
	
	//hungtp:get data from move view and update db
	public function data(){
		$get_data = json_decode($_GET['data']);
		//print_r($get_data);exit();
		foreach($get_data as $key=>$value){
			array_push($this->changeTree, array('id'=> $value->id,'parent' => 0,'position' => ($key+1)));
			if(isset($value->children))
				$this->getNewTree($value->children,$value->id);
		}
		
		//update db
		foreach($this->changeTree as $value){
			$data = array(
				'cate_parent'=>$value['parent'],
				'cate_orderby'=>$value['position'],
			);
			$this->category_model->update_cate($value['id'],$data);
		}
	}
	public function getNewTree($data,$parent){
		foreach($data as $key=>$value){
			array_push($this->changeTree, array('id'=> $value->id,'parent' =>$parent,'position' => ($key+1)));
			if(isset($value->children)){
				$this->getNewTree($value->children,$value->id);
			}
		}
	}

	// acc3 - hungtp(kiennb)
	public function delete($id){
		$this->category_model->delete_category($id);

		redirect('/admin/category/index', 'location');
	} //end function delete	

}
