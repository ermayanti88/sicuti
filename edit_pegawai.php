<?php
include('koneksi.php');

$id_pegawai = $_GET['id_pegawai'];

$ambil = mysqli_query($conn, "SELECT * FROM pegawai WHERE id_pegawai='$id_pegawai'");
$result = mysqli_fetch_all($ambil, MYSQLI_ASSOC);
$data = $result[0];
$id_user = $data['id_user'];



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



  <title>Form Edit Jenis Cuti</title>
  <link href="libs/images/logopemko.JPG" rel="icon" type="images/x-icon">
</head>

<body>

  <!-- Form Registrasi -->

  <div class="container">
    <h3 class="text-center mt-3 mb-5">SILAHKAN EDIT DATA PEGAWAI</h3>
    <div class="card p-5 mb-5">
      <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
          <label for="id_pegawai">Nama Pegawai</label>
          <input type="text" class="form-control" id="id_pegawai" name="nama_pegawai" value="<?php echo $data['nama_pegawai']; ?>">
        </div>
        <div class="form-group">
          <label for="id_pegawai">NIP</label>
          <input type="text" class="form-control" id="id_pegawai" name="NIP" value="<?php echo $data['NIP']; ?>">
        </div>

        <div class="form-group">
          <label for="id_bidang">Bidang</label>


          <select name="id_bidang" class="custom-select" required>
            <option selected>Pilih Bidang</option>
            <?php

            $query = mysqli_query($conn, 'SELECT * FROM bidang');
            $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
            ?>

            <?php foreach ($result as $result) : ?>
              <option value="<?php echo $result["id_bidang"]; ?>" <?php echo $data['id_bidang'] == $result["id_bidang"] ? 'selected' : ''; ?>>
                <?php echo $result["nama_bidang"]; ?></option>
            <?php endforeach; ?>
          </select>
        </div>


        <div class="form-group">
          <label for="id_jabatan">Jabatan</label>
          <select name="id_jabatan" class="custom-select" required>
            <option selected>Pilih Jabatan</option>
            <?php

            $query = mysqli_query($conn, 'SELECT * FROM jabatan');
            $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
            ?>

            <?php foreach ($result as $result) : ?>
              <option value="<?php echo $result["id_jabatan"]; ?>" <?php echo $data['id_jabatan'] == $result["id_jabatan"] ? 'selected' : ''; ?>>
                <?php echo $result["nama_jabatan"]; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="id_pegawai">Unit Kerja</label>
          <input type="text" class="form-control" id="id_pegawai" readonly name="unit_kerja" value="<?php echo $data['unit_kerja']; ?>">
        </div>
        <div class="form-group">
          <label for="id_pegawai">Pangkat</label>
          <input type="text" class="form-control" id="id_pegawai" name="pangkat" value="<?php echo $data['pangkat']; ?>">
        </div>
        <div class="form-group">
          <label for="id_pegawai">Alamat</label>
          <input type="text" class="form-control" id="id_pegawai" name="alamat" value="<?php echo $data['alamat']; ?>">
        </div>

        <div class="form-group">
          <label for="jenis_kelamin">Jenis Kelamin</label>
          <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
            <option value="Laki-laki" <?php echo ($data['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
            <option value="Perempuan" <?php echo ($data['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
          </select>
        </div>

        <div class="form-group">
          <label for="id_pegawai">No Telpon</label>
          <input type="text" class="form-control" id="id_pegawai" name="no_telp" value="<?php echo $data['no_telp']; ?>">
        </div>
        <br>
        <button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
        <button type="reset" class="btn btn-danger" name="reset">Reset</button>
      </form>

      <!-- Akhir Form Registrasi -->
      <?php
      if (isset($_POST['ubah'])) {
        $nama = $_POST['nama_pegawai'];
        $nip = $_POST['NIP'];
        $bidang = $_POST['id_bidang'];
        $jabatan = $_POST['id_jabatan'];
        $unit = $_POST['unit_kerja'];
        $pnkt = $_POST['pangkat'];
        $almt = $_POST['alamat'];
        $jk = $_POST['jenis_kelamin'];
        $no = $_POST['no_telp'];

        $update = mysqli_query($conn, "UPDATE `pegawai` SET `NIP`='$nip', `id_jabatan`='$jabatan', `id_bidang`='$bidang', `nama_pegawai`='$nama', `unit_kerja`='$unit', `pangkat`='$pnkt', `alamat`='$almt', `jenis_kelamin`='$jk', `no_telp`='$no' WHERE id_pegawai=$id_pegawai;");

        $update2 = mysqli_query($conn, "UPDATE `user` SET `nama`='$nama',`username`='$nip' WHERE id_user=$id_user;");

        if ($update) {
          echo "<script>
          Swal.fire({
            title: 'Edit Pegawai?',
            text: 'Data berhasil di edit',
            icon: 'success'
          }).then((result)=>{
        document.location='pegawai.php';
          });
        </script>";
        } else {
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