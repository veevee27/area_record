<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
                $('#discipline').dataTable();
        } );
</script>
<div class="CBcontent">
                <center>
                	<h1>Church Member Information</h1>
                <?php
                    
                    $chk = $this->uri->segment(4);
                    if(!empty($chk))
                    {
                        if($chk == 1)
                        {
                            echo '<div class="error">A Request has Already been Sent</div>';
                        }
                        elseif($chk == 2)
                        {
                            echo '<div class="error">You Cannot Sent a Transfer Member Request to Your Own Church</div>';
                        }
                        else
                        {
                            echo '<div class="error">Please Input Reason of the Disciplinary Action</div>';
                        }
                    }
                ?>
    <table border="0" cellpadding="3" cellspacing="0" class="fields_table">
                   	<?php
                                        echo '<br/>General Information<br/><br>';
                                        
                                                                                    
						foreach($results as $row)
						{	
                                                        $age = floor((time() - strtotime($row->member_bdate))/(60*60*24*365.2425));
                                                        $code = $row->member_code;
                                                        $for_update_url = base_url().'area_controller/updateDiscipline/'.$code;
                                                        echo '<tr>';
                                                        echo '<td align="right"><strong>Book Number:</strong></td><td> '.$row->reference_book.'</td>';
                                                        echo '</tr>';
							echo '<tr>';
                                                        echo '<td align="right"><strong>Page Number:</strong></td><td>'.$row->reference_page.'</td>';
                                                        echo '</tr>';
							echo '<tr>';
                                                        echo '<td align="right"><strong>Name: </strong></td>';
							echo '<td><span>'.$row->member_lname.', '.$row->member_fname.' '.$row->member_mname.'</td>';
							echo '</tr>';
                                                        echo '<tr>';
                                                        echo '<td align="right"><strong>Address: </strong></td>';
							echo '<td><span>'.$row->member_address.'</td>';
							echo '</tr>';
                                                        echo '<tr>';
                                                        echo '<td align="right"><strong>Birthday: </strong></td>';
							echo '<td><span>'.$row->member_bdate.'</td>';
							echo '</tr>';
                                                        echo '<tr>';
                                                        echo '<td align="right"><strong>Age: </strong></td>';
							echo '<td><span>'.$age.'</td>';
							echo '</tr>';
                                                        echo '<tr>';
                                                        echo '<td align="right"><strong>Marital Status: </strong></td>';
							echo '<td><span>'.$row->member_status.'</td>';
							echo '</tr>';
                                                        echo '<tr>';
                                                        echo '<td align="right"><strong>Gender: </strong></td>';
							echo '<td><span>'.$row->member_gender.'</td>';
							echo '</tr>';
							
							
						}
                                           
					?>
        
        </table>
                        
                 
        <table border="0" cellpadding="3" cellspacing="0" class="fields_table">
            <?php
                                        echo '<br/>Action Taken <a href="#" data-reveal-id="Actions" class="edits">Edit Action</a><br/><br>';
						foreach($results as $row)
						{	
                                                        if(empty($row->action_receive))
                                                        {
                                                            echo '<tr>';
                                                            echo '<td align="right"><strong>Receive:</strong></td>';
                                                            echo '<td>N/A</td>';
                                                            echo '</tr>';
                                                        }
                                                        else{
                                                             echo '<tr>';
                                                            echo '<td align="right"><strong>Receive:</strong></td>';
                                                            echo '<td>'.$row->action_receive.'</td>';
                                                            echo '</tr>';
                                                        }
                                                        if(empty($row->action_minister))
                                                        {
                                                            echo '<tr>';
                                                            echo '<td align="right"><strong>Receive By:</strong></td>';
                                                            echo '<td>N/A</td>';
                                                            echo '</tr>';
                                                        }
                                                        else{
                                                             echo '<tr>';
                                                            echo '<td align="right"><strong>Receive By:</strong></td>';
                                                            echo '<td>'.$row->action_minister.'</td>';
                                                            echo '</tr>';
                                                        }
                                                        if(empty($row->action_receive_date))
                                                        {
                                                            echo '<tr>';
                                                            echo '<td align="right"><strong>Receive Date:</strong></td>';
                                                            echo '<td>N/A</td>';
                                                            echo '</tr>';
                                                        }
                                                        else{
                                                             echo '<tr>';
                                                            echo '<td align="right"><strong>Receive Date:</strong></td>';
                                                            echo '<td>'.$row->action_receive_date.'</td>';
                                                            echo '</tr>';
                                                        }
                                                        if(empty($row->action_dismiss))
                                                        {
                                                            echo '<tr>';
                                                            echo '<td align="right"><strong>Dismiss:</strong></td>';
                                                            echo '<td>N/A</td>';
                                                            echo '</tr>';
                                                        }
                                                        else{
                                                             echo '<tr>';
                                                            echo '<td align="right"><strong>Dismiss:</strong></td>';
                                                            echo '<td  width="200px">'.$row->action_dismiss.'</td>';
                                                            echo '</tr>';
                                                        }
                                                        if(empty($row->action_dismiss_date))
                                                        {
                                                            echo '<tr>';
                                                            echo '<td align="right"><strong>Dismiss Date:</strong></td>';
                                                            echo '<td>N/A</td>';
                                                            echo '</tr>';
                                                        }
                                                        else{
                                                             echo '<tr>';
                                                            echo '<td align="right"><strong>Dismiss Date:</strong></td>';
                                                            echo '<td>'.$row->action_dismiss_date.'</td>';
                                                            echo '</tr>';
                                                        }
													
							
						}
                                           
					?>
                       
                    </table>
                        <br/>Disciplinary Actions <a href="#" data-reveal-id="Discipline" class="edits">Edit Discipline</a><br/>
                        </center>
                        <table border="0" cellpadding="3" cellspacing="0" class="CBdata" id="discipline">
                            <thead>
                                <tr>
                                    <th>Action Made</th>
                                    <th>Reason</th>
                                    <th>Church</th>
                                    <th>District</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                                 <?php
                                       echo '<tbody>';
                                                 foreach($discipline as $row)
                                                    {	
                                                            echo '<tr>';
                                                            echo '<td>'.$row->discipline_action.'</td>';
                                                            echo '<td>'.$row->discipline_reason.'</td>';
                                                            echo '<td>'.$row->discipline_church.'</td>';
                                                            echo '<td>'.$row->discipline_district.'</td>';
                                                            echo '<td>'.$row->discipline_date.'</td>';
                                                            echo "<td align='center'><span><a href='$for_update_url'><img src='". base_url() ."css/edit.png' title='Edit' /></a></span>&nbsp;&nbsp; ";
                                                            echo '<span id="' . $code . '" class="delinfogo"><a href="'.base_url().'area_controller/deleteDiscipline/'.$code.'"><img style="cursor:pointer" src="'. base_url() .'css/delete.png" title="Remove" /></a></span></td>';
                                                            echo '</tr>';


                                                    }
                                               
                                                echo '</tbody>';
                                           
					?>
                        <tr>
                            <td colspan ="2">
                               <br></td>
                               </tr>
                               
                    </table>
               <center>
                        <table>
                            <tr>
                                <td colspan="3" align="left"><a href="<?php echo base_url().'area_controller/records'; ?>" class="CBButton">Back to Records</a></td>
                           	<td colspan="3" align="left"><a href="<?php echo base_url().'area_controller/updateRecord/'.$this->uri->segment(3)?>" class="CBButton">Update Record</a></td>
                            </tr>
                            </table>
                        
               </center>
</div>


<div id="Actions" class="reveal-modal">
	<h1>Action</h1>
                        <center>
                        <?php echo form_open('area_controller/processUpdateAction');?>
                        <table>
                            <tr>
                                <td>Receive:</td>
                                <td><select name="action_receive" class="CBselect">
                                        <option value="Baptism">Baptism</option>
                                        <option value="Letter">By Letter</option>
                                        <option value="Profession">By Profession</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Minister:</td>
                                <td><input type="text" name="action_minister" class="CBinput"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Receive Date:</td>
                                <td><input type="text" name="action_receive_date" class="CBinput"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Dismiss:</td>
                                <td><select name="action_dismiss" class="CBselect">
                                        <option value="Death">Death</option>
                                        <option value="Disfellow">Disfellow</option>
                                        <option value="Letter">By Letter</option>
                                        <option value=" ">No Action</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Church:</td>
                                <td><select name="action_church" class="CBselect">
                                        <option value="">Select if Dismiss is By Letter</option>
                                        <?php
                                            foreach($churches as $row)
                                            {
                                                echo '<option value="'.$row->church_name.'">'.$row->church_name.'</option>';
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Dismiss Date:</td>
                                <td><input type="text" name="action_dismiss_date" class="CBinput"/>
                                    <input type="hidden" name="action_member" value="<?php echo $code;?>">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" name="SubmitAction" class="CBSubmit" value="Submit"></td>
                                
                            </tr>
                        </table>
                        <?php echo form_close();?>
                            </center>
           
            <a class="close-reveal-modal">&#215;</a>
		</div>

<div id="Discipline" class="reveal-modal">
	<h1>Discipline</h1>
                        <center>
                        <?php echo form_open('area_controller/addDiscipline');?>
                        <table>
                            <tr>
                                <td>Action:</td>
                                <td><select class="CBselect" name="discipline_action">
                                        <option value="warning">Warning</option>
                                        <option value="disfellow">Disfellow</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Reason:</td>
                                <td><textarea class="CBtext" name="discipline_reason"></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" class="CBButton" name="submitDiscipline" value="Add Disciplinary Action"></td>
                                <input type="hidden" name="discipline_member" value="<?php echo $code; ?>">
                            </tr>
                        </table>
                        <?php echo form_close();?>
                            </center>
           
            <a class="close-reveal-modal">&#215;</a>
		</div>