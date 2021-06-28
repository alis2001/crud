<?php 
	require_once('config.php');
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
	<form method="post">
		<label>Username:</label>
			<input type="text" name="username"><br>
		<label>Password:</label>
			<input type="password" name="password"><br>
		<input type="submit" name="submit" value="Submit">
	</form>
	<a href="signup.php">Sign Up</a><br>
	<?php
		if (isset($_POST['submit'])) {
			$username = $_POST['username'];
			$password = sha1($_POST['password']);
			if (empty($username) || empty($password)) {
				echo "Please enter the required parameters above!";
			}else{
				$select = "SELECT username, password, id FROM login WHERE username='$username' AND password='$password' ";
				$result = mysqli_query($conn,$select);
				$count = mysqli_num_rows($result);
				if ($count > 0) {
					$_SESSION['login'] = "true";
					$row = mysqli_fetch_assoc($result);
					$_SESSION['username'] = $row['username'];
					$_SESSION['id'] = $row['id'];
					$_SESSION['signup'] = "true";
					header('location:admin.php');
				}else{
					echo "User has not been found!";
				}
			}
		}
		


	?>

</body>
</html>