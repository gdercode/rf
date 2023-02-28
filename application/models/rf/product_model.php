<?php
class product_model extends CI_Model
{
					//	FOR PRODUCT
// ------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------ 

	private $product_table = 'product_table';
	private $stock_table = 'stock_table';

// ------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function Search_prod_name($prod_name)
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`,DATE_FORMAT(`product_registration_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\',DATE_FORMAT(`product_update_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\'', false)
						->from($this->product_table)
						->like('product_name',$prod_name)
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------

	public function insert_product( $product_name,$product_category)
	{
		return $this->db->set( array(
										'product_id'=>'',
										'product_name' => $product_name,
										'product_category'      => $product_category,
										'in_stock_status'     => ''
									) 
							 )
						->set( 'product_registration_date', 'NOW()', false)
						->set( 'product_update_date', 'NOW()', false)
						->insert( $this->product_table );
	}

//------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------

	public function insert_initial_stock( $product_id)
	{
		$quantity = 0;
		return $this->db->set( array(
										'stock_id'=>'',
										'stock_prod_id' => $product_id,
										'stock_prod_quantity'     => $quantity
									) 
							 )
						->insert( $this->stock_table );
	}

//------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_product()
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`,`in_stock_status` , DATE_FORMAT(`product_registration_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\',DATE_FORMAT(`product_update_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\'', false)
						->from($this->product_table)
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------

//---------------------------------------------------------------------------------

	public function get_all_liquid_product()
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`,`in_stock_status` , DATE_FORMAT(`product_registration_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\',DATE_FORMAT(`product_update_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\'', false)
						->from($this->product_table)
						->where('product_category','Liquid')
						->order_by('product_name','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_kilo_product()
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`,`in_stock_status` , DATE_FORMAT(`product_registration_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\',DATE_FORMAT(`product_update_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\'', false)
						->from($this->product_table)
						->where('product_category','Solid')
						->order_by('product_name','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_single_product()
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`,`in_stock_status` , DATE_FORMAT(`product_registration_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\',DATE_FORMAT(`product_update_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\'', false)
						->from($this->product_table)
						->where('product_category','Unit')
						->order_by('product_name','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------


	public function get_product($productname)
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`,`in_stock_status` , DATE_FORMAT(`product_registration_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\',DATE_FORMAT(`product_update_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\'', false)
						->from($this->product_table)
						->where('product_name',$productname)
						->get()
						->row_array();
	}

//----------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------


	public function get_real_product($productname)
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`,`in_stock_status` , DATE_FORMAT(`product_registration_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\',DATE_FORMAT(`product_update_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\'', false)
						->from($this->product_table)
						->where('product_name',$productname)
						->get()
						->row_array();
	}

//----------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------

	public function get_product_id($product_id)
	{
		return $this->db->select('`product_id`,`product_name`,`product_category`,`in_stock_status` , DATE_FORMAT(`product_registration_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\',DATE_FORMAT(`product_update_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\'', false)
						->from($this->product_table)
						->where('product_id',$product_id)
						->get()
						->row_array();
	} 

//-----------------------------------------------------------------------------------
//----------------------------------------------------------------------------------

	public function update_product($product_id,$product_name,$product_category)
	{
		return $this->db->set( array(
										'product_name'=>$product_name,
										'product_category'=>$product_category
									) 
							 )
						->set('product_update_date', 'NOW()',false)
						->where('product_id',$product_id)
						->update($this->product_table);
	}

// ---------------------------------------------------------------------------------
// --------------------------------------------------------------------------------- 

	public function delete_product($product_id)
	{
		return $this->db->where('product_id',$product_id)->delete($this->product_table);
	}

//----------------------------------------------------------------------------------
//----------------------------------------------------------------------------------
}

// ====================================================================================
?>