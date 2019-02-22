
<?php
	include('config.php');
	session_start();
	if(isset($_SESSION["email"])){
		$email=$_SESSION["email"];
		$result1= mysqli_query($con,"select count(*) AS num from books");
		$row1=mysqli_fetch_assoc($result1);
		$num=$row1["num"];
		$result2= mysqli_query($con,"select * from users where user_email='".$email."'");
		$row2=mysqli_fetch_assoc($result2);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Book_Rental</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="blue-skin.css">
	  <link rel="stylesheet" href="css/AdminLTE.min.css">
	  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
<header class="main-header">
    <nav class="navbar navbar-static-top yamm">
      <div class="container">
        <div class="navbar-header">
          <a href="../../index2.html" class="navbar-brand"><b>Book</b>Shop</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">All Categories <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="category.php">Literature & Fiction</a></li>
                <li><a href="category.php">Indian Writers</a></li>
                <li><a href="category.php">Entrance Exam</a></li>
				<li><a href="category.php">Educational Books</a></li>
				<li><a href="category.php">Business</a></li>
				<li><a href="category.php">Comics</a></li>
                <li class="divider"></li>
                <li><a href="category.php">Others</a></li>
              </ul>
            </li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            
			<li class="dropdown">
				<a href="basket.php"> <i class="fa fa-cart-plus"></i>
					<span class="label label-warning">10</span>
				</a>
			</li>
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="user1-128x128.jpg" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $row2["user_name"]; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="user1-128x128.jpg" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $row2["user_name"]; ?>
                    <small>Member since Nov. 2012</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="admin_profile.php" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
	
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
							<button class="button button2" href="https://p.w3layouts.com/demos_new/template_demo/20-06-2017/elite_shoppy-demo_Free/143933984/web/mens.html">Shop Now </button>
						</div>
					</div>
					<div class="item item2"> 
						<div class="carousel-caption">
							<h3>Summer <span>Collection</span></h3>
							<p>New Arrivals On Sale</p>
							<button class="button button2" href="https://p.w3layouts.com/demos_new/template_demo/20-06-2017/elite_shoppy-demo_Free/143933984/web/mens.html">Shop Now </button>
						</div>
					</div>
					<div class="item item3"> 
						<div class="carousel-caption">
							<h3>The Biggest <span>Sale</span></h3>
							<p>Special for today</p>
							<button class="button button2" href="https://p.w3layouts.com/demos_new/template_demo/20-06-2017/elite_shoppy-demo_Free/143933984/web/mens.html">Shop Now </button>
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
.content-row .row{padding:10px;}
.properties {padding: 10px; background-color: #fff;text-align: center; margin-bottom: 20px; height: 510px;}
.properties .image-holder{position: relative; height: 350px;}
.properties .image-holder img{width: 100%; height: 100%;}
.properties p{font-size: 14px;border-top: 1px solid #ddd;border-bottom: 1px solid #ddd; padding: 5px;}
.properties .listing-detail{margin-bottom: 10px;}
.properties .footer_P{margin-left:10px; margin-right:10px;}
</style>
	
	<section class="content content-row">
	<?php
		$result3= mysqli_query($con,"select * from books");
		$rem=$num%3;
		$k= ($num-$rem)/3;
		for($i=0;$i<=$k;$i++){ ?>
		<div class="row">
			<div class="col-lg-3 col-md-3">  </div>
			<?php for($j=0; $j<3; $j++){
			$row3=mysqli_fetch_assoc($result3);?>
				<div class="col-lg-3 col-md-3">
					<div class="properties">
						<div class="image-holder">
							<img src="img/engg/civil_engg.jpg" class="img-responsive" alt="properties"/>
						</div>
						<h4><a href="#"><?php echo $row3["book_name"]; ?></a></h4>
						<p class="price">Price:  <i class="fa fa-inr"></i> <?php echo $row3["price"]; ?> </p>
						<div class="listing-detail">Category: Comices<br>Language: <?php echo $row3["language"]; ?></div>
						<div class="footer_P">
							<div style="float:left;">
								<form action="book_details.php" method="post">
									<input type="hidden" name="cart" value="<?php echo $row3["book_id"]; ?>"/>
									<button type="submit" class="btn btn-primary">View Details </button>
								</form>
							</div>
							<div style="float: right;">
								<form action="basket.php" method="post">
									<input type="hidden" name="cart" value="<?php echo $row3["book_id"]; ?>"/> 
									<button type="submit" class="btn btn-primary">Add to cart</button>
								</form>
							</div>
						</div>
					</div>
			</div><?php
			} }  ?>
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
<?php
	}
	else{header("location:index.html");}
?>