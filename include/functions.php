<?php 
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	
	function connexionBdd()
	{		
			
		try {
			echo("test1");
			$dbh = new PDO('mysql:host=meludexaprstocky.mysql.db''dbname=meludexaprstocky','meludexaprstocky','Di062005D');
			echo("test2");
			foreach($dbh->query('SELECT * from melud_user') as $row) {
			echo("test3");
				print_r($row);
			}
			echo("test4");
			$dbh = null;
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
			//var_dump($user);
			return $monId;
		}
	}
	
	function uploadImage($session, $file)
	{
		$link = "/".recup_user_id($session)."/photos";
		// $file = $_FILES['fichier']['name'];
		// $file_tmp = $_FILES['fichier']['tmp_name'];

		$response = new FacebookRequest(
				$session, 'POST', $link, $up = array(
					'url' => $file,
					// 'source' =>  new CURLFile($file, 'image/png'),
					'message' => 'User provided message'
				)
			);

		$request = $response->execute();
 		$graphObject = $request->getGraphObject();
	}
?>