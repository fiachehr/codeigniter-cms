<?php

$this->load->helper("pdate");

$galleryTagStyle = null;

$adminUserEmail = set_value('adminUserEmail',$user['adminUserEmail']);
$adminUserFName = set_value('adminUserFName',$user['adminUserFName']);
$adminUserLName = set_value('adminUserLName',$user['adminUserLName']);
$adminUserMobile = set_value('adminUserMobile',$user['adminUserMobile']);
$adminUserGroupID = set_value('adminUserGroupID',$user['adminUserGroupID']);
$end = set_value('scheduleEnd','');
$start = set_value('scheduleStart','');

if($user['scheduleEnd'] != NULL){
	$end =$user['scheduleEnd'];
}
if($user['scheduleStart'] != NULL){
	$start =$user['scheduleStart'];
}

for($i = 0 ; $i <= 2; $i++){
	
	if($i == $user['adminUserStatus']){
		
		$check[$i] = "checked=\"\"";
		
	}else{
		
		$check[$i] = NULL;
		
	}
	
}

$adminUserGroupTitle = "<span class=\"tag\" data-action=\"deleteUserGroup\">".$user['title']."</span>";
$image = null;
if($user['adminUserAvatar'] != NULL){
    $image = "<img src=\"".base_url()."assets/uploads/admin_avatar/".$user['adminUserAvatar']."\" alt=\"Avatar\">";
    $galleryTagStyle = "-show"; 
}

if($resultMessage['result'] == "Alert"){
    
    if($this->input->post('scheduleStart') != null){
      $start = jalToGre($this->input->post('scheduleStart'));
    }
    if($this->input->post('scheduleEnd') != null){
      $end = jalToGre($this->input->post('scheduleEnd'));
    }
  
     if($userGroup != NULL){	
       $adminUserGroupID = $userGroup[0];
       $adminUserGroupTitle = "<span class=\"tag\" data-action=\"deleteUserGroup\">".$userGroup[1]."</span>";	
       $adminUserGroupStyle = "-edit";
     }
   
    $adminUserEmail = set_value('adminUserEmail',$this->input->post('adminUserEmail'));
    $adminUserMobile = set_value('adminUserMobile',$this->input->post('adminUserMobile'));
   	$adminUserFName = set_value('adminUserFName',$this->input->post('adminUserFName'));
   	$adminUserLName = set_value('adminUserLName',$this->input->post('adminUserLName'));

   }

?>

<div class="content-wrapper">
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title"><?=$pageTitle;?></h3>
               </div>
               <form role="form" action="<?php echo base_url();?>Acms/editUser/<?=$user['adminUserGUID'];?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="form-group">
                        <label for="adminUserEmail"> آدرس ایمیل</label>
                        <input type="text" class="form-control"  name="adminUserEmail" id="adminUserEmail" tabindex="1"	maxlength="256" value="<?php echo $adminUserEmail; ?>" placeholder=" آدرس ایمیل">
                        <?php echo form_error('adminUserEmail') ?>
                     </div>
                     <div class="form-group">
                        <label for="adminUserMobile">  شماره موبایل</label>
                        <input type="text" class="form-control"  name="adminUserMobile" id="adminUserMobile" tabindex="1"	maxlength="256" value="<?php echo $adminUserMobile; ?>" placeholder="  شماره موبایل">
                        <?php echo form_error('adminUserMobile') ?>
                     </div>
                     <div class="form-group">
                        <label for="adminUserFName"> نام</label>
                        <input type="text" class="form-control"  name="adminUserFName" id="adminUserFName" tabindex="2"	maxlength="256" value="<?php echo $adminUserFName; ?>" placeholder="نام">
                        <?php echo form_error('adminUserFName') ?>
                     </div>
                     <div class="form-group">
                        <label for="adminUserLName"> نام خانوادگی</label>
                        <input type="text" class="form-control"  name="adminUserLName" id="adminUserLName" tabindex="3"	maxlength="256" value="<?php echo $adminUserLName; ?>" placeholder="نام خانوادگی">
                        <?php echo form_error('adminUserLName') ?>
                     </div>
                     <div class="form-group">
                        <label for="adminUserLName"> آغاز دسترسی</label>
                        <input type="text" id="start" class="form-control initial-value-example"  name="scheduleStart"  tabindex="4"	maxlength="256" value="<?php echo $start; ?>" placeholder="آغاز دسترسی">
                        <?php echo form_error('scheduleStart') ?>
                     </div>
                     <div class="form-group">
                        <label for="adminUserLName"> پایان دسترسی</label>
                        <input type="text" id="end" class="form-control"  name="scheduleEnd"  tabindex="5"	maxlength="256" value="<?php echo $end; ?>" placeholder="پایان دسترسی">
                        <?php echo form_error('scheduleEnd') ?>
                     </div>
                     <div class="form-group">
                        <label class="control-label">گروه کاربری </label>
                        <div class="col-md-12 tree-menu">
                           <?php echo $tree;?>
                        </div>
                        <?php echo form_error('adminUserGroupID') ?>
                     </div>
                     <div class="form-group">
                        <label class="control-label">گروه کاربری انتخابی</label>
                        <div id="tag-suggest" class="col-md-12 select2-choices-edit">		
                           <?=$adminUserGroupTitle;?>							
                        </div>
                        <input type="hidden" id="parentID" name="adminUserGroupID" value="<?=$adminUserGroupID;?>">
                     </div>
                     <div class="form-group">
                      <label>وضعیت</label>
                      <div class="multi-checkbox">
                      <?php
                      $checked = "checked";
                      if($permission == "3" || $permission == "a"){
                        $checked = $check[0];
                      ?>
                        <label>
                        <input type="radio" name="adminUserStatus" value="1" <?php echo $check[1];?> class="flat-red">
                        فعال
                        </label>
                        <label>
                        <input type="radio" name="adminUserStatus" value="2" <?php echo $check[2];?> class="flat-red">
                        معلق
                        </label>
                        <?php } ?>
                         <label>
                        <input type="radio" name="adminUserStatus" value="0" <?php echo $checked;?> class="flat-red">
                        غیر فعال
                        </label>
                      </div>
                    </div>
                     <div class="form-group ">
                        <label for="adminUserLName"> تصویر اواتار</label>
                        <div class="col-md-12 file-section">
                           <div class="col-md-12">
                              <input type="file" size-data="100000"  id="upload-picture" name="adminUserAvatar" id="adminUserAvatar" tabindex="6"  />
                              فایل هایی با فرمت  jpg یا png یا gif ، حجم کمتر از 100 کیلو بایت و طول و عرض کمتر از 500 پیکسل
                           </div>
                           <div class="col-md-12" id="image-preview<?=$galleryTagStyle;?>">
                                <?=$image;?>
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">ویرایش اطلاعات کاربر</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>

