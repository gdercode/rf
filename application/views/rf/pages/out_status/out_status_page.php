<?php
	$_SESSION['page_name']='out_status';
	$this->load->view('rf/main_parts/header');  // call header
?> 	
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

// if (isset($all_out_status))
// {

// 	foreach ($all_out_status as $result)  
// 	{
// 		$cat = trim($result['product_category']);
// 	}
// }



?>

<div id="table_box">
	<div class="tables">
		<h3 id="faux"><?php echo $errorSearch; ?> </h3>
		<h1 id="vrai">COUNT</h1>
		<table class="Search">
			<form method="post" action="<?php echo base_url() ?>rf/out_status/out_statusController/search_c" >
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
		<h1>ALL</h1>
		<table>
			<div id="cont">
			<thead>
				<tr>
					<th> Name </th>
					<th> Category </th>
					<th> Repetition </th>
				</tr>
			</thead>
			<tbody>
				<?php
					$new_day = '';
					if (isset($all_out_status)) 
						{

							foreach ($all_out_status as $result)  
							{
?>
								<tr>
									<td> <?php echo $result['product_name']; ?> </td>
									<td> <?php echo $result['product_category']; ?> </td>
									<td id="money" class="money"> <?php echo $result['total']; ?> </td>
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







