<?php
include 'inc/header.php';
Session::CheckSession(); 

if (isset($_GET['id'])) {
  $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);

}
?>
<div class="main-content">
        <section class="section">
        <div class="section-header">
          <h3><i class="fas fa-shopping-cart"></i> Order List</h3>
        </div>
            <h2 class="section-title">Data All Order</h2>
            <?php if (Session::get('id') == TRUE) { ?>
            <?php if (Session::get('roleid') == '1') { ?>
              <div style="overflow-x:auto;">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th  class="text-center">No</th>
                      <th  class="text-center">Nama Penjual</th>
                      <th  class="text-center">Nama Pembeli</th>
                      <th  class="text-center">Nama Produk</th>
                      <th  class="text-center">Jumlah</th>
                      <th  class="text-center">Total</th>
                      <th  class="text-center">No Pembeli</th>
                      <th  class="text-center">Alamat</th>
                      <th  class="text-center">Status</th>
                      <th  class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      $allOrder = $users->selectAllOrder();

                      if ($allOrder) {
                        $i = 0;
                        foreach ($allOrder as  $value) {
                          $i++;

                     ?>

                      <tr class="text-center"
                      <?php if (Session::get("penjual") == $value->penjual ) {
                        echo "style='background:#d9edf7' ";
                      } ?>
                      >
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->penjual; ?></td>
                        <td><?php echo $value->npembeli; ?></td>
                        <td><?php echo $value->nproduk; ?></td>
                        <td><?php echo $value->jumlah; ?></td>
                        <td><?php echo $value->total; ?></td>
                        <td><?php echo $value->no_pembeli; ?></td>
                        <td><?php echo $value->alamat; ?></td>
                        <td><?php echo $value->status; ?></td>
                        <td><a class="btn btn-info btn-sm " href="updateOrder.php?id=<?php echo $value->order_id;?>">Update Status</a></td>
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
                      <th  class="text-center">Jumlah</th>
                      <th  class="text-center">Total</th>
                      <th  class="text-center">Nama Pembeli</th>
                      <th  class="text-center">No Pembeli</th>
                      <th  class="text-center">Alamat</th>
                      <th  class="text-center">Status</th>
                      <th  class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $penjual = $getUinfo->name;
                      $link = new Database();
                      $sql = "SELECT * FROM tbl_order WHERE penjual = :penjual ORDER BY order_id DESC";
                      $stmt = $link->pdo->prepare($sql);
                      $stmt->bindValue(':penjual', $penjual);
                      $stmt->execute();
                     ?>
                      <?php while($data = $stmt->fetch()){ ?>
                      <tr class="text-center">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data["nproduk"]; ?></td>
                        <td><?php echo $data["jumlah"]; ?></td>
                        <td><?php echo $data["total"]; ?></td>
                        <td><?php echo $data["npembeli"]; ?></td>
                        <td><?php echo $data["no_pembeli"]; ?></td>
                        <td><?php echo $data["alamat"]; ?></td>
                        <td><?php echo $data["status"]; ?></td>
                        <td><a class="btn btn-info btn-sm " href="updateOrder.php?id=<?php echo $data["order_id"];?>">Update Status</a></td>
                      </tr>
                    <?php 
                    $no++;
                    } ?>

                  </tbody>

              </table>
              </div>
    <?php }?>
    <?php }} ?>
</div></section>
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
