

<?php
   $moduleList = "";
   foreach($modules as $row){	
   	$moduleList .= "<option value=\"".$row['moduleID']."\">".$row['moduleTitle']."</option>";		
   }
?>
<div class="content-wrapper">
   <section class="content">
      <div class="row">
         <div class="col-xs-12">
            <div class="box">
               <div class="box-header with-border">
                  <div class="col-xs-2">
                     <h4 class="box-title"><?=$pageTitle;?></h4>
                  </div>
                  <div class="col-xs-1">
                  </div>
                  <div class="col-xs-9 panel-menu">
                     <?php if($id != null){ ?>
                     <a href="<?=base_url();?>Category/insertCategory/<?=$id;?>"><i class="fa fa-plus-square"></i><span class="link-title"> درج دسته بندی و صفحه</span> </a>
                     <?php } ?>
                     <a href="<?php echo base_url();?>Category/categoryIndex/0/دسته بندی های اصلی"><i class="fa fa-sort-numeric-desc"></i><span class="link-title">الویت بندی دسته بندی های اصلی</span> </a>
                  </div>
               </div>
               <div class="box-body">
                  <div class="form-group">
                     <label for="jobMainCategory"> انتخاب ماژول<i></i></label>
                     <select class="form-control select2" id="catModule">
                        <option value="">انتخاب کنید </option>
                        <?=$moduleList; ?>
                     </select>
                     <input type="hidden" id="moduleID" value="<?=$id;?>" />
                  </div>
                  <div class="tree-menu"><?=$tree;?></div>
               </div>
            </div>
         </div>
   </section>
   </div>
</div>

