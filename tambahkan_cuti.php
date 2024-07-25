<?php
include("koneksi.php");

$ajuan = date('Y-m-d');
// $no_cuti = $_POST['id_cuti'];
$id = $_POST['id_pegawai'];

$datax = mysqli_query($conn, "select * from pegawai where id_pegawai='$id'");
$result = mysqli_fetch_array($datax);
$nama = $result['nama_pegawai'];



$idjc = $_POST['id_jeniscuti'];
$mulai = $_POST['mulai'];
$akhir = $_POST['akhir'];


// $kembali = $_POST['tanggal_kembali'];
// $lamcut = $_POST['lama_cuti']
$keperluan = isset($_POST['keperluan']) ? $_POST['keperluan'] : '';
$status = "Diajukan";

// $start = new DateTime($mulai);
// $finish = new DateTime($akhir);
// $int = $start->diff($finish);
// $dur = $int->days +1;
// $durasi = $dur;

$start = new DateTime($mulai);
$finish = new DateTime($akhir);

$interval = new DateInterval('P1D'); // Interval satu hari
$daterange = new DatePeriod($start, $interval, $finish);

$durasi = 1;
$query_libur = "SELECT tanggal_libur FROM hari_libur WHERE tanggal_libur BETWEEN '{$start->format('Y-m-d')}' AND '{$finish->format('Y-m-d')}'";
$result_libur = $conn->query($query_libur);
 
$jumlah_hari_libur = $result_libur->num_rows;




foreach ($daterange as $date) {
    $dayOfWeek = $date->format('N'); // Mendapatkan hari dalam format ISO-8601 (1 untuk Senin, 7 untuk Minggu)
    
    // Jika hari bukan Sabtu (6) atau Minggu (7), tambahkan ke durasi
    if ($dayOfWeek < 6) {
        $durasi++;
    }
}

$stt = "Menunggu Approval Leader";


$pgw = "SELECT * FROM pegawai WHERE id_pegawai='$id'";
$qpgw = mysqli_query($conn, $pgw);
$ress = mysqli_fetch_array($qpgw);

// Menghitung lama cuti
$durasi -= $jumlah_hari_libur;
$lamcut = $durasi;


$query_libur = "SELECT tanggal_libur FROM hari_libur WHERE tanggal_libur BETWEEN '{$start->format('Y-m-d')}' AND '{$finish->format('Y-m-d')}'";
$result_libur = $conn->query($query_libur);
$libur = array();
while ($row = $result_libur->fetch_assoc()) {
    $libur[] = new DateTime($row['tanggal_libur']);
}

// Fungsi untuk mengecek apakah tanggal termasuk hari libur atau hari Sabtu/Minggu
function isWeekendOrHoliday($tanggal, $libur) {
    return in_array($tanggal->format('Y-m-d'), $libur) || $tanggal->format('N') >= 6;
}

// Mulai dari tanggal finish
$tanggalKembali = clone $finish->modify('+1 day');

// Loop untuk mencari tanggal kembali yang valid
while (isWeekendOrHoliday($tanggalKembali, $libur)) {
    $tanggalKembali->modify('-1 day');
}

// Format tanggal kembali
$kembali= $tanggalKembali->format('Y-m-d');



// Ganti '$id' menjadi '$no_cuti' di bawah, dan sesuaikan '$kembali'
$sql = "INSERT INTO `cuti`(`id_pegawai`, `id_jeniscuti`, `tanggal_mulai`, `tanggal_selesai`, `tanggal_kembali`, `lama_cuti`, `keperluan`, `status`)
VALUES('$id','$idjc','$mulai','$akhir','$kembali','$lamcut','$keperluan', '$status')";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script type='text/javascript'>
			alert('Pengajuan cuti berhasil!'); 
			document.location = 'cutiwaiting.php'; 
		</script>";

} else {
    echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'cutiwaiting.php'; 
		</script>";
}
?>
