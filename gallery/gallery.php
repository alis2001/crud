<!DOCTYPE html>
<html>
<head>
<title></title>
<style>
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
</style>
</head>
<body>
	<?php
		
	    $files = glob("uploads/*.*");
	    for ($i=0; $i<count($files); $i++) {
	     
	        $image = $files[$i];
	        $supportedFile = array(
	                'gif',
	                'jpg',
	                'jpeg',
	                'png'
	         );

	        $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
	        if (in_array($ext, $supportedFile)) {
	          // echo basename($image)."<br />";
	?>
			<a href="#"><div class="gall"><p><?php echo basename($image)."<br />"; ?></p><img src="<?= $image ?>"><br></div></a>
	<?php		

	        }else{
	            continue;
	        }
	    }
       
	

	?>
	



</body>
</html>