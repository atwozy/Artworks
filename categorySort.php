<?php 

	include "condb.php";
	$category = $_POST['category'];
	$price = $_POST['price'];

	if (isset($_POST['submit'])){
		$date = time();
		$sql = "SELECT * FROM sining_artworks WHERE Category = '$category' ";
		if($select_stat = $conn->query($sql)){
			while($post = $select_stat->fetch_assoc()){
				$post_title = $post['Title'];
				$post_img = $post['ImgURL'];
				$post_price = $post['Price'];
				$post_category = $post['Category'];
				$curr_time = time();
				$real_time = $curr_time - $post_time;
				$real_min = $real_time / 60;
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
						$time_string = round($days)." days ago";
					}	
				}else{
					$time_string=date_create($post_date);
					$time_string=date_format($time_string,"F d h:ia");
				}

			switch ($price) {
				case '1':
					if ($post_price<=5000) {
						echo '
						<div class = "posts">
							<div class = "prof_bar" styles="">
								<div class = "time_bar">
									<p style="margin: 0; padding: 0; font-size: 12px; color: dodgerblue;">'.$time_string.'</p>
									<p>'.$post_title.'</p><br>
									<p>'.$post_price.'</p>
								</div>
							</div>
							<div style="height: 240px">
								<img src="img/'.$post_img.'"width="100%" height="100%""/>
							</div>
						</div>
					';
					}
					break;

				case '2':
					if ($post_price>=5000 && $post_price<=15000) {
						echo '
						<div class = "posts">
							<div class = "prof_bar" styles="">
								<div class = "time_bar">
									<p style="margin: 0; padding: 0; font-size: 12px; color: dodgerblue;">'.$time_string.'</p>
									<p>'.$post_title.'</p><br>
									<p>'.$post_price.'</p>
								</div>
							</div>
							<div style="height: 240px">
								<img src="img/'.$post_img.'"width="100%" height="100%""/>
							</div>
						</div>
					';
					}
					break;

				case '3':
					if ($post_price>=15000 && $post_price<=50000) {
						echo '
						<div class = "posts">
							<div class = "prof_bar" styles="">
								<div class = "time_bar">
									<p style="margin: 0; padding: 0; font-size: 12px; color: dodgerblue;">'.$time_string.'</p>
									<p>'.$post_title.'</p><br>
									<p>'.$post_price.'</p>
								</div>
							</div>
							<div style="height: 240px">
								<img src="img/'.$post_img.'"width="100%" height="100%""/>
							</div>
						</div>
					';
					}
					break;

				case '4':
					if ($post_price>50000) {
						echo '
						<div class = "posts">
							<div class = "prof_bar" styles="">
								<div class = "time_bar">
									<p style="margin: 0; padding: 0; font-size: 12px; color: dodgerblue;">'.$time_string.'</p>
									<p>'.$post_title.'</p><br>
									<p>'.$post_price.'</p>
								</div>
							</div>
							<div style="height: 240px">
								<img src="img/'.$post_img.'"width="100%" height="100%""/>
							</div>
						</div>
					';
					}
					break;
				
				default:
					
					break;
			}}

	}}
	
 ?>