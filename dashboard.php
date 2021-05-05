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

        if (isset($_GET['remove_produk'])) {
          $remove_produk = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove_produk']);
          $remove_produk = $users->deleteProdukById($remove_produk);
        }

        if (isset($remove_produk)) {
          echo $remove_produk;
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
          <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4> <a href="vieworder.php">Total Orders In Database</a> </h4>
                  </div>
                  <div class="card-body">
                  <?php echo $countorder ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                  <?php if (Session::get('id') == TRUE) { ?>
                  <?php if (Session::get('roleid') == '1') { ?>
                    <h4> <a href="userlist.php">Total User In Database</a> </h4>
                  <?php }} ?>
                  <?php if (Session::get('id') == TRUE) { ?>
                  <?php if (Session::get('roleid') == '2') { ?>
                    <h4>Total User In Database</h4>
                  <?php }} ?>
                  </div>
                  <div class="card-body">
                  <?php echo $countuser ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4><a href="#produk">Total Produk In Database</a></h4>
                  </div>
                  <div class="card-body">
                  <?php echo $countproduk ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <h2 id="produk" class="section-title">Data Produk</h2>
          <?php if (Session::get('id') == TRUE) { ?>
            <?php if (Session::get('roleid') == '1') { ?>
              <div style="overflow-x:auto;">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th  class="text-center">No</th>
                      <th  class="text-center">Penjual</th>
                      <th  class="text-center">Nama Produk</th>
                      <th  class="text-center">Gambar Produk</th>
                      <th  class="text-center">Harga</th>
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
                        <td><?php echo '<img src=',$value->fldimage,' height="100" width="100" >'; ?></td>
                        <td><?php echo "Rp. ". number_format($value->harga); ?></td>
                        <td><?php echo $value->kategori; ?></td>
                        <td><a class="btn btn-info btn-sm " href="productDetail.php?id=<?php echo $value->product_id;?>" target="_blank">View</a>
                            <a class="btn btn-info btn-sm " href="updateProduk.php?id=<?php echo $value->product_id;?>">Update Produk</a>
                            <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger
                    <?php if (Session::get("product_id") == TRUE) {
                      echo "disabled";
                    } ?>
                             btn-sm " href="?remove_produk=<?php echo $value->product_id;?>">Remove</a>
                        </td>
                      </tr>
                    <?php }}else{ ?>
                      <tr class="text-center">
                      <td>No user availabe now !</td>
                    </tr>
                    <?php } ?>

                  </tbody>

              </table>
              </div>
            <?php }} ?>
            <?php if (Session::get('id') == TRUE) { ?>
            <?php if (Session::get('roleid') == '2') { ?>
          <?php
          $getUinfo = $users->getUserInfoById(Session::get("id"));
          if ($getUinfo) {
          ?>
          <div style="overflow-x:auto;">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th  class="text-center">No</th>
                      <th  class="text-center">Nama Produk</th>
                      <th  class="text-center">Gambar Produk</th>
                      <th  class="text-center">Harga</th>
                      <th  class="text-center">Kategori</th>
                      <th  class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                      $no = 1;
                      $penjual = $getUinfo->username;
                      $link = new Database();
                      $sql = "SELECT * FROM tbl_produk WHERE penjual = :penjual ORDER BY product_id DESC";
                      $stmt = $link->pdo->prepare($sql);
                      $stmt->bindValue(':penjual', $penjual);
                      $stmt->execute();
                      while($data = $stmt->fetch()){
                     ?>
                      <tr class="text-center">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data["namaproduk"]; ?></td>
                        <td><?php echo '<img src=',$data["fldimage"],' height="100" width="100" >'; ?></td>
                        <td><?php echo "Rp. ". number_format($data["harga"]); ?></td>
                        <td><?php echo $data["kategori"]; ?></td>
                        <td><a class="btn btn-info btn-sm " href="productDetail.php?id=<?php echo $data["product_id"];?>" target="_blank">View</a>
                            <a class="btn btn-info btn-sm " href="updateProduk.php?id=<?php echo $data["product_id"];?>">Update Produk</a>
                            <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger
                    <?php if (Session::get("product_id") == TRUE) {
                      echo "disabled";
                    } ?>
                             btn-sm " href="?remove_produk=<?php echo $data["product_id"];?>">Remove</a>
                        </td>
                      </tr>
                      <?php 
                      $no++;
                      } ?>

                  </tbody>

              </table>
              </div>
              <?php }?>
              <?php }} ?>






        </div>
      </div></div></div></section>



  <?php
  include 'inc/footer.php';
  ?>
