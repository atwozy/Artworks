<?php

include 'config.php';
session_start();


if(isset($_POST['submit'])){


   //$email = mysqli_real_escape_string($conn, $_POST['email']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);

   $select = mysqli_query($conn, "SELECT * FROM `sining_artists` WHERE email = '$email' AND password = '$password' ") or die('query failed');
  // $select = mysqli_query($conn, "SELECT * FROM sining_artists INNER JOIN sining_artworks ON sining_artists.id = sining_artworks.id WHERE sining_artists.email='$email'");  

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:sellerprofile.php');
   }else{
      $message[] = 'Incorrect email!';
   }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sining | Title</title>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="email" name="email" placeholder="email" class="box" required>
      <input type="password" name="password" placeholder="password" class="box" required>
      <input type="submit" name="submit" value="Next" class="btn">

   </form>

</div>


</body>
</html>