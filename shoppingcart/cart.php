<?php

	require_once('config.php');
	$error = array();
	if (!empty($_GET['id'])) {
		$id = $_GET['id'];
	}
	if (!empty($_GET['action'])) {
		$action = $_GET['action'];
		if ($action == "delete") {
			$delete = "DELETE FROM data WHERE id='$id' ";
			$deleteQuery = mysqli_query($conn,$delete);	
		}elseif ($action == "edit") {
			header('location:cart.php');
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/cart.css">
</head>
<body>	<form method="post">
			<h1>Shopping Cart</h1>
			<table class="table-bordered table-hover">
				<tr>
					<th>Item</th>
					<th>Price<i>$</i></th>
					<th>Description</th>
					<th>Date</th>
				</tr>
				<tr>
					<td><input type="text" name="item"></td>
					<td><input type="text" name="price"></td>
					<td><input type="text" name="description"></td>
					<td><input type="date" name="date"></td>
					<td class="submitTd"><input type="submit" name="submit"></td>
				</tr>
			<?php
				if (isset($_POST['submit'])) {
					$item = $_POST['item'];
					$price = $_POST['price'];
					$description = $_POST['description'];
					$dateof = $_POST['date'];
					if (empty($item) || empty($price) || empty($_POST['date'])) {
						$error[0] = "Please fill out the required fields!";
					}else{
						$insert = "INSERT INTO data(item, price, description, dateof) VALUES('$item', '$price', '$description', '$dateof')";
						if (mysqli_query($conn,$insert)) {
							header('location:cart.php');
						}else{
							$error[1] = "Please try again later!"; 
						}
					}
			?>
					<div class="errors alert alert-danger col-sm-2" style="text-align: center;">
			<?php  		
						foreach ($error as $key => $value) {
								echo "$value"."<br>";	
						} 
			?>				
					</div>		
			<?php
			}

				$query = "SELECT * FROM data ORDER BY id";
				$res = mysqli_query($conn,$query);
				$count = mysqli_num_rows($res);
				if ($count > 0) {
				 	for ($row=0; $row = mysqli_fetch_assoc($res) ; $row++) { 
			?>
						<tr>
							<td><?= substr($row['item'], 0, 15);?></td>
							<td><?= $row['price']?></td>
							<td><?= substr($row['description'], 0, 15);?></td>
							<td><?= $row['dateof']?></td>
							<td><a href="cart.php?action=edit&id=<?= $row['id'] ?>">Edit</a></td>
							<td><a href="cart.php?action=delete&id=<?= $row['id'] ?>">Delete</a></td>
						</tr> 		
			<?php			 	
					}


				}else{
				 	
				}
			?>
						
					

			
			</table>
		</form>	

		
					
					
			


		




</body>
</html>