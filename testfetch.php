<style>
	.image-box{
		width: 230px;
		height: auto;
		text-align: center;
	}
	.image-box img{
		width: 100%;
		height: auto;
	}
	.image-box img:hover{
		transform: scale(2);
		cursor: pointer;
		transition: ease-in-out .4s;
		border: 2px solid #ffc800;
		z-index: 1;
		position: relative;
	}
	.image-box .text-danger{
		color: #000;
	}
	.image-box a{
		text-decoration: none;
		font-size: larger;
	}
	h4{
		color: #000;
	}
</style>

<?php
include ('condb.php');
include('database_connection.php');
session_start();
error_reporting(E_ERROR | E_PARSE);
$artid = $_POST['artid'];
$fetchart = $_SESSION['fetchartid'];
$artistid= $_SESSION["artistid"];

$user_id = $_SESSION['user_id'];
include 'similarity.php';
	$host = "localhost";
	$user = "root";
	$pass = "";
	$dbname = "jcra-sining";

    $select_products = mysqli_query($conn, "SELECT * FROM sining_artists INNER JOIN sining_artworks 
    ON sining_artists.artistId = sining_artworks.artistId");  

    if(mysqli_num_rows($select_products) > 0){
       while($fetch_product = mysqli_fetch_assoc($select_products)){
    if(isset($_POST["action"]))
    {

        $fetch=$fetch_product['artistId'];

	$query = "
	SELECT * FROM sining_artists INNER JOIN sining_artworks 
    ON sining_artists.artistId = sining_artworks.artistid WHERE sining_artworks.artistid ='$artistid' 
    AND sining_artworks.artId <> '$fetchart'";

	
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row ){
				
		$output .= '
			<form action="view_art.php" method=post>
				<div class="col-sm-4 col-lg-3 col-md-3">
				<div class=image-box style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px;">
					<img src="artworks/'. $row['artImage'] .'" alt="" class="img-responsive"><br><br>
					<p class="text" align="center">
					<strong>
						<button type="submit" name="artid" value="'.$row['artId'].'">'. $row['artTitle'] .'</button>
                    </strong>
			<form>
					</p>
			<h4 class="text" >'.'₱'. $row['artPrice'] .'</h4>
            <h4 class="text" >'.$row['artId'].'</h4>
			<h6>'. $row['artCategory'] .' </h6><br>
            <h6>'.$_SESSION['artistid']=$fetch_product['artistId'].'</h6><br>
            
			</div>
		</div>';
	}
	$i++;
}
else
	{
		$output = '<h3>No Data Found</h3>';
	}}}
	echo $output;
	}
?>