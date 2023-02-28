<?php
class rfController extends CI_Controller  						// main controller
{
	public function __construct()									// constructor
 	{
	 	parent::__construct();  									// for parent class
	 	$this->load->database();									// for database
	 	$this->load->helper(array('form','url'));					// for url and form
	 	$this->load->library(array('form_validation'));				// for form validation  
	 	$this->load->model('rf/rf_model','rfManager');		// for model with an other name
	 	
	 	$this->session->set_userdata('userpagePermit', '90');
	 	$this->session->set_userdata('count_in_stockpagePermit', '90');
	 	$this->session->set_userdata('count_out_stockpagePermit', '90');
	 	$this->session->set_userdata('out_statuspagePermit', '90');
	 	$this->session->set_userdata('productpagePermit', '80');
	 	$this->session->set_userdata('in_stockpagePermit', '70');
	 	$this->session->set_userdata('stockpagePermit', '60');
	 	$this->session->set_userdata('out_stockpagePermit', '50');
	 	$this->session->set_userdata('homepagePermit', '1');

	 	$this->add_super_admin();
	}

//---------------------------------------------------------------------------------
	
// add superAdmin by default if he is not there.
	 private function add_super_admin()
	 {
	 	$firstname='superAdmin';
		$lastname= 'superAdmin';
		$username='superAdmin';
		$email='superAdmin@gmail.com';
		$password='superAdmin';
		$mobile=''; 
		$role_id='1';
		$role_name = 'superAdmin';
		$role_percentage = 100;

		$userData=$this->rfManager->get_user($username);	// get user with this username 
		if(empty($userData)) 							//if row is empty = no username found,
		{
			$roleData = $this->rfManager->get_role($role_name); 
			if (empty($roleData)) 
			{
				$this->rfManager->insert_role($role_name,$role_percentage);// register a superAdmin role by default first
			}
			else
			{
				$role_id = $roleData['role_id'];
			}

			$hashed_pass = password_hash($password, PASSWORD_DEFAULT); 
			$this->rfManager->insert_users($firstname,$lastname,$email,$mobile,$username,$hashed_pass,$role_id); 
		}
	 }

//---------------------------------------------------------------------------------

	
	private function check_home_page_permit($need)
	{
		$permit = $this->session->userdata('permit'); // keep in variable permit session
		$needed = $need;				 // keep in variable needed permit session
		if (!$permit)     		 // if there is no permit session 
		{
			redirect('rf/rfController/logout_C'); // go back to logout controller 
			return;
		}
		elseif ($permit<$needed) 
		{
			redirect('rf/rfController/logout_C');			// go back to logout controller 	
			return;
		}			
	}
//-------------------------------------------------------------------------------

	public function index()  										// index function
	{
		$this->session->set_userdata('mini_page_name', '');
		$this->login_C(); 
		return;
	}

//--------------------------------------------------------------------------------------

	public function logout_c()  										// logout_C function
	{
		 if (session_status() === PHP_SESSION_ACTIVE) 
		 {
		  	$this->session->unset_userdata('userpagePermit', '80');
	 		$this->session->unset_userdata('rfpagePermit', '50');
	 		$this->session->unset_userdata('homepagePermit', '10');
		 	$this->session->unset_userdata('permit');
		 	$this->session->unset_userdata('user');
		 	$this->session->unset_userdata('user_details');
		 } 
		 elseif (session_status() === PHP_SESSION_NONE) 
		 {
		  	echo "No session";
		 } 

		$this->load->view('rf/pages/logout_page');				// load a logout page 
	}

//------------------------------------------------------------------------

	public function login_C()  		 // login function
	{
		$permit = $this->session->userdata('permit'); // keep in variable permit session
		if ($permit)     		 // if there is permit session 
		{
			$this->home_c();	 // go directly to home_c function
			return;
		}

		$this->form_validation->set_rules('log_username','Username','trim|required|min_length[2]|max_length[50]'); 		
	 	$this->form_validation->set_rules('log_password', 'Password', 'trim|required|min_length[2]'); 	// rules for password

		if ($this->form_validation->run() == FALSE)	 // if validation fail
		{
			$data['error'] = "You are out";
			$this->load->view('rf/pages/login_page',$data); 
			return;
		}
		else 		//if yes
		{
			// remove tags for security
			$username=htmlspecialchars(trim( $this->input->post('log_username') ));
			$password=htmlspecialchars(trim( $this->input->post('log_password') ));

			// check the existance of a username
			$row = $this->rfManager->get_user($username);	  
			if(empty($row))  //if row is empty = no username found,
			{
				$data['error']="This user does not exist";	 // we give error message
				$this->load->view('rf/pages/login_page',$data);	 
				return;
			}
			else 											// if yes there is that username
			{
				$pass_from_db = $row['user_password']; 		//get user_password from database into a variable
						
				// check correct password 
				if (!password_verify($password, $pass_from_db ))	// if both password are not the same (decrypt and compare)
				{
					$data['error']="Wrong password"; 			// error message for wrong password
					$this->load->view('rf/pages/login_page',$data);	// go to the login page with data
					return;
				}
				else 						// if passwords are the same
				{
					$userRole = $this->rfManager->get_user_permit($username);
					$this->session->set_userdata('permit', $userRole['role_percentage']); //your permmitions in the system
					$this->session->set_userdata('user', $username);		 // set session for all pages
					$this->session->set_userdata('user_details', $userRole);	// set user details session for all pages

					$this->home_c();	 	// then you will be redireceted to home_page 
					return;
				}
			}
			return;
		}

	}

//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------

//--------------------------------------------------------------------------------

	Public function home_C()         							  // homepage function
	{
		$needed = $this->session->userdata('homepagePermit');		// needed permit for homepage
		$this->check_home_page_permit($needed);		// check homepage permit

		$this->load->view('rf/pages/home_page');		// load a home page 
		return;
	}

// --------------------------------------------------------------------------------- 
// --------------------------------------------------------------------------------- 
// --------------------------------------------------------------------------------- 
// ------------------------ --------------------------------------------------------
	
	Public function user_pg_controller() // user_pg_controller function
	{
		redirect('rf/user/userController'); // go to user controller
	}

// -----------------------------------------------------------------------------------

	Public function product_pg_controller()	 
	{
		redirect('rf/product/productController'); 
	}

// -----------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------

	Public function in_stock_pg_controller()	  
	{
		redirect('rf/in_stock/in_stockController'); 
	}

// -----------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------

	Public function stock_pg_controller()	 
	{
		redirect('rf/stock/stockController'); 
	}

// -----------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------

	Public function out_stock_pg_controller()	 
	{
		redirect('rf/out_stock/out_stockController'); 
	}

// -----------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------

	Public function count_in_stock_pg_controller()	 
	{
		redirect('rf/count_in_stock/count_in_stockController'); 
	}

// -----------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------

	Public function count_out_stock_pg_controller()	 
	{
		redirect('rf/count_out_stock/count_out_stockController'); 
	}

// -----------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------

	Public function out_status_pg_controller()	 
	{
		redirect('rf/out_status/out_statusController'); 
	}

// -----------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------

	Public function user_report_pg_controller()	 
	{
		redirect('rf/user_report/user_report_Controller'); 
	}

// -----------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------

	Public function refugee_report_pg_controller()	 
	{
		redirect('rf/refugee_report/refugee_report_Controller'); 
	}

// -----------------------------------------------------------------------------------




}

?>