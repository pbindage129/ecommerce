
<?php
session_start();
	require('config.php');
	$prod_res= mysqli_query($con,"select * from products");
	$products=mysqli_fetch_assoc($prod_res);
	require('header.php');

?>

	
  <!-- Full Width Column -->
  <div class="content-wrapper" >
      <!-- Main content -->
      <section class="content"style="background-attachment: fixed;">
		<div class="row">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="3000">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
					<div class="item active"> 
						<div class="carousel-caption">
							<h3>The Biggest <span>Sale</span></h3>
							<p>Special for today</p>
							<a class="button button2" href="#shop">Shop Now </a>
						</div>
					</div>
					<div class="item item2"> 
						<div class="carousel-caption">
							<h3>Summer <span>Collection</span></h3>
							<p>New Arrivals On Sale</p>
							<a class="button button2" href="#shop">Shop Now </a>
						</div>
					</div>
					<div class="item item3"> 
						<div class="carousel-caption">
							<h3>The Biggest <span>Sale</span></h3>
							<p>Special for today</p>
							<a class="button button2" href="#shop">Shop Now </a>
						</div>
					</div>	
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
          </div>
      </section>
      <!-- /.content -->
	<style>
	.tabs-left {
  border-bottom: none;
}
.tabs-left>li.active>a, .tabs-left>li.active>a:focus, .tabs-left>li.active>a:hover{
	border-bottom-color: #ddd;
	border-radius: 5px 0 0 4px;
	border-right-color: transparent;
}

.tabs-left>li {
  float: none;
 margin:0px;
  
}
	</style>
	<section id="shop" class="row content-row" style="padding: 0 2%">
        <div class="col-xs-3">
          <ul class="nav nav-tabs tabs-left sideways">
		  <li class="active"><a href="#all_product" data-toggle="tab">All Products</a></li>
		  <?php $cat_res= mysqli_query($con,"select * from prod_cat");
					$cnt=0;
					$cat_array = array();
				while($cats = mysqli_fetch_assoc($cat_res)) {
					$c_name= str_replace("'","_", $cats["cat_name"]);
					$c_name= str_replace(" ","_", $c_name);
					$cat_array[$cnt]=$cats["id"];
					echo '<li><a href="#'.$c_name.'" data-toggle="tab">'.$cats["cat_name"].'</a></li>';
					$cnt++;
				}?>
          </ul>
        </div>

        <div class="col-xs-9">
          <!-- Tab panes -->
          <div class="tab-content leftside">
            <div class="tab-pane active row" id="all_product">
				<?php $all_prod_res= mysqli_query($con,"select * from products");
				while($all_prod = mysqli_fetch_assoc($all_prod_res)) {
					$cat_id =$all_prod["product_cat"];
						$prod_id=$all_prod["product_id"];
						$prod_name = $all_prod["product_name"];
						$prod_desc = $all_prod["product_desc"];
						$price = $all_prod["product_price"];
						$urlimg =$all_prod["product_img"];
						$cat_r= mysqli_query($con,"select cat_name from prod_cat where id=".$cat_id."");
						$cat = mysqli_fetch_assoc($cat_r);
				echo '<div class="col-md-4">
					<div class="properties">
						<div class="image-holder">
							<img src="'.$urlimg.'" class="img-responsive"/>
						</div>
						<h4>'.$prod_name.'</h4>
						<p class="price">Price:  <i class="fa fa-inr"></i>'.$price.' </p>
						<p>Category: '.$cat["cat_name"].'</p>
						<div class="footer_P">
							<div style="float:left; display:inline-block; width:50%">
								<a href="product_details.php?p_id='.$prod_id.'" class="btn btn-primary">View Details </a>
							</div>
							<div>
								<form action="" method="post">
									<input type="hidden" name="cart" value="'.$prod_id.'"/> 
									<button type="submit" name="add_basket" class="btn btn-primary">Add to cart</button>
								</form>
							</div>
						</div>
					</div>
				</div>';
					
				}?>
				<div class="clearfix"></div>
			</div>
			<?php
			foreach($cat_array as $cat){
				$cat_id = (int)$cat;
				$cat_r= mysqli_query($con,"select cat_name from prod_cat where id=".$cat_id."");
				$cat = mysqli_fetch_assoc($cat_r);
				$cat_name = $cat["cat_name"];
				$cat_name_id = str_replace("'","_", $cat["cat_name"]);
					$cat_name_id= str_replace(" ","_", $cat_name_id);
				echo '<div class="tab-pane row" id="'.$cat_name_id.'">';
				
				$prod_res= mysqli_query($con,"select * from products where product_cat=".$cat_id."");
				while($prod = mysqli_fetch_assoc($prod_res)) {
						$prod_id_cat =$prod["product_id"];
						$prod_name_cat = $prod["product_name"];
						$prod_desc_cat = $prod["product_desc"];
						$price_cat = $prod["product_price"];
						$urlimg_cat =$prod["product_img"];
						echo '<div class="col-md-4">
					<div class="properties">
						<div class="image-holder">
							<img src="'.$urlimg_cat.'" class="img-responsive"/>
						</div>
						<h4>'.$prod_name_cat.'</h4>
						<p class="price">Price:  <i class="fa fa-inr"></i>'.$price_cat.' </p>
						<p>Category: '.$cat_name.'</p>
						<div class="footer_P">
							<div style="float:left; display:inline-block; width:50%">
								<a href="product_details.php?p_id='.$prod_id.'" class="btn btn-primary">View Details </a>
								
							</div>
							<div>
								<form action="" method="post">
									<input type="hidden" name="cart" value="'.$prod_id.'"/> 
									<button type="submit" name="add_basket" class="btn btn-primary">Add to cart</button>
								</form>
							</div>
						</div>
					</div>
				</div>';
				}
				echo '</div>';
			}
			?>
          </div>
        </div>

        <div class="clearfix"></div>
	</section>
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
?>