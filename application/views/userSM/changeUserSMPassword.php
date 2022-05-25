<?php
	$password = set_value("");
	$passwordRetry = set_value("");
?>


<div class="content-wrapper">
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title"><?=$pageTitle;?></h3>
               </div>
               <form role="form" action="<?php echo base_url();?>UserSM/changeUserSMPassword/<?=$id;?>/<?=$name;?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="form-group">
                        <label for="adminUserEmail"> کلمه عبور جدید</label>
                        <input type="password"  class="form-control" name="password" id="password" tabindex="1"	maxlength="16" placeholder="  کلمه عبور جدید" value="">
                        <?php echo form_error('password') ?>
                     </div>
                     <div class="form-group">
                        <label for="adminUserMobile">  تکرار کلمه عبور </label>
                        <input type="password"  class="form-control" name="passwordRetry" id="passwordRetry" tabindex="2"	maxlength="16" value="" placeholder="  تکرار کلمه عبور">
                        کلمه عبور باید بین 6 تا 16 کارکتر باشد <?php echo form_error('passwordRetry') ?>
                     </div>
                </div>

         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary"> تغییر رمز عبور</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>

