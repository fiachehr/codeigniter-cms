<html lang="fa">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
         integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <link rel="stylesheet" href="<?=base_url();?>assets/site/styles/style.css">
      <title><?=$pageTitle;?></title>
   </head>
   <body>
      <header id="header">
         <!-- top line in header -->
         <div class="top-line">
            <div class="container">
               <div class="row">
                  <div class="col-md-6">
                     <div class="top-line-right">
                     <div class="cart-section">
                        <?php
                           if(count($this->cart->contents()) == 0){
                              echo "<div class=\"cart-button\">
                                       <i class=\"fa fa-cart-plus\"></i>
                                       <div class=\"shop-box\">
                                          <div class=\"shop-box-price\"> <span>0</span> تومان  - </div>
                                          <div class=\"shop-box-counter\"> <span>0</span> عدد  </div>
                                       </div>
                                    </div>
                                    <div class=\"cart-items-main\">
                                       <ul class=\"cart-item-wrapper\">
                                       </ul>
                                    <div class=\"cart-items-result\">
                                       <div class=\"cart-item-price\">
                                          <span>قیمت کل :</span>
                                          <div class=\"cart-items-result-price\">
                                             <span>0</span>
                                             هزار تومان
                                          </div>
                                       </div>
                                       <div class=\"cart-itmes-link\">
                                          <a href=\"".base_url()."Shop/cartView\">مشاهده سبد خرید</a>
                                          <a href=\"\">ادامه خرید</a>
                                       </div>
                                    </div>";
                           }else{
                              $totalQty = 0;
                              $totalAmount = 0;
                              $cartList = null;
                              foreach($this->cart->contents() as $cart){
                                 $totalQty += $cart['qty'];
                                 $totalAmount += $cart['subtotal'];
                                 $cartList .= "<li class=\"cart-items\" data-id=\"".$cart['id']."\">
                                                   <div class=\"cart-items-img\">
                                                      <img src=\"".base_url()."assets/uploads/product/".$cart['id']."--0.jpg\">
                                                   </div>
                                                   <div class=\"cart-item-informations\">
                                                      <div class=\"cart-item-title\">
                                                      <a href=\"".base_url()."Product/ProductShow/".$cart['code']."/".str_replace(" ","-",$cart['name'])."\">".$cart['name']."</a>
                                                      </div>
                                                      <div class=\"cart-item-price\">
                                                         <span>".$cart['price']."</span> نومان
                                                      </div>
                                                   </div>
                                                   <div class=\"cart-items-counter\">
                                                         <span>".$cart['qty']."</span>
                                                   </div>
                                                   <div class=\"delete-items\" data-id=\"".$cart['id']."\"><i class=\"fa fa-times\"></i></div> 
                                                </li>";
                              }
                           
                              echo "<div class=\"cart-button\">
                                       <i class=\"fa fa-cart-plus\"></i>
                                       <div class=\"shop-box\">
                                          <div class=\"shop-box-price\"> <span>".number_format($totalAmount)."</span> تومان  - </div>
                                          <div class=\"shop-box-counter\"> <span>".$totalQty."</span> عدد  </div>
                                       </div>
                                    </div>
                                    <div class=\"cart-items-main\">
                                       <ul class=\"cart-item-wrapper\">".$cartList."</ul>
                                       <div class=\"cart-items-result\">
                                          <div class=\"cart-item-price\">
                                             <span>قیمت کل :</span>
                                             <div class=\"cart-items-result-price\">
                                                <span>".number_format($totalAmount)."</span>
                                                 تومان
                                             </div>
                                          </div>
                                          <div class=\"cart-itmes-link\">
                                             <a href=\"".base_url()."Shop/cartView\">مشاهده سبد خرید</a>
                                             <a href=\"\">ادامه خرید</a>
                                          </div>
                                       </div>";
                           }

                        ?>
                           </div>
                        </div>
                        <div class="welcome-user">
                           <?php  if(isset($this->session->userdata['userName'])){ ?> 
                           <p>
                           <span> <?=$this->session->userdata['userName'];?> </span>عزیز به سایت <strong> بیک </strong> خوش آمدید                           </p>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="top-line-left">
                        <ul>
                           <li>
                              <a href="<?=base_url()."Shop/trackOrder";?>">پیگیری سفارش</a>
                           </li>
                           <?php  if(!isset($this->session->userdata['userName'])){ ?>
                           <li>
                              <a href="<?=base_url()."UserSM/login";?>"> ثبت نام </a>
                           </li>
                           <li>
                              <a href="<?=base_url()."UserSM/login";?>">ورود</a>
                           </li>
                           <?php }else{ ?>
                              <li>
                              <a href="<?=base_url()."UserSM/profile";?>"> پروفایل </a>
                           </li>
                           <li>
                              <a href="<?=base_url()."UserSM/logout";?>">خروج</a>
                           </li>
                           <?php } ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- mid line header incloud search and logo -->
         <div class="mid-line">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-lg-6">
                     <div class="logo-section">
                        <a href="<?=base_url();?>" class="logo">
                        <img src="<?=base_url();?>assets/site/images/logo.png" alt="لوگوی بیک">
                        </a>
                        <h1 class="mb-0">
                           <span> عطر بیک </span>
                           <span> عطر جوانی </span>
                        </h1>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="search-section">
                        <form action="">
                           <input autocomplete="off" id="search" type="text" placeholder="محصول با مطلب مورد نظر خود را جستجو کنید ...">
                           <button><i class="fa fa-search"></i></button>
                           <ul class="search-suggest"></ul>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- header navigation -->
         <nav class="header-nav">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                     <div class="menu-toggler">
                        <i class="fa fa-bars"></i>
                     </div>
                     <?=$menubar;?>
                  </div>
               </div>
            </div>
         </nav>
      </header>