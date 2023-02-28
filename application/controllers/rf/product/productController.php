<?php
class ProductController extends CI_Controller // UserController
{

	public function __construct() // constructor
 	{
	 	parent::__construct();   // for parent class
	 	$this->load->database();	 // for database
	 	$this->load->helper(array('form','url')); // for url and form
	 	$this->load->library(array('form_validation'));	 // for form validation  
	 	$this->load->model('rf/product_model','productManager');  

	 	$needed = $this->session->userdata('productpagePermit');
		$this->check_product_page_permit($needed);
	}

//--------------------------------------------------------------------------------------------------------------------------------------

	private function check_product_page_permit($need)
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
		$data['all_product'] = $this->productManager->get_all_product(); 
		$this->load->view('rf/pages/product/product_page',$data); // load product page 
	}
//------------------------------------------------------------------------------------------- 

//-----------------------------------------------------------------------------------------------------------------------------------

	public function liquid_list_c()  // private function for user page
	{
		$this->session->set_userdata('mini_page_name', 'Liquid');

		$data['all_product'] = $this->productManager->get_all_liquid_product(); 
		$this->load->view('rf/pages/product/product_page',$data); // load product page 
	}
//-------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------

	public function solid_kilo_list_c()  // private function for user page
	{
		$this->session->set_userdata('mini_page_name', 'Solid');

		$data['all_product'] = $this->productManager->get_all_kilo_product(); 
		$this->load->view('rf/pages/product/product_page',$data); // load product page 
	}
//-------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------

	public function singleItems_list_c()  // private function for user page
	{
		$this->session->set_userdata('mini_page_name', 'Unit');

		$data['all_product'] = $this->productManager->get_all_single_product(); 
		$this->load->view('rf/pages/product/product_page',$data); // load product page 
	}
//------------------------------------------------------------------------------------------- 


// -------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------- 

	public function add_product_c() // add a new user
	{
		$this->session->set_userdata('mini_page_name', '');
		$data['error']='';
		// $data['all_product'] = $this->productManager->get_all_product(); 	
		$this->form_validation->set_rules('reg_prodname', 'Product Name', 'trim|required|min_length[2]|max_length[50]'); 
		$this->form_validation->set_rules('reg_prodcategory', 'Product Category', 'trim|alpha_numeric|required|min_length[2]|max_length[50]');   

        if ($this->form_validation->run() == FALSE) // if validation fail
        {
        	// nothing to do you will go back to the form
        }
        else // if yes 
        {
        	// remove tags for security
			$prodname=htmlspecialchars(trim( $this->input->post('reg_prodname') ));
			$prodcategory=htmlspecialchars(trim( $this->input->post('reg_prodcategory') ));
        	if ($prodcategory == 'none')
        	{
        		$data['select_error'] =  "Select Category";
        	}
        	else
        	{

        		$check_name_existance = $this->productManager->get_product($prodname);
        		if (!empty($check_name_existance))
        		{
        				// product irahari nothing to do
        			$data['dangerError']="Item already exists"; // set a error message
        		}
        		else
        		{
	        			// product registration
	        		$this->productManager->insert_product($prodname,$prodcategory);
				$product = $this->productManager->get_real_product($prodname);
				$this->productManager->insert_initial_stock($product['product_id']);
				$data['error']="Item registed successfully"; // set a success message
        		}
        	}
        }
        $this->load->view('rf/pages/product/product_registration_page',$data); // return to registration page with error or success message
	}	

// -------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------  
	public function product_find_list_c()
	{
		$this->session->set_userdata('mini_page_name', '');
		$product_id = htmlspecialchars(trim( $this->input->post('reg_prodid')));
		$data['the_product'] = $this->productManager->get_product_id($product_id); 	
		// print_r($data['the_product']);	 
 		$data['all_product']=$this->productManager->get_all_product();

		if(empty( $data['the_product'] )) // no product existance 
		{
		 	$data['error']="Item not found"; 
		 	$this->load->view('rf/pages/product/product_page',$data);   
		}
		else // user exist							
		{
			$this->load->view('rf/pages/product/manipulate_product_page',$data);  
		}
	}
// ----------------------------------------------------------------------------------------- 
// ----------------------------------------------------------------------------------------- 
	public function manipulate_product_c()
	{
		$this->session->set_userdata('mini_page_name', '');
		$data['error']='';
		
		if ($this->input->post('update_button'))
		{
			// set form rules
			
			$this->form_validation->set_rules('reg_prodname', 'Product Name', 'trim|required|min_length[2]|max_length[50]'); 
			$this->form_validation->set_rules('reg_prodcategory', 'Product Category', 'trim|alpha_numeric|required|min_length[2]|max_length[50]');   

			// remove tags for security
			$product_id = htmlspecialchars(trim( $this->input->post('reg_prodid')));
			$product_name=htmlspecialchars(trim( $this->input->post('reg_prodname') ));
			$product_category=htmlspecialchars(trim( $this->input->post('reg_prodcategory') ));

			// set the data array needed on the product page ( form )
			$data['the_product'] = array(
							'product_id' => $product_id,
							'product_name' => $product_name,
							'product_category' => $product_category
						);
 
	        if ($this->form_validation->run() == FALSE) // if validation fail
	        {
	        	$data['error']="Recheck Form"; 
	        }
	        else 		// if yes 
	        {
	        	$product =  $this->productManager->get_product_id($product_id); 
	        	if (empty($product)) 
	        	{
	        		$data['error']="Item not found"; // set a error message
	        	}
	        	else
	        	{
					if ($product_category == 'none')
					{
						//update a product without category error
						$data['select_error'] = "Category not changed";
						$this->productManager->update_product_no_category($product_id,$product_name,); 
						$data['error']="Updated successfully";  
					}
					else
					{
						//update product
						$this->productManager->update_product($product_id,$product_name,$product_category); 
						$data['error']="Updated successfully";  
					}
				}
	        }
		}
		elseif ($this->input->post('delete_button'))
		{
			$product_id=htmlspecialchars(trim( $this->input->post('reg_prodid') ));

			$product =  $this->productManager->get_product_id($product_id);  
			if (empty($product)) 
	        {
	        	$data['error']="Item not found"; // set a error message
	        }
	        else
	        {
	        	$this->productManager->delete_product($product_id);  // delete a product
				$data['error']="Deleted successfully";  // set a success message
			}
		}
		
		$this->load->view('rf/pages/product/manipulate_product_page',$data); // go back to manipulate_page page with data
	}



//-----------------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------

	public function search_c()
	{
		$this->session->set_userdata('mini_page_name', '');
		$data['errorSearch']='';
		
		$prod_name = htmlspecialchars(trim( $this->input->post('reg_prod_name')));
		
		$get_product_name = $this->productManager->Search_prod_name($prod_name);

		if (!empty($get_product_name)) 
		{
			$data['all_product'] = $get_product_name;
		}
		else
		{
			$data['errorSearch']='NOT FOUND';
		}


		$data['the_search'] = $prod_name ;
		$this->load->view('rf/pages/product/product_page',$data); 
	}

// -----------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------



// ----------------------------------------------------------------------------------------- 
// ========================================================================================= 

}
?>