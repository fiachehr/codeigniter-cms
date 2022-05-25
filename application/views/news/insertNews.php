<?php
   $resourceList = "";
   $propertyList = "";
   $errorMessage = "فایل هایی با فرمت jpg | png | gif با حجم کمتر از 1000kb و رزولیشن بین 400*400 تا 2000*2000پیکسل";
   $newsSoTitle = set_value('');		
   $newsRTitle = set_value('');
   $newsTitle = set_value('');
   $newsArthur = set_value('newsArthur',$this->session->userdata['userName']);
   $newsSummery = set_value('');
   $newsBody = set_value('');
   $newsKeywords = set_value('');
   $tagList = set_value('');
   $tagListTitle = set_value('');

if($resultMessage['result'] == "Alert"){

   $newsSoTitle = set_value('newsSoTitle',$this->input->post('newsSoTitle'));		
   $newsRTitle = set_value('newsRTitle',$this->input->post('newsRTitle'));
   $newsTitle = set_value('newsTitle',$this->input->post('newsTitle'));
   $newsArthur = set_value('newsArthur',$this->input->post('newsArthur'));
   $scheduleStart = set_value('scheduleStart',$this->input->post('scheduleStart'));
   $scheduleEnd = set_value('scheduleEnd',$this->input->post('scheduleEnd'));
   $newsSummery = set_value('newsSummery',$this->input->post('newsSummery'));
   $newsCatList = set_value('newsCatList',$this->input->post('newsCatList'));
   $newsTagList= set_value('newsTagList',$this->input->post('newsTagList'));
   $newsBody = set_value('newsBody',$this->input->post('newsBody'));
   $newsKeywords = set_value('newsKeywords',$this->input->post('newsKeywords'));
   if($this->input->post('newsCatList') != ""){  		
      foreach($catList as $catRow){ 			
         $newsCatsTitle .= "<span class=\"tag\" id=\"".$catRow->id."\" onclick=\"deleteMultiCat('".$catRow->id."')\">".$catRow->title."</span>"; 			
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
					<form role="form" action="<?php echo base_url();?>News/insertNews" method="post" enctype="multipart/form-data">
						<input type="hidden"  name="newsGUID"  value="<?php echo $newsGUID; ?>">
                     <div class="form-group">
                        <label for="newsSoTitle"> سو  تیتر</label>
                        <input type="text" class="form-control" id="newsSoTitle" name="newsSoTitle"  tabindex="2" value="<?php echo $newsSoTitle; ?>" >
                     </div>
                     <div class="form-group">
                        <label for="newsRTitle"> رو  تیتر</label>
                        <input type="text" class="form-control"id="newsRTitle" name="newsRTitle"  tabindex="3" value="<?php echo $newsRTitle; ?>" >
                     </div>
                     <div class="form-group">
                        <label for="newsTitle">تیتر</label>
                        <input type="text" class="form-control" id="newsTitle" name="newsTitle"  tabindex="4" value="<?php echo $newsTitle; ?>" >
                        <?php echo form_error('newsTitle') ?>
                     </div>
                     <div class="form-group">
                        <label for="newsArthur">نویسنده </label>
                        <input type="text" class="form-control" id="newsArthur" name="newsArthur" tabindex="5" value="<?php echo $newsArthur; ?>" >
                        <?php echo form_error('newsArthur') ?>
                     </div>
                     <div class="form-group">
                        <label class="control-label">دسته بندی  </label>
                        <div class="col-md-12 tree-menu">
                           <?php echo $tree;?>
                        </div>
                        <?php echo form_error('newsCatList') ?>
                     </div>
                     <div class="form-group">
                        <label class="control-label">دسته بندی های انتخابی</label>
                        <div id="tag-suggest">		
                           <?=$newsCatsTitle;?>							
                        </div>
                        <input type="hidden" id="catList" name="newsCatList"  value="<?php echo $newsCatList; ?>">
                     </div>
                     <div class="form-group">
                        <label for="newsSummery"> خلاصه خبر  </label>
                        <textarea class="form-control" name="newsSummery" rows="3"  tabindex="9" ><?=$newsSummery;?></textarea> 
                        <?php echo form_error('newsSummery') ?>                       
                     </div>
                     <div class="form-group">
                        <label for="newsBody"> متن خبر  </label>
                        <textarea class="form-control" name="newsBody" rows="3"  name="newsBody" cols="100" rows="10" id="content" tabindex="10"><?=$newsBody;?></textarea> 
                        <?php echo form_error('newsBody') ?>                       
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
                     <div class="form-group">
                        <label for="newsKeywords">کلمات کلیدی</label>
                        <input type="text" class="form-control" id="newsKeywords" name="newsKeywords" maxlength="200" tabindex="11" value="<?php echo $newsKeywords; ?>" placeholder="کلمه اول,کلمه دوم,..." >
                     </div>
                     <div class="form-group ">
                        <label for="newsImg">تصاویر خبر </label>
                        <div class="col-md-12 file-section">
                           <div class="col-md-12">
                              <input type="hidden" name="trueImage" id="trueImage" value="" />
                              <input type="file" multiple size-data="10000000"  id="upload-multiple-picture" name="newsImg[]" id="newsImg" tabindex="6"  />
                              <button id="btn-example-file-reset" type="button" disabled><i class="fa fa-trash-o"></i> حذف فایلهای انتخابی</button>
                              فایل هایی با فرمت  jpg یا png یا gif ، حجم کمتر از 3 مگا بایت 
                           </div>
                           <div class="col-md-12" id="image-preview">
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="newsImg"> خبر ویژه </label>
                        <div class="multi-checkbox">
                           <label>
                           <input type="checkbox" name="newsRecommanded" class="flat-red" value="1"> انتخاب به عنوان خبر ویژه
                           </label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>وضعیت</label>
                        <div class="multi-checkbox">
                           <label>
                           <input type="radio" name="newsStatus" value="0" class="flat-red" checked>
                           غیر فعال
                           </label>
                           <?php
                              if($permission == "3" || $permission == "a"){
                              ?>
                           <label>
                           <input type="radio" name="newsStatus" value="1" class="flat-red" >
                           فعال
                           </label>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">ثبت خبر</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>




