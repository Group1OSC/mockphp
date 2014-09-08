<form class="form-horizontal" role="form" action="" method="post">

   <div class="form-group <?php echo (form_error("cate_name") !== "") ? "has-error" : "" ?>">
      <label for="cate_name" class="col-sm-2 control-label">Category Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="cate_name" name="cate_name" 
         placeholder="Enter Category Name" value="<?php echo isset($cate_name) ? $cate_name : '' ?>">
      </div>
      <?php echo form_error("cate_name"); ?>
   </div>

   <div class="form-group">
      <label for="cate_parent" class="col-sm-2 control-label">Parent Category</label>
      <div class="col-sm-5">
         <select name="cate_parent" id="cate_parent" class="form-control">
            <option value="0" >Choose parent category</option>

<?php

if(!isset($cate_parent)){
   $cate_parent = -1;
}

$traveled = array();

foreach ($all_cates as $cate) {
   if($cate['cate_parent'] == 0) {

      echo '<option value="' . $cate['cate_id'] . '"';
      if($cate['cate_id'] == $cate_parent){
         echo 'selected="selected"';
      }
      echo ' >' . $cate['cate_name'] . ' </option>';

      global $traveled;
      $traveled[] = $cate['cate_id'];
      $current_id = $cate['cate_id'];

      dequy($current_id, $all_cates, $cate_parent, 1);
   }
}

function dequy($cate_id, $all_cates, $cate_parent, $level){
   global $traveled;
   foreach ($all_cates as $cate) {
      if($cate['cate_parent'] == $cate_id && !in_array($cate['cate_id'], $traveled)) {
         $levelDisplay = "";
         for($i = 0; $i < $level; $i++ ){
            $levelDisplay .= " - - ";
         }

         echo '<option value="' . $cate['cate_id'] . '"';
         if($cate['cate_id'] == $cate_parent){
            echo 'selected="selected"';         
         }
         echo  '>' . $levelDisplay . $cate['cate_name'] . ' </option>';

         $traveled[] = $cate['cate_id'];
         dequy($cate['cate_id'], $all_cates, $cate_parent, $level+1);
      }
   }
}

?>                      
         </select>
      </div>
   </div>
   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <input type="submit" class="btn btn-primary" name="btnInsert" value="Insert">
         <input type="submit" class="btn btn-default" name ="btnCancel" value="Cancel"/>         
      </div>
   </div>
</form>