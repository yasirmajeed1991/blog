<?php include "config.php";
						
							//accessing data for recent post limited to 5
							$query						=	"SELECT * FROM blogs ORDER BY rand() LIMIT 2";
							$rs		    				=	mysqli_query($conn,$query) or die(mysqli_error());
							$recent_post_result_rightbar = "";
							while($row		=	mysqli_fetch_array($rs))
							{
										// strip tags to avoid breaking any html
											$string = strip_tags($row['post_content_body']);
											if (strlen($string) > 120) 
											{
												// truncate string
												$stringCut = substr($string, 0, 120);
												$endPoint = strrpos($stringCut, ' ');
												//if the string doesn't contain any space then it will cut without word basis.
												$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
												
											}
								$recent_post_result_sidebar	.=	'<div class="col-md-6">
									<div class="blog_post blog_style2 box_shadow1">
										<div class="blog_img">
											<a href="readpost.php?title='.$row['post_title'].' && id='.$row['id'].'"> 
												<img src="'.$row['post_main_img'].'" alt="blog_small_img2">
											</a>
										</div>
										<div class="blog_content bg-white">
											<div class="blog_text">
												<h5 class="blog_title"><a href="readpost.php?title='.$row['post_title'].' && id='.$row['id'].'">'.$row['post_title'].'</a></h5>
												<ul class="list_none blog_meta">
													<li><a href="#"><i class="ti-calendar"></i> '.$row['date_created'].'</a></li>
													<li><a href="#"><i class="ti-comments"></i> 2 Comment</a></li>
												</ul>
												<p>'.$string.'</p>
											</div>
										</div>
									</div>
								</div>';      
									 
							
						}
						
						
						
						
						
?>						
						
						
						              
                    	 