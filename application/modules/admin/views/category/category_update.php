<meta charset="UTF-8" />
<title>Update Categories</title>
<form action="" method="post">
<div class="input-group">
   	<label><b>Category name</b></label>
   	<input type="text" class="form-control " name="cate_name" value="<?php echo $cateInfor['cate_name']; ?>" /> <br />
    <span class="error"><i><?php echo form_error("cate_name"); ?></i></span>
    <br />	
    
    <label><b>Parent Category</b></label>
    <select class="form-control" name="cate_parent">
        <option value="0" > Prarent Category</option>
        
                <?php                    
                      $current_id = array();                                        
                      foreach($cateAll as $key=>$value) {
                          if($value['cate_parent'] == 0) {
                                         
                              echo "<option value='".$value['cate_id']."'> + ". $value['cate_name']."</option>";  
                              $spacing = 5;
                                  
                              if(getChildren($cateAll,$value)){  
                              printChildren($cateAll,$value, $spacing);
                              }
                          }
                      } 
                      
                      function getChildren($cateList, $cate) {
                          $children = array();
                          foreach($cateList as $child) {
                              if($child['cate_parent'] == $cate['cate_id']) {
                                  $children[] = $child;  
                              }
                          }             
                          if(count($children)==0) {
                              return false;
                          } else {
                              return $children;
                          }
                      }
                      
                      function printChildren($cateList, $cate, $spacing) {
                          $children = getChildren($cateList, $cate);
                          for($i=0;$i<count($children) ; $i++) {
                                      $mar=""; 
                                      for ($j = 0 ; $j <= $spacing; $j++) {
                                          $mar.="&nbsp";
                                      }
                                       echo "<option value='".$children[$i]['cate_id']."'>" . $mar . "".$children[$i]['cate_name']."</option>"; 
                                 
                                      if(getChildren($cateList,$children[$i])){
                                          printChildren($cateList,$children[$i], $spacing+5 );
                                      }
                          }
                          
                      }
 
                ?>        
    					
    	</select>
        
 </div> 
        <br/>
        <div><input type="submit" name="update" value="Update" class="btn btn-primary" />&nbsp;
        <input type="submit" name="cancel" value="Cancel" class="btn btn-default" /></div>
        
</form>
