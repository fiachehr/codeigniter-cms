<?php
class Link extends CI_Controller
{

    private $adminMenu;
	private $language;
/*
|--------------------------------------------------------------------------
| Class Constractor -------------------------------------------------------
|--------------------------------------------------------------------------
*/

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Link_class");
        $this->load->model("Acms_class"); 
        $this->load->helper("tree");     
		$result = createModuleArray($this->Acms_class->getModules());
		$this->adminMenu = createAdminMenu($result,0);	
		$this->language = $this->Acms_class->siteLanguage();
    
    }

		

/*
|--------------------------------------------------------------------------
| Insert Admin Link -----------------------------------------------------
|--------------------------------------------------------------------------
*/	

    public function	insertLink(){

        // Check Permission
        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }
        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;
        if($this->input->post("submit") == "submit"){	
            $this->form_validation->run('link');	
            if($this->form_validation->run() == FALSE){
                $data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);				
            }else{
                if($this->Acms_class->checkAccess($data['permission'])){
                    $insert = $this->Link_class->linkAction($this->input->post());
                    $data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_INSERT_SUCCESS,"url"=>base_url()."Link/linkList");
                }else{
                    $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Link/linkList");
                }	
            }
        }
        $data['pageTitle'] = "درج لینک سایت";				
        $data['mainContent'] = 'link/insertLink';
        $this->load->view("layouts/panel/forms",$data);	
    }

/*
|--------------------------------------------------------------------------
| Edit Admin Link -------------------------------------------------------
|--------------------------------------------------------------------------
*/	

    public function	editLink($id){

        // Check Permission
        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "2" || $data['permission'] == "1" || $data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }
        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;
        
        $data['link'] = $this->Link_class->getLinkData($id);

        if($this->input->post("submit") == "submit"){
            $this->form_validation->run('link');		
            if($this->form_validation->run() == FALSE){
                $data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);					
            }else{
                if($this->Acms_class->checkAccess($data['permission'])){
                    $update = $this->Link_class->linkAction($this->input->post(),$id,$data['link']['linkTitle']);
                    if($update == true){
                        $data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_UPDATE_SUCCESS,"url"=>base_url()."Link/linkList");
                    }		
                }else{
                    $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Link/linkList");
                }		
            }				
        }		
                                
        $data['pageTitle'] = "ویرایش | ".$data['link']['linkTitle'];			
        $data['mainContent'] = 'link/editLink';
        $this->load->view("layouts/panel/forms",$data);			
    }


/*
|--------------------------------------------------------------------------
| .: Links List ------------------------------------------------------
|--------------------------------------------------------------------------
*/	

    public function	linkList($page=0){

        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;
        // Check Permission
        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }

        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;
        $data['count'] = $page + 1;	
        $data['links'] = $this->Link_class->getAllLinkList(25,3,$page,base_url()."Link/linkList");
        $data['pageTitle'] = "لیست لینکها ";			
        $data['mainContent'] = 'link/linkList';
        $this->load->view("layouts/panel/lists",$data);
        
    }


/*
|--------------------------------------------------------------------------
| .:Delete Link Ajax:. 
|--------------------------------------------------------------------------
*/	

	public function	deleteLinkAjax(){

		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if($permission == "a" || $permission == "3"){
			$result = $this->Link_class->deleteLink($this->input->get("id"),urldecode($this->input->get("title")));
			echo "1";
		}else{
			echo "0";		
		}
	}

	/*
	|--------------------------------------------------------------------------
	| .:Delete Dynamic Tag :. 
	|--------------------------------------------------------------------------
	*/	

	public function	deleteLink($id,$title){

		$permission = $this->Acms_class->checkPermission(__FUNCTION__);

		if($permission == "a" || $permission == "3"){
			$result = $this->Link_class->deleteLink($id,urldecode($title));
			echo "<script>alert('اطلاعات مورد نظر حذف گردید')</script>";	
		}else{
			echo "<script>alert('شما مجوز حذف اطلاعات را ندارید')</script>";		
		}
		redirect(base_url()."link/linkList","refresh");				
    }


}
