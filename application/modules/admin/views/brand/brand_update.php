<style>
    .error{
        color:red;
    }
</style>
<form action="" method="post">
    <label><b>Brand Name</b></label>
    <input type ="text" name ="brand_name" value ="<?php echo $brandInfor['brand_name'];?>" size ="30" />
    <span class = "error"><i><?php echo form_error("brand_name"); ?></i></span>
    <br /><br />
    <div>
    <input type ="submit" name ="update" value="Update" class="btn btn-primary" />&nbsp;
    <input type ="submit" name ="cancel" value="Cancel" class="btn btn-default" />
    </div>
</form>
