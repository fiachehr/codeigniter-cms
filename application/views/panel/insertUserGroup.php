<?php

$title = set_value('title','');
$userGroupStartTime = set_value('userGroupStartTime','');
$userGroupEndTime = set_value('userGroupStartTime','');

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
            <form role="form" action="<?php echo base_url();?>Acms/insertUserGroup" method="post">
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
						<input type="checkbox" name="userGroupWeekday[]" value="sa" class="flat-red" checked>
						شنبه
						</label>
						<label>
						<input type="checkbox" name="userGroupWeekday[]" value="su" class="flat-red" checked>
						یک شنبه
						</label>
						<label>
						<input type="checkbox" name="userGroupWeekday[]" value="mo" class="flat-red" checked>
						دو شنبه
						</label>
						<label>
						<input type="checkbox" name="userGroupWeekday[]" value="tu" class="flat-red" checked>
						سه شنبه
						</label>
						<label>
						<input type="checkbox" name="userGroupWeekday[]" value="we" class="flat-red" checked>
						چهار شنبه
						</label>
						<label>
						<input type="checkbox" name="userGroupWeekday[]" value="th" class="flat-red" >
						پنج شنبه
						</label>
						<label>
						<input type="checkbox" name="userGroupWeekday[]" value="fr" class="flat-red" >
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
						<div id="tag-suggest" class="col-md-12 select2-choices">									
						</div>
						<input type="hidden" id="parentID" name="parentID" value="">
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

							if($itemRows['moduleParentID'] == $row['moduleID']){

								$modulesLabel .= $itemRows['moduleLabel']."-";

								echo "<div class=\"form-group\">
										<label>".$itemRows['moduleTitle']."</label>
										<div class=\"multi-checkbox\">
											<label>
											<input type=\"radio\" name=\"".$itemRows['moduleLabel']."\" class=\"flat-red\" checked=\"\" value=\"".$itemRows['moduleID']."-0\">
											عدم دسترسی
											</label>
											<label>
											<input type=\"radio\" name=\"".$itemRows['moduleLabel']."\" class=\"flat-red\" value=\"".$itemRows['moduleID']."-1\">
											میهمان
											</label>
											<label>
											<input type=\"radio\" name=\"".$itemRows['moduleLabel']."\" class=\"flat-red\" value=\"".$itemRows['moduleID']."-2\">
											ویرایشگر
											</label>
											<label>
											<input type=\"radio\" name=\"".$itemRows['moduleLabel']."\" class=\"flat-red\" value=\"".$itemRows['moduleID']."-3\">
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
							<input type="radio" name="userGroupDataAccess" value="1" class="flat-red" checked>
							همه اطلاعات
							</label>
							<label>
							<input type="radio" name="userGroupDataAccess" value="0" class="flat-red">
							اطلاعات شخصی
							</label>
						</div>
					</div>
					<div class="form-group">
						<label>وضعیت</label>
						<div class="multi-checkbox">
						<label>
							<input type="radio" name="userGroupStatus" value="0" class="flat-red" checked>
							غیر فعال
							</label>
							<?php
							if($permission == "3" || $permission == "a"){
							?>
							<label>
							<input type="radio" name="userGroupStatus" value="1" class="flat-red" >
							فعال
							</label>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer">				
			<button type="submit" name="submit" value="submit" class="btn btn-primary">ثبت گروه کاربری</button>
		</div>	
     </form>
     </div>
    </section>
  </div>
</div>

