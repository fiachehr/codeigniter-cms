<div class="form-box">
    <div class="form-logo">
        <a href="">
            <img src="<?=base_url();?>assets/site/images/logo.png" alt="Bic">
        </a>
    </div>
    <form action="<?=base_url();?>UserSM/forgetPassword" method="post">
        <h3>  فراموشی رمز عبور </h3>
        <div class="form-group">
            <label for="forgot-password"> <span> ایمیل یا شماره موبایل</span> </label>
            <input id="forgot-password" type="text" class="form-control" placeholder="ایمیل  خود را وارد نمایید">
            <p class="form-error"><?=$forgetResult;?></p>
        </div>
        <div class="form-group">
            <button type="submit" name="submit" value="فراموشی رمز عبور" class="btn btn-block btn-login">فراموشی رمز عبور</button>
        </div>
    </form>
</div>