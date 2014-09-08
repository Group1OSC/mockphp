<form class="form-horizontal" role="form" action="" method="post">

   <div class="form-group <?php echo (form_error("brand_name") !== "") ? "has-error" : "" ?>">
      <label for="brand_name" class="col-sm-2 control-label">Brand Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="brand_name" name="brand_name" 
         placeholder="Enter Brand Name" value="<?php echo isset($brand_name) ? $brand_name : '' ?>">
      </div>
      <?php echo form_error("brand_name"); ?>
   </div>

   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <input type="submit" class="btn btn-primary" name="submit" value="<?php echo $button; ?>">
         <input type="submit" class="btn btn-default" name ="btnCancel" value="Cancel"/>
      </div>
   </div>
</form>