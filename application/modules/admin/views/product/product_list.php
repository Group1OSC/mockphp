
	<form action="" method="post">
<table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">

    <thead>
        <tr>
            <th>Featured</th>
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
		if($slides != '' && in_array($product['pro_id'], $slides)){
			$check = 'checked';
		}else{
			$check = '';
		}
            echo "<tr>";
                echo '<td><input type="checkbox" value="'.$product["pro_id"].'" name="slides" id="s'.$product["pro_id"].'" '.$check.' onClick="assignData(this.id)"/></td>';
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
<input type="hidden" name="slide_data" value="<?php echo $slides_data ?>" id="total_slide"/>
<input type="submit" name="upSlide" value="Update" />
<input type="submit" name="clear" value="Deselect All" />
	</form>
<!-- Jquery Data Table JavaScript Library--> <!--acc05 - toannt2-->
<script src="<?php echo base_url(); ?>public/javascript/jquery.dataTables.min.js"></script>

<!-- Bootstrap Data Table JavaScript Library--> <!--acc05 - toannt2-->
<script src="<?php echo base_url(); ?>public/javascript/dataTables.bootstrap.js"></script>

<script>

    function checkDelete() {
    press = confirm("Do you really want to delete this product?")
    if(press == true)
        return true;
    else return false;
    }
	
	function assignData(id){
		total_value = document.getElementById('total_slide').value;
		if(document.getElementById(id).checked){
			if(total_value != ''){
				document.getElementById('total_slide').value+=(","+ document.getElementById(id).value);
			}else{
				document.getElementById('total_slide').value+=document.getElementById(id).value;
			}
		}else{
			array_slide = total_value.split(',');
			
			//remove unchecked item
			position = array_slide.indexOf(document.getElementById(id).value);
			array_slide.splice(position, 1);
			
			new_slide = array_slide.toString();
			
			document.getElementById('total_slide').value = new_slide;
		}
	}
    $(document).ready(function() {
        $('#data-table').dataTable({
            
            "sort" : true,
            "pageLength": <?php echo isset($per_page) ? $per_page : "5"; ?>,            
            "iDisplayLength" : 5,

            "oLanguage": {
                 "sLengthMenu": "Display " + 
                                '<select name="data-table_length" aria-controls="data-table" class="form-control input-sm">' +
                                    "<option value='5'>05</option>" + 
                                    "<option value='10'>10</option>" + 
                                    "<option value='15'>15</option>" + 
                                    "<option value='20'>20</option>" + 
                                    "<option value='50'>50</option>" + 
                                    "<option value='100'>100</option>" + 
                                "</select>" + 
                                " products",
                                
                "sInfo": "Show _START_ to _END_ of total _TOTAL_ products"
               }            

        });

    });
 
</script>