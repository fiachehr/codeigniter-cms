

<?php 
   $mailAddr = set_value('');
   $subject = set_value('');
   $content = set_value('');
   
   if($dataRegister == "TRUE"){	
   	
   	$mailAddr = set_value('');
   	$subject = set_value('');
   	$content = set_value('');	
   	echo "<script>alert('پیام شما ارسال گردید.')</script>";
   	
   }elseif($dataRegister == "FALSE" ){
   	
   	 echo "<script>alert('پیام شما ارسال نگردید.')</script>";
   	$mailAddr = set_value('mailAddr',$this->input->post('mailAddr'));
   	$subject = set_value('subject',$this->input->post('subject'));
   	$content = set_value('content',$this->input->post('content'));
   	
   }
   
    ?>			
         <?php
            $phone = "";
            $email = "";
            $addr = "";
            $mobile = "";
            
            
            foreach($contactInfo as $rows){
               if($rows['contactType'] == "email"){
                  $email .= "<option value=\"".$rows['contactValue']."\">".$rows['contactValue']."</option>";
               }
               if($rows['contactType'] == "phone" ){
                  $phone .= "<div class=\"form-group\"><span>".$rows['contactTitle']."</span>".$rows['contactValue']."</div></div>";
               }
               if($rows['contactType'] == "address"){
                  $addr .= "<div class=\"contact-info\"><div class=\"contact-info-title\">".$rows['contactTitle']."</div>
                            <div class=\"contact-info-info\">".$rows['contactValue']." </div></div>";
               }
               if($rows['contactType'] == "mobile"){
                  $mobile .= "<div class=\"contact-info\"><div class=\"contact-info-title\">".$rows['contactTitle']."</div>
                              <div class=\"contact-info-info\">".$rows['contactValue']."</div></div>";
               }
              
            }
            ?>
         <div class="form-wrapper">
            <div class="form-logo">
               <a href="">
               <img src="<?=base_url();?>assets/site/images/logo.png" alt="">
               </a>
            </div>
            <div class="form-box">
               <form action="<?php echo base_url();?>agotd/contact"  method="post">
                  <h3>   ارتباط با  <span>بیک</span> </h3>
                  <div class="form-group">
                     <label for="login-email"> <span>آدرس ایمیل</span> </label>
                     <input name="mailAddr" id="mailAddr" value="<?php echo $mailAddr;?>" class="form-control" placeholder="ایمیل  را وارد نمایید">
                     <p class="form-error">
                        <?php echo form_error('mailAddr') ?>
                     </p>
                  </div>
                  <div class="form-group">
                     <label for="login-email"> <span>ارسال به</span> </label>
                     <select id="to" name="to" class="form-control" >
                     <?=$email;?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="login-email"> <span>موضوع پیام</span> </label>
                     <input name="subject" id="subject" value="<?php echo $subject;?>" class="form-control" placeholder="موضوع پیام را وارد نمایید">
                     <p class="form-error">
                        <?php echo form_error('subject') ?>
                     </p>
                  </div>
                  <div class="form-group">
                     <label for="login-email"> <span>متن پیام</span> </label>
                     <textarea name="content" id="content" class="form-control"  cols="20" rows="5"><?php echo $content;?></textarea>
                     <p class="form-error">
                        <?php echo form_error('content') ?>
                     </p>
                  </div>
                  <div class="form-group">
                     <label for="login-email"> <span>کد امنیتی</span> </label>
                     <input name="captcha" type="text" autocomplete="off" class="form-control" placeholder="کد امنیتی">
                     <p class="form-error">
                        <?php echo form_error('subject') ?>
                     </p>
                  </div>
                  <div class="form-group">
                     <label for="login-email"></label>
                     <?php echo $captchaImg; ?>
                     <p class="form-error">
                     <?php echo form_error('captcha') ?>
                     <?php echo $captchaError;?>
                     </p>
                  </div>
                  <div class="form-group">
                     <button type="submit" name="signup" value="signup" class="btn btn-block btn-login"> ارسال پیام  </button>
                  </div>
               </form>
            </div>
            <div class="form-box">
            <?=$addr.$phone.$mobile;?>
            </div>
         </div>
         <!--
         <div class="col-md-10 col-md-pull-1 col-sm-12 col-sm-pull-0 col-xs-12 col-xs-pull-0">
            <?=$addr.$phone.$mobile;?>
            <form class="form" action="<?php echo base_url();?>agotd/contact" method="post">
               <div class="form-detail-info">
                  <div class="form-detail-title">آدرس ایمیل</div>
                  <div class="form-detail-info-in">
                     <select name="to">
                     <?=$email;?>
                     </select>
                  </div>
               </div>
               <div class="form-detail-info">
                  <div class="form-detail-title">موضوع پیام </div>
                  <div class="form-detail-info-in"><input type="text" name="subject" id="subject" type="text"  value="<?php echo $subject;?>" /></div>
                  <div class="form-detail-error">
                     <?php echo form_error('subject') ?>
                  </div>
               </div>
               <div class="form-detail-info">
                  <div class="form-detail-title">متن پیام</div>
                  <div class="form-detail-info-in">
                     <textarea name="content" id="content"  cols="20" rows="5"><?php echo $content;?></textarea>
                  </div>
                  <div class="form-detail-error">
                     <?php echo form_error('content') ?>
                  </div>
               </div>
               <div class="form-detail-info">
                  <div class="form-detail-title">کد امنیتی </div>
                  <div class="form-detail-info-in">
                     <input name="captcha" type="text" autocomplete="off" />
                     <br/><br/>
                     <?php echo $captchaImg; ?>
                  </div>
                  <div class="form-detail-error">
                  </div>
               </div>
               <button class="btn btn-color2" type="submit" name="submit" value="submit">ارسال</button>
            </form>
         </div>
      </div>
   </div>
</section>

-->

