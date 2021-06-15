<?php

include("connection.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
              <!-- bootbox code -->
    <script src="js/bootbox.min.js"></script>

    <title>Login</title>


    <?php
    if (isset($_POST["loginbtn"]))
    {
      $dmail = $_POST["email"];
      $dpword = md5($_POST["dpassword"]);

      $sql="select * from driver where Driver_Email= '$dmail' and Driver_Password='$dpword'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);

      if (mysqli_num_rows($result) != 1)
      {
      ?>
    <script>
        $(document).ready(function(){
            bootbox.alert({ 
              size: "small",
              title: "Login Error",
              message: "Please Enter the correct email/password."
            })
            });
    </script>
      <?php
      }
      else
      {
        $_SESSION["memid"] = $row["Driver_ID"];
        $_SESSION["login"] = 1;
        header("Location: mobile_services.php");
      }
    }
    ?>
    <style type="text/css">
      .my-error-class {
        color:red;
    }
    </style>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                    <li class="active">
                        <a href="mobile_login.php">Member Login</a>
                    </li>
                    <li>
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
                <h1 class="page-header">Login</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Login</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="bs-example" style="margin-bottom: 200px;">

    <form class="form-horizontal" method="post" id="loginfrm">
        <div class="form-group">
            <label for="foremail" class="control-label col-xs-2">Email</label>
            <div class="col-xs-10">
                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="forpassword" class="control-label col-xs-2">Password</label>
            <div class="col-xs-10">
                <input type="password" class="form-control" id="inputPassword"
                 name="dpassword" placeholder="password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
                <input type="submit" name="loginbtn" value="login" class="btn btn-primary" />
            </div>
        </div>
    </form>
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
  $("#loginfrm").validate({
    errorClass: "my-error-class",
    rules:{
      email:{
        required:true,
        email:true
      },
      dpassword:{
        required : true,

      }
    },
    messages:{
      email: {
        required: "Please Enter your email"
      },
      dpassword: {
        required: "Please Enter your password"
      }
    }
  });
});
</script>
</body>

</html>
