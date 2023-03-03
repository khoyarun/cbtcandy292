<?php
require("config/config.default.php");
require("config/config.candy.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login | <?php echo $setting['aplikasi']; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dist/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dist/fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dist/vendor/animate/animate.css">

	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dist/css/util.css">
	<link rel="stylesheet" type="text/css" href="dist/css/main.css">
	<!--===============================================================================================-->
	<link rel='stylesheet' href='<?php echo $homeurl; ?>/plugins/sweetalert2/dist/sweetalert2.min.css'>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7174265070030455"
         crossorigin="anonymous"></script>
    <style>
        body, html {
        height: 100%;
        /*font-family: Poppins-Regular, sans-serif;*/
        }
    </style> 
</head>

<body style="background: url('<?= $setting['bc'] ?>');background-size:cover; background-position: center; background-repeat: no-repeat;" style="color: #FFC312;">

	<div class="limiter" >
		<div class="container-login100">
			<div class="animated flipInX wrap-login100" style="padding-top:30px; background: #52f21638;">
				<form id="formlogin" action="ceklogin.php" class="login100-form validate-form">
					<span class="animated infinite pulse delay-5s login100-form-title p-b-26 ">
						<img src="<?php echo $setting['logo']; ?>" style="max-height:90px" class="img-responsive" alt="Responsive image">
					</span>
					<span class=" login100-form-title p-b-26 ">
						<?php echo $setting['sekolah']; ?>
					</span>
					<div class="animated flipInX delay-10s p-b-20">
						<span>Silahkan Login dengan username dan password <strong><?php echo $setting['aplikasi']; ?></strong> yang anda miliki</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter Username" required>
						<input class="input100" type="text" name="username" autocomplete="off" >
						<span class="focus-input100" data-placeholder="Username"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">Login</button>
						</div>
					</div>
				</form>
				                        
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="dist/vendor/jquery/jquery-3.2.1.min.js"></script>

	<!--===============================================================================================-->
	<script src="dist/vendor/bootstrap/js/popper.js"></script>
	<script src="dist/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src='<?php echo $homeurl; ?>/plugins/sweetalert2/dist/sweetalert2.min.js'></script>
	<script src="dist/js/main.js"></script>
	<script>
		$(document).ready(function() {
			$('#formlogin').submit(function(e) {
				var homeurl;
				homeurl = '<?php echo $homeurl; ?>';
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: $(this).attr('action'),
					data: $(this).serialize(),
					success: function(data) {

						if (data == "ok") {
							console.log('sukses');
							window.location = homeurl;
						}
						if (data == "nopass") {
							swal({
								position: 'top-end',
								type: 'warning',
								title: 'Password Salah',
								showConfirmButton: false,
								timer: 1500
							});
						}
						if (data == "td") {
							swal({
								position: 'top-end',
								type: 'warning',
								title: 'Siswa tidak terdaftar',
								showConfirmButton: false,
								timer: 1500
							});
						}
						if (data == "nologin") {
							swal({
								position: 'top-end',
								type: 'warning',
								title: 'Siswa sudah aktif',
								showConfirmButton: false,
								timer: 1500
							});
						}
						if (data == "ta") {
							swal({
								position: 'top-end',
								type: 'warning',
								title: 'Akun belum diaktifkan silahkan hubungi panitia ujian',
								showConfirmButton: false,
								timer: 1500
							});
						}

					}
				})
				return false;
			});

		});

		function showpass() {
			var x = document.getElementById("pass");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
	</script>

</body>

</html>