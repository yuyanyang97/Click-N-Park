<?php
include("connection.php");

if ($_SESSION["offlogin"] != 1)
    header("Location: mobile_officer_login.php");

$sess_offid = $_SESSION["sess_offid"];

$result = mysqli_query($conn, "select * from Driver");
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

    <title>Car Status</title>

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
                <a class="navbar-brand" href="mobile_officer_interface.php">Click N' Park</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="mobile_officer_interface.php">Home</a>
                    </li>
					<li>
                        <a href="mobile_officer_new_summon.php">Add New Summon</a>
                    </li>
					<li>
                        <a href="mobile_officer_summon_history.php">Summon History</a>
                    </li>
					<li>
                        <a href="mobile_officer_car_status.php">Car Status</a>
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
                <h1 class="page-header">Car Status</h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row" style="margin-bottom:326px;">
            <div class="col-md-8">
                    <table id="status_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        <th class="col-md-5 col-xs-5">Date</th>
                        <th class="col-md-4 col-xs-4">Plat number</th>
                        <th class="col-md-4 col-xs-4">Status</th>
                    </tr>
                      </thead>
                    <tbody>
                    <?php 
                    $park_query=mysqli_query($conn,"SELECT * FROM park INNER JOIN car ON park.Car_ID = car.Car_ID WHERE Park_Date =(SELECT CURDATE())");

                    while($park_result=mysqli_fetch_assoc($park_query))
                    { 
                        if($park_result['estiamount'] == 0){
                    ?>
					<tr>
						<td><?php echo $park_result["Park_Date"] ?></td>
						<td><?php echo $park_result["Car_plat_No"] ?></td>
						<td><?php echo "Overtime.";
                        //echo $park_result["Park_Status"] ?></td>
					</tr>
                    <?php } 
                    
                    if($park_result['Park_Status'] == 'Active')
                    {
                        ?>
                        <tr>
                        <td><?php echo $park_result["Park_Date"] ?></td>
                        <td><?php echo $park_result["Car_plat_No"] ?></td>
                        <td><?php echo "1";
                        //echo $park_result["Park_Status"] ?></td>
                    </tr>
                    <?php
                    }
                } ?>
                      </tbody>
			      </table>  
            <form>
            <button type="button" name="summonbtn" class="btn btn-primary" onclick="location.href='mobile_officer_new_summon.php'">Issue a summon</button>
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

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="js/jqBootstrapValidation.js"></script>
        <script src="js/search_table.js"></script>
    <script src="js/dataTable.min.js"></script>
        <script src="js/bootstrap.min.2.js"></script>
    <script>
$(document).ready(function() {
    $('#status_table').DataTable();
} );
    </script>
</body>

</html>
