<?php
	$name = $this->session->userdata('lname').", ".$this->session->userdata('fname')." ".$this->session->userdata('mname');
	$church = $this->session->userdata('user_church');
	$district = $this->session->userdata('user_district');
	$title = $this->session->userdata('title');
?>
<div class="CNmain">
            <a href="<?php echo base_url();?>area_controller/" title="Home Page">Home</a>
            <a href="<?php echo base_url();?>area_controller/records" title="Records Page">Records</a>
            <a href="<?php echo base_url();?>area_controller/meetings" title="Area Page">Meetings</a>
            <a href="#" title="Contact Us Page" class="big-link" data-reveal-id="ContactUs">Contact Us</a>
            <a href="<?php echo base_url();?>area_controller/account" title="Contact Us Page">Account</a>
        </div>
        <div id="ContactUs" class="reveal-modal">
			<h1>Contact Us</h1>
            <br>
			<table>
               	<tr>
                	<td>
                    	Developer:
                    </td>
                    <td>
                    	Vito Dominic D. Sese
                    </td>
                </tr>
                <tr>
                	<td>
                    	Contact Number:
                    </td>
                    <td>
                    	+639159060389
                    </td>
                </tr>
                <tr>
                	<td>
                    	Email Address:
                    </td>
                    <td>
                    	www.sese_vito_230@yahoo.com
                    </td>
                </tr>
            </table>
            <a class="close-reveal-modal">&#215;</a>
		</div>

<div id="Area" class="reveal-modal">
			<h1>Area 3</h1>
            <h4>District</h4>
            <a class="close-reveal-modal">&#215;</a>
		</div>
        <div class="CNmain2">
        	Welcome <?php echo $title.' '.$name; ?> of <?php echo $district; ?> <?php echo $church; ?> Church <a href="<?php echo base_url();?>area_controller/logout"><img src="<?php echo base_url();?>css/logout.png" width="20px;"></a>
        </div>
    </div>