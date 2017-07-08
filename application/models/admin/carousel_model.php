<?php
class Carousel_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	///////     ----------------------- carousel -----------------------------      ////////
	function getCarousel($carousel_id = "",$arrwhere = "")
	{
		if($carousel_id || $arrwhere)
		{
			if($carousel_id && $arrwhere)
			{
				$arrwhere["carousel_id"] = $carousel_id;
			}
			else if($carousel_id)$arrwhere = array("carousel_id"=>$carousel_id);
			$this->db->where($arrwhere);
		}
		$result = $this->db->get(DBPREFIX."_carousel");
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();			
		}
	}
	
	function insertcarousel($data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$this->db->insert_batch(DBPREFIX."_carousel", $data); 
		return TRUE;
	}
	
	
	
	/**
	* this function is common for carousel and subcarousel
	* @param undefined $category_id
	* @param undefined $data
	* 
	*/
	function updatecarousel($carousel_id,$data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$arr = array('carousel_id' => $carousel_id);		
		$this->db->where($arr); 
		$this->db->update(DBPREFIX."_carousel", $data[0]);		
	//	echo "update".$carousel_id;print_r($data);die;
		return TRUE;
	}	
}	
?>