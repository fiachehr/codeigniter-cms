<?php
class Board extends CI_Controller{

	private $adminMenu;
	private $language;
	
/*
|--------------------------------------------------------------------------
| Class Constractor
|--------------------------------------------------------------------------
*/
	
	function __construct(){
		
		parent::__construct();
        $this->load->model("Board_class");	
        $this->load->model("Acms_class");	
		$this->load->helper("tree");
		$result = createModuleArray($this->Acms_class->getModules());
		$this->adminMenu = createAdminMenu($result,0);	
		$this->language = $this->Acms_class->siteLanguage();
	
	}


/*
|--------------------------------------------------------------------------
| .: Boards List:.
|--------------------------------------------------------------------------
*/	

	public function	boardList($page=0){

		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Board/desktop");
		}

		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		$data['count'] = $page + 1;	
		$data['boards'] = $this->Board_class->getBoardList(25,3,$page,base_url()."Board/boardList");
		$data['pageTitle'] = "لیست تابلو اعلانات";			
		$data['mainContent'] = 'board/boardList';
		$this->load->view("layouts/panel/lists",$data);
		
	}

/*
|--------------------------------------------------------------------------
| Insert  Board 
|--------------------------------------------------------------------------
*/	
	
	public function	insertBoard(){

		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Board/desktop");
		}

		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		$_POST['boardImg']  = null;
		$boardImage = NULL;
		$dateFlag = true;
		$fileFlag = true;
		
		if($this->input->post("submit") == "submit"){	

			$this->form_validation->run('board');	
			if($this->form_validation->run() == FALSE){
				$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);				
			}else{
				if($this->input->post("scheduleStart") != '' || $this->input->post("scheduleEnd") != ''){
					$this->load->helper("pdate");
					if(!compare2Date(jalToGre($this->input->post("scheduleStart")),jalToGre($this->input->post("scheduleEnd")))){
						$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATE_ERROR,"url"=>null);
						$dateFlag = false;
					}					
				}

				if ($_FILES['boardImg']['name'] != null && $dateFlag == true) {
					$this->load->helper("uploadfile");
					$uploadConfig = array('file' => 'boardImg', 'path' => BOARD, 'type' => 'jpg|png|gif', 'maxSize' => 1000);
					$upload = fileUpload($uploadConfig);
					if($upload['filename'] == null){
						$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>$upload['error'],"url"=>null);
						$fileFlag = false;
					}else{
						$_POST['boardImg'] = $upload['filename'];
					}				
				}  

				if($dateFlag == true && $fileFlag == true){
					if($this->Acms_class->checkAccess($data['permission'])){
						$insert = $this->Board_class->boardAction($this->input->post());
						if($insert == true){
							$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_INSERT_SUCCESS,"url"=>base_url()."Board/boardList");
						}	
					}else{
						$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Board/boardList");
					}	
				}
				
			}

		}
								
		$data['pageTitle'] = "درج تابلوی اعلانات";				
		$data['mainContent'] = 'board/insertBoard';
		$this->load->view("layouts/panel/forms",$data);	
	}

/*
|--------------------------------------------------------------------------
| Edit  Board 
|--------------------------------------------------------------------------
*/	
	
	public function	editBoard($id){

		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if($data['permission'] == "2" || $data['permission'] == "1" || $data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Board/desktop");
		}

		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;

		$avatar = NULL;
		$dateFlag = true;
		$fileFlag = true;
		
		$data['board'] = $this->Board_class->getboardInfo($id);			
		$_POST['boardImg']  = $data['board']['boardImg'];	

		if($this->input->post("submit") == "submit"){
            $this->form_validation->run('board');
		
			if($this->form_validation->run() == FALSE){
				$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);				
			}else{
				
				if($this->input->post("scheduleStart") != '' || $this->input->post("scheduleEnd") != ''){
					$this->load->helper("pdate");
					if(!compare2Date(jalToGre($this->input->post("scheduleStart")),jalToGre($this->input->post("scheduleEnd")))){
						$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATE_ERROR,"url"=>null);
						$dateFlag = false;
					}					
				}

				if ($_FILES['boardImg']['name'] != null && $dateFlag == true) {
					$this->load->helper("uploadfile");
					$uploadConfig = array('file' => 'boardImg', 'path' => BOARD, 'type' => 'jpg|png|gif', 'maxSize' => 1000);
					$upload = fileUpload($uploadConfig);
					if($upload['filename'] == null){
						$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>$upload['error'],"url"=>null);
						$fileFlag = false;
					}else{
						unlink(BOARD.$data['board']['boardImg']);
						$_POST['boardImg'] = $upload['filename'];
					}				
				}  

				if($dateFlag == true && $fileFlag == true){
					if($this->Acms_class->checkAccess($data['permission'])){
						$update = $this->Board_class->boardAction($this->input->post(),$id,$data['board']['boardTitle']);
						if($update == true){
							$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_UPDATE_SUCCESS,"url"=>base_url()."Board/boardList");
						}		
					}else{
						$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Board/boardList");
					}
				}			
			}				
		}		
								
		$data['pageTitle'] = "ویرایش | ".$data['board']['boardTitle'];			
		$data['mainContent'] = 'board/editBoard';
		$this->load->view("layouts/panel/forms",$data);			
	}

/*
|--------------------------------------------------------------------------
| .:Delete Board :. 
|--------------------------------------------------------------------------
*/	

	public function	deleteBoard($id,$title){

		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if($permission == "a" || $permission == "3"){
			$result = $this->Board_class->deleteBoard($id,urldecode($title));
			echo "<script>
					alert('اطلاعات مورد نظر حذف گردید');
					window.location = '".base_url()."Board/boardList'
				  </script>";
		}else{
			echo "<script>
					alert('شما مجوز حذف اطلاعات را ندارید');
					window.location = '".base_url()."Board/boardList'
				  </script>";		
		}
		
    }
    
    /*
|--------------------------------------------------------------------------
| Delete Board Ajax--------------------------------------------------------- 
|--------------------------------------------------------------------------
*/	

	public function	deleteBoardAjax(){

		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if($permission == "a" || $permission == "3"){
			$result = $this->Board_class->deleteBoard($this->input->get("id"),urldecode($this->input->get("title")));
			echo "1";
		}else{
			echo "0";		
		}
	}

}
