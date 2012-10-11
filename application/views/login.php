<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>css/church.ico" rel="shortcut icon"/>
<link href="<?php echo base_url(); ?>css/login.css" rel="stylesheet" type="text/css"/>
<title>Welcome to Area 3 Church Membership System Login Page</title>
</head>

<body>
	<div id="CLwrapper">
    	<div id="CLborder">
        	<div id="CLmain">
                    <div class="CLtitle">
                         Seventh Day Adventist Church<br>
                         Area 3 Church Membership Record System
                    </div>
            	<h2>Login Page</h2>
         		<div class="CLerror">
					<?php echo form_open('login_controller/login_attempt');?> 
                    <?php echo validation_errors();
                          echo $error;
                    ?>
                </div>
                <table>
                	<tr>
                    	<td>
                        	<img src="<?php echo base_url(); ?>css/people.png">
                        </td>
	                   	<td>
                            <ul>
                                <li>
                                    Username
                                </li>
                                <li>
                                    <input type="text" id="user_username" name="user_username" tabindex="1" placeholder="Enter Your Username Here"/>
                                </li>
                                <li>
                                    &nbsp;
                                </li>
                                <li>
                                    Password:
                                </li>
                                <li>
                                    <input type="password" id="user_password" name="user_password" tabindex="2" placeholder="Enter Your Password Here"/>
                                </li>
                                <li>
                                    &nbsp;
                                </li>
                                <li>
                                    <input type="submit" id="submitLogin" name="submitLogin" value="Login" tabindex="3">
                                </li>
                            </ul>
                        </td>
                     </tr>
                     </table>
                     </form>
                     
             </div>
             <div id="CFmain">
                     	Area 3 Church Membership Record System
                        <br>Seymantic Software Development
                        <br>&#169; 2012
                        <br><br>
             </div>
        </div>
    </div>
</body>
</html>