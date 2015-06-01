<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<?php 
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	
	function connexionBdd()
	{		
		$dbconn2 = pg_connect("host=ec2-54-217-202-108.eu-west-1.compute.amazonaws.com port=5432 dbname=d83d3aeifsc9ir user=qvgrnmrngeochj password= ByPWUf6LDRo4Cflah_kraHAExL") or die('connection failed');
		// $result = pg_query($dbconn2,"CREATE TABLE utilisateur5(id SERIAL PRIMARY KEY NOT NULL,tokenUser VARCHAR(255),href VARCHAR(255))");
		//$result = pg_query($dbconn2,"INSERT INTO utilisateur (tokenUser, href) VALUES ('oghruoufeu651781', 'http://blablabla.fr')");
		//$result = pg_query($dbconn2, "SELECT id,tokenUser, href FROM utilisateur3");
		//while ($row = pg_fetch_row($result)) {
		//echo "TokenUser: $row[0] TokenUser: $row[1]  href: $row[2]";
		//echo "<br />\n";	
		//}
		//echo pg_last_error($dbconn2);
		//pg_close($dbconn2);
		return $dbconn2;
	}	
	function Query($db,$requete)
	{
		$result = pg_query($db,$requete);
		echo pg_last_error($db);
		// var_dump($result);
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
		$result = Query($bdd,"SELECT * FROM utilisateur5 WHERE tokenUser = $id" );
		return $result;
	}

	// function data_test($session)
	// {
	// 	$test = recup_user_picture_concours($session);
	// 	foreach ($variable as $test) {
	// 		var_dump($variable);
	// 	}
	// }

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