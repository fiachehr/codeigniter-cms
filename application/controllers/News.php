<?php 
class News extends CI_Controller{

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
		$this->load->model("News_class");
		$this->load->helper("tree");
		$result = createModuleArray($this->Acms_class->getModules());
		$this->adminMenu = createAdminMenu($result,0);	
		$this->language = $this->Acms_class->siteLanguage();					

	}	

/*
|--------------------------------------------------------------------------
| ...Get News Title  .:Ajax:. ---------------------------------------------
|--------------------------------------------------------------------------
*/	

	public function	getNewsTitle(){

		$result = $this->News_class->getNewsTitle($this->input->post("keyword"));
		echo json_encode($result);

	}

/*
|--------------------------------------------------------------------------
| ...Remove News Images  .:Ajax:. -----------------------------------------
|--------------------------------------------------------------------------
*/	

	public function	removeNewsImage(){

		$guid = $this->input->post('resourceID');
		$imageID = $this->input->post('imageID');
		$imageCount = $this->input->post('imageCount');
		for($i = 0 ; $i < $imageCount ; $i++){
			if ($imageID == $i){
				unlink(NEWS.$guid."--".$i.".jpg");
			}elseif ($imageID < $i){
				rename(NEWS.$guid."--".$i.".jpg", NEWS.$guid."--".($i-1).".jpg");
			}			
		}
		$newImageCount = ($imageCount-1);
		$this->News_class->updateImageCount($guid,$newImageCount);
		echo json_encode($newImageCount);
		
	}

/*
|--------------------------------------------------------------------------
| ...News List ACMS -------------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function newsList($page = 0){
		
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
				
		$data['news'] = $this->News_class->getNewsList(25,3,$page,base_url()."news/newsList");
		$data['pageTitle'] = "لیست اخبار";			
		$data['mainContent'] = 'news/newsList';
		$this->load->view("layouts/panel/lists",$data);		

	}


/*
|--------------------------------------------------------------------------
| Insert News
|--------------------------------------------------------------------------
*/
	public function insertNews(){

		// User Permissions And Menubar
		$this->load->helper("str");
		$data['newsGUID'] = guid();
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}
		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		
		$this->load->model("Property_class");
		
		// Define Variable
		
		$data['newsCatsTitle'] = "";
		$data['newsCatList'] = "";
		$data['ckeditor'] = CKEDITOR;
		$dateFlag = true;
		$_POST['imageCount'] = 0;
		$data['tagsTitles'] = null;
		
		// Create Category List
		
		$queryResult = $this->Category_class->getModuleCategory("1");
		if(count($queryResult) == 0){			
			$data['tree'] = "موردی یافت نشد";		
		}else{		
			$result = createArray($queryResult);	
			$data['tree'] = createTree($result,0,"selectMultiCat"); 			 						
		}	
		    

		//form submit	
		
		if($this->input->post('submit') == "submit"){	
			$this->form_validation->run('news');		
			if($this->form_validation->run() == FALSE){	
				$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);										
				if($this->input->post("newsCatList") != ""){
					$data["catList"] = $this->Category_class->getItemCatList($this->input->post("newsCatList"));				
				}	
				if($this->input->post('tagsList') != "[]"){
					$tagsTitles = json_decode($this->input->post('tagsList'));
					foreach($tagsTitles as $rows){
						$data['tagsTitles'] .= "<span class=\"option\" data-focus=\"".str_replace("newTag-","",$rows)."\" data-focus-title=\"".str_replace("newTag-","",$rows)."\">".str_replace("newTag-","",$rows)."</span>";
					}			
				}							
			}else{

				if($this->input->post('trueImage') != ''){
					$this->load->helper("uploadfile");
					$acceptedFiles = strToArr($this->input->post('trueImage'),";;;;");
					$counter = 0;

					foreach ($_FILES['newsImg']['name'] as $value) {
						if(in_array($value,$acceptedFiles)){
							$uploadConfig = array(  'newName' => $this->input->post('newsGUID')."--".$counter,
													'name'=> $_FILES['newsImg']['name'][$counter],
													'tmp' => $_FILES['newsImg']['tmp_name'][$counter], 
													'size' => $_FILES['newsImg']['size'][$counter],
													'path' => NEWS, 
													'type' => 'jpg|png|gif', 
													'maxSize' => 5000,
													'resize'=> array("moduleFolder"=>"news",
																	 "width"=>"700",
																	 "height"=>"700",
																	 "type"=>"resize",
																	 "thumb"=>false,
																	// "watermark"=>array("text"=>"fiachehr","type"=>"text"),
																	 "watermark"=>null,
																	 )
													);
							$upload = multiFileUpload($uploadConfig);
							$counter++;
						}	
										
					}
					$_POST['imageCount'] = $counter;
				}

				if($this->Acms_class->checkAccess($data['permission'])){				
					$this->News_class->insertNews($this->input->post());
					$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_INSERT_SUCCESS,"url"=>base_url()."News/newsList");									
				}else{
					$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."News/newsList");
				}	
			}
		
		}	

		$data['pageTitle'] = 'درج خبر جدید';
		$data['mainContent'] = 'news/insertNews';
		$this->load->view("layouts/panel/forms",$data);		

	}

/*
|--------------------------------------------------------------------------
| Insert News -------------------------------------------------------------
|--------------------------------------------------------------------------
*/
	public function editNews($id,$page){

		// User Permissions And Menubar
		$this->load->helper("str");
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}
		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		
		$this->load->model("Property_class");

		// Define Variable
		$data['tagSelected'] = null;
		$data['newsCatsTitle'] = "";
		$data['newsCatList'] = "";
		$data['tagListTitle'] = "";
		$data['tagList'] = "";
		$data['newsGUID'] = $id;
		$data['tagsTitles'] = '';
		$data['page'] = $page;
		$data['ckeditor'] = CKEDITOR;
		$dateFlag = true;

		// Return News Tag

		$tags = $this->News_class->newsTag($id);

		if(count($tags) > 0){
			$data['tagList'] = '[';
			$data['tagListTitle'] = '[';
			foreach($tags as $rows){
				$data['tagList'] .= "'".$rows['tagID']."',";
				$data['tagListTitle'] .= "'".$rows['tagTitle']."',";
				$data['tagsTitles'] .= "<span class=\"option\" data-focus=\"".$rows['tagID']."\" data-focus-title=\"".$rows['tagTitle']."\">".$rows['tagTitle']."</span>";
			}
			$data['tagList'] = substr($data['tagList'],0,-1)."]";
			$data['tagListTitle'] = substr($data['tagListTitle'],0,-1)."]";
		}

		$data['news'] = $this->News_class->newsShow($id,"cms");
		
		// Create Category List

		$queryResult = $this->Category_class->getModuleCategory("1");
		if(count($queryResult) == 0){			
			$data['tree'] = "موردی یافت نشد";		
		}else{		
			$result = createArray($queryResult);	
			$data['tree'] = createTree($result,0,"selectMultiCat"); 			 						
		}		$cats = $this->News_class->newsCat($id);

		foreach($cats as $rows){
			$data['newsCatsTitle'] .= "<span class=\"tag\" data-action=\"deleteCategory\" data-id=\"".$rows['id']."\" id=\"cat-".$rows['id']."\">".$rows['title']."</span>";
			$data['newsCatList'] .= $rows['id'].";;";
		} 	    

		//form submit	
		
		if($this->input->post('submit') == "submit"){	
			$this->form_validation->run('news');		
			if($this->form_validation->run() == FALSE){	
				$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);										
				if($this->input->post("newsCatList") != ""){
					$data["catList"] = $this->Category_class->getItemCatList($this->input->post("newsCatList"));				
				}	
				if($this->input->post('tagsList') != "[]"){
					$tagsTitles = json_decode($this->input->post('tagsList'));
					foreach($tagsTitles as $rows){
						$data['tagsTitles'] .= "<span class=\"option\" data-focus=\"".str_replace("newTag-","",$rows)."\" data-focus-title=\"".str_replace("newTag-","",$rows)."\">".str_replace("newTag-","",$rows)."</span>";
					}			
				}								
			}else{
				if($this->input->post("scheduleStart") != '' && $this->input->post("scheduleEnd") != ''){
					$this->load->helper("pdate");
					$startDate = jalToGre($this->input->post("scheduleStart"))." ".substr($this->input->post("scheduleStart"),11);
					$endDate = jalToGre($this->input->post("scheduleEnd"))." ".substr($this->input->post("scheduleEnd"),11);
					$compareResult = compare2Date($startDate,$endDate);
					if($compareResult != true){
						$dateFlag = false;
						$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>"تاریخ ها به اشتباه وارد شده است","url"=>null);										
						if($this->input->post("newsCatList") != ""){
							$data["catList"] = $this->Category_class->getItemCatList($this->input->post("newsCatList"));				
						}	
						if($this->input->post("newsParentID") != 0){
							$data['newsParent'] = $this->News_class->newsParent($data['news']['newsParentID']);
						}
						// if($this->input->post("tagsList") != "[]"){
						// 	$data['tagSelected'] = true;			
						// }															
					}else{
						$_POST["scheduleStart"] = $startDate;
						$_POST["scheduleEnd"] = $endDate;
					}
				}		

				if($this->input->post('trueImage') != ''){
					$this->load->helper("uploadfile");
					$acceptedFiles = strToArr($this->input->post('trueImage'),";;;;");
					$counter = 0;
					$lastImageCount = ($this->input->post("imageCount"));
					foreach ($_FILES['newsImg']['name'] as $value) {
						if(in_array($value,$acceptedFiles)){
							$uploadConfig = array(  'newName' => $this->input->post('newsGUID')."--".($lastImageCount),
													'name'=> $_FILES['newsImg']['name'][$counter],
													'tmp' => $_FILES['newsImg']['tmp_name'][$counter], 
													'size' => $_FILES['newsImg']['size'][$counter],
													'path' => NEWS, 
													'type' => 'jpg|png|gif', 
													'maxSize' => 10000,
													'resize'=> array("moduleFolder"=>"news",
																	 "width"=>"700",
																	 "height"=>"700",
																	 "type"=>"resize",
																	 "thumb"=>false,
																	// "watermark"=>array("text"=>"fiachehr","type"=>"text"),
																	 "watermark"=>null,
																	 )
													);
							$upload = multiFileUpload($uploadConfig);
							$counter++;
							$lastImageCount++;
						}
					}
					$_POST['imageCount'] = $lastImageCount;
				}
				if($this->Acms_class->checkAccess($data['permission'])){
					$this->News_class->editNews($this->input->post(),$data['news']['newsTitle']);
					$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_UPDATE_SUCCESS,"url"=>base_url()."News/newsList");				
				}else{
					$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."News/newsList");
				}	
			}
		
		}	

		$data['pageTitle'] = 'ویرایش خبر | '.$data['news']['newsTitle'];
		$data['mainContent'] = 'news/editNews';
		$this->load->view("layouts/panel/forms",$data);		

	}


/*
|--------------------------------------------------------------------------
| Delete News -------------------------------------------------------------
|--------------------------------------------------------------------------
*/	

	public function	deleteNews($id,$title){
		
		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if($permission == "a" || $permission == "3"){
			$result = $this->News_class->deleteNews($id,urldecode($title));
			echo "<script>alert('اطلاعات مورد نظر حذف گردید');window.location = '".base_url()."News/newsList';</script>";
		}else{
			echo "<script>alert('شما مجوز حذف اطلاعات را ندارید');window.location = '".base_url()."News/newsList';</script>";			
		}
		
	}

/*
|--------------------------------------------------------------------------
| Delete News Ajax--------------------------------------------------------- 
|--------------------------------------------------------------------------
*/	

	public function	deleteNewsAjax(){

		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if($permission == "a" || $permission == "3"){
			$result = $this->News_class->deleteNews($this->input->get("id"),urldecode($this->input->get("title")));
			echo "1";
		}else{
			echo "0";		
		}
	}

/*
|--------------------------------------------------------------------------
|  News Show--------------------------------------------------------------- 
|--------------------------------------------------------------------------
*/	
		
	function newsShow($id){
						
		$this->load->library('cart');
        $this->load->model("Category_class");
		$this->load->helper("tree");
		$this->load->model("Link_class");
		$data['link'] = $this->Link_class->getLinkList('f');
        $queryResult = $this->Category_class->getAllCategory();
        $result = createArray($queryResult);	
		$data['menubar'] = createMenubar($result,0,"selectMultiCat");
		$data['news'] = $this->News_class->newsShow($id,"site");
		$data['newsTag'] = $this->News_class->newsTag($data['news'][0]['newsGUID']);
		$data['lastNews'] = $this->News_class->getLastNews(3);
		$data['pageTitle'] = $data['news'][0]['newsTitle'];	
		$data['mainContent'] = 'news/newsShow';
		$this->load->view("layouts/site/inner",$data);		

	}

/*
|--------------------------------------------------------------------------
| News Archive ---------------------------------------------------------
|--------------------------------------------------------------------------
*/	

	public function	newsArchive()
	{
		$this->load->library('cart');
		$this->load->model("Category_class");
		$this->load->helper("tree");
		$this->load->model("Link_class");
		$data['link'] = $this->Link_class->getLinkList('f');
		$queryResult = $this->Category_class->getAllCategory();
		$result = createArray($queryResult);	
		$data['menubar'] = createMenubar($result,0,"selectMultiCat");
		$urlProcces = $this->News_class->urlProcces(3);
		$data['news'] = $this->News_class->newsCatList(12,$urlProcces['segment'],$urlProcces['page'],$urlProcces['url'],$urlProcces['id']);
		$data['pageTitle'] = 'لیست اخبار دسته بندی | '.$urlProcces['title'];
		$data['mainContent'] = 'news/newsArchive';
		$this->load->view("layouts/site/inner",$data);		
		
	}
	

// /************************************************************** 
// * News Latter User
// /**************************************************************/

// 	function addEmail(){
		
// 		echo json_encode($this->News_class->addNewslatter($_GET['mail']));

// 	}

// /*
// |--------------------------------------------------------------------------
// | .:News Resource List:.
// |--------------------------------------------------------------------------
// */	

// 	public function	newsSrvList($page=0){		
		
// 		$data['permission'] = $this->Acms_class->checkPermission(1);	
// 		$data['language'] = $this->language;
// 		$data['menubar'] = $this->moduleMenu;		
// 		$data['newsSrv'] = $this->News_class->getNewsSrvList(25,3,$page,base_url()."index.php/news/newsSrvList");
// 		$data['pageTitle'] = "لیست منابع خبری";			
// 		$data['mainContent'] = 'news/newsSrvList';
// 		$this->load->view("layouts/admin/form",$data);
		
// 	}
	
// /*
// |--------------------------------------------------------------------------
// | .:Insert News Resource:.
// |--------------------------------------------------------------------------
// */	

// 	public function	insertNewsSrv(){
		
// 		$data['permission'] = $this->Acms_class->checkPermission(1);
		
// 		$data['dataRegister'] = NULL;
// 		$data['language'] = $this->language;
// 		$data['menubar'] = $this->moduleMenu;

		
// 		if($this->input->post("submit") == "submit"){					

// 			$this->form_validation->run('newsSrv');	

// 			if($this->form_validation->run() == FALSE){
				
// 				$data['dataRegister'] = "FALSE";
				
// 			}else{
				
// 				if($data['permission'] == "3" || $data['permission'] == "2" || $this->session->userdata("userStatus") == "a"){
									
// 					$this->News_class->newsResActionData($this->input->post());
// 					$data['dataRegister'] = "TRUE";
					
// 				}else{
					
// 					echo "<script>alert('شما مجوز درج  منابع خبری را ندارید')</script>";
// 				    redirect(base_url()."index.php/news/insertNewsSrv","refresh");
					
// 				}
				
// 			}
					
// 		}		
		
// 		$data['pageTitle'] = "درج منابع خبری";			
// 		$data['mainContent'] = 'news/insertNewsSrv';
// 		$this->load->view("layouts/admin/form",$data);
		
// 	}

// /*
// |--------------------------------------------------------------------------
// | .:Edit News Resource:.
// |--------------------------------------------------------------------------
// */	

// 	public function	editNewsSrv($id){
		
// 		$data['permission'] = $this->Acms_class->checkPermission(1);

// 		$data['dataRegister'] = NULL;
// 		$data['language'] = $this->language;
// 		$data['newsSrv'] = $this->News_class->getNewsResource($id);
// 		$data['menubar'] = $this->moduleMenu;

				
// 		if($this->input->post("submit") == "submit"){					

// 			$this->form_validation->run('newsSrv');	

// 			if($this->form_validation->run() == FALSE){
				
// 				$data['dataRegister'] = "FALSE";
				
// 			}else{
				
// 				if($data['permission'] == "3" || $data['permission'] == "2" || $this->session->userdata("userStatus") == "a"){
				
// 					$this->News_class->newsResActionData($this->input->post(),$id);
// 					$data['dataRegister'] = "TRUE";					
					
// 				}else{
					
// 					echo "<script>alert('شما مجوز ویرایش  منابع خبری را ندارید')</script>";
// 				    redirect(base_url()."index.php/news/newsSrvList/".$id,"refresh");
					
// 				}
				
// 			}
					
// 		}		
		
// 		$data['pageTitle'] = "ویرایش | ".$data['newsSrv']['newsSrvTitle'];			
// 		$data['mainContent'] = 'news/editNewsSrv';
// 		$this->load->view("layouts/admin/form",$data);
		
// 	}

// /*
// |--------------------------------------------------------------------------
// | .:Delete News Resource Without View:.
// |--------------------------------------------------------------------------
// */	

// 	public function	deleteNewsSrv($id,$title){
		
// 		$data['permission'] = $this->Acms_class->checkPermission(1);
		
// 		if($data['permission'] == "3" || $this->session->userdata("userStatus") == "a"){
	
// 			$this->News_class->deleteNewsSrv($id);
// 			echo "<script>alert('منبع خبری مورد نظر حذف گردید')</script>";
// 			$this->News_class->userLog("حذف منبع خبری",urldecode($title));
// 			redirect(base_url()."index.php/news/newsSrvList","refresh");
			
// 		}else{
			
// 			echo "<script>alert('شما مجوز حذف منبع خبری را ندارید')</script>";
// 			redirect(base_url()."index.php/news/newsSrvList","refresh");
			
// 		}
		
// 	}




// /*
// |--------------------------------------------------------------------------
// | .:News Latter:.
// |--------------------------------------------------------------------------
// */	

// 	public function	newsLatter($page=0){
	
		
// 		$data['permission'] = $this->Acms_class->checkPermission(1);	
// 		$data['language'] = $this->language;
// 		$data['menubar'] = $this->moduleMenu;		
// 		$data['news'] = $this->News_class->newsLatterLastNews();
		
// 		if($this->input->post("submit") == "submit"){					
				
// 			if($data['permission'] == "3" || $data['permission'] == "2" || $this->session->userdata("userStatus") == "a"){
			
// 				$result = $this->News_class->sendNewslatter($this->input->post());
				
// 				if($result != 0){
					
// 					echo "<script>alert('تعدادتعداد ".$result." ارسال شد.')</script>";
					
// 				}else{
					
// 					echo "<script>alert('در خبرنامه شما هیچ عضوی وجود ندارد.')</script>";
					
// 				}
				
				
// 			}else{
				
// 				echo "<script>alert('شما مجوز ارسال خبرنامه را ندارید')</script>";
// 			    redirect(base_url()."index.php/acms/desktop/".$id,"refresh");
				
// 			}
									
// 		}
				
// 		$data['pageTitle'] = "ارسال خبرنامه";			
// 		$data['mainContent'] = 'news/newsLatter';
// 		$this->load->view("layouts/admin/form",$data);
		
// 	}

// /************************************************************** 
// * News RSS
// /*************************************************************/

// 	function newsRss(){	

// 		$data['rss'] = $this->news_class->rssFeed($this->base_url(),'feed','گسترش فناوری آگو','fa-IR','tbl_news','newsDate',10,"ir","newsLanguage");
// 		$data['news'] = $data['rss']['news'];
// 		$data['feed_url'] = $data['rss']['feed_url'];
// 		$data['page_description'] = $data['rss']['page_description'];
// 		$data['page_language'] = $data['rss']['page_language'];
// 		$data['creator_email'] = $data['rss']['creator_email'];
// 		header("Content-Type: application/rss+xml");  
// 		$this->load->view('news/newsRss', $data); 	

// 	}

// /************************************************************** 
// *	News Archive
// /*************************************************************/
	
// 	function newsArchive($page = 0){
		
// 		$this->load->model("Tree_class");
// 		$data['search'] = NULL;
// 		$data['lastNews'] = $this->News_class->readCacheFile($this->News_class->latestNews(10,"news+newsArchive"));	    	
// 		$data['recommendedNews'] = $this->News_class->readCacheFile($this->News_class->recommendedNews(4,"news+newsArchive"));	
// 		$data['lastGalleryNews'] = $this->News_class->readCacheFile($this->News_class->latestNewsGallery("news+newsArchive")); 
// 		$page = $this->uri->segment(count($this->uri->segments));					
// 		$pageTitle = urldecode($this->uri->segment(count($this->uri->segments)-1));		
// 		$cat = urldecode(str_replace("-"," ",$pageTitle));	
// 		$url = substr(urldecode($this->uri->uri_string()),0,strlen(urldecode($this->uri->uri_string()))-strlen($page)-1);
// 		if(strlen($page) > 4){
			
// 			redirect(base_url()."index.php/".urldecode(uri_string()."/0"));
			
// 		}	
				
// 		$urlPage = base_url()."index.php/".$url;
// 		$data['news'] = $this->News_class->newsArchive(14,count($this->uri->segments),$page,$urlPage,"site",urldecode(str_replace("-"," ",$cat)));										
		
// 		$result = $this->Tree_class->selectTable("category");
// 	   	$data['map'] = $this->Tree_class->displayParentNodes($result,$data['news'][0][0]->itemCatID);
		
// 		$data['pageTitle'] = "آرشیو اخبار  ".$cat;
// 		$data['pageDesc'] = "آرشیو اخبار ".$cat;
// 		$data['pageKeywords'] = ' , آرشیو خبر ,اخبار فن آوری,'.$cat.'';					
// 		$data['mainContent'] = 'news/newsArchive';
// 		$this->load->view("layouts/ui/view",$data);				

// 	}

// /************************************************************** 
// * News Show Page
// /*************************************************************/

// 	function newsShow($newsCat,$newsID,$newsURL = NULL){
		
// 		$this->load->helper("text");
// 		$this->load->helper("captcha");
// 		$this->load->model("Comment_class");
// 		$this->load->model("Property_class");
		
// 		$data['gallery'] = "";		
// 		$data['movie'] = "";
		
// 		$data['lastNews'] = $this->News_class->readCacheFile($this->News_class->latestNews(10,"news+newsShow"));	    	
// 		$data['recommendedNews'] = $this->News_class->readCacheFile($this->News_class->recommendedNews(4,"news+newsShow"));	
// 		$data['lastGalleryNews'] = $this->News_class->readCacheFile($this->News_class->latestNewsGallery("news+newsShow")); 
		
// 		$data['news'] = $this->News_class->newsShow($newsID,"gui");
// 		$data['category'] = $this->Tree_class->selectTable("category");
// 	   	$data['map'] = $this->Tree_class->displayParentNodes($data['category'],$newsCat);
// 	   	$data['catID'] = $newsCat;
// 	   	$data['newsTags'] = $this->News_class->newsTag($data['news'][0]->newsGUID);
// 	   	$data['related'] = $this->News_class->relatedNews($data['newsTags'],$data['news'][0]->newsGUID,3);
// 	   	$data['comments'] = $this->Comment_class->sourceCommentList($data['news'][0]->newsGUID);
// 	   	$data['property'] = $this->Property_class->getSrcProperties($data['news'][0]->newsGUID);
	   	
// 	   	if($data['news'][0]->newsType == "g"){
			
// 			$data['gallery'] = $this->News_class->newsMedia($data['news'][0]->newsGUID,"i");
			
// 		}elseif($data['news'][0]->newsType == "m"){
			
// 			$data['movie'] = $this->News_class->newsMedia($data['news'][0]->newsGUID,"m");
			
// 		}

// 		$this->News_class->updateHits($newsID);		
	   	
// 	   	delete_files('./assets/captcha/public/');
// 		$data['cap'] = $this->News_class->Captcha(4, 140, 35, 900,"assets/captcha/public/");
// 		$data['captchaImg'] = $data['cap']['image'];
	   	
// 	   	$data['pageKeywords'] = $data['news'][0]->newsKeywords;
// 	   	$data['pageTitle'] = $data['news'][0]->newsTitle;
// 		$data['pageDesc'] = character_limiter($data['news'][0]->newsSummery,160);
// 		$data['mainContent'] = 'news/newsShow';
// 		$this->load->view("layouts/ui/view",$data);		

// 	}

// /************************************************************** 
// 	Search News 
// /*************************************************************/
	
// 	function searchNews($page = 0,$keyword = NULL){
		
		
// 		$data['lastNews'] = $this->News_class->readCacheFile($this->News_class->latestNews(10,"news+newsShow"));	    	
// 		$data['recommendedNews'] = $this->News_class->readCacheFile($this->News_class->recommendedNews(4,"news+newsShow"));	
// 		$data['lastGalleryNews'] = $this->News_class->readCacheFile($this->News_class->latestNewsGallery("news+newsShow")); 
		
// 		$page = $this->uri->segment(count($this->uri->segments));					
// 		$pageTitle = urldecode($this->uri->segment(count($this->uri->segments)-1));		
// 		$cat = urldecode(str_replace("-"," ",$pageTitle));		
// 		$url = substr(urldecode($this->uri->uri_string()),0,strlen(urldecode($this->uri->uri_string()))-strlen($page)-1);	
// 		$data['search'] = $cat;
// 		if(strlen($page) > 4){
			
// 			redirect(base_url()."index.php/".urldecode(uri_string()."/0"));			

// 		}	
		
// 		$urlPage = base_url()."index.php/".$url;
// 		$data['news'] = $this->News_class->newsArchive(14,count($this->uri->segments),$page,$urlPage,"search",urldecode(str_replace("-"," ",$cat)));										
// 		$data['pageTitle'] = "جستجوی عبارت ".$cat;
// 		$data['pageDesc'] = "جستجوی عبارت ".$cat;
// 		$data['pageKeywords'] = 'آرشیو خبر , اخبار فن آوری,'.$cat.'';
// 		$data['mainContent'] = 'news/newsArchive';
// 		$this->load->view("layouts/ui/view",$data);		
			
// 	}

// /************************************************************** 
// 	+Delete Cache+
// /*************************************************************/
	
// 	function deleteCache(){	
			
// 		$this->db->cache_delete_all();			

// 	}	
	
// /************************************************************** 
// +News Insert Cron+
// /*************************************************************/

// 	function newsCron(){		

// 		ini_set('memory_limit', '-1');
// 		include_once('./classes/parser/simple_html_dom.php');
// 		$data = array();		
// 		$category = NULL;
// 		$tag = array();		

// 		$html = file_get_html("http://www.zoomit.ir/home?format=feed");
// 		$link = $html->find('item guid');

// 		foreach($link as $href){			

// 			$data = array();			
// 			$category = NULL;
// 			$tag = array();
						
// 			$html2 = file_get_html($href->plaintext);
// 			$titles = $html2->find('h2[class=itemTitle]');
// 			$images = $html2->find('a[class=modal] img');		
// 			$summeries = $html2->find('div[class=itemIntroText]');
// 			$fulltext = $html2->find('div[class=itemFullText]');
// 			$cat = $html2->find('div[class=itemCategory] a');
// 			$keywords = $html2->find('meta[name=keywords]');		
// 			$tags = $html2->find('div[class=tag clearfix] a');
			
// 			foreach($tags as $ta){			

// 				array_push($tag,$ta->plaintext);			

// 			}			

// 			foreach($titles as $ti){
			
// 				$title = $ti->plaintext;
// 				$url = str_replace("زومیت","آگو",str_replace(":","",str_replace(".","",str_replace("»","",str_replace("«","",str_replace("؛","",str_replace(";","",str_replace(",","",str_replace("@","",str_replace("#","",str_replace("!","",str_replace("?","",word_limiter($title,15)))))))))))));			

// 			}		

// 			foreach($keywords as $ka){
		
// 				$keyword = $ka->content;			

// 			}
		
// 			foreach($cat as $ca){

// 				if($ca->plaintext == "اخبار فناوری"){

// 					$category = 24;

// 				}else if($ca->plaintext == "بازی"){				

// 					$category = 23;

// 				}else if($ca->plaintext == "سیستم عامل"){				

// 					$category = 22;

// 				}else if($ca->plaintext == "امنیت"){				

// 					$category = 21;

// 				}else if($ca->plaintext == "اینترنت و شبکه"){				

// 					$category = 20;

// 				}else if($ca->plaintext == "موبایل"){				

// 					$category = 25;

// 				}else if($ca->plaintext == "گوناگون"){				

// 					$category = 26;

// 				}

// 			}

// 			foreach($images as $img){

// 				$image = str_replace("/media/k2/items/cache/","",$img->src);
// 				$fileURL = $img->src;

// 			}
			
// 			foreach($summeries as $sum){			

// 				$summery = $sum->plaintext;					

// 			}			

// 			foreach($fulltext as $body){		

// 				$content = "<p>".str_replace("زومیت","آگو",str_replace('src="/cache/','src="http://www.zoomit.ir/cache/',str_replace('src="/images/','src="http://www.zoomit.ir/images/',$body->outertext)))."</p>";		
// 				$content = preg_replace('#<div class="source clearfix">(.*?)</div>#', '', $content);
// 				$content = preg_replace('#<script(.*?)>(.*?)</script>#','', $content);

// 			}			

// 			if($category != NULL ){
			
// 				$this->news_class->cronNews(array("title" => $title,"url" => $url, "tag" => $tag , "category" => $category, "keyword" => $keyword, "image" => $image, "summery" => $summery , "content" => $content),$fileURL);					

// 			}						

// 		}						

// 	}	


}
