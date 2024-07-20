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

$haries = array("Sunday" => "Minggu", "Monday" => "Senin", "Tuesday" => "Selasa", "Wednesday" => "Rabu", "Thursday" => "Kamis", "Friday" => "Jum'at", "Saturday" => "Sabtu");
$bulans = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

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
    <title>Sistem Informasi Pengajuan Cuti Pegawai Dinas Komunikasi Informatika dan Statistik Kota Banjarmasin - <?php echo $pagedesc ?></title>
    <link href="libs/images/isk-logopemko.png" rel="icon" type="images/x-icon">
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
        </div><!-- /.navbar-header -->
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
                        echo '<li><a href="hal_pegawai.php" class="aktif"><i class="fa fa-home fa-fw"></i>&nbsp;Beranda</a></li>';
                    } else {
                        echo '<li><a href="hal_pegawai.php"><i class="fa fa-home fa-fw"></i>&nbsp;Beranda</a></li>';
                    }
                    ?>
                    <li>
                        <a href="#"><i class="fa fa-group fa-fw"></i>&nbsp;Pengajuan Cuti<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php
                            if ($pagedesc == "Pengajuan Cuti") {
                                echo '<li><a href="cuti.php" class="active">Buat Pengajuan Cuti</a></li>';
                            } else {
                                echo '<li><a href="cuti.php">Buat Pengajuan Cuti</a></li>';
                            }
                            if ($pagedesc == "Cuti") {
                                echo '<li><a href="cutiwaiting.php" class="active">Menunggu Persetujuan</a></li>';
                            } else {
                                echo '<li><a href="cutiwaiting.php">Menunggu Persetujuan </a></li>';
                            }
                            if ($pagedesc == "Ditolak") {
                                echo '<li><a href="cutiditolak.php" class="active">Di Tolak</a></li>';
                            } else {
                                echo '<li><a href="cutiditolak.php">Di Tolak </a></li>';
                            }
                            if ($pagedesc == "Disetujui") {
                                echo '<li><a href="cutisetuju.php" class="active">Di Terima</a></li>';
                            } else {
                                echo '<li><a href="cutisetuju.php">Di Terima </a></li>';
                            }
                            ?>
                        </ul><!-- /.nav-second-level -->
                    </li>
                    <?php
                    if (isset($menuparent) && $menuparent == "approval") {
                        echo '<li class="active">';
                    } else {
                        echo '<li>';
                    }
                    ?>
                    <a href="#"><i class="fa fa-sign-out fa-fw"></i>&nbsp;Logout<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php
                        if ($pagedesc == "Logout") {
                            echo '<li><a href="logout.php" class="active">Logout</a></li>';
                        } else {
                            echo '<li><a href="logout.php">Logout</a></li>';
                        }
                        ?>
                    </ul><!-- /.nav-second-level -->
                </ul><!-- /#side-menu -->
            </div><!-- /.sidebar-collapse -->
        </div><!-- /.navbar-static-side -->
    </nav><!-- /Navigation -->
</div><!-- /#wrapper -->

<!-- jQuery -->
<script src="libs/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="libs/metisMenu/dist/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="libs/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="libs/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>

</body>
</html>
