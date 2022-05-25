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
<!-- nav our features -->
<main class="index-main">
   <div class="any-product-products">
      <div class="container">
         <div class="row align-items-start">

        <?php
            if($product['count'] > 0){
                foreach($product['list'] as $rows){
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
                                <a href=\"".base_url()."Product/productView/".$rows['productCode']."/".str_replace(" ","-",$rows['productTitle'])."\">
                                ".$rows['productTitle']."
                                </a>
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

            }else{
                echo "موردی یافت نشد";
            }
        ?>
         </div>
      </div>
   </div>
   <div class="pagination-parent">
      <div class="container">
         <div class="row justify-content-center">
             <?=$product['link'];?>
         </div>
      </div>
   </div>
</main>

