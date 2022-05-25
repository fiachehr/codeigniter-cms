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
					<th class="text-center">شماره فاکتور</th>
					<th class="text-center"> نام خریدار</th>
					<th class="text-center">شماره تماس</th>
					<th class="text-center">تاریخ ثبت</th>
					<th class="text-center">مبلغ فاکتور (ریال)</th>
					<th class="text-center">وضعیت مرسوله </th>
					<th class="text-center">وضعیت فاکتور </th>
					<!-- <th class="text-center">پرینت فاکتور</th> -->
					<th class="text-center">نمایش فاکتور</th>
					<th class="text-center">حذف</th>
                </tr>
                </thead>
                <tbody>
                    <?php
						$this->load->helper("str");
						$this->load->helper("pdate");
                        if($factor['count'] == 0){
                            echo "<tr>
                                    <td colspan=\"10\" class=\"text-center\">موردی یافت نشد </td>          
                                  </tr>";
                        }else{
							$counter = 1;
                            foreach($factor["list"] as $rows){

								if($rows['factorPaymentStatus'] == "d"){
									$status = "<span class=\"label label-warning\">پرداخت نشده</span>";
								}else if($rows['factorPaymentStatus'] == "e"){
									$status = "<span class=\"label label-success\">پرداخت شده</span>";
								}

								if($rows['factorStatus'] == "s"){
									$delivery = "<span class=\"label label-danger\">معلق</span>";
								}else if($rows['factorStatus'] == "r"){
									$delivery = "<span class=\"label label-warning\">دریافت شده</span>";
								}else if($rows['factorStatus'] == "c"){
									$delivery = "<span class=\"label label-info\">آماده سازی</span>";
								}else if($rows['factorStatus'] == "l"){
									$delivery = "<span class=\"label label-info\">ارسال شده</span>";
								}else if($rows['factorStatus'] == "ی"){
									$delivery = "<span class=\"label label-success\">تحویل داده شده</span>";
								}
								
                                $deleteLink = "<span data-action=\"deleteItem\"  data-link=\"".base_url()."Shop/deleteFactor/".$rows['factorID']."/\"><i class=\"glyphicon glyphicon-trash font-red\"></i></span>";
								//$printView = "<a href=\"".base_url()."Shop/printView/".$rows['factorID']."\"><i class=\"glyphicon glyphicon-print font-gray\"></i></a>";
                                $factorView = "<a href=\"".base_url()."Shop/viewFactor/".$rows['factorID']."\"><i class=\"fa fa-eye font-red\"></i></a>";

								if($permission == "1" || $permission == "0" || $permission == "2"){
									$deleteLink = "<i class=\"glyphicon glyphicon-trash font-red\"></i>";
									//$printView = "<i class=\"glyphicon glyphicon-print font-gray\"></i>";
									$factorView = "<i class=\"fa fa-eye font-red\"></i>";
								}
                                if($permission == "3"){
									$deleteLink = "<span data-action=\"deleteItem\"  data-link=\"".base_url()."Shop/deleteFactor/".$rows['factorID']."/\"><i class=\"glyphicon glyphicon-trash font-red\"></i></span>";
									//$printView = "<a href=\"".base_url()."Shop/printView/".$rows['factorID']."\"><i class=\"glyphicon glyphicon-print font-gray\"></i></a>";
									$factorView = "<a href=\"".base_url()."Shop/factorView/".$rows['factorID']."\"><i class=\"fa fa-eye font-red\"></i></a>";
								}
            
                                
                                echo "<tr>
										<td class=\"text-center\">".$counter."</td>
										<td class=\"text-center\">".$rows['factorID']."</td>
										<td class=\"text-center\">".$rows['userName']."</td>     
										<td class=\"text-center\">".$rows['userMobileNo']."</td>                                         
										<td class=\"text-center\">".greToJal($rows['factorRegDate'])."</td>
										<td class=\"text-center\">".number_format($rows['factorPayment'])."</td> 
										<td class=\"text-center\">".$status."</td>
										<td class=\"text-center\">".$delivery."</td>
										<td class=\"text-center\">".$factorView."</td>
                                        <td class=\"text-center\">".$deleteLink."</td>                                               
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
					<th class="text-center">شماره فاکتور</th>
					<th class="text-center"> نام خریدار</th>
					<th class="text-center">شماره تماس</th>
					<th class="text-center">تاریخ ثبت</th>
					<th class="text-center">مبلغ فاکتور (ریال)</th>
					<th class="text-center">وضعیت مرسوله </th>
					<th class="text-center">وضعیت فاکتور </th>
					<!-- <th class="text-center">پرینت فاکتور</th> -->
					<th class="text-center">نمایش فاکتور</th>
					<th class="text-center">حذف</th>
                </tr>
                </tfoot>
              </table>
              <?=$factor['link'];?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

