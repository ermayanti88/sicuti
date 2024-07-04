<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
include 'koneksi.php';

// deskripsi halaman
$pagedesc = "Data Pegawai";
include("layout_top1.php");
$now = date('Y-m-d');
$now_indonesia = date('d F Y', strtotime($now)); // Format tanggal Indonesia
// session_start();   

$username = $_SESSION['login_user'];
$cek_data = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

$hasil = mysqli_fetch_array($cek_data);
// Memeriksa apakah ada hasil yang ditemukan
if ($hasil !== null) {
    $query = mysqli_query($conn, "SELECT * FROM pegawai WHERE id_user = " . $hasil['id_user']);

    $pegawai  = mysqli_fetch_array($query);
    // echo var_dump($pegawai);die;
}
// echo var_dump($hasil);die;

$id_cuti = $_GET['id_cuti'];

$ambil = mysqli_query($conn, "SELECT * FROM cuti WHERE id_cuti='$id_cuti'");
$result = mysqli_fetch_all($ambil, MYSQLI_ASSOC);
$data = $result[0];
?>

<link href="libs/images/logopemko.JPG" rel="icon" type="images/x-icon">

<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Cuti</h1>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form class="form-horizontal" name="cuti" action="" method="POST" enctype="multipart/form-data" onSubmit="return valid();">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>Form Pengajuan Cuti</h3>
                        </div>
                        <br>
                        <!-- <div class="form-group">
                            <label class="control-label col-sm-4">Nomor Cuti</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="id_cuti" name="id_cuti" value="" readonly>
                            </div>

                        </div> -->

                        <div class="form-group">
                            <label class="control-label col-sm-4">Nama Pegawai</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="id_pegawai" name="nama_pegawai" value="<?php echo $hasil['nama'] ?> " readonly>
                                <input type="hidden" class="form-control" id="id_pegawai" name="id_pegawai" value="<?php echo $pegawai['id_pegawai'] ?> " readonly>

                            </div> <!-- <div class="form-group">
                            <label class="control-label col-sm-4">Nama Pegawai</label>
                            <div class="col-sm-4">
                                <select name="id_pegawai" class="form-control" required>
                                    <option selected>Pilih Nama Pegawai</option>

                                    <?php
                                    $query = mysqli_query($conn, 'SELECT * FROM pegawai');
                                    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                    ?>



                                    <?php foreach ($result as $result) : ?>
                                        <option value="<?php echo $result["id_pegawai"]; ?>">
                                            <?php echo $result["nama_pegawai"]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div> -->

                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4">Jenis Cuti</label>
                            <div class="col-sm-4">
                                <select name="id_jeniscuti" class="form-control" required>
                                    <option selected>Pilih Jenis Cuti</option>

                                    <?php
                                    $query = mysqli_query($conn, 'SELECT * FROM jeniscuti');
                                    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                    ?>



                                    <?php foreach ($result as $result) : ?>
                                        <option value="<?php echo $result["id_jeniscuti"]; ?>" <?php echo $data['id_jeniscuti'] == $result["id_jeniscuti"] ? 'selected' : ''; ?>>
                                            <?php echo $result["nama_jenis"]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- ... (kode lainnya) ... -->
                        <div class="form-group">
                            <label class="control-label col-sm-4">Mulai Cuti</label>
                            <div class="col-sm-4">
                            <?php
                                // Mengubah format tanggal dari YYYY-MM-DD menjadi MM/DD/YYYY
                                $formatted_date = date("m/d/Y", strtotime($data['tanggal_mulai']));
                                ?>
                                <input type="date" name="mulai" class="form-control" value="<?php echo date('Y-m-d', strtotime($formatted_date)); ?>" required>
                                <small class="form-text text-muted">Format: <?php echo $now_indonesia; ?></small>
                                <input type="hidden" name="now" class="form-control" value="<?php echo $now; ?>" required>
                                <input type="hidden" name="npp" class="form-control" value="<?php echo $npp; ?>" required>
                            </div>
                        </div>
                        <!-- ... (kode lainnya) ... -->

                        <div class="form-group">
                            <label class="control-label col-sm-4">Akhir Cuti</label>
                            <div class="col-sm-4">
                                <?php
                                // Mengubah format tanggal dari YYYY-MM-DD menjadi MM/DD/YYYY
                                $formatted_date = date("m/d/Y", strtotime($data['tanggal_selesai']));
                                ?>

                                <!-- Input dengan format yang diinginkan -->
                                <input type="date" name="akhir" class="form-control" value="<?php echo date('Y-m-d', strtotime($formatted_date)); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-4">Tanggal Kembali</label>
                            <div class="col-sm-4">
                            <?php
                                // Mengubah format tanggal dari YYYY-MM-DD menjadi MM/DD/YYYY
                                $formatted_date = date("m/d/Y", strtotime($data['tanggal_kembali']));
                                ?>
                                <input type="date" name="tanggal_kembali" class="form-control" value="<?php echo date('Y-m-d', strtotime($formatted_date)); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-4">Keperluan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="keperluan" name="keperluan" value="<?php echo $data['keperluan'] ?> " required>
                            </div>
                        </div>


                        <div>
                            <div>

                                <button type="submit" class="btn btn-primary" name="ubah">Simpan</button>
                            </div>

                            <?php
      if (isset($_POST['ubah'])) {

        $id = $_POST['id_pegawai'];
        $datax = mysqli_query($conn, "select * from pegawai where id_pegawai='$id'");
$result = mysqli_fetch_array($datax);
        $nama = $result['nama_pegawai'];
        $idjc = $_POST['id_jeniscuti'];
        $mulai = $_POST['mulai'];
        $akhir = $_POST['akhir'];
        $kembali = $_POST['tanggal_kembali'];
        $keperluan = isset($_POST['keperluan']) ? $_POST['keperluan'] : '';
        // $status = "Diajukan";
        
        $start = new DateTime($mulai);
        $finish = new DateTime($akhir);
        $int = $start->diff($finish);
        $dur = $int->days;
        $durasi = $dur;


        $update = mysqli_query($conn,  "UPDATE  `cuti` SET `id_pegawai`='$id',`id_jeniscuti`='$idjc',
        `nama_pegawai`='$nama',`tanggal_mulai`='$mulai',`tanggal_selesai`='$akhir',`tanggal_kembali`='$kembali',
        `keperluan`='$keperluan' WHERE id_cuti=$id_cuti ;");
        

        if ($update) {
          echo "<script>
          Swal.fire({
            title: 'Edit cuti?',
            text: 'Data berhasil di edit',
            icon: 'success'
          }).then((result)=>{
        document.location='cutiwaiting.php';
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