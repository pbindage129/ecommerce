<?php 
	$con=mysqli_connect("localhost", "root", "", "ecommerce");
	if (mysqli_connect_errno()) {
		die("Connection failed: " . mysqli_connect_error());
	}
	function alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}
?>