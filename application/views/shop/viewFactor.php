

<?php
   $financialActionList = null;
   $extraAmount = 0;
   if($factorItems[0]["factorFinancialAction"] != null){
   	$financialAction = json_decode($factorItems[0]["factorFinancialAction"]);
   	foreach($financialAction as $rows){
   		$financialActionList .= "<tr>
   									<th class=\"text-center\">".$rows->actionTitle."</th>									
   									<td class=\"text-center\">".number_format($factorItems[0]['factorAmount']*($rows->actionPercent/100))." ریال</td>
   								 </tr>";
   		if($rows->actionType == "+"){
   			$extraAmount = $extraAmount + ($factorItems[0]['factorAmount']*($rows->actionPercent/100));
   		}else{
   			$extraAmount = $extraAmount - ($factorItems[0]['factorAmount']*($rows->actionPercent/100));
   		}
   
   	}
   }
   if($factorItems[0]["factorGiftCard"] != NULL){
   	$financialActionList .="<tr>
   								<th class=\"text-center\" >تخفیف کارت هدیه </th>									
   								<td class=\"text-center\">".number_format($factorItems[0]["factorGiftCard"])." ریال</td>
   							</tr>";
   	$extraAmount = $extraAmount -$factorItems[0]["factorGiftCard"];
   }
   $suspend = null;
   $resive = null;
   $create = null;
   $loading = null;
   $deliver =  null;
   if($factorItems[0]["factorStatus"] == "s"){
   	$suspend = "Selected=\"\"";
   }elseif ($factorItems[0]["factorStatus"] == "r"){
   	$resive = "Selected=\"\"";
   }elseif ($factorItems[0]["factorStatus"] == "c"){
   	$create = "Selected=\"\"";
   }elseif ($factorItems[0]["factorStatus"] == "l"){
   	$loading = "Selected=\"\"";
   }elseif ($factorItems[0]["factorStatus"] == "d"){
   	$deliver = "Selected=\"\"";
   }
   
   ?>	
<div class="content-wrapper">
   <section class="content">
   <div class="row">
      <div class="col-xs-12">
         <div class="box">
            <div class="box-header with-border">
               <div class="col-xs-5">
                  <h4 class="box-title"><?=$pageTitle;?></h4>
               </div>
               <div class="col-xs-2">
               </div>
               <div class="col-xs-5 panel-menu">
               </div>
            </div>
            <div class="box-body">
               <table class="table table-bordered table-striped" id="sample_1">
                  <thead>
                     <tr>
                        <th class="text-center">شماره فاکتور</th>
                        <td class="text-center"><?php echo $factorItems[0]["factorID"];?></td>
                        <th class="text-center">تاریخ فاکتور</th>
                        <td class="text-center"><?php echo substr($factorItems[0]["created_at"],10)." ".greToJal($factorItems[0]["created_at"])?></td>
                        <td class="text-center" rowspan="3"><?php echo "<img src=\"".$qrcode."\"  alt=\"".$factorItems[0]["factorID"]."\"/>"; ?></td>
                     </tr>
                     <tr>
                        <th class="text-center">نام خریدار</th>
                        <td class="text-center">آقای / خانم<?php echo " ".$factorItems[0]["userName"]."";?></td>
                        <th class="text-center">شماره تماس</th>
                        <td class="text-center"><?php echo $factorItems[0]["userMobileNo"];?></td>
                     </tr>
                     <tr>
                        <th class="text-center" colspan="1">آدرس ایمیل</th>
                        <td class="text-center" colspan="3"><?php echo $factorItems[0]["userEmail"];?></td>
                     </tr>
                     <tr>
                        <th class="text-center" colspan="1">آدرس</th>
                        <td class="text-center" colspan="4"><?php echo $state." - ".$factorItems[0]["title"]." - ".$factorItems[0]["factorSendAddress"];?></td>
                     </tr>
                     <tr>
                        <th class="text-center">ردیف</th>
                        <th class="text-center">عنوان</th>
                        <th class="text-center">تعداد</th>
                        <th class="text-center">قیمت واحد</th>
                        <th class="text-center">قیمت کل</th>
                     </tr>
                     <?php 
                        $counter = 1;
                        foreach($factorItems as $itemsRows){ 
                        
                        echo  "<tr>
                        <td class=\"text-center\">".$counter."</td>
                        <td class=\"text-center\">".$itemsRows['itemProductTitle']."</td>
                        <td class=\"text-center\">".$itemsRows['itemQuantity']."</td>
                        <td class=\"text-center\">".number_format($itemsRows['itemAmount'])." ریال</td>
                        <td class=\"text-center\">".number_format($itemsRows['itemAmount']*$itemsRows['itemQuantity'])." ریال</td>
                        </tr>";
                        $counter++;          
                        
                        } 
                        ?>         
                  </thead>
               </table>
            </div>
         </div>
         <div class="row">
            <div class="box-body">
               <div class="col-md-4">
                  <div class="box">
                     <div class="box-header with-border">
                        <div class="col-xs-12">
                           <i class="fa fa-money"></i> 
                           <h4 class="box-title">تخفیفات و مالیات</h4>
                        </div>
                     </div>
                     <div class="box-body">
                        <table class="table table-bordered table-striped">
                           <tbody>
                              <?=$financialActionList;?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="box">
                     <div class="box-header with-border">
                        <div class="col-xs-12">
                           <i class="fa fa-car"></i> 
                           <h4 class="box-title">هزینه حمل و نقل</h4>
                        </div>
                     </div>
                     <div class="box-body">
                        <table class="table table-bordered table-striped">
                           <tbody>
                              <tr>
                                 <th class="text-center">هزینه حمل و نقل</th>
                                 <td class="text-center"><?php echo number_format($factorItems[0]['factorDeliveryFee'])?> ریال</td>
                              </tr>
                              <tr>
                                 <th class="text-center">اعتبار کاربر</th>
                                 <td class="text-center"><?php echo number_format($factorItems[0]['factorUserAccount'])?> ریال</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="box">
                     <div class="box-header with-border">
                        <div class="col-xs-12">
                           <i class="fa fa-credit-card"></i> 
                           <h4 class="box-title">محاسبات نهایی</h4>
                        </div>
                     </div>
                     <div class="box-body">
                        <table class="table table-bordered table-striped">
                           <tbody>
                              <tr>
                                 <th class="text-center">مبلغ کل کالا :</th>
                                 <td class="text-center"><?php echo number_format($factorItems[0]['factorAmount'])?> ریال</td>
                              </tr>
                              <tr>
                                 <th class="text-center">تخفیفات و مالیاتها :</th>
                                 <td class="text-center"><?php echo number_format($extraAmount)?> ریال</td>
                              </tr>
                              <tr>
                                 <th class="text-center">قابل پرداخت :</th>
                                 <td class="text-center font-red bold"><?php echo number_format($factorItems[0]['factorPayment'])?> ریال</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title">وضعیت فاکتور</h3>
               </div>
               <form role="form" action="<?php echo base_url();?>Shop/viewFactor/<?php echo $factorItems[0]["factorID"];?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="form-group">
                        <label for="factorDelivery">وضعیت فاکتور</label>
                        <select class="form-control"  data-placeholder="انتخاب کنید" tabindex="1" name="factorStatus">
                           <option value="s" <?php echo $suspend;?>>معلق</option>
                           <option value="r" <?php echo $resive;?>>دریافت شده </option>
                           <option value="c" <?php echo $create?>> در حال آماده سازی</option>
                           <option value="l" <?php echo $loading;?>>تحویل برای ارسال</option>
                           <option value="d" <?php echo $deliver;?>>تحویل شده</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="factorDelivery">وضعیت پرداخت</label>
                        <select class="form-control"  data-placeholder="انتخاب کنید" tabindex="2" name="factorPaymentStatus">
                           <?php if($factorItems[0]['factorPaymentStatus'] == "e"){?>	
                           <option value="e" selected >پرداخت شده</option>
                           <option value="d">پرداخت نشده </option>
                           <?php }else{ ?>
                           <option value="e"  >پرداخت شده</option>
                           <option value="d" selected>پرداخت نشده </option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
            </div>
         </div>
         <div class="box-footer">				
         <button type="submit" name="submit" value="submit" class="btn btn-primary">تغییر وضعیت فاکتور</button>
         </div>	
         </form>
      </div>
   </section>
</div>

