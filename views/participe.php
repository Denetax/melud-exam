<?php
	// include '../include/include.php';
	include '../include/functions.php';
	
	require '../config/config.php';
	require '../SDKPHP/autoload.php';
	require '../controllers/SessionController.php';

	include '../web/header.php';
?>
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
					<li role="presentation"><a href="#" id="firstBlock">Upload Facebook</a></li>
					<li role="presentation"><a href="#" id="secondBlock">Upload PC</a></li>
					<li><a href="https://melud-exam.herokuapp.com/views/conditionGeneralUtilisation.php">Mentions Légales</a></li>
				</ul>
				<div id="blockUploadFacebook">
					<h1>
						Pour participer au concours, vous devez d'abord selectionner votre album puis votre image
					</h1>
					<div class="row" style="margin-left:0px;">
						<div class="col-sm-3 ">
							<h1>Mes Albums</h1>
						</div>
					</div>
					<div class="col-sm-3">
						<div id="listAlbum">
						<?php
							$lesAlbums = recup_user_picture_album_concours($session); 
							foreach ($lesAlbums as $tof) 
								{
									?>
										<div class="MiseEnFormeAlbum">
											<div id="<?php echo $tof->id ?>"><?php echo $tof->name ?></div> 
										</div>
									<?php
								}
							?>
						</div>
					</div>
					<div class="col-sm-9">
						<div id="ImageAlbum">
						<img src="../web/img/loading.gif" id="loader"/>
						<?php
								$lesAlbums = recup_user_picture_album_concours($session); 
								foreach ($lesAlbums as $tof) 
									{
										$listPhotos = recup_user_picture_album_concours_photos($session, $tof->id);
										foreach ($listPhotos as $good) 
										{
											foreach ($good->images as $elem) {
												$url_img_alb = $elem->source;
												$coupe_tof = split('/', $url_img_alb);
												foreach ($coupe_tof as $val) {
													if($val == "p320x320")
													{
														?>
															<div class="SetBoxImage">
																<img alt="<?php echo $tof->name ?>" class="<?php echo $tof->id ?>" src="<?php echo $url_img_alb ?>" style="display:none;"/>
															</div>
														<?php
													}
												}
											}
										}	
									}?>		
						</div>
					</div>
				</div>
			<div id="blockUploadDesktop">
				<h1>
					Télécharge une image depuis ton ordinateur.
				</h1>
				<?php
				session_auto($session);
				$id_user = recup_user_id($session);

				$name_user = recup_user_name($session);
				$name_exist = verif_user_name($name_user);
				$album_exist = verif_if_album_exist($name_user);

				var_dump($album_exist);

				if ($name_exist)
				{
					if(!is_null($album_exist))
					{

						if(isset($_POST['participer']) && $_FILES['fichier']['name'] != "")
						{
							$file = $_FILES['fichier']['tmp_name'];
							$album_exit = recup_user_picture_album_concours($session);
							foreach ($album_exit as $values) {
								if (getVraiNameAlbum($values->name)){
									Add_New_Photo_in_Album($session, $file, $values->id);
									$listPhotoAlbumExist = recup_user_picture_album_concours_photos($session,$values->id);
									foreach ($listPhotoAlbumExist as $tofs) 
									{
										foreach ($tofs->images as $elems) {
											$url_img_albs = $elems->source;
											$coupe_tofs = split('/', $url_img_albs);
											foreach ($coupe_tofs as $vals) {
												if($vals == "p320x320")
												{
													updateLinehref($url_img_albs, $values->name);
												}
											}
										}
									}
								}
							}
						}else{
						?>
							<form enctype="multipart/form-data" method="POST" action="https://melud-exam.herokuapp.com/views/participe.php">
								<input type="file" id="fichier" name="fichier" class="filestyle" data-buttonName="btn-primary"><br>
								<button class="btn btn-default" id="participer" name="participer">Valider</button>
							</form>
						<?php
						}
					}else{
						if (isset($_POST['participer']) && $_FILES['fichier']['name'] != "" && $_POST['nameAlbum'] != "" && $_POST['descAlbum'] != "")
					{
						UpAlbum($session, $_FILES['fichier']['tmp_name'], $_POST['nameAlbum'], $_POST['descAlbum']);
						$album = recup_user_picture_album_concours($session);
						foreach ($album as $value) {
							if (getVraiNameAlbum($value->name)){
								$listPhotoAlbum = recup_user_picture_album_concours_photos($session,$value->id);
								foreach ($listPhotoAlbum as $tof) 
								{
									foreach ($tof->images as $elem) {
										$url_img_alb = $elem->source;
										$coupe_tof = split('/', $url_img_alb);
										foreach ($coupe_tof as $val) {
											if($val == "p320x320")
											{
												updateLinehref($url_img_alb, $value->name);
											}
										}
									}
								}
							}
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
				<?php }	


					}
				}else{

					if (isset($_POST['participer']) && $_FILES['fichier']['name'] != "" && $_POST['nameAlbum'] != "" && $_POST['descAlbum'] != "")
					{
						createAlbum($session, $_FILES['fichier']['tmp_name'], $_POST['nameAlbum'], $_POST['descAlbum']);
						$album = recup_user_picture_album_concours($session);
						foreach ($album as $value) {
							if (getVraiNameAlbum($value->name)){
								$listPhotoAlbum = recup_user_picture_album_concours_photos($session,$value->id);
								foreach ($listPhotoAlbum as $tof) 
								{
									foreach ($tof->images as $elem) {
										$url_img_alb = $elem->source;
										$coupe_tof = split('/', $url_img_alb);
										foreach ($coupe_tof as $val) {
											if($val == "p320x320")
											{
												updateLinehref($url_img_alb, $value->name);
											}
										}
									}
								}
							}
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
				<?php }	

			}?>
			</div>
		<?php } ?>
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

