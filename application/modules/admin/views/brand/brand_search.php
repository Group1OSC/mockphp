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
         <input type="submit" class="btn btn-primary" name="submit" value="Search">
      </div>
   </div>
</form>

<table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        foreach ($brands as $brand) {
            echo "<tr>";
                echo "<td>{$brand['brand_id']}</td>";
                echo "<td>{$brand['brand_name']}</td>";
                echo '<td><a href="' . base_url(). 'admin/brand/update/' . $brand['brand_id'] . '">Update</a></td>';
                echo "<td><a href='" . base_url(). 'admin/brand/delete/' . $brand['brand_id'] . "' onclick='if(checkDelete() == false) return false' />Delete</a></td>";
            echo "</tr>";
        }
    ?>
    </tbody>
</table>

<script>

    function checkDelete() {
    press = confirm("Do you really want to delete this brand?")
    if(press == true)
        return true;
    else return false;
    }

</script>