<?php

$nilai = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai"));
$soal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM mapel"));
$siswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa"));
$ruang = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM ruang"));
$kelas = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kelas"));
$mapel = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM mata_pelajaran"));
$online = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jawaban"));
$ujian = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM ujian where status='1'"));
$tugas = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tugas"));
$jawaban = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jawaban"));
?>
<?php if ($pengawas['level'] == 'admin') : ?>
    <div class='row'>
        <div class="col-lg-9">
            <div class='row'>
                <div class="col-lg-4">
                    <div class="small-box bg-blue ">
                        <div class="inner">
                            <h3><?= $siswa ?></h3>Data Peserta
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="?pg=siswa" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-box bg-red ">
                        <div class="inner">
                            <h3><?= $soal ?></h3>Data Bank Soal
                        </div>
                        <div class="icon">
                            <i class="fa fa-file"></i>
                        </div>
                        <a href="?pg=banksoal" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-box bg-green ">
                        <div class="inner">
                            <h3><?= $ujian ?></h3>Data Ujian
                        </div>
                        <div class="icon">
                            <i class="fa fa-edit"></i>
                        </div>
                        <a href="?pg=jadwal" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-box bg-yellow ">
                        <div class="inner">
                            <h3><?= $nilai ?></h3>Data Nilai
                        </div>
                        <div class="icon">
                            <i class="fa fa-file-signature"></i>
                        </div>
                        <a href="?pg=nilaiujian" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-box bg-purple ">
                        <div class="inner">
                            <h3><?= $jawaban ?></h3>Data Jawaban
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <a href="#" id="btnhapusjawaban" class="small-box-footer">Hapus Data <i class="fa fa-arrow-circle-right"></i></a>
                        <!-- Button trigger modal -->


                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-box bg-blue ">
                        <div class="inner">
                            <h3><?= $mapel ?></h3>Mata Pelajaran
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope-open-text"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box-body">

                <div class='small-box bg-aqua p-2'>
                <div class='box-header with-border'>
                    <h3 class='box-title'><i class='fa fa-bullhorn fa-fw'></i> Token aktif</h3>
                </div>
                    <div class='inner'>
                        <?php $token = mysqli_fetch_array(mysqli_query($koneksi, "select token from token")) ?>
                        <h3><span name='isi_token' id='isi_token'><?= $token['token'] ?></span></h3>
                    
                        <a href="?pg=newtoken" class="btn btn-success"><i class="fa fa-layer-group"></i> Kelola Token</a>
                    </div>
                </div>
            </div>

        </div>

        <div class='animated flipInX col-md-8'>
            <div class="row">
                <?php if ($setting['server'] == 'lokal') : ?>
                    <div class="col-lg-12">
                        <div class="small-box ">
                            <div class="inner">
                                <img id='loading-image' src='../dist/img/ajax-loader.gif' style='display:none; width:50px;' />
                                <p id='statusserver'></p>
                                <p>Status Server</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-desktop"></i>
                            </div>
                            <a href="?pg=sinkronset" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <script>
                        $.ajax({
                            type: 'POST',
                            url: 'mod_sinkron/statusserver.php',
                            beforeSend: function() {
                                $('#loading-image').show();
                            },
                            success: function(response) {
                                $('#statusserver').html(response);
                                $('#loading-image').hide();

                            }
                        });
                    </script>
                <?php endif; ?>
                <div class="col-md-12">
                    <div class='box box-solid direct-chat direct-chat-warning'>
                        <div class='box-header with-border'>
                            <h3 class='box-title'><i class='fas fa-bullhorn fa-fw'></i>
                                Pengumuman
                            </h3>
                            <div class='box-tools pull-right'>

                                <a href='?pg=<?= $pg ?>&ac=clearpengumuman' class='btn btn-default' title='Bersihkan Pengumuman'><i class='fa fa-trash'></i></a>
                            </div>
                        </div>
                        <div class='box-body'>
                            <div id='pengumuman'>
                                <p class='text-center'>
                                    <br /><i class='fa fa-spin fa-circle-o-notch'></i> Loading....
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class='animated flipInX col-md-4'>
            <div class='box box-solid direct-chat direct-chat-warning'>
                <div class='box-header with-border'>
                    <h3 class='box-title'><i class='fa fa-history'></i> Log Aktifitas</h3>
                    <div class='box-tools pull-right'>
                        <a href='?pg=<?= $pg ?>&ac=clearlog' class='btn btn-default' title='Bersihkan Log'><i class='fa fa-trash'></i></a>
                    </div>
                </div>
                <div class='box-body'>
                    <div id='log-list'>
                        <p class='text-center'>
                            <br /><i class='fa fa-spin fa-circle-o-notch'></i> Loading....
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php endif ?>
<?php
if ($ac == 'clearlog') {
    mysqli_query($koneksi, "TRUNCATE log");
    jump('?');
}
if ($ac == 'clearpengumuman') {
    mysqli_query($koneksi, "TRUNCATE pengumuman");
    jump('?');
}
?>
<?php if ($pengawas['level'] == 'guru' or $pengawas['level'] == 'pengawas') : ?>
    <div class='row'>
        <div class='col-md-8'>
            <div class='box box-solid direct-chat direct-chat-warning'>
                <div class='box-header with-border'>
                    <h3 class='box-title'><i class='fa fa-bullhorn'></i> Pengumuman
                    </h3>
                    <div class='box-tools pull-right'></div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div id='pengumuman'>
                        <p class='text-center'>
                            <br /><i class='fa fa-spin fa-circle-o-notch'></i> Loading....
                        </p>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class='col-md-4'>
            <div class='box box-solid '>
                <div class='box-body'>
                    <strong><i class='fa fa-building-o'></i> <?= $setting['sekolah'] ?></strong><br />
                    <?= $setting['alamat'] ?><br /><br />
                    <strong><i class='fa fa-phone'></i> Telepon</strong><br />
                    <?= $setting['telp'] ?><br /><br />
                    <strong><i class='fa fa-fax'></i> Fax</strong><br />
                    <?= $setting['fax'] ?><br /><br />
                    <strong><i class='fa fa-globe'></i> Website</strong><br />
                    <?= $setting['web'] ?><br /><br />
                    <strong><i class='fa fa-at'></i> E-mail</strong><br />
                    <?= $setting['email'] ?><br />
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
<?php endif ?>