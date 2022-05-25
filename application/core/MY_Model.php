<?php defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Model extends CI_Model
{

    protected $table = null;
    protected $primeryKey = null;
    protected $selectConditions = null;
    protected $updatedAt = true;
    protected $createdAt = true;
    private $logUserTitle = array("tbl_user_group"=>"گروه کاربری","tbl_admin"=>"کاربر مدیریت","tbl_category"=>"دسته بندی و صفحه","tbl_news"=>"اخبار و مقاله",
                                  "tbl_page_content"=>"محتوی صفحه","tbl_product_sm"=>"محصولات","tbl_user_sm"=>"کاربران","tbl_page_link"=>"فایل یا لینک","tbl_news_sm"=>"اخبار و مقالات",
                                  "tbl_product_smc"=>"محصولات","tbl_homepage"=> "صفحه اول","tbl_slider"=>"اسلایدر","tbl_contact"=>"اطلاعات ارتباطی","tbl_product"=>"محصولات","tbl_shop_giftcard"=>"کارت هدیه",
                                  "tbl_shop_factor_desc"=>"توضیحات فاکتور","tbl_shop_factor_financial"=>"تنظیمات فاکتور","tbl_shop_factor"=>" فاکتور","tbl_lottery"=>"قرعه کشی","tbl_link"=>"پیوند","tbl_board"=>"تابلو اعلانات");
    private $logUserType = array("insert"=>"ایجاد","delete"=>"حذف","update"=>"ویرایش");


/*
|--------------------------------------------------------------------------
| User Log
|--------------------------------------------------------------------------
*/

    private function setUserLog($table,$type,$title)
    {
        $this->table = "tbl_user_log";
        $this->createdAt = false;
        $data['logUserIP'] = $this->input->ip_address();
        $data['logUserID'] = $this->session->userdata("userGUID");
        $data['logDate'] = date("Y-m-d H:i:s"); 
        $data['logMessage'] = $this->logUserType[$type]." ".$this->logUserTitle[$table]." ".$title ;   
        $this->insert($data,false);     
        $this->createdAt = true;
    }

/*
|--------------------------------------------------------------------------
| Costum User Log
|--------------------------------------------------------------------------
*/

    public function setCostumUserLog($message)
    {
        $this->table = "tbl_user_log";
        $this->createdAt = false;
        $data['logUserIP'] = $this->input->ip_address();
        $data['logUserID'] = $this->session->userdata("userGUID");
        $data['logDate'] = date("Y-m-d H:i:s"); 
        $data['logMessage'] = $message ;   
        $this->insert($data,false);     
        $this->createdAt = true;
    }


/*
|--------------------------------------------------------------------------
| Check Data is Multi Dimensional
|--------------------------------------------------------------------------
*/
    
    public function isMultidimensional($array)
    {

        foreach($array as $element)
        {
            if(is_array($element))
            {
                return true;
            }
        }
        return false;
    }

/*
|--------------------------------------------------------------------------
| Insert Method
|--------------------------------------------------------------------------
*/

    protected function insert($data,$title = null)
    {
        
        if($this->createdAt == true){
            $data['created_at'] = date("Y-m-d H:i:s");
        }
        $multi = $this->isMultidimensional($data);
        if($multi == false){
            $this->db->insert($this->table,$data);
        }else{
            $this->db->insert_batch($this->table,$data);
        }      
        if($title != null){
            $this->setUserLog($this->table,__FUNCTION__,$title);
        }
        $this->createdAt = true;
    }

/*
|--------------------------------------------------------------------------
| Delete Method
|--------------------------------------------------------------------------
*/

    protected function delete($value,$title = null)
    {
        $this->db->where($this->primeryKey,$value);
        $this->db->delete($this->table);
        if($title != null){
            $this->setUserLog($this->table,__FUNCTION__,$title);
        }
    }

/*
|--------------------------------------------------------------------------
| Update Method
|--------------------------------------------------------------------------
*/

    protected function update($data,$value,$title = null)
    {
        if($this->updatedAt == true){
            $data['updated_at'] = date("Y-m-d H:i:s");
        }
        $this->db->where($this->primeryKey,$value);
        $this->db->update($this->table,$data);
        if($title != null){
            $this->setUserLog($this->table,__FUNCTION__,$title);
        }
        $this->updateAt = true;
    }

/*
|--------------------------------------------------------------------------
| Get ALL Method
|--------------------------------------------------------------------------
*/

    protected function getData()
    {
        $this->db->from($this->table);
        if(isset($this->selectConditions['select'])){
            $this->db->select($this->selectConditions['select']);
        }   
        if(isset($this->selectConditions['where']) ){
            $this->db->where($this->selectConditions['where']);
        }
        if(isset($this->selectConditions['order'] )){
            $this->db->order_by($this->selectConditions['order']);
        }
        if(isset($this->selectConditions['limit'] )){
            $this->db->limit($this->selectConditions['limit']);
        }
        if(isset($this->selectConditions['group'] )){
            $this->db->group_by($this->selectConditions['group']);
        }
        if(isset($this->selectConditions['join'] )){
            foreach($this->selectConditions['join'] as $value){
                $this->db->join($value['table'],$value['joinCondition'],$value['joinType']);
            }
        }
        $query = $this->db->get();
        $result = $query->result_array();  
        if($query->num_rows() > 0){
            if(!isset($this->selectConditions['resultType'] )){
                $this->selectConditions = null;
                return $result;
            }else{
                $this->selectConditions = null;
                return $result[0];
            }
        }else{
            $this->selectConditions = null;
            return null;
        }
    }

/*
|--------------------------------------------------------------------------
| Paginate List 
|--------------------------------------------------------------------------
*/	
	
	function paginate($limit,$segments,$page,$query,$url,$type,$queryString = FALSE){

        $getAllCount = $this->db->query($query);
		$rows_num = $getAllCount->num_rows();	

        if($type == "panel"){

            $config['first_link'] = 'صفحه نخست';
            $config['first_tag_open'] = '<li class="first-page">';
            $config['first_tag_close'] = '</li>';          
            $config['last_link'] = 'صفحه آخر';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';         
            $config['prev_link'] = '<span class="paginate_button next">قبلی</span>';
            $config['prev_tag_open'] = '<li class="paginate_button previous">';
            $config['prev_tag_close'] = '</li>';  
            $config['next_link'] = '<span class="paginate_button next">بعدی</span>';
            $config['next_tag_open'] = '<li class="next">';
            $config['next_tag_close'] = '</li>'; 
            $config['full_tag_open'] = '<div class="dataTables_paginate paging_simple_numbers"><ul class="pagination">';
            $config['full_tag_close'] = '</ul></div>';              
            $config['cur_tag_open'] = '<li class="paginate_button active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';          
            $config['num_tag_open'] = '<li class="paginate_button ">';
            $config['num_tag_close'] = '</li>';

        }else{

            $config['first_link'] = '<i class="fa fa-angle-double-right"></i>';        
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';  
   

            $config['last_link'] = '<i class="fa fa-angle-double-left"></i>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';  

            $config['prev_link'] = '<i class="fa fa-chevron-right"></i>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';  

            $config['next_link'] = '<i class="fa fa-chevron-left"></i>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>'; 

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>'; 

            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
            $config['cur_tag_close'] = '</a></li>';      

            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
            
            $config['num_links'] = 5;
            $config['page_query_string'] = $queryString;
            $config['first_url'] = '0';

        }
					
		$config['base_url'] = $url;
		$config['total_rows'] = $rows_num;
		$config['per_page'] = $limit;
        $config['uri_segment'] = $segments;
        
		$this->pagination->initialize($config);
		$pages = $this->pagination->create_links();
				
		$paggingQuery = $this->db->query($query." LIMIT ".$page.",".$limit."");
		$result = $paggingQuery->result_array();  		
		return array("list"=>$result,"link"=>$pages,"count"=>$rows_num);
	
    }

/*
|--------------------------------------------------------------------------
| Create Captcha
|--------------------------------------------------------------------------
*/	

    function createCaptcha($folder,$length,$type){

        $this->load->helper("string");
        $vals = array(
            'word'          => random_string($type, $length),
            'img_path'      => getcwd().'/'.$folder,
            'img_url'       => base_url().$folder,
            'font_path'     => './path/to/fonts/texb.ttf',
            'img_width'     => '150',
            'img_height'    => 30,
            'expiration'    => 7200,
            'word_length'   => $length,
            'font_size'     => 16,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'colors'        => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => array(255, 40, 40)
            )
        );

        $cap = create_captcha($vals);
        $data = array(
            'captchaTime'  => $cap['time'],
            'userIP'    => $this->input->ip_address(),
            'captchaString'          => $cap['word']
        );
        $query = $this->db->insert_string('tbl_captcha', $data);
        $this->db->query($query);
        return $cap['image'];

    }

/*
|--------------------------------------------------------------------------
| Check Captcha
|--------------------------------------------------------------------------
*/	

    function checkCaptcha($value){
        $result = 1;
        $expiration = time() - 7200; 
        $this->db->where('captchaTime < ', $expiration)->delete('tbl_captcha');
        $sql = 'SELECT COUNT(*) AS count FROM tbl_captcha WHERE captchaString = ? AND userIP = ? AND captchaTime > ?';
        $binds = array($value, $this->input->ip_address(), $expiration);
        $query = $this->db->query($sql, $binds);
        $row = $query->row();
        if ($row->count == 0){
           $result = 0;
        }
        return $result;
    }

/*
|--------------------------------------------------------------------------
| Get File Extension
|--------------------------------------------------------------------------
*/

    function urlProcces($idSegment) {

        $segments = $this->uri->segment_array();
        $result['page'] = $segments[count($segments)];
        $result['url'] = null;
        for($i = 1 ; $i < count($segments) ; $i++){
            $result['url'] .= urldecode($segments[$i])."/";
        }
        $result['url'] = base_url().$result['url'];
        $result['segment'] = $this->uri->total_segments();
        $result['id'] = $segments[$idSegment];
        $result['title'] = str_replace("-"," ",urldecode($segments[count($segments)-1]));
        return $result;

    }
}
