<?php
   $homeItemLabel = set_value('');
   $homeItemType = set_value('');
   $homeItemImageSize = set_value('');
if($resultMessage['result'] == "Alert"){
   $homeItemLabel = set_value('homeItemLabel',$this->input->post('homeItemLabel'));
   $homeItemType = set_value('homeItemType',$this->input->post('homeItemType'));
   $homeItemImageSize = set_value('homeItemImageSize',$this->input->post('homeItemImageSize'));
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
					<form role="form" action="<?php echo base_url();?>Homepage/insertHomepageItem" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="form-group">
                        <label for="homeItemLabel"> لیبل بخش </label>
                        <input type="text"  class="form-control" id="homeItemLabel" name="homeItemLabel"  tabindex="1" value="<?=$homeItemLabel;?>" autocomplete="off" >
                     </div>
                     <div class="form-group">
                        <label>نوع بخش</label>
                        <select class="form-control select2" name="homeItemType" >
                           <option selected="selected" value="SBX">باکس کوچک</option>
                           <option value="LBX" >باکس بزرگ</option>
                           <option value="PLX" >پارالاکس</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="">سایز تصویر باکس</label>
                        <input type="text" class="form-control"id="homeItemImageSize" name="homeItemImageSize"  tabindex="3" value="<?php echo $homeItemImageSize; ?>" >
                        <?php echo form_error('homeItemImageSize') ?>
                     </div>
                  </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">ثبت بخش صفحه اول</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>




