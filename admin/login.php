<?php 

session_start();
if (isset($_SESSION["n-user"])) {
	header("location:index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - Editorial Usco</title>

	<base href="./">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="author" content="cootranshuila">
	<link rel="icon" type="image/png" href="../img/uscoicon.png">
	  <!-- Icons-->
	<link href="assets/css/coreui-icons.min.css" rel="stylesheet">
	<link href="assets/css/flag-icon.min.css" rel="stylesheet">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="assets/css/simple-line-icons.css" rel="stylesheet">
	  <!-- Main styles for this application-->
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/toastr.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	  <!-- Global site tag (gtag.js) - Google Analytics-->
	<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
	<script>
	    window.dataLayer = window.dataLayer || [];

	    function gtag() {
	      dataLayer.push(arguments);
	    }
	    gtag('js', new Date());
	    // Shared ID
	    gtag('config', 'UA-118965717-3');
	    // Bootstrap ID
	    gtag('config', 'UA-118965717-5');
	</script>
</head>
<body style="overflow: hidden;">

	<div class="container" id="container-fondo">
		<div class="row">
			<!-- <img src="assets/img/fondo.jpg" class="img-fluid" id="img-fondo"> -->
		</div>
	</div>

	<div class="container" style="position: relative; z-index: 10;">
		<div class="row justify-content-center">
			<img src="../img/usco.png" class="img-fluid" id="img-logo">
		</div>
	</div>

	<div class="app flex-row align-items-center" id="app-login">
	    <div class="container">
	      <div class="row justify-content-center">
	        <div class="col-md-8">
	          <div class="card-group">
	            <div class="card p-4">
	              <div class="card-body">
	                <h1 class="active h2login">Inicia sesion</h1>
	                <p class="text-muted">Ingresa con tu cuenta</p>
	                <div class="fadeIn first" id="icon-user">
	                  <img src="assets/img/user.png" width="90" style="float: right; margin-top: -100px;" alt="User Icon" />
	                </div>
	                <form name="form-login" id="form-login" action="ValidarLogin.php" method="POST">
	                  <div class="input-group mb-3">
	                    <div class="input-group-prepend">
	                      <span class="input-group-text">
	                        <i class="icon-user"></i>
	                      </span>
	                    </div>
	                    <input id="id_usu" name="id_usu" autocomplete="off" class="form-control" type="text" placeholder="Usuario">
	                  </div>
	                  <div class="input-group mb-4">
	                    <div class="input-group-prepend">
	                      <span class="input-group-text">
	                        <i class="icon-lock"></i>
	                      </span>
	                    </div>
	                    <input id="pass" name="pass" autocomplete="off" class="form-control" type="password" placeholder="Contraseña">
	                  </div>
	                  <div class="row">
	                    <div class="col-6">
	                      <button class="btn btn-u px-4" type="submit">Ingresar</button>
	                    </div>
	                  </div>
	                </form>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
	</div>

	<script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/toastr.min.js"></script>

	<script>

		toastr.options = {
	        "closeButton": false,
	        "debug": false,
	        "newestOnTop": false,
	        "progressBar": true,
	        "positionClass": "toast-top-center",
	        "preventDuplicates": false,
	        "onclick": null,
	        "showDuration": "800",
	        "hideDuration": "1000",
	        "timeOut": "5000",
	        "extendedTimeOut": "1000",
	        "showEasing": "swing",
	        "hideEasing": "linear",
	        "showMethod": "fadeIn",
	        "hideMethod": "fadeOut"
	    }

		$('#form-login').submit(function() {
			$.ajax({
				type: 'POST',
				url: 'assets/validaciones/ValidarLogin.php',
				data: $('#form-login').serialize(),
				success:  function(data) {
					if (data == 'Ok') {
						// console.log(data);
						window.location.href = 'index.php?p=1';
					} else {
						Command: toastr["error"]("Usuario o contraseña incorrectos.", "ERROR!");
						// console.log(data);
						$('#form-login')[0].reset();
					}
				}
			});
			return false;
		});
	</script>

</body>
</html>