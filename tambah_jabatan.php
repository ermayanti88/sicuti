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
    <title>FORM TAMBAH NAMA JABATAN</title>
    <link href="libs/images/logopemko.JPG" rel="icon" type="images/x-icon">
    
  </head>
  <body>
 
 <!-- Form Registrasi -->
  <div class="container">
    <h3 class="text-center mt-3 mb-5">SILAHKAN TAMBAH NAMA JABATAN</h3>
    <input type="button" class="pink-button mb-4" value="Kembali" onclick="goToBeranda()">

<script>
    function goToBeranda() {
        window.location.href = 'jabatan.php'; // Gantilah 'halaman_beranda.php' dengan halaman beranda yang sesuai
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
          <label for="id_jabatan">Nama Jabatan</label>
          <input type="text" class="form-control" id="id_jabatan" name="nama_jabatan">
        </div>
       <br>
        <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
        <button type="reset" class="btn btn-danger" name="reset">Reset</button>
      </form>

      <?php 
  if(isset($_POST['tambah'])){
    $nama = $_POST['nama_jabatan'];



    $insert = mysqli_query($conn, "INSERT INTO jabatan (nama_jabatan) VALUES ('$nama'); ");

    if($insert){
      echo "<script>
      Swal.fire({
        title: 'Tambah Jabatan?',
        text: 'Jabatan Berhasil ditambahkan',
        icon: 'success'
      }).then((result)=>{
        document.location='jabatan.php';
      });
  </script>";
      
    }
    else {
      echo "Maaf, terjadi kesalahan saat mencoba menyimpan data ke database";
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