<?php

	include 'config.php';
 
	$query = mysqli_query($conn, "SELECT * FROM `sining_artworks` WHERE artid ='". $_GET['archiveid']."'   ") or die('query failed');

	while($fetch = mysqli_fetch_array($query)){
		if(($fetch['artid'])> 0){
			mysqli_query($conn, "INSERT INTO `artworks_archive` VALUES('$fetch[artid]', '$fetch[image]', '$fetch[title]', '$fetch[category]', '$fetch[price]', '$fetch[artistid]')") or die(mysqli_error($conn));
            mysqli_query($conn, "DELETE FROM `sining_artworks` WHERE artid ='". $_GET['archiveid']."' ") or die(mysqli_error($conn));
			
        }
        header('location:archive_page.php');
	}
?>