<?php
include 'inc/header.php';
Session::CheckSession(); 

if (isset($_GET['id'])) {
    $product_id = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
  
  }



$users = new Users();

if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['update'])) {
  $updateProduk = $users->UpdateProduct($product_id, $_POST);
  
}
if (isset($updateProduk)) {
  echo $updateProduk;
  
}

 ?>
    <?php
    $getProduknfo = $users->getProductInfoById($product_id);
    if ($getProduknfo) {
      
     ?>

        <div class="main-content">
        <section class="section">
          <div class="section-header">
          <h3><i class="fas fa-shopping-cart"></i> Update Produk</h3>
          </div>

          <h2 class="section-title">Masukkan Data Produk</h2>
          <div class="section-body">
              <div class="card-body">
			         <!--add dish-->
                     <form action="" method="post" enctype="multipart/form-data">
            		<div class="form-group">
                         <label for="food_name">Nama Produk :</label>
                            <input type="text" class="form-control" id="food_name" value="<?php echo $getProduknfo->namaproduk; ?>" placeholder="Nama Produk" name="namaproduk" required>
                    </div>
							 
							 
                    <div class="form-group">
                        <label for="cost">Harga :</label>
                            <input type="number" class="form-control" id="cost"  placeholder="Harga" value="<?php echo $getProduknfo->harga; ?>" name="harga" required>
                    </div>
							 				 
	                <div class="form-group row">
                            <label class="col-md-1 text-md-left text-right mt-2">Deskripsi</label>
                          <div class="col-lg-12 col-md-6">
                            <textarea rows="10" class="form-control" name="deskripsi"><?php echo nl2br($getProduknfo->deskripsi); ?></textarea>
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
                    <div class="form-group">
                      <input type="hidden" name="oldimage" value="<?php echo $getProduknfo->fldimage; ?>">
                      <input type="file" name="image" class="custom-file">
                      <img src="<?php echo $getProduknfo->fldimage; ?>" width="120" class="img-thumbnail">
                    </div>
                            <button type="submit" name="update" class="btn btn-primary">Update Produk</button>
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

<?php } ?>