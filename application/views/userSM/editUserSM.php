<?php

   $userName = set_value('userName',$user['userName']);
   $userMobileNo = set_value('userMobileNo',$user['userMobileNo']);
   $userEmail = set_value('userName',$user['userEmail']);
   $userAddress = set_value('userAddress',$user['userAddress']);
   $enabledStatus = "";
   $disabledStatus = "checked";

   if($user['userStatus'] == "e"){
      $enabledStatus = "checked";
      $disabledStatus = "";
   }

if($resultMessage['result'] == "Alert"){

   $userMobileNo = set_value('userMobileNo',$this->input->post('userMobileNo'));
   $userName = set_value('userName',$this->input->post('userName'));
   $userEmail = set_value('userEmail',$this->input->post('userEmail'));
   $userAddress = set_value('userAddress',$this->input->post('userAddress'));
   
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
               <form role="form" action="<?php echo base_url();?>UserSM/editUserSM/<?=$user['userGUID'];?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="form-group">
                        <label for="userName">نام و نام خانوادگی</label>
                        <input type="text" class="form-control"  name="userName" id="userName" tabindex="1"	maxlength="256" value="<?php echo $userName; ?>" placeholder=" نام و نام خانوادگی">
                        <?php echo form_error('userName') ?>
                     </div>
                     <div class="form-group">
                        <label for="userMobileNo">  شماره موبایل</label>
                        <input type="text" class="form-control"  name="userMobileNo" id="userMobileNo" tabindex="1"	maxlength="256" value="<?php echo $userMobileNo; ?>" placeholder="  شماره موبایل">
                        <?php echo form_error('userMobileNo') ?>
                     </div>
                  
                  <div class="form-group">
                        <label for="userName">آدرس آیمیل</label>
                        <input type="text" class="form-control"  name="userEmail" id="userEmail" tabindex="3"	maxlength="128" value="<?php echo $userEmail; ?>" placeholder="آدرس ایمیل">
                        <?php echo form_error('userEmail') ?>
                     </div>
                     <div class="form-group">
                        <label for="userMobileNo"> آدرس</label>
                        <input type="text" class="form-control"  name="userAddress" id="userAddress" tabindex="4"	maxlength="2048" value="<?php echo $userAddress; ?>" placeholder="آدرس">
                        <?php echo form_error('userAddress') ?>
                     </div>
                     <div class="form-group">
                        <label>وضعیت</label>
                        <div class="multi-checkbox">
                           <label>
                           <input type="radio" name="userStatus" value="d" class="flat-red" <?=$disabledStatus;?>>
                           غیر فعال
                           </label>
                           <?php
                              if($permission == "3" || $permission == "a"){
                              ?>
                           <label>
                           <input type="radio" name="userStatus" value="e" class="flat-red" <?=$enabledStatus;?> >
                           فعال
                           </label>
                           <?php } ?>
                        </div>
                     </div>
                     </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">ویرایش کاربر</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>

