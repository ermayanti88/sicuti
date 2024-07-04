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
<link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">
<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Data Cuti Yang Ditolak</h1>
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
						$where =" and cuti.id_pegawai =".$pegawai['id_pegawai'];
						$sy = '';
                    }else {
						$sy = " AND cuti.keterangan ='Masih ada pekerjaan'";
                        $where ="";
                    }
						$Sql = "SELECT cuti.*, pegawai.*, jeniscuti.nama_jenis
												FROM cuti
												INNER JOIN pegawai ON cuti.id_pegawai=pegawai.id_pegawai 
												INNER JOIN jeniscuti ON cuti.id_jeniscuti=jeniscuti.id_jeniscuti 
												WHERE cuti.status = 'Ditolak' $sy $where;"; 
						$Qry = mysqli_query($conn, $Sql);
						?>



						<table class="table table-striped table-bordered table-hover" id="tabel-data">
							<thead>
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
									<th width="5%">Keterangan</th>
									
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
									echo '<td class="text-center text-danger "> <b>' . $data['status'] . '</b></td>';
									echo '<td class="text-center "> <b>' . $data['keterangan'] . '</b></td>';
									

									echo '</tr>';
									$i++;

									// var_dump($data['keterangan']);die;
								}
								?>
							</tbody>
						</table>
					</div>
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
<!-- bottom of file -->
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