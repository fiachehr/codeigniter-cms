<?php

class Shop extends CI_Controller {

	private $adminMenu;
	private $language;

/*
--------------------------------------------------------------------
--- class constuctor method ----------------------------------------
--------------------------------------------------------------------
*/

    function __construct() 
    {
        parent::__construct();
        $this->load->model("Shop_class");
        $this->load->model("Acms_class");
        $this->load->model("Category_class");
		$this->load->helper("tree");
		$result = createModuleArray($this->Acms_class->getModules());
		$this->adminMenu = createAdminMenu($result,0);	
		$this->language = $this->Acms_class->siteLanguage();
    }

/*
--------------------------------------------------------------------
--- Add To Cart .:Ajax:. -------------------------------------------
--------------------------------------------------------------------
*/

    public function addToCart() 
    {
        $this->Shop_class->AddToCart($this->input->post());
    }

/*
--------------------------------------------------------------------
--- Remove Item From Cart .:Ajax:. ---------------------------------
--------------------------------------------------------------------
*/

    public function removeItemCart() 
    {
        $this->Shop_class->removeItemFromCart($this->input->post());
        echo true;
    }

/*
--------------------------------------------------------------------
--- Edit Item From Cart .:Ajax:. -----------------------------------
--------------------------------------------------------------------
*/

    public function updateCart() 
    {
        $this->Shop_class->updateCart($this->input->post());
        echo true;
    }

/*
--------------------------------------------------------------------
--- Check Gift Card Ajax -------------------------------------------
--------------------------------------------------------------------
*/

    public function checkGiftCard() 
    {
        echo json_encode($this->Shop_class->checkGiftCard($this->input->post()));
    }

/*
--------------------------------------------------------------------
--- Get Location Delivery Fee Ajax ---------------------------------
--------------------------------------------------------------------
*/

    public function locationDeliveryFee() {
        echo json_encode($this->Shop_class->getLocationFee($this->input->get('id', TRUE)));
    }

/*
--------------------------------------------------------------------
--- Set New Delivery Fee Ajax --------------------------------------
--------------------------------------------------------------------
*/

    public function setDeliveryFee() {
        $this->Shop_class->setDeliveryFee($this->input->get('id', TRUE), $this->input->get('delFee', TRUE));
        echo true;
    }

/*
--------------------------------------------------------------------
--- Gift Cart List -------------------------------------------------
--------------------------------------------------------------------
*/

    public function giftCardList($page = 0) 
    {
       	// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}
		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		$data['page'] = $page;
        $data['counter'] = $page+1;
        
        $data['giftCard'] = $this->Shop_class->getGiftCardList(25, 3, $page, base_url() . "shop/giftCardList");
        $data['pageTitle'] = "لیست کارتهای هدیه";
        $data['mainContent'] = 'shop/giftCardList';
		$this->load->view("layouts/panel/lists",$data);	
    }

/*
--------------------------------------------------------------------
--- Insert Gift Card -----------------------------------------------
--------------------------------------------------------------------
*/

    public function insertGiftCard() 
    {

        // Check Permission
        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }
        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;

        //form submit	
        if($this->input->post("submit") == "submit"){	
			$this->form_validation->run('giftcard');	
			if($this->form_validation->run() == FALSE){						
				$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);				
			}else{
				if($this->Acms_class->checkAccess($data['permission'])){
					$insert = $this->Shop_class->addGiftCard($this->input->post());
					$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_INSERT_SUCCESS,"url"=>base_url()."Shop/giftCardList");
				}else{
					$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Shop/giftCardList");
				}					
			}			
		}		

        $data['pageTitle'] = ' ایجاد کارت هدیه';
        $data['mainContent'] = 'shop/insertGiftCard';
        $this->load->view("layouts/panel/forms",$data);	
    }

/*
--------------------------------------------------------------------
--- Delete Gift Card -----------------------------------------------
--------------------------------------------------------------------
*/

    public function	deleteGiftCard($id,$title)
    {
        $permission = $this->Acms_class->checkPermission(__FUNCTION__);
        if($permission == "a" || $permission == "3"){
            $result = $this->Shop_class->deleteGiftCard($id,urldecode($title));
            echo "<script>alert('اطلاعات مورد نظر حذف گردید');window.location = '".base_url()."Shop/giftCardList';</script>";
        }else{
            echo "<script>alert('شما مجوز حذف اطلاعات را ندارید');window.location = '".base_url()."Shop/giftCardList';</script>";		
        }
    }

/*
--------------------------------------------------------------------
--- Delete Gift Card Ajax ------------------------------------------
--------------------------------------------------------------------
*/
    public function	deleteGiftCardAjax()
    {
        $permission = $this->Acms_class->checkPermission(__FUNCTION__);
        if($permission == "a" || $permission == "3"){
            $result = $this->Shop_class->deleteGiftCard($this->input->get("id"),urldecode($this->input->get("title")));
            echo "1";
        }else{
            echo "0";		
        }
    }

/*
--------------------------------------------------------------------
--- Factor Description ---------------------------------------------
--------------------------------------------------------------------
*/

    public function factorDesc() 
    {
        // Check Permission
        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }
        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;
        $data['ckeditor'] = CKEDITOR;
        $data['description'] = $this->Shop_class->getFactorDesc();

        //form submit	
        if($this->input->post("submit") == "submit"){	
            if($this->Acms_class->checkAccess($data['permission'])){
                $insert = $this->Shop_class->editFactorDesc($this->input->post());
                $data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_INSERT_SUCCESS,"url"=>base_url()."Shop/factorList");
            }else{
                $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Shop/factorList");
            }							
		}	

        $data['pageTitle'] = "توضیحات فاکتور";
        $data['mainContent'] = 'shop/factorDesc';
        $this->load->view("layouts/panel/forms",$data);	
    }


/*
--------------------------------------------------------------------
--- Factor Financial Setting List ----------------------------------
--------------------------------------------------------------------
*/

    public function factorFinancialList($page = 0) 
    {
    	// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if($data['permission'] == "0"){
			$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
		}
		$data['language'] = $this->language;	
		$data['adminMenu'] = $this->adminMenu;
		$data['page'] = $page;
        $data['counter'] = $page+1;
        $data['financial'] = $this->Shop_class->getfactorFinancialList(25, 3, $page, base_url() . "shop/factorFinancialList");
        $data['pageTitle'] = "لیست تنظیمات مالی فاکتورها";
        $data['mainContent'] = 'shop/factorFinancialList';
        $this->load->view("layouts/panel/lists",$data);	
    }

/*
--------------------------------------------------------------------
--- Insert Factor Financial Setting --------------------------------
--------------------------------------------------------------------
*/

    public function insertFactorFinancial() 
    {

        $this->load->helper("pdate");
        // Check Permission
        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }
        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;
        $dateFlag = true;

        //form submit	
		if($this->input->post("submit") == "submit"){	

			$this->form_validation->run('financial');	
			if($this->form_validation->run() == FALSE){
				$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);				
			}else{
				if($this->input->post("financialStartDate") != '' || $this->input->post("financialExpireDate") != ''){
					$this->load->helper("pdate");
					if(!compare2Date(jalToGre($this->input->post("financialStartDate")),jalToGre($this->input->post("financialExpireDate")))){
						$data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATE_ERROR,"url"=>null);
						$dateFlag = false;
					}					
				}
				if($dateFlag == true){
					if($this->Acms_class->checkAccess($data['permission'])){
						$insert = $this->Shop_class->financialActionData($this->input->post());
						$data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_INSERT_SUCCESS,"url"=>base_url()."Shop/factorFinancialList");
					}else{
						$data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Shop/factorFinancialList");
					}	
				}
				
			}

		}

        $data['pageTitle'] = 'افزودن تراکنش جدید';
        $data['mainContent'] = 'shop/insertFactorFinancial';
        $this->load->view("layouts/panel/forms",$data);
    }

/*
--------------------------------------------------------------------
--- Edit Factor Financial Setting ----------------------------------
--------------------------------------------------------------------
*/

    public function editFactorFinancial($id) 
    {

        $this->load->helper("pdate");
        // Check Permission
        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }
        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;
        $dateFlag = true;
        $data['financial'] = $this->Shop_class->getFinancial($id);

        //form submit	
        if($this->input->post("submit") == "submit"){	

            $this->form_validation->run('financial');	
            if($this->form_validation->run() == FALSE){
                $data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);				
            }else{
                if($this->input->post("financialStartDate") != '' || $this->input->post("financialExpireDate") != ''){
                    $this->load->helper("pdate");
                    if(!compare2Date(jalToGre($this->input->post("financialStartDate")),jalToGre($this->input->post("financialExpireDate")))){
                        $data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATE_ERROR,"url"=>null);
                        $dateFlag = false;
                    }					
                }
                if($dateFlag == true){
                    if($this->Acms_class->checkAccess($data['permission'])){
                        $insert = $this->Shop_class->financialActionData($this->input->post(),$id,$data['financial']['financialTitle']);
                        $data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_UPDATE_SUCCESS,"url"=>base_url()."Shop/factorFinancialList");
                    }else{
                        $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Shop/factorFinancialList");
                    }	
                }
                
            }

        }

        $data['pageTitle'] = 'ویرایش تراکنش | ' . $data['financial']['financialTitle'];
        $data['mainContent'] = 'shop/editFactorFinancial';
        $this->load->view("layouts/panel/forms", $data);
    }

/*
--------------------------------------------------------------------
--- Factor List ----------------------------------------------------
--------------------------------------------------------------------
*/
      public function factorList($page = 0) 
      {
        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }
        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;
        $data['factor'] = $this->Shop_class->getFactorList(25, 3, $page, base_url() . "shop/factorList", "cms");
        $data['pageTitle'] = "لیست فاکتورها";
        $data['mainContent'] = 'shop/factorList';
        $this->load->view("layouts/panel/lists", $data);
    }

/*
--------------------------------------------------------------------
--- View Factor ----------------------------------------------------
--------------------------------------------------------------------
*/

    public function viewFactor($factorID) 
    {

        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }
        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;
        $data['factorItems'] = $this->Shop_class->getFactorItems($factorID, "cms");
        if (file_exists(QRCODE_FOLDER . $factorID . '.png') != TRUE) {
            $this->load->library('ciqrcode');
            $params['level'] = 'H';
            $params['size'] = 2;
            $params['savename'] = QRCODE_FOLDER . $factorID . '.png';
            $params['data'] = base_url() . "shop/factorView/" . $factorID;
            $this->ciqrcode->generate($params);
        }
        $data['qrcode'] = base_url() . "/assets/uploads/qrcode/" . $factorID . '.png';
        $this->load->helper("tree");
        $result = $this->Shop_class->getAllLocation("location");
        $data['state'] = displayParentNodes(createArray($result), $data['factorItems'][0]['userLocation']);
       
        if ($this->input->post('submit') == "submit") {
            if($this->Acms_class->checkAccess($data['permission'])){
                $this->Shop_class->changeFactorStatus($this->input->post(), $factorID);
                $data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_UPDATE_SUCCESS,"url"=>base_url()."Shop/viewFactor/".$factorID);
            }else{
                $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Shop/viewFactor/".$factorID);
            }	
    
            
        }

        $data['pageTitle'] = "نمایش فاکتور | #" . $factorID;
        $data['mainContent'] = 'shop/viewFactor';
        $this->load->view("layouts/panel/forms", $data);
    }

/*
--------------------------------------------------------------------
--- Delete Factor --------------------------------------------------
--------------------------------------------------------------------
*/

    public function	deleteFactor($id)
    {
        $permission = $this->Acms_class->checkPermission(__FUNCTION__);
        if($permission == "a" || $permission == "3"){
            $result = $this->Shop_class->deleteFactor($id);
            echo "<script>alert('اطلاعات مورد نظر حذف گردید');window.location = '".base_url()."Shop/factorList';</script>";
        }else{
            echo "<script>alert('شما مجوز حذف اطلاعات را ندارید');window.location = '".base_url()."Shop/factorList';</script>";		
        }
    }

/*
--------------------------------------------------------------------
--- Insert Gift Card -----------------------------------------------
--------------------------------------------------------------------
*/

    public function insertLottery() 
    {

        // Check Permission
        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }
        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;

        //form submit	
        if($this->input->post("submit") == "submit"){	
            $this->form_validation->run('lottery');	
            if($this->form_validation->run() == FALSE){						
                $data['resultMessage'] = array("result"=>"Alert","group"=>GROUP_DATA_ERROR,"message"=>DATA_INSERT_ERROR,"url"=>null);				
            }else{
                if($this->Acms_class->checkAccess($data['permission'])){
                    $insert = $this->Shop_class->addLottery($this->input->post());
                    $data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>DATA_INSERT_SUCCESS,"url"=>base_url()."Shop/lotteryList");
                }else{
                    $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_DATA,"url"=>base_url()."Shop/lotteryList");
                }					
            }			
        }		

        $data['pageTitle'] = ' ایجاد قرعه کشی';
        $data['mainContent'] = 'shop/insertLottery';
        $this->load->view("layouts/panel/forms",$data);	
    }

/*
--------------------------------------------------------------------
--- Lottery List ---------------------------------------------------
--------------------------------------------------------------------
*/

    public function lotteryList($page = 0) 
    {
        // Check Permission
        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }
        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;
        $data['page'] = $page;
        $data['counter'] = $page+1;
        $data['lottery'] = $this->Shop_class->getLotteryList(25, 3, $page, base_url() . "Shop/lotteryList");
        $data['pageTitle'] = "لیست قرعه کشی ها";
        $data['mainContent'] = 'shop/lotteryList';
        $this->load->view("layouts/panel/lists",$data);	
    }

/*
--------------------------------------------------------------------
--- Lottery Chance List --------------------------------------------
--------------------------------------------------------------------
*/

    public function lotteryChanceList($id,$title,$page = 0) 
    {
        // Check Permission
        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }
        $title = str_replace("-"," ",urldecode($title));
        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;
        $data['page'] = $page;
        $data['counter'] = $page+1;
        $data['chance'] = $this->Shop_class->getChanceList(25, 5, $page, base_url() . "Shop/lotteryChanceList/".$id."/".$title);
        $data['pageTitle'] = "لیست شانسهای قرعه کشی | ".$title;
        $data['mainContent'] = 'shop/lotteryChanceList';
        $this->load->view("layouts/panel/lists",$data);	
    }

/*
--------------------------------------------------------------------
--- Run Lottery ----------------------------------------------------
--------------------------------------------------------------------
*/

    public function runLottery($id) 
    {
        // Check Permission
        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }
        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;
        $data['id'] = $id;
        $data['lotteryStatus'] = $this->Shop_class->getLotteryStatus($id);
        $this->updatedAt = false;
        if($this->input->post("submit") == "submit"){	
            if($this->Acms_class->checkAccess($data['permission'])){
                $this->Shop_class->runLottery($id,$data['lotteryStatus']['lotteryWinnerCount']);
                $data['resultMessage'] = array("result"=>"Success","group"=>GROUP_DATA_SUCCESS,"message"=>"قرعه کشی با موفقیت انجام شد","url"=>base_url()."Shop/lotteryList/");
            }
        }	
        $data['pageTitle'] = "برگذاری قرعه کشی";
        $data['mainContent'] = 'shop/runLottery';
        $this->load->view("layouts/panel/forms",$data);	
    }

/*
--------------------------------------------------------------------
--- Delete Lottery --------------------------------------------------
--------------------------------------------------------------------
*/

    public function	deleteLottery($id,$title)
    {
        $permission = $this->Acms_class->checkPermission(__FUNCTION__);
        if($permission == "a" || $permission == "3"){
            $result = $this->Shop_class->deleteLottery($id,urldecode($title));
            echo "<script>alert('اطلاعات مورد نظر حذف گردید');window.location = '".base_url()."Shop/lotteryList';</script>";
        }else{
            echo "<script>alert('شما مجوز حذف اطلاعات را ندارید');window.location = '".base_url()."Shop/lotteryList';</script>";		
        }
    }

/*
--------------------------------------------------------------------
--- Delivery Fee ---------------------------------------------------
--------------------------------------------------------------------
*/

    public function deliveryFee() 
    {
        // Check Permission
        $data['resultMessage'] = null;
        $data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
        if($data['permission'] == "0"){
            $data['resultMessage'] = array("result"=>"Alert","group"=>ACCESS_CONTROL,"message"=>DONT_ACCESS_MODULE,"url"=>base_url()."Acms/desktop");
        }
        $data['language'] = $this->language;	
        $data['adminMenu'] = $this->adminMenu;
        $this->load->helper("tree");
        $queryResult = $this->Shop_class->getAllLocation("location");
        $result = createArray($queryResult);	
        $data['tree'] = createTree($result,0,"getlocationDeliveryFee"); 	
        $data['pageTitle'] = "هزینه حمل و نقل";
        $data['mainContent'] = 'shop/deliveryFee';
        $this->load->view("layouts/panel/forms", $data);
    }

/*
--------------------------------------------------------------------
--- Cart View ------------------------------------------------------
--------------------------------------------------------------------
*/

    public function cartView() 
    {
        $this->load->library('cart');
        if ($this->cart->total() == 0) {
            redirect(base_url(), "Refresh");
        } else {
            $this->load->model("Category_class");
            $this->load->helper("tree");
            $this->load->model("Link_class");
            $data['link'] = $this->Link_class->getLinkList('f');
            $queryResult = $this->Category_class->getAllCategory();
            $result = createArray($queryResult);	
            $data['menubar'] = createMenubar($result,0,"selectMultiCat");
            $data['pageTitle'] = "سبد خرید";
            $data['pageDesc'] = "سبد خرید";
            $data['pageKeywords'] = "سبد خرید";
            $data['mainContent'] = 'shop/cartView';
            $this->load->view("layouts/site/inner", $data);
        }
    }

/*
--------------------------------------------------------------------
--- Select Address -------------------------------------------------
--------------------------------------------------------------------
*/

    public function selectAddress() 
    {
        if(!isset($this->session->userdata['userName'])){
            redirect(base_url()."userSM/login/","Refresh");				
        }else{
            $this->load->library('cart');
            if ($this->cart->total() == 0) {
                redirect(base_url(), "Refresh");
            }else{
                $this->load->model("Category_class");
                $this->load->model("UserSM_class");
                $this->load->helper("tree");
                $this->load->model("Link_class");
                $data['link'] = $this->Link_class->getLinkList('f');
                $queryResult = $this->Category_class->getAllCategory();
                $result = createArray($queryResult);	
                $data['menubar'] = createMenubar($result,0,"selectMultiCat");
                if($this->input->post("regAddress") != '' && $this->input->post("newAddress") != ""){
                    $this->UserSM_class->addAddress($this->input->post("newAddress"));
                }
                $data['userAddress'] = $this->UserSM_class->getUserAddress();
                $data['pageTitle'] = "انتخاب آدرس";
                $data['pageDesc'] = "انتخاب آدرس";
                $data['pageKeywords'] = "انتخاب آدرس";
                $data['mainContent'] = 'shop/selectAddress';
                $this->load->view("layouts/site/inner", $data);
            }
        }
    }

/*
--------------------------------------------------------------------
--- Create Factor --------------------------------------------------
--------------------------------------------------------------------
*/

    public function createFactor() 
    {
        if(!isset($this->session->userdata['userName'])){
			redirect(base_url(),"Refresh");				
        }else{
            $userData = array('userAddress'=>$this->input->post('address'));
            $this->session->set_userdata($userData);
            $this->load->library('cart');
            if ($this->cart->total() == 0) {
                redirect(base_url(), "Refresh");
            }else{
                $factorID = $this->Shop_class->createFactor();
                redirect(base_url() . "shop/factorView/" . $factorID , "Refresh");
            }
        } 
    }

























    /*     * ************************************************************ 
     * 	Factor View 
      /************************************************************ */

    public function factorView($factorID, $payment = NULL) {

        $data['payment'] = $payment;

        if ($this->input->post('submit') != "") {

            if ($this->input->post("paymentMethod") != "offline") {

                $this->Shop_class->factorPayment( $factorID);
            } else {

                redirect(base_url() . "shop/offlinePayment/" . $factorID, "Refresh");
            }
        } else {

            $this->load->model("User_class");
            $this->load->model("Tree_class");
            $this->User_class->checkPermission();

            $data['siteMenu'] = $this->siteMenu;
            $data['factorItems'] = $this->Shop_class->getFactorItems($factorID, "user");
            $data['factorFinancialItems'] = $this->Shop_class->getFinancialItems($factorID);

            if (file_exists(QRCODE_FOLDER . $factorID . '.png') != TRUE) {
                $this->load->library('ciqrcode');
                $params['level'] = 'H';
                $params['size'] = 2;
                $params['savename'] = QRCODE_FOLDER . $factorID . '.png';
                $params['data'] = base_url() . "shop/factorView/" . $factorID;
                $this->ciqrcode->generate($params);
            }
            $result = $this->Tree_class->selectTable("location");
            $data['state'] = $this->Tree_class->displayParentNodes($result, $this->session->userdata("userLocation"));
            $data['qrcode'] = base_url() . "/assets/uploads/qrcode/" . $factorID . '.png';
            $data['description'] = $this->Shop_class->getFactorDesc();
            $data['pageDesc'] = "فروشگاه اینترنتی  آموزش پرتال سبد خرید | نمایش فاکتور";
            $data['pageKeywords'] = "نمایش فاکتور";
            $data['pageTitle'] = "نمایش فاکتور " . $data['factorItems'][0]["factorID"];
            $data['mainContent'] = 'shop/factorView';
            $this->load->view("layouts/ui/inner", $data);
        }
    }

    /*     * ************************************************************ 
     * 	Verify Payment
      /************************************************************ */

    public function verifyPayment() {

        $this->load->model("User_class");
        $this->User_class->checkPermission();
        $data['siteMenu'] = $this->siteMenu;
        
        if( isset($_POST['CRN']) && isset($_POST['TRN']) && isset($_POST['RESCODE']) && $this->input->post('RESCODE') == '00' ) {
       
            $config['terminalID'] = $this->Shop_class->terminalID;
            $config['merchantID'] = $this->Shop_class->merchantID;       
            $this->load->library("payment",$config);
            $data['result'] = $this->payment->mabnaVerify($this->input->post('CRN'),$this->input->post('TRN'));
            if($data['result'][2] == true){

                $this->Shop_class->paymentResult($data['result'][1]);

            }
            
        }else{
        
            $data['result'] = 'برگشت ناموفق از درگاه';
        }

        $data['pageDesc'] = "فروشگاه انتشارات ارشد | نتیجه تراکنش";
        $data['pageKeywords'] = "نتیجه تراکنش";
        $data['pageTitle'] = "نتیجه تراکنش ";
        $data['mainContent'] = 'shop/verifyPayment';
        $this->load->view("layouts/ui/inner", $data);
    }





    /*     * ************************************************************ 
     * 	Factor Print View
      /************************************************************ */

    // public function printView($factorID, $type) {

    //     if ($type == "cms") {

    //         $data['permission'] = $this->Acms_class->checkPermission(14);
    //     } else {

    //         $this->User_class->checkPermission();
    //     }

    //     $this->load->model("Tree_class");
    //     $data['dataRegister'] = NULL;

    //     if ($this->input->post('submit') == "submit") {

    //         $this->Shop_class->changeFactorStatus($this->input->post(), $factorID);
    //         $data['dataRegister'] = "TRUE";
    //     }

    //     $data['menubar'] = $this->moduleMenu;
    //     $data['language'] = $this->language;
    //     $data['factorItems'] = $this->Shop_class->getFactorItems($factorID, "cms");
    //     $data['factorFinancialItems'] = $this->Shop_class->getFinancialItems($factorID);

    //     if (file_exists(QRCODE_FOLDER . $factorID . '.png') != TRUE) {
    //         $this->load->library('ciqrcode');
    //         $params['level'] = 'H';
    //         $params['size'] = 2;
    //         $params['savename'] = QRCODE_FOLDER . $factorID . '.png';
    //         $params['data'] = base_url() . "shop/factorView/" . $factorID;
    //         $this->ciqrcode->generate($params);
    //     }

    //     $result = $this->Tree_class->selectTable("location");
    //     $data['state'] = $this->Tree_class->displayParentNodes($result, $data['factorItems'][0]['userLocation']);
    //     $data['qrcode'] = base_url() . "/assets/uploads/qrcode/" . $factorID . '.png';
    //     $data['description'] = $this->Shop_class->getFactorDesc();

    //     $data['pageTitle'] = "نمایش فاکتور | #" . $factorID;
    //     $this->load->view("shop/printView", $data);
    // }

    /*     * ************************************************************ 
     * 	Factor View 
      /************************************************************ */

    // public function offlinePayment($factorID) {

    //     $data['dataRegister'] = NULL;
    //     $data['datePicker'] = "ON";
    //     $this->load->model("User_class");
    //     $this->User_class->checkPermission();

    //     if ($this->input->post('submit') != "") {

    //         $this->form_validation->run('payment');

    //         if ($this->form_validation->run() == FALSE) {

    //             $data['dataRegister'] = "FALSE";
    //         } else {

    //             $this->Shop_class->offlinePayment($this->input->post(), $factorID);
    //             $data['dataRegister'] = "TRUE";
    //         }
    //     }

    //     $data['siteMenu'] = $this->siteMenu;
    //     $data['factorItems'] = $this->Shop_class->getFactorItems($factorID, "user");
    //     $data['pageDesc'] = "فروشگاه اینترنتی شرکت گسترش فناوری آگو سبد خرید | نمایش فاکتور";
    //     $data['pageKeywords'] = "واریز نقدی";
    //     $data['pageTitle'] = "واریز نقدی فاکتور " . $data['factorItems'][0]["factorID"];
    //     $data['mainContent'] = 'shop/offlinePayment';
    //     $this->load->view("layouts/ui/inner", $data);
    // }

    /*     * ************************************************************ 
     * 	User Factor List
      /************************************************************ */

    public function userFactorList($page = 0) {

        $this->load->model("User_class");
        $this->User_class->checkPermission();
        $data['factor'] = $this->Shop_class->getFactorList(25, 3, $page, base_url() . "shop/userFactorList", "user");
        $data['siteMenu'] = $this->siteMenu;
        $data['pageDesc'] = "فروشگاه اینترنتی شرکت گسترش فناوری آگو سبد خرید | نمایش فاکتور";
        $data['pageKeywords'] = "واریز نقدی";
        $data['pageTitle'] = "لیست فاکتورها ";
        $data['mainContent'] = 'shop/userFactorList';
        $this->load->view("layouts/ui/user", $data);
    }

    /* End of file main.php 
      /* Location: ./application/controlers/main.php
     */
}

?>