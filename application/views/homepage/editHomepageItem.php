<?php

$this->load->helper("pdate");

$homeItemTitle = set_value('homeItemTitle',$item['homeItemTitle']);
$homeItemLink = set_value('homeItemLink',$item['homeItemLink']);
$homeItemDesc = set_value('homeItemDesc',$item['homeItemDesc']);
$galleryTagStyle = null; 
$image = null;
if($item['homeItemImage'] != NULL){
    $image = "<img src=\"".base_url()."assets/uploads/homepage/".$item['homeItemImage']."\" alt=\"Avatar\">";
    $galleryTagStyle = "-show"; 
}

if($resultMessage['result'] == "Alert"){
    
    $homeItemTitle = set_value('homeItemTitle',$this->input->post('homeItemTitle'));
    $homeItemLink = set_value('homeItemLink',$this->input->post('homeItemLink'));
    $homeItemDesc = set_value('homeItemDesc',$this->input->post('homeItemDesc'));

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
               <form role="form" action="<?php echo base_url();?>Homepage/editHomepageItem/<?=$item['homeItemID'];?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="form-group">
                        <label for="homeItemTitle"> عنوان بخش</label>
                        <input type="text" class="form-control"  name="homeItemTitle" id="homeItemTitle" tabindex="1"	maxlength="256" value="<?php echo $homeItemTitle; ?>" placeholder="عنوان بخش">
                     </div>
                     <div class="form-group">
                        <label for="homeItemLink">  لینک بخش</label>
                        <input type="text" class="form-control"  name="homeItemLink" id="homeItemLink" tabindex="1"	maxlength="256" value="<?php echo $homeItemLink; ?>" placeholder=" لینک بخش">
                     </div>
                     <div class="form-group">
                        <label for="homeItemDesc"> متن باکس  </label>
                        <textarea class="form-control" name="homeItemDesc" rows="3"  tabindex="9" ><?=$homeItemDesc;?></textarea>                        
                     </div>
                     <div class="form-group ">
                        <label for="adminUserLName"> تصویر بخش</label>
                        <div class="col-md-12 file-section">
                           <div class="col-md-12">
                              <input type="file" size-data="3000000"  id="upload-picture" name="homeItemImage"  tabindex="6"  />
                              فایل هایی با فرمت  jpg یا png یا gif ، حجم کمتر از 3 مگا بایت و  سایز <?=$item['homeItemImageSize'];?>
                           <div class="col-md-12" id="image-preview<?=$galleryTagStyle;?>">
                                <?=$image;?>
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">ویرایش اطلاعات بخش</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>

