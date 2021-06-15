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
      $dpword = md5($_POST["password"]);

      $sql="select * from admin where admin_email= '$dmail' and admin_password='$dpword'";
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
        $_SESSION["sess_memid"] = $row["admin_id"];
        $_SESSION["loggedin"] = 1;
        header("Location: index.php");
      }
    }
    ?>
    <style type="text/css">
      .my-error-class {
        color:red;
    }
    </style>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

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

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" id="loginfrm" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="loginbtn" value="login" class="btn btn-lg btn-success btn-block" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
      password:{
        required : true,

      }
    },
    messages:{
      email: {
        required: "Please Enter your email"
      },
      password: {
        required: "Please Enter your password"
      }
    }
  });
});
</script>

</body>

</html>
