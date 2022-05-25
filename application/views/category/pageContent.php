<?php
$contentTitle = set_value('contentTitle',$pageContent['contentTitle']);
$contentKeywords = set_value('contentKeywords',$pageContent['contentKeywords']);
$contentDesc = set_value('contentDesc',$pageContent['contentDesc']);
$contentBody = set_value('contentBody',$pageContent['contentBody']);
?>

<div class="content-wrapper">
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title"><?=$pageTitle;?></h3>
               </div>
               <form role="form" action="<?php echo base_url();?>Category/pageContent/<?php echo $id;?>/<?php echo $title; ?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
					<div class="form-group">
						<label for="title">عنوان صفحه</label>
						<input type="text"  class="form-control" name="contentTitle" id="contentTitle" tabindex="1"	maxlength="100" value="<?php echo $contentTitle; ?>"/>
					</div>
					<div class="form-group">
						<label for="title">کلمات کلیدی صفحه</label>
						<input type="text"  class="form-control" name="contentKeywords" id="contentKeywords" tabindex="2"	maxlength="200" value="<?php echo $contentKeywords; ?>"/>
					</div>
					<div class="form-group">
						<label for="title">توضیحات صفحه</label>
						<input type="text"  class="form-control" name="contentDesc" id="contentDesc" tabindex="3"	maxlength="200" value="<?php echo $contentDesc; ?>"/>
					</div>
					<div class="form-group">
                        <label for="newsBody">محتوی صفحه</label>
                        <textarea class="form-control" name="contentBody" rows="3"  name="contentBody" cols="100" rows="10" id="content" tabindex="4"><?=$contentBody;?></textarea>                       
                     </div>
				  </div>
         		</div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" tabindex="5" class="btn btn-primary">ثبت تغییرات</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>
