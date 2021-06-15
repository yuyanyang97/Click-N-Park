<?php
include("connection.php");

if ($_SESSION["login"] != 1)
    header("Location: mobile_login.php");

$memid = $_SESSION["memid"];

$result = mysqli_query($conn, "SELECT * from Driver where Driver_ID = $memid");
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

    <title>Reload</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="credit_assets/css/demo.css">
    <link rel="stylesheet" type="text/css" href="credit_assets/css/bootstrap.css">
    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="credit_assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="Hover-master/css/hover-min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .footer {
          position: absolute;
          right: 0;
          left: 0;
          padding: 1rem;
          background-color: #99ccff;
          text-align: center;
        }

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
        <div class="creditCardForm">
            <div class="payment">
                <form id="creditfrm" method="post">

                  <div class="form-group" id="card-number-field" style="width: 500px;">
                        <label for="cardNumber">Card Number</label>
                        <input type="text" class="form-control" id="cardNumber" name="cardNumber" />
                    </div>

                    <div class="form-group CVV" style="margin-right: 20px">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" />
                    </div>

                    <div class="form-group owner" style="margin-right: 20px">
                        <label for="owner">Owner</label>
                        <input type="text" class="form-control" id="owner" name="owner">
                    </div>

                    <div class="form-group" style="margin-right: 20px">
                        <label for="amount">Topup Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount" />
                        <a  class="button hvr-icon-hang" id="target_down"></a>
                        <a  class="button hvr-icon-bob" id="target_up"></a>                        
                    </div>
                        <label id="amount-error" class="my-error-class" for="amount"></label>


                    <div class="form-group" id="expiration-date">
                        <label>Expiration Date</label>
                        <select name="exp_month">
                            <option value="01">January</option>
                            <option value="02">February </option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <select name="exp_year">
                            <option value="2018"> 2018</option>
                            <option value="2019"> 2019</option>
                            <option value="2020"> 2020</option>
                            <option value="2021"> 2021</option>
                            <option value="2020"> 2022</option>
                            <option value="2021"> 2023</option>
                            <option value="2020"> 2024</option>
                            <option value="2021"> 2025</option>
                        </select>
                    </div>
                    <div class="form-group" id="credit_cards">
                        <img src="credit_assets/images/visa.jpg" id="visa">
                        <img src="credit_assets/images/mastercard.jpg" id="mastercard">
                        <img src="credit_assets/images/amex.jpg" id="amex">
                    </div>
                    <div class="form-group" id="pay-now">
                        <input type="submit" class="btn btn-primary" id="confirm-purchase" value="Confirm" />
                    </div>
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
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="credit_assets/js/jquery.payform.min.js" charset="utf-8"></script>
    <script src="credit_assets/js/script.js" charset="utf-8"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/bootbox.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
        $("#creditfrm").validate({
        errorClass: "my-error-class",
        rules:{
              owner:
              {
                required: true
              },
              cvv:
              {
                required: true
              },
              cardNumber:
              {
                required: true
              },
              exp_month:
              {
                required: true
              },
              exp_year:
              {
                required: true
              },
              amount:
              {
                required: true,
                rangelength: [2, 6]
              }
            },
            messages:{
              owner:
              {
                required: "Please Enter Your Name."
              },
              cvv:
              {
                required: "Please Enter Your CVV."
              },
              cardNumber:
              {
                required: "Please Enter Your Card Number."
              },
              exp_month:
              {
                required: "Please select expirate Month."
              },
              exp_year:
              {
                required: "Please select expirate Month."
              },
              amount:
              {
                required: "Please Enter your topup amount."
              }
          },
        submitHandler: function(form) {
                $.ajax({
                    type: "POST",
                    url: "mobile_pay_credit.php",
                    data: $('#creditfrm').serialize(),
                    success: function(data){
                        bootbox.alert({
                        message: data,
                        size: "small",              
                        callback: function(){
                            location.reload();
                        }
                    });
                    }
                });
            }
            });
        });
    </script>
    <script type="text/javascript">
      $('#target_up').click(function() {
        $('#amount').val(function(i, val) {
           if(val>=10)
          {
            return val*1+1;
          }
          else
          {
            return val=10;
          }
          });
    });
    $('#target_down').click(function() {
        $('#amount').val(function(i, val) { 
          if(val>10)
          {
            return val*1-1;
          }
          else
          {
            return val=10;
          }
        });
    });
    </script>
</body>

</html>