
<?php
	require('config.php');
	session_start();
	if(isset($_SESSION["email"])){
		$email=$_SESSION["email"];
		require('header.php');
?>

	
  <!-- Full Width Column -->
	<div class="content-wrapper" >
		<div id="content">
            <div class="container">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li>Shopping cart</li>
                    </ul>
                </div>
				<?php
					$u_id=$user["u_id"];
					$user_det_res= mysqli_query($con,"select * from user_details where user_id='".$u_id."'");
					$user_det=mysqli_fetch_assoc($user_det_res);
					if(empty($user_det)){
						$flag=0;
					}else{
						$flag=1;
					}
					$street1=$user_det["street1"];
					$street2=$user_det["street2"];
					$area=$user_det["area"];
					$zipcode=$user_det["zipcode"];
				?>
				
				<div class="col-md-12">
					<ul class="nav nav-tabs check">
						<li class="active"><a data-toggle="tab" href="#tab1">Address</a></li>
						<li><a data-toggle="tab" href="#tab2">Delivery Method</a></li>
						<li><a data-toggle="tab" href="#tab3">Payment Method</a></li>
					</ul>
					<form action="submit.php" method="post">
						<div class="tab-content">
							<div id="tab1" class="tab-pane fade in active box">
								<div class="box-header"><h3>Address</h3></div>
				
				<div class="content">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
								<input class="form-control" name="userid" type="hidden" value="<?php echo $user["u_id"];?>">
                                <input class="form-control" name="fullname" type="text" value="<?php echo $user["user_name"];?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                 <input class="form-control" name="email" type="text" value="<?php echo $email; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="stree1">Street 1</label>
                                <input class="form-control" name="street1" type="text" <?php if($flag) echo 'value="'.$street1.'"'; ?>>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="street2">Street 2</label>
                                <input class="form-control" name="street2" type="text" <?php if($flag) echo 'value="'.$street2.'"'; ?>>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="area">Area</label>
                                <input class="form-control" name="area" type="text" <?php if($flag) echo 'value="'.$area.'"'; ?>>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="zip">ZIP</label>
                                <input class="form-control" name="zip" type="text" <?php if($flag) echo 'value="'.$zipcode.'"'; ?>>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="state">State</label>
                                <select class="form-control" onchange='selct_district(this.value)' name="state" id="state"></select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="city">City</label>
                                <select class="form-control" name="city" id='city'></select>
                            </div>
                        </div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label for="phone">Mobile No.</label>
                                <input class="form-control" name="phone" type="text" value="<?php echo $user["mobile"];?>">
                            </div>
                        </div>
                    </div>
                </div>
				<div class="box-footer">
                    <div class="pull-left">
                        <a href="index.php" class="button button2">Continue shopping</a>
                    </div>
					<div class="pull-right">
                        <a data-toggle="tab" href="#tab2" class="button button2 tab2">Next</a>
                    </div>
                </div>
			</div>
			<div id="tab2" class="tab-pane fade box">
				<div class="box-header"><h3>Delivery Method</h3></div>
					<p>choose delivery method</p>
				<div class="box"> Prime Delivery. Note: if you are the Prime user then choose this option.</div>
				<div class="box"> Under One Week Delivery. Note: if you are the Prime user then choose this option.</div>
				<div class="box"> Within 2-3 Weeks Delivery. Note: if you are the Prime user then choose this option.</div>
				<div class="box-footer">
					<div class="pull-left">
						<a href="index.php" class="button button2">Continue shopping</a>
					</div>
					<div class="pull-right">
                        <a data-toggle="tab" href="#tab3" class="button button2 tab3">Next</a>
                    </div>
				</div>
			</div>
			<div id="tab3" class="tab-pane fade box">
				<div class="box-header"><h3>Payment Method</h3></div>
				<div class="box">Cradit card / Debit Card.</div>
				<div class="box">COD(Cash on Delivery).</div>
				<div class="box-footer">
					<div class="pull-left">
						<a href="index.php" class="button button2">Continue shopping</a>
					</div>
					<div class="pull-right">
						<input type="submit" name="checkout_btn" class="button button2" value="Proceed to checkout">
					</div>
				</div>
			</div>
		  </div>
		  </form>
		</div>
	  </div>
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
	<?php }
	else{
		header("location:index.php");
	}
?>
<script>
$(".tab2").click(function (){
	 $('.check li.active').removeClass('active');
	 $(".check li:eq(1)").addClass("active");
});
$(".tab3").click(function (){
	 $('.check li.active').removeClass('active');
	 $(".check li:eq(2)").addClass("active");
})
</script>