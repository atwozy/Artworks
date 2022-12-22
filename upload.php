<?php 
	session_start();
	$username=$_SESSION['Name'];
	$userid=$_SESSION['user_id'];
	$caption=$_POST['caption'];
	if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
	include "conndb.php";

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
				$img_upload_path = 'img/'.$img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				$sql = "INSERT INTO sining_posts(ArtistsID,postUsername, postImage, postLike, postCaption, postAtime) 
				        VALUES('$userid', '$username','$img_name', 1, '$caption', '$date')";
				mysqli_query($conn, $sql);
				header("Location: userprofile.php");
			}else {
				$em = "You can't upload files of this type";
		        header("Location: userprofile.php?error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: userprofile.php?error=$em");
	}

}else {
	header("Location: userprofile.php");
}