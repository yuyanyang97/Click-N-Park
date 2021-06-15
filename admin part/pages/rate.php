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

    <title>Rate</title>

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
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/modify_record.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
    .my-error-class {
        color:red;
    }
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
                        <li><a href="profile.php"><i class="fa fa-user fa-fw"></i>Driver Profile</a>
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
                            <a href="rate.php"><i class="fa fa-folder fa-fw"></i>Rate</a>
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
                    <h1 class="page-header">Rate</h1>
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
                                        <th>Duration(min)</th>
                                        <th>Rate per minute (RM)</th>
										<th>Start Date</th>
                                        <th>action</th>
                                    </tr>
                            </thead>
                            <tbody>
                            <?php $rate_result = mysqli_query($conn,"SELECT * from rate");
                                $i=1;
                                while($rate_rows = mysqli_fetch_assoc($rate_result))
                                    { ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i++ ?></td>
                                        <td><?php echo $rate_rows["rate_duration"] ?></td>
                                        <td><?php echo $rate_rows["rate_Cost"] ?></td>
                                        <td><?php $show_ratedate = new DateTime($rate_rows["rate_date"]); echo $show_ratedate->format('d-m-Y'); ?></td>
                                        <td>
                                            <button name="activebtn" class="activebtn" value="<?php echo $rate_rows["rate_ID"] ?>">
                                                <?php if($rate_rows["rate_status"]=='active')
                                                {
                                                    echo ('deactive');
                                                }
                                                else
                                                {
                                                    echo('active');
                                                } ?>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                            </tbody>
                            </table>
                            <form id="addnewrate">
							<br />
							<button type="button" id="addrate" class="btn btn-default">Add Rate</button>
							<div id="show_newrate" style="width:250px;display:none;margin-top:5px;">
								<p>Enter a new rate: </p>
								<input type="number" step="0.01" name="newrate" id="newrate" class="form-control" width="200px" />
								<br />
                                <p>Enter the duration of rate (min): </p>
                                <input type="number" step="0.01" name="newduration" id="newduration" class="form-control" width="200px" />
                                <br />
								<button type="submit" class="btn btn-default" id="saverate">Save</button>
							</div>
                            </form>
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
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- bootbox code -->
    <script src="js/bootbox.min.js"></script>
    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="js/jquery.validate.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

    <script type="text/javascript">
            $('#addrate').click(function(){
                if($("#show_newrate").is(":visible"))
                {
                    $('#show_newrate').hide();
                }
                else
                {
                    $('#show_newrate').show();   
                }
            });
    </script>

    <script type="text/javascript">
    $(document).ready(function(){
        $("#addnewrate").validate({
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        rules:{
              newrate:
              {
                required: true
              },
              newduration:
              {
                required: true
              }
            },
            messages:{
              newrate: {
                required: "Please Enter rate."
              },
              newduration:{
                required: "Please Enter the duration of rate."
              }
            },
        submitHandler: function(form) {
        $.ajax({
            type:"POST",
            data: {cost: $('#newrate').val(), duration: $('#newduration').val()},
            url: "add_rate.php",
            success: function(respone){
                if(respone==1)
                {
                    $(document).ready(function(){
                    bootbox.alert({
                        message: "The rate added",
                        size: 'small',
                        callback: function(){
                        location.reload();
                    }
                    });
                });
                }
                else
                {
                    $(document).ready(function(){
                    bootbox.alert({
                        message: "The rate is existed",
                        size: 'small'
                    });
                });
                }
            }
        });
    }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.activebtn').click(function(){
            $.ajax({
                type:"POST",
                data:{id:$(this).val()},
                url: "active_rate.php",
                success: function(result){
                    if(result==2)
                    {
                        $(document).ready(function(){
                        bootbox.alert({
                            message: "There has some car still parking...",
                            size: 'small',
                            callback: function(){
                            location.reload();
                        }
                        });
                        });
                    }
                    else
                    {
                        $(document).ready(function(){
                        bootbox.alert({
                            message: "The rate is active.",
                            size: 'small',
                            callback: function(){
                            location.reload();
                        }
                        });
                        });
                    }
                }
            });
        });
    });
</script>

</body>

</html>