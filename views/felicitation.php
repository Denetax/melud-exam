<?php
	include '../include/functions.php';
	require '../config/config.php';
	require '../SDKPHP/autoload.php';
	require '../controllers/SessionController.php';

	include '../web/header.php'
?>
	
	<body>
		<div class="container col-sm-12">
			<?php
				if($session)
				{ 
					?>
					<ul class="nav nav-pills">
						<li role="presentation"><a href="https://melud-exam.herokuapp.com">Retour</a></li>
					</ul>
					<div id ="miseEnFormeFeliciation" class="col-md-offset-2 col-md-8"> 
						
					</div>
					<?php 
					$LienImage = $_POST['inputSrc'];
					if ($LienImage != ""){
						$id_user = recup_user_id($session);
						$name_user = recup_user_name($session);
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
