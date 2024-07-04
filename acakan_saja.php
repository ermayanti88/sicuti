<?php
include 'koneksi.php'; 
$pagedesc = "Menunggu Approval";
include("layout_top.php");
include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");

?>
<!-- HTML Code -->
<link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">
<head>
    <!-- CSS Style -->
</head>

<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row" style="background-color: #F2F3F5; color: black;">
      <div class="col-lg-12" style="background-color: #EEF0F0; color: black;">
      <h1 class="page-header">
    <a href="#" style="color: black; text-decoration: none;">
        <span style="font-size: 1em;">Master</span>
        <span style="font-size: 0.6em; color: gray;">Data Pegawai</span>
    </a>
</h1>
      </div><!-- /.col-lg-12 -->
    </div>

    <div class="row">
      <div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
    </div>

    <!-- <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">

            <form method="get" name="cari" onSubmit="return valid();">
              <div class="form-group">
                <div class="col-sm-4">
                  <label>Tanggal Mulai</label>
                  <input type="date" class="form-control" name="mulai" placeholder="From Date(dd/mm/yyyy)" required>
                </div>
                <div class="col-sm-4">
                  <label>Tanggal Selesai</label>
                  <input type="date" class="form-control" name="selesai" placeholder="To Date(dd/mm/yyyy)" required>
                </div>
                <div class="col-sm-4">
                  <label>&nbsp;</label><br/>
                  <input type="submit" name="submit" value="Lihat Laporan" class="btn btn-primary">
                </div>
              </div>
            </form> -->

            <table class="table table-bordered" id="tabel-data" >
              <thead class="thead-light" style="background-color: #337ab7; color: black;">
                <tr>
                <th rowspan="2" style="background-color: #337ab7; color: white;">No</th>
<th rowspan="2" style="background-color:#337ab7; color: white;">Nama Pegawai</th>
<th rowspan="2" style="background-color: #337ab7; color: white;">NIP</th>
<th rowspan="2" style="background-color: #337ab7; color: white;">Jabatan</th>
<th rowspan="2" style="background-color: #337ab7; color: white;">Cuti Tahun 2023</th>
<!-- <th colspan="12">Rekapan cuti 2023</th> -->
<th rowspan="2" style="background-color: #337ab7; color: white;">Rekapan Cuti 2023</th>
<th rowspan="2" style="background-color: #337ab7; color: white;">Sisa cuti 2023</th>
<th rowspan="2" style="background-color: #337ab7; color: white;">Keterangan</th>

<!-- </tr>
                  <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>10</th>
            <th>11</th>
            <th>12</th>
        </tr> -->
    
              </thead>
              <tbody>

              <?php
              $nomor = 1;

              if(isset($_GET['submit'])) {
                $mulai = $_GET['mulai'];
                $selesai = $_GET['selesai'];

                $query = mysqli_query($conn, "
                  SELECT cuti.*, pegawai.*, jabatan.nama_jabatan
                  FROM cuti
                  FROM cuti
                  INNER JOIN pegawai ON cuti.id_pegawai=pegawai.id_pegawai 
                  INNER JOIN jabatan ON pegawai.id_jabatan=jabatan.id_jabatan
                  WHERE cuti.tanggal_mulai BETWEEN '$mulai' AND '$selesai'
                  AND cuti.tanggal_selesai BETWEEN '$mulai' AND '$selesai'
                ");
              } else {
                $query = mysqli_query($conn, '
                  SELECT cuti.*, pegawai.*, jabatan.nama_jabatan
                  FROM cuti
                  INNER JOIN pegawai ON cuti.id_pegawai=pegawai.id_pegawai
                  INNER JOIN jabatan ON pegawai.id_jabatan=jabatan.id_jabatan
                ');
              }

              $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

              foreach ($result as $data) :
              ?>
                <tr>
                  <td ><?php echo $nomor; ?></td>
             
                  <td><?php echo $data["nama_pegawai"]; ?></td>
                  <td><?php echo $data["NIP"]; ?></td>
                  <td><?php echo $data["nama_jabatan"]; ?></td>
                  <td>12</td> <!-- Nilai tetap -->

                  <td><?php echo $data["lama_cuti"]; ?></td>
                  <td><?php echo 12 - $data["lama_cuti"]; ?></td>
                  <td></td>
                  
                  <!-- <td class="text-center">
    <a href="cetak.php?id_cuti=<?php echo $data['id_cuti']; ?>" class="btn btn-warning btn-xs">CETAK</a>
</td> -->

                </tr>

                <?php $nomor++; ?>
              <?php endforeach; ?>
              </tbody>
            </table>

            <hr class="footer">

            <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

            <script>
              $(document).ready(function() {
                $('#tabel-data').DataTable({
                  "responsive": true,
                  "processing": true,
                  "columnDefs": [
                    { "orderable": false, "targets": [4] }
                  ]
                });

                $('#tabel-data').parent().addClass("table-responsive");
              });
            </script>

            <script>
              var app = {
                code: '0'
              };
            </script>

            <?php
            include("layout_bottom.php");
            ?>
