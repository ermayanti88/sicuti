<?php
require_once 'vendor/autoload.php';
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

// Creating the new document...
$phpWord = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');

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
$tanggal = date("d"); // Mendapatkan angka bulan saat ini
$tanggal2 = date("d F Y"); // Mendapatkan angka bulan saat ini

$bulanRomawi = angkaToRomawi($tanggal);


$bulan = angkaToRomawi(date("n"));
$tahun = date("Y");
/* Note: any element you append to a document must reside inside of a Section. */
$tanggalMulai = $data['tanggal_mulai'];
		// Ubah format tanggal
		$tanggalMulaiFormatted = date('d F Y', strtotime($tanggalMulai));

        $tanggalSelesai = $data['tanggal_selesai'];
							// Ubah format tanggal
		$tanggalSelesaiFormatted = date('d F Y', strtotime($tanggalSelesai));
        $tanggalKembali = $data['tanggal_kembali'];
        // Ubah format tanggal
        $tanggalKembaliFormatted = date('d F Y', strtotime($tanggalKembali));
$phpWord->setValues(
    [ 
    'nama_jenis' => $data['nama_jenis'],
    'id_cuti' => $data['id_cuti'],
    'nama' => $data['nama_pegawai'],
    'nip' => $data['NIP'],
    'pangkat' => $data['pangkat'],
    'jabatan' => $data['nama_jabatan'],
    'unit' => $data['unit_kerja'],
    'lama' => $data['lama_cuti'],
    'alamat' => $data['alamat'],
    'keperluan' => $data['keperluan'],
    'tgl_mulai' => tanggalIndonesia($tanggalMulaiFormatted),
    'tgl_selesai' => tanggalIndonesia($tanggalSelesaiFormatted),
    'tgl_kmb' => tanggalIndonesia($tanggalKembaliFormatted),
    'bulan' => $bulan,
    'tahun' => $tahun,
    'hari_ini' => tanggalIndonesia($tanggal2)
    ]
);
$path = $data['id_cuti'] . '.docx';
$phpWord->saveAs($path);
header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename=Draf '. $path);
// header('Content-Disposition: attachment; filename="'.tanggalIndonesia($tanggal2). ' '. $data['id_cuti'].'".docx');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
readfile($path);

