<?php
	include '../include/functions.php';
	require '../config/config.php';
	require '../SDKPHP/autoload.php';
	require '../controllers/SessionController.php';

	include '../web/header.php';
?>

	<body>
		<div class="container col-sm-12">
			<ul class="nav nav-pills">
				<li><a href="https://melud-exam.herokuapp.com">Retour</a></li>
				<li><a href="https://melud-exam.herokuapp.com/views/conditionGeneralUtilisation.php">Mention Légales</a></li>
			</ul>
			
			<h1>Galerie d'Images.</h1>
			<?php 
			$bdd = connexionBdd();
			$result = Query($bdd,"SELECT * FROM db_concours" );
			$req = pg_fetch_all($result);
			?> 
			<div id="photoGalerie"> 
			<?php
			foreach ($req as $value) 
			{ 
				?>
				<div class="col-sm-4" style="height:300px;overflow:hidden;">
					<img src="<?php echo $value['href'] ?>"/>
				</div>
				<?php 
			}
			?>
			</div>
		</div>
		<div id="myModalGalerie" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title"></h4>
					</div>
					<div class="modal-body">
						<img id="imgSelected" width="100%" />
					</div>
					<div class="modal-footer">
						
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
