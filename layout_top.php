<?php
include 'koneksi.php';
session_start();
$login = $_SESSION['login_user'];
if (!isset($login)) {
    echo "<script>
    document.location.href='index.php';
    </script>";
    die;
}

// setting tanggal
$haries = array("Sunday" => "Minggu", "Monday" => "Senin", "Tuesday" => "Selasa", "Wednesday" => "Rabu", "Thursday" => "Kamis", "Friday" => "Jum'at", "Saturday" => "Sabtu");
$bulans = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$bulans_count = count($bulans);
// tanggal bulan dan tahun hari ini
$hari_ini = $haries[date("l")];
$bulan_ini = $bulans[date("n")];
$tanggal = date("d");
$bulan = date("m");
$tahun = date("Y");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Informasi Pengajuan Cuti Pegawai Dinas Komunikasi Informatika dan Statika Kota Banjarmasin</title>
    
    <link href="libs/images/logopemko.png" rel="icon" type="images/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="libs/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link href="libs/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="libs/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="dist/css/offline-font.css" rel="stylesheet">
    <link href="dist/css/custom.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- jQuery -->
    <script src="libs/jquery/dist/jquery.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .icon-logout {
            display: inline-block;
            width: 20px;
            height: 20px;
            background: url('user.png') no-repeat center center;
            background-size: cover;
            margin-right: 15px;
        }
    </style>
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #337ab7;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand hidden-xs" href="admin.php">
                <img src="libs/images/logopemko.png" alt="brand" width="32" class="float-left image-brand">
                <div class="float-right">&nbsp;<strong style="color: white;">Dinas Komunikasi Informatika dan Statika Kota Banjarmasin</strong></div>
                <div class="clear-both"></div>
            </a>
            <a class="navbar-brand visible-xs" href="index.php">
                <img src="libs/images/logopemko.png" alt="brand" width="32" class="float-left image-brand">
                <div class="float-right">&nbsp;<strong style="color: white;">Dinas Komunikasi Informatika dan Statika Kota Banjarmasin</strong></div>
                <div class="clear-both"></div>
            </a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown dropdown-right">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Keluar</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <h1><b>SICUTI DISKOMINFO</b></h1>
                        <h5>Kota Banjarmasin</h5>
                        <h5 class="text-muted"><i class="fa fa-calendar fa-fw"></i>&nbsp;<?php echo $hari_ini . ", " . $tanggal . " " . $bulan_ini . " " . $tahun ?></h5>
                    </li>
                    
                    <?php 
                    if ($pagedesc == "Beranda") {
                        echo '<li><a href="admin.php" class="aktif"><i class="fa fa-home fa-fw"></i>&nbsp;Beranda</a></li>';
                    } else {
                        echo '<li><a href="admin.php"><i class="fa fa-home fa-fw"></i>&nbsp;Beranda</a></li>';
                    }

                    if (isset($menuparent) && $menuparent == "master") {
                        echo '<li class="aktif">';
                    } else {
                        echo '<li>';
                    }
                    ?>
                        <a href="#"><i class="fa fa-group fa-fw"></i>&nbsp;Data Master<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php
                            if ($pagedesc == "Data Pegawai") {
                                echo '<li><a href="pegawai.php" class="active">Data Pegawai</a></li>';
                            } else {
                                echo '<li><a href="pegawai.php">Data Pegawai</a></li>';
                            }
                            if ($pagedesc == "Bidang") {
                                echo '<li><a href="bidang.php" class="active">Sub Unit Kerja</a></li>';
                            } else {
                                echo '<li><a href="bidang.php">Sub Unit Kerja</a></li>';
                            }
                            if ($pagedesc == "Jabatan") {
                                echo '<li><a href="jabatan.php" class="active">Jabatan</a></li>';
                            } else {
                                echo '<li><a href="jabatan.php">Jabatan</a></li>';
                            }
                            if ($pagedesc == "Jenis Cuti") {
                                echo '<li><a href="jenis_cuti.php" class="active">Jenis Cuti</a></li>';
                            } else {
                                echo '<li><a href="jenis_cuti.php">Jenis Cuti</a></li>';
                            }
                            if ($pagedesc == "Hari Libur") {
                                echo '<li><a href="hari_libur.php" class="active">Hari Libur</a></li>';
                            } else {
                                echo '<li><a href="hari_libur.php">Hari Libur</a></li>';
                            }
                            ?>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                    <?php
                    if (isset($menuparent) && $menuparent == "laporan") {
                        echo '<li class="active">';
                    } else {
                        echo '<li>';
                    }
                    ?>
                        <a href="#"><i class="fa fa-folder fa-fw"></i>&nbsp;Laporan<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php
                            if ($pagedesc == "Menunggu") {
                                echo '<li><a href="menunggu.php" class="active">Menunggu Persetujuan</a></li>';
                            } else {
                                echo '<li><a href="menunggu.php">Menunggu Persetujuan</a></li>';
                            }
                            if ($pagedesc == "Ditolak") {
                                echo '<li><a href="cuti_ditolak_a.php" class="active">Ditolak</a></li>';
                            } else {
                                echo '<li><a href="cuti_ditolak_a.php">Ditolak</a></li>';
                            }
                            if ($pagedesc == "Diterima") {
                                echo '<li><a href="cuti_diterima_a.php" class="active">Diterima</a></li>';
                            } else {
                                echo '<li><a href="cuti_diterima_a.php">Diterima</a></li>';
                            }
                            if ($pagedesc == "Laporan Sisa Cuti") {
                                echo '<li><a href="laporan.php" class="active">Laporan Cuti Tahunan</a></li>';
                            } else {
                                echo '<li><a href="laporan.php">Laporan Sisa Cuti</a></li>';
                            }
                            ?>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                    <?php
                    if (isset($menuparent) && $menuparent == "logout") {
                        echo '<li class="active">';
                    } else {
                        echo '<li>';
                    }
                    ?>
                        <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i>&nbsp;Keluar</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
</div>
<!-- /#wrapper -->

<!-- Bootstrap Core JavaScript -->
<script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="libs/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>

</body>
</html>
