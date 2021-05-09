<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath."/../lib/Session.php";
Session::init();



spl_autoload_register(function($classes){

  include 'classes/'.$classes.".php";

});


$users = new Users();

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Sistem Pemesanan Product Melalui Whatsapp &mdash; Admin</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
</head>

<body>


<?php


if (isset($_GET['action']) && $_GET['action'] == 'logout') {
  // Session::set('logout', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
  // <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  // <strong>Success !</strong> You are Logged Out Successfully !</div>');
  Session::destroy();
}



 ?>



<div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <?php if (Session::get('id') == TRUE) { ?>
            <?php if (Session::get('roleid') == '3') { ?>
              <?php  } ?> 
              <?php  } ?> 
        <ul class="navbar-nav navbar-right">
        <?php
    $getUinfo = $users->getUserInfoById(Session::get("id"));
    if ($getUinfo) {
     ?>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
          <?php echo '<img src=',$getUinfo->fld_logo,' class="rounded-circle mr-1" width="50" height="30">'; ?>
            <div class="d-sm-none d-lg-inline-block">Hi, <?php $username = Session::get('username'); if (isset($username)) { echo $username; } ?></div></a>

            <?php } ?>

            <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">Anda Sebagai 
              <?php
                    if ( Session::get("roleid") == '1')  {
                      echo "<b>Admin</b>";
                    } else if ( Session::get("roleid") == '2')  {
                      echo "<b'>Vendor</b>";
                    }if ( Session::get("roleid") == '3')  {
                      echo "<b'>User</b>";
                    } 
                    ?>
              </div>
              <a href="index.php" target="_blank" class="dropdown-item has-icon">
                <i class="far fa-eye"></i> View Website
              </a>
              <a href="profile.php?id=<?php echo Session::get("id"); ?>" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="?action=logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="dashboard.html">ZYRUSHSHOP</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="dashboard.html">ZS</a>
          </div>
          <ul class="sidebar-menu">
              <?php if (Session::get('id') == TRUE) { ?>
            <?php if (Session::get('roleid') == '1') { ?>
                <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
                <li class="nav-item"><a href="userlist.php" class="nav-link"><i class="fas fa-user-alt"></i> <span>User List</span></a></li>
                <li class="nav-item"><a href="vieworder.php" class="nav-link"><i class="fas fa-clipboard-list"></i> <span>Order</span></a></li>
                <li class="nav-item"><a href="addUser.php" class="nav-link"><i class="fas fa-user-plus"></i> <span>Add User</span></a></li>
                <li class="nav-item"><a href="addProduct.php" class="nav-link"><i class="fas fa-shopping-cart"></i> <span>Add Product</span></a></li>
                <li class="nav-item"><a href="addCategory.php" class="nav-link"><i class="fas fa-list-alt"></i> <span>Add Category</span></a></li>
              
              <?php  } ?>
              <?php } ?>
          <?php if (Session::get('id') == TRUE) { ?>
            <?php if (Session::get('roleid') == '2') { ?>
                <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
                <li class="nav-item"><a href="vieworder.php" class="nav-link"><i class="fas fa-clipboard-list"></i> <span>Order</span></a></li>
                <li class="nav-item"><a href="addProduct.php" class="nav-link"><i class="fas fa-shopping-cart"></i> <span>Add Product</span></a></li>
                <li class="nav-item"><a href="addCategory.php" class="nav-link"><i class="fas fa-list-alt"></i> <span>Add Category</span></a></li>
            <?php  } ?>
          <?php }?>
          <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-download"></i> <span>Download Laporan</span></a>
                <ul class="dropdown-menu">
                    <?php if (Session::get('id') == TRUE) { ?>
                  <?php if (Session::get('roleid') == '1') { ?>
                    <li class="nav-item"><a href="report_order.php" class="nav-link"><i class="fas fa-file-pdf"></i> <span>Laporan Order</span></a></li>
                    <li class="nav-item"><a href="report_product.php" class="nav-link"><i class="fas fa-file-pdf"></i> <span>Laporan Product</span></a></li>
                    <li class="nav-item"><a href="report_akun.php" class="nav-link"><i class="fas fa-file-pdf"></i> <span>Laporan Akun</span></a></li>
                    <?php  } ?>
                    <?php } ?>
                <?php if (Session::get('id') == TRUE) { ?>
                  <?php if (Session::get('roleid') == '2') { ?>
                    <li class="nav-item"><a href="report_order.php" class="nav-link"><i class="fas fa-file-pdf"></i> <span>Laporan Order</span></a></li>
                    <li class="nav-item"><a href="report_product.php" class="nav-link"><i class="fas fa-file-pdf"></i> <span>Laporan Product</span></a></li>
                <?php  } ?>
              <?php }?>
                </ul>
              </li>
            </ul>
        </aside>
      </div>