 <?php
	$_SESSION['page_name']='in_stock';
	$this->load->view('rf/main_parts/header');  // call header
?> 
	<div class="miniMenu">
		<?php $this->load->view('rf/pages/in_stock/in_stock_page_blocks/miniMenu'); ?>
	</div>
	<div class="menu">
		<?php	$this->load->view('rf/main_parts/menu'); 	
		?> 
	</div>
<?php
$error = isset($error) ? $error : '';
$errorSearch = isset($errorSearch) ? $errorSearch : '';
$errorMessage = isset($errorMessage) ? $errorMessage : '';
$errorMessage2 = isset($errorMessage2) ? $errorMessage2 : '';

$the_search =isset($the_search) ? $the_search : '';

$the_product_id = isset($the_in_stock) ? trim($the_in_stock['product_id'])  : '';
$the_quantity = isset($the_in_stock) ? trim($the_in_stock['quantity']) : '';


?>




<div id="table_box">
	<div class="tables">
		<h3 id="faux"><?php echo $errorSearch; ?> </h3>
		<h1 id="vrai">In stock</h1>
		<table class="Search">
			<form method="post" action="<?php echo base_url() ?>rf/in_stock/in_stockController/search_c" >
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
					<!-- <th></th> -->
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
								
								<form method="post" action="<?php echo base_url() ?>rf/in_stock/in_stockController/add_in_stock_c" >
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
		<h1>IN STOCK</h1>
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
					if (isset($all_in_stock)) 
					{
						$item_total = 0;
						$TOTAL = 0;
						foreach ($all_in_stock as $result) 
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


							$item_total= $result['in_prod_total_item'];
							$TOTAL +=$item_total;
				?>
							<tr>
								<td> <?php echo $result['product_name']; ?> </td>
								<td> <?php echo $result['product_category']; ?> </td>

								<td class="money"> <?php echo $result['in_prod_total_item'].'<b id="vrai">'.$cat_label.'</b>'; ?> </td>

								<td class="money"> 
									<?php echo $item_total.'<b id="vrai">'.$cat_label.'</b>'; ?> </td>
								<td>
									<form method="post" action="<?php echo base_url() ?>rf/in_stock/in_stockController/remove_in_stock_c" >
										<input type="submit" value="-" name="edit_button">
										<input type="hidden" name="reg_in_stockid" value="<?php echo $result['in_prod_id'];  ?> "/>
									</form>
								</td>
							</tr>
						
				<?php 

						}
				?>
						<tr>
								<td></td><td></td><td></td>
								<td class="money" id="money"> <?php //echo $TOTAL; ?> </td>
								<td>
									<form method="post" action="<?php echo base_url() ?>rf/in_stock/in_stockController/Save_c" >
										<input type="submit" class="errorMessage" value="Save">
									</form>
								</td>
						</tr>

						
				<?php
					}
				?>
			</tbody>
			</div>	
		</table>
	</div>
	</div>

<?php $this->load->view('rf/main_parts/footer'); ?>







