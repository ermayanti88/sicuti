<?php
function tanggalIndonesia($tanggal) {
    // Array bulan dalam bahasa Indonesia
    $bulanIndonesia = array(
        "January" => "Januari",
        "February" => "Februari",
        "March" => "Maret",
        "April" => "April",
        "May" => "Mei",
        "June" => "Juni",
        "July" => "Juli",
        "August" => "Agustus",
        "September" => "September",
        "October" => "Oktober",
        "November" => "November",
        "December" => "Desember"
    );

    // Mengonversi tanggal ke format bahasa Indonesia
    $tanggalArr = explode(' ', $tanggal);
    $tanggalIndonesia = $tanggalArr[0] . ' ' . $bulanIndonesia[$tanggalArr[1]] . ' ' . $tanggalArr[2];

    return $tanggalIndonesia;
}
function angkaToRomawi($angka) {
    $romawi = array('', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
    return $romawi[$angka];
}

// Contoh penggunaan
$tanggal = date("n"); // Mendapatkan angka bulan saat ini
$bulanRomawi = angkaToRomawi($tanggal);

// Output: "I" untuk bulan Januari, "II" untuk bulan Februari, dan seterusnya.



session_start();
include 'koneksi.php';

$id_cuti = $_GET['id_cuti'];
$Sql = "SELECT cuti.*, pegawai.*, jeniscuti.nama_jenis,jabatan.nama_jabatan
												FROM cuti
												INNER JOIN pegawai ON cuti.id_pegawai=pegawai.id_pegawai 
												INNER JOIN jeniscuti ON cuti.id_jeniscuti=jeniscuti.id_jeniscuti
												INNER JOIN jabatan ON pegawai.id_jabatan=jabatan.id_jabatan  
												WHERE cuti.id_cuti = '$id_cuti' ";
$Qry = mysqli_query($conn, $Sql);
$data = mysqli_fetch_array($Qry);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Politeknik Negeri Banjarmasin">

	<title><?= $data['nama_pegawai'] ?></title>
	<!-- <title>Sistem Informasi Cuti Pegawai DISKOMINFO - <?php echo $pagedesc ?></title> -->
	<link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">

	<style>
		body {
			text-align: center;
			font-size:1.4em;
		}

		#header-kop {
			margin: auto;
		}

		#body-of-report {
			margin: auto;
		}

		table {
			margin: auto;
			
		}

		h4 {
			text-align: center;
		}

		label {
			text-align: justify;
			display: block;
			width: 85%;
			margin-left: auto;
			margin-right: auto;
		}

		.center-label {
			display: block;
			text-align: center;
			margin: 0 auto;
		}
		.footer{
			display : flex;
			/* justify-content : center; */
			align-items : center;
			gap : 1em;
		}
		.footer img{
			width : 200px;
			height : 70px;
		}
		.footer .text{
			
			font-size : .8em;
		}
		.text p{
			margin : none;
		}
		
	</style>
</head>
<script>
	
    var today = new Date();
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    var formattedDate = today.toLocaleDateString('id-ID', options);

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('current-date').innerHTML = formattedDate;
    });

	window.print()
</script>

<body>
	<section id="header-kop">
		<div class="container-fluid">
			<table class="table table-borderless">
				<tbody>
					<tr>
						<td class="text-left" width="20%">
							<img src="libs/images/logopemko.png" alt="logo-dkm" width="130" />
						</td>
						<td class="text-center" width="150%">
							<h1>PEMERINTAH KOTA BANJARMASIN
								DINAS KOMUNIKASI INFORMATIKA DAN STATISTIK</h1>
							Jalan R. E. Martadinata No. 1 Gedung Blok B Lantai Dasar - Banjarmasin 70111
							Email: diskominfotik@mail.banjarmasinkota.go.id - Website: diskominfotik.banjarmasinkota.go.id
							<br>
						</td>
						<td class="text-right" width="100%"></td>
					</tr>
				</tbody>
			</table>

			<hr class="line-top" style="border: 2px solid black;">
		</div>
	</section>

	<section id="body-of-report">
		<div class="container-fluid">
			<h4 class="text-center"> <u>SURAT IZIN CUTI</u></h4>

			<label class="center-label">Nomor : 850/<?php echo $data["id_cuti"]; ?>-cuti/Diskominfotik/<?php echo angkaToRomawi(date("n")); ?>/<?php echo (date("Y"));?> </label>
			<br>
			<label> Diberikan <b>Izin <?php echo $data["nama_jenis"]; ?></b> kepada Pegawai Negeri Sipil :<br>
				<table width="100%">
					<tr>
						<td width='200px'>Nama</td>
						<td width='10px'>:</td>
						<td><b><?= $data['nama_pegawai'] ?></b></td>
					</tr>
					<tr>
						<td>NIP</td>
						<td>:</td>
						<td><b><?= $data['NIP'] ?></b></td>
					</tr>
					<tr>
						<td>Pangkat/Gol</td>
						<td>:</td>
						<td><?= $data['pangkat'] ?></td>
					</tr>
					<tr>
						<td>Jabatan</td>
						<td>:</td>
						<td><?= $data['nama_jabatan'] ?></td>
					</tr>
					<tr>
						<td>Unit Kerja</td>
						<td>:</td>
						<td><?= $data['unit_kerja'] ?></td>
					</tr>
					<tr>
						<td>Lama </td>
						<td>:</td>
						<td><?= $data['lama_cuti'] ?> hari Kerja</td>
					</tr>
					<tr>
						<td>Dijalankan di</td>
						<td>:</td>
						<td><?= $data['alamat'] ?></td>
					</tr>
					<tr>
						<td>Terhitung mulai</td>
						<td>:</td>
						<td>
							<?php
							$tanggalMulai = $data['tanggal_mulai'];
							// Ubah format tanggal
							$tanggalMulaiFormatted = date('d F Y', strtotime($tanggalMulai));
							echo  tanggalIndonesia($tanggalMulaiFormatted);
							?>
						</td>
					</tr>
					<tr>
						<td>Sampai tanggal</td>
						<td>:</td>
						<td>
							<?php
							$tanggalSelesai = $data['tanggal_selesai'];
							// Ubah format tanggal
							$tanggalSelesaiFormatted = date('d F Y', strtotime($tanggalSelesai));
							echo tanggalIndonesia($tanggalSelesaiFormatted);
							?>
						</td>
					</tr>

					<tr>
						<td>Kembali masuk</td>
						<td>:</td>
						<td>Tanggal
								<b><?php
								$tanggalKembali = $data['tanggal_kembali'];
								// Ubah format tanggal
								$tanggalKembaliFormatted = date('d F Y', strtotime($tanggalKembali));
								echo tanggalIndonesia($tanggalKembaliFormatted);
								?></b>
						</td>
					</tr>
					<tr>
						<td>Alasan Cuti</td>
						<td>:</td>
						<td><b><?= $data['keperluan'] ?></b></td>
					</tr>
				</table>



				<br>
				Dengan ketentuan sebagai berikut :
				<ol>
					<li>
						Sebelum menjalankan Cuti wajib menyerahkan pekerjaannya kepada atasan langsung.
					</li>
					<li>
						Setelah selesai menjalankan Cuti wajib melaporkan diri kepada atasan langsung.
					</li>
				</ol>




				Demikian Surat Izin Cuti ini diberikan untuk dapat dipergunakan sebagaimana mestinya.
				
<div style="text-align: right;">
    <p>Banjarmasin <span id="current-date"></span></p>
    <!-- Menambahkan gambar di bawah kota dan tanggal -->
  
<img src="libs/font/SCH.jpg" alt="">
<!-- <div style="text-align: right;">
	<td><?= $data['pangkat'] ?></td>	
</div> -->

</div><!-- /.container -->
<!-- &nbsp;&nbsp;&nbsp;&nbsp;Tembusan Yth: <br>
&nbsp;&nbsp;&nbsp;&nbsp;1.	Kepala BKD dan Diklat Kota Banjarmasin di Banjarmasin. <br>
&nbsp;&nbsp;&nbsp;&nbsp;2.	Arsip. -->

<!-- <div class="footer">
	<div class="text">
		<p>• UU ITE No 11 Tahun 2008 Pasal 5 ayat 1 : <i>'Informasi Elektronik dan/atau Dokumen Elektronik dan/atau
		hasil cetaknya merupakan alat bukti hukum yang sah.</i>'</p>
		<p>• Surat ini ditandatangani secara elektronik menggunakan <b>sertifikat elektronik</b> yang diterbitkan BSr</p>
	</div>
	<img src="foto/logo-bsre.png" alt="" class="img-t">
</div> -->


</section>

<!-- Bootstrap Core JavaScript -->
<script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- jTebilang JavaScript -->
<script src="libs/jTerbilang/jTerbilang.js"></script>

</body>
</html>