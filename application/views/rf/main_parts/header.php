<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	 <link rel = "stylesheet" type = "text/css"
	 href = "<?php echo base_url(); ?>assets/css/style.css">
	<title> Refugee Food Management System </title>
</head>


<body>


	<div class="container">
		<?php
			if ($this->session->userdata('permit')) 
			{
				$userDetails = $this->session->userdata('user_details');

		?>
			<div class="logout"> 
				<b><?php echo $userDetails['username'];  ?></b> 
				<a href="<?php  echo base_url() ?>rf/rfController/logout_c" > Logout  </div></a> 

		<?php

			}
		?>
		<img src="<?php echo base_url(); ?>assets/images/logo_icon.png" height="50" align="left">
		<div class="company_name">
			<font size ='5' color="gray">
				<b>Refugee Food Management System</b>	
			</font> <br>
			<font color="gray">RFMS</font>
		</div>
		<center>
			<nav class="menu_breadge2">
				<!-- Empty space -->
			</nav>
			<nav class="menu_breadge">
				<font color="White" size="7px"> <b>Refugee Food Management System</b> </font> 
			</nav>
			<nav class="menu_breadge2">
				<!-- Empty space -->
			</nav>
		</center>
	

			


			 



			
			