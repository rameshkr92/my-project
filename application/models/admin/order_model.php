<?php
class Order_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	function placeOrder($orderData)
	{
		$this->db->insert(DBPREFIX."_orders",$orderData);
	//	echo $this->db->last_query();die;
	}
	
	function getOrders($order_id = "")
	{
		$sql = "
			SELECT orders.*,user.firstname,user.lastname 
			FROM ".DBPREFIX."_orders as orders        
			LEFT JOIN ".DBPREFIX."_users as user 
			ON orders.customer_id = user.id 
			WHERE orders.is_viewed = '0'			
		";
		if($order_id)
		{
			$sql .= " AND order_id = '".$order_id."'";
		}
	//	echo $sql;die;
		$result = $this->db->query($sql);
		if($result && $result->num_rows() > 0)
		{
			return $result->result_array();
		}
	}
}
?>