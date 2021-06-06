 <?php
 	session_start();
 	require_once('functions.php');
 		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "project1";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn) {
			die("connection failed" . mysqli_connect_error());
		}

 ?>