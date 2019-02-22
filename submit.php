<?php
	require('config.php');
	if(isset($_POST["checkout_btn"])){
		$u_id=$_POST['userid'];
		$street1=$_POST['street1'];
		$street2=$_POST['street2'];
		$area=$_POST['area'];
		$zip=$_POST['zip'];
		//$state=$_POST['state'];
		//$city=$_POST['city'];
		$state = 'Maharashtra';
		$city='kolhapur';
		$day = date('d')+1;
		$order_num = $day.date('_n_').$u_id;
		$user_det_res= mysqli_query($con,"select * from user_details where user_id='".$u_id."'");
		$user_det=mysqli_fetch_assoc($user_det_res);
		if(empty($user_det)){
			$i= mysqli_query($con,"insert into user_details(user_id, street1, street2, area, zipcode, city, state, profile_img)values(".$u_id.",'".$street1."','".$street2."','".$area."',".$zip.",'".$city."','".$state."', 'img/user_profiles/user_main.png')");
		}
		$total_price=0.00;
		$payemt = "Cradit card";
		$basket_res= mysqli_query($con,"select * from basket where user_id=".$u_id."");
		$dates = date('d-m-Y');
		while($basket = mysqli_fetch_assoc($basket_res)) {
			$prod_id=$basket["product_id"];
			$price_res= mysqli_query($con,"select * from products where product_id=".$prod_id."");
			$price = mysqli_fetch_assoc($price_res);
			$user_id=$basket["user_id"];
			$quant = $basket["quantity"];
			$subtotal_price = number_format($price["product_price"]*$quant, 2);
			$j= mysqli_query($con,"insert into orders(order_num, product_id, user_id, quantity, subtotal_price, total_price, payment, date, status)values('".$order_num."',".$prod_id.",'".$user_id."','".$quant."','".$subtotal_price."',".$total_price.",'".$payemt."','".$dates."','placed')");
			$total_price = number_format($total_price + $subtotal_price, 2);
		}
		$j= mysqli_query($con,"update orders set total_price=".$total_price." where order_num='".$order_num."'");
		if($j>0){
			$k= mysqli_query($con,"delete from basket where user_id=".$u_id."");	
		?>
			<h2>Your Order is Placed. Please go to <a href="index.php"> Home </a>page and Shopping new Books <h2>
		<?php
		}
		else		
		{
    		//header("location:index.html");
		}
	}
?>