<?php
$fileErrorClass = NULL;
$errorMessage = "فایل کمتر از یک و نیم مگا بایت";
?>
<div class="content-wrapper">
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title"><?=$pageTitle;?></h3>
               </div>
               <form role="form" action="<?=base_url();?>category/addAttachment/<?=$id;?>/<?=$title; ?>" method="post" enctype="multipart/form-data" method="post">
                  <div class="box-body">
                     <div class="form-group">
                        <label for="userName">انتخاب فایل</label>
                        <input type="file" name="attachment" id="attachment" tabindex="1" value=""/>
                        <?php echo $errorMessage;?>
                     </div>
				  </div>
				  <div class="form-group text-center">
							<?php echo $linkURL;?>
				  </div>
				  <br/>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">ثبت فایل</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>


