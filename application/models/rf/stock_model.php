<?php
class stock_model extends CI_Model 
{
					//	FOR PRODUCT
// ------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------ 

	private $stock_table = 'stock_table';
	private $product_table = 'product_table';

// ------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function Search_prod_name($prod_name)
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`,`in_stock_status`,`stock_prod_id`,`stock_prod_quantity`  , DATE_FORMAT(`product_registration_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\',DATE_FORMAT(`product_update_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'product_update_date\'', false)
						->from($this->product_table)
						->join('stock_table', 'stock_table.stock_prod_id = product_table.product_id')
						->like('product_name',$prod_name)
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_stock()
	{
	
		return $this->db->select('`stock_id`,`stock_prod_id`,`stock_prod_quantity`,`product_id`,`product_name`,`product_category`', false)
						->from($this->stock_table)
						->join('product_table', 'product_table.product_id = stock_table.stock_prod_id')
						->order_by('stock_id','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_liquid_stock()
	{
	
		return $this->db->select('`stock_id`,`stock_prod_id`,`stock_prod_quantity`,`product_id`,`product_name`,`product_category`', false)
						->from($this->stock_table)
						->where('product_category','Liquid')
						->join('product_table', 'product_table.product_id = stock_table.stock_prod_id')
						->order_by('stock_id','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_kilo_stock()
	{
	
		return $this->db->select('`stock_id`,`stock_prod_id`,`stock_prod_quantity`,`product_id`,`product_name`,`product_category`', false)
						->from($this->stock_table)
						->where('product_category','Solid')
						->join('product_table', 'product_table.product_id = stock_table.stock_prod_id')
						->order_by('stock_id','desc')
						->get()
						->result_array();
	}


//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_single_stock()
	{
	
		return $this->db->select('`stock_id`,`stock_prod_id`,`stock_prod_quantity`,`product_id`,`product_name`,`product_category`', false)
						->from($this->stock_table)
						->where('product_category','Unit')
						->join('product_table', 'product_table.product_id = stock_table.stock_prod_id')
						->order_by('stock_id','desc')
						->get()
						->result_array();
	}


//-----------------------------------------------------------------------------------
//----------------------------------------------------------------------------------
}

// ====================================================================================
?>