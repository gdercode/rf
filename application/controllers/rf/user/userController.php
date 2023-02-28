<?php
class UserController extends CI_Controller 
{

	public function __construct() // constructor
 	{
	 	parent::__construct();   // for parent class
	 	$this->load->database();	 // for database
	 	$this->load->helper(array('form','url','gderfileupload')); // for url and form
	 	$this->load->library(array('form_validation'));	 // for form validation  
	 	$this->load->model('rf/rf_model','rfManager');  

	 	$needed = $this->session->userdata('userpagePermit');
		$this->check_user_page_permit($needed);
	}

//--------------------------------------------------------------------------------------------------------------------------------------

	private function check_user_page_permit($need)
	{
		$permit = $this->session->userdata('permit');	// keep in variable permit session
		$needed = $need;					// keep in variable needed permit session
		if (!$permit)     	 // if there is no permit session 
		{
			redirect('rf/rfController/logout_c'); // go back to logout controller 
		}
		elseif ($permit<$needed) // if permit session is there but less than the needed
		{
			redirect('rf/rfController/home_c');		// go back to homepage controller 	
		}
	}

//------------------------------------------------------------------------------------------------------------------------------------

	public function index() 
	{
		$this->session->set_userdata('mini_page_name', '');
		$this->welcome();													// go to welcome function down below
	}

//-----------------------------------------------------------------------------------------------------------------------------------

	private function welcome()  // private function for user page
	{
		$data['all_user']=$this->rfManager->get_all_user();
		$this->load->view('rf/pages/user/user_page',$data);							// load a user page 
	}
//-------------------------------------------------------------------------------------------------------------------------------------- 


//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

	public function users_list_c()
	{
		$data['all_user']=$this->rfManager->get_all_user(); 	// for come back to list page

		$this->load->view('rf/pages/user/user_list_page',$data); 				 // go to the user_list_page with data array of all users 
	}	

//--------------------------------------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------------------------------------

	public function roles_list_c()
	{
		$data['all_role']=$this->rfManager->get_all_role(); 									// for come back to list page

		$this->load->view('rf/pages/user/role_list_page',$data); 				 // go to the user_list_page with data array of all users
	}	

//--------------------------------------------------------------------------------------------------------------------------------------

	public function users_find_list_c()
	{
		$data['allRolles'] = $this->rfManager->get_all_role();          // for roles
		$user_id = htmlspecialchars(trim( $this->input->post('reg_id')));
		$data['the_user'] = $this->rfManager->get_user_id($user_id); 		 
 		$data['all_user']=$this->rfManager->get_all_user();

		if(empty( $data['the_user'] ))	 
		{
		 	$data['error']="User not found"; 
		 	$this->load->view('rf/pages/user/user_list_page',$data);  // go to the user_list_page with data array of all users
		}
		else  // user exist							
		{
			$this->load->view('rf/pages/user/manipulate_user_page',$data);  			// go to the manipulate_user page with data
		}
	}

//--------------------------------------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------------------------------------

	public function role_find_list_c()
	{
		$role_id = htmlspecialchars(trim( $this->input->post('role_id')));
		$data['the_role'] = $this->rfManager->get_role_id($role_id); 		
			$data['all_role']=$this->rfManager->get_all_role();

		if(empty( $data['the_role'] ))						// no role existance, then we have to give back a message
		{
		 	$data['error']="No role found"; 
		 	$this->load->view('rf/pages/user/role_list_page',$data);  // go to the role_list_page with data array of all users
		}
		else 																// role exist							
		{
			$this->load->view('rf/pages/user/manipulate_role_page',$data);  			// go to the manipulate_role page with data
		}
	}

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

	public function browse_user_c() 																// browse_user
	{
		$data['allRolles'] = $this->rfManager->get_all_role();

		$this->form_validation->set_rules('username', 'User Name', 'trim|required|min_length[1]|max_length[50]'); // rules for username;

        if ($this->form_validation->run() == FALSE) 													// if validation fail
        {
            $this->load->view('rf/pages/user/browse_user_page',$data); 				 // go back to the browse_user_page page with data
        }
        else 																								// if yes 
        {
			$username = htmlspecialchars(trim( $this->input->post('username') )); 					// remove tags for security

         	// check the existance of username
			$data['the_user'] = $this->rfManager->get_user($username);  						// get all of User by username

			if(empty( $data['the_user'] ))						// no user existance, then we have to give back a message
			{
				$data['error']="No user found"; 										// set a error message
			 	$this->load->view('rf/pages/user/browse_user_page',$data);	 // return to browse_user_page with error or success message
			}
			else 																// user exist							
			{
				$this->load->view('rf/pages/user/manipulate_user_page',$data);  			// go to the manipulate_user page with data
			}
        }
	}

//--------------------------------------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------------------------------------

	public function manipulate_user_c()
	{
		$data['allRolles'] = $this->rfManager->get_all_role();
		
		if ($this->input->post('update_button'))
		{
			// set form rules

			$this->form_validation->set_rules('reg_firstname', 'First name', 'trim|required|alpha_numeric|min_length[2]|max_length[50]'); 
			$this->form_validation->set_rules('reg_lastname', 'Last name', 'trim|alpha_numeric|required|min_length[2]|max_length[50]');  
			$this->form_validation->set_rules('reg_username', 'Username', 'trim|required|min_length[2]|max_length[50]');  
	        $this->form_validation->set_rules('reg_email', 'Email', 'trim|valid_email'); 								
			$this->form_validation->set_rules('reg_password', 'Password', 'trim|min_length[2]'); 		
	        $this->form_validation->set_rules('reg_mobile', 'Telephone', 'trim|required|regex_match[/^\+(?:[0-9] ?){6,14}[0-9]$/]');  

			// remove tags for security
			$user_id=htmlspecialchars(trim( $this->input->post('reg_id') ));
			$firstname=htmlspecialchars(trim( $this->input->post('reg_firstname') ));
			$lastname=htmlspecialchars(trim( $this->input->post('reg_lastname') ));
			$username=htmlspecialchars(trim( $this->input->post('reg_username') ));
			$email=htmlspecialchars(trim( $this->input->post('reg_email') ));
			$mobile=htmlspecialchars(trim( $this->input->post('reg_mobile') )); 

			$password = !empty( $this->input->post('reg_password') ) ? htmlspecialchars(trim( $this->input->post('reg_password') )) : '';

			$role_id_form = htmlspecialchars(trim( $this->input->post('role_name_selection') )); 
			$role_id = $role_id_form;

			// set the data array needed on the manupilate user page ( form )
			$data['the_user'] = array(
							'user_id' => $user_id,
							'user_first_name' => $firstname,
							'user_last_name' => $lastname,
							'username' => $username,
							'user_email' => $email,
							'user_password' => $password,
							'user_mobile' => $mobile,
							'user_role_id' => $role_id
						);
 
	        if ($this->form_validation->run() == FALSE) 	 // if validation fail
	        {
	        	$data['error']="Recheck Your form"; 
	        }
	        else 		// if yes 
	        {
	        	$user =  $this->rfManager->get_user_id($user_id); // get a User by id

	        	if (empty($user)) 
	        	{
	        		$data['error']="User not found";
	        	}
	        	else
	        	{
					if (empty($password))	 // no password set from form
					{
						
						
						$data['pass_message']="Password not changed";  // set a message for password field 

						if ($role_id_form == 'none')
						{
							//update a user without password and role
							$data['select_error'] = "Role note changed";
							$this->rfManager->update_user_no_password_and_role($user_id,$firstname,$lastname,$email,$mobile,$username); 
							$data['error']="Updated successfully"; 	 // set a success message
						}
						else
						{
							//update a user without password
							$this->rfManager->update_user_no_password($user_id,$firstname,$lastname,$email,$mobile,$username,$role_id); 
							$data['error']="Updated successfully"; 	 // set a success message
						}
					}
					else
					{
						$hashed_pass = password_hash($password, PASSWORD_DEFAULT);  // encrypt password for security

						if ($role_id_form == 'none')
						{
							//update a user without role
							$data['select_error'] = "Role not changed";
							$this->rfManager->update_user_no_role($user_id,$firstname,$lastname,$email,$mobile,$username,$hashed_pass);
							$data['error']="Updated successfully";  	// set a success message
						}
						else
						{
							// update user all fields
							$this->rfManager->update_user($user_id,$firstname,$lastname,$email,$mobile,$username,$hashed_pass,$role_id);
							$data['error']="Updated successfully"; 	 // set a success message
						}
						
					}
				}
	        }
		}
		elseif ($this->input->post('delete_button'))
		{
			$user_id=htmlspecialchars(trim( $this->input->post('reg_id') ));

			$user =  $this->rfManager->get_user_id($user_id);  						// get a User by id
			if (empty($user)) 
	        {
	        	$data['error']="No user found"; 										// set a error message
	        }
	        else
	        {
	        	$this->rfManager->delete_user($user_id); 							// delete a user
				$data['error']="Deleted successfully"; 					// set a success message
			}
		}
		$this->load->view('rf/pages/user/manipulate_user_page',$data);			// go back to manipulate_user page with data
	}



//-----------------------------------------------------------------------------------------------------------------------------------

public function manipulate_role_c()
	{
		if ($this->input->post('update_button'))
		{
			// set form rules

			$this->form_validation->set_rules('role_name', 'Role Name', 'trim|required|min_length[2]|max_length[50]'); 
			$this->form_validation->set_rules('role_percentage', 'Role Percentage', 'trim|numeric|required|min_length[2]|max_length[50]');  

			// remove tags for security
			$role_id=htmlspecialchars(trim( $this->input->post('role_id') ));
			$role_name=htmlspecialchars(trim( $this->input->post('role_name') ));
			$role_percentage=htmlspecialchars(trim( $this->input->post('role_percentage') ));

			// set the data array needed on the manupilate role page ( form )
	        $data['the_role'] = array(
	        							'role_id' => $role_id,
	        							'role_name' => $role_name,
        								'role_percentage' => $role_percentage
        							);

	        if ($this->form_validation->run() == FALSE) 												// if validation fail
	        {
	        	$data['error']="Recheck Your form"; 
	        }
	        else 				// if yes 
	        {
	        	$role =  $this->rfManager->get_role_id($role_id);  						// get a role by id

	        	if (empty($role)) 
	        	{
	        		$data['error']="No Role found"; 										// set a error message
	//			 	$this->load->view('rf/pages/user/browse_role_page',$data); // return to browse_role_page with error or success message
	        	}
	        	else
	        	{
					//update a role
					$this->rfManager->update_role($role_id,$role_name,$role_percentage); 
					$data['error']="Role updated successfully"; 							// set a success message
				}
	        }
		}
		elseif ($this->input->post('delete_button'))
		{
			$role_id=htmlspecialchars(trim( $this->input->post('role_id') ));

			$role =  $this->rfManager->get_role_id($role_id);  						// get a role by id
			if (empty($role)) 
	        {
	        	$data['error']="No role found"; 										// set a error message
	        }
	        else
	        {
	        	$this->rfManager->delete_role($role_id); 							// delete a role
				$data['error']="role Deleted successfully"; 					// set a success message
			}
		}
		
		$this->load->view('rf/pages/user/manipulate_role_page',$data);
	}

//-----------------------------------------------------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------------------------------------------------
	public function add_user_c() 											// add a new user
	{
		$data['allRolles'] = $this->rfManager->get_all_role();
		// set rules for form validation 
			
		$this->form_validation->set_rules('reg_firstname', 'First name', 'trim|required|alpha_numeric|min_length[2]|max_length[50]'); 
		$this->form_validation->set_rules('reg_lastname', 'Last name', 'trim|alpha_numeric|required|min_length[2]|max_length[50]');  
		$this->form_validation->set_rules('reg_username', 'Username', 'trim|required|min_length[2]|max_length[50]');  
        $this->form_validation->set_rules('reg_email', 'Email', 'trim|valid_email');
		$this->form_validation->set_rules('reg_password', 'Password', 'trim|required|min_length[2]'); 
        $this->form_validation->set_rules('reg_conf_password', 'Password Confirmation', 'trim|required|matches[reg_password]'); 
        $this->form_validation->set_rules('reg_mobile', 'Telephone', 'trim|required|regex_match[/^\+(?:[0-9] ?){6,14}[0-9]$/]');

        if ($this->form_validation->run() == FALSE) 									// if validation fail
        {
        	// nothing to do you will go back to the form
        }
        else 																				// if yes 
        {
         	// remove tags for security
			$firstname=htmlspecialchars(trim( $this->input->post('reg_firstname') ));
			$lastname=htmlspecialchars(trim( $this->input->post('reg_lastname') ));
			$username=htmlspecialchars(trim( $this->input->post('reg_username') ));
			$email=htmlspecialchars(trim( $this->input->post('reg_email') ));
			$password=htmlspecialchars(trim( $this->input->post('reg_password') ));
			$mobile=htmlspecialchars(trim( $this->input->post('reg_mobile') )); 
			$role_id_form = htmlspecialchars(trim( $this->input->post('role_name_selection') )); 

			if ($role_id_form == 'none')
			{
				$data['select_error'] = "Select role";
			}
			else
			{
				$role_id = $role_id_form;


				// check the existance of the username or email
				$row=$this->rfManager->get_user($username);  // get user with this username
				
				$row_two=$this->rfManager->get_user_email($email); // get user with this email

				$row_three=$this->rfManager->get_user_phone($mobile); // get user with this email

				if($row) // username exist
				{
					// we have to give error message for user existance
					$data['error']="Username taken by an other User";
				}
				elseif($row_two) // email exist
				{
					// we have to give error message for email existance
					$data['error']="This Email already exists";
				}
				elseif($row_three) // phone exist
				{
					// we have to give error message for phone existance
					$data['error']="Phone number belongs to another User";
				}
				else // no username or email or phone existance, then we have to register new user
				{
					$hashed_pass = password_hash($password, PASSWORD_DEFAULT);  // encrypt password for security
					$this->rfManager->insert_users($firstname,$lastname,$email,$mobile,$username,$hashed_pass,$role_id); // register a user
					$data['error']="User created successfully"; 												// set a success message
				}	
			}
			
			
        }
        $this->load->view('rf/pages/user/registration_page',$data);	 // return to registration page with error or success message
	}

//------------------------------------------------------------------------------------------------------------------------------------

	public function add_role_c() 											// add a new role
	{

			// set rules for form validation 
			$this->form_validation->set_rules('role_name', 'Role Name', 'trim|required|min_length[1]|max_length[50]'); 
			$this->form_validation->set_rules('role_percentage', 'Role Percentage', 'trim|required|numeric|min_length[2]|max_length[50]'); 

	        if ($this->form_validation->run() == FALSE)								 // if validation fail
	        {
	        	$data['error'] = ''; // nothing to do , you will go back to the form 
	        }
	        else    			// if yes 
	        {
		         	// remove tags for security
				$role_name=htmlspecialchars(trim( $this->input->post('role_name') ));
				$role_percentage=htmlspecialchars(trim( $this->input->post('role_percentage') ));

				// check the existance of the role_name
				$row=$this->rfManager->get_role($role_name);  // get role with this roleId

				if(empty($row)) // no Role existance, then we have to create a new role
				{
					$this->rfManager->insert_role($role_name,$role_percentage); // insert a new role
					$data['error']="A New Role created successfully"; // set a success message
				}
				else // role ID exist
				{
					// we have to give error message for role existance
					$data['error']="This Role already exists";
				}	
				
	        }
	        $this->load->view('rf/pages/user/create_role_page',$data);	 // return to registration page with error or success message
	}


//------------------------------------------------------------------------------------------------------------------------------------


	public function browse_role_c() 											// browse_role
	{
		$this->form_validation->set_rules('role_name', 'Role Name', 'trim|required|min_length[1]|max_length[12]'); // rules for username;

        if ($this->form_validation->run() == FALSE) 													// if validation fail
        {
            $this->load->view('rf/pages/user/browse_role_page'); 				 // go back to the browse_role_page with data
        }
        else 																								// if yes 
        {
			$role_name = htmlspecialchars(trim( $this->input->post('role_name') )); 					// remove tags for security

         	// check the existance of role
			$data['the_role'] = $this->rfManager->get_role($role_name);  						// get all of role by role_name

			if(empty( $data['the_role'] ))						// no role existance, then we have to give back a message
			{
				$data['error']="No role found"; 										// set a error message
			 	$this->load->view('rf/pages/user/browse_role_page',$data);	 // return to browse_user_page with error or success message
			}
			else 																// role exist							
			{
				$this->load->view('rf/pages/user/manipulate_role_page',$data);  			// go to the manipulate_user page with data
			}
        }
	}


//--------------------------------------------------------------------------------------------------------- 
//--------------------------------------------------------------------------------------------------------- 
	public function search_c()
	{
		$data['errorSearch']='';
		
		$prod_name = htmlspecialchars(trim( $this->input->post('reg_prod_name')));
		
		$get_user_first_name = $this->rfManager->get_user_first_name($prod_name);
		$get_user_last_name = $this->rfManager->get_user_last_name($prod_name);

		if (!empty($get_user_first_name) AND !empty($get_user_last_name)) 
		{
			$data['all_user'] = $get_user_first_name;
			$data['all_user2'] = $get_user_last_name;
		}
		elseif (!empty($get_user_first_name))
		{
			$data['all_user'] = $get_user_first_name;
		}
		elseif (!empty($get_user_last_name))
		{
			$data['all_user'] = $get_user_last_name;
		}
		else
		{
			$data['errorSearch']='No user Found';
		}


		$data['the_search'] = $prod_name ;
		$this->load->view('rf/pages/user/user_page',$data); 
	}

//---------------------------------------------------------------------------------------------------------- 
//----------------------------------------------------------------------------------------------------------

//===========================================================================================================================================

}
?>