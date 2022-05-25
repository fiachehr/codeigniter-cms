<?php
class Product_class extends My_Model{

/*
|--------------------------------------------------------------------------
| --- Class Constractor ---------------------------------------------------
|--------------------------------------------------------------------------
*/	
	function __construct()
	{	
		parent::__construct();	
	}	

/*
|--------------------------------------------------------------------------
| Get Product List --------------------------------------------------------
|--------------------------------------------------------------------------
*/

	function getProductList($limit,$segments,$page,$url)
	{
		$query = "SELECT title,tbl_product.created_at as regDate,productGUID,productCode,productStatus,productHits,productCommentCount,productTitle FROM tbl_product
					LEFT OUTER JOIN tbl_item_cat ON tbl_item_cat.resrcGUID = tbl_product.productGUID
					LEFT OUTER JOIN tbl_category ON tbl_category.id = tbl_item_cat.itemCatID
					WHERE productLanguage = '".$this->session->userdata('panelLanguage')."'
					GROUP BY productTitle
					ORDER BY tbl_product.created_at DESC";	
		return $this->paginate($limit,$segments,$page,$query,$url,"panel");
	}

	
/*
|-------------------------------------------------------------------------
|--- Product Tags Suggestion  --------------------------------------------
|-------------------------------------------------------------------------
*/
	
	function suggestProduct($keyword)
	{
		$this->table = "tbl_product";
		$this->selectConditions = array("select"=>"productTitle,productCode","where"=>"productTitle LIKE '%".$keyword."%'","order"=>"productTitle DESC");					
		return $this->getData();
	}


/*
|-------------------------------------------------------------------------
|  Product Tags ----------------------------------------------------------
|-------------------------------------------------------------------------
*/
	
	function productTag($id){

		$this->table = "tbl_item_tag";
		$this->selectConditions = array("select"=>"tagTitle,tagID","where"=>"tagResrcGUID = '".$id."'","join"=>array(array("table"=>"tbl_tag","joinCondition"=>"tbl_item_tag.itemTagID = tbl_tag.tagID","joinType"=>"LEFT OUTER")));					
		return $this->getData();
		
	}

/*
|--------------------------------------------------------------------------
| Update Image Count ------------------------------------------------------
|--------------------------------------------------------------------------
*/

	function updateImageCount($productGUID,$imageCount){
		$data['imageCount'] = $imageCount;
		$this->table = "tbl_product";
		$this->primeryKey = "productGUID";
		$this->updatedAt = false;
		$this->update($data,$productGUID);
	}


/*
|-------------------------------------------------------------------------
|  Action SmProduct -----------------------------------------------------------
|-------------------------------------------------------------------------
*/
	
	function actionProduct($values,$id = null,$title = null){
		
		$this->load->helper('str');
		$productTags = json_decode($values['tagsList']);
		$productCats = strToArr($values['productCatList'],";;");
		
		$catData = array();
		$tagData = array();
		$newTagData = array();
		// Default Values
		$values['productCommentCount'] = 0;
		$values['productHits'] = 0;
		$values['productLanguage'] = $this->session->userdata("panelLanguage");	
		$singleTag['tagResrcGUID'] = $singleCat['resrcGUID'] = $values['productGUID'];
		if(!isset($values['productRecommanded'])){
			$values['productRecommanded'] = "0";
		}
		// Category
		foreach($productCats as $val){
			$singleCat['itemCatID'] = $val;
			array_push($catData,$singleCat);			
		}	
		// Tags
		foreach($productTags as $val){
			if(substr($val,0,7) == "newTag-"){
				$singleNewTag['tagTitle'] = trim(cleanString(str_replace("newTag-","",$val)));
				array_push($newTagData,$singleNewTag);
			}else{
				$singleTag['itemTagID'] = $val;
				array_push($tagData,$singleTag);			
			}
		}	
		// Delete Unnecessary Values
		unset($values['submit']);
		unset($values['trueImage']);
		unset($values['parentTitle']);
		unset($values['parentID']);
		unset($values['productCatList']);
		unset($values['tagsList']);
		unset($values['tagsListTitle']);
		//New Tags
		if(count($newTagData) > 0){		
			foreach($newTagData as $tag){
				$this->db->trans_start();
				$this->createdAt = false;	
				$this->table = "tbl_tag";
				$this->insert($tag);
				$singleTag['itemTagID'] = (string)$this->db->insert_id();
				$this->db->trans_complete();
				array_push($tagData,$singleTag);
			}			
		}	
	
		$this->table = "tbl_product";
		if($id == null){
			// Insert Product
			$this->db->trans_start();
			$this->insert($values,$values['productTitle']);
			$this->createdAt = false;	
			$this->table = "tbl_item_cat";
			$this->insert($catData);	
			
			if(count($tagData) > 0){
				$this->createdAt = false;	
				$this->table = "tbl_item_tag";
				$this->insert($tagData);
			}
			$this->db->trans_complete();
		}else{
			$this->db->trans_start();
			$this->primeryKey = "productGUID";
			$this->update($values,$id,$title);
			$this->db->flush_cache();

			$this->table = "tbl_item_cat";
			$this->primeryKey = "resrcGUID";
			$this->delete($values['productGUID']);	
			$this->db->flush_cache();

			$this->createdAt = false;	
			$this->table = "tbl_item_cat";
			$this->insert($catData);
			$this->db->flush_cache();

        	if(count($tagData) > 0){
        	    
            	$this->table = "tbl_item_tag";
    			$this->primeryKey = "tagResrcGUID";
    			$this->delete($values['productGUID']);	
    			$this->db->flush_cache();
    			
    			$this->createdAt = false;	
    			$this->table = "tbl_item_tag";
    			$this->insert($tagData);
    			
        	}
        	$this->db->trans_complete();
		}										
	}

/*
|-------------------------------------------------------------------------
|  Product Show -------------------------------------------------------------
|-------------------------------------------------------------------------
*/
	
	function productShow($id,$type){

		$this->table = "tbl_product";	
		if($type == "cms"){			
			$this->selectConditions = array("where"=>"productGUID = '".$id."'","resultType" => "e");									
		}else{
			$this->selectConditions = array("select"=>"productMaterial,productCountry,productLicense,productVitamin,productUsage,productFRNet,productMINet,productENNet,productRate,productProYear,productBrand,productSmellStr,productSmellStr,productTitle,title,categoryURL,id,productCode,productGUID,imageCount,productFor,productVolume,productPrice,productDesc,productDicount,productWeight","where"=>"productCode = '".$id."' AND productStatus = 'e'",
											"join"=>array(array("table"=>"tbl_item_cat","joinCondition"=>"tbl_item_cat.resrcGUID = tbl_product.productGUID","joinType"=>"INNER"),
														  array("table"=>"tbl_category","joinCondition"=>"tbl_item_cat.itemCatID = tbl_category.id","joinType"=>"INNER")));			
		}	
		return $this->getData();

	}

/*
|-------------------------------------------------------------------------
|  Get Prosuct Tag -------------------------------------------------------
|-------------------------------------------------------------------------
*/
	
	function getProductTag($id)
	{
		$this->table = "tbl_item_tag";	
		$this->selectConditions = array("select"=>"tagTitle","where"=>"tagResrcGUID = '".$id."'",
										"join"=>array(array("table"=>"tbl_tag","joinCondition"=>"tbl_tag.tagID = tbl_item_tag.itemTagID","joinType"=>"INNER")));			
		return $this->getData();
	}


/*
|--------------------------------------------------------------------------
| Get Top Product List -----------------------------------------------------------
|--------------------------------------------------------------------------
*/

	function relatedProduct($id,$limit)
	{
		$this->table = "tbl_product";
		$this->selectConditions['select'] = "productTitle,productGUID,productPrice,productDicount,productCode,productWeight";
		$this->selectConditions['where'] = "itemCatID = '".$id."' AND productStatus = 'e'";
		$this->selectConditions['order'] = "created_at DESC";
		$this->selectConditions['join'] = array(array("table"=>"tbl_item_cat","joinCondition"=>"tbl_item_cat.resrcGUID = tbl_product.productGUID","joinType"=>"INNER"));
		$this->selectConditions['limit'] = $limit;
		return $this->getData();
	}

/*
|--------------------------------------------------------------------------
| Delete SmProduct -------------------------------------------------------------
|--------------------------------------------------------------------------
*/

	function deleteProduct($id,$title){	
		
		$this->table = "tbl_product";
		$this->selectConditions = array("select"=>"imageCount","where"=>"productGUID = '".$id."'","resultType" => "1");
		$result = $this->getData();

		if($result['imageCount'] > 0){
			for($i = 0 ; $i < $result['imageCount'] ; $i++){
				if (file_exists(PRODUCT.$id."--".$i.".jpg")) {
					unlink(PRODUCT.$id."--".$i.".jpg");
				}
				if (file_exists(PRODUCT."thumb".$id."--".$i.".jpg")) {
					unlink(PRODUCT."thumb/".$id."--".$i.".jpg");
				}
			}
		}

		$this->db->trans_start();
		$this->table = "tbl_product";
		$this->primeryKey = "productGUID";
		$this->delete($id,str_replace("-"," ",$title));	

		$this->db->flush_cache();

		$this->table = "tbl_item_cat";
		$this->primeryKey = "resrcGUID";
		$this->delete($id);	

		$this->table = "tbl_item_tag";
		$this->primeryKey = "tagResrcGUID";
		$this->delete($id);	

		$this->db->trans_complete();
						
	}


/*
|-------------------------------------------------------------------------
|  Product Category ------------------------------------------------------
|-------------------------------------------------------------------------
*/
		
	function productCat($id){

		$this->table = "tbl_item_cat";
		$this->selectConditions = array("select"=>"title,id",
										"where"=>"resrcGUID = '".$id."'",
										"join"=>array(
														array("table"=>"tbl_category",
															"joinCondition"=>"tbl_item_cat.itemCatID = tbl_category.id",
															"joinType"=>"INNER"
															)
													),
										);			
		
		return $this->getData();
		
	}

/*
|--------------------------------------------------------------------------
| Get Top Product List -----------------------------------------------------------
|--------------------------------------------------------------------------
*/

	function getHomeProduct($limit,$type){

		$this->table = "tbl_product";
		$this->selectConditions['select'] = "productTitle,productGUID,productPrice,productDicount,productCode,productWeight";

		if($type == "Top F"){
			$this->selectConditions['where'] = "productStatus = 'e' AND productFor = 'بانوان'";
			$this->selectConditions['order'] = "productHits DESC";
			$this->selectConditions['limit'] = $limit;
		}
		if($type == "Top M"){
			$this->selectConditions['where'] = "productStatus = 'e' AND productFor = 'آقایان'";
			$this->selectConditions['order'] = "productHits DESC";
			$this->selectConditions['limit'] = $limit;
		}
		if($type == "F"){
			$this->selectConditions['where'] = "productStatus = 'e' AND productFor = 'بانوان'";
			$this->selectConditions['order'] = "created_at DESC";
			$this->selectConditions['limit'] = $limit;
		}
		if($type == "M"){
			$this->selectConditions['where'] = "productStatus = 'e' AND productFor = 'آقایان'";
			$this->selectConditions['order'] = "created_at DESC";
			$this->selectConditions['limit'] = $limit;
		}
		if($type == "H"){
			$this->selectConditions['where'] = "itemCatID = '33' AND productStatus = 'e'";
			$this->selectConditions['order'] = "created_at DESC";
			$this->selectConditions['join'] = array(array("table"=>"tbl_item_cat","joinCondition"=>"tbl_item_cat.resrcGUID = tbl_product.productGUID","joinType"=>"INNER"));
			$this->selectConditions['limit'] = $limit;
		}
		if($type == "S"){
			$this->selectConditions['where'] = "itemCatID = '37' AND productStatus = 'e'";
			$this->selectConditions['order'] = "created_at DESC";
			$this->selectConditions['join'] = array(array("table"=>"tbl_item_cat","joinCondition"=>"tbl_item_cat.resrcGUID = tbl_product.productGUID","joinType"=>"INNER"));
			$this->selectConditions['limit'] = $limit;
		}
		if($type == "TH"){
			$this->selectConditions['where'] = "itemCatID = '33' AND productStatus = 'e'";
			$this->selectConditions['order'] = "productHits DESC";
			$this->selectConditions['join'] = array(array("table"=>"tbl_item_cat","joinCondition"=>"tbl_item_cat.resrcGUID = tbl_product.productGUID","joinType"=>"INNER"));
			$this->selectConditions['limit'] = $limit;
		}
		return $this->getData();

	}

/*
|--------------------------------------------------------------------------
| Get Product List --------------------------------------------------------
|--------------------------------------------------------------------------
*/

	function productCatList($limit,$segments,$page,$url,$id)
	{
		$query = "SELECT title,productGUID,productCode,productCommentCount,productTitle,productPrice,productDicount,productWeight FROM tbl_product
					LEFT OUTER JOIN tbl_item_cat ON tbl_item_cat.resrcGUID = tbl_product.productGUID
					LEFT OUTER JOIN tbl_category ON tbl_category.id = tbl_item_cat.itemCatID
					WHERE productStatus = 'e' AND itemCatID = ".$id."
					GROUP BY productTitle
					ORDER BY tbl_product.created_at ASC";	
		return $this->paginate($limit,$segments,$page,$query,$url,"site");
	}

}
/* End of file ProductSM_class.php */
/* Location: ./application/modules/ProductSM_class.php */					
