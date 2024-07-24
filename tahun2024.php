<?php
session_start();
include 'koneksi.php';

// deskripsi halaman
$pagedesc = "Rekapan Sisa Cuti";
include("layout_top.php");
include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");

$username = $_SESSION['login_user'];
$cek_data = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

$hasil = mysqli_fetch_array($cek_data);
// Memeriksa apakah ada hasil yang ditemukan
if ($hasil !== null) {
    $query = mysqli_query($conn, "SELECT * FROM pegawai WHERE id_user = " . $hasil['id_user']);
    $pegawai = mysqli_fetch_array($query);
}

function hitung_sisa_cuti($conn, $id_pegawai, $tahun) {
    // Jumlah cuti tahunan
    $cuti_tahunan = 12;

    // Hitung total cuti yang telah diambil di tahun ini
    $sql = "SELECT SUM(lama_cuti) as total_cuti FROM cuti WHERE id_pegawai = '$id_pegawai' AND YEAR(tanggal_mulai) = '$tahun' AND keterangan = 'Verifikasi Kadis'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
    $total_cuti_diambil = $data['total_cuti'] ?: 0; // Pastikan menggunakan default value 0 jika null

    // Hitung sisa cuti
    $sisa_cuti = $cuti_tahunan - $total_cuti_diambil;
    return $sisa_cuti;
}

$tahun_sekarang = date('Y');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pagedesc; ?></title>
    <link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">
    <style>
        #page-wrapper {
            width: 100%;
            height: 100%;
            padding: 40px;
            margin: 0 auto;
            box-sizing: border-box;
        }
        .panel-body {
            padding-left: 210px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .page-header {
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Rekapan Sisa Cuti Tiap Tahunnya</h1>
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
                        $Sql = "SELECT pegawai.*, user.username, jabatan.nama_jabatan
                                FROM pegawai
                                INNER JOIN user ON pegawai.id_user = user.id_user
                                INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan";
                        $Qry = mysqli_query($conn, $Sql);
                    ?>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tabel-data">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th width="15%">Nama Pegawai</th>
                                        <th width="10%">NIP</th>
                                        <th width="15%">Jabatan</th>
                                        <th width="15%">Sisa cuti ditahun 2023</th>
                                        <th width="10%">Cuti tahun 2024</th>
                                        <th width="10%">Rekap Jumlah Cuti 2024</th>
                                        <th width="10%">Sisa Cuti 2024</th>
                                        <th width="15%">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
$i = 1;
while ($data = mysqli_fetch_array($Qry)) {
    $id_pegawai = $data['id_pegawai'];

    // Query untuk menghitung total cuti yang sudah diambil oleh pegawai di tahun ini
    $query_total_cuti = mysqli_query($conn, "SELECT SUM(lama_cuti) AS total_cuti FROM cuti WHERE id_pegawai = $id_pegawai AND YEAR(tanggal_mulai) = '$tahun_sekarang' AND keterangan = 'Verifikasi Kadis'");
    $result_total_cuti = mysqli_fetch_array($query_total_cuti);
    $total_cuti_diambil = $result_total_cuti['total_cuti'] ?: 0;

    $sisa_cuti = hitung_sisa_cuti($conn, $id_pegawai, $tahun_sekarang);

    // Tentukan kalimat keterangan berdasarkan sisa cuti
    if ($sisa_cuti > 0) {
        $keterangan = "Masih tersisa " . $sisa_cuti . " hari cuti untuk tahun ini.";
    } else {
        $keterangan = "Tidak tersisa cuti untuk tahun ini.";
    }

    echo '<tr>';
    echo '<td class="text-center">' . $i . '</td>';
    echo '<td>' . $data['nama_pegawai'] . '</td>';
    echo '<td>' . $data['NIP'] . '</td>';
    echo '<td>' . $data['nama_jabatan'] . '</td>';
    echo '<td class="text-center">12</td>'; // Cuti tahunan tetap 12
    echo '<td class="text-center">12</td>'; // Cuti tahunan tetap 12
    echo '<td class="text-center">' . $total_cuti_diambil . '</td>'; // Jumlah lama cuti yang sudah diambil per orang
    echo '<td class="text-center">' . $sisa_cuti . '</td>'; // Rekapan cuti (12 - jumlah lama cuti yang sudah diambil per orang)
    echo '<td class="text-center">' . $keterangan . '</td>'; // Keterangan berdasarkan sisa cuti
    echo '</tr>';
    $i++;
}
?>

                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.panel-body -->
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
