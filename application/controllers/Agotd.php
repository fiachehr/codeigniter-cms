<?php
class Agotd extends CI_Controller{

	private $siteMenu;
	
/*
|--------------------------------------------------------------------------
| Class Constractor
|--------------------------------------------------------------------------
*/
	
	function __construct(){
		
		parent::__construct();

		$this->load->model("Category_class");
		$this->load->helper("tree");
		$queryResult = $this->Category_class->getAllCategory();
		$result = createArray($queryResult);	
		$this->siteMenu = createMenubar($result,0,"selectMultiCat");
	
	}
    
/*
|--------------------------------------------------------------------------
| .:Index:.
|--------------------------------------------------------------------------
*/	

	public function	index(){	

		$this->load->model("Product_class");
		$this->load->model("Homepage_class");
		$this->load->model("Board_class");
		$this->load->model("News_class");
		$this->load->library('cart');
		$this->load->model("Link_class");
		$data['link'] = $this->Link_class->getLinkList('f');
		
		$data['menubar'] = $this->siteMenu;
		$data['slider'] = $this->Homepage_class->getSlider();
		$items = $this->Homepage_class->getHomepageItem();
		$counter = 1;
		$data['board'] = $this->Board_class->getBoard();

		foreach($items as $rows){
			if($rows['homeItemType'] == "PLX"){
				$data['paralax'.$counter.'Img'] = base_url()."assets/uploads/homepage/".$rows['homeItemImage'];
				$data['paralax'.$counter.'Title'] = $rows['homeItemTitle'];
				$data['paralax'.$counter.'Desc'] = $rows['homeItemDesc'];
				$data['paralax'.$counter.'Link'] = $rows['homeItemLink'];
				$counter++;
			}else{
				$data['section'.$counter."Img"] = base_url()."assets/uploads/homepage/".$rows['homeItemImage'];
				$data['section'.$counter."Title"] = $rows['homeItemTitle'];
				$data['section'.$counter."Desc"] = $rows['homeItemDesc'];
				$data['section'.$counter."Link"] = $rows['homeItemLink'];
			}
		}

		$data['femaleTopProduct'] = $this->Product_class->getHomeProduct(4,"Top F");
		$data['maleTopProduct'] = $this->Product_class->getHomeProduct(4,"Top M");
		$data['topHealthyProduct'] = $this->Product_class->getHomeProduct(4,"TH");

		$data['femaleProduct'] = $this->Product_class->getHomeProduct(8,"F");
		$data['maleProduct'] = $this->Product_class->getHomeProduct(8,"M");
		$data['sportProduct'] = $this->Product_class->getHomeProduct(8,"S");
		$data['healthyProduct'] = $this->Product_class->getHomeProduct(8,"H");

		$data['lastNews'] = $this->News_class->getLastNews(4);
		
		$data['pageDesc'] = "فروشگاه اینترنتی بیک";
		$data['pageKeywords'] = "فروشگاه اینترنتی بیک";
		$data['pageTitle'] = 'فروشگاه اینترنتی بیک';	
		$data['mainContent'] = 'site/home';
		$this->load->view("layouts/site/home",$data);
		
	}

/*
|--------------------------------------------------------------------------
| .:Contact:.
|--------------------------------------------------------------------------
*/	

	function contact(){
			
		$this->load->helper("file");
		$data['menubar'] = $this->siteMenu;
		$data['contactInfo'] = $this->Category_class->getContact();
		$data['dataRegister'] = NULL;
		$data['captchaError'] = NULL;
		$this->load->model("Link_class");
		$data['link'] = $this->Link_class->getLinkList('f');
		$this->load->library('cart');	
		
	// Captcha Control

		$this->load->helper("captcha");
		delete_files('./assets/captcha/contact/');
		$data['cap'] = $this->Category_class->createCaptcha("assets/captcha/contact/",4,"numeric");
		$data['captchaImg'] = $data['cap'];
		
		// Send Email

		if($this->input->post('submit') != ""){

			// Form Validation
			$this->form_validation->run('contactForm');			
			if($this->form_validation->run() == FALSE){
				$data['sendingMessage'] = "پیام شما ارسال نگردید";
				$data['dataRegister'] = "FALSE";		
			}else{
				$captcha = $this->input->post('captcha',TRUE);
				// Captcha Controler
				$data['captchaResult'] = $this->Category_class->checkCaptcha($captcha);	
				
				if($data['captchaResult'] != 1){
				
					$data['captchaError'] = "کد امنیتی به درستی وارد نشده است";	
					$data['dataRegister'] = "FALSE";
			
					$data['sendingMessage'] = "";		
				
				}else{	
					$this->load->helper("sendemail");
					sendEmail( $this->input->post('mailAddr'),$this->input->post('to'), NULL, $this->input->post('subject'),$this->input->post('content'), NULL);
					$data['dataRegister'] = "TRUE";
				}

				
			}		
				
				
		}
						
		$data['pageDesc'] = "ارتباط با ما";
		$data['pageKeywords'] = "ارتباط با ما";
		$data['pageTitle'] = 'ارتباط با ما';	
		$data['mainContent'] = 'site/contact';
		$this->load->view("layouts/site/home",$data);								
		
	}	
	
}
