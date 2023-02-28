<?php
class out_stockController extends CI_Controller
{
	public function __construct() // constructor
 	{
	 	parent::__construct();   // for parent class
	 	$this->load->database();	 // for database
	 	$this->load->helper(array('form','url')); // for url and form
	 	$this->load->library(array('form_validation'));	 // for form validation  
	 	$this->load->model('rf/out_stock_model','out_stockManager'); 
	 	$this->load->model('rf/rf_model','rfManager');  

	 	$needed = $this->session->userdata('out_stockpagePermit');
		$this->check_out_stock_page_permit($needed);
	}

//--------------------------------------------------------------------------------------------------------------------------------------

	private function check_out_stock_page_permit($need)
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
		$data['all_product'] = $this->out_stockManager->get_all_product();
		$data['all_out_stock'] = $this->out_stockManager->get_all_out_stock();
		$data['all_user']=$this->rfManager->get_all_user();
		$this->load->view('rf/pages/out_stock/out_stock_page',$data); // load product page 
	}
//------------------------------------------------------------------------------------------- 

//-----------------------------------------------------------------------------------------------------------------------------------

	public function liquid_list_c()  // private function for user page
	{
		$this->session->set_userdata('mini_page_name', 'Liquid');

		$data['all_product'] = $this->out_stockManager->get_all_liquid_product();
		$data['all_out_stock'] = $this->out_stockManager->get_all_out_stock(); 
		$this->load->view('rf/pages/out_stock/out_stock_page',$data); // load product page  
	}
//-------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------

	public function solid_kilo_list_c()  // private function for user page
	{
		$this->session->set_userdata('mini_page_name', 'Solid');

		$data['all_product'] = $this->out_stockManager->get_all_kilo_product(); 
		$data['all_out_stock'] = $this->out_stockManager->get_all_out_stock(); 
		$this->load->view('rf/pages/out_stock/out_stock_page',$data); // load product page 
	}
//-------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------

	public function singleItems_list_c()  // private function for user page
	{
		$this->session->set_userdata('mini_page_name', 'Unit');

		$data['all_product'] = $this->out_stockManager->get_all_single_product(); 
		$data['all_out_stock'] = $this->out_stockManager->get_all_out_stock(); 
		$this->load->view('rf/pages/out_stock/out_stock_page',$data); // load product page 
	}
//------------------------------------------------------------------------------------------- 
// ----------------------------------------------------------------------------------------- 
	

	public function add_out_stock_c()
	{
		$this->session->set_userdata('mini_page_name', '');

		$data['error']='';
		
		// remove tags for security
		$product_id = htmlspecialchars(trim( $this->input->post('reg_prodid') ));
		$stock_quantity = htmlspecialchars(trim( $this->input->post('reg_stock_quantity')));
		$quantity=htmlspecialchars(trim( $this->input->post('reg_quantity') ));

		$data['the_out_stock'] = array(
							'product_id' => $product_id,
							'quantity' => $quantity,
						);

		$this->form_validation->set_rules('reg_quantity', 'quantity', 'trim|numeric|required|min_length[1]|max_length[50]');

        if ($this->form_validation->run() == FALSE) // if validation fail
        {
        	$data['errorMessage'] = "Recheck quantity"; 
        }
        else
        {
        	if($stock_quantity<=0)
        	{
        		$data['errorMessage'] = "Empty stock";
        	} 
	        elseif ($quantity > $stock_quantity) 
	        {
	    		$data['errorMessage'] = "Sock can not suport this quantity";
	        }
	        elseif (0 >= $quantity)
	        {
	        	$data['errorMessage'] = "Recheck Quantity";
	        }
	        else 		// if yes 
	        {
	        	$the_prod = $this->out_stockManager->get_out_stock_id($product_id);

	        	if (!empty($the_prod)) 
	        	{
	        		$data['errorMessage']="Nothing changed ";
	        	}
	        	else
	        	{
	        		$this->out_stockManager->insert_out_stock($product_id,$quantity);
					$data['errorMessage']="Added into Chart";
	        	}
			}
		}
		
		$data['all_product'] = $this->out_stockManager->get_all_product();
		$data['all_out_stock'] = $this->out_stockManager->get_all_out_stock(); 
		$this->load->view('rf/pages/out_stock/out_stock_page',$data); 
	}



//-----------------------------------------------------------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------------- 
	public function remove_out_stock_c()
	{
		$this->session->set_userdata('mini_page_name', '');
		$data['error']='';
		
		$product_id = htmlspecialchars(trim( $this->input->post('reg_out_stockid')));
		
		$this->out_stockManager->remove_out_stock($product_id);
		$data['errorMessage2']="Removed successfully ";
	        
		$data['all_product'] = $this->out_stockManager->get_all_product();
		$data['all_out_stock'] = $this->out_stockManager->get_all_out_stock(); 
		$this->load->view('rf/pages/out_stock/out_stock_page',$data); 
	}



//-----------------------------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------- 
	public function search_c()
	{
		$this->session->set_userdata('mini_page_name', '');
		$data['errorSearch']='';
		
		$prod_name = htmlspecialchars(trim( $this->input->post('reg_prod_name')));
		
		$get_product_name = $this->out_stockManager->Search_prod_name($prod_name);

		if (!empty($get_product_name)) 
		{
			$data['all_product'] = $get_product_name;
		}
		else
		{
			$data['errorSearch']='Empty stock';
		}


		$data['the_search'] = $prod_name ;
		$data['all_out_stock'] = $this->out_stockManager->get_all_out_stock(); 
		$this->load->view('rf/pages/out_stock/out_stock_page',$data); 
	}



//-----------------------------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------- 
	public function out_c()
	{
		$this->session->set_userdata('mini_page_name', '');
		$data['errorMessage2']='';

		$refugee_id = htmlspecialchars(trim( $this->input->post('refugee_selection')));

		if ($refugee_id=='none')
		{
			$data['select_error']='Select Refugee';
		}
		else
		{
			$all_out_stock = $this->out_stockManager->get_all_out_stock();
			if (empty($all_out_stock))
			{
				$data['errorMessage2']='Nothing to give';
			}
			else
			{
				foreach($all_out_stock as $result)
				{
					$this->out_stockManager->insert_out_stock_history($result['out_prod_id'], $result['out_quantity'], $refugee_id);
					$data['error']='Thank you!';
				}
				
			}
			
		}
		
		$data['all_user']=$this->rfManager->get_all_user();
		$data['all_product'] = $this->out_stockManager->get_all_product();
		$data['all_out_stock'] = $this->out_stockManager->get_all_out_stock(); 
		$this->load->view('rf/pages/out_stock/out_stock_page',$data); 

	}



// -------------------------------------------------------------------------------------



// ----------------------------------------------------------------------------------------- 
// ========================================================================================= 

}
?>