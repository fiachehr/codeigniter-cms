<?php
$allSelected = "<input type=\"checkbox\" data-action=\"allSelected\" data-module=\"Homepage\" data-source=\"HomepageItem\" >";
$deleteLink = null;
$selected = null;
$editLink = null;

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
                    <?php 
                    if($this->session->userdata("userStatus") == "a"){
                    ?>
                    <a href="<?=base_url();?>Homepage/insertHomepageItem"><i class="fa fa-plus-square"></i><span class="link-title"> درج بخش جدید</span> </a>
                    <?php } ?>
                </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th class="text-center">ردیف</th>								
                    <th class="text-center">عنوان</th>	
                    <th class="text-center"> نوع باکس</th>
                    <?php 
                    if($this->session->userdata("userStatus") == "a"){
                    ?>		
                    <th class="text-center">ویرایش</th>																												
					<th class="text-center">حذف</th>
					<th class="text-center"> <?=$allSelected;?></th>
                    <?php }else{ ?>
                    <th class="text-center">ویرایش</th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                    <?php

                        $this->load->helper("str");
                        if(count($homepage) == 0 || $homepage == NULL){
                            echo "<tr>
                                    <td colspan=\"14\" class=\"text-center\">موردی یافت نشد </td>          
                                  </tr>";
                        }else{
                            foreach($homepage as $rows){

                                $boxType = "باکس کوچک";
                                if($rows['homeItemType'] == "LBX"){
                                    $boxType = "باکس بزرگ";
                                }elseif($rows['homeItemType'] == "PLX"){
                                    $boxType = "پارالاکس";
                                }

                                if($this->session->userdata("userStatus") == "a"){
                                    $deleteLink = "<td class=\"text-center\"><span data-action=\"deleteItem\"  data-link=\"".base_url()."Homepage/deleteHomepageItem/".$rows['homeItemID']."/".$rows['homeItemLabel']."\"><i class=\"glyphicon glyphicon-trash font-red\"></i></span></td>";
                                    $selected = "<td class=\"text-center\"><input type=\"checkbox\" data-source=\"Homepage\" data-module=\"Homepage\" name=\"selectedItem[]\" value=\"".$rows['homeItemID']."\" data-title=\"".$rows['homeItemLabel']."\" ></td>";
                                    $editLink = "<td class=\"text-center\"><a href=\"".base_url()."Homepage/editHomepageItem/".$rows['homeItemID']."\"><i class=\"fa fa-edit font-blue\"></i></a></td>";                                
                                }elseif($permission == "2" || $permission == "3"){
                                    $editLink = "<td class=\"text-center\"><a href=\"".base_url()."Homepage/editHomepageItem/".$rows['homeItemID']."\"><i class=\"fa fa-edit font-blue\"></i></a></td>";                                
                                }
                                echo "<tr>
										<td class=\"text-center\">".$counter."</td>
										<td class=\"text-center\">".$rows['homeItemLabel']."</td>
										<td class=\"text-center\">".$boxType."</td>
                                        ".$editLink.$deleteLink.$selected."
                                    </tr>";
                                $counter++;
                            }
                            
                        }
                           					
					?>        
                </tbody>
                <tfoot>
                <tr>
                <th class="text-center">ردیف</th>							
                    <th class="text-center">عنوان</th>																														
					<th class="text-center"> نوع باکس</th>
                    <?php 
                    if($this->session->userdata("userStatus") == "a"){
                    ?>	
                    <th class="text-center">ویرایش</th>
					<th class="text-center">حذف</th>
					<th class="text-center"> <?=$allSelected;?></th>
                    <?php }else{ ?>
                    <th class="text-center">ویرایش</th>
                    <?php } ?>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>



