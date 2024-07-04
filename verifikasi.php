<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include("koneksi.php");

$id = $_POST['id_cuti'];
$status = $_POST['status'];



$insert = mysqli_query($conn, "UPDATE cuti SET status = '$status' WHERE id_cuti='$id'");

if($insert){
  echo "<script>alert('data berhasil di verifikasi') </script>";
  echo "<script> window.history.back()</script>";
//   echo "<script>
//   Swal.fire({
//     title: 'Verifikasi?',
//     text: 'Data berhasil di Verifikasi',
//     icon: 'success'
//   }).then((result) => {
//     document.location='cutiwaiting.php';
//   });
// </script>";

}
else {
  echo "Maaf, terjadi kesalahan saat mencoba menyimpan data ke database";
  echo "<script> window.history.back()</script>";
}


?>