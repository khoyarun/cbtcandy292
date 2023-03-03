<?php
require("../config/config.default.php");
require("../config/config.function.php");
require("../config/config.candy.php");

$namaaplikasi = $setting['aplikasi'];
$namasekolah = $setting['sekolah'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login Panel Admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../favicon.ico" />
	<!--<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/bootstrap.min.css">-->
	<link rel="stylesheet" type="text/css" href="../plugins/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="../plugins/animate/animate.min.css">
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/util.css">
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/main.css">
	<link rel='stylesheet' href='<?= $homeurl ?>/plugins/izitoast/css/iziToast.min.css'>
	
	<style>
	    /* Made with love by Mutiullah Samim*/

        @import url('https://fonts.googleapis.com/css?family=Numans');
        
        html,body{
        background-image: url('../<?= $setting['bc'] ?>');
        background-size: cover;
        background-repeat: no-repeat;
        height: 100%;
        font-family: 'Numans', sans-serif;
        }
        
        .container{
        height: 100%;
        align-content: center;
        }
        
        .card{
        height: 270px;
        margin-top: auto;
        margin-bottom: auto;
        width: 320px;
        background-color: rgba(0,0,0,0.5) !important;
        }
        
        .social_icon span{
        font-size: 60px;
        margin-left: 10px;
        color: #FFC312;
        }
        
        .social_icon span:hover{
        color: white;
        cursor: pointer;
        }
        
        .card-header h3 {
        color: white;
        }
        
        .social_icon{
        position: absolute;
        right: 20px;
        top: -45px;
        }
        
        .input-group-prepend span{
        width: 40px;
        background-color: #FFC312;
        color: black;
        border:0 !important;
        }
        
        input:focus{
        outline: 0 0 0 0  !important;
        box-shadow: 0 0 0 0 !important;
        
        }
        
        .remember{
        color: white;
        }
        
        .remember input
        {
        width: 20px;
        height: 20px;
        margin-left: 15px;
        margin-right: 5px;
        }
        
        .login_btn{
        color: black;
        background-color: #FFC312;
        width: 100px;
        }
        
        .login_btn:hover{
        color: black;
        background-color: white;
        }
        
        .links{
        color: white;
        }
        
        .links a{
        margin-left: 4px;
        }
        
        
	</style>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>


<body>
	<div class="container">
    	<div class="d-flex justify-content-center h-100">
    		<div class="card">
    			<div class="card-header">
    				<h3>Sign In ADMIN</h3>
    				
    				<div class="d-flex justify-content-end social_icon">
    					<!--<span><i class="fab fa-facebook-square"></i></span>-->
    					<!--<span><i class="fab fa-google-plus-square"></i></span>-->
    					<!--<span><i class="fab fa-twitter-square"></i></span>-->
    				</div>
    			</div>
    			<div class="card-body">
    				<form id="form-login" class="validate-form">
    					<div class="input-group form-group">
    						<div class="input-group-prepend">
    							<span class="input-group-text"><i class="fas fa-user"></i></span>
    						</div>
    						<input type="text" class="form-control" name="username" placeholder="username">
    						
    					</div>
    					<div class="input-group form-group">
    						<div class="input-group-prepend">
    							<span class="input-group-text"><i class="fas fa-key"></i></span>
    						</div>
    						<input type="password" name="password"  class="form-control" placeholder="password">
    					</div>
    					<div class="row align-items-center remember">
    						<!--<input type="checkbox">Remember Me-->
    					</div>
    					<div class="form-group">
    						<input type="submit" value="Login" class="btn float-right login_btn">
    					</div>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>

	<script src='../plugins/jQuery/jquery-3.2.1.min.js'></script>
	<script src='../dist/bootstrap/js/bootstrap.min.js'></script>

	<script src="../plugins/jQuery/main.js"></script>
	<script src='<?= $homeurl ?>/plugins/izitoast/js/iziToast.min.js'></script>
	<script>
		$(document).ready(function() {
			$('#form-login').submit(function(e) {
				var homeurl;
				homeurl = '<?php echo $homeurl; ?>';
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: 'ceklogin.php',
					data: $(this).serialize(),
					success: function(data) {
						console.log(data);
						if (data == "ok") {
							iziToast.success({
								title: 'Login Berhasil!',
								message: "Anda akan dialihkan",
								position: 'topRight'
							});
							setTimeout(function() {
								location.href = '.';
							}, 2000);
						}
						if (data == "nopass") {
							iziToast.error({
								title: 'Maaf!',
								message: 'password salah',
								position: 'topRight'
							});

						}
						if (data == "td") {
							iziToast.error({
								title: 'Maaf!',
								message: 'akun tidak ada',
								position: 'topRight'
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