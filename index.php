<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath."/lib/Session.php";
Session::init();



spl_autoload_register(function($classes){

  include 'classes/'.$classes.".php";

});


$users = new Users();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ZyrushShop</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/Coloshop/styles/bootstrap4/bootstrap.min.css">
<link href="assets/Coloshop/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="assets/Coloshop/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="assets/Coloshop/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="assets/Coloshop/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="assets/Coloshop/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="assets/Coloshop/styles/responsive.css">
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
							<li ><a href="#shop">shop</a></li>
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
				<li class="menu_item"><a href="#shop">shop</a></li>
			</ul>
		</div>
	</div>

	<!-- Slider -->

	<div class="main_slider" style="background-image:url(https://image.freepik.com/free-photo/charming-feminine-modern-young-25s-european-woman-long-healthy-hair-holding-digital-tablet-turning-carefree-delighted-smile_176420-14940.jpg)">
		<div class="container fill_height">
			<div class="row align-items-center fill_height">
				<div class="col">
					<div class="main_slider_content">
						<h6>Pesan Lewat Whatsapp</h6>
						<h1>Pesan Product Dengan Mudah Melalui Whatsapp</h1>
						<div class="red_button shop_now_button"><a href="#shop">shop now</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h2>New Arrivals</h2>
					</div>
				</div>
			</div>
			<div id="shop" class="row align-items-center">
				<div class="col text-center">
					<div class="new_arrivals_sorting">
						<ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked" data-filter="*">all</li>
							<?php
							$allUser = $users->selectAllProductByCtegory();
							if ($allUser) {
								foreach ($allUser as  $value) {
							?>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".<?php echo $value->kategori; ?>"><?php echo $value->kategori; ?></li>
							<?php }}else{ ?>
							<tr class="text-center">
							<h1>No Product availabe now !</h1>
							</tr>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
						<?php
						$allUser = $users->selectAllProduct();

						if ($allUser) {
						foreach ($allUser as  $value) {

						?>
						<!-- Product 1 -->
						<div class="product-item <?php echo $value->kategori; ?>">
							<div class="product discount product_filter">
								<div class="product_image">
								<?php echo '<img src=',$value->fldimage,' height="235" width="235" >'; ?>
								</div>
								<div class="favorite favorite_left"></div>
								<div class="product_info">
									<h6 class="product_name"><a href="productDetail.php?id=<?php echo $value->product_id;?>"><?php echo $value->namaproduk; ?></a></h6>
									<div class="product_price"><?php echo "Rp. ". number_format($value->harga); ?></div>
								</div>
							</div>
							<div class="red_button add_to_cart_button"><a href="productDetail.php?id=<?php echo $value->product_id;?>">Beli</a></div>
						</div>

						<?php }}else{ ?>
						<tr class="text-center">
						<h1>No Product availabe now !</h1>
						</tr>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Best Sellers -->

	<div class="best_sellers">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h2>Best Sellers</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="product_slider_container">
						<div class="owl-carousel owl-theme product_slider">

						<?php
						$allUser = $users->selectAllProduct();

						if ($allUser) {
						foreach ($allUser as  $value) {

						?>

							<div class="owl-item product_slider_item">
								<div class="product-item">
									<div class="product discount">
										<div class="product_image">
											<?php echo '<img src=',$value->fldimage,' height="235" width="235" >'; ?>
										</div>
										<div class="favorite favorite_left"></div>
										<div class="product_info">
											<h6 class="product_name"><a href="productDetail.php?id=<?php echo $value->product_id;?>"><?php echo $value->namaproduk; ?></a></h6>
											<div class="product_price"><?php echo "Rp. ". number_format($value->harga); ?></div>
										</div>
									</div>
								</div>
							</div>

						<?php }}else{ ?>
						<tr class="text-center">
						<h1>No Product availabe now !</h1>
						</tr>
						<?php } ?>

							<!-- Slide 10 -->

						</div>

						<!-- Slider Navigation -->

						<div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
						</div>
						<div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Benefit -->

	<div class="benefit">
		<div class="container">
			<div class="row benefit_row">
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>free shipping</h6>
							<p>Suffered Alteration in Some Form</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>cach on delivery</h6>
							<p>The Internet Tend To Repeat</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>45 days return</h6>
							<p>Making it Look Like Readable</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>opening all week</h6>
							<p>8AM - 09PM</p>
						</div>
					</div>
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
<script src="assets/Coloshop/js/custom.js"></script>
</body>

</html>
