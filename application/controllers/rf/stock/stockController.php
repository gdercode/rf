<?php
class StockController extends CI_Controller
{
	public function __construct() // constructor
 	{
	 	parent::__construct();   // for parent class
	 	$this->load->database();	 // for database
	 	$this->load->helper(array('form','url')); // for url and form
	 	$this->load->library(array('form_validation'));	 // for form validation  
	 	$this->load->model('rf/stock_model','stockManager');  

	 	$needed = $this->session->userdata('stockpagePermit');
		$this->check_stock_page_permit($needed);
	}

//--------------------------------------------------------------------------------------------------------------------------------------

	private function check_stock_page_permit($need)
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
		$this->welcome(); 	// go to welcome function down below
	}

// //-----------------------------------------------------------------------------------------------------------------------------------

	private function welcome()  // private function for user page
	{
		$data['all_stock'] = $this->stockManager->get_all_stock();
		$this->load->view('rf/pages/stock/stock_page',$data); // load product page 
	}
// //------------------------------------------------------------------------------------------- 

// //-----------------------------------------------------------------------------------------------------------------------------------

	public function liquid_list_c()  // private function for user page
	{
		$this->session->set_userdata('mini_page_name', 'Liquid');
		$data['all_stock'] = $this->stockManager->get_all_liquid_stock();
		$this->load->view('rf/pages/stock/stock_page',$data); // load stock page 
	}
//-----------------------------------------------------------------------------------------------------------------------------------

	public function solid_kilo_list_c()  // private function for user page
	{
		$this->session->set_userdata('mini_page_name', 'Solid');
		$data['all_stock'] = $this->stockManager->get_all_kilo_stock(); 
		$this->load->view('rf/pages/stock/stock_page',$data); // load stock page
	}
//-------------------------------------------------------------------------------------------

	public function singleItems_list_c()  // private function for user page
	{
		$this->session->set_userdata('mini_page_name', 'Unit');
		$data['all_stock'] = $this->stockManager->get_all_single_stock(); 
		$this->load->view('rf/pages/stock/stock_page',$data); // load stock page 
	}


// -----------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------- 
	public function search_c()
	{
		$this->session->set_userdata('mini_page_name', '');
		$data['errorSearch']='';
		
		$prod_name = htmlspecialchars(trim( $this->input->post('reg_prod_name')));
		
		$get_product_name = $this->stockManager->Search_prod_name($prod_name);

		if (!empty($get_product_name)) 
		{
			$data['all_stock'] = $get_product_name;
		}
		else
		{
			$data['errorSearch']='Not found';
		}

		$data['the_search'] = $prod_name ;
		$this->load->view('rf/pages/stock/stock_page',$data); 
	}



//-----------------------------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------- 

// -----------------------------------------------------------------------------------------  
// ========================================================================================= 

}
?>