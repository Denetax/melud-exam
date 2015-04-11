<?php
	include 'include/include.php';

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
		<script src="https://melud-exam.herokuapp.com/web/js/bootstrap.min.js"></script>
		<script src="https://melud-exam.herokuapp.com/web/js/FBconfig.js"></script>
		<title>Jeux Coucours</title>
	</head>
	<body>
		<!-- template header -->
		<?php include 'web/header.php'; ?>
		<!-- Fin template -->
		<div class="container">
			<img src="http://melud-exam.fr/views/web/images/title.png"/>
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
					echo"j'ai passer le if";
					try{
						echo"dans le catch";
						$_SESSION['fb-token'] = (string) $session->getAccessToken();
						$request_user = new FacebookRequest($session,"GET","/me");
						$request_user_executed = $request_user->execute();
						//$user = $request_user_executed->getGraphObject(GraphUser::className());
						$user = $request_user_executed->getGraphObject('Facebook\GraphUser');
						echo"j'ai tous fait";
						?>
					<?php
					} catch (Exception $e)
					{
						echo"j'ai un soucis dans le try";
						$_SESSION = null;
						session_destroy();
						header('Location:index.php');
					}
					
				}
				else
				{
					echo"je suis pas co";
					$loginUrl = $helper->getLoginUrl(['email']);
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