<?php include("connection.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
              <!-- bootbox code -->
    <script src="js/bootbox.min.js"></script>

    <title>Register</title>

    <?php
    if (isset($_POST["registerbtn"]))
    {
    	$dname = $_POST["dname"];
    	$dmail = $_POST["dmail"];
    	$dpword = md5($_POST["dpword"]);
    	$daddress = $_POST["daddress"];
    	$dpostcode = $_POST["postcode"];
    	$dstate = $_POST["dstate"];
    	$dphone = $_POST["dphone"];
    	$dcity = $_POST["dcity"];
    	$dic = $_POST["dic"];

     	$sql = "select * from driver where Driver_Email = '$dmail'";
    	$result = mysqli_query($conn, $sql);


    	if (mysqli_num_rows($result) != 0)
    	{
    	?>

    <script>
        $(document).ready(function(){
            bootbox.alert({ 
              size: "small",
              title: "Register Error",
              message: "The account is existed"
            })
            });
    </script>

    	<?php
    	}
    	else
    	{
    		mysqli_query($conn,"insert into driver (Driver_Name, Driver_Email,Driver_IC,Driver_Address,Driver_Mobile,Driver_Password,Driver_City, Driver_Postcode,Driver_State) values ('$dname','$dmail','$dic','$daddress','+6$dphone','$dpword','$dcity','$dpostcode','$dstate')") or die (mysqli_error());
    		?>

    <script>
        $(document).ready(function(){
            bootbox.alert({ 
              size: "small",
              title: "Register Successful",
              message: "Welcome to be our member !"
            })
            });
    </script>
    	<?php
    	}
    }
    ?>
<?php $result = mysqli_query($conn, "select * from Driver");
$row = mysqli_fetch_assoc($result); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $("select.state").change(function(){
        var selectedState = $(".state option:selected").val();
        $.ajax({
            type: "POST",
            url: "js/process-request.php",
            data: { state : selectedState }
        }).done(function(data){
            $("#response").html(data);
        });
    });
});
</script>
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

	<script src="js/countries.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                <a class="navbar-brand" href="index.html">Click N' Park</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="not_memebr_contact.html">About</a>
                    </li>

                    <li class="active">
                        <a href="register.php">Register</a>
                    </li>
					<li>
                        <a href="login.php">Login</a>
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
                <h1 class="page-header">Member Register</h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Register</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row">
            <div class="col-md-8">
				<form class="form-horizontal" method="post" id="registerfrm">

          <!--Email-->
				  <div class="form-group">
					<label class="control-label col-sm-2" for="email">Email:</label>
					<div class="col-sm-10">
					  <input type="email" name="dmail" class="form-control" id="email" placeholder="Enter email">
            <p id="email_result"></p>
					</div>
				  </div>

          <!--Password-->
				  <div class="form-group">
					<label class="control-label col-sm-2" for="pwd">Password:</label>
					<div class="col-sm-10">
					  <input type="password" name="dpword" class="form-control" id="password" placeholder="Enter password" maxlength="15" />
					</div>
				  </div>
				   <div class="form-group">
					<label class="control-label col-sm-2" for="conpwd">Confirm Password:</label>
					<div class="col-sm-10">
					  <input type="password" class="form-control" id="confirm_password" name="con_dpword" placeholder="Enter password" maxlength="15" />
					  <span id='message'></span>
					</div>
				  </div>

				  <script>
          /*
					$('#password, #confirm_password').on('keyup', function ()
          {
					       if ($('#password').val() == $('#confirm_password').val())
                 {
						             $('#message').html('Matching').css('color', 'green');
					       }
                 else
					            $('#message').html('Not Matching').css('color', 'red');
					}
          );

          var password = document.getElementById("password"),confirm_password = document.getElementById("confirm_password");

          function validatePassword(){
          if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
          } else {
            confirm_password.setCustomValidity('');
          }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;*/
					</script>

          <!--Full Name-->
				  <div class="form-group">
					<label class="control-label col-sm-2" for="name">Full Name:</label>
					<div class="col-sm-10">
					  <input type="text" name="dname" class="form-control" id="name" placeholder="Enter Full Name." />
            <p id="name_result"></p>
					</div>
				  </div>

          <!--IC-->
				  <div class="form-group">
					<label class="control-label col-sm-2" for="ic">IC:</label>
					<div class="col-sm-10">
						<input type="text" name="dic" id="ic" placeholder="Enter IC" maxlength="12" width="50px" /> <span style="color: blue;">For Example: 000000112222</span><br />
						<label id="ic-error" class="my-error-class" for="ic"></label>
					</div>

				  </div>


          <!--Phone Number-->
          <div class="form-group">
					<label class="control-label col-sm-2" for="phone">Phone number:</label>
					<div class="col-sm-10">
          <br />
					  <input type="text" name="dphone" id="phone" placeholder="Enter Phone Number" width="50px" maxlength="12"/> <span style="color: blue">For Example: 0112345678</span>
					  <br />
            		<label id="phone-error" class="my-error-class" for="phone"></label>
					</div>
				  </div>

          <!--Address-->
          <div class="form-group">
          <label class="control-label col-sm-2" for="address">Address:</label>
          <div class="col-sm-10">
            <textarea name="daddress" class="form-control" id="address" placeholder="Enter address."></textarea>
            <p id="address_result"></p>
          </div>
          </div>

          <div class="form-group">
          <label class="control-label col-sm-2">State:</label>
          <div class="col-sm-10">
            <?php
              $state_id = $row['Driver_state'];
              $state_user = mysqli_query($conn,"select * from states where state_id = '$state_id'");
              $state_row = mysqli_fetch_assoc($state_user);
            ?>
          <select name="dstate" onchange="getId(this.value);">
            <option>Please Select State</option>
            <?php
              $state_ls = mysqli_query($conn,"select * from states");
              while($state_op = mysqli_fetch_assoc($state_ls))
              {
                ?>
                  <option value="<?php echo $state_op['state_id']; ?>"><?php echo $state_op['name']; ?></option>
                <?php
              }
            ?>
          </select>
          </div>
          </div>
          <br />
          <?php
            $city_id = $row['Driver_city'];
            $city_user = mysqli_query($conn,"select * from cities where id = '$city_id' ");
            $city_row = mysqli_fetch_assoc($city_user);
          ?>
          <div class="form-group">
          <label class="control-label col-sm-2">City:</label>
          <div class="col-sm-10">
            <select name="dcity" id="citylist">

            <option>Please Select City</option>
            <?php
              $city_ls = mysqli_query($conn,"select * from cities where state_id = '$state_id' order by city_name");
              while($city_op = mysqli_fetch_assoc($city_ls))
              {
                ?>
                  <option value="<?php echo $city_op['state_id']; ?>"><?php echo $city_op['city_name']; ?></option>
                <?php
              }
            ?>
            </select>
          </div>
          </div>

					<div class="form-group">
					<label class="control-label col-sm-2" for="postcode">Postcode</label>
					<div class="col-sm-5">
					  <input type="text" name="postcode" id="postcode" placeholder="Enter Postcode" maxlength="5" />
					</div>
				  </div>

				  <div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					  <input type="submit" name="registerbtn" class="btn btn-primary" value="Register" />
					</div>
				  </div>
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

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="lib/jquery.js"></script>
  <script src="js/jquery.validate.js"></script>
<script>
$(document).ready(function(){
  //alert('a');
  $("#registerfrm").validate({
    errorClass: "my-error-class",
    validClass: "my-valid-class",
    rules:{
      dname:{
        required:true,
        minlength: 3
      },
      dpword:{
        required : true,
        minlength: 6
      },
      dmail:{
        required: true,
        email : true
      },
      dphone:{
        required: true,
        number: true,
        minlength: 10
      },
      daddress:{
        required: true
      },
      postcode:
      {
        required: true,
        minlength: 5,
        maxlength: 5,
        number: true
      },
      dic:
      {
        required: true,
        minlength: 12,
        maxlength: 12,
        number: true
      },
      dstate:{
        required: true
      },
      dcity:{
        required: true
      },
      con_dpword:
      {
        equalTo: "#password"
      }
    },
    messages:{
      dname: {
        required: "Please Enter your name"
      },
      dpword: {
        required: "Please Enter your password"
      },
      dmail: {
        required: "Please Enter your email"
      },
      dphone: { 
        required: "Please Enter your phone"
      },
      postcode : {
        required: "Please Enter your postcode"
    },
    dstate:{
        required: "Please sleect your status."
      },
      dic:{
      	required: "Please sleect your IC number."
      },
      dcity:{
        required: "Please sleect your city."
      },
      con_dpword:
      {
        equalTo: "Please enter the same password with above"
      }
    }
  });
});

</script>

  <script type="text/javascript">
    function getId(val){
    $.ajax({
        type:"POST",
        url:"getdata.php",
        data:"state_id="+val,
        success:function(data){
            $("#citylist").html(data);
        }
    });

    //alert(val);
}
</script>

</body>

</html>
