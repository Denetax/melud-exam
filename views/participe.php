<?php
	// include '../include/include.php';
	include '../include/functions.php';
	
	require '../config/config.php';
	require '../SDKPHP/autoload.php';
	require '../controllers/SessionController.php';

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
		<script src="https://melud-exam.herokuapp.com/web/js/bootstrap.min.js"></script>
		<script src="https://melud-exam.herokuapp.com/web/js/FBconfig.js"></script>
		<title>Jeux Coucours</title>
	</head>
	<body>
		<!-- template header -->
		<?php include 'web/header.php'; ?>
		<!-- Fin template -->
		<div class="container col-sm-10 col-sm-offset-1">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<img src="http://melud-exam.fr/views/web/images/title.png"/>
					<img href="https://www.facebook.com/album.php?fbid=1111829722179&id=10206539202145025&aid=2019365"/>
				</div>
			</div>
			<h2>Jeux Concours - Fait ton affiche de cinéma d'horreur</h2>
			<p>
				Enregistre ton image pour participer au concours.
				<input type="file" class="filestyle" data-buttonName="btn-primary">
			</p>
			<p>
				Ou Récupérer une image de ton album pour participer au concours.
			</p>
			<?php
				if($session)
				{
					session_auto($session);
					$facebook->setFileUploadSupport(true);  

					# File is relative to the PHP doc  
					$file = "@".realpath("https://melud-exam.herokuapp.com/web/img/section8-image.png");  

					$args = array(  
					    'message' => 'Photo Caption',  
					    "access_token" => "AQBA4jAPglppzljiBpQXMuFxP61WRX-PzGm3s6tTgUfnjJbJA-vBvglOQaoVFiH9yk9FNNj7NM01tbCiXLm3qQFvCufAFmD1kgpNgM9vwI8u6_2k89zVjZFd8rP9oi09LwktUBOlgEWywVtJgtXyZfzSzkl-ATnbJWlYTHyUv2qBndWIMQaMIv83sjNGHEcvwP2_jvZTVTun827Vm39paC99sT1mA_mA-9EpHrbXnndfpZCg9lgOujxjTYQ1wJRzB3pf5hHkNPgp8-ZHfNsd487ln5J0hb81A7RGySA9CLc6u_y3UaYNfTKmmpuM6cWJu10&state=a2a43de956ab1678d4b4b4970d31d592#_=_",  
					    "image" => $file  
					);  


					$data = $facebook->api('/10153169477079799/photos', 'post', $args);
					if ($data) print_r("success");
				}
				else
				{
					$loginUrl = $helper->getLoginUrl(['email','user_photos','publish_actions']);
					echo "<a href=".$loginUrl." class='btn btn-primary btn-lg'>Se Connecter</a><br><br>";
				}
			?>
			<div class="fb-like" data-share="true" data-width="450" data-show-faces="true"></div>
		</div>
		<!-- template footer -->
		<?php include 'web/footer.php'; ?>
		<!-- Fin template -->
	</body>
</html>