<?php include("connection.php");

if(isset($_POST['edit_row']))
{
 $row=$_POST['row_id'];
 $name=$_POST['Driver_Name'];
 $age=$_POST['Driver_Age'];
 $address=$_POST['Driver_Address'];
 $state=$_POST['Driver_State'];
 $city=$_POST['Driver_City'];
 $postcode=$_POST['Driver_Postcode'];
 $ic=$_POST['Driver_IC'];
 $email=$_POST['Driver_Email'];
 $mobile=$_POST['Driver_Mobile'];

 mysqli_query($conn,"UPDATE driver set Driver_Name='$name',Driver_Age=$age, Driver_Address='$address', Driver_State='$state', Driver_City='$city', Driver_Postcode='$postcode', Driver_IC='$ic', Driver_Email='$email', Driver_Mobile='$mobile' where Driver_ID=$row");
 echo "success";
  exit();
}
?>