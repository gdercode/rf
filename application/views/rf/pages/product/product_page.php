<?php
	$_SESSION['page_name']='product';
	$this->load->view('rf/main_parts/header');  // call header
?> 	
	<div class="miniMenu">
		<?php $this->load->view('rf/pages/product/product_page_blocks/miniMenu'); ?>
	</div>
	<div class="menu">
		<?php	$this->load->view('rf/main_parts/menu'); 	 
		?> 
	</div>
<?php
$error = isset($error) ? $error : '';
$the_search =isset($the_search) ? $the_search : '';
	
$errorSearch = isset($errorSearch) ? $errorSearch : '';
?>


<div id="table_box">
	<div class="tables">
		<h3 id="faux"><?php echo $errorSearch; ?> </h3>
		<h1 id="vrai">ITEMS</h1>
		<table class="Search">
			<form method="post" action="<?php echo base_url() ?>rf/product/productController/search_c" >
				<td >
					<input type="text" name="reg_prod_name" class="table_input" value="<?php echo $the_search; ?> ">  
				</td>
				<td id="button">
					<input type="submit" class="errorMessage" value="Search">
				</td>
			</form>
		</table>
	</div>
</div>


<div id="table_box">
	<div class="tables">
		<h3><?php echo $error; ?> </h3>
		<h1>Items</h1>
		<table>
			<div id="cont">
			<thead>
				<tr>
					<th> Name </th>
					<th> Category </th>
					<th> Edit </th>
				</tr>
			</thead>
			<tbody>
				<?php
					if (isset($all_product)) 
					{
						foreach ($all_product as $result) // get row by row data to avoid array 
						{
				?>
							<tr>
								<td> <?php echo $result['product_name']; ?> </td>
								<td> <?php echo $result['product_category']; ?> </td>
								<td>
									<form method="post" action="<?php echo base_url() ?>rf/product/productController/product_find_list_c" >
										<input type="submit" value="Edit" name="edit_button">
										<input type="hidden" name="reg_prodid" value="<?php echo $result['product_id'];  ?> "/>
									</form>
								</td>
							</tr>
						
				<?php 

						}
					}
				?>
			</tbody>
			</div>	
		</table>
	</div>
	</div>

<?php $this->load->view('rf/main_parts/footer'); ?>







