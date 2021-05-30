<?php
include 'inc/header.php';
Session::CheckSession(); 
?>

<div class="main-content">
<?php if (Session::get('id') == TRUE) { ?>
            <?php if (Session::get('roleid') == '1') { ?>
        <section class="section">
          <div class="section-header">
          <h3><i class="fas fa-users mr-2"></i>Add User </h3>
          </div>
          <div class="section-body">
              <div class="card-body">
			         <!--add dish-->
            <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {

              $register = $users->userRegistration($_POST);
            }
            
            if (isset($register)) {
              echo $register;
            }
            ?>
                     <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="name">Name:</label>
                          <input type="text" class="form-control" id="name" value="<?php if(isset($r_name)) { echo $r_name;}?>" placeholder="Enter Restaurant Name" name="name" required/>
                      </div>
	                  <div class="form-group">
                          <label for="name">Email:</label>
                          <input type="email" class="form-control" id="email" value="<?php if(isset($email)) { echo $email;}?>" placeholder="Enter Email" name="email" required/>
                          <span style="color:red;"><?php if(isset($email_error)){ echo $email_error;} ?></span>
	                  </div>
	                 <div class="form-group">
                         <label for="pswd">Password:</label>
                         <input type="password" class="form-control" id="pswd" placeholder="Enter Password" name="password" required/>
                     </div>
                     <div class="form-group">
                         <label for="mob">Mobile:</label>
                         <input type="tel" class="form-control" value="<?php if(isset($mob)) { echo $mob;}?>"id="mob" placeholder="Enter 10-digit Phone no." name="mobile" required/>
                     </div>
	                 <div class="form-group">
                          <label for="add">Address:</label>
                          <input type="text" class="form-control" id="add" placeholder="Enter Address" value="<?php if(isset($address)) { echo $address;}?>" name="address" required>
                    </div>
                    <div class="form-group">
                    <div class="form-group">
                      <label for="sel1">Select user Role</label>
                      <select class="form-control" name="roleid" id="roleid">
                        <option value="1">Admin</option>
                        <option value="2">Vendor</option>
                      </select>
                    </div>
                   </div>
	                 <div class="form-group">
                     Upload Logo <br>
                     <input type="file"  name="usr_img" required>
                     </div>
                     <button type="submit" id="register" name="register" class="btn btn-outline-primary">Register</button>
                </form>
				   
                </div>
                
                <?php }} ?>
                <?php if (Session::get('id') == TRUE) { ?>
                <?php if (Session::get('roleid') == '2') { ?>
                  <div class="card">
                  <div class="card-header">
                    <h4>Not Found</h4>
                  </div>
                  <div class="card-body">
                    <div class="empty-state" data-height="600">
                      <img class="img-fluid" src="assets/img/drawkit/drawkit-nature-man-colour.svg" alt="image">
                      <h2 class="mt-0">Looks like you got lost</h2>
                      <p class="lead">
                        We can't find the path you're looking for, check the path again and try again.
                      </p>
                      <a href="dashboard.php" class="btn btn-warning mt-4">Dashboard</a>
                      <a href="index.php" class="mt-4 bb">Home</a>
                    </div>
                  </div>
                </div>
                  <?php }} ?>
                
</div>
</div></div></div></section>


              

  <?php
  include 'inc/footer.php';

  ?>
