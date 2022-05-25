<?php 
class Homepage extends CI_Controller{

	private $adminMenu;
	private $language;

/*
|--------------------------------------------------------------------------
| Class Constractor
|--------------------------------------------------------------------------
*/
	
	 function __construct(){

		parent::__construct();	
        $this->load->model("Acms_class");
        $this->load->model("Homepage_class");
		$this->load->helper("tree");
		$result = createModuleArray($this->Acms_class->getModules());
		$this->adminMenu = createAdminMenu($result,0);	
		$this->language = $this->Acms_class->siteLanguage();					

	}	

/*
|--------------------------------------------------------------------------
| ...Homepage Items List --------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function homepageItemList(){
		
		if(!isset($this->session->userdata["userGUID"])){
			redirect(base_url()."Acms/index","refresh");
		}
		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}
		$data['homepage'] = NULL;

		$data['counter'] = 1;
		$data['adminMenu'] = $this->adminMenu;
		$data['language'] = $this->language;	
		$data['resultMessage'] = null;
		$data['homepage'] = $this->Homepage_class->getHomepageItemList();
        $data['pageTitle'] = "لیست بخشهای صفحه اول";	
		$data['mainContent'] = 'homepage/homepageItemList';
		$this->load->view("layouts/panel/lists",$data);

	}

/*
|--------------------------------------------------------------------------
| Insert Homepage Item
|--------------------------------------------------------------------------
*/
	public function insertHomepageItem(){

		if(!isset($this->session->userdata["userGUID"])){
			redirect(base_url()."Acms/index","refresh");
		}
		
		$data['adminMenu'] = $this->adminMenu;
		$data['language'] = $this->language;	
		$data['resultMessage'] = null;
		
		if($this->session->userdata("userStatus") == "a"){	
            if($this->input->post('submit') == "submit"){
				$this->form_validation->run('insertHomeItem');	
                if($this->form_validation->run() == FALSE){	
                    $data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);										
				}else{
                    $insert = $this->Homepage_class->hompageActionData($this->input->post());
					$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_INSERT_SUCCESS,"url"=>base_url()."Homepage/homepageItemList");
                }	
            }
        }else{
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
			$data['homepage'] = NULL;			
        }

		$data['pageTitle'] = 'درج بخش جدید';
		$data['mainContent'] = 'homepage/insertHomepageItem';
		$this->load->view("layouts/panel/forms",$data);		

	}

/*
|--------------------------------------------------------------------------
| Edit HomePage Item ------------------------------------------------------
|--------------------------------------------------------------------------
*/
	public function editHomepageItem($id){

		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if($data['permission'] == "2" || $data['permission'] == "1" || $data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}

		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		$fileFlag = true;
		
		$data['item'] = $this->Homepage_class->getHomepageItemData($id);		
		$_POST['homeItemImage']  = $data['item']['homeItemImage'];	

		if($this->input->post("submit") == "submit"){
				
			if ($_FILES['homeItemImage']['name']) {
				$this->load->helper("uploadfile");
				$uploadConfig = array('file' => 'homeItemImage', 'path' => HOMEPAGE, 'type' => 'jpg|png|gif', 'maxSize' => 3000);
				$upload = fileUpload($uploadConfig);
				if($upload['filename'] == null){
					$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>$upload['error'],"url"=>null);
					$fileFlag = false;
				}else{
					if($_POST['homeItemImage'] != ''){
						unlink(HOMEPAGE.$data['item']['homeItemImage']);
					}
					$_POST['homeItemImage'] = $upload['filename'];
				}				
			}  

			if($fileFlag == true){
				if($this->Acms_class->checkAccess($data['permission'])){
					$this->Homepage_class->hompageActionData($this->input->post(),$id,$data['item']['homeItemLabel']);
					$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_UPDATE_SUCCESS,"url"=>base_url()."Homepage/homepageItemList");
				}else{
					$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Homepage/homepageItemList");
				}
			}									
		}		
								
		$data['pageTitle'] = "ویرایش | ".$data['item']['homeItemLabel'];			
		$data['mainContent'] = 'homepage/editHomepageItem';
		$this->load->view("layouts/panel/forms",$data);			

	}


/*
|--------------------------------------------------------------------------
| Delete Homepage Item ----------------------------------------------------
|--------------------------------------------------------------------------
*/	

	public function	deleteHomepageItem($id,$title){
		
		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if($permission == "a"){
			$result = $this->Homepage_class->deleteHomepageItem($id,urldecode($title));
			echo "<script>alert('اطلاعات مورد نظر حذف گردید')</script>";
		}else{
			echo "<script>alert('شما مجوز حذف اطلاعات را ندارید')</script>";		
		}
		redirect(base_url()."Homepage/homepageItemList","refresh");
		
	}

/*
|--------------------------------------------------------------------------
| Delete Homepage Item Ajax------------------------------------------------
|--------------------------------------------------------------------------
*/	

	public function	deleteHomepageItemAjax(){

		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if($permission == "a" || $permission == "3"){
			$result = $this->Homepage_class->deleteHomepageItem($this->input->get("id"),urldecode($this->input->get("title")));
			echo "1";
		}else{
			echo "0";		
		}
	}

/*
|--------------------------------------------------------------------------
| Slider List -------------------------------------------------------------
|--------------------------------------------------------------------------
*/	

    function sliderList($page = 0) {

		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if( $data['permission'] == "1" || $data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}
	
		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		$data['counter'] = 1;
		$data['page'] = $page;
		$data['slider'] = $this->Homepage_class->getSliderList(25, 3, $page, base_url() . "Homepage/sliderList");
		$data['pageTitle'] = "لیست اسلایدر";
		$data['mainContent'] = 'homepage/sliderList';
		$this->load->view("layouts/panel/lists", $data);
		}
		
		
/*
|--------------------------------------------------------------------------
| Insert Slider -----------------------------------------------------------
|--------------------------------------------------------------------------
*/	
	
	function insertSlider() {
		
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if( $data['permission'] == "1" || $data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}
	
		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		$data['ckeditor'] = CKEDITOR;
		$fileFlag = true;
		
		//form submit	
			
		if ($this->input->post('submit') == "submit") {
	
			if ($_FILES['sliderImg']['name']) {
				$this->load->helper("uploadfile");
				$uploadConfig = array('file' => 'sliderImg', 'path' => SLIDER, 'type' => 'jpg|png|gif', 'maxSize' => 3000);
				$upload = fileUpload($uploadConfig);
				if($upload['filename'] == null){
					$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>$upload['error'],"url"=>null);
					$fileFlag = false;
				}else{
					$_POST['sliderImg'] = $upload['filename'];
				}		
				
				if($fileFlag == true){
					if($this->Acms_class->checkAccess($data['permission'])){
						$this->Homepage_class->sliderActionData($this->input->post());
						$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_UPDATE_SUCCESS,"url"=>base_url()."Homepage/sliderList");
					}else{
						$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Homepage/sliderList");
					}
				}				
			} else {
				$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>"تصویری انتخاب نشده","url"=>null);
			}
					
		}
	
		$data['pageTitle'] = "درج اسلایدر";
		$data['mainContent'] = 'homepage/insertSlider';
		$this->load->view("layouts/panel/forms", $data);
		
		}
	
/*
|--------------------------------------------------------------------------
| Edit Slider -----------------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function editSlider($id) {
		
		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if( $data['permission'] == "1" || $data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}

		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		$data['ckeditor'] = CKEDITOR;
		$fileFlag = true;
		
		$data['slider'] = $this->Homepage_class->getSliderData($id);		
		$_POST['sliderImg']  = $data['slider']['sliderImg'];	

		if($this->input->post("submit") == "submit"){
				
			if ($_FILES['sliderImg']['name']) {
				$this->load->helper("uploadfile");
				$uploadConfig = array('file' => 'sliderImg', 'path' => SLIDER, 'type' => 'jpg|png|gif', 'maxSize' => 3000);
				$upload = fileUpload($uploadConfig);
				if($upload['filename'] == null){
					$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>$upload['error'],"url"=>null);
					$fileFlag = false;
				}else{
					if($_POST['sliderImg'] != ''){
						unlink(SLIDER.$data['slider']['sliderImg']);
					}
					$_POST['sliderImg'] = $upload['filename'];
				}				
			}  

			if($fileFlag == true){
				if($this->Acms_class->checkAccess($data['permission'])){
					$this->Homepage_class->sliderActionData($this->input->post(),$id,$data['slider']['sliderTitle']);
					$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_UPDATE_SUCCESS,"url"=>base_url()."Homepage/sliderList");
				}else{
					$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Homepage/sliderList");
				}
			}									
		}		
								
		$data['pageTitle'] = "ویرایش | ".$data['slider']['sliderTitle'];			
		$data['mainContent'] = 'homepage/editSlider';
		$this->load->view("layouts/panel/forms",$data);			

	}
		  
/*
|--------------------------------------------------------------------------
| Delete Homepage Item ----------------------------------------------------
|--------------------------------------------------------------------------
*/	

	public function	deleteSlider($id,$title = null){
			
		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if($permission == "a" || $permission == "3"){
			$result = $this->Homepage_class->deleteSlider($id,urldecode($title));
			echo "<script>alert('اطلاعات مورد نظر حذف گردید');window.location = '".base_url()."Homepage/sliderList';</script>";
		}else{
			echo "<script>alert('شما مجوز حذف اطلاعات را ندارید');window.location = '".base_url()."Homepage/sliderList';</script>";		
		}
		
	}

/*
|--------------------------------------------------------------------------
| Delete Homepage Item Ajax------------------------------------------------
|--------------------------------------------------------------------------
*/	

	public function	deleteSliderAjax(){

		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if($permission == "a" || $permission == "3"){
			$result = $this->Homepage_class->deleteSlider($this->input->get("id"),urldecode($this->input->get("title")));
			echo "1";
		}else{
			echo "0";		
		}
	}

}
