<main>
        <div class="container">
            <div class="cart-wrapper">
            <?php
                  foreach ($this->cart->contents() as $cartRow) {

                        echo "<div class=\"any-cart\">
                                 <div class=\"any-cart-image\">
                                    <a href=\"" . base_url() . "product/productShow/" . $cartRow['code'] . "/".$cartRow['name']."\">
                                       <img src=\"".base_url()."assets/uploads/product/".$cartRow['id']."--0.jpg\" alt=\"" . $cartRow['name'] . "\">
                                    </a>
                                 </div>
                                 <div class=\"any-cart-title\">
                                    <h5>
                                       <a href=\"" . base_url() . "product/productShow/" . $cartRow['code'] . "/".$cartRow['name']."\">".$cartRow['name']."</a>
                                    </h5>
                                 </div>
                                 <div class=\"any-cart-counter\">
                                    <span> تعداد </span>
                                    <div class=\"any-cart-counter-box\">
                                       <input type=\"text\" id=\"form-".$cartRow['rowid']."\" value=\"" . $cartRow['qty'] . "\">
                                       <div class=\"any-cart-counter-control\">
                                             <i class=\"fa fa-chevron-up plus-counter\"></i>
                                             <i class=\"fa fa-chevron-down minus-counter\"></i>
                                       </div>
                                    </div>
            
                                 </div>
                                 <div class=\"any-cart-price\">
                                    <div class=\"new-price\">
                                       <span>" . number_format($cartRow['subtotal']) . "</span><span>تومان</span>
                                    </div>
                                 </div>
                                 <div class=\"delete-any-cart\">
                                    <i class=\"fa fa-refresh\" data-id=\"".$cartRow['rowid']."\" id=\"update\"></i>
                                    <i class=\"fa fa-close delete-cart\" data-id=\"".$cartRow['id']."\"></i>
                                 </div>
                           </div>";
                  
                  }
					 ?>
                <div class="discount-cart">
                    <div class="discount-box">
                        <input type="text" placeholder="کد تخفیف" value="" name="giftcard" />
                        <button class="btn"> اعمال کد تخفیف </button>
                    </div>
                    <div class="discount-alert">
                        <div class="green-alert">
                            کد تخفیف اعمال شد
                        </div>
                        <div class="red-alert">
                            کد تخفیف نامعتبر می باشد
                        </div>
                    </div>
                </div>
                <div class="cart-result">
                    <div class="cart-full-price">
                        <span> مبلغ کل : </span>
                        <span class="cart-result-price"><?php echo number_format($this->cart->total()); ?> </span>
                        تومان
                    </div>
                    <div class="finish-cart">
                        <a href="<?=base_url();?>Shop/selectAddress" class="btn btn-finish-cart">
                            ادامه ثبت سفارش
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </main>