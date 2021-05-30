<?php
include 'inc/header.php';
Session::CheckSession();

 ?>

<div class="main-content">
        <section class="section">
          <div class="section-header">
          <h3><i class="fas fa-users mr-2"></i>Profile </h3>
          </div>
          <div class="section-body">
        <div class="card-body">
        <?php

if (isset($_GET['id'])) {
  $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  $updateUser = $users->updateUserByIdInfo($userid, $_POST);

}
if (isset($updateUser)) {
  echo $updateUser;
}




 ?>
    <?php
    $getUinfo = $users->getUserInfoById($userid);
    if ($getUinfo) {






     ?>
          <div class="section-body">
            <h2 class="section-title">Hi, <?php echo $getUinfo->name; ?></h2>
            <p class="section-lead">
              Change information about yourself on this page.
            </p>
                <div class="card author-box card-primary">
                  <div class="card-body">
                    <div class="author-box-left">
                    <?php echo '<img src=',$getUinfo->fld_logo,' class="rounded-circle profile-widget-picture" height="100" width="100" >'; ?>
                      <div class="clearfix"></div>
                    </div>
                    <div class="author-box-details">
                      <div class="author-box-name">
                        <a href="#"><?php echo $getUinfo->name; ?></a>
                      </div>
                      <div class="author-box-job">
                      <?php
                              if ( $getUinfo->roleid == '1')  {
                                echo "Admin";
                              } else if ( $getUinfo->roleid == '2')  {
                                echo "Vendor";
                              } else if ( $getUinfo->roleid == '3')  {
                                echo "User";
                              } 
                            ?>
                      </div>
                      <div class="author-box-description">
                        <p>" Tak ada rahasia untuk menggapai sukses. Sukses itu dapat terjadi karena persiapan, kerja keras, dan mau belajar dari kegagalan.</p>
                      </div>
                      <div class="mb-2 mt-3"><div class="text-small font-weight-bold">-Colin Powell</div></div>
                      <a href="#" class="btn btn-social-icon mr-1 btn-facebook">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                      <a href="#" class="btn btn-social-icon mr-1 btn-twitter">
                        <i class="fab fa-twitter"></i>
                      </a>
                      <a href="#" class="btn btn-social-icon mr-1 btn-github">
                        <i class="fab fa-github"></i>
                      </a>
                      <a href="#" class="btn btn-social-icon mr-1 btn-instagram">
                        <i class="fab fa-instagram"></i>
                      </a>
                      <div class="w-100 d-sm-none"></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                <form action="" method="post" enctype="multipart/form-data">
                <div class="card-header">
                      <h4>Edit Profile</h4>
                    </div>
                  <div class="card-body">
                  <div class="row">
                  <div class="form-group col-md-6 col-12">
                    <label for="name">Your Name</label>
                    <input type="text" name="name" value="<?php echo $getUinfo->name; ?>" class="form-control">
                  </div>
                  <div class="form-group col-md-6 col-12">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" value="<?php echo $getUinfo->email; ?>" class="form-control">
                  </div>
                  </div>
                  <div class="row">
                  <div class="form-group col-md-12 col-12">
                    <label for="mobile">Mobile Number</label>
                    <input type="number" id="mobile" name="mobile" value="<?php echo $getUinfo->mobile; ?>" class="form-control">
                  </div>
                  </div>
                  <div class="row">
                  <div class="form-group col-md-12 col-12">
                    <label for="mobile">Address</label>
                    <input type="text" id="mobile" name="address" value="<?php echo $getUinfo->fld_address; ?>" class="form-control">
                  </div>
                  </div>
                  <div class="row">
                  <div class="form-group col-md-6 col-12">
                      <input type="hidden" name="logo_lama" value="<?php echo $getUinfo->fld_logo; ?>">
                      <label>Update Foto</label>
                      <div class="col-sm-12 col-md-7">
                        <div id="image-preview" class="image-preview">
                          <label for="image-upload" id="image-label">Choose File</label>
                          <input type="file" id="files" accept="image/*" name="logo_akun" />
                          <img id="image" src="<?php echo $getUinfo->fld_logo; ?>" height="256" width="256"/>
                        </div>
                        <br><br>
                        
                      </div>
                    </div>
                    </div>
                  
                  
                  <?php if (Session::get("roleid") == '1') { ?>

                  <div class="form-group
                  <?php if (Session::get("roleid") == '1' && Session::get("id") == $getUinfo->id) {
                    echo "d-none";
                  } ?>
                  ">
                    <div class="form-group">
                      <label for="sel1">Select user Role</label>
                      <select class="form-control" name="roleid" id="roleid">

                      <?php

                    if($getUinfo->roleid == '1'){?>
                      <option value="1" selected='selected'>Admin</option>
                      <option value="2">Vendor</option>
                    <?php }elseif($getUinfo->roleid == '2'){?>
                      <option value="1">Admin</option>
                      <option value="2" selected='selected'>Vendor</option>


                    <?php } ?>


                      </select>
                      </div>
                  </div>
                  
              <?php }else{?>
                <input type="hidden" name="roleid" value="<?php echo $getUinfo->roleid; ?>">
              <?php } ?>
                  <?php if (Session::get("id") == $getUinfo->id) {?>

                    <div class="card-footer text-left">
                  <div class="form-group">
                    <button type="submit" name="update" class="btn btn-success">Update</button>
                    <a class="btn btn-primary" href="changepass.php?id=<?php echo $getUinfo->id;?>">Password change</a>
                  </div>
                <?php } elseif(Session::get("roleid") == '1') {?>


                  <div class="form-group">
                    <button type="submit" name="update" class="btn btn-success">Update</button>
                    <a class="btn btn-primary" href="changepass.php?id=<?php echo $getUinfo->id;?>">Password change</a>
                  </div>
                <?php } elseif(Session::get("roleid") == '2') {?>


                  <div class="form-group">
                    <button type="submit" name="update" class="btn btn-success">Update</button>

                  </div>

                  <?php   }else{ ?>
                      <div class="form-group">

                        <a class="btn btn-primary" href="index.php">Ok</a>
                      </div>
                    <?php } ?>
                    </div>
                    </div>
              </form>
                </div>
              </div>

      <?php }else{

        header('Location:index.php');
      } ?>



</div>
      </div></div></div></section>
      <script>
document.getElementById("files").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("image").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};
</script>

  <?php
  include 'inc/footer.php';

  ?>
