<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath."../lib/Session.php";
Session::init();



spl_autoload_register(function($classes){

  include 'classes/'.$classes.".php";

});


$users = new Users();
Session::CheckLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/Coloshop/styles/bootstrap4/bootstrap.min.css">
<link href="assets/Coloshop/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="assets/Coloshop/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="assets/Coloshop/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="assets/Coloshop/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" href="assets/Coloshop/plugins/themify-icons/themify-icons.css">
<link rel="stylesheet" type="text/css" href="assets/Coloshop/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="assets/Coloshop/styles/contact_styles.css">
<link rel="stylesheet" type="text/css" href="assets/Coloshop/styles/contact_responsive.css">
</head>

<body>

<div class="super_container">

	<!-- Header -->

	<header class="header trans_300">

		<!-- Top Navigation -->

		<div class="top_nav">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="top_nav_left">CheckOut With Whatsapp</div>
					</div>
					<div class="col-md-6 text-right">
						<div class="top_nav_right">
							<ul class="top_nav_menu">

								<!-- Currency / Language / My Account -->
								<li class="account">
								<?php if (Session::get('id') == TRUE) { ?>
									<?php if (Session::get('roleid') == '1') { ?>
									<a href="#">
										My Account
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="account_selection">
									<li><a href="dashboard.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Dashboard</a></li>
									<?php  } ?>
									<?php } ?>
								<?php if (Session::get('id') == TRUE) { ?>
									<?php if (Session::get('roleid') == '2') { ?>
										<a href="#">
										My Account
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="account_selection">
									<li><a href="dashboard.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Dashboard</a></li>
									<?php  } ?>
								<?php } else {?>
									<a href="#">
										Join Now !
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="account_selection">
									<li><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
									<li><a href="daftar.php"><i class="fa fa-user-plus" aria-hidden="true"></i>daftar</a></li>
									<?php } ?>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Navigation -->

		<div class="main_nav_container">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-right">
						<div class="logo_container">
							<a href="index.php">Zyrush<span>shop</span></a>
						</div>
						<nav class="navbar">
							<ul class="navbar_menu">
							<li><a href="index.php">home</a></li>
							</ul>
							<ul class="navbar_user">
							<?php if (Session::get('id') == TRUE) { ?>
									<?php if (Session::get('roleid') == '1') { ?>
									<li><a href="dashboard.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>
									<?php  } ?>
									<?php } ?>
								<?php if (Session::get('id') == TRUE) { ?>
									<?php if (Session::get('roleid') == '2') { ?>
									<li><a href="dashboard.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>
									<?php  } ?>
								<?php }?>
							</ul>
							<div class="hamburger_container">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>

	</header>

	<div class="fs_menu_overlay"></div>
	<div class="hamburger_menu">
		<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="hamburger_menu_content text-right">
			<ul class="menu_top_nav">
				<li class="menu_item has-children">
				<?php if (Session::get('id') == TRUE) { ?>
									<?php if (Session::get('roleid') == '1') { ?>
									<a href="#">
										My Account
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="menu_selection">
									<li><a href="dashboard.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Dashboard</a></li>
									<?php  } ?>
									<?php } ?>
								<?php if (Session::get('id') == TRUE) { ?>
									<?php if (Session::get('roleid') == '2') { ?>
										<a href="#">
										My Account
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="menu_selection">
									<li><a href="dashboard.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Dashboard</a></li>
									<?php  } ?>
								<?php } else {?>
									<a href="#">
										Join Now !
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="menu_selection">
									<li><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
									<li><a href="daftar.php"><i class="fa fa-user-plus" aria-hidden="true"></i>daftar</a></li>
									<?php } ?>
									</ul>
				</li>
				<li class="menu_item"><a href="index.php">home</a></li>
			</ul>
		</div>
	</div>

	<div class="container contact_container">
		<div class="row">
			<div class="col">

			</div>
		</div>

		<br><br><br>
    <?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
   $userLog = $users->userLoginAuthotication($_POST);
}
if (isset($userLog)) {
  echo $userLog;
}

$logout = Session::get('logout');
if (isset($logout)) {
  echo $logout;
}



 ?>
			<center>
			<div class="col-lg-6 get_in_touch_col">
				<div class="get_in_touch_contents">
					<h1>Login</h1>
					<p>Silahkan Login...</p>
					<form method="POST">
						<div>
							<input id="input_email" class="form_input input_email input_ph" type="email" name="email" placeholder="Email" required="required" data-error="Valid email is required.">
							<input id="input_name" class="form_input input_name input_ph" type="password" name="password" placeholder="Password" required="required" data-error="Name is required.">
						</div>
						<div>
							<button id="review_submit" type="submit" class="red_button message_submit_btn trans_300" name="login" value="Submit">Login</button>
						</div>
					</form>
				</div>
			</div>
			</center>

		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="newsletter_text d-flex flex-column justify-content-center align-items-lg-start align-items-md-center text-center">
						<h4>Newsletter</h4>
						<p>Subscribe to our newsletter and get 20% off your first purchase</p>
					</div>
				</div>
				<div class="col-lg-6">
					<form action="post">
						<div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
							<input id="newsletter_email" type="email" placeholder="Your email" required="required" data-error="Valid email is required.">
							<button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">subscribe</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="footer_nav_container d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
						<ul class="footer_nav">
							<li><a href="#">Blog</a></li>
							<li><a href="#">FAQs</a></li>
							<li><a href="contact.html">Contact us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
						<ul>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="footer_nav_container">
					<div class="cr">©2021 ZYRUSHSHOP - All Rights Reserverd.</div>
					</div>
				</div>
			</div>
		</div>
	</footer>

</div>

<script src="assets/Coloshop/js/jquery-3.2.1.min.js"></script>
<script src="assets/Coloshop/styles/bootstrap4/popper.js"></script>
<script src="assets/Coloshop/styles/bootstrap4/bootstrap.min.js"></script>
<script src="assets/Coloshop/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="assets/Coloshop/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="assets/Coloshop/plugins/easing/easing.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="assets/Coloshop/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="assets/Coloshop/js/contact_custom.js"></script>
</body>

</html>
