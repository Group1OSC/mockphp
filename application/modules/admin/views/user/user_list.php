
<table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Level</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        foreach ($users as $user) {
            echo "<tr>";
                echo "<td>{$user['user_id']}</td>";
                echo "<td>{$user['user_name']}</td>";
                echo "<td>{$user['user_email']}</td>";
                echo "<td>{$user['user_address']}</td>";
                echo "<td>{$user['user_phone']}</td>";
                echo "<td>";
                echo $user['user_gender'] == 1 ? "Male" : "Female";
                echo "</td>";
                echo "<td>";
                echo $user['user_level'] == 1 ? "Admin" : "Member";
                echo "</td>";       
                echo '<td><a href="' . base_url(). 'admin/user/update/' . $user['user_id'] . '">Update</a></td>';
                echo "<td><a href='" . base_url(). 'admin/user/delete/' . $user['user_id'] . "' onclick='if(checkDelete() == false) return false' />Delete</a></td>";
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
    press = confirm("Do you really want to delete this user?")
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
                                " users",
                                
                "sInfo": "Show _START_ to _END_ of total _TOTAL_ users"
               }            

        });

    });
 
</script>