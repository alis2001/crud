 <?php session_start(); ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>


 	<?php

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "project1";
	
	
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn) {
		die("connection failed" . mysqli_connect_error());
		}




	 		if (isset($_POST['submit'])) {
	 			$username = $_POST['username'];	
	 			$password = sha1($_POST['password']);
	 			if (empty($username || $password)) {
	 				echo "Please Enter the required parameters";
	 			}else{
	 				$select = "SELECT username,password FROM users WHERE username='$username' AND password='$password' ";
	 				$result = mysqli_query($conn,$select);
	 				$count = mysqli_num_rows($result);
	 				$userNameResult = mysqli_fetch_assoc($result);
	 			if ($count > 0) {
	 				$_SESSION['login'] = "true";
	 				$getId = "SELECT id FROM users WHERE username='$username' ";
	 				$resultId = mysqli_query($conn,$getId);
	 				$rowId = mysqli_fetch_assoc($resultId);
	 				$_SESSION['userId'] = $rowId['id'];
	 				$_SESSION['userName'] = $userNameResult['username'];

	 				header('location:dashboard.php');
	 			}else{	

	 				echo "The Username and Password dont match";
	 			}

	 		}
	 	}



 	 ?>

 	<form action="login.php" method="post" >
 		
 		<input type="text" name="username" placeholder="Username">
 		<input type="password" name="password" placeholder="Password">
 		<input type="submit" name="submit" >

 	</form>


 	


 
 </body>
 </html>