<?php
include("connection.php");
?>

<!DOCTYPE html>
<HMTL>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
$(function () {
    $("#btnPrint").click(function () {
        var contents = $("#dvContents").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>DIV Contents</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
        //Append the DIV contents.
		        frameDoc.document.write('<link href="../css/bootstrap.min.css" rel="stylesheet">');
				frameDoc.document.write('<link href="../css/theme.css" rel="stylesheet">');
				frameDoc.document.write('<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">');
				frameDoc.document.write('<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">');
				frameDoc.document.write('<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">');

        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });
});


</script>


<?php
		//$Gan = "Gan";
   //$sess_memid =$_SESSION["sess_memid"];
   $result = mysqli_query($conn, "SELECT * FROM (((park INNER JOIN location ON park.Location_ID=location.Location_ID)INNER JOIN driver ON park.Driver_ID=driver.Driver_ID)INNER JOIN car ON park.Car_ID=car.Car_ID)");
  // $result =mysqli_query($conn,"select * from digital_coupon where park= $sess_park and car =$sess_carplate and driver =$sess_driver and location =$sess_location ");
 ?>
 
 
 
<body>
	<div id = "dvContents">
		<div  style="width: 1000px; height: 100px; margin-left: auto; margin-right: auto;">
				<div style="width: 1000px;;">
					<img src="MMU_logo.png">
				</div>
				<div style="width : 1000px;">
					
					<h1 style =" text-align : center;"> Online Car Parking System</h1>
				</div>
			</div>
			<table border="2" style="width: 1000px;  text-align:center; margin-left: auto; margin-right: auto; margin-top: 60px;">

			  <tr >
				<th style="height: 50px;" >Date</th>
				<th>CarPlate</th>
				<th>Name</th>
				<th>Duration</th>
				<th>TimeIn</th>
				<th>TimeOut</th>
				<th>Amount</th>
			  </tr>
				<?php
				 while($row = mysqli_fetch_assoc($result))//retreive each record form the table
				{
				?>
			  <tr>
					<td><?php echo $row["Park_Date"]; ?></td>
					<td><?php echo $row["Car_plat_No"]; ?></td>
					<td><?php echo $row["Driver_Name"]; ?></td>
					<td><?php echo $row["Park_Duration"]; ?></td>  
					<td><?php echo $row["Park_TimeIN"]; ?></td>
					<td><?php echo $row["Park_TimeOut"]; ?></td>
					<td><?php echo $row["Park_Amount"]; ?></td>
			  </tr>
				<?php 
			  }
			  ?>
			  </table>
			  <?php
	while($row)
	{
	 echo $row["Driver_Nam"];

	}
	  mysqli_close($conn);

	?>
	</div>
<input type="button" id="btnPrint" value="Print" />
  </body>
  </html>
  