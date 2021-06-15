<?php
	include("connection.php");

	if(!empty($_POST['state_id']))
	{
		$id = $_POST['state_id'];
		$result = mysqli_query($conn,"select * from cities where state_id = '$id'");
		while($row = mysqli_fetch_assoc($result))
		{
			?>
				<option value="<?php echo $row['id']; ?>"><?php echo $row['city_name']; ?></option>
			<?php
		}
	}
?>
