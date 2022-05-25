<?php
   $contactType = array("email"=>"ایمیل","phone"=>"شماره تماس","mobile"=>"شماره موبایل","address"=>"آدرس پستی","sn-facebook"=>"فیسبوک",
                        "sn-linkedin"=>"لینکدین","sn-twitter"=>"توییتر","sn-instagram"=>"اینستاگرام","sn-telegram"=>"تلگرام","map"=>"نقشه",
                        "sn-google"=>"گوگل پلاس","sn-youtube"=>"یوتیوب","sn-aparat"=>"آپارات","sn-wiki"=>"ویکیپدیا","sn-pintrest"=>"پینترست","sn-whatsapp"=>"واتساپ");
   
   $contactTitle = set_value('');		
   $contactValue = set_value('');
   $counter = 0;



if($resultMessage['result'] == "Alert"){

   $contactTitle = set_value('contactTitle',$this->input->post('contactTitle'));		
   $contactValue = set_value('contactValue',$this->input->post('contactValue'));
   $counter = 1;

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
					<form role="form" action="<?php echo base_url();?>Category/insertContact" method="post" enctype="multipart/form-data">
						
                  <div class="box-body">
                     <div class="form-group">
                        <label for="contactTitle">عنوان اطلاعات ارتباطی</label>
                        <input type="text" class="form-control" id="contactTitle" name="contactTitle"  tabindex="1" value="<?php echo $contactTitle; ?>" >
                        <?php echo form_error('contactTitle') ?>
                     </div>
                     <div class="form-group">
                        <label for="contactValue"> مقدار اطلاعات ارتباطی </label>
                        <input type="text" class="form-control"id="contactValue" name="contactValue"  tabindex="3" value="<?php echo $contactValue; ?>" >
                        <?php echo form_error('contactValue') ?>
                     </div>
                     <div class="form-group">
                        <label>نوع اطلاعات ارتباطی</label>
                        <select class="form-control select2" name="contactType" >
                            <?php 
                            foreach($contactType as $key => $value){
                                if($counter == 0 || $this->input->post('contactType') == $key){
                                    echo "<option selected=\"selected\" value=\"".$key."\">".$value."</option>";
                                    $counter = 1;
                                }else{
                                    echo "<option value=\"".$key."\">".$value."</option>";
                                }
                            }
                            ?>
                        </select>
                     </div>
                  </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">ثبت اطلاعات ارتباطی</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>




