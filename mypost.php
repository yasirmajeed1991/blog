<?php 	session_start();
    if(!isset($_SESSION['user_id']))
   {
    header("location:login.php");
   }
   else
   { 
	include "header.php";
		include "config.php";
				$universal_user_id = $_SESSION['user_id'];
				 


?>
<!-- START SECTION CATEGORIES -->
<?php include "headerglyph.php";

						//accessing data for recent post limited to 2 
						
						if($_SESSION['user_id']!="")
							
						$num_per_page=05;


								if(isset($_GET["page"]))
								{
									$page=$_GET["page"];
								}
								else
								{
									$page=1;
								}

								$start_from=($page-1)*05;
						{	
							$query	=	"SELECT * FROM blogs  where post_created_by=$universal_user_id  limit $start_from,$num_per_page";
							$rs		=	mysqli_query($conn,$query) or die(mysqli_error());
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
										if($_SESSION['user_id'] == 2)
										{
											$delete_post	= '<a href="funtions.php?del_post_id='.$row['id'].'" class="btn btn-fill-line  border-2 btn-xs rounded-0">Delete Post</a>';	
										}
										else
										{
											$delete_post= "";
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
																						<a href="readpost.php?title='.$row['post_title'].' && id='.$row['id'].'" class="btn btn-fill-line border-2 btn-xs rounded-0">Read More</a> <a href="update_post.php?id='.$row['id'].'" class="btn btn-fill-line  border-2 btn-xs rounded-0">Edit Post</a> '.$delete_post.'
																					</div>
																					<a href="blogcat.php?id='.$row['post_category'].'" class="btn btn-fill-out" style="margin-top:13px;">Show More</a>
																				</div>
																				 
																		</div>
																</div>
																 ';
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
			<?php if($_SESSION['message_success']!=""){echo '<p class="alert alert-success">'.$_SESSION['message_success'].'</p>';$_SESSION['message_success']='';}?>
				<h2 class="font-weight-light specific_color">MY POSTS</h2>
				<h6 class="font-weight-light">HIGHLIGHT</h6>
				<hr>
                <div class="row blog_thumbs">
                   <?php echo $recent_post_result_rightbar?>
                    
                </div>
				<!--Pagination-->
				<?php 
        
                $pr_query = "select * from blogs ";
                $pr_result = mysqli_query($conn,$pr_query);
                $total_record = mysqli_num_rows($pr_result );
                
                $total_page = ceil($total_record/$num_per_page); ?>
				<div class="col-12 mt-2 mt-md-4">
                        <ul class="pagination pagination_style1 justify-content-center">
						<?php

                if($page>1)
                {
                    echo "<li class='page-item'><a href='mypost.php?page=".($page-1)."' class='page-link' tabindex='-1'><i class='linearicons-arrow-left'></i></a></li>";
                }

                if(isset($_GET['page'])){
					$get_page_to_active = $_GET['page'];
				}
                for($i=1;$i<$total_page;$i++)
                {
                    echo "<li class='page-item active'><a href='mypost.php?page=".$i."' class='page-link active' >$i</a></li>";
                }
				
                if($i>$page)
                {
                    echo "<li class='page-item'><a href='mypost.php?page=".($page+1)."' class='page-link'><i class='linearicons-arrow-right'></i></a></li>";
                }
        
        ?>
		</ul>
		</div>
				<!--Pagination End-->
            </div>
        	<?php include "sidebarpost.php";?>
        </div>
    </div>
</div>
<!-- END SECTION BLOG -->


   <?php include "footer.php";}
   if(time() - $_SESSION['timestamp'] > 1500) 
		{ //subtract new timestamp from the old one
			   unset($_SESSION['user_id'], $_SESSION['name'], $_SESSION['timestamp']);
			   header("Location:index.php"); //redirect to index.php
			   exit;
		}
		else 
		{
			$_SESSION['timestamp'] =  time();
		}
   
   
   
   
   ?>