<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
<div class='row'>
    <div class='col-md-12'>
        <div class='box box-solid'>
            <div class='box-header with-border'>
                <h3 class='box-title'><i class="fas fa-edit    "></i> Pemutahiran Nomor HP</h3>
            </div><!-- /.box-header -->
            <div class='box-body'>

                <?php
                $siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$_SESSION[id_siswa]'"));
                
                ?>
                <form action="update_fungsi.php" method="POST">
				    <div class="col-xm-3">
				    	<label>Nomor HP aktif saat ini</label>
					</div>
				    <div class="col-md-6">
				      <input type="hidden" name="username" value="<?=$siswa['username']?>">
				      <input type="number" class="form-control" placeholder="isikan no. HP yg Aktif" name="hp_baru" value="<?=$siswa['hp']?>" maxlength="12"><br>
				    0823xxxxxxxx <small>(maksimal 12 angka tanpa spasi dan tanda baca!)</small>
				    </div>
				    <br>
					<button class="btn btn-success btn-md" name="update_data" type="submit">
						Simpan
					</button>
				</form>
            </div>
        </div>
    </div>
</div>