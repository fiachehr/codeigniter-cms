<div class="content-wrapper">
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
			  <div class="col-xs-5">
				  <h4 class="box-title"><?=$pageTitle;?></h4>
			  </div>
			  <div class="col-xs-5">
				  <?php
				  if($parent != "0"){?>
						<a href="<?=base_url();?>Acms/modules/0"><i class="fa fa-arrow-right"></i><span class="link-title">بازگشت</span> </a>
				  <?php } ?>
			  </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>عنوان ماژول</th>
                  <th class="text-center">آیکن</th>
                  <th class="text-center">وضعیت</th>
                </tr>
                </thead>
                <tbody>
					<?php
						if($modules != NULL){
							foreach($modules as $rows){

								$status = "<div class=\"btn-group\">
												<button type=\"button\" class=\"btn btn-danger\">غیر فعال</button>
												<button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">
												<span class=\"caret\"></span>
												<span class=\"sr-only\">Toggle Dropdown</span>
												</button>
												<ul class=\"dropdown-menu\" role=\"menu\">
													<li><a href=\"".base_url()."Acms/changeStatus/".$rows['moduleID']."/1/".$rows['moduleParentID']."\">فعالسازی ماژول</a></li>
												</ul>
											</div>";
								$title = $rows['moduleTitle'];

								if($rows['moduleStatus'] == "1"){
									$status = "<div class=\"btn-group\">
												<button type=\"button\" class=\"btn btn-success\"> فعال</button>
												<button type=\"button\" class=\"btn btn-success dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">
												<span class=\"caret\"></span>
												<span class=\"sr-only\">Toggle Dropdown</span>
												</button>
												<ul class=\"dropdown-menu\" role=\"menu\">
													<li><a href=\"".base_url()."Acms/changeStatus/".$rows['moduleID']."/0/".$rows['moduleParentID']."\">غیر فعالسازی ماژول</a></li>
												</ul>
											</div>";

									if($rows['moduleParentID'] == 0){
										$title = "<a href=\"".base_url()."Acms/modules/".$rows['moduleID']."\" >".$rows['moduleTitle']."</a>";
									}
									
								}

							echo "<tr>
									<td>".$title."</td>
									<td class=\"text-center\"><i class=\"fa ".$rows['moduleIcon']."\"></i></td>
									<td class=\"text-center\">".$status."</td>
								 </tr>";

						}
					}
					?>        
                </tbody>
                <tfoot>
                <tr>
				  <th>عنوان ماژول</th>
                  <th class="text-center">آیکن</th>
                  <th class="text-center">وضعیت</th>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


