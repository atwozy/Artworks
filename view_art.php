<?php
error_reporting(E_ERROR | E_PARSE);
@include 'condb.php';
session_start();
$user_id = $_SESSION['user_id'];
$artist = $_SESSION['artistid'];
$fetchart = $_SESSION['fetchartid'];
$artid = $_POST['artid'];

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE id ='". $_GET['archiveid']."' ");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Artwork</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/view_products_style.css">

</head>
<body>
   
<?php
echo $artid;
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<nav class="row">
   <div class="col-sm-1">
         <a href="homepage.php"><i class='fas fa-arrow-left' style='font-size:20px'></i>Back</a>
      </div>
      <div class="col-sm-1">
      <?php
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);
      ?>
         <a href="cart.php" class="cart">Cart <span>(<?php echo $row_count; ?>)</span> </a>
      </div>
</nav>



<section class="products">


   <div class="box-container">

      <?php
      
      //$select_products = mysqli_query($conn, "SELECT * FROM `sining_artworks` WHERE artid ='". $_GET['archiveid']."'");
      $select_products = mysqli_query($conn, "SELECT * FROM sining_artists INNER JOIN sining_artworks 
      ON sining_artists.artistId = sining_artworks.artistId WHERE sining_artworks.artId = '$artid'");  
      
      
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="container prodview">
            <div class="row">
               <div class="col-md-7">
               <img src="artworks/<?php echo $fetch_product['artImage']; ?>" alt="" >
               </div>
               <div class="col-md-5">
            <h3><?php echo $fetch_product['artTitle']; ?>

            <?php 
            $ID=$fetch_product['artId'];
            $artistid=$fetch_product['artistId'];
            $follow=$fetch_product['artistFollow'];

            if($ID!=$user_id){

               if ($ID==$artistid && $follow<=0)
                  {
                     echo "<a href='#'>FOLLOW</a>"; 
                  }
            }

            else {
               echo "User's profile";  
            }
            ?></h3>
            <?php echo $fetch_product['artistEmail']; ?>
            <h2><?php echo $fetch_product['artTitle']; 
            $_SESSION["artistid"] = $fetch_product['artistId'];
            $_SESSION["artid"] = $fetch_product['artId'];

            ?></h2>
            <hr>
            <div class="price">PH₱<?php echo $fetch_product['artPrice']; ?></div>
            <div class="genre"><?php echo $fetch_product['artCategory']; ?></div>

            <input type="hidden" name="product_name" value="<?php echo $fetch_product['artTitle']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['artPrice']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['artImage']; ?>">
            <input type="submit" class="btn" value="Add to cart" name="add_to_cart">
         </div></div></div>
            <br><br>
            <h4 style="text-align: center;"> Other works by <?php echo $fetch_product['artistName']; ?></h4>

            <!-- Other Artworks -->
<table cellspacing = 0 cellpadding = 10>




<?php
      $category= $_POST["category"];
      $archive= $_GET['artId'];
      $fetch=$fetch_product['artistId'];
      $i = 1;

      //$rows = mysqli_query($conn, "SELECT * FROM sining_artists INNER JOIN sining_artworks ON sining_artists.id = sining_artworks.artistid WHERE sining_artworks.artistid='". $_GET['artistid']."' ORDER BY sining_artworks.title ASC");  
      //$rows = mysqli_query($conn, "SELECT * FROM sining_artists INNER JOIN sining_artworks ON sining_artists.id = sining_artworks.artistid WHERE sining_artworks.artistid='".$_SESSION["artistid"]."' ORDER BY sining_artworks.title ASC");  
      //$rows = mysqli_query($conn, "SELECT * FROM sining_artists INNER JOIN sining_artworks ON sining_artworks.artid=$archive  WHERE sining_artists.id='sining_artworks.artistid' ORDER BY sining_artworks.title ASC");  
      $rows = mysqli_query($conn, "SELECT * FROM sining_artists INNER JOIN sining_artworks 
      ON sining_artists.artistId = sining_artworks.artistid WHERE sining_artworks.artistid ='$fetch' 
      AND sining_artworks.artId <> '$artid' ");  
?>
      
      

      
      
      <tr >
       
        <td style="font-size:3vw"><?php echo $category= $fetch_product["artCategory"];?> </td>
      </tr>
      
      <?php foreach ($rows as $row) : ?>
      <div class="row others">
      <!--Images -->
      <div class="col-md-2">
      <?php 
      
      $archive= $_GET['archiveid'];
         $match=$row["artId"];
         
               ?>
      </div>
      <!--Data -->

        <td>
        <?php 
        $archive= $_GET['archiveid'];
        ?> </td>
      </div>
      <td> <img src="img/<?php echo $row["artImage"];?>" width = 200> </td>
      <td>
       <h3><?php echo $row["artTitle"]; ?></h3>
        <p> <?php echo $row["artistLocation"]; ?>
        <?php 
        $price=$row["artPrice"];
        $formattedNum = number_format($price, 2);
        echo $formattedNum;
        ?></p></td>
      
      

      
      <?php endforeach; ?>
    </table>
    <br>
         </div>
      </form>

      <?php

         };
      };
      ?>


   </div>

</section>

</div>






<!-- custom js file link  -->
<script src="js/script.js"></script>



</body>
</html>