
<!doctype html>
<html lang="en">
  <head>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body></body>
</html>
<?php 

include('koneksi.php');

$id_libur = $_GET['id_libur'];

$hapus= mysqli_query($conn, "DELETE FROM hari_libur WHERE id_libur='$id_libur'");
if($hapus) {
    echo "<script>
    Swal.fire({
        title: 'Apa Kamu Yakin Mehapus Data ini?',
        text: 'Anda tidak akan dapat mengembalikan ini!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus saja!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Hapus!',
                text: 'Nama Bidang telah dihapus.',
                icon: 'success'
            }).then((result)=>{
                window.location='hari_libur.php';
            });
        }
    });
    </script>";
} else {
    echo "Hapus data gagal";
}
?>