<?php
	include '../include/functions.php';
	require '../config/config.php';
	require '../SDKPHP/autoload.php';
	require '../controllers/SessionController.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://melud-exam.herokuapp.com/web/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://melud-exam.herokuapp.com/web/css/styles.css">
		<script src="https://melud-exam.herokuapp.com/web/js/jquery-2.1.4.min.js"></script>
		<script src="https://melud-exam.herokuapp.com/web/js/bootstrap.min.js"></script>
		<script src="https://melud-exam.herokuapp.com/web/js/FBconfig.js"></script>
		<script src="https://melud-exam.herokuapp.com/web/js/app.js"></script>
		<title>Jeux Coucours</title>
	</head>
	<body>
		<!-- template header -->
		<?php //include 'web/header.php'; ?>
		<!-- Fin template -->
		
		<div class="container col-sm-12">
			<?php
				if($session)
				{ ?>
				<ul class="nav nav-pills">
					<li role="presentation"><a href="https://melud-exam.herokuapp.com">Retour</a></li>
				</ul>
				<?php 
					$LienImage = $_POST['inputSrc'];
					if ($LienImage != ""){
						$id_user = recup_user_id($session);
						$bdd = connexionBdd();
						$user_exist = verif_user_id($id_user);
						/*if ($user_exist == false)
						{*/
							Query($bdd,"INSERT INTO db_concours (tokenUser, href) VALUES ('$id_user', '$LienImage')" );
						//}
					}
					$album = recup_user_picture_album_concours($session);
					foreach ($album as $value) {
						// if (getVraiNameAlbum($value->name) != false){
							getVraiNameAlbum($value->name);
							$lil = recup_user_picture_album_concours_photos($session,$value->id);
							// var_dump($lil);
						// }
					}

				}
				
			?><br>
		</div>
		<!-- template footer -->
		<?php //include 'web/footer.php'; ?>
		<!-- Fin template -->
