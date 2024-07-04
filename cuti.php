<?php
session_start();
include 'koneksi.php';

// deskripsi halaman
$pagedesc = "Data Pegawai";
include("layout_top1.php");
$now = date('d-m-Y');

// session_start();   

$username=$_SESSION['login_user'];
$cek_data = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
		  
$hasil = mysqli_fetch_array($cek_data);
// Memeriksa apakah ada hasil yang ditemukan
if ($hasil !== null) 
{
    $query = mysqli_query($conn, "SELECT * FROM pegawai WHERE id_user = ".$hasil['id_user']);
		  
    $pegawai  = mysqli_fetch_array($query);
    // echo var_dump($pegawai);die;
}
// echo var_dump($hasil);die;

?>

<link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">

<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pengajuan Cuti</h1>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form class="form-horizontal" name="cuti" action="tambahkan_cuti.php" method="POST" enctype="multipart/form-data" onSubmit="return valid();">
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
                                <input type="text" class="form-control" id="id_pegawai" name="nama_pegawai" value="<?php echo $hasil['nama']?> " readonly>
                            <input type="hidden" class="form-control" id="id_pegawai" name="id_pegawai" value="<?php echo $pegawai['id_pegawai']?> " readonly>
                        
</div>    <!-- <div class="form-group">
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
                                        <option value="<?php echo $result["id_jeniscuti"]; ?>">
                                            <?php echo $result["nama_jenis"]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- ... (kode lainnya) ... -->
                        <div class="form-group">
                            <label class="control-label col-sm-4">Mulai Cuti</label>
                            <div class="col-sm-4">
                                <input type="date" name="mulai" class="form-control" required>
                             
                                <input type="hidden" name="now" class="form-control" value="<?php echo $now; ?>" required>
                                <input type="hidden" name="npp" class="form-control" value="<?php echo $npp; ?>" required>
                            </div>
                        </div>
                        <!-- ... (kode lainnya) ... -->


                        <div class="form-group">
                            <label class="control-label col-sm-4">Akhir Cuti</label>
                            <div class="col-sm-4">
                                <input type="date" name="akhir" class="form-control" required>
                            </div>
                        </div>
 
                        <!-- <div class="form-group">
                            <label class="control-label col-sm-4">Tanggal Kembali</label>
                            <div class="col-sm-4">
                                <input type="date" name="tanggal_kembali" class="form-control" required> -->
                            <!-- </div>  -->
                        <!-- </div>  -->

                        <div class="form-group">
                            <label class="control-label col-sm-4">Keperluan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="keperluan" name="keperluan" require>
                            </div>
                        </div>

                        <div style="text-align:center; margin-bottom:5px;">

<button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
</div>
                        <div>
                           <br><br>

                        </div>
                    </div><!-- /.panel -->
                </form>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
<!-- bottom of file -->
<?php
include("layout_bottom.php");
?>