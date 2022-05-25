<?php
$allSelected = "<input type=\"checkbox\" data-action=\"allSelected\" data-module=\"Shop\" data-source=\"GiftCard\" >";
if($permission == "1" || $permission == "2"){                           
    $allSelected = "<input type=\"checkbox\" disabled >";
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
                <a href="<?=base_url();?>Shop/insertGiftCard"><i class="fa fa-plus-square"></i><span class="link-title"> درج کارت هدیه جدید</span> </a>
            </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th class="text-center">ردیف</th>							
					<th class="text-center">شماره کارت</th>
					<th class="text-center">مبلغ کارت</th>
					<th class="text-center">تاریخ انقضا</th>
					<th class="text-center">وضعیت کارت</th>
					<th class="text-center">حذف</th>
					<th class="text-center"> <?=$allSelected;?></th>
                </tr>
                </thead>
                <tbody>
                    <?php
						$this->load->helper("str");
						$this->load->helper("pdate");
                        if($giftCard['count'] == 0){
                            echo "<tr>
                                    <td colspan=\"7\" class=\"text-center\">موردی یافت نشد </td>          
                                  </tr>";
                        }else{
                            foreach($giftCard["list"] as $rows){

								if(compare2Date($rows['giftCardExpireDate'],date("Y-m-d H:i:s"))){
									$status = "<span class=\"label label-danger\">منقضی</span>";      
								}elseif($rows['giftCardStatus'] == "d"){                                   
                                    $status = "<span class=\"label label-warning\">استفاده شده</span>";                                 
                                }else{                                   
                                    $status = "<span class=\"label label-success\">فعال</span>";                                 
								}
								
                                $deleteLink = "<span data-action=\"deleteItem\"  data-link=\"".base_url()."Shop/deleteGiftCard/".$rows['giftID']."/".$rows['giftCardID']."/\"><i class=\"glyphicon glyphicon-trash font-red\"></i></span>";
                                $selected = "<input type=\"checkbox\" data-source=\"GiftCard\" data-module=\"Shop\" name=\"selectedItem[]\" value=\"".$rows['giftID']."\" data-title=\"".$rows['giftCardID']."\" >";
								
								 if($permission == "1" || $permission == "0"){
                                    $deleteLink = "<i class=\"glyphicon glyphicon-trash font-red\"></i>";
									$selected = "<input type=\"checkbox\" disabled >";
                                }
                                if($permission == "2"){
                                    $deleteLink = "<i class=\"glyphicon glyphicon-trash font-red\"></i>";                                   
									$selected = "<input type=\"checkbox\" disabled >";    
                                }
            
                                
                                echo "<tr>
										<td class=\"text-center\">".$counter."</td>
										<td class=\"text-center\">".$rows['giftCardID']."</td>
										<td class=\"text-center\">".greToJal($rows['created_at'])."</td>                                        
										<td class=\"text-center\">".greToJal($rows['giftCardExpireDate'])."</td>
										<td class=\"text-center\">".$status."</td>
                                        <td class=\"text-center\">".$deleteLink."</td> 
                                        <td class=\"text-center\">".$selected."</td>                                                 
                                    </tr>
                                    ";
                                $counter++;
                            }
                            
                        }
                           					
					?>        
                </tbody>
                <tfoot>
                <tr>
				<th class="text-center">ردیف</th>							
					<th class="text-center">شماره کارت</th>
					<th class="text-center">مبلغ کارت</th>
					<th class="text-center">تاریخ انقضا</th>
					<th class="text-center">وضعیت کارت</th>
					<th class="text-center">حذف</th>
					<th class="text-center"> <?=$allSelected;?></th>
                </tr>
                </tfoot>
              </table>
              <?=$giftCard['link'];?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

