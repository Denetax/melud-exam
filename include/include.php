<?php

	/* Config css / js */

	$bootstrapCSS = "melud-exam/web/css/bootstrap.min.css";
	$bootstrapJS = "melud-exam/web/js/bootstrap.min.js";
	$fbJS = "melud-exam/web/js/FBconfig.js";
	$stylePerso = "melud-exam/web/css/styles.css"

	/* Config Générale */

	require 'config/config.php';
	require 'SDKPHP/autoload.php';
	
	/* Chargement des controllers */

	require 'controllers/SessionController.php';

?>