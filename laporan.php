<?php
include 'koneksi.php'; 
$pagedesc = "Menunggu Approval";
include("layout_top.php");
include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");

?>
<!-- HTML Code -->
<link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">
<head>
    <!-- CSS Style -->
</head>

<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row" style="background-color: #F2F3F5; color: black;">
      <div class="col-lg-12" style="background-color: #EEF0F0; color: black;">
      <h1 class="page-header">
    <a href="#" style="color: black; text-decoration: none;">
        <span style="font-size: 1em;">LAPORAN</span>
        <span style="font-size: 0.6em; color: gray;">Sisa Cuti</span>
    </a>
</h1>
      </div><!-- /.col-lg-12 -->
    </div>

    <div class="row">
      <div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
    </div>

    <!-- <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">

            <form method="get" name="cari" onSubmit="return valid();">
              <div class="form-group">
                <div class="col-sm-4">
                  <label>Tanggal Mulai</label>
                  <input type="date" class="form-control" name="mulai" placeholder="From Date(dd/mm/yyyy)" required>
                </div>
                <div class="col-sm-4">
                  <label>Tanggal Selesai</label>
                  <input type="date" class="form-control" name="selesai" placeholder="To Date(dd/mm/yyyy)" required>
                </div>
                <div class="col-sm-4">
                  <label>&nbsp;</label><br/>
                  <input type="submit" name="submit" value="Lihat Laporan" class="btn btn-primary">
                </div>
              </div>
            </form> -->
            <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
    
        .container {
            display: flex;
            gap: 20px;
            flex-wrap: nowrap;
            overflow-x: auto;
        }
        .card {
            width: 150px;
            height: 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            border-radius: 8px;
            text-align: center;
            flex: 0 0 auto; /* Prevent cards from shrinking or growing */
         } 
         .card p {
            margin: 5px 0;
            font-family: 'Times New Roman', Times, serif;
            font-size: 35px;
            font-weight: bold;
        }
        .card .detail {
            margin-top: auto;
            margin-bottom: 10px;
            text-decoration: none;
            color: white;
            background-color: rgba(0, 0, 0, 0.2);
            padding: 5px 10px;
            border-radius: 4px;
        }
        .tahun23 { background-color: #6690FF; }
        .tahun24 { background-color: #DD98EC; }
   
    </style>
</head>
<body>
    <div class="container">
        <div class="card tahun23">
          
            <p>Tahun 2023</p>
            <a href="tahun2023.php" class="detail">Lihat Detail</a>
        </div>
        <div class="card tahun24">
            
            <p>Tahun 2024</p>
            <a href="tahun2024.php" class="detail">Lihat Detail</a>
        </div>
       
    </div>
</body>
</html>
