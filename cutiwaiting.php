

<?php
session_start();
include 'koneksi.php';

// deskripsi halaman
$pagedesc = "Menunggu Approval";
include("layout_top1.php");
include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");

$username=$_SESSION['login_user'];
$cek_data = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
		  
$hasil = mysqli_fetch_array($cek_data);
// Memeriksa apakah ada hasil yang ditemukan
if ($hasil !== null) 
{
    $query = mysqli_query($conn, "SELECT * FROM pegawai WHERE id_user = ".$hasil['id_user']);
		  
    $pegawai  = mysqli_fetch_array($query);
//    echo var_dump($pegawai);die;
}
// echo var_dump($hasil);die;

?>

<link href="libs/images/logopemko.JPG" rel="icon" type="images/x-icon">
<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Data Cuti Menunggu </h1>
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
					
                    if ($pegawai['id_pegawai']!= 32) {
						$stat = 'Diajukan';
						$where ="and cuti.id_pegawai =".$pegawai['id_pegawai'];
						$ket = '';
						$s = "SELECT cuti.*, pegawai.*, jeniscuti.nama_jenis
						FROM cuti
						INNER JOIN pegawai ON cuti.id_pegawai=pegawai.id_pegawai 
						INNER JOIN jeniscuti ON cuti.id_jeniscuti=jeniscuti.id_jeniscuti 
						WHERE cuti.status = '$stat' $where;"; 
                    }else {

						$stat = 'Diterima';
                        $where ="";
						$ket = 'Proses';

						if($stat == 'Diterima'){
							$stat = 'Diajukan';
						}
						$s = "SELECT cuti.*, pegawai.*, jeniscuti.nama_jenis
						FROM cuti
						INNER JOIN pegawai ON cuti.id_pegawai=pegawai.id_pegawai 
						INNER JOIN jeniscuti ON cuti.id_jeniscuti=jeniscuti.id_jeniscuti 
						WHERE cuti.status = '$stat' AND cuti.keterangan = '$ket'  $where;";
                    }
						
						$Sql = $s; 
						$Qry = mysqli_query($conn, $Sql);
						?>




						<table class="table table-striped table-bordered table-hover" id="tabel-data">
							<thead>
								<tr>
									<th width="1%">No</th>
									<th width="10%">No Cuti</th>
									<th width="15%">Nama Jenis Cuti</th>
									<th width="15%">Id Pegawai</th>
									<th width="15%">Nama Pegawai</th>
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
								
								$i = 1;
								while ($data = mysqli_fetch_array($Qry)) {
								
									echo '<tr>';
									echo '<td class="text-center">' . $i . '</td>';
									echo '<td class="text-center">' . $data['id_cuti'] . '</td>';
									echo '<td class="text-center">' . $data['nama_jenis'] . '</td>';
									echo '<td class="text-center">' . $data['id_pegawai'] . '</td>';
									echo '<td class="text-center">' . $data['nama_pegawai'] . '</td>';
									echo '<td class="text-center">' . $data['tanggal_mulai'] . '</td>';
									echo '<td class="text-center">' . $data['tanggal_selesai'] . '</td>';
									echo '<td class="text-center">' . $data['tanggal_kembali'] . '</td>';

									echo '<td class="text-center">' . $data['lama_cuti'] . '</td>';
									echo '<td class="text-center">' . $data['keperluan'] . '</td>';
									echo '<td class="text-center">' . $data['status'] . '</td>';
									?>
									
									<td class="text-center">
                      
									<?php
											 $status = $data['status'];
											 $ket = $data['keterangan'];
											 if ($pegawai['id_pegawai']!= 32) {

												$pros = '';
												$st = '';

											 }
											 else{
												
												$pros = 'Diajukan';
												$st = 'Proses';  
											 }

											 if($status == $pros && $ket == $st){
												 ?>
												   <a href="alasan_tolak_k.php?id=<?= $data["id_cuti"];?>" class="btn btn-danger btn-sm " style="margin-bottom: 5px;" >Tolak</a>
												   <a href="terima_cuti_d.php?id=<?= $data["id_cuti"];?>" class="btn btn-primary btn-sm">Terima</a> 
			   
											 <?php
											 }
											 else{
											   ?>
											   <a href="edit_cuti.php?id_cuti=<?= $data['id_cuti']; ?>" class="btn btn-warning btn-xs">Edit</a>
											   <?php
											 }
									 ?>
														 
									</td>
									<?php

									echo '</tr>';
									$i++;
								}
								?>
							</tbody>
						</table>
					</div>
					<!-- Large modal -->
				</div>
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
<!-- bottom of file -->

<form action="verifikasi.php" method="POST" enctype="multipart/form-data" onSubmit="return valid();"> 

<div class="modal fade" id="modalver" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
  <label>
    <input type="radio" name="status" value="Diterima"> Diterima
  </label>
  <br>
  <label>
    <input type="radio" name="status" value="Ditolak"> Ditolak
  </label>


      <div class="modal-footer" >
	  <input type="hidden" class="form-control" id="id_cuti" name="id_cuti" value="" readonly>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>

      </div>
    </div>
  </div>
</div>

</form>

<script type="text/javascript">
	function modal1(id){
		$('#modalver').modal({
        show: true,
        backdrop: 'static', // tambahkan ini
    }); 
		$('#id_cuti').val(id) 
	}
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