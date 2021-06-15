<?php

include("connection.php");

$myArray = array();
$car_query=mysqli_query($conn,"SELECT * FROM car");

while($row=mysqli_fetch_assoc($car_query)) {
        $myArray[] = $row;
}
echo json_encode($myArray);

?>