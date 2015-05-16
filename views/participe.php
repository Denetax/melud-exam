<?php
	// include '../include/include.php';
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
		<script src="https://melud-exam.herokuapp.com/web/js/bootstrap.min.js"></script>
		<script src="https://melud-exam.herokuapp.com/web/js/FBconfig.js"></script>
		<title>Jeux Coucours</title>
	</head>
	<body>
		<!-- template header -->
		<?php include 'web/header.php'; ?>
		<!-- Fin template -->
		<div class="container col-sm-12">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<img src="http://melud-exam.fr/views/web/images/title.png"/>
				</div>
			</div>
			<h2>Jeux Concours</h2>
			<?php
				if($session)
				{ ?>
				<?php $lesPhotos = recup_user_picture_concours($session); ?>
				<div id="picture_fb">
					<?php
					foreach ($lesPhotos as $variable) 
					{
						foreach ($variable->images as $element) {
							$url_img = $element->source;
							$coupe = split('/', $url_img);
							foreach ($coupe as $value) {
								if($value == "p320x320")
								{
								?>
								<span id="LesImages">
									<img src="<?php echo $url_img ?>" width="100%" />
									<input type="radio" name="check" id="check" />
								</span>
								<?php 
								}
							}
							?>

						 <? }
					} ?>
				</div>
				<?php
				session_auto($session);
				if (isset($_POST['participer']) && $_FILES['fichier']['name'] != "" && $_POST['nameAlbum'] != "" && $_POST['descAlbum'] != "")
				{
					createAlbum($session, $_FILES['fichier']['tmp_name'], $_POST['nameAlbum'], $_POST['descAlbum']);
					echo "Votre photo est upload, votre participation au concours est pris en compte";	
				}else{ ?>
				<p>
					Récupére une image de ton album pour participer au concours.
				</p>
				<form enctype="multipart/form-data" method="POST" action="https://melud-exam.herokuapp.com/views/participe.php">
					<div class="row">
						<div class="col-sm-6">
							<div class="input-group input-group-lg">
		  						<span class="input-group-addon" id="sizing-addon1">#</span>
		  						<input type="text" class="form-control" id="nameAlbum" name="nameAlbum" placeholder="Nom de l'album" aria-describedby="sizing-addon1" required>
							</div>
						</div>
					</div><br><br>
					<div class="row">
						<div class="col-sm-6">
							<div class="input-group input-group-lg">
		  						<span class="input-group-addon" id="sizing-addon1">#</span>
		  						<input type="text" class="form-control" id="descAlbum" name="descAlbum" placeholder="Description de l'album" aria-describedby="sizing-addon1" required>
							</div>
						</div>
					</div>
					<input id="input-1a" name="fichier" type="file" class="file" data-show-preview="false">
					<!-- <input type="file" id="fichier" name="fichier" class="filestyle" data-buttonName="btn-primary"> -->
					<button id="participer" name="participer">Valider</button>
				</form>
			<?php }	
				}
				else
				{
					$loginUrl = $helper->getLoginUrl(['email','user_photos','publish_actions']);
					echo "<a href=".$loginUrl." class='btn btn-primary btn-lg'>Se Connecter</a><br><br>";
				}
			?>
			<div class="fb-like" data-share="true" data-width="450" data-show-faces="true"></div>
		</div>
		<!-- template footer -->
		<?php include 'web/footer.php'; ?>
		<!-- Fin template -->
	</body>
</html>