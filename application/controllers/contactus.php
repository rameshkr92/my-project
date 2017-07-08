<?php include("securearea.php"); ?>
<?php
class Contactus extends Securearea 
{ 
	function __construct()
	{		
		parent::__construct();
	}
	public function index()
	{
		$this->loadHeader($this,FALSE,"Contact Us - HalalKart");
		
		//load sidebar
		$this->loadSidebar($this);
		
		$this->load->view("contactus_view");
		
			//load footer
		$this->loadFooter($this);
	}
}
?>