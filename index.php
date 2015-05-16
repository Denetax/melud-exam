<?php
	include 'include/include.php';
	include 'include/functions.php';

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://melud-exam.herokuapp.com/web/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://melud-exam.herokuapp.com/web/css/styles.css">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
		<script src="https://melud-exam.herokuapp.com/web/js/bootstrap.min.js"></script>
		<script src="https://melud-exam.herokuapp.com/web/js/FBconfig.js"></script>
		<title>Jeux Coucours</title>
	</head>
	<body>
		<!-- template header -->
		<?php include 'web/header.php'; ?>
		<!-- Fin template -->
		<div class="container col-sm-12">
			<div class="row bandeBanche" style="height:50px; line-height:50px;">
				<div class="col-sm-8">
					<?php if($session == ""){
						$loginUrl = $helper->getLoginUrl(['user_photos','publish_actions']);
						echo "<a href=".$loginUrl.">Se Connecter</a><br><br>";
					} ?>
				</div>
			</div>
			<div class="row bandeImage" style="height:300px">
				<div class="col-sm-8 col-sm-offset-2">
					<h1 style="font-size:80px">Melud</h1>
					<p>
					Bienvenue sur le jeux concours Melud dédié à la photographie. <br>
					Le principe est simple, 
					prend toi en photo dans un magnifique paysage
					pour participe au coucours.
					</p>
				</div>
			</div><br><br>
			<?php
				if($session)
				{ ?>
					<?php session_auto($session); ?>
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3">
							<div class="col-sm-6">
								<a href="https://melud-exam.herokuapp.com/views/participe.php" class="btn btn-primary btn-lg">Je Participe</a>
							</div>
							<div class="col-sm-6">
								<a href="https://melud-exam.herokuapp.com/views/vote.php" class="btn btn-warning btn-lg">Je vote</a> <br><br>
							</div>
						</div>
					</div>
				<?php
				}
				// else
				// {
				// 	$loginUrl = $helper->getLoginUrl(['user_photos','publish_actions']);
				// 	echo "<a href=".$loginUrl." class='btn btn-primary btn-lg'>Se Connecter</a><br><br>";
				// }
			?>
			<div class="row">
				<div class="col-sm-3">
					<img src="https://melud-exam.herokuapp.com/web/img/80652197.jpg">
				</div>
				<div class="col-sm-3">
					<img src="https://melud-exam.herokuapp.com/web/img/82e2ae94.jpg">
				</div>
				<div class="col-sm-3">
					<img src="https://melud-exam.herokuapp.com/web/img/photo-1415298910336-daa47babb3cc.jpg">
				</div>
				<div class="col-sm-3">
					<img src="https://melud-exam.herokuapp.com/web/img/photo-1428954376791-d9ae785dfb2d.jpg">
				</div>
			</div><br><br>
			<div class="fb-like" data-share="true" data-width="450" data-show-faces="true"></div>
		</div>
		<!-- template footer -->
		<?php include 'web/footer.php'; ?>
		<!-- Fin template -->
	</body>
</html>