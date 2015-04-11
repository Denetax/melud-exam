<?php

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	FacebookSession::setDefaultApplication(APPID, APPSECRET);
	
	$monUrl = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
	$helper = new FacebookRedirectLoginHelper("$monUrl");

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