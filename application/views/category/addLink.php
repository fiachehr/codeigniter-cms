<?php
	$linkURL = set_value('linkURL',$pageLink['linkURL']);  
?>
<div class="content-wrapper">
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title"><?=$pageTitle;?></h3>
               </div>
               <form role="form" action="<?=base_url();?>category/addLink/<?=$id;?>/<?=$title;?>" method="post">
                  <div class="box-body">
                     <div class="form-group">
                        <label for="userName">آدرس صفحه یا سایت</label>
                        <input type="text" class="form-control"  name="linkURL" id="linkURL" tabindex="1"	maxlength="128" value="<?php echo $linkURL; ?>" placeholder="ago.ir">
                        <?php echo form_error('linkURL') ?>
                     </div>
                  </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">ثبت لینک</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>


