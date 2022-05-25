
<?php
$discout = null;
$fee = $productData[0]['productPrice'];
$amount = number_format($productData[0]['productPrice']);
if($productData[0]['productDicount'] > 0){
   $discout = "<span class=\"new-price\">".number_format($productData[0]['productPrice'] - ($productData[0]['productPrice'] * ($productData[0]['productDicount'] / 100)))."</span>";
   $fee = $productData[0]['productPrice'] - ($productData[0]['productPrice'] * ($productData[0]['productDicount'] / 100));
}
?>
<div class="breadcrumb-parent">
    <div class="container">
        <div class="row">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url();?>">فروشگاه اینترنتی بیک</a></li>
                <li class="breadcrumb-item"><a href="<?=base_url()."Product/category/".$productData[0]['id']."/".$productData[0]['categoryURL']."";?>"><?=$productData[0]['title'];?></a></li>
                <li class="breadcrumb-item"><a href="<?=base_url()."Product/productView/".$productData[0]['productCode']."/".$productData[0]['productTitle']."";?>"><?=$productData[0]['productTitle'];?></a></li>
            </ul>
        </div>
    </div>
</div>
<main class="full-story-main">
   <!-- full story details -->
   <div class="full-story-details">
      <div class="container">
         <div class="row">
            <div class="col-lg-4">
               <div class="full-story-image-wrapper">
                  <div class="full-story-big-image">
                  <?php 
                     $mainImage = "<img src=\"".base_url()."assets/site/images/no-image.jpg\" alt=\"".$productData[0]['productTitle']."\" />";
                     if($productData[0]['imageCount'] == 1){
                        $mainImage = "<img src=\"".base_url()."assets/uploads/product/".$productData[0]['productGUID']."--0.jpg\" alt=\"".$productData[0]['productTitle']."\" />";
                     }
                     echo $mainImage."</div>";
                     if($productData[0]['imageCount'] > 1){
                         echo  "<ul class=\"full-story-small-image\">";
                         for($i = 1 ; $i <= $productData[0]['imageCount'] ; $i++){
                             echo " <li>
                                        <img src=\"".base_url()."assets/uploads/product/".$productData[0]['productGUID']."--".$i.".jpg\" alt=\"".$productData[0]['productTitle']."\" />
                                    </li>";
                         }
                         echo "</ul>";
                     }
                    ?>
               </div>
            </div>
            <div class="col-lg-8">
               <div class="full-story-stuff-details">
                  <div class="full-story-stuff-top">
                     <div class="stuff-top-right">
                        <div class="stuff-titles">
                           <h2><?=$productData[0]['productTitle'];?></h2>
                        </div>
                        <div class="stuff-stars">
                           <ul>
                               <?php
                                for($i = 5; $i >= 1 ; $i--){
                                    if($i <= $productData[0]['productRate']){
                                        echo "<li class=\"gold-star\" data-index=\"".$i."\">
                                                <i class=\"fa fa-star-o\" ></i>
                                             </li>";
                                    }else{
                                        echo "<li data-index=\"".$i."\">
                                                <i class=\"fa fa-star-o\" ></i>
                                             </li>";
                                    }
                                }
                               ?>
                           </ul>
                        </div>
                        <div class="stuff-detail">
                           <i class="fa fa-bars"></i>
                           <span><?=$productData[0]['productFor'];?></span>
                           <span> <?=$productData[0]['productVolume'];?> میلی لیتر </span>
                        </div>
                        <div class="stuff-price">
                           <span><?=number_format($productData[0]['productPrice']);?></span>
                           <span> تومان</span>
                        </div>
                     </div>
                     <div class="stuff-top-left">
                        <div class="stuff-favorite" data-action="addToFavorite" data-action="<?=$productData[0]['productCode'];?>">
                           <i class="fa fa-heart-o"></i> 
                        </div>
                        <!-- <div class="stuff-diff">
                           <i class="fa fa-adjust"></i>
                        </div> -->
                        <div class="stuff-share">
                           <a href="" class="social-instagram">
                              <i class="fa fa-instagram"></i>
                           </a>
                        </div>
                        <div class="stuff-share">
                           <a href="" class="social-telegram">
                              <i class="fa fa-telegram"></i>
                           </a>
                        </div>
                        <div class="stuff-share">
                           <a href="" class="social-facebook">
                              <i class="fa fa-facebook"></i>
                           </a>
                        </div>
                        <div class="stuff-share">
                        <a href="" class="social-linkedin">
                           <i class="fa fa-linkedin"></i>
                        </a>
                        </div>
                     </div>
                  </div>
                  <div class="stuff-informations">
                     <h6>ویژگی محصول</h6>
                     <div class="stuff-descriptions">
                     <?=$productData[0]['productDesc'];?>
                     </div>
                  </div>
                  <div class="stuff-cart">
                     <div class="stuff-counter">
                        <i class="fa fa-plus stuff-plus"></i>
                        <span class="stuff-cart-number">2</span>
                        <i class="fa fa-minus stuff-minus"></i> 
                     </div>
                     <div class="stuff-buy-link">
                        <a href="" data-id="<?=$productData[0]['productGUID'];?>" data-code="<?=$productData[0]['productCode'];?>" data-weight="<?=$productData[0]['productWeight'];?>" data-title="<?=$productData[0]['productTitle'];?>" data-fee="<?=$fee;?>">
                        <span>اضافه به سبد خرید
                        </span><i class="fa fa-cart-plus"></i>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="full-story-information-wrapper">
      <div class="container">
         <!-- full story informations and detils -->
         <div class="row">
            <div class="col-12">
               <div class="full-story-information">
                  <div class="details selected">
                     مشخصات
                  </div>
                  <div class="users-opinion">
                     نظرات کاربران
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="full-story-information-main">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <ul class="product-info">
                    
                  <li><span>سال تولید</span> <span><?=$productData[0]['productProYear'];?></span></li>
                  <li><span>برند تولید کننده</span> <span><?=$productData[0]['productBrand'];?></span></li>
                  <?php
                    if($productData[0]['productSmellStr'] != null){
                        echo "<li><span>ساختار رایحه</span> <span>".$productData[0]['productSmellStr']."</span></li>";
                    }
                  ?>
                  <?php
                    if($productData[0]['productFRNet'] != null){
                        echo "<li><span>نت آغازین</span> <span>".$productData[0]['productFRNet']."</span></li>";
                    }
                  ?>
                  <?php
                    if($productData[0]['productMINet'] != null){
                        echo "<li><span> نت میانی</span> <span>".$productData[0]['productMINet']."</span></li>";
                    }
                  ?>
                  <?php
                    if($productData[0]['productENNet'] != null){
                        echo "<li><span>نت انتهایی</span> <span>".$productData[0]['productENNet']."</span></li>";
                    }
                  ?>
                  <?php
                    if($productData[0]['productVitamin'] != null){
                        echo "<li><span>ویتامین</span> <span>".$productData[0]['productVitamin']."</span></li>";
                    }
                  ?>
                   <?php
                    if($productData[0]['productUsage'] != null){
                        echo "<li><span>مورد استفاده</span> <span>".$productData[0]['productUsage']."</span></li>";
                    }
                  ?>
                  <?php
                    if($productData[0]['productMaterial'] != null){
                        echo "<li><span>جنس</span> <span>".$productData[0]['productMaterial']."</span></li>";
                    }
                  ?>
                  <li><span>کشور سازنده</span> <span><?=$productData[0]['productCountry'];?></span></li>
                  <li><span>شماره مجوز</span> <span><?=$productData[0]['productLicense'];?></span></li>
                  <?php
                    if($tags != null){
                        $counter = 1;
                        $tagCount = count($tags);
                        echo "<li><span>برچسبها</span> <span>";
                        foreach($tags as $tag){
                            if($tagCount > $counter){
                                echo "<a href=\"".base_url()."Category/tag/product/".str_replace(" ","-",$tag['tagTitle'])."\">".$tag['tagTitle']."</a>&nbsp;-&nbsp;";
                            }else{
                                echo "<a href=\"".base_url()."Category/tag/product/".str_replace(" ","-",$tag['tagTitle'])."\">".$tag['tagTitle']."</a>";                               
                            }
                            $counter++;
                        }
                        echo "</span></li>";
                    }
                  ?>

               </ul>
               <div class="users-opinion-box">
                  <div class="any-user-opinion">
                     <div class="any-user-opinion-title">
                        <span> فیاچهر پورمجیب </span>
                        <time>7 روز پیش</time>
                     </div>
                     <div class="any-user-opinion-description">
                        لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت
                        چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این متن به عنوان عنصری از
                        ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده
                        استفاده می نماید
                     </div>
                     <div class="any-user-opnion-replay">پاسخ به نظر</div>
                     <div class="user-replayed">
                        <div class="any-user-opinion-title">
                           <span> فیاچهر </span>
                           <time>7 روز پیش</time>
                        </div>
                        <div class="any-user-opinion-description">
                           لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در
                           صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این متن به عنوان
                           عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش
                           گرفته شده استفاده می نماید
                        </div>
                     </div>
                  </div>
                  <div class="any-user-opinion">
                     <div class="any-user-opinion-title">
                        <span> فیاچهر پورمجیب </span>
                        <time>7 روز پیش</time>
                     </div>
                     <div class="any-user-opinion-description">
                        لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت
                        چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این متن به عنوان عنصری از
                        ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده
                        استفاده می نماید
                     </div>
                     <div class="any-user-opnion-replay">پاسخ به نظر</div>
                     <div class="user-replayed">
                        <div class="any-user-opinion-title">
                           <span> فیاچهر </span>
                           <time>7 روز پیش</time>
                        </div>
                        <div class="any-user-opinion-description">
                           لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در
                           صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این متن به عنوان
                           عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش
                           گرفته شده استفاده می نماید
                        </div>
                     </div>
                  </div>
                  <div class="any-user-opinion">
                     <div class="any-user-opinion-title">
                        <span> فیاچهر پورمجیب </span>
                        <time>7 روز پیش</time>
                     </div>
                     <div class="any-user-opinion-description">
                        لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت
                        چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این متن به عنوان عنصری از
                        ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده
                        استفاده می نماید
                     </div>
                     <div class="any-user-opnion-replay">پاسخ به نظر</div>
                  </div>
                  <div class="container">
                     <div class="row">
                        <form class="user-opinion-form col-lg-8">
                           <h5>لطفا دیدگاه خود را بنویسید .</h5>
                           <div>
                              <textarea name="" id="" cols="30" rows="10"></textarea>
                              <button>ارسال دیدگاه</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- related products -->
   <div class="index-any-product-sections index-any-product-sections-man">
      <div class="container">
         <div class="any-product-background">
         <img src="<?=$paralaxImg;?>">
      </div>
      <div class="any-product-title">
         <div class="container">
            <div class="row">
               <div class="any-product-title-inner">
                  <div class="any-product-title-right">
                     <i class="fa fa-home"></i>
                     <h3>
                        <span>Perfiume</span>
                        <span>محصولات مشابه</span>
                     </h3>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="any-product-products">
         <div class="container">
            <div class="row align-items-start">
            <?php
                  if(count($relatedProduct) > 0){
                     foreach($relatedProduct as $rows){
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
   </div>
</main>

