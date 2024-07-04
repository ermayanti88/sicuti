<?php
include 'koneksi.php';

// deskripsi halaman
$pagedesc = "Data Karyawan";
include("layout_top.php");
include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");
?>
<link href="libs/images/logopemko.JPG" rel="icon" type="images/x-icon">
<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Data Sub Unit Kerja</h1>
      </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->

   
    <div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
						
            <a href="tambah_bidang.php" class="btn btn-success" style="margin-bottom: 10px;">Tambah</a>
	
            <table class="table table-bordered" id="example">
              <thead class="thead-light" style="background-color: #898E94; color: white;">
                <tr>
                
                  <th width="1%">No</th>

                  <th width="25%">Nama Bidang</th>
                  <th width="5%">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $nomor = 1; ?>
                <?php

                $query = mysqli_query($conn, 'SELECT * FROM bidang');
                $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
                ?>

                <?php foreach ($result as $result) : ?>
                  <tr>

                    <th scope="row"><?php echo $nomor; ?></th>
                    <td><?php echo $result["nama_bidang"]; ?></td>


                    <td>
                    <a href="edit_bidang.php?id_bidang=<?php echo $result['id_bidang'] ?>" class="btn btn-warning btn-xs">Edit</a>


                      <a href="hapus_bidang.php?id_bidang=<?php echo $result['id_bidang'] ?>" class="btn btn-danger btn-xs">Hapus</a>


                    </td>
                  </tr>
                  <?php $nomor++; ?>
                <?php endforeach; ?>

          </div>

          </tbody>
          </table>
        </div>




      </div>
      <!-- Akhir Menu -->


      <!-- Awal Footer -->
      <hr class="footer">


      <!-- Akhir Footer -->





      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     
     
      
      <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
   
      <script>
        $(document).ready(function() {
          $('#example').DataTable();
        });
      </script>
      </body>

      </html>
      <?php  ?>