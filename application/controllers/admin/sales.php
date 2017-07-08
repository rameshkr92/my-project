<?php include("secureaccess.php"); ?>
<?php
class Sales extends SecureAccess 
{
	function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");
		$this->load->model("admin/Order_model");
		$this->load->model("admin/Vendors_model");
		$this->load->model("admin/areas_model");
	}
	public function index()
	{
		$this->PendingOrders();
	}
	
	/**
	* This function will list the orders placed by the user
	* 
	*/
	public function PendingOrders()
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		$orderData = $this->Order_model->getOrders();
		$orderData = $this->arrangeData($orderData);
		$headings = array
		( 
			"order_id"=>"Order No.",
			"cart_table"=>"Cart Contents",			
			"customer_name"=>"Customer Name",
			"shippingaddress"=>"Shipping Address",
			"shipping_area"=>"Shipping Area",
			"shipping_PIN"=>"Shipping PIN",
			"order_date_time"=>"Recieving Date",
			"vendors"=>"Probable Vendors"	
		);
		$label = "Pending Orders";
		$action = array
		(
			"btns"=>array("view"),
			"text"=>array("Edit & Place Order"),
			"dbcols"=>array("order_id"),
			"link"=>array(base_url()."admin/sales/finalizeorder/%@$%"),
			"clickable"=>array("","")
		);
		
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$orderData,"",$action);
		$tableData["descFirst"] = TRUE;
		$this->load->view('helpers/members_table_view',$tableData);		
		$this->load->view('admin/pendingorders_view');			
		$this->load->view("admin/includes/admin_footer");
	}
	
	/**
* 
* This function will edit and finalize the pending orders
* 
*/
	public function finalizeorder($order_id = "")
	{
		if(!$order_id)redirect(base_url()."admin/sales/pendingOrders","refresh");
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		$this->load->model("product_model");
		$this->load->model("admin/user_model");
		$this->load->model("admin/vendors_model");
		$orderData = $this->Order_model->getOrders($order_id);
		$orderData = $orderData[0];
		$orderData['cart_data'] = $this->arrangeCartData($orderData['cart_data']);
		$pass["orderData"] = $orderData;
		$pass["areas"] = $this->areas_model->getAreas("","area_name,area_pin");
		$pass["deliveryusers"] = $this->user_model->getuserbytype("delivery");
		$pass["vendors"] = $this->vendors_model->getVendors();
		$pass["product_list"]=$this->product_model->getProductData("",""," product_name ");
		$this->load->view('admin/finalizeorders_view',$pass);			
		$this->load->view("admin/includes/admin_footer");
	//	echo "<pre>";print_r($orderData);die;
	}
	
	private function arrangeCartData($cartData)
	{
		$cartData = unserialize($cartData);
		$cart = array();
		foreach($cartData as $data)
		{
			unset($data["rowid"]);
			$cart[$data["id"]] = $data;
		}
		return $cart;
	}
	
	private function arrangeData($orderData)
	{
		$retVal = array();
		if(!$orderData){return "";}		
	//	echo "<pre>";print_r($vendors);die;	
		$vendors = $this->Vendors_model->getVendors();	
		foreach($orderData as $order)
		{			
			$retVal[$order['order_id']] = $order;
			$retVal[$order['order_id']]['customer_name'] = $order['firstname']." ".$order['lastname'];
			$cartData = unserialize($order['cart_data']);
			if($cartData)
			{
				$total = 0;
				$strTable =  "<table class = 'table table-bordered'>
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Rate</th>
					<th>Total Price</th>
				";
				foreach($cartData as $products)
				{
					$strTable .= "<tr>
						<td>".$products["name"]."</td>
						<td>".$products["qty"]."</td>
						<td>Rs.&nbsp;".number_format($products["price"])."</td>
						<td>Rs.&nbsp;".number_format($products["subtotal"])."</td>
					</tr>";
					$total += doubleval($products["subtotal"]);
				}
				$strTable .= "
					<td colspan = '3' style = 'text-align:right;padding-right : 10px; font-size : 16px;'><strong>Total </strong></td>
					<td>Rs.&nbsp;".number_format($total)."</td>
				";
				$strTable .= "</table>";
			}
			$retVal[$order['order_id']]['cart_table'] = $strTable;			
			if($vendors)
			{
				$area = $order['shipping_area'];
				$strVendors = "";
				foreach($vendors as $vendor)
				{
					if(in_array($area,explode(",",$vendor['vendor_area'])))
					{
						$strVendors .= "
							<h5>".$vendor['vendor_name']."</h5>
							<p><strong> Address : </strong>".$vendor["vendor_address"]."<br /> 
							<strong>Phone : </strong>".$vendor["vendor_phone"]."<br /> 
							<strong>Mobile : </strong>".$vendor["vendor_mobile"]."<br /> 
							<strong>Email : </strong>".$vendor["vendor_email"]."<br /> 
							</p>
							<hr class = 'soft'>
						";
					}
				}
				$retVal[$order['order_id']]['vendors'] = $strVendors;	
			}			
		}
		return $retVal;
	}
	
	function finalizedOrder()
	{
		$this->load->model("admin/sales_model");
		$rcvdarr = $_POST;
		$insertArr = array
		(
			"order_id" =>	1260 + intval($rcvdarr["orderid"]),
			"customer_id" => $rcvdarr["custid"],
			"vendor_ids" => serialize($rcvdarr["vendors"]),
			"order_date" => $rcvdarr["order_date"],
			"shipping_address" => $rcvdarr["shippingaddress"],
			"shipping_area" => $rcvdarr["area"],
			"shipping_pin" => $rcvdarr["shippingpin"],
			"product_ids" => serialize($rcvdarr["prod_id"]),
			"product_quantities" => serialize($rcvdarr["quantity"]),
			"delivered_by" => $rcvdarr["delvby"],
			"created_by" => $this->userData[0]["admin_id"],
			"created_date"=> Date("Y-m-d H:m:s")
		);
	//	echo "<pre>";print_r($insertArr);die;
		$this->sales_model->insertinvoice($insertArr);
		$this->sales_model->delete_pendingorder($rcvdarr["orderid"]);
		redirect(base_url()."admin/sales/sales_invoice","refresh");
	}
	
	function sales_invoice()
	{
		$this->load->model("admin/sales_model");
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);			
		$orderData = $this->sales_model->getSalesInvoice();
		$headings = array
		( 
			"order_id"=>"Order No.",
			"customer_name"=>"Customer Name",
			"delivery_name" => "Delivery Boy",
			"order_date"=>"Order Date",
			"shipping_address"=>"Shipping Address",
			"shipping_area"=>"Shipping Area",
			"shipping_pin"=>"Shipping PIN",
			"vendor_details"=>"Vendor Details",
			"creator_name"=> "Created By",
			"created_date"=>"Created On"
		);
		$label = "Sales Invoice";
		$action = array
		(
			"btns"=>array("view"),
			"text"=>array("View Sales Invoice"),
			"dbcols"=>array("order_id"),
			"link"=>array(base_url()."admin/sales/disp_invoice/%@$%"),
			"clickable"=>array()
		);
		
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$orderData,"",$action);
		$tableData["descFirst"] = TRUE;
		$this->load->view('helpers/members_table_view',$tableData);
		$this->load->view('admin/sales_inv_view');			
		$this->load->view("admin/includes/admin_footer");
	}
	
	public function disp_invoice($inv_id = "0")
	{
		$data = array();
		$this->load->model("admin/sales_model");
		$this->load->model("admin/user_model");
		$this->load->model("admin/product_model");		
		$data["inv"] = $this->sales_model->getSalesInvoice($inv_id);$data["inv"] = $data["inv"][0]; 
		$data["cust"] = $this->user_model->getAllUsers($data["inv"]["customer_id"]);$data["cust"] = $data["cust"][0];
		$productids = unserialize($data["inv"]["product_ids"]);
		$data["quantities"] = unserialize($data["inv"]["product_quantities"]);
		$data["products"] = $this->product_model->getProduct($productids," product_id, product_name, product_price, discount_price, discount_status ");		
		$this->load->view("admin/disp_invoice_view",$data);		
	}
}
?>