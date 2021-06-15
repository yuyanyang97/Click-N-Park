<?php include("connection.php");

if(isset($_POST['location'],$_POST['area']))
{
	$location=$_POST['location'];
	$area=$_POST['area'];

	$quantity_location=mysqli_query($conn,"SELECT * FROM location WHERE Location_Name = '$location' AND Area_ID = '$area'");
	if(mysqli_num_rows($quantity_location)==0)
	{
		mysqli_query($conn,"INSERT INTO location(Location_Name, Area_ID) VALUES ('$location', '$area')");
		echo("1");
	}
	else
	{
		ehco("2");
	}
}
?>