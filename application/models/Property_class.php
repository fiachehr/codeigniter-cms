<?php
class Property_class extends MY_Model{
	
/*
|--------------------------------------------------------------------------
| Class Constractor
|--------------------------------------------------------------------------
*/
	
	function __construct(){
		
		parent::__construct();
	
	}	

/************************************************************** 
* 	Get Modules List
***************************************************************/

	function getModuleList(){
		
		$query = $this->db->query("SELECT * FROM `tbl_module` WHERE `moduleStatus` = '1' AND (`moduleLabel` = 'category' OR `moduleLabel` = 'news' OR `moduleLabel` = 'product' OR `moduleLabel` = 'estate' OR `moduleLabel` = 'project' OR `moduleLabel` = 'download' OR `moduleLabel` = 'information' OR `moduleLabel` = 'classified')");
		return $query->result();	

	}	

/*
|--------------------------------------------------------------------------
|  Property Group Insert And Edit
|--------------------------------------------------------------------------
*/
	
	function propertyGroupActionData($values,$id = NULL){
		
		$data = array();
		$table = "tbl_property_group"; 		
		$fields = $this->db->list_fields($table);
								
		foreach($fields as $field){
		
			if($field != "propertyGroupID" && $field != "propertyLanguage"){
				
				$data[$field] = $values[$field]	;
				
			}elseif($field == "propertyLanguage"){
				
				$data[$field] = $this->session->userdata('panelLanguage');
				
			}
		
		}	
		
		if($id == NULL){
			
			$this->db->insert($table, $data);
			parent::userLog("درج گروه مشخصه",$values["propertyGroupTitle"]);
			
		}else{
			
			$this->db->where("propertyGroupID",$id);
			$this->db->update($table, $data);	
			parent::userLog("ویرایش گروه مشخصه",$values["propertyGroupTitle"]);
		
			
		}					
										
	}
	
/************************************************************** 
* 	Get Property Group List
***************************************************************/

	function getPropertyGroupList($limit,$segments,$page,$url){
		
		$query = "SELECT * FROM tbl_property_group LEFT OUTER JOIN tbl_module ON tbl_module.moduleID = tbl_property_group.propertyGroupModule WHERE propertyLanguage = '".$this->session->userdata('panelLanguage')."'";	
		$result = $this->db->query($query);
		$num = $result->num_rows();		
		return  $this->pagging($limit,$num,$segments,$page,$query,$url);

	}

/*
|--------------------------------------------------------------------------
| Get Property Group
|--------------------------------------------------------------------------
*/
	
	function getPropertyGroupInfo($id){
		
		$this->db->from('tbl_property_group');
		$this->db->join("tbl_module","tbl_module.moduleID = tbl_property_group.propertyGroupModule","LEFT OUTER");			
		$this->db->where("propertyGroupID",$id);	
		$query = $this->db->get();
		$result = $query->result_array();	
		return $result[0];	
			
	}

/************************************************************** 
* 	Get Property List
***************************************************************/

	function getPropertyList($limit,$segments,$page,$url,$id){
		
		$query = "SELECT * FROM tbl_property  WHERE propertyGroup = '".$id."'";	
		$result = $this->db->query($query);
		$num = $result->num_rows();		
		return  $this->pagging($limit,$num,$segments,$page,$query,$url);

	}

/*
|--------------------------------------------------------------------------
|  User Group Data Action
|--------------------------------------------------------------------------
*/
	
	function propertyActionData($values,$groupID,$id = NULL){
		

		$this->load->helper("str");
		
		$data = array();
		$items = array();
		$propertyItems = array();
		$singleItems = array();
		$table = "tbl_property"; 
		$newID = guid();
			
		$fields = $this->db->list_fields($table);
								
								
		foreach($fields as $field){	
		
			if($field != "propertyGUID" && $field != "propertyGroup"){
				
				$data[$field] = $values[$field]	;
				
			}
			
			if($field == "propertyGUID"){
				
				if($id == NULL){
					
					$data[$field] = $newID;
					
				}else{
					
					 $data[$field] = $id;
					
				}
				
			}				
			
			if($field == "propertyGroup"){
				
				$data[$field] = $groupID;
				
			}						
														
		}
				
		if($values['propertyItem'] != ""){
			
			$propertyItems = explode(";;",substr($values['propertyItem'],2));
			
			for($i = 0 ; $i < count($propertyItems) ; $i++){
				
				if($id == NULL){
					$singleItems['itemPropertyGUID'] = $newID;		
				}else{			
					$singleItems['itemPropertyGUID'] = $id;			
				}
				$singleItems['propertyItemTitle'] = $propertyItems[$i];
				array_push($items,$singleItems);
			}	
										
		}								
		
		$this->db->trans_start();
		
		
		if($id == NULL){
			
				$this->db->insert($table, $data);
				
				if($values['propertyItem'] != ""){
					$this->db->insert_batch('tbl_property_item', $items);
				}
				parent::userLog("درج مشخصه",$values["propertyTitle"]);						
			
		}else{
			
			$this->db->where("propertyGUID",$id);
			$this->db->update($table, $data);
			
			if($values['propertyItem'] != ""){
				
				$this->db->flush_cache();
				$this->db->where("itemPropertyGUID",$id);
				$this->db->delete('tbl_property_item');
				$this->db->insert_batch('tbl_property_item', $items);			
				
			}
						
			parent::userLog("ویرایش مشخصه",$values["propertyTitle"]);							
					
		}
		
		$this->db->trans_complete();												
	}

/*
|--------------------------------------------------------------------------
| Get Property Group
|--------------------------------------------------------------------------
*/
	
	function getPropertyInfo($id){
		
		$this->db->from('tbl_property');
		$this->db->join("tbl_property_group","tbl_property_group.propertyGroupID = tbl_property.propertyGroup","LEFT OUTER");			
		$this->db->join("tbl_property_item","tbl_property.propertyGUID = tbl_property_item.itemPropertyGUID","LEFT OUTER");			
		$this->db->where("propertyGUID",$id);	
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;	
			
	}

/*
|--------------------------------------------------------------------------
| Delete Property Group
|--------------------------------------------------------------------------
*/
	
	function deletePropertyGroup($id){
		
		$this->db->select("propertyGroup");
		$this->db->from('tbl_property');	
		$this->db->where("propertyGroup",$id);	
		$this->db->limit('1');
		$query = $this->db->get();
		
		if($query->num_rows() == 0){
			
			$this->db->from('tbl_property_group');			
			$this->db->where("propertyGroupID",$id);
			$this->db->delete();
			return "گروه مشخصه مورد نظر حذف گردید";
			
		}else{
			
			return "این گروه دارای زیر گروه می باشد و شما نمی توانید آنرا حذف نمایید";
		}
			
	}

/*
|--------------------------------------------------------------------------
| Delete Property
|--------------------------------------------------------------------------
*/
	
	function deleteProperty($id){
		
		$this->db->from('tbl_property');			
		$this->db->where("propertyGUID",$id);
		$this->db->delete();	
			
	}

/*
|--------------------------------------------------------------------------
| Get Modules Property Group
|--------------------------------------------------------------------------
*/
	
	function getModulePropList($moduleID){
		
		$this->db->from('tbl_property_group');
		$this->db->where("propertyGroupModule",$moduleID);	
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;				
	}
	
/*
|--------------------------------------------------------------------------
| Get Resourcese Property Group
|--------------------------------------------------------------------------
*/
	
	function getSrcPropList($srcGUID){
		
		$this->db->select('propertyID');
		$this->db->from('tbl_item_property_group');
		$this->db->where("itemGUID",$srcGUID);	
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;	
					
	}
	
/*
|--------------------------------------------------------------------------
| Get Resourcese Property Group And Feilds
|--------------------------------------------------------------------------
*/
	
	function getSrcProperties ($srcGUID){
		
		$itemsValue = array();
		$itemFlag = "FALSE";
		$condition = "";
		$counter = 0;
		$itemResult = "";
		
		$this->db->select("propertyTitle,propertyGroupTitle,propertyType,propertyGUID");
		$this->db->from('tbl_item_property_group');
		$this->db->join('tbl_property_group','tbl_property_group.propertyGroupID = tbl_item_property_group.propertyID','LEFT OUTER');
		$this->db->join('tbl_property','tbl_property.propertyGroup = tbl_item_property_group.propertyID','LEFT OUTER');
		$this->db->order_by('propertyGroupTitle','ACS');
		$this->db->where("tbl_item_property_group.itemGUID",$srcGUID);
		$query = $this->db->get();
		$result = $query->result_array();
						
		$this->db->select("valueContent,valuePropertyID,valuePropertyID");
		$this->db->from("tbl_property_value");
		$this->db->where("valueSrcGUID",$srcGUID);
		$valuesQuery = $this->db->get();
		
		
		if(count($result) > 0){
			
		
			foreach($result as $row){
				
				if($row['propertyType'] == "3" || $row['propertyType'] == "4"){
					
					if($counter == 0){
						
						$condition .= " itemPropertyGUID = '".$row['propertyGUID']."'";
						
					}else{
						
						$condition .= " OR itemPropertyGUID = '".$row['propertyGUID']."'";
						
					}
						
					$itemFlag = "TRUE";	
					$counter++;	
					
				}
				

				
			}
			
			if($itemFlag == "TRUE"){
				
				$query = $this->db->query("SELECT * FROM tbl_property_item WHERE ".$condition."");
				$itemResult = $query->result_array();
				
			}
			
			
			return $finalResult = array($result,$itemResult,$valuesQuery->result_array());
			
		}else{
			
			return "FALSE";
			
		}	
							
	}

/*
|--------------------------------------------------------------------------
|  Property Value Action Method
|--------------------------------------------------------------------------
*/
	
	function propertyValueAction($values,$id){
		
		$this->load->helper("str");
		$keys = array_keys($values);
		$data = array();
		$packID = guid();
		
		for($i = 0 ; $i < count($keys)-1 ; $i++){
						
			if(is_array($values[$keys[$i]])){
				
				for($j = 0; $j < count($values[$keys[$i]]); $j++){
					
					$valueContent .= $values[$keys[$i]][$j].";;";
					
				}				
				
			}else{
				
				$valueContent = $values[$keys[$i]];
				
			}
			
			$singleData['valuePropertyID'] = $keys[$i];
			$singleData['valueContent'] = $valueContent;
			$singleData['valueSrcGUID'] = $id;
			$singleData['valuePackDataGUID'] = $packID;
			
			if($valueContent != NULL){
				
				array_push($data,$singleData);
				$valueContent = "";
				
			}
			
		}								
		
		$this->db->trans_start();	
		$this->db->where("valueSrcGUID",$id);
		$this->db->delete('tbl_property_value');
		$this->db->insert_batch('tbl_property_value', $data);
		$this->db->trans_complete();
	
	}

/*
|--------------------------------------------------------------------------
| Get Pages Form Data
|--------------------------------------------------------------------------
*/
	
	function getFormData($id){			
								
		$this->db->select('formGroupID,valuePackDataGUID,valueContent,valuePropertyID,propertyTitle');
		$this->db->from('tbl_page_form');
		$this->db->join('tbl_property_value','tbl_page_form.formResourceID = tbl_property_value.valueSrcGUID',"LEFT OUTER");
		$this->db->join('tbl_property','tbl_property.propertyGUID = tbl_property_value.valuePropertyID',"LEFT OUTER");
		$this->db->where("formResourceID",$id);	
		$this->db->order_by("valuePackDataGUID","ASC");
		$query = $this->db->get();
		$result = $query->result_array();
		
		if($query->num_rows() > 0){
			return $result;
		}
	
	}

/*
|--------------------------------------------------------------------------
| Get Form Fields
|--------------------------------------------------------------------------
*/
	
	function getFormFields($id){		
								
		$this->db->select('propertyTitle,propertyGUID');
		$this->db->from('tbl_property');
		$this->db->where("propertyGroup",$id);	
		$this->db->where("propertyStatus","1");	
		$this->db->order_by("propertyGUID","ASC");
		$query = $this->db->get();
		return $query->result_array();
	
	}

/*
|--------------------------------------------------------------------------
| Delete Form Data
|--------------------------------------------------------------------------
*/
	
	function deleteFormData($id){
		
		$this->db->from('tbl_property_value');			
		$this->db->where("valuePackDataGUID",$id);
		$this->db->delete();	
			
	}

/*
|--------------------------------------------------------------------------
| Get Form Page Feilds
|--------------------------------------------------------------------------
*/
	
	function getPageForm ($srcGUID){
		
		$itemsValue = array();
		$itemFlag = "FALSE";
		$condition = "";
		$counter = 0;
		$itemResult = "";
		
		$this->db->from('tbl_property');
		$this->db->order_by('propertyTitle','ACS');
		$this->db->where("propertyGroup",$srcGUID);
		$query = $this->db->get();
		$result = $query->result_array();
		
		if(count($result) > 0){
		
			foreach($result as $row){
				
				if($row['propertyType'] == "3" || $row['propertyType'] == "4"){
					
					if($counter == 0){
						
						$condition .= " itemPropertyGUID = '".$row['propertyGUID']."'";
						
					}else{
						
						$condition .= " OR itemPropertyGUID = '".$row['propertyGUID']."'";
						
					}
						
					$itemFlag = "TRUE";	
					$counter++;	
					
				}
				
			}
			
			if($itemFlag == "TRUE"){
				
				$query = $this->db->query("SELECT * FROM tbl_property_item WHERE ".$condition."");
				$itemResult = $query->result_array();
				
			}
			
			return $finalResult = array($result,$itemResult);
			
		}else{
			
			return "FALSE";
			
		}	
							
	}

/*
|--------------------------------------------------------------------------
|  User Group Data Action
|--------------------------------------------------------------------------
*/
	
	function pageViewFormReg($values,$pageTitle){
		
		$this->load->helper("str");
		$keys = array_keys($values);
		$data = array();
		$packID = guid();
		$emailContent = NULL;
		
		$this->db->select('formEmail,formRegType,id');
		$this->db->from('tbl_category');
		$this->db->join('tbl_page_form','tbl_page_form.formResourceID = tbl_category.id ',"LEFT OUTER");
		$this->db->where("title",$pageTitle);	
		$query = $this->db->get();
		$result = $query->result_array();
				
		for($i = 0 ; $i < count($keys)-3 ; $i++){
									
			if(is_array($values[$keys[$i]])){
				
				for($j = 0; $j < count($values[$keys[$i]]); $j++){
					
					$valueContent .= $values[$keys[$i]][$j].";;";
					
				}				
				
			}else{
				
				$valueContent = $values[$keys[$i]];
				
			}
			
			$singleData['valuePropertyID'] = $keys[$i];
			$singleData['valueContent'] = $valueContent;
			$singleData['valueSrcGUID'] = $result[0]['id'];
			$singleData['valuePackDataGUID'] = $packID;
			
			if($valueContent != NULL){
				
				array_push($data,$singleData);
				$valueContent = "";
				
			}
			
		}	
		
		if($result[0]['formRegType'] == "0" || $result[0]['formRegType'] == "1"){
			
			$fieldsName = array_values(array_filter(array_unique(explode(";;",$values['fieldsName']))));
			
			for($i = 0 ; $i < count($fieldsName) ; $i++){
				
				$emailContent .= "<tr>
								    <td class=\"field\">".$fieldsName[$i]."</td>
								    <td class=\"value\">".$data[$i]['valueContent']."</td>
								  </tr>";
				
			}
			
			$this->load->model("Message_class");
			$this->Message_class->pageViewFormDate($emailContent,$result[0]['formEmail'],$pageTitle);
			
		}
		
		if($result[0]['formRegType'] == "1" || $result[0]['formRegType'] == "2"){					
		
			$this->db->trans_start();	
			$this->db->where("valueSrcGUID",$result[0]['id']);
			$this->db->delete('tbl_property_value');
			$this->db->insert_batch('tbl_property_value', $data);
			$this->db->trans_complete();
			
		}
	
	}
}
?>