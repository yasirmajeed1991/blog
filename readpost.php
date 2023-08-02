<?php include "header.php";?>
<!-- START SECTION CATEGORIES -->
<?php include "headerglyph.php";
 include "config.php";			
				if($_GET['id']!=""  || $_GET['reply'] !="" )
				{
					$post_id = $_GET['id'];
					$query = "SELECT * FROM blogs where id = $post_id";
					$rs = mysqli_query($conn,$query) or die(mysqli_error());
					$result_of_post = mysqli_fetch_array($rs);
					
					$comment_reply_id = $_GET['reply'];
				}
				else
				{
					header("location:index.php");
				}
				//submit comment form
						if(isset($_POST['submit'])){
							//for post id
							$post_id = $_GET['id'];
							//for user_id
							$user_id = $_SESSION['user_id'];
							//comment body
							$user_comment = '';
							$user_comment_error = '';
							$user_comment = $_POST['user_comment'];
							if($user_comment == ''){
								$user_comment_error = "Please Write Something Before Submiting Your Comment";
							}
							if(empty($user_comment_error)){
								$sql = "INSERT INTO blog_comments (`post_id`,`user_id`,`body`) VALUES ('$post_id','$user_id','$user_comment')";
								$run_query = mysqli_query($conn,$sql);
								if($run_query){
									$user_comment_error = "Your Comment is Submitted and Waiting for Approve";
								}else{
									echo "Error"."<br>".mysqli_error($conn);
								}
							}
						}
						//comment form end	


						//submit reply form//
						if(isset($_POST['reply'])){
							//for user_id
							$user_id = $_SESSION['user_id'];
							//comment id//
							$comment_id = $comment_reply_id;
							//reply body
							$user_reply = '';
							$user_reply_error = '';
							$user_reply = $_POST['user_reply'];
							if($user_reply == ''){
								$user_reply_error = "Please Write Something Before Submiting Your Reply";
							}
							if(empty($user_reply_error)){
								$sql = "INSERT INTO blog_replies (`user_id`,`body`,`comment_id`) VALUES ('$user_id','$user_reply','$comment_id')";
								$run_query = mysqli_query($conn,$sql);
								if($run_query){
									$user_reply_error = "Thanks For your Reply";
								}else{
									echo "Error"."<br>".mysqli_error($conn);
								}
							}
						}			

						  $sql = "SELECT b.id as post_id, bc.body as comments, br.body as replies
									FROM blogs as b
									LEFT JOIN blog_comments as bc ON b.id = bc.post_id
									LEFT JOIN blog_replies as br ON bc.id = br.comment_id
									WHERE post_id = $post_id";
									
							
							$run_query = mysqli_query($conn,$sql);
							while($get_reply = mysqli_fetch_assoc($run_query)){		
						   
						   
                            $replyarea .= '<ul class="children">
                            	<li class="comment_info">
                                    <div class="d-flex">
                                        <div class="comment_user">
                                            <img src="assets/images/user3.jpg" alt="user3">
                                        </div>
                                        <div class="comment_content">
                                            <div class="d-flex align-items-md-center">
                                                <div class="meta_data">
                                                    <h6><a href="#">  '.$get_reply["your_name"].' </a></h6>
                                                    <div class="comment-time"> '.$get_reply["created_at"].' </div>
                                                </div>
                                                
                                            </div>
                                            <p>  '.$get_reply["replies"].' </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>';
							}
							
							
?>

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION BLOG -->
<div class="section">
	<div class="container">
    	<div class="row">
        	<div class="col-xl-9">
            	<div class="single_post">
                	<h3 class="specific_color font-weight-light "><?php echo $result_of_post['post_title']?></h3>
					
					<div><p><?php echo $result_of_post['post_category']?> | <?php echo $result_of_post['sub_category']?></p></div>
                    
					<ul class="list_none blog_meta">
                        <li><a href="#"><i class="ti-calendar"></i> <?php echo $result_of_post['date_created']?></a></li>
                        <li><a href="#"><i class="ti-comments"></i> 2 Comment</a></li>
                    </ul>
                    <div class="blog_img">
                        <img src="<?php echo $result_of_post['post_main_img']?>" alt="blog_img1" class="main_image">
                    </div>
                    <div class="blog_content">
                        <div class="blog_text">
                            <p><?php echo $result_of_post['post_content_body']?></p>
                            <blockquote class="blockquote_style3">
                            	<p><?php echo $result_of_post['post_quote']?> </p>
                            </blockquote>
                            <div class="row">
                            	<div class="col-sm-6">
                                	<div class="single_img ">
                                		<img class="w-100 mb-4 image_dimensions" src="<?php echo $result_of_post['post_1st_img']?>" alt="blog_single_img1">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                	<div class="single_img">
                                		<img class="w-100 mb-4 image_dimensions" src="<?php echo $result_of_post['post_2nd_img']?>" alt="blog_single_img2">
                                    </div>
                                </div>
                            </div>
							<p><?php echo $result_of_post['post_content_cont']?></p>		
							<div class="blog_post_footer">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-md-8 mb-3 mb-md-0">
                                        <div class="tags">
                                            <a href="#">General</a>
                                            <a href="#">Design</a>
                                            <a href="#">jQuery</a>
                                            <a href="#">Branding</a>
                                            <a href="#">Modern</a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="social_icons text-md-right">
                                            <li><a href="#" class="sc_facebook"><i class="ion-social-facebook"></i></a></li>
                                            <li><a href="#" class="sc_twitter"><i class="ion-social-twitter"></i></a></li>
                                            <li><a href="#" class="sc_google"><i class="ion-social-googleplus"></i></a></li>
                                            <li><a href="#" class="sc_youtube"><i class="ion-social-youtube-outline"></i></a></li>
                                            <li><a href="#" class="sc_instagram"><i class="ion-social-instagram-outline"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="comment-area">
                    <div class="content_title">
                        <h5>(03) Comments</h5>
                    </div>
                    <ul class="list_none comment_list">
                        <li class="comment_info">
						<!--Displaying Comments -->
						<?php
								$sql = "SELECT ur.your_name, bc.created_at, bc.body, blogs.id, bc.status, bc.id as comment_id
								FROM blog_comments as bc 
								LEFT JOIN user_register as ur ON bc.user_id = ur.id
                                LEFT JOIN blogs ON bc.post_id = blogs.id
								WHERE bc.post_id =  $post_id";
								$run = mysqli_query($conn,$sql);
								while($data = mysqli_fetch_assoc($run)){
								?>
								
								<?php
									if($data['status'] == 'Approve'){
								?>
                            <div class="d-flex">
                                <div class="comment_user">
                                    <img src="assets/images/user2.jpg" alt="user2">
                                </div>
                                <div class="comment_content">
                                    <div class="d-flex">
                                        <div class="meta_data">
                                            <h6><a href="#"><?php echo $data['your_name']; ?></a></h6>
                                            <div class="comment-time"><?php echo $data ['created_at']; ?></div>
                                        </div>
                                        <div class="ml-auto display_reply_box">
                                            <a href="readpost.php?reply=<?php echo $data['comment_id']; ?> && id=<?php  echo  $post_id?>" class="comment-reply" id="commentreplyare"><i class="ion-reply-all"></i>Reply</a>
                                        </div>
										
                                    </div>
                                    <p><?php echo $data ['body']; ?></p>
                                </div>
                            </div>
									<?php } else {
										echo "";
									}?>
                            <?php } ?>
                           <!-- Reply Area-->
						   
						   <?php echo $replyarea; ?>
						   
                        <!-- Reply Area End   -->
                        </li>
                    </ul> 
					<!--Displaying Comments End -->
                    <div class="content_title">
                        <h5>Write a comment</h5>
                    </div>
					<?php if (!empty($_SESSION['user_id'])): ?>
                    <form class="field_form" action="" method="post" id="comment_form"  >
                        <div class="row">
                            <div class="form-group col-md-12">
                                <textarea rows="4" name="user_comment" class="form-control" placeholder="Your Comment" ></textarea>
								<span><?php echo $user_comment_error; ?></span>
                            </div>
                            <div class="form-group col-md-12">
                                <button value="Submit" name="submit" class="btn btn-fill-out" title="Submit Your Message!" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
					<?php else: ?>
				<div class="well" style="margin-top: 20px;">
					<h4 class="text-center"><a href="login.php">Sign in</a> to post a comment</h4>
				</div>
			<?php endif ?>
			
			
			<!-- Reply-->
			<?php
				 if (!empty($_SESSION['user_id'])):
					?>
					<div class="reply_form">
						<div class="content_title">
							<h5>Write a Reply</h5>
						</div>
						<form class="field_form" action="" method="post" id="comment_form"  >
							<div class="row">
								
								<div class="form-group col-md-12">
									<textarea rows="4" name="user_reply" class="form-control" placeholder="Your Reply" ></textarea>
									<span><?php echo $user_reply_error; ?></span>
								</div>
								<div class="form-group col-md-12">
									<button value="Submit" name="reply" class="btn btn-fill-out" title="Reply Your Message!" type="submit">Reply</button>
								</div>
							</div>
						</form>
					</div>
					<?php else: ?>
				<div class="well" style="margin-top: 20px;">
					<h4 class="text-center"><a href="login.php">Sign in</a> to post a Reply</h4>
				</div>
			<?php endif ?>
			
					                </div>
					<div class="related_post">
                	<div class="content_title">
                    	<h5>Related posts</h5>
                    </div>
                    <div class="row">
                        <?php include "relatedpost.php";
						echo $recent_post_result_sidebar;
						?>
                	</div>
                </div>

            </div>
        		<?php include "sidebarpost.php";?>
        </div>
    </div>
</div>
<!-- END SECTION BLOG -->

<?php include "footer.php";?>