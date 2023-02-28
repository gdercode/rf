<?php
class out_stock_model extends CI_Model 
{
					//	FOR PRODUCT
// ------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------ 

	private $product_table = 'product_table';
	private $out_stock_table = 'out_stock_table';
	private $out_stock_history_table = 'out_stock_history_table';
	private $stock_table = 'stock_table';

// ------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------

	public function Search_prod_name($prod_name)
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`,`out_stock_status`,`stock_prod_id`,`stock_prod_quantity`  , DATE_FORMAT(`product_registration_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\',DATE_FORMAT(`product_update_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\'', false)
						->from($this->product_table)
						->join('stock_table', 'stock_table.stock_prod_id = product_table.product_id')
						->where('out_stock_status','')
						->like('product_name',$prod_name)
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_product()
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`,`out_stock_status`,`stock_prod_id`,`stock_prod_quantity`  , DATE_FORMAT(`product_registration_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\',DATE_FORMAT(`product_update_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\'', false)
						->from($this->product_table)
						->join('stock_table', 'stock_table.stock_prod_id = product_table.product_id')
						->where('out_stock_status','')
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_out_stock()
	{
	
		return $this->db->select('`out_id`,`out_prod_id`,`out_quantity`,DATE_FORMAT(`out_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'out_date\',`product_id`,`product_name`,`product_category`', false)
						->from($this->out_stock_table)
						->join('product_table', 'product_table.product_id = out_stock_table.out_prod_id')
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------

//---------------------------------------------------------------------------------

	public function get_all_liquid_product()
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`,`out_stock_status`,`stock_prod_id`,`stock_prod_quantity`  , DATE_FORMAT(`product_registration_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\',DATE_FORMAT(`product_update_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\'', false)
						->from($this->product_table)
						->join('stock_table', 'stock_table.stock_prod_id = product_table.product_id')
						->where('out_stock_status','')
						->where('product_category','Liquid')
						->order_by('product_name','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_kilo_product()
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`,`out_stock_status`,`stock_prod_id`,`stock_prod_quantity`  , DATE_FORMAT(`product_registration_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\',DATE_FORMAT(`product_update_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\'', false)
						->from($this->product_table)
						->join('stock_table', 'stock_table.stock_prod_id = product_table.product_id')
						->where('out_stock_status','')
						->where('product_category','Solid')
						->order_by('product_name','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_single_product()
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`,`out_stock_status`,`stock_prod_id`,`stock_prod_quantity`  , DATE_FORMAT(`product_registration_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\',DATE_FORMAT(`product_update_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\'', false)
						->from($this->product_table)
						->join('stock_table', 'stock_table.stock_prod_id = product_table.product_id')
						->where('out_stock_status','')
						->where('product_category','Unit')
						->order_by('product_name','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------

	public function get_out_stock_id($Products_id)
	{
		return $this->db->select('`out_id`,`out_prod_id`,`out_quantity`, DATE_FORMAT(`out_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'out_date\'', false)
						->from($this->out_stock_table)
						->where('out_prod_id',$Products_id)
						->get()
						->row_array();
	} 

//-----------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------

	public function insert_out_stock( $product_id, $quantity )
	{

		// $userDetails = $this->session->userdata('user_details');
        // $user_id = $userDetails['user_id'];

		$prod_status = 'pending';
		$this->update_out_stock_status($product_id, $prod_status);

		return $this->db->set( array(
										'out_id'=>'',
										'out_prod_id' => $product_id,
										'out_quantity'  => $quantity
									) 
							 )
						->set( 'out_date', 'NOW()', false)
						->insert( $this->out_stock_table );

	}

// ------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------

	public function remove_out_stock($product_id)
	{
		$prod_status = '';
		$this->update_out_stock_status($product_id, $prod_status);

		return $this->db->where('out_prod_id',$product_id)->delete($this->out_stock_table);
	}

// ------------------------------------------------------------------------------------
	public function update_out_stock_status($product_id , $prod_status)
	{
		return $this->db->set('out_stock_status', $prod_status)
						->where('product_id',$product_id)
						->update($this->product_table);
	}

//------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------

	public function insert_out_stock_history( $product_id, $quantity, $refugee_id )
	{
		$userDetails = $this->session->userdata('user_details');
        $user_id = $userDetails['user_id'];

		// for stock table

		$this->for_update_stock($product_id, $quantity);

		// for in_stock table
		$this->remove_out_stock($product_id);

		// for in_stock history table
		return $this->db->set( array(
										'out_hist_id'=>'',
										'out_user_id' => $user_id,
										'refugee_id' => $refugee_id	,
										'out_prod_id' => $product_id,
										'out_quantity'  => $quantity
									) 
							 )
						->set( 'out_date', 'NOW()', false)
						->insert( $this->out_stock_history_table );

	}
// ------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------

	public function for_update_stock( $product_id, $quantity)
	{

		$current_stock_prod = $this->get_stock_id($product_id);

		if (empty($current_stock_prod))
		{
			// nothing to do
		}
		else
		{
			// update stock
			$current_stock_prod_quantity = $current_stock_prod['stock_prod_quantity'];
			$new_quantity = $current_stock_prod_quantity - $quantity;

			$this->update_stock($product_id, $new_quantity);
		}

	}
// ------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------

	public function get_all_stock()
	{
	
		return $this->db->select('`stock_id`,`stock_prod_id`,`stock_prod_quantity`,`product_id`,`product_name`,`product_category`', false)
						->from($this->stock_table)
						->join('product_table', 'product_table.product_id = stock_table.stock_prod_id')
						->order_by('stock_id','desc')
						->get()
						->result_array();

	}

//----------------------------------------------------------------------------------


// ------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------
	
	private function update_stock($product_id , $new_quantity)
	{
		return $this->db->set('stock_prod_quantity', $new_quantity)
						->where('stock_prod_id',$product_id)
						->update($this->stock_table);
	}

//------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------

	public function get_stock_id($product_id)
	{
		return $this->db->select('`stock_id`,`stock_prod_id`,`stock_prod_quantity`', false)
						->from($this->stock_table)
						->where('stock_prod_id',$product_id)
						->get()
						->row_array();
	} 

//----------------------------------------------------------------------------------
//----------------------------------------------------------------------------------
}

// ====================================================================================
?>