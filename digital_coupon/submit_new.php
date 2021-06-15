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

    <title>Reset</title>

<?php
if(isset($_POST['submit_password']) && $_POST['email'] && $_POST['password'])
{
  mysql_connect('localhost','root','');
  mysql_select_db('digital_coupon');
  $email=$_POST['email'];
  $password=md5($_POST['password']);

  $select=mysql_query("update driver set Driver_Password='$password' where Driver_Email='$email'");
}
?>

      <script>
        $(document).ready(function(){
            bootbox.alert({ 
              size: "small",
              title: "Success",
              message: "The password already reset."
             
            })
            });
        
      </script>

       <style type="text/css">
      .my-error-class {
        color:red;
    }
    .my-valid-class {
        color:green;
    }
    </style>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
</html>