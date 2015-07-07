<?php
	include '../include/functions.php';
	require '../config/config.php';
	require '../SDKPHP/autoload.php';
	require '../controllers/Session2Controller.php';

	include '../web/header.php';
?>
	<body>
		<div class="container col-sm-12">
			<ul class="nav nav-pills">
				<li><a href="https://melud-exam.herokuapp.com">Retour</a></li>
				<li><a href="https://melud-exam.herokuapp.com/views/conditionGeneralUtilisation.php">Mentions Légales</a></li>
			</ul>
			<h1>Votez pour vos photographies favorites.</h1>
			
			<?php 
			$bdd = connexionBdd();
			$result = Query($bdd,"SELECT * FROM db_concours" );
			$req = pg_fetch_all($result);

			foreach ($req as $value) 
			{ 
				?>
				<div id="photoVote" class="col-md-4">
					<img src="<?php echo $value['href'] ?>" alt=""></br></br>
					<input id="inputNameUser" value="<?php echo $value['nameUser'] ?>"  type="text" style="display:none;"/>
					<input id="inputSrc" name="inputSrc" type="text" style="display:none;" value=""/>
					<div id="fboverlay" class="fb-like" data-href="<?php echo $value['href'] ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
				</div>
			<?php 
			} 
			?>
		</div>
		<div id="myModalVote" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 id="titreNomUser" class="modal-title">Voter pour  </h4>
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