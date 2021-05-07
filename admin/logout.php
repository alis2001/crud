<?php
	session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php  
		unset($_SESSION['login']);
		unset($_SESSION['userId']);
		unset($_SESSION['userName']);
		header('location:login.php');
	?>
</body>
</html>