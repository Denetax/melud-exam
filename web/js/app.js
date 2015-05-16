$(document).ready(function(){

	$('#firstBlock').click(function(){
		$('#blockUploadDesktop').fadeOut();
		$('#blockUploadFacebook').fadeIn();
	});

	$('#secondBlock').click(function(){
		$('#blockUploadFacebook').fadeOut();
		$('#blockUploadDesktop').fadeIn();
	});

});