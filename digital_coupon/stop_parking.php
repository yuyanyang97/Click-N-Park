<?php
include("connection.php");

if ($_SESSION["login"] != 1)
    header("Location: mobile_login.php");

$memid = $_SESSION["memid"];

$result = mysqli_query($conn, "select * from Driver where Driver_ID = $memid");
$row = mysqli_fetch_assoc($result);

 ?>

<?php 
    $park_result=mysqli_query($conn,"SELECT * from park WHERE Driver_ID=$memid ORDER BY Park_ID DESC limit 1");
    $park_rows=mysqli_fetch_assoc($park_result);
?>
<?php
$driver_car = mysqli_query($conn,"SELECT * from car where Driver_ID = $memid");

    $start_time=mysqli_query($conn,"SELECT * FROM park WHERE Driver_ID=$memid ORDER BY Park_ID DESC limit 1");
    $start_time_row=mysqli_fetch_assoc($start_time);
    $start_time_result=$start_time_row["Park_TimeIN"];
    date_default_timezone_set('UTC');
    $int_start=strtotime($start_time_result);

if ($_POST['action'] == 'call_this') 
  {
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $stop_time=date('H:i:s');
    date_default_timezone_set('UTC');
    $int_stop = strtotime($stop_time);

    date_default_timezone_set('UTC');
    $int_duration = $int_stop - $int_start;

    date_default_timezone_set('UTC');
    $duration=date('H:i:s', $int_duration);


  $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $duration);

  sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

  $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

  $rate=mysqli_query($conn,"SELECT * FROM rate where rate_status='active'");
  $result_rate=mysqli_fetch_assoc($rate);

  //if(mysqli_num_rows($rate_query)==1){
    $seconds_result = intval($time_seconds/(($result_rate["rate_duration"])*60)); 
  //}
  
  $cost=$seconds_result*($result_rate["rate_Cost"]);
  $balance=$row["Driver_Balance"]-$cost;

  mysqli_query($conn,"UPDATE park SET Park_TimeOut = '$stop_time', Park_Duration = '$duration', Park_Amount = '$cost', Park_Status = 'Inactive' WHERE Driver_ID=$memid ORDER BY Park_ID DESC limit 1");
    mysqli_query($conn,"UPDATE driver SET Driver_Balance = $balance WHERE Driver_ID=$memid");
    //echo($seconds_result);
  }
?>