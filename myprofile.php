<?php	session_start();
    if(!isset($_SESSION['user_id']))
   {
    header("location:login.php");
   }
   else
   { 
		include "header.php";
		include "config.php";
		include "headerglyph.php";
									$universal_user_id  = 	$_SESSION['user_id'];
									$query				=	"select * from user_register where id=$universal_user_id ";
									$rs		    		=	mysqli_query($conn,$query) or die(mysqli_error());
									$row		    	=	mysqli_fetch_array($rs);
									$your_name			= 	$row['your_name'];
								 	$email				=	$row['email'];
								  	$password			=	$row['password'];
									function test_input($data) 
									{
									  $data = trim($data);
									  $data = stripslashes($data);
									  $data = htmlspecialchars($data);
									  return $data;
									}
								
							if($_SERVER["REQUEST_METHOD"] == "POST") 
							{
								$your_name=$email=$password='';
								$your_nameErr=$emailErr=$passwordErr='';
								//POSTED RECORD
								//Validation For USER Form
								 	$your_name			= 	$_REQUEST['your_name'];
								 	$email				=	$row['email'];
								  	$password			=	$_REQUEST['password'];
								
									
									//PASSWORD 
									if (empty($_POST["password"]) ) 
									{
										$password = $row['password'];
									}
									else
									{
											if ((strlen($password) <5) || (strlen($password) > 30))
											{
												$passwordErr = "Password must be greater than 5 character and less than 30 ";	
											}
									}
									//USERNAME
									if (empty($_POST["your_name"])) 
									{
									$your_nameErr = "Your Name is required";
									}
									else 
									{
										// check if name only contains letters and whitespace
										if (!preg_match("/^[a-zA-Z-' ]*$/",$your_name))
										{
										  $your_nameErr = "Your name Only Contains letters and numbers";
										}
										if ((strlen($your_name)< 5) || (strlen($your_name) > 15))
										{
											$your_nameErr = "Name Must be greater than 5 and less than 30 Characters";	
										}
										
									}
								
									//CHECKING FOR ERRORS IF THERE IS NOT ANY ERROR THAN THE FORM SHOULD BE SUBMITTED
									if(empty($emailErr) && empty($passwordErr) && empty($your_nameErr)) 
									{
										//CHECKING FOR RECORD IF USER ALREADY EXISTED		
										$query			=	"UPDATE user_register SET your_name='$your_name',password='$password' where id='$universal_user_id' ";
										$rs		    	=	mysqli_query($conn,$query) or die(mysqli_error());
										$row		    =	mysqli_fetch_array($rs);
										
										header("location:funtions.php?profileok=".$universal_user_id."");		
											
										
									}
							}						
									
					

?>

 
			<!-- START MAIN CONTENT -->
			<div class="main_content">
			<!-- START SECTION BLOG -->
			<div class="section">
				<div class="container">
					<div class="row justify-content-md-center">
						<div class="col-xl-6">
						<?php if($_SESSION['message_success']!=""){echo '<p class="alert alert-success">'.$_SESSION['message_success'].'</p>';$_SESSION['message_success']='';}?>
						<div class="single_post">
							<form method="post">
									<h2 align="center" class="font-weight-light specific_color">UPDATE DETAILS!</h2>
									<?php if($message_Err!=""){echo '<p class="alert alert-danger">'.$message_Err.'</p>';}?>
									<?php if($message_success!=""){echo '<p class="alert alert-success">'.$message_success.'</p>';}?>
									<table class="table table-bordered">
									<tr><td><span>YOUR NAME:</span>
											<input class="form-control " type="text" placeholder="Your Name" name="your_name" value="<?php echo $your_name?>" required>
											<?php if(!empty($your_nameErr)){echo '<p class="error">'.$your_nameErr.'</p>';}?>
									</td></tr>		
									<tr><td><span>EMAIL:</span>
									<input class="form-control " type="text" placeholder="Email" name="email" disabled value="<?php echo $email?>" >
									<?php if(!empty($emailErr)){echo '<p class="error">'.$emailErr.'</p>';}?>
										  </td></tr>
									<tr><td><span>PASSWORD:</span>
									<input class="form-control " type="password" placeholder="Left field blank if you don't want to change password" name="password" value="" >
									<?php if(!empty($passwordErr)){echo '<p class="error">'.$passwordErr.'</p>';}?>			
									</td></tr>
									
									<tr><td><input type="submit" value="Update" class="btn btn-danger btn-sm">
									
									</td>  
									</tr>
									
									</table>
					</div>
							</form>
            </div>
        	
			
        </div>
    </div>
	
	<!--Displaying All No. of Posts and Comments on Each Post-->
	<?php
		$sql = "SELECT * FROM user_register WHERE id = $universal_user_id";
		$run_query = mysqli_query($conn,$sql);
		$fetch_data_user_register = mysqli_fetch_assoc($run_query);
	if($fetch_data_user_register['role'] == 'admin'){
	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-md-12">
				<h2 align="center" class="font-weight-light specific_color">Total No. Of Posts!</h2>
					<table class="table">
					  <thead>
						<tr>
						  <th scope="col">Sr.No</th>
						  <th scope="col">Post Title</th>
						  <th scope="col">Post Comments</th>
						  <th scope="col">Comment Replies</th>
						  <th scope="col">Current Status</th>
						  <th scope="col">Status</th>
						</tr>
					  </thead>
					  <tbody>
					  <?php
					  //update comment status to show on front//
					  if(isset($_GET['approve'])){
							$approve_status = $_GET['approve'];
							$sql = "UPDATE blog_comments SET `status` = 'Approve' WHERE id = $approve_status";
							if (mysqli_query($conn, $sql)) {
							echo "";
						} else {
							echo "Error Updating record: " . mysqli_error($conn);
						}	
					  }
					  //Delete comment status to show on front//
					  if(isset($_GET['delete'])){
							$delete_status = $_GET['delete'];
							$sql = "UPDATE blog_comments SET `status` = 'Delete' WHERE id = $delete_status";
							if (mysqli_query($conn, $sql)) {
							echo "";
						} else {
							echo "Error Updating record: " . mysqli_error($conn);
						}	
					  }
					  
					  //get data of all posts done and comments on each post
						
						$sql = "SELECT b.post_title, b.id as post_id, bc.id as comments_id, bc.body as comments, bc.status, br.body as replies 
								FROM blogs as b
								LEFT JOIN blog_comments as bc ON b.id = bc.post_id
                                LEFT JOIN blog_replies as br ON bc.id = br.comment_id
                                ";
										
								
					  $run = mysqli_query($conn,$sql);
					  while($data = mysqli_fetch_assoc($run)){
					  ?>
						<tr>
						  <th scope="row"><?php echo $data['id'] ?></th>
						  <td><a href="readpost.php?id=<?php echo $data['post_id']; ?>"><?php echo $data['post_title'] ?></a></td>
						  <td><?php echo implode(' ', array_slice(explode(' ', $data['comments']), 0, 10));?></td>
						  <td><?php echo implode(' ', array_slice(explode(' ', $data['replies']), 0, 10));?></td>
						  <td><?php echo $data['status']; ?></td>
						  <td><a href="myprofile.php?approve=<?php echo $data['comments_id']; ?>">Approve</a> | <a href="myprofile.php?delete=<?php echo $data['comments_id']; ?>"> Delete </a></td>
						</tr>
					  <?php } ?>
					  </tbody>
					</table>
				</div>
			</div>
	</div>
	<?php }else{
		echo "";
	}?>
	<!--Table End Here-->
</div><div style="height:100px;"></div>
<!-- END SECTION BLOG -->
   <?php include "footer.php"; }?>