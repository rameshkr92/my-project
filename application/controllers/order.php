<?php include("securearea.php"); ?>
<?php include("cart.php"); ?>
<?php
class Order extends Securearea 
{
	public $oCart;
	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");				
		$this->load->model("admin/areas_model");
		$this->load->model("admin/order_model");
		$this->oCart = new Cart();
	}
	
	function index()
	{
		$this->showOrder();
	}	
	
	function showOrder()
	{		
		//load header
		$this->loadHeader($this);
		
		//load sidebar
		$this->loadSidebar($this);
		
		//load middle content		
		$view['obj'] = $this;
		$view["areas"] = $this->areas_model->getAreas("","area_name,area_pin");	
		$view['cartData'] = $this->oCart->getcurrentcart(TRUE);
		if(empty($view['cartData']))
		redirect(base_url(),"refresh");
		$view['userdata'] = $this->userData;
		$this->load->view('order_view',$view);
		
		//load footer
		$this->loadFooter($this);
	}
	function placeOrder()
	{
		if(empty($_POST))redirect(base_url()."order","refresh");		
		$this->load->library('form_validation');		
		$config = array(
             array(
                     'field'   => 'shippingaddress', 
                     'label'   => 'Shipping Address', 
                     'rules'   => 'trim|required'
                  ),
             array(
                     'field'   => 'shipping_area', 
                     'label'   => 'Shipping Area', 
                     'rules'   => 'trim|required'
                  ),
             array(
                     'field'   => 'shipping_PIN', 
                     'label'   => 'Shipping Postal Code', 
                     'rules'   => 'trim|required|min_length[6]'
                  ),
			  array(
	                 'field'   => 'customer_id', 
	                 'label'   => 'Customer ID', 
	                 'rules'   => 'trim|required'
	              ),
			array(
	                 'field'   => 'recieving_date', 
	                 'label'   => 'Recieving Date', 
	                 'rules'   => 'trim|required'
	              ),				    
            );
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{	
			$this->showOrder();
			$this->session->set_flashdata("alert",json_encode(array("type"=>"block","msg"=>"<strong>Please Re-Check your Form.</strong>")));
		}
		else
		{
			$orderData = $_POST;
			$orderData["recieving_date"] = str_replace("/","-",$orderData["recieving_date"]);			
			$mer = (intval($orderData["recieving_time"]) >= 10 && intval($orderData["recieving_time"]) <= 12)?"AM" : "PM";			
			$orderData["order_date_time"] = $orderData["recieving_time"]." ".$mer." ".$orderData["recieving_date"];
			unset($orderData["recieving_time"]);unset($orderData["recieving_date"]);
			$orderData["order_date_time"] =  date("Y-m-d H:m:s",strtotime($orderData["order_date_time"]));
			$cartcontent = $this->cart->contents();
			if(empty($cartcontent))redirect(base_url());
			$orderData["cart_data"] = serialize($cartcontent);						
			$this->order_model->placeOrder($orderData);			
			$this->session->set_flashdata("alert",json_encode(array("type"=>"success","msg"=>"<strong>Your Order is placed Successfully.</strong>")));			
			//load header
			$this->loadHeader($this);
			
			//load sidebar
			$this->loadSidebar($this);
			
			//load middle content		
			$view['obj'] = $this;
			$this->load->view("placed_order_view",$orderData);			
			
			
			//load footer
			$this->loadFooter($this);	
			$this->oCart->removeCart();
		}
	}
}
?>