<?php

include("connection.php");


if ($_POST["id"])
{
	$id = $_POST["id"];
	$dname = $_POST["editName"];
	$daddress = $_POST["editAddress"];
	$dstate = $_POST["editState"];
	$dcity = $_POST["editCity"];
	$dpostcode = $_POST["editPostcode"];
	$dmobile = $_POST["editMobile"];
	$dIC = $_POST["editIC"];
	$demail = $_POST["editEmail"];

	mysqli_query($conn, "UPDATE driver SET Driver_Name='$dname', Driver_Address='$daddress', Driver_Postcode='$dpostcode', Driver_Mobile='$dmobile', Driver_IC='$dIC', Driver_Email='$demail' WHERE Driver_ID = '$id'");
	mysqli_query($conn, "UPDATE driver SET Driver_state=$dstate, Driver_city=$dcity WHERE Driver_ID = '$id'");

	echo "Profile has been updated.";
}
?>