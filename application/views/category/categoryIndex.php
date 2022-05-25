


<div class="content-wrapper">
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title"><?=$pageTitle;?></h3>
               </div>
               <form role="form" action="<?php echo base_url();?>Category/categoryIndex/<?php echo $parentID;?>/<?php echo $title; ?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
				  <ul id="sortable">
					<?php 			
						foreach($categoryList as $menu){						
							echo "<li class=\"category-index\" id=\"".$menu['id']."\">".$menu['title']."</li>";							
						} 			
					?>
					</ul>
                  </div>
            </div>
         </div>
         <div class="box-footer">	
		 <input type="hidden" id="indexList" value="" name="indexList"/>			
         <button type="submit" name="submit" value="submit" class="btn btn-primary" onClick="changeIndex()">ویرایش الویتها</button>
         </div>	
         </form>
      </div>
   </section>
</div>
</div>


		