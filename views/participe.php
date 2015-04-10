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
		<link rel="stylesheet" href="<?php echo $bootstrapCSS; ?>">
		<link rel="stylesheet" href="<?php echo $stylePerso; ?>">
		<script src="<?php echo $bootstrapJS; ?>"></script>
		<script src="<?php echo $fbJS; ?>"></script>
		<title>Jeux Coucours</title>
	</head>
	<body>
		<!-- template header -->
		<?php include 'web/header.php'; ?>
		<!-- Fin template -->
		<div class="container">
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
					try{
						$_SESSION['fb-token'] = (string) $session->getAccessToken();
						$request_user = new FacebookRequest($session,"GET","/me");
						$request_user_executed = $request_user->execute();
						//$user = $request_user_executed->getGraphObject(GraphUser::className());
						$user = $request_user_executed->getGraphObject('Facebook\GraphUser');
						?>
						<a href="https://melud-exam.herokuapp.com/views/participe.php" class="btn btn-primary btn-lg">Je Participe</a>
						<a href="https://melud-exam.herokuapp.com/views/vote.php" class="btn btn-warning btn-lg">Je vote</a> <br><br>
					<?php
					} catch (Exception $e)
					{
						?>
						<?php
						$_SESSION = null;
						session_destroy();
						header('Location:index.php');
					}
					
				}
				else
				{
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