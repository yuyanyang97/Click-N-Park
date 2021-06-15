<?php
include("connection.php");

if ($_SESSION["loggedin"] != 1)
	header("Location: login.php");

$sess_memid = $_SESSION["sess_memid"];

$result = mysqli_query($conn, "select * from Driver where Driver_ID = $sess_memid");
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
							<br />
							<div class="control-group form-group" id="showNewName" style="margin-left:50px;">
								<div class="controls">
									<label>New Name :</label>
										<input type="text" class="form-control" id="new_name" name="editName" value="<?php echo $row["Driver_Name"]; ?>"/>
								</div>
							</div>
						</td>
					</tr>
		            <tr>
						<td><span style="margin-left:50px;">Address: <?php echo $row["Driver_Address"]; ?></span><br />
							<div class="control-group form-group" id="showNewAdress" style="margin-left:50px;">
								<div class="controls">
									<label>New Address :</label>
										<input type="text" class="form-control" id="new_address" name="editAddress" value="<?php echo $row["Driver_Address"]; ?>"/>
										<p class="help-block"></p>
								</div>
							</div>
						</td>
					</tr>
          <?php
            $state_id = $row['Driver_state'];
            $state_user = mysqli_query($conn,"select * from states where state_id = '$state_id'");
            $state_row = mysqli_fetch_assoc($state_user);
          ?>
		      <tr>
						<td><span style="margin-left:50px;">State: <?php echo $state_row['name']; ?></span><br />
							<div class="control-group form-group" id="showNewState" style="margin-left:50px;">
								<div class="controls">
									<label>New State :</label>
                    <div class="form-group">
                    <div class="col-sm-10">
                    <?php
                        $state_id = $row['Driver_state'];
                        $state_user = mysqli_query($conn,"select * from states where state_id = '$state_id'");
                        $state_row = mysqli_fetch_assoc($state_user);
                      ?>
                    <select name="editState" onchange="getId(this.value);" id="new_state">
                      <option value="<?php echo $state_row['state_id']; ?>"><?php echo $state_row['name']; ?></option>
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
								</div>
						</td>
					</tr>
          <?php
            $city_id = $row['Driver_city'];
            $city_user = mysqli_query($conn,"select * from cities where id = '$city_id' ");
            $city_row = mysqli_fetch_assoc($city_user);
          ?>
		      <tr>
						<td><span style="margin-left:50px;">City: <?php echo $city_row['city_name']; ?></span><br />
							<div class="control-group form-group" id="showNewCity" style="margin-left:50px;">
								<div class="controls">
									<label>New City :</label>

        					<div class="form-group">
                  <div class="col-sm-10">
                  <select name="editCity" id="citylist">

                    <option value="<?php echo $city_row['State_id']; ?>"><?php echo $city_row['city_name']; ?></option>
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

								</div>
							</div>
						</td>
					</tr>

		      <tr>
						<td><span style="margin-left:50px;">Postcode: <?php echo $row["Driver_Postcode"]; ?></span><br />
							<div class="control-group form-group" id="showNewPostcode" style="margin-left:50px;">
								<div class="controls">
									<label>New Postcode :</label>
										<input type="text" class="form-control" id="new_postcode"  name="editPostcode" value="<?php echo $row["Driver_Postcode"]; ?>" maxlength="5"/>
								</div>
							</div>
						</td>
					</tr>

		            <tr>
						<td>
							<span style="margin-left:50px;">Phone Number : <?php echo $row["Driver_Mobile"]; ?></span><br />
							<div class="control-group form-group" id="showNewNumber" style="margin-left:50px;">
								<div class="controls">
									<label>New Phone Number :</label>
										<input type="text" class="form-control" id="new_number"  name="editMobile" value="<?php echo $row["Driver_Mobile"]; ?>" maxlength="12"/>
								</div>
							</div>
						</td>
					</tr>

		      <tr>
						<td>
							<span style="margin-left:50px;">IC number : <?php echo $row["Driver_IC"] ?></span><br />
							<div class="control-group form-group" id="showNewIC" style="margin-left:50px;">
								<div class="controls">
									<label>New IC Number :</label>
										<input type="text" class="form-control" id="new_IC_name"  name="editIC" value="<?php echo $row["Driver_IC"] ?>" maxlength="12"/>
								</div>
							</div>
						</td>
					</tr>

		            <tr>
						<td>
							<span style="margin-left:50px;">Email Address : <?php echo $row["Driver_Email"]; ?></span><br />
							<div class="control-group form-group" id="showNewEmail" style="margin-left:50px;">
								<div class="controls">
									<label>New Email Address :</label>
										<input type="email" class="form-control" id="new_email" name="editEmail" value="<?php echo $row["Driver_Email"]; ?>" />
								</div>
							</div>
						</td>
					</tr>
					</table>
					<br />
                    <!-- For success/fail messages -->
					 <input type="submit" name="savebtn" class="btn btn-primary" value="Save" id="savebtn"/>
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
    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
<script src="js/jquery.validate.js"></script>

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
<script>
$(document).ready(function(){
  //alert('a');
  $("#profilefrm").validate({
    errorClass: "my-error-class",
    validClass: "my-valid-class",
    rules:{
      editName:{
        required:true,
        minlength: 3
      },
      editEmail:{
        required: true,
        email : true
      },
      editMobile:{
        required: true,
        number: true,
        minlength: 10
      },
      editAddress:{
        required: true
      },
      editAge:{
        required: true,
        number: true
      },
      editPostcode:
      {
        required: true,
        minlength: 5,
        maxlength: 5,
        number: true
      },
      editIC:
      {
        required: true,
        minlength: 12,
        maxlength: 12,
        number: true
      },
      editState:{
        required: true
      },
      editCity:
      {
        required: true
      }

    },
    messages:{
      editName: {
        required: "Please Enter your name"
      },
      editEmail: {
        required: "Please Enter your email"
      },
      editMobile: { 
        required: "Please Enter your phone"
      },
      editAge: {
        required: "Please Enter your age"
      },
      editPostcode : {
        required: "Please Enter your postcode"
    },
      editIC:
      {
        required: "Please enter your IC."
      },
      editAddress:
      {
      	required: "Please Enter your address."
      },
      editState:
      {
      	required: "Please choose your state."
      },
      editCity:
      {
        required: "Please choose your city."
      }
    },
        submitHandler: function(form) {
        $.ajax({
        type: "POST",
        url: "update_edit.php",
        data: {id: <?php echo $sess_memid ?>, editName: $('#new_name').val(), editAddress: $('#new_address').val(), editState: $('#new_state').val(), editCity: $('#citylist').val(), editPostcode: $('#new_postcode').val(), editMobile: $('#new_number').val(), editIC: $('#new_IC_name').val(), editEmail: $('#new_email').val()},
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