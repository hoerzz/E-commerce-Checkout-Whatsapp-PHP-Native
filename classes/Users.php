<?php

include 'lib/Database.php';
include_once 'lib/Session.php';


class Users{


  // Db Property
  private $db;

  // Db __construct Method
  public function __construct(){
    $this->db = new Database();
  }

  // Date formate Method
   public function formatDate($date){
     // date_default_timezone_set('Asia/Dhaka');
      $strtime = strtotime($date);
    return date('Y-m-d H:i:s', $strtime);
   }



  // Check Exist Email Address Method
  public function checkExistEmail($email){
    $sql = "SELECT email from  tbl_users WHERE email = :email";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
     $stmt->execute();
    if ($stmt->rowCount()> 0) {
      return true;
    }else{
      return false;
    }
  }


  // User Registration Method
  public function userRegistration($data){
    $username = $data['username'];
    $email = $data['email'];
    $mobile = $data['mobile'];
    $roleid = $data['roleid'];
    $password = $data['password'];
    $address = $data['address'];
    $photo=$_FILES['usr_img']['name'];
    $upload="image/akunimage/".$photo;

    $checkEmail = $this->checkExistEmail($email);

    if ($username == "" || $email == "" || $mobile == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Input fields must not be Empty !</div>';
        return $msg;
    }elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Username is too short, at least 3 Characters !</div>';
        return $msg;
    }elseif (filter_var($mobile,FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Enter only Number Characters for Mobile number field !</div>';
        return $msg;

    }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Invalid email address !</div>';
        return $msg;
    }elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Email already Exists, please try another Email... !</div>';
        return $msg;
    }else{
      $sql = "INSERT INTO tbl_users(username, email, password, mobile, roleid, fld_address, fld_logo) VALUES(:username, :email, :password, :mobile, :roleid, :address, :logo)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':password', SHA1($password));
      $stmt->bindValue(':mobile', $mobile);
      $stmt->bindValue(':roleid', $roleid);
      $stmt->bindValue(':address', $address);
      $stmt->bindValue(':logo', $upload);
      $result = $stmt->execute();
      if ($result) {
        move_uploaded_file($_FILES['usr_img']['tmp_name'], $upload);

          echo "<script>location.href='dashboard.php';</script>";
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success !</strong> Anda Berhasil Mendaftar !</div>';
          return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Ada yang salah !</div>';
          return $msg;
      }
      $_SESSION['id']=$email;
    }




  }



  // Select All User Method
  public function selectAllUserData(){
    $sql = "SELECT * FROM tbl_users ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }


  // User login Autho Method
  public function userLoginAutho($email, $password){
    $password = SHA1($password);
    $sql = "SELECT * FROM tbl_users WHERE email = :email and password = :password LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }
  // Check User Account Satatus
  public function CheckActiveUser($email){
    $sql = "SELECT * FROM tbl_users WHERE email = :email and isActive = :isActive LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':isActive', 1);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }




    // User Login Authotication Method
    public function userLoginAuthotication($data){
      $email = $data['email'];
      $password = $data['password'];


      $checkEmail = $this->checkExistEmail($email);

      if ($email == "" || $password == "" ) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Email atau Kata Sandi tidak boleh Kosong !</div>';
          return $msg;

      }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Alamat email salah !</div>';
          return $msg;
      }elseif ($checkEmail == FALSE) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Email tidak ditemukan, gunakan daftar email atau kata sandi!</div>';
          return $msg;
      }else{


        $logResult = $this->userLoginAutho($email, $password);
        $chkActive = $this->CheckActiveUser($email);

        if ($chkActive == TRUE) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong>Maaf, Akun Anda Dinonaktifkan, Silahkan Hubungi Admin!</div>';
            return $msg;
        }elseif ($logResult) {

          Session::init();
          Session::set('login', TRUE);
          Session::set('id', $logResult->id);
          Session::set('roleid', $logResult->roleid);
          Session::set('email', $logResult->email);
          Session::set('username', $logResult->username);
          Session::set('logMsg', '');
          echo "<script>location.href='dashboard.php';</script>";

        }else{
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Email atau Kata Sandi Tidak Cocok!</div>';
            return $msg;
        }

      }


    }



    // Get Single User Information By Id Method
    public function getUserInfoById($userid){
      $sql = "SELECT * FROM tbl_users WHERE id = :id LIMIT 1";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':id', $userid);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_OBJ);
      if ($result) {
        return $result;
      }else{
        return false;
      }


    }



  //
  //   Get Single User Information By Id Method
    public function updateUserByIdInfo($userid, $data){
      $username = $data['username'];
      $email = $data['email'];
      $mobile = $data['mobile'];
      $address = $data['address'];
      $roleid = $data['roleid'];
      $oldimage=$_POST['logo_lama'];

      if(isset($_FILES['logo_akun']['name'])&&($_FILES['logo_akun']['name']!="")){
        $newimage="image/akunimage/".$_FILES['logo_akun']['name'];
        unlink($oldimage);
        move_uploaded_file($_FILES['logo_akun']['tmp_name'], $newimage);
      }
      else{
        $newimage=$oldimage;
      }
      


      if ($username == ""|| $email == "" || $mobile == ""  ) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Kolom tidak boleh Kosong!</div>';
          return $msg;
        }elseif (strlen($username) < 3) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Nama pengguna terlalu pendek, minimal 3 Karakter!</div>';
            return $msg;
        }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Alamat email salah !</div>';
          return $msg;
      }else{

        $sql = "UPDATE tbl_users SET
          username = :username,
          email = :email,
          mobile = :mobile,
          fld_address = :address,
          fld_logo = :fld_logo,
          roleid = :roleid
          WHERE id = :id";
          $stmt= $this->db->pdo->prepare($sql);
          $stmt->bindValue(':username', $username);
          $stmt->bindValue(':email', $email);
          $stmt->bindValue(':mobile', $mobile);
          $stmt->bindValue(':address', $address);
          $stmt->bindValue(':fld_logo', $newimage);
          $stmt->bindValue(':roleid', $roleid);
          $stmt->bindValue(':id', $userid);
          $result =  $stmt->execute();

        if ($result) {
          echo "<script>location.href='dashboard.php';</script>";
          Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Informasi Anda Berhasil Diperbarui!</div>');



        }else{
          echo "<script>location.href='dashboard.php';</script>";
          Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data tidak dimasukkan!</div>');


        }


      }


    }




    // Delete User by Id Method
    public function deleteUserById($remove){
      $sql = "SELECT fld_logo FROM tbl_users WHERE id = :id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':id', $remove);
      $stmt->execute();
      $result = $stmt->fetch();
      unlink($result ["fld_logo"]);

      $sql = "DELETE FROM tbl_users WHERE id = :id ";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':id', $remove);
        $result =$stmt->execute();
        if ($result) {
          header('Location:dashboard.php');
          Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Akun Berhasil Dihapus !</div>');
        }else{
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data tidak Dihapus!</div>';
            return $msg;
        }
    }

    // User Deactivated By Admin
    public function userDeactiveByAdmin($deactive){
      $sql = "UPDATE tbl_users SET

       isActive=:isActive
       WHERE id = :id";

       $stmt = $this->db->pdo->prepare($sql);
       $stmt->bindValue(':isActive', 1);
       $stmt->bindValue(':id', $deactive);
       $result =   $stmt->execute();
        if ($result) {
          echo "<script>location.href='dashboard.php';</script>";
          Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Akun Berhasil Dinonaktifkan !</div>');

        }else{
          echo "<script>location.href='dashboard.php';</script>";
          Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data tidak Dinonaktifkan !</div>');

            return $msg;
        }
    }


    // User Deactivated By Admin
    public function userActiveByAdmin($active){
      $sql = "UPDATE tbl_users SET
       isActive=:isActive
       WHERE id = :id";

       $stmt = $this->db->pdo->prepare($sql);
       $stmt->bindValue(':isActive', 0);
       $stmt->bindValue(':id', $active);
       $result =   $stmt->execute();
        if ($result) {
          echo "<script>location.href='dashboard.php';</script>";
          Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Akun diaktifkan dengan sukses !</div>');
        }else{
          echo "<script>location.href='dashboard.php';</script>";
          Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data tidak diaktifkan !</div>');
        }
    }




    // Check Old password method
    public function CheckOldPassword($userid, $old_pass){
      $old_pass = SHA1($old_pass);
      $sql = "SELECT password FROM tbl_users WHERE password = :password AND id =:id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':password', $old_pass);
      $stmt->bindValue(':id', $userid);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        return true;
      }else{
        return false;
      }
    }



    // Change User pass By Id
    public  function changePasswordBysingelUserId($userid, $data){

      $old_pass = $data['old_password'];
      $new_pass = $data['new_password'];


      if ($old_pass == "" || $new_pass == "" ) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> kata sandi tidak boleh Kosong !</div>';
          return $msg;
      }elseif (strlen($new_pass) < 6) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Kata sandi baru minimal harus 6 karakter !</div>';
          return $msg;
       }

         $oldPass = $this->CheckOldPassword($userid, $old_pass);
         if ($oldPass == FALSE) {
           $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong>Error !</strong> Kata sandi lama tidak cocok !</div>';
             return $msg;
         }else{
           $new_pass = SHA1($new_pass);
           $sql = "UPDATE tbl_users SET

            password=:password
            WHERE id = :id";

            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':password', $new_pass);
            $stmt->bindValue(':id', $userid);
            $result =   $stmt->execute();

          if ($result) {
            echo "<script>location.href='dashboard.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success !</strong> Kata sandi berhasil diubah !</div>');

          }else{
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Kata sandi tidak berubah !</div>';
              return $msg;
          }

         }



    }

    public function deleteProdukById($remove_produk){
      $sql = "SELECT fldimage FROM tbl_produk WHERE product_id = :product_id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':product_id', $remove_produk);
      $stmt->execute();
      $result = $stmt->fetch();
      unlink($result ["fldimage"]);

      $sql = "DELETE FROM tbl_produk WHERE product_id = :product_id ";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':product_id', $remove_produk);
        $result =$stmt->execute();
        if ($result) {
          $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Produk !</strong> Berhasil Dihapus</div>';
            return $msg;
        }else{
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data tidak Dihapus !</div>';
            return $msg;
        }
    }

    public function UpdateProduct($product_id, $data){
      $namaproduk = $data['namaproduk'];
      $harga = $data['harga'];
      $deskripsi = $data['deskripsi'];
      $kategori = $data['kategori'];
      $oldimage=$_POST['oldimage'];

      if(isset($_FILES['image']['name'])&&($_FILES['image']['name']!="")){
        $newimage="image/produk/produkimage/".$_FILES['image']['name'];
        unlink($oldimage);
        move_uploaded_file($_FILES['image']['tmp_name'], $newimage);
      }
      else{
        $newimage=$oldimage;
      }

      $sql = "UPDATE tbl_produk SET
      namaproduk = :namaproduk,
      harga = :harga,
      deskripsi = :deskripsi,
      kategori = :kategori,
      fldimage = :fldimage
      WHERE product_id = :product_id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':namaproduk', $namaproduk);
      $stmt->bindValue(':harga', ($harga));
      $stmt->bindValue(':deskripsi', $deskripsi);
      $stmt->bindValue(':kategori', $kategori);
      $stmt->bindValue(':fldimage', $newimage,PDO::PARAM_STR);
      $stmt->bindValue(':product_id', $product_id);
      $result = $stmt->execute();
      if ($result) {
        echo "<script>location.href='dashboard.php';</script>";
          Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Product !</strong> Berhasil Diupdate</div>');
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Ada yang salah !</div>';
          return $msg;
      }
    }

    public function AddProduct($data){
      $penjual = $data['penjual'];
      $notlp = $data['notlp'];
      $namaproduk = $data['namaproduk'];
      $harga = $data['harga'];
      $deskripsi = $data['deskripsi'];
      $kategori = $data['kategori'];
      $photo=$_FILES['prod_img']['name'];
	    $upload="image/produk/produkimage/".$photo;

      $sql = "INSERT INTO tbl_produk(penjual,notlp,namaproduk,harga,deskripsi,kategori,fldimage) VALUES (:penjual, :notlp, :namaproduk, :harga, :deskripsi, :kategori, :fldimage)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':penjual', $penjual);
      $stmt->bindValue(':notlp', $notlp);
      $stmt->bindValue(':namaproduk', $namaproduk);
      $stmt->bindValue(':harga', ($harga));
      $stmt->bindValue(':deskripsi', $deskripsi);
      $stmt->bindValue(':kategori', $kategori);
      $stmt->bindValue(':fldimage', $upload);
      $result = $stmt->execute();
      if ($result) {
        move_uploaded_file($_FILES['prod_img']['tmp_name'], $upload);
        echo "<script>location.href='dashboard.php';</script>";
          Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Product !</strong> Berhasil Ditambahkan</div>');
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Ada yang salah !</div>';
          return $msg;
      }
    }

    

    public function AddKategori($data){
        $kategori = $data['kategori'];
        $sql = "INSERT INTO kategori(category) VALUES (:kategori)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':kategori', $kategori);
        $result = $stmt->execute();
        if ($result) {
          echo "<script>location.href='dashboard.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Kategori</strong> Berhasil Ditambahkan</div>');
        }else{
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Ada yang salah !</div>';
            return $msg;
        }
    }
    public function selectAllKategori(){
      $sql = "SELECT * FROM kategori ORDER BY id DESC";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectAllProduct(){
      $sql = "SELECT * FROM tbl_produk ORDER BY product_id  DESC";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectAllProductByCtegory(){
      $sql = "SELECT DISTINCT kategori FROM tbl_produk";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getProductInfoById($produkid){
      $sql = "SELECT * FROM tbl_produk WHERE product_id = :id LIMIT 1";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':id', $produkid);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_OBJ);
      if ($result) {
        return $result;
      }else{
        return false;
      }


    }

    public function AddOrder($data){
      $penjual = $data['penjual'];
      $nproduk = $data['nproduk'];
      $jumlah = $data['jumlah'];
      $npembeli = $data['npembeli'];
      $no_pembeli = $data['no_pembeli'];
      $alamat = $data['alamat'];
      $status = $data['status'];

      $sql = "INSERT INTO tbl_order(penjual,nproduk,jumlah,npembeli,no_pembeli,alamat,status) VALUES (:penjual, :nproduk, :jumlah, :npembeli, :no_pembeli, :alamat, :status)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':penjual', $penjual);
      $stmt->bindValue(':nproduk', $nproduk);
      $stmt->bindValue(':jumlah', $jumlah);
      $stmt->bindValue(':npembeli', ($npembeli));
      $stmt->bindValue(':no_pembeli', $no_pembeli);
      $stmt->bindValue(':alamat', $alamat);
      $stmt->bindValue(':status', $status);
      $result = $stmt->execute();
      if ($result) {
        echo "<script>location.href='index.php';</script>";
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Ada yang salah !</div>';
          return $msg;
      }
    }

    public function selectAllOrder(){
      $sql = "SELECT * FROM tbl_order ORDER BY order_id  DESC";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateOrderByIdInfo($order_id, $data){
      $npembeli = $data['no_pembeli'];
      $status = $data['status'];
      

        $sql = "UPDATE tbl_order SET
          no_pembeli = :pembeli,
          status = :status
          WHERE order_id = :order_id";
          $stmt= $this->db->pdo->prepare($sql);
          $stmt->bindValue(':pembeli', $npembeli);
          $stmt->bindValue(':status', $status);
          $stmt->bindValue(':order_id', $order_id);
          $result = $stmt->execute();
          if ($result) {
            echo "<script>location.href='vieworder.php';</script>";
          }
      }

    public function CountOrder(){
      $sql = "SELECT COUNT(*) FROM tbl_order WHERE order_id";
      $stmt = $this->db->pdo->prepare($sql);
      return $stmt->fetchColumn();
    }

    public function getOrderInfoById($order_id){
      $sql = "SELECT * FROM tbl_order WHERE order_id = :order_id LIMIT 1";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':order_id', $order_id);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_OBJ);
      if ($result) {
        return $result;
      }else{
        return false;
      }


    }








}
