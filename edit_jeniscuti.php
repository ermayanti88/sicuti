<?php 
include('koneksi.php');
	

$id_jeniscuti = $_GET['id_jeniscuti'];

$ambil = mysqli_query($conn, "SELECT * FROM jeniscuti WHERE id_jeniscuti='$id_jeniscuti'");
$result = mysqli_fetch_all($ambil, MYSQLI_ASSOC);
$data = $result[0];




?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags --> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Form Edit Jenis Cuti</title>
    <link href="libs/images/logopemko.JPG" rel="icon" type="images/x-icon">
  </head>
  <body>
 
 <!-- Form Registrasi -->

  <div class="container">
    <h3 class="text-center mt-3 mb-5">SILAHKAN EDIT JENIS CUTI</h3>
    <div class="card p-5 mb-5">
     <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
          <label for="id_jeniscuti">Nama Jenis Cuti</label>
          <input type="text" class="form-control" id="id_jeniscuti" name="nama_jenis" value="<?php echo $data['nama_jenis']; ?>">
        </div>
        <div class="form-group">
          <label for="id_jeniscuti">Maksimal Hari</label>
          <input type="text" class="form-control" id="id_jeniscuti" name="maks_hari" value="<?php echo $data['maks_hari']; ?>">
        </div>
       <br>
        <button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
        <button type="reset" class="btn btn-danger" name="reset">Reset</button>
      </form>
  
  <!-- Akhir Form Registrasi --> 
  <?php 
  if(isset($_POST['ubah'])){
    $nama = $_POST['nama_jenis'];
    $hari = $_POST['maks_hari'];

    $update = mysqli_query($conn, "UPDATE jeniscuti SET nama_jenis = '$nama', maks_hari = '$hari' WHERE id_jeniscuti = $id_jeniscuti;");
    if ($update) {
      echo "<script>
      Swal.fire({
        title: 'Edit Jenis Jabatan?',
        text: 'Data berhasil di edit',
        icon: 'success'
      }).then((result)=>{
    document.location='jenis_cuti.php';
      });
    </script>";
  }
  else {
    echo "Maaf, terjadi kesalahan saat mencoba menyimpan data ke database";
  }
}

 ?>
  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
  </body>
</html>