<?php include("secureaccess.php"); ?>
<?php
class Carousel extends SecureAccess 
{
	public $posteddata = "";
	function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");		
		$this->load->model("admin/carousel_model");		
	}
	public function index()
	{
		$this->listCarousel();
	}
	
	private function listCarousel()
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		
		$this->load->view("admin/carousel_view");
		
		
		$carouselData = $this->carousel_model->getCarousel();
		$carouselData = $this->createimageTag($carouselData,"carousel_image");		
		
	//	echo "<pre>"; print_r($carouselData);die;
		$headings = array(
			"carousel_id"=>"Sr. No.",
			"carousel_image"=>"Carousel Image",
			"carousel_link"=>"Carousel Link",
			"carousel_caption"=>"Caption",
			"display_status"=>"Display Status"
			);
		$statusval = array(
							1 => array(
								"value" =>"active",
								"text" => "Enabled"
								),
							0 =>array(
								"value" =>"inactive",
								"text" => "Disabled"
								)
					);
		$this->customtable_lib->createStatus("display_status",$statusval);				
		$label = "Carousel List";
		$action = array
		(
			"btns"=>array("edit"),
			"text"=>array("Edit"),
			"dbcols"=>array("carousel_id"),
			"link"=>array(base_url()."admin/carousel/getcarousel/%@$%"),
			"clickable"=>array("#carouselmodal")
		);
		
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$carouselData,"",$action);			
		$this->load->view('helpers/members_table_view',$tableData);
		
		
		$this->load->view("admin/includes/admin_footer");	
	}
	
	
	public function createcarousel()
	{
		if(!(empty($_POST)) && ($_POST['carousel_func'] == "create"))
		{
			$this->posteddata = $_POST;
			if($this->validatecarousel($_POST))
			{
				$this->uploadCarouselFiles($_FILES);
				$this->arrangePostData();
			//	echo "<pre>"; print_r($this->posteddata);die;
				$this->carousel_model->insertcarousel($this->posteddata);		
				$this->session->set_flashdata("success","Carousel created successfully.");	
			}
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function getcarousel($carousel_id)
	{
		echo json_encode(array("status"=>"success","data"=>$this->carousel_model->getCarousel($carousel_id)));
	}
	
	public function editedcarousel()
	{		
		if(!(empty($_POST)) && ($_POST['carousel_func'] == "edit"))
		{
			$this->posteddata = $_POST;
			if($this->validatecarousel($_POST,TRUE))
			{				
				$carousel_id = $this->posteddata['carousel_id_1'];
				$this->uploadCarouselFiles($_FILES);
				$this->arrangePostData(TRUE);
				$this->carousel_model->updatecarousel($carousel_id,$this->posteddata);	
				$this->session->set_flashdata("success","Carousel updated successfully.");			
			}			
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	private function RefreshListingPage()
	{
		redirect(base_url()."admin/carousel","refresh");
	}
	
	private function createimageTag($arrData,$rowname,$width = "",$height = "")
	{
		if(!$width && !$height)
		{
			$width = 100;
		}
		if($arrData)
		{
			foreach($arrData as $key=>$arr)
			{
			//	echo "<pre>"; print_r($key);print_r($arr);			
				$arrData[$key][$rowname] = "
					<a href = '".$arr[$rowname]."&width=500&height=500&type=imgtag' class='cboxElement'>
					<img style = 'height : ".$height."px;width : ".$width."px;' src='".$arr[$rowname]."' class='' />
					</a>
					";
			}
		}		
		return $arrData;
	}
	
	private function validatecarousel($data,$is_edit = "")
	{return TRUE;
		$chkuniq = "";
		if(!$is_edit){
			 $chkuniq = '|is_unique['.DBPREFIX.'_categories.carousel_name]';
		}
		if($this->posteddata && isset($this->posteddata['carousel_count']))
		{
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['carousel_count']; $i++)			
			{
				$this->form_validation->set_rules('carousel_name_'.$i, 'carousel Name', 'xss_clean|trim|required'.$chkuniq);
				$this->form_validation->set_rules('display_status_'.$i, 'Display Status', 'required');
			}
		}		
		if ($this->form_validation->run() == FALSE)
		{
			$errors = validation_errors();
			$this->session->set_flashdata("error", $errors);			
			return FALSE;
		}
		else			
		return TRUE;
	}
	
	private function uploadCarouselFiles($files)
	{
		$config['upload_path'] = './images/uploads/carousel/';
		$config['allowed_types'] = 'gif|jpg|png';
		for($i = 1; $i <= $this->posteddata['carousel_count']; $i++)
		{
			if(isset($files["carousel_image_".$i]))
			{				
				$config['file_name']  = "carousel_".strtotime($this->cur_date_time).$this->userData[0]['admin_id'];	
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload("carousel_image_".$i))
				{
					$error = array('info' => $this->upload->display_errors());
					$this->session->set_flashdata("error", $this->upload->display_errors());			
					$this->posteddata["carousel_image_".$i] = "";
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
				//	echo "<pre>";print_r($data);die;
				//	base_url()."images/uploads/carousel/".$data['upload_data']['file_name'];
					$arrImg = array
					(
						"base"=>"uploads",
						"type"=>"carousel",
						"img"=>$data['upload_data']['file_name'],
						"width"=>100,
						"height"=>100
					);
					$img_url = base_url()."custom/images?img=".base64_encode(serialize($arrImg));
										
					$this->posteddata["carousel_image_".$i] = $img_url;
				}				
			}
			else
			{
				$this->posteddata["carousel_image_".$i] = "";
			}			
		}
//		echo "<pre>";print_r($this->posteddata);die;
	}
	
	private function arrangePostData($isUpdate = FALSE)
	{		
		if($this->posteddata && isset($this->posteddata['carousel_count']))
		{//echo "<pre>";print_r($this->posteddata);die;
			$arrRetval = array();
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['carousel_count']; $i++)			
			{	
				$arrRetval[$cnt]['carousel_caption'] = $this->posteddata["carousel_caption_".$i];
				$arrRetval[$cnt]['carousel_link'] = $this->posteddata["carousel_link_".$i];
				if(isset($this->posteddata["carousel_image_".$i]) && $this->posteddata["carousel_image_".$i] != "")
				{
					$arrRetval[$cnt]['carousel_image'] = $this->posteddata["carousel_image_".$i];
				}				
				$arrRetval[$cnt]['display_status'] = $this->posteddata["display_status_".$i];
				$cnt++;
			}
			$this->posteddata = $arrRetval;			
		//	echo "<pre>";print_r($this->posteddata);die;
		}
		else
		{
			$this->backtologin();
		}
	}
}
?>