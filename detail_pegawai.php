<!-- Printing -->
<link rel="stylesheet" href="css/printing.css">
		
        <?php
        include("sess_check.php");
        include("dist/function/format_tanggal.php");
        if($_GET) {
            $kode = $_GET['code'];
            $sql = "SELECT * FROM pegawai WHERE id_pegawai='". $_GET['code'] ."'";
            $query = mysqli_query($conn,$sql);
            $result = mysqli_fetch_array($query);
        }
        else {
            echo "Nomor Transaksi Tidak Terbaca";
            exit;
        }
        ?>
        <html>
        <head>
        </head>
        <body>
        <div id="section-to-print">
        <div id="only-on-print">
        </div>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel">Detail Karyawan</h4>
        </div>
        <div><br/>
        <table width="100%">
            <tr>
                <td width="20%"><b>NIP</b></td>
                <td width="2%"><b>:</b></td>
                <td width="78%"><?php echo $result['NIP'];?></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td width="20%"><b>Nama Pegawai</b></td>
                <td width="2%"><b>:</b></td>
                <td width="78%"><?php echo $result['nama_pegawai'];?></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td width="20%"><b>Unit Kerja</b></td>
                <td width="2%"><b>:</b></td>
                <td width="78%"><?php echo $result['unit_kerja'];?></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td width="20%"><b>Pangkat</b></td>
                <td width="2%"><b>:</b></td>
                <td width="78%"><?php echo $result['pangkat'];?></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td width="20%"><b>Alamat</b></td>
                <td width="2%"><b>:</b></td>
                <td width="78%"><?php echo $result['alamat'];?></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td width="20%"><b>No Telepon</b></td>
                <td width="2%"><b>:</b></td>
                <td width="78%"><?php echo $result['jabatan'];?></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td width="20%"><b>Alamat</b></td>
                <td width="2%"><b>:</b></td>
                <td width="78%"><?php echo $result['alamat'];?></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td width="20%"><b>Jumlah Cuti</b></td>
                <td width="2%"><b>:</b></td>
                <td width="78%"><?php echo $result['jml_cuti'];?></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td width="20%"><b>Hak Akses</b></td>
                <td width="2%"><b>:</b></td>
                <td width="78%"><b><?php echo $result['hak_akses'];?></b></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td width="20%"><b>Aktif</b></td>
                <td width="2%"><b>:</b></td>
                <td width="78%"><?php 
                if($result['active']==1){
                echo "Ya";
                }else{
                echo "Tidak";
                }
                ?></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td width="20%"><b>Foto</b></td>
                <td width="2%"><b>:</b></td>
                <td width="78%"><img src="foto/<?php echo $result['foto_emp'];?>" width="70px"></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
        </table>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        
        </body>
        </html>