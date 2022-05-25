

<?php
   $parentTitle = "";
   $parentTitleValue = "";
   $parentID = "0";
   $errorMessage = "فایل هایی با فرمت png یا gif ، حجم کمتر از 100 کیلو بایت و طول و عرض کمتر از 300 پیکسل";
   $title = set_value('title','');
if($resultMessage['result'] == "Alert"){
	$title = set_value('title',$this->input->post('title'));
   $parentID = set_value('parentID',$this->input->post('parentID'));
   $parentTitleValue = set_value('parentTitle',$category['title']);
   if($parentID != 0){
		$parentTitle = "<span class=\"tag\" data-action=\"deleteUserGroup\">".$category['title']."</span>";
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
               <form role="form" action="<?php echo base_url();?>Category/insertCategory/<?=$categoryModule;?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="form-group">
                        <label for="title">عنوان دسته بندی یا صفحه</label>
                        <input type="text"  class="form-control" name="title" id="title" tabindex="1"	maxlength="256" value="<?php echo $title; ?>"/>
                        <?php echo form_error('title') ?>
                     </div>
                     <div class="form-group">
                        <label for="categoryType">نوع صفحه یا دسته بندی</label>
                        <select class="form-control select2"  name="categoryType">
                           <option value="c">دسته بندی یا صفحه</option>
                           <option value="l">لینک </option>
                           <option value="a">فایل</option>
                           <option value="f">فرم</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label class="control-label">انتخاب والد</label>
                        <div class="col-md-12 tree-menu"><?=$tree;?>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label">والد انتخابی</label>
                        <div id="tag-suggest" class="col-md-12 select2-choices">	
                        <?php echo $parentTitle; ?>								
                        </div>
                        <input type="hidden" id="parentID" name="parentID" value="<?php echo $parentID; ?>">
                        <input type="hidden" id="parentTitle" name="parentTitle" value="<?php echo $parentTitleValue; ?>">
                     </div>
                     <div class="form-group ">
                        <label for="adminUserLName"> نمایه دسته بندی با صفحه</label>
                        <div class="col-md-12 file-section">
                           <div class="col-md-12">
                              <input type="file" size-data="100000"  id="upload-picture" name="categoryImg" id="adminUserAvatar" tabindex="6"  />
                              فایل هایی با فرمت  jpg یا png یا gif ، حجم کمتر از 100 کیلو بایت و طول و عرض کمتر از 500 پیکسل
                           </div>
                           <div class="col-md-12" id="image-preview">
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>وضعیت</label>
                        <div class="multi-checkbox">
                           <label>
                           <input type="radio" name="categoryStatus" value="0" class="flat-red">
                           غیر فعال
                           </label>
                           <?php
                              if($permission == "3" || $permission == "a"){
                              ?>
                           <label>
                           <input type="radio" name="categoryStatus" value="1" class="flat-red" checked >
                           فعال
                           </label>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">ثبت دسته بندی یا صفحه</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>

