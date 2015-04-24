<?php 
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	
	function connexionBdd()
	{		
			
		try {
		
			// $serveur = 'mysql:host=meludexaprstocky.mysql.db;dbname=meludexaprstocky';
			// $user = 'meludexaprstocky';
			// $mdp = 'Di062005D';
			
			$pdo = new PDO('mysql:host=213.186.33.40;dbname=meludexaprstocky', 'meludexaprstocky', 'Di062005D'); 
			//$dbh = new PDO($serveur,$user,$mdp);
			// var_dump($dbh);
			// echo "test2";
			// $resultats=$pdo->query("SELECT * FROM melud_user");
			// var_dump($resultats);
			 $pdo = null;
		} catch (PDOException $e) {
			print "Erreur !: " . $e->getMessage() . "<br/>";
			die();
		}

	}
	
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
		// $monId="";
		if($session != ""){
			$_SESSION['fb-token'] = (string) $session->getAccessToken();
			$request_user = new FacebookRequest($session,"GET","/me/photos");
			$request_user_executed = $request_user->execute(); 
			$user = $request_user_executed->getGraphObject('Facebook\GraphUser');


		}
	}

	// function test(){
	// 	FB.api('/me/photos', function (response) {
	// 		foreach (photo in response.data) {
	// 			if (response.data[photo].name == "melud-exam Photos") {
	// 				image = response.data[0].images[0].source;
	// 			}
	// 		}
	// 	}
	// }

	function test($session){
		$album_details = array(
        	'message'=> 'Album desc',
        	'name'=> 'Melud'
  		);
		$create_album = new FacebookRequest($session, '/me/albums', 'post', $album_details);
	}
	
	function uploadImage($session, $file)
	{
		$link = "/".recup_user_id($session)."/albums";

		$response = new FacebookRequest(
				$session, 'POST', $link, array(
					// 'url' => $file,
					'source' =>  new CURLFile($file, 'image/png'),
					'message' => 'User provided message'
				)
			);

		$request = $response->execute();
 		$graphObject = $request->getGraphObject();
	}
?>