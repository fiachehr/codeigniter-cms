<?php

   $userName = set_value('');

   $userEmail = set_value('');

   $userMobileNo = set_value('');

   $userAddress = set_value('');

   $userPassword = set_value('');

   $passwordRetry = set_value('');

   $userLocation = "";

   $states = "";

   

foreach ($location as $row) {

    $states .= "<option value=\"" . $row['id'] . "\">" . $row['title'] . "</option>";

}



foreach ($city as $rows) {

    $userLocation .= "<option value=\"" . $rows['id'] . "\">" . $rows['title'] . "</option>";

}



if ($dataRegister == "TRUE") { 

    if($this->cart->total() != 0) {

        redirect(base_url()."Shop/cartView/","Refresh");		

    }else{

        redirect(base_url(), "Refresh");

    }

} elseif ($dataRegister == "FALSE") { 



    if ($passwordFlag == FALSE) { 

        echo "<script>alert('اطلاعات کاربری شما ثبت نگردید.کلمه عبور و تکرار آن متفاوت است');</script>";

    } else {

        echo "<script>alert('اطلاعات کاربری شما ثبت نگردید');</script>";

    }



    $userName = set_value('userName', $this->input->post('userName'));

    $userEmail = set_value('userEmail', $this->input->post('userEmail'));

    $userMobileNo = set_value('userMobileNo', $this->input->post('userMobileNo'));

    $userAddress = set_value('userAddress', $this->input->post('userAddress'));

    $userPassword = set_value('');

    $passwordRetry = set_value('');



    foreach ($location as $row) {

        if ($this->input->post('state') == $row['id']) {

            $states .= "<option value=\"" . $row['id'] . "\" selected=\"selected\">" . $row['title'] . "</option>";

        } else {

            $states .= "<option value=\"" . $row['id'] . "\">" . $row['title'] . "</option>";

        }

    }



    foreach ($city as $rows) {

        if ($this->input->post('userLocation') == $rows['id']) {

            $userLocation .= "<option value=\"" . $rows['id'] . "\" selected=\"selected\">" . $rows['title'] . "</option>";

        } else {

            $userLocation .= "<option value=\"" . $rows['id'] . "\">" . $rows['title'] . "</option>";

        }

    }

}



if ($dataLogin == "FALSE") { 

   echo "<script>alert('نام کاربری یا کلمه عبور اشتباه است');</script>";

}

 ?> 

      

      

      <div class="form-wrapper">

         <div class="form-logo">

            <a href="">

            <img src="<?=base_url();?>assets/site/images/logo.png" alt="">

            </a>

         </div>

         <div class="form-box">

            <form action="<?=base_url();?>UserSM/login" method="post">

               <h3> ورود به <span>بیک</span> </h3>

               <div class="form-group">

                  <label for="login-email"> <span> ایمیل یا شماره موبایل</span> </label>

                  <input id="login-email" type="text" class="form-control" name="loginUserName" placeholder="ایمیل یا شماره موبایل خود را وارد نمایید">

                  <p class="form-error">

                     <?php echo form_error('loginUserName') ?>

                  </p>

               </div>

               <div class="form-group">

                  <label for="login-password"> <span>رمز عبور</span> </label>

                  <input id="login-password" type="password" name="password" class="form-control" placeholder=" رمز عبور خود را وارد نمایید ">

                  <p class="form-error">

                     <?php echo form_error('password') ?>

                  </p>

               </div>

               <div class="form-group">

                  <button type="submit" name="login" value="login" class="btn btn-block btn-login"> ورود به بیک </button>

               </div>

               <div class="form-footer">

               <a class="link-forgot" href="<?=base_url();?>UserSM/forgetPassword"> رمز عبور خود را فراموش کرده ام</a>

               </div>

            </form>

         </div>

         <div class="form-box">

            <form action="<?=base_url();?>UserSM/login" method="post">

               <h3>  ثبت نام در <span>بیک</span> </h3>

               <div class="form-group">

                  <label for="login-email"> <span>نام و نام خانوادگی</span> </label>

                    <input id="login-email" name="userName" type="text" class="form-control" placeholder="نام و نام خانوادگی  را وارد نمایید" value="<?php echo $userName; ?>">

                  <p class="form-error">

                  <?php echo form_error('userName') ?>

                  </p>

               </div>

               <div class="form-group">

                  <label for="login-email"> <span>ایمیل</span> </label>

                  <input id="login-email" type="text" name="userEmail" value="<?php echo $userEmail; ?>" class="form-control" placeholder="ایمیل  را وارد نمایید">

                  <p class="form-error">

                    <?php echo form_error('userEmail') ?>

                  </p>

               </div>

               <div class="form-group">

                  <label for="login-email"> <span>شماره موبایل</span> </label>

                  <input id="login-email" name="userMobileNo" value="<?php echo $userMobileNo; ?>" type="text" class="form-control" placeholder=" شماره موبایل خود را وارد نمایید">

                  <p class="form-error">

                  <?php echo form_error('userMobileNo') ?>

                  </p>

               </div>

               <div class="form-group">

                  <label for="login-email"> <span>استان</span> </label>

                  <select id="state" name="state" class="form-control" ><?php  echo $states; ?></select>

               </div>

               <div class="form-group">

                  <label for="login-email"> <span>شهر</span> </label>

                  <select id="city" name="userLocation" class="form-control" ><?php  echo $userLocation; ?></select>

               </div>

               <div class="form-group">

                  <label for="login-email"> <span>آدرس</span> </label>

                  <input id="login-email" type="text" class="form-control" placeholder="آدرس"  name="userAddress" value="<?php echo $userAddress; ?>">

                  <p class="form-error">

                  <?php echo form_error('userAddress') ?>   

                  </p>

               </div>

               <div class="form-group">

                  <label for="login-password"> <span>رمز عبور</span> </label>

                  <input id="login-password" type="password" name="userPassword"   class="form-control" placeholder=" رمز عبور خود را وارد نمایید ">

                  <p class="form-error">

                  <?php echo form_error('userPassword') ?>

                  </p>

               </div>

               <div class="form-group">

                  <label for="login-email"> <span>تکرار رمز عبور </span> </label>

                  <input id="login-email" type="password" name="passwordRetry" class="form-control" placeholder=" شماره موبایل خود را وارد نمایید">

                  <p class="form-error">

                  <?php echo form_error('passwordRetry') ?>

                  </p>

               </div>

               <div class="form-group">

                  <button type="submit" name="signup" value="signup" class="btn btn-block btn-login"> ثبت نام در بیک  </button>

               </div>

            </form>

         </div>

      </div>