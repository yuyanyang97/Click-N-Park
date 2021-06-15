<!DOCTYPE HTML>
<html>
<body>
<form enctype="multipart/form-data" method="post" name="changer">
<input name="image" accept="image/jpeg" type="file">
<input value="Submit" name="submitbtn" type="submit">
</form>
</body>
</html>
<?php

  include 'connection.php';

  if(isset($_POST["submitbtn"])){

  if ($_FILES["image"]["error"] > 0)
  {
     echo "<font size = '5'><font color=\"#e31919\">Error: NO CHOSEN FILE <br />";
     echo"<p><font size = '5'><font color=\"#e31919\">INSERT TO DATABASE FAILED";
   }
   else
   {
     move_uploaded_file($_FILES["image"]["tmp_name"],"imageup/" . $_FILES["image"]["name"]);
     echo"<font size = '5'><font color=\"#0CF44A\">SAVED<br>";

     $file="imageup/".$_FILES["image"]["name"];
     $sql="INSERT INTO summon (summon_image) VALUES ('$file')";

     if (!mysql_query($sql))
     {
        die('Error: ' . mysql_error());
     }
     echo "<font size = '5'><font color=\"#0CF44A\">SAVED TO DATABASE";

   }
}

?>