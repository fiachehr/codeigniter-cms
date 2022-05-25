<?php
class Homepage_class extends My_Model{

/*
|--------------------------------------------------------------------------
| Class Constractor -------------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function __construct(){
		
		parent::__construct();
	
	}	

/*
|--------------------------------------------------------------------------
| Get Homepage Item List --------------------------------------------------
|--------------------------------------------------------------------------
*/

	function getHomepageItemList(){

		$this->table = "tbl_homepage";
		$this->selectConditions = array("where"=>"homeItemLanguage = '".$this->session->userdata("panelLanguage")."'");			
		return $this->getData();

	}

/*
|-------------------------------------------------------------------------
|  Action Homepage -------------------------------------------------------
|-------------------------------------------------------------------------
*/
	
	function hompageActionData($values,$id = null,$title = null){
		$this->table = "tbl_homepage";
        if($id == null){
            $values['homeItemLanguage'] = $this->session->userdata("panelLanguage");
            unset($values['submit']);		
            $this->insert($values,$values['homeItemLabel']);
        }else{
			unset($values['submit']);	
			$this->primeryKey = "homeItemID";
			$this->update($values,$id,$title);
		}
														
	}

/*
|-------------------------------------------------------------------------
|  Get Homepage Item  ----------------------------------------------------
|-------------------------------------------------------------------------
*/
	
	function getHomepageItemData($id){
	

		$this->table = "tbl_homepage";
		$this->selectConditions = array("where"=>"homeItemID = '".$id."'",
										"resultType" => "1"
										);			
				
		return $this->getData();

	}


/*
|--------------------------------------------------------------------------
| Delete Homepage Items ---------------------------------------------------
|--------------------------------------------------------------------------
*/

	function deleteHomepageItem($id,$title){	
		
		$this->table = "tbl_homepage";
		$this->selectConditions = array("select"=>"homeItemImage","where"=>"homeItemID = '".$id."'","resultType" => "1");
		$result = $this->getData();

		if($result['homeItemImage'] != ''){
			if (file_exists(HOMEPAGE.$result['homeItemImage'])) {
				unlink(HOMEPAGE.$result['homeItemImage']);
			}
		}

		$this->table = "tbl_homepage";
		$this->primeryKey = "homeItemID";
		$this->delete($id,$title);			
		
	}
/*
|--------------------------------------------------------------------------
|  Slider Action Data -----------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function sliderActionData($values,$id = null,$title = null) {

		$this->table = "tbl_slider";
        if($id == null){
            $values['sliderLanguage'] = $this->session->userdata("panelLanguage");
            unset($values['submit']);		
            $this->insert($values,$values['sliderTitle']);
        }else{
			unset($values['submit']);	
			$this->primeryKey = "sliderID";
			$this->update($values,$id,$title);
		}
														
	}

/*
|--------------------------------------------------------------------------
| Get Slider List ---------------------------------------------------------
|--------------------------------------------------------------------------
*/

    function getSliderList($limit, $segments, $page, $url) {

		$query = "SELECT * FROM tbl_slider 
		WHERE sliderLanguage = '".$this->session->userdata('panelLanguage')."'
		ORDER BY sliderID DESC";	

		return $this->paginate($limit,$segments,$page,$query,$url,"panel");

    }

/*
|--------------------------------------------------------------------------
| Get Slider Data ---------------------------------------------------------
|--------------------------------------------------------------------------
*/
	
    function getSliderData($id) {
		
		$this->table = "tbl_slider";
		$this->selectConditions = array("where"=>"sliderID = '".$id."'",
										"resultType" => "1"
										);			
				
		return $this->getData();

    }

/*
|--------------------------------------------------------------------------
| Delete Homepage Items ---------------------------------------------------
|--------------------------------------------------------------------------
*/

	function deleteSlider($id,$title){	
			
		$this->table = "tbl_slider";
		$this->selectConditions = array("select"=>"sliderImg","where"=>"sliderID = '".$id."'","resultType" => "1");
		$result = $this->getData();
		unlink(SLIDER.$result['sliderImg']);
		$this->table = "tbl_slider";
		$this->primeryKey = "sliderID";
		$this->delete($id);			
		
	}

/*
|-------------------------------------------------------------------------
|  Get Slider ------------------------------------------------------------
|-------------------------------------------------------------------------
*/
		
	function getSlider(){

		$this->table = "tbl_slider";
		$this->selectConditions = array("where"=>"sliderLanguage = 'ir'");
		return $this->getData();
		
	}

/*
|--------------------------------------------------------------------------
| Get Homepage Item  --------------------------------------------------
|--------------------------------------------------------------------------
*/

	function getHomepageItem(){

		$this->table = "tbl_homepage";
		$this->selectConditions = array("where"=>"homeItemLanguage = 'ir'");			
		return $this->getData();

	}

}
/* End of file Homepage_class.php */
/* Location: ./application/modules/newsSM/newsSM_class.php */					
