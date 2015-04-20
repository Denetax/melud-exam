<?php 
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	
	function session_auto($session)
	{
		$test = "";
		if($session != ""){
			try
			{
				$_SESSION['fb-token'] = (string) $session->getAccessToken();
				$request_user = new FacebookRequest($session,"GET","/me");
				$request_user_executed = $request_user->execute(); 
				$user = $request_user_executed->getGraphObject('Facebook\GraphUser');
				// $object = $response->getGraphObject();
				// $user = $response->getGraphObject(GraphUser::className());
				$test = $response->getProperty('id');
				var_dump($test);
				return $test
			}
			catch (Exception $e)
			{
				$_SESSION = null;
				session_destroy();
				header('Location:index.php');
			}
		}
	}
?>