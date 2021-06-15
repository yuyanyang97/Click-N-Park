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
if(isset($_POST['submit_email']) && $_POST['email'])
{
  mysql_connect('localhost','root','');
  mysql_select_db('digital_coupon');
  $email =  $_POST['email'];
  $select=mysql_query("SELECT * from driver where Driver_Email='$email'");
  if(mysql_num_rows($select)==1)
  {
    while($row=mysql_fetch_array($select))
    {
      $email=$row['Driver_Email'];
      
      $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
      $password=substr(str_shuffle($chars), 0, 8);
     
    }
    $link="<a href='http://localhost/digital_coupon/reset_pass.php?key=".$email."&reset=".$password."'>Click To Reset password</a>";
    require_once('PHPMailer/PHPMailerAutoload.php');
    $mail = new PHPMailer();
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;                  
    // GMAIL username
    $mail->Username = "wei.shun772112@hotmail.com";
    // GMAIL password
    $mail->Password = "Cws12697017021";
    $mail->SMTPSecure = "tls";  
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp-mail.outlook.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "587";
    $mail->From='wei.shun772112@hotmail.com';
    $mail->FromName='wei shun';
    $mail->AddAddress($email, 'reciever_name');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = 'Click On This Link to Reset Password '.$link.'';
    if($mail->Send())
    {
      ?>
      <script>
        $(document).ready(function(){
            bootbox.alert({ 
              size: "small",
              title: "Success",
              message: "The reset link has send to your email."
             
            })
            });
        
      </script>
      <?php
      }
    
    else
    {
     ?>
      <script>
        $(document).ready(function(){
            bootbox.alert({ 
              size: "small",
              title: "Fail",
              message: "Your email is invalid."
            })
            });
      </script>
    <?php
    }
  }	
}
?>
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