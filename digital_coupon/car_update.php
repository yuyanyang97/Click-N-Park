<?php include("connection.php");

$sess_memid = $_SESSION["sess_memid"];

if(isset($_POST['id'] , $_POST['car_plat'])) {
$car_id = $_POST['id'];
$plat = $_POST['car_plat'];

$plat_check=mysqli_query($conn,"SELECT * from car where Driver_ID =  $sess_memid AND car_display = 'able' AND Car_plat_No = '$plat'");
$plat_quantity=mysqli_num_rows($plat_check);

    if($plat_quantity == 0)
    {
        mysqli_query($conn,"UPDATE car SET Car_plat_No = '$plat' WHERE Car_ID = $car_id");
        echo("1");
    }
    else
    {
        echo("2");
    }
}
?>