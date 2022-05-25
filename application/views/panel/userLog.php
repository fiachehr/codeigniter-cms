<div class="content-wrapper">
<section class="content">
      <div class="row">
        <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="col-xs-12">
                    <h4 class="box-title"><?=$pageTitle;?></h4>
                </div>
                
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center"> ردیف </th>           
                    <th class="text-center">نام و نام خانوادگی</th>
                    <th class="text-center">زمان</th>
                    <th class="text-center">IP</th>
                    <th class="text-center"> شرح فعالیت </th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $this->load->helper("pdate");
                        if($users['count'] == 0){
                            echo "<tr>
                                    <td colspan=\"8\" class=\"text-center\">موردی یافت نشد </td>          
                                  </tr>";
                        }else{

                            foreach($users["list"] as $rows){                              
                                echo "<tr>
                                        <td class=\"text-center\">".$count."</td>
                                        <td class=\"text-center\">".$rows['adminUserFName']." ".$rows['adminUserLName']."</td>
                                        <td class=\"text-center\">".substr($rows['logDate'],10). " | ".greToJal($rows['logDate'])."</td>
                                        <td class=\"text-center\">".$rows['logUserIP']."</td>
                                        <td class=\"text-center\">".$rows['logMessage']."</td>

                                    </tr>
                                    ";
                                $count++;
                            }
                            
                        }
                           					
					?>        
                </tbody>
                <tfoot>
                <tr>          
                    <th class="text-center"> ردیف </th>           
                    <th class="text-center">نام و نام خانوادگی</th>
                    <th class="text-center">زمان</th>
                    <th class="text-center">IP</th>
                    <th class="text-center"> شرح فعالیت </th>
                </tr>
                </tfoot>
              </table>
              <?=$users['link'];?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>




