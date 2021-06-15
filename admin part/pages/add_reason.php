<?php include("connection.php");

if(isset($_POST['reason']))
{
	$reason=$_POST['reason'];

	$quantity_reason=mysqli_query($conn,"SELECT * FROM summon_reason WHERE reason_opt = '$reason'");
	if(mysqli_num_rows($quantity_reason)==0)
	{
		mysqli_query($conn,"INSERT INTO summon_reason(reason_opt) VALUES ('$reason')");
		echo("The new reason has been add.");
	}
	else
	{
		ehco("The reason is existed.");
	}
}