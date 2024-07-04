
<?php
	include'koneksi.php';
	
	// deskripsi halaman
	$pagedesc = "Data Karyawan";
	include("layout_top.php");
	include("dist/function/format_tanggal.php");
	include("dist/function/format_rupiah.php");
?>
		<link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">
<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> Data Hari Libur</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
				
                <div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
						
            <a href="tambahlibur.php" class="btn btn-success" style="margin-bottom: 10px;">Tambah</a>
	
            <table class="table table-bordered" id="example">
              <thead class="thead-light" style="background-color: #898E94; color: white;">
                <tr>


            <th scope="col">No.</th>
            <th scope="col">Tanggal Libur</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1; ?>
          <?php 
          
             $query = mysqli_query($conn, 'SELECT * FROM hari_libur');
          $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
          ?>

          <?php foreach($result as $result) : ?>
<tr>

<th scope="row"><?php echo $nomor; ?></th>
<td><?php echo $result["tanggal_libur"]; ?></td>
<td><?php echo $result["keterangan"]; ?></td>

             <td>
<a href="edit_libur.php?id_libur=<?php echo $result['id_libur'] ?>" class="btn btn-warning btn-xs">Edit</a>
             

              <a href="hapus_libur.php?id_libur=<?php echo $result['id_libur'] ?>" class="btn btn-danger btn-xs">Hapus</a>

            
             </td>
           </tr>
          <?php $nomor++; ?>
              <?php endforeach; ?>
            </div>
          </div>

        </tbody>
      </table>
    </div>
  <!-- Akhir Menu -->
     

  <!-- Akhir Footer -->



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  
    <script>
      $(document).ready(function() {
          $('#example').DataTable();
      } );
    </script>
  </body>
</html>
<?php  ?>