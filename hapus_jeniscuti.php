<!doctype html>
<html lang="en">
  <head>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body></body>
</html>
<?php

include('koneksi.php');

$id_jeniscuti = $_GET['id_jeniscuti'];

$hapus= mysqli_query($conn, "DELETE FROM jeniscuti WHERE id_jeniscuti='$id_jeniscuti'");
if($hapus) {
    echo "<script>
    Swal.fire({
        title: 'Apa kamu yakin mehapus Jenis Cuti ini?',
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
                text: 'Nama Jenis cuti berhasil dihapus.',
                icon: 'success'
            }).then((result)=>{
                window.location='jenis_cuti.php';
            });
        }
    });
    </script>";
} else {
    echo "Hapus data gagal";
}
?>