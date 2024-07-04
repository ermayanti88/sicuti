<?php
session_start();
include 'koneksi.php';

// deskripsi halaman
$pagedesc = "Menunggu Approval";
include("layout_top.php");
include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");

$username = $_SESSION['login_user'];
$cek_data = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

$hasil = mysqli_fetch_array($cek_data);
// Memeriksa apakah ada hasil yang ditemukan
if ($hasil !== null) {
    $query = mysqli_query($conn, "SELECT * FROM pegawai WHERE id_user = " . $hasil['id_user']);

    $pegawai  = mysqli_fetch_array($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pagedesc; ?></title>
    <link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">
    <style>
        #page-wrapper {
            width: 100%; /* Atau ukuran yang diinginkan, misalnya 80%, 1000px, dll */
            height: 100%; /* Atau ukuran yang diinginkan, misalnya 600px, auto, dll */
            padding: 40px; /* Opsional: Untuk menambahkan jarak di dalam elemen */
            margin: 0 auto; /* Opsional: Untuk mengatur margin otomatis */
            box-sizing: border-box; /* Agar padding tidak menambah ukuran total elemen */
        }
        .panel-body {
            padding-left: 210px; /* Atau nilai yang diinginkan, misalnya 50px, 100px, dll */
        }
        .table-responsive {
            overflow-x: auto;
        }
        .page-header {
            text-align: center; /* Untuk menengahkan teks */
        }
    </style>
</head>
<body>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data Cuti Yang Diterima</h1>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                    <?php
                        $Sql = "SELECT cuti.*, pegawai.*, jeniscuti.nama_jenis
                                FROM cuti
                                INNER JOIN pegawai ON cuti.id_pegawai=pegawai.id_pegawai 
                                INNER JOIN jeniscuti ON cuti.id_jeniscuti=jeniscuti.id_jeniscuti 
                                WHERE cuti.keterangan = 'Verifikasi Kadis'";

                        $Qry = mysqli_query($conn, $Sql);
                    ?>

                        <div class="table-responsive">
							
                            <table class="table table-striped table-bordered table-hover" id="tabel-data">
                               
							<thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th width="1%">No Cuti</th>
                                        <th width="10%">Id Pegawai</th>
                                        <th width="15%">Nama Pegawai</th>
                                        <th width="15%">Nama Jenis Cuti</th>
                                        <th width="5%">Tanggal Mulai</th>
                                        <th width="10%">Tanggal Selesai</th>
                                        <th width="5%">Tanggal Kembali</th>
                                        <th width="5%">Lama Cuti</th>
                                        <th width="5%">Keperluan</th>
                                        <th width="5%">Status</th>
                                        <th colspan="3" width="1%">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($data = mysqli_fetch_array($Qry)) {
										
                                        echo '<tr>';
                                        echo '<td class="text-center">' . $i . '</td>';
                                        echo '<td class="text-center">' . $data['id_cuti'] . '</td>';
                                        echo '<td class="text-center">' . $data['id_pegawai'] . '</td>';
                                        echo '<td class="text-center">' . $data['nama_pegawai'] . '</td>';
                                        echo '<td class="text-center">' . $data['nama_jenis'] . '</td>';
                                        echo '<td class="text-center">' . $data['tanggal_mulai'] . '</td>';
                                        echo '<td class="text-center">' . $data['tanggal_selesai'] . '</td>';
                                        echo '<td class="text-center">' . $data['tanggal_kembali'] . '</td>';
                                        echo '<td class="text-center">' . $data['lama_cuti'] . '</td>';
                                        echo '<td class="text-center">' . $data['keperluan'] . '</td>';
                                        echo '<td class="text-center text-primary"><b>' .  $data['status']  . '</b></td>';
                                        echo '<td class="text-center">
                                            <a href="word.php?id_cuti=' . $data['id_cuti'] . '" target="_blank" class="btn btn-primary btn-xs">Unduh Draf</a>
                                            </td>
                                            <td class="text-center">
                                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                            <input type="file" class="custom-file-input" name="fileToUpload">
                                            </td>
                                            <td>
                                            <button type="submit" name="btn" class="btn btn-warning">Kirim</button>
                                            </form>
                                            </td>';
                                        echo '</tr>';
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.panel-body -->
                    <!-- Large modal -->
                    <div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p>Sedang memproses…</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.panel -->
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#tabel-data').DataTable({
            "responsive": true,
            "processing": true,
            "columnDefs": [{
                "orderable": false,
                "targets": []
            }]
        });

        $('#tabel-data').parent().addClass("table-responsive");
    });
</script>
<script>
    var app = {
        code: '0'
    };

    $('[data-load-code]').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var code = $this.data('load-code');
        if (code) {
            $($this.data('remote-target')).load('cuti_detail.php?code=' + code);
            app.code = code;
        }
    });
</script>

<?php
include("layout_bottom.php");
?>

</body>
</html>
