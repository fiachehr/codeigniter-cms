<footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-links">
                        <h4> پیوندها </h4>
                        <ul>
                            <?php
                                if(count($link) > 0){
                                    foreach($link as $rows){
                                        echo "<li>
                                                <a href=\"".$rows['linkURL']."\">".$rows['linkTitle']."</a>
                                              </li>";
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-links">
                        <h4>جشنواره ها</h4>
                        <ul>
                            <li>
                                <a href="">نحوه شرکت در قرعه کشی</a>
                            </li>
                            <li>
                                <a href="">برندگان جشنوازه عطرهای زنانه بیک</a>
                            </li>
                            <li>
                                <a href="">سوالات متداول</a>
                            </li>
                            <li>
                                <a href="">فصل بهار</a>
                            </li>
                            <li>
                                <a href="">فصل تابستان </a>
                            </li>
                            <li>
                                <a href=""> فصل پاییز </a>
                            </li>
                            <li>
                                <a href=""> فصل زمستان </a>
                            </li>
                            <li>
                                <a href=""> جشنوارهای اخیر </a>
                            </li>
                        </ul>
                    </div>


                </div>
                <div class="col-lg-3 col-md-6">
                    <ul class="safety-partner">
                        <li>
                            <a href="">
                                <img src="<?=base_url();?>assets/site/images/footer2.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="<?=base_url();?>assets/site/images/footer3.png" alt="">
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <!-- <ul class="socials">
                        <p> ما را در شبکه های اجتماعی دنبال کنید </p>
                        <li>
                            <a href=""><i class="fa fa-telegram"></i></a>
                        </li>
                        <li>
                            <a href=""><i class="fa fa-whatsapp"></i></a>
                        </li>
                        <li>
                            <a href=""><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href=""><i class="fa fa-instagram"></i></a>
                        </li>
                    </ul> -->
                    <div class="user-mobile-footer">
                        <p>اولین نفری باشید که از جشنواره ها و تخفیف ویژه ما مطلع می شوید .</p>
                        <form>
                            <input type="text" placeholder="شماره همراه">
                            <button>ارسال</button>
                        </form>
                            <p>
                                صدای مشتری 74819-021
                            </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright">
        <p>
            از این که مطالب این سایت را با ذکر منبع منتشر می کنید ، از شما سپاسگزاریم . کلیه حقوق این وبسایت محفوظ و
            متعلق به شرکت <a href=""> عطر بیک</a> می باشد .
        </p>
    </div>

    <!-- success modal box -->
    <div class="success-add-cart">
		<div class="modalbox success col-sm-8 col-md-6 col-lg-5 center animate">
			<div class="icon">
				<span class="fa fa-check"></span>
			</div>
			<h2>با موفقیت انجام شد</h2>
			<p> محصول <span> ادکلن مردانه جدید </span> با موفقیت به سبد خرید اضافه شد .</p>
			<button type="button">بستن این پنجره</button>
</div>
</div>


    <input type="hidden" id="base_url" value="<?=base_url();?>" />
    <script src="<?=base_url();?>assets/site/scripts/jquery.js"></script>
    <script src="<?=base_url();?>assets/site/scripts/main.js"></script>
    <script src="<?=base_url();?>assets/site/scripts/cart.js"></script>
    <script src="<?=base_url();?>assets/site/scripts/carousel.min.js"></script>
</body>

</html>