<div class="breadcrumbs">
	<span class="location">شما اینجا هستید:</span>
	<?php 	
			
		  echo "<span itemtype=\"http://data-vocabulary.org/Breadcrumb\" itemscope=\"\">
					<a href=\"".base_url()."\" itemprop=\"url\">
						<span itemprop=\"title\">خانه</span>
					</a>
				</span>
				<span class=\"delim\">»</span>
				<span itemtype=\"http://data-vocabulary.org/Breadcrumb\" itemscope=\"\">
					<a href=\"#\" itemprop=\"url\">
					<span itemprop=\"title\">لیست منابع مربوط به برچسب | ".urldecode($tagTitle)."</span>
					</a>
				 </span>";
				 		
	?>
</div>
<div class="main wrap cf">
	<div class="row">
		<div class="col-8 main-content">			
			<div class="row listing">						
				<?php 
				
					foreach($list[0] as $newsRow){					

						echo  "<div class=\"column half\">		
									<article class=\"post-8 post type-post status-publish format-standard has-post-thumbnail sticky category-- highlights\" \">				
										<span class=\"cat-title cat-2\">
											<a href=\"".base_url()."index.php/news/newsArchive/".$newsRow->categoryURL."/0\">".$newsRow->title."</a>
										</span>							
										<a href=\"".base_url()."index.php/news/newsShow/".$newsRow->itemCatID."/".$newsRow->newsCode."/".str_replace(" ","-",$newsRow->newsURL)."\" title=\"".$newsRow->newsTitle."\" class=\"image-link\">
											<img class=\"image-List\" src=\"".base_url()."assets/uploads/news/".$newsRow->newsImg."\" alt=\"".$newsRow->newsTitle."\" itemprop=\"image\" /> 													
										</a>				
										<div class=\"meta\">
											<time datetime=\"".$newsRow->newsDate."\" itemprop=\"datePublished\">".greToJal($newsRow->newsDate)."</time>																					
										</div>							
										<h2 itemprop=\"name\"><a href=\"".base_url()."index.php/news/newsShow/".$newsRow->itemCatID."/".$newsRow->newsCode."/".str_replace(" ","-",$newsRow->newsURL)."\" title=\"".$newsRow->newsTitle."\" class=\"image-link\" itemprop=\"url\">".$newsRow->newsTitle."</a></h2>							
										<div class=\"excerpt\">
											<p>".word_limiter($newsRow->newsSummery,15)."</p>
										</div>			
									</article>
								</div>";	

					}				
			
				
				 ?>
			</div>
		<?php echo $list[1]; ?>	
</div>
                                
         
