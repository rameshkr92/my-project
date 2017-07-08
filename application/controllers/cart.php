<?php include("securearea.php"); ?>
<?php
class Cart extends Securearea 
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Product_model");
	}
	
	public function addtocart($product_id = "",$quantity = "1",$is_ajax = 1)
	{
		if($product_id == "")redirect(base_url(),"refresh");
		if(is_array($product_id))
		{
			$where = "AND product_id IN ('".implode("','",$product_id)."')";			
		}
		else $where = "AND product_id = '".$product_id."'";
		$products = $this->product_model->getProduct("","",$where);
	//	echo "<pre>";print_r($products);die;
		$cProduct = array();
		foreach($products as $key=>$product)
		{
			$id = $product["product_id"];
			$qty = $quantity;
			if($product['discount_status'] != 0)$price = $product["discount_price"];
			else $price = $product["product_price"];
			$name = $product["product_name"];
			$cProduct[] = array
			(
               'id'      => $id,
               'qty'     => $qty,
               'price'   => $price,
               'name'    => $name,
            );	
		}		 
		$this->cart->insert($cProduct);
		if($this->cart_id)
		{
		//	print_r($this->cart->contents());
			$this->updatecarttodb($this->cart->contents());						
		}
		else
		{			
			$this->addcarttodb($this->cart->contents());
		}		
		if($is_ajax)
		{
			echo "success";
		}
		else
		{
			redirect(base_url(),"refresh");
		}		
	}
	
	public function getcurrentcart($getValues = FALSE)
	{	
	//	echo $this->cart_id;die;
		if(intval($this->carttotalitems) == 0){if($getValues == TRUE){return "";}echo "";die;} //Kill it when there is no item in the cart
		//echo "calle";
		$cartprodids = $this->getCartProductIds();
		$Products = $this->getProductsData($cartprodids);
		$cartProducts = array();
		$totalprice = 0;	
		$discount = 0;	
		foreach($this->Cart_model->getCartContents($this->cart_id) as $key=>$cartitems)	
		{
			$val = array();			
			foreach($Products as $product)
			{
				if($cartitems["id"] == $product["product_id"])
				{
					$val['product_id'] = $product["product_id"];
					$val['product_name'] = $product["product_name"];	
					$val['product_image'] = $product["product_image"];
					$val['discount_price'] = number_format($product["discount_price"]);
					$val['product_price'] = number_format($product["product_price"]);
					$val['discount_status'] = $product["discount_status"];
					$val['quantity'] = $cartitems["qty"];
					$val['row_id'] = $key;					
					$val['totalprice'] = ($product['discount_status'] == "1") ? number_format($product["discount_price"] * $cartitems["qty"]) : number_format($product["product_price"] * $cartitems["qty"]);
					$totalprice += doubleval($product['product_price'] * $cartitems["qty"]);					
					$discount += ($product['discount_status'] == "1") ? doubleval(($product['product_price'] - $product["discount_price"]) * $cartitems["qty"]) : 0;
				}				
			}
			$cartProducts[] = $val;
		}
		$retArr = array
		(
			"status"=>"success",
			"productData"=>$cartProducts,
			"grossprice"=>"Rs. ".number_format(doubleval($totalprice)-doubleval($discount)),
			"totalprice"=>"Rs. ".number_format($totalprice),
			"totaldiscount"=>"Rs. ".number_format($discount),
		);
		if($getValues == TRUE)		
		{
			return $retArr;
		}
		else
		{
			echo json_encode($retArr);
		}
	//	echo "<pre>";print_r($Products);die;
	}
	
	public function removeCartItem($row_id)
	{
		$data = array(
               'rowid' => $row_id,
               'qty'   => 0
            );	
		$this->cart->update($data);		
		if($this->cart_id)
		{
			$this->updatecarttodb($this->cart->contents());
		} 
	}
	
	public function updateQuantity($row_id,$qty = "1",$getResp = FALSE)
	{
		$data = array(
               'rowid' => $row_id,
               'qty'   => $qty
            );
		$this->cart->update($data); 
		if($this->cart_id)
		{
			$this->updatecarttodb($this->cart->contents());
		}
		if($getResp)
		{
			$this->getcurrentcart();
		}
	}
	
	public function removeCart($redirect_url = "")
	{
		$this->cart->destroy();
		if($this->cart_id)
		{
			$this->updatecarttodb($this->cart_id,"");
		}
		if($redirect_url)redirect(base_url(),"refresh");
	}
	
	private function getProductsData($prod_ids)
	{
		$where = " AND product_id IN ('".implode("','",$prod_ids)."')";
		$products = $this->product_model->getProduct("","",$where);
		return $products;
	}
	
	private function getCartProductIds()
	{
		$id_array = array();
		foreach($this->cart->contents() as $cartitems)
		{
			$id_array[] = $cartitems["id"];
		}
		return $id_array;
	}
	
	private function addcarttodb($cartdata)
	{
		$cart_id = $this->Cart_model->addtoCart($cartdata);
		$cookie = array(
						    'name'   => 'cart_id',
						    'value'  => $cart_id,
						    'expire' => (365*60*60*24),
						    'domain' => '',
						    'path'   => '/',
						    'prefix' => '',
						    'secure' => FALSE
						);
		$this->input->set_cookie($cookie);
	}
	private function updatecarttodb($cartdata)
	{
		$this->Cart_model->updateCart($this->cart_id,$cartdata);		
	}
}
?>