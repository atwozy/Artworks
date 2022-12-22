<!DOCTYPE html>
<html>
<?php
	session_start();
	$profile = $_SESSION['profile'];
?>
<head>
	<title>Sining-NewsFeed</title>
	<script>
		var full_url = '';

		function getImage(photo){
			var url_splits = photo.split('\\');
			var last = url_splits.length - 1;
			var real_url = url_splits[last];
			full_url = "http://localhost/JCRA-Sining/addpost_newsfeed/img/" + real_url;
			var preview = document.getElementById('preview');
			preview.style.display = "block";
			preview.src = full_url;
			alert(full_url);
		}

		function upload(){
			var ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function(){
				if(ajax.readyState === 4 && ajax.status === 200){
					var mess = ajax.responseText;
					var preview = document.getElementById('preview');
					preview.style.display = "none";
					preview.src = "";
					getFeed();
				}
			};
			ajax.open('POST', 'upload_image.php', true);
			ajax.setRequestHeader('Content-type', 'application/x-www-form-urlcoded');
			ajax.send("imageName" + full_url);
		}

		function getFeed(){
			var cont = document.getElementById('main');
			var ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function(){
				if(ajax.readyState === 4 && ajax.status === 200){
					main.innerHTML = ajax.response;
				}
			};
			ajax.open('GET', 'get_feed.php', true);
			ajax.send();
		}
	</script>
	<link rel="stylesheet" type="text/css" href="css/newsfeedstyle.css">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body onload="getFeed()">
	<article>
		<div>
			<div class="prof_bar">
				<div style="width: 150px; height: 150px">
					<img src="img/<?php echo $profile ?>" width="55px" height="55px" style="border-radius: 50%; margin-right: 1%;" class="pfp"/>
				</div>
			</div>
		</div>
		<div>
			<div>
				<img src="" id="preview" width="100%" height="100%" style="display: none;">
			</div>

			<label class="upload" for="uploadDialog"><i class="fa fa-file-image-o"></i></label>
			<form action="upload.php" method="post" enctype="multipart/form-data">
			<input type="text" name="caption" placeholder="Write Caption">
			<input type="file" id="uploadDialog" style="display: none;" name="my_image" onchange="getImage(this.value)"/>
		</div>
		<div style="margin-top: 10%;">
			<input type="submit" name="submit" value="Upload Image" >
		</div>
	</form>

	</article>
	<main id="main">
		
	</main>
</body>
</html>