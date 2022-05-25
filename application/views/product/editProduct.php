<?php
   $errorMessage = "فایل هایی با فرمت jpg | png | gif با حجم کمتر از 1000kb و رزولیشن بین 400*400 تا 2000*2000پیکسل";
   $productTitle = set_value('productTitle',$product['productTitle']);	
   $productVolume = set_value('productVolume',$product['productVolume']);	
   $productProYear = set_value('productProYear',$product['productProYear']);
   $productBrand = set_value('productBrand',$product['productBrand']);
   $productPrice = set_value('productPrice',$product['productPrice']);
   $productSmellStr = set_value('productSmellStr',$product['productSmellStr']);
   $productFRNet = set_value('productFRNet',$product['productFRNet']);
   $productMINet = set_value('productMINet',$product['productMINet']);
   $productENNet = set_value('productENNet',$product['productENNet']);
   $productWeight = set_value('productWeight',$product['productWeight']);
   $productPackage = set_value('productPackage',$product['productPackage']);
   $productLicense = set_value('productLicense',$product['productLicense']);
   $productVitamin = set_value('productVitamin',$product['productVitamin']);
   $productUsage = set_value('productUsage',$product['productUsage']);
   $productMaterial = set_value('productMaterial',$product['productMaterial']);
   $productDesc = set_value('productDesc',$product['productDesc']);
   $productParentCode = set_value('productParentCode',$product['productParentCode']);
   $productDicount = set_value('productDicount',$product['productDicount']);
   $productCountry = set_value('productCountry',$product['productCountry']);
   $productFor = set_value('productFor',$product['productFor']);
   $productRecommanded = null;
   $images = null;
   if($product['productRecommanded'] == "1"){
      $productRecommanded = "checked";
   }
   if($product['imageCount'] > 0){
      for($i = 0 ; $i < $product['imageCount'] ; $i++){
         $images .= "<div data-action=\"removeServerImage\" data-id=\"".$i."\" data-module=\"product\" data-guid=\"productGUID\" ><img src=\"".base_url()."assets/uploads/product/".$productGUID."--".$i.".jpg\" /></div>"; 
      } 
   }

   $statusChecked = array("checked","");
   if($product['productStatus'] == "e"){
      $statusChecked = array("","checked");
   }
   
 
   

if($resultMessage['result'] == "Alert"){

   $productTitle = set_value('productTitle',$this->input->post('productTitle'));	
   $productVolume = set_value('productVolume',$this->input->post('productVolume'));	
   $productProYear = set_value('productProYear',$this->input->post('productProYear'));		
   $productBrand = set_value('productBrand',$this->input->post('productBrand'));
   $productPrice = set_value('productPrice',$this->input->post('productPrice'));
   $productSmellStr = set_value('productSmellStr',$this->input->post('productSmellStr'));
   $productFRNet = set_value('productFRNet',$this->input->post('productFRNet')); 
   $productMINet = set_value('productMINet',$this->input->post('productMINet')); 
   $productENNet = set_value('productENNet',$this->input->post('productENNet'));
   $productWeight = set_value('productWeight',$this->input->post('productWeight'));
   $productPackage = set_value('productPackage',$this->input->post('productPackage'));
   $productLicense = set_value('productLicense',$this->input->post('productLicense'));
   $productVitamin = set_value('productVitamin',$this->input->post('productVitamin'));
   $productUsage = set_value('productUsage',$this->input->post('productUsage'));
   $productMaterial = set_value('productMaterial',$this->input->post('productMaterial'));
   $productDesc = set_value('productDesc',$this->input->post('productDesc'));
   $productParentCode = set_value('productParentCode',$this->input->post('productParentCode'));
   $productDicount = set_value('productDicount',$this->input->post('productDicount'));
   $productCountry = set_value('productCountry',$this->input->post('productCountry'));
   $productFor = set_value('productFor',$this->input->post('productFor'));
   if(isset($_POST['productRecommanded'])){
      $productRecommanded = "checked";
   }
   if($this->input->post('productCatList') != ""){  		
      foreach($catList as $catRow){ 			
          $productCatsList .= "<span class=\"tag\" id=\"cat-".$catRow['id']."\" data-id=\"".$catRow['id']."\" data-action=\"deleteCategory\">".$catRow['title']."</span>"; 			
      }				
   }
}
   
   ?>	

<div class="content-wrapper">
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title"><?=$pageTitle;?></h3>
               </div>
					<form role="form" action="<?php echo base_url();?>Product/editProduct/<?php echo $productGUID; ?>/<?php echo $page; ?>" method="post" enctype="multipart/form-data">
						<input type="hidden"  name="productGUID"  value="<?php echo $productGUID; ?>">
                  <input type="hidden"  name="imageCount"  value="<?php echo $product['imageCount']; ?>">
                  <div class="box-body">
                     <div class="form-group">
                        <label for="productTitle"> عنوان محصول</label>
                        <input type="text" class="form-control" id="productTitle" name="productTitle"  tabindex="2" value="<?php echo $productTitle; ?>" >
                        <?php echo form_error('productTitle') ?>
                     </div>
                     <div class="form-group">
                        <label for="productSoTitle"> حجم محصول (میلی لیتر)</label>
                        <input type="text" class="form-control" id="productVolume" name="productVolume"  tabindex="3" value="<?php echo $productVolume; ?>" >
                        <?php echo form_error('productVolume') ?>
                     </div>
                     <div class="form-group">
                        <label for="productProYear"> سال معرفی محصول</label>
                        <input type="text" class="form-control" id="productProYear" name="productProYear"  tabindex="4" value="<?php echo $productProYear; ?>" >
                        <?php echo form_error('productProYear') ?>
                     </div>
                     <div class="form-group">
                        <label for="productBrand"> برند سازنده محصول</label>
                        <input type="text" class="form-control" id="productBrand" name="productBrand"  tabindex="5" value="<?php echo $productBrand; ?>" >
                        <?php echo form_error('productBrand') ?>
                     </div>
                     <div class="form-group">
                        <label for="productBrand"> کشور سازنده محصول</label>
                        <input type="text" class="form-control" id="productCountry" name="productCountry"  tabindex="5" value="<?php echo $productCountry; ?>" >
                        <?php echo form_error('productCountry') ?>
                     </div>
                     <div class="form-group">
                        <label for="productBrand"> مناسب برای</label>
                        <input type="text" class="form-control" id="productFor" name="productFor"  tabindex="5" value="<?php echo $productFor; ?>" >
                        <?php echo form_error('productFor') ?>
                     </div>
                     <div class="form-group">
                        <label for="productPrice">قیمت محصول  (تومان)</label>
                        <input type="text" class="form-control" id="productPrice" name="productPrice" tabindex="6" value="<?php echo $productPrice; ?>" >
                        <?php echo form_error('productPrice') ?>
                     </div>
                     <div class="form-group">
                        <label for="productPrice">تخفیف محصول  (درصد)</label>
                        <input type="text" class="form-control" id="productDicount" name="productDicount" tabindex="6" value="<?php echo $productDicount; ?>" >
                        <?php echo form_error('productDicount') ?>
                     </div>
                     <div class="form-group">
                        <label for="producproductSmellStrtBrand"> ساختار رایحه محصول</label>
                        <input type="text" class="form-control" id="productSmellStr" name="productSmellStr"  tabindex="6" value="<?php echo $productSmellStr; ?>" >
                     </div>  
                     <div class="form-group">
                        <label for="productBrand"> نت آغازی محصول</label>
                        <input type="text" class="form-control" id="productFRNet" name="productFRNet"  tabindex="7" value="<?php echo $productFRNet; ?>" >
                     </div>  
                     <div class="form-group">
                        <label for="productMINet"> نت میانی محصول</label>
                        <input type="text" class="form-control" id="productMINet" name="productMINet"  tabindex="8" value="<?php echo $productMINet; ?>" >
                     </div>  
                     <div class="form-group">
                        <label for="productBrand"> نت پایانی محصول</label>
                        <input type="text" class="form-control" id="productENNet" name="productENNet"  tabindex="9" value="<?php echo $productENNet; ?>" >
                     </div>  
                     <div class="form-group">
                        <label for="productWeight"> وزن محصول (گرم)</label>
                        <input type="text" class="form-control" id="productWeight" name="productWeight"  tabindex="10" value="<?php echo $productWeight; ?>" >
                        <?php echo form_error('productWeight') ?>
                     </div>  
                     <div class="form-group">
                        <label for="productBrand"> نوع محفظه نگهدارنده محصول</label>
                        <input type="text" class="form-control" id="productPackage" name="productPackage"  tabindex="11" value="<?php echo $productPackage; ?>" >
                        <?php echo form_error('productPackage') ?>
                     </div>  
                     <div class="form-group">
                        <label for="productLicense"> شماره مجوز محصول</label>
                        <input type="text" class="form-control" id="productLicense" name="productLicense"  tabindex="12" value="<?php echo $productLicense; ?>" >
                        <?php echo form_error('productLicense') ?>
                     </div>  
                     <div class="form-group">
                        <label for="productVitamin"> نوع ویتامین محصول</label>
                        <input type="text" class="form-control" id="productVitamin" name="productVitamin"  tabindex="13" value="<?php echo $productVitamin; ?>" >
                     </div>  
                     <div class="form-group">
                        <label for="productUsage"> کاربرد محصول</label>
                        <input type="text" class="form-control" id="productUsage" name="productUsage"  tabindex="14" value="<?php echo $productUsage; ?>" >
                     </div> 
                     <div class="form-group">
                        <label for="productMaterial"> جنس تیغه محصول</label>
                        <input type="text" class="form-control" id="productMaterial" name="productMaterial"  tabindex="15" value="<?php echo $productMaterial; ?>" >
                     </div> 
                     <div class="form-group">
                        <label for="productBody"> توضیحات محصول  </label>
                        <textarea class="form-control" name="productDesc" rows="3"  name="productDesc" cols="100" rows="16" id="content" tabindex="10"><?=$productDesc;?></textarea>                 
                     </div>
                     <div class="form-group">
                        <label class="control-label">دسته بندی</label>
                        <div class="col-md-12 tree-menu">
                           <?php echo $tree;?>
                        </div>
                        <?php echo form_error('productCatList') ?>
                     </div>
                     <div class="form-group">
                        <label class="control-label">دسته بندی های انتخابی</label>
                        <div id="tag-suggest">		
                           <?=$productCatsList;?>							
                        </div>
                        <input type="hidden" id="catList" name="productCatList"  value="<?php echo $productCatList; ?>">
                     </div>
                     <div class="form-group">
                        <label> برچسب خبر  </label> 
                        <div class="tags">
                           <div><?=$tagsTitles;?></div>
                           <input type="text" placeholder="برچسبها" action-data="getTag">
                           <button type="button">+</button>
                           <input type="hidden" class="hidden1" value="<?=$tagList;?>" name="tagsList">
                           <input type="hidden" class="hidden2" value="<?=$tagListTitle;?>" name="tagsListTitle">
                           <select id="tagsList"></select>
                        </div>
                     </div>
                     <div class="form-group ">
                        <label for="newsImg">تصاویر محصول </label>
                        <div class="col-md-12 file-section">
                           <label> تصاویر ثبت شده</label>
                           <?php 
                             if($product['imageCount'] > 0){
                           ?>
                           <div class="col-md-12" id="image-preview-show">
                           <?php
                              echo $images;
                           ?>
                           </div>
                             <?php } ?>
                           <div class="col-md-12">
                              <input type="hidden" name="trueImage" id="trueImage" value="" />
                              <input type="file" multiple size-data="500000"  id="upload-multiple-picture" name="productImg[]" id="productImg" tabindex="6"  />
                              <button id="btn-example-file-reset" type="button" disabled><i class="fa fa-trash-o"></i>حذف فایلهای انتخابی جدید</button>
                              فایل هایی با فرمت  jpg یا png یا gif ، حجم کمتر از 3000 کیلو بایت و طول و عرض کمتر از 500 پیکسل
                           </div>
                           <div class="col-md-12" id="image-preview">
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="productImg"> محصول ویژه </label>
                        <div class="multi-checkbox">
                           <label>
                           <input type="checkbox" name="productRecommanded" class="flat-red" value="1" <?=$productRecommanded;?>> انتخاب به عنوان محصول ویژه
                           </label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>وضعیت</label>
                        <div class="multi-checkbox">
                           <label>
                           <input type="radio" name="productStatus" value="d" class="flat-red" <?=$statusChecked[0];?>>
                           غیر فعال
                           </label>
                           <?php
                              if($permission == "3" || $permission == "a"){
                              ?>
                           <label>
                           <input type="radio" name="productStatus" value="e" class="flat-red" <?=$statusChecked[1];?> >
                           فعال
                           </label>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">ویرایش محصول</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>




