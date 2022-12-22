<html>
<?php
  $conn = mysqli_connect('localhost','root','','shop_db') or die('connection failed');
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<script src="custom_tags_input.js"></script>

<body>
<div class="container">	
	<h2>Create Bootstrap Tags Input with jQuery, PHP & MySQL</h2>	
	<form method="post" class="form-horizontal" action="save.php">	
		<div class="form-group">
			<label class="col-xs-3 control-label">Your Skills:</label>
			<div class="col-xs-8">
				<input type="text" name="tags" data-role="tagsinput"  />				
			</div>
		</div>
		<div class="form-group">	
			<label class="col-xs-3 control-label"></label>		
			<div class="col-xs-8">
				<input type="submit" name="submit" value="Save"/>
			</div>
		</div>  		
	</form>	
</div>
</body>
</html>