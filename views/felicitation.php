<?php
	include '../include/functions.php';
	require '../config/config.php';
	require '../SDKPHP/autoload.php';
	require '../controllers/SessionController.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="https://melud-exam.herokuapp.com/web/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="https://melud-exam.herokuapp.com/web/css/styles.css"/>
		<script src="https://melud-exam.herokuapp.com/web/js/jquery-2.1.4.min.js"></script>
		<script src="https://melud-exam.herokuapp.com/web/js/bootstrap.min.js"></script>
		<script src="https://melud-exam.herokuapp.com/web/js/FBconfig.js"></script>
		<script src="https://melud-exam.herokuapp.com/web/js/app.js"></script>
		<title>Jeux Coucours</title>
	</head>
	<body>
		<div class="container col-sm-12">
			<?php
				if($session)
				{ 
					?>
					<ul class="nav nav-pills">
						<li role="presentation"><a href="https://melud-exam.herokuapp.com">Retour</a></li>
					</ul>
					<?php 
					$LienImage = $_POST['inputSrc'];
					if ($LienImage != ""){
						$id_user = recup_user_id($session);
						$name_user = recup_user_name($session);
						$bdd = connexionBdd();
						$user_exist = verif_user_name($name_user);
						if($user_exist){
							upload_change_photo_user($LienImage, $name_user);
						}else{
							insert_photo_via_facebook($id_user, $LienImage, $name_user);
						}
					}
				}			
			?><br/>
		</div>
	</body>
</html>
