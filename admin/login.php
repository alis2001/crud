 <?php
 	require_once('config.php');
 ?>
 <!DOCTYPE html>
 <html>
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 <head>
 	<title></title>
 </head>
 <body style="background-color: #FFFAF0">
	<?php
		$error = "";
 		if (isset($_POST['submit'])) {
 			$username = $_POST['username'];	
 			$password = sha1($_POST['password']);
 			if (empty($username)) {
 				$error = "Please Enter the required parameters";
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
	 				$error = "The Username and Password dont match";
	 			}
	 		}
	 	}
 	?>
 	<div class="container col-sm-4">
		<form class="form-horizontal" action="login.php" method="post" >
			<div class="input-group col-sm-6">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input class="form-control" type="text" name="username" placeholder="Username">
			</div>
			<div class="input-group col-sm-6">
				 <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>	
				<input class="form-control" type="password" name="password" placeholder="Password">
			</div>
				<input type="submit" name="submit" class="btn btn-default" ><br>
			<?php 
				echo "$error";

			 ?>			

		</form>
	</div>

 </body>
 </html>