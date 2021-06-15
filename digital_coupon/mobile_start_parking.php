<?php
include("connection.php");

if ($_SESSION["login"] != 1)
  header("Location: mobile_login.php");

$memid = $_SESSION["memid"];

$result = mysqli_query($conn, "SELECT * from Driver where Driver_ID = $memid");
$row = mysqli_fetch_assoc($result);

 ?>

<?php 
    $park_result=mysqli_query($conn,"SELECT * FROM park WHERE Driver_ID=$memid ORDER BY Park_ID DESC limit 1");
    $park_rows=mysqli_fetch_assoc($park_result);
?>

 <!--car list-->
<?php
$driver_car = mysqli_query($conn,"SELECT * from car where Driver_ID = $memid AND car_display='able'");

    $start_time=mysqli_query($conn,"SELECT * FROM park where Driver_ID = $memid");
    $start_time_row=mysqli_fetch_assoc($start_time);
    $start_time_result=$start_time_row["Park_TimeIN"];
    date_default_timezone_set('UTC');
    $int_start=strtotime($start_time_result);
?>


<!DOCTYPE html>
<html >

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Start Parking</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <script type="text/javascript" >
    function clock() {
      //Save the times in variables

      var today = new Date();

      var hours = today.getHours();
      var minutes = today.getMinutes();
      var seconds = today.getSeconds();

      //Set the AM or PM time

      if (hours >= 12) {
        meridiem = " PM";
      } else {
        meridiem = " AM";
      }

      //convert hours to 12 hour format and put 0 in front
      if (hours > 12) {
        hours = hours - 12;
      } else if (hours === 0) {
        hours = 12;
      }

      //Put 0 in front of single digit minutes and seconds

      if (minutes < 10) {
        minutes = "0" + minutes;
      } else {
        minutes = minutes;
      }

      if (seconds < 10) {
        seconds = "0" + seconds;
      } else {
        seconds = seconds;
      }

      document.getElementById("clock").innerHTML =
        hours + ":" + minutes + ":" + seconds + meridiem;
    }

    setInterval("clock()", 1000);
    </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body style="color: #333">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="mobile_services.php">Click N' Park</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="mobile_services.php">Home</a>
                    </li>
                    <li class="dropdown">
                        <a href="mobile_topup.php" >Your Balance: RM <?php echo $row["Driver_Balance"] ?></a>
                    </li>
                    <li class="dropdown">
                        <a href="mobile_register_car.php">Car</a>
                    </li>
                    <li>
                        <a href="mobile_logout.php">Logout</a>
                    </li>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Page Content -->
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Start Parking</h1>
                <ol class="breadcrumb">
					<li><a href="monile_services.php">Home</a>
                    </li>
                    <li class="active">Start Parking</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row" style="margin-bottom:220px;">
            <div class="col-md-8">
             	<link rel="stylesheet" type="text/css" href="css/car.css"/>
              <link rel="stylesheet" type="text/css" href="css/button.css"/>
             	<form name="startfrm" id="startform" method="post" class="form-horizontal">
              <?php
              /*area query*/
              $area = mysqli_query($conn, "SELECT * FROM area");

              /*get location from area*/
              ?>
				 <center><div id="clock"></div></center>
         <br />
              <div class="form-group">
      				<label>Location:</label> 
              <select name="db_location" class="local_class form-control">
      				  <div class="list_1" id="local_id">
                <?php $location1 = mysqli_query($conn, "SELECT * FROM location WHERE Area_ID=1"); ?>
                        <optgroup label="Central Malacca">
                        <?php while($location1_rows = mysqli_fetch_assoc($location1))
                        { ?>
                          <option class="location-1" value="<?php echo $location1_rows["Location_ID"]; ?>"><?php echo $location1_rows["Location_Name"]; ?></option>
                          <?php
                        }
                         ?>
                         </optgroup>
                  </div>

                  <div class="list_2" id="local_id">
                  <?php $location2 = mysqli_query($conn, "SELECT * FROM location WHERE Area_ID=2"); ?>
                  <optgroup label="Alor Gajah">
                        <?php while($location2_rows = mysqli_fetch_assoc($location2))
                        { ?>
                          <option class="location-2" value="<?php echo $location2_rows["Location_ID"]; ?>"><?php echo $location2_rows["Location_Name"]; ?></option>
                          <?php
                        }
                         ?>
                         </optgroup>
                  </div>

                  <div class="list_3" id="local_id">
                  <optgroup label="Jasin">
                  <?php $location3 = mysqli_query($conn, "SELECT * FROM location WHERE Area_ID=3"); ?>
                        <?php while($location3_rows = mysqli_fetch_assoc($location3))
                        { ?>
                          <option class="location-3" value="<?php echo $location3_rows["Location_ID"]; ?>"><?php echo $location3_rows["Location_Name"]; ?></option>
                          <?php
                        }
                         ?>
                         </optgroup>
                  </div>
              </select>
              </div>

              <br />
              <br />

                  <div class="form-group">
                    <label>Car : </label>
                  <select name="car_list" class="get_car_id form-control">
                  <?php 
                  while($car_row=mysqli_fetch_assoc($driver_car))
                  {
              ?>
                    <option value="<?php echo $car_row["Car_ID"]; ?>"><?php echo $car_row["Car_plat_No"]; ?></option>
              <?php 
                  }
              ?>
              </select>
            </div>
              <br />

              <br />

      					<input type="button" class="btn btn-primary" id="startbtn" name="start" value="Start" />
      					<input type="button" name="stop" id="stopbtn" class="btn btn-primary" value="Stop" />
      			
                </form>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->
    
    <!-- Bootstrap Core JavaScript -->


    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->

</body>
</html>
<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- bootbox code -->
    <script src="js/bootbox.min.js"></script>
        <script>
        $(document).ready(function(){
          $('#startbtn').click(function() { // catch the form's submit event
          var postcar = $('.get_car_id').val();
          var postlocation = $('.local_class').val();
          //var data_send = 'db_location='+postlocation+'&car_list='+postcar;
          bootbox.confirm({
                message: "Are you sure to Start timer?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (result){
                if(result == true){
                $.ajax({ // create an AJAX call...
                  data: 'db_location='+postlocation+'&car_list='+postcar, // get the form data
                  type: 'POST', // GET or POST
                  url: 'start_parking_php.php',
                  success : function(data){
                    bootbox.alert({
                    message: data,
                    size: 'small',
                    callback: function(){
                      location.reload();
                    }
                    });
                  } // the file to call
                  });
            }
                }
            })
          });
          });
          $(document).ready(function(){
            if('<?php echo $park_rows["Park_Status"]; ?>' == 'Active')
            {
                $('#startbtn').ready(function(){
                $('#startbtn').attr("disabled",true);
              })
            }
            else if('<?php echo $park_rows["Park_Status"]; ?>' == 'Inactive')
            {
              $('#stopbtn').ready(function(){
                $('#stopbtn').attr("disabled",true);
                })
            }
          });
        </script>
        
        <script type="text/javascript">
      function FetchData(){
        $.post("timer.php",
        {
          driver_id : <?php echo $memid; ?>
        })
        .then(

          function success(data)
          {   
            if(data=='Your timer is stop')
            {
              bootbox.alert(data, function()
                {
                  window.reload();
              });
            }
          }

          );
        }
        setInterval(FetchData, 60000);
    </script>
    <?php 
    $find_car=mysqli_query($conn,"SELECT * FROM ((car INNER JOIN driver ON car.Driver_ID=driver.Driver_ID) INNER JOIN park ON park.Car_ID=car.Car_ID) WHERE car.Driver_ID=$memid AND park.Park_Status='Active'");
    $findcar_result=mysqli_fetch_assoc($find_car); ?>
    <script type="text/javascript">
      function notification(){
        $.post("notification.php",
        {
          driver_id : <?php echo $memid; ?>, car_id: <?php echo $findcar_result['Car_ID']; ?>
        })
        .then(

          function success(data)
          {   
            if(data=='1')
            {
              bootbox.alert("Your timer still running...", function()
              {
                  window.reload();
              });
            }
          }

          );
      }
        setInterval(notification, 7200000);
    </script>

        <script>
          $(document).ready(function(){
            $('#stopbtn').click(function(){
              $.ajax({
                type: "POST",
                url: "stop_parking.php",
                data: {
                  action : "call_this"
                },
                success: function(result){
                  bootbox.alert({
                    message: "The Timer has been Stoped.",
                    size: 'small',
                    callback: function(){
                      location.reload();
                    }
                    });
                } 
              })
            });
          });
    </script>