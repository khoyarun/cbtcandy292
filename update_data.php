<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
<div class='row'>
    <div class='col-md-12'>
        <div class='box box-solid'>
            <div class='box-header with-border'>
                <h3 class='box-title'><i class="fas fa-edit    "></i> Pemutahiran Tempat tinggal dan Kontak</h3>
            </div><!-- /.box-header -->
            <div class='box-body container-fluid'>

                <?php
                $siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$_SESSION[id_siswa]'"));

                ?>
                <div class="col-md-8">
                    <form action="update_fungsi.php" method="POST">
                        <div class="row col-12">
                            <div class="col-md-3">
                                <label>Nomor WA aktif</label>
                            </div>
                            <div class="col-md-9">
                                <input type="hidden" name="username" value="<?= $siswa['username'] ?>">
                                <input type="number" class="form-control mb-lg-3" placeholder="isikan no. WA yg Aktif" name="hp_baru" value="<?= $siswa['hp'] ?>" maxlength="12">
                                0823xxxxxxxx <small>(maksimal 12 angka tanpa spasi dan tanda baca!)</small>
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="col-md-3">
                                <label>Jenis tinggal</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Jenis tampat tinggal" name="jenis_tinggal" value="<?= $siswa['jenis_tinggal'] ?>">
                            </div>
                        </div> <br>
                        <div class="row col-12">
                            <div class="col col-md-3">
                                <label>Kecamatan</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Kecamatan tampat tinggal" name="kecamatan" value="<?= $siswa['kecamatan'] ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Kelurahan</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Kelurahan tampat tinggal" name="kelurahan" value="<?= $siswa['kelurahan'] ?>">
                        </div> <br>
                        <div class="col-md-3">
                            <label>Dusun</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Dusun tampat tinggal" name="dusun" value="<?= $siswa['dusun'] ?>">
                        </div> <br>
                        <div class="col-md-3">
                            <label>Transportasi</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="transportasi ke Madrasah" name="transportasi" value="<?= $siswa['transportasi'] ?>">
                        </div>
                        <br> <br>
                        <button class="btn btn-success btn-md" name="update_data" type="submit">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>