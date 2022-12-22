<?php
require 'condb.php';
error_reporting(E_ERROR | E_PARSE);
session_start();
$user_id = $_SESSION['user_id'];


if(isset($_POST["submit"])){
  $title= $_POST["title"];
  $category= $_POST["category"];
  $price= $_POST["price"];



  #upload image#
  if($_FILES["image"]["error"] == 4){
    echo
    "<script> alert('Image Does Not Exist'); </script>"
    ;
  }
  else{
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Invalid Image Extension');
      </script>
      ";
    }
    else if($fileSize > 20000000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
      </script>
      ";
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      
      move_uploaded_file($tmpName, 'uploaded_img/' . $newImageName);
      #Insert data#
      $query = "INSERT INTO sining_artworks VALUES('', '$newImageName','$title','$category','$price', '$user_id')";
      mysqli_query($conn, $query);
      echo
      "
      <script>
        alert('Successfully Added');
        document.location.href = ' data.php';
      </script>
      ";
    }
  }
  header('location: sellerprofile.php');
}
#upload image#

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href=" css/upload.css">
  </head>

  <body>
  <div class="wrapper">
   <div class="container">
   <table class="outer-tab">
      <tr>
         <td colspan="2" class="header"><h1>Add Products</h1></td>
      </tr>
      <tr>
         <td colspan="2" class="spacer"></td>
      </tr>
      <td>

            <table class="inner-tab">
            <tr>
         <td>
            <label for="title">Title : </label>
         </td>
         <td>
            <input type="text" name="title" id = "title" required value="">
         </td>
         </tr>
      <tr>
         <td>
            <label for="category">Category : </label>
         </td>
         <td>
            <input type="text" name="category" id = "category" required value="">
         </td>
         </tr>
      <tr>
         <td>
            <label for="price">Price: </label>
         </td>
         <td>
            <input type="number" name="price" id = "price" required value="">
         </td>
      </tr>
      <tr>
         <td>
            <label for="image">Image : </label>
         </td>
         <td>
            <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png" value="">
         </td>
      </tr>
      <tr>
         <td colspan="2" class="button">
            <button type = "submit" name = "submit">Submit</button>
            <a href="sellerprofile.php"><button>Cancel</button></a>
         </td>
      </tr>
            </table>
         </td>
   </table>
   </tr>
   </div>
  </div>
  </body>
   
</html>