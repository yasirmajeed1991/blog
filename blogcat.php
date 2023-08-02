<?php include "header.php";?>
<!-- START SECTION CATEGORIES -->
<?php include "headerglyph.php";

						//accessing data for recent post limited to 2 
						if($_GET['id']!="")
						{	 $categoryid = $_GET['id'];
							$query						=	"SELECT * FROM blogs where post_category ='$categoryid'";
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
											$category_post_item = $row['post_category'];
											$category_post_item2 = $row['sub_category'];
											
										}
										if (!empty($_SESSION['user_id']))
										{
											$edit_post = '<a href="update_post.php?id='.$row['id'].'" class="btn btn-fill-line  border-2 btn-xs rounded-0">Edit Post</a>';
										}
										else
										{
											$edit_post = '';
										}
										
								$recent_post_result_rightbar	.=	'<div class="col-12">
																		<div class="blog_post blog_style2">
																					
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
																						<a href="readpost.php?title='.$row['post_title'].' && id='.$row['id'].'" class="btn btn-fill-line border-2 btn-xs rounded-0">Read More</a> '.$edit_post.'
																					</div>
																					<a href="blogcat.php?id='.$row['post_category'].'" class="a1 btn-secondary btn-sm btn-block" style="margin-top:13px;">Show More</a>
																				</div>
																		</div>
																</div>';
							}

						}
						




?>
<style>
.blog_title{
	font-size:16px;
	
}
</style>
<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION BLOG -->
<div class="section">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-9">
                <div class="row blog_thumbs">
				<div class="col">
					 	<h2  class="font-weight-light"><?php echo $category_post_item2?></h2>
							<h5  class="font-weight-light blog_title"><?php echo $category_post_item?></h5>
					 
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
        	
			
			<?php include "sidebarpost.php";?>
			
        </div>
    </div>
</div>
<!-- END SECTION BLOG -->


<?php include "footer.php";?>