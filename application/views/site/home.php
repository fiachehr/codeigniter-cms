

<?php 
   $counter = 0;
   $number = null;
   $slide = null;
   $link = null;
   foreach($slider as $rows){
      if($rows['sliderURL'] != null){
         $link =  "<a href=\"".$rows['sliderURL']."\" class=\"slider-link\">
                      مشاهده بیشتر
                  </a>";
      }
      if($counter == 0){
         $slide .= "<div class=\"carousel-item active\">";
         $number .= "<li data-target=\"#carouselExampleIndicators\" data-slide-to=\"".$counter."\" class=\"active\"></li>";
      }else{
         $slide .= "<div class=\"carousel-item\">";
         $number .= "<li data-target=\"#carouselExampleIndicators\" data-slide-to=\"".$counter."\"></li>";
      }
      $slide .=  "<img class=\"d-block w-100\" src=\"".base_url()."assets/uploads/slider/".$rows['sliderImg']."\" alt=\"".$rows['sliderTitle']."\">
                     <div class=\"carousel-caption d-none d-md-block\">
                        <h3>".$rows['sliderTitle']."</h3>
                        ".$link."
                     </div>
                  </div>";
      $counter++;
   }
   ?>
<!-- main slider index -->
<div class="main-slider">
   <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
         <?=$number;?>
      </ol>
      <div class="carousel-inner">
         <?=$slide;?>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
      </a>
   </div>
</div>
<!-- nav our features -->
<!-- <nav class="index-feature">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <ul>
               <li>
                  <a href="">
                  <i class="fa fa-truck"></i>
                  <span class="feature-text">
                  <span>ارسال رایگان</span>
                  <span>برای خرید های بالای 100هزار تومان</span>
                  </span>
                  </a>
               </li>
               <li>
                  <a href="">
                  <i class="fa fa-credit-card"></i>
                  <span class="feature-text">
                  <span> پرداخت در محل </span>
                  <span> در شهر تهران </span>
                  </span>
                  </a>
               </li>
               <li>
                  <a href="">
                  <i class="fa fa-certificate"></i>
                  <span class="feature-text">
                  <span> اصالت کالا </span>
                  <span> ضمانت اصل بودن تمام کالا ها </span>
                  </span>
                  </a>
               </li>
               <li>
                  <a href="">
                  <i class="">7</i>
                  <span class="feature-text">
                  <span> تعویض کالا </span>
                  <span> تا 7 روز در صورت داشتن مشکل </span>
                  </span>
                  </a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</nav> -->
<main class="index-main">
   <!-- most popular section -->
   <div class="most-popular-wrapper">
      <div class="container">
         <section class="most-popular">
            <!-- most popular header -->
            <div class="most-popular-header">
               <div class="most-popular-title">
                  <span>محبوب ترین ها</span>
                  <span>
                  ( عطر زنانه )
                  </span>
               </div>
               <ul class="choose-popular-title">
                  <li class="choosed-popular" data-popular-choose="woman">
                     <i class="fa fa-female"></i>
                     <span> عطر زنانه </span>
                  </li>
                  <li data-popular-choose="man">
                     <i class="fa fa-male"></i>
                     <span> عطر مردانه </span>
                  </li>
                  <li data-popular-choose="sanitary">
                     <i class="fa fa-leaf"></i>
                     <span> محصولات آرایشی و بهداشتی</span>
                  </li>
               </ul>
            </div>
            <!-- most popular main -->
            <div class="most-popular-main">
               <!-- most popular any section -->
               <div class="most-popular-main-in most-popular-main-in-selected" data-popular-choose="woman">
                  <div class="row align-items-start">
                     <?php
                        if(count($femaleTopProduct) > 0){
                           foreach($femaleTopProduct as $rows){
                              $discout = null;
                              $fee = $rows['productPrice'];
                              $amount = number_format($rows['productPrice']);
                              if($rows['productDicount'] > 0){
                                 $discout = "<span class=\"new-price\">".number_format($rows['productPrice'] - ($rows['productPrice'] * ($rows['productDicount'] / 100)))."</span>";
                                 $fee = $rows['productPrice'] - ($rows['productPrice'] * ($rows['productDicount'] / 100));
                              }
                              echo "<div class=\"col-md-6 col-lg-3\">
                                       <div class=\"product-wrapper\">
                                          <figure>
                                             <a href=\"".base_url()."Product/productView/".$rows['productCode']."/".str_replace(" ","-",$rows['productTitle'])."\">
                                                <img src=\"".base_url()."assets/uploads/product/".$rows['productGUID']."--0.jpg\" alt=\"".$rows['productTitle']."\">
                                             </a>
                                          </figure>
                                          <h3 class=\"mb-0\">
                                             <a href=\"".base_url()."Product/productView/".$rows['productCode']."/".str_replace(" ","-",$rows['productTitle'])."\" data-id=\"".$rows['productGUID']."\">".$rows['productTitle']."</a>
                                          </h3>
                                          <p>
                                             ".$discout."
                                             <span class=\"orginal-price\">".$amount."</span>
                                          </p>
                                          <div class=\"add-to-cart\">
                                             <a href=\"\" data-id=\"".$rows['productGUID']."\" data-code=\"".$rows['productCode']."\" data-weight=\"".$rows['productWeight']."\" data-title=\"".$rows['productTitle']."\" data-fee=\"".$fee."\" >اضافه به سبد</a>
                                          </div>
                                       </div>
                                    </div>";
                           }
                        }
                        ?>
                  </div>
               </div>
               <div class="most-popular-main-in" data-popular-choose="man">
                  <div class="row align-items-start">
                     <?php
                        if(count($maleTopProduct) > 0){
                           foreach($maleTopProduct as $rows){
                              $discout = null;
                              $fee = $rows['productPrice'];
                              $amount = number_format($rows['productPrice']);
                              if($rows['productDicount'] > 0){
                                 $discout = "<span class=\"new-price\">".number_format($rows['productPrice'] - ($rows['productPrice'] * ($rows['productDicount'] / 100)))."</span>";
                                 $fee = $rows['productPrice'] - ($rows['productPrice'] * ($rows['productDicount'] / 100));
                              }
                              echo "<div class=\"col-md-6 col-lg-3\">
                                       <div class=\"product-wrapper\">
                                          <figure>
                                             <a href=\"".base_url()."Product/productView/".$rows['productCode']."/".str_replace(" ","-",$rows['productTitle'])."\">
                                                <img src=\"".base_url()."assets/uploads/product/".$rows['productGUID']."--0.jpg\" alt=\"".$rows['productTitle']."\">
                                             </a>
                                          </figure>
                                          <h3 class=\"mb-0\">
                                             <a href=\"".base_url()."Product/productView/".$rows['productCode']."/".str_replace(" ","-",$rows['productTitle'])."\" data-id=\"".$rows['productGUID']."\">".$rows['productTitle']."</a>
                                          </h3>
                                          <p>
                                             ".$discout."
                                             <span class=\"orginal-price\">".$amount."</span>
                                          </p>
                                          <div class=\"add-to-cart\">
                                          <a href=\"\" data-id=\"".$rows['productGUID']."\" data-code=\"".$rows['productCode']."\" data-weight=\"".$rows['productWeight']."\" data-title=\"".$rows['productTitle']."\" data-fee=\"".$fee."\" >اضافه به سبد</a>
                                          </div>
                                       </div>
                                    </div>";
                           }
                        }
                        ?>
                  </div>
               </div>
               <div class="most-popular-main-in" data-popular-choose="sanitary">
                  <div class="row align-items-start">
                     <?php
                        if(count($topHealthyProduct) > 0){
                           foreach($topHealthyProduct as $rows){
                              $discout = null;
                              $fee = $rows['productPrice'];
                              $amount = number_format($rows['productPrice']);
                              if($rows['productDicount'] > 0){
                                 $discout = "<span class=\"new-price\">".number_format($rows['productPrice'] - ($rows['productPrice'] * ($rows['productDicount'] / 100)))."</span>";
                                 $fee = $rows['productPrice'] - ($rows['productPrice'] * ($rows['productDicount'] / 100));
                              }
                              echo "<div class=\"col-md-6 col-lg-3\">
                                       <div class=\"product-wrapper\">
                                          <figure>
                                             <a href=\"".base_url()."Product/productView/".$rows['productCode']."/".str_replace(" ","-",$rows['productTitle'])."\">
                                                <img src=\"".base_url()."assets/uploads/product/".$rows['productGUID']."--0.jpg\" alt=\"".$rows['productTitle']."\">
                                             </a>
                                          </figure>
                                          <h3 class=\"mb-0\">
                                             <a href=\"".base_url()."Product/productView/".$rows['productCode']."/".str_replace(" ","-",$rows['productTitle'])."\" data-id=\"".$rows['productGUID']."\">".$rows['productTitle']."</a>
                                          </h3>
                                          <p>
                                             ".$discout."
                                             <span class=\"orginal-price\">".$amount."</span>
                                          </p>
                                          <div class=\"add-to-cart\">
                                          <a href=\"\" data-id=\"".$rows['productGUID']."\" data-code=\"".$rows['productCode']."\" data-weight=\"".$rows['productWeight']."\" data-title=\"".$rows['productTitle']."\" data-fee=\"".$fee."\" >اضافه به سبد</a>
                                          </div>
                                       </div>
                                    </div>";
                           }
                        }
                        ?>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>
   <!-- index any product parent -->
   <div class="index-any-product-sections index-any-product-sections-woman">
   <div class="container">
      <div class="any-product-background"><img src="<?=$paralax1Img;?>"></div>
                     </div>
      <div class="any-product-title">
         <div class="container">
            <div class="row">
               <div class="any-product-title-inner">
                  <div class="any-product-title-right">
                     <i class="fa fa-female"></i>
                     <h3>
                        <span>Women's Perfume</span>
                        <span>عطرهای زنانه</span>
                     </h3>
                  </div>
                  <a href="https://bicyar.com/Product/ProductArchive/35/%D9%85%D8%AD%D8%B5%D9%88%D9%84%D8%A7%D8%AA/%D8%B9%D8%B7%D8%B1-%D8%A8%D8%A7%D9%86%D9%88%D8%A7%D9%86/0" class="any-product-more">
                        مشاهده همه محصولات عطر زنانه
                  </a>
               </div>
            </div>
         </div>
      </div>
      <div class="any-product-products">
         <div class="container">
            <div class="row align-items-start">
               <?php
                  if(count($femaleProduct) > 0){
                     foreach($femaleProduct as $rows){
                        $discout = null;
                        $fee = $rows['productPrice'];
                        $amount = number_format($rows['productPrice']);
                        if($rows['productDicount'] > 0){
                           $discout = "<span class=\"new-price\">".number_format($rows['productPrice'] - ($rows['productPrice'] * ($rows['productDicount'] / 100)))."</span>";
                           $fee = $rows['productPrice'] - ($rows['productPrice'] * ($rows['productDicount'] / 100));
                        }
                        echo "<div class=\"col-md-6 col-lg-3\">
                                 <div class=\"product-wrapper\">
                                    <figure>
                                       <a href=\"".base_url()."Product/productView/".$rows['productCode']."/".str_replace(" ","-",$rows['productTitle'])."\">
                                          <img src=\"".base_url()."assets/uploads/product/".$rows['productGUID']."--0.jpg\" alt=\"".$rows['productTitle']."\">
                                       </a>
                                    </figure>
                                    <h3 class=\"mb-0\">
                                       <a href=\"".base_url()."Product/productView/".$rows['productCode']."/".str_replace(" ","-",$rows['productTitle'])."\" data-id=\"".$rows['productGUID']."\">".$rows['productTitle']."</a>
                                    </h3>
                                    <p>
                                       ".$discout."
                                       <span class=\"orginal-price\">".$amount."</span>
                                    </p>
                                    <div class=\"add-to-cart\">
                                    <a href=\"\" data-id=\"".$rows['productGUID']."\" data-code=\"".$rows['productCode']."\" data-weight=\"".$rows['productWeight']."\" data-title=\"".$rows['productTitle']."\" data-fee=\"".$fee."\" >اضافه به سبد</a>
                                    </div>
                                 </div>
                              </div>";
                     }
                  }
                  ?>
            </div>
         </div>
      </div>
   </div>
   <!-- index any product parent -->
   <div class="index-any-product-sections index-any-product-sections-man">
      <div class="container">
         <div class="any-product-background">
            <img src="<?=$paralax2Img;?>">
         </div>
         </div>
         <div class="any-product-title">
            <div class="container">
               <div class="row">
                  <div class="any-product-title-inner">
                     <div class="any-product-title-right">
                        <i class="fa fa-male"></i>
                        <h3>
                           <span>Men's Perfume</span>
                           <span>عطرهای مردانه</span>
                        </h3>
                     </div>
                     <a href="https://bicyar.com/Product/ProductArchive/36/%D9%85%D8%AD%D8%B5%D9%88%D9%84%D8%A7%D8%AA/%D8%B9%D8%B7%D8%B1-%D9%85%D8%B1%D8%AF%D8%A7%D9%86%D9%87/0" class="any-product-more">
                        مشاهده همه محصولات عطر مردانه
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="any-product-products">
            <div class="container">
               <div class="row align-items-start">
                  <?php
                     if(count($maleProduct) > 0){
                        foreach($maleProduct as $rows){
                           $discout = null;
                           $fee = $rows['productPrice'];
                           $amount = number_format($rows['productPrice']);
                           if($rows['productDicount'] > 0){
                              $discout = "<span class=\"new-price\">".number_format($rows['productPrice'] - ($rows['productPrice'] * ($rows['productDicount'] / 100)))."</span>";
                              $fee = $rows['productPrice'] - ($rows['productPrice'] * ($rows['productDicount'] / 100));
                           }
                           echo "<div class=\"col-md-6 col-lg-3\">
                                    <div class=\"product-wrapper\">
                                       <figure>
                                          <a href=\"".base_url()."Product/productView/".$rows['productCode']."/".str_replace(" ","-",$rows['productTitle'])."\">
                                             <img src=\"".base_url()."assets/uploads/product/".$rows['productGUID']."--0.jpg\" alt=\"".$rows['productTitle']."\">
                                          </a>
                                       </figure>
                                       <h3 class=\"mb-0\">
                                          <a href=\"".base_url()."Product/productView/".$rows['productCode']."/".str_replace(" ","-",$rows['productTitle'])."\" data-id=\"".$rows['productGUID']."\">".$rows['productTitle']."</a>
                                       </h3>
                                       <p>
                                          ".$discout."
                                          <span class=\"orginal-price\">".$amount."</span>
                                       </p>
                                       <div class=\"add-to-cart\">
                                       <a href=\"\" data-id=\"".$rows['productGUID']."\" data-code=\"".$rows['productCode']."\" data-weight=\"".$rows['productWeight']."\" data-title=\"".$rows['productTitle']."\" data-fee=\"".$fee."\" >اضافه به سبد</a>
                                       </div>
                                    </div>
                                 </div>";
                        }
                     }
                     ?>
               </div>
            </div>
         </div>
      </div>

      <div class="index-any-product-sections index-any-product-sections-man">
      <div class="container">
         <div class="any-product-background">
            <img src="<?=$paralax3Img;?>">
         </div>
         </div>
         <div class="any-product-title">
            <div class="container">
               <div class="row">
                  <div class="any-product-title-inner">
                     <div class="any-product-title-right">
                        <i class="fa fa-male"></i>
                        <h3>
                           <span>Sport Perfume</span>
                           <span>عطرهای اسپرت</span>
                        </h3>
                     </div>
                     <a href="https://bicyar.com/Product/ProductArchive/37/%D9%85%D8%AD%D8%B5%D9%88%D9%84%D8%A7%D8%AA/%D8%B9%D8%B7%D8%B1-%D8%A7%D8%B3%D9%BE%D8%B1%D8%AA/0" class="any-product-more">
                        مشاهده همه محصولات عطر اسپرت
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="any-product-products">
            <div class="container">
               <div class="row align-items-start">
                  <?php
                     if(count($sportProduct) > 0){
                        foreach($sportProduct as $rows){
                           $discout = null;
                           $fee = $rows['productPrice'];
                           $amount = number_format($rows['productPrice']);
                           if($rows['productDicount'] > 0){
                              $discout = "<span class=\"new-price\">".number_format($rows['productPrice'] - ($rows['productPrice'] * ($rows['productDicount'] / 100)))."</span>";
                              $fee = $rows['productPrice'] - ($rows['productPrice'] * ($rows['productDicount'] / 100));
                           }
                           echo "<div class=\"col-md-6 col-lg-3\">
                                    <div class=\"product-wrapper\">
                                       <figure>
                                          <a href=\"".base_url()."Product/productView/".$rows['productCode']."/".str_replace(" ","-",$rows['productTitle'])."\">
                                             <img src=\"".base_url()."assets/uploads/product/".$rows['productGUID']."--0.jpg\" alt=\"".$rows['productTitle']."\">
                                          </a>
                                       </figure>
                                       <h3 class=\"mb-0\">
                                          <a href=\"".base_url()."Product/productView/".$rows['productCode']."/".str_replace(" ","-",$rows['productTitle'])."\" data-id=\"".$rows['productGUID']."\">".$rows['productTitle']."</a>
                                       </h3>
                                       <p>
                                          ".$discout."
                                          <span class=\"orginal-price\">".$amount."</span>
                                       </p>
                                       <div class=\"add-to-cart\">
                                       <a href=\"\" data-id=\"".$rows['productGUID']."\" data-code=\"".$rows['productCode']."\" data-weight=\"".$rows['productWeight']."\" data-title=\"".$rows['productTitle']."\" data-fee=\"".$fee."\" >اضافه به سبد</a>
                                       </div>
                                    </div>
                                 </div>";
                        }
                     }
                     ?>
               </div>
            </div>
         </div>
      </div>
   <!-- index any product parent -->
   <div class="index-any-product-sections index-any-product-sections-sanitary">
   <div class="container">
      <div class="any-product-background">
      <img src="<?=$paralax4Img;?>">
   </div>
   </div>
      <div class="any-product-title">
         <div class="container">
            <div class="row">
               <div class="any-product-title-inner">
                  <div class="any-product-title-right">
                     <i class="fa fa-leaf"></i>
                     <h3>
                        <span>Sanitary Ware</span>
                        <span> محصولات آرایشی و بهداشتی</span>
                     </h3>
                  </div>
                  <a href="https://bicyar.com/Product/ProductArchive/33/%D9%85%D8%AD%D8%B5%D9%88%D9%84%D8%A7%D8%AA/%D8%B9%D8%B7%D8%B1-%D8%A7%D8%B3%D9%BE%D8%B1%D8%AA/0" class="any-product-more">
                        مشاهده همه محصولات آرایشی و بهداشتی
                     </a>
               </div>
            </div>
         </div>
      </div>
      <div class="any-product-products">
         <div class="container">
            <div class="row align-items-start">
               <?php
                  if(count($healthyProduct) > 0){
                     foreach($healthyProduct as $rows){
                        $discout = null;
                        $fee = $rows['productPrice'];
                        $amount = number_format($rows['productPrice']);
                        if($rows['productDicount'] > 0){
                           $discout = "<span class=\"new-price\">".number_format($rows['productPrice'] - ($rows['productPrice'] * ($rows['productDicount'] / 100)))."</span>";
                           $fee = $rows['productPrice'] - ($rows['productPrice'] * ($rows['productDicount'] / 100));
                        }
                        echo "<div class=\"col-md-6 col-lg-3\">
                                 <div class=\"product-wrapper\">
                                    <figure>
                                       <a href=\"".base_url()."Product/productView/".$rows['productCode']."/".str_replace(" ","-",$rows['productTitle'])."\">
                                          <img src=\"".base_url()."assets/uploads/product/".$rows['productGUID']."--0.jpg\" alt=\"".$rows['productTitle']."\">
                                       </a>
                                    </figure>
                                    <h3 class=\"mb-0\">
                                       <a href=\"".base_url()."Product/productView/".$rows['productCode']."/".str_replace(" ","-",$rows['productTitle'])."\" data-id=\"".$rows['productGUID']."\">".$rows['productTitle']."</a>
                                    </h3>
                                    <p>
                                       ".$discout."
                                       <span class=\"orginal-price\">".$amount."</span>
                                    </p>
                                    <div class=\"add-to-cart\">
                                    <a href=\"\" data-id=\"".$rows['productGUID']."\" data-code=\"".$rows['productCode']."\" data-weight=\"".$rows['productWeight']."\" data-title=\"".$rows['productTitle']."\" data-fee=\"".$fee."\" >اضافه به سبد</a>
                                    </div>
                                 </div>
                              </div>";
                     }
                  }
                  ?>
            </div>
         </div>
      </div>
   </div>
</main>
<section class="last-articles">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="index-news-title">
               <div> آخرین مطالب</div>
               <a href="https://bicyar.com/news/newsArchive/64/%D9%88%D8%A8%D9%84%D8%A7%DA%AF/0">
               مشاهده همه مطالب
               </a>
            </div>
            <div class="index-news-wrapper">
               <?php
                  if(count($lastNews) > 0){
                     foreach($lastNews as $rows){
                       
                        echo "<div class=\"col-lg-3 col-md-6\">
                                 <div class=\"index-news\">
                                    <figure>
                                       <a href=\"".base_url()."News/newsShow/".$rows['newsCode']."/".str_replace(" ","-",$rows['newsTitle'])."\">
                                       <img src=\"".base_url()."assets/uploads/news/".$rows['newsGUID']."--0.jpg\" alt=\"".$rows['newsTitle']."\">
                                       </a>
                                    </figure>
                                    <a href=\"".base_url()."News/newsShow/".$rows['newsCode']."/".str_replace(" ","-",$rows['newsTitle'])."\">".$rows['newsTitle']."</a>
                                    <p class=\"news-summery\">".word_limiter($rows['newsSummery'],10)."</p>
                                 </div>
                              </div>";
                     }
                  }
                  ?>
            </div>
         </div>
      </div>
   </div>
   </div>
</section>
<?php
if($board != null){
?>

<!-- its modal -->
 <div class="glass-modal">
    <div class="glass-modal-image">
        <img src="<?=base_url();?>assets/uploads/board/<?=$board['boardImg'];?>" alt="<?=$board['boardTitle'];?>">
    </div>
    <div class="glass-modal-close">
        <i class="fa fa-times"></i>
    </div>
</div> 
<?php } ?>

