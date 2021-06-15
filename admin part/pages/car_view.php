<?php include("connection.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Driver's Car</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

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
                        <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Officer<span class="fa arrow"></span></a>
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
                    <h1 class="page-header">Driver Car</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <?php $ID=$_REQUEST['car_id']; ?>
                        <p>Car Plat NO. : <?php $car_plat_result=mysqli_fetch_assoc($car_plat= mysqli_query($conn,"SELECT * FROM car WHERE Car_ID = $ID"));
                        echo $car_plat_result["Car_plat_No"] ?>
                        </p>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Duration(min)</th>
                                        <th>Parking location</th>
                                        <th>Amount(RM)</th>
                                        <th>Owner</th>
                                        <th>Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $car_result = mysqli_query($conn,"SELECT * FROM park INNER JOIN car ON park.Car_ID=car.Car_ID WHERE car.Car_ID=$ID");
                                $i=1;
                                while($car_rows = mysqli_fetch_assoc($car_result))
                                    { ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $car_rows["Park_Date"] ?></td>
                                    <td>
                                        <?php echo $car_rows["Park_TimeIN"] ?>
                                    </td>
                                    <td>
                                        <?php echo $car_rows["Park_TimeOut"] ?>
                                    </td>
                                    <td>
                                        <?php echo $car_rows["Park_Duration"] ?>
                                    </td>
                                    <td>
                                        <?php $location_id= $car_rows["Location_ID"];
                                        $location_query=mysqli_query($conn,"SELECT * FROM location where Location_ID=$location_id");
                                        $location_result=mysqli_fetch_assoc($location_query);
                                        echo $location_result["Location_Name"] ?>
                                    </td>
                                    <td>
                                        <?php echo $car_rows["Park_Amount"] ?>
                                    </td>
                                    <td>
                                        <?php $driver_id= $car_rows["Driver_ID"];
                                        $driver_query=mysqli_query($conn,"SELECT * FROM driver where Driver_ID=$driver_id");
                                        $driver_result=mysqli_fetch_assoc($driver_query);
                                        echo $driver_result["Driver_Name"] ?>
                                    </td>
                                    <td>
                                        <?php $rate_id= $car_rows["Rate_ID"];
                                        $rate_query=mysqli_query($conn,"SELECT * FROM rate where Rate_ID=$rate_id");
                                        $rate_result=mysqli_fetch_assoc($rate_query);
                                        echo $rate_result["rate_Cost"] ?>
                                    </td>
                                </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
					
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
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

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
