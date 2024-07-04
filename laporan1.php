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

    <div class="row">
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
            </form>

            <table class="table table-bordered" id="tabel-data" >
              <thead class="thead-light" style="background-color: #EEF0F0; color: black;">
                <tr>
                  <th width="1%">No</th>
                  <th width="10%">No Cuti</th>
                  <th width="15%">Id Pegawai</th>
                  <th width="15%">Nama Pegawai</th>
                  <th width="15%">NIP</th>
                  <th width="15%">Pangkat</th>
                  <th width="15%">Sisa Cuti Tahun 2023</th>
                  <th width="15%">Rekapan cuti 2023</th>
                  <th width="5%">Sisa cuti</th>
                  <th width="10%">Keterangan</th>
                  <th width="5%">Opsi</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $nomor = 1;

              if(isset($_GET['submit'])) {
                $mulai = $_GET['mulai'];
                $selesai = $_GET['selesai'];

                $query = mysqli_query($conn, "
                  SELECT cuti.*, pegawai.*, jeniscuti.nama_jenis
                  FROM cuti
                  INNER JOIN pegawai ON cuti.id_pegawai=pegawai.id_pegawai
                  INNER JOIN jeniscuti ON cuti.id_jeniscuti=jeniscuti.id_jeniscuti
                  WHERE cuti.tanggal_mulai BETWEEN '$mulai' AND '$selesai'
                  AND cuti.tanggal_selesai BETWEEN '$mulai' AND '$selesai'
                ");
              } else {
                $query = mysqli_query($conn, '
                  SELECT cuti.*, pegawai.*, jeniscuti.nama_jenis
                  FROM cuti
                  INNER JOIN pegawai ON cuti.id_pegawai=pegawai.id_pegawai
                  INNER JOIN jeniscuti ON cuti.id_jeniscuti=jeniscuti.id_jeniscuti
                ');
              }

              $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

              foreach ($result as $data) :
              ?>
                <tr>
                  <td><?php echo $nomor; ?></td>
                  <td><?php echo $data["id_cuti"]; ?></td>
                  <td><?php echo $data["id_pegawai"]; ?></td>
                  <td><?php echo $data["nama_pegawai"]; ?></td>
                  <td><?php echo $data["NIP"]; ?></td>
                  <td><?php echo $data["pangkat"]; ?></td>
                  <td><?php echo $data["cuti2023"]; ?></td>
                  <td><?php echo $data["rekap2023"]; ?></td>
                  <td><?php echo $data["sisacuti2023"]; ?></td>
                  <td><?php echo $data["Keterangan"]; ?></td>
                  
                  <td class="text-center">
    <a href="cetak.php?id_cuti=<?php echo $data['id_cuti']; ?>" class="btn btn-warning btn-xs">CETAK</a>
</td>

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
