<?php
class count_in_stock_model extends CI_Model 
{
					//	FOR PRODUCT
// ------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------ 

	private $product_table = 'product_table';
	private $in_stock_table = 'in_stock_table';
	private $in_stock_history_table = 'in_stock_history_table';
	private $stock_table = 'stock_table';

//---------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_product()
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`,`in_hist_id`,in_prod_id`,`in_prod_total_item`, DATE_FORMAT(`in_prod_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'in_prod_date\'')
						->from($this->product_table)
						->join('in_stock_history_table', 'in_stock_history_table.in_prod_id = product_table.product_id')
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_liquid_product()
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`,`in_hist_id`,in_prod_id`,`in_prod_total_item` , DATE_FORMAT(`in_prod_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'in_prod_date\'')
						->from($this->product_table)
						->join('in_stock_history_table', 'in_stock_history_table.in_prod_id = product_table.product_id')
						->where('product_category','Liquid')
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------

	public function get_all_kilo_product()
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`, `in_hist_id`,in_prod_id`,`in_prod_total_item`, DATE_FORMAT(`in_prod_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'in_prod_date\'')
						->from($this->product_table)
						->join('in_stock_history_table', 'in_stock_history_table.in_prod_id = product_table.product_id')
						->where('product_category','Solid')
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------

	public function get_all_Unit_product()
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`, `in_hist_id`,in_prod_id`,`in_prod_total_item`, DATE_FORMAT(`in_prod_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'in_prod_date\'')
						->from($this->product_table)
						->join('in_stock_history_table', 'in_stock_history_table.in_prod_id = product_table.product_id')
						->where('product_category','Unit')
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_ivyaranguwe()
	{
	
		return $this->db->select('`in_hist_id`,`in_prod_id`,`in_prod_total_item`, DATE_FORMAT(`in_prod_date`,\'%d-%m-%Y\') AS \'in_prod_date\',`product_id`,`product_name`,`product_category`', false)
						->from($this->in_stock_history_table)
						->join('product_table', 'product_table.product_id = in_stock_history_table.in_prod_id')
						->order_by('in_prod_date','desc')
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------

//---------------------------------------------------------------------------------

	public function get_all_ivyaranguwe_by_category($cat)
	{
	
		return $this->db->select('`in_hist_id`,`in_prod_id`,`in_prod_total_item`, DATE_FORMAT(`in_prod_date`,\'%d-%m-%Y\') AS \'in_prod_date\',`product_id`,`product_name`,`product_category`', false)
						->from($this->in_stock_history_table)
						->join('product_table', 'product_table.product_id = in_stock_history_table.in_prod_id')
						->where('product_category',$cat)
						->order_by('in_prod_date','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_ivyaranguwe_by_date($first_date, $second_date)
	{
		return $this->db->select('`in_hist_id`,`in_prod_id`,`in_prod_total_item`, DATE_FORMAT(`in_prod_date`,\'%d-%m-%Y\') AS \'in_prod_date\',`product_id`,`product_name`,`product_category` ', false)
						->from($this->in_stock_history_table)
						->join('product_table', 'product_table.product_id = in_stock_history_table.in_prod_id')
						->where('in_prod_date>=',$first_date)
						->where('in_prod_date<=',$second_date.' 23:59:00')
						->order_by('in_prod_date','desc')
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_ivyaranguwe_by_date_and_cat($first_date, $second_date, $cat)
	{
		return $this->db->select('`in_hist_id`,`in_prod_id`,`in_prod_total_item`, DATE_FORMAT(`in_prod_date`,\'%d-%m-%Y\') AS \'in_prod_date\',`product_id`,`product_name`,`product_category`', false)
						->from($this->in_stock_history_table)
						->join('product_table', 'product_table.product_id = in_stock_history_table.in_prod_id')
						->where('product_category',$cat)
						->where('in_prod_date>=',$first_date)
						->where('in_prod_date<=',$second_date.' 23:59:00')
						->order_by('in_prod_date','desc')
						->get()
						->result_array();
	}

//----------------------------------------------------------------------------------
//----------------------------------------------------------------------------------
}

// ====================================================================================
?>