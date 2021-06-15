<?php include("connection.php"); 
	if(isset($_POST["car"]))
	{
		$car = $_POST["car"];
		$check_car = mysqli_query($conn,"SELECT * FROM park where Car_ID = $car AND Park_Status = 'active'");
		$quantity_car = mysqli_num_rows($check_car);

		if($quantity_car != 0)
		{
			echo ("1");
		}
		else
		{
			echo ("2");
		}
	}
?>