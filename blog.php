<?php include "header.php";?>
<!-- START SECTION CATEGORIES -->
<?php include "headerglyph.php";

						//accessing data for recent post limited to 2 
						if($_GET['id']!="")
						{	$categoryid = $_GET['id'];
							$query						=	"SELECT * FROM blogs ORDER BY id DESC limit 5 where post_category = $categoryid";
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
																							<img src="'.$row['post_main_img'].'" alt="blog_small_img1">
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

						}
						





?>

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION BLOG -->
<div class="section">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-9">
                <div class="row blog_thumbs">
                   <?php echo $recent_post_result_rightbar?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2 mt-md-4">
                        <ul class="pagination pagination_style1 justify-content-center">
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i class="linearicons-arrow-left"></i></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="linearicons-arrow-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        	<div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
            	<div class="sidebar">
                	<div class="widget">
                        <div class="search_form">
                            <form> 
                                <input required="" class="form-control" placeholder="Search..." type="text">
                                <button type="submit" title="Subscribe" class="btn icon_search" name="submit" value="Submit">
                                    <i class="ion-ios-search-strong"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                	<div class="widget">
                    	<h5 class="widget_title">Recent Posts</h5>
                        <ul class="widget_recent_post">
                            <li>
                                <div class="post_footer">
                                    <div class="post_img">
                                        <a href="#"><img src="assets/images/letest_post1.jpg" alt="letest_post1"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h6>
                                        <p class="small m-0">April 14, 2018</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="post_footer">
                                    <div class="post_img">
                                        <a href="#"><img src="assets/images/letest_post2.jpg" alt="letest_post2"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h6>
                                        <p class="small m-0">April 14, 2018</p>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="post_footer">
                                    <div class="post_img">
                                        <a href="#"><img src="assets/images/letest_post3.jpg" alt="letest_post3"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h6>
                                        <p class="small m-0">April 14, 2018</p>
                                    </div>
                                </div>
                            </li>
                    	</ul>
                    </div>
                    <div class="widget">
                        <h5 class="widget_title">Archive</h5>
                        <ul class="widget_archive">
                            <li><a href="#"><span class="archive_year">June 2019</span><span class="archive_num">(12)</span></a></li>
                            <li><a href="#"><span class="archive_year">May 2019</span><span class="archive_num">(5)</span></a></li>
                            <li><a href="#"><span class="archive_year">March 2018</span><span class="archive_num">(6)</span></a></li>
                            <li><a href="#"><span class="archive_year">January 2018</span><span class="archive_num">(7)</span></a></li>
                            <li><a href="#"><span class="archive_year">April 2017</span><span class="archive_num">(10)</span></a></li>
                        </ul>
                    </div>
                    <div class="widget">
                    	<div class="shop_banner">
                            <div class="banner_img overlay_bg_20">
                                <img src="assets/images/sidebar_banner_img.jpg" alt="sidebar_banner_img">
                            </div> 
                            <div class="shop_bn_content2 text_white">
                                <h5 class="text-uppercase shop_subtitle">New Collection</h5>
                                <h3 class="text-uppercase shop_title">Sale 30% Off</h3>
                                <a href="#" class="btn btn-white rounded-0 btn-sm text-uppercase">Shop Now</a>
                            </div>
                        </div>
                    </div>
                	<div class="widget">
                    	<h5 class="widget_title">tags</h5>
                        <div class="tags">
                        	<a href="#">General</a>
                            <a href="#">Design</a>
                            <a href="#">jQuery</a>
                            <a href="#">Branding</a>
                            <a href="#">Modern</a>
                            <a href="#">Blog</a>
                            <a href="#">Quotes</a>
                            <a href="#">Advertisement</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION BLOG -->


<?php include "footer.php";?>