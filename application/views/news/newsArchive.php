<?php
$segments = $this->uri->segment_array();
$links = "<li class=\"breadcrumb-item\"><a href=\"".base_url()."Product/productArchive/".urldecode($segments[count($segments)-3])."/".urldecode($segments[count($segments)-1])."/0\">".urldecode(str_replace("-"," ",$segments[count($segments)-1]))."</a></li>";
?>
<div class="breadcrumb-parent">
   <div class="container">
      <div class="row">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url();?>">فروشگاه اینترنتی بیک</a></li>
            <?=$links;?>
         </ul>
      </div>
   </div>
</div>



    <main class="news-main">
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="index-news-wrapper">
                                <?php
                                    if(count($news['count']) > 0){
                                        foreach($news['list'] as $rows){
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
                                    }else{
                                        echo "موردی یافت نشد";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination-parent">
      <div class="container">
         <div class="row justify-content-center">
             <?=$news['link'];?>
         </div>
      </div>
    </div>
</main>