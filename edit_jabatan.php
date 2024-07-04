<?php 
include('koneksi.php');

$id_jabatan = $_GET['id_jabatan'];

$ambil = mysqli_query($conn, "SELECT * FROM jabatan WHERE id_jabatan='$id_jabatan'");
$result = mysqli_fetch_all($ambil, MYSQLI_ASSOC);
$data = $result[0];



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

    <title>Form Edit Menu</title>
    <link href="libs/images/logopemko.JPG" rel="icon" type="images/x-icon">
  </head>
  <body>
 
 <!-- Form Registrasi -->

  <div class="container">
    <h3 class="text-center mt-3 mb-5">SILAHKAN EDIT MENU</h3>
    <div class="card p-5 mb-5">
     <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
          <label for="id_jabatan">Nama Jabatan</label>
          <input type="text" class="form-control" id="id_jabatan" name="nama_jabatan" value="<?php echo $data['nama_jabatan']; ?>">
        </div>
       <br>
        <button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
        <button type="reset" class="btn btn-danger" name="reset">Reset</button>
      </form>
  
  <!-- Akhir Form Registrasi --> 

  <?php 
  if(isset($_POST['ubah'])){
    $nama = $_POST['nama_jabatan'];



    $insert = mysqli_query($conn, "UPDATE jabatan SET nama_jabatan = '$nama' WHERE id_jabatan=$id_jabatan;");

    if($insert){
        echo "<script>
        Swal.fire({
          title: 'Edit Jabatan?',
          text: 'Data berhasil di edit',
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
  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
  </body>
</html>