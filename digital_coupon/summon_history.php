<?php
include("connection.php");

if ($_SESSION["loggedin"] != 1)
	header("Location: login.php");

$sess_memid = $_SESSION["sess_memid"];

$result = mysqli_query($conn, "SELECT * from Driver where Driver_ID = $sess_memid");
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

    <title>Member History</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	label a
	 {
		border: 1px #5495f7 solid;
		border-radius: 5px;
		background-color:#5495f7;
		color: white;
		text-decoration:none;
	 }

	label a:hover
	 {
		color: black;
		text-decoration:none;
		border: 1px #99ccff solid;
		background-color:#99ccff;
	 }

	 .input[type=text] {
    width: 130px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
	}

	/* When the input field gets focus, change its width to 100% */
	input[type=text]:focus {
		width: 200px;
	}

	table tr th,td
	{
		text-align:center;
	}
	 </style>
</head>

<body>

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
                <a class="navbar-brand" href="services.php">Click N' Park</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="services.php">Home</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Your Balance: RM <?php echo $row["Driver_Balance"] ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="topup.php">Reload</a>
                            </li>
                            <li>
                                <a href="member_history.php">Reload History</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $row["Driver_Name"] ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="profile.php">Profile</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Car<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="member_history.php">Parking History</a>
                            </li>
                            <li>
                                <a href="register_car.php">Car Register</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.php">Logout</a>
                    </li>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container" style="margin-bottom:70px;">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Member History</h1>
                <ol class="breadcrumb">
					<li><a href="services.php">Home</a>
                    </li>
                    <li class="active">Member History</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row">
        
        <input type="button" onclick="window.location = 'reload_history.php';" class="btn btn-primary" id="reload" value="Reload History"/>
        <input type="button" onclick="window.location = 'member_history.php';" class="btn btn-primary" id="parking" value="Parking History"/>
        <input type="button" onclick="window.location = 'summon_history.php';" class="btn btn-primary" id="summon" value="Summon History"/>

            <h1>Parking History</h1>
            <div>
            <form name="parkhis" method="get" action="print_parkhis.php">
                    <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="park_table">
                    <thead>
                    <tr>
                        <th class="col-md-2 col-xs-5">Date</th>
                        <th class="col-md-2 col-xs-5">Time</th>
                        <th class="col-md-2 col-xs-4">Plat number</th>
                        <th class="col-md-2 col-xs-5">location</th>

                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $car=mysqli_query($conn,"SELECT * FROM car WHERE Driver_ID=$sess_memid");
                        while($car_result=mysqli_fetch_assoc($car))
                        {
                        $car_select=$car_result['Car_plat_No'];
                        $result_park =mysqli_query($conn, "SELECT * FROM summon INNER JOIN location ON summon.summon_location=location.Location_ID WHERE summon.summon_car='$car_select'");
                        while($show_park = mysqli_fetch_assoc($result_park))
                        { 
                        ?>
                        <tr>
                            <td><?php $date = new DateTime($show_park["Summon_Date"]);
                            echo $date->format('d-m-Y'); ?></td>
                            <td><?php echo $show_park["Summon_Time"] ?></td>
                            <td><?php echo $show_park["summon_car"] ?></td>
                            <td><?php echo $show_park["Location_Name"] ?></td>
                        </tr>
                        <?php }
                        } ?>
                    </tbody>
            </table>
            </form>
            </div>

        </div>
        <!-- /.row -->
        <hr>
    </div>
	<!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootbox.min.js"></script>
    <script src="js/search_table.js"></script>
    <script src="js/dataTable.min.js"></script>
    <script src="js/bootstrap.min.2.js"></script>
    <!-- bootbox code -->
    
    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="js/jquery.validate.js"></script>
<script>
$(document).ready(function() {
    $('#park_table').DataTable();
} );
</script>
    <script src="jsPDF/dist/jspdf.min.js"></script>
    <script src="jsPDF/dist/jspdf.plugin.autotable.js"></script>
</body>

</html>
