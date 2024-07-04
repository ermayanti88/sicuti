<?php 

include('koneksi.php');

$id_cuti = $_GET['no'];

$hapus= mysqli_query($conn, "DELETE FROM cuti WHERE id_cuti='$id_cuti'");

if($hapus)
	header('location: cutiwaiting.php');
else
	echo "Hapus data gagal";

 ?> 