<?php session_start();
if (empty($_SESSION['login'])) {
	header('location:login.php');
}
if (!empty($_GET['action'])) {
	$action = $_GET['action'];
}
if (!empty($_GET['id'])) {
	$id = $_GET['id'];
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		
		td {padding: 10px};
		tr {padding: 20px};


	</style>
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

		function test_input($a){

			trim($a);
			htmlspecialchars($a);
			return $a;


		}

	 ?>

	<a href="logout.php">Logout</a><br>
	<?php echo "<a href=\"javascript:history.go(-1)\">Back</a>"; ?><br><br><br>
	<a href="pages.php?action=add">Add</a><br>
	
<?php

if (empty($action)) {

	$selectPage = "SELECT * FROM pages ORDER BY id";
	$resultPage = mysqli_query($conn,$selectPage);
	$row = mysqli_num_rows($resultPage);
	if ($row > 0) { ?>
		
		<table>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Body</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php
				for ($x=0; $x = mysqli_fetch_assoc($resultPage) ; $x++) { 
			?>
				<tr>
					<td><?= $x['id']?></td>
					<td><?= $x['title'] ?></td>
					<td><?= $x['body'] ?></td>
					<td><a href="pages.php?action=edit&id=<?= $x['id']?>">Edit</a></td>
					<td><a href="pages.php?action=delete&id=<?= $x['id']?>">Delete</a></td>
				</tr>

			<?php 
				} 
	}	
			 ?>
			
		</table>

			<?php  
					}elseif ($action == "add") {
			?>
			
						<h1>Form</h1>
						<form method="post">
							<input type="title" name="title"><br>
							<textarea name="body"></textarea><br>
							<input type="submit" name="submit">
						</form>
			<?php
					if (isset($_POST['submit'])) {
						$title = test_input($_POST['title']);
						$body = test_input($_POST['body']);
							if (empty($title || $body)) {
								echo "Please Insert the fields above";
							}else{
									$insert = "INSERT INTO pages(title, body) VALUES('$title', '$body')";

								if (mysqli_query($conn,$insert)) {
					
										header("location:pages.php");

								}else{	
										echo "Sorry";
									}

							}
					}

					}elseif ($action == "edit") {
			?>			
			<?php
						$selectEdit = "SELECT * FROM pages WHERE id='$id' ";
						$result = mysqli_query($conn,$selectEdit);
						$x = mysqli_fetch_assoc($result);
			?>
							<h1>Form</h1>
							<form method="post">
								<input type="title" name="titleUpdate" value="<?= $x['title'] ?>"><br>
								<textarea name="bodyUpdate"><?= $x['body'] ?></textarea><br>
								<input type="submit" name="submit">
							</form>
			<?php
						
					if (isset($_POST['submit'])) {
						if (empty($x['title'] || $x['body'])) {
							echo "Please fill out the form";
						}else{
							$titleUpdate = $_POST['titleUpdate'];
							$bodyUpdate = $_POST['bodyUpdate'];
							$update = "UPDATE pages SET title='$titleUpdate', body = '$bodyUpdate' WHERE id='$id' ";
							mysqli_query($conn,$update);
							header("location:pages.php");
						}	
					}

			?>				
			<?php		
					}elseif ($action == "delete") {
						
						$delete = "DELETE FROM pages WHERE id='$id' ";
						mysqli_query($conn,$delete);
						header("location:pages.php");

					}

			?>
	 




	



</body>
</html>