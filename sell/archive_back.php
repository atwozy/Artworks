<?php

	include 'config.php';
 
	$query = mysqli_query($conn, "SELECT * FROM `artworks_archive` WHERE artid ='". $_GET['archiveid']."'   ") or die('query failed');

	while($fetch = mysqli_fetch_array($query)){
		if(($fetch['artid'])> 0){
			mysqli_query($conn, "INSERT INTO `sining_artworks` VALUES('$fetch[artid]', '$fetch[image]', '$fetch[title]', '$fetch[category]', '$fetch[price]', '$fetch[artistid]')") or die(mysqli_error($conn));
            mysqli_query($conn, "DELETE FROM `artworks_archive` WHERE artid ='". $_GET['archiveid']."' ") or die(mysqli_error($conn));
			
        }
        header('location:sellerprofile.php');
	}
?>