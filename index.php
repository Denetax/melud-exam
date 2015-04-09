<?php
	include 'include/config.php';

	//error_reporting(E_ALL);
	//ini_set("display_error", 1);

	require "SDKPHP/autoload.php";

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;

	session_start();

	/*const APPID = "1574686139449224";
	const APPSECRET = "6d8066b399193febf5f0a587443d4b48";*/

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
		<title>Test</title>
	</head>
	<body>
		<script>
		  window.fbAsyncInit = function() {
			FB.init({
			  appId      : '<?php echo APPID; ?>',
			  xfbml      : true,
			  version    : 'v2.3'
			});
		  };

			  (function(d, s, id){
			 var js, fjs = d.getElementsByTagName(s)[0];
			 if (d.getElementById(id)) {return;}
			 js = d.createElement(s); js.id = id;
			 js.src = "//connect.facebook.net/en_US/sdk.js";
			 fjs.parentNode.insertBefore(js, fjs);
		   }(document, 'script', 'facebook-jssdk'));
		</script>
		<h1>appli facebook</h1>
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
</html>