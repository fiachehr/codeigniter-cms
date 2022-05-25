
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
                <a href="<?=base_url();?>Shop/insertFactorFinancial"><i class="fa fa-plus-square"></i><span class="link-title"> درج تنظیمات فاکتور</span> </a>
            </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th class="text-center">ردیف</th>							
					<th class="text-center">عنوان</th>
					<th class="text-center">درصد</th>
					<th class="text-center">تاریخ انقضا</th>
					<th class="text-center">وضعیت </th>
                    <th class="text-center">ویرایش</th>
                </tr>
                </thead>
                <tbody>
                    <?php
						$this->load->helper("pdate");
                        if($financial['count'] == 0){
                            echo "<tr>
                                    <td colspan=\"5\" class=\"text-center\">موردی یافت نشد </td>          
                                  </tr>";
                        }else{
                            foreach($financial["list"] as $rows){

								if(compare2Date($rows['financialExpireDate'],date("Y-m-d H:i:s"))){
									$status = "<span class=\"label label-danger\">منقضی</span>";      
								}elseif($rows['financialStatus'] == "0"){                                   
                                    $status = "<span class=\"label label-warning\"> غیر فعال</span>";                                 
                                }else{                                   
                                    $status = "<span class=\"label label-success\">فعال</span>";                                 
                                }
                                $percent = "<span class=\"label label-success\">".$rows['financialPercent']."% <i class=\"fa fa-long-arrow-down\"></i></span> ";
                                if($rows['financialType'] == "+"){
                                    $percent = "<span class=\"label label-warning\">".$rows['financialPercent']."% <i class=\"fa fa-long-arrow-up\"></i></span>";
                                }
								
                                $selected = "<input type=\"checkbox\" data-source=\"FactorFinancial\" data-module=\"Shop\" name=\"selectedItem[]\" value=\"".$rows['financialID']."\" data-title=\"".$rows['financialTitle']."\" >";
                                $editLink = "<a href=\"".base_url()."Shop/editFactorFinancial/".$rows['financialID']."\"><i class=\"fa fa-edit font-blue\"></i></a>";
				
								 if($permission == "1" || $permission == "0"){
                                    $selected = "<input type=\"checkbox\" disabled >";
                                    $editLink = "<i class=\"fa fa-edit font-blue\"></i>";

                                }
                                if($permission == "2"){
                                    $selected = "<input type=\"checkbox\" disabled >";    
                                    $editLink = "<a href=\"".base_url()."Shop/editFactorFinancial/".$rows['financialID']."\"><i class=\"fa fa-edit font-blue\"></i></a>";

                                }
            
                                
                                echo "<tr>
										<td class=\"text-center\">".$counter."</td>
										<td class=\"text-center\">".$rows['financialTitle']."</td>
										<td class=\"text-center\">".$percent."</td>                                        
										<td class=\"text-center\">".greToJal($rows['financialExpireDate'])."</td>
										<td class=\"text-center\">".$status."</td>
                                        <td class=\"text-center\">".$editLink."</td>                                             
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
					<th class="text-center">عنوان</th>
					<th class="text-center">درصد</th>
					<th class="text-center">تاریخ انقضا</th>
					<th class="text-center">وضعیت </th>
                    <th class="text-center">ویرایش</th>
                </tr>
                </tfoot>
              </table>
              <?=$financial['link'];?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

