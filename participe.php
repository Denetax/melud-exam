<?php
	require 'include/config.php';
	require "SDKPHP/autoload.php";

	session_start();

	<?php include 'web/namespaces.php'; ?>

	FacebookSession::setDefaultApplication(APPID, APPSECRET);

	$helper = new FacebookRedirectLoginHelper('https://melud-exam.herokuapp.com/index.php');

	if(isset($_SESSION) && isset($_SESSION['fb-token']))
	{
		$session = new FacebookSession($_SESSION['fb-token']);
	}
	else
	{
		try {
				$session = $helper->getSessionFromRedirect();
			} catch(FacebookRequestException $ex) {
				echo "Erreur Facebook";
			} catch(\Exception $ex) {
				echo "Probleme Local";
			}
		if ($session) {
		 echo "connecter";
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="web/css/bootstrap.min.css">
		<script src="web/js/bootstrap.min.js"></script>
		<script src="web/js/FBconfig.js"></script>
		<title>Je participe</title>
	</head>
	<body>
		<h1>Je participe</h1>
		<?php
			if($session)
			{
				try{
					$_SESSION['fb-token'] = (string) $session->getAccessToken();
					$request_user = new FacebookRequest($session,"GET","/me");
					$request_user_executed = $request_user->execute();
					$user = $request_user_executed->getGraphObject('Facebook\GraphUser');
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
				echo "<a href=".$loginUrl.">Se Connecter</a><br><br>";
			}
		?>
		<div>
			<h1>Enregistrer votre photo</h1>
		</div>
		<div>
			<h1>Utiliser une photo de votre album</h1>
		</div>
		<div class="fb-like" data-share="true" data-width="450" data-show-faces="true"></div>
	</body>
</html>