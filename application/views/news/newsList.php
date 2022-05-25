<?php
$allSelected = "<input type=\"checkbox\" data-action=\"allSelected\" data-module=\"News\" data-source=\"News\" >";
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
                <a href="<?=base_url();?>News/insertNews"><i class="fa fa-plus-square"></i><span class="link-title"> درج خبر جدید</span> </a>
            </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th class="text-center">ردیف</th>
					<th class="text-center">کد</th>									
					<th class="text-center">عنوان</th>
					<th class="text-center">دسته بندی</th>
					<th class="text-center">نویسنده</th>										
					<th class="text-center">تاریخ</th>									
					<th class="text-center">بازدید</th>	
					<th class="text-center">نظرات</th>																
					<th class="text-center">مشخصه</th>
					<th class="text-center">وضعیت</th>
					<th class="text-center">ویرایش</th>
					<th class="text-center">حذف</th>
					<th class="text-center"> <?=$allSelected;?></th>
                </tr>
                </thead>
                <tbody>
                    <?php

                        $this->load->helper("str");


                        if($news['count'] == 0){
                            echo "<tr>
                                    <td colspan=\"14\" class=\"text-center\">موردی یافت نشد </td>          
                                  </tr>";
                        }else{
                            foreach($news["list"] as $rows){

                                if($rows['newsStatus'] == "0"){                                   
                                    $status = "<span class=\"label label-warning\">غیر فعال</span>";                                 
                                }else{                                   
                                    $status = "<span class=\"label label-success\">فعال</span>";                                 
                                }

                                $deleteLink = "<span data-action=\"deleteItem\"  data-link=\"".base_url()."News/deleteNews/".$rows['newsGUID']."/".$rows['newsTitle']."\"><i class=\"glyphicon glyphicon-trash font-red\"></i></span>";
								$editLink = "<a href=\"".base_url()."News/editNews/".$rows['newsGUID']."/".$page."\"><i class=\"fa fa-edit font-blue\"></i></a>";                                
                                $selected = "<input type=\"checkbox\" data-source=\"News\" data-module=\"News\" name=\"selectedItem[]\" value=\"".$rows['newsGUID']."\" data-title=\"".$rows['newsTitle']."\" >";
                                $propertyLink = "<a href=\"".base_url()."property/addPropertyValue/".$rows['newsGUID']."/".cleanString($rows['newsTitle'])."/1\"><i class=\"fa fa-list-alt  font-red\"></i></a>";
								
								 if($permission == "1" || $permission == "0"){
                                
                                    $deleteLink = "<i class=\"glyphicon glyphicon-trash font-red\"></i>";
                                    $editLink = "<i class=\"fa fa-edit font-blue\"></i>"; 
									$selected = "<input type=\"checkbox\" disabled >";
									$propertyLink = "<i class=\"fa fa-list-alt  font-red\"></i>";				
                                
                                }

                                if($permission == "2"){

                                    $deleteLink = "<i class=\"glyphicon glyphicon-trash font-red\"></i>";                                   
									$editLink = "<a href=\"".base_url()."Job/editJob/".$rows['newsGUID']."/".$page."\"><i class=\"fa fa-edit font-blue\"></i></a>";                                
									$selected = "<input type=\"checkbox\" disabled >";    
									$propertyLink = "<i class=\"fa fa-list-alt  font-red\"></i>";

                                }
            
                                
                                echo "<tr>
										<td class=\"text-center\">".$counter."</td>
										<td class=\"text-center\">".$rows['newsCode']."</td>
                                        <td class=\"text-center\"><span data-list-title=\"".$rows['newsTitle']."\">".word_limiter($rows['newsTitle'],3)."</span></td>
                                        <td class=\"text-center\">".$rows['title']."</td>
                                        <td class=\"text-center\">".$rows['newsArthur']."</td>
                                        <td class=\"text-center\">".greToJal($rows['created_at'])." | ".substr($rows['created_at'],10)."</td>
                                        <td class=\"text-center\">".$rows['newsHits']."</td>
                                        <td class=\"text-center\">".$rows['newsCommentCount']."</td>
										<td class=\"text-center\">".$propertyLink."</td>
										<td class=\"text-center\">".$status."</td>
                                        <td class=\"text-center\">".$editLink."</td>
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
					<th class="text-center">کد</th>									
					<th class="text-center">عنوان</th>
					<th class="text-center">دسته بندی</th>
					<th class="text-center">نویسنده</th>										
					<th class="text-center">تاریخ</th>									
					<th class="text-center">بازدید</th>	
					<th class="text-center">نظرات</th>																	
					<th class="text-center">مشخصه</th>
					<th class="text-center">وضعیت</th>
					<th class="text-center">ویرایش</th>
					<th class="text-center">حذف</th>
					<th class="text-center"> <?=$allSelected;?></th>
                </tr>
                </tfoot>
              </table>
              <?=$news['link'];?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>



