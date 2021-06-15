<?php

include("connection.php");

    if (isset($_POST["loginbtn"]))
    {
      $offno = $_POST["offnum"];
      $offpword = $_POST["offpassword"];

      $result =mysqli_query($conn, "SELECT * from officer where Officer_No= '$offno' and Officer_Password='$offpword'");
      $row = mysqli_fetch_assoc($result);

      if (mysqli_num_rows($result) != 1)
      {
      ?>
        <script type = "text/javascript">
          alert("Wrong officer No. or Password");
        </script>
      <?php
      }
      else
      {
        $_SESSION["sess_offid"] = $row["Officer_ID"];
        $_SESSION["offlogin"] = 1;
        header("Location: mobile_officer_interface.php");
      }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Officer Login</title>

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
                <a class="navbar-brand" href="mobile_index.php">Click N' Park</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
					<li>
                        <a href="mobile_login.php">Member Login</a>
                    </li>
					<li class="active">
                        <a href="mobile_officer_login.php">Officer Login</a>
                    </li>
                </ul>
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
                <h1 class="page-header">Officer Login</h1>
                <ol class="breadcrumb">
                    <li><a href="mobile_index.php">Home</a>
                    </li>
                    <li class="active">Officer Login</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row" style="margin-bottom: 170px;">
            <div class="col-md-8">
                <form name="offlogin" id="offfrm" method="post">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Officer No:</label>
                            <input type="text" class="form-control" id="officer_id" name="offnum" maxlength="10" /">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Password:</label>
                            <input type="password" class="form-control" id="password" name="offpassword" maxlength="15" />
                        </div>
                    </div>
					<br />
                    <!-- For success/fail messages -->
					<input type="submit" name="loginbtn" value="login" class="btn btn-primary" />
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
    <script src="js/jquery.validate.js"></script>
    <script>
    $(document).ready(function(){
  //alert('a');
  $("#offfrm").validate({
    errorClass: "my-error-class",
    validClass: "my-valid-class",
    rules:{
      offnum:{
        required:true
      },
      offpassword:{
        required : true

      }
    },
    messages:{
      offnum: {
        required: "Please Enter your ID number"
      },
      offpassword: {
        required: "Please Enter your password"
      }
    }
  });
});
</script>
</body>

</html>
