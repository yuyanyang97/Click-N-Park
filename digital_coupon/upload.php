<?php 
include("connection.php");

if ($_SESSION["offlogin"] != 1)
    header("Location: mobile_officer_login.php");

$sess_offid = $_SESSION["sess_offid"];

$result = mysqli_query($conn, "select * from Driver");
$row = mysqli_fetch_assoc($result);

$target_dir = "imageup/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_FILES["image"]["name"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
$match_query=mysqli_query($conn,"SELECT * FROM summon WHERE summon_image = '$target_file'");
// Check if file already exists
if (mysqli_num_rows($match_query)>0) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
else if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

        /*$carplat = $_POST["car_plat"];
        $location = $_POST["db_location"];
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $time= date("H:i:s");   
        $date = date("Y-m-d");
        mysqli_query($conn,"INSERT INTO summon(Summon_Date,Summon_Time,Officer_ID,Location_ID,summon_car,summon_image) VALUES ('$date','$time','$sess_offid',$location,'$carplat','$target_file')") or die (mysqli_error($conn));*/
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
 ?>