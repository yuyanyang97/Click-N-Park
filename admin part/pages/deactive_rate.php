<?php
include("connection.php");

if(isset($_POST["id"]))
{
	$rate=$_POST["id"];
	mysqli_query($conn,"UPDATE rate SET rate_status = 'deactive' where rate_ID='$rate'");
	echo("1");
}
?>