<?php include("securearea.php"); ?>
<?php
class Register extends Securearea 
{
	public $redirect = "";
	function __construct()
	{		
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("user_model");
		if(isset($_GET['redirect'])){$this->redirect = $_GET['redirect'];}
		else $this->redirect = base_url();
	}
	
	public function index()
	{
		$this->viewRegistrationForm();
	}
	
	public function viewRegistrationForm($edit = FALSE,$user_id = "")
	{
		if($this->isloggedin && $edit == FALSE)
		{
			redirect($this->redirect,"refresh");
		}
		//load header
		$this->loadHeader($this);
		
		//load sidebar
		$this->loadSidebar($this);
		
		//load middle content
		$this->load->model("admin/areas_model");
		$view["areas"] = $this->areas_model->getAreas("","area_name,area_pin");		
		$view["obj"] = $this;
		$view["edit"]=$edit;
		$view["user_id"]=$user_id;
		$this->load->view('register_view',$view);	
		
		//load footer
		$this->loadFooter($this);		
	}
	
	public function submitform()
	{		
		if(empty($_POST))redirect(base_url()."register","refresh");
		$edit = TRUE;
		$chkunique = "";
		if(isset($_POST["is_new_customer"]) && $_POST["is_new_customer"] == "1")
		{
			$edit = FALSE;
			$chkunique = '|is_unique['.DBPREFIX.'_users.email]';
		}			
		$this->load->library('form_validation');		
		$config = array(               
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'required|trim|min_length[6]|matches[confpassword]'
                  ),
			  array(
                 'field'   => 'confpassword', 
                 'label'   => 'Confirm Password', 
                 'rules'   => 'required'
              ),
	         array(
	                 'field'   => 'first_name', 
	                 'label'   => 'First Name', 
	                 'rules'   => 'trim|required|xss_clean'
	              ), 
			 array(
                     'field'   => 'middle_name', 
                     'label'   => 'Middle Name', 
                     'rules'   => 'trim|xss_clean'
                  ),   
			 array(
                     'field'   => 'last_name', 
                     'label'   => 'Last Name', 
                     'rules'   => 'trim|required|xss_clean'
                  ),
			 array(
                     'field'   => 'date', 
                     'label'   => 'Date', 
                     'rules'   => 'trim|required|xss_clean'
                  ),
			 array(
                     'field'   => 'month', 
                     'label'   => 'Month', 
                     'rules'   => 'trim|required|xss_clean'
                  ),
			 array(
                     'field'   => 'year', 
                     'label'   => 'Year', 
                     'rules'   => 'trim|required|xss_clean'
                  ),
			array(
                     'field'   => 'phone', 
                     'label'   => 'Phone Number', 
                     'rules'   => 'trim|xss_clean'
                  ),
			array(
                     'field'   => 'mobile', 
                     'label'   => 'Mobile Number', 
                     'rules'   => 'trim|required|xss_clean|exact_length[10]|integer'
                  ),
             array(
                     'field'   => 'email', 
                     'label'   => 'Email', 
                     'rules'   => 'trim|valid_email'.$chkunique
                  ),
             array(
                     'field'   => 'address', 
                     'label'   => 'Address', 
                     'rules'   => 'required'
                  ),
             array(
                     'field'   => 'area', 
                     'label'   => 'Area', 
                     'rules'   => 'trim|required'
                  ),
             array(
                     'field'   => 'PIN', 
                     'label'   => 'Postal Code', 
                     'rules'   => 'trim|required|min_length[6]'
                  ),
			 array(
                     'field'   => 'gender', 
                     'label'   => 'Gender', 
                     'rules'   => 'trim|required'
                  )
            );
			if($edit == FALSE)
			{
				$config[] = array(
			                     'field'   => 'username', 
			                     'label'   => 'Username', 
			                     'rules'   => 'required|trim|min_length[6]|is_unique['.DBPREFIX.'_users.userid]'
			                  );
			}					
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{			
			$this->viewRegistrationForm($edit,(isset($_POST["customer_id"])?$_POST["customer_id"]:""));
			$this->session->set_flashdata("alert",json_encode(array("type"=>"block","msg"=>"<strong>Please Re-Check your Form.</strong>")));
		}
		else
		{
			if($edit)
			{
				if(isset($_POST["customer_id"]))
				{
					$updateData = $this->formatInsertData($_POST);					
					if($this->user_model->updateUser($_POST["customer_id"],$updateData) == TRUE)
					{						
						$this->session->set_flashdata("alert",json_encode(array("type"=>"success","msg"=>"User Updated Successfully")));
						/*
						delete_cookie("ecomm_userData");
						$array_items = array('userdata' => '', 'password' => '');
						$this->session->unset_userdata($array_items);*/
						redirect(base_url()."register/useredit/".$_POST["customer_id"]);
					}
				}				
				redirect($this->redirect,"refresh");
			}
			else
			{
				$insertData = $this->formatInsertData($_POST,TRUE);
				if($this->user_model->addNewUser($insertData))
				{
					$this->checkuser();
					$this->session->set_flashdata("alert",json_encode(array("type"=>"success","msg"=>"User Created Successfully")));
				}
				else
				{
					$this->session->set_flashdata("alert",json_encode(array("type"=>"block","msg"=>"User cannot be created")));
				}
				redirect($this->redirect,"refresh");
			}
		}
	//	echo "<pre>";print_r($_POST);die;
	}
	
	public function useredit($user_id)
	{
		if(!$this->isloggedin || $this->userData["id"] != $user_id)
		{
			redirect($this->redirect,"refresh");
		}
		//load header
		$this->loadHeader($this);
		
		//load sidebar
		$this->loadSidebar($this);
		
		//load middle content
		$view["areas"] = $this->areas;
		$view["formData"] = $this->user_model->getUserByID($user_id);
		$view["formData"] = $view["formData"][0];
		if(!($view["formData"]))redirect($this->redirect,"refresh");		
		$view["obj"] = $this;
		$this->load->view('register_view',$view);		
		
		//load footer
		$this->loadFooter($this);
	}
	
	public function checkUserID($user_id)
	{
		if($this->user_model->checkUserId($user_id))
		{
			echo json_encode(array("status"=>"present","data"=>$user_id));
		}
		else
		{
			echo json_encode(array("status"=>"notpresent","data"=>$user_id));
		}
	}
	
	private function formatInsertData($postData,$insert = FALSE)
	{		
		$retData = array
		(			
			"password"=>$postData["password"],
			"firstname"=>$postData["first_name"],
			"middlename"=>$postData["middle_name"],
			"lastname"=>$postData["last_name"],
			"email"=>$postData["email"],
			"dob"=>$postData["year"]."-".$postData["month"]."-".$postData["date"],
			"mobile"=>$postData["mobile"],
			"telephone"=>$postData["phone"],
			"address"=>$postData["address"],
			"area"=>$postData["area"],
			"PIN"=>$postData["PIN"],
			"gender"=>$postData["gender"],
		);
		if($insert == TRUE)
		{
			$retData["userid"]=$postData["username"];
			$retData["shippingaddress"]=$retData["address"];
			$retData["shipping_area"]=$retData["area"];
			$retData["shipping_PIN"]=$retData["PIN"];
		}
		return $retData;
	}
}
?>