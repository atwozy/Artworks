<?php

	include 'condb.php';
 
	$query = mysqli_query($conn, "SELECT * FROM `artworks_archive` WHERE artId ='". $_GET['archiveid']."'   ") or die('query failed');

	while($fetch = mysqli_fetch_array($query)){
		if(($fetch['artId'])> 0){
			mysqli_query($conn, "INSERT INTO `sining_artworks` VALUES('$fetch[artId]', '$fetch[artImage]', '$fetch[artTitle]', '$fetch[artCategory]', '$fetch[artPrice]', '$fetch[artistid]')") or die(mysqli_error($conn));
            mysqli_query($conn, "DELETE FROM `artworks_archive` WHERE artId ='". $_GET['archiveid']."' ") or die(mysqli_error($conn));
			
        }
        header('location:sellerprofile.php');
	}
?>