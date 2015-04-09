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
	<?php include 'web/header.php'; ?>
	<body>
		<h1>Yes</h1>
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
					<a href="https://melud-exam.herokuapp.com/participe.php">Je Participe</a>
					<a href="https://melud-exam.herokuapp.com/vote.php">Je vote</a> 
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
				echo "<a href=".$loginUrl.">Se Connecter</a><br><br>";
			}
		?>
		<div class="fb-like" data-share="true" data-width="450" data-show-faces="true"></div>
	</body>
	<?php include 'web/footer.php'; ?>
</html>