<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>

<div class='row'>
    <div class='col-md-12'>
        <div class='box box-solid'>
            <div class='box-header with-border '>
                <h3 class='box-title'><i class="fas fa-envelope-open-text    "></i> Aktifasi Ujian</h3>
                <div class='box-tools pull-right '>
                    <?php if ($setting['server'] == 'pusat') : ?>

                        <button class='btn btn-sm btn-flat btn-success' data-toggle='modal' data-backdrop='static' data-target='#tambahjadwal'><i class='glyphicon glyphicon-plus'></i> <span class='hidden-xs'>Tambah Jadwal</span></button>
                    <?php endif ?>
                </div>
            </div><!-- /.box-header -->
            <div class='box-body'>
                <div class="col-md-1">
                </div>
                <div class="col-md-6">
                    <form id='formaktivasi' action="">
                        <div class="form-group">
                            <label for="">Pilih Jadwal Ujian</label>
                            <select class="form-control select2" name="ujian[]" style="width:100%" multiple='true' required>
                                <?php if ($pengawas['level'] == 'admin') {
                                    $jadwal = mysqli_query($koneksi, "SELECT * FROM ujian ORDER BY tgl_ujian ASC, waktu_ujian ASC");
                                } else {
                                    $jadwal = mysqli_query($koneksi, "SELECT * FROM ujian where id_guru='$id_pengawas' ORDER BY tgl_ujian ASC, waktu_ujian ASC");
                                } ?>
                                <?php while ($ujian = mysqli_fetch_array($jadwal)) : ?>

                                    <option value="<?= $ujian['id_ujian'] ?>"><?= $ujian['kode_nama'] . " - " . $ujian['nama'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Pilih Kelompok Test / Sesi</label>
                                    <select class="form-control select2" name="sesi" id="">
                                        <?php $sesi = mysqli_query($koneksi, "select * from siswa group by sesi"); ?>
                                        <?php while ($ses = mysqli_fetch_array($sesi)) : ?>
                                            <option value="<?= $ses['sesi'] ?>"><?= $ses['sesi'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Pilih Aksi</label>
                                    <select class="form-control select2" name="aksi" required>

                                        <option value=""></option>
                                        <option value="1">aktif</option>
                                        <option value="0">non aktif</option>
                                        <option value="hapus">hapus</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button name="simpan" class="btn btn-success">Simpan Semua</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="box-body">
                        <div class='small-box bg-aqua p-2'>
                            <div class='inner'>
                                <?php $token = mysqli_fetch_array(mysqli_query($koneksi, "select token, masa_berlaku from token")) ?>
                                <h3><span name='isi_token' id='isi_token'><?= $token['token']?></span></h3>
                                <p>Token Tes (Renewal setiap <?= $token['masa_berlaku']?>)</p>
                            
                                <a id="btntoken" href="#" class="mt-20"><i class='fa fa-spin fa-refresh'></i> Refreh Sekarang</a>
                            </div>
                        </div>
                        <form id='formtoken' action="">
                            <div class="col-md-7">
                                <input class="form-control" id="isi_token" name="isi_token" maxlength="6">
                            </div>
                            <button name="simpan" class="btn btn-success col-md-5"><i class="fa fa-layer-group"></i> Buat Token</button>
                        </form>
                    </div>
                </div>
            </div><!-- /.box -->
        </div>

    </div>




</div>


    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        var autoRefresh = setInterval(
            function() {
                $('#isi_token').load('mod_jadwal/crud_jadwal.php?pg=token');
            }, 2700000
        );
        $(document).ready(function() {
            $("#btntoken").click(function() {
                $.ajax({
                    url: "mod_jadwal/crud_jadwal.php?pg=token",
                    type: "POST",
                    success: function(respon) {
                        $('#isi_token').html(respon);
                        iziToast.success({
                            title: 'Mantap!',
                            message: 'Token diperbarui',
                            position: 'topRight'
                        });
                    }
                });
                return false;
            })
            $("#btnnewtoken").click(function() {
                $.ajax({
                    url: "mod_jadwal/crud_jadwal.php?pg=addtoken",
                    type: "POST",
                    success: function(respon) {
                        $('#new_token').html(respon);
                        iziToast.success({
                            title: 'Mantap!',
                            message: 'Token diperbarui',
                            position: 'topRight'
                        });
                    }
                });
                return false;
            })
        });
        $('#formtoken').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'mod_jadwal/crud_jadwal.php?pg=add_new_token',
                    data: $(this).serialize(),
                    success: function(data) {
                        $('#isi_token').html(data);
                        iziToast.success({
                            title: 'Mantap!',
                            message: 'Token wes anyar meen',
                            position: 'topRight'
                        });
                        // setTimeout(function() {
                        //     window.location.reload();
                        // }, 2000);


                    }
                });
                return false;
            });
    </script>