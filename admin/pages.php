<?php 
	$errors = array();
	require_once('config.php');
	test_session();
	if (!empty($_GET['action'])) {
		$action = $_GET['action'];
	}
	if (!empty($_GET['id'])) {
		$id = $_GET['id'];
	}
	if (isset($_POST['submit'])) {
		if ($_POST['formAction'] == "add") {
			$title = test_input($_POST['title']);
			$body = test_input($_POST['body']);
			if (empty($title || $body)) {
					$errors[0] = "Please Insert the fields above";
			}else{
				$insert = "INSERT INTO pages(title, body) VALUES('$title', '$body')";
				if (mysqli_query($conn,$insert)) {
					header("location:pages.php");
				}else{	
					$errors[1] = "Sorry";
				}
			}	
		}elseif ($_POST['formAction'] == "edit"){
			$query = "SELECT * FROM pages WHERE id='$id' ";
			$res = mysqli_query($conn,$query);
			$row = mysqli_fetch_assoc($res);
			if (empty($row['title'] || $row['body'])) {
				$errors[2] = "Please fill out the form";
			}else{
				$title = $_POST['title'];
				$body = $_POST['body'];
				$query = "UPDATE pages SET title='$title', body = '$body' WHERE id='$id' ";
				mysqli_query($conn,$query);
				header("location:pages.php");
			}	
			
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/new.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
		td {padding: 10px};
		tr {padding: 20px};
	</style>
</head>
<body style="background-color: #666699;">
	<?php 
		function test_input($a){
			trim($a);
			htmlspecialchars($a);
			return $a;
		}
	?>

	<a href="logout.php">Logout</a><br>
	<a href="javascript:history.go(-1)\">Back</a><br><br><br>
	<a href="pages.php?action=add">Add</a><br>
	
	<?php
		if (empty($action)) {
	?>
			<table>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Body</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
	<?php
				$query = "SELECT * FROM pages ORDER BY id";
				$res = mysqli_query($conn,$query);
				$count = mysqli_num_rows($res);
				if ($count > 0) { 
					for ($row=0; $row = mysqli_fetch_assoc($res) ; $row++) { 
	?>
						<tr>
							<td><?= $row['id']?></td>
							<td><?= $row['title'] ?></td>
							<td><?= $row['body'] ?></td>
							<td><a href="pages.php?action=edit&id=<?= $row['id']?>">Edit</a></td>
							<td><a href="pages.php?action=delete&id=<?= $row['id']?>">Delete</a></td>
						</tr>
	<?php 
					} 
				}	
	?>
			</table>
	<?php  
		}elseif ($action == "add") {
	?>
		<div class="container">	
			<form method="post" class="form-horizontal">
				<h1>Add Page</h1>
				<div class="input-group col-sm-6">
					<input type="title" name="title"><br>
				</div>
				<div class="input-group col-sm-6">
					<textarea name="body"></textarea><br>
				</div>
				<input type="hidden" name="formAction" value="add">
				<input type="submit" name="submit" class="btn btn-default"><br>
				<div class="ifContainer">
					<?php
						if (isset($errors[0])) {
						 	print_r($errors[0]);
						} 
		 			?>
	 			</div>
			</form>
		</div>	
	
			
	<?php

		}elseif ($action == "edit") {
				$query = "SELECT * FROM pages WHERE id='$id' ";
				$res = mysqli_query($conn,$query);
				$row = mysqli_fetch_assoc($res);
			
	?>	
		<div class="container">
			<form method="post" class="form-horizontal">
				<h1>Edit Page</h1>
				<div class="input-group col-sm-6">
					<input type="title" name="title" value="<?= $row['title'] ?>"><br>
				</div>
				<div class="input-group col-sm-6">
					<textarea name="body"><?= $row['body'] ?></textarea><br>
				</div>
				<input type="hidden" name="formAction" value="edit">
				<input type="submit" name="submit" class="btn btn-default">
			</form><br>
		</div>	
	<?php
			if (isset($errors[2])) {
				print_r($errors[2]);
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