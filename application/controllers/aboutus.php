<?php include("securearea.php"); ?> 
<?php
class Aboutus extends Securearea 
{
	function __construct()
	{		
		parent::__construct();
	}
	public function index()
	{		
		$this->loadHeader($this,FALSE,"About Us - HalalKart");
		
		//load sidebar
		$this->loadSidebar($this);
		
		$this->load->view("aboutus_view");
		
			//load footer
		$this->loadFooter($this);
	}
}
?>