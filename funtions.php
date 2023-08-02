<?php include "config.php";
if (!empty($_GET['newpost']))
{
	session_start();
	$_SESSION['message_success']="Post Has Been Published Successfully!";
	header("location:post.php");
}
if (!empty($_GET['updatepost']))
{
	session_start();
	$id=$_GET['updatepost'];
	$_SESSION['message_success']="Post Has Been Updated Successfully!";
	header("location:update_post.php?id=".$id."");
}
if (!empty($_GET['del_post_id']))
{	
	session_start();
	$id		=	$_GET['del_post_id'];
echo	$query	="Select * From blogs where id = $id limit 1";
	$rs = mysqli_query($conn,$query);
	$row =	mysqli_fetch_array($rs);
	$imageUrl1 = $row['post_main_img'];
	$imageUrl2 = $row['post_1st_img'];
	$imageUrl3 = $row['post_2nd_img'];
	 //check if image exists
  if(file_exists($imageUrl1))
  {
    //delete the image
    unlink($imageUrl1);
  }
  if(file_exists($imageUrl2))
  {
    //delete the image
    unlink($imageUrl2);
  }
  if(file_exists($imageUrl3))
  {
    //delete the image
    unlink($imageUrl3);
  }	
	//after deleting image you can delete the record
    $query	="DELETE From blogs where id = $id";
	$rs = mysqli_query($conn,$query);
	$_SESSION['message_success']="Post Has Been Deleted Successfully!";
	header("location:mypost.php");
  
}
if (!empty($_GET['profileok']))
{
	session_start();
	$id=$_GET['profileok'];
	$_SESSION['message_success']="Profile Has Been Updated Successfully!";
	header("location:myprofile.php");
}


?>