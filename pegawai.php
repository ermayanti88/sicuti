<?php
include 'koneksi.php';

// deskripsi halaman
$pagedesc = "Data Pegawai";
include("layout_top.php");
include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");
?>
<link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">
<!-- Page Content -->
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- ... tag-tag lainnya ... -->
  <style>
    /* Gaya untuk warna baris ganjil */
    tbody tr:nth-child(odd) {
      background-color: #f2f2f2;
    }

    /* Gaya untuk warna baris genap */
    tbody tr:nth-child(even) {
      background-color: #ffffff;
    }

    .panel-body {
      overflow-x: auto; /* Tambahkan ini untuk scroll horizontal jika tabel terlalu lebar */
    }

    .table-responsive {
      width: 100%;
      margin-bottom: 15px;
      overflow-x: auto;
      overflow-y: hidden;
      -ms-overflow-style: -ms-autohiding-scrollbar;
      border: 1px solid #ddd;
      -webkit-overflow-scrolling: touch;
    }
  </style>
  <!-- ... tag-tag lainnya ... -->
</head>
<body>
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
      </div><!-- /.row -->

      <div class="row">
        <div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-body">
              <a href="tambah_pegawai.php" class="btn btn-success" style="margin-bottom: 10px;">Tambah</a>
              <div class="table-responsive">
                <table class="table table-bordered" id="example">
                  <thead class="thead-light" style="background-color: #EEF0F0; color: black;">
                    <tr>
                      <th width="1%">No.</th>
                      <th width="20%">Nama Pegawai</th>
                      <th width="5%">NIP</th>
                      <th width="10%">Sub Unit Kerja</th>
                      <th width="5%">Jabatan</th>
                      <th width="5%">Unit kerja</th>
                      <th width="3%">Pangkat</th>
                      <th width="15%">Alamat</th>
                      <th width="10%">Jenis Kelamin</th>
                      <th width="1%">No Telepon</th>
                      <th width="5%">Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $nomor = 1;
                    $query = mysqli_query($conn, '
                      SELECT pegawai.*, bidang.nama_bidang, jabatan.nama_jabatan
                      FROM pegawai
                      INNER JOIN bidang ON pegawai.id_bidang=bidang.id_bidang
                      INNER JOIN jabatan ON pegawai.id_jabatan=jabatan.id_jabatan
                    ');
                    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
                    foreach ($result as $row) :
                    ?>
                      <tr>
                        <th scope="row"><?= $nomor; ?></th>
                        <td><?= $row["nama_pegawai"]; ?></td>
                        <td><?= is_numeric($row["NIP"]) ? $row["NIP"] : '0'; ?></td>
                        <td><?= $row["nama_bidang"]; ?></td>
                        <td><?= $row["nama_jabatan"]; ?></td>
                        <td><?= $row["unit_kerja"]; ?></td>
                        <td><?= $row["pangkat"]; ?></td>
                        <td><?= $row["alamat"]; ?></td>
                        <td><?= $row["jenis_kelamin"]; ?></td>
                        <td><?= is_numeric($row["no_telp"]) ? $row["no_telp"] : '0'; ?></td>
                        <td>
                          <a href="edit_pegawai.php?id_pegawai=<?= $row['id_pegawai']; ?>" class="btn btn-warning btn-xs mr-2">Edit</a>
                          <a href="#" onClick="hapus(<?= $row['id_pegawai']; ?>)" class="btn btn-danger btn-xs mr-2">Hapus</a>
                        </td>
                      </tr>
                      <?php $nomor++; ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Awal Footer -->
      <hr class="footer">
      <!-- Akhir Footer -->

      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
      <script>
        function hapus(id_pegawai) {
          if (confirm("Yakin ingin mehapus data?")) {
            window.location.href = "hapus_pegawai.php?id_pegawai=" + id_pegawai;
          }
        }

        $(document).ready(function() {
          $('#example').DataTable();
        });
      </script>
    </div>
  </div>
</body>
</html>
