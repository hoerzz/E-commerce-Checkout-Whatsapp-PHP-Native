<?php
include 'inc/header.php';
Session::CheckSession();
 ?>
 <?php

 if (isset($_GET['id'])) {
   $userid = (int)$_GET['id'];

 }



 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changepass'])) {
    $changePass = $users->changePasswordBysingelUserId($userid, $_POST);
 }



 if (isset( $changePass)) {
   echo  $changePass;
 }
  ?>


<div class="main-content">
        <section class="section">
          <div class="section-header">
          <h3><i class="fas fa-users mr-2"></i>Change Your Password </h3>
          </div>
          <div class="section-body">
        <div class="card-body">



          <div style="width:600px; margin:0px auto">

          <form class="" action="" method="POST">
              <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" name="old_password"  class="form-control">
              </div>
              <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password"  class="form-control">
              </div>


              <div class="form-group">
                <button type="submit" name="changepass" class="btn btn-success">Change password</button>
              </div>


          </form>
        </div>


        </div>
      </div></div></div></section>


  <?php
  include 'inc/footer.php';

  ?>
