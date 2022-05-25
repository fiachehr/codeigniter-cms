<?php
class UserSM extends CI_Controller
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
        $this->load->model("UserSM_class");
        $this->load->model("Acms_class"); 
        $this->load->helper("tree");     
		$result = createModuleArray($this->Acms_class->getModules());
		$this->adminMenu = createAdminMenu($result,0);	
		$this->language = $this->Acms_class->siteLanguage();
    
    }

/*
--------------------------------------------------------------------
--- Get City Ajax --------------------------------------------------
--------------------------------------------------------------------
*/

    public function getCity()
    {
        echo json_encode($this->UserSM_class->getLocation($this->input->get("locID")));	
    }		

/*
--------------------------------------------------------------------
--- Login ----------------------------------------------------------
--------------------------------------------------------------------
*/

    public function login() 
    {
        $this->load->library('cart');
        $this->load->model("Category_class");
        $this->load->helper("tree");
        $queryResult = $this->Category_class->getAllCategory();
        $result = createArray($queryResult);	
        $data['menubar'] = createMenubar($result,0,"selectMultiCat");
        $data['location'] = $this->UserSM_class->getLocation();
        $data['city'] = $this->UserSM_class->getLocation("1");
        $data['dataRegister'] = null;
        $data['dataLogin'] = null;
        $data['passwordFlag'] = true;
        $this->load->model("Link_class");
		$data['link'] = $this->Link_class->getLinkList('f');

        if ($this->input->post("signup") != "") {
            $this->form_validation->run('insertUserUI');
            if ($this->form_validation->run() == FALSE) {
                $data['dataRegister'] = "FALSE";
                $data['city'] = $this->UserSM_class->getLocation($this->input->post("state"));
            } else {		
                if ($this->input->post("userPassword", TRUE) == $this->input->post("passwordRetry", TRUE)) {
                    $this->UserSM_class->signup($this->input->post());
                    $data['dataRegister'] = "TRUE";
                } else {
                    $data['city'] = $this->UserSM_class->getLocation($this->input->post("state"));
                    $data['dataRegister'] = "FALSE";
                    $data['passwordFlag'] = FALSE;
                }
            }
        }
        if ($this->input->post("login") != "") {
            $this->form_validation->run('loginUser');
            if ($this->form_validation->run() == FALSE) {
                $data['dataLogin'] = "FALSE";
            } else {
                $result = $this->UserSM_class->login($this->input->post());	
                if($result == "TRUE"){
                    if($this->cart->total() != 0) {
                        redirect(base_url()."Shop/cartView/","Refresh");		
                    }else{
                        redirect(base_url(), "Refresh");
                    }
                }else{
                    $data['dataLogin'] = "FALSE";
                }
            }
        }
  
        $data['pageTitle'] = "ورود و ثبت نام";
        $data['pageDesc'] = "ورود و ثبت نام";
        $data['pageKeywords'] = "ورود و ثبت نام";
        $data['mainContent'] = 'userSM/login';
        $this->load->view("layouts/site/inner", $data);
    }

/*
|--------------------------------------------------------------------------
| Insert Admin UserSM -----------------------------------------------------
|--------------------------------------------------------------------------
*/	

    public function	insertUserSM(){

        // Check Permission
        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }

        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;
        
        if($this->input->post("submit") == "submit"){	

            $this->form_validation->run('insertUserSM');	
            if($this->form_validation->run() == FALSE){
                $data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);				
            }else{

                if($this->Acms_class->checkAccess($data['permission'])){
                    $insert = $this->UserSM_class->siteUserSMAction($this->input->post());
                    $data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_INSERT_SUCCESS,"url"=>base_url()."UserSM/siteUserSMList");
                }else{
                    $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."UserSM/siteUserSMList");
                }	
                
            }

        }
                                
        $data['pageTitle'] = "درج کاربر سایت";				
        $data['mainContent'] = 'userSM/insertUserSM';
        $this->load->view("layouts/panel/forms",$data);	
    }

/*
|--------------------------------------------------------------------------
| Edit Admin UserSM -------------------------------------------------------
|--------------------------------------------------------------------------
*/	

    public function	editUserSM($id){

        // Check Permission
        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "2" || $data['permission'] == "1" || $data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }
        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;
        
        $data['user'] = $this->UserSM_class->getUserSMData($id);

        if($this->input->post("submit") == "submit"){
            if($this->input->post("userEmail") == $data['user']['userEmail']){
                $this->form_validation->run('editUserSM');
            }else{
                $this->form_validation->run('insertUserSM');
            }		
            if($this->form_validation->run() == FALSE){
                
                $data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);					
                
            }else{
                
                if($this->Acms_class->checkAccess($data['permission'])){
                    $update = $this->UserSM_class->siteUserSMAction($this->input->post(),$id,$data['user']['userName']);
                    if($update == true){
                        $data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_UPDATE_SUCCESS,"url"=>base_url()."UserSM/siteUserSMList");
                    }		
                }else{
                    $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."UserSM/siteUserSMList");
                }		
            }				
        }		
                                
        $data['pageTitle'] = "ویرایش | ".$data['user']['userName'];			
        $data['mainContent'] = 'userSM/editUserSM';
        $this->load->view("layouts/panel/forms",$data);			
    }

/*
|--------------------------------------------------------------------------
| .:Change Password  ------------------------------------------------------
|--------------------------------------------------------------------------
*/	

    public function	changeUserSMPassword($id,$name){

        if($id == null || $name == null){
            redirect(base_url()."Acms/desktop","refresh");
        }
            
        // Check Permission
        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "2" || $data['permission'] == "1" || $data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }

        $data['id'] = $id;
        $data['name'] = $name;
        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;

        if($this->input->post("submit") == "submit"){
            $this->form_validation->run('changePass');	
            if($this->form_validation->run() == FALSE){
                $data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>PASS_ERROR,"url"=>null);			
            }else{
                if($data['permission'] == "3" || $data['permission'] == "a"){
                    if($this->input->post("password",TRUE) == $this->input->post("passwordRetry",TRUE)){
                        $this->UserSM_class->changePass($this->input->post("password",TRUE),$this->input->post("passwordRetry",TRUE),$id,urldecode(str_replace("-"," ",$name)));
                        $data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>CHANGE_PASS,"url"=>base_url()."UserSM/siteUserSMList");
                    }else{
                        $data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DIFF_PASS,"url"=>null);
                    }
                }else{
                    $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."UserSM/siteUserSMList");
                }

            }

        }		
        $data['pageTitle'] = "تغییر کلمه عبور | ".urldecode(str_replace("-"," ",$name));	
        $data['mainContent'] = 'userSM/changeUserSMPassword';
        $this->load->view("layouts/panel/forms",$data);	
        
    }

/*
|--------------------------------------------------------------------------
| .: Users List ------------------------------------------------------
|--------------------------------------------------------------------------
*/	

    public function	siteUserSMList($page=0){

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
        $data['users'] = $this->UserSM_class->getAllUserSMList(25,3,$page,base_url()."User/siteUserSMList");
        $data['pageTitle'] = "لیست کاربران ";			
        $data['mainContent'] = 'userSM/siteUserSMList';
        $this->load->view("layouts/panel/lists",$data);
        
    }


/*
|--------------------------------------------------------------------------
| .:Delete UserSM Ajax:. 
|--------------------------------------------------------------------------
*/	

	public function	deleteUserSMAjax(){

		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if($permission == "a" || $permission == "3"){
			$result = $this->UserSM_class->deleteUserSM($this->input->get("id"),urldecode($this->input->get("title")));
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

	public function	deleteUserSM($id,$title){

		$permission = $this->Acms_class->checkPermission(__FUNCTION__);

		if($permission == "a" || $permission == "3"){
			$result = $this->UserSM_class->deleteUserSM($id,urldecode($title));
			echo "<script>alert('اطلاعات مورد نظر حذف گردید')</script>";	
		}else{
			echo "<script>alert('شما مجوز حذف اطلاعات را ندارید')</script>";		
		}
		redirect(base_url()."UserSM/siteUserSMList","refresh");				
    }

    /*
    |--------------------------------------------------------------------------
    | Logout ***
    |--------------------------------------------------------------------------
    */

    function logout() {

        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }

    /*
    |--------------------------------------------------------------------------
    |  Change Password  ***
    |--------------------------------------------------------------------------
    */
    

	public function changePassword(){

        if(!isset($this->session->userdata['userName'])){
            redirect(base_url()."userSM/login/","Refresh");				
        }else{
            $this->load->library('cart');
            $this->load->model("Category_class");
            $this->load->model("UserSM_class");
            $this->load->helper("tree");
            $this->load->model("Link_class");
            $data['link'] = $this->Link_class->getLinkList('f');
            $queryResult = $this->Category_class->getAllCategory();
            $result = createArray($queryResult);	
            $data['menubar'] = createMenubar($result,0,"selectMultiCat");
            $data['error'] = null;
            $data['message'] =  null;
            $data['accept'] = null;
            
            if($this->input->post("submit") != ""){
                $this->form_validation->run('changePasswordUser');	
                if($this->form_validation->run() == TRUE){	
                    if($this->input->post("password",TRUE) == $this->input->post("retryPassword",TRUE)){
                        $result = $this->UserSM_class->changeUserPassword($this->input->post());
                        if($result != "TRUE"){
                            $data['error'] = "کلمه عبور فعلی به درستی وارد نشده است";
                        }else{
                            $data['accept'] = "رمز عبور با موفقیت تغییر پیدا کرد";
                        }
                    }else{							
                        $data['error'] = "رمزهای عبور وارد شده یکسان نیستند";
                    }													
                }
            }

            $data['pageTitle'] = "تغییر کلمه عبور";	
            $data['pageKeywords'] = "تغییر کلمه عبور";
            $data['pageDesc'] = "تغییر کلمه عبور";
            $data['mainContent'] = 'userSM/changePassword';
            $this->load->view("layouts/site/inner", $data);
        }						
    }
    
    /*
    |--------------------------------------------------------------------------
    |  Change Password  ***
    |--------------------------------------------------------------------------
    */
    

	public function forgetPassword(){

        $this->load->library('cart');
        $this->load->model("Category_class");
        $this->load->model("UserSM_class");
        $this->load->helper("tree");
        $this->load->model("Link_class");
		$data['link'] = $this->Link_class->getLinkList('f');
        $queryResult = $this->Category_class->getAllCategory();
        $result = createArray($queryResult);	
        $data['menubar'] = createMenubar($result,0,"selectMultiCat");
        $data['forgetResult'] = null;            
        if ($this->input->post("forget") != '') {
            $this->form_validation->run('forgetPass');
            if ($this->form_validation->run() != FALSE) {
                $result = $this->User_class->forgetPassword($this->security->xss_clean($this->input->post()));
                if ($result == "1") {
                    $data['forgetResult'] = "کلمه عبور جدید به ایمیل شما ارسال گردید";
                } else{
                    $data['forgetResult'] = "آدرس ایمیل وارد شده صحیح نمی باشد";
                }
            }
        }

        $data['pageTitle'] = "فراموشی رمز عبور";	
        $data['pageKeywords'] = "فراموشی رمز عبور";
        $data['pageDesc'] = "فراموشی رمز عبور";
        $data['mainContent'] = 'userSM/forgetPassword';
        $this->load->view("layouts/site/inner", $data);
                
	}

}
