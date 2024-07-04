<?php
include("koneksi.php");
$ajuan = date('Y-m-d');
$id = $_GET['id'];


$keperluan = isset($_POST['keperluan']) ? $_POST['keperluan'] : '';
$status = "Diterima";

$ket = isset($_POST['keterangan']) ? $_POST['keterangan'] : 'Verifikasi Kadis';


$sql = "UPDATE cuti SET `status`='$status', keterangan = '$ket' WHERE id_cuti=$id";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script type='text/javascript'>
			alert('Terima cuti berhasil!'); 
			document.location = 'cutisetuju.php'; 
		</script>";
} else {
    echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'cutiwaiting.php'; 
		</script>";
}
?>
