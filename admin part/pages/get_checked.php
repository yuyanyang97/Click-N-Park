<?php include("connection.php");


if(isset($_GET['deletebox'])) {

$name = $_GET['deletebox'];
foreach ($name as $deletebox){

mysqli_query($conn,"UPDATE driver SET driver_display = 'disable' where Driver_ID = '$deletebox'");
echo "driver has been delete";
}

} // end brace for if(isset

else {
echo ("You did not choose a driver data.");
}
?>