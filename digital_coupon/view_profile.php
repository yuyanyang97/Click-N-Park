<?php
include("connection.php");

if ($_SESSION["loggedin"] != 1)
	header("Location: login.php");

$sess_memid = $_SESSION["sess_memid"];

$result = mysqli_query($conn, "SELECT * from ((Driver INNER JOIN states ON Driver.Driver_state=states.state_id) INNER JOIN cities ON Driver.Driver_city=cities.id)where Driver_ID = $sess_memid");
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

    <title>Profile</title>

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
				<!- jQuery -->
	<script src="js/jquery.js"></script>
    <script src="js/countries.js"></script>

    <!--[endif]-->
    <style type="text/css">
	  .my-error-class {
	    color:red;
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
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Profile</h1>
                <ol class="breadcrumb">
                    <li><a href="services.php">Service</a>
                    </li>
                    <li class="active">Profile</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <!-- Contact Form -->
        <div class="row">

          <form name="profilefrm" id="profilefrm" method="post">
          <table class="table table-striped">
					<tr>
						<th><span style="margin-left:190px;">Information</span></th>
					</tr>

		            <tr>
						<td>
							<span style="margin-left:50px;">Full Name : <?php echo $row["Driver_Name"]; ?></span>
						</td>
					</tr>

		            <tr>
						<td><span style="margin-left:50px;">Address: <?php echo $row["Driver_Address"]; ?></span><br />
						</td>
					</tr>

		            <tr>
						<td><span style="margin-left:50px;">State: <?php echo $row["name"]; ?></span><br />
						</td>
					</tr>

		            <tr>
						<td><span style="margin-left:50px;">City: <?php echo $row["city_name"]; ?></span><br />
						</td>
					</tr>

		            <tr>
						<td><span style="margin-left:50px;">Postcode: <?php echo $row["Driver_Postcode"]; ?></span><br />
						</td>
					</tr>

		            <tr>
						<td>
							<span style="margin-left:50px;">Phone Number : <?php echo $row["Driver_Mobile"]; ?></span><br />
						</td>
						<td>
						</td>
					</tr>

		            <tr>
						<td>
							<span style="margin-left:50px;">IC number : <?php echo $row["Driver_IC"] ?></span><br />
						</td>
					</tr>

		            <tr>
						<td>
							<span style="margin-left:50px;">Email Address : <?php echo $row["Driver_Email"]; ?></span><br />
						</td>
					</tr>
					</table>
					<br />
                    <!-- For success/fail messages -->
					<a href="profile.php" class="btn btn-primary">Edit Profile</a>
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
  </body>
  
</html>

