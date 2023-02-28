<?php
	$_SESSION['page_name']='product';
	$this->load->view('rf/main_parts/header');  // call header 
?> 	
	<div class="menu">
		<?php	$this->load->view('rf/main_parts/menu'); 	// call menu ?> 
	</div>
<?php
		
		$error = isset($error) ? $error : '';
		$pass_message = isset($pass_message) ? $pass_message : '';
		$select_error = isset($select_error) ? $select_error : '';

		$product_id = isset($the_product) ? $the_product['product_id'] : ''; 
		$product_name = isset($the_product) ? $the_product['product_name'] : ''; 
		$product_category = isset($the_product) ? $the_product['product_category'] : ''; 
?>

<div id="logContainer_browse">

	<div id="registerBox">

		<h1>Edit Item</h1>

		<form id="registerForm" method="post" action="<?php echo base_url() ?>rf/product/productController/manipulate_product_c" > 
			 <h3><?php echo $error; ?> </h3>

			 <input type="hidden" name="reg_prodid" value="<?php echo $product_id;  ?> "/>

			<p>	
				<h5><?php echo form_error('reg_prodname'); ?></h5>
				<input type="text" name="reg_prodname" value="<?php echo $product_name; ?>" placeholder="Name" />
			</p>

			<p>
				<h5><?php echo $select_error; ?> </h5>
				<select name="reg_prodcategory"  class ="role_name_selection">
				
					<option value="<?php echo $product_category; ?>" <?php echo set_select('product_category','none')  ?> ><?php echo $product_category; ?> </option>
					<option value="Liquid">Liquid</option>
					<option value="Solid">Solid</option>
					<option value="Unit">Unit</option>
				</select>
			</p>

			<p><input type="submit" name="update_button" value="Save changes" > </p>
			<!-- <p><input type="submit" name="delete_button" value="Futa Ikidandazwa" > </p> -->
		</form>

	</div>

</div>

<?php $this->load->view('rf/main_parts/footer'); ?>