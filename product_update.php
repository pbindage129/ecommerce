<?php
session_start();
	require('config.php');

	$target_dir = "img/products_img/";
	
	
	if(isset($_POST["update"])){
		$id = $_POST['prod_id'];
		$productname=str_replace("'","\'", $_POST['prod_name']);
		$price=$_POST['price'];
		$prod_desc=str_replace("'","\'", $_POST['prod_desc']);
		$cat=$_POST['catgry'];
		$ext = pathinfo($_FILES["img_update"]["name"], PATHINFO_EXTENSION);
		$new_name = str_replace(" ","_", $productname);
		$target_file = $target_dir . $new_name . '_'.$cat .'.'.$ext;
		$target_file = str_replace("\'","", $target_file);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["img_update"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		$imgurlupdate=0;
		if ($_FILES["img_update"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		} else {
			move_uploaded_file($_FILES["img_update"]["tmp_name"], $target_file);
			$imgurlupdate = $target_file;
		}
		if(isset($_FILES['img_update']) && !empty($_FILES['img_update']['name'])) {
			$i= mysqli_query($con,"update products set product_name='".$productname."', product_cat=".$cat.", product_price=".$price.", product_img='".$imgurlupdate."', product_desc='".$prod_desc."' where product_id=".$id."");	
		}
		else{
			$i= mysqli_query($con,"update products set product_name='".$productname."', product_cat=".$cat.", product_price=".$price.", product_desc='".$prod_desc."' where product_id=".$id."");	
		}
		if($i>0){
			alert("Updated successfully");
			header("location:admin_page.php");
		}
		else		
		{	echo mysqli_error($con);
    		alert("Sorry!! something is wrong please try again");
		}
	}
	
	
	if(isset($_POST["add_product"])){
		$productname=str_replace("'","\'", $_POST['prod_name']);
		$price=str_replace("'","\'", $_POST['price']);
		$cat=$_POST['cat'];
		$prod_desc=str_replace("'","\'", $_POST['prod_desc']);
		$ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
		$new_name = str_replace(" ","_", $productname);
		$target_file = $target_dir . $new_name . '_'.$cat .'.'.$ext;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
			$imgurl =0;
		} else {
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
			$imgurl = $target_file;
		}
		
		
		$i= mysqli_query($con,"insert into products(product_name, product_cat, product_price, product_img, product_desc)values('".$productname."', '".$cat."', '".$price."', '".$imgurl."', '".$prod_desc."')");	
		if($i>0){
			alert("Added successfully");
			header("location:admin_page.php");
		}
		else		
		{
    		alert("Sorry!! something is wrong please try again". mysqli_error($con));
		}
	}
	
	if(isset($_POST["add_category"])){
		$catname=str_replace("'","\'", $_POST["prod_cat"]);
		echo "insert into prod_cat(cat_name)values('".$catname."')";
		$i= mysqli_query($con,'insert into prod_cat(cat_name)values("'.$catname.'")');	
		if($i>0){
			alert("Added successfully");
			header("location:admin_page.php");
		}
		else		
		{
    		echo "Sorry!! something is wrong please try again". mysqli_error($con);
		}
	}
?>