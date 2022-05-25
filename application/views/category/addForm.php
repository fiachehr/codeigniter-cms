<?php

$propertyList = "";
$formEmail = set_value('formEmail',$formData['formEmail']);

if(count($property) != 0){
	
	foreach($property as $row){
		
		if($row['propertyGroupID'] == $formData['formResourceID']){
			
			$propertyList .= "<option value=\"".$row['propertyGroupID']."\" selected=\"selected\">".$row['propertyGroupTitle']."</option>";
			
		}else{
			
			$propertyList .= "<option value=\"".$row['propertyGroupID']."\">".$row['propertyGroupTitle']."</option>";
			
		}
		
		
	}	
	
}

for($i = 0 ; $i <= 2; $i++){
	
	if($i == $formData['formRegType']){
		
		$check[$i] = "checked=\"\"";
		
	}else{
		
		$check[$i] = NULL;
		
	}
	
}


if($dataRegister == "TRUE"){	
	
	echo "<script>alert('فرم مورد نظر ثبت گردید');</script>";
	redirect(base_url()."index.php/category/pageAndCatList","refresh");

	
}elseif($dataRegister == "FALSE" ){
	
	echo "<script>alert('فرم مورد نظر ثبت نگردید');</script>";
	
}



?>


						
								<div class="portlet box blue ">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-pencil-square"></i><?php echo $pageTitle;?>
										</div>
										<div class="tools">
											
										</div>
									</div>

<div class="portlet-body form">
	<form class="form-horizontal form-bordered form-row-stripped" action="<?php echo base_url();?>index.php/category/addForm/<?php echo $id;?>/<?php echo $title; ?>" method="post" enctype="multipart/form-data">
		<div class="form-body">
			
			<div class="form-group">
				<label class="control-label col-md-3">آدرس ایمیل</label>
				<div class="col-md-9">
					<input type="text"  class="form-control" name="formEmail" id="formEmail" tabindex="1"	maxlength="512" value="<?php echo $formEmail; ?>"/>
					<span class="help-block"><span class="help-block"><?php echo form_error('formEmail') ?></span></span>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-3">انتخاب فرم</label>
				<div class="col-md-3">
					<select class="col-md-3 form-control select2_category" data-placeholder="انتخاب کنید" tabindex="2" name="formGroupID">
						<?php echo $propertyList; ?>
					</select>
					<span class="help-block"></span>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-3">ثبت اطلاعات</label>
				<div class="col-md-9 md-checkbox-inline">
					
					
					<div class="md-radio">
						<input type="radio" class="md-radiobtn" name="formRegType" id="formRegType1" tabindex="2" value="0" <?php echo $check[0]; ?>>
						<label for="formRegType1">
						<span class="inc"></span>
						<span class="check"></span>
						<span class="box"></span>
						ارسال به ایمیل</label>
					</div>
					
					<div class="md-radio">
						<input type="radio" class="md-radiobtn" name="formRegType" id="formRegType2" tabindex="3" value="1" <?php echo $check[1]; ?>>
						<label for="formRegType2">
						<span class="inc"></span>
						<span class="check"></span>
						<span class="box"></span>
						ارسال به ایمیل و ثبت در پایگاه داده</label>
					</div>
					
					<div class="md-radio">
						<input type="radio" class="md-radiobtn" name="formRegType" id="formRegType3" tabindex="4" value="2" <?php echo $check[2]; ?>>
						<label for="formRegType3">
						<span class="inc"></span>
						<span class="check"></span>
						<span class="box"></span>
						ثبت در پایگاه داده</label>
					</div>
					

			
				</div>
			</div>
					
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" class="btn green" name="submit" value="submit" tabindex="5"><i class="fa fa-check"></i>ثبت</button>
						<button type="button" class="btn default" tabindex="6"><i class="fa fa-times"></i>لغو</button>
					</div>
				</div>
			</div>			
		</div>	
	</form>
</div>
