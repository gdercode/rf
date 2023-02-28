<?php
	$_SESSION['page_name']='stock';
	$this->load->view('rf/main_parts/header');  // call header
?> 	
	<div class="miniMenu">
		<?php $this->load->view('rf/pages/stock/stock_page_blocks/miniMenu'); ?>
	</div>
	
	<div class="menu">
		<?php	$this->load->view('rf/main_parts/menu');  ?>
	</div>
<?php
$error = isset($error) ? $error : '';

$the_search =isset($the_search) ? $the_search : '';

$errorSearch = isset($errorSearch) ? $errorSearch : '';
$errorMessage = isset($errorMessage) ? $errorMessage : '';

?>

<div id="table_box">
	<div class="tables">
		<h3 id="faux"><?php echo $errorSearch; ?> </h3>
		<h1 id="vrai">STOCK</h1>
		<table class="Search">
			<form method="post" action="<?php echo base_url() ?>rf/stock/stockController/search_c" >
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
		<h1>STOKE</h1>
		<table>
			<div id="cont">
			<thead>
				<tr>
					<th> Name </th>
					<th> Category </th>
					<th> quantity </th>
					<th></th> 
				</tr>
			</thead>
			<tbody>
				<?php
					if (isset($all_stock)) 
					{
						foreach ($all_stock as $result)  
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
								<td class="money" > 
									<?php 
										if ($result['stock_prod_quantity']<=0)
										{
											echo '<b id="faux">'.$result['stock_prod_quantity'].'</b>';
										}
										else
										{
											echo '<b id="vrai">'.$result['stock_prod_quantity'].'</b>';
										}

										
									?> 	
								</td>
								<td class="money" ><?php echo $cat_label; ?></td>
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







