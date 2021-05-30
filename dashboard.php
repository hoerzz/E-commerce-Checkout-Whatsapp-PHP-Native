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
        <div class="section-body">
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
        <h2 class="section-title">Hi, <?php echo $getUinfo->name; ?></h2>
            <p class="section-lead">
              Selamat Datang Di Zyrushshop
            </p>
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                  <img src='<?php echo $getUinfo->fld_logo; ?>' class="rounded-circle profile-widget-picture" height="100" width="100" >
                    <div class="profile-widget-items">
                      <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Nama</div>
                        <div class="profile-widget-item-value"><?php echo $getUinfo->name; ?></div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Sebagai</div>
                        <div class="profile-widget-item-value">
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
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Nomer WhatsApp</div>
                        <div class="profile-widget-item-value"><?php echo $getUinfo->mobile; ?></div>
                      </div>
                    </div>
                  </div>
                  <div class="profile-widget-description">
                    <div class="profile-widget-name"><?php echo $getUinfo->name; ?><div class="text-muted d-inline font-weight-normal"><div class="slash"></div> 
                    
                    <?php
                    if ( $getUinfo->roleid == '1')  {
                      echo "Admin";
                    } else if ( $getUinfo->roleid == '2')  {
                      echo "Vendor";
                    } else if ( $getUinfo->roleid == '3')  {
                      echo "User";
                    } 
                    ?>
                    
                    </div></div>
                    <b>“Fokuslah menjadi produktif, bukan sekadar sibuk saja.”</b>
                    <div class="mb-2 mt-3"><div class="text-small font-weight-bold">-Tim Ferris</div></div>
                  </div>
                </div>
<?php if (Session::get('id') == TRUE) { ?>
                  <?php if (Session::get('roleid') == '1') { ?>
<div class="card">
                  <div class="card-header">
                    <h4>Pemberitahuan</h4>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-tabs justify-content-center" id="myTab6" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active text-center" id="home-tab6" data-toggle="tab" href="#home6" role="tab" aria-controls="home" aria-selected="true">
                          <span><i class="fas fa-home"></i></span> Dashboard</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-center" id="profile-tab6" data-toggle="tab" href="#profile6" role="tab" aria-controls="profile" aria-selected="false">
                          <span><i class="fas fa-shopping-cart"></i></span> Jual Produk</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-center" id="contact-tab6" data-toggle="tab" href="#contact6" role="tab" aria-controls="contact" aria-selected="false">
                          <span><i class="fas fa-plus"></i></span> Tambahan</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTabContent6">
                      <div class="tab-pane fade show active" id="home6" role="tabpanel" aria-labelledby="home-tab6">
                        Selamat Datang Di Zyrushshop
                        Disini Anda Bisa Menjual Atau Membeli Product Yang Sudah Tersedia
                        Kamu Bisa lihat list order kamu disini <a href="vieworder.php">Daftar Order</a>
                        Dan Untuk Tambah Produk Bisa Disini <a href="addProduct.php">Tambah Produk</a>
                      </div>
                      <div class="tab-pane fade" id="profile6" role="tabpanel" aria-labelledby="profile-tab6">
                        Harap Perhatikan Sebelum Menjual Produk Pastikan anda sudah setting Nomer Whatsapp Anda dengan benar dan gunakan Nomer Kode Negara Yang Benar Cth : 6285xxxx Ganti Nomer Whatsapp Kamu disini <a href="profile.php?id=<?php echo Session::get("id"); ?>">Profil</a>
                      </div>
                      <div class="tab-pane fade" id="contact6" role="tabpanel" aria-labelledby="contact-tab6">
                        Sebelum Menjual Harap Tambahkan Kategori Terlebih Dahulu, Anda bisa Tambahkan disini <a href="addCategory.php">Tambah Kategori</a>
                      </div>
                    </div>
                  </div>
                </div>
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
                    <h4> <a href="userlist.php">Total User In Database</a> </h4>
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
          <?php }} ?>
          <?php if (Session::get('id') == TRUE) { ?>
                  <?php if (Session::get('roleid') == '2') { ?>
                    <div class="card">
                  <div class="card-header">
                    <h4>Pemberitahuan</h4>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-tabs justify-content-center" id="myTab6" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active text-center" id="home-tab6" data-toggle="tab" href="#home6" role="tab" aria-controls="home" aria-selected="true">
                          <span><i class="fas fa-home"></i></span> Dashboard</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-center" id="profile-tab6" data-toggle="tab" href="#profile6" role="tab" aria-controls="profile" aria-selected="false">
                          <span><i class="fas fa-shopping-cart"></i></span> Jual Produk</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-center" id="contact-tab6" data-toggle="tab" href="#contact6" role="tab" aria-controls="contact" aria-selected="false">
                          <span><i class="fas fa-plus"></i></span> Tambahan</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTabContent6">
                      <div class="tab-pane fade show active" id="home6" role="tabpanel" aria-labelledby="home-tab6">
                        Selamat Datang Di Zyrushshop
                        Disini Anda Bisa Menjual Atau Membeli Product Yang Sudah Tersedia
                        Kamu Bisa lihat list order kamu disini <a href="vieworder.php">Daftar Order</a>
                        Dan Untuk Tambah Produk Bisa Disini <a href="addProduct.php">Tambah Produk</a>
                      </div>
                      <div class="tab-pane fade" id="profile6" role="tabpanel" aria-labelledby="profile-tab6">
                        Harap Perhatikan Sebelum Menjual Produk Pastikan anda sudah setting Nomer Whatsapp Anda dengan benar dan gunakan Nomer Kode Negara Yang Benar Cth : 6285xxxx Ganti Nomer Whatsapp Kamu disini <a href="profile.php?id=<?php echo Session::get("id"); ?>">Profil</a>
                      </div>
                      <div class="tab-pane fade" id="contact6" role="tabpanel" aria-labelledby="contact-tab6">
                        Sebelum Menjual Harap Tambahkan Kategori Terlebih Dahulu, Anda bisa Tambahkan disini <a href="addCategory.php">Tambah Kategori</a>
                      </div>
                    </div>
                  </div>
                </div>
                    <?php }} ?>

                

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
                        <td>
                            <div class="dropdown d-inline">
                              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Options
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item has-icon" href="productDetail.php?id=<?php echo $value->product_id;?>"><i class="fas fa-eye"></i> View</a>
                                <a class="dropdown-item has-icon" href="updateProduk.php?id=<?php echo $value->product_id;?>"><i class="fas fa-edit"></i> Update</a>
                                <a onclick="return confirm('Are you sure To Delete ?')" class="dropdown-item has-icon" href="?remove_produk=<?php echo $value->product_id;?>"><i class="fas fa-trash-alt"></i> Delete</a>
                              </div>
                            </div>
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
                      $penjual = $getUinfo->name;
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
