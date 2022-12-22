<?php

include 'condb.php';
session_start();
$user_id = 8;
?>

<!DOCTYPE html>
<html lang="en">
<style>
      body{
         display: flex;
         flex-wrap: wrap;
         justify-content: center;
         background-color: #77777775;
         padding-top: 36px;
         font-family: "Segoe UI";
      }  
      article{
         width: 100%;
         display: flex;
         flex-wrap: wrap;
         justify-content: center;
      }
      article div{
         width: 500px;
         background-color: white;
         display: flex;
         flex-wrap: wrap;
         align-content: center;
      }
      main{
         width: 500px;
      }
      .posts{
         margin-top: 24px;
         width: 100%;
         height: 280px;
         background-color: white;
         display: flex;
         flex-wrap: wrap;
         box-shadow: 0 0 8px 1px rgba(0, 0, 0.4);
      }
      .posts div{
         width: 100%;
      }
      .prof_bar{
         width: 100%;
         display: flex;
         flex-wrap: nowrap;
         align-items: center;
      }
      .prof_bar div{
         margin-left: 12px;
      }
      .time_bar{
         margin: 0; padding: 0;
         width: 100px !important;
         display: flex;
         flex-wrap: wrap;
      }
      .time_bar div{
         width: 100%;
      }
      .upload{
         width: 140px;
         border: 1px dashed #777777;
         color: #777777;
         text-align: center;
         padding: 24px 0;
      }
      button{
         width: 80px;
         border: none;
         background-color: dodgerblue;
         color: white;
         padding: 4px 0;   
      }
   </style>
   <script>
      var full_url = '';

      function getImage(photo){
         var url_splits = photo.split('\\');
         var last = url_splits.length - 1;
         var real_url = url_splits[last];
         full_url = "http://localhost/User_profile/img/" + real_url;
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
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body onload="getFeed()">
   
<div class="container">

   

</div>
<article>
      <div style="padding-bottom: 12px;">
         <div class="prof_bar" style="height: 40px">
            <div style="width: 36px; height: 36px">

            </div>
         </div>
      </div>
      <div style="width: 60%; height: 80px; margin-left: 12px; border: 1px solid black;">
         <div style="width: 160px; height: 80px; margin-left: 12px;">
            <img src="" id="preview" width="100%" height="100%" style="display: none;">
         </div>

         <label class="upload" for="uploadDialog">+</label>
      <form action="insertDB.php" method="post" enctype="multipart/form-data">
         <input type="text" name="title" placeholder="title"><br>
         <input type="text" name="price" placeholder="price"><br>
         <input type="text" name="category" placeholder="category"><br>
         <input type="hidden" name="product_status" value="1"><br>
         <input type="file" id="uploadDialog" style="display: none;" name="my_image" onchange="getImage(this.value)"/>
      </div>
      <div style="margin-left: 12px;">
         <input type="submit" name="submit" value="Upload">
      </div>
   </form>
   </article>
   <main id="main">
      
   </main>
</body>
</html>