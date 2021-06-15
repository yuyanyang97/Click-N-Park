<?php
include("connection.php");

if ($_SESSION["login"] != 1)
    header("Location: mobile_login.php");

$memid = $_SESSION["memid"];

$result = mysqli_query($conn, "SELECT * from Driver where Driver_ID = $memid");
$row = mysqli_fetch_assoc($result);

$result_car=mysqli_query($conn, "SELECT * FROM car where Driver_ID =  $memid");
$row_car = mysqli_fetch_assoc($result_car);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Car Register</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <style type="text/css">
    .my-error-class {
        color:red;
    }
    table tr th,td
    {
        text-align:center;
    }
    </style>
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
                <a class="navbar-brand" href="mobile_services.php">Click N' Park</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="mobile_services.php">Home</a>
                    </li>
                    <li class="dropdown">
                        <a href="mobile_topup.php" >Your Balance: RM <?php echo $row["Driver_Balance"] ?></a>
                    </li>
                    <li class="dropdown">
                        <a href="mobile_register_car.php">Car</a>
                    </li>
                    <li>
                        <a href="mobile_logout.php">Logout</a>
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
                <h1 class="page-header">Register Car</h1>
                <ol class="breadcrumb">
                    <li><a href="services.php">Home</a>
                    </li>
                    <li class="active">Register Car</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row" style="margin-bottom:235px;">
            <div class="col-md-8">
                <form name="carfrm" id="carform" method="post">
                        <div class="container">
                            <table class="table table-striped" id="car_table">
                            <thead>
                                <tr>
                                  <th>Delete?</th>
                                  <th>No</th>
                                  <th>Car Plat</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $result_car=mysqli_query($conn, "SELECT * FROM car where Driver_ID =  $memid AND car_display = 'able'");
                                    $i = 1;
                                    while($show_car = mysqli_fetch_assoc($result_car) )
                                    {
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="deletebox[]" id="deletebox" value="<?php echo $show_car["Car_ID"] ?>"/></td>
                                        <td><?php echo $i++ ?></td>
                                        <td><?php echo $show_car["Car_plat_No"]; ?></td>
                                    </tr>
                                    <?php

                                    }  // closing of while loop
                                    ?>
                                    </tbody>
                            </table>
                            <br />
                            </div>
                            
                            <input type="button" class="btn btn-primary" id="add" value="Add Car"/>
                            <input type="button" class="btn btn-primary" id="delete" value="Delete Car"/>
                            <input type="button" class="btn btn-primary" id="edit" value="Edit Car"/>

                            <div class="control-group form-group controls" id="showAdd" style="display:none;">
                            <br />
                            <label>Add new car :</label>
                            <input type="text" class="form-control" name="newcar" id="newcar"/>
                            <br />
                            <input type="submit" name="savebtn" class="btn btn-primary" value="Save" id="addbtn"/>

                            </div>
                    <!-- For success/fail messages  -->
                </form>
                <form name="editfrm" id="editform">
                    <br />
                    <!--Edit-->
                    <div class="control-group form-group" id="showedit" style="display:none;">
                        <label>Please choose the car :</label>
                        <select name="editlist" id="choose_edit">
                        <option value=""></option>
                        <?php
                        $car_query=mysqli_query($conn, "SELECT * FROM car where Driver_ID =  $memid AND car_display = 'able'");
                        while($car_rows = mysqli_fetch_assoc($car_query))
                        {
                        ?>
                            <option value="<?php echo $car_rows["Car_ID"] ?>"><?php echo $car_rows["Car_plat_No"]; ?></option>
                        <?php 
                        } 
                        ?>
                        </select>
                        <br />
                        Edit your car plate :
                        <input type="text" class="form-control" name="editcar" id="new_car"/>
                        <br />
                        <input type="submit" name="edit_save" class="btn btn-primary" value="Save" id="saveedit"/>

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

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootbox.min.js"></script>
    <script src="js/search_table.js"></script>
    <script src="js/dataTable.min.js"></script>
    <script src="js/bootstrap.min.2.js"></script>
    <!-- bootbox code -->
    
    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="js/jquery.validate.js"></script>

    <script type="text/javascript">
    $(document).ready(function()
    {
        $("#carform").validate({
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        rules:{
              newcar:
              {
                required: true
              }
            },
            messages:{
              newcar: {
                required: "Please Enter your car plat"
              }
            },
        submitHandler: function(form) {
            $.ajax({
                type:"POST",
                data: {plat:$('#newcar').val()},
                url: "add_car.php",
                success: function(respone)
                {
                    if(respone=='1')
                    {
                        $(document).ready(function(){
                            bootbox.alert({
                                message: "The plat is added",
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
                                message: "The plat is existed",
                                size: 'small',
                                callback: function(){
                                    location.reload();
                                }
                            });
                        });
                    }
                }
            });
        }
    })
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    $("#editform").validate({
    errorClass: "my-error-class",
    validClass: "my-valid-class",
    rules:{
          editcar:
          {
            required: true
          },
          editlist:
          {
            required: true
          }
        },
        messages:{
          editcar: {
            required: "Please Enter your car plat"
          },
          editlist:
          {
            required: "Please Select your car plat"
          }
        },
        submitHandler: function(form) {
        $.ajax({
            type:"POST",
            url: "car_update.php",
            data: {id: $('#choose_edit').val(), car_plat: $('#new_car').val()},
            success: function(respone)
            {
                if(respone=="1")
                {
                    $(document).ready(function(){
                        bootbox.alert({
                            message: "The plat is changed",
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
                            message: "The plat is duplicated",
                            size: 'small'
                        });
                    });
                }
            }
        })
    }
        });
    });
</script>
    <script>
    $(document).ready(function(){
        $("#delete").click(function()
        {
            if($('input[name="deletebox[]"]').is(':checked')) //$('#deletebox:checked')
            {
                bootbox.confirm({
                message: "Are you sure to delete car?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (result){
                if(result == true){
                $.ajax({
                url:"carDelete.php", //the page containing php script
                data: $('#deletebox:checked').serialize(),
                type: "GET", //request type
                success: function(){
                    bootbox.alert({
                    message: "The Car deleted",
                    size: 'small',
                    callback: function(){
                        location.reload();
                    }
                    });
                }
            });
            }
                }
            })
        }
    else
    {
        $(document).ready(function(){
            bootbox.alert({
                message: "Please select the car",
                size: 'small'
            });
        });
    }
    });
        });
    </script>

    <script>
    $(document).ready(function(){
        $("#edit").click(function(){
            if($('#showAdd').is(':visible'))
            {
                $('#showAdd').hide();
                if($('#showedit').is(':hidden'))
                {
                    $('#showedit').show();
                }
                else
                {
                    $('#showedit').hide();
                }
            }
            else
            {
                if($('#showedit').is(':hidden'))
                {
                    $('#showedit').show();
                }
                else
                {
                    $('#showedit').hide();
                }
            }
        });
    });
</script>

    <script>
    $(document).ready(function(){
        $("#add").click(function(){
            if($('#showedit').is(':visible'))
            {
                $('#showedit').hide();
                if($('#showAdd').is(':hidden'))
                {
                    $('#showAdd').show();
                }
                else
                {
                    $('#showAdd').hide();
                }
            }

            else{ 
                if($('#showAdd').is(':hidden'))
            {
                $('#showAdd').show();
            }
                else
                {
                    $('#showAdd').hide();
                }
            }
        });
    });
</script>

<script type="text/javascript">
$(document).ready(function(){

  $('#choose_edit').on('change',function(){
     $('input[name=editcar]').val($('#choose_edit option:selected').text());
  });
});
</script>

    <script>
$(document).ready(function() {
    $('#car_table').DataTable();
} );
    </script>
</body>
</html>