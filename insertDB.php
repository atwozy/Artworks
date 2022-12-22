<?php 
	session_start();
	$title=$_POST['title'];
	$price=$_POST['price'];
	$category=$_POST['category'];
	$status=$_POST['product_status'];
	if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
	include "condb.php";

	echo "<pre>";
	print_r($_FILES['my_image']);
	echo "</pre>";

	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];
	$date = time();

	if ($error === 0) {
		if ($img_size > 12500000000) {
			$em = "Sorry, your file is too large.";
		    header("Location: index.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$img_upload_path = 'artworks/'.$img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				$sql = "INSERT INTO sining_artworks(title, img,price,category,product_status) 
				        VALUES('$title','$img_name','$price','$category','$status')";
				mysqli_query($conn, $sql);
				header("Location: FORMinsertDB.php");
			}else {
				$em = "You can't upload files of this type";
		        header("Location: FORMinsertDB.php?error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: FORMinsertDB.php?error=$em");
	}

}else {
	header("Location: FORMinsertDB.php");
}