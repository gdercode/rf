 <?php
	$_SESSION['page_name']='out_stock';
	$this->load->view('rf/main_parts/header');  // call header
?> 	
	<div class="miniMenu">
		<?php $this->load->view('rf/pages/out_stock/out_stock_page_blocks/miniMenu');  ?>
	</div>
	<div class="menu">
		<?php	$this->load->view('rf/main_parts/menu'); ?> 
	</div>
	
	
<?php
$error = isset($error) ? $error : '';
$errorSearch = isset($errorSearch) ? $errorSearch : '';
$errorMessage = isset($errorMessage) ? $errorMessage : '';
$errorMessage2 = isset($errorMessage2) ? $errorMessage2 : '';

$select_error = isset($select_error) ? $select_error : '';

$the_search =isset($the_search) ? $the_search : '';

$the_product_id = isset($the_out_stock) ? trim($the_out_stock['product_id'])  : '';
$the_quantity = isset($the_out_stock) ? trim($the_out_stock['quantity']) : '';



?>



<div id="table_box">

	<div class="tables">
		<h3 id="faux"><?php echo $errorSearch; ?> </h3>
		<h1 id="vrai">Out stock</h1>
		<table class="Search">
			<form method="post" action="<?php echo base_url() ?>rf/out_stock/out_stockController/search_c" >
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
		<h3 id="vrai"><?php echo $error; ?> </h3>
		<h3 class="errorMessage"><?php echo $errorMessage; ?> </h3>
		<h1>ALL</h1>
		<table>
			<div id="cont">
			<thead>
				<tr>
					<th> Name </th>
					<th> Category </th>
					<th> STOKE </th>
					<th> quantity </th>
					<th> Edit </th>
				</tr>
			</thead>
			<tbody>
				<?php
					if (isset($all_product)) 
					{
						foreach ($all_product as $result)  
						{
							$cat_label='';
							if ($result['product_category']=='Unit')
							{
								$cat_label='';
							}
							else if ($result['product_category']=='Liquid')
							{
								$cat_label=' liters';
							}
							else if ($result['product_category']=='Solid')
							{
								$cat_label=' kg';
							}
							
				?>
							<tr>
								<td> <?php echo $result['product_name']; ?> </td>
								<td> <?php echo $result['product_category']; ?> </td>
								<td id="faux"> 
									<?php 
										if ($result['stock_prod_quantity']<=0)
										{
											echo '<b id="faux">'.$result['stock_prod_quantity'].'</b>'.$cat_label;
										}
										else
										{
											echo '<b id="vrai">'.$result['stock_prod_quantity'].'</b>'.$cat_label;
										}

									?> 
								</td>
								
								<form method="post" action="<?php echo base_url() ?>rf/out_stock/out_stockController/add_out_stock_c" >
									<td> 
										<input type="text" name="reg_quantity" class="table_input" value="<?php
											if ($the_product_id==$result['product_id'])
											{
													echo $the_quantity;
											}
											
										?>"> 
									</td>
									
									<td>
										<input type="submit" value="+" name="add_button">
										<input type="hidden" name="reg_prodid" value="<?php echo $result['product_id'];  ?> "/>
										<input type="hidden" name="reg_stock_quantity" value="<?php echo $result['stock_prod_quantity'];  ?> "/>
										
									</td>
								</form>
								
							</tr>
						
				<?php 

						}
					}
				?>
			</tbody>
			</div>	
		</table>
	</div>

<div class="tables">
		<h3 class="errorMessage"><?php echo $errorMessage2; ?> </h3>
		<h1>OUT STOCK</h1>
		<table>
			<div id="cont">
			<thead>
				<tr>
					<th> Name </th>
					<th> Category </th>
					<th> quantity </th>
					<th> TOTAL</th>

					<th> Edit </th>
				</tr>
			</thead>
			<tbody>
				<?php
					if (isset($all_out_stock)) 
					{
						$item_total = 0;
						$TOTAL = 0;
						foreach ($all_out_stock as $result) 
						{

							$cat_label='';
							if ($result['product_category']=='Unit')
							{
								$cat_label='';
							}
							else if ($result['product_category']=='Liquid')
							{
								$cat_label=' liters';
							}
							else if ($result['product_category']=='Solid')
							{
								$cat_label=' kg';
							}


							$item_total= $result['out_quantity'];
							$TOTAL +=$item_total;
				?>
							<tr>
								<td> <?php echo $result['product_name']; ?> </td>
								<td> <?php echo $result['product_category']; ?> </td>

								<td class="money"> <?php echo $result['out_quantity'].'<b id="vrai">'.$cat_label.'</b>'; ?> </td>

								<td class="money"> 
									<?php echo $item_total.'<b id="vrai">'.$cat_label.'</b>'; ?> </td>
								<td>
									<form method="post" action="<?php echo base_url() ?>rf/out_stock/out_stockController/remove_out_stock_c" >
										<input type="submit" value="-" name="edit_button">
										<input type="hidden" name="reg_out_stockid" value="<?php echo $result['out_prod_id'];  ?> "/>
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
	
	<div class="tables">
		<h3 id="faux"><?php echo $select_error; ?> </h3>
		<h1 id="vrai">Select Refugee</h1>
		<table class="Search">
			<form method="post" action="<?php echo base_url() ?>rf/out_stock/out_stockController/out_c" >
				<td >
					<select name="refugee_selection"  class ="role_name_selection">
	
						<option  value="none" <?php echo set_select('refugee_selection','none')  ?>></option>
						<?php 
							if (isset($all_user)) 
							{
								foreach($all_user as $user)
								{
						?>
									<option 
											value=<?php echo $user['user_id']; ?> 
											<?php echo set_select('role_name_selection',$user['user_id']) ; ?>   >

											<?php echo $user['user_first_name'].' &nbsp; &nbsp;'.$user['user_last_name']; ?> 
									</option>
						<?php
								}
							}
						?>
					</select>
				</td>
					
				<td id="button">
					<input type="submit" class="errorMessage" value="Save">
				</td>
			</form>
		</table>
	</div>	
	</div>

<?php $this->load->view('rf/main_parts/footer'); ?>







