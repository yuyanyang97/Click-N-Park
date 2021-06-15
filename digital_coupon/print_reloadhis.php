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

        <h1>Reload History</h1>
        <form name="reloadhis">
			<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="reload_table">
                    <thead>
                    <tr>
                        <th class="col-md-5 col-xs-5">Date</th>
                        <th class="col-md-5 col-xs-4">Time</th>
                        <th class="col-md-5 col-xs-4">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if(isset($_GET['print'])){

                    $ID=$_GET['print'];
                    foreach ($ID as $key)
                    { 
                    $result_reload =mysqli_query($conn, "SELECT * FROM topup where Driver_ID=$sess_memid");
                    $show_reload = mysqli_fetch_assoc($result_reload)
                    ?>
                    <tr>
                        <td><?php $reload_date = new DateTime($show_reload["Topup_Date"]);
                        echo $reload_date->format('d-m-Y'); ?></td>
                        <td><?php echo $show_reload["Topup_TIme"] ?></td>
                        <td><?php echo $show_reload["Topup_Amount"] ?></td>
                    </tr>
                    <?php } 
                    } 
                    else{
                    ?>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                    <script src="js/bootstrap.min.js"></script>
                              <!-- bootbox code -->
                    <script src="js/bootbox.min.js"></script>
                    <script type="text/javascript">
                            bootbox.alert({ 
                              size: "small",
                              message: "Plese select reload history",
                              callback: function(){
                                location.href="reload_history.php";
                              }
                            })
                    </script>
              <?php  } ?>
                      </tbody>
            </table>
            <input type="button" name="printbtn" class="btn btn-primary" value="Print" id="printbtn"/>
            </form>
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
    <script src="jsPDF/dist/jspdf.min.js"></script>
    <script src="jsPDF/dist/jspdf.plugin.autotable.js"></script>
    <script type="text/javascript">
        var doc = new jsPDF();
        var specialElementHandlers = {
            '#editor': function (element, renderer) {
                return true;
            }
        };

        $('#printbtn').click(function () {
        function demoPDF() {
          var pdfsize = 'a0';
          var pdf = new jsPDF('l', 'pt', pdfsize);

          var res = pdf.autoTableHtmlToJson(document.getElementById("reload_table"));
          pdf.autoTable(res.columns, res.data, {
            startY: 60,
            styles: {
              overflow: 'linebreak',
              fontSize: 50,
              rowHeight: 60,

            },
            columnStyles: {
              1: {columnWidth: 'auto'}
            }
          });

          pdf.save("<?php echo date("Y-m-d H:i"); ?> topup record.pdf");
        };

        demoPDF();
    });
    </script>
</body>

</html>
