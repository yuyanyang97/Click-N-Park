<?php include("connection.php");

if(isset($_POST['area']))
{
	$area=$_POST['area'];

	$quantity_area=mysqli_query($conn,"SELECT * FROM area WHERE Area_Name = '$area'");
	if(mysqli_num_rows($quantity_area)==0)
	{
		mysqli_query($conn,"INSERT INTO area(Area_Name) VALUES ('$area')");
		echo("1");
	}
	else
	{
		ehco("2");
	}
}