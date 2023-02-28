<?php
	$_SESSION['page_name']='product';
	$this->load->view('rf/main_parts/header');  // call header 
?> 	
	<div class="menu">
		<?php	$this->load->view('rf/main_parts/menu'); 	// call menu ?> 
	</div>
<?php
	$error = isset($error) ? $error : '';
	$dangerError = isset($dangerError) ? $dangerError : '';
	$select_error = isset($select_error) ? $select_error : '';
?>

<div id="logContainer">

	<div id="registerBox">

		<h1>Add Item</h1>

		<form id="registerForm" method="post">
			 <h3><?php echo $error; ?> </h3>
			 <h5><?php echo $dangerError; ?> </h5>

			<p>	
				<h5><?php echo form_error('reg_prodname'); ?></h5>
				<input type="text" name="reg_prodname" value="<?php echo set_value('reg_prodname'); ?>" placeholder="Name" />
			</p>

			<p>
				<h5><?php echo $select_error; ?> </h5>
				<select name="reg_prodcategory"  class ="role_name_selection">
				
					<option value="none" <?php echo set_select('reg_prodcategory','none')  ?> >...</option>
					<option value="Liquid">Liquid</option>
					<option value="Solid">Solid</option>
					<option value="Unit">Unit</option>
				</select>
			</p>

			<p> <input type="submit" name="reg_button" value="REGISTER"> </p>

		</form>


	</div>

</div>

<?php $this->load->view('rf/main_parts/footer'); ?>