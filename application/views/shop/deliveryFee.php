	
<div class="content-wrapper">
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title"><?=$pageTitle;?></h3>
               </div>
                  <div class="box-body">
				  <div class="form-group">
                        <label class="control-label">انتخاب شهر</label>
                        <div class="col-md-12 tree-menu">
                           <?php echo $tree;?>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="productTitle">قیمت به ریال به ازای هر کیلوگرم</label>
                        <input type="text" class="form-control" id="locationFee"  tabindex="1" value="" >
						<input type="hidden"  id="locationID" value="" >
                     </div>
                  </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="button" name="submit" id="setDeliveryFee" value="submit" class="btn btn-primary">ویرایش قیمت</button>
         </div>	
      </div>
   </section>
</div>
</div>


