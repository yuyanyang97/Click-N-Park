<?php
	include("connection.php");
	if(isset($_POST['driver_id']))
	{
		$id=$_POST['driver_id'];
		$park_result=mysqli_query($conn,"SELECT * FROM park WHERE Driver_ID=$id ORDER BY Park_ID DESC limit 1");
    	$park_rows=mysqli_fetch_assoc($park_result);
		if($park_rows["Park_Status"]=='Active'){
            if($park_rows["estiamount"] >0)
            {
              mysqli_query($conn, "UPDATE park SET estiamount=estiamount-0.10 WHERE Driver_ID = $id AND Park_Status = 'Active'");
            }
            else
            {
                ?>
                <script type="text/javascript">
                    $(document).ready(function(){
                      $.ajax({
                        type: "POST",
                        url: "stop_parking.php",
                        data: {
                          action : "call_this"
                        }
                      })
                  });
                </script>
                <?php
                echo "Your timer is stop";
            }
          }
	}
?>