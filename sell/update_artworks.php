<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];


if(isset($_POST['update_artworks'])){


  

   $update_title = mysqli_real_escape_string($conn, $_POST['update_title']);
   $update_category = mysqli_real_escape_string($conn, $_POST['update_category']);
   $update_price = mysqli_real_escape_string($conn, $_POST['update_price']);

   mysqli_query($conn, "UPDATE `sining_artworks` SET title ='$update_title', category ='$update_category', price = '$update_price' WHERE artid =' ". $_GET['updateid']." ' ") or die('query failed');


   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `sining_artworks` SET image = '$update_image' WHERE artid ='". $_GET['updateid']."'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated successfully!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/updateartworks.css">
</head>
<body>
   
<div class="update-profile">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM `sining_artworks` WHERE artid ='". $_GET['updateid']."'   ") or die('query failed');
      
      
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
      
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="../uploaded_img/'.$fetch['image'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
            <span>Title :</span>
            <input type="text" name="update_title" value="<?php echo $fetch['title']; ?>" class="box">
            <span>Category :</span>
            <input type="text" name="update_category" value="<?php echo $fetch['category']; ?>" class="box">
            <span>Price :</span>
            <input type="number" name="update_price" value="<?php echo $fetch['price']; ?>" class="box">
         </div>
      </div>
      <div class="button">
      <input type="submit" value="UPDATE" name="update_artworks" class="btn">
      
      </form>
      <button class="btn"><a href="sellerprofile.php">BACK</a></button>
      </div>

</div>

</body>
</html>