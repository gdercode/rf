<?php
class out_status_model extends CI_Model 
{
					//	FOR PRODUCT
// ------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------ 

	private $out_stock_history_table = 'out_stock_history_table';
	private $product_table = 'product_table';

// ------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_out_status() 
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`, COUNT(product_id) as total', false)
						->from($this->out_stock_history_table)
						->join('product_table', 'product_table.product_id = out_stock_history_table.out_prod_id')
						->group_by('product_id')
						->order_by('total','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_out_status_by_date($first_date, $second_date)
	{
		return $this->db->select('`product_id`,`product_name`,`product_category`, COUNT(product_id) as total', false)
						->from($this->out_stock_history_table)
						->join('product_table', 'product_table.product_id = out_stock_history_table.out_prod_id')
						->group_by('product_id')
						->order_by('total','desc')
						->where('out_date>=',$first_date)
						->where('out_date<=',$second_date.' 23:59:00')
						->order_by('total','desc')
						->get()
						->result_array();
	}


//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------


//-----------------------------------------------------------------------------------
//----------------------------------------------------------------------------------
}

// ====================================================================================
?>