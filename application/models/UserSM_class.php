<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserSM_class
 *
 * @author lenovo
 */
class UserSM_class extends MY_Model {


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
| Get UserSM Data ---------------------------------------------------------
|--------------------------------------------------------------------------
*/

    function getUserSMData($id) {

        $this->table = "tbl_user_sm";
        $this->selectConditions = array("where"=>"userGUID = '".$id."'",
                                  "resultType"=>"1");
        return $this->getData();

    }

/*
|--------------------------------------------------------------------------
| Get UserSM List ---------------------------------------------------------
|--------------------------------------------------------------------------
*/

    function getAllUserSMList($limit, $segments, $page, $url) {

        $query = "SELECT * FROM tbl_user_sm ORDER BY created_at DESC";
        return $this->paginate($limit,$segments,$page,$query,$url,"panel");

    }

/*
|--------------------------------------------------------------------------
|  .:Job Action Data ------------------------------------------------------
|--------------------------------------------------------------------------
*/
	
	function siteUserSMAction($values,$id = NULL,$lastTitle = NULL){
   
		unset($values['submit']);
		if($id == NULL){
            $this->load->helper("str");
            $values['userGUID'] = guid();
            $values['userPassword'] = passwordEncode("123456");
            $values['userStatus'] = "d";
			$this->table = "tbl_user_sm";
			$this->insert($values,$values['userName']);		
		}else{		
			$this->table = "tbl_user_sm";
			$this->primeryKey = "userGUID";
			$this->update($values,$id,$lastTitle);								
		}
		return true;
												
    }
    
/*
|--------------------------------------------------------------------------
| .:Change Password -------------------------------------------------------
|--------------------------------------------------------------------------
*/
	
    function changePass($password,$retry,$id = NULL,$name = NULL){
        $this->load->helper('security');
        $this->load->helper('str');
        $data = array("userPassword" => passwordEncode($password));
        $this->table = "tbl_user_sm";
        $this->primeryKey = "userGUID";
        $this->update($data,$id);
        $this->setCostumUserLog(" تغییر رمز ورود ".$name);	
    }	


/*
|--------------------------------------------------------------------------
| .:Delete UserSM ---------------------------------------------------------
|--------------------------------------------------------------------------
*/
		
	function deleteUserSM($id,$title){

		$this->table = "tbl_user_sm";
		$this->primeryKey = "userGUID";
		$this->delete($id,str_replace("-"," ",$title));	
					
    }

/*
|--------------------------------------------------------------------------
| .:Get Location Ajax -----------------------------------------------------
|--------------------------------------------------------------------------
*/
	
    function getLocation($parent = 0)
    {

        $this->table = "tbl_location";
        $this->selectConditions = array("where"=>"parentID = '".$parent."'");
        return $this->getData();

    }

/*
|--------------------------------------------------------------------------
|  .:Signup User ----------------------------------------------------------
|--------------------------------------------------------------------------
*/
	
    function signup($values)
    {
        unset($values['signup']);
        unset($values['state']);
        unset($values['passwordRetry']);
        $this->load->helper("str");
        $userAddr['addressUserGUID'] = $values['userGUID'] = guid();
        $userAddr['address'] = $values['userAddress'];
        unset($values['userAddress']);
        $userAddr['addressGUID'] = guid();
        $values['userAccount'] = 0;
        $values['userPassword'] = passwordEncode($values['userPassword']);
        $values['userStatus'] = "e";

        $this->db->trans_start();
        $this->table = "tbl_user_sm";
        $this->insert($values);	
        $this->table = "tbl_user_sm_address";
        $this->createdAt = false;
        $this->insert($userAddr);	
        $this->db->trans_complete();		

        $this->table = "tbl_user_sm";
		$this->selectConditions = array("where"=>"userGUID = '".$values['userGUID']."'","join"=>array(array("table"=>"tbl_location","joinCondition"=>"tbl_user_sm.userLocation = tbl_location.id","joinType"=>"INNER"),array("table"=>"tbl_user_sm_address","joinCondition"=>"tbl_user_sm.userGUID = tbl_user_sm_address.addressUserGUID","joinType"=>"INNER")),"resultType"=>"1");			
		$result = $this->getData();
        $userData = array(
                            'userGUID'			=>		$result['userGUID'],
                            'userEmail'			=>		$result['userEmail'],
                            'userStatus'		=>		$result['userStatus'],
                            'userName'			=>		$result['userName'],
                            'userAccount' 		=>		$result['userAccount'] ,
                            'userLocationDel' 	=>		$result['locDelFee'],
                            'userLocation' 		=>		$result['userLocation'],
                            'userLocationTitle' =>		$result['title'],
                            'userMobileNo' 		=>		$result['userMobileNo'],
                            'userAddress' 		=>		$result['address']
                            );           		 
        $this->session->set_userdata($userData);
    }

/*
|--------------------------------------------------------------------------
| .:Get User Address  -----------------------------------------------------
|--------------------------------------------------------------------------
*/
	
    function getUserAddress()
    {
        $this->table = "tbl_user_sm_address";
        $this->selectConditions = array("where"=>"addressUserGUID = '".$this->session->userdata['userGUID']."'");
        return $this->getData();
    }

/*
|--------------------------------------------------------------------------
| Add User Address --------------------------------------------------------
|--------------------------------------------------------------------------
*/
        
    function addAddress($address)
    {
        $this->load->helper("str");
        $userAddr['addressUserGUID'] = $this->session->userdata['userGUID'];
        $userAddr['addressGUID'] = guid();
        $userAddr['address'] = $address;
        $this->table = "tbl_user_sm_address";
        $this->createdAt = false;
        $this->insert($userAddr);	
    }

/*
|--------------------------------------------------------------------------
| User Login
|--------------------------------------------------------------------------
*/
	
    function login($values)
    {	
        $this->load->helper('security');
        $this->load->helper('str');
        $finalResult = "FALSE";

        $this->table = "tbl_user_sm";
        $this->selectConditions = array("where"=>"(userMobileNo = '".$values['loginUserName']."' OR userEmail = '".$values['loginUserName']."') AND userPassword = '".passwordEncode($values['password'])."'",
                                        "join"=>array(array("table"=>"tbl_location","joinCondition"=>"tbl_user_sm.userLocation = tbl_location.id","joinType"=>"INNER"),
                                                      array("table"=>"tbl_user_sm_address","joinCondition"=>"tbl_user_sm.userGUID = tbl_user_sm_address.addressUserGUID","joinType"=>"INNER")),
                                                      "resultType"=>"1");			
        $result = $this->getData();
        
        if(count($result) > 0){
            $userData = array(
                'userGUID'			=>		$result['userGUID'],
                'userEmail'			=>		$result['userEmail'],
                'userStatus'		=>		$result['userStatus'],
                'userName'			=>		$result['userName'],
                'userAccount' 		=>		$result['userAccount'] ,
                'userLocationDel' 	=>		$result['locDelFee'],
                'userLocation' 		=>		$result['userLocation'],
                'userLocationTitle' =>		$result['title'],
                'userMobileNo' 		=>		$result['userPhoneNo'],
                'userAddress' 		=>		$result['userAddress']
                );           		 
            $this->session->set_userdata($userData);
            $finalResult = "TRUE";
        }        
        return $finalResult;
        
    }
       
}
