<?php
class Category extends CI_Controller{
	
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
		$this->load->model("Category_class");	
		$this->load->helper("tree");
		$result = createModuleArray($this->Acms_class->getModules());
		$this->adminMenu = createAdminMenu($result,0);	
		$this->language = $this->Acms_class->siteLanguage();		
	
	}

/*
|--------------------------------------------------------------------------
| ...Get Type Of Selected Category .:Jauery:.
|--------------------------------------------------------------------------
*/	

	public function	getCatData(){

		$permistion = $this->Acms_class->checkPermission(__FUNCTION__);
		if($permistion != "0"){		
			$type = $this->Category_class->getCatType($this->input->get("id"));
			$result = array("permission"=>$permistion,"type"=>$type['categoryType'],"module"=>$type['categoryModule']);
			echo json_encode($result);
		}else{
			return false;
		}
		
	}

/*
|--------------------------------------------------------------------------
| ...Get Suggestion Tag List .:Jauery:.
|--------------------------------------------------------------------------
*/	

	public function	getTagList(){

		$result = $this->Category_class->getTagList($this->input->post("keyword"));
		echo json_encode($result);
	
	}

/*
|--------------------------------------------------------------------------
| ...Get Suggestion Tag List .:Jauery:.
|--------------------------------------------------------------------------
*/	

	public function	deleteCategoryImage(){

		$this->Category_class->deleteCategoryImage($this->input->post("id"));
		unlink(CATEGORY.$this->input->post("image"));
		echo json_encode(1);  

	}


/*
|--------------------------------------------------------------------------
| .:Pages And Categories List:. -------------------------------------------
|--------------------------------------------------------------------------
*/	
	
	public function	pageAndCatList($id = null){
		
		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}

		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		$data['modules'] = $this->Category_class->moduleList();	
		$data['id'] = $id;

		if($id == null){
			$data['tree'] = 'ماژول مورد نظر را انتخاب کنید';
		}else{
			$queryResult = $this->Category_class->getModuleCategory($id);
			if(count($queryResult) == 0){			
				$data['tree'] = "موردی یافت نشد";		
			}else{		
				$result = createArray($queryResult);	
				$data['tree'] = createTree($result,0,"createCatMenu"); 			 						
			}	
		}
		
		$data['pageTitle'] = "لیست دسته بندی و صفحات";			
		$data['mainContent'] = 'category/pageAndCatList';
		$this->load->view("layouts/panel/forms",$data);	
	}

/*
|--------------------------------------------------------------------------
| .:Insert Category:. -----------------------------------------------------
|--------------------------------------------------------------------------
*/	
	
	public function	insertCategory($id){
		
		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		$moduleConfirmation = $this->Category_class->confirmModule($id);
		if($data['permission'] == "0" || $moduleConfirmation == false){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}

		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
	
		$data['category'] = array("title" => "");
		$_POST['categoryImg']  = null;
		$data['categoryModule'] = $_POST['categoryModule'] = $id;
		$fileFlag = true;
		$typeFlag = true;

		$queryResult = $this->Category_class->getModuleCategory($id);
		if(count($queryResult) == 0){			
			$data['tree'] = "موردی یافت نشد";		
		}else{		
			$result = createArray($queryResult);	
			$data['tree'] = createTree($result,0,"parentCategory"); 			 						
		}	
			
		if($this->input->post("submit") == "submit"){					
			$this->form_validation->run('category');	
			if($this->form_validation->run() == FALSE){			
				$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);	
				if($this->input->post("parentID") != "0"){	
					$data['category'] = $this->Category_class->getCategoryTitle($this->input->post("parentID"));									
				}		
			}else{
				if($this->input->post('categoryType') != "c" && $id != "25"){
					$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>"نوع انتخاب شده فقط برای ماژول دسته بندی و صفحه قابل دسترس است","url"=>null);
					$data['category'] = $this->Category_class->getCategoryTitle($this->input->post("parentID"));
					$typeFlag = false;	
				}
				if ($_FILES['categoryImg']['name'] != null && $typeFlag == true) {
					$this->load->helper("uploadfile");
					$uploadConfig = array('file' => 'categoryImg', 'path' => CATEGORY, 'type' => 'jpg|png|gif', 'maxSize' => 100);
					$upload = fileUpload($uploadConfig);
					$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>$upload['error'],"url"=>null);
					if($upload['filename'] == null){
						$data['category'] = $this->Category_class->getCategoryTitle($this->input->post("parentID"));	
						$fileFlag = false;
					}else{
						$_POST['categoryImg'] = $upload['filename'];
					}				
				}  
				if($fileFlag == true && $typeFlag == true){
					if($this->Acms_class->checkAccess($data['permission'])){
						$insert = $this->Category_class->insertCategory($this->input->post(),$queryResult);
						if($insert == true){
							$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_INSERT_SUCCESS,"url"=>base_url()."Category/pageAndCatList");
						}
					}else{
						$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Category/pageAndCatList");
					}	
				}
			}
		}		
		
		$data['pageTitle'] = "درج دسته بندی و صفحه";			
		$data['mainContent'] = 'category/insertCategory';
		$this->load->view("layouts/panel/forms",$data);		
	}

/*
|--------------------------------------------------------------------------
| .:Edit Category:. 
|--------------------------------------------------------------------------
*/	
	
	public function	editCategory($id){

		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		$moduleConfirmation = $this->Category_class->confirmModule($id);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}

		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		$fileFlag = true;
		$typeFlag = true;
		$parentFlag = true;
		
		$data['category'] = $this->Category_class->categoryInfo($id);	
		$result = createArray($this->Category_class->getModuleCategory($data['category']["categoryModule"]));	
		$data['tree'] = createTree($result,0,"parentCategory"); 
		$data['parentTit'] = $this->Category_class->getCategoryTitle($data['category']["parentID"]);
		$_POST['categoryImg']  = $data['category']['categoryImg'];	
		$lastType = $data['category']['categoryType']; 		
		$lastModule = $data['category']['categoryModule']; 
		$queryResult = $this->Category_class->getModuleCategory($id);		 							
		
		if($this->input->post("submit") == "submit"){					
			$this->form_validation->run('category');	
			if($this->form_validation->run() == FALSE){
				$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_UPDATE_ERROR,"url"=>null);	
				if($this->input->post("parentID") != "0"){	
					$data['parentTit'] = $this->Category_class->getCategoryTitle($this->input->post("parentID"));									
				}					
			}else{

				if($this->input->post('parentID') == $id){
					$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>'والد انتخابی اشتباه است',"url"=>null);
					$data['parentTit'] = $this->Category_class->getCategoryTitle($this->input->post("parentID"));	
					$parentFlag = false;
				}

				if($this->input->post('categoryType') != "c" && $data['category']['categoryModule'] != "25" && $parentFlag == true){
					$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>"نوع انتخاب شده فقط برای ماژول دسته بندی و صفحه قابل دسترس است","url"=>null);
					$data['parentTit'] = $this->Category_class->getCategoryTitle($this->input->post("parentID"));	
					$typeFlag = false;	
				}

				if ($_FILES['categoryImg']['name'] != null && $typeFlag == true) {
					$this->load->helper("uploadfile");
					$uploadConfig = array('file' => 'categoryImg', 'path' => CATEGORY, 'type' => 'jpg|png|gif', 'maxSize' => 100);
					$upload = fileUpload($uploadConfig);
					if($upload['filename'] == null){
						$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>$upload['error'],"url"=>null);
						$data['parentTit'] = $this->Category_class->getCategoryTitle($this->input->post("parentID"));	
						$fileFlag = false;
					}else{
						if($data['category']['categoryImg'] != ''){
							unlink(CATEGORY.$data['category']['categoryImg']);
						}
						$_POST['categoryImg'] = $upload['filename'];
					}				
				}  

				if($typeFlag == true && $fileFlag == true && $parentFlag == true){
					if($this->Acms_class->checkAccess($data['permission'])){
						$update = $this->Category_class->updateCategory($this->input->post(),$id,$data['category']['title'],$lastType,$lastModule,$queryResult);
						if($update == true){
							$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_UPDATE_SUCCESS,"url"=>base_url()."category/pageAndCatList");
						}		
					}else{
						$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."category/pageAndCatList");
					}
				}			
			}				
		}		
		
		$data['pageTitle'] = " ویرایش دسته بندی و صفحه | ".$data['category']['title'] ;			
		$data['mainContent'] = 'category/editCategory';
		$this->load->view("layouts/panel/forms",$data);		
	}


/*
|--------------------------------------------------------------------------
| .:Delete Category:. -----------------------------------------------------
|--------------------------------------------------------------------------
*/	

	public function	deleteCategory($id,$title){

		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if($permission == "a" || $permission == "3"){
			$result = $this->Category_class->deleteCategory($id,urldecode($title));
			echo "<script>alert('".$result."');window.location = '".base_url()."Category/pageAndCatList';</script>";
		}else{
			echo "<script>alert('شما مجوز حذف اطلاعات را ندارید');window.location = '".base_url()."Category/pageAndCatList';</script>";		
		}
			
	}

/*
|--------------------------------------------------------------------------
| .:Edit Page Content:.
|--------------------------------------------------------------------------
*/	
	
	public function	pageContent($id,$title){
		
		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		$moduleConfirmation = $this->Category_class->confirmModule($id);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}

		$data['dataRegister'] = NULL;
		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;


		$data['ckeditor'] = CKEDITOR;
		$data['pageContent'] = $this->Category_class->getPageContent($id);
		$data['id'] = $id;
		$data['title'] = str_replace("-"," ",urldecode($title));
		$action = "edit";
		
		if(count($data['pageContent']) == 0){
			$action = "insert";
			$data['pageContent'] = array("contentTitle"=>"","contentKeywords"=>"","contentDesc"=>"","contentBody"=>"");
		}
		
		if($this->input->post("submit") == "submit"){

			if($this->Acms_class->checkAccess($data['permission'])){
				$this->Category_class->insertPageContent($this->input->post(),$action,$id,$data['title']);
				$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_UPDATE_SUCCESS,"url"=>base_url()."category/pageAndCatList");
			}else{
				$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."category/pageAndCatList");
			}											
			
		}
		
		$data['pageTitle'] = "ویرایش محتوی صفحه | ".$data['title'];			
		$data['mainContent'] = 'category/pageContent';
		$this->load->view("layouts/panel/forms",$data);		
	}

/*
|--------------------------------------------------------------------------
| .:Edit Page Link:.
|--------------------------------------------------------------------------
*/	
	
	public function	addLink($id,$title){
		
		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		$moduleConfirmation = $this->Category_class->confirmModule($id);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}

		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		$data['id'] = $id;
		$data['title'] = $title;
		$action = "edit";
		$data['pageLink'] = $this->Category_class->getPageLink($id,"l");
		
		if(count($data['pageLink']) == 0){		
			$action = "insert";
			$data['pageLink'] = array("linkURL"=>"");			
		}
			
		if($this->input->post("submit") == "submit"){
			if($this->Acms_class->checkAccess($data['permission'])){
				$this->Category_class->insertPageLink($this->input->post(),$action,$id);
				$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_UPDATE_SUCCESS,"url"=>base_url()."category/pageAndCatList");
			}else{
				$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."category/pageAndCatList");
			}			
		}
		
		$data['pageTitle'] = "ویرایش لینک | ".urldecode($title);			
		$data['mainContent'] = 'category/addLink';
		$this->load->view("layouts/panel/forms",$data);		
	}

/*
|--------------------------------------------------------------------------
| .:Edit Page Attachment:.
|--------------------------------------------------------------------------
*/	
	
	public function	addAttachment($id,$title){
		
		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		$moduleConfirmation = $this->Category_class->confirmModule($id);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}

		$data['language'] = $this->language;
		$data['adminMenu'] = $this->adminMenu;
		$data['id'] = $id;
		$data['title'] = $title;
		$data['fileError'] = NULL;
		$action = "edit";
		$attachment = NULL;
		$data['pageLink'] = $this->Category_class->getPageLink($id,"a");
		
		if(count($data['pageLink']) == 0){
			$action = "insert";
			$data['linkURL'] = "فایلی درج نشده است";
		}else{
			$data['linkURL'] = "<a target=\"_blank\" href=\"".base_url()."assets/uploads/attachment/".$data['pageLink']['linkURL']."\">فایل درج شده</a>";
		}
						
		if($this->input->post("submit") == "submit"){
			if($this->Acms_class->checkAccess($data['permission'])){
				$this->load->helper("uploadfile");
				$uploadConfig = array('file' => 'attachment', 'path' => CAT_ATTACHMENT, 'type' => 'jpg|png|pdf|docx|zip', 'maxSize' => 1500);
				$upload = fileUpload($uploadConfig);
				if($upload['filename'] == null){
					$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_SUCCESS,"message"=>$upload['error'],"url"=>null);
				}else{
					if($data['pageLink'] != 0){
						unlink(CAT_ATTACHMENT.$data['pageLink']['linkURL']);
					}
					$values['linkURL'] = $upload['filename'];
					$this->Category_class->insertPageLink($values,$action,$id,'attach');
					$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_UPDATE_SUCCESS,"url"=>base_url()."category/pageAndCatList");
				}
			}else{
				$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."category/pageAndCatList");
			}			
		}

		$data['pageTitle'] = "ویرایش فایل | ".urldecode($title);			
		$data['mainContent'] = 'category/addAttachment';
		$this->load->view("layouts/panel/forms",$data);		
	}

/*
|--------------------------------------------------------------------------
| .:Category Index Edit
|--------------------------------------------------------------------------
*/	

	function categoryIndex($parentID,$title){
		
		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}
		$data['parentID'] = $parentID;
		$data['title'] = $title;
		$data['jqueryUI'] = "true";
		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		$data['categoryList'] = $this->Category_class->getMenuIndex($parentID);			
		if(count($data['categoryList']) == 0){		
			echo "<script>alert('این دسته بندی فاقد زیر دسته بندی می باشد')</script>";
			redirect(base_url().'Category/pageAndCatList','refresh');		
		}	

		if($this->input->post("submit") == "submit"){
			if($this->Acms_class->checkAccess($data['permission'])){
				$this->Category_class->changeCategoryIndex($this->input->post('indexList'));
				$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_UPDATE_SUCCESS,"url"=>base_url()."category/pageAndCatList");
			}else{
				$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."category/pageAndCatList");
			}			
		}			

		$data['pageTitle'] = "الویت بندی دسته بندیها و منو ها | ".urldecode($title);			
		$data['mainContent'] = 'category/categoryIndex';
		$this->load->view("layouts/panel/forms",$data);					

	}

/*
|--------------------------------------------------------------------------
| ...Contact List ACMS ----------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function contactList($page = 0){
			
		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}
		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		$data['page'] = $page;
		$data['counter'] = $page+1;
				
		$data['contact'] = $this->Category_class->getContactList(25,3,$page,base_url()."Category/contactList");
		$data['pageTitle'] = "لیست اطلاعات ارتباطی";			
		$data['mainContent'] = 'category/contactList';
		$this->load->view("layouts/panel/lists",$data);		

	}

/*
|--------------------------------------------------------------------------
| Insert Contact ----------------------------------------------------------
|--------------------------------------------------------------------------
*/
	public function insertContact(){

		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}
		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;			    

		//form submit	
		
		if($this->input->post('submit') == "submit"){	
			$this->form_validation->run('contact');		
			if($this->form_validation->run() == FALSE){	
				$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);										
			}else{				
				if($this->Acms_class->checkAccess($data['permission'])){
					$this->Category_class->actionContactData($this->input->post());
					$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_INSERT_SUCCESS,"url"=>base_url()."Category/contactList");
				}else{
					$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Category/contactList");
				}	
			}
		
		}	

		$data['pageTitle'] = 'درج اطلاعات ارتباطی جدید';
		$data['mainContent'] = 'category/insertContact';
		$this->load->view("layouts/panel/forms",$data);		

	}

/*
|--------------------------------------------------------------------------
| Edit Contact ------------------------------------------------------------
|--------------------------------------------------------------------------
*/
	public function editContact($id,$page){

		// User Permissions And Menubar
		$this->load->helper("str");
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}
		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		
		// Define Variable

		$data['page'] = $page;
		$data['contact'] = $this->Category_class->getContactData($id);

		//form submit	
		
		if($this->input->post('submit') == "submit"){	
			$this->form_validation->run('contact');		
			if($this->form_validation->run() == FALSE){	
				$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);										
			}else{
				if($this->Acms_class->checkAccess($data['permission'])){
						$insert = $this->Category_class->actionContactData($this->input->post(),$id,$data['contact']['contactTitle']);
						$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_UPDATE_SUCCESS,"url"=>base_url()."category/contactList");				
				}else{
					$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."category/contactList");
				}	
			}
		
		}	

		$data['pageTitle'] = 'ویرایش اطلاعات ارتباطی | '.$data['contact']['contactTitle'];
		$data['mainContent'] = 'category/editContact';
		$this->load->view("layouts/panel/forms",$data);		

	}

/*
|--------------------------------------------------------------------------
| Delete Contact ------------------------------------------------------------
|--------------------------------------------------------------------------
*/

	public function	deleteContact($id,$title){
			
		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if($permission == "a" || $permission == "3"){
			$result = $this->Category_class->deleteContact($id,urldecode($title));
			echo "<script>alert('اطلاعات مورد نظر حذف گردید');window.location = '".base_url()."category/contactList';</script>";
		}else{
			echo "<script>alert('شما مجوز حذف اطلاعات را ندارید');window.location = '".base_url()."category/contactList';</script>";		
		}

		
	}

/*
|--------------------------------------------------------------------------
| Delete Homepage Item Ajax------------------------------------------------
|--------------------------------------------------------------------------
*/	

	public function	deleteContactAjax(){

		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if($permission == "a" || $permission == "3"){
			$result = $this->Category_class->deleteContact($this->input->get("id"),urldecode($this->input->get("title")));
			echo "1";
		}else{
			echo "0";		
		}
	}

/*
|--------------------------------------------------------------------------
| Page View -------------------------------------------------------------
|--------------------------------------------------------------------------
*/	

public function	pageView($title){
			
	$this->load->library('cart');
	$this->load->model("Category_class");
	$this->load->helper("tree");
	$this->load->model("Link_class");
	$data['link'] = $this->Link_class->getLinkList('f');
	$queryResult = $this->Category_class->getAllCategory();
	$result = createArray($queryResult);	
	$data['menubar'] = createMenubar($result,0,"selectMultiCat");	
	$data['pageContent'] = $this->Category_class->getPageContentView(urldecode($this->uri->segment(count($this->uri->segments))));		

	
	if($data['pageContent'][1] == "c" && isset($data['pageContent'][0]['contentTitle'])){
		
		$data['pageTitle'] = $data['pageContent'][0]['contentTitle'];
		$data['pageDesc'] = $data['pageContent'][0]['contentDesc'];
		$data['pageKeywords'] = $data['pageContent'][0]['contentKeywords'];
		
	}elseif($data['pageContent'][1] == "f"){
		
		$data['pageTitle'] = $data['pageDesc'] = $data['pageKeywords'] = str_replace("-"," ",urldecode($this->uri->segment(count($this->uri->segments))));
		$this->load->helper("captcha");
		$this->load->helper("file");
		delete_files('./assets/captcha/public/');
		$data['cap'] = $this->Category_class->Captcha(4, 140, 35, 900,"assets/captcha/public/");
		$data['captchaImg'] = $data['cap']['image'];
	
	}elseif($data['pageContent'][1] == "c" && !isset($data['pageContent'][0][0]['contentTitle'])){
		
		$data['pageTitle'] = $data['pageDesc'] = $data['pageKeywords'] = str_replace("-"," ",urldecode($this->uri->segment(count($this->uri->segments))));
	
	}
	
	if($this->input->post("submit") == "submit"){
		
		$captcha = $this->input->post('captcha',TRUE);
		$data['captchaResult'] = $this->Acms_class->captchaValid($captcha, $this->input->ip_address());	
		
		if($data['captchaResult'] != 1){
		
			$data['captchaError'] = $data['captchaResult'];	
			$data['dataRegister'] = "FALSE";	
		
		}else{	
					
			$this->Property_class->pageViewFormReg($this->input->post(),str_replace("-"," ",urldecode($this->uri->segment(count($this->uri->segments)))));
			$data['dataRegister'] = "TRUE";
													
		}
			
	}	
	
	$data['mainContent'] = 'category/pageView';
	$this->load->view("layouts/site/inner",$data);			
		
}











// /*
// |--------------------------------------------------------------------------
// | .:Edit Page Form:.
// |--------------------------------------------------------------------------
// */	
	
// 	public function	addForm($id,$title){
		
// 		$this->load->model("Property_class");
		
// 		$data['permission'] = $this->Acms_class->checkPermission(15);
// 		$data['dataRegister'] = NULL;
// 		$data['language'] = $this->language;
// 		$data['menubar'] = $this->moduleMenu;
// 		$data['id'] = $id;
// 		$data['title'] = $title;
// 		$action = "edit";
// 		$data['property'] = $this->Property_class->getModulePropList("15");	
// 		$data['formData'] = $this->Category_class->getPageFormData($id);

		
// 		if(count($data['formData']) == 0){
			
// 			$action = "insert";
// 			$data['formData'] = array("formEmail"=>"","formResourceID"=>"","sendEmail"=>"0","formRegType"=>"0");
			
// 		}
		
		
// 		if($this->input->post("submit") == "submit"){
			
// 			$this->form_validation->run('pageForm');	

// 			if($this->form_validation->run() == FALSE){
				
// 				$data['dataRegister'] = "FALSE";
				
// 			}else{
												
			
// 				if($data['permission'] == "3" || $this->session->userdata("userStatus") == "a"){
					
// 					$result = $this->Category_class->insertPageForm($this->input->post(),$action,$id);
// 					$this->Category_class->userLog("ویرایش فرم",urldecode($title));
// 					$data['dataRegister'] = "TRUE";
					
// 				}else{
					
// 					 echo "<script>alert('شما مجوز ویرایش این بخش را ندارید')</script>";
// 					 redirect(base_url()."index.php/category/addLink","refresh");
					
// 				}
				
// 			}
		
// 		}
		
// 		$data['pageTitle'] = "ویرایش فرم | ".urldecode($title);			
// 		$data['mainContent'] = 'category/addForm';
// 		$this->load->view("layouts/admin/form",$data);		
// 	}

// /*
// |--------------------------------------------------------------------------
// | .:Form Data View:.
// |--------------------------------------------------------------------------
// */	
	
// 	public function	formDataView($id,$title){
		
// 		$this->load->model("Property_class");		
// 		$data['permission'] = $this->Acms_class->checkPermission(15);
// 		$data['language'] = $this->language;
// 		$data['menubar'] = $this->moduleMenu;
// 		$data['id'] = $id;
// 		$data['title'] = $title;
// 		$data['formData'] = $this->Property_class->getFormData($id);		
// 		$data['formFields'] = $this->Property_class->getFormFields($data['formData'][0]['formGroupID']);			
// 		$data['pageTitle'] = "نمایش اطلاعات فرم | ".urldecode($title);			
// 		$data['mainContent'] = 'category/formDataView';
// 		$this->load->view("layouts/admin/form",$data);		
	
// 	}

// /*
// |--------------------------------------------------------------------------
// | .:Delete Form Data :. 
// |--------------------------------------------------------------------------
// */	

// 	public function	deleteFormData($id,$title){
		
// 		$this->load->model("Property_class");
// 		$this->load->library('user_agent');		
// 		$data['permission'] = $this->Acms_class->checkPermission(15);
		
// 		if($data['permission'] == "3" || $this->session->userdata("userStatus") == "a"){
			
// 			$result = $this->Property_class->deleteFormData($id,$title);
// 			echo "<script>alert('اطلاعات مورد نظر شما حذف گردید')</script>";
// 			$this->Category_class->userLog("حذف اطلاعات فرم",urldecode($title));
// 			redirect($this->agent->referrer(),"refresh");
			
// 		}else{
			
// 			echo "<script>alert('شما مجوز حذف اطلاعات را ندارید')</script>";
// 			redirect($this->agent->referrer(),"refresh");
						
// 		}
			
// 	}
	


}
