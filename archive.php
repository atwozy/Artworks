<?php  
include 'condb.php';
session_start();

$delete=$_POST['delete'];
$archiveid=$_POST['archivedId'];



$query = mysqli_query($conn, "SELECT * FROM `sining_posts` WHERE postId ='$archiveid'   ") or die('query failed');

while($fetch = mysqli_fetch_array($query)){
		if(($fetch['id'])> 0){
			mysqli_query($conn, "DELETE FROM `sining_posts` WHERE postId ='$archiveid' ") or die(mysqli_error($conn));
			
		}
        header('location: home.php');
}


?>