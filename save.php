<?php
include 'condb.php';
if(isset($_POST['tags'])){
	$tags[] = $_POST['tags'];
	$artTags= explode(",",$tags);
	print_r($artTags);
	$count = count($artTags);
	echo $count;
	for($i=0; $i<$count; $i++){
		$insert_query = "INSERT INTO art_tags (tags) VALUES ('".$artTags[$i]."')";
	}	
	mysqli_query($conn, $insert_query) or die("database error: ". mysqli_error($conn));	
	echo "Your details saved successfully. Thanks!";	
} else {
	echo "Please Enter you name and skills!";
}
?>