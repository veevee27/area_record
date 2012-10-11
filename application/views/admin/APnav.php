<body>
	<?php
	$name = $this->session->userdata('lname').", ".$this->session->userdata('fname')." ".$this->session->userdata('mname');
	$title = $this->session->userdata('title');
	?>
	<div class="ANwrapper">
    	<div class="ANmain1">
            <a href="<?php echo base_url();?>admin_controller">Home</a>
            <a href="<?php echo base_url();?>admin_controller/accounts">Accounts</a>
            <a href="#" class="big-link" data-reveal-id="Churches">Churches</a>
            <a href="<?php echo base_url();?>admin_controller/activity">Activity</a>
            <a href="#" class="big-link" data-reveal-id="ContactUs">Contact Us</a>
            <a href="#" class="big-link" data-reveal-id="Backup">Backup</a>
            <a href="<?php echo base_url();?>admin_controller/account" title="Contact Us Page">Account</a>
        </div>
        <div class="ANmain2">
        	Welcome <?php echo $title.' '.$name; ?> <a href="<?php echo base_url();?>area_controller/logout"><img src="<?php echo base_url();?>css/logout.png" width="20px;"></a>
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
        <div id="Churches" class="reveal-modal">
			<h1>Churches</h1>
            <table>
            	<tr>
                	<td colspan="4">
                    	North Pampanga 1
                    </td>
                </tr>
                <tr>
                    <td><a href="#">Angeles Worship Center</a></td><td><a href="#">Sta. Cruz Church</a></td><td><a href="#">Pandacaqui Church</a></td><td><a href="#">Manibaug Church</a></td>
                </tr>
            </table>
          
            <a class="close-reveal-modal">&#215;</a>
		</div>
            
            <div id="Backup" class="reveal-modal">
			<h1>Backup Database</h1>
                        <br>
                        <center>
                            <?php echo form_open('admin_controller/check');?>
                            <table>
                                <tr>
                                    <td>What Church Do I Belong?</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="user_church" class="APinput"/></td>
                                </tr>
                                <tr>
                                    <td>What District Do I Belong?</td>
                                <tr>
                                </tr>
                                    <td><input type="text" name="user_district" class="APinput"/></td>
                                </tr>
                                <tr>
                                    <td><input type="submit" name="submitQuestion" class="APsubmit" value="Backup"></td>
                                </tr>
                            </table>
                            <?php echo form_close(); ?>
                        </center>
            
            <a class="close-reveal-modal">&#215;</a>
		</div>
    </div>
    <br>
    <br>