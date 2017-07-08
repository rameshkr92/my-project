<?php include("securearea.php"); ?> 
<?php
class Faq extends Securearea 
{
	function __construct()
	{		
		parent::__construct();
	}
	public function index()
	{
		$this->loadHeader($this,FALSE,"Frequently Asked Questions - HalalKart");
		
		//load sidebar
		$this->loadSidebar($this);
		
		$this->load->view("faq_view");
		
			//load footer
		$this->loadFooter($this);
	}
}
?>