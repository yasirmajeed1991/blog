<?php	 include "header.php";
		include "headerglyph.php";


				 		include "config.php";
									//FUNCTION FOR CHECKING TEXT INPUT  
									  function test_input($data) 
									{
									  $data = trim($data);
									  $data = stripslashes($data);
									  $data = htmlspecialchars($data);
									  return $data;
									}
								$email=$password='';
								$emailErr=$passwordErr='';
							if($_SERVER["REQUEST_METHOD"] == "POST") 
							{
								//POSTED RECORD
								//Validation For USER Form
									$email=$password='';
									$emailErr=$passwordErr='';
									$email				=	$_REQUEST['email'];
									$password			=	$_REQUEST['password'];
								
									//EMAIL
									if (empty($_POST["email"])) 
									{
										$emailErr = "Email is required";
									} 
									else 
									{
										$email = test_input($_POST["email"]);
										// check if e-mail address is well-formed
										if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
										{
										  $emailErr = "Invalid email format";
										}
									}
									//PASSWORD 
									if (empty($_POST["password"]) || empty($_POST["password"])) 
									{
										$passwordErr = "Password is required";
									}
									else
									{
											if ((strlen($password) <4) || (strlen($password) > 20))
											{
												$passwordErr = "Password must be greater than 8 character and less than 20 ";	
											}
									}
								
									//CHECKING FOR ERRORS IF THERE IS NOT ANY ERROR THAN THE FORM SHOULD BE SUBMITTED
									if(empty($emailErr) && empty($passwordErr)) 
									{
										//CHECKING FOR RECORD IF USER EXISTED		
												$query			=	"select * from user_register where (email='$email' && password='$password') ";
												$rs		    	=	mysqli_query($conn,$query) or die(mysqli_error());
												if(mysqli_num_rows($rs)	> 0)	
												{
														$row		=	mysqli_fetch_array($rs);
														if($row['approved'] ==1)
														{
															$_SESSION['timestamp'] = time(); //set new timestamp
															$_SESSION['user_id']		=	$row['id'];
															header("location:mypost.php");
														}
														else
														{
															$message_Err= "You are not approved to Login Post/Comment!";
														}
												}		
												else
												{
													 $message_Err  = "Invalid User Details if not a registered member <a href='register.php'>Click Here</a> for registration";
												}
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
							<div class="single_post">
							<form method="post">
									<h2 align="center" class="font-weight-light specific_color">Login Details!</h2>
									<?php if($message_Err!=""){echo '<p class="alert alert-danger">'.$message_Err.'</p>';}?>
									<?php if($message_success!=""){echo '<p class="alert alert-success">'.$message_success.'</p>';}?>
									<table class="table table-bordered">
									<tr><td><span>EMAIL:</span>
									<input class="form-control " type="email" placeholder="Email" name="email" value="" required>
									<?php if(!empty($emailErr)){echo '<p class="error">'.$emailErr.'</p>';}?>	
										  </td></tr>
									<tr><td><span>PASSWORD:</span>
									<input class="form-control " type="password" placeholder="Password" name="password" value="" required>
									<?php if(!empty($passwordErr)){echo '<p class="error">'.$passwordErr.'</p>';}?>					
									</td></tr>
									<tr><td><input type="submit" value="Login" class="btn btn-danger btn-sm">
									
									</td>  
									</tr>
									<tr><td><p ><a class="specific_color" href="register.php ">Register!</a></p></td></tr> 
									</table>
										
								</div>
                </form>
            </div>
        	
			
        </div>
    </div>
</div><div style="height:100px;"></div>
<!-- END SECTION BLOG -->
	<?php include "footer.php"; ?>