<form class="form-horizontal" role="form" action="" method="post">

    <div class="form-group">    
        <label for="txtID" class="col-sm-2 control-label">Product ID: </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="txtID" id="txtID" value="<?php echo $this->session->userdata("srch_id") ? $this->session->userdata("srch_id") : "" ?>" />
        </div>
    </div>

    <div class="form-group">    
        <label for="txtName" class="col-sm-2 control-label">Product name: </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="txtName" id="txtName" value="<?php echo $this->session->userdata("srch_name") ? $this->session->userdata("srch_name") : "" ?>" />
        </div>
    </div>

    <div class="form-group">
        <label for="txtBrand" class="col-sm-2 control-label">Brand name: </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="txtBrand" id="txtBrand" value="<?php echo $this->session->userdata("srch_brand") ? $this->session->userdata("srch_brand") : "" ?>" />
        </div>
    </div>

    <div class="form-group">
        <label for="txtCountry" class="col-sm-2 control-label">Country name: </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="txtCountry" id="txtCountry" value="<?php echo $this->session->userdata("srch_country") ? $this->session->userdata("srch_country") : "" ?>" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">List price range: </label>
        <div class="col-sm-5">
            <span id="amount"></span>
            <input type="hidden" readonly name="prcMin" id="prcMin">
            <input type="hidden" readonly name="prcMax" id="prcMax">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-5">
            <div id="slider-range" class="form-control"></div>
        </div>
    </div>

    <div class="form-group">
        <label for="chbxStrict" class="col-sm-2 control-label">Strictly Search: </label>
        <div class="col-sm-5">
            <input type="checkbox" name="chbxStrict" id="chbxStrict" value="1" <?php echo $this->session->userdata("srch_strict") == 1 ? "checked" : "" ?> />
        </div>
    </div>

   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <input type="submit" class="btn btn-default" name="btnSearch" value="Search">
      </div>
   </div>
          
</form>

<table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>List Price</th>
            <th>Sale Price</th>
            <th>Country</th>
            <th>Brand</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        foreach ($products as $product) {
            echo "<tr>";
                echo "<td>{$product['pro_id']}</td>";
                echo "<td>{$product['pro_name']}</td>";
                echo "<td>{$product['pro_list_price']} USD</td>";
                echo "<td>{$product['pro_sale_price']} USD</td>";
                echo "<td>{$product['pro_country']}</td>";
                echo "<td>{$product['brand_name']}</td>";
                echo '<td><a href="' . base_url(). 'admin/product/update/' . $product['pro_id'] . '">Update</a></td>';
                echo "<td><a href='" . base_url(). 'admin/product/delete/' . $product['pro_id'] . "' onclick='if(checkDelete() == false) return false' />Delete</a></td>";
            echo "</tr>";
        }
    ?>
    </tbody>
</table>

<div class="pagination">
<?php echo $pages; ?>        
</div>

<script>

    function checkDelete() {
    press = confirm("Do you really want to delete this product?")
    if(press == true)
        return true;
    else return false;
    }

    $(document).ready(function() {

        $("#slider-range").slider({
            range: true,
            min: 0,
            max: <?php echo isset($max_price) ? $max_price : "2000"?>,
            step: 1,
            //values: [0, 9000000],
            values: [<?php echo $this->session->userdata("srch_prcMin") ? $this->session->userdata("srch_prcMin") : "0" ?>, 
                     <?php echo $this->session->userdata("srch_prcMax") ? $this->session->userdata("srch_prcMax") : "2000" ?>],
            slide: function(event, ui) {
                console.log(ui.values[0]);
                console.log(ui.values[1]);
                $("#amount").html(ui.values[0] + " USD - " + ui.values[1] + " USD");
                $("#prcMin").val(ui.values[0]);
                $("#prcMax").val(ui.values[1]);
            }
            
        });


        $("#amount").html( $("#slider-range").slider("values", 0) + " USD - " + $('#slider-range').slider("values", 1) + " USD");
        $("#prcMin").val($("#slider-range").slider("values", 0));
        $("#prcMax").val($("#slider-range").slider("values", 1));        

    });
 
</script>