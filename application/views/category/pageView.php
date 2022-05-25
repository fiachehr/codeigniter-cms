<?php

if($pageContent[1] == "f"){

	$fields = NULL;
	$items = NULL;
	$fieldsName = NULL;
		
	foreach($pageContent[0] as $frow){
		
		$fieldsName .= $frow['propertyTitle'].";;";
											
		if($frow['propertyType'] == "1"){
			
			$fields .= "<div class=\"col-md-2 form-label\">".$frow['propertyTitle']."</div>
						<div class=\"col-md-10 form-field\">
							<input type=\"text\" class=\"col-md-5\" name=\"".$frow['propertyGUID']."\"  />
						</div>";					
	
		}elseif($frow['propertyType'] == "2"){
	
			$fields .= "<div class=\"col-md-2 form-label\">".$frow['propertyTitle']."</div>
						<div class=\"col-md-10 form-field\">
                    		<textarea class=\"col-md-5\"  rows=\"3\" tabindex=\"3\" name=\"".$frow['propertyGUID']."\"></textarea>
                        </div>";
                      
        }elseif($frow['propertyType'] == "5" ){			
			
			$fields .= "<div class=\"col-md-2 form-label\">".$frow['propertyTitle']."</div>
						<div class=\"col-md-10 form-field\">
							<input type=\"text\" class=\"col-md-5\"  name=\"".$frow['propertyGUID']."\" id=\"datePicker\"/>
						</div>
                      <script>
				         $(document).ready(function() {					        
				            $(\"#".$frow['propertyGUID']."\").datepicker({
				                isRTL: true,
				                dateFormat: \"yy-mm-dd\"
				            });					            
				        });
				    </script>";
                      
        }elseif($frow['propertyType'] == "3"){
	
			foreach($pageContent[0][1] as $irow){
				
				if($irow['itemPropertyGUID'] == $frow['propertyGUID'] ){
					
					$items .=  "<input type=\"radio\" name=\"".$irow['itemPropertyGUID']."\" value=\"".$irow['propertyItemTitle']."\" >&nbsp;&nbsp;&nbsp;".$irow['propertyItemTitle']."<br/>";	
					
				}
			}
			
			$fields .= "<div class=\"col-md-2 form-label\">".$frow['propertyTitle']."</div>
						<div class=\"col-md-10 form-field\">".$items."</div>";								

            $items = "";
                      
																				
		}elseif($frow['propertyType'] == "4"){
	
			foreach($pageContent[0][1] as $irow){
				
				if($irow['itemPropertyGUID'] == $frow['propertyGUID'] ){
					
					$items .=  "<input type=\"checkbox\"  name=\"".$irow['itemPropertyGUID']."[]\" value=\"".$irow['propertyItemTitle']."\" >&nbsp;&nbsp;&nbsp;".$irow['propertyItemTitle']."<br/>";

				}
					
			}
			
			$fields .= "<div class=\"col-md-2 form-label\">".$frow['propertyTitle']."</div>
						<div class=\"col-md-10 form-field\">".$items."</div>";	
            $items = "";      
                      
        }
																				
	}

}


?>
	<main class="news-full-main">
      <div class="news-full-wrapper">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="news-title-article">
				<?php 
					if($pageContent[1] == "c" && isset($pageContent[0]['contentBody'])){
						echo $pageContent[0]['contentBody'];
					}elseif($pageContent[1] == "f"){
				?>
				 	<form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
						<?php  echo $fields;?> 
						<div class="col-md-2 form-label">کد امنیتی</div>
						<div class="col-md-10 form-field"><input type="text" name="captcha" /><input type="hidden"  name="fieldsName" value="<?php echo $fieldsName; ?>"/></div>											
						<div class="col-md-2 form-label"></div>
						<div class="col-md-10 form-field"><p class="captcha" id="captchaImg"><?php echo $captchaImg; ?></p></div>
						<div class="col-md-2 form-label"></div>
						<div class="col-md-10 form-field"><button type="submit"  name="submit" value="submit"><i class="fa fa-check"></i>ثبت اطلاعات</button></div>	
					</form>
				<?php 
					}elseif($pageContent[1] == "0"){
						echo $pageTitle;
					}
				?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

