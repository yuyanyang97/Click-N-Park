<?php
include("connection.php");

if ($_SESSION["loggedin"] != 1)
    header("Location: login.php");

$sess_memid = $_SESSION["sess_memid"];

$result = mysqli_query($conn, "select * from admin where admin_id = $sess_memid");
$row = mysqli_fetch_assoc($result);

if ($_POST["email"] !=' ' && $_POST["name"] != ' ')
{
	$name=$_POST["name"];
	$email=$_POST["email"];

	mysqli_query($conn, "UPDATE admin SET admin_name='$name', admin_email='$email' WHERE admin_id = '$sess_memid'");

	echo "Profile has been updated.";
}
?>