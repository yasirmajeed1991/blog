<?php if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include "config.php";
error_reporting(0);
ob_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="Anil z" name="author">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Shopwise is Powerful features and You Can Use The Perfect Build this Template For Any eCommerce Website. The template is built for sell Fashion Products, Shoes, Bags, Cosmetics, Clothes, Sunglasses, Furniture, Kids Products, Electronics, Stationery Products and Sporting Goods.">
<meta name="keywords" content="ecommerce, electronics store, Fashion store, furniture store,  bootstrap 4, clean, minimal, modern, online store, responsive, retail, shopping, ecommerce store">

<!-- SITE TITLE -->
<title>Multi USER BLOG</title>
<!-- Favicon Icon -->
<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">
<!-- Animation CSS -->
<link rel="stylesheet" href="assets/css/animate.css">	
<!-- Latest Bootstrap min CSS -->
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet"> 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("select.country").change(function(){
        var selectedCountry = $(".country option:selected").val();
        $.ajax({
            type: "POST",
            url: "process-request.php",
            data: { country : selectedCountry } 
        }).done(function(data){
            $("#response").html(data);
        });
    });
});


$(document).ready(function(){
	$("#commentreplyare") .click(function(){
		$("#reply_form").hide();
	});
});

</script>
<!-- Icon Font CSS -->
<link rel="stylesheet" href="assets/css/all.min.css">
<link rel="stylesheet" href="assets/css/ionicons.min.css">
<link rel="stylesheet" href="assets/css/themify-icons.css">
<link rel="stylesheet" href="assets/css/linearicons.css">
<link rel="stylesheet" href="assets/css/flaticon.css">
<link rel="stylesheet" href="assets/css/simple-line-icons.css">
<!--- owl carousel CSS-->
<link rel="stylesheet" href="assets/owlcarousel/css/owl.carousel.min.css">
<link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.css">
<link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.default.min.css">
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="assets/css/magnific-popup.css">
<!-- Slick CSS -->
<link rel="stylesheet" href="assets/css/slick.css">
<link rel="stylesheet" href="assets/css/slick-theme.css">
<!-- Style CSS -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/responsive.css">


<style>

.header {
       background-color: #3b5998;
	   
}
.footer {
       background-color: #3b5998;
	   color:white;
	   
}
.footer_p{
	color:#889bc4;
}
.specific_color{
	color:#889bc4;
}
.footer_p:hover{
	color:white;
}
.btn-primary {
    color: #3b5998;
    background-color: white;
    border-color: white;
	font-size:11px;
	padding: 04px 08px;
	border-radius: 0px;
	
}
.btn-primary:hover{
	background-color:white;
	color:#3b5998;
	border-color:white;
	
}
.btn-primary:focus{
	background-color:white;
	border-color:white;
	
}
.img_human{
	padding-left:30px;
}
.site_title{
font: 35px Arial;
color:#3b5998;

}
.top-buffer { margin-top:20px; }
.a1:link, .a1:visited {
  background-color: #f44336;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  width: 170px;
}
.blog_title{
	font-size:16px;
	
}
.section {
    padding: 0px 0;
    position: relative;
}
.error{
	color:red;
}
.p2-title-mini {
	padding: 30px 0;
}
.image_dimensions{
	width:540px !important;
	height:360px; 
}
.main_image{
	    width: 825px;
    height: 550px;
}
</style>

</head>

<body>

<!-- START HEADER -->
<header class="header_wrap  fixed-top header_with_topbar">
	<div class="top-header header ">
        <div class="container">
            <div class="row ">
                <div class="col-md-5">
                	<a href="index.php" class="logo">
							<img src="img/logo2.png" alt="">
					</a>
                </div>
                <div class="col-md-6 " style="margin-top: 12px;margin-bottom:0px;font-size:14px;">
							<div class="row" >
										<div class="col-md-3">
										<?php if($_SESSION['user_id']!=''){?>
										<p><a style="color:white;" href="myprofile.php">My Profile</a></p>	
										<?php }?>
										</div>

										<div class="col-md-3">
										<?php if($_SESSION['user_id']!=''){?>
										<p><a style="color:white;" href="mypost.php">My Post</a></p>
										<?php }?>
										</div>	
										<div class="col-md-3">
										<div > <a href="post.php" class="btn btn-primary">Create Post</a>        </div>
										</div>
										
										<div class="col-md-2">
											 
													
													<div class="img_human"> <a <?php if(!empty($_SESSION['user_id'])){echo 'href="logout.php"';}else{?>href="login.php"<?php }?>><img src="img/loginsymbol1.png"/></a>   </div>
											 
										</div>	
										
										
							</div>			
				</div>
				
            </div>
        </div>
    </div>
    
</header>
<!-- END HEADER -->
