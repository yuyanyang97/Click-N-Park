<?php
include("connection.php");

if ($_SESSION["login"] != 1)
  header("Location: mobile_login.php");

$memid = $_SESSION["memid"];

$result = mysqli_query($conn, "SELECT * from Driver where Driver_ID = $memid");
$row = mysqli_fetch_assoc($result);

if($_POST['driver_id'] != ' ' && $_POST['car_id'] != ' ')
{
	$driver=$_POST['driver_id'];
	$car=$_POST['car_id'];

	$query=mysqli_query($conn,"SELECT * FROM ((car INNER JOIN driver ON car.Driver_ID=driver.Driver_ID) INNER JOIN park ON park.Car_ID=car.Car_ID) WHERE car.Driver_ID=$memid AND park.Park_Status='Active'");
	$quantity=mysqli_num_rows($query);

	if ($quantity>0) {
		echo 1;
	}
}

?>
