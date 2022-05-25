<?php
   $phone = "";
   $email = "";
   $addr = "";
   $google = "";
   $twitter = "";
   $facebook = "";
   $insta = "";
   $linkedin = "";
   $youtube = "";

   foreach($contactInfo as $rows){
      if($rows['contactType'] == "email" && $email == ''){
         $email = $rows['contactValue'];
      }
      if($rows['contactType'] == "phone" && $phone == ''){
         $phone = $rows['contactValue'];
      }
      if($rows['contactType'] == "address" && $addr == ''){
         $addr = $rows['contactValue'];
      }
      if($rows['contactType'] == "sn-google" && $google == ''){
         $google = $rows['contactValue'];
      }
      if($rows['contactType'] == "sn-twitter" && $twitter == ''){
         $twitter = $rows['contactValue'];
      }
      if($rows['contactType'] == "sn-facebook" && $facebook == ''){
         $facebook = $rows['contactValue'];
      }
      if($rows['contactType'] == "sn-instagram" && $insta == ''){
         $insta = $rows['contactValue'];
      }
      if($rows['contactType'] == "sn-linkedin" && $linkedin == ''){
         $linkedin = $rows['contactValue'];
      }
      if($rows['contactType'] == "sn-youtube" && $youtube == ''){
         $youtube = $rows['contactValue'];
      }
   }


?>

<!-- start footer -->
<div id="footer">
   <section id="footer-mid">
      <div class="container">
         <div class="row">
            <div class="col-md-6 col-xs-12">
               <div class="title">
                  <h4 class="text-right">وبلاگ</h4>
               </div>
               <ul class="footer-links-blogs ">
               <?php
                  $counter = 1;
                  foreach($topNews as $rows){
                     echo "<li><a href=\"".base_url()."newsView/".$rows['newsCode']."/".str_replace(" ","-",$rows['newsTitle'])."\"><img src=\"".base_url()."assets/uploads/news_sm/".$rows['newsGUID']."--0.jpg\"></a><a href=\"".base_url()."newsView/".$rows['newsCode']."/".str_replace(" ","-",$rows['newsTitle'])."\">".word_limiter($rows['newsTitle'],4)."</a></li>";
                     $counter++;
                     if($counter == 3){
                        break;
                     }
                  }
                  ?>
               </ul>
            </div>
            <div class="col-md-6 col-xs-12">
               <div class="title">
                  <h4 class="text-right">تماس با ما</h4>
               </div>
               <div id="footer-contact">
                  <div id="footer-contact-info">
                     <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           <div class="footer-contact-info">
                              <span class="footer-contact-info-title">تلفن : </span>
                              <span class="footer-contact-info-text text-right text-sm-left"><?=$phone;?></span>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           <div class="footer-contact-info">
                              <span class="footer-contact-info-title">ایمیل : </span>
                              <span class="footer-contact-info-text text-left"><?=$email;?></span>
                           </div>
                        </div>
                     </div>
                     <div class="footer-contact-info">
                        <span class="footer-contact-info-title">آدرس : </span>
                        <span class="footer-contact-info-text text-justify"><?=$addr;?> </span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section  id="footer-social">
      <ul>
         <li><a href="<?=$insta;?>"><i class="fab fa-instagram"></i></a></li>
         <li><a href="<?=$facebook;?>"><i class="fab fa-facebook-f"></i></a></li>
         <li><a href="<?=$twitter;?>"><i class="fab fa-twitter"></i></a></li>
         <li><a href="<?=$google;?>"><i class="fab fa-google-plus-g"></i></a></li>
         <li><a href="<?=$linkedin;?>"><i class="fab fa-linkedin"></i></a></li>
         <li><a href="<?=$youtube;?>"><i class="fab fa-youtube"></i></a></li>
      </ul>
   </section>
   <section id="footer-copy">
      <div class="container">
         <div class="row">
            <div class="col-md-4 col-md-pull-2 col-xs-6 ">طراحی شده توسط <a href="http://www.ago.ir">گسترش فناوری آگو </a></div>
            <div class="col-md-4 col-md-pull-2 col-xs-6">
               <p class="text-left">تمامی حقوق محفوظ است &copy; <?=date("Y");?></p>
            </div>
         </div>
      </div>
   </section>
</div>
<!-- end footer -->
<script src="https://maps.google.com/maps/api/js?sensor=false&amp;libraries=geometry&amp;v=3.22"></script>
<script >
   $(document).ready(function() {
   
       var owl = $('.owl-carousel');
       owl.owlCarousel({
           rtl: true,
           margin: 10,
           nav: true,
           dots:true,
           loop: true,
           navText: ["<i class='fas fa-angle-right'></i>","<i class='fas fa-angle-left'></i>"],
           responsive: {
               0: {
                   items: 1
               },
               480: {
                   items: 2
               },
               600: {
                   items: 3
               },
               1000: {
                   items: 4
               }
           }
       })
   })
   
</script>
<script src="<?=base_url();?>assets/site/js/main.js"></script>
<script src="<?=base_url();?>assets/site/js/libs.min.js"></script>
<script src="<?=base_url();?>assets/site/js/maplace.js"></script>
<script src="<?=base_url();?>assets/site/js/app.js"></script>
<script src="<?=base_url();?>assets/site/js/bootstrap.min.js"></script>
</body>
</html>

