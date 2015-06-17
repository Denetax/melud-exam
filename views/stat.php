
<?php 
include '../include/functions.php';
	
require '../config/config.php';
require '../SDKPHP/autoload.php';
require '../controllers/SessionController.php';

include '../web/header.php';

// getCountLikeFacebook($page); 

$Participant = getAllUserParticipe();

foreach ($Participant as $res) {
	echo $res['nameuser']."<br>";
	echo $res['href']."<br>";
	echo getCountLikeFacebook($res['href'])."<br><br>";
}

?>