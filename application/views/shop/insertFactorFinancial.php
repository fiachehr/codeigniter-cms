<?php
   $financialTitle = set_value('');		
   $financialPercent = set_value('');
   $financialStartDate = set_value('');
   $financialExpireDate = set_value('');
   $statusChecked = array("checked","");
   $typeSelected = array("selected","");
  

if($resultMessage['result'] == "Alert"){
    if($this->input->post('financialStatus') == "e"){
        $statusChecked = array("","checked");
    }
    if($this->input->post('financialType') == "-"){
        $typeSelected = array("","selected");
    }
    if($this->input->post('financialStartDate') != null){
        $financialStartDate = jalToGre($this->input->post('financialStartDate'));
    }
    if($this->input->post('financialExpireDate') != null){
        $financialExpireDate = jalToGre($this->input->post('financialExpireDate'));
    }
    $this->load->helper("pdate");
    $financialTitle = set_value('financialTitle',$this->input->post('financialTitle'));		
    $financialPercent = set_value('financialPercent',$this->input->post('financialPercent'));

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
				<form role="form" action="<?php echo base_url();?>Shop/insertFactorFinancial" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="form-group">
                        <label for="financialTitle">عنوان</label>
                        <input type="text" class="form-control" id="financialTitle" name="financialTitle"  tabindex="1" value="<?php echo $financialTitle; ?>" >
                        <?php echo form_error('financialTitle') ?>
                     </div>
                     <div class="form-group">
                        <label for="financialPercent">میزان (درصد)</label>
                        <input type="text" class="form-control" id="financialPercent" name="financialPercent"  tabindex="2" value="<?php echo $financialPercent; ?>" >
                        <?php echo form_error('financialPercent') ?>
                     </div>
                     <div class="form-group">
                        <label for="financialType">نوع</label>
                        <select class="form-control select2" name="financialType" tabindex="2">
                           <option value="+" <?=$typeSelected[0];?>>افزاینده</option>
                           <option value="-" <?=$typeSelected[1];?>>کاهنده</option>
                        </select>
                     </div>
                     <?php
                        $sDateVaules = "set";
                        $eDateVaules = "set";
                        if($financialStartDate == ''){
                            $sDateVaules = "empty";
                        }
                        if($financialExpireDate == ''){
                            $eDateVaules = "empty";
                        }
                        ?>
                     <div class="form-group">
                        <label for="financialStartDate"> آغاز </label>
                        <input type="text" id="startSche" class="form-control initial-value-example"  name="financialStartDate"  tabindex="4" maxlength="10" value="<?php echo $financialStartDate; ?>">
                        <?php echo form_error('financialStartDate') ?>
                     </div>
                     <div class="form-group">
                        <label for="financialExpireDate"> پایان </label>
                        <input type="text" id="endSche" class="form-control  initial-value-example"  name="financialExpireDate"  tabindex="5"	 value="<?php echo $financialExpireDate; ?>">
                        <?php echo form_error('scheduleEnd') ?>
                     </div>
                     <input type="hidden" id="startValue" value="<?=$sDateVaules;?>">
                     <input type="hidden" id="endValue" value="<?=$eDateVaules;?>">
                     <div class="form-group">
                        <label>وضعیت</label>
                        <div class="multi-checkbox">
                           <label>
                           <input type="radio" name="financialStatus" value="0" class="flat-red" <?=$statusChecked[0];?>>
                           غیر فعال
                           </label>
                           <?php
                              if($permission == "3" || $permission == "a"){
                              ?>
                           <label>
                           <input type="radio" name="financialStatus" value="1" class="flat-red" <?=$statusChecked[1];?> >
                           فعال
                           </label>
                           <?php } ?>
                        </div>
                     </div>
                  </div>

                  </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">ثبت تراکنش</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>


