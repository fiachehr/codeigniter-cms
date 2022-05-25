<?php
   $lotteryTitle = set_value('');		
   $lotteryExpireDate = set_value('');
   $onlineCode = set_value('');
   $offlineCode = set_value('');
   $lotteryWinnerCount = set_value('');

if($resultMessage['result'] == "Alert"){
   $lotteryTitle = set_value('lotteryTitle',$this->input->post('lotteryTitle'));		
   $lotteryExpireDate = set_value('lotteryExpireDate',$this->input->post('lotteryExpireDate'));
   $onlineCode = set_value('onlineCode',$this->input->post('onlineCode'));
   $offlineCode = set_value('offlineCode',$this->input->post('offlineCode'));
   $lotteryWinnerCount = set_value('lotteryWinnerCount',$this->input->post('lotteryWinnerCount'));
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
				<form role="form" action="<?php echo base_url();?>Shop/insertLottery" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="form-group">
                        <label for="lotteryTitle">عنوان قرعه کشی</label>
                        <input type="text" class="form-control" id="lotteryTitle" name="lotteryTitle"  tabindex="1" value="<?php echo $lotteryTitle; ?>" >
                        <?php echo form_error('lotteryTitle') ?>
                     </div>
                     <div class="form-group">
                        <label for="productTitle">تعداد کد آنلاین</label>
                        <input type="text" class="form-control" id="onlineCode" name="onlineCode"  tabindex="2" value="<?php echo $onlineCode; ?>" >
                        <?php echo form_error('onlineCode') ?>
                     </div>
                     <div class="form-group">
                        <label for="productTitle">تعداد کد آفلاین</label>
                        <input type="text" class="form-control" id="offlineCode" name="offlineCode"  tabindex="3" value="<?php echo $offlineCode; ?>" >
                        <?php echo form_error('offlineCode') ?>
                     </div>
                     <div class="form-group">
                        <label for="productTitle">تعداد برنده</label>
                        <input type="text" class="form-control" id="lotteryWinnerCount" name="lotteryWinnerCount"  tabindex="4" value="<?php echo $lotteryWinnerCount; ?>" >
                        <?php echo form_error('lotteryWinnerCount') ?>
                     </div>
					      <?php
                        $sDateVaules = "set";
                        if($lotteryExpireDate == ''){
                        	$sDateVaules = "empty";
                        }
                     ?>
                     <div class="form-group">
                        <label for="lotteryExpireDate"> تاریخ انقضا</label>
                        <input type="text" id="start" class="form-control initial-value-example"  name="lotteryExpireDate" id="lotteryExpireDate" tabindex="5" maxlength="10" value="<?php echo $lotteryExpireDate; ?>">
						<input type="hidden" id="startValue" value="<?php echo $sDateVaules; ?>">
					    <?php echo form_error('lotteryExpireDate') ?>
                     </div>

                  </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">ثبت قرعه کشی</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>


