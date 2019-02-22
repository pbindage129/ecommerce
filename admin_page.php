
<?php
	require('config.php');
	session_start();
	if(isset($_SESSION["email"]) && $_SESSION["email"]=="admin@gmail.com"){
		$email=$_SESSION["email"];
		require('header.php');
?>
	
	<section class="container content-row">
				<div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>Admin Authorities</li>
                    </ul>
                </div>
		<div class="row">
			<ul class="nav nav-pills nav-justified">
				<li class="active"><a data-toggle="tab" href="#all_prod">See All Products</a></li>
				<li><a data-toggle="tab" href="#new_prod">Add New Product</a></li>
				<li><a data-toggle="tab" href="#order_details">Orders Detail</a></li>
			</ul>
			
			<div class="tab-content">
				<div id="all_prod" class="tab-pane fade in active">
					<?php $prod_res= mysqli_query($con,"select * from products"); ?>
					<table>
						<tr>
							<th>Product Name</th>
							<th>Product Category</th>
							<th>Product Description</th>
							<th>Product Price</th>
							<th>Product Image</th>
							<th></th>
						</tr>
			<?php	while($products = mysqli_fetch_assoc($prod_res)) {
						$cat_id =$products["product_cat"];
						$prod_id=$products["product_id"];
						$prod_name = $products["product_name"];
						$prod_desc = $products["product_desc"];
						$price = $products["product_price"];
						$imgurl =$products["product_img"];
						$cat_r= mysqli_query($con,"select cat_name from prod_cat where id=".$cat_id."");
						$cat = mysqli_fetch_assoc($cat_r);
					  echo '<tr>
							<td>'.$prod_name.'</td>
							<td>'.$cat["cat_name"].'</td>
							<td>'.$prod_desc.'</td>
							<td>'.$price.'</td>
							<td><img width="70px" height="70px" src="'.$imgurl.'"></td>
							<td><a href="#" data-toggle="modal" data-target="#update'.$prod_id.'" class="button btn">Update</a></td>   
						</tr>';
						
						echo '<div class="modal fade" id="update'.$prod_id.'" role="dialog">
						  <div class="modal-dialog modal-sm">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Update</h4>
							  </div>
							  <div class="modal-body">
								<div class="content-agileits">
								  <form action="product_update.php" method="post" role="form" novalidate="true" enctype="multipart/form-data">
									<input type="hidden" name="prod_id" value="'.$prod_id.'" class="form-control" required="">
									<div class="form-group">
										<label for="prod_name" class="control-label">Product Name</label>
										<input type="text" name="prod_name" value="'.$prod_name.'" class="form-control" id="prod_name" placeholder="Product Name" required="">
									</div>
									<div class="form-group">
									<select id="update_select_'.$cat_id.'" name="catgry" class="form-control custom-select">';
									 $cat_res= mysqli_query($con,"select * from prod_cat");
									while($cats = mysqli_fetch_assoc($cat_res)) {
										$c_id = $cats["id"];
										$c_name= $cats["cat_name"];
										echo '<option value="'.$c_id.'">'.$c_name.'</option>';
									}
									echo '<script> $("#update_select_'.$cat_id.' option[value='.$cat_id.']").prop("selected","selected"); </script>';
								echo '</select>
									</div>
									<div class="form-group">
										<label for="price" class="control-label">Price</label>
										<input type="email" name="price" value="'.$price.'" class="form-control" id="price" placeholder="Price" required="">
									</div>
									<div class="form-group">
										<label for="prod_desc" class="control-label">Product Description</label>
										<input type="text" name="prod_desc" value="'.$prod_desc.'" class="form-control" id="prod_desc" placeholder="Product Description" required="">
									</div>	
									<div class="form-group">
										<label for="img_update" class="control-label">Select image to upload:</label>
										<input type="file" name="img_update" accept="image/*" class="form-control" id="img_update" required="">
									</div>
									
									</div>
								</div>
								<div class="modal-footer">
									<button type="input" name="update" class="btn btn-default button2">Update</button>
									<button type="button" class="btn btn-default button2" data-dismiss="modal">Cancel</button>
								</div>
								</form>
							</div>
						</div>
						</div>';
						}
						
					?>
					</table>
				</div>
				<div id="new_prod" class="tab-pane row fade">
					<div class="col-lg-6">
					<div class="box box-solid box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Enter new product details</h3>
						</div>
						<div class="box-body">
							<form action="product_update.php" method="post" role="form" novalidate="true" enctype="multipart/form-data">
							<div class="form-group">
								<label for="prod_name" class="control-label">Product Name</label>
								<input type="text" name="prod_name" class="form-control" id="prod_name" placeholder="Product Name"  required="">
							</div>
							<div class="form-group">
								<select name="cat" class="form-control custom-select">
									<option disabled selected>Select category</option>
									<?php $cat_res= mysqli_query($con,"select * from prod_cat"); 
										while($category = mysqli_fetch_assoc($cat_res)) {
										$category_id = $category["id"];
										$category_name= $category["cat_name"];
										echo '<option value="'.$category_id.'">'.$category_name.'</option>';
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="price" class="control-label">Price</label>
								<input type="email" name="price" class="form-control" id="price" placeholder="Price" required="">
							</div>
							<div class="form-group">
								<label for="prod_desc" class="control-label">Product Description</label>
								<input type="text" name="prod_desc" class="form-control" id="prod_desc" placeholder="Product Description" required="">
							</div>	
							<div class="form-group">
								<label for="fileToUpload" class="control-label">Select image to upload:</label>
								<input type="file" name="fileToUpload" class="form-control" id="fileToUpload" required="">
							</div>
						</div>
						<div class="box-footer" align="center">
							<button type="submit" name="add_product" class="btn btn-default button2">Add Product</button>
						</div>
						</form>
					</div>
					</div>
					<div class="col-md-6">
					   <div class="box box-solid box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Enter new product category</h3>
						</div>
						<div class="box-body">
							<form action="product_update.php" method="post" role="form" novalidate="true">
							<div class="form-group">
								<label for="prod_cat" class="control-label">Category Name</label>
								<input type="text" name="prod_cat" class="form-control" id="prod_cat" placeholder="Category Name" required="">
							</div>
						</div>
						<div class="box-footer" align="center">
							<button type="submit" name="add_category" class="btn btn-default button2">Add Product Category</button>
						</div>
						</form>
					  </div>
					</div>
				</div>
				<div id="order_details" class="tab-pane fade">
					<?php $order_res= mysqli_query($con,"select * from orders");
					echo '<table>
						<tr>
							<th>User Name</th>
							<th>Product Name</th>
							<th>Product Category</th>
							<th>Product Price</th>
							<th>Quantity</th>
							<th>Total Price</th>
							<th>Date</th>
							<th>Status</th>
						</tr>';
					while($orders=mysqli_fetch_assoc($order_res)){
						$group_res= mysqli_query($con,"select count(*) as cnts, order_num from orders GROUP by order_num");
						$grp = mysqli_fetch_assoc($group_res);
						$order_nums =$orders["order_num"];
						$u_id=$orders["user_id"];
						$users_r= mysqli_query($con,"select user_name from users where u_id=".$u_id."");
						$users=mysqli_fetch_assoc($users_r);
						$user_nm=$users["user_name"];
						$user_detail= mysqli_query($con,"select * from users_details where user_id=".$u_id."");
						$prod_id=$orders["product_id"];
						$prod_res= mysqli_query($con,"select * from products where product_id=".$prod_id."");
						$prod_s=mysqli_fetch_assoc($prod_res);
						$cat_id =$prod_s["product_cat"];
						$prod_name = $prod_s["product_name"];
						$price = $prod_s["product_price"];
						$cat_r= mysqli_query($con,"select cat_name from prod_cat where id=".$cat_id."");
						$cat = mysqli_fetch_assoc($cat_r);
						$quant=$orders["quantity"];
						$sub_total_p=$orders["subtotal_price"];
						$date_order=$orders["date"];
						$status=$orders["status"];
					  echo '<tr class="'.$order_nums.'">
							<td>'.$user_nm.'</td>
							<td>'.$prod_name.'</td>
							<td>'.$cat["cat_name"].'</td>
							
							<td>'.$price.'</td>
							<td>'.$quant.'</td>
							<td>'.$sub_total_p.'</td>
							<td>'.$date_order.'</td>
							<td>'.$status.'</td>							
						</tr>';
					}?>
					</table>
				</div>
			</div>
		</div>
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
	<?php }
	?>