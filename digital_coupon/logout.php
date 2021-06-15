<?php include("connection.php"); ?>
<!DOCTYPE html>
<html>

<head><title>Logout</title>

<script type="text/javascript">

	setTimeout("window.location='index.php';", 2000);
	
	history.forward();

</script>

</head>

<body>

<p>Thank you for using our system. </p>

<?php

session_destroy();
?>

</body>

</html>
