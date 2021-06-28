<?php 
	require_once('config.php');
	if (empty($_SESSION['signup']) || empty($_SESSION['login'])) {
		header('location:login.php');
	}
	if (!empty($_GET['action'])) {
		$action = $_GET['action'];	
	}
	if (!empty($_GET['name'])) {
		$name = $_GET['name'];
		$tar = "uploads/".$name;
		if (!unlink($tar)) {
		 	echo "Failed to Delete the File";
		 	header('location:admin.php');
		 }else{
		 	echo "Sucsess!";
		 	header('location:admin.php');
		 } 	
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<style type="text/css">
		div.gall{
			margin-top: 20px;
			width: 400px;
			height: 400px;
			float: left;
		}
		img{
			width: 50%;
			height: 50%;
		}
		h1{
			color: grey;
		}
		
	</style>
</head>
<body>
	<h1>
		<?php
			echo "Welcome" . " " . ($_SESSION['id'] . " <u>" . $_SESSION['username'] . "<u/>");
		?>
	</h1>
	<h1>Admin Page</h1>
	<form method="post" enctype="multipart/form-data" class="form-vertical">
		<label>Choose your image to upload:</label>
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" name="submit" value="Submit">
	</form>
	<a href="logout.php">Log Out</a><br>
	<?php
		if (isset($_POST['submit'])) {
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$uploadOk = 1;
			$check = getimagesize($_FILES['fileToUpload']['tmp_name']);
			if ($check !== false) {
				echo "File is an image - " . $check['mime'] . ".";
				$uploadOk = 1;
			}elseif (empty($check)) {
				echo "Please Choose a Photo first!";
				$uploadOk = 0;
			}else{
				echo "File is not an image!";
				$uploadOk = 0;
			}
			if (file_exists($target_file)) {
				echo "Sorry this file alreade exists!";
				$uploadOk = 0;
			}
			if ($_FILES["fileToUpload"]["size"] > 5000000) {
  				echo "Sorry, your file is too large.";
 				$uploadOk = 0;
			}
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
			  	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  				$uploadOk = 0;
			}
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
			
			}else{
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				   	echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
				}else{
			   	echo "Sorry, there was an error uploading your file.";
				}
			}
		}
		

		$files = glob('uploads/*.*');
		for ($i=0; $i < count($files) ; $i++) { 
			$image = $files[$i];
			$supportedFile = array(
	                'gif',
	                'jpg',
	                'jpeg',
	                'png'
	        );
	        $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
	        if (in_array($ext, $supportedFile)) {
	         	
	?>
				<a href="#"><div class="gall"><p><?php echo basename($image)."<br />"; ?></p><img src="<?= $image ?>"><br><a href="admin.php?action=delete&name=<?= basename($image) ?>">Delete</a></div></a>

	<?php          
			}else{
			continue;
			}
		}	

	?>

</body>
</html>