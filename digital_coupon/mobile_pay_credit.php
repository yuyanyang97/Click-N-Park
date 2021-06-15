<?php
include("connection.php");

if ($_SESSION["login"] != 1)
    header("Location: mobile_login.php");

$memid = $_SESSION["memid"];

$result = mysqli_query($conn, "SELECT * from Driver where Driver_ID = $memid");
$row = mysqli_fetch_assoc($result);

if($_POST['owner'] != '')
{
	$name=$_POST['owner'];
	$cvv=$_POST['cvv'];
	$card=$_POST['cardNumber'];
	$month=$_POST['exp_month'];
	$year=$_POST['exp_year'];
	$amount=$_POST['amount'];

	$check=mysqli_query($conn,"SELECT * FROM credit_card WHERE credit_name='$name' AND credit_cvv='$cvv'AND credit_month=$month AND credit_year=$year AND credit_no='$card'");
	$quantity=mysqli_num_rows($check);

	if($quantity==1)
	{
		$date = date("Y/m/d");
		date_default_timezone_set("Asia/Kuala_Lumpur");
		$time = date("H:i");

		mysqli_query($conn, "INSERT INTO topup (Topup_Date,Topup_Time,Topup_Amount,Driver_ID) VALUES ('$date','$time',$amount,$sess_memid)");

		mysqli_query($conn, "UPDATE driver SET Driver_Balance= Driver_Balance+$amount where Driver_ID=$sess_memid");

		echo "Top-up Success.";
	}
	else
	{
		echo "Please Enter the correct information.";
	}
}
?>