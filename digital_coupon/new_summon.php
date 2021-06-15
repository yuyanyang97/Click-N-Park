<?php
include("connection.php");

if ($_SESSION["offlogin"] != 1)
    header("Location: mobile_officer_login.php");

$sess_offid = $_SESSION["sess_offid"];

	if($_POST['car'] && $_POST['location'] && $_POST['reason'])
	{	
		$car=$_POST['car'];
		?>
		<script type="text/javascript">
		      function FetchData(){
		        $.post("sms.php",
		        {
		          car : '<?php echo $car; ?>'
		        })
		        .then(
		    	function success() {
			        location.href= "officer_takephoto.php";
		    }
		    );
		    }
		</script>
		<?php
		$location=$_POST['location'];
		$petak=$_POST['petak'];
		$reason=$_POST['reason'];
		$check=mysqli_query($conn,"SELECT * FROM car WHERE Car_plat_No='$car'");
		$qty=mysqli_num_rows($check);
		date_default_timezone_set("Asia/Kuala_Lumpur");
		$time= date("H:i:s");   
		$date = date("Y-m-d");

		if($qty==1)
		{
			mysqli_query($conn,"INSERT INTO summon(Summon_Date, Summon_Time, Officer_ID, summon_car, summon_location, summon_petak, reason_id) VALUES('$date','$time',$sess_offid, '$car', $location, '$petak', '$reason')");
			?>
			 <script type="text/javascript">
		        FetchData();
		    </script>
			<?php
			echo "The summon has been issue.";
		}
		else
		{
			echo "The car is not in the record.";
		}
	}
?>