<?php include "config.php";
//accessing data for recent post limited to 5
						$query						=	"SELECT * FROM blogs ORDER BY id DESC limit 3";
						$rs		    				=	mysqli_query($conn,$query) or die(mysqli_error());
						$recent_post_result_sidebar1 = "";
						while($row		=	mysqli_fetch_array($rs))
						{
						$recent_post_result_sidebar1	.=	'<li>
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
						
						$query						=	"SELECT COUNT(*) FROM blogs ";
						$rs		    				=	mysqli_query($conn,$query) or die(mysqli_error());
						$row		=	mysqli_fetch_array($rs);
						$totalcount= $row[0];
						
						

						

?>




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
                             <?php echo $recent_post_result_sidebar1;?>
                    	</ul>
                    </div>
                    <div class="widget">
                        <h5 class="widget_title">Archive</h5>
                        <ul class="widget_archive">
						
                            <li><a href="#"><span class="archive_year">November 2020</span><span class="archive_num"><?php echo '('.$totalcount.')';?></span></a></li>
                            
                        </ul>
                    </div>
                    <div class="widget">
                    	<div class="shop_banner">
                            <div class="banner_img overlay_bg_20">
                                <img src="img/vbanner.jpg" alt="sidebar_banner_img">
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