<?php
class Category_class extends MY_Model{
	
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
| Active And Categorisable Modules List -----------------------------------
|--------------------------------------------------------------------------
*/
	
	function moduleList(){	

		$this->table = "tbl_module";
		$this->selectConditions = array("where"=>"moduleParentID = '0' AND  moduleStatus = '1' AND moduleLabel NOT IN ('adminUser','user','smallUser','homepage')","order"=>"moduleID DESC");
		return $this->getData();	
	
	}

/*
|--------------------------------------------------------------------------
| Delete Category Image ---------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function deleteCategoryImage($id){	

		$data['categoryImg'] = '';
		$this->table = "tbl_category";
		$this->primeryKey = "id";
		$this->update($data,$id);

	}
	
/*
|--------------------------------------------------------------------------
| Get Tags List -----------------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function getTagList($keyword){	

		$this->table = "tbl_tag";
		$this->selectConditions = array("where"=>"tagTitle LIKE '%".$keyword."%'");
		return $this->getData();	

	}	

/*
|--------------------------------------------------------------------------
| Get Module Categories ---------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function getModuleCategory($moduleID){	

		$this->table = "tbl_category";
		$this->selectConditions = array("select"=>"id,title,parentID",
										"where"=>"categoryModule = '".$moduleID."' AND categoryStatus = '1'  AND categoryLanguage = '". $this->session->userdata("panelLanguage")."'");
		return $this->getData();	

	}	

/*
|--------------------------------------------------------------------------
| Get All Categories ------------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function getAllCategory(){	

		$this->table = "tbl_category";
		$this->selectConditions = array("select"=>"id,title,parentID,categoryType,moduleUIPage,categoryURL,categoryModule,linkURL",
										"join"=>array(array("table"=>"tbl_module","joinCondition"=>"tbl_module.moduleID = tbl_category.categoryModule","joinType"=>"LEFT"),
													  array("table"=>"tbl_page_link","joinCondition"=>"tbl_page_link.linkCategoryID = tbl_category.id","joinType"=>"LEFT")),
										"where"=>"categoryStatus = '1' AND categoryLanguage = 'ir'",
										"order"=>"categoryIndex");
		return $this->getData();	

	}	

/*
|--------------------------------------------------------------------------
| Get Module Categories ---------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function getCatType($id){	

		$this->table = "tbl_category";
		$this->selectConditions = array("select"=>"categoryType,categoryModule",
										"where"=>"id = '".$id."'",
										"resultType" => "1");
		return $this->getData();	

	}	

/*
|--------------------------------------------------------------------------
| Confirm Module ----------------------------------------------------------
|--------------------------------------------------------------------------
*/
		
	function confirmModule($id){	

		$result = false;
		$this->table = "tbl_module";
		$this->selectConditions = array("select"=>"moduleID",
										"where"=>"moduleID = '".$id."' AND moduleStatus = '1'",
										"resultType" => "1");
		$queryResult = $this->getData();
		if(count($queryResult) == 1){
			$result = true;
		}
		return $result;

	}


/*
|--------------------------------------------------------------------------
| Category Category Title -------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function getCategoryTitle($id){	
		
		$this->table = "tbl_category";
		$this->selectConditions = array("select"=>"title",
										"where"=>"id = '".$id."'",
										"resultType" => "1");
		$result = $this->getData();	
		$finalResult = array("title"=> $result['title']);
		return $finalResult;		
	
	}	

/*
|--------------------------------------------------------------------------
|  Insert Category --------------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function insertCategory($values,$queryResult){

		$this->load->helper("tree");
		$link = '';
		$values['categoryURL'] = str_replace(" ","-",$values['parentTitle'])."/".str_replace(" ","-",$values['title'])."/";
		$values['categoryLanguage'] = $this->session->userdata("panelLanguage");
		if($values['parentID'] != '0'){
			$result = createArray($queryResult);
			$link = displayParentNodes($result,$values['parentID']);
		}else{
			$values['categoryURL'] = str_replace(" ","-",$values['title'])."/";
		}	  
		if($link != ''){
			$values['categoryURL'] = str_replace(" ","-",str_replace(" > ","/",$link))."/".str_replace(" ","-",$values['parentTitle'])."/".str_replace(" ","-",$values['title'])."/";
		}
		unset($values['parentTitle']);
		unset($values['submit']);
		$this->table = "tbl_category";
		$this->insert($values,$values['title']);
		return true;
													
	}

/*
|--------------------------------------------------------------------------
|   Edit Category
|--------------------------------------------------------------------------
*/
	
	function updateCategory($values,$id,$title,$lastType,$lastModule,$queryResult){

		$this->load->helper("tree");
		$link = '';
		$values['categoryURL'] = str_replace(" ","-",$values['parentTitle'])."/".str_replace(" ","-",$values['title'])."/";
		$values['categoryLanguage'] = $this->session->userdata("panelLanguage");
		if($values['parentID'] != '0'){
			$result = createArray($queryResult);
			$link = displayParentNodes($result,$values['parentID']);
		}else{
			$values['categoryURL'] = str_replace(" ","-",$values['title'])."/";
		}	  
		if($link != ''){
			$values['categoryURL'] = str_replace(" ","-",str_replace(" > ","/",$link))."/".str_replace(" ","-",$values['parentTitle'])."/".str_replace(" ","-",$values['title'])."/";
		}

		if($values['categoryType'] != $lastType && $lastModule == "25"){
			if($lastType == "c"){
				$this->table = "tbl_page_content";
				$this->primeryKey = "cantentCategoryID";
				$this->delete($id);	
				$this->db->flush_cache();
			}elseif($lastType == "l"){

				$this->table = "tbl_page_link";
				$this->primeryKey = "linkCategoryID";
				$this->delete($id);
				$this->db->flush_cache();		

			}elseif($lastType == "a"){

				$this->table = "tbl_page_link";
				$this->selectConditions = array(
					"select"=>"linkURL",
					"where"=>"linkCategoryID = '".$id."'",
					"resultType" => "1"
				);	
				$attach = $this->getData();	
				$this->db->flush_cache();
				if(count($attach) > 0){
					unlink(CAT_ATTACHMENT.$attach['linkURL']);
				}
				$this->table = "tbl_page_link";
				$this->primeryKey = "linkCategoryID";
				$this->delete($id);
				$this->db->flush_cache();	

			}elseif($lastType == "f"){
				$this->table = "tbl_page_form";
				$this->selectConditions = array(
					"select"=>"formGUID",
					"where"=>"linkCategoryID = '".$id."'",
					"resultType" => "1"
				);	
				$formResult = $this->getData();
				$this->db->flush_cache();
				if(count($formResult) > 0){
					$this->db->from('tbl_page_form');
					$this->primeryKey = "valueSrcGUID";
					$this->delete($formResult['formGUID']);	
					$this->db->flush_cache();
					$this->db->from('tbl_page_form');
					$this->primeryKey = "formResourceID";
					$this->delete($id);	
				}
			}
		}

		unset($values['parentTitle']);
		unset($values['submit']);
		$this->table = "tbl_category";
		$this->primeryKey = "id";
		$this->update($values,$id,$title);
		return true;
																		
	}

/*
|--------------------------------------------------------------------------
| Category Information For Edit
|--------------------------------------------------------------------------
*/
	
	function categoryInfo($id){
		
		$this->table = "tbl_category";
		$this->selectConditions = array("where"=>"id = '".$id."'","resultType"=>"1");
		return $this->getData();		
	
	}	


/*
|--------------------------------------------------------------------------
| Get Cat List ------------------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function getItemCatList($catsList){
					
			$cats = explode(";;",$catsList);
			$catsArray = array_values(array_filter(array_unique($cats)));
			$this->db->from('tbl_category');
			$this->db->or_where_in('id', $catsArray);	
			$query = $this->db->get();
			return $query->result();					
							
	}

/*
|--------------------------------------------------------------------------
| Delete Category ---------------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function deleteCategory($id,$title){

		$message = "دسته بندی یا صفحه مورد نظر حذف گردید";

		$this->table = "tbl_category p";
		$this->selectConditions = array("select"=>"p.id as parentID,p.title as parentTitle, p.categoryImg as image , , p.categoryType as type ,c.id as childID,c.title as childTitle",
										"join"=>array(array("table"=>"tbl_category c","joinCondition"=>"c.parentID = p.id","joinType"=>"LEFT")),
										"where"=>"p.id = '".$id."'",
										);
		$result = $this->getData();

		if(count($result) > 1){
			$message = "این دسته بندی دارای زیر دسته بندی می باشد و شما نمی توانید آنرا حذف نمایید";
		}else{
			if($result[0]['type'] == "c"){
				$this->table = "tbl_page_content";
				$this->primeryKey = "cantentCategoryID";
				$this->delete($id);	
				$this->db->flush_cache();
			}elseif($result[0]['type']  == "l"){

				$this->table = "tbl_page_link";
				$this->primeryKey = "linkCategoryID";
				$this->delete($id);
				$this->db->flush_cache();		

			}elseif($result[0]['type']  == "a"){

				$this->table = "tbl_page_link";
				$this->selectConditions = array(
					"select"=>"linkURL",
					"where"=>"linkCategoryID = '".$id."'",
					"resultType" => "1"
				);	
				$attach = $this->getData();	
				$this->db->flush_cache();
				if(count($attach) > 0){
					unlink(CAT_ATTACHMENT.$attach['linkURL']);
				}
				$this->table = "tbl_page_link";
				$this->primeryKey = "linkCategoryID";
				$this->delete($id);
				$this->db->flush_cache();	

			}elseif($lastType == "f"){
				$this->table = "tbl_page_form";
				$this->selectConditions = array(
					"select"=>"formGUID",
					"where"=>"linkCategoryID = '".$id."'",
					"resultType" => "1"
				);	
				$formResult = $this->getData();
				$this->db->flush_cache();
				if(count($formResult) > 0){
					$this->db->from('tbl_page_form');
					$this->primeryKey = "valueSrcGUID";
					$this->delete($formResult['formGUID']);	
					$this->db->flush_cache();
					$this->db->from('tbl_page_form');
					$this->primeryKey = "formResourceID";
					$this->delete($id);	
				}
			}
			$this->table = "tbl_category";
			$this->primeryKey = "id";
			$this->delete($id,$title);
			$this->db->flush_cache();
			if($result[0]['image'] != null){
				unlink(CATEGORY.$result[0]['image']);
			}
		}	
		return $message;		
	}

/*
|--------------------------------------------------------------------------
| Get Page Content --------------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function getPageContent($id){	
		
		$this->table = "tbl_page_content";
		$this->selectConditions = array("where"=>"cantentCategoryID = '".$id."'","resultType"=>"1");
		return $this->getData();										
	
	}

/*
|--------------------------------------------------------------------------
| Insert And Edit page Content --------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function insertPageContent($values,$action,$categoryID,$title){

		$this->table = "tbl_page_content";
		unset($values['submit']);
		$values['contentLanguage'] = $this->session->userdata('panelLanguage');
		$values['cantentCategoryID'] = $categoryID;
		if($action == "insert"){		
			$this->insert($values,$title);		
		}else{
			$this->primeryKey = "cantentCategoryID";
			$this->update($values,$categoryID,$title);			
		}		
				
	}

/*
|--------------------------------------------------------------------------
| Get Page Link And Attachment
|--------------------------------------------------------------------------
*/
	
	function getPageLink($id,$type){
		
		$this->table = "tbl_page_link";
		$this->selectConditions = array("where"=>"linkCategoryID = '".$id."' AND linkType = '".$type."'" ,"resultType"=>"1");
		return $this->getData();						
	
	}

/*
|--------------------------------------------------------------------------
| Insert Page Link And Attachment
|--------------------------------------------------------------------------
*/
	
	function insertPageLink($values,$action,$categoryID,$attachment = NULL){

		$values['linkCategoryID'] = $categoryID;
		$values['linkType'] = "l";
		if($attachment != NULL){
			$values['linkType'] = "a";
		}
		unset($values['submit']);
		$this->table = "tbl_page_link";
		if($action == "insert"){
			$this->createdAt = false;
			$this->insert($values,$values['linkURL']);
		}else{
			$this->updatedAt = false;
			$this->primeryKey = "linkCategoryID";
			$this->update($values,$categoryID,$values['linkURL']);	
		}

	}

/*
|--------------------------------------------------------------------------
| Get Category Index
|--------------------------------------------------------------------------
*/
	
	function getMenuIndex($id){		
		
		$this->table = "tbl_category";
		$this->selectConditions = array("where"=>"parentID = '".$id."' AND categoryLanguage = '".$this->session->userdata('panelLanguage')."'",
									    "order"=>"categoryIndex");
		return $this->getData();

	}
	
/*
|--------------------------------------------------------------------------
| Change Category Index
|--------------------------------------------------------------------------
*/

	 function changeCategoryIndex($menuIndexes){
		 	
		$indexes = array_values(array_filter(array_unique(explode(",",$menuIndexes))));
		$this->table = "tbl_category";
		for($i = 0 ; $i < count($indexes) ; $i++){		
			$data = array("categoryIndex" => $i+1);
			$this->primeryKey = "id";
			$this->update($data,$indexes[$i]);		
		}
		
	}


/*
|--------------------------------------------------------------------------
| Get Contact List -----------------------------------------------------------
|--------------------------------------------------------------------------
*/

	function getContactList($limit,$segments,$page,$url){

		$query = "SELECT * FROM tbl_contact 
					WHERE contactLanguage = '".$this->session->userdata('panelLanguage')."'
					ORDER BY created_at DESC";	
		return $this->paginate($limit,$segments,$page,$query,$url,"panel");

	}

/*
|--------------------------------------------------------------------------
|  Contact Action Data -----------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function actionContactData($values,$id = null,$title = null) {

		$this->table = "tbl_contact";
		if($id == null){
			$values['contactLanguage'] = $this->session->userdata("panelLanguage");
			unset($values['submit']);		
			$this->insert($values,$values['contactTitle']);
		}else{
			unset($values['submit']);	
			$this->primeryKey = "contactID";
			$this->update($values,$id,$title);
		}
	}

/*
|--------------------------------------------------------------------------
| Get Contact In Site -----------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function getContact(){
			
		$this->table = "tbl_contact";
		return $this->getData();						

	}

/*
|--------------------------------------------------------------------------
| Get Contact Data --------------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function getContactData($id){
				
		$this->table = "tbl_contact";
		$this->selectConditions = array("where"=>"contactID = '".$id."'","resultType"=>"1");
		return $this->getData();						

	}

/*
|--------------------------------------------------------------------------
| Delete Contact  ---------------------------------------------------------
|--------------------------------------------------------------------------
*/

	function deleteContact($id,$title){	

		$this->table = "tbl_contact";
		$this->primeryKey = "contactID";
		$this->delete($id,$title);			
		
	}


/*
|--------------------------------------------------------------------------
| Get Page Content
|--------------------------------------------------------------------------
*/
	
	function getPageContentView($pageTitle){	
		
		$this->table = "tbl_category";
		$this->selectConditions = array("select"=>"categoryType,id",
										"where"=>"title = '".str_replace("-"," ",$pageTitle)."'",
										"resultType"=>"1"
									);
		$result = $this->getData();	
							
		
		if($result['categoryType'] == "c"){
			$this->table = "tbl_page_content";
			$this->selectConditions = array("where"=>"cantentCategoryID = '".$result['id']."'",
											"resultType"=>"1"
										);
			$finalResult = array( $this->getData(),"c");
			
		}elseif($result[0]['categoryType'] == "f"){
			
			$this->load->model("Property_class");
			$this->db->select('formGroupID');
			$this->db->from('tbl_page_form');
			$this->db->where("formResourceID",$result[0]['id']);	
			$query = $this->db->get();
			$finalResult = array($this->Property_class->getPageForm($query->result()[0]->formGroupID),"f");

		}
		
		return $finalResult;
	
	}

// /*
// |--------------------------------------------------------------------------
// | Category Information 
// |--------------------------------------------------------------------------
// */
	
// 	function getCategory($id){			
								
// 		$this->db->select('categoryType');
// 		$this->db->select('categoryModule');
// 		$this->db->from('tbl_category');
// 		$this->db->where("id",$id);	
// 		$query = $this->db->get();
// 		$result = array("type"=>$query->result()[0]->categoryType,"module"=>$query->result()[0]->categoryModule);
// 		return $result;		
	
// 	}












		 




// /*
// |--------------------------------------------------------------------------
// | Get Page Link And Attachment
// |--------------------------------------------------------------------------
// */
	
// 	function getPageFormData($id){			
								
// 		$this->db->from('tbl_page_form');
// 		$this->db->where("formResourceID",$id);	
// 		$query = $this->db->get();
// 		$result = $query->result_array();
		
// 		if($query->num_rows() > 0){
// 			return $result[0];
// 		}
	
// 	}

// /*
// |--------------------------------------------------------------------------
// | Insert Page Link And Attachment
// |--------------------------------------------------------------------------
// */
	
// 	function insertPageForm($values,$action,$categoryID){
		
// 		$this->load->helper("str");
		
// 		$data = array();
// 		$table = "tbl_page_form"; 		
// 		$fields = $this->db->list_fields($table);
			
// 		foreach($fields as $field){
	
// 			if($field != "formGUID" && $field != "formResourceID"){
				
// 				$data[$field] = $values[$field]	;
				
// 			}elseif($field == "formResourceID"){
									
// 				$data[$field] = $categoryID;
			
// 			}elseif($field == "formGUID" && $action == "insert"){
									
// 				$data[$field] = guid();
			
// 			}
	
// 		}	
			
	
// 		if($action == "insert"){
			
// 			$this->db->insert($table, $data);
			
// 		}elseif ($action == "edit"){			
			
// 			$this->db->where("formResourceID",$categoryID);
// 			$this->db->update($table, $data);
			
// 		}
										
// 	}





}
