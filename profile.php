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
            <h2 class="section-title">Hi, <?php
$name = Session::get('name');
if (isset($name)) {
  echo $name;
}
 ?></h2>
            <p class="section-lead">
              Change information about yourself on this page.
            </p>

            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                  <?php echo '<img src=',$getUinfo->fld_logo,' class="rounded-circle profile-widget-picture" height="100" width="100" >'; ?>
                    <div class="profile-widget-items">
                      <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Nama</div>
                        <div class="profile-widget-item-value"><?php $name = Session::get('name');if (isset($name)) {echo $name;}?></div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Sebagai</div>
                        <div class="profile-widget-item-value"><?php
                    if ( Session::get("roleid") == '1')  {
                      echo "Admin";
                    } else if ( Session::get("roleid") == '2')  {
                      echo "Vendor";
                    }if ( Session::get("roleid") == '3')  {
                      echo "User";
                    } 
                    ?></div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Nomer WhatsApp</div>
                        <div class="profile-widget-item-value"><?php echo $getUinfo->mobile; ?></div>
                      </div>
                    </div>
                  </div>
                  <div class="profile-widget-description">
                    <div class="profile-widget-name"><?php $name = Session::get('name');if (isset($name)) {echo $name;}?><div class="text-muted d-inline font-weight-normal"><div class="slash"></div> 
                    
                    <?php
                    if ( Session::get("roleid") == '1')  {
                      echo "Admin";
                    } else if ( Session::get("roleid") == '2')  {
                      echo "Vendor";
                    }if ( Session::get("roleid") == '3')  {
                      echo "User";
                    } 
                    ?>
                    
                    </div></div>
                    <b>“Fokuslah menjadi produktif, bukan sekadar sibuk saja.”</b>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-7">
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
                      <label class="col-form-label text-md-left col-md-6 col-6">Update Foto</label>
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
                      <option value="3">User only</option>
                    <?php }elseif($getUinfo->roleid == '2'){?>
                      <option value="1">Admin</option>
                      <option value="2" selected='selected'>Vendor</option>
                      <option value="3">User only</option>
                    <?php }elseif($getUinfo->roleid == '3'){?>
                      <option value="1">Admin</option>
                      <option value="2">Vendor</option>
                      <option value="3" selected='selected'>User only</option>


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
            </div>
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
