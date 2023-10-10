<?php
    include "../config/koneksi.php";
    @$tgl_awal = $_GET['tgl_awal'];
    @$tgl_sampai = $_GET['tgl_sampai'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="row">
        <div class="col-lg-6" style="margin: 0 auto; float:none">
            <center>
                <h2>Laporan Peminjaman</h2>
                Periode : <?= date('d-m-Y', strtotime($tgl_awal))?> <b>s/d</b> <?= date('d-m-Y', strtotime($tgl_sampai))?>
            </center>
            <hr>
            <br>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Nama Inventaris</th>
                        <th>Jumlah</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $cari ='';
                        @$tgl_awal = $_GET['tgl_awal'];
                        @$tgl_sampai = $_GET['tgl_sampai'];
                        if (!empty($tgl_awal)) {
                            $cari .= "and tanggal_pinjam >='".$tgl_awal."'";
                        }
                        if (!empty($tgl_sampai)) {
                            $cari .= "and tanggal_pinjam <='".$tgl_sampai."'";
                        }
                        // if (empty($tgl_awal) && empty($tgl_sampai)) {
                        //     $cari .= "and tanggal_pinjam >='".$tgl_awal."'and tanggal_pinjam <='".$tgl_sampai."'";
                        // }
                        $sql = "SELECT *, detail_pinjam_baru.jumlah as jml FROM detail_pinjam_baru LEFT JOIN peminjaman_baru ON peminjaman_baru.id_peminjaman = detail_pinjam_baru.id_peminjaman LEFT JOIN inventaris_baru ON inventaris_baru.id_inventaris = detail_pinjam_baru.id_inventaris LEFT JOIN pegawai_baru ON pegawai_baru.id_pegawai = peminjaman_baru.id_pegawai WHERE 1=1 $cari";
                        $query = mysqli_query($koneksi, $sql);
                        $cek = mysqli_num_rows($query);
                        if ($cek > 0) {
                            $no = 1;
                            while ($data = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td><?= $no++?></td>
                                        <td><?= $data['nama_pegawai']?></td>
                                        <td><?= $data['nama']?></td>
                                        <td><?= $data['jml']?></td>
                                        <td><?= $data['tanggal_pinjam']?></td>
                                        <td><?= $data['tanggal_kembali']?></td>
                                    </tr>
                                <?php
                            }
                        }else {
                            ?>
                                <tr>
                                    <td colspan="6">Tidak Ada Data</td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
    window.print();
</script>