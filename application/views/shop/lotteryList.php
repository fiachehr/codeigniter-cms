<?php
$allSelected = "<input type=\"checkbox\" data-action=\"allSelected\" data-module=\"Shop\" data-source=\"Lottery\" >";
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
                <a href="<?=base_url();?>Shop/insertLottery"><i class="fa fa-plus-square"></i><span class="link-title">درج قرعه کشی جدید</span> </a>
            </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center">ردیف</th>							
					<th class="text-center">عنوان قرعه کشی</th>
                    <th class="text-center">تعداد برندگان</th>
                    <th class="text-center">تاریخ انقضا</th>
					<th class="text-center">لیست شانسها</th>
                    <th class="text-center">قرعه کشی</th>
					<th class="text-center">وضعیت </th>
					<th class="text-center">حذف</th>
					<th class="text-center"> <?=$allSelected;?></th>
                </tr>
                </thead>
                <tbody>
                    <?php
						$this->load->helper("str");
						$this->load->helper("pdate");
                        if($lottery['count'] == 0){
                            echo "<tr>
                                    <td colspan=\"9\" class=\"text-center\">موردی یافت نشد </td>          
                                  </tr>";
                        }else{
                            foreach($lottery["list"] as $rows){

								if(compare2Date($rows['lotteryExpireDate'],date("Y-m-d H:i:s")) && $rows['lotteryStatus'] == "e"){
                                    $status = "<span class=\"label label-danger\">منقضی</span>";    
                                    $runLottery = "<a href=\"".base_url()."Shop/runLottery/".$rows['lotteryGUID']."\"><span class=\"label label-success\">قرعه کشی</span></a>";
								}elseif($rows['lotteryStatus'] == "d"){                                   
                                    $status = "<span class=\"label label-warning\">پایان یافته</span>";    
                                    $runLottery = "<span class=\"label label-danger\">انجام شده</span>";
                                }else{                                   
                                    $status = "<span class=\"label label-success\">فعال</span>";  
                                    $runLottery = "<span class=\"label label-warning\">در انتظار</span>";                               
								}
								
                                $deleteLink = "<span data-action=\"deleteItem\"  data-link=\"".base_url()."Shop/deleteLottery/".$rows['lotteryGUID']."/".str_replace(" ","-",$rows['lotteryTitle'])."/\"><i class=\"glyphicon glyphicon-trash font-red\"></i></span>";
                                $selected = "<input type=\"checkbox\" data-source=\"Lottery\" data-module=\"Shop\" name=\"selectedItem[]\" value=\"".$rows['lotteryGUID']."\" data-title=\"".$rows['lotteryGUID']."\" >";
                                $chanceList = "<a href=\"".base_url()."Shop/lotteryChanceList/".$rows['lotteryGUID']."/".str_replace(" ","-",$rows['lotteryTitle'])."\"><i class=\"fa fa-ticket font-red\" ></i></a>";
					
								if($permission == "1" || $permission == "0" || $permission == "2"){
                                    $deleteLink = "<i class=\"glyphicon glyphicon-trash font-red\"></i>";
                                    $deleteLink = "<i class=\"glyphicon glyphicon-trash font-red\"></i>";
                                    $chanceList = "<i class=\"fa fa-ticket font-red\" ></i>";
                                    $runLottery = "<span class=\"label label-danger\">غیر فعال</span>";
                                }            
                                
                                echo "<tr>
										<td class=\"text-center\">".$counter."</td>
										<td class=\"text-center\">".$rows['lotteryTitle']."</td>
                                        <td class=\"text-center\">".$rows['lotteryWinnerCount']."</td>     
                                        <td class=\"text-center\">".greToJal($rows['lotteryExpireDate'])."</td> 
                                        <td class=\"text-center\">".$chanceList."</td>                                  
										<td class=\"text-center\">".$runLottery."</td> 
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
					<th class="text-center">عنوان قرعه کشی</th>
                    <th class="text-center">تعداد برندگان</th>
                    <th class="text-center">تاریخ انقضا</th>
                    <th class="text-center">لیست شانسها</th>
                    <th class="text-center">قرعه کشی</th>
					<th class="text-center">وضعیت </th>
					<th class="text-center">حذف</th>
					<th class="text-center"> <?=$allSelected;?></th>
                </tr>
                </tfoot>
              </table>
              <?=$lottery['link'];?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

