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

    <title>Form Tambah Menu</title>
    <link href="libs/images/logopemko.JPG" rel="icon" type="images/x-icon">
    <style>
        /* Gaya CSS untuk tombol kembali */
        .pink-button {
            background-color: green;
            color: white;
            padding: 1px 13px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
  </head>
  
  <body>
 
 <!-- Form Registrasi -->
  <div class="container">
    <h3 class="text-center mt-3 mb-5">SILAHKAN TAMBAH DATA PEGAWAI</h3>
    <input type="button" class="pink-button mb-4" value="Kembali" onclick="goToBeranda()">

<script>
    function goToBeranda() {
        window.location.href = 'pegawai.php';
    }
</script>
    <div class="card p-5 mb-5">
      
      <form method="POST" action="" enctype="multipart/form-data">



        
        <div class="form-group">
          <label for="id_pegawai">NIP</label>
          <input type="text" class="form-control" id="nip" name="NIP" required>
        </div>
        <div class="form-group">
          <label for="id_pegawai">Nama Pegawai</label>
          <input type="text" class="form-control" id="id_pegawai" name="nama_pegawai" required>
        </div>
        
      
        <div class="form-group">
          <label for="id_jabatan">Jabatan</label>
          <select name="id_jabatan" class="custom-select" required>
            <option selected>Pilih Jabatan</option>
            <?php 
          
          $query = mysqli_query($conn, 'SELECT * FROM jabatan');
       $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
       ?>

<?php foreach($result as $result) : ?>
          <option value="<?php echo $result["id_jabatan"]; ?>">
          <?php echo $result["nama_jabatan"]; ?></option>
          <?php endforeach; ?>       
</select>
        </div>
        <div class="form-group">
          <label for="id_pegawai">Unit Kerja</label>
          <input type="text" readonly value="Dinas Komunikasi, Informatika dan Statistik" class="form-control" id="id_pegawai" name="unit_kerja" required>
        </div>
        
        <div class="form-group">
          <label for="id_bidang">Sub Unit Kerja</label>


        <select name="id_bidang"class="custom-select" required>
            <option selected>Pilih Bidang</option>
            <?php 
          
          $query = mysqli_query($conn, 'SELECT * FROM bidang');
       $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
       ?>

<?php foreach($result as $result) : ?>
          <option value="<?php echo $result["id_bidang"]; ?>">
          <?php echo $result["nama_bidang"]; ?></option>
          <?php endforeach; ?>       
</select>
        </div>
        
        <div class="form-group">
          <label for="id_pegawai">Pangkat / Golongan</label>
          <input type="text" class="form-control" id="id_pegawai" name="pangkat" required>
        </div>
        <div class="form-group">
          <label for="id_pegawai">Alamat</label>
          <input type="text" class="form-control" id="id_pegawai" name="alamat" required>
        </div>

        <div class="form-group">
    <label for="jenis_kelamin">Jenis Kelamin</label>
    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
    <option selected>Pilih Jenis Kelamin</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
      
    </select>
</div>



<div class="form-group">
          <label for="id_pegawai">No Handphone</label>
          <input type="text" class="form-control" id="id_pegawai" name="no_telp" required>
        </div>
        
        
      
        
       <br>
        <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
        <button type="reset" class="btn btn-danger" name="reset">Reset</button>
        
      
      </form>

      <?php 
  if(isset($_POST['tambah'])){
  
    $nip = $_POST['NIP'];
    $nama = $_POST['nama_pegawai'];
    $jabatan= $_POST['id_jabatan'];
    $bidang=$_POST['id_bidang'];
    $unit = $_POST['unit_kerja'];
    $pngkt = $_POST['pangkat'];
    $almt = $_POST['alamat'];
    $jk = $_POST['jenis_kelamin'];
    $telp = $_POST['no_telp'];
    



  //   echo "INSERT INTO pegawai (NIP,nama_pegawai,id_jabatan,id_bidang,unit_kerja,pangkat,alamat,no_telp) 
  //  VALUES('$nip','$nama','$jabatan',$bidang, $unit','$pngkt','$almt','$telp')"; die;

// Check if form is submitted


// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $nip = $_POST['NIP'];

    // Check if the NIP already exists in the database
    $check_query = "SELECT COUNT(*) as count FROM pegawai WHERE NIP = '$nip'";
    $check_result = mysqli_query($conn, $check_query);
    $count = mysqli_fetch_assoc($check_result)['count'];

    if ($count > 0) {
        // NIP already exists, display an error message
        echo "<script>alert('NIP Sudah Ada'); window.location = document.referrer;</script>";
        return false;
    } else {
        // NIP is unique, proceed with insertion
        // ... (rest of your code for form processing)
    }
}



$insert1 = mysqli_query($conn, "INSERT INTO user (nama, username, password, role)
VALUES ('$nama', '$nip', '12345', 2)");

$id_user = mysqli_insert_id($conn);

$insert2 = mysqli_query($conn, "INSERT INTO pegawai (NIP, nama_pegawai, id_jabatan, id_bidang, unit_kerja, pangkat, alamat, jenis_kelamin, no_telp, id_user) 
VALUES ('$nip', '$nama', $jabatan, $bidang, '$unit', '$pngkt', '$almt', '$jk', '$telp', $id_user)");

    if($insert2){
      echo "<script>
      Swal.fire({
        title: 'Tambah Pegawai?',
        text: 'Bidang Berhasil ditambahkan',
        icon: 'success'
      }).then((result)=>{
        document.location='pegawai.php';
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