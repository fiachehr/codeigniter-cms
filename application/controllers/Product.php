<?php 
class Product extends CI_Controller{

	private $adminMenu;
	private $language;

/*
|--------------------------------------------------------------------------
|--- Class Constractor ----------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	 function __construct()
	 {
		parent::__construct();	
		$this->load->model("Acms_class");
		$this->load->model("Product_class");
		$this->load->model("Category_class");
		$this->load->helper("tree");
		$result = createModuleArray($this->Acms_class->getModules());
		$this->adminMenu = createAdminMenu($result,0);	
		$this->language = $this->Acms_class->siteLanguage();				
	}	

/*
|--------------------------------------------------------------------------
|--- Get Product Title Suggest .:Ajax:. -----------------------------------
|--------------------------------------------------------------------------
*/	

	public function	suggest()
	{
		$result = $this->Product_class->suggestProduct($this->input->post("keyword"));
		echo json_encode($result);
	}

/*
|--------------------------------------------------------------------------
| ...Remove SmProduct Images  .:Ajax:. ------------------------------------
|--------------------------------------------------------------------------
*/	

	public function	removeProductImage(){

		$guid = $this->input->post('resourceID');
		$imageID = $this->input->post('imageID');
		$imageCount = $this->input->post('imageCount');
		for($i = 0 ; $i < $imageCount ; $i++){
			if ($imageID == $i){
				unlink(PRODUCT.$guid."--".$i.".jpg");
			}elseif ($imageID < $i){
				rename(PRODUCT.$guid."--".$i.".jpg", PRODUCT.$guid."--".($i-1).".jpg");
			}			
		}
		$newImageCount = ($imageCount-1);
		$this->Product_class->updateImageCount($guid,$newImageCount);
		echo json_encode($newImageCount);
		
	}

/*
|--------------------------------------------------------------------------
| ...Product List ACMS --------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function productList($page = 0){
		
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
				
		$data['product'] = $this->Product_class->getProductList(25,3,$page,base_url()."product/productList");
		$data['pageTitle'] = "لیست محصولات";			
		$data['mainContent'] = 'product/productList';
		$this->load->view("layouts/panel/lists",$data);		

	}


/*
|--------------------------------------------------------------------------
| Insert SmC Product --------------------------------------------------------
|--------------------------------------------------------------------------
*/
	public function insertProduct(){

		// User Permissions And Menubar
		$this->load->helper("str");
		$data['productGUID'] = guid();
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}
		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		
		// Define Variable

		$data['productCatsTitle'] = "";
		$data['productCatList'] = "";
		$data['ckeditor'] = CKEDITOR;
		$data['tagListTitle'] = "";
		$data['tagsTitles'] = "";
		$data['tagList'] = "";
		$dateFlag = true;
		$_POST['imageCount'] = 0;	
		
		// Create Category List
		
		$queryResult = $this->Category_class->getModuleCategory("101");
		if(count($queryResult) == 0){			
			$data['tree'] = "موردی یافت نشد";		
		}else{		
			$result = createArray($queryResult);	
			$data['tree'] = createTree($result,0,"selectMultiCat"); 			 						
		}	
		
		//form submit	
	
		if($this->input->post('submit') == "submit"){	

			$this->form_validation->run('Product');		
			if($this->form_validation->run() == FALSE){	
				$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);
				if($this->input->post("productCatList") != ""){
					$data["catList"] = $this->Category_class->getItemCatList($this->input->post("productCatList"));				
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
					foreach ($_FILES['productImg']['name'] as $value) {
						if(in_array($value,$acceptedFiles)){
							$uploadConfig = array(  'newName' => $this->input->post('productGUID')."--".$counter,
													'name'=> $_FILES['productImg']['name'][$counter],
													'tmp' => $_FILES['productImg']['tmp_name'][$counter], 
													'size' => $_FILES['productImg']['size'][$counter],
													'path' => PRODUCT, 
													'type' => 'jpg|png|gif', 
													'maxSize' => 5000,
													'resize'=> array("moduleFolder"=>"product",
																	 "width"=>"5000",
																	 "height"=>"5000",
																	 "type"=>null,
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
					$this->Product_class->actionProduct($this->input->post());
					$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_INSERT_SUCCESS,"url"=>base_url()."Product/ProductList");			
				}else{
					$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Product/ProductList");
				}	
			}
		
		}	

		$data['pageTitle'] = 'درج محصول جدید';
		$data['mainContent'] = 'product/insertProduct';
		$this->load->view("layouts/panel/forms",$data);		

	}

/*
|--------------------------------------------------------------------------
| Insert SmProduct --------------------------------------------------------
|--------------------------------------------------------------------------
*/
	public function editProduct($id,$page){

		// User Permissions And Menubar
		$this->load->helper("str");
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}
		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		$data['productCatsList'] = "";
		$data['productCatList'] = "";
		$data['tagsTitles'] = "";
		$data['tagListTitle'] = "";
		$data['tagList'] = "";

		// Define Variable
		
		$data['page'] = $page;
		$data['ckeditor'] = CKEDITOR;
		$dateFlag = true;

		$data['product'] = $this->Product_class->productShow($id,"cms");
		$data['productGUID'] = $id;

		// Return News Tag
		$tags = $this->Product_class->productTag($id);
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

		$queryResult = $this->Category_class->getModuleCategory("101");
		if(count($queryResult) == 0){			
			$data['tree'] = "موردی یافت نشد";		
		}else{		
			$result = createArray($queryResult);	
			$data['tree'] = createTree($result,0,"selectMultiCat"); 			 						
		}		
		$cats = $this->Product_class->productCat($id);


		foreach($cats as $rows){
			$data['productCatsList'] .= "<span class=\"tag\" data-action=\"deleteCategory\" data-id=\"".$rows['id']."\" id=\"cat-".$rows['id']."\">".$rows['title']."</span>";
			$data['productCatList'] .= $rows['id'].";;";
		} 	    

		//form submit	
		
		if($this->input->post('submit') == "submit"){	
			$this->form_validation->run('Product');		
			if($this->form_validation->run() == FALSE){	
				$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);										
				if($this->input->post("productCatList") != ""){
					$data["catList"] = $this->Category_class->getItemCatList($this->input->post("productCatList"));				
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
					$lastImageCount = ($this->input->post("imageCount"));
					foreach ($_FILES['productImg']['name'] as $value) {
						if(in_array($value,$acceptedFiles)){
							$uploadConfig = array(  'newName' => $this->input->post('productGUID')."--".($lastImageCount),
													'name'=> $_FILES['productImg']['name'][$counter],
													'tmp' => $_FILES['productImg']['tmp_name'][$counter], 
													'size' => $_FILES['productImg']['size'][$counter],
													'path' => PRODUCT, 
													'type' => 'jpg|png|gif', 
													'maxSize' => 5000,
													'resize'=> array("moduleFolder"=>"product",
																	 "width"=>"3000",
																	 "height"=>"3000",
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
						$this->Product_class->actionProduct($this->input->post(),$id,$data['product']['productTitle']);
						$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_UPDATE_SUCCESS,"url"=>base_url()."Product/ProductList");				
				}else{
					$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Product/ProductList");
				}	
			}
		
		}	

		$data['pageTitle'] = 'ویرایش محصول | '.$data['product']['productTitle'];
		$data['mainContent'] = 'product/editProduct';
		$this->load->view("layouts/panel/forms",$data);		

	}


/*
|--------------------------------------------------------------------------
| Delete Product ----------------------------------------------------------
|--------------------------------------------------------------------------
*/	

	public function	deleteProduct($id,$title){
		
		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if($permission == "a" || $permission == "3"){
			$result = $this->Product_class->deleteProduct($id,urldecode($title));
			echo "<script>alert('اطلاعات مورد نظر حذف گردید');window.location = '".base_url()."Product/ProductList';</script>";
		}else{
			echo "<script>alert('شما مجوز حذف اطلاعات را ندارید');window.location = '".base_url()."Product/ProductList';</script>";		
		}
		
	}

/*
|--------------------------------------------------------------------------
| Delete SmProduct Ajax----------------------------------------------------
|--------------------------------------------------------------------------
*/	

	public function	deleteProductAjax(){

		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if($permission == "a" || $permission == "3"){
			$result = $this->Product_class->deleteProduct($this->input->get("id"),urldecode($this->input->get("title")));
			echo "1";
		}else{
			echo "0";		
		}
	}

/*
|--------------------------------------------------------------------------
| Product Archive ---------------------------------------------------------
|--------------------------------------------------------------------------
*/	

	public function	productArchive()
	{
		$this->load->library('cart');
        $this->load->model("Category_class");
		$this->load->helper("tree");
		$this->load->model("Link_class");
		$data['link'] = $this->Link_class->getLinkList('f');
        $queryResult = $this->Category_class->getAllCategory();
        $result = createArray($queryResult);	
		$data['menubar'] = createMenubar($result,0,"selectMultiCat");
		$urlProcces = $this->Product_class->urlProcces(3);
		$data['product'] = $this->Product_class->productCatList(12,$urlProcces['segment'],$urlProcces['page'],$urlProcces['url'],$urlProcces['id']);
		$data['pageTitle'] = 'لیست محصولات دسته بندی | '.$urlProcces['title'];
		$data['mainContent'] = 'product/productArchive';
		$this->load->view("layouts/site/inner",$data);		
		
	}

/*
|--------------------------------------------------------------------------
| Product View ---------------------------------------------------------
|--------------------------------------------------------------------------
*/	

	public function	productView($id)
	{
		$this->load->library('cart');
		$this->load->model("Category_class");
		$this->load->model("Homepage_class");
		$this->load->helper("tree");
		$this->load->model("Link_class");
		$data['link'] = $this->Link_class->getLinkList('f');
        $queryResult = $this->Category_class->getAllCategory();
		$result = createArray($queryResult);	
		$items = $this->Homepage_class->getHomepageItem();
		$rand = rand(0,2);
		$data['paralaxImg'] = base_url()."assets/uploads/homepage/".$items[$rand]['homeItemImage'];

		$data['menubar'] = createMenubar($result,0,"selectMultiCat");
		$data['productData'] = $this->Product_class->productShow($id,"site");
		$data['tags'] = $this->Product_class->getProductTag($data['productData'][0]['productGUID']);
		$data['relatedProduct'] = $this->Product_class->relatedProduct($data['productData'][0]['id'],4);
		$data['pageTitle'] = $data['productData'][0]['productTitle'];
		$data['mainContent'] = 'product/productView';
		$this->load->view("layouts/site/inner",$data);		
		
	}

}
