<?php 
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	
	function connexionBdd()
	{		
		$dbconn2 = pg_connect("host=ec2-54-217-202-108.eu-west-1.compute.amazonaws.com port=5432 dbname=d83d3aeifsc9ir user=qvgrnmrngeochj password= ByPWUf6LDRo4Cflah_kraHAExL") or die('connection failed');
		// $result = pg_query($dbconn2,"CREATE TABLE db_concours(id SERIAL PRIMARY KEY NOT NULL,tokenUser VARCHAR(255),href VARCHAR(255),nomAlbum VARCHAR(100))");
		return $dbconn2;
	}

	function Query($db,$requete)
	{
		$result = pg_query($db,$requete);
		echo pg_last_error($db);
		return $result;
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
		$monId = recup_user_id($session);
		if($session != ""){
			$_SESSION['fb-token'] = (string) $session->getAccessToken();
			$request_user = new FacebookRequest($session,"GET","/".$monId."/photos");
			$request_user_executed = $request_user->execute(); 
			$user = $request_user_executed->getGraphObject('Facebook\GraphUser')->asArray();
			return $user["data"];
		}
	}

	function verif_user_id($id)
	{
		$bdd = connexionBdd();
		$result = Query($bdd,"SELECT * FROM db_concours WHERE tokenUser = '$id'" );
		
		$req = pg_fetch_all($result);
		
		return $req;
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