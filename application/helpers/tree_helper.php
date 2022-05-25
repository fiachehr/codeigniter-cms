<?php

/*
|--------------------------------------------------------------------------
| Create Array
|--------------------------------------------------------------------------
*/
	
	function createArray($result){
		
		$data = array();
		$index = array();

		if(count($result) > 0){

			foreach($result as $row){
			
				$id = $row['id'];
				$parentID= $row['parentID'] === NULL ? "NULL" : $row['parentID'];
				$data[$id] = (array)$row;
				$index[$parentID][] = $id;
				
			}		
			
			$result = array($data,$index);			
			return $result[0];	

		}else{
			return null;
		}
		
	
		
	}

/*
|--------------------------------------------------------------------------
| Create Array
|--------------------------------------------------------------------------
*/
	
function createIndexArray($result){	
	$data = array();
	$index = array();

	if(count($result) > 0){
		foreach($result as $row){
		
			$id = $row['id'];
			$parentID= $row['parentID'] === NULL ? "NULL" : $row['parentID'];
			$data[$id] = (array)$row;
			$index[$parentID][] = $id;		
		}		
		$result = array($data,$index);			
		return $result[1];	

	}else{
		return null;
	}	
}

/*
|--------------------------------------------------------------------------
| Create Admin Modules Array
|--------------------------------------------------------------------------
*/
	
function createModuleArray($result){

	$data = array();
	$index = array();	
	foreach($result as $row){
		$row['moduleParentID'];	
		$id = $row['moduleID'];
		$moduleParentID= $row['moduleParentID'] === NULL ? "NULL" : $row['moduleParentID'];
		$data[$id] = (array)$row;
		$index[$moduleParentID][] = $id;	
	}			
	$result = array($data,$index);			
	return $result[0];		
	
}

/*
|--------------------------------------------------------------------------
| Create Admin Menu
| $result = createArray();
| Sample : $data['tree'] = createMenubar($result[0],0); 
|--------------------------------------------------------------------------
*/
	
function createAdminMenu($array, $currentParent, $currLevel = 0, $prevLevel = -1, $tree = "",$topLevel = TRUE) {
		
	foreach ($array as $moduleId => $module) {
		
		if($currentParent == $module['moduleParentID']){     
					  
			if($currLevel > $prevLevel){
				
				if($topLevel == TRUE){
					
					$tree .= "<ul class=\"sidebar-menu\" data-widget=\"tree\"><li class=\"header\">منو</li>";
					
				}else{
					
					$tree .= "<ul class=\"treeview-menu\">";
					
				}			    				    	
									 
			}

			if($currLevel == $prevLevel){			    	
				$tree .= "</li>";			    	 
			}

			if($module['moduleParentID'] == 0){

				$tree .= "<li class=\"treeview\"><a href=\"".base_url().$module['moduleAdminPage']."\"><i class=\"fa ".$module['moduleIcon']."\"></i><span>".$module['moduleTitle']."</span><span class=\"pull-left-container\"><i class=\"fa fa-angle-right pull-left\"></i> </span></a>";

			}else{

				$tree .= "<li><a href=\"".base_url().$module['moduleAdminPage']."\"><i class=\"fa ".$module['moduleIcon']."\"></i><span>".$module['moduleTitle']."</span></a>";

			}
									
			if($currLevel > $prevLevel){	    	
				$prevLevel = $currLevel; 	    	 
			}

			$currLevel++; 
			$tree = createAdminMenu ($array, $moduleId, $currLevel, $prevLevel,$tree,FALSE);
			$currLevel--;               
		}   	    	

	}

	if ($currLevel == $prevLevel){	
		
		 $tree .= "</li></ul>";
	 
	}
	 
	return $tree;

}   
/*
|--------------------------------------------------------------------------
| Create Tree
| $result = createArray();
| Sample : $data['tree'] = createTree($result[0],0); 
|--------------------------------------------------------------------------
*/
	
	function createTree($array, $currentParent,$function, $currLevel = 0, $prevLevel = -1, $tree = "") {

		if($array != null){
			foreach ($array as $categoryId => $category) {

				if($currentParent == $category['parentID']){     
							
					if($currLevel > $prevLevel){			    				    	
						$tree .= "<ul class=\"tree-close\">"; 			    	
					}

					if($currLevel == $prevLevel){			    	
						$tree .= "</li>";			    	 
					}

					$tree .= "<li data-id=\"".$category['id']."\" class=\"selected\" data-title=\"".$category['title']."\" data-action=\"".$function."\">".$category['title'];

					if($currLevel > $prevLevel){	    	
						$prevLevel = $currLevel; 	    	 
					}

					$currLevel++; 
					$tree = createTree ($array, $categoryId,$function, $currLevel, $prevLevel,$tree);
					$currLevel--;               
				}   

			}

			if ($currLevel == $prevLevel){		
				$tree .= "</li></ul>";
			
			}
			
			return $tree;
		}else{
			return null;
		}

	}   

/*
|--------------------------------------------------------------------------
| Create Menu
| $result = createArray();
| Sample : $data['tree'] = createMenubar($result[0],0); 
|--------------------------------------------------------------------------
*/
	
	function createMenubar($array, $currentParent,$function, $currLevel = 0, $prevLevel = -1, $tree = "",$topLevel = TRUE) {
			
		foreach ($array as $categoryId => $category) {
			if($currentParent == $category['parentID']){     
				if($currLevel > $prevLevel){
					if($topLevel == TRUE){
						$tree .= "<ul class=\"navigation\">";
					}else{
						$tree .= "<ul class=\"sub-navigation\">";
					}			    				    	
				}
				if($currLevel == $prevLevel){			    	
					$tree .= "</li>";			    	 
				}
				if($category['categoryType'] == "l"){
					$tree .= "<li><a href=\"http://www.".$category['linkURL']."\">".$category['title']."</a>";
				}elseif($category['categoryType'] == "a"){
					$tree .= "<li><a href=\"".base_url()."assets/uploads/attachment/".$category['linkURL']."\">".$category['title']."</a>";
				}elseif($category['categoryType'] == "c" || $category['categoryType'] == "f"){
					if($category['categoryModule'] != "25" && $category['categoryModule'] != 0){
						$tree .= "<li><a href=\"".base_url().$category['moduleUIPage']."/".$category['id']."/".$category['categoryURL']."0\"><span>".$category['title']."</span></a>";
					}elseif($category['categoryModule'] == "25" ){
						$tree .= "<li><a href=\"".base_url().$category['moduleUIPage']."/".$category['categoryURL']."\"><span>".$category['title']."<span></a>";
					}elseif($category['categoryModule'] != "25" && $category['categoryModule'] == 0){
						$tree .= "<li><a href=\"".base_url().$category['categoryURL']."\"><span>".$category['title']."<span></a>";
					}
				}
					if($currLevel > $prevLevel){	    	
					$prevLevel = $currLevel; 	    	 
				}
				$currLevel++; 
				$tree = createMenubar ($array, $categoryId,$function, $currLevel, $prevLevel,$tree,FALSE);
				$currLevel--;               
			}   	    	
		}
		if ($currLevel == $prevLevel){	
			$tree .= "</li></ul>";
		}
		return $tree;
	}   

/*
|--------------------------------------------------------------------------
| Display Child Node
| $result = createIndexArray();
| Sample : displayChildNodes($result,NULL,0);
|--------------------------------------------------------------------------
*/
	
	function displayChildNodes($result,$parentID,$level){

		$parentID = $parentID === NULL ? "NULL" : $parentID;
	    if (isset($result[$parentID])) {	    	
	    	
	        foreach ($result[$parentID] as $id) {
	            echo str_repeat("-", $level) . $result[$id]["title"] . "<br/>";
	            displayChildNodes($result,$id, $level + 1);
	        }
	    
	    }
	}

/*
|--------------------------------------------------------------------------
| Get Child Nodes
| $result = createIndexArray();
| Sample : $children = array();
|		   $this->tree_class->getChildNodes($result,5, $children); 
|		    echo implode("\n", $children)
|--------------------------------------------------------------------------
*/
function getChildNodes($result,$parentID, &$children){
	$parentID = $parentID === NULL ? "NULL" : $parentID;
	if (isset($result[$parentID])) {
		foreach ($result[$parentID] as $id) {
			$children[] = $id;
			getChildNodes($result,$id, $children);
		}
	}
}	

/*
|--------------------------------------------------------------------------
| Get Child Nodes
| | $result = createIndexArray();
| Sample : var_dump(getChildNodesArray($result,5));
|--------------------------------------------------------------------------
*/
	
function getChildNodesArray($result,$parentID){

	$children = array();
	$parentID = $parentID === NULL ? "NULL" : $parentID;
	if (isset($result[$parentID])) {
		foreach ($result[$parentID] as $id) {
			$children[] = $id;
			$children = array_merge($children, $this->getChildNodesArray($result,$id));
		}
	}
	return $children;

}

/*
|--------------------------------------------------------------------------
| Display Parent Node
| $result = createArray();
| Sample :  displayParentNodes($result,15);
|--------------------------------------------------------------------------
*/
	
	function displayParentNodes($result,$id){
		
	    $current = $result[$id];
	    $parentID = $current["parentID"] === NULL ? "NULL" : $current["parentID"];
	    $parents = array();
	    while (isset($result[$parentID])) {
	        $current = $result[$parentID];
	        $parentID = $current["parentID"] === NULL ? "NULL" : $current["parentID"];
	        $parents[] = $current["title"];
	    }
	    
	    return implode(" > ", array_reverse($parents));
    }

