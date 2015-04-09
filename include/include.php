<?php	
	error_reporting(E_ALL);
	ini_set("display_error", 1);

	require "SDKPHP/autoload.php";

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;

	session_start();

	const APPID = "1574686139449224";
	const APPSECRET = "6d8066b399193febf5f0a587443d4b48";
?>