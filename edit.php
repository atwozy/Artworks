<?php  
include 'condb.php';
session_start();
$edit=$_POST['edit'];
$archiveid=$_POST['archivedId'];


if(isset($_POST['update_profile'])){


   $update_caption = mysqli_real_escape_string($conn, $_POST['update_caption']);

   mysqli_query($conn, "UPDATE `sining_posts` SET caption = '$update_caption' WHERE id = '$archiveid'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 20000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `sining_posts` SET image = '$update_image' WHERE id = '$archiveid'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated succssfully!';

      }
   }
header('location:home.php');
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
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="update-profile">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM `sining_posts` WHERE id = '$archiveid'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>UPDATE POST</h3>
      <?php
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="img/'.$fetch['image'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <span>your caption :</span>
            <input type="text" name="update_caption" value="<?php echo $fetch['caption']; ?>" class="box">
            <span>update your pic :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
         </div>
      </div>
      <input type="submit" value="update profile" name="update_profile" class="btn">
      <a href="home.php" class="delete-btn">go back</a>
   </form>

</div>
</body>
</html>


?>