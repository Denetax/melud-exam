<?php
	include '../include/functions.php';
	require '../config/config.php';
	require '../SDKPHP/autoload.php';
	require '../controllers/SessionController.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://melud-exam.herokuapp.com/web/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://melud-exam.herokuapp.com/web/css/styles.css">
		<script src="https://melud-exam.herokuapp.com/web/js/jquery-2.1.4.min.js"></script>
		<script src="https://melud-exam.herokuapp.com/web/js/bootstrap.min.js"></script>
		<script src="https://melud-exam.herokuapp.com/web/js/FBconfig.js"></script>
		<script src="https://melud-exam.herokuapp.com/web/js/app.js"></script>
		<title>Jeux Coucours</title>
	</head>
	<body>
		<!-- template header -->
		<?php //include 'web/header.php'; ?>
		<!-- Fin template -->
		
		<div class="container col-sm-12">
			<ul class="nav nav-pills">
				<li role="presentation"><a href="https://melud-exam.herokuapp.com">Retour</a></li>
			</ul>
			<h1 style="color:#000">Galerie d'Images.</h1>
			<?php 

			$bdd = connexionBdd();
			$result = Query($bdd,"SELECT * FROM db_concours" );
			$req = pg_fetch_all($result);

			foreach ($req as $value) { ?>
			<div class="col-sm-4">
				<img src="<?php echo $value['href'] ?>" alt="">
			</div>
			<?php } ?>
		</div>
		<!-- template footer -->
		<?php //include 'web/footer.php'; ?>
		<!-- Fin template -->
