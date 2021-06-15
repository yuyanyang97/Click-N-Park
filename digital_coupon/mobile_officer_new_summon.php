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

    .footer {
      position: absolute;
      right: 0;
      bottom: 0;
      left: 0;
      background-color: #99ccff;
      text-align: center;
    }


    </style>
</head>

<body>
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="photobooth_min.js"></script>

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
                <form name="summonfrm" method="post" id="summonfrm">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Car Plat number:</label>
                            <input type="text" class="form-control" id="car_plat" name="car_plat"  />
                            <p class="help-block"></p>
                        </div>
                    </div>
          <div class="control-group form-group">
              <div class="controls">
                  <label>Location: </label>
                    <select name="db_location" id="db_location" class="local_class form-control">
                <div class="list_1" id="local_id">
                <?php $location1 = mysqli_query($conn, "SELECT * FROM location WHERE Area_ID=1"); ?>
                        <optgroup label="Central Malacca">
                        <?php while($location1_rows = mysqli_fetch_assoc($location1))
                        { ?>
                          <option class="location-1" value="<?php echo $location1_rows["Location_ID"]; ?>"><?php echo $location1_rows["Location_Name"]; ?></option>
                          <?php
                        }
                         ?>
                         </optgroup>
                  </div>

                  <div class="list_2" id="local_id">
                  <?php $location2 = mysqli_query($conn, "SELECT * FROM location WHERE Area_ID=2"); ?>
                  <optgroup label="Alor Gajah">
                        <?php while($location2_rows = mysqli_fetch_assoc($location2))
                        { ?>
                          <option class="location-2" value="<?php echo $location2_rows["Location_ID"]; ?>"><?php echo $location2_rows["Location_Name"]; ?></option>
                          <?php
                        }
                         ?>
                         </optgroup>
                  </div>

                  <div class="list_3" id="local_id">
                  <optgroup label="Jasin">
                  <?php $location3 = mysqli_query($conn, "SELECT * FROM location WHERE Area_ID=3"); ?>
                        <?php while($location3_rows = mysqli_fetch_assoc($location3))
                        { ?>
                          <option class="location-3" value="<?php echo $location3_rows["Location_ID"]; ?>"><?php echo $location3_rows["Location_Name"]; ?></option>
                          <?php
                        }
                         ?>
                         </optgroup>
                  </div>
              </select>
            </div>
          </div>

              <div class="control-group form-group">
                  <div class="controls">
                      <label>No. Petak:</label>
                      <input type="text" class="form-control" id="petak" name="petak"  />
                  </div>
              </div>
              <?php $reason_query=mysqli_query($conn,"SELECT * FROM summon_reason"); ?>
              <div class="form-group">
                  <div class="controls">
                      <label>Reason:</label>
                      <select class="form-control" id="reason" name="reason">
                        <?php while($reason_result=mysqli_fetch_assoc($reason_query)){ ?>
                        <option value="<?php echo $reason_result['reason_id']; ?>"><?php echo $reason_result['reason_opt']; ?></option>
                      <?php } ?>
                      </select>
                  </div>
              </div>
              <br />
                    <input type="submit" name="submitbtn" class="btn btn-primary" id="submitbtn" value="submit" />
                </form>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <div class="footer">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootbox.min.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="EasyAutocomplete/jquery.easy-autocomplete.min.js"></script>

    <script type="text/javascript">
      var options = {

      url: function(phrase) {
        return "search_plat.php";
      },

      getValue: function(element) {
        return element.Car_plat_No;
      },

      ajaxSettings: {
        dataType: "json",
        method: "POST",
        data: {
          dataType: "json"
        }
      },

      preparePostData: function(data) {
        data.phrase = $("#car_plat").val();
        return data;
      },
      list: {
        maxNumberOfElements: 8,
        match: {
            enabled: true
        },
        sort: {
            enabled: true
        }
    },


      requestDelay: 400
    };

    $("#car_plat").easyAutocomplete(options);
    </script>

    <script type="text/javascript">
    $(document).ready(function(){
      //alert('a');
      $("#summonfrm").validate({
        errorClass: "my-error-class",
        rules:{
          car_plat:{
            required:true
          },
          db_location:{
            required: true
          },
          reason:{
            required: true
          }
        },
        messages:{
          car_plat: {
            required: "Please enter car plat."
          },
          db_location:{
            required: "Please select the location."
          },
          reason:{
            required: "Please select reason of isuue summon."
          }
        },
        submitHandler: function(form) {
          $.ajax({
            type: "POST",
            url: "new_summon.php",
            data: {car: $('#car_plat').val(), location: $('#db_location').val(), petak: $('#petak').val(), reason: $('#reason').val()},
            success: function(data){
              if(data=='1')
              {
                location.href= "officer_takephoto.php";
              }
              else{
                bootbox.alert({
                message: data,
                size: 'small',
                callback: function(){
                  location.reload();
                }
            });
              }
            }
          });
          }
    });
});
</script>

</body>

</html>
