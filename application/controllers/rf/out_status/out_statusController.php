 <?php
class out_statusController extends CI_Controller
{
	public function __construct() // constructor
 	{
	 	parent::__construct();   // for parent class
	 	$this->load->database();	 // for database
	 	$this->load->helper(array('form','url')); // for url and form
	 	$this->load->library(array('form_validation'));	 // for form validation  
	 	$this->load->model('rf/out_status_model','out_statusManager');  

	 	$needed = $this->session->userdata('out_statuspagePermit');
		$this->check_out_status_page_permit($needed);
	}

//--------------------------------------------------------------------------------------------------------------------------------------

	private function check_out_status_page_permit($need)
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
		$data['all_out_status'] = $this->out_statusManager->get_all_out_status();
		$this->load->view('rf/pages/out_status/out_status_page',$data); // load product page 
	}

// ----------------------------------------------------------------------------------------- 
	

	public function search_c()
	{
		$this->session->set_userdata('mini_page_name', '');

		$data['errorMessage']='';
		
		$out_date1 = htmlspecialchars(trim( $this->input->post('reg_out_date1')));
		$out_date2 = htmlspecialchars(trim( $this->input->post('reg_out_date2')));


		$get_out_date = $this->out_statusManager->get_all_out_status_by_date($out_date1, $out_date2);

		if (!empty($get_out_date)) 
		{
			$i=0;
			$data['all_out_status'] = $get_out_date;
			$data['errorSearch']='Results';
		}
		else
		{
			$data['errorSearch']='Nothing found';
		}

		$this->load->view('rf/pages/out_status/out_status_page',$data); // load product page 
	}



//-----------------------------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------- 

// -----------------------------------------------------------------------------------------  
// ========================================================================================= 

}
?>