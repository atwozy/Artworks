<?php

include 'condb.php';
session_start();
$user_id = $_SESSION['user_id'];
$art_id=$_SESSION['art_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
  a:link {
  text-decoration: none;
  
   }
   </style>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="container">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `sining_artists` WHERE artistId = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['artistImage'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['artistImage'].'">';
         }
      ?>
      <h3><?php echo $fetch['artistName']; ?></h3>
      <a href="#" class="">Back</a>
      <a href="update_profile.php" class="btn">Update Profile</a>
      <a href="sellerprofile.php?logout=<?php echo $user_id; ?>" class="delete-btn">Logout</a>
      <a href="upload.php" class="btn">Add Products</a>
   </div>
</div>



<div class="update_art">
<?php
//start
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Data</title>
  </head>
  <body>
    <table cellspacing = 0 cellpadding = 10>

    <td style="font-size:5vw"> Artworks</td>

      <?php
      $category= $_POST["category"];
      $i = 1;

      $rows = mysqli_query($conn, "SELECT * FROM sining_artists INNER JOIN sining_artworks ON sining_artists.artistId = sining_artworks.artistid WHERE sining_artworks.artistid='$user_id' ORDER BY sining_artworks.artTitle ASC");  
?>

      
</div>

      <tr >
        <td style="font-size:3vw"><?php echo $category= $_POST["category"];?> </td>
      </tr>
      <?php foreach ($rows as $row) : ?>
      <tr>
        
        <td> <img src="uploaded_img/<?php echo $row["artImage"]; ?>" width = 200> </td>
        <td><?php echo $row["artTitle"]; ?></td>
        <td><?php echo $row["artistLocation"]; ?></td>
        <td><?php 
        $price=$row["artPrice"];
        $formattedNum = number_format($price, 2);
        
        
        echo $formattedNum;
        ?></td>
<!-- START UPDATE-->
<td>
   <button>
<a href="update_artworks.php? updateid=<?php echo $row["artId"]; ?>">Edit</a></button>
              
      </td>
        
         <!-- END UPDATE-->
      <td>
      <button> <a href="archive_artworks.php? archiveid=<?php echo $row["artId"]; ?>">Archive</a></button>
      </td>
      </tr>
      <?php endforeach; ?>
    </table>
    <br>
    <a href="backupsellerprofile.php">back</a>
  </body>
</html>


</body>
</html>