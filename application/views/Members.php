<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
                $('#member').dataTable();
        } );
</script>
<table border="0" cellpadding="0" cellspacing="0" class="datatable" id="member">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Birth Date</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($records as $row){
                            $age = floor((time() - strtotime($row->member_bdate))/(60*60*24*365.2425));
                            ?>
                            <tr>
                                <td><a href='$view_url/viewRecord/$row->member_code'><?php echo $row->member_lname.", ".$row->member_fname." ".$row->member_mname; ?></a></td>
                                <td><?php echo $row->member_bdate; ?></td>
                                <td><?php echo $age; ?></td>
                                <td><?php echo $row->member_bdate; ?></td>
                                <td align='center'><span><a href='<?php echo base_url(); ?>area_controller/updateRecord/<?php echo $row->member_code; ?>'><img src='<?php echo base_url(); ?>css/edit.png' title='Edit' /></a></span>&nbsp;&nbsp;
                                <a href="<?php echo base_url(); ?>area_controller/deleteRecord/<?php echo $row->member_code; ?>"><img style="cursor:pointer" src="<?php echo base_url(); ?>css/delete.png" title="Remove" /></a></span></td>
                            </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            
<script type="text/javascript">
 $(".field_value:odd").css("background","#A4DAFF");
</script>