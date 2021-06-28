 <?php
 	session_start();
 		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "gallery";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn) {
			die("connection failed" . mysqli_connect_error());
		}

 ?>