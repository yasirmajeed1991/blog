<?php include "header.php";
						//accessing data for recent post limited to 5
						$query						=	"SELECT * FROM blogs ORDER BY id DESC limit 5";
						$rs		    				=	mysqli_query($conn,$query) or die(mysqli_error());
						$recent_post_result_sidebar = "";
						while($row		=	mysqli_fetch_array($rs))
						{
						$recent_post_result_sidebar	.=	'<li>
															<div class="post_footer">
																<div class="post_img">
																		<a href="#"><img src="'.$row['post_main_img'].'" alt="letest_post"></a>
																</div>
																<div class="post_content">
																		<h6><a href="readpost.php?title='.$row['post_title'].' && id='.$row['id'].'">'.$row['post_title'].'</a></h6>
																		<p class="small m-0">'.$row['date_created'].'</p>
																</div>
															</div>
														</li>';
						}
						//accessing data for recent post limited to 2 
						$query						=	"SELECT * FROM blogs ORDER BY id DESC limit 2";
						$rs		    				=	mysqli_query($conn,$query) or die(mysqli_error());
						$recent_post_result_rightbar = "";
						while($row		=	mysqli_fetch_array($rs))
						{
								// strip tags to avoid breaking any html
									$string = strip_tags($row['post_content_body']);
									if (strlen($string) > 150) 
									{
										// truncate string
										$stringCut = substr($string, 0, 150);
										$endPoint = strrpos($stringCut, ' ');
										//if the string doesn't contain any space then it will cut without word basis.
										$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
										
									}
									
							$recent_post_result_rightbar	.=	'<div class="col-12">
																	<div class="blog_post blog_style2">
																				<p  class="font-weight-light blog_title">'.$row['post_category'].'</p>
																				<div class="blog_img">
																					<a href="readpost.php?title='.$row['post_title'].' && id='.$row['id'].'"">
																						<img src="'.$row['post_main_img'].'" alt="blog_small_img1" class="image_dimensions"">
																					</a>
																				</div>

																			<div class="blog_content bg-white">
																				<div class="blog_text">
																					<h6 class="blog_title"><a href="readpost.php?title='.$row['post_title'].' && id='.$row['id'].'"">But I must explain to you how all this mistaken idea</a></h6>
																					<ul class="list_none blog_meta">
																						<li><a href="readpost.php?title='.$row['post_title'].' && id='.$row['id'].'""><i class="ti-calendar"></i> '.$row['date_created'].'</a></li>
																						<li><a href="readpost.php?title='.$row['post_title'].' && id='.$row['id'].'""><i class="ti-comments"></i> 10</a></li>
																					</ul>
																					<p>'.$string.'</p>
																					<a href="readpost.php?title='.$row['post_title'].' && id='.$row['id'].'" class="btn btn-fill-line border-2 btn-xs rounded-0">Read More</a>
																				</div>
																			</div>
																	</div>
															</div>';
						}








?>






<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row font-weight-light site_title">
        			<div >Join Expertgist</div>
					
        </div>
		 <div class="row font-weight-light">
        			
					<div style="color:#3b5998;" >It's Professionaly casual.</div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">
<div class="container" style="padding-top:60px;">
		<div class="row ">
			<div class="col-sm">
			<a href="blogcat.php?id=Business Startup">  <img src="img/business_startup.png" class="image_size"/>
					Business Start-up
				</a>
			</div>
			<div class="col-sm">
				<a href="blogcat.php?id=Loan">  <img src="img/loan.png" />
					Loan</a>
			</div>
			<div class="col-sm">
				<a href="blogcat.php?id=Family"> <img src="img/family.png" />
					Family</a>
			</div>
			 <div class="col-sm">
				<a href="blogcat.php?id=Finance"> <img src="img/finance.png" />
					Finance</a>
			</div>
		</div>
  
		<div class="row top-buffer">
			<div class="col-sm">
				<a href="blogcat.php?id=Insurance"><img src="img/insurance.png" />
					Insurance</a>
				
			</div>
			<div class="col-sm">
				<a href="blogcat.php?id=Agriculture">  <img src="img/agriculture.png" />
					Agriculture</a>
			</div>
			<div class="col-sm">
			<a href="blogcat.php?id=Romance"> 
			   <img src="img/romance.png" />
					Romance</a>
			</div>
			 <div class="col-sm">
			<a href="blogcat.php?id=Computer and Software">   <img src="img/computersoftware.png" />
					Computer and Software</a>
			</div>
		</div>
		
		
		<div class="row top-buffer">
			<div class="col-sm">
			 <a href="blogcat.php?id=Health Care">  <img src="img/healthcare.png" />
					Health Care</a>
				
			</div>
			<div class="col-sm">
			<a href="blogcat.php?id=Social Media">   <img src="img/socialmedia.png" />
					Social Media</a>
			</div>
			<div class="col-sm">
			<a href="blogcat.php?id=Media">   <img src="img/media.png" />
					Media</a>
			</div>
			 <div class="col-sm">
			<a href="blogcat.php?id=Document Template">   <img src="img/documenttemplate.png" />
					Document Template</a>
			</div>
		</div>
		
		
		
		<div class="row top-buffer">
			<div class="col-sm">
			<a href="blogcat.php?id=Law">   <img src="img/law.png" />
					Law</a>
				
			</div>
			<div class="col-sm">
		<a href="blogcat.php?id=property"> 	  <img src="img/property.png" />
					property</a>
			</div>
			<div class="col-sm">
			<a href="blogcat.php?id=Education">    <img src="img/education.png" />
					Education</a>
			</div>
			 <div class="col-sm">
			<a href="blogcat.php?id=Pet">   <img src="img/pet.png" />
					Pet</a>
			</div>
		</div>
		
		
		<div class="row top-buffer">
			<div class="col-sm">
			 <a href="blogcat.php?id=Job">  <img src="img/job.png" />
					Job
				</a>
			</div>
			<div class="col-sm">
			<a href="blogcat.php?id=Culture">   <img src="img/culture.png" />
					Culture</a>
			</div>
			<div class="col-sm">
			 
			</div>
			<div class="col-sm">
			  
			</div>
		</div>
  
  
  <div class="row justify-content-md-center">
  
 <a href="#" class="btn btn-fill-out" target="_blank">Show More</a>
  
  </div>
  </div>
<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION BLOG -->
<div class="section">
	<div class="container">
	
	<h5 class="widget_title">Recent Posts</h5>
	<hr>
    	<div class="row">
        	<div class="col-lg-9">
                <div class="row blog_thumbs">
                    <?php echo $recent_post_result_rightbar;?>
                    
                </div>
                
            </div>
        	<div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
            	<div class="sidebar">
                	
                	<div class="widget">
                    	
                        <ul class="widget_recent_post">
							
                           <?php echo $recent_post_result_sidebar;?>
                    	
						</ul>
                    </div>
                    
                    
                	
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION BLOG -->
<?php include "footer.php";?>
