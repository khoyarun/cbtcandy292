<?php
//konfigurasi server database
// $host = 'localhost';
// $debe = 'u1708537_app_cbt_pusat';
// $user = 'u1708537_cbtsyimulapusat';
// $pass = 'Fwa25AKkX36a8F@';

//konfigurasi server cbtlokal
$host = 'localhost';
$debe = 'candy_cbtcandy292_git';
$user = 'root';
$pass = '';


$koneksi = mysqli_connect($host, $user, $pass, "");
if ($koneksi) {
	$pilihdb = mysqli_select_db($koneksi, $debe);
	if ($pilihdb) {
		$query = mysqli_query($koneksi, "SELECT * FROM setting WHERE id_setting='1'");
		if ($query) {
			$setting = mysqli_fetch_array($query);
			mysqli_set_charset($koneksi, 'utf8');
			$sess = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM session WHERE id='1'"));
			date_default_timezone_set($setting['waktu']);
		}
	}
}
    