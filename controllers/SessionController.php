<?php

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	
	FacebookSession::setDefaultApplication(APPID, APPSECRET);
	
	$helper = new FacebookRedirectLoginHelper('https://melud-exam.herokuapp.com/views/participe.php');
	$helper2 = new FacebookRedirectLoginHelper('https://melud-exam.herokuapp.com/views/vote.php');

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
	}

?>