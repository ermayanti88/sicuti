<!doctype html>
<html lang="en">
  <head>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body></body>
</html>
<?php


include('koneksi.php');

$id_jabatan = $_GET['id_jabatan'];

$hapus= mysqli_query($conn, "DELETE FROM jabatan WHERE id_jabatan='$id_jabatan'");
if($hapus) {
    echo "<script>
    Swal.fire({
        title: 'Apa kamu yakin mehapus Nama Jabatan ini?',
        text: 'Kamu tidak akan dapat mengembalikan ini!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus saja!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Hapus!',
                text: 'Nama Jabatan berhasil dihapus.',
                icon: 'success'
            }).then((result)=>{
                window.location='jabatan.php';
            });
        }
    });
    </script>";
} else {
    echo "Hapus data gagal";
}
?>