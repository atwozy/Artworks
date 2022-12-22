<?php
require 'condb.php';

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
      <tr >
        <td style="font-size:3vw"><?php echo $category= $_POST["category"];?> </td>
      </tr>
      <tr>
        <td>Title</td>
        <td>Image</td>
      </tr>

      


      <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
      <label for="category">Category : </label>
      <input type="text" name="category" id = "category" required value=""> <br>
      <button type = "submit" name = "submit">Submit</button>
    </form>
    
      <?php
      $category= $_POST["category"];

      if(isset($_POST["submit"])){
      
      $i = 1;
      //$rows = mysqli_query($conn, "SELECT * FROM sining_artworks WHERE category='$category'");
      $rows = mysqli_query($conn,"SELECT * FROM sining_artists INNER JOIN sining_artworks ON sining_artists.artistId = sining_artworks.artId WHERE artCategory='$category'");  

    }
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
        
        <td><?php echo $row["artTitle"]; ?></td>
        <td> <img src="img/<?php echo $row["artImage"]; ?>" width = 200> </td>
      </tr>
      <?php endforeach; ?>
    </table>
    <br>
    <a href="index.php">back</a>
  </body>
</html>
