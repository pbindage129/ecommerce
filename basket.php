
<?php
	require('config.php');
	session_start();
	if(isset($_SESSION["email"])){
		$email=$_SESSION["email"];
		require('header.php');
?>

	
  <!-- Full Width Column -->
	<div class="content-wrapper" >
		<div class="container">
				<?php $user_res= mysqli_query($con,"select * from users where email_id='".$email."'");
					$user=mysqli_fetch_assoc($user_res);   ?>
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>Shopping cart</li>
						<li><?php echo $user["user_name"];?></li>
                    </ul>
                </div>
				
				<?php
					$u_id = $user["u_id"];
					$count= mysqli_query($con,"select count(*) as cnt from basket where user_id=".$u_id.""); 
					if(!empty($count)){$cnt=mysqli_fetch_assoc($count);?>
                <div class="col-md-9" id="basket">
                    <div class="box">
						<div class="box-header">
                            <h1>Shopping cart</h1>
                            <p class="text-muted" style="color: #fff;">You currently have <?php echo $cnt["cnt"]; ?> item(s) in your cart.</p>
							</div>
							<?php $basket_res= mysqli_query($con,"select * from basket where user_id=".$u_id.""); ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
											<th></th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Unit price</th>
                                            <th>Discount</th>
                                            <th colspan="2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									  <?php $all_total=0;
										while($basket=mysqli_fetch_assoc($basket_res)){
											$prod_id =$basket["product_id"];
											$quant =$basket["quantity"];
											$prod_res= mysqli_query($con,"select * from products where product_id=".$prod_id."");
											$prod=mysqli_fetch_assoc($prod_res);
											$prod_name = $prod["product_name"];
											$price = $prod["product_price"];
											$urlimg_cat =$prod["product_img"];
											$prod_total = number_format($quant*$price, 2);
                                        echo '<tr>
                                            <td><img width="70px" height="80px" src="'.$urlimg_cat.'"></td>
                                            <td>'.$prod_name.'</td>
                                            <td>'.$quant.'</td>
                                            <td> ₹'.$price.'</td>
                                            <td> ₹0.00</td>
											
                                            <td> ₹'.$prod_total.'</td>
                                            <td><form action="" method="post"><input type="hidden" name="prod_id" value="'.$prod_id.'"><button class="delete_btn" type="submit" name="delete"><i class="fa fa-trash-o"></i></form></button></td>
                                        </tr>';
										$all_total = number_format($all_total + $prod_total, 2);
										}?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th colspan="2">₹<?php echo $all_total; ?></th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <!-- /.table-responsive -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="index.php" class="button button2">Continue shopping</a>
                                </div>
                                <div class="pull-right">
								<?php if($all_total!=0)
                                    echo '<a href="checkout.php" class="button button2">Proceed to checkout</a>'; ?>
                                </div>
                            </div>

                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col-md-9 -->

                <div class="col-md-3">
                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>Order summary</h3>
                        </div>
                        <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>

                        <div class="table-responsive">
                            <table class="table summary">
                                <tbody>
                                    <tr>
                                        <td>Order subtotal</td>
                                        <th>₹<?php echo number_format($all_total, 2); ?></th>
                                    </tr>
                                    <tr>
                                        <td>Shipping and handling</td>
                                        <th>₹0.00</th>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <th>₹0.00</th>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <th>₹<?php echo number_format($all_total + 00.00, 2);?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- /.col-md-3 -->
	<?php }else{echo "<script type='text/javascript'>alert('Your basket is empty! Please shopping'); window.location.href = 'index.php';</script>";}?>
            </div>
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
<?php
	if(isset($_POST["delete"])){
		$prod = $_POST["prod_id"];
		$i= mysqli_query($con,"delete from basket where product_id=".$prod."");	
		if($i>0){
			echo '<meta http-equiv="refresh" content="0;url=basket.php">';
		}
		}
	}
	else{
		header("location:index.php");
	}
?>
<script>
$(".delete_btn").click(function() {
	location.reload();
});
</script>