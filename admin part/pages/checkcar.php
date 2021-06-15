<?php
include("connection.php");

$plat=$_POST['plat'];
$plat_query=mysqli_query($conn,"SELECT * FROM car INNER JOIN driver ON car.Driver_ID=driver.Driver_ID WHERE Car_plat_No='$plat'");
$plat_result=mysqli_fetch_assoc($plat_query);
$owner=$plat_result['Driver_Name'];

echo "The Owner is ".$owner;
 ?>
