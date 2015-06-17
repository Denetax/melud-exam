<?php
	include 'include/include.php';
	include 'include/functions.php';

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="https://melud-exam.herokuapp.com/web/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="https://melud-exam.herokuapp.com/web/css/styles.css"/>
		<script src="https://melud-exam.herokuapp.com/web/js/bootstrap.min.js"></script>
		<script src="https://melud-exam.herokuapp.com/web/js/FBconfig.js"></script>
		<title>Jeux Coucours</title>
	</head>
	<body>
		<div class="container col-sm-12">
			<div class="row bandeBanche" style="height:50px; line-height:50px;">
				<div class="col-sm-8">
					<?php if($session == "")
					{
						$loginUrl = $helper->getLoginUrl(['user_photos','publish_actions']); ?>
						<ul class="nav nav-pills">
							<li><a href="<?php echo $loginUrl ?>">Je Participe</a></li>
							<li><a href="https://melud-exam.herokuapp.com/views/galerie.php">Photos participante</a></li>
							<li><a href="https://melud-exam.herokuapp.com/views/conditionGeneralUtilisation.php">Mentions Légales</a></li>
						</ul>
					<?php 
					}
					else
					{ 
						session_auto($session); ?>
						<ul class="nav nav-pills">
							<li role="presentation"><a href="https://melud-exam.herokuapp.com/views/participe.php">Je Participe</a></li>
							<li role="presentation"><a href="https://melud-exam.herokuapp.com/views/vote.php">Je vote</a></li>
							<li><a href="https://melud-exam.herokuapp.com/views/conditionGeneralUtilisation.php">Mentions Légales</a></li>
						</ul>
					<?php 
					} 
					?>	
				</div>
			</div>
			<div class="row bandeImage" style="height:300px; margin-top:20px;">
				<div class="col-sm-8 col-sm-offset-2">
					<h1 style="font-size:80px">Melud</h1>
					<p>
						Bienvenue sur le jeux concours Melud dédié à la photographie. <br>
						Le principe est simple, 
						prend toi en photo dans un magnifique paysage
						pour participe au coucours.
					</p>
				</div>
			</div>
			<?php 
				$page = "https://fbcdn-sphotos-b-a.akamaihd.net/hphotos-ak-xfa1/v/t1.0-9/p320x320/295450_321730364615230_364064530_n.jpg?oh=1ac507bfc183f8f264bf7011c1ba4d27&oe=56078D4D&__gda__=1441451754_1c605e834f0b8d9f08f560e6ea99adeb";
				getCountLikeFacebook($page); 
			?>
			<!-- <div class="row">
				<div class="col-sm-3">
					<img src="https://melud-exam.herokuapp.com/web/img/80652197.jpg"/>
				</div>
				<div class="col-sm-3">
					<img src="https://melud-exam.herokuapp.com/web/img/82e2ae94.jpg"/>
				</div>
				<div class="col-sm-3">
					<img src="https://melud-exam.herokuapp.com/web/img/photo-1415298910336-daa47babb3cc.jpg"/>
				</div>
				<div class="col-sm-3">
					<img src="https://melud-exam.herokuapp.com/web/img/photo-1428954376791-d9ae785dfb2d.jpg"/>
				</div>
			</div> --><br/>
			<div class="fb-like" data-share="true" data-width="450" data-show-faces="true"></div>
		</div>
	</body>
</html>