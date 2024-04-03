<?php
ob_start();
?>
<!DOCTYPE html>
<html>

<head>
	<?php
	$listarDiseno = new ControladorDiseno();
	$diseno = $listarDiseno->listarDisenoTemplete();
	?>
	<meta charset="utf-8">
	<link rel="icon"
		href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/inventario/<?php if($diseno != null){echo $diseno[0]['icon_sistema'];}else{echo "Views/img/img.jpg";} ?>">
	<link href="Views/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="Views/css/jquery-ui.css">
	<link rel="stylesheet" href="Views/css/login.css">
	<script src="Views/js/jquery-3.3.1.slim.min.js"></script>
	<title>
		<?php if($diseno != null){echo $diseno[0]['nom_sistema'];}else{echo "Inventario";} ?>
	</title>

</head>
<body id="body-pd" class="d-flex align-items-center py-4 bg-body-tertiary">
	<header>
		<?php
		include('Views/Moduls/navar.php');
		?>
	</header>
		<div class="container-fluid">
			<div class="row">
				<div class="col min-vh-100 p-4">
					<!-- toggler -->
					<?php
					if (isset($_SESSION['rol'])) {
						?>
						<button class="btn float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
								class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
								<path fill-rule="evenodd"
									d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
							</svg>
						</button>
						<?php
					}
					?>
					<?php
					$mvc = new controladorViews();
					$mvc->enlacesPaginaControlador();
					?>
				</div>
			</div>
		</div>
	<script src="Views/js/ConectorJavaScript.js"></script>
	<script src="Views/js/jquery-3.6.0.js"></script>
	<script type='text/javascript' src='Views/js/jquery/3.2.1/jquery.min.js'></script>
	<script src="Views/js/jquery-ui.js"></script>
	<script src="Views/js/bootstrap.bundle.min.js"></script>
	<script src="Views/js/popper.min.js"></script>
	<script src="Views/js/bootstrap.min.js"></script>
	<script src="views/js/js.js"></script>
</body>

</html>