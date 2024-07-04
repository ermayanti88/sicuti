<?php
    include 'koneksi.php';
    
    // deskripsi halaman
    $pagedesc = "Data Karyawan";
    include("layout_top.php");
    include("dist/function/format_tanggal.php");
    include("dist/function/format_rupiah.php");
?>
	<link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">
<!-- Bagian awal file -->
<!-- Konten Halaman -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data Jenis Cuti</h1>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="tambah_jeniscuti.php" class="btn btn-success" style="margin-bottom: 10px;">Tambah</a>

                        <table class="table table-bordered" id="example">
                            <thead class="thead-light" style="background-color: #898E94; color: white;">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Jenis</th>
                                    <th scope="col">Maks Hari</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor=1; ?>
                                <?php 
                                    $query = mysqli_query($conn, 'SELECT * FROM jeniscuti');
                                    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                ?>

                                <?php foreach($result as $result) : ?>
                                    <tr>
                                        <th scope="row"><?php echo $nomor; ?></th>
                                        <td><?php echo $result["nama_jenis"]; ?></td>
                                        <td><?php echo $result["maks_hari"]; ?></td>
                                        <td>
                                            <a href="edit_jeniscuti.php?id_jeniscuti=<?php echo $result['id_jeniscuti'] ?>" class="btn btn-warning btn-xs">Edit</a>
                                            <a href="hapus_jeniscuti.php?id_jeniscuti=<?php echo $result['id_jeniscuti'] ?>" class="btn btn-danger btn-xs">Hapus</a>
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
    <!-- Akhir Menu -->
    
    <!-- Awal Footer -->
    <hr class="footer">
    <!-- Akhir Footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery dulu, kemudian Popper.js, kemudian Bootstrap JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        // Tambahkan skrip validasi
        $(document).on('submit', '#yourFormId', function() {
            var maksHari = $('#maksHariInput').val();

            if (!$.isNumeric(maksHari)) {
                alert('Maks Hari harus diisi dengan angka');
                return false;
            }
        });
    </script>
  </body>
</html>
<?php  ?>
