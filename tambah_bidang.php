<?php 
include 'koneksi.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags --> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>NAMA BIDANG DISKOMINFOTIK</title>
    <link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">
  </head>
  <body>
 
 <!-- Form Registrasi -->
  <div class="container">
    <h3 class="text-center mt-3 mb-5">SILAHKAN TAMBAH NAMA BIDANG</h3>
    <input type="button" class="pink-button mb-4" value="Kembali" onclick="goToBeranda()">

<script>
    function goToBeranda() {
        window.location.href = 'bidang.php'; // Gantilah 'halaman_beranda.php' dengan halaman beranda yang sesuai
    }
</script>
<script>
    function goBack() {
        window.history.back();
    }
</script>
    <div class="card p-5 mb-5">
      <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
          <label for="id_bidang">Nama Bidang</label>
          <input type="text" class="form-control" id="id_bidang" name="nama_bidang">
        </div>
       <br>
        <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
        <button type="reset" class="btn btn-danger" name="reset">Reset</button>
      </form>
      <?php 
    
if (isset($_POST['tambah'])) {
  $nama = $_POST['nama_bidang'];

  // Pemeriksaan apakah nama bidang sudah ada
  $check_query = mysqli_query($conn, "SELECT * FROM bidang WHERE nama_bidang = '$nama'");
  $num_rows = mysqli_num_rows($check_query);

  if ($num_rows > 0) {
      echo "<script>
          Swal.fire({
              title: 'Tambah Bidang',
              text: 'Nama bidang sudah ada. Silahkan masukkan nama bidang yang berbeda.',
              icon: 'error'
          });
      </script>";
  } else {
      // Jika nama bidang belum ada, lakukan penambahan
      $insert = mysqli_query($conn, "INSERT INTO bidang (nama_bidang) VALUES ('$nama'); ");

      if ($insert) {
          echo "<script>
              Swal.fire({
                  title: 'Tambah Bidang',
                  text: 'Bidang berhasil ditambahkan',
                  icon: 'success'
              }).then((result) => {
                  document.location='bidang.php';
              });
          </script>";
      } else {
          echo "Maaf, terjadi kesalahan saat mencoba menyimpan data ke database";
      }
  }
}
?>

  </div>
  </div>
  <!-- Akhir Form Registrasi -->


  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
  </body>
</html>