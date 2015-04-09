<?php
	include 'include/include.php';

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="web/css/bootstrap.min.css">
	<script src="web/js/bootstrap.min.js"></script>
	<script src="web/js/FBconfig.js"></script>
	<title>Jeux Coucours</title>
</head>
<body>
	<!-- template header -->
	<?php include 'web/header.php'; ?>
	<!-- Fin template -->
	<div class="container">
		<h2>Jeux Concours - Fait ton affiche de cinéma d'horreur</h2>
		<p>
			Minions ipsum jeje po kass butt tulaliloo. Poopayee tatata bala tu hahaha belloo! Gelatooo jiji po kass daa para tú la bodaaa. La bodaaa me want bananaaa! Po kass ti aamoo! Ti aamoo! tank yuuu! Underweaaar potatoooo bananaaaa gelatooo. Tatata bala tu me want bananaaa! Bananaaaa bananaaaa la bodaaa la bodaaa tulaliloo baboiii uuuhhh hana dul sae. Hana dul sae hahaha butt ti aamoo! Belloo! Bananaaaa po kass ti aamoo! Potatoooo pepete aaaaaah poopayee poopayee hana dul sae po kass. Para tú daa poulet tikka masala uuuhhh aaaaaah pepete hahaha poulet tikka masala poulet tikka masala. Bappleees me want bananaaa! Belloo! Baboiii jiji gelatooo. Wiiiii ti aamoo! Jeje aaaaaah belloo! Wiiiii po kass po kass para tú. Poulet tikka masala daa jeje po kass baboiii gelatooo. Gelatooo baboiii uuuhhh hahaha hana dul sae butt bee do bee do bee do bappleees tulaliloo poopayee. Hana dul sae jiji baboiii aaaaaah wiiiii belloo! Daa hahaha potatoooo aaaaaah poopayee. Bananaaaa gelatooo po kass butt po kass butt la bodaaa wiiiii po kass tulaliloo. Ti aamoo! gelatooo tatata bala tu jiji jiji. Pepete para tú daa hana dul sae tulaliloo poulet tikka masala belloo! Poopayee. Ti aamoo! belloo! Gelatooo gelatooo. Potatoooo me want bananaaa! Uuuhhh aaaaaah belloo! Tank yuuu! Chasy ti aamoo!
		</p>
		<?php
			if($session)
			{
				try{
					$_SESSION['fb-token'] = (string) $session->getAccessToken();
					$request_user = new FacebookRequest($session,"GET","/me");
					$request_user_executed = $request_user->execute();
					//$user = $request_user_executed->getGraphObject(GraphUser::className());
					$user = $request_user_executed->getGraphObject('Facebook\GraphUser');
					?>
					<a href="https://melud-exam.herokuapp.com/views/participe.php" class="btn btn-primary btn-lg">Je Participe</a>
					<a href="https://melud-exam.herokuapp.com/views/vote.php" class="btn btn-info btn-lg">Je vote</a> <br><br>
				<?php
				} catch (Exception $e)
				{
					?>
					<?php
					$_SESSION = null;
					session_destroy();
					header('Location:index.php');
				}
				
			}
			else
			{
				$loginUrl = $helper->getLoginUrl(['email']);
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