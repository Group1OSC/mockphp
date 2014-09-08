<?php 
    if(isset($feedbacks) && count($feedbacks) > 0){
?>

<table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Product</th>
            <th>Name</th>
            <th>Email</th>
            <th>Rating</th>
            <th>Content</th>
            <th>Time</th>
            <th>Approve</th>
            <th>Disapprove</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        foreach ($feedbacks as $feedback) {
            echo "<tr>";
                echo "<td><a target='_blank' href='" . base_url() . "default/home/detail/" . $feedback['pro_id'] . "'>{$feedback['pro_name']}</a></td>";
                echo "<td>{$feedback['feedback_name']}</td>";
                echo "<td>{$feedback['feedback_email']}</td>";
                echo "<td>{$feedback['feedback_rate']}/5</td>";
                echo "<td>{$feedback['feedback_content']}</td>";
                echo "<td>{$feedback['feedback_time']}</td>";     
                echo '<td><a class="btn btn-success" href="' . base_url(). 'admin/feedback/approve/' . $feedback['feedback_id'] . '">Approve</a></td>';
                echo "<td><a class='btn btn-danger' href='" . base_url(). 'admin/feedback/disapprove/' . $feedback['feedback_id'] . "' onclick='if(checkDelete() == false) return false' />Disapprove</a></td>";
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

    function checkDelete() {
    press = confirm("Do you really want to delete this feedback?")
    if(press == true)
        return true;
    else return false;
    }

    $(document).ready(function() {

        $('#data-table').dataTable({
            
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
                                " feedbacks",
                                
                "sInfo": "Show _START_ to _END_ of total _TOTAL_ feedbacks"
               }            

        });

    });
 
</script>
<?php
    } else {
        echo "<p class='col-sm-6 col-sm-offset-3'><i>There aren't any pending feedbacks right now.</i></p>";
    }
?>