<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
                $('#meeting').dataTable();
        } );
</script>
<script type="text/javascript">
var auto_refresh = setInterval(
function ()
{
   
$.get("<?php echo base_url(); ?>area_controller/minutes",
function(data){ $("#CBdata").html($data); } // not sure about fadeIn here!
);
}, 2000); // refresh every 10000 milliseconds

</script>
<div class="CBcontent">
	<center>
    	<h1>Meetings</h1>
       </center>
    <a href="<?php echo base_url();?>area_controller/addMeeting" class="CBButton">Add Meeting</a><br><br>
     <div class="CBdata">
         <center>
             <table border="0" cellpadding="0" cellspacing="0" class="datatable" id="meeting">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($records as $row){
                           ?>
                            <tr>
                                <td><a href='<?php echo base_url(); ?>area_controller/viewMeeting/<?php echo $row->meeting_id;?>'><?php echo $row->meeting_date ?></a></td>
                                <td align='center'><span><a href="<?php echo base_url(); ?>area_controller/deleteMeeting/<?php echo $row->meeting_id; ?>"><img style="cursor:pointer" src="<?php echo base_url(); ?>css/delete.png" title="Remove" /></a></span></td>
                            </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            </center>
	

<script type="text/javascript">
 $(".field_value:odd").css("background","#A4DAFF");
</script>
</div>
</div>  
