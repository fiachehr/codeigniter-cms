<?php
class Board_class extends MY_Model{
	
/*
|--------------------------------------------------------------------------
| .:Class Constractor:.
|--------------------------------------------------------------------------
*/
	
	function __construct(){	
		parent::__construct();
    }
    
/*
|--------------------------------------------------------------------------
| Get Board List ---------------------------------------------------------
|--------------------------------------------------------------------------
*/

    function getBoardList($limit, $segments, $page, $url) {

        $query = "SELECT * FROM tbl_board WHERE boardLanguage = '".$this->session->userdata('panelLanguage')."' ORDER BY created_at DESC ";
        return $this->paginate($limit,$segments,$page,$query,$url,"panel");

    }


/*
|--------------------------------------------------------------------------
|  .:Admin Board Data Action:.
|--------------------------------------------------------------------------
*/
	
	function boardAction($values,$id = null,$lastTitle = null){

		$this->load->helper("str");
		$schedule = false;
		if($id == null){
			$values['boardGUID'] = guid();
		}else{
			$values['boardGUID'] = $id;
        }
        $values['boardLanguage'] = $this->session->userdata("panelLanguage");
		unset($values['submit']);
		if($values['scheduleStart'] != ""){
			$this->load->helper('pdate');
			$scheduleData['scheduleModuleID'] = 104;
			$scheduleData['scheduleSrcID'] = $values['boardGUID'];
			$scheduleData['scheduleStart'] = jalToGre($values['scheduleStart']);
			$scheduleData['scheduleEnd'] = jalToGre($values['scheduleEnd']);
			$schedule = true;
		}
		unset($values['scheduleEnd']);
		unset($values['scheduleStart']);

		if($id == null){
            $this->db->trans_start();
            if($values['boardStatus'] == "a"){
                $data['boardStatus'] = "d";
                $this->table = "tbl_board";
                $this->primeryKey = "boardStatus";
                $this->update($data,"a");
            }
			$this->table = "tbl_board";
			$this->insert($values,$values['boardTitle']);
			if($schedule == true){
				$this->table = "tbl_schedule";
				$this->createdAt = false;
				$this->insert($scheduleData);
            }
			$this->db->trans_complete();
			return true;
		}else{
            $this->db->trans_start();
            if($values['boardStatus'] == "a"){
                $data['boardStatus'] = "d";
                $this->table = "tbl_board";
                $this->primeryKey = "boardStatus";
                $this->update($data,"a");
            }
			$this->table = "tbl_board";
			$this->primeryKey = "boardGUID";
			$this->update($values,$id,$lastTitle);
			$this->db->flush_cache();
			$this->table = "tbl_schedule";
			$this->primeryKey = "scheduleSrcID";
			$this->delete($id);		
			if($schedule == true){
				$this->table = "tbl_schedule";
				$this->createdAt = false;
				$this->insert($scheduleData);
			}
			$this->db->trans_complete();	
			return true;

		}
	}

/*
|--------------------------------------------------------------------------
| .:Get Board Information:.
|--------------------------------------------------------------------------
*/
	
	function getBoardInfo($id){

		$this->table = "tbl_board";
		$this->selectConditions = array(
			"join"=>array(	array("table"=>"tbl_schedule","joinCondition"=>"tbl_schedule.scheduleSrcID = tbl_board.boardGUID","joinType"=>"LEFT OUTER")),
			"where"=>"boardGUID = '".$id."'",
			"resultType"=>"1"
		);				
		return $this->getData();
			
	}


/*
|--------------------------------------------------------------------------
| Delete Board  -----------------------------------------------------------
|--------------------------------------------------------------------------
*/

    function deleteBoard($id,$title){	
                
        $this->table = "tbl_board";
        $this->selectConditions = array("select"=>"boardImg","where"=>"boardGUID = '".$id."'","resultType" => "1");
        $result = $this->getData();
        unlink(BOARD.$result['boardImg']);
        $this->table = "tbl_board";
        $this->primeryKey = "boardGUID";
        $this->delete($id);			
        
    }

/*
|-------------------------------------------------------------------------
|  Get Board -------------------------------------------------------------
|-------------------------------------------------------------------------
*/
	
    function getBoard(){
                        
        $this->table = "tbl_board";
        $this->selectConditions = array("select"=>"boardTitle,boardImg","where"=>"(tbl_board.boardStatus = 'a' 
                                                AND tbl_schedule.scheduleModuleID = '104' 
                                                AND tbl_schedule.scheduleStart < '".date("Y-m-d H:i:s")."'
                                                AND tbl_schedule.scheduleEnd > '".date("Y-m-d H:i:s")."'
                                                )
                                                OR ( tbl_board.boardStatus = 'a' AND tbl_schedule.scheduleEnd IS NULL)",
                                        "join"=>array(
                                                    array("table"=>"tbl_schedule",
                                                        "joinCondition"=>"tbl_schedule.scheduleSrcID = tbl_board.boardGUID",
                                                        "joinType"=>"LEFT OUTER"
                                                        ),
                                                ),
                                        "resultType" => "1"
                                        );				
        
        return $this->getData();

    }

}
