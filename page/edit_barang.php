<?php
    $id_inventaris = $_GET['id_inventaris'];
    if (empty($id_inventaris)) {
        ?>
            <script type="text/javascript">
                window.location.href="?p=list_barang";
            </script>
        <?php
    }
        $sql="SELECT *, inventaris_baru.keterangan as ket FROM inventaris_baru LEFT JOIN ruang_baru ON ruang_baru.id_ruang=inventaris_baru.id_ruang LEFT JOIN jenis_baru ON jenis_baru.id_jenis=inventaris_baru.id_jenis WHERE id_inventaris='$id_inventaris'";
        $query=mysqli_query($koneksi, $sql);
        $cek = mysqli_num_rows($query);
        if ($cek > 0) {
            $data = mysqli_fetch_array($query);
        }else {
            $data= NULL;
        }
?>
<div class="row">
    <div class="col-lg-4">
    <div class="panel panel-primary">
        <div class="panel-heading">Edit Inventaris</div>
            <div class="panel-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="">Kode Inventaris</label>
                            <input type="text" class="form-control" name="kode_inventaris" value="<?= $data['kode_inventaris']?>">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Inventaris</label>
                            <input type="text" class="form-control" name="nama" value="<?= $data['nama']?>">
                        </div>
                        <div class="form-group">
                            <label for="">Kondisi</label>
                            <select name="kondisi" id="" class="form-control">
                                <option value="<?= $data['kondisi']?>" name="kondisi" class="form-control"><?= $data['kondisi']?></option>
                                <option value="Baik" name="kondisi" class="form-control">Baik</option>
                                <option value="Rusak" name="kondisi" class="form-control">Rusak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" value="<?= $data['jumlah']?>">
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Inventaris</label>
                            <select name="id_jenis" id="" class="form-control">
                                <option value="<?= $data['id_jenis']?>" class="form-control"><?= $data['nama_jenis']?></option>
                                <?php
                                $sql_jenis ="SELECT * FROM jenis_baru";
                                $q_jenis =mysqli_query($koneksi, $sql_jenis);
                                while ($jenis = mysqli_fetch_array($q_jenis)) {
                                    ?>
                                        <option value="<?= $jenis['id_jenis']?>"><?= $jenis['nama_jenis']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Ruang</label>
                            <select name="id_ruang" id="" class="form-control">
                                <option value="<?= $data['id_ruang']?>" class="form-control"><?= $data['nama_ruang']?></option>
                                <?php
                                $sql_ruang = "SELECT * FROM ruang_baru";
                                $q_ruang=mysqli_query($koneksi, $sql_ruang);
                                while ($ruang = mysqli_fetch_array($q_ruang)) {
                                    ?>
                                        <option value="<?= $ruang['id_ruang']?>"><?= $ruang['nama_ruang']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea name="ket" id="" cols="30" rows="5" class="form-control" value="<?= $data['ket']?>"><?= $data['ket']?></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-md btn-primary" name="simpan" type="submit">Simpan</button>
                            <a href="?p=list_barang" class="btn btn-md btn-default">Kembali</a>
                        </div>
                    </form>
                    <?php
                        if (isset($_POST['simpan'])) {
                            $kode_inventaris = $_POST['kode_inventaris'];
                            $nama = $_POST['nama'];
                            $kondisi = $_POST['kondisi'];
                            $jumlah = $_POST['jumlah'];
                            $id_jenis = $_POST['id_jenis'];
                            $id_ruang = $_POST['id_ruang'];
                            $ket = $_POST['ket'];
                            $sql_update="UPDATE inventaris_baru SET 
                            kode_inventaris='$kode_inventaris', 
                            nama='$nama', 
                            kondisi='$kondisi', 
                            jumlah='$jumlah', 
                            id_jenis='$id_jenis', 
                            id_ruang='$id_ruang', 
                            keterangan='$ket' WHERE id_inventaris = '$id_inventaris'";
                            $q_update=mysqli_query($koneksi, $sql_update);
                            if ($q_update) {
                                ?>
                                <script type="text/javascript">
                                    window.location.href="?p=list_barang"
                                </script>
                                <?php
                            }else {
                                ?>
                                    <div class="alert alert-danger">
                                        Inventaris Gagal di Update!
                                    </div>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>