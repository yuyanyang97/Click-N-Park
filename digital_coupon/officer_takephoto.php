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

    <title>Add New Summon</title>

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
    <!-- CSS file -->
    <link rel="stylesheet" href="EasyAutocomplete/easy-autocomplete.min.css"> 

    <!-- Additional CSS Themes file - not required-->
    <link rel="stylesheet" href="EasyAutocomplete/easy-autocomplete.themes.min.css">
    <style type="text/css">
    .my-error-class {
        color:red;
    }
    #example {
        min-height: 300px;
        min-width: 300px;
        height: 600px;
        width: 600px;
    }

    #gallery {
        min-height: 200px;
        min-width: 200px;
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
                <h1 class="page-header">Add new Summon</h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row">
            <div class="col-md-8">

            					<video id="video" width="320" height="240" autoplay></video>                    
                     <div style="display: none"><canvas id="canvas" width="320" height="240"></canvas></div>
                     <br />
                     <form id="imagefrm">
                     <img src="" id="imgup" name="imgup" />
                    <br />
                    <!-- For success/fail messages -->
					<input type="button" class="btn btn-primary" id="snap" value="Snap" />
          <input type="button" name="submitbtn" id="submitbtn" value="submit" />
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
    <script src="js/bootbox.min.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="EasyAutocomplete/jquery.easy-autocomplete.min.js"></script>

    <script type="text/javascript">
      $('#submitbtn').click(function(){
      var dataURL = $('#imgup').attr('src');
       $.ajax({
        type: "POST",
        url: "saveimage.php",
        dataType: 'json',
        cache: false,
        data: { 
         imgBase64: dataURL
        },
        success: function(data){
          if (data==2) {
            bootbox.alert({
              message: "Please take the car photo.",
              size: 'small'
          });
        }
        else{
          bootbox.alert({
              message: "The photo has been upload.",
              size: 'small',
              callback: function(){
                location.href= "mobile_officer_new_summon.php";
              }
          });
        }
      }
       });
      });
    </script>

    <script type="text/javascript">
 // Grab elements, create settings, etc.
 var video = document.getElementById('video');

 // Get access to the camera!
 if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
     // Not adding `{ audio: true }` since we only want video now
     navigator.mediaDevices.getUserMedia({ video: true }).then(function (stream) {
         video.src = window.URL.createObjectURL(stream);
         video.play();
     });
 }
 else if (navigator.getUserMedia) { // Standard
     navigator.getUserMedia({ video: true }, function (stream) {
         video.src = stream;
         video.play();
     }, errBack);
 } else if (navigator.webkitGetUserMedia) { // WebKit-prefixed
     navigator.webkitGetUserMedia({ video: true }, function (stream) {
         video.src = window.webkitURL.createObjectURL(stream);
         video.play();
     }, errBack);
 } else if (navigator.mozGetUserMedia) { // Mozilla-prefixed
     navigator.mozGetUserMedia({ video: true }, function (stream) {
         video.src = window.URL.createObjectURL(stream);
         video.play();
     }, errBack);
 }
 var canvas = document.getElementById('canvas');
 var context = canvas.getContext('2d');
 var video = document.getElementById('video');


 // Trigger photo take
 document.getElementById("snap").addEventListener("click", function () {
     // context.drawImage(video, 0, 0, 640, 480);
     var origin=context.drawImage(video, 0, 0, 320, 240);
	
   var strDataURI = canvas.toDataURL();
   canvas.src = strDataURI;
	var img_can=$('#imgup').attr('src', canvas.src);
 });
 
    </script>

</body>

</html>
