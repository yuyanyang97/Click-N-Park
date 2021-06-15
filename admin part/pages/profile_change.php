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

    <title>Profile</title>

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
   table tr th
   {
		text-align:center;
   }
      .my-error-class {
        color:red;
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
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Admin Profile</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
				<div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form name="profilefrm" id="profilefrm" method="post">
                            <table width="100%" class="table table-striped" id="dataTables-example">
                                    <tr>
										<th>Information</th>
									</tr>
									<tr>
										<td>
											<div class="form-group">
                                                <label class="control-label col-sm-2" for="email">Email:</label>
                                                <div class="col-sm-5">
                                                  <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo $row['admin_email'] ?>" / >
                                                </div>
                                            </div>
										</td>
									</tr>
									<tr>
										<td>
                                            <div class="form-group">
                                            <label class="control-label col-sm-2" for="name">Full Name:</label>
                                            <div class="col-sm-5">
                                              <input type="text" name="name" class="form-control" id="name" placeholder="Enter Full Name." value="<?php echo $row['admin_name'] ?>" />
                                            </div>
                                          </div>
                                        </td>
									</tr>
                            </table>
                            <div class="form-group">
                                <div class=" col-sm-5">
                                  <input type="submit" name="registerbtn" class="btn btn-primary" value="Register" />
                                </div>
                            </div>
                        </form>
                        </div>
                        <!-- /.panel-body -->
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
    <script src="js/bootbox.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
<script src="js/jquery.validate.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
$(document).ready(function(){
  //alert('a');
  $("#profilefrm").validate({
    errorClass: "my-error-class",
    rules:{
      email:{
        required: true,
        email : true
      },
      name:
      {
        required: true
      }

    },
    messages:{
      email:{
        required: "Please Enter Email.",
        email : "Please Enter valid Email."
      },
      name:
      {
        required: "Please Enter Name."
      }
    },
        submitHandler: function(form) {
        $.ajax({
        type: "POST",
        url: "update_edit.php",
        data: $('#profilefrm').serialize(),
        success: function(data)
        {
          $(document).ready(function()
          {
          bootbox.alert(
          {
            message: data,
            size: 'small',
            callback: function(){
              location.reload();
            }
          });
          });
      }
      });
    }
  });
});
</script>

</body>

</html>