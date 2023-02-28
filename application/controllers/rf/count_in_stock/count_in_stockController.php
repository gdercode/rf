 <?php
class count_in_stockController extends CI_Controller
{
	public function __construct() // constructor
 	{
	 	parent::__construct();   // for parent class
	 	$this->load->database();	 // for database
	 	$this->load->helper(array('form','url')); // for url and form
	 	$this->load->library(array('form_validation'));	 // for form validation  
	 	$this->load->model('rf/count_in_stock_model','count_in_stockManager');
	 	$this->load->model('rf/stock_model','stockManager');  

	 	$needed = $this->session->userdata('count_in_stockpagePermit');
		$this->check_count_in_stock_page_permit($needed);
	}

//--------------------------------------------------------------------------------------------------------------------------------------

	private function check_count_in_stock_page_permit($need)
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

//-----------------------------------------------------------------------------------------------------------------------------------

	private function welcome()  // private function for user page
	{
		$data['all_product'] = $this->count_in_stockManager->get_all_product();
		$data['all_count_in_stock'] = $this->count_in_stockManager->get_all_ivyaranguwe(); 
		$this->load->view('rf/pages/count_in_stock/count_in_stock_page',$data); // load product page 
	}
//------------------------------------------------------------------------------------------- 

//------------------------------------------------------------------------------------------- 

	public function liquid_list_c()   
	{
		$this->session->set_userdata('mini_page_name', 'Liquid'); 

		$cat = 'Liquid';
		$data['all_product'] = $this->count_in_stockManager->get_all_liquid_product();
		$data['all_count_in_stock'] = $this->count_in_stockManager->get_all_ivyaranguwe_by_category($cat);  
		$this->load->view('rf/pages/count_in_stock/count_in_stock_page_category',$data); 
	}
//-------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------

	public function solid_kilo_list_c()   
	{
		$this->session->set_userdata('mini_page_name', 'Solid');

		$cat = 'Solid';
		$data['all_product'] = $this->count_in_stockManager->get_all_kilo_product();
		$data['all_count_in_stock'] = $this->count_in_stockManager->get_all_ivyaranguwe_by_category($cat);  
		$this->load->view('rf/pages/count_in_stock/count_in_stock_page_category',$data); 
	}
//-------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------

	public function singleItems_list_c()  
	{
		$this->session->set_userdata('mini_page_name', 'Unit');

		$cat = 'Unit';
		$data['all_product'] = $this->count_in_stockManager->get_all_Unit_product();
		$data['all_count_in_stock'] = $this->count_in_stockManager->get_all_ivyaranguwe_by_category($cat);  
		$this->load->view('rf/pages/count_in_stock/count_in_stock_page_category',$data); 
	}
//------------------------------------------------------------------------------------------- 
// ----------------------------------------------------------------------------------------- 
	public function search_c()
	{
		$this->session->set_userdata('mini_page_name', '');

		$data['errorMessage']='';
		
		$all_count_in_stock=array();
		$in_date1 = htmlspecialchars(trim( $this->input->post('reg_in_date1')));
		$in_date2 = htmlspecialchars(trim( $this->input->post('reg_in_date2')));


		$get_in_date = $this->count_in_stockManager->get_all_ivyaranguwe_by_date($in_date1, $in_date2);

		if (!empty($get_in_date)) 
		{
			$i=0;
			$data['all_count_in_stock'] = $get_in_date;
			
		}
		else
		{
			$data['errorSearch']='Nothing found';
		}

		$this->load->view('rf/pages/count_in_stock/count_in_stock_page',$data); 
	}



//----------------------------------------------------------------------------------------- 
// ----------------------------------------------------------------------------------------- 
	public function search_cat_c()
	{
		$data['errorMessage']='';
		
		$all_count_in_stock=array();

		$cat = htmlspecialchars(trim( $this->input->post('reg_category')));
		$in_date1 = htmlspecialchars(trim( $this->input->post('reg_in_date1')));
		$in_date2 = htmlspecialchars(trim( $this->input->post('reg_in_date2')));


		$this->session->set_userdata('mini_page_name', $cat);

		$get_in_date = $this->count_in_stockManager->get_all_ivyaranguwe_by_date_and_cat($in_date1, $in_date2, $cat);

		if (!empty($get_in_date)) 
		{
			$i=0;
			$data['all_count_in_stock'] = $get_in_date;
		}
		else
		{
			$data['errorSearch']='Nothing found';
		}

		$this->load->view('rf/pages/count_in_stock/count_in_stock_page_category',$data); 
	}



//----------------------------------------------------------------------------------------- 
//------------------------------------------------------------------------------------------ 





//------------------------------------------------------------------------------------------ 
// ----------------------------------------------------------------------------------------- 
// ========================================================================================= 

}
?>