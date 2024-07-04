<?php
include 'koneksi.php';

function Januari(){
    global $conn;
    $queryJanuari = "SELECT id_cuti, tanggal_mulai, status FROM cuti WHERE tanggal_mulai BETWEEN '2024-01-01' AND '2024-01-31' AND status = 'Diterima'";
    $ch = mysqli_query($conn, $queryJanuari);
    $row = mysqli_num_rows($ch);
    return $row;
}
function Februari(){
    global $conn;
    $queryFeb = "SELECT id_cuti, tanggal_mulai, status FROM cuti WHERE tanggal_mulai BETWEEN '2024-02-01' AND '2024-01-29' AND status = 'Diterima'";
    $ch = mysqli_query($conn, $queryFeb);
    $row = mysqli_num_rows($ch);
    return $row;
}
function Maret(){
    global $conn;
    $queryMar = "SELECT id_cuti, tanggal_mulai, status FROM cuti WHERE tanggal_mulai BETWEEN '2024-03-01' AND '2024-03-31' AND status = 'Diterima'";
    $ch = mysqli_query($conn, $queryMar);
    $row = mysqli_num_rows($ch);
    return $row;
}
function April(){
    global $conn;
    $queryApr = "SELECT id_cuti, tanggal_mulai, status FROM cuti WHERE tanggal_mulai BETWEEN '2024-04-01' AND '2024-04-30' AND status = 'Diterima'";
    $ch = mysqli_query($conn, $queryApr);
    $row = mysqli_num_rows($ch);
    return $row;
}
function Mei(){
    global $conn;
    $queryFeb = "SELECT id_cuti, tanggal_mulai, status FROM cuti WHERE tanggal_mulai BETWEEN '2024-05-01' AND '2024-05-31' AND status = 'Diterima'";
    $ch = mysqli_query($conn, $queryFeb);
    $row = mysqli_num_rows($ch);
    return $row;
}
function Juni(){
    global $conn;
    $queryFeb = "SELECT id_cuti, tanggal_mulai, status FROM cuti WHERE tanggal_mulai BETWEEN '2024-06-01' AND '2024-06-30' AND status = 'Diterima'";
    $ch = mysqli_query($conn, $queryFeb);
    $row = mysqli_num_rows($ch);
    return $row;
}
function Juli(){
    global $conn;
    $queryFeb = "SELECT id_cuti, tanggal_mulai, status FROM cuti WHERE tanggal_mulai BETWEEN '2024-07-01' AND '2024-07-31' AND status = 'Diterima'";
    $ch = mysqli_query($conn, $queryFeb);
    $row = mysqli_num_rows($ch);
    return $row;
}
function Agustus(){
    global $conn;
    $queryFeb = "SELECT id_cuti, tanggal_mulai, status FROM cuti WHERE tanggal_mulai BETWEEN '2024-08-01' AND '2024-08-31' AND status = 'Diterima'";
    $ch = mysqli_query($conn, $queryFeb);
    $row = mysqli_num_rows($ch);
    return $row;
}
function September(){
    global $conn;
    $queryFeb = "SELECT id_cuti, tanggal_mulai, status FROM cuti WHERE tanggal_mulai BETWEEN '2024-09-01' AND '2024-09-30' AND status = 'Diterima'";
    $ch = mysqli_query($conn, $queryFeb);
    $row = mysqli_num_rows($ch);
    return $row;
}
function Oktober(){
    global $conn;
    $queryFeb = "SELECT id_cuti, tanggal_mulai, status FROM cuti WHERE tanggal_mulai BETWEEN '2024-10-01' AND '2024-10-31' AND status = 'Diterima'";
    $ch = mysqli_query($conn, $queryFeb);
    $row = mysqli_num_rows($ch);
    return $row;
}
function November(){
    global $conn;
    $queryFeb = "SELECT id_cuti, tanggal_mulai, status FROM cuti WHERE tanggal_mulai BETWEEN '2024-11-01' AND '2024-10-30' AND status = 'Diterima'";
    $ch = mysqli_query($conn, $queryFeb);
    $row = mysqli_num_rows($ch);
    return $row;
}
function Desember(){
    global $conn;
    $queryFeb = "SELECT id_cuti, tanggal_mulai, status FROM cuti WHERE tanggal_mulai BETWEEN '2024-12-01' AND '2024-12-31' AND status = 'Diterima'";
    $ch = mysqli_query($conn, $queryFeb);
    $row = mysqli_num_rows($ch);
    return $row;
}

