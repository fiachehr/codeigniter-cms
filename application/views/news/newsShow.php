<main class="news-full-main">
      <div class="news-full-wrapper">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-4">
              <div class="news-right">
                <div class="news-right-last-news">
                  <p class="last-news-right-titles">پست های آخر</p>
                  <ul>
                    <?php
                        foreach($lastNews as $rows){
                            echo "  <li>
                                        <a class=\"last-news-img\" href=\"".base_url()."News/newsShow/".$rows['newsCode']."/".str_replace(" ","-",$rows['newsTitle'])."\">
                                            <img src=\"".base_url()."assets/uploads/news/".$rows['newsGUID']."--0.jpg\" alt=\"".$rows['newsTitle']."\">
                                        </a>
                                        <div class=\"last-news-caption\">
                                        <a cclass=\"last-news-title\" href=\"".base_url()."News/newsShow/".$rows['newsCode']."/".str_replace(" ","-",$rows['newsTitle'])."\">
                                            ".word_limiter($rows['newsTitle'],4)."
                                        </a>
                                        </div>
                                    </li>";
                        }
                    ?>
                  </ul>
                </div>
                <!-- <div class="news-right-tag-box">
                  <p class="last-news-right-titles">برچسب ها</p>
                  <div class="news-right-tag-inside">
                    <a href="">تگ اول</a>
                    <a href="">تگ دوم</a>
                    <a href="">تگ سوم</a>
                    <a href="">تگ عطرهای جدید</a>
                    <a href="">خبر </a>
                    <a href="">عطر بیک عطر جوانی </a>
                    <a href="">تگ تگ تگ تگ</a>
                  </div>
                </div> -->
              </div>
            </div>
            <div class="col-lg-8 col-md-8">
              <div class="news-left">
                <div>
                  <img class="img-fluid" src="<?=base_url()."assets/uploads/news/".$news[0]['newsGUID']."--0.jpg";?>" alt="<?=$news[0]['title'];?>" />
                </div>
                <div class="news-title-box">
                  <div class="news-title-category">
                    <?=$news[0]['title'];?>
                  </div>
                  <div class="news-title-title">
                    <div class="ro-title col-lg-12 col-md-12"><?=$news[0]['newsRTitle'];?></div>
                    <h1><?=$news[0]['newsTitle'];?></h1>
                    <div class="so-title col-lg-12 col-md-12"><?=$news[0]['newsSoTitle'];?></div>
                    <div>
                      <?php
                            $this->load->helper("pdate");
                            $articleDate = greToJal($news[0]['newsRegDate']);
                            $greDate = $news[0]['newsRegDate'];
                            $monthName = getNameDate(substr($articleDate,5,2),"M");
                            $mounthDay = substr($articleDate,8,2);
                            $year =  substr($articleDate,0,4);
                            $time = substr($greDate,11,5);
                            $dayName = getNameDate(date('D', strtotime($greDate)),"D");

                            echo  "<time class=\"text-secondary\">
                                    <i class=\"fa fa-calendar\"></i>
                                    <span> ".$dayName."،</span>
                                    <span>".$mounthDay." ".$monthName." ".$year." ،</span>
                                    <span>".$time."</span></time>";

                        ?>
                      <div class="news-author">
                        <i class="fa fa-pencil"></i>
                        <span><?=$news[0]['newsArthur'];?> </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="news-title-article">
                  <p>
                  <?=$news[0]['newsSummery'];?>
                  </p>
                  <?=$news[0]['newsBody'];?>
                </div>
                <div class="news-footer">
                  <!-- <div class="news-source">
                    <span>منبع</span>
                    <a href="">گوگل</a>
                  </div> -->
                  <div class="news-tag">
                    <span>برچسب</span>
                    <?php
                        if(count($newsTag) > 0){
                            foreach($newsTag as $tag){
                                echo "<a href=\"".base_url()."Category/tag/product/".str_replace(" ","-",$tag['tagTitle'])."\">".$tag['tagTitle']."</a>";
                            }
                        }
                    ?>
                  </div>
                </div>
                <div class="news-socials">
                  <span> اشتراک گذاری این مطلب در </span>
                  <a href="" class="social-instagram">
                    <i class="fa fa-instagram"></i>
                  </a>
                  <a href="" class="social-telegram">
                    <i class="fa fa-telegram"></i>
                  </a>
                  <a href="" class="social-facebook">
                    <i class="fa fa-facebook"></i>
                  </a>
                  <a href="" class="social-linkedin">
                    <i class="fa fa-linkedin"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>