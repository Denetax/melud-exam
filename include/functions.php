<?php 
	function session_auto($session){
		if($session)
			{
				try{
					$_SESSION['fb-token'] = (string) $session->getAccessToken();
					$request_user = new FacebookRequest($session,"GET","/me");
					$request_user_executed = $request_user->execute();
					//$user = $request_user_executed->getGraphObject(GraphUser::className());
					$user = $request_user_executed->getGraphObject('Facebook\GraphUser');
					?>
				<?php
				} catch (Exception $e)
				{
					?>
					<?php
					$_SESSION = null;
					session_destroy();
					header('Location:index.php');
				}
				return "test";
			}
	}

?>