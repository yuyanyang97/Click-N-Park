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

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Driver Summon</title>

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
    <style>
        table tr th,td
        {
            text-align:center;
        }
    </style>

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
                        <li>
                            <a href="reason.php"><i class="fa fa-folder fa-fw"></i> Summon Reason</a>
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
                    <h1 class="page-header">Driver Summon</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
										<th>Date</th>
										<th>Time</th>
                                        <th>Officer Name</th>
										<th>Car Plat</th>
                                        <th>Photo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $off_result = mysqli_query($conn,"SELECT * from summon");
                                $i=1;
                                while($off_rows = mysqli_fetch_assoc($off_result))
                                    { ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i++ ?></td>
                                    <td><?php $show_summdate = new DateTime($off_rows["Summon_Date"]); echo $show_summdate->format('d-m-Y'); ?></td>
                                    <td><?php echo $off_rows["Summon_Time"] ?></td>
                                    <td><?php $officer_id= $off_rows["Officer_ID"];
                                        $off_query=mysqli_query($conn,"SELECT * FROM officer where Officer_ID=$officer_id");
                                        $officer_result=mysqli_fetch_assoc($off_query);
                                        echo $officer_result["Officer_Name"] ?></td>
                                    <td><a href="#" class="showowner"><?php echo $off_rows["summon_car"] ?></a></td>
                                    <td><a class="btn btn-default" href="../../digital_coupon/<?php echo $off_rows["summon_image"] ?>" download="<?php echo $off_rows["summon_car"] ?>">download</a></td>
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
    <script src="js/bootbox.min.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.showowner').click(function(){
        $.ajax({
            type: "POST",
            url: "checkcar.php",
            data: {plat: $(this).text()},
            success: function(data){
                bootbox.alert({
                message: data,
                size: 'small',
                callback: function(){
                location.reload();
        }
        });
            }
        });
    });
});
</script>
</body>

</html>
