<?php 
include('database_connection.php');
include('condb.php')

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sining Homepage</title>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom CSS -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <!-- <link href="css/style.css" rel="stylesheet"> -->
</head>

<body>
    <!-- Page Content --><br><br><br>
    <div class="container">
        <div class="row">
        	<br />
        	<!-- <h2 align="center">Sining</h2> -->
        	<br />
            <div class="col-md-3">                				
				<div class="list-group">
					
                </div>				
               
                </div>

            </div>

            <div class="col-md-9">
            	<br />
                <div class="row filter_data">

                </div>
            </div>
        </div>

    </div>
<style>
#loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}
</style>

<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'testfetch.php';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var category = get_filter('category');
        $.ajax({
            url:"testfetch.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, category:category},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

   

    

});
</script>

</body>

</html>