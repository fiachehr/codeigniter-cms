<?php
   $giftCardAmount = set_value('');		
   $giftCardExpireDate = set_value('');
   $giftCardCount = set_value('');

if($resultMessage['result'] == "Alert"){
   $giftCardAmount = set_value('giftCardAmount',$this->input->post('giftCardAmount'));		
   $giftCardExpireDate = set_value('giftCardExpireDate',$this->input->post('giftCardExpireDate'));
   $giftCardCount = set_value('giftCardCount',$this->input->post('giftCardCount'));
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
				<form role="form" action="<?php echo base_url();?>Shop/insertGiftCard" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="form-group">
                        <label for="productTitle">ارزش کارت هدیه (ریال)</label>
                        <input type="text" class="form-control" id="giftCardAmount" name="giftCardAmount"  tabindex="2" value="<?php echo $giftCardAmount; ?>" >
                        <?php echo form_error('giftCardAmount') ?>
                     </div>
                     <div class="form-group">
                        <label for="productTitle">تعداد</label>
                        <input type="text" class="form-control" id="giftCardCount" name="giftCardCount"  tabindex="2" value="<?php echo $giftCardCount; ?>" >
                        <?php echo form_error('giftCardCount') ?>
                     </div>
					      <?php
                        $sDateVaules = "set";
                        if($giftCardExpireDate == ''){
                        	$sDateVaules = "empty";
                        }
                     ?>
                     <div class="form-group">
                        <label for="giftCardExpireDate"> تاریخ انقضا</label>
                        <input type="text" id="start" class="form-control initial-value-example"  name="giftCardExpireDate" id="giftCardExpireDate" tabindex="2" maxlength="10" value="<?php echo $giftCardExpireDate; ?>">
						<input type="hidden" id="startValue" value="<?php echo $sDateVaules; ?>">
					    <?php echo form_error('giftCardExpireDate') ?>
                     </div>

                  </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">ثبت کارت هدیه</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>


