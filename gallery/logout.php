<?php 
	require_once('config.php');
	unset($_SESSION['signup']);
	unset($_SESSION['login']);
	unset($_SESSION['id']);
	unset($_SESSION['username']);
	header('location:login.php');


 ?>