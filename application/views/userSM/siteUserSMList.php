<?php
$allSelected = "<input type=\"checkbox\" data-action=\"allSelected\" data-module=\"UserSM\" data-source=\"UserSM\" >";
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
                <a href="<?=base_url();?>UserSM/insertUserSM"><i class="fa fa-plus-square"></i><span class="link-title">درج کاربر جدید </span> </a>
            </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th class="text-center"> ردیف </th>           
                    <th class="text-center">نام و نا خانوادگی</th>
                    <th class="text-center">شماره تماس</th>
                    <th class="text-center"> آدرس ایمیل</th>
                    <th class="text-center"> تاریخ ثبت</th>
                    <th class="text-center">وضعیت</th>
                    <th class="text-center">تغییر کلمه عبور</th>
                    <th class="text-center"> ویرایش</th>
                    <th class="text-center"> حذف</th>
                    <th class="text-center"> <?=$allSelected;?></th>
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

                            if($rows['userStatus'] == "d"){                                   
                                $status = "<span class=\"label label-warning\">غیر فعال</span>";                                 
                            }else{                                   
                                $status = "<span class=\"label label-success\">فعال</span>";                                 
                            }

                            $passwordLink = "<a href=\"".base_url()."UserSM/changeUserSMPassword/".$rows['userGUID']."/".$rows['userName']."\"><i class=\"fa fa-lock font-yellow\"></i></a>";               
                            $deleteLink = "<a href=\"".base_url()."UserSM/deleteUserSM/".$rows['userGUID']."/".$rows['userName']."\"><i class=\"glyphicon glyphicon-trash font-red\"></i></a>";
                            $editLink = "<a href=\"".base_url()."UserSM/editUserSM/".$rows['userGUID']."\"><i class=\"fa fa-edit font-blue\"></i></a>";
                            $selected = "<input type=\"checkbox\" data-source=\"UserSM\" data-module=\"UserSM\" name=\"selectedItem[]\" value=\"".$rows['userGUID']."\" data-title=\"".$rows['userName']."\" >";

                            if($permission == "1" || $permission == "2"){
                            
                                $deleteLink = "<i class=\"glyphicon glyphicon-trash font-red\"></i>";
                                $passwordLink = "<i class=\"fa fa-lock font-yellow\"></i>";
                                $editLink = "<i class=\"fa fa-edit font-blue\"></i>";
                                $selected = "<input type=\"checkbox\" disabled >"; 
                            
                            }
                            
                            echo "<tr>
                                    <td class=\"text-center\">".$count."</td>
                                    <td class=\"text-center\">".$rows['userName']."</td>
                                    <td class=\"text-center\">".$rows['userMobileNo']."</td>
                                    <td class=\"text-center\">".$rows['userEmail']."</td>
                                    <td class=\"text-center\">".greToJal($rows['created_at'])."</td>
                                    <td class=\"text-center\">".$status."</td>
                                    <td class=\"text-center\">".$passwordLink."</td>
                                    <td class=\"text-center\">".$editLink."</td>
                                    <td class=\"text-center\">".$deleteLink."</td>
                                    <td class=\"text-center\">".$selected."</td>   
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
                <th class="text-center">نام و نا خانوادگی</th>
                    <th class="text-center">شماره تماس</th>
                    <th class="text-center"> آدرس ایمیل</th>
                    <th class="text-center"> تاریخ ثبت</th>
                    <th class="text-center">وضعیت</th>
                    <th class="text-center">تغییر کلمه عبور</th>
                    <th class="text-center"> ویرایش</th>
                    <th class="text-center"> حذف</th>
                    <th class="text-center"> <?=$allSelected;?></th>
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




