<?php
include("connection.php");

if ($_SESSION["login"] != 1)
    header("Location: mobile_login.php");

$memid = $_SESSION["memid"];

$result = mysqli_query($conn, "select * from Driver where Driver_ID = $memid");
$row = mysqli_fetch_assoc($result);

$rate=mysqli_query($conn,"SELECT * FROM rate where rate_status='active'") or die (mysql_error());
$rate_row=mysqli_fetch_assoc($rate);
$rate_result=$rate_row["rate_ID"];

$estimate=$row["Driver_Balance"];
  
  if( isset($_POST['db_location']) != "" && isset($_POST['car_list']) != "")
  {
    if($estimate>=1.20)
  	{
  		date_default_timezone_set("Asia/Kuala_Lumpur");
  	    $start_time= date("H:i:s");
  	    $date = date("Y-m-d");
  	    $location = $_POST["db_location"];
  	    $car= $_POST["car_list"];
  	
  	    mysqli_query($conn,"INSERT INTO park(Park_Date,Driver_ID,Car_ID,Location_ID,Park_TimeIN,Rate_ID,Park_Status,estiamount) VALUES ('$date',$memid,'$car','$location','$start_time',$rate_result,'Active','$estimate')") or die (mysqli_error($conn));
  	    echo "The timer has been start.";
  	}
  	else
  	{
  		echo "Please Reload.";
  	}
  }

?>
