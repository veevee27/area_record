<?php
    foreach($result as $row)
    {
        $bage = floor((time() - strtotime($row->member_bdate))/(60*60*24*365.2425));
        $fname = $row->member_fname;
        $mname = $row->member_mname;
        $lname = $row->member_lname;
        $bdate = $row->member_bdate;
        $age = $bage;
        $address = $row->member_address;
        $gender = $row->member_gender;
        $status = $row->member_status;
     }
     foreach($action as $row)
     {
         $receive = $row->action_receive;
         $minister = $row->action_minister;
         $receive_date = $row->action_receive_date;
         $dismiss = $row->action_dismiss;
         $dismiss_date = $row->action_dismiss_date;
     }
     
?>
<div class="CBcontent">
	<center>
    	<h1>Update Church Member Information</h1>
        <?php echo validation_errors(); 
        $chk = $this->uri->segment(4);
            if(!empty($chk))
            {
                echo '<div class="error">Input Already Exists</div><br>';
            }
        ?>
        <?php echo form_open('area_controller/updateRecords');?>
	    <table>
        	<tr>
            	<td>
                	Last Name:
                </td>
                <td>
                	<input type="text" class="CBinput" name="member_lname" value="<?php echo $lname; ?>" tabindex="1"/>
                </td>
                <td>
                	First Name:
                </td>
                <td>    <input type="text" class="CBinput" name="member_fname" value="<?php echo $fname; ?>" tabindex="2"/>
                </td>
                <td>
                	Middle Name:
                </td>
                <td>
                	<input type="text" class="CBinput" name="member_mname" value="<?php echo $mname; ?>" tabindex="3"/>
                </td>
            </tr>
            <tr>
            	<td>
                	Address:
                </td>
            	<td colspan="5">
                	<textarea class="CBtext" name="member_address" tabindex="4"><?php echo $address; ?></textarea>
                </td>
            </tr>
            <tr>
            	<td>
                	Date of Birth:
                </td>
                <td>
                	<input type="text" class="CBinput" name="member_bdate" id="member_bdate" onBlur="javascript:ageCount()" value="<?php echo $bdate?>" tabindex="5"/><br><small>(dd/mm/yyyy)</small>
                </td>
                <td>
                	Age:
                   	<span id="getage"><?php echo $age; ?></span><input type="hidden" name="member_age" value="<?php echo $age; ?>"/>
                </td>
                <td>
                	Gender:
                   	<select class="CBselect" name="member_gender" tabindex="6">
                            <?php
                                if($gender == 'Male')
                                {
                                   echo '<option value="Male">Male</option>';
                                   echo '<option value="Female">Female</option>';
                                }
                                else
                                {
                                   echo '<option value="Female">Female</option>';
                                   echo '<option value="Male">Male</option>';
                                }
                            ?>
                    	
                    </select>
                </td>
                <td colspan="2">
                	Status:
                    <select class="CBselect" name="member_status" tabindex="7">
                        <?php
                            if($status == 'Single')
                            {
                                echo '<option value="Single">Single</option>';
                                echo '<option value="Married">Married</option>';
                                echo '<option value="Widowed">Widowed</option>';
                            }
                            elseif ($status == 'Married')
                            {
                                echo '<option value="Married">Married</option>';
                                echo '<option value="Single">Single</option>';
                                echo '<option value="Widowed">Widowed</option>';
                            }
                            else
                            {
                                echo '<option value="Widowed">Widowed</option>';
                                echo '<option value="Single">Single</option>';
                                echo '<option value="Married">Married</option>';
                            }
                            
                        ?>
                    	
                    </select>
                        <input type="hidden" value="<?php echo $this->uri->segment(3); ?>" name="member_code"/>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="right">
                    <input type="submit" class="CBSubmit" name="submit_record" value="Update Record" tabindex="9">
               </td>
               <td colspan="3"><div class="CBback"><?php  echo anchor(base_url().'area_controller/records','Back to Records', 'class="CBButton"'); ?></div></td>
            </tr>
        </table>
	</center>
</div>