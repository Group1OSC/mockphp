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
if(isset($cates) && count($cates) > 0) {
    $order = 0;
?>

<!-- result table -->
<table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Order</th>
            <th>ID</th>
            <th>Category Name</th>
            <th>Number of Purchasing</th>
            <th>Level</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        foreach ($cates as $cate) {
            if($cate['count'] != 0){
                $order++;
                echo "<tr>";
                echo "<td>$order</td>";
                    echo "<td>{$cate['cate_id']}</td>";
                    echo "<td>{$cate['cate_name']}</td>";
                    echo "<td>{$cate['count']}</td>";
                    echo "<td>{$cate['cate_level']}</td>";
                echo "</tr>";
            }
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

        var table = $('#data-table').dataTable({
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
                                "</select>" + 
                                " categories",
                                
                "sInfo": "Show _START_ to _END_ of total _TOTAL_ categories"
               }            

        });

    });
 
</script>

<?php
} else {
    echo "<p class='col-sm-offset-2 col-sm-10'>There is no purchasing in this time range.</p>";
}
?>