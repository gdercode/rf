  <?php
class in_stockController extends CI_Controller
{
	public function __construct() // constructor
 	{
	 	parent::__construct();   // for parent class
	 	$this->load->database();	 // for database
	 	$this->load->helper(array('form','url')); // for url and form
	 	$this->load->library(array('form_validation'));	 // for form validation  
	 	$this->load->model('rf/in_stock_model','in_stockManager');
	 	$this->load->model('rf/stock_model','stockManager');  

	 	$needed = $this->session->userdata('in_stockpagePermit');
		$this->check_in_stock_page_permit($needed);
	}

//--------------------------------------------------------------------------------------------------------------------------------------

	private function check_in_stock_page_permit($need)
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
		$data['all_product'] = $this->in_stockManager->get_all_product();
		$data['all_in_stock'] = $this->in_stockManager->get_all_in_stock(); 
		$this->load->view('rf/pages/in_stock/in_stock_page',$data); // load product page 
	}
//------------------------------------------------------------------------------------------- 

//-----------------------------------------------------------------------------------------------------------------------------------

	public function liquid_list_c()  // private function for user page
	{
		$this->session->set_userdata('mini_page_name', 'Liquid');

		$data['all_product'] = $this->in_stockManager->get_all_liquid_product();
		$data['all_in_stock'] = $this->in_stockManager->get_all_in_stock(); 
		$this->load->view('rf/pages/in_stock/in_stock_page',$data); // load product page 
	}
//-------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------

	public function solid_kilo_list_c()  // private function for user page
	{
		$this->session->set_userdata('mini_page_name', 'Solid');

		$data['all_product'] = $this->in_stockManager->get_all_kilo_product(); 
		$data['all_in_stock'] = $this->in_stockManager->get_all_in_stock(); 
		$this->load->view('rf/pages/in_stock/in_stock_page',$data); // load product page 
	}
//-------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------

	public function singleItems_list_c()  // private function for user page
	{
		$this->session->set_userdata('mini_page_name', 'Unit');

		$data['all_product'] = $this->in_stockManager->get_all_single_product(); 
		$data['all_in_stock'] = $this->in_stockManager->get_all_in_stock(); 
		$this->load->view('rf/pages/in_stock/in_stock_page',$data); // load product page 
	}
//------------------------------------------------------------------------------------------- 



// ----------------------------------------------------------------------------------------- 
	public function add_in_stock_c()
	{
		$this->session->set_userdata('mini_page_name', '');
		$data['error']='';
		
		// remove tags for security
		$product_id = htmlspecialchars(trim( $this->input->post('reg_prodid')));
		$quantity=htmlspecialchars(trim( $this->input->post('reg_quantity') ));

		$data['the_in_stock'] = array(
							'product_id' => $product_id,
							'quantity' => $quantity
						);

		$this->form_validation->set_rules('reg_quantity', 'quantity', 'trim|numeric|required|min_length[1]|max_length[50]');

        if ($this->form_validation->run() == FALSE) // if validation fail
        {
        	$data['errorMessage'] = "Recheck quantity"; 
        }
        else 		// if yes 
        {
        	if (0 >= $quantity)
	        {
	        	$data['errorMessage'] = "Recheck Quantity";
	        }
	        else
	        {
	        	$the_prod = $this->in_stockManager->get_in_stock_id($product_id);

	        	if (!empty($the_prod)) 
	        	{
	        		$data['errorMessage']="Nothing changed";
	        	}
	        	else
	        	{
	        		$this->in_stockManager->insert_in_stock($product_id,$quantity);
					$data['errorMessage']="Added into Chart";
	        	}
	        }
		}
		
		
		$data['all_product'] = $this->in_stockManager->get_all_product();
		$data['all_in_stock'] = $this->in_stockManager->get_all_in_stock(); 
		$this->load->view('rf/pages/in_stock/in_stock_page',$data); 
	}



//-----------------------------------------------------------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------------- 
	public function remove_in_stock_c()
	{
		$this->session->set_userdata('mini_page_name', '');
		$data['error']='';
		
		$product_id = htmlspecialchars(trim( $this->input->post('reg_in_stockid')));
		
		$this->in_stockManager->remove_in_stock($product_id);
		$data['errorMessage2']="Removed successfully ";
	        
		$data['all_product'] = $this->in_stockManager->get_all_product();
		$data['all_in_stock'] = $this->in_stockManager->get_all_in_stock(); 
		$this->load->view('rf/pages/in_stock/in_stock_page',$data); 
	}



//-----------------------------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------- 
	public function search_c()
	{
		$this->session->set_userdata('mini_page_name', '');
		$data['errorSearch']='';
		
		$prod_name = htmlspecialchars(trim( $this->input->post('reg_prod_name')));
		
		$get_product_name = $this->in_stockManager->Search_prod_name($prod_name);

		if (!empty($get_product_name)) 
		{
			$data['all_product'] = $get_product_name;
		}
		else
		{
			$data['errorSearch']='Empty stock';
		}

		$data['the_search'] = $prod_name ;

		$data['all_out_stock'] = $this->in_stockManager->get_all_in_stock(); 
		$this->load->view('rf/pages/in_stock/in_stock_page',$data); 
	}



//-----------------------------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------- 
	public function Save_c()
	{
		$this->session->set_userdata('mini_page_name', '');
		$data['errorMessage2']='';
		
		$all_in_stock = $this->in_stockManager->get_all_in_stock();
		if (empty($all_in_stock))
		{
			$data['errorMessage2']='Nothing is unavailable';

			$data['all_product'] = $this->in_stockManager->get_all_product();
			$data['all_in_stock'] = $this->in_stockManager->get_all_in_stock(); 
			$this->load->view('rf/pages/in_stock/in_stock_page',$data); 
		}
		else
		{
			foreach($all_in_stock as $result)
			{
				$this->in_stockManager->insert_in_stock_history($result['in_prod_id'], $result['in_prod_total_item']);
			}
			
			$data['all_stock'] = $this->stockManager->get_all_stock();
			$this->load->view('rf/pages/stock/stock_page',$data); 
		}

	}



//-----------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------ 
// ----------------------------------------------------------------------------------------- 
// ========================================================================================= 

}
?>