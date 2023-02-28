<?php
	$_SESSION['page_name']='user';
	$this->load->view('rf/main_parts/header');  // call header 
?> 	
	<div class="menu">
		<?php	$this->load->view('rf/main_parts/menu'); 	// call menu ?> 
	</div>
<?php
		
		$error = isset($error) ? $error : '';
		$pass_message = isset($pass_message) ? $pass_message : '';
		$select_error = isset($select_error) ? $select_error : '';

		$id = isset($the_user) ? $the_user['user_id'] : ''; 
		$FN = isset($the_user) ? $the_user['user_first_name'] : ''; 
		$LN = isset($the_user) ? $the_user['user_last_name'] : ''; 
		$UN = isset($the_user) ? $the_user['username'] : ''; 
		$e  = isset($the_user) ? $the_user['user_email'] : ''; 
		$p  = isset($the_user) ? $the_user['user_password'] : ''; 
		$m  = isset($the_user) ? $the_user['user_mobile'] : ''; 
		$r  = isset($the_user) ? $the_user['user_role_id'] : '';   
?>

<div id="logContainer_browse">

	<div id="registerBox">

		<h1>Edit User</h1>

		<form id="registerForm" method="post" action="<?php echo base_url() ?>rf/user/userController/manipulate_user_c" > 
			 <h3><?php echo $error; ?> </h3>

			 <input type="hidden" name="reg_id" value="<?php echo $id;  ?> "/>

			<p>	
				<h5><?php echo form_error('reg_firstname'); ?></h5>
				<input type="text" name="reg_firstname" value="<?php echo $FN;  ?>" placeholder="First name" />
			</p>
			<p>	
				<h5><?php echo form_error('reg_lastname'); ?></h5>
				<input type="text" name="reg_lastname" value="<?php echo $LN; ?>" placeholder="Last name " />
			</p>
			<p>	
				<h5><?php echo form_error('reg_username'); ?></h5>
				<input type="text" name="reg_username" value="<?php echo $UN; ?>" placeholder="Username" />
			</p>
			<p>	
				<h5><?php echo form_error('reg_email'); ?></h5>
				<input type="text" name="reg_email" value="<?php echo $e; ?>" placeholder="Email" />
			</p>


			<p>
				<h5><?php echo form_error('reg_password'); ?></h5>
				<h5><?php echo $pass_message; ?></h5>
				<input type="password" name="reg_password" placeholder="password" />
			</p>
			
			<p>

				<h5><?php echo form_error('reg_mobile'); ?></h5>
				<input type="text" name="reg_mobile" value="<?php echo $m;  ?>" placeholder="Telephone" />
			</p>

			<p>
				 Role <br> <h5><?php echo $select_error; ?> </h5>
				<select name="role_name_selection"  class ="role_name_selection">
				
					<option value="none" <?php echo set_select('role_name_selection','none')  ?> ></option>
					<?php 
						if (isset($allRolles)) 
						{
							foreach($allRolles as $role)
							{
								if ($role['role_percentage'] != 100 )
								{
					?>
								<option 
										value=<?php echo $role['role_id']; ?> 
										<?php echo set_select('role_name_selection',$role['role_id']) ; ?>   >

										<?php echo $role['role_name']; ?> 
								</option>
					<?php
								
								}
							}
						}
					?>
				</select>
			</p>

			<p><input type="submit" name="update_button" value="Update User" > </p>
			<p><input type="submit" name="delete_button" value="Delete User" > </p>
		</form>

	</div>

</div>

<?php $this->load->view('rf/main_parts/footer'); ?>