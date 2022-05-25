<?php
$description = set_value('description',$description['description']);
?>

<div class="content-wrapper">
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title"><?=$pageTitle;?></h3>
               </div>
               <form role="form" action="<?php echo base_url();?>Shop/factorDesc/" method="post" enctype="multipart/form-data">
                  <div class="box-body">
					      <div class="form-group">
                        <label for="description">توضیحات فاکتور </label>
                        <textarea class="form-control" name="description" rows="3"  cols="100" rows="10" id="content" tabindex="1"><?=$description;?></textarea>                       
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
