<?php
	$_SESSION['page_name']='user';
	$this->load->view('rf/main_parts/header');  // call header 
?> 	
	<div class="miniMenu">
		<?php 	$this->load->view('rf/pages/user/user_page_blocks/miniMenu'); ?>
	</div>
	<div class="menu">
		<?php	$this->load->view('rf/main_parts/menu'); ?>
	</div>

<?php

	$error = isset($error) ? $error : '';
	$the_search =isset($the_search) ? $the_search : '';
	$errorSearch = isset($errorSearch) ? $errorSearch : '';
?>

<div id="table_box">
	<div class="tables">
		<h3 id="faux"><?php echo $errorSearch; ?> </h3>
		<h1 id="vrai">Users</h1>
		<table class="Search">
			<form method="post" action="<?php echo base_url() ?>rf/user/userController/search_c" >
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
	<h1>List of Users</h1>
	<table>
		<div id="cont">
		<thead>
			<tr>
				<th> First name </th>
				<th> Last name </th>
				<th> Role     </th>
				<th> Telephone </th>
				<th> Edit </th>
			</tr>
		</thead>
		<tbody>

			<?php
			// print_r($all_user);
				if (isset($all_user)) 
				{
					foreach ($all_user as $result) // get row by row data to avoid array 
					{

						if ($result['role_percentage'] != 100 ) 
						{
			?>
						<tr>
							<td> <?php echo $result['user_first_name']; ?> </td>
							<td> <?php echo $result['user_last_name']; ?> </td>
							<td> <?php echo $result['role_name']; ?> </td>
							<td> <?php echo $result['user_mobile']; ?> </td>
							<td>
								<form method="post" action="<?php echo base_url() ?>rf/user/userController/users_find_list_c" >
									<input type="submit" value="Edit" name="edit_button">
									<input type="hidden" name="reg_id" value="<?php echo $result['user_id'];  ?> "/>
								</form>
							</td>
						</tr>
					
			<?php 
						}
					}
				}
			?>








			<?php
			// print_r($all_user);
				if (isset($all_user2)) 
				{
					foreach ($all_user2 as $result2) // get row by row data to avoid array 
					{

						if ($result2['role_percentage'] != 100 ) 
						{
			?>
						<tr>
							<td> <?php echo $result2['user_first_name']; ?> </td>
							<td> <?php echo $result2['user_last_name']; ?> </td>
							<td> <?php echo $result2['role_name']; ?> </td>
							<td> <?php echo $result2['user_mobile']; ?> </td>
							<td>
								<form method="post" action="<?php echo base_url() ?>rf/user/userController/users_find_list_c" >
									<input type="submit" value="Edit" name="edit_button">
									<input type="hidden" name="reg_id" value="<?php echo $result2['user_id'];  ?> "/>
								</form>
							</td>
						</tr>
					
			<?php 
						}
					}
				}
			?>
		</tbody>
		</div>	
	</table>
</div>
</div>



<?php $this->load->view('rf/main_parts/footer'); ?>