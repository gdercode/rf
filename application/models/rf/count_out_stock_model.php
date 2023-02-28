<?php
class count_out_stock_model extends CI_Model 
{
					//	FOR PRODUCT
// ------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------ 

	private $product_table = 'product_table';
	private $out_stock_history_table = 'out_stock_history_table';
	private $stock_table = 'stock_table';

//---------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_product()
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`, `out_hist_id`,`out_user_id`,out_prod_id`,`out_quantity` , DATE_FORMAT(`out_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'out_date\'')
						->from($this->product_table)
						->join('out_stock_history_table', 'out_stock_history_table.out_prod_id = product_table.product_id')
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------

//---------------------------------------------------------------------------------

	public function get_all_liquid_product()
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`, `out_hist_id`,`out_user_id`,out_prod_id`,`out_quantity`, DATE_FORMAT(`out_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'out_date\'')
						->from($this->product_table)
						->join('out_stock_history_table', 'out_stock_history_table.out_prod_id = product_table.product_id')
						->where('product_category','Liquid')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_kilo_product()
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`, `out_hist_id`,`out_user_id`,out_prod_id`,`out_quantity`, DATE_FORMAT(`out_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'out_date\'')
						->from($this->product_table)
						->join('out_stock_history_table', 'out_stock_history_table.out_prod_id = product_table.product_id')
						->where('product_category','Solid')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_Unit_product()
	{
	
		return $this->db->select('`product_id`,`product_name`,`product_category`, `out_hist_id`,`out_user_id`,out_prod_id`,`out_quantity` , DATE_FORMAT(`out_date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'out_date\'')
						->from($this->product_table)
						->join('out_stock_history_table', 'out_stock_history_table.out_prod_id = product_table.product_id')
						->where('product_category','Unit')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------

//---------------------------------------------------------------------------------

	public function get_all_out_prod()
	{
	
		return $this->db->select('`out_hist_id`,`out_user_id`,`out_prod_id`,`out_quantity`, DATE_FORMAT(`out_date`,\'%d-%m-%Y\') AS \'out_date\',`product_id`,`product_name`,`product_category`', false)
						->from($this->out_stock_history_table)
						->join('product_table', 'product_table.product_id = out_stock_history_table.out_prod_id')
						->order_by('out_date','desc')
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------

//---------------------------------------------------------------------------------

	public function get_all_out_prod_by_category($cat)
	{
	
		return $this->db->select('`out_hist_id`,`out_user_id`,`out_prod_id`,`out_quantity`, DATE_FORMAT(`out_date`,\'%d-%m-%Y\') AS \'out_date\',`product_id`,`product_name`,`product_category`', false)
						->from($this->out_stock_history_table)
						->join('product_table', 'product_table.product_id = out_stock_history_table.out_prod_id')
						->where('product_category',$cat)
						->order_by('out_date','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_out_prod_by_user($user_id, $first_date, $second_date)
	{
		return $this->db->select('`out_hist_id`,`out_user_id`,`out_prod_id`,`out_quantity`, DATE_FORMAT(`out_date`,\'%d-%m-%Y\') AS \'out_date\',`product_id`,`product_name`,`product_category`,`user_first_name`,`user_last_name`', false)
						->from($this->out_stock_history_table)
						->join('product_table', 'product_table.product_id = out_stock_history_table.out_prod_id')
						->join('all_user_table', 'all_user_table.user_id = out_stock_history_table.out_user_id')
						->where('out_user_id',$user_id)
						->where('out_date>=',$first_date)
						->where('out_date<=',$second_date.' 23:59:00')
						->order_by('out_date','desc')
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_out_prod_to_user($refugee_id, $first_date, $second_date)
	{
		return $this->db->select('`out_hist_id`,`out_user_id`,`out_prod_id`,`out_quantity`, DATE_FORMAT(`out_date`,\'%d-%m-%Y\') AS \'out_date\',`product_id`,`product_name`,`product_category`,`user_first_name`,`user_last_name`,`refugee_id`', false)
						->from($this->out_stock_history_table)
						->join('product_table', 'product_table.product_id = out_stock_history_table.out_prod_id')
						->join('all_user_table', 'all_user_table.user_id = out_stock_history_table.out_user_id')
						->where('refugee_id',$refugee_id)
						->where('out_date>=',$first_date)
						->where('out_date<=',$second_date.' 23:59:00')
						->order_by('out_date','desc')
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_out_prod_by_date($first_date, $second_date)
	{
		return $this->db->select('`out_hist_id`,`out_user_id`,`out_prod_id`,`out_quantity`, DATE_FORMAT(`out_date`,\'%d-%m-%Y\') AS \'out_date\',`product_id`,`product_name`,`product_category`', false)
						->from($this->out_stock_history_table)
						->join('product_table', 'product_table.product_id = out_stock_history_table.out_prod_id')
						->where('out_date>=',$first_date)
						->where('out_date<=',$second_date.' 23:59:00')
						->order_by('out_date','desc')
						->order_by('product_category','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

	public function get_all_out_prod_by_date_and_cat($first_date, $second_date, $cat)
	{
		return $this->db->select('`out_hist_id`,`out_user_id`,`out_prod_id`,`out_quantity`, DATE_FORMAT(`out_date`,\'%d-%m-%Y\') AS \'out_date\',`product_id`,`product_name`,`product_category`', false)
						->from($this->out_stock_history_table)
						->join('product_table', 'product_table.product_id = out_stock_history_table.out_prod_id')
						->where('product_category',$cat)
						->where('out_date>=',$first_date)
						->where('out_date<=',$second_date.' 23:59:00')
						->order_by('out_date','desc')
						->get()
						->result_array();
	}

//-----------------------------------------------------------------------------------

//---------------------------------------------------------------------------------

//---------------------------------------------------------------------------------

	
//----------------------------------------------------------------------------------
}

// ====================================================================================
?>