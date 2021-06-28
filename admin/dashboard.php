<?php
	require_once('config.php');
	test_session(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="background-color: #FFFAF0">
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