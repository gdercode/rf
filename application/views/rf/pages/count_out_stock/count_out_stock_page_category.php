<?php
	$_SESSION['page_name']='count_out_stock';
	$this->load->view('rf/main_parts/header');  // call header
?> 	
	<div class="miniMenu">
		<?php $this->load->view('rf/pages/count_out_stock/count_out_stock_page_blocks/miniMenu'); ?>
	</div>
	<div class="menu">
		<?php
			$this->load->view('rf/main_parts/menu');  
		?> 
	</div>
<?php
$error = isset($error) ? $error : '';
$errorSearch = isset($errorSearch) ? $errorSearch : '';
$errorMessage = isset($errorMessage) ? $errorMessage : '';

$the_search =isset($the_search) ? $the_search : '';

$cat = '';

if (isset($all_count_out_stock))
{

	foreach ($all_count_out_stock as $result)  
	{
		$cat = trim($result['product_category']);
	}
}



?>

<div id="table_box">
	<div class="tables">
		<h3 id="faux"><?php echo $errorSearch; ?> </h3>
		<h1 id="vrai">COUNT</h1>
		<table class="Search">
			<form method="post" action="<?php echo base_url() ?>rf/count_out_stock/count_out_stockController/search_cat_c" >
				<td >
					<input type="date" name="reg_out_date1" class="table_input" >
				</td>
				<td >
					<input type="date" name="reg_out_date2" class="table_input" >  
				</td>
				<td id="button">
					<input type="hidden" name="reg_category" value="<?php echo $cat ?>">
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
					if (isset($all_count_out_stock)) 
						{
							$item_total = 0;
							$TOTAL = 0;

							$item_total_daily = 0;
							$TOTAL_daily = 0;

							$first_row_check='yes';

							foreach ($all_count_out_stock as $result)  
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


								$item_total = $result['out_quantity'];
								$TOTAL = $TOTAL + $item_total;

								if ($new_day != $result['out_date'])
								{
									$new_day = $result['out_date'];
									if ($first_row_check=='no')
									{
				?>
										<!-- <tr>
											<td></td><td></td>
											<td></b></td>
											<td><b class="money"><?php// echo $TOTAL_daily;  ?></td>
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
									$item_total_daily = $result['out_quantity'];
									$TOTAL_daily = $item_total_daily;
									$first_row_check='no';
								}
								else
								{
									$item_total_daily = $result['out_quantity'];
									$TOTAL_daily = $TOTAL_daily + $item_total_daily;
								}
				?>
								<tr>
									<td> <?php echo $result['product_name']; ?> </td>
									<td> <?php echo $result['product_category']; ?> </td>

									<td class="money"> <?php echo $result['out_quantity']; ?> </td>

									<td class="money"> 
										<?php echo $item_total; ?>
									</td>
									
									<td class="money" ><?php echo $cat_label; ?></td>
								</tr>
							
				<?php 
								
							}
				?>
						
				<?php
					}
				?>
			</tbody>
			</div>	
		</table>
	</div>
	</div>

<?php $this->load->view('rf/main_parts/footer'); ?>







