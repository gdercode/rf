<?php
	$_SESSION['page_name']='user';
	$this->load->view('rf/main_parts/header');  // call header 
?> 	
	<div class="menu">
		<?php	$this->load->view('rf/main_parts/menu'); 	// call menu ?> 
	</div>
<?php
	$error = isset($error) ? $error : '';
?>

<div id="table_box">
<div class="tables">
	<h3><?php echo $error; ?> </h3>
	<h1>List of Users</h1>
	<table>
		<div id="cont">
		<thead>
			<tr>
				<th> First Name </th>
				<th> Last Name  </th>
				<th> Role     </th>
				<th> Mobile     </th>
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
			?>
		</tbody>
		</div>	
	</table>
</div>
</div>



<?php $this->load->view('rf/main_parts/footer'); ?>