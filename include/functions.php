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
		$monId="";
		if($session != ""){
			$_SESSION['fb-token'] = (string) $session->getAccessToken();
			$request_user = new FacebookRequest($session,"GET","/me/albums");
			$request_user_executed = $request_user->execute(); 
			$user = $request_user_executed->getGraphObject('Facebook\GraphUser');

			var_dump($user->getProperty("data")->getProperty(0));
			
		}
	}

	function createAlbum($session, $file, $nameAlbum, $descAlbum){
		$album_details = array(
        	'message'=> $descAlbum,
        	'name'=> $nameAlbum
  		);
		$create_album = new FacebookRequest($session, 'POST', '/me/albums', $album_details);
		$request = $create_album->execute();
 		$graphObject = $request->getGraphObject();

 		$link = "/".$graphObject->getProperty('id')."/photos";

		$response = new FacebookRequest(
				$session, 'POST', $link, array(
					// 'url' => $file,
					'source' =>  new CURLFile($file, 'image/png'),
					'message' => 'User provided message'
				)
			);

		$request2 = $response->execute();
 		$graphObject2 = $request2->getGraphObject();
	}
?>