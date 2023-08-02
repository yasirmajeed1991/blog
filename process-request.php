<?php
include "config.php";
if(isset($_POST["country"])){
    // Capture selected country value
    $country = $_POST["country"];
	if($country !== ''){
     $result = mysqli_query($conn,"SELECT * FROM blog_subcategory where category_id =$country"); 
									while($row = mysqli_fetch_array($result)) 
									{
										
									
	 ?>
<option value="<?php echo $row['sub_category_name'];?>"><?php echo $row['sub_category_name'];?></option>
<?php	
}
    
	}
}
?>

