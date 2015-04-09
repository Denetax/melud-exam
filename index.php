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
	<link rel="stylesheet" href="web/css/bootstrap.min.css">
	<script src="web/js/bootstrap.min.js"></script>
	<script src="web/js/FBconfig.js"></script>
	<title>Jeux Coucours</title>
</head>
<body>
	<!-- template header -->
	<?php include 'web/header.php'; ?>
	<!-- Fin template -->
		<h1>Jeux Concours - Faite ton affiche de cinéma d'horreur</h1>
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
					<a href="https://melud-exam.herokuapp.com/views/vote.php" class="btn btn-info btn-lg">Je vote</a> 
				<?php
				} catch (Exception $e)
				{
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
	<!-- template footer -->
	<?php include 'web/footer.php'; ?>
	<!-- Fin template -->
</body>
</html>