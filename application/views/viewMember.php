<div class="CBcontent">
                <center>
                	<h1>Church Member Information</h1>
                
    <table border="0" cellpadding="3" cellspacing="0" class="fields_table">
                   	<?php
                                        echo '<br/>General Information<br/><br>';
                                        
                                                                                    
						foreach($results as $row)
						{	
                                                        $age = floor((time() - strtotime($row->member_bdate))/(60*60*24*365.2425));
                                                        $code = $row->member_code;
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
                                echo '<br/>Actions<br/><br>';
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
                        <tr>
                            <td colspan ="2">
                               <br></td>
                               </tr>
                               <tr>
                    		<td><a href="<?php echo base_url().'area_controller/requests'; ?>" class="CBButton">Back to Records</a></td>
                           	<td><a href="<?php echo base_url().'area_controller/approve/'.$this->uri->segment(3); ?>" class="CBButton">Approve Requests</a></td>
                        
                        </tr>
                    </table>
                        
               </center>
</div>