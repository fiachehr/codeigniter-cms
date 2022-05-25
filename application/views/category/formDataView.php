					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-list"></i><?php echo $pageTitle; ?>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="sample_1">
							<thead>
								<tr>
									<?php 
									
									$fieldArray = array();
																		
									foreach($formFields as $fRows){
										
										array_push($fieldArray,$fRows['propertyTitle']);										
										echo "<th class=\"text-center\">".$fRows['propertyTitle']."</th>";

									}
									
									?>
								<th class="text-center">حذف</th></tr>
							</thead>
							<tbody>
							<?php 
							
							$packID = "";							
							$dataPack = array();							
							
							foreach($formData as $rows){								
								
								$packID = $rows['valuePackDataGUID'];
								
								if($packID == $rows['valuePackDataGUID']){
									
									if(!in_array($rows['valuePackDataGUID'],$dataPack)){
										
										array_push($dataPack,$rows['valuePackDataGUID']);
										
									}																		
																			
									$data[$rows['valuePackDataGUID']][$rows['propertyTitle']] = $rows['valueContent'];
																																										
								}
								
							}
							
							$counter = 0;
														
							foreach($data as $dataRows){
																
								echo "<tr>";
								
								for($i = 0 ; $i < count($fieldArray) ; $i++){
									
									if(isset($dataRows[$fieldArray[$i]])){
										
										echo "<td class=\"text-center\">".str_replace(";;","-",$dataRows[$fieldArray[$i]])."</td>";
										
									}else{
										
										echo "<td class=\"text-center\">---</td>";
										
									}
																									
								}
								
								echo "<td class=\"text-center\"><a href=\"".base_url()."index.php/category/deleteFormData/".$dataPack[$counter]."/".$title."\"><i class=\"glyphicon glyphicon-trash font-red\"></i></a></td></tr>";							
								$counter++;
							
							}
																					
							?>
							
							</table>
						</div>						
					</div>
					
					
					<!-- END EXAMPLE TABLE PORTLET-->