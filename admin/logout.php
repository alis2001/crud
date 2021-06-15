<?php
	require_once('config.php');
	
?>

<?php  
	unset($_SESSION['login']);
	unset($_SESSION['userId']);
	unset($_SESSION['userName']);
	header('location:login.php');
?>
