<?php
include 'inc/header.php';
Session::CheckSession(); 
?>
<div class="main-content">
        <section class="section">
          <div class="section-header">
          <h3><i class="fas fa-shopping-cart"></i> Tambah Produk</h3>
          </div>

          <h2 class="section-title">Masukkan Data Produk</h2>
          <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
                $register = $users->AddProduct($_POST);
              }
              
              if (isset($register)) {
                echo $register;
              }
          ?>


          <div class="section-body">
              <div class="card-body">
			         <!--add dish-->
                     <form action="" method="post" enctype="multipart/form-data">
            		<div class="form-group">
                         <label for="food_name">Nama Produk :</label>
                            <input type="hidden" name="penjual" value="<?php $getUinfo = $users->getUserInfoById(Session::get("id")); if ($getUinfo) { echo $getUinfo->name; }?>" class="form-control">
                            <input type="hidden" name="notlp" value="<?php $getUinfo = $users->getUserInfoById(Session::get("id")); if ($getUinfo) { echo $getUinfo->mobile; }?>" class="form-control">
                            <input type="text" class="form-control" id="food_name" placeholder="Nama Produk" name="namaproduk" required>
                    </div>
							 
							 
                    <div class="form-group">
                        <label for="cost">Harga :</label>
                            <input type="number" class="form-control" id="cost"  placeholder="Harga" name="harga" required>
                    </div>
							 				 
	                <div class="form-group row">
                            <label class="col-md-1 text-md-left text-right mt-2">Deskripsi</label>
                          <div class="col-lg-12 col-md-6">
                            <textarea rows="10" class="form-control" name="deskripsi"></textarea>
                          </div>
                    </div>
                    <div class="form-group">
                      <label>Category</label>
                      <select class="form-control" name="kategori">
                      <?php
                        $allUser = $users->selectAllKategori();

                        if ($allUser) {
                            foreach ($allUser as  $value) {
                        ?>
                        <option value="<?php echo $value->category; ?>"><?php echo $value->category; ?></option>
                        <?php }}else{ ?>
                        <tr class="text-center">
                        <option value="">No Category availabe now !</option>
                        </tr>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label class="col-form-label text-md-left col-md-6 col-6">Thumbnail</label>
                      <div class="col-sm-12 col-md-7">
                        <div id="image-preview" class="image-preview">
                          <label for="image-upload" id="image-label">Choose File</label>
                          <input type="file" id="files" accept="image/*" name="prod_img" required/>
                          <img id="image" height="256" width="256"/>
                        </div>
                        <br><br>
                        
                      </div>
                    </div>	
                            <button type="submit" name="add" class="btn btn-primary">Tambah Produk</button>
                            
                </form>
				   
            </div>


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
