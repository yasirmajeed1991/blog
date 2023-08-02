<?php include "header.php";?>
<?php include "headerglyph.php";
				 			include "config.php";
									//FUNCTION FOR CHECKING TEXT INPUT  
									  function test_input($data) 
									{
									  $data = trim($data);
									  $data = stripslashes($data);
									  $data = htmlspecialchars($data);
									  return $data;
									}
								$your_name=$email=$password='';
								$your_nameErr=$emailErr=$passwordErr='';
							if($_SERVER["REQUEST_METHOD"] == "POST") 
							{
								//POSTED RECORD
								//Validation For USER Form
								 	$your_name			= 	$_REQUEST['your_name'];
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
									if (empty($_POST["password"])) 
									{
										$passwordErr = "Password is required";
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
										$query			=	"select * from user_register where email='$email' ";
										$rs		    	=	mysqli_query($conn,$query) or die(mysqli_error());
										$row		    =	mysqli_fetch_array($rs);
										if($row>0)
										{
											$message_Err = "User Already Existed Please Logged In!";
										}
										else
										{
											$query = "INSERT INTO user_register (your_name,email,password,approved,role,avatar) 
											values('$your_name','$email','$password','1','author','')";
											$rs=	mysqli_query($conn,$query) or die(mysqli_error());
												
											$message_success = "User Registered Successfully!";
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
									<h2 align="center" class="font-weight-light specific_color">Registration Details!</h2>
									<?php if($message_Err!=""){echo '<p class="alert alert-danger">'.$message_Err.'</p>';}?>
									<?php if($message_success!=""){echo '<p class="alert alert-success">'.$message_success.'</p>';}?>
									<table class="table table-bordered">
									<tr><td><span>YOUR NAME:</span>
											<input class="form-control " type="text" placeholder="Your Name" name="your_name" value="" required>
											<?php if(!empty($your_nameErr)){echo '<p class="error">'.$your_nameErr.'</p>';}?>
									</td></tr>		
									<tr><td><span>EMAIL:</span>
									<input class="form-control " type="text" placeholder="Email" name="email" value="" required>
									<?php if(!empty($emailErr)){echo '<p class="error">'.$emailErr.'</p>';}?>
										  </td></tr>
									<tr><td><span>PASSWORD:</span>
									<input class="form-control " type="password" placeholder="Password" name="password" value="" required>
									<?php if(!empty($passwordErr)){echo '<p class="error">'.$passwordErr.'</p>';}?>			
									</td></tr>
									
									<tr><td><input type="submit" value="Register" class="btn btn-fill-out">
									
									</td>  
									</tr>
									<tr><td><p ><a class="specific_color" href="login.php ">Login!</a></p></td></tr> 
									</table>
										
								</div>
                </form>
            </div>
        	
			
        </div>
    </div>
</div><div style="height:100px;"></div>
<!-- END SECTION BLOG -->
				<?php include "footer.php";?>