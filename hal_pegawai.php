<?php
include 'koneksi.php';
include 'bulanGrafik.php';

$arrayBulan = [Januari(), Februari(), Maret(), April(), Mei(),Juni(),Juli(),Agustus(),September(), Oktober(), November(), Desember()];
$gabung = implode(",", $arrayBulan);


	// query database mencari data admin
	$sql_e = "SELECT id_cuti FROM cuti WHERE status='Diajukan'";
	$ress_e = mysqli_query($conn, $sql_e);
	$e = mysqli_num_rows($ress_e);
	
	$sql_ter = "SELECT id_cuti FROM cuti WHERE status='Diterima'";
	$ress_ter = mysqli_query($conn, $sql_ter);
	$terima = mysqli_num_rows($ress_ter);
	
	$sql_tolak = "SELECT id_cuti FROM cuti WHERE status='Ditolak'";
	$ress_tolak = mysqli_query($conn, $sql_tolak);
	$tolak = mysqli_num_rows($ress_tolak);
	
	// deskripsi halaman
	$pagedesc = "Beranda";
	include("layout_top1.php");
?>
<link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">

<div id="page-wrapper">
            <div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<form class="form-horizontal">
							<div class="panel panel-default">
								<div class="panel-body">
								<h2 align="center">Selamat Datang !</h2>
								<center><img src="foto/admin.png" width="120px"></center>
								<hr/>
								</div>
							</div><!-- /.panel -->
						</form>
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-lg-4 col-md-4">
					<div class="panel panel-yellow">
						
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-check-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $e; ?></div>
										<div><h4>Diajukan</h4></div>
									</div>
								</div>
							</div>

							<a href="cutisetuju.php">
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div><!-- /.panel-green -->
					

					<div class="row">
					<div class="col-lg-4 col-md-4">
					<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-plus-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $terima; ?></div>
										<div><h4>Disetujui</h4></div>
									</div>
								</div>
							</div>
							<a href="cutiwaiting.php">
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div><!-- /.panel-green -->
					<div class="row">
					<div class="col-lg-4 col-md-4">
						<div class="panel panel-red">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-minus-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $tolak; ?></div>
										<div><h4>Di Tolak</h4></div>
									</div>
								</div>
							</div>
							<a href="cutiditolak.php">
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
<!--     
</div>
            </div>
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
					backgroundColor: '#A94442',
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
        </div>
	 -->
<!-- bottom of file -->
<?php
	include("layout_bottom.php");
?>
