<?php
class user_report_Controller extends CI_Controller
{
	public function __construct() // constructor
 	{
	 	parent::__construct();   // for parent class
	 	$this->load->database();	 // for database
	 	$this->load->helper(array('form','url')); // for url and form
	 	$this->load->library(array('form_validation'));	 // for form validation  
	 	$this->load->model('rf/count_out_stock_model','count_out_stockManager');
	 	$this->load->model('rf/stock_model','stockManager');
	 	$this->load->model('rf/rf_model','rfManager');   

	 	$needed = $this->session->userdata('out_statuspagePermit');
		$this->check_out_statuspagePermit($needed);
	}

//--------------------------------------------------------------------------------------------------------------------------------------

	private function check_out_statuspagePermit($need)
	{
		$permit = $this->session->userdata('permit'); // keep in variable permit session
		$needed = $need; // keep in variable needed permit session
		if (!$permit)     	 // if there is no permit session 
		{
			redirect('rf/rfController/logout_c'); // go back to logout controller 
		}
		elseif ($permit<$needed) // if permit session is there but less than the needed
		{
			redirect('rf/rfController/home_c'); // go back to homepage controller 	
		}
	}

//------------------------------------------------------------------------------------------------------------------------------------

	public function index() 
	{
		$this->session->set_userdata('mini_page_name', '');
		$this->welcome(); 	
	}

//-----------------------------------------------------------------------------------------------------------------------------------

	private function welcome()  // private function for user page
	{
		$data['all_user']=$this->rfManager->get_all_user();
		$this->load->view('rf/pages/user_report/user_report_page',$data); // load product page 
	}
//------------------------------------------------------------------------------------------- 
// ----------------------------------------------------------------------------------------- 
	public function search_c()
	{
		$data['all_user']=$this->rfManager->get_all_user();

		$this->session->set_userdata('mini_page_name', '');

		$data['errorMessage']='';
		
		$all_count_out_stock=array();
		$out_date1 = htmlspecialchars(trim( $this->input->post('reg_out_date1')));
		$out_date2 = htmlspecialchars(trim( $this->input->post('reg_out_date2')));
		$user_id = htmlspecialchars(trim( $this->input->post('refugee_selection')));


		if ($user_id=='none')
		{
			$data['errorSearch']='Select User';
		}
		else
		{
			$get_out_date = $this->count_out_stockManager->get_all_out_prod_by_user($user_id, $out_date1, $out_date2);

			if (!empty($get_out_date)) 
			{
				$i=0;
				$data['all_count_out_stock'] = $get_out_date;
			}
			else
			{
				$data['errorSearch']='Nothing found';
			}
		}


		$this->load->view('rf/pages/user_report/user_report_page',$data); 
	}

//----------------------------------------------------------------------------------------- 
//------------------------------------------------------------------------------------------ 





//------------------------------------------------------------------------------------------ 
// ----------------------------------------------------------------------------------------- 
// ========================================================================================= 

}
?>