<?php 
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	
	function connexionBdd()
	{		
		$dbconn2 = pg_connect("host=ec2-54-217-202-108.eu-west-1.compute.amazonaws.com port=5432 dbname=d83d3aeifsc9ir user=qvgrnmrngeochj password= ByPWUf6LDRo4Cflah_kraHAExL") or die('connection failed');
		// $result = pg_query($dbconn2,"CREATE TABLE db_concours(id SERIAL PRIMARY KEY NOT NULL,tokenUser VARCHAR(255),href VARCHAR(255),nomAlbum VARCHAR(100))");
		// $result = pg_query($dbconn2,"delete from db_concours ");
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

	function recup_user_name($session)
	{
		$monId="";
		if($session != ""){
			$_SESSION['fb-token'] = (string) $session->getAccessToken();
			$request_user = new FacebookRequest($session,"GET","/me");
			$request_user_executed = $request_user->execute(); 
			$user = $request_user_executed->getGraphObject('Facebook\GraphUser');
			$name = $user->getProperty('name');
			return $name;
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

	function recup_user_picture_album_concours($session)
	{
		$monId = recup_user_id($session);
		if($session != ""){
			$_SESSION['fb-token'] = (string) $session->getAccessToken();
			$request_user = new FacebookRequest($session,"GET","/".$monId."/albums");
			$request_user_executed = $request_user->execute(); 
			$user = $request_user_executed->getGraphObject('Facebook\GraphUser')->asArray();
			return $user["data"];
		}
	}


	function recup_user_picture_album_concours_photos($session,$id)
	{
		$monId = recup_user_id($session);
		if($session != ""){
			$_SESSION['fb-token'] = (string) $session->getAccessToken();
			$request_user = new FacebookRequest($session,"GET","/".$id."/photos");
			$request_user_executed = $request_user->execute(); 
			$user = $request_user_executed->getGraphObject('Facebook\GraphUser')->asArray();
			return $user["data"];
		}
	}

	function getVraiNameAlbum($name){

		$bdd = connexionBdd();
		$result = Query($bdd,"SELECT * FROM db_concours WHERE nomalbum = '$name'" );
		$req = pg_fetch_all($result);
		return $req;
	}

	function updateLinehref($url, $name){
		$bdd = connexionBdd();
		$result =  Query($bdd, "UPDATE db_concours SET href = '$url' WHERE nomalbum = '$name'");
		$req = pg_fetch_all($result);
		return $req;
	}


	function verif_user_name($name)
	{
		$bdd = connexionBdd();
		$result = Query($bdd,"SELECT * FROM db_concours WHERE nameuser = '$name'" );
		
		$req = pg_fetch_all($result);
		
		return $req;
	}

	function insert_photo_via_facebook($id_user, $LienImage, $name_user){
		$bdd = connexionBdd();
		$req = Query($bdd,"INSERT INTO db_concours (tokenUser, href, nameuser) VALUES ('$id_user', '$LienImage', '$name_user')" );
		return $req;
	}

	function upload_change_photo_user($LienImage, $name_user){
		$bdd = connexionBdd();
		$result =  Query($bdd, "UPDATE db_concours SET href = '$LienImage' WHERE nameuser = '$name_user'");
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

 		$nameUser = recup_user_name($session);
 		$id_user = $graphObject->getProperty('id');

 		$bdd = connexionBdd();
 		Query($bdd,"INSERT INTO db_concours (tokenUser, nomalbum, nameuser) VALUES ('$id_user', '$nameAlbum', '$nameUser')" );
 		// $error = pg_last_error($bdd);

 		$link = "/".$id_user."/photos";

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