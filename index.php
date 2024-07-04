<?php

include 'koneksi.php';
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistem Informasi Cuti Pegawai DISKOMINFO - Login</title>
  
  <link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">

  <!-- Bootstrap Core CSS -->
  <link href="libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="dist/css/offline-font.css" rel="stylesheet">
  <link href="dist/css/custom.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" defer>
     // Menambahkan state baru ke history saat halaman dimuat
     window.history.forward();

     function noBack(){
      window.history.forward();
     }
     

 </script>
 
  <!-- jQuery -->
  <script src="libs/jquery/dist/jquery.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body style="background-color: #f1f4f7; background-image: url('latar.png')" onload="noBack()" onpageshow="if(event.persisted) noBack()">

  <section id="main-wrapper" style="margin-top: 120px">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4"><?php include("layout_alert.php"); ?></div>
      </div><!-- /.row -->
      <div class="row">
        <div id="page-wrapper" class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4" style="background-color: #ffffff;
         border-radius: 10px;  box-shadow: 0 1px 1px rgba(0,0,0,.05)">
          <div class="row">
            <div class="col-lg-12">
              <br />
              <center><img src="libs/images/logopemko.png" width="120" height="120"></center>
              <h2 class="text-center">Sistem Informasi Cuti Pegawai<br /> <b>DISKOMINFOTIK</b><br /> Kota Banjarmasin</h2>


            </div>
          </div><!-- /.row -->
          <div class="row">
            <div class="col-lg-20">
              <div class="panel panel-default">
                <div class="panel-body">

                  <form action="index.php" method="post">
                    <div class="form-group">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>

                        <div class="input-group-prepend">

                        </div>
                        <input type="text" class="form-control" placeholder="Masukkan Username" name="username">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <div class="input-group-prepend">

                      </div>
                      <input type="password" class="form-control" placeholder="Masukkan Password" name="password">
                    </div>
                </div>
                <center>
                  <button type="submit" name="submit" class="btn btn-primary">LOGIN</button>
                  <button type="reset" name="reset" class="btn btn-secondary">RESET</button>
                  </form>
                  <!-- Akhir Form Login -->

                  <!-- Akhir Form Login -->

                  <!-- Eksekusi Form Login -->
                  <?php
                  if (isset($_POST['submit'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];


                    // Query untuk memilih tabel
                    //   var_dump($koneksi);
                    $cek_data = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");

                    $hasil = mysqli_fetch_array($cek_data);
                    // Memeriksa apakah ada hasil yang ditemukan
                    if ($hasil !== null) {
                      $status = $hasil['role'];
                      // Lakukan sesuatu dengan $status
                      $status = $hasil['role'];
                      $login_user = $hasil['username'];
                      $row = mysqli_num_rows($cek_data);

                      // Pengecekan Kondisi Login Berhasil/Tidak
                      // echo $row; die;

                      session_start();
                      $_SESSION['login_user'] = $login_user;
                      // echo var_dump($_SESSION);die;
                      if ($status == '1') {
                        header('location: admin.php');
                      } elseif ($status == '2') {
                        header('location: hal_pegawai.php');
                      }
                    } else {

                      echo "<script>
      Swal.fire({
        title: 'LOGIN GAGAL',
     text:' Silahkan Periksa kembali username dan password',
        icon: 'error'
      }).then((result)=>{
        document.location='index.php';
      });;
      </script>";
                    }
                  }




                  ?>
              </div>