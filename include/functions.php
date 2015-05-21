<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<?php 
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	
	function connexionBdd()
	{		
		//pgsql:host=ec2-54-217-202-108.eu-west-1.compute.amazonaws.com;port=5432;dbname=d5iqngvvkvdj0o;user=vcgyjwcpqrizgf;password=DlgzzsaQvO0PamJBLqxj5fxlKK
		try {
				$db = new PDO("pgsql:host=ec2-54-217-202-108.eu-west-1.compute.amazonaws.com;port=5432;dbname=d83d3aeifsc9ir;user=qvgrnmrngeochj;password=ByPWUf6LDRo4Cflah_kraHAExL");
				var_dump($db);
				print_r($db);
				echo 'Connexion OK';
				$sql ='CREATE TABLE utilisateur2(id INT PRIMARY KEY NOT NULL SERIAL,tokenUser VARCHAR(100),href VARCHAR(100))';
				echo($sql);
				$db->exec($sql);
				pg_close($db);
			}
			catch(PDOException $e) {
			  $db = null;
			  echo 'ERREUR DB: ' . $e->getMessage();
			}

		// try {
				// //$sth = $db->prepare("CREATE TABLE utilisateur2(id INT PRIMARY KEY NOT NULL SERIAL,tokenUser VARCHAR(100),href VARCHAR(100))");
				// //$sth->execute();
				

			// }
			// catch (PDOException $e) {
				// print $e->getMessage();
		  // }
		//$dbconn1 = pg_connect("host=ec2-54-217-202-108.eu-west-1.compute.amazonaws.com port=5432 dbname=d5iqngvvkvdj0o user=vcgyjwcpqrizgf password= DlgzzsaQvO0PamJBLqxj5fxlKK") or die('connection failed');
		//$result = pg_query($dbconn1,"CREATE TABLE utilisateur2(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,tokenUser VARCHAR(100),href VARCHAR(100))");
		// $result = pg_query($dbconn1, "SELECT tokenUser, href FROM utilisateur");
		// if (!$result) {
		  // echo "Une erreur s'est produite.\n";
		// }
		//$result = pg_query($dbconn1, "DROP TABLE utilisateur");
		//pg_query($dbconn1, "INSERT INTO utilisateur (tokenUser, href VALUES ('oghruoufeu651781', 'http://blablabla.fr'))");
		
		//while ($row = pg_fetch_row($result)) {
		//echo "TokenUser: $row[0]  href: $row[1]";
		//echo "<br />\n";	
		
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