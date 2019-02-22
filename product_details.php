
<?php
	require('config.php');
	session_start();
	require('header.php');
?>

	<?php
	if(isset($_GET["p_id"])){
		$id = $_GET["p_id"];
		$prod_res= mysqli_query($con,"select * from products where product_id=".$id."");
		$prod = mysqli_fetch_assoc($prod_res);
		$cat_id =$prod["product_cat"];
		
		$cat_r= mysqli_query($con,"select cat_name from prod_cat where id=".$cat_id."");
		$cat = mysqli_fetch_assoc($cat_r);
		$cat_name = $cat["cat_name"];
		$prod_name = $prod["product_name"];
		$prod_desc = $prod["product_desc"];
		$price = $prod["product_price"];
		$imgurl =$prod["product_img"];
	
	?>
	<section class="container content-row">
		<div class="row">
			<div class="col-lg-1 col-md-1">
			</div>
			<div class="col-lg-10 col-md-10">
				<div class="box box-solid box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Prduct Details</h3>
					</div>
					<div class="box-body row">						
						<div class="col-md-4">
							<img width="100%" src="<?php echo $imgurl; ?>">
						</div>
						<div class="col-md-8">
							<div class="table-responsive">
								<table class="table prod_details">
									<tr><td>Name: </td><td><?php echo $prod_name; ?></td></tr>
									<tr><td>Product Category: </td><td><?php echo $cat_name; ?></td></tr> 
									<tr><td>Price: </td><td><?php echo $price; ?></td></tr>
									<tr><td>Description: </td><td><?php echo $prod_desc; ?> </td></tr>
								</table>
							</div>
						</div>
					</div>
					<div class="box-footer" align="center">
						<a href="index.php" class="button2 button" style="float:left">Shopping</a>
						<form action="" method="post">
							<input type="hidden" name="cart" value="<?php echo $id;?>"/> 
							<button type="submit" name="add_basket" class="button2 button">Add to cart</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-1 col-md-1">
			</div>
		</div>
	</section>
	<?php 
	if(isset($_POST["add_basket"])){
		if(isset($_SESSION["email"])){
			$email=$_SESSION["email"];
			$user_res= mysqli_query($con,"select * from users where email_id='".$email."'");
			$user=mysqli_fetch_assoc($user_res);
			$u_id = $user["u_id"];
			$prd_id=$_POST['cart'];
			$quant_res = mysqli_query($con,"select quantity from basket where product_id=".$prd_id." AND user_id=".$u_id."");
			$cnt=mysqli_fetch_assoc($quant_res);
			if($cnt>0){
				$quant=$cnt["quantity"]+1;
				$i= mysqli_query($con,"update basket set quantity=".$quant." where product_id=".$prd_id." AND user_id=".$u_id."");	
				if($i>0){
					alert("Product is added in cart");
				}
			}
			else{
				$quant = 1;
				$i= mysqli_query($con,"insert into basket(product_id, user_id, quantity)values(".$prd_id.",".$u_id.",".$quant.")");	
				if($i>0){
					alert("Product is added in cart");
				}
			}
		}
		else{
			alert("Please Login");
		}
	}
	
	
	}
	else{
		header("location:index.php");
	}?>
  </div>
	<div class="footer1" style="font-size: 20px;">
		<div class="container">
			<div class="row">
				<div class="col-lg-offset-3 col-md-offset-3 col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3" align="center">
                    <h1>Contact us</h1>
                    <p><h3><b>Book Rental Website</b></h3><br>
					<div class="col-lg-6">
					<span class="glyphicon glyphicon-envelope"></span><br> hello@bootstrapreal.com</div>
					<div class="col-lg-6">
					<span class="glyphicon glyphicon-earphone"></span><br> (123) 456-7890</p></div><br>
					<p class="copyright">Copyright 2013. All rights reserved.	</p>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
