
<?php 
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
// (isset($_GET['idk'])) ? $idk = "id_kelas = ".$_GET['idk'] : $idk = " id_kelas = LIKE".'1%';
// (isset($_GET['idk'])) ? $idk = $_GET['idk'] : $idk = '1%';
if (isset($_GET['idk'])) {
	 $idk = $_GET['idk'];
	 $siswa = mysqli_query($koneksi, "SELECT id_siswa,id_kelas,nama,username,status FROM siswa WHERE server != 'ONLINE' AND id_kelas = '$idk'");
} else {
	$siswa = mysqli_query($koneksi, "SELECT id_siswa,id_kelas,nama,username,status FROM siswa WHERE server != 'ONLINE'");
}
// echo $idk;
// die;
// $idk = $_GET['idk'] ;
                ;?>
<div class='row'>
    <div class='col-md-12'>
        <div class='box box-solid'>
            <div class='box-header with-border '>
                <h3 class='box-title'><i class="fas fa-user-friends fa-fw   "></i> Peserta Ujian <?= $idk ;?></h3> 
                <div class='box-tools pull-right'>
					<div class="btn-group">
					  <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					   Perkelas
					  </button>
					  <div class="dropdown-menu">
					  	<?php 
					  	$kelas = mysqli_query($koneksi, "SELECT id_kelas FROM kelas"); 
					  	while($kls = mysqli_fetch_array($kelas)){
					  		echo '<a  href="?pg=aktifasi&idk=';
					  		echo $kls['id_kelas'];
					  		echo '" class="btn btn-sm"';
					  		echo '"> Kelas  '.$kls['id_kelas'].'</a><br>'; 
					  	} ?>
					  	<a href="?pg=aktifasi" class="btn btn-sm">Semua</a>
					  </div>
					</div>
                    <button id='btnstatus' class='btn btn-sm btn-primary'><i class="fas fa-edit    "></i> Aktifkan</button>
                    <button id='btnstatus2' class='btn btn-sm btn-danger'><i class="fas fa-edit    "></i> Non Aktifkan</button>
                </div>
            </div><!-- /.box-header -->
            <div class='box-body'>

                <div class='table-responsive'>
                    <table style="font-size: 11px" id='tablesiswa' class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                                <th width='5px'><input type='checkbox' id='cekall'></th>
                                <th width='3px'></th>
                                <th>Kelas</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;?>
                            <?php // $siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE server != 'ONLINE' AND $var2 ") ;?>
                            <?php while ($data = mysqli_fetch_array($siswa)) { ?>
                                <tr>
                                    <td><input type='checkbox' name='cekpilih[]' class='cekpilih' id='cekpilih-<?= $no ?>' value="<?= $data['id_siswa'] ?>"></td>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['id_kelas'] ?></td>
                                    <td><?= $data['nama'] ?></td>
                                    <td><?= $data['username'] ?></td>
                                    <td>
                                        <?php if ($data['status'] == 'aktif') { ?>
                                            <span class="badge bg-green">Aktif</span>
                                        <?php  } else { ?>
                                            <span class="badge bg-red">Tidak Aktif</span>
                                        <?php } ?>
                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#cekall').change(function() {
        $(this).parents('#tablesiswa:eq(0)').
        find(':checkbox').attr('checked', this.checked);
    });
    $(function() {
        $("#btnstatus").click(function() {
            id_array = new Array();
            i = 0;
            $("input.cekpilih:checked").each(function() {
                id_array[i] = $(this).val();
                i++;
            });
            $.ajax({
                url: "mod_siswa/crud_siswa.php?pg=statusaktif",
                data: "kode=" + id_array,
                type: "POST",
                success: function(respon) {
                    if (respon == 1) {
                        // $("input.cekpilih:checked").each(function() {
                        //     $(this).parent().parent().remove('.cekpilih').animate({
                        //         opacity: "hide"
                        //     }, "slow");
                        // })
                        location.reload();
                    }
                }
            });
            return false;
        })
    });
    $(function() {
        $("#btnstatus2").click(function() {
            id_array = new Array();
            i = 0;
            $("input.cekpilih:checked").each(function() {
                id_array[i] = $(this).val();
                i++;
            });
            $.ajax({
                url: "mod_siswa/crud_siswa.php?pg=statusnonaktif",
                data: "kode=" + id_array,
                type: "POST",
                success: function(respon) {
                    if (respon == 1) {
                        // $("input.cekpilih:checked").each(function() {
                        //     $(this).parent().parent().remove('.cekpilih').animate({
                        //         opacity: "hide"
                        //     }, "slow");
                        // })
                        location.reload();
                    }
                }
            });
            return false;
        })
    });
</script>