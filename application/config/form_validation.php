<?php

$config = array(
	'login' => array(
		array('field' => 'username','label' => 'نام کاربری','rules' => 'trim|required|valid_email'),
		array('field' => 'password','label' => 'رمز عبور','rules' => 'trim|required')
	),
	'userGroup' => array(
		array('field' => 'title','label' => 'عنوان گروه کاربری','rules' => 'trim|required')
	),
	'insertUserAdmin' => array(
		array('field' => 'adminUserEmail','label' => 'آدرس ایمیل','rules' => 'trim|required|valid_email|is_unique[tbl_admin.adminUserEmail]'),
		array('field' => 'adminUserMobile','label' => 'شماره موبایل','rules' => 'trim|required|numeric|min_length[10]'),
		array('field' => 'adminUserFName','label' => 'نام','rules' => 'trim|required'),
		array('field' => 'adminUserLName','label' => 'نام خانوادگی','rules' => 'trim|required'),
		array('field' => 'adminUserGroupID','label' => 'گروه کاربری','rules' => 'trim|required')
	),
	'editUserAdmin' => array(
		array('field' => 'adminUserFName','label' => 'نام','rules' => 'trim|required'),
		array('field' => 'adminUserLName','label' => 'نام خانوادگی','rules' => 'trim|required'),
		array('field' => 'adminUserGroupID','label' => 'گروه کاربری','rules' => 'trim|required'),
		array('field' => 'adminUserMobile','label' => 'شماره موبایل','rules' => 'trim|required|numeric|min_length[10]')
	),	
	'changePass' => array(
		array('field' => 'password','label' => 'رمز عبور','rules' => 'trim|required|max_length[16]|min_length[6]'),
		array('field' => 'passwordRetry','label' => 'تکرار کلمه عبور','rules' => 'trim|required|max_length[16]|min_length[6]')
	),	
	'category' => array(
		array('field' => 'title','label' => 'عنوان دسته بندی یا صفحه','rules' => 'trim|required'),
	),	
	'news' => array(
		array('field' => 'newsTitle','label' => 'عنوان خبر','rules' => 'trim|required'),
		array('field' => 'newsArthur','label' => 'نویسنده خبر','rules' => 'trim|required'),
		array('field' => 'newsSummery','label' => 'خلاصه خبر','rules' => 'trim|required'),
		array('field' => 'newsBody','label' => 'متن خبر','rules' => 'trim|required'),
		array('field' => 'newsCatList','label' => 'دسته بندی خبر','rules' => 'trim|required')
	),
	'productSM' => array(
		array('field' => 'productTitle','label' => 'عنوان محصول','rules' => 'trim|required'),
		array('field' => 'productModel','label' => 'مدل محصول','rules' => 'trim|required'),
		array('field' => 'productSize','label' => 'سایز محصول','rules' => 'trim|required|numeric'),
		array('field' => 'productPrice','label' => 'قیمت محصول','rules' => 'trim|required|numeric'),
		array('field' => 'productDesc','label' => 'توضیحات محصول','rules' => 'trim|required')
	),

	'insertUserSM' => array(
		array('field' => 'userName','label' => ' نام و نام خانوادگی','rules' => 'trim|required'),
		array('field' => 'userMobileNo','label' => 'شماره موبایل','rules' => 'numeric'),
		array('field' => 'userEmail','label' => 'آدرس ایمیل','rules' => 'trim|required|is_unique[tbl_user_sm.userEmail]'),
		array('field' => 'userAddress','label' => 'آدرس','rules' => 'trim|required'),
	),
	'editUserSM' => array(
		array('field' => 'userName','label' => ' نام و نام خانوادگی','rules' => 'trim|required'),
		array('field' => 'userMobileNo','label' => 'شماره موبایل','rules' => 'numeric'),
		array('field' => 'userAddress','label' => 'آدرس','rules' => 'trim|required'),
	),
	'productSMC' => array(
		array('field' => 'productTitle','label' => 'عنوان محصول','rules' => 'trim|required'),
		array('field' => 'productSummery','label' => 'خلاصه توضیحات','rules' => 'trim|required'),
		array('field' => 'productCatList','label' => 'دسته بندی محصول','rules' => 'trim|required'),
		array('field' => 'productPrice','label' => 'قیمت محصول','rules' => 'numeric'),
	),
	'insertHomeItem' => array(
		array('field' => 'homeItemImageSize','label' => ' سایز تصویر بخش','rules' => 'trim|required'),
		array('field' => 'homeItemLabel','label' => '  لیبل بخش ','rules' => 'trim|required')
	),
	'contact' => array(
		array('field' => 'contactTitle','label' => 'عنوان اطلاعات ارتباطی','rules' => 'trim|required'),
		array('field' => 'contactValue','label' => 'مقدار اطلاعات ارتباطی','rules' => 'trim|required')
	),
	'Product' => array(
		array('field' => 'productTitle','label' => 'عنوان محصول','rules' => 'trim|required'),
		array('field' => 'productProYear','label' => 'سال معرفی محصول','rules' => 'trim|required|numeric|max_length[4]'),
		array('field' => 'productVolume','label' => 'حجم محصول','rules' => 'required|numeric'),
		array('field' => 'productPrice','label' => 'قیمت محصول','rules' => 'trim|required|numeric'),
		array('field' => 'productDesc','label' => 'توضیحات محصول','rules' => 'trim|required'),
		array('field' => 'productBrand','label' => 'برند محصول','rules' => 'trim|required'),
		array('field' => 'productDicount','label' => 'تخفیف محصول','rules' => 'trim|numeric|max_length[2]'),
		array('field' => 'productWeight','label' => 'وزن محصول','rules' => 'trim|numeric|max_length[6]'),
		array('field' => 'productPackage','label' => 'نوع محفظه نگهدارنده محصول','rules' => 'required|trim'),
		array('field' => 'productLicense','label' => 'شماره مجوز محصول','rules' => 'trim|required'),
		array('field' => 'productCatList','label' => 'دسته بندی محصول','rules' => 'trim|required'),
		array('field' => 'productCountry','label' => 'کشور سازنده محصول','rules' => 'trim|required'),
		array('field' => 'productFor','label' => 'مناسب برای','rules' => 'trim|required'),
		
		
	),

	'giftcard' => array(
		array('field' => 'giftCardAmount','label' => 'ارزش کارت هدیه','rules' => 'trim|required|min_length[5]|numeric'),
		array('field' => 'giftCardExpireDate','label' => ' تاریخ انقضا','rules' => 'trim|required'),						  
		array('field' => 'giftCardCount','label' => 'تعداد','rules' => 'trim|required|numeric'),		 
	),
	'financial' => array(
		array('field' => 'financialTitle','label' => 'عنوان','rules' => 'trim|required'),
		array('field' => 'financialPercent','label' => 'میزان','rules' => 'trim|required|max_length[2]|numeric'),						  
		array('field' => 'financialStartDate','label' => 'آغاز','rules' => 'trim|required'),	
		array('field' => 'financialExpireDate','label' => 'پایان','rules' => 'trim|required'),	 
	),
	'insertUserUI' => array(
		array('field' => 'userEmail','label' => 'آدرس ایمیل','rules' => 'trim|required|valid_email|is_unique[tbl_user_sm.userEmail]'),
		array('field' => 'userName','label' => 'نام و نام خانوادگی','rules' => 'trim|required'),
		array('field' => 'userMobileNo','label' => 'شماره تماس','rules' => 'trim|required|numeric|min_length[8]'),
		array('field' => 'userAddress','label' => 'آدرس','rules' => 'trim|required'),
		array('field' => 'userPassword','label' => 'کلمه عبور','rules' => 'trim|required|min_length[8]'),
		array('field' => 'passwordRetry','label' => 'تکرار کلمه عبور','rules' => 'trim|required|min_length[8]')
   ),
   'loginUser' => array(
		array('field' => 'loginUserName','label' => 'نام کاربری','rules' => 'trim|required'),
		array('field' => 'password','label' => 'رمز عبور','rules' => 'trim|required')
	),
	'lottery' => array(
		array('field' => 'lotteryTitle','label' => 'عنوان قرعه کشی','rules' => 'trim|required'),
		array('field' => 'lotteryExpireDate','label' => ' تاریخ انقضا','rules' => 'trim|required'),						  
		array('field' => 'onlineCode','label' => 'تعداد کدهای آنلاین','rules' => 'trim|required|numeric|max_length[3]'),
		array('field' => 'offlineCode','label' => 'تعداد کدهای آفلاین','rules' => 'trim|required|numeric|max_length[3]'),	
		array('field' => 'lotteryWinnerCount','label' => 'تعداد برنده','rules' => 'trim|required|numeric|max_length[3]'),	 
	),
	'link' => array(
		array('field' => 'linkTitle','label' => 'عنوان لینک','rules' => 'trim|required'),
		array('field' => 'linkURL','label' => 'آدرس لینک','rules' => 'trim|required')
	),
	'board' => array(
		array('field' => 'boardTitle','label' => 'عنوان تابلو اعلانات','rules' => 'trim|required'),
	),

	
		
	     





    'insertJob' => array(
		array('field' => 'jobMainTitle','label' => ' عنوان آگهی','rules' => 'trim|required'),
		array('field' => 'jobContact','label' => '  اطلاعات تماس ','rules' => 'trim|required')
	),
	'userLogin' => array(
		array('field' => 'userMobileNo','label' => 'شماره موبایل','rules' => 'trim|required|numeric|min_length[10]'),
		array('field' => 'userPassword','label' => 'رمز عبور','rules' => 'trim|required')
	),	
	'changePasswordUser' => array(
		array('field' => 'lastPassword','label' => 'کلمه عبور فعلی','rules' => 'trim|required|min_length[5]'),
		array('field' => 'password','label' => 'کلمه عبور','rules' => 'trim|required|min_length[5]'),						  
		array('field' => 'retryPassword','label' => 'تکرار کلمه عبور','rules' => 'trim|required|min_length[5]'),		 
	),
	'forgetPass' => array(
		array('field' => 'forgetPasswordMobile','label' => 'شماره موبایل','rules' => 'trim|required|numeric|min_length[10]'),
	),	
	'insertTag' => array(
		array('field' => 'tagTitle','label' => 'عنوان ویژگی','rules' => 'trim|required'),
	),
	'insertUser' => array(
		array('field' => 'userMobileNo','label' => 'شماره موبایل','rules' => 'trim|required|numeric|min_length[10]|is_unique[tbl_user.userMobileNo]'),
		array('field' => 'userName','label' => 'نام کاربری','rules' => 'trim|required')
	),
	'editUser' => array(
		array('field' => 'userName','label' => 'نام کاربری','rules' => 'trim|required')
	),		
	'location' => array(
		array('field' => 'locTitle','label' => 'عنوان','rules' => 'trim|required')
	),	
);


