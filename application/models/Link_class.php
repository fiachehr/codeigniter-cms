<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Link_class
 *
 * @author lenovo
 */
class Link_class extends MY_Model {


/*
|--------------------------------------------------------------------------
| Class Constractor -------------------------------------------------------
|--------------------------------------------------------------------------
*/

    function __construct() {

        parent::__construct();
    }

/*
|--------------------------------------------------------------------------
| Get Link Data ---------------------------------------------------------
|--------------------------------------------------------------------------
*/

    function getLinkData($id) {

        $this->table = "tbl_link";
        $this->selectConditions = array("where"=>"linkID = '".$id."'",
                                  "resultType"=>"1");
        return $this->getData();

    }

/*
|--------------------------------------------------------------------------
| Get Link List ---------------------------------------------------------
|--------------------------------------------------------------------------
*/

    function getAllLinkList($limit, $segments, $page, $url) {

        $query = "SELECT * FROM tbl_link WHERE linkLanguage = '".$this->session->userdata('panelLanguage')."' ORDER BY created_at DESC ";
        return $this->paginate($limit,$segments,$page,$query,$url,"panel");

    }

/*
|--------------------------------------------------------------------------
|  .:Link Action Data ------------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function linkAction($values,$id = NULL,$lastTitle = NULL){
   
        unset($values['submit']);
        $values['linkLanguage'] = $this->session->userdata("panelLanguage");	
		if($id == NULL){
			$this->table = "tbl_link";
			$this->insert($values,$values['linkTitle']);		
		}else{		
			$this->table = "tbl_link";
			$this->primeryKey = "linkID";
			$this->update($values,$id,$lastTitle);								
		}
		return true;
    }

/*
|--------------------------------------------------------------------------
| .:Delete Link ---------------------------------------------------------
|--------------------------------------------------------------------------
*/
		
	function deleteLink($id,$title){
		$this->table = "tbl_link";
		$this->primeryKey = "linkID";
		$this->delete($id,str_replace("-"," ",$title));	
    }

/*
|--------------------------------------------------------------------------
| Get Link List ---------------------------------------------------------
|--------------------------------------------------------------------------
*/

    function getLinkList($position) {
        $this->table = "tbl_link";
        $this->selectConditions = array("where"=>"linkPosition = '".$position."' AND linkStatus = 'a'");
        return $this->getData();
    }

}
