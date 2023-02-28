<?php
	$this->load->view('rf/main_parts/header');  // call header 
?>
	<div class="logout">
		<a href="<?php  echo base_url() ?>rf/rfController/login_c" > Login </a> 
	</div>

	<div id="para">	
		<div id="repImage">
		<p>	<img src="<?php echo base_url(); ?>assets/images/logo_icon.png"> </p> <br>
		</div>
		<div id="para">
			<p>	<h1>You are Out!</h1> </p>
		</div>
		
	</div>
<?php $this->load->view('rf/main_parts/footer'); ?>
