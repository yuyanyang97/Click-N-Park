<?php include("connection.php");

if(isset($_POST['cost'],$_POST['duration']))
{
	$cost=$_POST['cost'];
	$duration=$_POST['duration'];
	date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date("Y-m-d");

	$quantity_cost=mysqli_query($conn,"SELECT * FROM rate WHERE rate_Cost = '$cost' AND rate_duration = '$duration'");
	if(mysqli_num_rows($quantity_cost)==0)
	{
		mysqli_query($conn,"INSERT INTO rate(rate_Cost, rate_date, rate_duration) VALUES ('$cost', '$date', '$duration')");
		echo("1");
	}
	else
	{
		ehco("2");
	}
}
?>