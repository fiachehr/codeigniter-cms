<?php
   $boardTitle = "";
   $start = set_value('scheduleStart','');
   $end = set_value('scheduleEnd','');
   
   if($resultMessage['result'] == "Alert"){
     
    $this->load->helper("pdate");
    
    if($this->input->post('scheduleStart') != null){
      $start = jalToGre($this->input->post('scheduleStart'));
    }
    if($this->input->post('scheduleEnd') != null){
      $end = jalToGre($this->input->post('scheduleEnd'));
    }
    $boardTitle = set_value('boardTitle',$this->input->post('boardTitle'));
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
               <form role="form" action="<?php echo base_url();?>Board/insertBoard" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="form-group">
                        <label for="adminUserLName">عنوان تابلوی اعلانات</label>
                        <input type="text" class="form-control"  name="boardTitle" id="boardTitle" tabindex="1"	maxlength="128" value="<?php echo $boardTitle; ?>" placeholder="عنوان تابلوی اعلانات">
                        <?php echo form_error('boardTitle') ?>
                     </div>
                     <div class="form-group">
                        <label for="start"> آغاز نمایش</label>
                        <input type="text" id="start" class="form-control initial-value-example"  name="scheduleStart"  tabindex="4"	maxlength="256" value="<?php echo $start; ?>" placeholder="آغاز نمایش">
                        <?php echo form_error('scheduleStart') ?>
                     </div>
                     <div class="form-group">
                        <label for="end"> پایان نمایش</label>
                        <input type="text" id="end" class="form-control"  name="scheduleEnd"  tabindex="5"	maxlength="256" value="<?php echo $end; ?>" placeholder="پایان نمایش">
                        <?php echo form_error('scheduleEnd') ?>
                     </div>
                     <div class="form-group ">
                        <label for="boardImg"> تصویر </label>
                        <div class="col-md-12 file-section">
                           <div class="col-md-12">
                              <input type="file" size-data="1000000"  id="upload-picture" name="boardImg" id="boardImg" tabindex="6"  />
                              فایل هایی با فرمت  jpg یا png یا gif ، حجم کمتر از 1 مگا بایت و طول و عرض کمتر از 500 پیکسل
                           </div>
                           <div class="col-md-12" id="image-preview">
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>وضعیت</label>
                        <div class="multi-checkbox">
                           <label>
                           <input type="radio" name="boardStatus" value="d" class="flat-red" checked>
                           غیر فعال
                           </label>
                           <?php
                              if($permission == "3" || $permission == "a"){
                              ?>
                           <label>
                           <input type="radio" name="boardStatus" value="a" class="flat-red" >
                           فعال
                           </label>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">ثبت تابلو اعلانات</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>

