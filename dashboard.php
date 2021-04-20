<?php
include 'inc/header.php';

Session::CheckSession();
?>
 <div class="main-content">
        <section class="section">
          <div class="section-header">
          <h3><i class="fas fa-users mr-2"></i>Dashboard</h3>
          </div>
          <div class="section-body">
        <div class="card-body pr-2 pl-2">
        <?php
$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
  echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);

if (isset($_GET['remove'])) {
  $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
  $removeUser = $users->deleteUserById($remove);
}

if (isset($removeUser)) {
  echo $removeUser;
}
if (isset($_GET['deactive'])) {
  $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
  $deactiveId = $users->userDeactiveByAdmin($deactive);
}

if (isset($deactiveId)) {
  echo $deactiveId;
}
if (isset($_GET['active'])) {
  $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
  $activeId = $users->userActiveByAdmin($active);
}

if (isset($activeId)) {
  echo $activeId;
}
$db = new Database();
$sql = "SELECT COUNT(*) FROM tbl_order WHERE order_id";
$stmt = $db->pdo->query($sql);
$countorder = $stmt->fetchColumn();

$sql = "SELECT COUNT(*) FROM tbl_users WHERE id";
$stmt = $db->pdo->query($sql);
$countuser = $stmt->fetchColumn();

$sql = "SELECT COUNT(*) FROM tbl_produk WHERE product_id ";
$stmt = $db->pdo->query($sql);
$countproduk = $stmt->fetchColumn();
 ?>
          <div class="row">
          <div class="col-12 mb-4">
                <div class="hero text-white hero-bg-image hero-bg-parallax" data-background="https://th.bing.com/th/id/R80eadb38292891deec853ccbc7cb789b?rik=HMEbnzrFe81ITg&riu=http%3a%2f%2fblogs.ubc.ca%2fcham93%2ffiles%2f2013%2f10%2fyoung-women-girls-shopping-81.jpg&ehk=8uSdJeoYoEu6Lmf6iUvjUtbbZjrecl7sbD0wTdYGQMM%3d&risl=&pid=ImgRaw">
                  <div class="hero-inner">
                    <h2>Welcome, <?php $username = Session::get('username');if (isset($username)) {echo $username;}?></h2>
                    <p class="lead">Selamat Bergabung Di Zyrushshop</p>
                    <div class="mt-4">
                      <a href="profile.php?id=<?php echo Session::get("id"); ?>" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Setup Account</a>
                    </div>
                  </div>
                </div>
              </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <!-- <div class="card-stats">
                  <div class="card-stats-items">
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">24</div>
                      <div class="card-stats-item-label">Pending</div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">12</div>
                      <div class="card-stats-item-label">Shipping</div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">23</div>
                      <div class="card-stats-item-label">Completed</div>
                    </div>
                  </div>
                </div> -->
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4> <a href="vieworder.php">Total Orders</a> </h4>
                  </div>
                  <div class="card-body">
                  <?php echo $countorder ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <!-- <div class="card-stats">
                  <div class="card-stats-items">
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">24</div>
                      <div class="card-stats-item-label">Pending</div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">12</div>
                      <div class="card-stats-item-label">Shipping</div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">23</div>
                      <div class="card-stats-item-label">Completed</div>
                    </div>
                  </div>
                </div> -->
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4> <a href="userlist.php">Total User</a> </h4>
                  </div>
                  <div class="card-body">
                  <?php echo $countuser ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <!-- <div class="card-stats">
                  <div class="card-stats-items">
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">24</div>
                      <div class="card-stats-item-label">Pending</div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">12</div>
                      <div class="card-stats-item-label">Shipping</div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">23</div>
                      <div class="card-stats-item-label">Completed</div>
                    </div>
                  </div>
                </div> -->
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4><a href="addProduct.php">Total Produk</a></h4>
                  </div>
                  <div class="card-body">
                  <?php echo $countproduk ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <h2 class="section-title">Data Produk</h2>
          <div style="overflow-x:auto;">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th  class="text-center">SL</th>
                      <th  class="text-center">Penjual</th>
                      <th  class="text-center">Nama Produk</th>
                      <th  class="text-center">Gambar Produk</th>
                      <th  class="text-center">Harga</th>
                      <th  class="text-center">Deskripsi</th>
                      <th  class="text-center">Kategori</th>
                      <th  class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      $allUser = $users->selectAllProduct();

                      if ($allUser) {
                        $i = 0;
                        foreach ($allUser as  $value) {
                          $i++;

                     ?>

                      <tr class="text-center"
                      <?php if (Session::get("product_id") == $value->product_id ) {
                        echo "style='background:#d9edf7' ";
                      } ?>
                      >
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->penjual; ?></td>
                        <td><?php echo $value->namaproduk; ?></td>
                        <td><?php echo '<img src=image/restaurant/foodimages/',$value->fldimage,' height="100" width="100" >'; ?></td>
                        <td><?php echo "Rp. ". number_format($value->harga); ?></td>
                        <td><?php echo $value->deskripsi; ?></td>
                        <td><?php echo $value->kategori; ?></td>
                        <td><a class="btn btn-info btn-sm " href="productDetail.php?id=<?php echo $value->product_id;?>" target="_blank">View</a></td>
                      </tr>
                    <?php }}else{ ?>
                      <tr class="text-center">
                      <td>No user availabe now !</td>
                    </tr>
                    <?php } ?>

                  </tbody>

              </table>
              </div>








        </div>
      </div></div></div></section>



  <?php
  include 'inc/footer.php';

  ?>
