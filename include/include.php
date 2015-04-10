<?php

	/* Config css / js */

	$bootstrapCSS = "https://melud-exam.herokuapp.com/web/css/bootstrap.min.css";
	$bootstrapJS = "https://melud-exam.herokuapp.com/web/js/bootstrap.min.js";
	$fbJS = "https://melud-exam.herokuapp.com/web/js/FBconfig.js";
	$stylePerso = "https://melud-exam.herokuapp.com/web/css/styles.css";

	/* Config Générale */

	require 'config/config.php';
	require 'SDKPHP/autoload.php';
	
	/* Chargement des controllers */

	require 'controllers/SessionController.php';

?>