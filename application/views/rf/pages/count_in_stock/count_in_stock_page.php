 <?php
	$_SESSION['page_name']='count_in_stock';
	$this->load->view('rf/main_parts/header');  // call header
?> 	
	<div class="miniMenu">
		<?php $this->load->view('rf/pages/count_in_stock/count_in_stock_page_blocks/miniMenu'); ?>
	</div>
	<div class="menu">
		<?php	$this->load->view('rf/main_parts/menu'); 	 
		?> 
	</div>
<?php
$error = isset($error) ? $error : '';
$errorSearch = isset($errorSearch) ? $errorSearch : '';
$errorMessage = isset($errorMessage) ? $errorMessage : '';

$the_search =isset($the_search) ? $the_search : '';


?>

<div id="table_box">
	<div class="tables">
		<h3 id="faux"><?php echo $errorSearch; ?> </h3>
		<h1 id="vrai">COUNT</h1>
		<table class="Search">
			<form method="post" action="<?php echo base_url() ?>rf/count_in_stock/count_in_stockController/search_c" >
				<td >
					<input type="date" name="reg_in_date1" class="table_input" >
				</td>
				<td >
					<input type="date" name="reg_in_date2" class="table_input" >  
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
					<th> quantity </th>
					<th> TOTAL</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$new_day = '';
					if (isset($all_count_in_stock)) 
						{
							


							$item_total = 0;
							$TOTAL = 0;

							$item_total_daily = 0;
							$TOTAL_daily = 0;

							$first_row_check='yes';

							foreach ($all_count_in_stock as $result)  
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


								$item_total = $result['in_prod_total_item'];
								$TOTAL = $TOTAL + $item_total;

								if ($new_day != $result['in_prod_date'])
								{
									$new_day = $result['in_prod_date'];
									if ($first_row_check=='no')
									{
				?>

									<!-- 	<tr>
											<td></td><td></td>
											<td></b></td>
											<td></td><td></td><td><b class="money"><?php //echo $TOTAL_daily;  ?></td>
										</tr> -->
				<?php 
									}
				?>

									<tr>
										<td></td><td></td>
										<td> <b id="money"><?php echo $new_day;  ?></b></td>
										<td></td><td></td>
									</tr>


				<?php				
									$item_total_daily = $result['in_prod_total_item'];
									$TOTAL_daily = $item_total_daily;
									$first_row_check='no';
								}
								else
								{
									$item_total_daily = $result['in_prod_total_item'];
									$TOTAL_daily = $TOTAL_daily + $item_total_daily;
								}
				?>
								<tr>
									<td> <?php echo $result['product_name']; ?> </td>
									<td> <?php echo $result['product_category']; ?> </td>

									<td class="money"> <?php echo $result['in_prod_total_item']; ?> </td>

									<td class="money"> 
										<?php echo $item_total; ?>
									</td>
									<td class="money" ><?php echo $cat_label; ?></td>
								</tr>

							
				<?php 
								
							}
				?>
					<!-- 	<tr>
								<tr>
									<td></td><td></td>
									<td></b></td>
									<td></td><td></td><td><b class="money"><?php //echo $TOTAL_daily;  ?></td>
								</tr>
								<td> TOTAL </td>
									<td></td><td></td>
								<td class="money" id="money"> <?php //echo $TOTAL; ?> </td>
						</tr> -->
				<?php
					}
				?>
			</tbody>
			</div>	
		</table>
	</div>
	</div>

<?php $this->load->view('rf/main_parts/footer'); ?>







