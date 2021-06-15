<?php include("connection.php");

if(isset($_GET['deletebox'])) {

$name = $_GET['deletebox'];

foreach ($name as $deletebox)
{
	$check_park=mysqli_query($conn,"SELECT * FROM park WHERE Car_ID = $deletebox");
	$quantity_car=mysqli_num_rows($check_park);
	if($quantity_car!=0)
	{
		mysqli_query($conn,"UPDATE car SET car_display = 'disable' where Car_ID = '$deletebox'");
	}
	else
	{
		mysqli_query($conn,"DELETE FROM car WHERE Car_ID=$deletebox");
	}

}
}
?>
