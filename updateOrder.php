<?php
include 'inc/header.php';
Session::CheckSession();

 ?>
<div class="main-content">
        <section class="section">
          <div class="section-header">
          <h3><i class="fas fa-users mr-2"></i>Update Order </h3>
          </div>
          <div class="section-body">
        <div class="card-body">

        <div class="alert alert-light alert-has-icon">
                      <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                      <div class="alert-body">
                        <div class="alert-title">Pemberitahuan</div>
                        Jika Nomer Pembeli Tidak Sesuai Maka tidak bisa diberitahu
                      </div>
                    </div>

        <?php
          if (isset($_GET['id'])) {
            $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
          }
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
            $updateorder = $users->updateOrderByIdInfo($userid, $_POST);
          }
          if (isset($updateorder)) {
            echo $updateorder;
          }
        ?>
            <?php
            $getOrderInfo = $users->getOrderInfoById($userid);
            if ($getOrderInfo) {
            ?>
           <h2 class="section-title">Status Sekarang : <span style="color:blue;"><?php echo $getOrderInfo->status; ?></span> </h2> 
                <form action="" method="POST">
                    <div class="form-group">
                    <label class="d-block">Update Nomor Pembeli</label>
                         <label for="food_name">No Wa Valid :</label>
                            <input type="number" class="form-control" value="<?php echo $getOrderInfo->no_pembeli; ?>" placeholder="Gunakan Kode Negara Cth :62xxxxx" name="no_pembeli" required>
                            <label for="food_name">Gunakan Kode Negara Cth :62xxxxx</label>
                    </div>
                    <div class="form-group">
                      <label class="d-block">Update Status</label>
                      <div class="form-check">
                      <input name="npembeli" id="wa_email" class="form_input input_email input_ph" type="hidden" placeholder="Nama" required="required" data-error="Valid email is required." value="rudin@gmail.com">
                        <input class="form-check-input" type="radio" value="Terkirim" name="status" id="status1">
                        <label class="form-check-label" for="status1">
                          Terkirim
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" value="Dalam Pengiriman" name="status" id="status2">
                        <label class="form-check-label" for="status2">
                          Dalam Pengiriman
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" value="Proses" name="status" id="status2" checked>
                        <label class="form-check-label" for="status2">
                          Proses
                        </label>
                      </div>
                    </div>
                    <input name="update" class="btn btn-primary" type="submit" title="UPDATE" value="UPDATE"></input>
                    <input id="send_form" class="btn btn-success" href="javascript:void" type="submit" title="UPDATE" value="BERITAHU DI WHATSAPP"></input>
                </form>
                

                <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
	<script type="text/javascript">
$(document).on('click','#send_form', function(){
var input_blanter = document.getElementById('wa_email');

/* Whatsapp Settings */
var walink = 'https://web.whatsapp.com/send',
	phone = '<?php echo $getOrderInfo->no_pembeli; ?>',
    nproduct = '<?php echo $getOrderInfo->nproduk; ?>';
    status = '<?php echo $getOrderInfo->status; ?>';

/* Smartphone Support */
if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
var walink = 'whatsapp://send';
}

if("" != input_blanter.value){

/* Final Whatsapp URL */
var contact_whatsapp = walink + '?phone=' + phone + '&text=' +
    '*Status Pemesanan* ' + '*'+'<?php echo $getOrderInfo->npembeli; ?>'+'*' + '%0A' + 
    '=============='+ '%0A' +
    '*Nama Produk* : ' + nproduct + '%0A' +
    '*Status* : ' + '*'+'<?php echo $getOrderInfo->status; ?>'+'*' + '%0A' +
	'==============='+ '%0A' +
    'Detail Customer'+ '%0A' +
    '==============='+ '%0A' +
    '*Name* : ' + '<?php echo $getOrderInfo->npembeli; ?>' + '%0A' +
    '*No* : ' + '<?php echo $getOrderInfo->no_pembeli; ?>' + '%0A' +
    '*Alamat* : ' + '<?php echo $getOrderInfo->alamat; ?>' + '%0A' +
    '==============='+ '%0A' +
    'Terimakasih Sudah Memesan ^_^'+ '%0A' +
    '==============='+ '%0A' +
    'ZYRUSHSHOP'+ '%0A' +
    '==============='+ '%0A';

/* Whatsapp Window Open */
window.open(contact_whatsapp,'_blank');
document.getElementById("text-info").innerHTML = '<span class="yes">'+text_yes+'</span>';
} else {
document.getElementById("text-info").innerHTML = '<span class="no">'+text_no+'</span>';
}
});
</script>
<?php
  include 'inc/footer.php';

  ?>
<?php } ?>