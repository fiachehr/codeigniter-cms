<?php

   $linkTitle = set_value('linkTitle',$link['linkTitle']);
   $linkURL = set_value('linkURL',$link['linkURL']);

   $statusChecked = array("checked","");
   if($link['linkStatus'] == "a"){
      $statusChecked = array("","checked");
   }
   
   

   if($resultMessage['result'] == "Alert"){
   
    $linkTitle = set_value('linkTitle',$this->input->post('linkTitle'));
    $linkURL = set_value('linkURL',$this->input->post('linkURL'));

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
               <form role="form" action="<?php echo base_url();?>Link/editLink/<?=$link['linkID'];?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="form-group">
                        <label for="linkTitle">عنوان لینک</label>
                        <input type="text" class="form-control"  name="linkTitle" id="linkTitle" tabindex="1"	maxlength="128" value="<?php echo $linkTitle; ?>" placeholder="عنوان لینک">
                        <?php echo form_error('linkTitle') ?>
                     </div>
                     <div class="form-group">
                        <label for="userMobileNo">آدرس</label>
                        <input type="text" class="form-control"  name="linkURL" id="linkURL" tabindex="2"	 value="<?php echo $linkURL; ?>" placeholder="http://www.ago.ir">
                        <?php echo form_error('linkURL') ?>
                     </div>
                     <div class="form-group">
                        <label for="linkPosition">محل نمایش</label>
                        <select class="form-control select2"  name="linkPosition">
                           <option value="rsb" <?php if($link['linkPosition'] == 'rsb'){echo "selected";}?> >سایدبار راست</option>
                           <option value="lsb" <?php if($link['linkPosition'] == 'lsb'){echo "selected";}?>>سایدبار چپ </option>
                           <option value="f" <?php if($link['linkPosition'] == 'f'){echo "selected";}?> >فوتر</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>وضعیت</label>
                        <div class="multi-checkbox">
                           <label>
                           <input type="radio" name="linkStatus" value="d" class="flat-red" <?=$statusChecked[0];?>>
                           غیر فعال
                           </label>
                           <?php
                              if($permission == "3" || $permission == "a"){
                              ?>
                           <label>
                           <input type="radio" name="linkStatus" value="a" class="flat-red" <?=$statusChecked[1];?> >
                           فعال
                           </label>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">ویرایش اطلاعات  </button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>

