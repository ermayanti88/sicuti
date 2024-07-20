<?php
include 'koneksi.php';
// deskripsi halaman
$pagedesc = "Menunggu Approval";
include("layout_top.php");
include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");

// echo var_dump($hasil);die;
?>
<link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">
<!-- Page Content -->
<!DOCTYPE html>
<html lang="en">
<head>
<style>
        #searchButton {
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        #searchButton:hover {
            background-color: darkgreen;
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
</head>
<body>
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row" style="background-color: #F2F3F5; color: black;">
        <div class="col-lg-12" style="background-color: #EEF0F0; color: black;">
          <h1 class="page-header">
            <a href="#" style="color: black; text-decoration: none;">
              <span style="font-size: 1em;">Data Menunggu Laporan</span>
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
              <div class="row">
                <input type="date" id="tanggalMulai" name="tanggalMulai">
                <input type="date" id="tanggalSelesai" name="tanggalSelesai">
                <button type="button" id="searchButton">Cari</button>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="example">
                  <thead class="thead-light" style="background-color: #EEF0F0; color: black;">
                    <tr>
                      <th width="1%">No</th>
                      <th width="10%">No Cuti</th>
                      <th width="15%">Id Pegawai</th>
                      <th width="15%">Nama Pegawai</th>
                      <th width="15%">Nama Jenis Cuti</th>
                      <th width="5%">Tanggal Mulai</th>
                      <th width="10%">Tanggal Selesai</th>
                      <th width="5%">Tanggal Kembali</th>
                      <th width="5%">Lama Cuti</th>
                      <th width="5%">Keperluan</th>
                      <th width="5%">Status</th>
                      <th width="5%">Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $res = "SELECT cuti.*, pegawai.*, jeniscuti.nama_jenis
                    FROM cuti
                    INNER JOIN pegawai ON cuti.id_pegawai=pegawai.id_pegawai
                    INNER JOIN jeniscuti ON cuti.id_jeniscuti=jeniscuti.id_jeniscuti 
                    WHERE cuti.status = 'Diajukan'";
                    $query = mysqli_query($conn, $res);
                    $results = mysqli_fetch_all($query, MYSQLI_ASSOC); // Menggunakan $results sebagai array hasil
                    $nomor = 1;
                    foreach ($results as $result) : ?>
                      <tr>
                        <th scope="row"><?php echo $nomor; ?></th>
                        <td><?= $result["id_cuti"]; ?></td>
                        <td><?= $result["id_pegawai"]; ?></td>
                        <td><?= $result["nama_pegawai"]; ?></td>
                        <td><?= $result["nama_jenis"]; ?></td>
                        <td><?= $result["tanggal_mulai"]; ?></td>
                        <td><?= $result["tanggal_selesai"]; ?></td>
                        <td><?= $result["tanggal_kembali"]; ?></td>
                        <td><?= $result["lama_cuti"]; ?></td>
                        <td><?= $result["keperluan"]; ?></td>
                        <td class='text-danger'><?= $result["status"]; ?></td>
                        <td class="text-center">
                          <?php
                          $ket = $result['keterangan'];
                          $st = $result['status'];

                          if($st == 'Diajukan' && $ket == ''){
                          ?>
                            <a href="alasan_tolak.php?id=<?= $result["id_cuti"];?>" class="btn btn-danger btn-sm " style="margin-bottom: 5px;" onclick="return confirm('apakah anda yakin menolak cuti <?= $result['nama_pegawai']; ?>')">Tolak</a>
                            <a href="terima_cuti.php?id=<?= $result["id_cuti"];?>" class="btn btn-primary btn-sm">Terima</a> 
                          <?php
                          }
                          else{
                            if($st == 'Diajukan'){
                                echo 'Diajukan';
                            }else{
                            ?>
                              <a href="cetak.php?id_cuti=<?= $result['id_cuti']; ?>" class="btn btn-warning btn-xs">CETAK</a>
                            <?php
                            }
                          }
                          ?>
                        </td>
                      </tr>
                    <?php 
                      $nomor++; // Tingkatkan nomor setiap iterasi
                    endforeach; ?>
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
        $(document).ready(function() {
          $('#example').DataTable();
          
          $('#searchButton').on('click', function() {
            var tanggalMulai = $('#tanggalMulai').val();
            var tanggalSelesai = $('#tanggalSelesai').val();
            var table = $('#example').DataTable();
            table.columns(5).search(tanggalMulai);
            table.columns(6).search(tanggalSelesai);
            table.draw();
          });
        });
      </script>
    </div>
  </div>
</body>
</html>
