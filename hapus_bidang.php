
<!doctype html>
<html lang="en">
  <head>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body></body>
</html>
<?php 

include('koneksi.php');

$id_bidang = $_GET['id_bidang'];

$hapus= mysqli_query($conn, "DELETE FROM bidang WHERE id_bidang='$id_bidang'");
if($hapus) {
    echo "<script>
    Swal.fire({
        title: 'Apa kamu yakin mehapus Nama Bidang ini?',
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
                window.location='bidang.php';
            });
        }
    });
    </script>";
} else {
    echo "Hapus data gagal";
}
?>