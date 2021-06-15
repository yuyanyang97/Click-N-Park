<?php include("connection.php");
if ($_SESSION["loggedin"] != 1)
    header("Location: login.php");

$sess_memid = $_SESSION["sess_memid"];

$result = mysqli_query($conn, "select * from Driver where Driver_ID = $sess_memid");
$row = mysqli_fetch_assoc($result);

if(isset($_POST["plat"]))
{
    $car=$_POST["plat"];
    $result_car=mysqli_query($conn, "SELECT * FROM car where Driver_ID =  $sess_memid");
    $row_car = mysqli_fetch_assoc($result_car);
    $plat_check=mysqli_query($conn,"SELECT * from car where Car_plat_No='$car' AND Driver_ID =  $sess_memid AND car_display = 'able'");
    $plat_quantity=mysqli_num_rows($plat_check);


    if($plat_quantity == 0)
    {
        mysqli_query($conn,"INSERT INTO car (Car_plat_No, Driver_ID) VALUES ('$car',$sess_memid)") or die (mysql_error());
        echo("1");
    }
    else
    {
        echo("2");
    }
}
?>
