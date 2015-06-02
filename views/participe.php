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
					<li><a href="https://melud-exam.herokuapp.com/views/conditionGeneralUtilisation.php">Condition Géneral D'utilisation</a></li>
					<li role="presentation"><a href="#" id="firstBlock">Upload Facebook</a></li>
					<li role="presentation"><a href="#" id="secondBlock">Upload PC</a></li>
				</ul>
				<div id="blockUploadFacebook">
				<p>
					Sélectionne une photo parmit celle de ton compte Facebook.
				</p>
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
									<img src="<?php echo $url_img ?>" width="100%" />
								<?php 
								}
							}
							?>

						 <? }
					} ?>
				</div>
				</div>
				<div id="blockUploadDesktop">
				<p>
					Télécharge une image depuis ton ordinateur.
				</p>
				<?php
				session_auto($session);
				if (isset($_POST['participer']) && $_FILES['fichier']['name'] != "" && $_POST['nameAlbum'] != "" && $_POST['descAlbum'] != "")
				{
					createAlbum($session, $_FILES['fichier']['tmp_name'], $_POST['nameAlbum'], $_POST['descAlbum']);
					echo "Votre photo est upload, votre participation au concours est pris en compte";
					$album = recup_user_picture_album_concours($session);
					foreach ($album as $value) {
						// if (true){
						echo $value->name;
						if (getVraiNameAlbum($value->name)){
							// var_dump($value->name);
							// var_dump($value->id);
							echo $value->name;
							// var_dump($value);
							// getVraiNameAlbum($value->name);
							// $listPhotoAlbum = recup_user_picture_album_concours_photos($session,$value->id);
							// var_dump($listPhotoAlbum);
						}
						// }
					}
				}else{ ?>
				<form enctype="multipart/form-data" method="POST" action="https://melud-exam.herokuapp.com/views/participe.php">
					<div class="row">
						<div class="col-sm-6">
							<div class="input-group input-group-lg">
		  						<span class="input-group-addon" id="sizing-addon1">#</span>
		  						<input type="text" class="form-control" id="nameAlbum" name="nameAlbum" placeholder="Nom de l'album" aria-describedby="sizing-addon1" required>
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-sm-6">
							<div class="input-group input-group-lg">
		  						<span class="input-group-addon" id="sizing-addon1">#</span>
		  						<input type="text" class="form-control" id="descAlbum" name="descAlbum" placeholder="Description de l'album" aria-describedby="sizing-addon1" required>
							</div>
						</div>
					</div><br>
					<input type="file" id="fichier" name="fichier" class="filestyle" data-buttonName="btn-primary"><br>
					<button class="btn btn-default" id="participer" name="participer">Valider</button>
				</form>
			<?php }	?>
			</div>
				<?php } 
			?>
		</div>
		<!-- template footer -->
		<?php //include 'web/footer.php'; ?>
		<!-- Fin template -->
		
		
		
		<div id="myModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Sélection de votre photos</h4>
					</div>
					<form action="felicitation.php" method="post">
						<div class="modal-body">
							<input id="inputSrc" name="inputSrc" type="text" style="display:none;" value=""/>
							<img id="imgSelected" src="" width="100%" />
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Retour</button>
							<button id="buttonSendPhoto" type="submit" class="btn btn-primary">Valider</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

