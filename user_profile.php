
<?php
	require('config.php');
	session_start();
	require('header.php');
	if(isset($_SESSION["email"])){
		$email=$_SESSION["email"];
		$user_res= mysqli_query($con,"select * from users where email_id='".$email."'");
		$user=mysqli_fetch_assoc($user_res);
?>

	
	<section class="content content-row" style="padding:30px; margin: 20px 0;">
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
					$city=$user_det["city"];
					$state=$user_det["state"];
				?>
		
		<div class="row">
			<div class="col-lg-1 col-md-1">
			</div>
			<div class="col-lg-10 col-md-10">
				<div class="box box-solid box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Profile</h3>
					</div>
					<div class="box-body">
						<div class="img">
							<img width="100%" src="<?php echo $user_det["profile_img"];; ?>">
						</div>
							<div class="table-responsive">
								<table class="table profiles">
									<tr class="p_name"><td colspan="4"><?php echo $user["user_name"]; ?></td></tr> 
									<tr><td>Email: </td><td><?php echo $email; ?></td><td>Mobile: </td><td><?php echo $user["mobile"]; ?></td></tr>
									<tr><td>Street1: </td><td><?php echo $street1; ?> </td><td>Street2: </td><td><?php echo $street2; ?></td></tr>
									<tr><td>Area: </td><td><?php echo $area; ?></td><td>Pin code: </td><td><?php echo $zipcode; ?></td></tr> 
									<tr><td>City: </td><td><?php echo $city; ?> </td><td>State: </td><td><?php echo $state; ?></td></tr>
								</table>
							</div>
					</div>
					<div class="box-footer" align="center">
						<a href="#" data-toggle="modal" class="button button2" data-target="#edit_profile">Edit Profile</a>
					</div>
				</div>
			</div>
			<div class="col-lg-1 col-md-1">
			</div>
		</div>
	</section>
  </div>
  
	<div class="modal fade" id="edit_profile" role="dialog">
		<div class="modal-dialog modal-lg">
			<form action="" method="post" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Sign In</h4>
				</div>
				<div class="modal-body">
					<div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
								<input class="form-control" name="userid" type="hidden" value="<?php echo $user["u_id"];?>">
                                <input class="form-control" disabled name="fullname" type="text" value="<?php echo $user["user_name"];?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                 <input class="form-control" disabled name="email" type="text" value="<?php echo $email; ?>">
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
                                <input class="form-control" disabled name="phone" type="text" value="<?php echo $user["mobile"];?>">
                            </div>
                        </div>
						<div class="col-sm-6">
                            <div class="form-group">
								<label for="img_update" class="control-label">Select image to upload:</label>
								<input type="file" name="img_update" accept="image/*" class="form-control" id="img_update">
							</div>
                        </div>
                    </div>
				</div>
				<div class="modal-footer">
					<div class="pull-right">
						<button type="submit" name="update_profile" class="btn btn-default button2">Update</a>
					</div>
					<div class="pull-right">
						<button type="button" class="btn btn-default button2" data-dismiss="modal">Cancel</button>
					</div>	
				</div>
				</form>
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
<?php 

$target_dir = "img/user_profiles/";
	
	if(isset($_POST["update_profile"])){
		$u_id=$_POST['userid'];
		$street1=str_replace("'","\'", $_POST['street1']);
		$street2=str_replace("'","\'", $_POST['street2']);
		$area=str_replace("'","\'", $_POST['area']);
		$zip=$_POST['zip'];
		//$state=$_POST['state'];
		//$city=$_POST['city'];
		$state = 'Maharashtra';
		$city='kolhapur';
		$ext = pathinfo($_FILES["img_update"]["name"], PATHINFO_EXTENSION);
		$target_file = $target_dir .$email .'.'.$ext;
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
		$user_record= mysqli_query($con,"select * from user_details where user_id='".$u_id."'");		
		$count = mysqli_num_rows($user_record);
		if($count){
			if(isset($_FILES['img_update']) && !empty($_FILES['img_update']['name'])) {
				$i= mysqli_query($con,"update user_details set street1='".$street1."', street2='".$street2."', area='".$area."', zipcode='".$zip."', city='".$city."', state='".$state."', profile_img='".$imgurlupdate."' where user_id=".$u_id."");	
			}
			else{
				$i= mysqli_query($con,"update user_details set street1='".$street1."', street2='".$street2."', area='".$area."', zipcode='".$zip."', city='".$city."', state='".$state."' where user_id=".$u_id."");
			}
		}
		else{
			$i= mysqli_query($con,"insert into user_details(user_id, street1, street2, area, zipcode, city, state, profile_img)values(".$u_id.",'".$street1."','".$street2."','".$area."',".$zip.",'".$city."','".$state."', '".$imgurlupdate."')");
		}
		if($i>0){
			alert("Updated successfully");
		}
		else		
		{	echo mysqli_error($con);
    		alert("Sorry!! something is wrong please try again");
		}
	}


}
else{
	echo '<meta http-equiv="refresh" content="0;url=index.php">';
}?>