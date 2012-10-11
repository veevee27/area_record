<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
                $('#member').dataTable();
        } );
</script>
<?php
	$validCharacters = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$validCharNumber = strlen($validCharacters);
	$x = 0;
	$randomCharacter = '';
	while($x < 20)
	{
		$index = mt_rand(0, $validCharNumber-1);
		$randomCharacter .= $validCharacters[$index];
		$x++;
	}
        
?>

<script type="text/javascript">
var auto_refresh = setInterval(
function ()
{
    

$.get("<?php echo base_url(); ?>area_controller/Members",
function(data){ $("#members").html($data); } // not sure about fadeIn here!
);
}, 2000); // refresh every 10000 milliseconds

</script>


<div class="CBcontent">
	<center>
    	<h1>Add Church Member</h1>
        <?php echo validation_errors(); 
        $chk = $this->uri->segment(3);
            if(!empty($chk) && $chk == 'fail')
            {
                echo '<div class="error">Input Already Exists</div><br>';
            }
        ?>
        <?php echo form_open('area_controller/addMember');?>
	    <table>
                <tr>
                    <td>
                        Book Number:
                    </td>
                    <td>
                        <input type="text" class="CBinput" name="member_book"/>
                    </td>
                    <td>
                        Page Number:
                    </td>
                    <td>
                        <input type="text" class="CBinput" name="member_page"/>
                    </td>
                </tr>
        	<tr>
            	<td>
                	Last Name:
                </td>
                <td>
                	<input type="text" class="CBinput" name="member_lname" value="<?php echo set_value('member_lname')?>" tabindex="1"/>
                </td>
                <td>
                	First Name:
                </td>
                <td>
                	<input type="text" class="CBinput" name="member_fname" value="<?php echo set_value('member_fname')?>" tabindex="2"/>
                </td>
                <td>
                	Middle Name:
                </td>
                <td>
                	<input type="text" class="CBinput" name="member_mname" value="<?php echo set_value('member_mname')?>" tabindex="3"/><input type="hidden" name="member_code" value="<?php echo $randomCharacter;?>" tabindex="3"/>
                </td>
            </tr>
            <tr>
            	<td>
                	Address:
                </td>
            	<td colspan="5">
                	<textarea class="CBtext" name="member_address" tabindex="4"><?php echo set_value('member_address')?></textarea>
                </td>
            </tr>
            <tr>
            	<td>
                	Date of Birth:
                </td>
                <td>
                	<input type="text" class="CBinput" name="member_bdate" id="member_bdate" onBlur="javascript:ageCount()" value="<?php echo set_value('member_bdate')?>" tabindex="5"/><br><small>(dd/mm/yyyy)</small>
                </td>
                <td>
                	Age:
                   	<span id="getage"><?php echo set_value('member_age'); ?></span><input type="hidden" name="member_age" value="<?php echo set_value('member_age'); ?>"/>
                </td>
                <td>
                	Gender:
                   	<select class="CBselect" name="member_gender" tabindex="6">
                    	<option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td colspan="2">
                	Status:
                    <select class="CBselect" name="member_status" tabindex="7">
                    	<option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="6" align="right">
                    <input type="submit" class="CBSubmit" name="submit_record" value="Add Record" tabindex="8">
           
                    <input type="button" class="CBSubmit" name="cancel_record" value="Cancel" tabindex="9">
                </td>
            </tr>
        </table>
	</center>
        
        <div class="CBdata">
        <div id="members">
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
                                <td><a href='<?php echo base_url(); ?>area_controller/viewRecord/<?php echo $row->member_code; ?>'><?php echo $row->member_lname.", ".$row->member_fname." ".$row->member_mname; ?></a></td>
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
</div>
</div>
</div>
</div>  
