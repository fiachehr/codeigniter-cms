<?php
$sliderURL = set_value('');
$sliderCaption = set_value('');
$sliderTitle = set_value('');

if($resultMessage['result'] == "Alert"){

	$sliderURL = set_value('sliderURL', $this->input->post('sliderURL'));
	$sliderCaption = set_value('sliderCaption', $this->input->post('sliderCaption'));
	$sliderTitle = set_value('sliderTitle', $this->input->post('sliderTitle'));
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
               <form role="form" action="<?php echo base_url();?>Homepage/insertSlider" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="form-group">
                        <label for="homeItemTitle">لینک اسلایدر</label>
                        <input type="text" class="form-control"  name="sliderURL" id="sliderURL" tabindex="1"	maxlength="256" value="<?php echo $sliderURL; ?>" placeholder="لینک اسلایدر">
                     </div>
                     <div class="form-group">
                        <label for="homeItemLink">عنوان اسلایدر</label>
                        <input type="text" class="form-control"  name="sliderTitle" id="sliderTitle" tabindex="1"	maxlength="256" value="<?php echo $sliderTitle; ?>" placeholder="عنوان اسلایدر">
                     </div>
                     <div class="form-group">
                        <label for="homeItemDesc"> توضیحات اسلایدر  </label>
						      <textarea name="sliderCaption" cols="100" rows="10" id="content" tabindex="10"><?php echo $sliderCaption; ?></textarea>			
                     </div>
                     <div class="form-group ">
                        <label for="adminUserLName"> تصویر اسلایدر</label>
                        <div class="col-md-12 file-section">
                           <div class="col-md-12">
                              <input type="file" size-data="3000000"  id="upload-picture" name="sliderImg"  tabindex="4"  />
                              فایل هایی با فرمت  jpg یا png یا gif ، حجم کمتر از 3 مگا بایت و  سایز 
                           <div class="col-md-12" id="image-preview">                             
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">درج اسلایدر جدید</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>




