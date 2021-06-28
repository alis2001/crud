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
	<h1>Sign Up form</h1>
	<form method="post">
		<label>Username:</label>
			<input type="text" name="username"><br>
		<label>Password:</label>
			<input type="password" name="password"><br>
		<label>Date of Birth:</label>
			<input type="date" name="dateOfBirth"><br>
		<label>Gender:</label><br>
			<input type="radio" id="male" name="gender" value="male">
 		<label for="male">Male</label><br>
 			<input type="radio" id="female" name="gender" value="female">
		<label for="female">Female</label><br>
			<input type="radio" id="other" name="gender" value="other">
 		<label for="other">Other</label><br>
		<input type="submit" name="submit" value="Submit">
	</form>
	<a href="login.php">Login</a><br>
	<a href="logout.php">Log Out</a>

	<?php
		if (isset($_POST['submit'])) {
			$username = $_POST['username'];
			$password = sha1($_POST['password']);
			$dateOfBirth = $_POST['dateOfBirth'];
			$gender = $_POST['gender'];
			if (!empty($username) && !empty($password) && !empty($dateOfBirth) && !empty($gender)) {
				$insert = "INSERT INTO login(username, password, dateofbirth, gender) VALUES('$username', '$password', '$dateOfBirth', '$gender')";
				if (mysqli_query($conn,$insert)) {
					$_SESSION['signup'] = "true";
					$choose = "SELECT username, id FROM login WHERE username='$username' ";
					$query = mysqli_query($conn,$choose);
					$row = mysqli_fetch_assoc($query);
					$_SESSION['username'] = $row['username'];
					$_SESSION['id'] = $row['id'];
					$_SESSION['login'] = "true";
					header('location:admin.php');
				}else{
					die("connection failed" . mysqli_connect_error());
				}
			}else{
				echo "Please enter the required parameters above!";
			}
		}
		



	?>

</body>
</html>