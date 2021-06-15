<?php
include("connection.php");
mysqli_query($conn,"SET GLOBAL event_scheduler = ON;")
mysqli_query($conn,"UPDATE park 
    SET estiamount = (
        SELECT Driver_Balance
        FROM driver
        WHERE driver.Driver_ID = park.Driver_ID AND driver.Driver_ID=9
    )");
$balance=mysqli_query($conn,"SELECT estiamount FROM park WHERE Driver_ID=9");
$rate=mysqli_query($conn,"SELECT ")
mysqli_query($conn,"CREATE EVENT joy
    ON SCHEDULE EVERY 60 SECOND
    DO
    IF($balance>0){
      BEGIN
        SELECT $balance - ;
      END
  }");
?>