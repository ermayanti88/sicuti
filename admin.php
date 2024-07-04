
<?php
include 'koneksi.php';
include 'bulanGrafik.php';
session_start();
$login = $_SESSION['login_user'];
if(!$login){
	echo "
	<script>
	document.location.href='index.php';
	</script>
	";
	die;
}



$arrayBulan = [Januari(), Februari(), Maret(), April(), Mei(),Juni(),Juli(),Agustus(),September(), Oktober(), November(), Desember()];
$gabung = implode(",", $arrayBulan);

	
	// query database mencari data admin
	$sql_e = "SELECT NIP FROM pegawai";
	$ress_e = mysqli_query($conn, $sql_e);
	$e = mysqli_num_rows($ress_e);
	
	$sql_bidang = "SELECT id_bidang FROM bidang";
	$ress_bidang = mysqli_query($conn, $sql_bidang);
	$bidangq = mysqli_num_rows($ress_bidang);

	
	$sql_jabatan = "SELECT id_jabatan FROM jabatan";
	$ress_jabatan = mysqli_query($conn, $sql_jabatan);
	$jabatanq = mysqli_num_rows($ress_jabatan);
	
	
	$sql_jabatan = "SELECT id_jabatan FROM jabatan";
	$ress_jabatan = mysqli_query($conn, $sql_jabatan);
	$jabatanq = mysqli_num_rows($ress_jabatan);
	
	$sql_jc = "SELECT id_jeniscuti FROM jeniscuti";
	$ress_jc = mysqli_query($conn, $sql_jc);
	$jc = mysqli_num_rows($ress_jc);
	
// 	$queryJanuari = "SELECT COUNT(*) AS jumlah_cuti 
// FROM cuti WHERE MONTH(tanggal_mulai) = 1 AND YEAR(tanggal_mulai) = YEAR(CURRENT_DATE) 
//   AND status = 'Diterima';
// ";

	



	
	// $sql_bidang = "SELECT id_bidang FROM verifikasi WHERE status='Menunggu APproval HRD'";
	// $ress_wait = mysqli_query($conn, $sql_wait);
	// $wait = mysqli_num_rows($ress_wait);
	
	// deskripsi halaman
	$pagedesc = "Beranda";
	include("layout_top.php");
?>
	<link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">

<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Beranda</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
				
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-check-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $e; ?></div>
										<div><h4>Jumlah Data Pegawai Aktif</h4></div>
									</div>
								</div>
							</div>
							<a href="pegawai.php">
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div><!-- /.panel-green -->
					

					<div class="col-lg-6 col-md-6">
						<div class="panel panel-yellow">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-plus-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $bidangq; ?></div>
										<div><h4>Data Sub Unit Kerja</h4></div>
									</div>
								</div>
							</div>
							<a href="bidang.php">
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div><!-- /.panel-green -->


					<div class="col-lg-6 col-md-6">
						<div class="panel panel-success">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-plus-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $jabatanq; ?></div>
										<div><h4>Data Jabatan</h4></div>
									</div>
								</div>
							</div>
							<a href="jabatan.php">
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div><!-- /.panel-green -->

					<div class="col-lg-6 col-md-6">
						<div class="panel panel-danger">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-plus-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $jc; ?></div>
										<div><h4>Data Jenis Cuti</h4></div>
									</div>
								</div>
							</div>
							<a href="jenis_cuti.php">
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div><!-- /.panel-green -->


				</div><!-- /.row -->
            </div><!-- /.container-fluid -->
			<div class="contaner-fluid">
				<div>
  					<canvas id="myChart"></canvas>
				</div>

				<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

			<script>
			const ctx = document.getElementById('myChart');

			new Chart(ctx, {
				type: 'bar',
				data: {
				labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus','September','November','Desember'],
				datasets: [{
					label: 'Cuti Diterima',
					data: [<?= $gabung; ?>],
					backgroundColor: '#24115a',
					borderWidth: 1
				}]
				},
				options: {
				scales: {
					y: {
					beginAtZero: true
					}
				}
				}
			});
			</script>
			</div>
        </div><!-- /#page-wrapper -->
<!-- bottom of file -->
<?php
	include("layout_bottom.php");
?>