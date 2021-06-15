<?php
include("connection.php");

if ($_SESSION["loggedin"] != 1)
    header("Location: login.php");

$sess_memid = $_SESSION["sess_memid"];

$result = mysqli_query($conn, "select * from admin where admin_id = $sess_memid");
$row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript">
        window.onload = function () {
            var chart1 = new CanvasJS.Chart("chartContainer",
            {
                title:{
                    text: "Total Driver Park in Every Location"
                },
                animationEnabled: true,
                data: [
                {
                    type: "column",

                    dataPoints: [
                    <?php $location_row=mysqli_query($conn,"SELECT * FROM location");
                    while($location_result=mysqli_fetch_assoc($location_row))
                    {
                       $local=$location_result['Location_ID'];
                       $local_result=mysqli_query($conn,"SELECT * FROM park WHERE Location_ID=$local");
                       $local_qty=mysqli_num_rows($local_result);
                       if($local_qty>0){ ?>

                    { y: <?php echo $local_qty ?>, label:"<?php echo $location_result['Location_Name'] ?>" },
                    <?php } } ?>
                    ]
                }
                ]
            });

            chart1.render();
        
            //Better to construct options first and then pass it as a parameter
            var chart = new CanvasJS.Chart("chartContainer4",
            {
                title: {
                    text: "Total Summon in Each location"
                },
                animationEnabled: true,
                legend: {
                    verticalAlign: "bottom",
                    horizontalAlign: "center"
                },
                data: [
                {
                    type: "pie",
                    showInLegend: true,
                    toolTipContent: "{y} - <strong>#percent%</strong>",
                    dataPoints: [<?php $sum_location_row=mysqli_query($conn,"SELECT * FROM location");
                    while($sum_location_result=mysqli_fetch_assoc($sum_location_row))
                    {
                       $summon_local=$sum_location_result['Location_ID'];
                       $summon_result=mysqli_query($conn,"SELECT * FROM summon WHERE summon_location=$summon_local");
                       $summon_qty=mysqli_num_rows($summon_result);
                       if($summon_qty>0){ ?>
                        { y: <?php echo $summon_qty ?>, legendText: "<?php echo $sum_location_result['Location_Name'] ?>", indexLabel: "<?php echo $sum_location_result['Location_Name'] ?>" },
                        <?php } } ?>
                    ]
                }
                ]
            });
            chart.render();

        };
    </script>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Click N' Park</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">	
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="profile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i>Home</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="driver_list.php">Driver List</a>
                                </li>
                                <li>
                                    <a href="driver_car.php">Driver Car</a>
                                </li>
                                <li>
                                    <a href="driver_topup.php">Driver Reload</a>
                                </li>
                                <li>
                                    <a href="driver_balance.php">Driver Balance</a>
                                </li>
								<li>
                                    <a href="driver_summon.php">Driver Summon</a>
                                </li>
								<li>
                                    <a href="driver_parking.php">Driver parking</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i>Officer<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="officer_list.php">Officer list</a>
                                </li>
                            </ul>
                        </li>
						<li>
                            <a href="location.php"><i class="fa fa-folder fa-fw"></i> Location</a>
                        </li>
						<li>
                            <a href="area.php"><i class="fa fa-folder fa-fw"></i> Area</a>
                        </li>
						<li>
                            <a href="rate.php"><i class="fa fa-folder fa-fw"></i> Rate</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Home</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Total Parking Record
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row" style="width:100%;">
                                <div class="col-lg-4">
                                    <div id="chartContainer" style="height: 400px; width: 600px;">
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-8">
                                    <div id="morris-bar-chart"></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                        
                    </div>

                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Total Summon Record
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row" style="width:100%;">
                                <div class="col-lg-4">
                                    <div id="chartContainer4" style="height: 400px; width: 600px;">
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-8">
                                    <div id="morris-bar-chart"></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                        
                    </div>

                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="graph/canvasjs.min.js"></script>
    
</body>

</html>
