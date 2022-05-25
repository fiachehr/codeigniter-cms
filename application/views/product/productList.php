<?php

$allSelected = "<input type=\"checkbox\" data-action=\"allSelected\" data-module=\"Product\" data-source=\"Product\" >";

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

                <a href="<?=base_url();?>Product/insertProduct"><i class="fa fa-plus-square"></i><span class="link-title"> درج محصول جدید</span> </a>

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

					<th class="text-center">تاریخ</th>									

					<th class="text-center">بازدید</th>	

					<th class="text-center">نظرات</th>																

					<th class="text-center">وضعیت</th>

					<th class="text-center">ویرایش</th>

					<th class="text-center">حذف</th>

					<th class="text-center"> <?=$allSelected;?></th>

                </tr>

                </thead>

                <tbody>

                    <?php

                        $this->load->helper("str");

                        if($product['count'] == 0){

                            echo "<tr>

                                    <td colspan=\"14\" class=\"text-center\">موردی یافت نشد </td>          

                                  </tr>";

                        }else{

                            foreach($product["list"] as $rows){



                                if($rows['productStatus'] == "d"){                                   

                                    $status = "<span class=\"label label-warning\">غیر فعال</span>";                                 

                                }else{                                   

                                    $status = "<span class=\"label label-success\">فعال</span>";                                 

                                }



                                $deleteLink = "<span data-action=\"deleteItem\"  data-link=\"".base_url()."product/deleteProduct/".$rows['productGUID']."/".$rows['productTitle']."\"><i class=\"glyphicon glyphicon-trash font-red\"></i></span>";

								$editLink = "<a href=\"".base_url()."product/editProduct/".$rows['productGUID']."/".$page."\"><i class=\"fa fa-edit font-blue\"></i></a>";                                

                                $selected = "<input type=\"checkbox\" data-source=\"Product\" data-module=\"Product\" name=\"selectedItem[]\" value=\"".$rows['productGUID']."\" data-title=\"".$rows['productTitle']."\" >";

                                // $propertyLink = "<a href=\"".base_url()."property/addPropertyValue/".$rows['productGUID']."/".cleanString($rows['productTitle'])."/1\"><i class=\"fa fa-list-alt  font-red\"></i></a>";

								

								 if($permission == "1" || $permission == "0"){

                                

                                    $deleteLink = "<i class=\"glyphicon glyphicon-trash font-red\"></i>";

                                    $editLink = "<i class=\"fa fa-edit font-blue\"></i>"; 

									$selected = "<input type=\"checkbox\" disabled >";

									// $propertyLink = "<i class=\"fa fa-list-alt  font-red\"></i>";				

                                

                                }



                                if($permission == "2"){



                                    $deleteLink = "<i class=\"glyphicon glyphicon-trash font-red\"></i>";                                   

									$editLink = "<a href=\"".base_url()."Job/editJob/".$rows['productGUID']."/".$page."\"><i class=\"fa fa-edit font-blue\"></i></a>";                                

									$selected = "<input type=\"checkbox\" disabled >";    

									// $propertyLink = "<i class=\"fa fa-list-alt  font-red\"></i>";



                                }

            

                                

                                echo "<tr>

										<td class=\"text-center\">".$counter."</td>

										<td class=\"text-center\">".$rows['productCode']."</td>

                                        <td class=\"text-center\"><span data-list-title=\"".$rows['productTitle']."\">".word_limiter($rows['productTitle'],3)."</span></td>

                                        <td class=\"text-center\">".$rows['title']."</td>

                                        <td class=\"text-center\">".greToJal($rows['regDate'])." | ".substr($rows['regDate'],10)."</td>

                                        <td class=\"text-center\">".$rows['productHits']."</td>

                                        <td class=\"text-center\">".$rows['productCommentCount']."</td>

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

					<th class="text-center">تاریخ</th>									

					<th class="text-center">بازدید</th>	

					<th class="text-center">نظرات</th>																	

					<th class="text-center">وضعیت</th>

					<th class="text-center">ویرایش</th>

					<th class="text-center">حذف</th>

					<th class="text-center"> <?=$allSelected;?></th>

                </tr>

                </tfoot>

              </table>

              <?=$product['link'];?>

            </div>

          </div>

        </div>

      </div>

    </section>

  </div>







