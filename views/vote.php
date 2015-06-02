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
	<style type="text/css">
		#fboverlay {
		    filter: alpha(opacity=60);
		    -webkit-filter: grayscale(100%);
		    -moz-filter: grayscale(100%);
		    -o-filter: grayscale(100%);
		    -ms-filter: grayscale(100%);
		    filter: grayscale(100%);
		}
	</style>
	<body>
		<!-- template header -->
		<?php //include 'web/header.php'; ?>
		<!-- Fin template -->
		
		<div class="container col-sm-12">
			<ul class="nav nav-pills">
				<li role="presentation"><a href="https://melud-exam.herokuapp.com">Retour</a></li>
			</ul>
			<h1 style="color:#000">Votez pour vos photographies favorites.</h1>
			<?php 

			$bdd = connexionBdd();
			$result = Query($bdd,"SELECT * FROM db_concours" );
			$req = pg_fetch_all($result);

			foreach ($req as $value) { ?>
			<div id="photoVote" class="col-sm-4">
				<img id="imgSelected" src="<?php echo $value['href'] ?>" alt=""><br><br>
				<div id="fboverlay" class="fb-like" data-href="<?php echo $value['href'] ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
			</div>
			<?php } ?>
		</div>
		<!-- template footer -->
		<?php //include 'web/footer.php'; ?>
		<!-- Fin template -->
		
		<div id="myModalVote" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Voter pour </h4>
					</div>
					<div class="modal-body">
						<img id="imgSelected" src="" width="100%" />
					</div>
					<div class="modal-footer">
						
					</div>
				</div>
			</div>
		</div>
	</body>
</html>