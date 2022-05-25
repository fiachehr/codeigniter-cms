<?php

$title = set_value('title',$userGroup[0]['title']);
$start = $userGroup[0]['userGroupStartTime'];
$end = $userGroup[0]['userGroupEndTime'];
if(substr($userGroup[0]['userGroupStartTime'],0,2) > 12 ){
	$start =  (substr($userGroup[0]['userGroupStartTime'],0,2) - 12)." PM";
}
if(substr($userGroup[0]['userGroupEndTime'],0,2) > 12 ){
	$end =  (substr($userGroup[0]['userGroupEndTime'],0,2) - 12)." PM";
}
$userGroupStartTime = set_value('userGroupStartTime',$start);
$userGroupEndTime = set_value('userGroupEndTime',$end);

$selected = "";

$weekday = array("sa","su","mo","tu","we","th","fr");
$userWeekday = explode("-",$userGroup[0]['userGroupWeekday']);
$checked = array("","","","","","","");

for($i = 0 ; $i < 7 ; $i++){
	if(in_array($weekday[$i],$userWeekday)){	
		$checked[$i] = "checked=\"\"";	
	}
}


$groupStatus = array();

for($i = 0 ; $i <= 1; $i++){
	if($i == $userGroup[0]['userGroupStatus']){	
		$groupStatus[$i] = "checked=\"\"";		
	}else{		
		$groupStatus[$i] = NULL;		
	}	
}

$accessData = array();

for($i = 0 ; $i <= 1; $i++){
	if($i == $userGroup[0]['userGroupDataAccess']){	
		$accessData[$i] = "checked=\"\"";		
	}else{		
		$accessData[$i] = NULL;		
	}	
}


if($parentTitle == NULL){
	$pTitle = "";
}else{
	$parents = explode(" > ",$parentTitle);
	$count = count($parents);	
	$pTitle = "<span class=\"tag\" data-action=\"deleteUserGroup\">".$parents[$count-1]."</span>";
	
}

if($resultMessage['result'] == "Alert"){
	
	$title = set_value('title',$this->input->post('title'));
	$userGroupStartTime = set_value('userGroupStartTime',$this->input->post('userGroupStartTime'));
	$userGroupEndTime = set_value('userGroupStartTime',$this->input->post('userGroupStartTime'));
	
}


?>

   <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?=$pageTitle;?></h3>
            </div>
            <form role="form" action="<?php echo base_url();?>Acms/editUserGroup/<?=$userGroup[0]['id'];?>" method="post">
              <div class="box-body">

                <div class="form-group">
                  <label for="title">عنوان گروه کاربری</label>
                  <input type="text" class="form-control"  name="title" id="title" tabindex="1"	maxlength="256" value="<?php echo $title; ?>" placeholder="عنوان گروه کاربری">
				  <?php echo form_error('title') ?>
				</div>

				<div class="bootstrap-timepicker">
					<div class="form-group">
					<label>آغاز زمان کاری</label>
					<div class="input-group">
						<input type="text" id="from_time" name="userGroupStartTime" value="<?php echo $userGroupStartTime; ?>" class="form-control timepicker">
						<div class="input-group-addon">
						<i class="fa fa-clock-o"></i>
						</div>
					</div>
					</div>
				</div>		

				<div class="bootstrap-timepicker">
					<div class="form-group">
					<label>پایان زمان کاری</label>
					<div class="input-group">
						<input type="text" name="userGroupEndTime" value="<?php echo $userGroupEndTime; ?>" class="form-control timepicker">
						<div class="input-group-addon">
						<i class="fa fa-clock-o"></i>
						</div>
					</div>
					</div>
				</div>	
				
				<div class="form-group">
					<label>روزهای کاری</label>
					<div class="multi-checkbox">
						<label>
						<input type="checkbox" name="userGroupWeekday[]" value="sa" class="flat-red" <?php echo $checked[0]; ?>>
						شنبه
						</label>
						<label>
						<input type="checkbox" name="userGroupWeekday[]" value="su" class="flat-red" <?php echo $checked[1]; ?>>
						یک شنبه
						</label>
						<label>
						<input type="checkbox" name="userGroupWeekday[]" value="mo" class="flat-red" <?php echo $checked[2]; ?>>
						دو شنبه
						</label>
						<label>
						<input type="checkbox" name="userGroupWeekday[]" value="tu" class="flat-red" <?php echo $checked[3]; ?>>
						سه شنبه
						</label>
						<label>
						<input type="checkbox" name="userGroupWeekday[]" value="we" class="flat-red" <?php echo $checked[4]; ?>>
						چهار شنبه
						</label>
						<label>
						<input type="checkbox" name="userGroupWeekday[]" value="th" class="flat-red" <?php echo $checked[5]; ?> >
						پنج شنبه
						</label>
						<label>
						<input type="checkbox" name="userGroupWeekday[]" value="fr" class="flat-red" <?php echo $checked[6]; ?> >
						جمعه
						</label>
					</div>
				  </div>

				    <div class="form-group">
						<label class="control-label">انتخاب والد</label>
						<div class="col-md-12 tree-menu">
							<?php echo $tree;?>
						</div>
					</div>	

					<div class="form-group">
						<label class="control-label">والد انتخابی</label>
						<div id="tag-suggest" class="col-md-12 select2-choices-edit">			
							<?php echo $pTitle; ?>								
						</div>
						<input type="hidden" id="parentID" name="parentID" value="<?php echo $userGroup[0]['parentID'];?>">
					</div>

					 <?php 
			
					$modulesLabel = "";

					$module = array();
					$item = array();

					foreach($modules as $rows){
						if($rows['moduleParentID'] == 0){
							array_push($module,$rows);
						}else{
							array_push($item,$rows);
						}
					}
				
					foreach($module as $row){			

						echo "<div class=\"box-header with-border modules\">سطح دسترسی ماژول ".$row['moduleTitle']."</div>";

						foreach($item as $itemRows){

							if($itemRows['moduleParentID'] == $row['mainModuleID']){

								for($i = 0; $i < 4; $i++){					
									if($i == $itemRows['roleStatus']){										
										$checkRole[$i] = "checked=\"\"";										
									}else{										
										$checkRole[$i] = "";										
									}													
								}			

								$modulesLabel .= $itemRows['moduleLabel']."-";

								echo "<div class=\"form-group\">
										<label>".$itemRows['moduleTitle']."</label>
										<div class=\"multi-checkbox\">
											<label>
											<input type=\"radio\" name=\"".$itemRows['moduleLabel']."\" class=\"flat-red\" ".$checkRole[0]." value=\"".$itemRows['moduleID']."-0\">
											عدم دسترسی
											</label>
											<label>
											<input type=\"radio\" name=\"".$itemRows['moduleLabel']."\" class=\"flat-red\" ".$checkRole[1]." value=\"".$itemRows['moduleID']."-1\">
											میهمان
											</label>
											<label>
											<input type=\"radio\" name=\"".$itemRows['moduleLabel']."\" class=\"flat-red\" ".$checkRole[2]." value=\"".$itemRows['moduleID']."-2\">
											ویرایشگر
											</label>
											<label>
											<input type=\"radio\" name=\"".$itemRows['moduleLabel']."\" class=\"flat-red\" ".$checkRole[3]." value=\"".$itemRows['moduleID']."-3\">
											دسترسی کامل
											</label>											
										</div>
									</div>";										
							}
						}

					}

					echo "<input type=\"hidden\" name=\"moduleLabels\" value=\"".$modulesLabel."\" />";
						
					?>
					<div class="box-header with-border"></div>
					<div class="form-group">
						<label>دسترسی اطلاعات</label>
						<div class="multi-checkbox">
							<label>
							<input type="radio" name="userGroupDataAccess" value="1" <?php echo $accessData[1];?> class="flat-red" checked>
							همه اطلاعات
							</label>
							<label>
							<input type="radio" name="userGroupDataAccess" value="0" <?php echo $accessData[0];?> class="flat-red">
							اطلاعات شخصی
							</label>
						</div>
					</div>
					<div class="form-group">
						<label>وضعیت</label>
						<div class="multi-checkbox">
							<?php
							$checked = "checked";
							if($permission == "3" || $permission == "a"){
								$checked = $groupStatus[0];
							?>
							<label>
							<input type="radio" name="userGroupStatus" value="1" <?php echo $groupStatus[1];?>  class="flat-red" checked>
							فعال
							</label>
							<?php } ?>
							<label>
							<input type="radio" name="userGroupStatus" value="0" <?php echo $checked;?>  class="flat-red">
							غیر فعال
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer">				
			<button type="submit" name="submit" value="submit" class="btn btn-primary">ویرایش گروه کاربری</button>
		</div>	
     </form>
     </div>
    </section>
  </div>
</div>


<!--


			
			
			

			
			