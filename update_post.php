<?php session_start();
    if(!isset($_SESSION['user_id']))
   {
    header("location:login.php");
   }
   else
   { 
					include "header.php";
					include "headerglyph.php";
					include "config.php";		
					$universal_user_id = $_SESSION['user_id'];
					$post_id_of_post = $_GET['id'];
			$post_titleErr = $post_categoryErr = $sub_categoryErr = $post_main_imgErr = $post_content_bodyErr = $post_quoteErr = $post_1st_imgErr = $post_2nd_imgErr = $post_content_contErr = ""; 
			$post_title    = $post_category    = $sub_category    = $post_main_img    = $post_content_body    = $post_quote    = $post_1st_img    = $post_2nd_img    = $post_content_cont = ""; 
             
				if(!empty($_GET['id']))
				{
					
					
					
					$result = mysqli_query($conn,"SELECT * FROM blogs WHERE id=$post_id_of_post"); 
					$post_result = mysqli_fetch_array($result);
					
					$post_title          =  $post_result['post_title'];
					$post_category       =  $post_result['post_category'];
					$sub_category        =  $post_result['sub_category'];
					$post_main_img       =  $post_result['post_main_img'];
					$post_content_body   =  $post_result['post_content_body'];
					$post_quote          =  $post_result['post_quote'];
					$post_1st_img        =  $post_result['post_1st_img'];
					$post_2nd_img        =  $post_result['post_2nd_img'];
					$post_content_cont   =  $post_result['post_content_cont'];
				}
				

   
        if($_SERVER["REQUEST_METHOD"]=="POST") 
		{
			
			function test_input($data) 
			{
			 $data = trim($data);
			 $data = stripslashes($data);
			 $data = htmlspecialchars($data);
		     return $data;		
			}
			
			$post_title          =  $_REQUEST['post_title'];
	 		$post_category       =  $_REQUEST['post_category'];
	 		$sub_category        =  $_REQUEST['sub_category'];
			$post_main_img       =  $_REQUEST['post_main_img'];
			$post_content_body   =  $_REQUEST['post_content_body'];
			$post_quote          =  $_REQUEST['post_quote'];
			$post_1st_img        =  $_REQUEST['post_1st_img'];
			$post_2nd_img        =  $_REQUEST['post_2nd_img'];
			$post_content_cont   =  $_REQUEST['post_content_cont'];
		
				//post_title
				if (empty($_REQUEST['post_title']))
				{
					$post_titleErr="This is Required";
				}
				  else
				{
				    $post_title = test_input($_REQUEST["post_title"]);
					$post_title=preg_replace("/[^A-Za-z0-9 .]/", '', $post_title);
      			  if (!preg_match("/^[a-zA-Z-'0-9 ]*$/",$post_title)) 
				  {
                    $post_titleErr = "Only letters and white space allowed";
				  }
				  if(strlen($_REQUEST['post_title'])<70 && strlen($_REQUEST['post_title'])>150)
					{
						$post_titleErr = "This Field Must Contain At Least 100 to 150 Characters";
					}
				}
            	
				//post_category
                if (empty($_REQUEST['post_category']))
				{
					$post_categoryErr="This is Required";
				}
				    else
				{
				    $post_category = test_input($_REQUEST["post_category"]);
			    
     				if (!is_numeric($post_category)) 
				  {
                    $post_categoryErr = "Only Number value allowed";
				  }
				  else
				  {
							$query		=	"SELECT * FROM  blog_categories ";
							$rsa1		=	mysqli_query($conn,$query) or die(mysqli_error());
							while($row1		=	mysqli_fetch_array($rsa1))
							{
								if($row1['id'] == $post_category)
								{
									$post_category = $row1['name'];
								}
							}
				  }
				}
        
				//post_content_body
				if (empty($_REQUEST['post_content_body']))
				{
					$post_content_bodyErr="This is Required";
				}
				  else
				{
				    $post_content_body = test_input($_REQUEST["post_content_body"]);
					$post_content_body=preg_replace("/[^A-Za-z0-9 .]/", '', $post_content_body);
     				 if(strlen($_REQUEST['post_content_body'])<100)
					{
						$post_content_bodyErr = "This Field Must Contain At Least 100 Characters";
					}
				}	

					//post_quote
				if (empty($_REQUEST['post_quote']))
				{
					$post_quoteErr="This is Required";
				}
				  else
				{
				    $post_quote = test_input($_REQUEST["post_quote"]);
			        $post_quote=preg_replace("/[^A-Za-z0-9 .]/", '', $post_quote);
				    if(strlen($_REQUEST['post_quote'])>300)
					{
						$post_quoteErr = "Quotes must be less than 300 characters";
					}
				}		

				//post_content_cont
				if (empty($_REQUEST['post_content_cont']))
				{
					$post_content_contErr="This is Required"; 
				}
				  else
				{
				    $post_content_cont = test_input($_REQUEST["post_content_cont"]);
					$post_content_cont=preg_replace("/[^A-Za-z0-9 .]/", '', $post_content_cont);
     				 if(strlen($_REQUEST['post_content_cont'])<100)
					{
						$post_content_contErr = "This Field Must Contain At Least 100 Characters";
					}
				}					
				//post_main_img
				if (empty($_FILES["post_main_img"]["tmp_name"]))
				{
					$post_main_img=$post_result['post_main_img']; 
				}
				else
				{
						// Set image placement folder
						$target_dir = "uploads/";
						// Get file path
						$filename = rand(10,100000). basename($_FILES["post_main_img"]["name"]);
						$post_main_img = $target_dir . $filename;     //Path of the file to be uploaded
						// Get file extension
						$imageExt = strtolower(pathinfo($post_main_img, PATHINFO_EXTENSION));
						// Allowed file types
						$allowd_file_ext = array("jpg", "jpeg", "png");
						

						if (!file_exists($_FILES["post_main_img"]["tmp_name"])) 
						{
						    
						   
						} 
						else if (!in_array($imageExt, $allowd_file_ext)) 
						{
							$post_main_imgErr = "Allowed file formats .jpg, .jpeg and .png.";
						            
						} 
						else if ($_FILES["post_main_img"]["size"] > 2097152) 
						{
							$post_main_imgErr =  "File is too large. File size should be less than 2 megabytes.";
						} 
						else if (file_exists($post_main_img)) 
						{
							
							$post_main_imgErr = "File already exists.";
							
						} 
						else 
						{
							$ok=1;
						}

							
				}
						
				if (empty($_FILES["post_1st_img"]["tmp_name"]))
				{
					$post_1st_img = $post_result['post_1st_img']; 
				}
				else
				{
						
						// Set image placement folder
						$target_dir = "uploads/";
						// Get file path
						$filename = rand(10,100000). basename($_FILES["post_1st_img"]["name"]);
						$post_1st_img = $target_dir . $filename;     //Path of the file to be uploaded
						// Get file extension
						$imageExt = strtolower(pathinfo($post_1st_img, PATHINFO_EXTENSION));
						// Allowed file types
						$allowd_file_ext = array("jpg", "jpeg", "png");
						//post_1st_img
						
						if (!file_exists($_FILES["post_1st_img"]["tmp_name"])) 
						{
						   
						   
						} 
						else if (!in_array($imageExt, $allowd_file_ext)) 
						{
							$post_1st_imgErr = "Allowed file formats .jpg, .jpeg and .png.";
						            
						} 
						else if ($_FILES["post_1st_img"]["size"] > 2097152) 
						{
							$post_1st_imgErr =  "File is too large. File size should be less than 2 megabytes.";
						} 
						else if (file_exists($post_1st_img)) 
						{
							
							$post_1st_imgErr = "File already exists.";
							
						} 
						else 
						{
							$ok=1;
						}	
				}
				//post_2nd_img
				if (empty($_FILES["post_2nd_img"]["tmp_name"]))
				{
					$post_2nd_img= $post_result['post_2nd_img']; 
				}		
				else
				{
				// Set image placement folder
						$target_dir = "uploads/";
						// Get file path
						$filename = rand(10,100000). basename($_FILES["post_2nd_img"]["name"]);
						$post_2nd_img = $target_dir . $filename;     //Path of the file to be uploaded
						// Get file extension
						$imageExt = strtolower(pathinfo($post_2nd_img, PATHINFO_EXTENSION));
						// Allowed file types
						$allowd_file_ext = array("jpg", "jpeg", "png");
						

						if (!file_exists($_FILES["post_2nd_img"]["tmp_name"])) 
						{
						    
						   
						} 
						else if (!in_array($imageExt, $allowd_file_ext)) 
						{
							$post_2nd_imgErr = "Allowed file formats .jpg, .jpeg and .png.";
						            
						} 
						else if ($_FILES["post_2nd_img"]["size"] > 2097152) 
						{
							$post_2nd_imgErr =  "File is too large. File size should be less than 2 megabytes.";
						} 
						else if (file_exists($post_2nd_img)) 
						{
							
							$post_2nd_imgErr = "File already exists.";
							
						} 
						else 
						{
							$ok=1;
						}		
				}
				if(empty($post_titleErr) && empty($post_categoryErr) && empty($sub_categoryErr) && empty($post_main_imgErr) && empty($post_content_bodyErr) && empty($post_quoteErr) && empty($post_1st_imgErr) && empty($post_2nd_imgErr) && empty($post_content_contErr))
				{
				 
					if(move_uploaded_file($_FILES["post_main_img"]["tmp_name"], $post_main_img))
					{
								//			echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
								$imageUrl = $post_result['post_main_img'];
								//check if image exists
								if(file_exists($imageUrl))
							{
								//delete the image
								unlink($imageUrl);
							}
					}
				 
					if(move_uploaded_file($_FILES["post_1st_img"]["tmp_name"], $post_1st_img))
					{
								//			echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
								$imageUrl = $post_result['post_1st_img'];
								//check if image exists
								if(file_exists($imageUrl))
							{
								//delete the image
								unlink($imageUrl);
							}
					}
					if(move_uploaded_file($_FILES["post_2nd_img"]["tmp_name"], $post_2nd_img))
					{
								//			echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
								$imageUrl = $post_result['post_2nd_img'];
								//check if image exists
								if(file_exists($imageUrl))
							{
								//delete the image
								unlink($imageUrl);
							}
					}
					$date_updated = date ("F jS, Y");
			     	$query = "UPDATE blogs SET post_title='$post_title',post_category='$post_category',sub_category='$sub_category',post_main_img='$post_main_img',post_content_body='$post_content_body',post_quote='$post_quote',post_1st_img='$post_1st_img',post_2nd_img='$post_2nd_img',post_content_cont='$post_content_cont',date_updated='$date_updated' 
					WHERE id=$post_id_of_post";
					mysqli_query($conn,$query) or die(mysqli_error());
					header("location:funtions.php?updatepost=".$post_id_of_post."");
				}	





					
		
		}
		
		

?>	 
<!-- START MAIN CONTENT -->
<div class="main_content">
<!-- START SECTION BLOG -->
<div class="section">
	<div class="container">
    	<div class="row">
        	<div class="col-xl-9">
			<?php if($_SESSION['message_success']!=""){echo '<p class="alert alert-success">'.$_SESSION['message_success'].'</p>';$_SESSION['message_success']='';}?>
			  	<div class="single_post">
				<form method="post" enctype="multipart/form-data">
									<div class="row col">
										
											<input class="form-control " type="text" placeholder="Title" name="post_title" value="<?php echo $post_title?>" required>
										    <span class="error"> <?php echo $post_titleErr ?> </span>
									</div>
									
									<div class="row top-buffer">
											<div class="form-group col-md-4">
											   <select   name="post_category" class="form-control country"  required>
													<option value="">Select Category</option>
													<?php
													$result = mysqli_query($conn,"SELECT * FROM blog_categories"); 
													while($row = mysqli_fetch_array($result)) {
														$category_id = $row['id'];
														$category_name = $row['name'];
														if($row['name'] == $post_category  ){$selectedd="selected";}else {$selectedd='';}
													?>
													
														<option value="<?php echo $category_id;?>" <?php echo $selectedd?>><?php echo $category_name;?></option>
														
													<?php
													}
													?>
											  </select> <span class="error"><?php echo $post_categoryErr?></span>
											</div>
											<div class="form-group col-md-4">
												<select id="response" name="sub_category" class="form-control" required >
													<option value="<?php echo $sub_category;?>"><?php echo $sub_category;?></option>
											  </select><span class="error"><?php echo $sub_categoryErr?></span>
											</div>
									</div>		
									

									<div class="blog_img top-buffer">
									
									 <!--   <img src="assets/images/blog_img1.jpg" alt="blog_img1">		-->
									 <img src="<?php echo $post_main_img;?>" width="500px" height="400px">
														Select Main image to upload:
														<input type="file" name="post_main_img"  >
														
									</div><span class="error"> <?php echo $post_main_imgErr ?></span>
									
									<div class="row col top-buffer">
										
											<textarea class="form-control" name="post_content_body" value="<?php echo $post_content_body?>" placeholder="Content Body" rows="5" required><?php echo $post_content_body?></textarea>
										     <span class="error"><?php echo $post_content_bodyErr?></span>
									</div>
									
									<div class="row col top-buffer">
										<blockquote class="blockquote_style3">
											<textarea class="form-control" name="post_quote" placeholder="Quotes Not More Than 300 Characters" rows="2" value="<?php echo $post_quote?>" required><?php echo $post_quote?></textarea>
											<span class="error"><?php echo $post_quoteErr?></span>
										</blockquote>
									</div>
								
									<div class="blog_content">
										<div class="blog_text">
											   
													  
											<div class="row">
												<div class="col-sm-6">
													<div class="single_img top-buffer">
														<img src="<?php echo $post_1st_img;?>" width="350px" height="400px">
														Select 1st image to upload:
														
														<input type="file" name="post_1st_img"     >
                                                        												
													</div><span class="error"><?php echo $post_1st_imgErr?></span>	
												</div>
												<div class="col-sm-6">
													<div class="single_img top-buffer">
													<img src="<?php echo $post_2nd_img;?>" width="350px" height="400px">
														Select 2nd image to upload:
														
														<input type="file" name="post_2nd_img">
                                                       
                                                    </div> <span class="error"><?php echo $post_2nd_imgErr?></span>
												</div>
											</div>
											
											<div class="row col top-buffer">
										
												<textarea class="form-control" name="post_content_cont" placeholder="Content Continue" rows="10" value="<?php echo $post_content_cont?>" ><?php echo $post_content_cont?></textarea>
										         
											</div ><span class="error"><?php echo $post_content_contErr?></span>
											<div class="top-buffer">
											<button  class="btn-danger btn-sm" type="submit" target="_blank">Update Post!</button>
											</div>
										</div>
									</div>
								</div>
                </form>
            </div>
        	
			<?php include "sidebarpost.php";?>
        </div>
    </div>
</div><div style="height:100px;"></div>
<!-- END SECTION BLOG -->
   <?php include "footer.php";}?>