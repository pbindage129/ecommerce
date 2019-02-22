<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Commerce</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="blue-skin.css">
	  <link rel="stylesheet" href="css/AdminLTE.min.css">
	  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
<header class="main-header">
    <nav class="navbar navbar-static-top yamm">
      <div class="container">
        <div class="navbar-header">
          <a href="index.php" class="navbar-brand"><b>E-Commerce</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Navbar Right Menu -->
		<?php if(isset($_SESSION["email"])){
		$email=$_SESSION["email"];
		$user_res= mysqli_query($con,"select * from users where email_id='".$email."'");
		$user=mysqli_fetch_assoc($user_res);
		$id=$user["u_id"];
		$user_img= mysqli_query($con,"select profile_img from user_details where user_id=".$id."");
		$img=mysqli_fetch_assoc($user_img);
		?>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
			<li class="dropdown">
				<a href="basket.php"> <i class="fa fa-2x fa-cart-plus"></i></a>
			</li>
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo $img["profile_img"]; ?>" class="user-image">
                <span class="hidden-xs"><?php echo $user["user_name"]; ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="<?php echo $img["profile_img"]; ?>" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $user["user_name"]; ?>
                  </p>
				  <?php if($email=="admin@gmail.com"){?>
					<a href="admin_page.php" class="btn btn-default btn-flat" style="display:table; margin:0 auto">Admin Page</a>
				  <?php }?>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
				  <a href="user_profile.php" class="btn btn-default btn-flat">Profile</a>			
				  
                  </div>
                  <div class="pull-right">
                    <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
		<?php }
		else{ ?>
		<div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
			<li class="dropdown">
				<a href="basket.php"> <i class="fa fa-2x fa-cart-plus"></i></a>
			</li>
            <li class="dropdown user user-menu">
              <a href="#"  data-toggle="modal" data-target="#sign">
                <span class="hidden-xs">New User?</span>
              </a>
            </li>
			<li class="dropdown user user-menu">
              <a href="#"  data-toggle="modal" data-target="#login">
                <span class="hidden-xs">Login</span>
              </a>
            </li>
          </ul>
        </div>
		<?php }?>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
	
	<div class="modal fade" id="sign" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Sign In</h4>
				</div>
				<div class="modal-body">
					<div class="contents">
						<form action="login_sign.php" method="post" data-toggle="validator" role="form" novalidate="true">
							<div class="form-group">
								<label for="firstname" class="control-label">First Name</label>
								<input type="text" name="firstname" class="form-control" id="firstname" placeholder="First Name" data-error="Enter Your First Name" required="">	
							</div>
							<div class="form-group">
								<label for="lastname" class="control-label">Last Name</label>
								<input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name" data-error="Enter Your Last Name" required="">
								
							</div>
							<div class="form-group">
								<label for="email" class="control-label">Email</label>
								<input type="email" name="email" class="form-control" id="email" placeholder="Email" data-error="This email address is invalid" required="">
								
							</div>
							<div class="form-group">
								<label for="Phone" class="control-label">Mobile No.</label>
								<input type="text" name="mobile" class="form-control" id="Phone" placeholder="Phone" data-error="Enter Your Phone Number" required="">
								
							</div>
							<div class="form-group">
								<label for="password" class="control-label">Password</label>
								<input style="width:100%" name="password" type="password" data-minlength="6" class="form-control" id="password" placeholder="Password" required="">
								
							</div>
						</div> 
					</div>
					<div class="modal-footer">
						<button type="submit" name="sign_in" class="btn btn-default button2">Sign In</button>
						<button type="button" class="btn btn-default button2" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>	 

	<div class="modal fade" id="login" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Log In</h4>
				</div>
				<div class="modal-body">
					<div class="content-agileits">
						<form action="login_sign.php" method="post" data-toggle="validator" role="form" novalidate="true">
							<div class="form-group w3l agileinfo wthree w3-agileits">
								<label for="inputEmail" class="control-label">Email</label>
								<input type="email" name="inputEmail" class="form-control" id="inputEmail" placeholder="Email" data-error="This email address is invalid" required="">
								<div class="help-block with-errors"></div>
							</div>
			
							<div class="form-group agile agileits-w3layouts w3-agile">
								<label for="inputPassword" class="control-label">Password</label>
								<input type="password" name="inputPassword" class="form-control" id="inputPassword" placeholder="Password" data-error="Password is invalid" required="">
							</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="input" name="login" class="btn btn-default button2">Login</button>
					<button type="button" class="btn btn-default button2" data-dismiss="modal">Cancel</button>
				</div>
				</form>
			</div>
		</div>
	</div>