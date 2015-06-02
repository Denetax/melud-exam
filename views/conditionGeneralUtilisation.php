<?php
	include 'include/include.php';
	include 'include/functions.php';

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
?>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://melud-exam.herokuapp.com/web/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://melud-exam.herokuapp.com/web/css/styles.css">
		<script src="https://melud-exam.herokuapp.com/web/js/bootstrap.min.js"></script>
		<script src="https://melud-exam.herokuapp.com/web/js/FBconfig.js"></script>
		<title>Jeux Coucours</title>
	</head>
	<body>
		<!-- template header -->
		<!-- Fin template -->
		<div class="container col-sm-12">
				<div class="row bandeBanche" style="height:50px; line-height:50px;">
					<div class="col-sm-8">
						<?php if($session == ""){
							$loginUrl = $helper->getLoginUrl(['user_photos','publish_actions']); ?>
						<ul class="nav nav-pills">
							<li role="presentation"><a href="<?php echo $loginUrl ?>">Se Connecter</a></li>
							<li role="presentation"><a href="https://melud-exam.herokuapp.com/views/galerie.php">Photos participante</a></li>
						</ul>
						<?php }else{ ?>
						<?php session_auto($session); ?>
						<ul class="nav nav-pills">
							<?php 
							$result = verif_user_id(recup_user_id($session)); 
							?>
							<?php //if( $result == false ) { ?>
							<li role="presentation"><a href="https://melud-exam.herokuapp.com/views/participe.php">Je Participe</a></li>
							<?php //} ?>
							<li role="presentation"><a href="https://melud-exam.herokuapp.com/views/vote.php">Je vote</a></li>
						</ul>
						<?php } ?>	
					</div>
				</div>
				<div class="row bandeImage" style="height:300px; margin-top:20px;">
					<div class="col-sm-8 col-sm-offset-2">
						<h1 style="font-size:80px">Condition d'utilisation Melud-exam</h1>
						<p>
						Le pr�sent document a pour objet de d�finir les modalit�s et conditions dans lesquelles d�une part,  Melud-exam , ci-apr�s d�nomm� l�EDITEUR, met � la disposition de ses utilisateurs le site, et les services disponibles sur le site et d�autre part, la mani�re par laquelle l�utilisateur acc�de au site et utilise ses services.
						Toute connexion au site est subordonn�e au respect des pr�sentes conditions.
						Pour l�utilisateur, le simple acc�s au site de l�EDITEUR � l�adresse URL suivante Melud-exam.fr  implique l�acceptation de l�ensemble des conditions d�crites ci-apr�s.
						</p>
					</div>
				</div>
		</div>
		<!-- template footer -->
		<?php //include 'web/footer.php'; ?>
		<!-- Fin template -->
	</body>
</html>