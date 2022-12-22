<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Privacy Settings</title>
	<link rel="stylesheet" href=" css/updateprofile.css">
</head>
<?php  
include 'condb.php';
session_start();
$user_id = $_SESSION['user_id'];
   
if(isset($_POST['update_profile'])){

   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `sining_artists` SET artistPassword = '$confirm_pass', artistEmail ='$update_email' WHERE artistId = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }
}
?>
<body>
<div class="update-profile">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM `sining_artists` WHERE artistId = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>Email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['artistEmail']; ?>" class="box"><br>
            <input type="hidden" name="old_pass" value="<?php echo $fetch['artistPassword']; ?>">
            <span>Old Password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box"><br>
            <span>New Password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box"><br>
            <span>Confirm Password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box"><br><br>
         </div>
      </div>
      <div class="buttons">
         <input type="submit" value="UPDATE" name="update_profile" class="btn">
         <a href="userprofile.php" class="btn">BACK</a>
      </div>
      
   </form>
   

</div>
</body>
</html>