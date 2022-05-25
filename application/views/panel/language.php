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
			  </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>عنوان</th>
                  <th class="text-center">آیکن</th>
                  <th class="text-center">وضعیت</th>
                </tr>
                </thead>
                <tbody>
					<?php
						if($languages != NULL){
							foreach($languages as $rows){

								$status = "<div class=\"btn-group\">
												<button type=\"button\" class=\"btn btn-danger\">غیر فعال</button>
												<button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">
												<span class=\"caret\"></span>
												<span class=\"sr-only\">Toggle Dropdown</span>
												</button>
												<ul class=\"dropdown-menu\" role=\"menu\">
													<li><a href=\"".base_url()."Acms/changeLangStatus/".$rows['languageID']."/1/\">فعالسازی زبان</a></li>
												</ul>
											</div>";

								if($rows['languageStatus'] == "1"){
									$status = "<div class=\"btn-group\">
												<button type=\"button\" class=\"btn btn-success\"> فعال</button>
												<button type=\"button\" class=\"btn btn-success dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">
												<span class=\"caret\"></span>
												<span class=\"sr-only\">Toggle Dropdown</span>
												</button>
												<ul class=\"dropdown-menu\" role=\"menu\">
													<li><a href=\"".base_url()."Acms/changeLangStatus/".$rows['languageID']."/0/\">غیر فعالسازی زبان</a></li>
												</ul>
											</div>";						
									
								}

							echo "<tr>
									<td>".$rows['languageTitle']."</td>
									<td class=\"text-center\"><img src=\"".base_url()."assets/panel/images/flags/".$rows['languageIcon'].".png\" alt=\"".$rows['languageTitle']."\"></td>
									<td class=\"text-center\">".$status."</td>
								 </tr>";

						}
					}
					?>        
                </tbody>
                <tfoot>
                <tr>
				 					 <th>عنوان </th>
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


