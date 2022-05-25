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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center">ردیف</th>							
					<th class="text-center">کد</th>
                    <th class="text-center">نام خریدار</th>
                    <th class="text-center">شماره تماس خریدار</th>
                    <th class="text-center">نوع خریدار</th>
					<th class="text-center">وضعیت </th>
                </tr>
                </thead>
                <tbody>
                    <?php
						$this->load->helper("str");
						$this->load->helper("pdate");
                        if($chance['count'] == 0){
                            echo "<tr>
                                    <td colspan=\"5\" class=\"text-center\">موردی یافت نشد </td>          
                                  </tr>";
                        }else{
                            foreach($chance["list"] as $rows){

								if($rows['chanceStatus'] == "d"){
                                    $status = "<span class=\"label label-danger\">استفاده نشده</span>";    
								}elseif($rows['chanceStatus'] == "l"){                                   
                                    $status = "<span class=\"label label-warning\">بازنده</span>";    
                                }elseif($rows['chanceStatus'] == "w"){                                   
                                    $status = "<span class=\"label label-success\"> **برنده **</span>";  
                                }elseif($rows['chanceStatus'] == "e"){ 
                                    $status = "<span class=\"label label-success\"> استفاده شده</span>";  
                                }
                                if($rows['chanceUserType'] == "on"){
                                    $type = "<span class=\"label label-warning\">آفلاین</span>";    
                                }else{                                   
                                    $type = "<span class=\"label label-success\">آنلاین</span>";  
								}
								                                
                                echo "<tr>
										<td class=\"text-center\">".$counter."</td>
										<td class=\"text-center\">".$rows['chanceCode']."</td>
                                        <td class=\"text-center\">".$rows['chanceUserName']."</td>     
                                        <td class=\"text-center\">".$rows['chanceUserMobileNo']."</td> 
                                        <td class=\"text-center\">".$type."</td>                                  
										<td class=\"text-center\">".$status."</td>                                            
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
					<th class="text-center">کد</th>
                    <th class="text-center">نام خریدار</th>
                    <th class="text-center">شماره تماس خریدار</th>
                    <th class="text-center">نوع خریدار</th>
					<th class="text-center">وضعیت </th>
                </tr>
                </tfoot>
              </table>
              <?=$chance['link'];?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

