<?php
session_start();
	require('config.php');
	if(isset($_POST["sign_in"])){
		$fullname=$_POST['firstname'].' '.$_POST['lastname'];
		$pass=md5($_POST['password']);
		$email=$_POST['email'];
		$phone=$_POST['mobile'];
		$i= mysqli_query($con,"insert into users(user_name, email_id, password, mobile, active)values('".$fullname."', '".$email."', '".$pass."', '".$phone."', 1)");	
		if($i>0){
			$_SESSION["email"]=$email;
			alert("Sign in successfully");
			header("location:index.php");
		}
		else		
		{
    		alert("Sorry!! something is wrong please try again");
			echo mysqli_error($con);
			header("location:index.php");
		}
	}
	
	
	if(isset($_POST["login"])){
		$pass=md5(mysqli_real_escape_string($con,$_POST['inputPassword']));
		$email=mysqli_real_escape_string($con,$_POST['inputEmail']);
		$i= mysqli_query($con,"select * from users where UCASE(email_id)=UCASE('".$email."') and UCASE(password) LIKE UCASE('".$pass."')");	
		$count = mysqli_num_rows($i);
		if($count == 1){
			$_SESSION["email"]=$email;
			header("location:index.php");
		}
		else		
		{
    		alert("Sorry!! something is wrong please try again". mysqli_error($con));
			echo '<meta http-equiv="refresh" content="0;url=index.php">';
		}
	}
?>