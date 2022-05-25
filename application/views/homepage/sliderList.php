<?php
$allSelected = "<input type=\"checkbox\" data-action=\"allSelected\" data-module=\"Homepage\" data-source=\"Slider\" >";
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
                <a href="<?=base_url();?>Homepage/insertSlider"><i class="fa fa-plus-square"></i><span class="link-title"> درج تصویر جدید</span> </a>
            </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th class="text-center">ردیف</th>								
					<th class="text-center">عنوان</th>
					<th class="text-center">تصویر</th>
					<th class="text-center">ویرایش</th>
					<th class="text-center">حذف</th>
					<th class="text-center"> <?=$allSelected;?></th>
                </tr>
                </thead>
                <tbody>
                    <?php

                        $this->load->helper("str");


                        if($slider['count'] == 0){
                            echo "<tr>
                                    <td colspan=\"14\" class=\"text-center\">موردی یافت نشد </td>          
                                  </tr>";
                        }else{
                            foreach($slider["list"] as $rows){    

                                $deleteLink = "<span data-action=\"deleteItem\"  data-link=\"".base_url()."Homepage/deleteSlider/".$rows['sliderID']."/".$rows['sliderTitle']."\"><i class=\"glyphicon glyphicon-trash font-red\"></i></span>";
								$editLink = "<a href=\"".base_url()."Homepage/editSlider/".$rows['sliderID']."/".$page."\"><i class=\"fa fa-edit font-blue\"></i></a>";                                
                                $selected = "<input type=\"checkbox\" data-source=\"Slider\" data-module=\"Homepage\" name=\"selectedItem[]\" value=\"".$rows['sliderID']."\" data-title=\"".$rows['sliderTitle']."\" >";
								
								 if($permission == "1" || $permission == "0"){
                                
                                    $deleteLink = "<i class=\"glyphicon glyphicon-trash font-red\"></i>";
                                    $editLink = "<i class=\"fa fa-edit font-blue\"></i>"; 
									$selected = "<input type=\"checkbox\" disabled >";
                                
                                }

                                if($permission == "2"){

                                    $deleteLink = "<i class=\"glyphicon glyphicon-trash font-red\"></i>";                                   
									$editLink = "<a href=\"".base_url()."Homepage/editSlider/".$rows['sliderID']."/".$page."\"><i class=\"fa fa-edit font-blue\"></i></a>";                                
									$selected = "<input type=\"checkbox\" disabled >";    

                                }
                                          
                                echo "<tr>
										<td class=\"text-center\">".$counter."</td>
										<td class=\"text-center\">".$rows['sliderTitle']."</td>
                                        <td class=\"text-center\"><img src=\"" . base_url() . "assets/uploads/slider/" . $rows['sliderImg'] . "\" alt=\"slider\" style=\"width:120px;height:96px\"/></td>
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
					<th class="text-center">عنوان</th>
					<th class="text-center">تصویر</th>
					<th class="text-center">ویرایش</th>
					<th class="text-center">حذف</th>
					<th class="text-center"> <?=$allSelected;?></th>
                </tr>
                </tfoot>
              </table>
              <?=$slider['link'];?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>







