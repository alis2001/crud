<?php
	function test_session(){
		if (empty($_SESSION['login'])) {
		header('location:login.php');
		}	
	}
	function select_table(){
		$query = "SELECT * FROM pages WHERE id='$id' ";
		$res = mysqli_query($conn,$query);
		$row = mysqli_fetch_assoc($res);
	}
?>