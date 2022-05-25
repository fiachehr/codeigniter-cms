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
                <a href="<?=base_url();?>Acms/insertUser"><i class="fa fa-plus-square"></i><span class="link-title">درج کاربر مدیریت</span> </a>
            </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center"> ردیف </th>           
                    <th class="text-center">آدرس ایمیل</th>
                    <th class="text-center">نام و نام خانوادگی</th>
                    <th class="text-center">گروه کاربری</th>
                    <th class="text-center">وضعیت</th>
                    <th class="text-center">تغییر کلمه عبور</th>
                    <th class="text-center"> ویرایش</th>
                    <th class="text-center"> حذف</th>
                </tr>
                </thead>
                <tbody>
                    <?php

                        if($users['count'] == 0){
                            echo "<tr>
                                    <td colspan=\"8\" class=\"text-center\">موردی یافت نشد </td>          
                                  </tr>";
                        }else{

                            foreach($users["list"] as $rows){

                                $passwordLink = "<a href=\"".base_url()."Acms/changeAdminUserPassword/".$rows['adminUserGUID']."/".$rows['adminUserFName']."-".$rows['adminUserLName']."\"><i class=\"fa fa-lock font-yellow\"></i></a>";

                                if($rows['adminUserStatus'] == 0){                                   
                                    $status = "<span class=\"label label-warning\">غیر فعال</span>";
                                    $passwordLink = "<i class=\"fa fa-lock font-yellow\"></i>";                                   
                                }else if($rows['adminUserStatus'] == 1){                                   
                                    $status = "<span class=\"label label-success\">فعال</span>";                                 
                                }else if($rows['adminUserStatus'] == 2){                                 
                                    $status = "<span class=\"label label-danger\">معلق</span>";        
                                    $passwordLink = "<i class=\"fa fa-lock font-yellow\"></i>";                           
                                }

                                $deleteLink = "<a href=\"".base_url()."Acms/deleteUser/".$rows['adminUserGUID']."/".$rows['adminUserFName']."-".$rows['adminUserLName']."\"><i class=\"glyphicon glyphicon-trash font-red\"></i></a>";
                                $editLink = "<a href=\"".base_url()."Acms/editUser/".$rows['adminUserGUID']."\"><i class=\"fa fa-edit font-blue\"></i></a>";
                                
                                if($permission == "1" || $permission == "2"){
                                
                                    $deleteLink = "<i class=\"glyphicon glyphicon-trash font-red\"></i>";
                                    $passwordLink = "<i class=\"fa fa-lock font-yellow\"></i>";
                                    $editLink = "<i class=\"fa fa-edit font-blue\"></i>"; 
                                
                                }
                                
                                echo "<tr>
                                        <td class=\"text-center\">".$count."</td>
                                        <td class=\"text-center\">".$rows['adminUserEmail']."</td>
                                        <td class=\"text-center\">".$rows['adminUserFName']." ".$rows['adminUserLName']."</td>
                                        <td class=\"text-center\">".$rows['title']."</td>
                                        <td class=\"text-center\">".$status."</td>
                                        <td class=\"text-center\">".$passwordLink."</td>
                                        <td class=\"text-center\">".$editLink."</td>
                                        <td class=\"text-center\">".$deleteLink."</td>
                                    </tr>
                                    ";
                                $count++;
                            }
                            
                        }
                           					
					?>        
                </tbody>
                <tfoot>
                <tr>
                <th class="text-center">ردیف </th>           
                    <th class="text-center">آدرس ایمیل</th>
                    <th class="text-center">نام و نام خانوادگی</th>
                    <th class="text-center">گروه کاربری</th>
                    <th class="text-center">وضعیت</th>
                    <th class="text-center">تغییر کلمه عبور</th>
                    <th class="text-center"> ویرایش</th>
                    <th class="text-center"> حذف</th>
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




