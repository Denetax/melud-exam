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
			<h2>Jeux Concours - Fait ton affiche de cinéma d'horreur</h2>
			<p>
				Minions ipsum tulaliloo chasy potatoooo. Belloo! jiji jiji wiiiii wiiiii pepete underweaaar wiiiii. Poopayee bananaaaa poopayee poopayee jeje uuuhhh hana dul sae aaaaaah potatoooo. Hana dul sae bee do bee do bee do belloo! Bee do bee do bee do pepete pepete baboiii. Hana dul sae tank yuuu! Belloo! Chasy bee do bee do bee do. Poulet tikka masala gelatooo daa tank yuuu! Bee do bee do bee do ti aamoo! Hahaha la bodaaa.
			</p>
			<?php
				if($session)
				{ ?>
					<?php session_auto($session); ?>
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3">
							<div class="col-sm-6">
								<a href="https://melud-exam.herokuapp.com/views/participe.php" class="btn btn-primary btn-lg">Je Participe</a>
							</div>
							<div class="col-sm-6">
								<a href="https://melud-exam.herokuapp.com/views/vote.php" class="btn btn-warning btn-lg">Je vote</a> <br><br>
							</div>
						</div>
					</div>
				<?php
				}
				else
				{
					$loginUrl = $helper->getLoginUrl(['user_photos','publish_actions']);
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