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
					$file = "https://melud-exam.herokuapp.com/web/img/example_image.png";  
					
					 $response = (new FacebookRequest(
					  $session, 'POST', '/me/10153169477079799', array(
						'url' => $file,
						'message' => 'User provided message'
					  )
					))->execute()->getGraphObject();
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