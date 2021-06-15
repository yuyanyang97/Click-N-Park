<?php
include("connection.php");

header("Content-Type:text/html;charset=utf-8");

if ($_SESSION["offlogin"] != 1)
    header("Location: mobile_officer_login.php");

$sess_offid = $_SESSION["sess_offid"];
date_default_timezone_set("Asia/Kuala_Lumpur");
$time= date("H:i:s");   
$car=mysqli_query($conn,"SELECT * FROM summon WHERE Officer_ID=$sess_offid ORDER BY Summon_ID DESC limit 1");
$car_result=mysqli_fetch_assoc($car);
$car_select=$car_result['summon_car'];
$upload_dir = "imageup/";
if($_POST['imgBase64'])
{
	$img = $_POST['imgBase64'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = $upload_dir."car".$car_select.".png";
	file_put_contents($file, $data);

    mysqli_query($conn,"UPDATE summon SET summon_image='$file' WHERE Officer_ID=$sess_offid ORDER BY Summon_ID DESC limit 1");

	echo "1";
}
else
{
	echo "2";
}
?>