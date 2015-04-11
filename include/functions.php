<?php 
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	
	function session_auto($session)
	{
		if($session != ""){
			try
			{
				echo "test";
				$_SESSION['fb-token'] = (string) $session->getAccessToken();
				$request_user = new FacebookRequest($session,"GET","/me");
				$request_user_executed = $request_user->execute();
				//$user = $request_user_executed->getGraphObject(GraphUser::className());
				$user = $request_user_executed->getGraphObject('Facebook\GraphUser');
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