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

$user_id = $_SESSION['user_id'];
include 'similarity.php';
	$host = "localhost";
	$user = "root";
	$pass = "";
	$dbname = "jcra-sining";

	$sql = $conn -> query("SELECT * FROM sining_artists WHERE artistId= '$user_id' ORDER BY artistId DESC");

	$conn1 = new Mysqli($host, $user, $pass, $dbname);
	$sql1 = $conn1 -> query('SELECT * FROM sining_artworks ORDER BY artId ASC');
	$count = $sql1 -> num_rows;

	while($post = mysqli_fetch_assoc($sql)){
		
		$artistTarget= explode(",",$post['artistTarget']);
		}


		while($post = mysqli_fetch_assoc($sql1)){
					$title = $post['artTitle'];
					$exoTags= explode(",",$post['artTags']);
					$articles[] = array(
						$tag1="article" => $title, 
						$tag2="tags" => $exoTags
					);	
			}

		$dot = Similarity::dot(call_user_func_array("array_merge", array_column($articles, "tags")));

		$target = $artistTarget;
		//echo "example articles:<br/>";
		//print_r($articles);
		//echo "<br/>target article:<br/>";
		//print_r($target);
		//asort($score);
		//echo "</br></br>Sorted result similarity:<br/>";

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM sining_artworks WHERE product_status = '1' 
	";

	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= ("
		 AND artPrice BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		");
	}
	if(isset($_POST["category"]))
	{
		$category_filter = implode("','", $_POST["category"]);
		$query .= ("
		 AND artCategory IN('".$category_filter."')
		");
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		
			foreach($articles as $article) {
				$score[] = Similarity::cosine($target, $article['tags'], $dot);
				$sort[$article['article']] = Similarity::cosine($target, $article['tags'], $dot);
			}
			rsort($score);
			arsort($sort);
			$count = count($sort);
			//echo $count;
			//print_r($score);	
			//print_r($sort);	
			echo "\n";
			$i=0;
					foreach($result as $row ){

						if($sort[$i]<=$count){
							if($score[$i]!=0){
								$output .= '
								<form action="view_art.php" method=post>
         <div class="col-sm-4 col-lg-3 col-md-3">
            <div class=image-box style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px;">
               <button type="submit" name="artid" value="'.$row['artId'].'"><img src="artworks/'. $row['artImage'] .'" alt="" class="img-responsive"></button><br><br>
               <p class="text" align="center">
                  <strong>
                     <a href="view_art.php">'. $row['artTitle'].'</a>
                  </strong>
                  <form>
								</p>
								<h4 class="text" >'
								.'₱'. $row['artPrice'] .'
								</h4>
								<h6>'
								. $row['artCategory'] .' 
								</h6><br>
								</div>
								</div>';
							}	
					$i++;
				}
			}		
	}
	else
	{
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
	}
?>