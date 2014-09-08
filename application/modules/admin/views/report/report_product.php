<?php 
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $current_date = date('Y/m/d', time());
?>

<form class="form-horizontal" role="form" action="" method="post">

    <div class="form-group">    
        <label for="toDate" class="col-sm-2 control-label">From: </label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control datepicker" name="fromDate" id="fromDate" value="<?php echo $this->session->userdata('fromDate') ? $this->session->userdata('fromDate') : $current_date ?>" />
        </div>
    </div>

    <div class="form-group">    
        <label for="toDate" class="col-sm-2 control-label">To: </label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control datepicker" name="toDate" id="toDate" value="<?php echo $this->session->userdata('toDate') ? $this->session->userdata('toDate') : $current_date ?>" />
        </div>
    </div>

   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <input type="submit" class="btn btn-default" name="btnReport" value="Report">
      </div>
   </div>
          
</form>

<script>
    $(function() {

        $( ".datepicker" ).datepicker({
            dateFormat: "yy/mm/dd"
        });

    });
</script>

<?php 
if(isset($products) && count($products) > 0) {
?>

<!-- result table -->
<table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Order</th>
            <th>ID</th>
            <th>Product Name</th>
            <th>Number of Purchasing</th>
            <th>Quantity</th>
            <th>Sale Price</th>
            <th>List Price</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        foreach ($products as $product) {
            echo "<tr>";
            echo "<td>{$product['order']}</td>";
                echo "<td>{$product['pro_id']}</td>";
                echo "<td>{$product['pro_name']}</td>";
                echo "<td>{$product['count']}</td>";
                echo "<td>{$product['quantity']}</td>";
                echo "<td>{$product['pro_list_price']} USD</td>";
                echo "<td>{$product['pro_sale_price']} USD</td>";
            echo "</tr>";
        }
    ?>
    </tbody>
</table>

<!-- Jquery Data Table JavaScript Library--> <!--acc05 - toannt2-->
<script src="<?php echo base_url(); ?>public/javascript/jquery.dataTables.min.js"></script>

<!-- Bootstrap Data Table JavaScript Library--> <!--acc05 - toannt2-->
<script src="<?php echo base_url(); ?>public/javascript/dataTables.bootstrap.js"></script>

<script>

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

<?php
} else {
    echo "<p class='col-sm-offset-2 col-sm-10'>There is no purchasing in this time range.</p>";
}
?>