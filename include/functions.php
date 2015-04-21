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
				$_SESSION['fb-token'] = (string) $session->getAccessToken();
				$request_user = new FacebookRequest($session,"GET","/me");
				$request_user_executed = $request_user->execute(); 
				$user = $request_user_executed->getGraphObject('Facebook\GraphUser');
				// $object = $response->getGraphObject();
				// $user = $response->getGraphObject(GraphUser::className());
			}
			catch (Exception $e)
			{
				$_SESSION = null;
				session_destroy();
				header('Location:index.php');
			}
		}
	}

	function recup_user_id($session)
	{
		$monId="";
		if($session != ""){
			$_SESSION['fb-token'] = (string) $session->getAccessToken();
			$request_user = new FacebookRequest($session,"GET","/me");
			$request_user_executed = $request_user->execute(); 
			$user = $request_user_executed->getGraphObject('Facebook\GraphUser');
			$monId = $user->getProperty('id');
			return $monId;
		}
	}

	function recup_user_picture_concours($session)
	{
		$monId="";
		if($session != ""){
			$_SESSION['fb-token'] = (string) $session->getAccessToken();
			$request_user = new FacebookRequest($session,"GET","/me/albums");
			$request_user_executed = $request_user->execute(); 
			$user = $request_user_executed->getGraphObject('Facebook\GraphUser');
			//var_dump($user);
			return $monId;
		}
	}
	
	function uploadImage($session)
	{
		$url = "https://melud-exam.herokuapp.com/views/participe.php";
		// recup_user_picture_concours($session);
		$link = "/".recup_user_id($session)."/photos";
		$file = "https://melud-exam.herokuapp.com/web/img/example_image.png";  

		$test = new CURLFile($file, 'image/png', 'melud-image');
		// var_dump($test->name);

		$response = (new FacebookRequest(
			$session, 'POST', $link, $up = array(
				'source' => new CURLFile($file, 'image/png', 'melud-image'),
				'message' => 'User provided message'
			)
		))->execute()->getGraphObject();

		var_dump($up);

		$ch = curl_init();
 
		curl_setopt_array($ch, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => $up
		));
	}
?>