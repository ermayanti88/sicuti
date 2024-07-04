<?php 

include('koneksi.php');

$id_pegawai = $_GET['id_pegawai'];


$ambil = mysqli_query($conn, "SELECT * FROM pegawai WHERE id_pegawai='$id_pegawai'");
if (!$ambil) {
	die('Error fetching data: ' . mysqli_error($conn));
}
$result = mysqli_fetch_all($ambil, MYSQLI_ASSOC);
$data = $result[0];
$id_user = $data['id_user'];

$hapus2 = mysqli_query($conn, "DELETE FROM user WHERE id_user='$id_user'");



if ($hapus2) {
   
	$hapus = mysqli_query($conn, "DELETE FROM pegawai WHERE id_pegawai=$id_pegawai");

	if ($hapus) {
		header('location: pegawai.php');
	} else {
		echo "Hapus data user gagal: " . mysqli_error($conn);
	}

} else {
    echo "Hapus data pegawai gagal: " . mysqli_error($conn);
}
?>