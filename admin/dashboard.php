<?php
	session_start(); 
	if (empty($_SESSION['login'])) {
		header('location:login.php');
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
	 	echo "Welcome";
		echo "<br>";
		echo ($_SESSION['userName']);
		print_r ($_SESSION['userId']);
		echo "<br>"; 
	?>
	
	 <a href="logout.php">Log Out</a><br>
	 <a href="pages.php">pages</a><br>
	 <?php echo "<a href=\"javascript:history.go(-1)\">Back</a>"; ?>
</body>
</html>