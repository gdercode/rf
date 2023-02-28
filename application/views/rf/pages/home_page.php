<?php
	$_SESSION['page_name']='home';
	$this->load->view('rf/main_parts/header');  // call header 
?> 	
	<div class="menu">
		<?php	$this->load->view('rf/main_parts/menu'); 	// call menu ?> 
	</div>
<?php
?>
	<div id="para">	
		<h2> You are welcome</h2>
		
		<div id="repImage">
			<img src="<?php echo base_url(); ?>assets/images/logo_icon.png">
		</div>

		<h2> Welcome to Home page </h2>
	</div>
	<div id="para">
		
		
	</div>
	
<?php $this->load->view('rf/main_parts/footer'); ?>
