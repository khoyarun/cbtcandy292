<?php
require("config/config.default.php");

if ( isset($_POST["update_data"])) {
	if (update_data($_POST)>0) {
		echo "<script>
	      alert('Yey, Pembaruan nomor HP berhasil, berhasil!');
	      document.location.href='index.php';
	      </script>"
	      ;
	} else {

	    echo "<script>
	      alert('owh no, Gagal ditambahkan!');
	      document.location.href='update_data';
	      </script>";
	      }
	}

function update_data($data) {
	global $koneksi;
	$username = $data['username'];
	$hpq = $data['hp_baru'];
	mysqli_query($koneksi, "UPDATE siswa set hp='$hpq' where username='$username' ");
	return mysqli_affected_rows($koneksi);
}

