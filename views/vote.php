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
			<h1 style="color:#000">Votez pour votre photographie favorite.</h1>
			<?php 

			$bdd = connexionBdd();
			$result = Query($bdd,"SELECT * FROM utilisateur5" );
			$req = pg_fetch_all($result);

			foreach ($req as $value) { ?>
			<div class="col-sm-4">
				<img src="<?php echo $value['href'] ?>" alt=""><br>
				<div class="fb-like" data-href="<?php echo $value['href'] ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
			</div><br><br>
			<?php } ?>
			<div class="fb-like" data-share="true" data-width="450" data-show-faces="true"></div>
		</div>
		<!-- template footer -->
		<?php //include 'web/footer.php'; ?>
		<!-- Fin template -->