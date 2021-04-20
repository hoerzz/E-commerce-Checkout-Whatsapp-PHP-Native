<?php
include 'inc/header.php';
Session::CheckSession(); 
?>
<div class="main-content">
        <section class="section">
          <div class="section-header">
          <h3><i class="fas fa-list-alt"></i> Tambah Category</h3>
          </div>
          <h2 class="section-title">Tambah Kategori</h2>
          <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
                $register = $users->AddKategori($_POST);
              }
              
              if (isset($register)) {
                echo $register;
              }
          ?>


          <div class="section-body">
              <div class="card-body">
              
                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Ketegori</label>
                            <input type="text" class="form-control" name="kategori" required>
                    </div>
                        <br><br>
                    <button type="submit" name="add" class="btn btn-primary">Add Category</button>	
                </form>
            </div>
            <h2 class="section-title">Data Kategori</h2>
            <div style="overflow-x:auto;">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th  class="text-center">ID</th>
                      <th  class="text-center">Category</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      $allUser = $users->selectAllKategori();

                      if ($allUser) {
                        $i = 0;
                        foreach ($allUser as  $value) {
                          $i++;

                     ?>

                      <tr class="text-center"
                      <?php if (Session::get("id") == $value->id) {
                        echo "style='background:#d9edf7' ";
                      } ?>
                      >

                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->category; ?></td>

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
