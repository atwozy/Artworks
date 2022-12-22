<html>  
<body>  
   <form action="homepage.php" method="post" enctype="multipart/form-data">  
   <div style="width:200px;border-radius:6px;margin:0px auto">  
<table border="1">  
   <tr>  
      <td colspan="2">Select Category:</td>  
   </tr>  
   <tr>  
      <td>Anime</td>  
      <td><input type="checkbox" name="cate[]" value="Anime"></td>  
   </tr>  
   <tr>  
      <td>Cartoon</td>  
      <td><input type="checkbox" name="cate[]" value="Cartoon"></td>  
   </tr>  
   <tr>  
      <td>Portrait</td>  
      <td><input type="checkbox" name="cate[]" value="Portrait"></td>  
   </tr>  
   <tr>  
      <td>Painting</td>  
      <td><input type="checkbox" name="cate[]" value="Painting"></td>  
   </tr>  
   <tr>  
      <td colspan="2" align="center"><input type="submit" value="submit" name="sub"></td>  
   </tr>  
</table>  
</div>  
</form>  
<?php  
if(isset($_POST['sub']))  
{  
include 'condb.php';
$checkbox1=$_POST['cate'];  
$chk="";  
foreach($checkbox1 as $chk1)  
   {  
      $chk .= $chk1.",";  
   } 

         $insert = mysqli_query($conn, "UPDATE `sining_artists` SET artistTarget = '$chk' WHERE artistId = '$aid'") or die('query failed');
}
?>  
</body>  
</html>  