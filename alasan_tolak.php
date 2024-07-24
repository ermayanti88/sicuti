<?php
session_start();
include 'koneksi.php';

// deskripsi halaman
$pagedesc = "Data Pegawai";
include("layout_top1.php");
$now = date('d-m-Y');

$id = $_GET['id'];

if ($id !== null) 
{
    // Query untuk mengambil data cuti dan data pegawai
    $query = mysqli_query($conn, "SELECT cuti.*, pegawai.nama_pegawai, pegawai.id_pegawai 
                                  FROM cuti 
                                  INNER JOIN pegawai ON cuti.id_pegawai = pegawai.id_pegawai 
                                  WHERE cuti.id_cuti = " . $id);
		  
    $pegawai = mysqli_fetch_array($query);
}
?>

<link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">

<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Penolakan Cuti</h1>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form class="form-horizontal" name="cuti" action="tolak_cuti.php" method="POST" enctype="multipart/form-data" onSubmit="return valid();">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>Form Penolakan Cuti</h3>
                        </div>
                        <br>
                        <input type="hidden" class="form-control" name="mulai" value="<?php echo $pegawai['tanggal_mulai'];?>" >
                        <input type="hidden" class="form-control" name="akhir" value="<?php echo $pegawai['tanggal_selesai'];?>" >
                        <input type="hidden" class="form-control" name="id_jeniscuti" value="<?php echo $pegawai['id_jeniscuti'];?>" >
                        <input type="hidden" class="form-control" name="keperluan" value="<?php echo $pegawai['keperluan'];?>" >
                        <input type="hidden" class="form-control" name="id_cuti" value="<?php echo $pegawai['id_cuti'];?>" >
                        <div class="form-group">
                            <label class="control-label col-sm-4">Nama Pegawai</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="id_pegawai" name="nama_pegawai" value="<?php echo $pegawai['nama_pegawai']?>" readonly>
                                <input type="hidden" class="form-control" id="id_pegawai" name="id_pegawai" value="<?php echo $pegawai['id_pegawai']?>" readonly>
                            </div>    
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-4">Alasan Penolakan : </label>
                            <div class="col-sm-4 form-check">
                                <input type="checkbox" name="keterangan[]" value="Tanggal sama dengan Pegawai lain" class="form-check-input"> Tanggal Bentrok
                                <input type="checkbox" name="keterangan[]" value="Masa cuti telah habis" class="form-check-input"> Masa cuti habis
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
