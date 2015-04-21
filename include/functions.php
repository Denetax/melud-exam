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
		// recup_user_picture_concours($session);
		$link = "/".recup_user_id($session)."/photos";
		$file = "https://melud-exam.herokuapp.com/web/img/example_image.png";  

		$test = new CURLFile($file, 'image/png')

		$response = (new FacebookRequest(
			$session, 'POST', $link, array(
				'source' => $test,
				'message' => 'User provided message'
			)
		))->execute()->getGraphObject();

		$imgdata = array('myimage' => $test);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $target);
		curl_setopt($curl, CURLOPT_USERAGENT,'Opera/9.80 (Windows NT 6.2; Win64; x64) Presto/2.12.388 Version/12.15');
		curl_setopt($curl, CURLOPT_HTTPHEADER,array('User-Agent: Opera/9.80 (Windows NT 6.2; Win64; x64) Presto/2.12.388 Version/12.15','Referer: http://someaddress.tld','Content-Type: multipart/form-data'));
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // stop verifying certificate
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($curl, CURLOPT_POST, true); // enable posting
		curl_setopt($curl, CURLOPT_POSTFIELDS, $imgdata); // post images 
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); // if any redirection after upload
		$r = curl_exec($curl); 
		curl_close($curl);
	}
?>