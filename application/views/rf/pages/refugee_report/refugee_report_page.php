<?php
	$_SESSION['page_name']='refugee_report_page';
	$this->load->view('rf/main_parts/header');  // call header
?> 	

	<div class="menu">
		<?php	$this->load->view('rf/main_parts/menu'); 	  
		?> 
	</div>
<?php
$error = isset($error) ? $error : '';
$errorSearch = isset($errorSearch) ? $errorSearch : '';
$errorMessage = isset($errorMessage) ? $errorMessage : '';
$refugee_name = isset($refugee_name) ? $refugee_name : '';

$the_search =isset($the_search) ? $the_search : '';


?>

<div id="table_box">
	<div class="tables">
		<h3 id="faux"><?php echo $errorSearch; ?> </h3>
		<h1 id="vrai">COUNT</h1>
		<table class="Search">
			<form method="post" action="<?php echo base_url() ?>rf/refugee_report/refugee_report_Controller/search_c" >
				
				<td >
					<select name="refugee_selection"  class ="role_name_selection">
	
						<option  value="none" <?php echo set_select('refugee_selection','none')  ?>></option>
						<?php 
							if (isset($all_refugee)) 
							{
								foreach($all_refugee as $user)
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
				<td >
					<input type="date" name="reg_out_date1" class="table_input" >
				</td>
				<td >
					<input type="date" name="reg_out_date2" class="table_input" >  
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
		<h1>Refugee Name</h1>
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


								$refugee_name = $result['user_first_name'].' &nbsp; &nbsp;'.$result['user_last_name'];
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
											<td><b class="money"><?php //echo $TOTAL_daily;  ?></td>
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
					}
				?>

				<h1 id="vrai"><?php echo $refugee_name; ?></h1>
			</tbody>
			</div>	
		</table>
	</div>
	</div>

<?php $this->load->view('rf/main_parts/footer'); ?>







