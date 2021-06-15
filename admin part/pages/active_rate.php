<?php
include("connection.php");

if(isset($_POST["id"]))
{
	$rate=$_POST["id"];

	$check_park=mysqli_query($conn,"SELECT * FROM park where Park_Status='active'");
	$quantity_park=mysqli_num_rows($check_park);

	if($quantity_park==0)
	{
	//check all rate active or not
	$chk_all_active=mysqli_query($conn,"SELECT * FROM rate where rate_status='active'");
	$quantity_active=mysqli_num_rows($chk_all_active);

	$status=mysqli_query($conn,"SELECT rate_status FROM rate where rate_ID = $rate");

	if($status='deactive')
	{
		if($quantity_active>0){
			mysqli_query($conn,"UPDATE rate SET rate_status = 'deactive' where rate_status = 'active'");
		}
		mysqli_query($conn,"UPDATE rate SET rate_status = 'active' where rate_ID=$rate");
		
		echo("1");// 1 means the rate in active
	}
	}
	else
	{
		echo("2");//2 means got car still using this rate
	}
}
?>