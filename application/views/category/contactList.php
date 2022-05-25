<?php
$allSelected = "<input type=\"checkbox\" data-action=\"allSelected\" data-module=\"Category\" data-source=\"Contact\" >";
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
                <a href="<?=base_url();?>Category/insertContact"><i class="fa fa-plus-square"></i><span class="link-title"> درج اطلاعات ارتباطی جدید</span> </a>
            </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th class="text-center">ردیف</th>
					<th class="text-center">عنوان</th>									
                    <th class="text-center">مقدار</th>	
                    <th class="text-center">نوع</th>
					<th class="text-center">ویرایش</th>
					<th class="text-center">حذف</th>
					<th class="text-center"> <?=$allSelected;?></th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $contactType = array("email"=>"ایمیل","phone"=>"شماره تماس","mobile"=>"شماره موبایل","address"=>"آدرس پستی","sn-facebook"=>"فیسبوک",
                                             "sn-linkedin"=>"لینکدین","sn-twitter"=>"توییتر","sn-instagram"=>"اینستاگرام","sn-telegram"=>"تلگرام","map"=>"نقشه",
                                             "sn-google"=>"گوگل پلاس","sn-youtube"=>"یوتیوب","sn-aparat"=>"آپارات","sn-wiki"=>"ویکیپدیا","sn-pintrest"=>"پینترست","sn-whatsapp"=>"واتساپ");
                        if($contact['count'] == 0){
                            echo "<tr>
                                    <td colspan=\"14\" class=\"text-center\">موردی یافت نشد </td>          
                                  </tr>";
                        }else{
                            foreach($contact["list"] as $rows){

                                $deleteLink = "<span data-action=\"deleteItem\"  data-link=\"".base_url()."Category/deleteContact/".$rows['contactID']."/".$rows['contactTitle']."\"><i class=\"glyphicon glyphicon-trash font-red\"></i></span>";
								$editLink = "<a href=\"".base_url()."Category/editContact/".$rows['contactID']."/".$page."\"><i class=\"fa fa-edit font-blue\"></i></a>";                                
                                $selected = "<input type=\"checkbox\" data-source=\"Contact\" data-module=\"Category\" name=\"selectedItem[]\" value=\"".$rows['contactID']."\" data-title=\"".$rows['contactTitle']."\" >";
								
								if($permission == "1" || $permission == "0"){
                                
                                    $deleteLink = "<i class=\"glyphicon glyphicon-trash font-red\"></i>";
                                    $editLink = "<i class=\"fa fa-edit font-blue\"></i>"; 
									$selected = "<input type=\"checkbox\" disabled >";
		
                                }

                                if($permission == "2"){

                                    $deleteLink = "<i class=\"glyphicon glyphicon-trash font-red\"></i>";                                   
									$editLink = "<a href=\"".base_url()."Category/editContact/".$rows['contactID']."/".$page."\"><i class=\"fa fa-edit font-blue\"></i></a>";                                
									$selected = "<input type=\"checkbox\" disabled >";    

                                }
            
                                echo "<tr>
										<td class=\"text-center\">".$counter."</td>
                                        <td class=\"text-center\">".$rows['contactTitle']."</td>
                                        <td class=\"text-center\">".$rows['contactValue']."</td>
                                        <td class=\"text-center\">".$contactType[$rows['contactType']]."</td>
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
                    <th class="text-center">مقدار</th>																														
					<th class="text-center">نوع</th>
					<th class="text-center">ویرایش</th>
					<th class="text-center">حذف</th>
					<th class="text-center"> <?=$allSelected;?></th>
                </tr>
                </tfoot>
              </table>
              <?=$contact['link'];?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>



