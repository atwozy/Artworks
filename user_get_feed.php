<?php
	include 'condb.php';
	session_start();
	$user_id = $_SESSION['user_id'];


	if(!isset($user_id)){
   		header('location:index.php');
	};

	if(isset($_GET['logout'])){
   		unset($user_id);
   		session_destroy();
   		header('location:index.php');
	}

         	$select = mysqli_query($conn, "SELECT * FROM `sining_artists` WHERE artistId = '$user_id'") or die('query failed');
         		if(mysqli_num_rows($select) > 0){
            		$fetch = mysqli_fetch_assoc($select);
        		}

			$date = time();
			$select = mysqli_query($conn, "SELECT * FROM `sining_posts` WHERE ArtistsID = '$user_id'") or die('query failed');
			//$select = mysqli_query($conn, "SELECT * FROM `sining_posts` WHERE ArtistsID ORDER BY username ASC") or die('query failed');

         	if(mysqli_num_rows($select) > 0){
				while($post = mysqli_fetch_assoc($select)){
					$post_username = $post['postUsername'];
					$post_image = $post['postImage'];
					$post_time = $post['postAtime'];
					$post_date = $post['postAdate'];
					$post_caption = $post['postCaption'];
					$curr_time = time();
					$real_time = $curr_time - $post_time;
					$real_min = $real_time / 60;
					$archivedid = $post['postId'];
					if($real_min < 1){
						$time_string = $real_time." seconds ago";
					}else if($real_min >= 1 && $real_min < 60){
						$time_string = round($real_min)." minutes ago";
					}else if($real_min >= 60 && $real_min < 1440){
						$hrs = $real_min / 60;
						if(round($hrs == 1)){
							$time_string = round($hrs)." hour ago";
						}else{
							$time_string = round($hrs)." hours ago";	
						}
					}else if($real_min >=1440 && $real_min < 4320){
						$days = $real_min / 1440;
						if(round($days == 1)){	
							$time_string = round($days)." day ago";
						}else{
							$time_string=date_create($post_date);
							$time_string=date_format($time_string,"F d h:ia");
							//$time_string = round($days)." days ago";
						}	
					}else{
						$time_string=date_create($post_date);
						$time_string=date_format($time_string,"F d h:ia");
					}

					$_SESSION['archivedid'] = $archivedid;
					echo '
						<div class = "posts">
							<div class = "prof_bar">
								<div style="width: 36px; height: 36px">
									<img src="img/'.$fetch['artistProfile'].'" width="45px" height="45px" style="border-radius: 50%"/>
								</div>
								<div class = "time_bar">
									<h4>'.$post_username.'</h4>
									<p class="tiem">'.$time_string.'</p><i class="fa fa-calendar-o"></i><br>
									<p>'.$post_caption.'</p><br>
									<a href="edit.php"><i class="fas fa-edit" alt="edit" style="font-size:25px;"></i></a>
      								<a href="archive.php"><i class="fas fa-trash-alt" alt="delete" style="font-size:25px; color:#d19999;margin-left:50%; "></i></a>
								</div>
							</div>
							<div style="height: auto">
								<img src="img/'.$post_image.'"width="100%" height="100%""/>
							</div>
						</div>
					';

				}
			}else{
				echo " ".$conn->error;
			}

?>