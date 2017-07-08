<?php include("securearea.php"); ?>
<?php include("cart.php"); ?>
<?php
class Checkout extends Securearea 
{
	public $oCart;
	function __construct()
	{		
		parent::__construct();
		$this->load->helper("url");	
		$this->oCart = new Cart();	
	}
	function index()
	{
		$this->viewCartDetails();
	}
	public function viewCartDetails()
	{
		$this->hidecartlist = TRUE;
		//load header
		$this->loadHeader($this);
		
		//load sidebar
		$this->loadSidebar($this);
		
		//load middle content		
		$view['obj'] = $this;
		$view['cartData'] = $this->oCart->getcurrentcart(TRUE);
		$this->load->view('cart_view',$view);
		
		//load footer
		$this->loadFooter($this);
	}
	
	public function removeItem($row_id)
	{
		$this->oCart->removeCartItem($row_id);	
		$this->oCart->getcurrentcart();
	//	redirect(base_url()."checkout","refresh");
	}
}
?>