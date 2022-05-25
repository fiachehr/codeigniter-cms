<?php
class News_class extends My_Model{

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
| Get News List -----------------------------------------------------------
|--------------------------------------------------------------------------
*/

	function getNewsList($limit,$segments,$page,$url){

		$query = "SELECT * FROM tbl_news 
					LEFT OUTER JOIN tbl_item_cat ON tbl_item_cat.resrcGUID = tbl_news.newsGUID
					LEFT OUTER JOIN tbl_category ON tbl_category.id = tbl_item_cat.itemCatID
					WHERE newsLanguage = '".$this->session->userdata('panelLanguage')."'
					GROUP BY newsTitle
					ORDER BY newsCode DESC";	

		return $this->paginate($limit,$segments,$page,$query,$url,"panel");

	}

/*
|--------------------------------------------------------------------------
| Get News Resource List 
|--------------------------------------------------------------------------
*/

	function getRescourceNews(){
		
		$this->db->from("tbl_news_service");
		$this->db->where("newsSrvLanguage",$this->session->userdata('panelLanguage'));
		$query = $this->db->get();	
		return $query->result_array();		

	}

/*
|--------------------------------------------------------------------------
| Update Image Count ------------------------------------------------------
|--------------------------------------------------------------------------
*/

	function updateImageCount($newsGUID,$imageCount){
		$data['imageCount'] = $imageCount;
		$this->table = "tbl_news";
		$this->primeryKey = "newsGUID";
		$this->updatedAt = false;
		$this->update($data,$newsGUID);
	}

/*
|--------------------------------------------------------------------------
| Get News Title List -----------------------------------------------------
|--------------------------------------------------------------------------
*/

	function getNewsTitle($keyword){
			
		$this->table = "tbl_news";
		$this->selectConditions = array("where"=>"newsTitle LIKE '%".$keyword."%' AND newsStatus = '1'","order"=>"newsTitle DESC","select"=>"newsTitle as title , newsCode as id");
		return $this->getData();

	}

/*
|-------------------------------------------------------------------------
|  Insert News -----------------------------------------------------------
|-------------------------------------------------------------------------
*/
	
	function insertNews($values){

		$this->load->helper('str');

		$newsTags = json_decode($values['tagsList']);
		$newsCats = strToArr($values['newsCatList'],";;");
		$values['newsCommentCount'] = 0;
		$values['newsHits'] = 0;
		$values['newsLanguage'] = $this->session->userdata("panelLanguage");
		$catData = array();
		$tagData = array();
		$newTagData = array();
		
		unset($values['submit']);
		unset($values['trueImage']);
		unset($values['parentTitle']);
		unset($values['newsCatList']);
		unset($values['tagsList']);
		unset($values['tagsListTitle']);
	
		$singleTag['tagResrcGUID'] = $singleCat['resrcGUID'] = $values['newsGUID'];

		foreach($newsTags as $val){
			if(substr($val,0,7) == "newTag-"){
				$singleNewTag['tagTitle'] = trim(cleanString(str_replace("newTag-","",$val)));
				array_push($newTagData,$singleNewTag);
			}else{
				$singleTag['itemTagID'] = $val;
				array_push($tagData,$singleTag);			
			}
		}	

		foreach($newsCats as $val){
			$singleCat['itemCatID'] = $val;
			array_push($catData,$singleCat);			
		}	

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

		$this->db->trans_start();
		$this->table = "tbl_news";
		$this->insert($values,$values['newsTitle']);
		$this->createdAt = false;	
		$this->table = "tbl_item_cat";
		$this->insert($catData);	
		if(count($tagData) > 0){
			$this->createdAt = false;	
			$this->table = "tbl_item_tag";
			$this->insert($tagData);
		}
		$this->db->trans_complete();
		return true;
														
	}

/*
|-------------------------------------------------------------------------
|  News Show -------------------------------------------------------------
|-------------------------------------------------------------------------
*/
	
	function newsShow($id,$type){
			
		if($type == "cms"){

			$this->table = "tbl_news";
			$this->selectConditions = array("where"=>"newsGUID = '".$id."'",
											"join"=>array(
															array("table"=>"tbl_schedule",
																"joinCondition"=>"tbl_news.newsGUID = tbl_schedule.scheduleSrcID",
																"joinType"=>"LEFT OUTER"
																)
														),
											"resultType" => "1"
											);			
							
		}else{
			$this->table = "tbl_news";
			$this->selectConditions = array("select"=>"newsGUID,newsTitle,newsRTitle,newsSoTitle,title,tbl_news.created_at as newsRegDate,newsArthur,newsSummery,newsBody",
											"where"=>"tbl_news.newsStatus = '1' AND newsCode = '".$id."'",
											"join"=>array(array("table"=>"tbl_item_cat","joinCondition"=>"tbl_item_cat.resrcGUID = tbl_news.newsGUID","joinType"=>"INNER"),
													array("table"=>"tbl_category","joinCondition"=>"tbl_item_cat.itemCatID = tbl_category.id","joinType"=>"INNER"))
											);		
		}
		return $this->getData();

	}

/*
|-------------------------------------------------------------------------
|  News Tags -------------------------------------------------------------
|-------------------------------------------------------------------------
*/

	function newsTag($id){

		$this->table = "tbl_item_tag";
		$this->selectConditions = array("select"=>"tagTitle,tagID",
										"where"=>"tagResrcGUID = '".$id."'",
										"join"=>array(
														array("table"=>"tbl_tag",
															"joinCondition"=>"tbl_item_tag.itemTagID = tbl_tag.tagID",
															"joinType"=>"LEFT OUTER"
															)
													),
										);			
		
		return $this->getData();
		
	}

/*
|-------------------------------------------------------------------------
|  News Category ---------------------------------------------------------
|-------------------------------------------------------------------------
*/
	
	function newsCat($id){

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
|-------------------------------------------------------------------------
|  Edit News -------------------------------------------------------------
|-------------------------------------------------------------------------
*/

	function editNews($values,$lastTitle){
		
		$this->load->helper('str');

		$newsTags = json_decode($values['tagsList']);
		$newsCats = strToArr($values['newsCatList'],";;");
		$values['newsLanguage'] = $this->session->userdata("panelLanguage");
		$catData = array();
		$tagData = array();
		$newTagData = array();

		if(!isset($values['newsRecommanded'])){
			$values['newsRecommanded'] = "0";
		}

		unset($values['submit']);
		unset($values['trueImage']);
		unset($values['parentTitle']);
		unset($values['newsCatList']);
		unset($values['tagsList']);
		unset($values['tagsListTitle']);
		
		$singleTag['tagResrcGUID'] = $singleCat['resrcGUID'] = $values['newsGUID'];

		foreach($newsTags as $val){
			if(substr($val,0,7) == "newTag-"){
				$singleNewTag['tagTitle'] = trim(cleanString(str_replace("newTag-","",$val)));
				array_push($newTagData,$singleNewTag);
			}else{
				$singleTag['itemTagID'] = $val;
				array_push($tagData,$singleTag);			
			}
		}	

		foreach($newsCats as $val){
			$singleCat['itemCatID'] = $val;
			array_push($catData,$singleCat);			
		}	

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

		$this->db->trans_start();

		$this->table = "tbl_news";
		$this->primeryKey = "newsGUID";
		$this->updatedAt = false;
		$this->update($values,$values['newsGUID']);

		$this->db->flush_cache();

		$this->table = "tbl_item_cat";
		$this->primeryKey = "resrcGUID";
		$this->delete($values['newsGUID']);	

		$this->db->flush_cache();

		$this->table = "tbl_item_tag";
		$this->primeryKey = "tagResrcGUID";
		$this->delete($values['newsGUID']);	

		$this->db->flush_cache();

		$this->createdAt = false;	
		$this->table = "tbl_item_cat";
		$this->insert($catData);	
		if(count($tagData) > 0){
			$this->createdAt = false;	
			$this->table = "tbl_item_tag";
			$this->insert($tagData);
		}

		$this->db->trans_complete();
		return true;
						
	}

/*
|--------------------------------------------------------------------------
| Get Parent News ---------------------------------------------------------
|--------------------------------------------------------------------------
*/

	function newsParent($id){

		$this->table = "tbl_news";
		$this->selectConditions = array("select"=>"newsTitle,newsCode","where"=>"newsCode = '".$id."'","resultType" => "1");
		return $this->getData();	

	}	


/*
|--------------------------------------------------------------------------
| Delete News -------------------------------------------------------------
|--------------------------------------------------------------------------
*/

	function deleteNews($id,$title){	
		
		$this->table = "tbl_news";
		$this->selectConditions = array("select"=>"imageCount","where"=>"newsGUID = '".$id."'","resultType" => "1");
		$result = $this->getData();

		if($result['imageCount'] > 0){
			for($i = 0 ; $i < $result['imageCount'] ; $i++){
				if (file_exists(NEWS.$id."--".$i.".jpg")) {
					unlink(NEWS.$id."--".$i.".jpg");
				}
				if (file_exists(NEWS."thumb".$id."--".$i.".jpg")) {
					unlink(NEWS."thumb/".$id."--".$i.".jpg");
				}
			}
		}
							
		$this->db->trans_start();

		$this->table = "tbl_item_cat";
		$this->primeryKey = "resrcGUID";
		$this->delete($id);	

		$this->db->flush_cache();

		$this->table = "tbl_item_tag";
		$this->primeryKey = "tagResrcGUID";
		$this->delete($id);	

		$this->db->flush_cache();

		$this->table = "tbl_news";
		$this->primeryKey = "newsGUID";
		$this->delete($id,str_replace("-"," ",$title));	
				
		$this->db->trans_complete();			
		
	}

/*
|--------------------------------------------------------------------------
| Get Last News -----------------------------------------------------------
|--------------------------------------------------------------------------
*/

	function getLastNews($limit){
				
		$this->table = "tbl_news";
		$this->selectConditions['select'] = "newsTitle,newsCode,newsGUID,newsSummery";
		$this->selectConditions['where'] = "itemCatID = '64' AND newsStatus = '1'";
		$this->selectConditions['order'] = "created_at DESC";
		$this->selectConditions['join'] = array(array("table"=>"tbl_item_cat","joinCondition"=>"tbl_item_cat.resrcGUID = tbl_news.newsGUID","joinType"=>"INNER"));
		$this->selectConditions['limit'] = $limit;
		return $this->getData();

	}

/*
|--------------------------------------------------------------------------
| Get News List --------------------------------------------------------
|--------------------------------------------------------------------------
*/

	function newsCatList($limit,$segments,$page,$url,$id)
	{
		$query = "SELECT title,newsGUID,newsCode,newsTitle,newsSummery FROM tbl_news
					INNER JOIN tbl_item_cat ON tbl_item_cat.resrcGUID = tbl_news.newsGUID
					INNER JOIN tbl_category ON tbl_category.id = tbl_item_cat.itemCatID
					WHERE newsStatus = '1' AND itemCatID = ".$id."
					GROUP BY newsTitle
					ORDER BY tbl_news.created_at DESC";	
		return $this->paginate($limit,$segments,$page,$query,$url,"site");
	}

}
/* End of file news_class.php */
/* Location: ./application/modules/news/news_class.php */					
