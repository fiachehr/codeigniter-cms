<?php
$allSelected = "<input type=\"checkbox\" data-action=\"allSelected\" data-module=\"Link\" data-source=\"Link\" >";
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
                <a href="<?=base_url();?>Link/insertLink"><i class="fa fa-plus-square"></i><span class="link-title">درج لینک جدید </span> </a>
            </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th class="text-center"> ردیف </th>           
                    <th class="text-center">عنوان لینک</th>
                    <th class="text-center">آدرس</th>
                    <th class="text-center"> محل نمایش</th>
                    <th class="text-center"> تاریخ ثبت</th>
                    <th class="text-center">وضعیت</th>
                    <th class="text-center"> ویرایش</th>
                    <th class="text-center"> حذف</th>
                    <th class="text-center"> <?=$allSelected;?></th>
                </tr>
                </thead>
                <tbody>
                <?php

                    $this->load->helper("pdate");

                    if($links['count'] == 0){
                        echo "<tr>
                                <td colspan=\"9\" class=\"text-center\">موردی یافت نشد </td>          
                            </tr>";
                    }else{

                        foreach($links["list"] as $rows){

                            if($rows['linkStatus'] == "d"){                                   
                                $status = "<span class=\"label label-warning\">غیر فعال</span>";                                 
                            }else{                                   
                                $status = "<span class=\"label label-success\">فعال</span>";                                 
                            }

                            if($rows['linkPosition'] == "rsb"){                                   
                                $position = "<span class=\"label label-warning\">سایدبار راست</span>";                                 
                            }else if($rows['linkPosition'] == "lsb"){                                 
                                $position = "<span class=\"label label-success\">سایدبار چپ</span>";                                 
                            }else if($rows['linkPosition'] == "f"){                                 
                                $position = "<span class=\"label label-danger\">فوتر</span>";                                 
                            }

                            $deleteLink = "<a href=\"".base_url()."Link/deleteLink/".$rows['linkID']."/".$rows['linkTitle']."\"><i class=\"glyphicon glyphicon-trash font-red\"></i></a>";
                            $editLink = "<a href=\"".base_url()."Link/editLink/".$rows['linkID']."\"><i class=\"fa fa-edit font-blue\"></i></a>";
                            $selected = "<input type=\"checkbox\" data-source=\"Link\" data-module=\"Link\" name=\"selectedItem[]\" value=\"".$rows['linkID']."\" data-title=\"".$rows['linkTitle']."\" >";

                            if($permission == "1" || $permission == "2"){
                            
                                $deleteLink = "<i class=\"glyphicon glyphicon-trash font-red\"></i>";
                                $editLink = "<i class=\"fa fa-edit font-blue\"></i>";
                                $selected = "<input type=\"checkbox\" disabled >"; 
                            
                            }
                            
                            echo "<tr>
                                    <td class=\"text-center\">".$count."</td>
                                    <td class=\"text-center\">".$rows['linkTitle']."</td>
                                    <td class=\"text-center\">".$rows['linkURL']."</td>
                                    <td class=\"text-center\">".$position."</td>
                                    <td class=\"text-center\">".greToJal($rows['created_at'])."</td>
                                    <td class=\"text-center\">".$status."</td>
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
                    <th class="text-center">عنوان لینک</th>
                    <th class="text-center">آدرس</th>
                    <th class="text-center"> محل نمایش</th>
                    <th class="text-center"> تاریخ ثبت</th>
                    <th class="text-center">وضعیت</th>
                    <th class="text-center"> ویرایش</th>
                    <th class="text-center"> حذف</th>
                    <th class="text-center"> <?=$allSelected;?></th>
                </tr>
                </tfoot>
              </table>
              <?=$links['link'];?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>




