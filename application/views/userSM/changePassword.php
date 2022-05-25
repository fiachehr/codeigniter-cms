<div class="form-box">
   <div class="form-logo">
      <a href="">
      <img src="<?=base_url();?>assets/site/images/logo.png" alt="Bic">
      </a>
   </div>
   <form action="<?=base_url();?>UserSM/changePassword" method="post">
      <h3>  تغییر رمز عبور </h3>
      <div class="form-group">
         <label for="change-pass1"><span>رمز عبور قبلی </span></label>
         <input id="change-pass1" type="password" name="lastPassword"  class="form-control" placeholder=" رمز عبور قبلی خود را وارد نمایید ">
         <p class="form-error">
            <?php echo form_error('lastPassword') ?> 
         </p>
      </div>
      <div class="form-group">
         <label for="change-pass2"> <span>رمز عبور جدید </span> </label>
         <input id="change-pass2" type="password"  name="password" class="form-control" placeholder=" رمز عبور جدید خود را وارد نمایید ">
         <p class="form-error">
            <?php echo form_error('password') ?>
         </p>
      </div>
      <div class="form-group">
         <label for="change-pass1"> <span>تکرار رمز عبور جدید </span> </label>
         <input id="change-pass1" name="retryPassword" type="password" class="form-control" placeholder=" رمز عبور جدید خود را دوباره وارد نمایید ">
         <p class="form-error">
            <?php echo form_error('retryPassword') ?> 
         </p>
      </div>
      <div class="form-group">
         <button type="submit" name="submit" value=" ثبت تغییر رمز "  class="btn btn-block btn-login">تغییر رمز عبور</button>
      </div>
      <div class="form-group">
         <p class="color-red"><?=$error;?></p>
         <p class="color-green"> <?=$accept;?> </p>
      </div>
   </form>
</div>

